<?php
require '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

require_once("conexionpsql.php");

foreach ($_GET as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$conn = new Conexion();
$cons = $conn->conectar();

try {
    /* $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC); */
    $row = array();
    $row['nombre_rsocial'] = $nombre_;
    $row['NUMERO_INMUEBLE'] = $numInmueble_;
    $row['LOTE_PLANO'] = $numlote_;
    $row['MANZANO_PLANO'] = $manzano_;
    $row['DIRECCION_DESCRIPTIVA'] = $ubicacion_;
    $row['SUPERFICIE_TERRENO'] = $superficie_;
    $row['tipo_documento'] = $tipodoc_;

    $documento = "
        <style type='text/css'>
            ul.main { width: 95%; list-style-type: square; }
            ul.main li { padding-bottom: 2mm; }
        </style> 
    ";
    /* $apll = $row['primer_apellido_sigla'] . " " . $row['segundo_apellido'] . " " . $row['apellido_esposo']; */
    $nombre = $row['nombre_rsocial'];
    /* if ($apll)
        $nombre .= " " . $apll; */
    $documento .= "
            <page format='272x210' style='font: arial; color: #222222;'>
            <!--136=14cm y 210=21.5cm--> 
            <div style='margin:55px;'>
                <div style='text-align: right; margin-bottom: 20px;'>
                    <p>El Alto - Bolivia, <span id='fechaActual'>" . date("d") . " de " . $conn->obtenerNombreMes(intval(date("m"))) . " de " . date("Y") . "</span></p>
                </div>
                <div style='margin-bottom: 20px;'>
                    <p>Señor:</p>
                    <p>Lic. Jhon Villalba Camacho<br>
                    Director de Administración Tributaria Municipal de El Alto<br>
                    GOBIERNO AUTONOMO MUNICIPAL DE EL ALTO</p>
                    <p>Presente:</p>
                </div>
                <div style='text-align: right; margin-bottom: 20px;'>
                    <span style='text-decoration:underline;'><b>REF.: SOLICITUD DE EMPADRONAMIENTO POR POSESIÓN</b></span>
                </div>
                <div style='text-align: justify;'>
                    <p>Mediante la presente carta, me dirijo a su autoridad, para solicitar de acuerdo a derecho el empadronamiento del lote de terreno o bien inmueble:</p>

                    <ul class='main'>
                        <li>Número de inmueble: " . $row['NUMERO_INMUEBLE'] . "</li>
                        <li>Número lote: " . ($row['LOTE_PLANO'] ? $row['MANZANO_PLANO'] : $row['DIRECCION_DESCRIPTIVA']) . "</li>
                        <li>Manzano: " . ($row['MANZANO_PLANO'] ? $row['MANZANO_PLANO'] : 'NN') . "</li>
                        <li>Superficie terreno: " . $row['SUPERFICIE_TERRENO'] . "[m2]</li>
                        <li>Ubicación: " . $row['DIRECCION_DESCRIPTIVA'] . "</li>
                    </ul> 
                    <p>Con el compromiso de presentación de todos los requisitos solicitados</p>
                    <p>Atentamente,</p>
                    <p></p>
                    </div>
                </div>
                <table style='text-align: center; border-top: solid 1px; width: 35%' align='center'><tr><td style='width: 100%'>
                    $nombre<br>
                    " . $row['tipo_documento'] . " $ci_</td></tr>
                </table> 
            ";

    $footer = "Se autoriza la notificación por medio telemático al número de contacto $contacto_ ";
    if ($correo_)
        $footer .= " o al correo electrónico $correo_";
    $footer .= " , conforme al Art. 83 Bis, de la Ley No 2492 (CTB)";

    $documento .= '<page_footer>
            <table style="width: 100%; font-size:11px; color:##515151; ">
                <tr>
                    <td style="text-align: left; padding:0 10px 0 20px;width: 100%;"> 
                        ' . $footer . '
                        </td>
                    </tr>
                </table>
            </page_footer>';


    $documento .= "</page>";
    /* if($resultados){ */
    $path = '/static/solicitudes/' . $numInmueble_ . rand(111, 999) . '.pdf';
    /* echo $documento; */
    $html2pdf = new Html2Pdf();
    $html2pdf->writeHTML($documento);
    $html2pdf->Output();
    /* }else  
        echo "NH"; */
} catch (PDOException $e) {
    echo "Error al ejecutar la consulta: " . $e->getMessage();
}
