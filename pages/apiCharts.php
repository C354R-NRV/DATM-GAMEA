<?php
session_start();
header('Content-Type: application/json');

require_once("../conexionmysql.php");

// --- Fecha por parámetro o actual ---
$date_param = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d'); // Formato YYYY-MM-DD
$response = [];

// Filtro por rol y área
$filtroAux = '';
if ($_SESSION['area'] == 'UICT' && ($_SESSION['rol'] == 'JEFATURA' || $_SESSION['rol'] == 'JEFE AREA')) {
    $filtroAux = " AND SUBSTRING_INDEX(th.tramite, '-', 1) NOT IN ('RT', 'PI') ";
}

// Función auxiliar para ejecutar consulta y obtener resultados
function fetch_query($mysqli, $sql, $params = [], $types = "")
{
    $stmt = $mysqli->prepare($sql);
    if ($params) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $stmt->close();
    return $data;
}

// --- Consulta 1: Minutos promedio de espera ---
$sql_wait_time = "
SELECT
    ROUND(
        AVG(
            TIMESTAMPDIFF(
                SECOND,
                STR_TO_DATE(fecha_hora_tiket, '%d/%m/%Y %H:%i:%s'),
                STR_TO_DATE(fecha_hora_inicio_atencion, '%d/%m/%Y %H:%i:%s')
            ) / 60
        ), 2
    ) AS minutos_promedio_espera
FROM tramites_uict.tramite_historico th
WHERE DATE(STR_TO_DATE(fecha_hora_tiket, '%d/%m/%Y %H:%i:%s')) = ?
    AND STR_TO_DATE(fecha_hora_inicio_atencion, '%d/%m/%Y %H:%i:%s') IS NOT NULL
    AND STR_TO_DATE(fecha_hora_inicio_atencion, '%d/%m/%Y %H:%i:%s') > STR_TO_DATE(fecha_hora_tiket, '%d/%m/%Y %H:%i:%s')
    $filtroAux
";
$data = fetch_query($mysqli, $sql_wait_time, [$date_param], "s");
$response['minutos_promedio_espera'] = isset($data[0]['minutos_promedio_espera']) ? floatval($data[0]['minutos_promedio_espera']) : 0.0;

// --- Consulta 2: Minutos promedio de atención ---
$sql_attention_time = "
SELECT
    ROUND(
        AVG(
            TIMESTAMPDIFF(
                SECOND,
                STR_TO_DATE(fecha_hora_inicio_atencion, '%d/%m/%Y %H:%i:%s'),
                STR_TO_DATE(fecha_hora_fin_atencion, '%d/%m/%Y %H:%i:%s')
            ) / 60
        ), 2
    ) AS minutos_promedio_atencion
FROM tramites_uict.tramite_historico th
WHERE DATE(STR_TO_DATE(fecha_hora_tiket, '%d/%m/%Y %H:%i:%s')) = ?
    AND STR_TO_DATE(fecha_hora_inicio_atencion, '%d/%m/%Y %H:%i:%s') IS NOT NULL
    AND STR_TO_DATE(fecha_hora_fin_atencion, '%d/%m/%Y %H:%i:%s') IS NOT NULL
    AND STR_TO_DATE(fecha_hora_fin_atencion, '%d/%m/%Y %H:%i:%s') > STR_TO_DATE(fecha_hora_inicio_atencion, '%d/%m/%Y %H:%i:%s')
    $filtroAux
";
$data = fetch_query($mysqli, $sql_attention_time, [$date_param], "s");
$response['minutos_promedio_atencion'] = isset($data[0]['minutos_promedio_atencion']) ? floatval($data[0]['minutos_promedio_atencion']) : 0.0;

// --- Consulta 3: Trámites atendidos por usuario ---
$sql_attended_by_user = "
SELECT
    uh.NOMBRE_OPERADOR,
    COUNT(th.id) AS cantidad_tramites_atendidos
FROM tramites_uict.tramite_historico th
INNER JOIN tramites_uict.usuarios_habilitados uh ON th.atiende_usuario = uh.USUARIO
WHERE th.estado = 'ATENDIDO'
    AND DATE(STR_TO_DATE(th.fecha_hora_tiket, '%d/%m/%Y %H:%i:%s')) = ?
    $filtroAux
GROUP BY uh.NOMBRE_OPERADOR
ORDER BY cantidad_tramites_atendidos DESC
";
$response['tramites_atendidos_por_usuario'] = array_map(function ($row) {
    $row['cantidad_tramites_atendidos'] = intval($row['cantidad_tramites_atendidos']);
    return $row;
}, fetch_query($mysqli, $sql_attended_by_user, [$date_param], "s"));

// --- Consulta 4: Resumen por tipo ---
$sql_types_summary = "
SELECT
    SUBSTRING_INDEX(th.tramite, '-', 1) AS tipo_tramite,
    COUNT(*) AS cantidad_creados,
    SUM(CASE WHEN th.estado = 'ATENDIDO' THEN 1 ELSE 0 END) AS cantidad_atendidos
FROM tramites_uict.tramite_historico th
WHERE th.estado IN ('CREADO', 'ATENDIDO')
    AND STR_TO_DATE(th.fecha_hora_tiket, '%d/%m/%Y %H:%i:%s') IS NOT NULL
    AND DATE(STR_TO_DATE(fecha_hora_tiket, '%d/%m/%Y %H:%i:%s')) = ?
    $filtroAux
GROUP BY tipo_tramite
ORDER BY tipo_tramite ASC
";
$response['resumen_tipos_tramite'] = array_map(function ($row) {
    $row['cantidad_creados'] = intval($row['cantidad_creados']);
    $row['cantidad_atendidos'] = intval($row['cantidad_atendidos']);
    return $row;
}, fetch_query($mysqli, $sql_types_summary, [$date_param], "s"));

// --- Consulta 5: Detalle por fecha y tipo ---
$sql_detailed_by_type = "
SELECT
    DATE(STR_TO_DATE(th.fecha_hora_tiket, '%d/%m/%Y %H:%i:%s')) AS fecha_creacion,
    SUBSTRING_INDEX(th.tramite, '-', 1) AS tipo_tramite,
    COUNT(*) AS cantidad_creados,
    SUM(CASE WHEN th.estado = 'ATENDIDO' THEN 1 ELSE 0 END) AS cantidad_atendidos
FROM tramites_uict.tramite_historico th
WHERE th.estado IN ('CREADO', 'ATENDIDO')
    AND STR_TO_DATE(th.fecha_hora_tiket, '%d/%m/%Y %H:%i:%s') IS NOT NULL
    AND DATE(STR_TO_DATE(fecha_hora_tiket, '%d/%m/%Y %H:%i:%s')) = ?
    $filtroAux
GROUP BY fecha_creacion, tipo_tramite
ORDER BY fecha_creacion ASC, tipo_tramite ASC
";
$response['detalle_por_tipo'] = array_map(function ($row) {
    $row['cantidad_creados'] = intval($row['cantidad_creados']);
    $row['cantidad_atendidos'] = intval($row['cantidad_atendidos']);
    return $row;
}, fetch_query($mysqli, $sql_detailed_by_type, [$date_param], "s"));

// --- Consulta 6: Matriz operador vs tipo ---
$sql_matrix_data = "
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
    ),0) AS minutos_promedio_atencion
FROM tramites_uict.tramite_historico th
INNER JOIN tramites_uict.usuarios_habilitados uh ON th.atiende_usuario = uh.USUARIO
WHERE th.estado = 'ATENDIDO'
    AND DATE(STR_TO_DATE(th.fecha_hora_tiket, '%d/%m/%Y %H:%i:%s')) = ?
    $filtroAux
GROUP BY uh.NOMBRE_OPERADOR, tipo_tramite
ORDER BY uh.NOMBRE_OPERADOR, cantidad_por_tipo_de_tramite DESC
";
$response['matriz_operador_tipo'] = array_map(function ($row) {
    $row['cantidad_por_tipo_de_tramite'] = intval($row['cantidad_por_tipo_de_tramite']);
    return $row;
}, fetch_query($mysqli, $sql_matrix_data, [$date_param], "s"));

// --- Consulta 7: Resumen para gráfico de torta ---
$sql_pie_chart = "
SELECT
    DATE(STR_TO_DATE(th.fecha_hora_tiket, '%d/%m/%Y %H:%i:%s')) AS fecha_creacion,
    COUNT(*) AS cantidad_creados,
    SUM(CASE WHEN th.estado = 'ATENDIDO' THEN 1 ELSE 0 END) AS cantidad_atendidos
FROM tramites_uict.tramite_historico th
WHERE th.estado IN ('CREADO', 'ATENDIDO')
    AND STR_TO_DATE(th.fecha_hora_tiket, '%d/%m/%Y %H:%i:%s') IS NOT NULL
    AND DATE(STR_TO_DATE(fecha_hora_tiket, '%d/%m/%Y %H:%i:%s')) = ?
    $filtroAux
GROUP BY fecha_creacion
ORDER BY fecha_creacion ASC
";
$response['resumen_torta'] = array_map(function ($row) {
    $row['cantidad_creados'] = intval($row['cantidad_creados']);
    $row['cantidad_atendidos'] = intval($row['cantidad_atendidos']);
    return $row;
}, fetch_query($mysqli, $sql_pie_chart, [$date_param], "s"));

// Cerrar conexión
$mysqli->close();

// Respuesta final
echo json_encode($response, JSON_UNESCAPED_UNICODE);
