<?php
session_start();
require_once './conexionpsql.php';
require_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

try {
    if (!isset($_SESSION['idusuario'])) {
        die('Usuario no autenticado');
    }

    $conn = new Conexion();
    $cons = $conn->conectar();

    // Consulta para el reporte F2
    $query = "SELECT 
                sistema_operativo,
                ofimatica,
                COUNT(*) as cantidad_equipos
              FROM pislea_equipo
              WHERE estado_ IS TRUE
              GROUP BY sistema_operativo, ofimatica
              ORDER BY sistema_operativo, ofimatica";

    $stmt = $cons->query($query);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Crear el archivo Excel
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Reporte F2');

    // Encabezados
    $headers = ['Correlativo', 'Sistema Operativo', 'Ofimática', 'Cantidad Equipos'];
    $col = 'A';
    foreach ($headers as $header) {
        $sheet->setCellValue($col . '1', $header);
        $sheet->getStyle($col . '1')->getFont()->setBold(true);
        $sheet->getStyle($col . '1')->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FF70AD47');
        $sheet->getStyle($col . '1')->getFont()->getColor()->setARGB('FFFFFFFF');
        $col++;
    }

    // Datos
    $row = 2;
    $correlativo = 1;

    foreach ($resultados as $dato) {
        $sheet->setCellValue('A' . $row, $correlativo);
        $sheet->setCellValue('B' . $row, $dato['sistema_operativo'] ?: 'No especificado');
        $sheet->setCellValue('C' . $row, $dato['ofimatica'] ?: 'No especificado');
        $sheet->setCellValue('D' . $row, $dato['cantidad_equipos']);
        
        $row++;
        $correlativo++;
    }

    // Ajustar ancho de columnas
    foreach (range('A', 'D') as $col) {
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
    $sheet->getStyle('A1:D' . ($row - 1))->applyFromArray($styleArray);

    // Descargar el archivo
    $filename = 'Reporte_F2_' . date('Y-m-d_His') . '.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;

} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
