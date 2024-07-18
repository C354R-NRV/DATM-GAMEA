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
    /* $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC); */

    $resultados = getInfoVehRpt($cons, $ci_, $num_placa_);



    foreach ($resultados as $row) {
        $apll = $row['primer_apellido_sigla'] . " " . $row['segundo_apellido'] . " " . $row['apellido_esposo'];
        $nombre = $row['nombre_rsocial'];
        $ci_ = $row['documento_identidad'];
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
                    <p>Lic. Jhon Villalba Camacho<br>
                    Director de Administración Tributaria Municipal de El Alto<br>
                    GOBIERNO AUTONOMO MUNICIPAL DE EL ALTO  </p>
                    <p>Presente:</p>
                </div>
                <div style='text-align: right; margin-bottom: 20px;'>
                    <span style='text-decoration:underline;'><b>REF.: SOLICITUD DE BAJA TEMPORAL TRIBUTARIA E INHABILITACION DEL SISTEMA RUAL POR ROBO DE VEHICULO AUTOMOTOR TERRESTRE</b></span>
                </div>
                <div style='text-align: justify;'>
                    <p>Distinguido director:</p>

                    <p>Por la presente, solicito muy respetuosamente se me extienda la <b>BAJA TEMPORAL TRIBUTARIA E INHABILITACION DEL SISTEMA RUAL POR ROBO DE VEHICULO AUTOMOTOR TERRESTRE</b> con las siguientes características:</p>

                    <ul class='main'>
                        <li>Placa de control : " . $row['NRO_PTA'] . "</li>
                        <li>Servicio: " . $row['SERVICIO'] . "</li>
                        <li>Clase: " . $row['CLASE'] . "</li>
                        <li>Combustible: " . $row['TIPO_COMBUSTIBLE'] . "</li>
                        <li>Marca: " . $row['MARCA']  . "</li>
                    </ul> 
                    <p>El cual adquirí de buena fé, con el fin de tramitar toda la documentación que corresponda en la Alcaldía y el Gobierno Municipal de El Alto.</p>
                    <p>Agradezco su gentil colaboración, en la emisión del documento de FE.</p>
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

        $html2pdf->writeHTML($documento);
    }
    $path = '/static/solicitudes/' . $numInmueble_ . rand(111, 999) . '.pdf';
    $html2pdf->Output();
} catch (PDOException $e) {
    echo "Error al ejecutar la consulta: " . $e->getMessage();
}
