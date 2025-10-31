<?php
// ufPuntosSearch.php - Endpoint para búsqueda de puntos en la base de datos PostgreSQL
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

// Función centralizada para enviar respuestas de error
function sendErrorResponse($message, $details = null, $code = 500) {
    http_response_code($code);
    $response = [
        'success' => false,
        'error' => $message,
        'details' => $details,
        'timestamp' => date('Y-m-d H:i:s')
    ];
    echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
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

try {
    // Validar parámetro de búsqueda
    if (!isset($_GET['search']) || trim($_GET['search']) === '') {
        sendErrorResponse('Parámetro de búsqueda requerido', 'El parámetro "search" es obligatorio', 400);
    }

    $searchTerm = trim($_GET['search']);
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 100;

    // Validar límite
    if ($limit < 1 || $limit > 1000) {
        $limit = 100;
    }

    require_once 'conexionpsql.php';
    $conexion = new conexion();
    $conn = $conexion->conectar();

    if (!$conn) {
        sendErrorResponse('Error de conexión a la base de datos', 'No se pudo establecer conexión con PostgreSQL');
    }

    // Normalizar término de búsqueda para código catastral (remover guiones y ceros iniciales)
    $searchTermNormalized = preg_replace('/^0+/', '', str_replace('-', '', $searchTerm));

    $sql = "SELECT
                id,
                numero_inmueble,
                codigo_catastral,
                nombre_razon,
                direccion,
                latitud,
                longitud,
                imagen_principal,
                imagen_adicional,
                tipologia,
                estado_fiscalizacion,
                fecha_apersonamiento,
                fecha_cambio_estado,
                usuario,
                usuario_cambio_estado,
                observacion_estado,
                no_formulario,
                cant_act,
                descripcion_act,
                is_visit_today,
                sort_priority
            FROM (
                SELECT DISTINCT
                    uf.id,
                    uf.numero_inmueble,
                    uf.codigo_catastral,
                    uf.nombre_razon,
                    TRIM(uf.ubicacion_nivel1 || ' ' || uf.ubicacion_nivel2 || ' ' || uf.ubicacion_nivel3 || ' ' || uf.descripcion) AS direccion,
                    uf.latitud,
                    uf.longitud,
                    uf.imagen_principal,
                    uf.imagen_adicional,
                    uf.tipologia,
                    b.estado_fiscalizacion,
                    to_char(uf.fecha_apersonamiento, 'DD/MM/YYYY HH24:MI:SS') AS fecha_apersonamiento,
                    to_char(uf.fecha_cambio_estado, 'DD/MM/YYYY HH24:MI:SS') AS fecha_cambio_estado,
                    a.usuario,
                    c.usuario AS usuario_cambio_estado,
                    uf.observacion_estado,
                    uf.no_formulario,
                    uf.cant_act,
                    uf.descripcion_act,
                    CASE 
                        WHEN DATE(uf.fecha_apersonamiento) = CURRENT_DATE THEN true 
                        ELSE false 
                    END AS is_visit_today,
                    CASE 
                        WHEN uf.numero_inmueble = :searchTerm THEN 1
                        WHEN CAST(uf.no_formulario AS TEXT) = :searchTerm THEN 2
                        ELSE 3
                    END AS sort_priority
                FROM uf_predial uf  
                LEFT JOIN datm_usuario a ON uf.idusuario = a.id 
                LEFT JOIN uf_estado_fiscalizacion b ON b.idestado_fiscalizacion = uf.idestado_fiscalizacion 
                LEFT JOIN datm_usuario c ON c.id = uf.idusuario_cambio_estado
                WHERE   
                    uf.latitud IS NOT NULL  
                    AND uf.longitud IS NOT NULL 
                    AND ( 
                        uf.numero_inmueble ILIKE :searchPartial 
                        OR CAST(uf.no_formulario AS TEXT) ILIKE :searchPartial  
                        OR LOWER(uf.nombre_razon) ILIKE :searchPartial 
                        OR uf.codigo_catastral ILIKE :searchPartial 
                        OR TRIM(LEADING '0' FROM REPLACE(uf.codigo_catastral, '-', '')) ILIKE :searchNormalized 
                        OR LOWER(a.usuario) ILIKE :searchPartial   
                        OR TO_CHAR(uf.fecha_apersonamiento, 'YYYY-MM-DD') ILIKE :searchPartial 
                    )
            ) t
            ORDER BY 
                sort_priority,
                fecha_apersonamiento DESC
            LIMIT :limit";

    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        sendErrorResponse('Error al preparar consulta', $conn->errorInfo());
    }

    $searchPartial = '%' . $searchTerm . '%';
    $searchNormalized = '%' . $searchTermNormalized . '%';

    $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    $stmt->bindParam(':searchPartial', $searchPartial, PDO::PARAM_STR);
    $stmt->bindParam(':searchNormalized', $searchNormalized, PDO::PARAM_STR);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);

    // Ejecutar consulta
    if (!$stmt->execute()) {
        sendErrorResponse('Error al ejecutar consulta', $stmt->errorInfo());
    }

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $formattedResults = array_map(function($row) {
        $isVisitToday = ($row['is_visit_today'] === 't' || $row['is_visit_today'] === true || $row['is_visit_today'] == 1);
        
        // Procesar imágenes
        $imagenes = processImages($row['imagen_principal'] ?? '', $row['imagen_adicional'] ?? '');
        
        // Agregar lat/lng al array para la función createPopupHtml
        $row['lat'] = $row['latitud'];
        $row['lng'] = $row['longitud'];
        
        // Generar HTML del popup usando la misma función que ufPuntosGet.php
        $popupHtml = createPopupHtml($row, $imagenes);

        return [
            'id' => $row['id'],
            'numero_inmueble' => $row['numero_inmueble'],
            'codigo_catastral' => $row['codigo_catastral'],
            'nombre_razon' => $row['nombre_razon'],
            'position' => [
                floatval($row['latitud']),
                floatval($row['longitud'])
            ],
            'estado_fiscalizacion' => $row['estado_fiscalizacion'],
            'fecha_apersonamiento' => $row['fecha_apersonamiento'],
            'usuario' => $row['usuario'],
            'no_formulario' => $row['no_formulario'],
            'tipologia' => $row['tipologia'],
            'imagen_principal' => $row['imagen_principal'],
            'is_visit_today' => $isVisitToday,
            'html' => $popupHtml,
            'title' => $row['numero_inmueble'] ?? 'N/A',
            'description' => $row['direccion'] ?? 'N/A'
        ];
    }, $results);

    // Respuesta exitosa
    http_response_code(200);
    echo json_encode([
        'success' => true,
        'data' => $formattedResults,
        'count' => count($formattedResults),
        'searchTerm' => $searchTerm,
        'timestamp' => date('Y-m-d H:i:s')
    ], JSON_UNESCAPED_UNICODE);

} catch (PDOException $e) {
    sendErrorResponse(
        'Error de base de datos PostgreSQL',
        [
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]
    );
} catch (Exception $e) {
    sendErrorResponse(
        'Error interno del servidor',
        [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]
    );
}
?>
