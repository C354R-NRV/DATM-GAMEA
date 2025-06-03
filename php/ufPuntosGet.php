<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

/**
 * Backend optimizado para manejar datos masivos por teselas (tiles)
 * Soporta tanto carga normal como carga masiva optimizada
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
    logDebug("Iniciando script ufPuntosGet-optimizado.php");

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
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 1000;
    $masivo = isset($_GET['masivo']) ? intval($_GET['masivo']) : 0; // Nuevo parámetro para modo masivo

    logDebug("Parámetros: minLat=$minLat, maxLat=$maxLat, minLng=$minLng, maxLng=$maxLng, zoom=$zoom, limit=$limit, masivo=$masivo");

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

    logDebug("Conectando a la base de datos...");

    // Conectar a la base de datos
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_TIMEOUT => 30
    ]);
    $pdo->exec("SET NAMES 'UTF8'");

    logDebug("Conexión a la base de datos exitosa");

    if ($masivo) {
        // Modo masivo: optimizaciones especiales
        logDebug("Modo masivo activado");

        // Límites más estrictos para modo masivo
        if ($zoom < 12) {
            $limit = min($limit, 200);  // Muy pocos puntos en zoom bajo
        } elseif ($zoom < 15) {
            $limit = min($limit, 500);  // Puntos medios en zoom medio
        } else {
            $limit = min($limit, 1000); // Más puntos en zoom alto
        }

        // Query optimizada para modo masivo con sampling
        $sql = "
            WITH sampled_data AS (
                SELECT 
                    a.id,
                    a.codigo_catastral,
                    a.nombre_razon,
                    a.numero_inmueble,
                    a.descripcion as direccion,
                    ST_Y(a.geom) as lat,
                    ST_X(a.geom) as lng,
                    a.imagen_principal,
                    a.imagen_adicional,
                    to_char(a.fecha_apersonamiento, 'DD/MM/YYYY') AS fecha_apersonamiento,
                    c.usuario,
                    -- Agregar sampling basado en zoom
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
                    GROUP BY numero_inmueble 
                ) b ON a.numero_inmueble = b.numero_inmueble AND a.id = b.max_id   
                LEFT JOIN datm_usuario c ON c.id = a.idusuario
                WHERE a.geom IS NOT NULL
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
        // Modo normal: usar la lógica original
        logDebug("Modo normal activado");

        // Ajustar límite basado en zoom (lógica original)
        if ($zoom < 12) {
            $limit = min($limit, 500);
        } elseif ($zoom < 15) {
            $limit = min($limit, 1500);
        } else {
            $limit = min($limit, 3000);
        }

        // Query original optimizada
        $sql = "
            SELECT 
                a.id,
                a.codigo_catastral,
                a.nombre_razon,
                a.numero_inmueble,
                a.descripcion as direccion,
                ST_Y(a.geom) as lat,
                ST_X(a.geom) as lng,
                a.imagen_principal,
                a.imagen_adicional,
                to_char(a.fecha_apersonamiento, 'DD/MM/YYYY') AS fecha_apersonamiento,
                c.usuario
            FROM uf_predial a 
            INNER JOIN ( 
                SELECT numero_inmueble, MAX(id) AS max_id 
                FROM uf_predial 
                GROUP BY numero_inmueble 
            ) b ON a.numero_inmueble = b.numero_inmueble AND a.id = b.max_id   
            LEFT JOIN datm_usuario c ON c.id = a.idusuario
            WHERE a.geom IS NOT NULL
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

    logDebug("Límite ajustado por zoom: $limit");
    logDebug("Ejecutando query SQL...");

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':minLat', $minLat, PDO::PARAM_STR);
    $stmt->bindValue(':maxLat', $maxLat, PDO::PARAM_STR);
    $stmt->bindValue(':minLng', $minLng, PDO::PARAM_STR);
    $stmt->bindValue(':maxLng', $maxLng, PDO::PARAM_STR);
    $stmt->bindValue(':zoom', $zoom, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);

    // Binding adicional para modo masivo
    if ($masivo) {
        $stmt->bindValue(':zoom2', $zoom, PDO::PARAM_INT);
    } else {
        // Binding adicional para modo normal
        $stmt->bindValue(':minLat2', $minLat, PDO::PARAM_STR);
        $stmt->bindValue(':maxLat2', $maxLat, PDO::PARAM_STR);
        $stmt->bindValue(':minLng2', $minLng, PDO::PARAM_STR);
        $stmt->bindValue(':maxLng2', $maxLng, PDO::PARAM_STR);
    }

    $stmt->execute();
    $results = $stmt->fetchAll();

    logDebug("Query ejecutada. Resultados encontrados: " . count($results));

    // Obtener conteo total para metadatos (optimizado para modo masivo)
    if ($masivo) {
        // Para modo masivo, estimamos el total basado en sampling
        $totalCount = count($results) * 10; // Estimación aproximada
        logDebug("Conteo estimado para modo masivo: $totalCount");
    } else {
        // Para modo normal, conteo exacto
        $countSql = "
            SELECT COUNT(*) as total 
            FROM uf_predial a 
            INNER JOIN ( 
                SELECT DISTINCT numero_inmueble, MAX(id) AS max_id 
                FROM uf_predial 
                GROUP BY numero_inmueble    
            ) b ON a.numero_inmueble = b.numero_inmueble AND a.id = b.max_id       
            WHERE a.geom IS NOT NULL    
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

    // Procesar resultados
    $data = [];
    foreach ($results as $row) {
        try {
            // Procesar imágenes desde imagen_principal e imagen_adicional
            $imagenes = processImages($row['imagen_principal'], $row['imagen_adicional']);

            // Crear HTML del popup (optimizado para modo masivo)
            if ($masivo && $zoom < 14) {
                // Popup simplificado para modo masivo en zoom bajo
                $popupHtml = createSimplifiedPopupHtml($row);
            } else {
                // Popup completo para modo normal o zoom alto
                $popupHtml = createPopupHtml($row, $imagenes);
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
                'html' => $popupHtml
            ];
        } catch (Exception $e) {
            logDebug("Error procesando fila ID {$row['id']}: " . $e->getMessage());
            continue;
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

/**
 * Procesar imágenes desde campos imagen_principal e imagen_adicional
 */
function processImages($imagen_principal, $imagen_adicional)
{
    $imagenes = [];

    // Procesar imagen principal
    if (!empty($imagen_principal) && trim($imagen_principal) !== '') {
        $imagenes[] = trim($imagen_principal);
    }

    // Procesar imagen adicional
    if (!empty($imagen_adicional) && trim($imagen_adicional) !== '') {
        // Si imagen_adicional contiene múltiples imágenes separadas por coma
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

/**
 * Crear HTML del popup completo (modo normal)
 */
function createPopupHtml($row, $imagenes)
{
    $id = $row['id'];
    $codigo = htmlspecialchars($row['codigo_catastral'] ?: 'Sin código');
    $nombre = htmlspecialchars($row['nombre_razon'] ?: 'Sin nombre');
    $direccion = htmlspecialchars($row['direccion'] ?: 'Sin dirección');
    $numero_inmueble = htmlspecialchars($row['numero_inmueble'] ?: 'Sin número');

    $html = "<div class='card-inmueble' id='card-{$id}' data-images='" . json_encode($imagenes) . "' data-index='0'>";
    $html .= "<div class='header-numero'>{$numero_inmueble}</div>";

    // Carrusel de imágenes
    if (!empty($imagenes)) {
        $html .= "<div class='carrusel'>";
        $html .= "<img id='img-{$id}' src='../static/ufpredial/{$imagenes[0]}' alt='Imagen del inmueble' class='carrusel-img'>";

        if (count($imagenes) > 1) {
            $html .= "<button class='carrusel-btn left' onclick='prevImage({$id})'>‹</button>";
            $html .= "<button class='carrusel-btn right' onclick='nextImage({$id})'>›</button>";
        }
        $html .= "</div>";
    }

    // Información del inmueble
    $html .= "<div class='info-inmueble'>";
    $html .= "<strong>Contribuyente:</strong> {$nombre}<br>";
    $html .= "<strong>Dirección:</strong> {$direccion}<br>";
    $html .= "<strong>Código catastral:</strong> {$codigo}<br>";
    $html .= '<strong>Última visita:</strong> ' . $row['fecha_apersonamiento'] . '<br>';
    $html .= '<strong>Usuario:</strong> ' . $row['usuario'];
    $html .= "</div>";
    $html .= "</div>";

    return $html;
}

/**
 * Crear HTML del popup simplificado (modo masivo en zoom bajo)
 */
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
