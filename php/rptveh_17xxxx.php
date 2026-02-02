<?php
require '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

require_once("conexionpsql.php");
require_once("getInfoUnivRpt.php");

foreach ($_GET as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$conn = new Conexion();
$cons = $conn->conectar();

$html2pdf = new Html2Pdf();

try {

    $resultados = getInfoVeh10_11Rpt($cons, $ci_);
    $detalleVehiculo = '<table align="center" style="text-align:center;width: 100%; border-collapse: collapse; margin: 0 0 0 15px;">';
    $cssAux_ = 'style=" border: 1px solid #A9A9A9;padding: 5px; text-align: left; "';
    $auxCnt = 0;
    $nomAp = '';
    foreach ($resultados as $row) {
        $apll = $row['primer_apellido_sigla'] . " " . $row['segundo_apellido'] . " " . $row['apellido_esposo'];
        $nombre = $row['nombre_rsocial'];
        $tipo_documento = $row['tipo_documento'];
        $ci_ = $row['documento_identidad'];
        $detalleVehiculo .= '<tr><td ' . $cssAux_ . '>' . $row['nro_pta'] . '</td><td ' . $cssAux_ . '>:</td><td ' . $cssAux_ . '>' . $row['clase'] . ', ' . $row['TIPO_COMBUSTIBLE'] . ', ' . $row['MARCA'] . ' ' . $row['TIPO'] . '</td></tr>';
        if ($row['DOCUMENTO_IDENTIDAD_APO'] != '' && $row['DOCUMENTO_IDENTIDAD_APO'])
            $nomAp = ', con apoderado: ' . $row['NOMBRE_APO'] . ' ' . $row['primer_apellido_apo'] . ' ' . $row['segundo_apellido_apo'] . ' con ' . $row['tipo_documento_APO'] . ':' . $row['DOCUMENTO_IDENTIDAD_APO'];
        $auxCnt++;
    }
    $txtPlural = ' del vehiculo ';
    if ($auxCnt > 1)
        $txtPlural = ' de los vehiculos ';

    $detalleVehiculo .= '</table>';
    if ($apll)
        $nombre .= " " . $apll;

    $documento = "
        <style type='text/css'>
            ul.main { width: 95%; list-style-type: square; }
            ul.main li { padding-bottom: 2mm; }
        </style> 
        
        <!--136=14cm y 210=21.5cm--> 
    ";

    $documento .= " 
        <page format='272x210' style='font: arial; color: #222222;'>
            <div style='margin:55px;'>
                <div style='text-align: right; margin-bottom: 20px;'>
                    <p>El Alto - Bolivia, <span id='fechaActual'>" . date("d") . " de " . $conn->obtenerNombreMes(intval(date("m"))) . " de " . date("Y") . "</span></p>
                </div>
                <div style='margin-bottom: 20px;'>
                    <p>Señor:</p>
                    <p>Ing. Veronica Judith Mancilla Nina<br>
                    Director de Administración Tributaria Municipal de El Alto<br>
                    GOBIERNO AUTONOMO MUNICIPAL DE EL ALTO</p>
                    <p>Presente:</p>
                </div>
                <div style='text-align: right; margin-bottom: 20px;'>
                    <span style='text-decoration:underline;'><b>REF.: SOLICITUD DE PRESCRIPCIÓN</b></span>
                </div>
                <div style='text-align: justify;'>
                    <p>Mediante la presente tengo a bien saludar a su autoridad y desearle éxitos en la función que desempeña.</p>

                    <p>El motivo por el cual me dirijo a su autoridad es para solicitarle muy respetuosamente pueda instruir a quien corresponda LA PRESCRIPCION DE LA DEUDA TRIBUTARIA de $txtPlural:</p>

                    $detalleVehiculo 
                    
                    <p>Registrado a nombre de: $nombre $nomAp, correspondientes a las gestiones desde $gestionIni_ hasta $gestionFin_, lo cual se detalla en el documento.</p>
                    <p>Sin otro particular me despido de usted esperando una respuesta favorable a nuestra petición.</p>
                    <p>Atentamente,</p>
                    <p></p>
                    </div>
                </div>
                <table style='text-align: center; border-top: solid 1px; width: 35%' align='center'><tr><td style='width: 100%'>
                    $nombre<br>
                    " . $tipo_documento . " $ci_</td></tr>
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

    $html2pdf->writeHTML($documento);

    $path = '/static/solicitudes/' . $numInmueble_ . rand(111, 999) . '.pdf';
    $html2pdf->Output();
} catch (PDOException $e) {
    echo "Error al ejecutar la consulta: " . $e->getMessage();
}
