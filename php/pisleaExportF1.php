<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

session_start();

try {
    $autoload_path = __DIR__ . '/vendor/autoload.php';
    
    if (!file_exists($autoload_path)) {
        throw new Exception('Composer autoload not found at: ' . $autoload_path . '. Run: cd /var/www/html/php && composer install');
    }
    
    require_once __DIR__ . '/conexionpsql.php';
    require_once $autoload_path;


    if (!isset($_SESSION['idusuario'])) {
        throw new Exception('Usuario no autenticado');
    }

    $conexion = new Conexion();
    $conn = $conexion->conectar();

    // Consulta para el reporte F1
    $query = "SELECT 
                f.idfuncionario,
                u.unidad, 
                UPPER(CONCAT(f.nombres, ' ', f.apellido_paterno, ' ', COALESCE(f.apellido_materno, ''))) as nombre_completo,
                f.idnivel_know,
                n.nivel,
                a.area
              FROM pislea_funcionario f
              LEFT JOIN pislea_area a ON f.idarea = a.idarea
              LEFT JOIN pislea_unidad u ON a.idunidad = u.idunidad
              LEFT JOIN pislea_nivelknow n ON f.idnivel_know = n.idnivel_know
              WHERE f.estado_ IS TRUE
              ORDER BY u.unidad, f.nombres";

    $stmt = $conn->query($query);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Crear el archivo Excel
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Reporte F1');

    // Encabezados
    $headers = ['Correlativo', 'Unidad', 'Nombre Completo', 'Ninguno', 'Básico', 'Medio', 'Alto', 'Cantidad Personal'];
    $col = 'A';
    foreach ($headers as $header) {
        $sheet->setCellValue($col . '1', $header);
        $sheet->getStyle($col . '1')->getFont()->setBold(true);
        $sheet->getStyle($col . '1')->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FF4472C4');
        $sheet->getStyle($col . '1')->getFont()->getColor()->setARGB('FFFFFFFF');
        $col++;
    }

    // Datos
    $row = 2;
    $correlativo = 1;
    $cantidadPorUnidad = [];

    // Contar funcionarios por unidad
    foreach ($resultados as $dato) {
        $unidad = $dato['unidad'] ;
        if (!isset($cantidadPorUnidad[$unidad])) {
            $cantidadPorUnidad[$unidad] = 0;
        }
        $cantidadPorUnidad[$unidad]++;
    }

    foreach ($resultados as $dato) {
        $unidad = $dato['unidad'] ;
        
        $sheet->setCellValue('A' . $row, $correlativo);
        $sheet->setCellValue('B' . $row, $unidad);
        $sheet->setCellValue('C' . $row, $dato['nombre_completo']);
        
        // Marcar con X según el nivel
        $sheet->setCellValue('D' . $row, $dato['idnivel_know'] == 1 ? 'X' : '');
        $sheet->setCellValue('E' . $row, $dato['idnivel_know'] == 2 ? 'X' : '');
        $sheet->setCellValue('F' . $row, $dato['idnivel_know'] == 3 ? 'X' : '');
        $sheet->setCellValue('G' . $row, $dato['idnivel_know'] == 4 ? 'X' : '');
        
        // Cantidad de personal por unidad
        $sheet->setCellValue('H' . $row, $cantidadPorUnidad[$unidad]);
        
        $row++;
        $correlativo++;
    }

    // Ajustar ancho de columnas
    foreach (range('A', 'H') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // Aplicar bordes
    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
            ],
        ],
    ];
    $sheet->getStyle('A1:H' . ($row - 1))->applyFromArray($styleArray);

    // Descargar el archivo
    $filename = 'Reporte_F1_' . date('Y-m-d_His') . '.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;

} catch (Exception $e) {
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString()
    ]);
    exit;
}
?>
