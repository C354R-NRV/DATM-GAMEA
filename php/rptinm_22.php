<?php
require '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

require_once("conexionpsql.php");
require_once("getInfoUnivRpt.php");

foreach ($_GET as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
// $nombreRegularizado   --> sera una variable enviada desde el formulario, que representa el nuevo nombre a ser regularizado
/**
 * en el formulario se solicitara el numero de inmueble, CI del titular y nombre a ser regularizado
 */

$conn = new Conexion();
$cons = $conn->conectar();

try {
    $resultados = getInfoInmuebleRpt($cons, $ci_, $numInmueble_);

    $documento = "
    <style type='text/css'>
        ul.main { width: 95%; list-style-type: square; }
        ul.main li { padding-bottom: 2mm; }
    </style> 
    ";
    foreach ($resultados as $row) {
        $apll = $row['primer_apellido_sigla'] . " " . $row['segundo_apellido'] . " " . $row['apellido_esposo'];
        $nombre = $row['nombre_rsocial'];
        $DIRECCION_DESCRIPTIVA = $row['DIRECCION_DESCRIPTIVA'];
        $NUMERO_PUERTA = $row['NUMERO_PUERTA'];
        $UBICACION_NIVEL2 = $row['AUXDIRECCION'];
        $ci_ = $row['documento_identidad'];
        if ($apll)
            $nombre .= " " . $apll;
        $correoAux_ = "";
        if ($correo_)
            $correoAux_ = "Correo:" . $correo_;
        $documento .= "
            <page format='272x210' style='font: arial; color: #222222;'>
            <!--136=14cm y 210=21.5cm--> 
            <div style='margin:55px;'>
                <div style='text-align: right; margin-bottom: 20px;'>
                    <p>El Alto - Bolivia, <span id='fechaActual'>" . date("d") . " de " . $conn->obtenerNombreMes(intval(date("m"))) . " de " . date("Y") . "</span></p>
                </div>
                <div style='margin-bottom: 20px;'>
                    <p>Señor:</p>
                    <p>Abg. Ivan Puña Aguilar<br>
                    Director de Administración Tributaria Municipal de El Alto<br>
                    GOBIERNO AUTONOMO MUNICIPAL DE EL ALTO</p>
                    <p>Presente:</p>
                </div>
                <div style='text-align: right; margin-bottom: 20px;'>
                    <span style='text-decoration:underline;'><b>REF.: SOLICITUD DE LIQUIDACION DE IMPUESTOS SEGUN VALOR EN TABLAS</b></span>
                </div>
                <div style='text-align: justify;'>
                    <p>Por intermedio de la presente le hago llegar un cordial saludo a su distinguida persona.</p> 
                    <p>Solicito muy respetuosamente el valor en tablas del número de inmueble: <b> $numInmueble_</b> ($UBICACION_NIVEL2, $DIRECCION_DESCRIPTIVA, #$NUMERO_PUERTA), registrado a nombre de $nombre.</p>
                    <p>Con este motivo honrar con las obligaciones tributarias pertienentes.</p>
                    <p>Agradeciendo su gentil deferencia, saludo a usted muy cordialmente.</p>
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
    }
    if ($resultados) {
        $path = '/static/solicitudes/' . $numInmueble_ . rand(111, 999) . '.pdf';
        /* echo $documento; */
        $html2pdf = new Html2Pdf();
        $html2pdf->writeHTML($documento);
        $html2pdf->Output();
    } else
        echo "No se logro recuperar los registros";
} catch (PDOException $e) {
    echo "Error al ejecutar la consulta: " . $e->getMessage();
}
