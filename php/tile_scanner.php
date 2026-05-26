<?php
/**
 * Utilidad para escanear y analizar la estructura de tiles
 * Útil para debugging y verificación de la estructura
 */

function scanTileStructure($basePath) {
    $structure = [
        'totalFiles' => 0,
        'tiles' => [],
        'errors' => []
    ];
    
    if (!is_dir($basePath)) {
        $structure['errors'][] = "Directorio no encontrado: $basePath";
        return $structure;
    }
    
    $files = scandir($basePath);
    
    foreach ($files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'geojson' && 
            strpos($file, 'el_alto_tile_') === 0) {
            
            $structure['totalFiles']++;
            
            // Extraer información del tile
            if (preg_match('/el_alto_tile_r(\d+)_c(\d+)(?:_part(\d+))?\.geojson/', $file, $matches)) {
                $row = intval($matches[1]);
                $col = intval($matches[2]);
                $part = isset($matches[3]) ? intval($matches[3]) : 1;
                
                $tileKey = "r{$row}_c{$col}";
                
                if (!isset($structure['tiles'][$tileKey])) {
                    $structure['tiles'][$tileKey] = [
                        'row' => $row,
                        'col' => $col,
                        'parts' => [],
                        'totalSize' => 0
                    ];
                }
                
                $filePath = $basePath . $file;
                $fileSize = file_exists($filePath) ? filesize($filePath) : 0;
                
                $structure['tiles'][$tileKey]['parts'][] = [
                    'filename' => $file,
                    'part' => $part,
                    'size' => $fileSize,
                    'sizeFormatted' => formatBytes($fileSize)
                ];
                
                $structure['tiles'][$tileKey]['totalSize'] += $fileSize;
            } else {
                $structure['errors'][] = "Nombre de archivo no reconocido: $file";
            }
        }
    }
    
    // Ordenar partes de cada tile
    foreach ($structure['tiles'] as &$tile) {
        usort($tile['parts'], function($a, $b) {
            return $a['part'] - $b['part'];
        });
        $tile['totalSizeFormatted'] = formatBytes($tile['totalSize']);
    }
    
    return $structure;
}

function formatBytes($size, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    
    for ($i = 0; $size > 1024 && $i < count($units) - 1; $i++) {
        $size /= 1024;
    }
    
    return round($size, $precision) . ' ' . $units[$i];
}

function generateTileReport($basePath) {
    $structure = scanTileStructure($basePath);
    
    echo "<h2>Reporte de Estructura de Tiles</h2>\n";
    echo "<p><strong>Total de archivos:</strong> {$structure['totalFiles']}</p>\n";
    echo "<p><strong>Total de tiles:</strong> " . count($structure['tiles']) . "</p>\n";
    
    if (!empty($structure['errors'])) {
        echo "<h3>Errores:</h3>\n";
        echo "<ul>\n";
        foreach ($structure['errors'] as $error) {
            echo "<li>$error</li>\n";
        }
        echo "</ul>\n";
    }
    
    echo "<h3>Tiles Encontrados:</h3>\n";
    echo "<table border='1' style='border-collapse: collapse;'>\n";
    echo "<tr><th>Tile</th><th>Partes</th><th>Archivos</th><th>Tamaño Total</th></tr>\n";
    
    ksort($structure['tiles']);
    
    foreach ($structure['tiles'] as $tileKey => $tile) {
        echo "<tr>\n";
        echo "<td>$tileKey</td>\n";
        echo "<td>" . count($tile['parts']) . "</td>\n";
        echo "<td>";
        foreach ($tile['parts'] as $part) {
            echo $part['filename'] . " (" . $part['sizeFormatted'] . ")<br>";
        }
        echo "</td>\n";
        echo "<td>{$tile['totalSizeFormatted']}</td>\n";
        echo "</tr>\n";
    }
    
    echo "</table>\n";
}

// Si se ejecuta directamente, generar reporte
if (basename(__FILE__) == basename($_SERVER['SCRIPT_NAME'])) {
    $basePath = '../static/geojson/tiles/';
    generateTileReport($basePath);
}
?>
