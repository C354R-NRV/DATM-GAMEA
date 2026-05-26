<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

echo "<h2>Debug Reporte F1</h2>";

// Paso 1: Verificar sesión
echo "<h3>1. Verificar Sesión</h3>";
session_start();
if (!isset($_SESSION['idusuario'])) {
    echo "⚠️ ADVERTENCIA: No hay sesión activa. Creando sesión temporal para pruebas...<br>";
    $_SESSION['idusuario'] = 1; // Temporal para debug
} else {
    echo "✓ Sesión activa: Usuario ID = " . $_SESSION['idusuario'] . "<br>";
}

// Paso 2: Verificar autoload
echo "<h3>2. Verificar Autoload</h3>";
$autoload_path = __DIR__ . '/vendor/autoload.php';
echo "Buscando autoload en: $autoload_path<br>";
if (file_exists($autoload_path)) {
    echo "✓ Autoload encontrado<br>";
    require_once $autoload_path;
    echo "✓ Autoload cargado<br>";
} else {
    echo "✗ Autoload NO encontrado<br>";
    exit;
}

// Paso 3: Verificar PHPSpreadsheet
echo "<h3>3. Verificar PHPSpreadsheet</h3>";
if (class_exists('PhpOffice\PhpSpreadsheet\Spreadsheet')) {
    echo "✓ PHPSpreadsheet disponible<br>";
} else {
    echo "✗ PHPSpreadsheet NO disponible<br>";
    exit;
}

// Paso 4: Verificar conexión
echo "<h3>4. Verificar Conexión a Base de Datos</h3>";
require_once __DIR__ . '/conexionpsql.php';
try {
    $conexion = new Conexion();
    echo "✓ Objeto Conexion creado<br>";
    
    $conn = $conexion->getConexion();
    echo "✓ Conexión obtenida<br>";
    
    // Probar consulta simple
    $test_query = "SELECT COUNT(*) as total FROM pislea_funcionario WHERE estado_ IS TRUE";
    $stmt = $conn->query($test_query);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "✓ Consulta ejecutada: " . $result['total'] . " funcionarios encontrados<br>";
    
} catch (Exception $e) {
    echo "✗ Error en conexión: " . $e->getMessage() . "<br>";
    echo "Archivo: " . $e->getFile() . "<br>";
    echo "Línea: " . $e->getLine() . "<br>";
    exit;
}

// Paso 5: Probar consulta completa
echo "<h3>5. Probar Consulta Completa</h3>";
try {
    $query = "SELECT 
                f.idfuncionario,
                u.unidad,
                u.sigla,
                CONCAT(f.nombres, ' ', f.apellido_paterno, ' ', COALESCE(f.apellido_materno, '')) as nombre_completo,
                f.idnivel_know,
                n.nivel,
                a.area
              FROM pislea_funcionario f
              LEFT JOIN pislea_area a ON f.idarea = a.idarea
              LEFT JOIN pislea_unidad u ON a.idunidad = u.idunidad
              LEFT JOIN pislea_nivelknow n ON f.idnivel_know = n.idnivel_know
              WHERE f.estado_ IS TRUE
              ORDER BY u.unidad, f.nombres
              LIMIT 5";
    
    $stmt = $conn->query($query);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "✓ Consulta ejecutada: " . count($resultados) . " registros obtenidos<br>";
    echo "<pre>";
    print_r($resultados);
    echo "</pre>";
    
} catch (Exception $e) {
    echo "✗ Error en consulta: " . $e->getMessage() . "<br>";
    echo "Archivo: " . $e->getFile() . "<br>";
    echo "Línea: " . $e->getLine() . "<br>";
    exit;
}

// Paso 6: Probar creación de Excel
echo "<h3>6. Probar Creación de Excel</h3>";
try {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Test');
    $sheet->setCellValue('A1', 'Prueba');
    
    echo "✓ Spreadsheet creado correctamente<br>";
    echo "✓ Todas las pruebas pasaron exitosamente<br>";
    echo "<br><strong>El sistema está listo para generar reportes Excel</strong><br>";
    
} catch (Exception $e) {
    echo "✗ Error al crear Excel: " . $e->getMessage() . "<br>";
    echo "Archivo: " . $e->getFile() . "<br>";
    echo "Línea: " . $e->getLine() . "<br>";
}
?>
