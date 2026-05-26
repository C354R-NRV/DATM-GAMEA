<?php
session_start();
header('Content-Type: application/json');

// Convertir todos los errores PHP a excepciones
set_error_handler(function ($severity, $message, $file, $line) {
    throw new ErrorException($message, 0, $severity, $file, $line);
});

// Manejador global de excepciones no capturadas
set_exception_handler(function ($e) {
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'message' => $e->getMessage()
    ]);
    exit;
});

try {
    // Configuración de la base de datos
    $hostname_conexion_usuarios = '172.16.21.17:3307';
    $database_conexion_usuarios = "atencion_fiscalizacion";
    $username_conexion_usuarios = "datmremote";
    $password_conexion_usuarios = "1n0v4d05";

    // Crear conexión usando mysqli
    $conexion_usuarios = new mysqli(
        $hostname_conexion_usuarios,
        $username_conexion_usuarios,
        $password_conexion_usuarios,
        $database_conexion_usuarios
    );

    // Verificar conexión
    if ($conexion_usuarios->connect_error) {
        die(json_encode(['error' => 'Error de conexión: ' . $conexion_usuarios->connect_error]));
    }

    // Obtener fecha (parámetro GET o actual)
    $date_param = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
    $date_param_safe = $conexion_usuarios->real_escape_string($date_param);

    $response = [];

    // Filtro adicional según rol y área
    $filtroAux = '';
    if (
        isset($_SESSION['area'], $_SESSION['rol']) &&
        $_SESSION['area'] === 'UF' &&
        in_array($_SESSION['rol'], ['JEFATURA', 'JEFE AREA'])
    ) {
        $filtroAux = " AND SUBSTRING_INDEX(th.tramite, '-', 1) NOT IN ('RT', 'PI') ";
    }

    // Función para ejecutar consultas y devolver datos
    function fetch_query($conexion, $sql, $singleRow = false)
    {
        $result = $conexion->query($sql);
        if (!$result) {
            throw new Exception('Error en consulta: ' . $conexion->error);
        }
        if ($singleRow) {
            return $result->fetch_assoc();
        }
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $result->free();
        return $data;
    }

    // --- Consulta 1: Minutos promedio de espera ---
    $sql_wait_time = "
    SELECT ROUND(
        AVG(
            TIMESTAMPDIFF(
                SECOND,
                STR_TO_DATE(fecha_hora_tiket, '%d/%m/%Y %H:%i:%s'),
                STR_TO_DATE(fecha_hora_inicio_atencion, '%d/%m/%Y %H:%i:%s')
            ) / 60
        ), 2
    ) AS minutos_promedio_espera
    FROM tramite_historico th
    WHERE DATE(STR_TO_DATE(fecha_hora_tiket, '%d/%m/%Y %H:%i:%s')) = '$date_param_safe'
        AND STR_TO_DATE(fecha_hora_inicio_atencion, '%d/%m/%Y %H:%i:%s') IS NOT NULL
        AND STR_TO_DATE(fecha_hora_inicio_atencion, '%d/%m/%Y %H:%i:%s') > STR_TO_DATE(fecha_hora_tiket, '%d/%m/%Y %H:%i:%s')
        $filtroAux;
    ";

    $row = fetch_query($conexion_usuarios, $sql_wait_time, true);

    $response['minutos_promedio_espera'] = isset($row['minutos_promedio_espera'])
        ? floatval($row['minutos_promedio_espera'])
        : 0.0;



    // --- Consulta 2: Minutos promedio de atención ---
    $sql_attention_time = "
SELECT ROUND(
    AVG(
        TIMESTAMPDIFF(
            SECOND,
            STR_TO_DATE(fecha_hora_inicio_atencion, '%d/%m/%Y %H:%i:%s'),
            STR_TO_DATE(fecha_hora_fin_atencion, '%d/%m/%Y %H:%i:%s')
        ) / 60
    ), 2
) AS minutos_promedio_atencion
FROM atencion_fiscalizacion.tramite_historico th
WHERE DATE(STR_TO_DATE(fecha_hora_tiket, '%d/%m/%Y %H:%i:%s')) = '$date_param_safe'
    AND STR_TO_DATE(fecha_hora_inicio_atencion, '%d/%m/%Y %H:%i:%s') IS NOT NULL
    AND STR_TO_DATE(fecha_hora_fin_atencion, '%d/%m/%Y %H:%i:%s') IS NOT NULL
    AND STR_TO_DATE(fecha_hora_fin_atencion, '%d/%m/%Y %H:%i:%s') > STR_TO_DATE(fecha_hora_inicio_atencion, '%d/%m/%Y %H:%i:%s')
    $filtroAux;
";
    $row = fetch_query($conexion_usuarios, $sql_attention_time, true);
    $response['minutos_promedio_atencion'] = isset($row['minutos_promedio_atencion']) ? floatval($row['minutos_promedio_atencion']) : 0.0;

    // --- Consulta 3: Trámites atendidos por usuario ---
    $sql_attended_by_user = "
SELECT uh.NOMBRE_OPERADOR, COUNT(th.id) AS cantidad_tramites_atendidos
FROM atencion_fiscalizacion.tramite_historico AS th
INNER JOIN atencion_fiscalizacion.usuarios_habilitados AS uh ON th.atiende_usuario = uh.USUARIO
WHERE th.estado = 'ATENDIDO'
    AND DATE(STR_TO_DATE(th.fecha_hora_tiket, '%d/%m/%Y %H:%i:%s')) = '$date_param_safe'
    $filtroAux
GROUP BY uh.NOMBRE_OPERADOR
ORDER BY cantidad_tramites_atendidos DESC;
";
    $data = fetch_query($conexion_usuarios, $sql_attended_by_user);
    foreach ($data as &$row) {
        $row['cantidad_tramites_atendidos'] = intval($row['cantidad_tramites_atendidos']);
    }
    $response['tramites_atendidos_por_usuario'] = $data;

    // --- Consulta 4: Resumen por tipo de trámite ---
    $sql_types_summary = "
SELECT SUBSTRING_INDEX(th.tramite, '-', 1) AS tipo_tramite,
        SUM(1) AS cantidad_creados,
        SUM(CASE WHEN th.estado = 'ATENDIDO' THEN 1 ELSE 0 END) AS cantidad_atendidos
FROM atencion_fiscalizacion.tramite_historico AS th
WHERE th.estado IN ('CREADO', 'ATENDIDO')
    AND STR_TO_DATE(th.fecha_hora_tiket, '%d/%m/%Y %H:%i:%s') IS NOT NULL
    AND DATE(STR_TO_DATE(fecha_hora_tiket, '%d/%m/%Y %H:%i:%s')) = '$date_param_safe'
    $filtroAux
GROUP BY SUBSTRING_INDEX(th.tramite, '-', 1)
ORDER BY tipo_tramite ASC;
";
    $data = fetch_query($conexion_usuarios, $sql_types_summary);
    foreach ($data as &$row) {
        $row['cantidad_creados'] = intval($row['cantidad_creados']);
        $row['cantidad_atendidos'] = intval($row['cantidad_atendidos']);
    }
    $response['resumen_tipos_tramite'] = $data;

    // --- Las consultas 5, 6 y 7 se reescriben de la misma manera --- 

    $sql_attended_by_user = "
SELECT
    DATE(STR_TO_DATE(th.fecha_hora_tiket, '%d/%m/%Y %H:%i:%s')) AS fecha_creacion,
    SUBSTRING_INDEX(th.tramite, '-', 1) AS tipo_tramite,
    SUM(1) AS cantidad_creados,
    SUM(CASE WHEN th.estado = 'ATENDIDO' THEN 1 ELSE 0 END) AS cantidad_atendidos
FROM
    atencion_fiscalizacion.tramite_historico AS th
WHERE
    th.estado IN ('CREADO', 'ATENDIDO')
    AND STR_TO_DATE(th.fecha_hora_tiket, '%d/%m/%Y %H:%i:%s') IS NOT NULL
    AND DATE(STR_TO_DATE(fecha_hora_tiket, '%d/%m/%Y %H:%i:%s')) = '" . $date_param_safe . "'
GROUP BY
    DATE(STR_TO_DATE(th.fecha_hora_tiket, '%d/%m/%Y %H:%i:%s')),
    SUBSTRING_INDEX(th.tramite, '-', 1)
    $filtroAux  
ORDER BY
    fecha_creacion ASC,
    tipo_tramite ASC;
";
    $data = fetch_query($conexion_usuarios, $sql_attended_by_user);
    foreach ($data as &$row) {
        $row['cantidad_creados'] = intval($row['cantidad_creados']);
        $row['cantidad_atendidos'] = intval($row['cantidad_atendidos']);
    }
    $response['detalle_por_tipo'] = $data;


    $sql_attended_by_user = "
SELECT
    uh.NOMBRE_OPERADOR,
    SUBSTRING_INDEX(th.tramite, '-', 1) AS tipo_tramite,
    COUNT(th.id) AS cantidad_por_tipo_de_tramite,
    
    COALESCE(ROUND(
        AVG(
            TIMESTAMPDIFF(
                SECOND,
                STR_TO_DATE(fecha_hora_inicio_atencion, '%d/%m/%Y %H:%i:%s'),
                STR_TO_DATE(fecha_hora_fin_atencion, '%d/%m/%Y %H:%i:%s')
            ) / 60
        ), 2
    ),0 )  AS minutos_promedio_atencion
FROM
    atencion_fiscalizacion.tramite_historico AS th
INNER JOIN
    atencion_fiscalizacion.usuarios_habilitados AS uh ON th.atiende_usuario = uh.USUARIO
WHERE
    th.estado = 'ATENDIDO'
    AND DATE(STR_TO_DATE(th.fecha_hora_tiket, '%d/%m/%Y %H:%i:%s')) = '" . $date_param_safe . "'
    $filtroAux  
GROUP BY
    uh.NOMBRE_OPERADOR,
    SUBSTRING_INDEX(th.tramite, '-', 1)
ORDER BY
    uh.NOMBRE_OPERADOR,
    cantidad_por_tipo_de_tramite DESC;
";
    $data = fetch_query($conexion_usuarios, $sql_attended_by_user);
    foreach ($data as &$row) {
        $row['cantidad_por_tipo_de_tramite'] = intval($row['cantidad_por_tipo_de_tramite']);
    }
    $response['matriz_operador_tipo'] = $data;



    $sql_attended_by_user = "
SELECT
    DATE(STR_TO_DATE(th.fecha_hora_tiket, '%d/%m/%Y %H:%i:%s')) AS fecha_creacion,
    SUM(1) AS cantidad_creados,
    SUM(CASE WHEN th.estado = 'ATENDIDO' THEN 1 ELSE 0 END) AS cantidad_atendidos
FROM
    tramite_historico AS th
WHERE
    th.estado IN ('CREADO', 'ATENDIDO')
    AND STR_TO_DATE(th.fecha_hora_tiket, '%d/%m/%Y %H:%i:%s') IS NOT NULL
    AND DATE(STR_TO_DATE(fecha_hora_tiket, '%d/%m/%Y %H:%i:%s')) = '" . $date_param_safe . "'
    $filtroAux   
GROUP BY
    DATE(STR_TO_DATE(th.fecha_hora_tiket, '%d/%m/%Y %H:%i:%s'))
ORDER BY
fecha_creacion ASC;
";
    $data = fetch_query($conexion_usuarios, $sql_attended_by_user);
    foreach ($data as &$row) {
        $row['cantidad_creados'] = intval($row['cantidad_creados']);
        $row['cantidad_atendidos'] = intval($row['cantidad_atendidos']);
    }
    $response['resumen_torta'] = $data;



    echo json_encode($response);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'message' => $e->getMessage()
    ]);
    exit;
}
