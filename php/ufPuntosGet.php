<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

/**
 * Backend optimizado para manejar datos masivos por teselas (tiles)
 * Versión mejorada con manejo robusto de errores
 */

// Habilitar reporte de errores para debug
error_reporting(E_ALL);
ini_set('display_errors', 0); // Desactivar display_errors para producción
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');

// Log de debug mejorado
function logDebug($message, $context = [])
{
    $contextStr = !empty($context) ? ' | Context: ' . json_encode($context) : '';
    error_log("[ufPuntosGet] " . date('Y-m-d H:i:s') . " - " . $message . $contextStr);
}

function sendErrorResponse($message, $code = 500, $details = [])
{
    http_response_code($code);
    $response = [
        'success' => false,
        'error' => $message,
        'timestamp' => date('Y-m-d H:i:s'),
        'request_params' => $_GET
    ];

    if (!empty($details)) {
        $response['details'] = $details;
    }

    logDebug("ERROR: $message", $details);
    echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

try {
    logDebug("=== Iniciando script ufPuntosGet.php ===");

    // Verificar parámetros requeridos
    $required_params = ['minLat', 'maxLat', 'minLng', 'maxLng'];
    foreach ($required_params as $param) {
        if (!isset($_GET[$param]) || $_GET[$param] === '') {
            sendErrorResponse(
                "Parámetro requerido faltante: $param",
                400,
                ['missing_param' => $param, 'received_params' => array_keys($_GET)]
            );
        }
    }

    // Obtener y validar parámetros
    $minLat = floatval($_GET['minLat']);
    $maxLat = floatval($_GET['maxLat']);
    $minLng = floatval($_GET['minLng']);
    $maxLng = floatval($_GET['maxLng']);
    $zoom = isset($_GET['zoom']) ? intval($_GET['zoom']) : 13;
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 2500;
    $masivo = isset($_GET['masivo']) ? intval($_GET['masivo']) : 0;
    $modulo = isset($_GET['modulo']) ? intval($_GET['modulo']) : 'prepredial';

    // Configuración para archivo GeoJSON
    $geojsonFile = '../static/geojson/grupo_numeros_con_guion.geojson';
    $useGeojsonFile = isset($_GET['useGeojson']) ? intval($_GET['useGeojson']) : 0;

    // Determinar límite de puntos basado en zoom
    $zoomBasedLimit = 3600;
    if ($modulo != 'predial') {
        $zoomBasedLimit = 6600;
        if ($zoom > 13) {
            $zoomBasedLimit = 6600 + (($zoom - 13) * 250);
        } elseif ($zoom < 13) {
            $zoomBasedLimit = max(100, 1000 - ((13 - $zoom) * 100));
        }
    }

    $limit = min($limit, $zoomBasedLimit);

    logDebug("Parámetros recibidos", [
        'minLat' => $minLat,
        'maxLat' => $maxLat,
        'minLng' => $minLng,
        'maxLng' => $maxLng,
        'zoom' => $zoom,
        'limit' => $limit,
        'masivo' => $masivo,
        'useGeojson' => $useGeojsonFile
    ]);

    // Validar rangos de coordenadas
    if ($minLat >= $maxLat || $minLng >= $maxLng) {
        sendErrorResponse(
            "Rangos de coordenadas inválidos",
            400,
            [
                'minLat' => $minLat,
                'maxLat' => $maxLat,
                'minLng' => $minLng,
                'maxLng' => $maxLng,
                'issue' => 'minLat debe ser menor que maxLat y minLng menor que maxLng'
            ]
        );
    }

    if ($minLat < -90 || $maxLat > 90 || $minLng < -180 || $maxLng > 180) {
        sendErrorResponse(
            "Coordenadas fuera del rango válido",
            400,
            ['valid_range' => 'lat: -90 a 90, lng: -180 a 180']
        );
    }

    // Configuración de base de datos
    $host = 'localhost';
    $dbname = 'datm';
    $port = '5432';
    $username = 'postgres';
    $password = '1n0v4d05';

    // Determinar fuente de datos
    if ($useGeojsonFile && file_exists($geojsonFile)) {
        logDebug("Usando archivo GeoJSON: $geojsonFile");

        $data = loadFromGeojsonFile($geojsonFile, $minLat, $maxLat, $minLng, $maxLng, $limit, $zoom);
        $totalCount = count($data) * 10;
    } else {
        logDebug("Modo base de datos activado");

        try {
            $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
            $pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_TIMEOUT => 30
            ]);
            $pdo->exec("SET NAMES 'UTF8'");

            logDebug("Conexión a la base de datos exitosa");
        } catch (PDOException $e) {
            sendErrorResponse(
                "Error de conexión a la base de datos",
                500,
                [
                    'db_error' => $e->getMessage(),
                    'db_code' => $e->getCode(),
                    'host' => $host,
                    'port' => $port,
                    'database' => $dbname
                ]
            );
        }

        if ($masivo) {
            logDebug("Modo masivo desde BD activado");

            $sql = "
                WITH sampled_data AS ( 
                    SELECT 
                        a.cant_act,
                        a.descripcion_act,
                        a.id, 
                        a.codigo_catastral, 
                        a.nombre_razon, 
                        a.numero_inmueble, 
                        trim( a.ubicacion_nivel1||' '||a.ubicacion_nivel2 ||' '||a.ubicacion_nivel3 ||' '||a.descripcion ) as direccion, 
                        ST_Y(a.geom) as lat, 
                        ST_X(a.geom) as lng, 
                        a.imagen_principal, 
                        a.imagen_adicional,  
                        to_char(a.fecha_apersonamiento, 'DD/MM/YYYY HH24:MI:SS') fecha_apersonamiento, 
                        a.fecha_apersonamiento as fecha_apersonamiento_raw, 
                        d.estado_fiscalizacion, 
                        to_char(a.fecha_cambio_estado, 'DD/MM/YYYY HH24:MI:SS') fecha_cambio_estado, 
                        c1.usuario usuario_cambio_estado, 
                        a.observacion_estado, 
                        a.no_formulario,
                        c.usuario, 
                        CASE 
                            WHEN :zoom < 13 THEN 
                                row_number() OVER (
                                    PARTITION BY 
                                        floor(ST_X(a.geom) * 100), 
                                        floor(ST_Y(a.geom) * 100) 
                                    ORDER BY random()
                                )
                            WHEN :zoom2 < 15 THEN 
                                row_number() OVER (
                                    PARTITION BY 
                                        floor(ST_X(a.geom) * 1000), 
                                        floor(ST_Y(a.geom) * 1000) 
                                    ORDER BY random()
                                )
                            ELSE 1
                        END as sample_rank
                    FROM uf_predial a 
                    INNER JOIN ( 
                        SELECT numero_inmueble, MAX(id) AS max_id 
                        FROM uf_predial
                        WHERE estado_ 
                        GROUP BY numero_inmueble 
                    ) b ON a.numero_inmueble = b.numero_inmueble AND a.id = b.max_id   
                    LEFT JOIN datm_usuario c ON c.id = a.idusuario
                    LEFT JOIN uf_estado_fiscalizacion d ON d.idestado_fiscalizacion = a.idestado_fiscalizacion
                    LEFT JOIN datm_usuario c1 ON c1.id = a.idusuario_cambio_estado
                    WHERE a.estado_ AND a.geom IS NOT NULL
                    AND ST_Intersects(
                        a.geom, 
                        ST_MakeEnvelope(:minLng, :minLat, :maxLng, :maxLat, 4326)
                    )
                )
                SELECT * FROM sampled_data 
                WHERE sample_rank = 1
                ORDER BY random()
                LIMIT :limit
            ";
        } else {
            logDebug("Modo normal activado");

            $gridSize = 0.002; // Default para zoom 13
            if ($zoom <= 13) {
                $gridSize = 0.002; // ~200m
            } elseif ($zoom <= 15) {
                $gridSize = 0.0005; // ~50m
            } else {
                $gridSize = 0.0001; // ~10m
            }

            logDebug("Grid size calculado: $gridSize para zoom $zoom");

            $sql = "
                WITH grid_sampled AS (
                    SELECT 
                        A.cant_act,
                        A.descripcion_act,
                        A.id,
                        A.codigo_catastral,
                        A.nombre_razon,
                        A.numero_inmueble,
                        TRIM(A.ubicacion_nivel1 || ' ' || A.ubicacion_nivel2 || ' ' || A.ubicacion_nivel3 || ' ' || A.descripcion) AS direccion,
                        ST_Y(A.geom) AS lat,
                        ST_X(A.geom) AS lng,
                        A.imagen_principal,
                        A.imagen_adicional,
                        to_char(A.fecha_apersonamiento, 'DD/MM/YYYY HH24:MI:SS') AS fecha_apersonamiento,
                        A.fecha_apersonamiento AS fecha_apersonamiento_raw,
                        d.estado_fiscalizacion,
                        A.tipologia,
                        to_char(A.fecha_cambio_estado, 'DD/MM/YYYY HH24:MI:SS') AS fecha_cambio_estado,
                        c1.usuario AS usuario_cambio_estado,
                        A.observacion_estado,
                        C.usuario,
                        A.no_formulario, 
                        FLOOR(ST_X(A.geom) / :gridSize) AS grid_x,
                        FLOOR(ST_Y(A.geom) / :gridSize2) AS grid_y, 
                        CASE
                            WHEN DATE(A.fecha_apersonamiento) = CURRENT_DATE THEN 1 
                            ELSE 2 
                        END AS priority,
                        random() AS rand_order 
                    FROM uf_predial A 
                    INNER JOIN (
                        SELECT numero_inmueble, MAX(id) AS max_id 
                        FROM uf_predial 
                        WHERE estado_ 
                        GROUP BY numero_inmueble
                    ) b ON A.numero_inmueble = b.numero_inmueble AND A.id = b.max_id
                    LEFT JOIN datm_usuario C ON C.id = A.idusuario
                    LEFT JOIN uf_estado_fiscalizacion d ON d.idestado_fiscalizacion = A.idestado_fiscalizacion
                    LEFT JOIN datm_usuario c1 ON c1.id = A.idusuario_cambio_estado 
                    WHERE A.estado_ 
                    AND A.geom IS NOT NULL 
                    AND ST_Intersects(
                        A.geom, 
                        ST_MakeEnvelope(:minLng, :minLat, :maxLng, :maxLat, 4326)
                    ) 
                ),
                sampled_points AS (
                    SELECT DISTINCT ON (grid_x, grid_y) * 
                    FROM grid_sampled 
                    ORDER BY grid_x, grid_y, priority, rand_order
                ) 
                SELECT * 
                FROM sampled_points 
                ORDER BY priority, rand_order 
                LIMIT :limit
            ";
        }

        try {
            logDebug("Preparando query SQL...");
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':minLat', $minLat, PDO::PARAM_STR);
            $stmt->bindValue(':maxLat', $maxLat, PDO::PARAM_STR);
            $stmt->bindValue(':minLng', $minLng, PDO::PARAM_STR);
            $stmt->bindValue(':maxLng', $maxLng, PDO::PARAM_STR);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);

            if ($masivo) {
                $stmt->bindValue(':zoom', $zoom, PDO::PARAM_INT);
                $stmt->bindValue(':zoom2', $zoom, PDO::PARAM_INT);
            } else {
                $stmt->bindValue(':gridSize', $gridSize, PDO::PARAM_STR);
                $stmt->bindValue(':gridSize2', $gridSize, PDO::PARAM_STR);
            }

            logDebug("Ejecutando query SQL...");
            $stmt->execute();
            $results = $stmt->fetchAll();

            logDebug("Query ejecutada exitosamente. Resultados: " . count($results));
        } catch (PDOException $e) {
            sendErrorResponse(
                "Error ejecutando consulta SQL",
                500,
                [
                    'sql_error' => $e->getMessage(),
                    'sql_code' => $e->getCode(),
                    'sql_state' => $e->errorInfo[0] ?? 'N/A',
                    'driver_code' => $e->errorInfo[1] ?? 'N/A',
                    'driver_message' => $e->errorInfo[2] ?? 'N/A',
                    'mode' => $masivo ? 'masivo' : 'normal',
                    'zoom' => $zoom,
                    'limit' => $limit
                ]
            );
        }

        // Obtener conteo total
        if ($masivo) {
            $totalCount = count($results) * 10;
            logDebug("Conteo estimado para modo masivo: $totalCount");
        } else {
            try {
                $countSql = "
                    SELECT COUNT(DISTINCT a.numero_inmueble) as total
                    FROM uf_predial a
                    INNER JOIN (
                        SELECT numero_inmueble, MAX(id) AS max_id
                        FROM uf_predial
                        WHERE estado_
                        GROUP BY numero_inmueble
                    ) b ON a.numero_inmueble = b.numero_inmueble AND a.id = b.max_id
                    WHERE a.estado_ 
                    AND a.geom IS NOT NULL
                    AND ST_Intersects(
                        a.geom,
                        ST_MakeEnvelope(:minLng, :minLat, :maxLng, :maxLat, 4326)
                    )
                ";

                $countStmt = $pdo->prepare($countSql);
                $countStmt->bindValue(':minLat', $minLat, PDO::PARAM_STR);
                $countStmt->bindValue(':maxLat', $maxLat, PDO::PARAM_STR);
                $countStmt->bindValue(':minLng', $minLng, PDO::PARAM_STR);
                $countStmt->bindValue(':maxLng', $maxLng, PDO::PARAM_STR);
                $countStmt->execute();
                $totalCount = $countStmt->fetch()['total'];

                logDebug("Conteo exacto: $totalCount");
            } catch (PDOException $e) {
                logDebug("Error en conteo, usando estimación: " . $e->getMessage());
                $totalCount = count($results);
            }
        }

        // Procesar resultados de base de datos
        $data = [];
        $currentDate = date('Y-m-d');
        $errorsProcessing = [];

        foreach ($results as $index => $row) {
            try {
                $imagenes = processImages($row['imagen_principal'] ?? '', $row['imagen_adicional'] ?? '');

                if ($masivo && $zoom < 14) {
                    $popupHtml = createSimplifiedPopupHtml($row);
                } else {
                    $popupHtml = createPopupHtml($row, $imagenes);
                }

                // Verificar si la fecha de apersonamiento es hoy
                $isVisitToday = false;
                if (!empty($row['fecha_apersonamiento_raw'])) {
                    $visitDate = date('Y-m-d', strtotime($row['fecha_apersonamiento_raw']));
                    $isVisitToday = ($visitDate === $currentDate);
                }

                $data[] = [
                    'id' => $row['id'],
                    'position' => [floatval($row['lat']), floatval($row['lng'])],
                    'title' => $row['numero_inmueble'] ?: 'Sin código',
                    'nombre_razon' => $row['nombre_razon'] ?: 'Sin nombre',
                    'codigo_catastral' => $row['codigo_catastral'] ?: '',
                    'numero_inmueble' => $row['numero_inmueble'] ?: 'Sin número',
                    'description' => $row['direccion'] ?: 'Sin dirección',
                    'type' => $row['numero_inmueble'] ?: 'Sin número',
                    'fecha_apersonamiento' => $row['fecha_apersonamiento'] ?: null,
                    'fecha_apersonamiento_raw' => $row['fecha_apersonamiento_raw'] ?: null,
                    'is_visit_today' => $isVisitToday,
                    'usuario' => $row['usuario'] ?? null,
                    'no_formulario' => $row['no_formulario'] ?? null,
                    'imagen_principal' => $row['imagen_principal'] ?? null,
                    'estado_fiscalizacion' => $row['estado_fiscalizacion'] ?? null,
                    'tipologia' => $row['tipologia'] ?? null,
                    'html' => $popupHtml
                ];
            } catch (Exception $e) {
                $error = "Error procesando fila índice $index, ID {$row['id']}: " . $e->getMessage();
                logDebug($error);
                $errorsProcessing[] = $error;
                continue;
            }
        }

        if (!empty($errorsProcessing)) {
            logDebug("Errores durante procesamiento", ['errors' => $errorsProcessing]);
        }
    }

    logDebug("Datos procesados: " . count($data) . " elementos");

    // Respuesta exitosa
    $response = [
        'success' => true,
        'data' => $data,
        'meta' => [
            'total' => intval($totalCount),
            'returned' => count($data),
            'zoom' => $zoom,
            'masivo' => $masivo,
            'source' => ($useGeojsonFile && file_exists($geojsonFile)) ? 'geojson' : 'database',
            'current_date' => date('Y-m-d'),
            'tile_bounds' => [
                'minLat' => $minLat,
                'maxLat' => $maxLat,
                'minLng' => $minLng,
                'maxLng' => $maxLng
            ],
            'tile_size' => ($maxLat - $minLat) * ($maxLng - $minLng),
            'timestamp' => date('Y-m-d H:i:s')
        ]
    ];

    logDebug("=== Respuesta exitosa enviada ===");
    echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
} catch (Exception $e) {
    sendErrorResponse(
        "Error inesperado en el servidor",
        500,
        [
            'exception' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => array_slice($e->getTrace(), 0, 5) // Primeras 5 líneas del stack trace
        ]
    );
}


function loadFromGeojsonFile($geojsonFile, $minLat, $maxLat, $minLng, $maxLng, $limit, $zoom)
{
    logDebug("Cargando desde archivo GeoJSON: $geojsonFile");

    try {
        $jsonContent = file_get_contents($geojsonFile);
        if ($jsonContent === false) {
            throw new Exception("No se pudo leer el archivo GeoJSON");
        }

        $geojson = json_decode($jsonContent, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Error decodificando JSON: " . json_last_error_msg());
        }

        if (!isset($geojson['features']) || !is_array($geojson['features'])) {
            throw new Exception("Formato GeoJSON inválido: no se encontraron features");
        }

        logDebug("GeoJSON cargado correctamente: " . count($geojson['features']) . " features encontrados");

        $filteredFeatures = [];
        $processedCount = 0;

        foreach ($geojson['features'] as $feature) {
            if (count($filteredFeatures) >= $limit) {
                break;
            }

            $processedCount++;

            if (isset($feature['geometry']['coordinates'])) {
                $coords = $feature['geometry']['coordinates'];
                $lng = floatval($coords[0]);
                $lat = floatval($coords[1]);

                if (
                    $lat >= $minLat && $lat <= $maxLat &&
                    $lng >= $minLng && $lng <= $maxLng
                ) {
                    $filteredFeatures[] = $feature;
                }
            }

            if ($processedCount % 10000 === 0) {
                logDebug("Procesados $processedCount features, filtrados: " . count($filteredFeatures));
            }
        }

        logDebug("Features filtrados por coordenadas: " . count($filteredFeatures));

        $data = [];
        foreach ($filteredFeatures as $feature) {
            $coords = $feature['geometry']['coordinates'];
            $properties = $feature['properties'] ?? [];

            $text = $properties['Text'] ?? $properties['name'] ?? $properties['codigo'] ?? '';

            $popupHtml = "<div class='popup-content'>";
            $popupHtml .= "<div class='popup-title'>" . htmlspecialchars($text) . "</div>";
            $popupHtml .= "<div class='popup-description'>";
            $popupHtml .= "<strong>Coordenadas:</strong> " . number_format($coords[1], 6) . ", " . number_format($coords[0], 6) . "<br>";
            $popupHtml .= "<strong>Fuente:</strong> GeoJSON<br>";

            foreach ($properties as $key => $value) {
                if ($key !== 'Text' && !empty($value)) {
                    $popupHtml .= "<strong>" . htmlspecialchars($key) . ":</strong> " . htmlspecialchars($value) . "<br>";
                }
            }

            $popupHtml .= "</div></div>";

            $data[] = [
                'id' => 'geojson_' . ($properties['fid'] ?? $properties['id'] ?? uniqid()),
                'position' => [floatval($coords[1]), floatval($coords[0])],
                'title' => $text,
                'nombre_razon' => $properties['Layer'] ?? 'GeoJSON',
                'codigo_catastral' => $properties['EntityHandle'] ?? '',
                'numero_inmueble' => $text,
                'description' => $properties['SubClasses'] ?? 'Punto GeoJSON',
                'type' => 'geojson_point',
                'fecha_apersonamiento' => null,
                'is_visit_today' => false,
                'html' => $popupHtml
            ];
        }

        logDebug("Datos procesados desde GeoJSON: " . count($data) . " elementos");
        return $data;
    } catch (Exception $e) {
        logDebug("Error procesando archivo GeoJSON: " . $e->getMessage());
        throw new Exception("Error en GeoJSON: " . $e->getMessage());
    }
}

function processImages($imagen_principal, $imagen_adicional)
{
    $imagenes = [];

    if (!empty($imagen_principal) && trim($imagen_principal) !== '') {
        $imagenes[] = trim($imagen_principal);
    }

    if (!empty($imagen_adicional) && trim($imagen_adicional) !== '') {
        if (strpos($imagen_adicional, ',') !== false) {
            $adicionales = explode(',', $imagen_adicional);
            foreach ($adicionales as $img) {
                $img = trim($img);
                if (!empty($img)) {
                    $imagenes[] = $img;
                }
            }
        } else {
            $imagenes[] = trim($imagen_adicional);
        }
    }

    return $imagenes;
}

function createPopupHtml($row, $imagenes)
{
    $id = $row['id'];
    $codigo = htmlspecialchars($row['codigo_catastral'] ?: 'Sin código');
    $nombre = htmlspecialchars($row['nombre_razon'] ?: 'Sin nombre');
    $direccion = htmlspecialchars($row['direccion'] ?: 'Sin dirección');
    $numero_inmueble = htmlspecialchars($row['numero_inmueble'] ?: 'Sin número');

    $html = "<div class='card-inmueble' id='card-{$id}' data-images='" . json_encode($imagenes) . "' data-index='0'>";
    $html .= "<div class='header-numero'>{$numero_inmueble}</div>";

    if (!empty($imagenes)) {
        $html .= "<div class='carrusel'>";
        $html .= "<img id='img-{$id}' src='../static/ufpredial/{$imagenes[0]}' alt='Imagen del inmueble' class='carrusel-img'>";

        if (count($imagenes) > 1) {
            $html .= "<button class='carrusel-btn left' onclick='prevImage({$id})'>‹</button>";
            $html .= "<button class='carrusel-btn right' onclick='nextImage({$id})'>›</button>";
        }
        $html .= "</div>";
    }

    $estado = '<div class="icon-buttons">
                <i class="fa fa-check icon-check" aria-hidden="true" title="Inmueble actualizado" onclick="actualizarEstado(' . $id . ', \'' . $numero_inmueble . '\',1)"></i> 
                <a target="_blank" style="color:white;" href="https://www.google.com/maps?q=' . $row['lat'] . ',' . $row['lng'] . '"><i class="fa fa-street-view" aria-hidden="true"></i></a> 
                <i class="fa fa-exclamation-triangle icon-warning" aria-hidden="true" title="Desacato a la fiscalización" onclick="actualizarEstado(' . $id . ',\'' . $numero_inmueble . '\', 0)"></i> 
                </div>';

    if (isset($row['estado_fiscalizacion']) && $row['estado_fiscalizacion'] != 'VISITADO') {
        $estado = '<div class="info-row">
                    <div class="info-label">Estado:</div>
                    <div class="info-value">' . ($row['estado_fiscalizacion'] ?? 'N/A')  . '</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Fecha de cambio:</div>
                    <div class="info-value">' . ($row['fecha_cambio_estado'] ?? 'N/A') . '</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Procesado por:</div>
                    <div class="info-value">' . ($row['usuario_cambio_estado'] ?? 'N/A') . '</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Obs/Anotación:</div>
                    <div class="info-value">' . ($row['observacion_estado'] ?? '-') . '</div>
                </div>';
    }

    $act = '';
    if (isset($row['cant_act']) && $row['cant_act'] > 0) {
        $act = '<div class="info-row">
                    <div class="info-label">Cantidad Act.:</div>
                    <div class="info-value">' . $row['cant_act']  . '</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Descripción Act.:</div>
                    <div class="info-value">' . ($row['descripcion_act'] ?? 'N/A') . '</div>
                </div>';
    }

    $html .= '<div class="info-container">
                <div class="info-row">
                    <div class="info-label">Contribuyente:</div>
                    <div class="info-value">' . $nombre . '</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Dirección:</div>
                    <div class="info-value">' . $direccion . '</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Código catastral:</div>
                    <div class="info-value">' . $codigo . " " . (isset($row['estado_fiscalizacion']) && $row['estado_fiscalizacion'] == 'PROCESADO' ? ' <a target="_blank"  href="https://www.google.com/maps?q=' . $row['lat'] . ',' . $row['lng'] . '"><i class="fa fa-street-view" style="font-size:1.2rem; COLOR: yellow" aria-hidden="true"></i></a>' : '') . '</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tipologia:</div>
                    <div class="info-value">' . ($row['tipologia'] ?? 'N/A') . ' [N°Form:' . ($row['no_formulario'] ?? 'N/A') . ']</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Última visita:</div>
                    <div class="info-value">' . ($row['fecha_apersonamiento'] ?? 'N/A') . '</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Usuario:</div>
                    <div class="info-value">' . ($row['usuario'] ?? 'N/A') . '</div>
                </div>
                ' . $estado . '
                ' .  $act . ' 
            </div>';

    return $html;
}

function createSimplifiedPopupHtml($row)
{
    $numero_inmueble = htmlspecialchars($row['numero_inmueble'] ?: 'Sin número');
    $nombre = htmlspecialchars($row['nombre_razon'] ?: 'Sin nombre');
    $codigo = htmlspecialchars($row['codigo_catastral'] ?: 'Sin código');

    $html = "<div class='popup-content'>";
    $html .= "<div class='popup-title'>{$numero_inmueble}</div>";
    $html .= "<div class='popup-description'>";
    $html .= "<strong>Contribuyente:</strong> {$nombre}<br>";
    $html .= "<strong>Código:</strong> {$codigo}";
    $html .= "</div>";
    $html .= "</div>";

    return $html;
}
