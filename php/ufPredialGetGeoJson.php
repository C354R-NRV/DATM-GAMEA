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

if (isset($zoom) && intval($zoom) >= 19) {
    $limit = PHP_INT_MAX;
    logDebug("Zoom 19+ detectado - Límite establecido a PHP_INT_MAX para mostrar todos los puntos");
} else {
    $limit = isset($limit) ? intval($limit) : 2000;
}

// Configuración de archivos tileados actualizada
$tileConfig = [
    'inmueble' => [
        'basePath' => '../static/geojson/tiles/',
        'filePattern' => 'el_alto_tile_r{row}_c{col}*.geojson',
        'supportsParts' => true,
        'maxRows' => 4,
        'maxCols' => 4
    ],
    'catastro' => [
        'basePath' => '../static/geojson/',
        'singleFile' => 'grupo_numeros_con_guion.geojson'
    ]
];

$data = [];
$totalCount = 0;
$loadedTiles = [];

if ($modulo == 'inmueble') {
    // Cargar datos de inmuebles usando sistema de tiles
    $result = loadFromTiledFiles($tileConfig['inmueble'], $minLat, $maxLat, $minLng, $maxLng, $limit, $zoom);
    $data = $result['data'];
    $totalCount = $result['totalCount'];
    $loadedTiles = $result['loadedTiles'];
} else {
    // Cargar datos de catastro desde archivo único
    $geojsonFile = $tileConfig['catastro']['basePath'] . $tileConfig['catastro']['singleFile'];
    if (file_exists($geojsonFile)) {
        logDebug("Usando archivo GeoJSON único: $geojsonFile");
        $data = loadFromGeojsonFile($geojsonFile, $minLat, $maxLat, $minLng, $maxLng, $limit, $zoom);
        $totalCount = count($data) * 10; // Estimación
    }
}

// MEJORA: Agregar información de fecha actual para comparación
$response = [
    'data' => $data,
    'meta' => [
        'total' => intval($totalCount),
        'returned' => count($data),
        'zoom' => $zoom,
        'limit_applied' => $limit == PHP_INT_MAX ? 'unlimited' : $limit, // Agregar info de límite aplicado
        'modulo' => $modulo,
        'loadedTiles' => $loadedTiles,
        'tile_bounds' => [
            'minLat' => $minLat,
            'maxLat' => $maxLat,
            'minLng' => $minLng,
            'maxLng' => $maxLng
        ],
        'tile_size' => ($maxLat - $minLat) * ($maxLng - $minLng),
        'timestamp' => date('Y-m-d H:i:s'),
        'current_date' => date('Y-m-d') // Para comparar fechas de visita
    ]
];

logDebug("Enviando respuesta exitosa con " . count($data) . " features");
echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);

function logDebug($message)
{
    error_log("[ufPredialGetGeoJson-Optimizado] " . $message);
}

function loadFromTiledFiles($config, $minLat, $maxLat, $minLng, $maxLng, $limit, $zoom)
{
    logDebug("Cargando desde archivos tileados con estructura real - Límite: " . ($limit == PHP_INT_MAX ? 'ILIMITADO' : $limit));
    
    $allFeatures = [];
    $totalCount = 0;
    $loadedTiles = [];
    
    // Determinar qué tiles necesitamos cargar
    $tilesToLoad = determineTilesToLoad($config, $minLat, $maxLat, $minLng, $maxLng);
    
    logDebug("Tiles a cargar: " . count($tilesToLoad));
    
    foreach ($tilesToLoad as $tileInfo) {
        $tileFeatures = [];
        $tileFilesLoaded = [];
        $tileTotalFeatures = 0;
        
        // Cargar todas las partes del tile
        foreach ($tileInfo['files'] as $fileInfo) {
            $filePath = $fileInfo['fullPath'];
            
            if (file_exists($filePath)) {
                logDebug("Cargando archivo: " . $fileInfo['filename']);
                
                try {
                    $jsonContent = file_get_contents($filePath);
                    if ($jsonContent === false) {
                        logDebug("Error leyendo archivo: " . $fileInfo['filename']);
                        continue;
                    }
                    
                    $geojson = json_decode($jsonContent, true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        logDebug("Error decodificando JSON en " . $fileInfo['filename'] . ": " . json_last_error_msg());
                        continue;
                    }
                    
                    if (!isset($geojson['features']) || !is_array($geojson['features'])) {
                        logDebug("Formato GeoJSON inválido en " . $fileInfo['filename']);
                        continue;
                    }
                    
                    // Filtrar features que están dentro del área solicitada
                    $filteredFeatures = [];
                    foreach ($geojson['features'] as $feature) {
                        if (isset($feature['geometry']['coordinates'])) {
                            $coords = $feature['geometry']['coordinates'];
                            $lng = floatval($coords[0]);
                            $lat = floatval($coords[1]);
                            
                            if ($lat >= $minLat && $lat <= $maxLat && 
                                $lng >= $minLng && $lng <= $maxLng) {
                                
                                // MEJORA: Agregar información de fecha de visita si existe
                                if (isset($feature['properties']['ultima_visita'])) {
                                    $feature['properties']['is_visit_today'] = 
                                        (date('Y-m-d') === date('Y-m-d', strtotime($feature['properties']['ultima_visita'])));
                                }
                                
                                $filteredFeatures[] = $feature;
                                
                                if ($limit != PHP_INT_MAX && 
                                    count($allFeatures) + count($tileFeatures) + count($filteredFeatures) >= $limit) {
                                    logDebug("Límite alcanzado: " . $limit);
                                    break 3; // Salir de todos los loops
                                }
                            }
                        }
                    }
                    
                    $tileFeatures = array_merge($tileFeatures, $filteredFeatures);
                    $tileTotalFeatures += count($geojson['features']);
                    
                    $tileFilesLoaded[] = [
                        'filename' => $fileInfo['filename'],
                        'part' => $fileInfo['part'],
                        'featuresLoaded' => count($filteredFeatures),
                        'totalFeatures' => count($geojson['features'])
                    ];
                    
                    logDebug("Archivo cargado: " . $fileInfo['filename'] . " - Features filtrados: " . count($filteredFeatures));
                    
                } catch (Exception $e) {
                    logDebug("Error procesando archivo " . $fileInfo['filename'] . ": " . $e->getMessage());
                    continue;
                }
            } else {
                logDebug("Archivo no encontrado: " . $fileInfo['filename']);
            }
        }
        
        // Agregar features del tile completo
        $allFeatures = array_merge($allFeatures, $tileFeatures);
        $totalCount += $tileTotalFeatures;
        
        $loadedTiles[] = [
            'tileKey' => $tileInfo['tileKey'],
            'row' => $tileInfo['row'],
            'col' => $tileInfo['col'],
            'files' => $tileFilesLoaded,
            'totalFeaturesLoaded' => count($tileFeatures),
            'totalFeaturesInTile' => $tileTotalFeatures
        ];
        
        logDebug("Tile {$tileInfo['tileKey']} completado - Features: " . count($tileFeatures));
    }
    
    logDebug("Carga completa - Total features cargados: " . count($allFeatures)); // Agregar log final
    
    return [
        'data' => $allFeatures,
        'totalCount' => $totalCount,
        'loadedTiles' => $loadedTiles
    ];
}

function determineTilesToLoad($config, $minLat, $maxLat, $minLng, $maxLng)
{
    $tilesToLoad = [];
    
    // Primero, escanear todos los archivos disponibles en el directorio
    $availableFiles = [];
    if (is_dir($config['basePath'])) {
        $files = scandir($config['basePath']);
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'geojson' && 
                strpos($file, 'el_alto_tile_') === 0) {
                $availableFiles[] = $file;
            }
        }
    }
    
    logDebug("Archivos disponibles encontrados: " . count($availableFiles));
    
    // Agrupar archivos por tile base (sin part)
    $tileGroups = [];
    foreach ($availableFiles as $file) {
        // Extraer información del tile del nombre del archivo
        if (preg_match('/el_alto_tile_r(\d+)_c(\d+)(?:_part(\d+))?\.geojson/', $file, $matches)) {
            $row = intval($matches[1]);
            $col = intval($matches[2]);
            $part = isset($matches[3]) ? intval($matches[3]) : 1;
            
            $tileKey = "r{$row}_c{$col}";
            
            if (!isset($tileGroups[$tileKey])) {
                $tileGroups[$tileKey] = [
                    'row' => $row,
                    'col' => $col,
                    'files' => []
                ];
            }
            
            $tileGroups[$tileKey]['files'][] = [
                'filename' => $file,
                'part' => $part,
                'fullPath' => $config['basePath'] . $file
            ];
        }
    }
    
    // Ordenar las partes de cada tile
    foreach ($tileGroups as $tileKey => &$tileGroup) {
        usort($tileGroup['files'], function($a, $b) {
            return $a['part'] - $b['part'];
        });
    }
    
    logDebug("Grupos de tiles encontrados: " . json_encode(array_keys($tileGroups)));
    
    // Verificar qué tiles intersectan con el área solicitada
    foreach ($tileGroups as $tileKey => $tileGroup) {
        // Verificar intersección usando el primer archivo del grupo
        $firstFile = $tileGroup['files'][0]['fullPath'];
        
        if (tileIntersectsWithBounds($firstFile, $minLat, $maxLat, $minLng, $maxLng)) {
            $tilesToLoad[] = [
                'tileKey' => $tileKey,
                'row' => $tileGroup['row'],
                'col' => $tileGroup['col'],
                'files' => $tileGroup['files']
            ];
            
            logDebug("Tile {$tileKey} intersecta - archivos: " . count($tileGroup['files']));
        }
    }
    
    return $tilesToLoad;
}

function tileIntersectsWithBounds($filePath, $minLat, $maxLat, $minLng, $maxLng)
{
    try {
        // Leer solo una pequeña parte del archivo para obtener los metadatos
        $handle = fopen($filePath, 'r');
        if (!$handle) {
            return false;
        }
        
        $content = '';
        $bracketCount = 0;
        $inString = false;
        $escapeNext = false;
        
        // Leer hasta encontrar tile_cell_bbox_EPSG4326
        while (($char = fgetc($handle)) !== false) {
            $content .= $char;
            
            if (!$escapeNext) {
                if ($char === '"') {
                    $inString = !$inString;
                } elseif (!$inString) {
                    if ($char === '{') {
                        $bracketCount++;
                    } elseif ($char === '}') {
                        $bracketCount--;
                    }
                }
            }
            
            $escapeNext = ($char === '\\' && !$escapeNext);
            
            // Si encontramos tile_cell_bbox_EPSG4326, leemos un poco más y salimos
            if (strpos($content, 'tile_cell_bbox_EPSG4326') !== false) {
                // Leer hasta el final del array bbox
                $bboxStart = strpos($content, 'tile_cell_bbox_EPSG4326');
                $remaining = substr($content, $bboxStart);
                
                // Leer más contenido para asegurar que tenemos el bbox completo
                for ($i = 0; $i < 200 && ($char = fgetc($handle)) !== false; $i++) {
                    $content .= $char;
                }
                break;
            }
            
            // Limitar la lectura para evitar cargar archivos muy grandes
            if (strlen($content) > 10000) {
                break;
            }
        }
        
        fclose($handle);
        
        // Extraer el bbox usando regex
        if (preg_match('/"tile_cell_bbox_EPSG4326"\s*:\s*\[\s*([-\d.]+)\s*,\s*([-\d.]+)\s*,\s*([-\d.]+)\s*,\s*([-\d.]+)\s*\]/', $content, $matches)) {
            $tileBbox = [
                'minLng' => floatval($matches[1]),
                'minLat' => floatval($matches[2]),
                'maxLng' => floatval($matches[3]),
                'maxLat' => floatval($matches[4])
            ];
            
            // Verificar intersección
            $intersects = !($maxLng < $tileBbox['minLng'] || 
                           $minLng > $tileBbox['maxLng'] || 
                           $maxLat < $tileBbox['minLat'] || 
                           $minLat > $tileBbox['maxLat']);
            
            logDebug("Tile " . basename($filePath) . " bbox: " . json_encode($tileBbox) . " - Intersects: " . ($intersects ? 'YES' : 'NO'));
            
            return $intersects;
        }
        
        logDebug("No se pudo extraer bbox de " . basename($filePath));
        return true; // Si no podemos determinar, incluimos el tile por seguridad
        
    } catch (Exception $e) {
        logDebug("Error verificando intersección para $filePath: " . $e->getMessage());
        return true; // En caso de error, incluimos el tile
    }
}

function loadFromGeojsonFile($geojsonFile, $minLat, $maxLat, $minLng, $maxLng, $limit, $zoom)
{
    logDebug("Cargando desde archivo GeoJSON único: $geojsonFile - Límite: " . ($limit == PHP_INT_MAX ? 'ILIMITADO' : $limit));

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

                if ($lat >= $minLat && $lat <= $maxLat &&
                    $lng >= $minLng && $lng <= $maxLng) {
                    
                    // MEJORA: Agregar información de fecha de visita si existe
                    if (isset($feature['properties']['ultima_visita'])) {
                        $feature['properties']['is_visit_today'] = 
                            (date('Y-m-d') === date('Y-m-d', strtotime($feature['properties']['ultima_visita'])));
                    }
                    
                    $filteredFeatures[] = $feature;

                    if ($limit != PHP_INT_MAX && count($filteredFeatures) >= $limit) {
                        logDebug("Límite alcanzado: " . $limit);
                        break;
                    }
                }
            }
        }
        
        logDebug("Features filtrados dentro del área: " . count($filteredFeatures)); // Agregar log
        
        return $filteredFeatures;
    } catch (Exception $e) {
        logDebug("Error procesando archivo GeoJSON: " . $e->getMessage());
        return [];
    }
}
?>
