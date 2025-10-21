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

    // Consulta para el reporte F3
    $query = "SELECT 
                nombre_software,
                fabricante_proveedor,
                hardware_asociado,
                uso_especifico
              FROM pislea_software
              WHERE estado_ IS TRUE
              ORDER BY nombre_software";

    $stmt = $cons->query($query);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Crear el archivo Excel
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Reporte F3');

    // Encabezados
    $headers = ['Correlativo', 'Nombre Software', 'Fabricante/Proveedor', 'Hardware Asociado', 'Uso Específico'];
    $col = 'A';
    foreach ($headers as $header) {
        $sheet->setCellValue($col . '1', $header);
        $sheet->getStyle($col . '1')->getFont()->setBold(true);
        $sheet->getStyle($col . '1')->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFFC000');
        $sheet->getStyle($col . '1')->getFont()->getColor()->setARGB('FFFFFFFF');
        $col++;
    }

    // Datos
    $row = 2;
    $correlativo = 1;

    foreach ($resultados as $dato) {
        $sheet->setCellValue('A' . $row, $correlativo);
        $sheet->setCellValue('B' . $row, $dato['nombre_software'] ?: '-');
        $sheet->setCellValue('C' . $row, $dato['fabricante_proveedor'] ?: '-');
        $sheet->setCellValue('D' . $row, $dato['hardware_asociado'] ?: '-');
        $sheet->setCellValue('E' . $row, $dato['uso_especifico'] ?: '-');
        
        $row++;
        $correlativo++;
    }

    // Ajustar ancho de columnas
    foreach (range('A', 'E') as $col) {
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
    $sheet->getStyle('A1:E' . ($row - 1))->applyFromArray($styleArray);

    // Descargar el archivo
    $filename = 'Reporte_F3_' . date('Y-m-d_His') . '.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;

} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
