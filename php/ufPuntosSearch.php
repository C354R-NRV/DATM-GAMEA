<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');


error_reporting(E_ALL);
ini_set('display_errors', 1);

function logDebug($message) {
    error_log("[ufPuntosSearch] " . $message);
}

try {
    logDebug("Iniciando búsqueda");

    if (!isset($_GET['term']) || trim($_GET['term']) === '') {
        throw new Exception("Término de búsqueda requerido");
    }

    $searchTerm = trim($_GET['term']);
    
    if (strlen($searchTerm) < 3) {
        throw new Exception("El término debe tener al menos 3 caracteres");
    }

    logDebug("Buscando: $searchTerm");

    // Configuración de base de datos
    $host = 'localhost';
    $dbname = 'datm';
    $port = '5432';
    $username = 'postgres';
    $password = '1n0v4d05';

    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_TIMEOUT => 30
    ]);
    $pdo->exec("SET NAMES 'UTF8'");

    // Query de búsqueda en múltiples campos
    $sql = "
        SELECT 
            a.id,
            a.codigo_catastral,
            a.nombre_razon,
            a.numero_inmueble,
            trim(a.ubicacion_nivel1||' '||a.ubicacion_nivel2||' '||a.ubicacion_nivel3||' '||a.descripcion) as direccion,
            ST_Y(a.geom) as lat,
            ST_X(a.geom) as lng,
            a.imagen_principal,
            a.imagen_adicional,
            to_char(a.fecha_apersonamiento, 'DD/MM/YYYY HH24:MI:SS') as fecha_apersonamiento,
            a.fecha_apersonamiento as fecha_apersonamiento_raw,
            d.estado_fiscalizacion,
            a.tipologia,
            to_char(a.fecha_cambio_estado, 'DD/MM/YYYY HH24:MI:SS') as fecha_cambio_estado,
            c1.usuario as usuario_cambio_estado,
            a.observacion_estado,
            c.usuario,
            a.no_formulario,
            a.cant_act,
            a.descripcion_act
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
        WHERE a.estado_ 
        AND a.geom IS NOT NULL
        AND (
            LOWER(a.numero_inmueble) LIKE LOWER(:term1) OR
            LOWER(a.codigo_catastral) LIKE LOWER(:term2) OR
            LOWER(a.nombre_razon) LIKE LOWER(:term3) OR
            LOWER(a.ubicacion_nivel1||' '||a.ubicacion_nivel2||' '||a.ubicacion_nivel3||' '||a.descripcion) LIKE LOWER(:term4) OR
            LOWER(c.usuario) LIKE LOWER(:term5) OR
            LOWER(a.no_formulario) LIKE LOWER(:term6)
        )
        ORDER BY 
            CASE 
                WHEN LOWER(a.numero_inmueble) = LOWER(:exactTerm) THEN 1
                WHEN LOWER(a.no_formulario) = LOWER(:exactTerm2) THEN 2
                ELSE 3
            END,
            a.fecha_apersonamiento DESC
        LIMIT 500
    ";

    $stmt = $pdo->prepare($sql);
    $searchPattern = "%{$searchTerm}%";
    
    $stmt->bindValue(':term1', $searchPattern, PDO::PARAM_STR);
    $stmt->bindValue(':term2', $searchPattern, PDO::PARAM_STR);
    $stmt->bindValue(':term3', $searchPattern, PDO::PARAM_STR);
    $stmt->bindValue(':term4', $searchPattern, PDO::PARAM_STR);
    $stmt->bindValue(':term5', $searchPattern, PDO::PARAM_STR);
    $stmt->bindValue(':term6', $searchPattern, PDO::PARAM_STR);
    $stmt->bindValue(':exactTerm', $searchTerm, PDO::PARAM_STR);
    $stmt->bindValue(':exactTerm2', $searchTerm, PDO::PARAM_STR);

    $stmt->execute();
    $results = $stmt->fetchAll();

    logDebug("Resultados encontrados: " . count($results));

    // Procesar resultados
    $data = [];
    $currentDate = date('Y-m-d');

    foreach ($results as $row) {
        $imagenes = processImages($row['imagen_principal'], $row['imagen_adicional']);
        $popupHtml = createPopupHtml($row, $imagenes);

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
            'imagen_principal' => $row['imagen_principal'],
            'estado_fiscalizacion' => $row['estado_fiscalizacion'],
            'tipologia' => $row['tipologia'],
            'html' => $popupHtml
        ];
    }

    $response = [
        'data' => $data,
        'meta' => [
            'total' => count($data),
            'returned' => count($data),
            'search_term' => $searchTerm,
            'source' => 'database_search',
            'timestamp' => date('Y-m-d H:i:s')
        ]
    ];

    echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);

} catch (PDOException $e) {
    logDebug("Error de BD: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'error' => 'Error de base de datos',
        'message' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    logDebug("Error: " . $e->getMessage());
    http_response_code(400);
    echo json_encode([
        'error' => 'Error en la búsqueda',
        'message' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}

function processImages($imagen_principal, $imagen_adicional) {
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

function createPopupHtml($row, $imagenes) {
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
                </div>';
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
                    <div class="info-value">' . $codigo . '</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tipología:</div>
                    <div class="info-value">' . $row['tipologia'] . ' [N°Form:'.$row['no_formulario'].']</div>
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
                ' . $act . '
            </div>';

    return $html;
}
?>
