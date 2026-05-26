<?php
require '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

require_once("conexionpsql.php");

foreach ($_GET as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$conn = new Conexion();
$cons = $conn->conectar();

$query = "select  TRIM(
        CONCAT_WS(' ', 
            NULLIF(CONCAT(nombre, ' ', COALESCE(apellido_paterno, ''), ' ', COALESCE(apellido_materno, '')), '  '), 
            razon_social
        )
    ) AS nombre_completo,
documento_identidad_numero || COALESCE(NULLIF(' ' || documento_identidad_complemento, ' '), '') AS documento_identidad_numero,
documento_identidad_extension,
auto_conclusion, 
tipo_respaldo, 
documento_respaldo, 
monto_retencion_bs, 
monto_retencion_ufv , 
a.tipo_persona,
tipo_proceso,
a.id_cabecera_solicitud, a.id_item_solicitud, d.codigo_solicitud, 
to_char(d.fecha_envio, 'DD/MM/YYYY') AS fecha_envio,
e.circular, 
to_char(e.fecha_circular, 'DD/MM/YYYY HH24:MI:SS') AS fecha_circular ,  a.hash_detalle,
documento_tributario,
tipo_documento_tributario , cod_documento_identidad_tipo
from srf_item_solicitud a 
left join srf_documento_identidad_extension b on b.id_documento_identidad_extension = a.id_documento_identidad_extension
left join srf_tipo_respaldo c on  c.id_tipo_respaldo = a.id_tipo_respaldo
left join srf_cabecera_solicitud d on d.id_cabecera_solicitud = a.id_cabecera_solicitud
left join srf_documento_identidad_tipo f on f.id_documento_identidad_tipo = a.id_documento_identidad_tipo 
left join srf_estado_envio e on e.id_cabecera_solicitud = a.id_cabecera_solicitud and e.estado_ is true
where a.estado_  is true and a.id_item_solicitud =  $id;";

$stmt = $cons->query($query);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

try {

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
        .tableReqtd{
            font-size:16px;
            font-weight: bold;
        }
        .tableReq .tableReqth, .tableReqtd {
            border: 1px solid #525659;
            padding: 3px;
            text-align: center;
            
        }
        .tableReq .tableReqth {
            background-color: #f2f2f2;
            text-align: center;
        } 
    </style> 
    ";
    $aux_qr = "<qrcode value='https://datm.elalto.gob.bo/pages/vsrf.php?id=" . $item['hash_detalle'] . "' ec='Q' style='width: 25mm; border: none;' ></qrcode>";
    $documento .= "
        <page format='272x210' style='font: arial; color: #222222;' backtop='27mm' backbottom='10mm' backleft='20mm' backright='15mm'>
            <page_header>
                <table style='width: 100%; font-size:11px; color:#515151;'>
                    <tr>
                        <td style='text-align: center; padding:5px 10px 5px 20px; border-bottom:3px double black; width: 33%; font-size:10px;'> 
                            <img src='./escudo.jpg' style='width:60px;height:70px;'/> 
                        </td>
                        <td style='text-align: center; padding:5px 10px 5px 20px; border-bottom:3px double black; width: 33%;'> 
                            <img src='./central.png' style='width:100px;height:50px;'/><br><b><span style='font-size:10px;'>GOBIERNO AUTÓNOMO MUNICIPAL</span> <br><span style='font-size:21px;'>EL ALTO</span></b>
                        </td>
                        <td style='text-align: center; padding:5px 10px 5px 20px; border-bottom:3px double black; width: 33%; font-size:10px;'> 
                            <img src='./bandera.png' style='width:50px;height:70px;'/> 
                        </td>
                    </tr>
                </table>
            </page_header>
            <page_footer>
                
                <table style='width: 100%; font-size:11px; color:##515151; '> 


                    <tr>
                    <td style='text-align:right'> 
                    $aux_qr 
                    </td>

                    </tr>

                                        <tr>
                    <td style='text-align:center'>  
                    </td>
                    </tr>
                    
                    <tr>
                        <td style='text-align: center; padding:5px 10px 0 20px; border-top:3px double black; width: 100%; font-size:10px;'> 
                            Zonal Villa Bolivar D, Carretera a Viacha, Terminal Metropolitana de la Ciudad de El Alto, primer piso<br>https://datm.elalto.gob.bo/
                        </td>
                    </tr>
                </table>
            </page_footer> 

            <!--136=14cm y 210=21.5cm--> 
            <div  >
                <div style='text-align: right; margin-bottom: 20px;'>
                    <p>El Alto, <span id='fechaActual'>" . date("d") . " de " . $conn->obtenerNombreMes(intval(date("m"))) . " de " . date("Y") . "</span></p>
                </div>
                <div style='margin-bottom: 20px;'>
                    <p>Señor(a):<br>
                    <b>" . $item['nombre_completo'] . "</b><br>
                    <b>" . $item['cod_documento_identidad_tipo'] . ": " . $item['documento_identidad_numero'] . "</b><br>
                    <b>" . $item['tipo_documento_tributario'] . ": " . $item['documento_tributario'] . "</b>
                    </p>
                </div>
                Presente:<br>
                <div style='text-align: right; margin-bottom: 20px;'>
                    <span style='text-decoration:underline;'><b>REF.: " . ($item['tipo_proceso'] == 'S' ? "PROCEDIMIENTO DE SUSPENSIÓN REALIZADA" : "PROCEDIMIENTO DE RETENCIÓN REALIZADA") . "</b></span>
                </div>

                <div style='text-align: justify;'>
                    <p>De nuestra mayor consideración:</p> 
                    <p>Por medio de la presente, conforme a lo dispuesto por el Artículo 109 del Código Tributario Boliviano Ley 2492, concordante con el parágrafo Art. 35 del D.S. 27310 Reglamento del Código Tributario Boliviano, 
                    la Dirección de Administración Tributaria Municipal de la Secretaría Municipal de Administración y Finanzas del Gobierno Autónomo Municipal de El Alto, 
                    anoticia a usted, que se ha procedido satisfactoriamente con el procedimiento de <b>" . ($item['tipo_proceso'] == 'S' ? "suspensión" : "retención") . "</b> 
                    realizada en fecha " . $item['fecha_envio'] . " bajo código de solicitud: <b>" . $item['codigo_solicitud'] . "</b>" . ($item['tipo_proceso'] == 'S' ? " y Auto de Conclusión " . $item['auto_conclusion'] . "" : "") . ".</p>
                    <p>Considere además los datos de  circular siguientes emitido por la Autoridad de Supervisión del Sistema Financiero:</p> 
                    <table class='tableReq' align='center'>
                        <tr class='tableReqtr'>
                            <th class='tableReqth' style='width: 250px;'>CIRCULAR</th>
                            <th class='tableReqth' style='width: 250px;'>FECHA CIRCULAR</th>
                        </tr>
                        <tr>
                            <td class='tableReqtd'>" . $item['circular'] . "</td>
                            <td class='tableReqtd'>" . $item['fecha_circular'] . "</td> 
                        </tr> 
                    </table>
                    <p>Es por cuanto se emite el presente para fines que convengan al interesado.</p>
                    <br>
                    <br>
                    <br>
                </div> 

                <!-- <table style='text-align: center; width: 40%' align='center'>
                    <tr>
                        <td style='width: 100%'> 
                            <b>Dirección de Administración Tributaria Municipal</b>
                        </td>
                    </tr>
                </table> -->
            </div>
        </page>
        ";

    /* if ($resultados) { */
    //$path = '/static/solicitudes/rptSirefo_'.$item['documento_identidad_numero'].'_' . date('dmYHsi') . '.pdf';
    /* echo $documento; */
    $html2pdf = new Html2Pdf();
    $html2pdf->writeHTML($documento);
    $html2pdf->Output();
        /* } else
        echo "No se logro recuperar los registros" */;
} catch (PDOException $e) {
    echo "Error al ejecutar la consulta: " . $e->getMessage();
}
