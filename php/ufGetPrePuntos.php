<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Iniciar sesión si es necesario
session_start();

// Verificar si el usuario está logueado (opcional, según tu sistema)
if (!isset($_SESSION['swlogin']) || $_SESSION['swlogin'] != '1') {
    echo json_encode([
        'success' => false,
        'message' => 'Usuario no autenticado'
    ]);
    exit;
}

try {
    $host = 'localhost';
    $dbname = 'datm';
    $port = '5432';
    $username = 'postgres';
    $password = '1n0v4d05';

    // Crear conexión PDO
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);

    // Obtener parámetros de coordenadas
    $minLat = isset($_POST['minLat']) ? floatval($_POST['minLat']) : null;
    $maxLat = isset($_POST['maxLat']) ? floatval($_POST['maxLat']) : null;
    $minLng = isset($_POST['minLng']) ? floatval($_POST['minLng']) : null;
    $maxLng = isset($_POST['maxLng']) ? floatval($_POST['maxLng']) : null;

    // Validar parámetros
    if ($minLat === null || $maxLat === null || $minLng === null || $maxLng === null) {
        throw new Exception('Parámetros de coordenadas faltantes o inválidos');
    }

    // Validar que las coordenadas sean lógicas
    if ($minLat >= $maxLat || $minLng >= $maxLng) {
        throw new Exception('Coordenadas inválidas: los valores mínimos deben ser menores que los máximos');
    }
    $sql = "
        SELECT 
            a.idprepredial,
            ST_AsText(a.geom) as geom_text,
            ST_X(a.geom) as longitud_calc,
            ST_Y(a.geom) as latitud_calc,
            a.latitud,
            a.longitud,
            a.detalle,
            a.idusuario,
            a.fregistro_,
            a.estado_,
            a.color,
            a.idpredial_asociado,
            ST_Distance(
                a.geom, 
                ST_Centroid(ST_MakeEnvelope(:minLng, :minLat, :maxLng, :maxLat, 4326))
            ) as distancia_centro,
            b.usuario ,
            c.numero_inmueble
            
        FROM public.uf_prepredial a
        left join datm_usuario b on  a.idusuario = b.id  
        left join uf_predial c on c.id = a.idpredial_asociado  
        WHERE  
            a.estado_ = true
            and a.idoperativo in ( 4, 5, 6) -- [pendiente] esto debe cambiar por algo dinamico  
            AND a.geom IS NOT NULL
            AND ST_Within(
                a.geom, 
                ST_MakeEnvelope(:minLng2, :minLat2, :maxLng2, :maxLat2, 4326)
            )
        ORDER BY distancia_centro ASC
    ";

    // Preparar y ejecutar consulta
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':minLat', $minLat, PDO::PARAM_STR);
    $stmt->bindParam(':maxLat', $maxLat, PDO::PARAM_STR);
    $stmt->bindParam(':minLng', $minLng, PDO::PARAM_STR);
    $stmt->bindParam(':maxLng', $maxLng, PDO::PARAM_STR);
    $stmt->bindParam(':minLat2', $minLat, PDO::PARAM_STR);
    $stmt->bindParam(':maxLat2', $maxLat, PDO::PARAM_STR);
    $stmt->bindParam(':minLng2', $minLng, PDO::PARAM_STR);
    $stmt->bindParam(':maxLng2', $maxLng, PDO::PARAM_STR);

    $inicio = microtime(true);
    $stmt->execute();
    $tiempo_consulta = microtime(true) - $inicio;
    $resultados = $stmt->fetchAll();

    // Procesar resultados
    $prePuntos = [];
    foreach ($resultados as $row) {
        // Formatear fecha si existe
        $fecha = null;
        if ($row['fregistro_']) {
            $fecha = date('d/m/Y H:i', strtotime($row['fregistro_']));
        }

        // Usar coordenadas calculadas desde geom si están disponibles, sino usar las columnas separadas
        $lat = $row['latitud_calc'] ?? $row['latitud'];
        $lng = $row['longitud_calc'] ?? $row['longitud'];


        $prePuntos[] = [
            'idprepredial' => $row['idprepredial'],
            'latitud' => $lat,
            'longitud' => $lng,
            'detalle' => $row['detalle'].' ['.$row['idprepredial'].']',
            'idusuario' => $row['usuario'],
            'fregistro_' => $fecha,
            'estado_' => $row['estado_'],
            'color' => $row['color'],
            'idpredial_asociado' => $row['idpredial_asociado'],
            'geom_text' => $row['geom_text'],
            'numero_inmueble' => $row['numero_inmueble'],
            'distancia_centro' => round($row['distancia_centro'], 2)
        ];
    }

    // Log para debugging (opcional)
    error_log("Pre-puntos encontrados: " . count($prePuntos) . " en " . round($tiempo_consulta * 1000, 2) . "ms");

    // Respuesta exitosa
    echo json_encode([
        'success' => true,
        'data' => $prePuntos,
        'count' => count($prePuntos),
        'message' => 'Pre-puntos encontrados exitosamente',
        'query_time_ms' => round($tiempo_consulta * 1000, 2),
        'area' => [
            'minLat' => $minLat,
            'maxLat' => $maxLat,
            'minLng' => $minLng,
            'maxLng' => $maxLng
        ]
    ]);
} catch (PDOException $e) {
    // Error de base de datos
    error_log("Error de BD en ufGetPrePuntos.php: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'Error de base de datos: ' . $e->getMessage(),
        'error_code' => 'DB_ERROR'
    ]);
} catch (Exception $e) {
    // Error general
    error_log("Error en ufGetPrePuntos.php: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'error_code' => 'GENERAL_ERROR'
    ]);
}
