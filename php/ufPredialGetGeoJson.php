<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type'); 

error_reporting(E_ALL);
ini_set('display_errors', 1);

foreach ($_GET as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
$geojsonFile = '../static/geojson/grupo_numeros_con_guion.geojson';
if ($modulo == 'inmueble')
    $geojsonFile = '../static/geojson/inmuebles.geojson';

if (file_exists($geojsonFile)) {
    logDebug("Usando archivo GeoJSON: $geojsonFile");

    $data = loadFromGeojsonFile($geojsonFile, $minLat, $maxLat, $minLng, $maxLng, $limit, $zoom);
    $totalCount = count($data) * 10; 

}
$response = [
    'data' => $data,
    'meta' => [
        'total' => intval($totalCount),
        'returned' => count($data),
        'zoom' => $zoom,
        'source' => $geojsonFile,
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


function logDebug($message)
{
    error_log("[ufPuntosGet-Optimizado] " . $message);
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
        foreach ($geojson['features'] as $feature) {
            if (isset($feature['geometry']['coordinates'])) {
                $coords = $feature['geometry']['coordinates'];
                $lng = floatval($coords[0]);
                $lat = floatval($coords[1]);

                if (
                    $lat >= $minLat && $lat <= $maxLat &&
                    $lng >= $minLng && $lng <= $maxLng
                ) {

                    $filteredFeatures[] = $feature;

                    if (count($filteredFeatures) >= $limit) {
                        break;
                    }
                }
            }
        }
        return $filteredFeatures;
    } catch (Exception $e) {
        logDebug("Error procesando archivo GeoJSON: " . $e->getMessage());
        return [];
    }
}
