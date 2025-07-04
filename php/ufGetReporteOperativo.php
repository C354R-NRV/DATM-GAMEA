<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Manejar preflight requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

try {
    // Incluir PhpSpreadsheet
    require_once 'vendor/autoload.php';
    
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Style\Alignment;
    use PhpOffice\PhpSpreadsheet\Style\Border;
    use PhpOffice\PhpSpreadsheet\Style\Fill;
    use PhpOffice\PhpSpreadsheet\Style\Font;    
    
    // Configuración de base de datos
    $host = 'localhost';
    $dbname = 'tu_base_de_datos';
    $username = 'tu_usuario';
    $password = 'tu_password';
    
    // Conectar a la base de datos
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Obtener parámetros
    $fechaInicial = $_POST['fechaInicial'] ?? '';
    $fechaFinal = $_POST['fechaFinal'] ?? '';
    $grupo = $_POST['grupo'] ?? 'Todos';
    
    // Validar parámetros
    if (empty($fechaInicial) || empty($fechaFinal)) {
        throw new Exception('Las fechas son requeridas');
    }
    
    // Construir consulta SQL
    $sql = "
        select 
        a.id,
        x.detalle ,x.idprepredial,
        b.grupo,
        c.usuario,
            a.nombre_razon, 
            a.nombre_apoderado, 
            trim(a.ubicacion_nivel1||' '||a.ubicacion_nivel2 ||' '||a.ubicacion_nivel3 ||' '||a.descripcion) as direccion, 
            a.codigo_catastral, 
            a.no_formulario, 
            a.via as dato_tecnico_via, 
            CASE 
            WHEN ( 
            SELECT string_agg(s.servicio, ', ')  
            FROM uf_predrial_servicio ps 
            JOIN uf_servicios s ON ps.idservicio = s.idservicio 
            WHERE ps.idpredial = a.id
            ) IN (
            'LUZ, AGUA, ALCANTARILLADO, GAS, TELEFONO',
            'TODOS, LUZ, AGUA, ALCANTARILLADO, GAS, TELEFONO'
            )
            THEN 'TODOS'
            ELSE (
            SELECT string_agg(s.servicio, ', ') 
            FROM uf_predrial_servicio ps
            JOIN uf_servicios s ON ps.idservicio = s.idservicio
            WHERE ps.idpredial = a.id
            )
        END AS dato_tecnico_servicio,
            a.tipologia as dato_tecnico_tipologia,
            a.no_plantas as construccion_plantas,
            a.no_concluidos as construccion_concluidas,
            a.no_brutos as construccion_construccion,
            'https://datm.elalto.gob.bo/pages/ufPredialList.php?i='||a.numero_inmueble as enlace,
            a.numero_inmueble,
            a.descripcion,
            a.cant_act,
            a.descripcion_act,
            a.hhrr,
            a.fecha_apersonamiento 
        from uf_predial a 
        left join uf_grupo_operativo b on a.idusuario = b.idusuario
        left join uf_operativo d on d.idoperativo = b.idoperativo
        left join datm_usuario c on c.id = b.idusuario
        LEFT JOIN uf_prepredial x ON x.idpredial_asociado = a.id 
        where  a.estado_  
        and d.operativo = '13' 
        and a.clasificacion = 'A'
        AND d.fecha_operativo::DATE = a.fecha_apersonamiento::DATE  
        -- and b.grupo = 'G-8' 
        order by grupo, a.no_formulario; 
    ";
    
    // Agregar filtro de grupo si no es "Todos"
    if ($grupo !== 'Todos') {
        $sql .= " AND x.detalle = :grupo";
    }
    
    $sql .= " ORDER BY x.idprepredial";
    
    // Preparar y ejecutar consulta
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':fecha_inicial', $fechaInicial);
    $stmt->bindParam(':fecha_final', $fechaFinal);
    
    if ($grupo !== 'Todos') {
        $stmt->bindParam(':grupo', $grupo);
    }
    
    $stmt->execute();
    $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Crear nuevo spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    // Configurar título principal
    $sheet->setCellValue('A1', 'OPERATIVO DE CONTROL - INMUEBLES');
    $sheet->setCellValue('A2', date('d \D\E F \D\E Y', strtotime($fechaFinal)));
    
    // Merge cells para el título
    $sheet->mergeCells('A1:T1');
    $sheet->mergeCells('A2:T2');
    
    // Estilo del título
    $sheet->getStyle('A1:A2')->applyFromArray([
        'font' => [
            'bold' => true,
            'size' => 14,
            'color' => ['rgb' => 'FFFFFF']
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['rgb' => 'D32F2F']
        ]
    ]);
    
    // Definir encabezados
    $encabezados = [
        'Nº', 'NOMBRE O RAZÓN SOCIAL', 'REPRESENTANTE LEGAL/APODERADO', 'DIRECCIÓN', 
        'CÓDIGO CATASTRAL', 'Nº FORMULARIO', 'VIA', 'SERVICIOS', 'TIPOLOGÍA', 
        'Nº DE PLANTAS', 'CONCLUIDAS', 'EN CONSTRUCCIÓN', 'ENLACE', 
        'Nº INMUEBLE', 'DESCRIPCIÓN', 'DATM', 'FECHA DE APERSONAMIENTO'
    ];
    
    // Agregar encabezados principales
    $sheet->setCellValue('A4', 'Nº');
    $sheet->setCellValue('B4', 'NOMBRE O RAZÓN SOCIAL');
    $sheet->setCellValue('C4', 'REPRESENTANTE LEGAL/APODERADO');
    $sheet->setCellValue('D4', 'DIRECCIÓN');
    $sheet->setCellValue('E4', 'CÓDIGO CATASTRAL');
    $sheet->setCellValue('F4', 'Nº FORMULARIO');
    
    // Merge para "DATOS TÉCNICOS"
    $sheet->setCellValue('G3', 'DATOS TÉCNICOS');
    $sheet->mergeCells('G3:I3');
    $sheet->setCellValue('G4', 'VIA');
    $sheet->setCellValue('H4', 'SERVICIOS');
    $sheet->setCellValue('I4', 'TIPOLOGÍA');
    
    // Merge para "CONSTRUCCIONES"
    $sheet->setCellValue('J3', 'CONSTRUCCIONES');
    $sheet->mergeCells('J3:L3');
    $sheet->setCellValue('J4', 'Nº DE PLANTAS');
    $sheet->setCellValue('K4', 'CONCLUIDAS');
    $sheet->setCellValue('L4', 'EN CONSTRUCCIÓN');
    
    $sheet->setCellValue('M4', 'ENLACE');
    $sheet->setCellValue('N4', 'Nº INMUEBLE');
    $sheet->setCellValue('O4', 'DESCRIPCIÓN');
    $sheet->setCellValue('P4', 'DATM');
    $sheet->setCellValue('Q4', 'FECHA DE APERSONAMIENTO');
    
    // Estilo de encabezados
    $sheet->getStyle('A3:Q4')->applyFromArray([
        'font' => [
            'bold' => true,
            'color' => ['rgb' => 'FFFFFF']
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
            'wrapText' => true
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['rgb' => 'D32F2F']
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['rgb' => 'FFFFFF']
            ]
        ]
    ]);
    
    // Agregar datos
    $fila = 5;
    $contador = 1;
    
    foreach ($datos as $registro) {
        $sheet->setCellValue('A' . $fila, $contador);
        $sheet->setCellValue('B' . $fila, $registro['nombre_razon']);
        $sheet->setCellValue('C' . $fila, $registro['nombre_apoderado']);
        $sheet->setCellValue('D' . $fila, $registro['direccion']);
        $sheet->setCellValue('E' . $fila, $registro['codigo_catastral']);
        $sheet->setCellValue('F' . $fila, $registro['no_formulario']);
        $sheet->setCellValue('G' . $fila, $registro['dato_tecnico_via']);
        $sheet->setCellValue('H' . $fila, $registro['dato_tecnico_servicio']);
        $sheet->setCellValue('I' . $fila, $registro['dato_tecnico_tipologia']);
        $sheet->setCellValue('J' . $fila, $registro['construccion_plantas']);
        $sheet->setCellValue('K' . $fila, $registro['construccion_concluidas']);
        $sheet->setCellValue('L' . $fila, $registro['construccion_construccion']);
        $sheet->setCellValue('M' . $fila, $registro['enlace']);
        $sheet->setCellValue('N' . $fila, $registro['numero_inmueble']);
        $sheet->setCellValue('O' . $fila, $registro['descripcion']);
        $sheet->setCellValue('P' . $fila, $registro['hhrr']);
        $sheet->setCellValue('Q' . $fila, $registro['fecha_apersonamiento']);
        
        $fila++;
        $contador++;
    }
    
    // Estilo de datos
    if ($fila > 5) {
        $sheet->getStyle('A5:Q' . ($fila - 1))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000']
                ]
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true
            ]
        ]);
    }
    
    // Ajustar ancho de columnas
    $anchos = [
        'A' => 5,   // Nº
        'B' => 25,  // Nombre
        'C' => 25,  // Representante
        'D' => 30,  // Dirección
        'E' => 15,  // Código catastral
        'F' => 12,  // Nº Formulario
        'G' => 12,  // Via
        'H' => 20,  // Servicios
        'I' => 15,  // Tipología
        'J' => 10,  // Nº Plantas
        'K' => 10,  // Concluidas
        'L' => 12,  // En construcción
        'M' => 35,  // Enlace
        'N' => 12,  // Nº Inmueble
        'O' => 25,  // Descripción
        'P' => 15,  // DATM
        'Q' => 15   // Fecha apersonamiento
    ];
    
    foreach ($anchos as $columna => $ancho) {
        $sheet->getColumnDimension($columna)->setWidth($ancho);
    }
    
    // Ajustar altura de filas
    $sheet->getRowDimension(1)->setRowHeight(25);
    $sheet->getRowDimension(2)->setRowHeight(20);
    $sheet->getRowDimension(3)->setRowHeight(20);
    $sheet->getRowDimension(4)->setRowHeight(30);
    
    // Configurar para descarga
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Reporte_Operativo_' . date('Y-m-d') . '.xlsx"');
    header('Cache-Control: max-age=0');
    
    // Generar y enviar archivo
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    
} catch (Exception $e) {
    // En caso de error, enviar respuesta JSON
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'message' => $e->getMessage()
    ]);
}
?>
