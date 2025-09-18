<?php
require_once '../vendor/autoload.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\SimpleType\TblWidth;
use PhpOffice\PhpWord\Style\Table as TableStyle;

// VARIABLES DINÁMICAS
$registro = '1510299757';
$hojaRuta = 'DATM/585/585';
$operador = 'Lic. Delma Fátima García Martínez';

// INICIALIZAR DOCUMENTO
$phpWord = new PhpWord();
$phpWord->getSettings()->setThemeFontLang(new \PhpOffice\PhpWord\Style\Language('es-BO'));
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
    'lineHeight' => 1.5
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
$section->addText("DATM/UAJ-CC /ITL-INM/Nº 221/2025", ['bold' => true, 'name' => 'Times New Roman', 'size' => 12], [
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
$table->addCell(8000)->addText("$operador", 'textoNormal', 'sinEspacio');

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
$table->addCell(8000)->addText("BAJA POR NO POSESIÓN \nREGISTRO TRIBUTARIO Nº $registro", 'textoNegrita');

$table->addRow();
$table->addCell(2000)->addText("FECHA", 'textoNegrita', 'sinEspacioIdentado');
$table->addCell(1000)->addText(":", 'textoNegrita', 'sinEspacio');
$table->addCell(8000)->addText("El Alto, 29 de abril de 2024", 'textoNormal');

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
    'gridSpan' => 2, // Hacer que la celda ocupe 2 columnas
    'valign' => 'center',
];
$footerParagraphStyle = [
    'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT,
    'spaceAfter' => 0,
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
$cell2->addText('INMUEBLE: 1515151525', $headerFontStyle2, $headerParagraphStyle2);
$cell2->addText('(BAJA)', $headerFontStyle2, $headerParagraphStyle2);


// --- Filas de Datos ---
$labels = [
    "CONTRIBUYENTES:",
    "P.M.C. (titular):",
    "DOMICILIO LEGAL:",
    "DIRECCION INMUEBLE:",
    "SUPERFICIE DEL TERRENO:",
    "SUPERFICIE CONSTRUIDA"
];

$labelFontStyle = ['name' => 'Times New Roman', 'size' => 8]; // Estilo para las etiquetas

foreach ($labels as $label) {
    $table->addRow();
    $table->addCell($colWidth1, $cellStyleCol1)->addText($label, $labelFontStyle, 'sinEspacio');
    // Añadir celda vacía en la segunda columna
    $table->addCell($colWidth2, $cellStyleCol2)->addText('', $labelFontStyle, 'sinEspacio');
}

// --- Fila Final: FUENTE ---
$table->addRow();
$cellFuente = $table->addCell($colWidth1 + $colWidth2, $footerCellStyle); // La celda ocupa el ancho total
$cellFuente->addText(
    'FUENTE: Extraído del Sistema RUAT-Inmuebles.',
    $footerFontStyle,
    $footerParagraphStyle
);

/**
 * 
    FIN TABLA
 */

$styleParrafoJustificado = [
    'alignment' => Jc::BOTH, 
    'spaceAfter' => 0,
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


$textrun = $section->addTextRun('parrafo'); 
$textrun->addText("Mediante nota presentada en fecha de 17 de septiembre de 2024 (cursante en foja 4), notas complementarias presentadas en fecha 03 de octubre de 2023 (cursante en foja 19) y 08 de octubre de 2024 (cursante en foja 21), presentadas ante esta Dirección de Administración Tributaria Municipal por ABEL GARCIA LAURA con CI 3325341 L.P., quien solicita la ");
$textrun->addText("BAJA POR NO POSESIÓN", ['bold' => true]);   
$textrun->addText(" del Inmueble con Registro Tributario N°1510299757, a tal efecto el impetrante presenta la siguiente documentación:");




$section->addListItem('Original del CERTIFICADO NACIONAL (GENERAL), emitida por Derechos Reales.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
$section->addListItem('Fotocopia simple de comprobante de pago de impuesto del inmueble con Registro Tributario N°', 0, null, 'myBulletStyle', $styleParrafoJustificado);
$section->addListItem('Fotocopia simple de Cédula de Identidad.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
$section->addListItem('Original Declaración Voluntaria Notariada.', 0, null, 'myBulletStyle', $styleParrafoJustificado);

$section->addText('3.	CONSIDERACIONES.', 'textoNegrita', 'subtitulo');
$section->addText('3.1.	DATOS REGISTRADOS EN EL SISTEMA RUAT REGISTRO TRIBUTARIO Nº  (BAJA).', 'textoNegrita', 'subtitulo');

$section->addListItem('Según Sistema RUAT-Inmuebles, el inmueble fue empadronado como propiedad única en fecha 16 de diciembre de 2002, a nombre de ABEL GARCIA LAURA.', 0, null, 'myBulletStyle', $styleParrafoJustificado);
$section->addListItem('De acuerdo a verificación de pagos según Módulo Consultas-Pagos, se registra pagos por concepto del Impuesto a la Propiedad de Bienes Inmuebles e Impuesto Municipal a la Propiedad de Bienes Inmuebles por las gestiones fiscales 2001 al 2023', 0, null, 'myBulletStyle', $styleParrafoJustificado);
$section->addListItem('Según sistema RUAT-Inmuebles, Módulo Liquidación-Proforma, no presenta deuda tributaria por ninguna gestión fiscal (cursante en fojas 22).', 0, null, 'myBulletStyle', $styleParrafoJustificado);

$section->addText('4.	ANTECEDENTES DE EMPADRONAMIENTO.', 'textoNegrita', 'subtitulo');

$section->addText("De la revisión de los antecedentes administrativos proporcionados por el Área de Archivo, 
dependiente del Área de Gestión Administrativa del inmueble con Registro Tributario N°1510299757 (BAJA), 
se determina la existencia de ANTECEDENTES DE EMPADRONAMIENTO, (cursante en fojas 5 al 11). ", 'textoNormal', 'parrafo');

$section->addText('5.	NOTIFICACION DE ACTOS ADMINISTRATIVOS POR LA DATM.', 'textoNegrita', 'subtitulo');
$section->addText("La Administración Tributaria Municipal emite PROVEIDO DATM/UAJ-CC/N° 1054/2024 de fecha 04 de octubre de 2024, 
notificado de manera Personal en fecha 07 de octubre de 2024, dando respuesta a notas presentadas en fecha de 17 de septiembre de 2024, 
nota complementaria presentada en fecha 03 de octubre de 2023; solicitando a ABEL GARCIA LAURA la presentación de: 1) 
Declaración Jurada ante un Notario de Fe Pública. 2) Nota de solicitud expresa dirigida al Director de la Administración 
Tributaria Municipal (Abg. Ivan Puña Aguilar), referencia Baja por NO POSESIÓN, en respuesta mediante nota de fecha 08 de 
octubre de 2024, el contribuyente presenta su Declaración Jurada ante un notario de fe pública referente al inmueble con Registro 
Tributario N°1510299757.", 'textoNormal', 'parrafo');

$section->addText('6.	CONCLUSIONES.', 'textoNegrita', 'subtitulo');
$section->addText("Por todo lo expuesto en el análisis técnico referente a la solicitud de BAJA POR NO POSESION del Registro Tributario N°1510299757 (BAJA), corresponde señalar lo siguiente:", 'textoNormal', 'parrafo');

$section->addListItem('El Sr. ABEL GARCIA LAURA, se empadronó ante esta Dirección de Administración Tributaria Municipal en fecha 16 de diciembre de 2002', 0, null, 'myBulletStyle', $styleParrafoJustificado);


$listItemRun = $section->addListItemRun(0, 'myBulletStyle', $styleParrafoJustificado);

$listItemRun->addText("Asimismo, CERTIFICADO NACIONAL (GENERAL) emitido por la oficina de Derechos Reales, señala: ");
$listItemRun->addText("“(…) Que, a la fecha de la revisión de los datos de registro de Derechos Reales correspondientes al ámbito nacional, consta que:", ['italic' => true]);
$listItemRun->addText(" NO ", ['bold' => true, 'italic' => true]);
$listItemRun->addText("se tiene registrado o inscrito derecho propietario sobre inmuebles, a nombre de:  ABEL GARCIA LAURA con C.I.  3325341 LP, (…)”", ['italic' => true]);
$listItemRun->addText(" cursante en (foja 1).");


$listItemRun = $section->addListItemRun(0, 'myBulletStyle', $styleParrafoJustificado);

$listItemRun->addText("Mediante Declaración Voluntaria notariada el Sr. ABEL GARCIA LAURA con C.I.  3325341 LP, señala: ");
$listItemRun->addText("“(…) de mi libre y espontánea voluntad, sin presión, error, dolo u otro vicio que invalide mi consentimiento, DECLARO VOLUNTARIAMENTE QUE NO ME ENCUENTRO EN POSESION del bien inmueble ubicado CALLE SUCRE N° 5125, URBANIZACIÓN, LOTE 23, MANZANO C, COMUNIDAD URB. 2 DE FEBERO, JUNTHUMA, registrado, con una superficie de 151.90 m2 con numero de inmueble 1510299757 (…)”", ['italic' => true]);

$section->addText("En conclusión, corresponde proseguir el tramite como Baja por No Posesión, toda vez que el Sr. ABEL GARCIA LAURA titular el inmueble con Registro Tributario N°1510299757 (BAJA) se ve imposibilitado de presentar documentación del inmueble vigente y por otro lado la Administración Tributaria Municipal agoto todas las instancias administrativas", 'textoNormal', 'parrafo');

$section->addText('7.	RECOMENDACION.', 'textoNegrita', 'subtitulo');
$section->addText("Por tanto, se recomienda remitir al asesor legal de la Unidad de Asesoría Legal y Cobranza Coactiva para que proceda a elaborar la Resolución Administrativa de Baja por No Posesión del Registro Tributario N°1510299757 (BAJA), tomando en cuenta las observaciones referidas en el presente informe", 'textoNormal', 'parrafo');
$section->addText("Es por cuanto tengo a bien informar para los fines consiguientes.", 'textoNormal', 'parrafo');

$section->addText("", 'textoNormal', 'subtitulo');
$section->addText("C.c. Arch Unidad", 'anotacion', 'sinEspacio');
$section->addText("Expediente/", 'anotacion', 'sinEspacio');
$section->addText("USUARIO/", 'anotacion', 'sinEspacio');

// SALIDA DEL DOCUMENTO
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment;filename="Informe_Baja_No_Posesion.docx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($phpWord, 'Word2007');
$writer->save('php://output');
exit;
