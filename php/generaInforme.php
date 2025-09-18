<?php
session_start();
require_once '../vendor/autoload.php';
require_once './conexionpsql.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\SimpleType\TblWidth;
use PhpOffice\PhpWord\Style\Table as TableStyle;

foreach ($_GET as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$conn = new Conexion();
$cons = $conn->conectar();

$query = "INSERT INTO datm_informe_tecnico 
(idrubro, nro_registro, hhrr, 
proveido, gestion_fiscal, idcite, idtipo_informe ) VALUES (
    :idrubro, :nro_registro, :hhrr, 
    :proveido, :gestion_fiscal, :idcite, :idtipo_informe
)";

$stmt = $cons->prepare($query);
$stmt->bindParam(':idrubro',  $idrubro);
$stmt->bindParam(':nro_registro', $registro_tributario);
$stmt->bindParam(':hhrr', $hoja_ruta);
$stmt->bindParam(':proveido', $proveido);
$stmt->bindParam(':gestion_fiscal', $gestion_fiscal);
$stmt->bindParam(':idcite', $idcite);
$stmt->bindParam(':idtipo_informe', $tipo_informe);
$nErr = $stmt->execute();

$pjson = array();
if ($nErr != '1') {
    $pjson['log'] .= "<br>- Problemas en el registro:" . $nErr;
    $pjson['err'] = '1';
} else {
    $pjson['log'] .= "<p>- Registro sin errores</p>";
}

$rubroAux = 'actividad_univ';
$filtro = 'numero_actividad';
$datosInm = '';
switch ($idrubro) {
    case '1': {
            $rubroAux = 'vehiculo_univ';
            $filtro = 'nro_pta';
            break;
        }
    case '2': {
            $datosInm = ' ,pmc, TO_CHAR(fecha_empadronamiento, \'DD "de" TMMonth "de" YYYY\') as fecha_empadronamiento, superficie_terreno, superficie_construccion, 
            REPLACE(ubicacion_nivel2, \'URBANIZACION, LOTE, COMUNIDAD:\', \'\') ubicacion_nivel2, ubicacion_nivel3 ,direccion_descriptiva, tipo_construccion ';
            $rubroAux = 'inmueble_univ';
            $filtro = 'numero_inmueble';
            break;
        }
}

$query = "SELECT tipo_contribuyente, tipo_documento,documento_identidad , expedido, 
trim(upper(concat(nombre_rsocial, ' ', primer_apellido_sigla, ' ', segundo_apellido, ' ', apellido_esposo))) nombre_tit,
    COALESCE (tipo_apoderado,'x') tipo_apoderado, 
    trim(upper(concat(nombre_apo, ' ', primer_apellido_apo, ' ', segundo_apellido_apo))) nombre_apo, 
    trim(concat(tipo_documento_apo, ' ', documento_identidad_apo, ' ',  expedido_apo  )   ) as documento_identidad_apo
    $datosInm 
    from  $rubroAux   
    where  $filtro = '$registro_tributario';";


$stmt = $cons->query($query);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// VARIABLES DINÁMICAS
$registro = $registro_tributario;
$hojaRuta = $hoja_ruta;
$nombreUsuario = $_SESSION['honorifico'] . " " . $_SESSION['nombreUsuario'];
$sigla_usuario = $_SESSION['sigla_usuario'];

// INICIALIZAR DOCUMENTO
$phpWord = new PhpWord();
$phpWord->getSettings()->setThemeFontLang(new \PhpOffice\PhpWord\Style\Language('es-BO'));
$phpWord->setDefaultFontName('Times New Roman');
$phpWord->setDefaultFontSize(11);

// Configura página tamaño oficio
$sectionStyle = [
    'pageSizeW' => Converter::inchToTwip(8.5),
    'pageSizeH' => Converter::inchToTwip(13),

    'marginLeft' => Converter::inchToTwip(1),
    'marginRight' => Converter::inchToTwip(1),
    'marginTop' => Converter::inchToTwip(1),
    'marginBottom' => Converter::inchToTwip(1),
];

$section = $phpWord->addSection($sectionStyle);

// FUENTE GENERAL
$phpWord->addFontStyle('anotacion', ['name' => 'Times New Roman', 'size' => 6]);
$phpWord->addFontStyle('textoNormal', ['name' => 'Times New Roman', 'size' => 11]);
$phpWord->addFontStyle('textoNegrita', ['name' => 'Times New Roman', 'size' => 11, 'bold' => true]);
$phpWord->addFontStyle('tituloSubrayado', ['name' => 'Times New Roman', 'size' => 12, 'bold' => true, 'underline' => 'single', 'allCaps' => true]);

$phpWord->addParagraphStyle('sinEspacio', [
    'spaceBefore' => 0,
    'spaceAfter' => 0,
    'lineHeight' => 1
]);

$phpWord->addParagraphStyle('sinEspacioIdentado', [
    'spaceBefore' => 0,
    'spaceAfter' => 0,
    'lineHeight' => 1,
    'indentation' => ['left' => 400]
]);
$phpWord->addParagraphStyle('subtitulo', [
    'spaceBefore' => 200,
    'spaceAfter' => 0,
    'lineHeight' => 1.5,
    'alignment' => Jc::BOTH
]);
$phpWord->addParagraphStyle('parrafo', [
    'lineHeight' => 1,
    'alignment' => Jc::BOTH
]);

// CABECERA
$header = $section->addHeader();
$header->addImage('escudo.jpg', [
    'width' => 60,
    'height' => 70,
    'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
]);
$header->addText('GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO', [
    'bold' => true,
    'size' => 11,
    'name' => 'Times New Roman',
    'allCaps' => true
], [
    'alignment' => Jc::CENTER,
    'spaceAfter' => 0,
    'spaceBefore' => 0,
    'lineHeight' => 1
]);
$header->addImage('linea_cabecera.jpg', [
    'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
]);
// PIE DE PÁGINA
$footer = $section->addFooter();
$footer->addImage('linea_cabecera.jpg', [
    'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
    'spaceAfter' => 0,
    'spaceBefore' => 0,
    'lineHeight' => 1
]);
$footer->addText(
    'Terminal Metropolitana El Alto',
    ['name' => 'Times New Roman', 'size' => 9],
    [
        'alignment' => Jc::CENTER,
        'spaceAfter' => 0,
        'spaceBefore' => 0,
        'lineHeight' => 1
    ]
);
$footer->addText(
    'Avenida Ladislao Cabrera, carretera a Viacha – Urb. Villa Bolívar “D” (Primer Piso)',
    ['name' => 'Times New Roman', 'size' => 9],
    ['alignment' => Jc::CENTER]
);

// CONTENIDO PRINCIPAL
$section->addText('INFORME', ['bold' => true, 'name' => 'Times New Roman', 'size' => 12, 'allCaps' => true], [
    'alignment' => Jc::CENTER,
    'spaceAfter' => 0,
    'spaceBefore' => 0,
    'lineHeight' => 1
]);
$section->addText($cite, ['bold' => true, 'name' => 'Times New Roman', 'size' => 12], [
    'alignment' => Jc::CENTER,
    'spaceAfter' => 0,
    'spaceBefore' => 0,
    'lineHeight' => 1
]);
$section->addTextBreak(1);

// DESTINATARIOS 

$table = $section->addTable();
$table->addRow();
$table->addCell(2000)->addText("A", 'textoNegrita', 'sinEspacioIdentado');
$table->addCell(1000)->addText(":", 'textoNegrita', 'sinEspacio');
$table->addCell(8000)->addText("Abg. Ivan Puña Aguilar", 'textoNormal', 'sinEspacio');

$table->addRow();
$table->addCell(2000)->addText("", 'textoNegrita', 'sinEspacioIdentado');
$table->addCell(1000)->addText("", 'textoNegrita', 'sinEspacio');
$table->addCell(8000)->addText("DIRECTOR DE ADMINISTRACIÓN TRIBUTARIA MUNICIPAL", 'textoNegrita', 'sinEspacio');

$table->addRow();
$table->addCell(2000)->addText("", 'textoNegrita', 'sinEspacioIdentado');
$table->addCell(1000)->addText("", 'textoNegrita', 'sinEspacio');
$table->addCell(8000)->addText("GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO", 'textoNegrita');

$table->addRow();
$table->addCell(2000)->addText("VÍA", 'textoNegrita', 'sinEspacioIdentado');
$table->addCell(1000)->addText(":", 'textoNegrita', 'sinEspacio');
$table->addCell(8000)->addText("Abg. Nadia Daniela Avendaño Miranda", 'textoNormal', 'sinEspacio');

$table->addRow();
$table->addCell(2000)->addText("", 'textoNegrita', 'sinEspacioIdentado');
$table->addCell(1000)->addText("", 'textoNegrita', 'sinEspacio');
$table->addCell(8000)->addText("JEFE UNIDAD DE ASESORÍA JURÍDICA Y COBRANZA COACTIVA", 'textoNegrita', 'sinEspacio');

$table->addRow();
$table->addCell(2000)->addText("", 'textoNegrita', 'sinEspacioIdentado');
$table->addCell(1000)->addText("", 'textoNegrita', 'sinEspacio');
$table->addCell(8000)->addText("GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO", 'textoNegrita');

$table->addRow();
$table->addCell(2000)->addText("DE", 'textoNegrita', 'sinEspacioIdentado');
$table->addCell(1000)->addText(":", 'textoNegrita', 'sinEspacio');
$table->addCell(8000)->addText("$nombreUsuario", 'textoNormal', 'sinEspacio');

$table->addRow();
$table->addCell(2000)->addText("", 'textoNegrita', 'sinEspacioIdentado');
$table->addCell(1000)->addText("", 'textoNegrita', 'sinEspacio');
$table->addCell(8000)->addText("OPERADOR TRIBUTARIO", 'textoNegrita', 'sinEspacio');

$table->addRow();
$table->addCell(2000)->addText("", 'textoNegrita', 'sinEspacioIdentado');
$table->addCell(1000)->addText("", 'textoNegrita', 'sinEspacio');
$table->addCell(8000)->addText("GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO", 'textoNegrita');

$table->addRow();
$table->addCell(2000)->addText("REF.", 'textoNegrita', 'sinEspacioIdentado');
$table->addCell(1000)->addText(":", 'textoNegrita', 'sinEspacio');

$textAux = '';
switch ($tipo_informe) {
    case '1':
        $textAux = 'BAJA POR NO POSESIÓN';
        break;
    case '2':
        $textAux = 'PRESCRIPCIÓN';
        break;
    case '3':
        $textAux = 'ACCION DE REPETICIÓN';
        break;
    case '4':
        $textAux = 'DOBLE EMPADRONAMIENTO';
        break;
    case '5':
        $textAux = 'EXENCIÓN 3RA EDAD';
        break;
}


$cell = $table->addCell(8000);
$textRun = $cell->addTextRun();
$textRun->addText($textAux, 'textoNegrita');
$textRun->addTextBreak(); // esto agrega el salto de línea
$textRun->addText("REGISTRO TRIBUTARIO Nº $registro", 'textoNegrita');


$table->addRow();
$table->addCell(2000)->addText("FECHA", 'textoNegrita', 'sinEspacioIdentado');
$table->addCell(1000)->addText(":", 'textoNegrita', 'sinEspacio');
$table->addCell(8000)->addText("El Alto, " . obtenerFecha(), 'textoNormal');

$textrun = $section->addTextRun('parrafo');
$textrun->addText("En atención a Hoja de Ruta $hojaRuta, referente al inmueble con Registro Tributario N° ");
$textrun->addText($registro, ['bold' => true]);
$textrun->addText(" (BAJA), tengo a bien informar:");

$section->addText('1. DATOS GENERALES.', 'textoNegrita', 'subtitulo');

/**
 * TABLA
 * 
 */
// 3. Definir estilos (opcional pero recomendado para mejor control)

// Estilo para la tabla (bordes simples)
$tableStyle = [
    'borderSize'  => 6,          // Tamaño del borde en twips (1/20 de punto)
    'borderColor' => '000000',   // Color del borde (negro)
    'alignment'   => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, // Centrar la tabla en la página
    'spaceAfter' => 0,
    'spaceBefore' => 0,
    'lineHeight' => 1
];
// También podemos definir un estilo con nombre
$phpWord->addTableStyle('miTablaEstilo', $tableStyle);

// Estilo para las celdas (general)
$cellStyle = [
    'valign' => 'center', // Alineación vertical
];

// Estilo para las celdas de la primera columna (texto a la izquierda)
$cellStyleCol1 = [
    'valign' => 'center',
    'spaceAfter' => 0,
    'spaceBefore' => 0,
    'lineHeight' => 1
];

// Estilo para las celdas de la segunda columna (simulando espacio vacío)
$cellStyleCol2 = [
    'valign' => 'center',
    'spaceAfter' => 0,
    'spaceBefore' => 0,
    'lineHeight' => 1
];

// Estilo para la celda del encabezado "DATOS" (negrita, centrado)
$headerCellStyle1 = [
    'valign' => 'center',
];
$headerParagraphStyle1 = [
    'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
    'spaceAfter' => 0,
    'spaceBefore' => 0,
    'lineHeight' => 1
];
$headerFontStyle1 = [
    'bold' => true,
    'name' => 'Arial', // Puedes especificar la fuente
    'size' => 10,      // Puedes especificar el tamaño
];

// Estilo para la celda del encabezado "INMUEBLE..." (negrita, centrado)
$headerCellStyle2 = [
    'valign' => 'center',
];
$headerParagraphStyle2 = [
    'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
    'spaceAfter' => 0,
    'spaceBefore' => 0,
    'lineHeight' => 1
];
$headerFontStyle2 = [
    'bold' => true,
    'name' => 'Arial',
    'size' => 10,
];

// Estilo para la celda final que ocupa todo el ancho (izquierda)
$footerCellStyle = [
    'gridSpan' => 2,
    'valign' => 'center',
];
$footerCellStyle2 = [
    'gridSpan' => 3,
    'valign' => 'center',
];
$footerParagraphStyle = [
    'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT,
    'spaceAfter' => 0,
    'spaceBefore' => 0,
    'lineHeight' => 1
];
$footerParagraphStyle2 = [
    'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT,
    'spaceAfter' => 1,
    'spaceBefore' => 0,
    'lineHeight' => 1
];
$footerFontStyle = [
    'name' => 'Arial',
    'size' => 9, // Un poco más pequeño quizás
];


// 4. Añadir la tabla con el estilo definido
// Definimos anchos relativos para las columnas (ej: 40% y 60% aprox.)
// PHPWord usa twips (1/20 de punto). Un ancho de página A4 típico es ~9000 twips.
$colWidth1 = 3000;
$colWidth2 = 5000;

$table = $section->addTable('miTablaEstilo');
// --- Fila 1: Encabezados ---
$table->addRow();
$cell1 = $table->addCell($colWidth1, $headerCellStyle1);
$cell1->addText('DATOS', $headerFontStyle1, $headerParagraphStyle1);

$cell2 = $table->addCell($colWidth2, $headerCellStyle2);
// Para el salto de línea dentro de la celda, usamos addTextBreak
$cell2->addText("INMUEBLE: $registro", $headerFontStyle2, $headerParagraphStyle2);
$cell2->addText('(BAJA)', $headerFontStyle2, $headerParagraphStyle2);


$labelFontStyle = ['name' => 'Times New Roman', 'size' => 8]; // Estilo para las etiquetas 
if ($tipo_informe == 4) {

    $cell3 = $table->addCell($colWidth2, $headerCellStyle2);
    // Para el salto de línea dentro de la celda, usamos addTextBreak
    $cell3->addText("INMUEBLE: $registro", $headerFontStyle2, $headerParagraphStyle2);
    $cell3->addText('(VIGENTE)', $headerFontStyle2, $headerParagraphStyle2);

    $table->addRow();
    $table->addCell($colWidth1, $cellStyleCol1)->addText('CONTRIBUYENTE', $labelFontStyle, 'sinEspacio');
    $table->addCell($colWidth2, $cellStyleCol2)->addText($result['nombre_tit'], $labelFontStyle, 'sinEspacio');
    $table->addCell($colWidth2, $cellStyleCol2)->addText("", $labelFontStyle, 'sinEspacio');

    $table->addRow();
    $table->addCell($colWidth1, $cellStyleCol1)->addText('P.M.C. (titular):', $labelFontStyle, 'sinEspacio');
    $table->addCell($colWidth2, $cellStyleCol2)->addText($result['pmc'], $labelFontStyle, 'sinEspacio');
    $table->addCell($colWidth2, $cellStyleCol2)->addText("", $labelFontStyle, 'sinEspacio');


    if ($idrubro == '2') {
        $query = "select pmc, trim(upper(concat(nombre_rsocial, ' ', primer_apellido_sigla, ' ', segundo_apellido, ' ', apellido_esposo))) nombre_contribuyente  from inmueble_copropietario";
        $stmt = $cons->query($query);
        $resultCop = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultCop as $key => $value) {
            $table->addRow();
            $table->addCell($colWidth1, $cellStyleCol1)->addText('COPROPIETARIO', $labelFontStyle, 'sinEspacio');
            $table->addCell($colWidth2, $cellStyleCol2)->addText($value['nombre_contribuyente'], $labelFontStyle, 'sinEspacio');
            $table->addCell($colWidth2, $cellStyleCol2)->addText("", $labelFontStyle, 'sinEspacio');

            $table->addRow();
            $table->addCell($colWidth1, $cellStyleCol1)->addText('P.M.C.:', $labelFontStyle, 'sinEspacio');
            $table->addCell($colWidth2, $cellStyleCol2)->addText($value['pmc'], $labelFontStyle, 'sinEspacio');
            $table->addCell($colWidth2, $cellStyleCol2)->addText("", $labelFontStyle, 'sinEspacio');
        }
    }


    $table->addRow();
    $table->addCell($colWidth1, $cellStyleCol1)->addText('DOMICILIO LEGAL:', $labelFontStyle, 'sinEspacio');

    $cell = $table->addCell(8000);
    $textRun = $cell->addTextRun();
    $textRun->addText($result['ubicacion_nivel2'], 'sinEspacio');
    $textRun->addTextBreak();
    $textRun->addText($result['ubicacion_nivel3'], 'sinEspacio');
    $textRun->addTextBreak();
    $textRun->addText($result['direccion_descriptiva'], 'sinEspacio');

    $table->addCell($colWidth2, $cellStyleCol2)->addText("", $labelFontStyle, 'sinEspacio');

    $table->addRow();
    $table->addCell($colWidth1, $cellStyleCol1)->addText('SUPERFICIE DEL TERRENO:', $labelFontStyle, 'sinEspacio');
    $table->addCell($colWidth2, $cellStyleCol2)->addText($result['superficie_terreno'] . " m2.", $labelFontStyle, 'sinEspacio');
    $table->addCell($colWidth2, $cellStyleCol2)->addText("", $labelFontStyle, 'sinEspacio');

    $table->addRow();
    $table->addCell($colWidth1, $cellStyleCol1)->addText('SUPERFICIE CONSTRUIDA', $labelFontStyle, 'sinEspacio');
    $table->addCell($colWidth2, $cellStyleCol2)->addText($result['superficie_construccion'] . " m2.", $labelFontStyle, 'sinEspacio');
    $table->addCell($colWidth2, $cellStyleCol2)->addText("", $labelFontStyle, 'sinEspacio');

    $table->addRow();
    $table->addCell($colWidth1, $cellStyleCol1)->addText('TIPO DE CONSTRUCCION', $labelFontStyle, 'sinEspacio');
    $table->addCell($colWidth2, $cellStyleCol2)->addText($result['tipo_construccion'], $labelFontStyle, 'sinEspacio');
    $table->addCell($colWidth2, $cellStyleCol2)->addText("", $labelFontStyle, 'sinEspacio');


    $table->addRow();
    $cellFuente = $table->addCell($colWidth1 + $colWidth2 + $colWidth2, $footerCellStyle2); // La celda ocupa el ancho total
    $cellFuente->addText(
        'FUENTE: Extraído del Sistema RUAT-Inmuebles.',
        $footerFontStyle,
        $footerParagraphStyle
    );
} else {

    $table->addRow();
    $table->addCell($colWidth1, $cellStyleCol1)->addText('CONTRIBUYENTE', $labelFontStyle, 'sinEspacio');
    // Añadir celda vacía en la segunda columna
    $table->addCell($colWidth2, $cellStyleCol2)->addText($result['nombre_tit'], $labelFontStyle, 'sinEspacio');

    $table->addRow();
    $table->addCell($colWidth1, $cellStyleCol1)->addText('P.M.C. (titular):', $labelFontStyle, 'sinEspacio');
    $table->addCell($colWidth2, $cellStyleCol2)->addText($result['pmc'], $labelFontStyle, 'sinEspacio');

    if ($idrubro == '2') {
        $query = "select pmc, trim(upper(concat(nombre_rsocial, ' ', primer_apellido_sigla, ' ', segundo_apellido, ' ', apellido_esposo))) nombre_contribuyente  from inmueble_copropietario";
        $stmt = $cons->query($query);
        $resultCop = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultCop as $key => $value) {
            $table->addRow();
            $table->addCell($colWidth1, $cellStyleCol1)->addText('COPROPIETARIO', $labelFontStyle, 'sinEspacio');
            $table->addCell($colWidth2, $cellStyleCol2)->addText($value['nombre_contribuyente'], $labelFontStyle, 'sinEspacio');

            $table->addRow();
            $table->addCell($colWidth1, $cellStyleCol1)->addText('P.M.C.:', $labelFontStyle, 'sinEspacio');
            $table->addCell($colWidth2, $cellStyleCol2)->addText($value['pmc'], $labelFontStyle, 'sinEspacio');
        }
    }

    $table->addRow();
    $table->addCell($colWidth1, $cellStyleCol1)->addText('DOMICILIO LEGAL:', $labelFontStyle, 'sinEspacio');
    $cell = $table->addCell(8000);
    $textRun = $cell->addTextRun();
    $textRun->addText($result['ubicacion_nivel2'], $labelFontStyle, 'sinEspacio');
    $textRun->addTextBreak();
    $textRun->addText($result['ubicacion_nivel3'], $labelFontStyle, 'sinEspacio');
    $textRun->addTextBreak();
    $textRun->addText($result['direccion_descriptiva'],  $labelFontStyle, 'sinEspacio');

    $table->addRow();
    $table->addCell($colWidth1, $cellStyleCol1)->addText('SUPERFICIE DEL TERRENO:', $labelFontStyle, 'sinEspacio');
    $table->addCell($colWidth2, $cellStyleCol2)->addText($result['superficie_terreno'] . " m2.", $labelFontStyle, 'sinEspacio');

    $table->addRow();
    $table->addCell($colWidth1, $cellStyleCol1)->addText('SUPERFICIE CONSTRUIDA', $labelFontStyle, 'sinEspacio');
    $table->addCell($colWidth2, $cellStyleCol2)->addText($result['superficie_construccion'] . " m2.", $labelFontStyle, 'sinEspacio');

    $table->addRow();
    $table->addCell($colWidth1, $cellStyleCol1)->addText('TIPO DE CONSTRUCCION', $labelFontStyle, 'sinEspacio');
    $table->addCell($colWidth2, $cellStyleCol2)->addText($result['tipo_construccion'], $labelFontStyle, 'sinEspacio');

    $table->addRow();
    $cellFuente = $table->addCell($colWidth1 + $colWidth2, $footerCellStyle); // La celda ocupa el ancho total
    $cellFuente->addText(
        'FUENTE: Extraído del Sistema RUAT-Inmuebles.',
        $footerFontStyle,
        $footerParagraphStyle
    );
}



/** 
    FIN TABLA
 */

$styleParrafoJustificado = [
    'alignment' => Jc::BOTH,
    'spaceAfter' => 0,
    'spaceBefore' => 0,
    'lineHeight' => 1
];
$styleParrafoJustificadoEspaciadoTop = [
    'alignment' => Jc::BOTH,
    'spaceAfter' => 0,
    'spaceBefore' => 200,
    'lineHeight' => 1
];

$styleParrafoJustificadoEspaciadoDown = [
    'alignment' => Jc::BOTH,
    'spaceAfter' => 200,
    'spaceBefore' => 0,
    'lineHeight' => 1
];

$phpWord->addNumberingStyle(
    'myBulletStyle', // ID del estilo
    [
        'type' => 'multilevel', // ¡IMPORTANTE! NO usar 'bullet'
        'levels' => [
            [
                'format' => 'bullet',
                'text' => '•',       // Primer nivel: punto grande
                'left' => 720,
                'hanging' => 360,
                'tabPos' => 720
            ],
            [
                'format' => 'bullet',
                'text' => 'o',       // Segundo nivel: circulito
                'left' => 1080,
                'hanging' => 360,
                'tabPos' => 1080
            ],
            [
                'format' => 'bullet',
                'text' => '▪',       // Tercer nivel: cuadradito
                'left' => 1440,
                'hanging' => 360,
                'tabPos' => 1440
            ]
        ]
    ]
);

$section->addText('2.  ANTECEDENTES.', 'textoNegrita', 'subtitulo');

switch ($tipo_informe) {
    case '1': {
            $textrun = $section->addTextRun('parrafo');
            $textrun->addText("Mediante nota presentada en fecha de XX de septiembre de 202X (cursante en foja X), notas complementarias presentadas en fecha XX de octubre de 202X (cursante en foja XX) y XX de octubre de 202X (cursante en foja XX), presentadas ante esta Dirección de Administración Tributaria Municipal por " . $result['nombre_tit'] . " con " . $result['tipo_documento'] . " " . $result['documento_identidad'] . " " . $result['expedido'] . ", quien solicita la BAJA POR NO POSESIÓN del Inmueble con Registro Tributario N°" . $registro . ", a tal efecto el impetrante presenta la siguiente documentación:");

            $section->addListItem('Original del CERTIFICADO NACIONAL (GENERAL), emitida por Derechos Reales.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem('Fotocopia simple de comprobante de pago de impuesto del inmueble', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem('Fotocopia simple de Cédula de Identidad.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem('Original Declaración Voluntaria Notariada.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            break;
        }
    case '2': {
            $textrun = $section->addTextRun('parrafo');
            $textrun->addText("Mediante nota presentada (cursante en foja XX) a la Dirección de Administración Tributaria Municipal del Gobierno Autónomo Municipal de El Alto en fecha XX de julio de 202X, por la Sr(a). " . $result['nombre_tit'] . ", en la que solicita la prescripción de pago del Impuesto a la Propiedad de Bienes Inmuebles por la gestión fiscal $gestion_fiscal, del inmueble con Registro Tributario N°$registro, con el objeto de respaldar la misma, presenta la siguiente documentación:");

            $section->addListItem('Fotocopia simple Plano de construcción o fotos.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem('Fotocopia simple de comprobante de pago (IPBI-IMPBI).', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem('Fotocopia simple de Plano de Lote.', 0, null, 'myBulletStyle', $styleParrafoJustificado);

            $section->addListItem('Fotocopia simple Folio Real y/o Tarjeta de Propiedad.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem('Fotocopia simple de Testimonio de Propiedad.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem('Fotocopia simple de la Cédula de Identidad.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            break;
        }
    case '3': {

            $textrun = $section->addTextRun('parrafo');
            $textrun->addText("Mediante solicitud de fecha XX de marzo de 202X (cursante en foja XX), el Sr(a). " . $result['nombre_tit'] . ", solicita ACCIÓN DE REPETICIÓN del inmueble con registro tributario N° $registro por la gestión fiscal $gestion_fiscal, presentando para tal efecto la siguiente documentación:");

            $section->addListItem('Fotocopia simple de comprobante de pago de la gestión pagada posteriormente.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem('Fotocopia simple de comprobante de pago de la gestión pagada previamente.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem('Fotocopia simple de Plano de Lote.', 0, null, 'myBulletStyle', $styleParrafoJustificado);

            $section->addListItem('Fotocopia simple Folio Real y/o Tarjeta de Propiedad.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem('Fotocopia simple de Testimonio de Propiedad.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem('Fotocopia simple de la Cédula de Identidad.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            break;
        }
    case '4': {
            $textrun = $section->addTextRun('parrafo');
            $textrun->addText("Mediante nota presentada en fecha de 12 de enero de 2023, ante esta Dirección de Administración Tributaria Municipal por el Sr(a). " . $result['nombre_tit'] . " con " . $result['tipo_documento'] . " " . $result['documento_identidad'] . " " . $result['expedido'] . ", quien solicita la Baja Por Doble Empadronamiento del Inmueble con Registro Tributario N°$registro, a tal efecto presentan la siguiente documentación:");

            $section->addListItem('Original de Certificado NO PROPIEDAD, emitida por Derechos Reales.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem('Fotocopia simple del comprobante de pago de impuestos (IPBI-IMPBI) inmueble de baja.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem('Fotocopia simple del comprobante de pago de impuestos (IPBI-IMPBI) inmueble de vigente.', 0, null, 'myBulletStyle', $styleParrafoJustificado);

            $section->addListItem('Fotocopia simple de plano de ubicación o croquis detallado inmueble de vigente.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem('Fotocopia simple de Tarjeta de Registro de Propiedad y/o Folio Real inmueble de vigente.', 0, null, 'myBulletStyle', $styleParrafoJustificado);

            $section->addListItem('Fotocopia simple de Plano de Lote.', 0, null, 'myBulletStyle', $styleParrafoJustificado);

            $section->addListItem('Fotocopia simple de Testimonio de Propiedad.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem('Fotocopia simple de la Cédula de Identidad.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            break;
        }
    case '5': {
            $textrun = $section->addTextRun('parrafo');
            $textrun->addText("En atención a nota presentada (cursante en foja XX) en fecha XX de marzo de 202X,  " . $result['nombre_tit'] . " , solicita a esta Administración Tributaria Municipal el descuento de la tercera edad del Impuesto Municipal a la Propiedad de Bienes Inmuebles por el inmueble con registro tributario Nº $registro, toda vez que el Gobierno Autónomo Municipal de El Alto mediante LEY MUNICIPAL Nº 003/2012, DE CREACIÓN DE IMPUESTOS MUNICIPALES, LEY AUTONÓMICA MUNICIPAL N° 12 LEY MUNICIPAL AUTONÓMICA DE COMPLEMENTACIÓN, DE MODIFICACIÓN Y ENMIENDA A LA LEY MUNICIPAL Nº 003/2012, DE CREACIÓN DE IMPUESTOS MUNICIPALES Y DECRETO MUNICIPAL Nº 001 de 20 de junio de 2013, dispone la creación del citado beneficio para los ciudadanos de 60 años o más que residen en la jurisdicción territorial del GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO (GAMEA), el impetrante adjunta la siguiente documentación:");

            $section->addListItem('Fotocopia simple de Formulario U-R', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem("Fotocopia simple de la boleta de pago del inmueble $registro correspondiente a la gestión fiscal $gestion_fiscal.", 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem('Fotocopia simple de Testimonio.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem('Fotocopia simple de cédula de identidad.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem('Fotocopia simple de folio real.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            break;
        }
}

switch ($tipo_informe) {
    case '1': {

            $section->addText('3.	CONSIDERACIONES.', 'textoNegrita', 'subtitulo');
            $section->addText("3.1.	DATOS REGISTRADOS EN EL SISTEMA RUAT REGISTRO TRIBUTARIO Nº $registro.", 'textoNegrita', 'subtitulo');

            $section->addListItem('Según Sistema RUAT, el inmueble fue empadronado como propiedad única en fecha ' . $result['fecha_empadronamiento'] . ', a nombre de ' . $result['nombre_tit'] . '.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem("De acuerdo a verificación de pagos según Módulo Consultas-Pagos, se registra pagos por concepto del Impuesto a la Propiedad de Bienes Inmuebles e Impuesto Municipal a la Propiedad de Bienes Inmuebles por las gestiones fiscales $gestion_fiscal", 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem('Según sistema RUAT-Inmuebles, Módulo Liquidación-Proforma, no presenta deuda tributaria por ninguna gestión fiscal (cursante en fojas XX).', 0, null, 'myBulletStyle', $styleParrafoJustificado);


            $section->addText('4.	ANTECEDENTES DE EMPADRONAMIENTO.', 'textoNegrita', 'subtitulo');

            $section->addText("De la revisión de los antecedentes administrativos proporcionados por el Área de Archivo, dependiente del Área de Gestión Administrativa del inmueble con Registro Tributario N°$registro (BAJA), se determina la existencia de ANTECEDENTES DE EMPADRONAMIENTO, (cursante en fojas XX al XX). ", 'textoNormal', 'parrafo');

            $section->addText('5.	NOTIFICACIÓN DE ACTOS ADMINISTRATIVOS POR LA DATM.', 'textoNegrita', 'subtitulo');
            $section->addText("La Administración Tributaria Municipal emite PROVEIDO $proveido de fecha XX de octubre de 202X, notificado de manera Personal en fecha XX de octubre de 202X, dando respuesta a notas presentadas en fecha de XX de septiembre de 202X, nota complementaria presentada en fecha XX de octubre de 202X; solicitando a  " . $result['nombre_tit'] . " la presentación de: 1) Declaración Jurada ante un Notario de Fe Pública. 2) Nota de solicitud expresa dirigida al Director de la Administración Tributaria Municipal (Abg. Ivan Puña Aguilar), referencia Baja por NO POSESIÓN, en respuesta mediante nota de fecha XX de octubre de 202X, el contribuyente presenta su Declaración Jurada ante un notario de fe pública referente al inmueble con Registro Tributario N°$registro.", 'textoNormal', 'parrafo');

            $section->addText('6.	CONCLUSIONES.', 'textoNegrita', 'subtitulo');
            $section->addText("Por todo lo expuesto en el análisis técnico referente a la solicitud de BAJA POR NO POSESION del Registro Tributario N°$registro (BAJA), corresponde señalar lo siguiente:", 'textoNormal', 'parrafo');

            $section->addListItem("El Sr(a).  " . $result['nombre_tit'] . ", se empadronó ante esta Dirección de Administración Tributaria Municipal en fecha  " . $result['fecha_empadronamiento'], 0, null, 'myBulletStyle', $styleParrafoJustificado);

            $listItemRun = $section->addListItemRun(0, 'myBulletStyle', $styleParrafoJustificado);

            $listItemRun->addText("Asimismo, CERTIFICADO NACIONAL (GENERAL) emitido por la oficina de Derechos Reales, señala: ");
            $listItemRun->addText("“(…) Que, a la fecha de la revisión de los datos de registro de Derechos Reales correspondientes al ámbito nacional, consta que:", ['italic' => true]);
            $listItemRun->addText(" NO ", ['bold' => true, 'italic' => true]);
            $listItemRun->addText("se tiene registrado o inscrito derecho propietario sobre inmuebles, a nombre de:   " . $result['nombre_tit'] . " con " . $result['tipo_documento'] . " " . $result['documento_identidad'] . " " . $result['expedido'] . ", (…)”", ['italic' => true]);
            $listItemRun->addText(" cursante en (foja XX).");


            $listItemRun = $section->addListItemRun(0, 'myBulletStyle', $styleParrafoJustificado);

            $listItemRun->addText("Mediante Declaración Voluntaria notariada el Sr(a).  " . $result['nombre_tit'] . " con " . $result['tipo_documento'] . " " . $result['documento_identidad'] . " " . $result['expedido'] . ", señala: ");
            $listItemRun->addText("“(…) de mi libre y espontánea voluntad, sin presión, error, dolo u otro vicio que invalide mi consentimiento, DECLARO VOLUNTARIAMENTE QUE NO ME ENCUENTRO EN POSESION del bien inmueble ubicado en " . $result['direccion'] . ", registrado con una superficie de " . $result['superficie_terreno'] . " m2 con numero de inmueble $registro (…)”", ['italic' => true]);

            $section->addText("En conclusión, corresponde proseguir el tramite como Baja por No Posesión, toda vez que el Sr(a).  " . $result['nombre_tit'] . " titular el inmueble con Registro Tributario N°$registro (BAJA) se ve imposibilitado de presentar documentación del inmueble vigente y por otro lado la Administración Tributaria Municipal agoto todas las instancias administrativas", 'textoNormal', 'parrafo');

            $section->addText('7.	RECOMENDACIÓN.', 'textoNegrita', 'subtitulo');
            $section->addText("Por tanto, se recomienda remitir al asesor legal de la Unidad de Asesoría Legal y Cobranza Coactiva para que proceda a elaborar la Resolución Administrativa de Baja por No Posesión del Registro Tributario N°$registro (BAJA), tomando en cuenta las observaciones referidas en el presente informe", 'textoNormal', 'parrafo');



            break;
        }
    case '2': {
            $section->addText('3.	CONSIDERACIONES.', 'textoNegrita', 'subtitulo');
            $section->addText("3.1.	DATOS REGISTRADOS EN EL SISTEMA RUAT REGISTRO TRIBUTARIO Nº $registro.", 'textoNegrita', 'subtitulo');
            $section->addListItem('Según Sistema RUAT, el inmueble fue empadronado como propiedad única en fecha ' . $result['fecha_empadronamiento'] . ', a nombre de ' . $result['nombre_tit'] . '.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem("Según Sistema RUAT-Inmuebles en el módulo de Pagos Impuesto a la Propiedad se registran los pagos de IMPUESTO A LA PROPIEDAD DE BIENES INMUEBLES Y/O IMPUESTO MUNICIPAL A LA PROPIEDAD DE BIENES INMUEBLES por las gestiones fiscales $gestion_fiscal", 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem('Consulta varios módulos del sistema RUAT:', 0, null, 'myBulletStyle', $styleParrafoJustificado);

            $colWidth1 = 3500;
            $colWidth2 = 4000;

            $table = $section->addTable('miTablaEstilo');
            // --- Fila 1: Encabezados ---
            $table->addRow();
            $cell1 = $table->addCell($colWidth1, $headerCellStyle1);
            $cell1->addText('Consultas Módulos RUAT Inmuebles', $headerFontStyle1, $headerParagraphStyle1);

            $cell2 = $table->addCell($colWidth2, $headerCellStyle2);
            // Para el salto de línea dentro de la celda, usamos addTextBreak
            $cell2->addText("Registros Encontrados: $registro", $headerFontStyle2, $headerParagraphStyle2);

            $table->addRow();
            $table->addCell($colWidth1, $cellStyleCol1)->addText('Descuentos', $labelFontStyle, 'sinEspacio');
            $table->addCell($colWidth2, $cellStyleCol2)->addText('', $labelFontStyle, 'sinEspacio');

            $table->addRow();
            $table->addCell($colWidth1, $cellStyleCol1)->addText('Exenciones', $labelFontStyle, 'sinEspacio');
            $table->addCell($colWidth2, $cellStyleCol2)->addText('', $labelFontStyle, 'sinEspacio');

            $table->addRow();
            $table->addCell($colWidth1, $cellStyleCol1)->addText('Multas Administrativas ACT', $labelFontStyle, 'sinEspacio');
            $table->addCell($colWidth2, $cellStyleCol2)->addText('', $labelFontStyle, 'sinEspacio');

            $table->addRow();
            $table->addCell($colWidth1, $cellStyleCol1)->addText('Multas Administrativas NCT', $labelFontStyle, 'sinEspacio');
            $table->addCell($colWidth2, $cellStyleCol2)->addText('', $labelFontStyle, 'sinEspacio');

            $table->addRow();
            $table->addCell($colWidth1, $cellStyleCol1)->addText('Prescripciones', $labelFontStyle, 'sinEspacio');
            $table->addCell($colWidth2, $cellStyleCol2)->addText('', $labelFontStyle, 'sinEspacio');

            $table->addRow();
            $table->addCell($colWidth1, $cellStyleCol1)->addText('Otras Multas', $labelFontStyle, 'sinEspacio');
            $table->addCell($colWidth2, $cellStyleCol2)->addText('', $labelFontStyle, 'sinEspacio');

            $table->addRow();
            $table->addCell($colWidth1, $cellStyleCol1)->addText('Rectificaciones', $labelFontStyle, 'sinEspacio');
            $table->addCell($colWidth2, $cellStyleCol2)->addText('', $labelFontStyle, 'sinEspacio');

            $table->addRow();
            $table->addCell($colWidth1, $cellStyleCol1)->addText('Anulación Multas', $labelFontStyle, 'sinEspacio');
            $table->addCell($colWidth2, $cellStyleCol2)->addText('', $labelFontStyle, 'sinEspacio');

            $table->addRow();
            $table->addCell($colWidth1, $cellStyleCol1)->addText('Extinción Deudas', $labelFontStyle, 'sinEspacio');
            $table->addCell($colWidth2, $cellStyleCol2)->addText('', $labelFontStyle, 'sinEspacio');

            $table->addRow();
            $table->addCell($colWidth1, $cellStyleCol1)->addText('Compensaciones', $labelFontStyle, 'sinEspacio');
            $table->addCell($colWidth2, $cellStyleCol2)->addText('', $labelFontStyle, 'sinEspacio');

            $table->addRow();
            $table->addCell($colWidth1, $cellStyleCol1)->addText('Pagos Otras Multas', $labelFontStyle, 'sinEspacio');
            $table->addCell($colWidth2, $cellStyleCol2)->addText('', $labelFontStyle, 'sinEspacio');

            $table->addRow();
            $table->addCell($colWidth1, $cellStyleCol1)->addText('Pagos Plan Cuotas', $labelFontStyle, 'sinEspacio');
            $table->addCell($colWidth2, $cellStyleCol2)->addText('', $labelFontStyle, 'sinEspacio');

            $table->addRow();
            $table->addCell($colWidth1, $cellStyleCol1)->addText('Pagos Previos', $labelFontStyle, 'sinEspacio');
            $table->addCell($colWidth2, $cellStyleCol2)->addText('', $labelFontStyle, 'sinEspacio');

            $table->addRow();
            $cellFuente = $table->addCell($colWidth1 + $colWidth2, $footerCellStyle);
            $cellFuente->addText(
                'FUENTE: Extraído del Sistema RUAT-Inmuebles.',
                $footerFontStyle,
                $footerParagraphStyle2
            );
            $section->addText("");
            $section->addListItem('En el módulo Condonaciones Ley Municipal se encuentran los siguientes registros:', 0, null, 'myBulletStyle', $styleParrafoJustificado);


            $phpWord->addFontStyle('font6', ['name' => 'Arial', 'size' => 6]);
            $phpWord->addParagraphStyle('center', ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
            $phpWord->addTableStyle('tablaEstilo', [
                'borderSize' => 6,
                'borderColor' => '000000',
                'cellMargin' => 50,
            ]);

            $table = $section->addTable('tablaEstilo');

            // Primera fila (encabezados)
            $table->addRow();
            $table->addCell(800)->addText('Número', 'font6', 'center');
            $table->addCell(800)->addText('Gestión', 'font6', 'center');
            $table->addCell(800)->addText('Ley Municipal', 'font6', 'center');
            $table->addCell(2000)->addText('Ítem', 'font6', 'center');
            $table->addCell(800)->addText('Porcentaje', 'font6', 'center');
            $table->addCell(1200)->addText('Trámite Registro', 'font6', 'center');
            $table->addCell(1500)->addText('Usuario Registro', 'font6', 'center');
            $table->addCell(1500)->addText('Fecha Registro', 'font6', 'center');
            $table->addCell(1200)->addText('Trámite Anulación', 'font6', 'center');
            $table->addCell(1500)->addText('Usuario Anulación', 'font6', 'center');
            $table->addCell(1500)->addText('Fecha Anulación', 'font6', 'center');

            // Segunda fila (contenido)
            $table->addRow();
            $table->addCell(800)->addText('1', 'font6');
            $table->addCell(800)->addText('1996', 'font6');
            $table->addCell(800)->addText('785', 'font6');

            $cellItem = $table->addCell(2000);
            $cellItem->addText('- INTERÉS', 'font6');
            $cellItem->addText('- MULTA INCUMPLIMIENTO', 'font6');
            $cellItem->addText('- MULTA MORA', 'font6');

            $table->addCell(800)->addText('100', 'font6');
            $table->addCell(1200)->addText('98801705', 'font6');
            $table->addCell(1500)->addText('OPERACION ES - RUAT(*)', 'font6');
            $table->addCell(1500)->addText('30/03/2023 09:50', 'font6');
            $table->addCell(1200)->addText('106202511', 'font6');
            $table->addCell(1500)->addText('OPERACION ES - RUAT(*)', 'font6');
            $table->addCell(1500)->addText('07/03/2024 09:52', 'font6');

            $section->addText("");

            $textrun = $section->addTextRun('parrafo');
            $textrun->addText("La Ley Municipal Nº 785 “Perdonazo Tributario” de fecha 24 de marzo de 2023, parágrafo I del Artículo SEPTIMO establece: “(…) Las Multas e intereses serán ", ['italic' => true]);
            $textrun->addText('condonadas de forma automática ', ['bold' => true, 'italic' => true]);
            $textrun->addText("en el sistema RUAT y de forma escalonada, conforme al siguiente cuadro:", ['italic' => true]);


            $phpWord->addFontStyle('font6', ['name' => 'Arial', 'size' => 6]);
            $phpWord->addFontStyle('font6Italic', ['name' => 'Arial', 'size' => 6, 'italic' => true]);
            $phpWord->addParagraphStyle('center', ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);

            // Estilo de tabla con bordes punteados 

            $phpWord->addTableStyle('tablaCondonacion', [
                'borderSize' => 6,
                'borderColor' => '000000',
                'cellMargin' => 50,
            ]);

            $table = $section->addTable('tablaCondonacion');


            /*             // Fila de encabezado
            $table->addRow();
            $table->addCell(1500)->addText('PERIODO', 'font6', 'center');
            $table->addCell(4000)->addText('PLAZO', 'font6', 'center');
            $table->addCell(1500)->addText("CONDONACION\n(%)", 'font6', 'center');

            // Fila 1
            $table->addRow();
            $table->addCell(1500)->addText('1°', 'font6', 'center');
            $table->addCell(4000)->addText('Los primeros (90) días calendario', 'font6Italic');
            $table->addCell(1500)->addText('100', 'font6', 'center');

            // Fila 2
            $table->addRow();
            $table->addCell(1500)->addText('2°', 'font6', 'center');
            $table->addCell(4000)->addText('Los siguientes (30) días calendario', 'font6Italic');
            $table->addCell(1500)->addText('70', 'font6', 'center'); */


            $colWidth1 = 1500;
            $colWidth2 = 2500;
            $colWidth3 = 2500;

            $table = $section->addTable('miTablaEstilo');
            // --- Fila 1: Encabezados ---
            $table->addRow();
            $cell1 = $table->addCell($colWidth1, $headerCellStyle1);
            $cell1->addText('PERIODO', $headerFontStyle1, $headerParagraphStyle1);

            $cell2 = $table->addCell($colWidth2, $headerCellStyle2);
            // Para el salto de línea dentro de la celda, usamos addTextBreak
            $cell2->addText("PLAZO", $headerFontStyle2, $headerParagraphStyle2);

            $cell3 = $table->addCell($colWidth3, $headerCellStyle2);
            // Para el salto de línea dentro de la celda, usamos addTextBreak
            $cell3->addText("CONDONACION (%)", $headerFontStyle2, $headerParagraphStyle2);

            $table->addRow();
            $table->addCell($colWidth1, $cellStyleCol1)->addText('1°', $labelFontStyle, 'sinEspacio');
            $table->addCell($colWidth2, $cellStyleCol2)->addText('Los primeros (90) días calendario', $labelFontStyle, 'sinEspacio');
            $table->addCell($colWidth3, $cellStyleCol2)->addText('100', $labelFontStyle, 'sinEspacio');

            $table->addRow();
            $table->addCell($colWidth1, $cellStyleCol1)->addText('2°', $labelFontStyle, 'sinEspacio');
            $table->addCell($colWidth2, $cellStyleCol2)->addText('Los siguientes (30) días calendario', $labelFontStyle, 'sinEspacio');
            $table->addCell($colWidth3, $cellStyleCol2)->addText('70', $labelFontStyle, 'sinEspacio');



            $section->addListItem('Según verificación en sistema RUAT-Inmuebles Módulo Observados, no registra observaciones activas por ninguna gestión fiscal.', 0, null, 'myBulletStyle', $styleParrafoJustificadoEspaciadoTop);
            $section->addListItem("De acuerdo a la verificación del Módulo Proforma del Sistema RUAT-Inmuebles, se puede verificar que el inmueble presenta deuda tributaria por el IMPUESTO A LA PROPIEDAD DE BIENES INMUEBLES de la gestión fiscal $gestion_fiscal (foja XX). Asimismo, en fecha XX de julio de 202X se realiza la modificación Datos Técnicos del inmueble con Registro Tributario Nº $registro mediante el Trámite xxxxxxx habiéndose generado deuda tributaria rectificada por las gestiones fiscales  $registro  y obligación tributaria rectificada  por la gestión fiscal $registro  (foja XX).", 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem("Según Sistema RUAT-Inmuebles en el módulo de Datos Técnicos se evidencia que el inmueble registra datos actualizados verificados en fecha XX de julio de 202X por el Área Técnico Predial dependiente de la Unidad de Fiscalización y Recaudaciones de la Administración Tributaria Municipal (foja XX).    ", 0, null, 'myBulletStyle', $styleParrafoJustificado);

            $section->addText('4.	CONCLUSIONES.', 'textoNegrita', 'subtitulo');
            $section->addText("Por todo lo expuesto en el análisis técnico referente a la solicitud de PRESCRIPCIÓN de pago del Impuesto a la Propiedad de Bienes Inmuebles por la gestión fiscal $gestion_fiscal del Registro Tributario $registro  corresponde señalar:", 'textoNormal', 'parrafo');
            $section->addText("De la revisión del sistema RUAT – Inmuebles se evidencia que el número de Registro Tributario $registro, NO REGISTRA descuentos, observaciones por proceso de liquidación por determinación mixta y/o proceso de fiscalización de oficio, pagos por plan cuotas por la gestión fiscal $gestion_fiscal sin embargo registra condonación de manera automática conforme a la Ley Municipal N°785 por la gestión fiscal $gestion_fiscal (véase el punto XXXX. del informe).", 'textoNormal', 'parrafo');

            $section->addText('5.   RECOMENDACIÓN.', 'textoNegrita', 'subtitulo');
            $section->addText("Por tanto, se recomienda técnicamente declarar la procedencia de la pretensión de prescripción para la gestión fiscal $gestion_fiscal. Asimismo, sea remitido al asesor legal de la Unidad de Asesoría Jurídica y Cobranza Coactiva para la emisión de la resolución administrativa (tomando en cuenta previamente el informe de Cobranza Coactiva).", 'textoNormal', 'parrafo');

            break;
        }
    case '3': {

            $section->addText('3.	ANÁLISIS TÉCNICO.', 'textoNegrita', 'subtitulo');

            $textrun = $section->addTextRun('parrafo');
            $textrun->addText("De los antecedentes adjuntos al expediente y la base de datos del Padrón Municipal de Contribuyentes (PMC) en relación al inmueble con registro tributario N° $registro se tiene lo siguiente:");

            $section->addListItem('Según Sistema RUAT-Inmuebles, Módulo Consultas-Trámites, se evidencia que en fecha ' . $result['fecha_empadronamiento'] . ', se registra el empadronamiento como propiedad única a nombre del Sr(a). ' . $result['nombre_tit'], 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem("Verificado el Sistema RUAT Inmuebles, Módulo Pagos, procedió al pago de la deuda tributaria por la gestión $gestion_fiscal en fecha XX de marzo de 202X, ingresando a favor del Gobierno Autónomo Municipal de El Alto Bs. XXX.- (XXX 00/100 Bolivianos).", 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem("Mediante nota de fecha XX de marzo de 202X, el Sr(a). " . $result['nombre_tit'] . ", presenta el Formulario 198-A,  Nº de Orden XXXXX, documento por el cual se evidencia que el contribuyente procedió al pago del Impuesto a la Propiedad de Bienes  Inmuebles por la gestión fiscal $gestion_fiscal  en fecha XX de agosto de XXXX, realizando el pago de Bs. 13- (Trece 00/100 Bolivianos).", 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem('De la verificación de Sistema RUAT Inmuebles, Módulo “Proforma”, NO presenta deuda tributaria por ninguna gestión.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem("De acuerdo a la verificación del Módulo “Pagos” del Sistema RUAT Inmuebles, el contribuyente procedió al pago del Impuesto a la Propiedad de Bienes Inmuebles e Impuesto Municipal a la Propiedad de Bienes Inmuebles por las gestiones fiscales $gestion_fiscal ; asimismo registra pagos previos por las gestiones fiscales $gestion_fiscal.", 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem('De acuerdo a verificación del Módulo “Tramites” del Sistema RUAT Inmuebles, se puede evidenciar que en fecha XX de noviembre de 20XX el contribuyente procedió a actualizar los Datos Técnicos del Inmueble', 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem("El impetrante, mediante Nota adjunta a la Hoja de Ruta $hoja_ruta, solicita a esta Administración Tributaria Municipal la ACCIÓN DE REPETICIÓN por lo cual se verifico el pago del Impuesto a la Propiedad de Bienes Inmuebles por la gestión fiscal $gestion_fiscal realizado en fecha XX de marzo de 202X, mismo que se encuentra registrado en el sistema RUAT; por otro lado, se evidencia el pago del Impuesto a la Propiedad de Bienes Inmuebles mediante el  Formulario 198-A,  Nº de Orden XXXXXX en fecha XX de agosto de 19XX, de acuerdo al siguiente detalle:", 0, null, 'myBulletStyle', $styleParrafoJustificadoDown);


            $phpWord->addFontStyle('font6', ['name' => 'Arial', 'size' => 6]);
            $phpWord->addFontStyle('font6Bold', ['name' => 'Arial', 'size' => 6, 'bold' => true]);
            $phpWord->addParagraphStyle('center', [
                'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
                'spaceBefore' => 0,
                'spaceAfter' => 0,
                'lineHeight' => 1
            ]);
            $phpWord->addParagraphStyle('left', [
                'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT,
                'spaceBefore' => 0,
                'spaceAfter' => 0,
                'lineHeight' => 1
            ]);


            $phpWord->addTableStyle('tablaPagos', [
                'borderSize' => 6,
                'borderColor' => '000000',
                'cellMargin' => 50,
            ]);

            $table = $section->addTable('tablaPagos');


            $table->addRow(0);
            $table->addCell(3000, ['vMerge' => 'restart'])->addText('DATOS', 'font6Bold', 'center');
            $table->addCell(3500, ['gridSpan' => 1])->addText('FORMULARIO 198-A GESTIÓN 1995', 'font6Bold', 'center');
            $table->addCell(3500, ['gridSpan' => 1])->addText('COMPROBANTE DE PAGO, GESTIÓN 2024', 'font6Bold', 'center');


            $table->addRow();
            $table->addCell(3000)->addText('GESTIÓN ADEUDADA', 'font6', 'left');
            $table->addCell(3500)->addText('1995', 'font6', 'center');
            $table->addCell(3500)->addText('1995', 'font6', 'center');


            $table->addRow();
            $table->addCell(3000)->addText('FECHA DE PAGO', 'font6', 'left');
            $table->addCell(3500)->addText('29/08/1996', 'font6', 'center');
            $table->addCell(3500)->addText('01/03/2024', 'font6', 'center');


            $table->addRow();
            $table->addCell(3000)->addText('MONTO DE PAGO', 'font6', 'left');
            $table->addCell(3500)->addText('Bs. 13.-', 'font6', 'center');
            $table->addCell(3500)->addText('Bs. 330.-', 'font6', 'center');


            $table->addRow();
            $table->addCell(3000)->addText('SUJETO PASIVO', 'font6', 'left');
            $table->addCell(3500)->addText('Bernardo Quispe Ramos', 'font6', 'center');
            $table->addCell(3500)->addText('Bernardo Quispe Ramos', 'font6', 'center');


            $table->addRow();
            $table->addCell(3000, ['vMerge' => 'restart'])->addText("DIRECCIÓN DEL INMUEBLE", 'font6', 'left');
            $table->addCell(3500, ['vMerge' => 'restart'])->addText('Complemento Calle C# 135, Mano C, Lote N° 4-A', 'font6', 'left');
            $table->addCell(3500, ['vMerge' => 'restart'])->addText('Urb. San Luis Tasa, Avenida Héroes del Pacífico # 135, Mano C, Lote N° 4-A', 'font6', 'left');

            $textrun = $section->addTextRun('parrafo');
            $textrun->addText("La tabla arriba descrita hace conocer que existen diferencias en el monto pagado en la gestión 1996 y 2024");

            $section->addListItem("De la revisión del Sistema RUAT Inmuebles “Módulo Observados”, se determina que el inmueble no registra observaciones", 0, null, 'myBulletStyle', $styleParrafoJustificadoDown);

            $section->addText('4.	CONCLUSIONES.', 'textoNegrita', 'subtitulo');
            $section->addText("En consideración a los antecedentes y análisis expuestos precedentemente se concluye lo siguiente:", 'textoNormal', 'parrafo');

            $textrun = $section->addTextRun('parrafo');
            $textrun->addText("El Sr(a). ");
            $textrun->addText($result['nombre_tit'] . " ", ['bold' => true]);
            $textrun->addText("solicita ", 'textoNormal', 'parrafo');
            $textrun->addText("ACCION DE REPETICION ", ['bold' => true]);
            $textrun->addText("de la gestión fiscal $gestion_fiscal del inmueble con registro tributario N° $registro, por lo cual la Administración Tributaria Municipal  verifico el pago  de Bs. XXX.- (XXX 00/100 Bolivianos) realizado en fecha XX de marzo de 202X en el sistema RUAT, asimismo se verifico el Formulario XXX-X de fecha XX de agosto de 199X  adjunto al expediente donde se evidencio el pago de la gestión fiscal $gestion_fiscal, por un total de Bs.13.-  (Trece 00/100 Bolivianos), también se verificó que el impetrante actualizo datos técnicos en fecha XX de noviembre de 201X, por lo cual corresponde disponer saldo a favor, según el siguiente detalle:", 'textoNormal', 'parrafo');

            $colWidth1 = 2000;
            $colWidth2 = 3500;

            $table = $section->addTable('miTablaEstilo');
            // --- Fila 1: Encabezados ---
            $table->addRow();
            $cell1 = $table->addCell($colWidth1, $headerCellStyle1);
            $cell1->addText('MONTO PAGADO POR ACCIÓN DE REPETICIÓN', 'font6Bold', 'center');

            $cell2 = $table->addCell($colWidth2, $headerCellStyle2);
            // Para el salto de línea dentro de la celda, usamos addTextBreak
            $cell2->addText("IMPUESTO MUNICIPAL A LA PROPIEDAD DE BIENES INMUEBLES REGISTRO Nº $registro", 'font6Bold', 'center');

            $table->addRow();
            $table->addCell($colWidth1, $cellStyleCol1)->addText('Bs. 330.-', $labelFontStyle, 'sinEspacio');
            $table->addCell($colWidth2, $cellStyleCol2)->addText('EL INMUEBLE NO TIENE DEUDAS A LA FECHA', $labelFontStyle, 'sinEspacio');


            $textrun = $section->addTextRun('parrafo');
            $textrun->addText("(*) FECHA DE PROFORMA XX/XX/202X ");

            $textrun = $section->addTextRun('parrafo');
            $textrun->addText("Es importante aclarar que habiéndose verificado el Sistema RUAT – INMUEBLES, Módulo “Proforma”, donde se evidencia que el registro tributario ");
            $textrun->addText("Nº $registro", ['bold' => true]);
            $textrun->addText(", no presenta deuda tributaria por ninguna gestión, por lo cual se deberá proceder a la devolución del saldo a favor del pago en exceso, mediante Resolución Administrativa otorgando saldo a favor del contribuyente a través de crédito fiscal en el inmueble con registro tributario ");
            $textrun->addText("Nº $registro.", ['bold' => true]);

            $section->addText('5.	RECOMENDACIONES', 'textoNegrita', 'subtitulo');

            $textrun = $section->addTextRun('parrafo');
            $textrun->addText("Se recomienda remitir al asesor legal de la Unidad de Asesoría Jurídica y Cobranza Coactiva para que proceda a  elaborar la Resolución Administrativa del inmueble con registro tributario ");
            $textrun->addText("Nº $registro ", ['bold' => true]);
            $textrun->addText("registrado a nombre del titular Sr(a). ");
            $textrun->addText($result['nombre_tit'] . " ", ['bold' => true]);
            $textrun->addText("tomando en cuenta las observaciones referidas en el presente informe y disponer lo que en derecho corresponda.");

            break;
        }
    case '4': {

            $section->addText('3.	CONSIDERACIONES.', 'textoNegrita', 'subtitulo');
            $section->addText("3.1.	DATOS REGISTRADOS EN EL SISTEMA RUAT REGISTRO TRIBUTARIO Nº $registro. (BAJA)", 'textoNegrita', 'subtitulo');

            $section->addListItem("Según Sistema RUAT-Inmuebles, el inmueble fue empadronado como Propiedad Única en fecha " . $result['fecha_empadronamiento'] . ", a nombre del Sr(a). " . $result['nombre_tit'] . ", con una superficie de " . $result['superficie_terreno'] . " mts2.", 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem("Según Sistema RUAT-Inmuebles Modulo Observados, no registra observaciones activas por ninguna gestión fiscal.", 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem("De acuerdo a verificación de pagos según Módulo Consultas-Pagos, registra Pago del Impuesto a la Propiedad de Bienes Inmuebles e Impuesto Municipal a la Propiedad de Bienes Inmuebles por las gestiones fiscales $gestion_fiscal, además presenta el registro de pagos previos por las gestiones fiscales $gestion_fiscal.", 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem("Según sistema RUAT-Inmuebles, Módulo Liquidación-Proforma, registra deuda tributaria por las gestiones fiscales $gestion_fiscal y obligación tributaria por la gestión fiscal $gestion_fiscal.", 0, null, 'myBulletStyle', $styleParrafoJustificado);


            $section->addText("3.2.	DATOS REGISTRADOS EN EL SISTEMA RUAT REGISTRO TRIBUTARIO Nº $registro (VIGENTE).", 'textoNegrita', 'subtitulo');
            $section->addListItem("Según Sistema RUAT-Inmuebles, el inmueble fue empadronado como Propiedad Única en fecha " . $result['fecha_empadronamiento'] . ", a nombre de la Sr(a). " . $result['nombre_tit'] . ", asimismo es importante aclarar que mediante Testimonio N° XXX/XXXX de fecha XX de agosto de 20XX el(la) Sr(a). XXXXXXXX y YYYYYYYYY legítimos propietarios de un lote de terreno ubicado en " . $result['direccion'] . " con una superficie de " . $result['superficie_terreno'] . " mts2 resuelven proceder a la División y Partición e individualización del Lote de Terreno  de la siguiente forma: XXXXXXX.", 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem("Según Sistema RUAT-Inmuebles Modulo Observados, el inmueble no registra observaciones por ninguna gestión fiscal.", 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem("De acuerdo a verificación de pagos según Módulo Consultas-Pagos, se registra el Pago del Impuesto a la Propiedad de Bienes Inmuebles e Impuesto Municipal a la Propiedad de Bienes Inmuebles por las gestiones fiscales $gestion_fiscal.", 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem("Según sistema RUAT-Inmuebles, Módulo Liquidación-Proforma, registra deuda tributaria por la gestión fiscal $gestion_fiscal, y obligación tributaria por la gestión fiscal $gestion_fiscal.", 0, null, 'myBulletStyle', $styleParrafoJustificado);



            $section->addText("3.3.	DATOS REGISTRADOS EN EL SISTEMA RUAT REGISTRO TRIBUTARIO Nº $registro (VIGENTE).", 'textoNegrita', 'subtitulo');
            $section->addListItem("Según Sistema RUAT-Inmuebles, el inmueble fue empadronado como Propiedad Única en fecha " . $result['fecha_empadronamiento'] . ", a nombre de la Sr(a). " . $result['nombre_tit'] . ", asimismo es importante aclarar que mediante Testimonio N° XXX/XXXX de fecha XX de agosto de 20XX el(la) Sr(a). XXXXXXXX y YYYYYYYYY legítimos propietarios de un lote de terreno ubicado en " . $result['direccion'] . " con una superficie de " . $result['superficie_terreno'] . " mts2 resuelven proceder a la  División y Partición e individualización del Lote de Terreno  de la siguiente forma: XXXXXXX.", 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem("Según Sistema RUAT-Inmuebles Modulo Observados, el inmueble no registra observaciones por ninguna gestión fiscal.", 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem("De acuerdo a verificación de pagos según Módulo Consultas-Pagos, se registra el Pago del Impuesto a la Propiedad de Bienes Inmuebles e Impuesto Municipal a la Propiedad de Bienes Inmuebles por las gestiones fiscales $gestion_fiscal.", 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem("Según sistema RUAT-Inmuebles, Módulo Liquidación-Proforma, no registra deuda tributaria por ninguna gestión fiscal.", 0, null, 'myBulletStyle', $styleParrafoJustificado);

            $section->addText('4.	INFORME DEL ÁREA TÉCNICA PREDIAL Nro. XXX/202X.', 'textoNegrita', 'subtitulo');

            $textrun = $section->addTextRun('parrafo');
            $textrun->addText("Con el objeto de determinar si los Registros Tributarios ");
            $textrun->addText("Nº $registro ", ['bold' => true]);
            $textrun->addText("(VIGENTE) y ");
            $textrun->addText("Nº $registro ", ['bold' => true]);
            $textrun->addText("(BAJA) corresponden a un mismo predio, la Unidad de Fiscalización y Recaudaciones mediante el Área Técnica Predial (ATP) procedió a realizar la inspección externa al inmueble con registro tributario Nº $registro, producto del cual en fecha XX de julio de 202X se emite el Informe Técnico Predial N° XXX/202X, el cual señala: ");
            $textrun->addText("“(… ) El inmueble con registro Tributario ", ['italic' => true]);
            $textrun->addText("Nº $registro ", ['italic' => true, 'bold' => true]);
            $textrun->addText("(VIGENTE) es parte del inmueble ", ['italic' => true]);
            $textrun->addText("Nº $registro ", ['italic' => true, 'bold' => true]);
            $textrun->addText("(BAJA) por tanto son el mismo predio (…)”.", ['italic' => true]);

            $section->addText('5.	CONCLUSIONES', 'textoNegrita', 'subtitulo');
            $textrun = $section->addTextRun('parrafo');
            $textrun->addText("Por todo lo expuesto en el análisis técnico referente a la solicitud de BAJA POR DOBLE EMPADRONAMIENTO del INMUEBLE con Registro Tributario ");
            $textrun->addText("Nº $registro ", ['bold' => true]);
            $textrun->addText("(BAJA) con los registros tributario ");
            $textrun->addText("Nº $registro ", ['bold' => true]);
            $textrun->addText("(VIGENTE) y Registro Tributario ");
            $textrun->addText("Nº $registro ", ['bold' => true]);
            $textrun->addText("(VIGENTE), corresponde señalar lo siguiente:");

            $listItemRun = $section->addListItemRun(0, 'myBulletStyle', $styleParrafoJustificado);

            $listItemRun->addText("El Sr(a). " . $result['nombre_tit'] . ", se empadronó, ante esta Dirección de Administración Tributaria Municipal en " . $result['fecha_empadronamiento'] . ", con una superficie de " . $result['superficie_terreno'] . " mts2, sin embargo, de acuerdo a Informe Técnico Predial N° 00XXX/202X de fecha XX de julio de 202X, emitido por el Área Técnica Predial, señala: ");
            $listItemRun->addText("“… El inmueble con registro Tributario ", ['italic' => true]);
            $listItemRun->addText("Nº $registro ", ['italic' => true, 'bold' => true]);
            $listItemRun->addText("(VIGENTE) es parte del inmueble ", ['italic' => true]);
            $listItemRun->addText("Nº $registro ", ['italic' => true, 'bold' => true]);
            $listItemRun->addText("(BAJA) por tanto son el mismo predio (…)”. ", ['italic' => true]);
            $listItemRun->addText("Por otra parte, el Informe Técnico Predial N° 00XXX/202X de fecha XX de julio de 202X, emitido por el Área Técnica Predial, señala:");
            $listItemRun->addText("“… El inmueble con registro Tributario Nº $registro (VIGENTE) es parte del inmueble Nº $registro (BAJA) por tanto son el mismo predio (…)”.", ['italic' => true]);

            $listItemRun = $section->addListItemRun(0, 'myBulletStyle', $styleParrafoJustificado);
            $listItemRun->addText("Asimismo, el CERTIFICADO NACIONAL (GENERAL) emitido por la oficina de Derechos Reales, señala: ");
            $listItemRun->addText("“(…) Que, a la fecha de la revisión de los datos de registro de Derechos Reales correspondientes al ámbito nacional, consta que: ", ['italic' => true]);
            $listItemRun->addText("SI ", ['italic' => true, 'bold' => true]);
            $listItemRun->addText("se tiene registrado o inscrito derecho propietario sobre inmuebles, a nombre de:  " . $result['nombre_tit'] . " con  " . $result['tipo_documento'] . " " . $result['documento_identidad'] . " " . $result['expedido'] . " bajo Partidas (s) o Matriculas (s): 20109900XXXXX en ciudad de La Paz (NSC), 207010000XXXX en Apolo (Bella Vista) y 207101000XXXXX en Apolo (ACC. Y DERE 72.000HAS, BELA VISTA) (…)” ", ['italic' => true]);
            $listItemRun->addText("cursante en (foja XXX)");

            $section->addText('6.	RECOMENDACIÓN', 'textoNegrita', 'subtitulo');

            $textrun = $section->addTextRun('parrafo');
            $textrun->addText("Por tanto, se recomienda remitir al asesor legal de la Unidad de Asesoría Legal y Cobranza Coactiva para que proceda a elaborar la Resolución Administrativa de Baja por Doble Empadronamiento con Registro Tributario ");
            $textrun->addText("Nº $registro ", ['bold' => true]);
            $textrun->addText("(BAJA), tomando en cuenta el presente informe.");

            break;
        }
    case '5': {

            $section->addText('3.	CONSIDERACIONES.', 'textoNegrita', 'subtitulo');
            $section->addText("3.1.	DATOS REGISTRADOS EN EL SISTEMA RUAT, REGISTRO TRIBUTARIO Nº $registro. (BAJA)", 'textoNegrita', 'subtitulo');

            $section->addListItem("El inmueble fue empadronado como propiedad única en fecha " . $result['fecha_empadronamiento'] . " a nombre de " . $result['nombre_tit'] . ", en fecha XX de octubre de 20XX se realiza una Transferencia Especial por Declaratoria de Herederos en favor del Sr. XXXXX,  en la misma fecha se registra la Transferencia por Compra Venta al Sr. YYYY.", 0, null, 'myBulletStyle', $styleParrafoJustificado);
            $section->addListItem("El Área Técnica Predial informa que los datos técnicos del inmueble N° $registro se encuentran actualizados (foja XX).", 0, null, 'myBulletStyle', $styleParrafoJustificado);


            $section->addText("3.2. Respecto a la solicitud de descuento", 'textoNegrita', 'subtitulo');
            $section->addListItem("La Ley Autonómica Municipal N°12 LEY MUNICIPAL AUTONÓMICA DE COMPLEMENTACIÓN, DE MODIFICACIÓN Y ENMIENDA A LA LEY MUNICIPAL Nº 003/2012, DE CREACIÓN DE IMPUESTOS MUNICIPALES en su Artículo 5 modifica el Artículo 7 de la Ley Municipal N° 003/2012, donde en su inciso c) señala: “(…) Las personas de 60 o más años, propietarias de inmuebles de interés social o de tipo económico que le sirva de vivienda permanente, tendrán una rebaja del 20% en el impuesto, hasta el límite del primer tramo contemplado en la escala establecida en el Artículo 11. Como condición para el goce de esta exención, los beneficiarios deberán solicitar la declaratoria de exención ante la Administración Tributaria anualmente (…)”. A efectos de dar cumplimiento a lo señalado precedentemente deberá cumplir ante esta Administración Tributaria Municipal con los REQUISITOS PARA TRAMITES ADMINISTRATIVOS DE INMUEBLES establecidos conforme dispone la RESOLUCION ADMINISTRATIVA DRPT/No. 006/2022, de acuerdo al siguiente detalle:", 0, null, 'myBulletStyle', $styleParrafoJustificadoEspaciadoDown);

            $section->addText('3.	RECOMENDACIONES.', 'textoNegrita', 'subtitulo');

            $textrun = $section->addTextRun('parrafo');
            $textrun->addText("Por tanto, se recomienda declarar la procedencia de la pretensión de descuento por tercera edad, invocado por el contribuyente Sr(a). ");
            $textrun->addText($result['nombre_tit'], ['bold' => true]);
            $textrun->addText(", asimismo sea remitido al asesor legal de la Unidad de Asesoría Jurídica y Cobranza Coactiva, para la emisión de la Resolución Administrativa.");

            $table = $section->addTable('miTablaEstilo');
            // Fila del encabezado
            $table->addRow();
            $cell = $table->addCell(7000, ['gridSpan' => 1, 'valign' => 'center'],  [
                'spaceAfter' => 0,
                'spaceBefore' => 0,
                'lineHeight' => 1
            ]);
            $cell->addText(
                'EXENCIONES PERSONAS DE 60 AÑOS O MAS (TERCERA EDAD)',
                ['bold' => true, 'size' => 9],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
            );

            // Lista de requisitos
            $requisitos = [
                'Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).',
                'Testimonio de Propiedad. (compra y venta).',
                'Folio Real y/o Tarjeta de Registro de Propiedad.',
                'Certificado de vivencia actualizado (cuando corresponda).',
                'Plano de Lote.',
                'Plano de Construcción o fotos (en caso de construcciones grandes).',
                'Cédula de Identidad del Propietario.'
            ];

            // Agregar filas con viñetas
            foreach ($requisitos as $item) {
                $table->addRow();
                $table->addCell(7000)->addText('•    ' . $item, ['size' => 9], [
                    'spaceAfter' => 0,
                    'spaceBefore' => 0,
                    'lineHeight' => 1
                ]);
            }

            $section->addListItem("Según consulta de datos técnicos en el sistema RUAT inmuebles se verifica lo siguiente: \n  El inmueble tiene una superficie de " . $result['superficie_terreno'] . " m2, cuenta con XXXXXXXX de tipología *Económica*. En base a lo detallado en los datos técnicos se establece que el inmueble cuenta con las características técnicas requeridas para el beneficio de descuento del 20% del Impuesto Municipal a la Propiedad de Bienes Inmuebles", 0, null, 'myBulletStyle', $styleParrafoJustificadoEspaciadoTop);

            $section->addText('4.	CONCLUSIONES', 'textoNegrita', 'subtitulo');
            $textrun = $section->addTextRun('parrafo');
            $textrun->addText("Por lo expuesto en el análisis técnico referente a la solicitud de descuento por tercera edad (20%) del Impuesto Municipal a la Propiedad de Bines Inmuebles, del registro ");
            $textrun->addText("Nº $registro ", ['bold' => true]);
            $textrun->addText("nombre de " . $result['nombre_tit'] . " corresponde señalar lo siguiente: ");

            $section->addListItem("El impetrante en calidad de titular del inmueble, solicita el descuento del 20% sobre el Impuesto Municipal a la Propiedad de Bienes Inmuebles, lo cual está contemplado en la normativa legal vigente como descuento para contribuyentes de 60 años o más, concluyendo que la contribuyente cumple con las condiciones para gozar de este beneficio al contar con un bloque de construcción de tipología Económica, lo cual confirma el Área Técnica Predial en foja XXX, que el inmueble estaría con los datos técnicos actualizados.", 0, null, 'myBulletStyle', $styleParrafoJustificado);

            $section->addText('5.	RECOMENDACIONES', 'textoNegrita', 'subtitulo');

            $textrun = $section->addTextRun('parrafo');
            $textrun->addText("Por tanto, se recomienda declarar la procedencia de la pretensión de descuento por tercera edad, invocado por el contribuyente Sr(a). ");
            $textrun->addText($result['nombre_tit'], ['bold' => true]);
            $textrun->addText(", asimismo sea remitido al asesor legal de la Unidad de Asesoría Jurídica y Cobranza Coactiva, para la emisión de la Resolución Administrativa.");

            break;
        }
}

$section->addText("Es por cuanto tengo a bien informar para los fines consiguientes.", 'textoNormal', 'parrafo');

$section->addText("", 'textoNormal', 'subtitulo');
$section->addText("C.c. Arch Unidad", 'anotacion', 'sinEspacio');
$section->addText("Expediente/", 'anotacion', 'sinEspacio');
$section->addText("$sigla_usuario/", 'anotacion', 'sinEspacio');

// SALIDA DEL DOCUMENTO
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment;filename="Informe_tecnico.docx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($phpWord, 'Word2007');
$writer->save('php://output');
exit;


function obtenerFecha()
{
    $dia = date('d');
    $mes = date('n');
    $anio = date('Y');
    $mes_ = '';
    $meses = array(
        1 => 'enero',
        2 => 'febrero',
        3 => 'marzo',
        4 => 'abril',
        5 => 'mayo',
        6 => 'junio',
        7 => 'julio',
        8 => 'agosto',
        9 => 'septiembre',
        10 => 'octubre',
        11 => 'noviembre',
        12 => 'diciembre'
    );
    if ($mes < 1 || $mes > 12) {
        $mes_ =  'Mes inválido';
    }
    $mes_ = $meses[$mes];
    return "$dia de $mes_ de $anio";
}
