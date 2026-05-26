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
            $nombre = $row['nombre_apo'] . " " . $row['primer_apellido_apo'] . " " . $row['segundo_apellido_apo']. " (". $row['tipo_apoderado'].")";
            $tip_doc =  $row['tipo_documento_apo'];
        }

        $correoAux_ = "";
        if ($correo_)
            $correoAux_ = "Correo:" . $correo_;
        $documento .= "
            <page format='272x210' style='font: arial; color: #222222;'> 
            <div style='margin:35px 55px 55px 55px;'>
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
                    <span style='text-decoration:underline;'><b>REF.: SOLICITUD DEL TRAMITE PARA LA BAJA POR OMISI ÓN DE PAGO DEL IMPUESTO A LA 
                    PROPIEDAD DE VEHÍCULOS AUTOMOTORES (IPVA) Y EL IMPUESTO MUNICIPAL A LA PROPIEDAD DE VEHÍCULOS AUTOMOTORES TERRESTRES (IMPVAT) 
                    DEL POSEEDOR A SOLICITUD DEL TITULAR CON PLACA DE CONTROL Nº. $num_placa_ (PARRAFO II POR LA R.A. 020).</b></span>
                </div>
                <div style='text-align: justify;'>
                    <p>De mi mayor consideración:</p> 
                    <p>Por medio de la presente nota, me dirijo a su autoridad solicitando el trámite de BAJA POR OBSOLESCENCIA DEL VEHÍCULO del 
                    vehiculo con placa de control: Nº  <b> $num_placa_</b>, adjuntando a la presente la documentación necesaria 
                    que respalde la solicitud, todo ello al amparo de la Resolución Administrativa DRPT/Nº 006/2022 de fecha 02 de febrero de 2022.
                    </p>
                    <br>

                    <table class='tableReq' align='center'>
                        <tr class='tableReqtr'>
                            <th class='tableReqth' style='width: 550px;'>REQUISITOS</th>
                            <th class='tableReqth' style='width: 30px;'>SI</th>
                            <th class='tableReqth' style='width: 30px;'>NO</th>
                        </tr>
                        <tr>
                            <td class='tableReqtd'style='width: 550px;'>Solicitud expresa dirigida al Director de Administración Tributaria Municipal.</td>
                            <td class='tableReqtd'></td>
                            <td class='tableReqtd'></td>
                        </tr>
                        <tr>
                            <td class='tableReqtd'style='width: 550px;'>Fotocopia de documento de Identidad.</td>
                            <td class='tableReqtd'></td>
                            <td class='tableReqtd'></td>
                        </tr>
                        <tr>
                            <td class='tableReqtd'style='width: 550px;'>Poder notarial (si corresponde).</td>
                            <td class='tableReqtd'></td>
                            <td class='tableReqtd'></td>
                        </tr>
                        <tr>
                            <td class='tableReqtd'style='width: 550px;'>Declaratoria de herederos (si corresponde).</td>
                            <td class='tableReqtd'></td>
                            <td class='tableReqtd'></td>
                        </tr>
                        <tr>
                            <td class='tableReqtd'style='width: 550px;'>Certificado Original de Inspección Técnica Vehicular, emitido por la Dirección de Tránsito; transporte y seguridad vial con una vigencia no mayor a un año.</td>
                            <td class='tableReqtd'></td>
                            <td class='tableReqtd'></td>
                        </tr>
                        <tr>
                            <td class='tableReqtd'style='width: 550px;'>Certificado original emitido por la Dirección de Tránsito, transporte y seguridad vial, en el que conste que el vehículo no registra y/o se encuentran canceladas las infracciones de Tránsito, con una vigencia no mayor a un año.</td>
                            <td class='tableReqtd'></td>
                            <td class='tableReqtd'></td>
                        </tr>
                        <tr>
                            <td class='tableReqtd'style='width: 550px;'>Fotocopia de los comprobantes de pago impositivo de las gestiones adeudadas a la fecha de solicitud de la baja.</td>
                            <td class='tableReqtd'></td>
                            <td class='tableReqtd'></td>
                        </tr>
                        <tr>
                            <td class='tableReqtd'style='width: 550px;'>Certificación de Constancia de Registro de Propiedad del Vehículo Automotor Terrestre.</td>
                            <td class='tableReqtd'></td>
                            <td class='tableReqtd'></td>
                        </tr>
                        <tr>
                            <td class='tableReqtd'style='width: 550px;'>Certificación de reposición de placas de vehículo automotor terrestre.</td>
                            <td class='tableReqtd'></td>
                            <td class='tableReqtd'></td>
                        </tr>
                    </table>


                    <p>Sin otro particular me despido seguro de que mi solicitud será atendida favorablemente.</p>
                    <p>Atentamente,</p>
                    <p></p>
                    </div>
                </div>
                <table style='text-align: center; border-top: 1px solid #A9A9A9; width: 40%; font-size: 11px;' align='center'>
                    <tr>
                        <td style='width: 100%'>
                            $nombre<br>
                            $tip_doc $ci_<br>
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
        echo "No se logro recuperar los registros";
} catch (PDOException $e) {
    echo "Error al ejecutar la consulta: " . $e->getMessage();
}
