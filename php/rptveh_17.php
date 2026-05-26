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

try {

    $resultados = getInfoVehRpt($cons, $ci_, $num_placa_);

    $detalleVehiculo = '<table align="center" style="text-align:center;width: 100%; border-collapse: collapse; margin: 0 0 0 15px;">';
    $cssAux_ = 'style=" border: 1px solid #A9A9A9;padding: 5px; text-align: left;"';
    $auxCnt = 0;
    foreach ($resultados as $row) {
        $apll = $row['primer_apellido_sigla'] . " " . $row['segundo_apellido'] . " " . $row['apellido_esposo'];
        $nombre = $row['nombre_rsocial'];
        $tipo_documento = $row['tipo_documento'];
        $ci_ = $row['documento_identidad'];
        $detalleVehiculo .= '<tr ><td ' . $cssAux_ . '>' . $row['nro_pta'] . '</td><td ' . $cssAux_ . '>:</td><td ' . $cssAux_ . '>' . $row['clase'] . ', ' . $row['TIPO_COMBUSTIBLE'] . ', ' . $row['MARCA'] . ' ' . $row['TIPO'] . '</td></tr>';
        $auxCnt++;
    }
    $txtPlural = ' del vehiculo ';
    if ($auxCnt > 1)
        $txtPlural = ' de los vehiculos ';
    $detalleVehiculo .= '</table>';


    
    $documento = "
    <style type='text/css'>
        ul.main { width: 95%; list-style-type: square; }
        ul.main li { padding-bottom: 2mm; }


        .tableReq {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0;
            font-size: 12px;
        }
        .tableReq .tableReqth, .tableReqtd {
            border: 1px solid #525659;
            padding: 3px;
            text-align: left;
        }
        .tableReq .tableReqth {
            background-color: #f2f2f2;
            text-align: center;
        } 
    </style> 
    ";
    foreach ($resultados as $row) {
        
        $apll = $row['primer_apellido_sigla'] . " " . $row['segundo_apellido'] . " " . $row['apellido_esposo'];

        $ci_ = $row['documento_identidad'];
        $nombre = $row['nombre_rsocial'];
        $tip_doc = $row['tipo_documento'];

        if ($apll)
            $nombre .= " " . $apll;

        if ($row['documento_identidad_apo'] == $ci_) {
            $nombre = $row['nombre_apo'] . " " . $row['primer_apellido_apo'] . " " . $row['segundo_apellido_apo'] . " (" . $row['tipo_apoderado'] . ")";
            $tip_doc =  $row['tipo_documento_apo'];
        }

        $correoAux_ = "";
        if ($correo_)
            $correoAux_ = "Correo:" . $correo_;

        $documento .= "
            <page format='272x210' style='font: arial; color: #222222;'> 
            <div style='margin:25px 55px 25px 55px;'>
                <div style='text-align: right; margin-bottom: 20px;'>
                    <p>El Alto - Bolivia, <span id='fechaActual'>" . date("d") . " de " . $conn->obtenerNombreMes(intval(date("m"))) . " de " . date("Y") . "</span></p>
                </div>
                <div style='margin-bottom: 20px;'>
                    <p>Señor:</p>
                    <p>Lic. Rosse Mary Rivera Ocampo<br>
                    Director de Administración Tributaria Municipal de El Alto<br>
                    GOBIERNO AUTONOMO MUNICIPAL DE EL ALTO</p>
                    <p>Presente:</p>
                </div>
                <div style='text-align: right; margin-bottom: 20px;'>
                    <span style='text-decoration:underline;'><b>REF.: SOLICITUD DEL TRAMITE DE PRESCRIPCIÓN DE VEHÍCULOS Y/O MOTOCICLETAS, CON PLACA DE   CONTROL Nº. $num_placa_, RESPECTO A LA FACULTAD (determinación, imposición de sanción y/o ejecución)</b></span>
                </div>
                <div style='text-align: justify;'>
                    <p>De mi mayor consideración:</p> 
                    <p>Por medio de la presente nota, me dirijo a su autoridad solicitando el trámite de BAJA POR ROBO E INHABILITACIÓN DEL SISTEMA DE VEHÍCULOS Y/O MOTOCICLETAS $txtPlural:</p>
                    
                    $detalleVehiculo
                    
                    <p>Todo ello al amparo de la Resolución Administrativa DRPT/Nº 006/2022 de fecha 02 de febrero de 2022, para tal efecto se adjunta:</p>
                    
                    <table class='tableReq' align='center'>
                        <tr class='tableReqtr'>
                            <th class='tableReqth' style='width: 550px;'>REQUISITOS</th>
                            <th class='tableReqth' style='width: 30px;'>SI</th>
                            <th class='tableReqth' style='width: 30px;'>NO</th>
                        </tr>
                        <tr>
                            <td class='tableReqtd' style='width: 550px;'>Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).</td>
                            <td class='tableReqtd'></td>
                            <td class='tableReqtd'></td>
                        </tr>
                        <tr>
                            <td class='tableReqtd' style='width: 550px;'>Certificado de Registro de Propiedad - Vehículo Automotor (CRPVA) o RUA -03</td>
                            <td class='tableReqtd'></td>
                            <td class='tableReqtd'></td>
                        </tr>
                        <tr>
                            <td class='tableReqtd' style='width: 550px;'>Comprobantes de pago del Impuesto (IMPVAT).</td>
                            <td class='tableReqtd'></td>
                            <td class='tableReqtd'></td>
                        </tr>
                        <tr>
                            <td class='tableReqtd' style='width: 550px;'>Proforma de liquidación</td>
                            <td class='tableReqtd'></td>
                            <td class='tableReqtd'></td>
                        </tr>
                        <tr>
                            <td class='tableReqtd' style='width: 550px;'>NIT (Para persona Jurídica) (Si corresponde)</td>
                            <td class='tableReqtd'></td>
                            <td class='tableReqtd'></td>
                        </tr>
                    </table> 

                    <p>Sin otro particular me despido seguro de que mi solicitud será atendida favorablemente.</p>
                    <p>Atentamente,</p> 
                    </div><br>
                    <table style='text-align: center; border-top: 1px solid #A9A9A9; width: 50%; font-size: 11px;' align='center'>
                        <tr>
                            <td style='width: 100%'>
                                $nombre<br>
                                $tip_doc $ci_<br>
                                Num. Contacto: $contacto_<br>
                                $correoAux_
                            </td>
                        </tr>
                    </table> 
                </div> 
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
        
        break;
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
