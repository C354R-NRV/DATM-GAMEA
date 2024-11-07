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

    $resultados = getInfoActBaseCiRpt($cons, $ci_);

    $documento = "
    <style type='text/css'>
        ul.main { width: 95%; list-style-type: square; }
        ul.main li { padding-bottom: 2mm; }


        .tableReq {
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

    $detalleActividad = '<table align="center" style="text-align:center;width: 100%; border-collapse: collapse;">';
    $cssAux_ = 'style=" border: 1px solid #A9A9A9;padding: 5px; text-align: left;"';
    $auxCnt = 0;
    $nomAp = '';
    foreach ($resultados as $row) {
        $apll = $row['primer_apellido_sigla'] . " " . $row['segundo_apellido'] . " " . $row['apellido_esposo'];
        $nombre = $row['nombre_rsocial'];
        $tipo_documento = $row['tipo_documento'];
        $ci_ = $row['documento_identidad'];
        $detalleActividad .= '<tr><td ' . $cssAux_ . '>' . $row['numero_actividad'] . '</td><td ' . $cssAux_ . '>:</td><td ' . $cssAux_ . '>' . $row['RUBRO'] . ', ' . $row['TIPO_ACTIVIDAD'] . ', ' . $row['ZONA_TRIBUTARIA'] . '</td><td ' . $cssAux_ . '>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>';

        if ($row['documento_identidad_apo'] != '' && $row['documento_identidad_apo'])
            $nomAp = ', con ' . $row['tipo_apoderado'] . ': ' . $row['nombre_apo'] . ' ' . $row['primer_apellido_apo'] . ' ' . $row['segundo_apellido_apo'] . ' con ' . $row['tipo_documento_apo'] . ':' . $row['documento_identidad_apo'];
        $auxCnt++;
    }
    $txtPlural = ' de la actividad económica ';
    if ($auxCnt > 1)
        $txtPlural = ' de las actividades económicas ';

    $detalleActividad .= '</table>';

    foreach ($resultados as $row) {
        $apll = $row['primer_apellido_sigla'] . " " . $row['segundo_apellido'] . " " . $row['apellido_esposo'];

        $ci_ = $row['documento_identidad'];
        $nombre = $row['nombre_rsocial'];
        if ($apll)
            $nombre .= " " . $apll;
        $correoAux_ = "";
        if ($correo_)
            $correoAux_ = "Correo:" . $correo_;

        $documento .= "
            <page format='272x210' style='font: arial; color: #222222;'>
            <!--136=14cm y 210=21.5cm--> 
            <div style='margin:30px 55px 55px 55px;'>
                <div style='text-align: right; margin-bottom: 5px;'>
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
                    <span style='text-decoration:underline;'><b>REF.: SOLICITUD DEL TRAMITE DE PRESCRIPCIÓN DE ACTIVIDAD ECONÓMICA CON REGISTRO TRIBUTARIO N.º $num_act_ DE LA GESTIÓN $gestionIni_ SOBRE LA FACULTAD (determinación, imposición de sanción y/o ejecución)</b></span>
                </div>
                <div style='text-align: justify;'>
                    <p>De mi mayor consideración:</p> 
                    <p>Por medio de la presenta nota, me dirijo a su autoridad solicitando el inicio de trámite de PRESCRIPCIÓN DE ACTIVIDAD ECONÓMICA $txtPlural:
                    </p>
                    $detalleActividad 
                    <p>Por lo cual se adjunta a la presente, la documentación necesaria que respalde la solicitud, todo ello al amparo de la Resolución Administrativa 
                    DRPT/Nº 006/2022 de fecha 02 de febrero de 2022.</p> 

                        <table class='tableReq' align='center'>
                            <tr class='tableReqtr'>
                                <th class='tableReqth' style='width: 550px;'>REQUISITOS</th>
                                <th class='tableReqth' style='width: 30px;'>Si</th>
                                <th class='tableReqth' style='width: 30px;'>No</th>
                            </tr>
                            <tr>
                                <td class='tableReqtd' style='width: 550px;'>Solicitud escrita del titular (Dirigida al Director de Administración Tributaria Municipal).</td>
                                <td class='tableReqtd'></td>
                                <td class='tableReqtd'></td>
                            </tr>
                            <tr>
                                <td class='tableReqtd' style='width: 550px;'>Proforma de liquidación.</td>
                                <td class='tableReqtd'></td>
                                <td class='tableReqtd'></td>
                            </tr>
                            <tr>
                                <td class='tableReqtd' style='width: 550px;'>Licencia de Funcionamiento (en caso de pérdida de la Licencia adjuntar los originales de 2 publicaciones de dos días diferentes, marcando la publicación) (si corresponde).</td>
                                <td class='tableReqtd'></td>
                                <td class='tableReqtd'></td>
                            </tr>
                            <tr>
                                <td class='tableReqtd' style='width: 550px;'>Poder Original o Poder legalizado (en específico el trámite a realizar).</td>
                                <td class='tableReqtd'></td>
                                <td class='tableReqtd'></td>
                            </tr>
                            <tr>
                                <td class='tableReqtd' style='width: 550px;'>Fotocopia simple de cédula de identidad (vigente).</td>
                                <td class='tableReqtd'></td>
                                <td class='tableReqtd'></td>
                            </tr>
                        </table> 

                    <p>Sin otro particular me despido seguro de que mi solicitud será atendida favorablemente.</p>
                    <p>Atentamente,</p>
                    <p></p>
                    </div>
                </div>
                <table style='text-align: center; border-top: solid 1px; width: 35%' align='center'>
                    <tr>
                        <td style='width: 100%'>
                            $nombre<br>
                            " . $row['tipo_documento'] . " $ci_<br>
                            Num. Contacto: $contacto_<br>
                            $correoAux_
                        </td>
                    </tr>
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
        echo "NO SE ENCONTRO REGISTROS EN LA BASE DE DATOS";
} catch (PDOException $e) {
    echo "Error al ejecutar la consulta: " . $e->getMessage();
}
