<?php
// Archivo de diagnóstico para verificar la configuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Diagnóstico de Exportación PISLEA</h2>";

// 1. Verificar ruta actual
echo "<h3>1. Ruta actual:</h3>";
echo "<p>" . __DIR__ . "</p>";

// 2. Verificar vendor/autoload.php
echo "<h3>2. Verificar php/vendor/autoload.php:</h3>";
$autoload_path = dirname(__DIR__) . '/php/vendor/autoload.php';
if (file_exists($autoload_path)) {
    echo "<p style='color: green;'>✓ Archivo encontrado: $autoload_path</p>";
    require_once $autoload_path;
    echo "<p style='color: green;'>✓ Autoload cargado correctamente</p>";
} else {
    echo "<p style='color: red;'>✗ Archivo NO encontrado: $autoload_path</p>";
    echo "<p>Ejecuta: <code>cd /var/www/html && composer install</code></p>";
}

// 3. Verificar PHPSpreadsheet
echo "<h3>3. Verificar PHPSpreadsheet:</h3>";
if (class_exists('PhpOffice\PhpSpreadsheet\Spreadsheet')) {
    echo "<p style='color: green;'>✓ PHPSpreadsheet está disponible</p>";
} else {
    echo "<p style='color: red;'>✗ PHPSpreadsheet NO está disponible</p>";
}

// 4. Verificar conexión a base de datos
echo "<h3>4. Verificar conexión a base de datos:</h3>";
if (file_exists(__DIR__ . '/conexionpsql.php')) {
    echo "<p style='color: green;'>✓ Archivo conexionpsql.php encontrado</p>";
    require_once __DIR__ . '/conexionpsql.php';
    
    try {
        $conexion = new Conexion();
        $conn = $conexion->conectar();
        echo "<p style='color: green;'>✓ Conexión a base de datos exitosa</p>";
        
        // Probar una consulta simple
        $stmt = $conn->query("SELECT COUNT(*) as total FROM pislea_funcionario");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "<p style='color: green;'>✓ Consulta exitosa. Total funcionarios: " . $result['total'] . "</p>";
        
    } catch (Exception $e) {
        echo "<p style='color: red;'>✗ Error de conexión: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p style='color: red;'>✗ Archivo conexionpsql.php NO encontrado</p>";
}

// 5. Verificar permisos de escritura
echo "<h3>5. Verificar permisos de escritura:</h3>";
$temp_dir = sys_get_temp_dir();
if (is_writable($temp_dir)) {
    echo "<p style='color: green;'>✓ Directorio temporal escribible: $temp_dir</p>";
} else {
    echo "<p style='color: red;'>✗ Directorio temporal NO escribible: $temp_dir</p>";
}

echo "<hr>";
echo "<h3>Resumen:</h3>";
echo "<p>Si todos los checks están en verde, los reportes deberían funcionar.</p>";
echo "<p>Si hay errores en rojo, corrígelos antes de continuar.</p>";
?>
