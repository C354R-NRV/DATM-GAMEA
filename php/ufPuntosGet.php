<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

/**
 * Backend optimizado para manejar datos masivos por teselas (tiles)
 * Soporta tanto carga normal como carga masiva optimizada
 * Actualizado para funcionar con el frontend completo
 */

// Habilitar reporte de errores para debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log de debug
function logDebug($message)
{
    error_log("[ufPuntosGet-Optimizado] " . $message);
}

try {
    logDebug("Iniciando script ufPuntosGet.php");

    // Verificar parámetros requeridos
    $required_params = ['minLat', 'maxLat', 'minLng', 'maxLng'];
    foreach ($required_params as $param) {
        if (!isset($_GET[$param]) || $_GET[$param] === '') {
            throw new Exception("Parámetro requerido faltante: $param");
        }
    }

    // Obtener y validar parámetros
    $minLat = floatval($_GET['minLat']);
    $maxLat = floatval($_GET['maxLat']);
    $minLng = floatval($_GET['minLng']);
    $maxLng = floatval($_GET['maxLng']);
    $zoom = isset($_GET['zoom']) ? intval($_GET['zoom']) : 13;
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 2000;
    $masivo = isset($_GET['masivo']) ? intval($_GET['masivo']) : 0;

    // Configuración para archivo GeoJSON
    $geojsonFile = '../static/geojson/grupo_numeros_con_guion.geojson';
    $useGeojsonFile = isset($_GET['useGeojson']) ? intval($_GET['useGeojson']) : 0;

    // Determinar límite de puntos basado en zoom
    $zoomBasedLimit = 500;
    if ($zoom > 13) {
        $zoomBasedLimit = 500 + (($zoom - 13) * 250);
    } elseif ($zoom < 13) {
        $zoomBasedLimit = max(100, 500 - ((13 - $zoom) * 100));
    }

    $limit = min($limit, $zoomBasedLimit);

    logDebug("Parámetros: minLat=$minLat, maxLat=$maxLat, minLng=$minLng, maxLng=$maxLng, zoom=$zoom, limit=$limit, masivo=$masivo, useGeojson=$useGeojsonFile");
    logDebug("Límite ajustado por zoom ($zoom): $limit");

    // Validar rangos de coordenadas
    if ($minLat >= $maxLat || $minLng >= $maxLng) {
        throw new Exception("Rangos de coordenadas inválidos");
    }

    if ($minLat < -90 || $maxLat > 90 || $minLng < -180 || $maxLng > 180) {
        throw new Exception("Coordenadas fuera del rango válido");
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

        logDebug("Conectando a la base de datos...");

        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
        $pdo = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_TIMEOUT => 30
        ]);
        $pdo->exec("SET NAMES 'UTF8'");

        logDebug("Conexión a la base de datos exitosa");

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
                        estado_fiscalizacion, 
                        to_char(a.fecha_cambio_estado, 'DD/MM/YYYY HH24:MI:SS') fecha_cambio_estado, 
                        c1.usuario usuario_cambio_estado, 
                        observacion_estado, 
                        no_formulario,
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
                        where  estado_ 
                        GROUP BY numero_inmueble 
                    ) b ON a.numero_inmueble = b.numero_inmueble AND a.id = b.max_id   
                    LEFT JOIN datm_usuario c ON c.id = a.idusuario
                    left join uf_estado_fiscalizacion d on d.idestado_fiscalizacion = a.idestado_fiscalizacion
                    LEFT JOIN datm_usuario c1 ON c1.id = a.idusuario_cambio_estado
                    WHERE a.estado_ and a.geom IS NOT NULL
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

            $sql = "
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
                    to_char(a.fecha_apersonamiento, 'DD/MM/YYYY HH24:MI:SS') AS fecha_apersonamiento,
                    a.fecha_apersonamiento as fecha_apersonamiento_raw,
                    estado_fiscalizacion,
                    a.tipologia,  
                        to_char(a.fecha_cambio_estado, 'DD/MM/YYYY HH24:MI:SS') fecha_cambio_estado,
                        c1.usuario usuario_cambio_estado,
                        observacion_estado,
                    c.usuario, no_formulario
                FROM uf_predial a 
                INNER JOIN ( 
                    SELECT numero_inmueble, MAX(id) AS max_id 
                    FROM uf_predial 
                    where  estado_ 
                    GROUP BY numero_inmueble 
                ) b ON a.numero_inmueble = b.numero_inmueble AND a.id = b.max_id   
                LEFT JOIN datm_usuario c ON c.id = a.idusuario
                left join uf_estado_fiscalizacion d on d.idestado_fiscalizacion = a.idestado_fiscalizacion
                LEFT JOIN datm_usuario c1 ON c1.id = a.idusuario_cambio_estado
                WHERE  a.estado_ and a.geom IS NOT NULL
                AND ST_Intersects(
                    a.geom, 
                    ST_MakeEnvelope(:minLng, :minLat, :maxLng, :maxLat, 4326)
                )
                ORDER BY 
                    CASE 
                        WHEN :zoom >= 15 THEN random()
                        ELSE ST_Distance(a.geom, ST_Centroid(ST_MakeEnvelope(:minLng2, :minLat2, :maxLng2, :maxLat2, 4326)))
                    END
                LIMIT :limit
            ";
        }

        logDebug("Ejecutando query SQL...");

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':minLat', $minLat, PDO::PARAM_STR);
        $stmt->bindValue(':maxLat', $maxLat, PDO::PARAM_STR);
        $stmt->bindValue(':minLng', $minLng, PDO::PARAM_STR);
        $stmt->bindValue(':maxLng', $maxLng, PDO::PARAM_STR);
        $stmt->bindValue(':zoom', $zoom, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);

        if ($masivo) {
            $stmt->bindValue(':zoom2', $zoom, PDO::PARAM_INT);
        } else {
            $stmt->bindValue(':minLat2', $minLat, PDO::PARAM_STR);
            $stmt->bindValue(':maxLat2', $maxLat, PDO::PARAM_STR);
            $stmt->bindValue(':minLng2', $minLng, PDO::PARAM_STR);
            $stmt->bindValue(':maxLng2', $maxLng, PDO::PARAM_STR);
        }

        $stmt->execute();
        $results = $stmt->fetchAll();

        logDebug("Query ejecutada. Resultados encontrados: " . count($results));

        if ($masivo) {
            $totalCount = count($results) * 10;
            logDebug("Conteo estimado para modo masivo: $totalCount");
        } else {
            $countSql = "
                SELECT COUNT(*) as total 
                FROM uf_predial a 
                INNER JOIN ( 
                    SELECT DISTINCT numero_inmueble, MAX(id) AS max_id 
                    FROM uf_predial 
                    where  estado_ 
                    GROUP BY numero_inmueble    
                ) b ON a.numero_inmueble = b.numero_inmueble AND a.id = b.max_id       
                where  a.estado_ and  a.geom IS NOT NULL    
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
        }

        // Procesar resultados de base de datos
        $data = [];
        $currentDate = date('Y-m-d'); // Fecha actual para comparación

        foreach ($results as $row) {
            try {
                $imagenes = processImages($row['imagen_principal'], $row['imagen_adicional']);

                if ($masivo && $zoom < 14) {
                    $popupHtml = createSimplifiedPopupHtml($row);
                } else {
                    $popupHtml = createPopupHtml($row, $imagenes);
                }

                // MEJORA: Verificar si la fecha de apersonamiento es hoy
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
                    'usuario' => $row['usuario'],
                    'no_formulario' => $row['no_formulario'],
                    'estado_fiscalizacion' => $row['estado_fiscalizacion'],
                    'tipologia' => $row['tipologia'],
                    'html' => $popupHtml
                ];
            } catch (Exception $e) {
                logDebug("Error procesando fila ID {$row['id']}: " . $e->getMessage());
                continue;
            }
        }
    }

    logDebug("Datos procesados: " . count($data) . " elementos");

    // Respuesta con metadatos optimizada
    $response = [
        'data' => $data,
        'meta' => [
            'total' => intval($totalCount),
            'returned' => count($data),
            'zoom' => $zoom,
            'masivo' => $masivo,
            'source' => ($useGeojsonFile && file_exists($geojsonFile)) ? 'geojson' : 'database',
            'current_date' => date('Y-m-d'), // Fecha actual para referencia
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

    logDebug("Enviando respuesta exitosa");
    echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
} catch (PDOException $e) {
    logDebug("Error de base de datos: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'error' => 'Error de base de datos',
        'message' => $e->getMessage(),
        'code' => $e->getCode()
    ], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    logDebug("Error general: " . $e->getMessage());
    http_response_code(400);
    echo json_encode([
        'error' => 'Error en la solicitud',
        'message' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
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
        return [];
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
    if ($row['estado_fiscalizacion'] != 'VISITADO') {
        $estado = '<div class="info-row">
                    <div class="info-label">Estado:</div>
                    <div class="info-value">' . $row['estado_fiscalizacion']  . '</div>
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
                </div>
                ';
    }
    $act = '';
    if ($row['cant_act'] > 0) {

        $act = '<div class="info-row">
                    <div class="info-label">Cantidad Act.:</div>
                    <div class="info-value">' . $row['cant_act']  . '</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Descripción Act.:</div>
                    <div class="info-value">' . ($row['descripcion_act'] ?? 'N/A') . '</div>
                </div> 
                ';
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
                    <div class="info-value">' . $codigo . " " . ($row['estado_fiscalizacion'] == 'PROCESADO' ? ' <a target="_blank"  href="https://www.google.com/maps?q=' . $row['lat'] . ',' . $row['lng'] . '"><i class="fa fa-street-view" style="font-size:1.2rem; COLOR: yellow" aria-hidden="true"></i></a>' : '') . '</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tipologia:</div>
                    <div class="info-value">' . $row['tipologia'] . '</div>
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
