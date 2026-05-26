<?php
session_start();
require_once './conexionpsql.php';
foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
$conn = new Conexion();
$cons = $conn->conectar();

$query = "
select a.id_cabecera_solicitud, a.codigo_solicitud, a.detalle_cantidad, to_char(a.fecha_envio, 'YYYY-MM-DD HH24:MI:SS') AS fecha_envio, a.adjunto_nombre, b.usuario, a.tipo_proceso
from srf_cabecera_solicitud a 
left join datm_usuario b on b.id = a.idusuario
where a.estado_   and a.id_cabecera_solicitud = $idsolicitud;";
$stmt = $cons->query($query);
$cabeceras = $stmt->fetchAll(PDO::FETCH_ASSOC);
$resp['query'] =   $query;
$data = array();

$html = ' <hr>
<div class="containerDetalleSolicitud col-md-12">
        <div class="row"> 
            <div class="col-md-6"> 
';

foreach ($cabeceras as $key => $cabecera) {

    $query = "
        select a.respuesta, a.detalle
        from srf_estado_envio a 
        where a.id_cabecera_solicitud = " . $cabecera['id_cabecera_solicitud'] . "  limit 1 ";
    $stmt = $cons->query($query);
    $estadoEnvio = $stmt->fetch(PDO::FETCH_ASSOC);

    $query = "
        select a.estado, to_char(a.fecha_circular, 'YYYY-MM-DD HH24:MI:SS') AS fecha_circular
        from srf_estado_solicitud a 
        where a.id_cabecera_solicitud = " . $cabecera['id_cabecera_solicitud'] . "   limit 1 ";
    $stmt = $cons->query($query);
    $estadoSolicitud = $stmt->fetch(PDO::FETCH_ASSOC);


    /* $fila = array(
        "id_cabecera_solicitud" => $cabecera['id_cabecera_solicitud'],
        "tipo_proceso" => ($cabecera['tipo_proceso'] == 'R' ? 'Retencion' : 'Suspencion'),
        "codigo_solicitud" => $cabecera['codigo_solicitud'],
        "detalle_cantidad" => $cabecera['detalle_cantidad'],
        "fecha_envio" => $cabecera['fecha_envio'],
        "estado_envio" => isset($estadoEnvio['respuesta']) ? $estadoEnvio['respuesta'] : '-',
        "fecha_circular" => isset($estadoSolicitud['fecha_circular']) ? $estadoSolicitud['fecha_circular'] : '-',
        "estado_solicitud" => isset($estadoSolicitud['estado']) ? $estadoSolicitud['estado'] : '-'
    ); */

    $html .= ' 
                CÓDIGO DE SOLICITUD:  <b>' . $cabecera['codigo_solicitud'] . '</b>
            </div>
            <div class="col-md-6"> 
                TIPO DE PROCESO: <b>' . ($cabecera['tipo_proceso'] == 'R' ? 'Retencion' : 'Suspencion') . '</b> 
            </div>
        </div>
        <div class="row">
            <div class="col-md-6"> 
                FECHA DE ENVÍO: <b>' . ($cabecera['fecha_envio']) . '</b>
            </div>
            <div class="col-md-6"> 
                ESTADO SOLICITUD: <b>' . (isset($estadoSolicitud['estado']) ? $estadoSolicitud['estado'] : '-') . '</b>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <table class="striped-table">
                    <thead>
                        <tr>
                            <th>CI/NIT</th>
                            <th>NOMBRES/R. SOCIAL</th>
                            <th>DETALLES DE SOLICITUD</th>
                            <th>RESPALDO</th>
                            <th>DOC. RESPALDO</th>
                            <th>RETENCIÓN</th>
                            <th>DOC. TRIB.</th>
                        </tr>
                    </thead>
                    <tbody>  
    ';
    break;
    /* $data[] = $fila; */
}
// OBTENEMOS LOS DETALLES DE LOS ITEMS
$query = "select concat(nombre, ' ', apellido_paterno, ' ', apellido_materno) nombres, 
    razon_social,
    documento_identidad_numero, 
    documento_identidad_complemento,
    documento_identidad_extension,
	auto_conclusion, 
	tipo_respaldo, 
	documento_respaldo, 
	monto_retencion_bs, 
	monto_retencion_ufv , 
    tipo_persona,
	a.id_cabecera_solicitud, documento_tributario, tipo_documento_tributario, resolucion_determinativa, gestion_fiscal, cite_anotacion_preventiva
from srf_item_solicitud a 
left join srf_documento_identidad_extension b on b.id_documento_identidad_extension = a.id_documento_identidad_extension
left join srf_tipo_respaldo c on  c.id_tipo_respaldo = a.id_tipo_respaldo
where a.estado_  and a.id_cabecera_solicitud = $idsolicitud order by a.id_item_solicitud asc;";
$stmt = $cons->query($query);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* $dataItem = array(); */

foreach ($items as $key => $item) {

    /* $fila = array(
        "documento_identidad_numero" => $item['documento_identidad_numero'] . ($item['tipo_persona'] == 'N' ? (trim($item['documento_identidad_complemento']) != '' ? '-' . $item['documento_identidad_complemento'] : '') : ' ' . $item['documento_identidad_extension']),
        "nombres" => ($item['tipo_persona'] == 'N' ? $item['nombres'] : $item['razon_social']),
        "auto_conclusion" => $item['auto_conclusion'],
        "tipo_respaldo" => $item['tipo_respaldo'], 
        "documento_respaldo" => $item['documento_respaldo'],
        "monto_retencion" => ($item['codigo_solicitud'] > 0 ? $item['monto_retencion_bs'] . ' Bs.' : $item['monto_retencion_ufv'] . ' UFV.')
    ); */

    $html .= ' 
            <tr>
                <td>' . $item['documento_identidad_numero'] . ($item['tipo_persona'] == 'N' ? (trim($item['documento_identidad_complemento']) != '' ? '-' . $item['documento_identidad_complemento'] : '') . ' ' . $item['documento_identidad_extension'] : '') . '</td>
                <td>' . ($item['tipo_persona'] == 'N' ? $item['nombres'] : $item['razon_social']) . '</td>';
                

            if ($cabecera['tipo_proceso'] == 'R') {
                $html .= '<td style="font-size:0.75rem;">
                                <b>' . $item['tipo_respaldo'] . ':</b> ' . $item['documento_respaldo'] . '<br>                
                                <b>Res. determinativa:</b> ' . $item['resolucion_determinativa'] . '<br>
                                <b>Gestión fiscal:</b> ' . $item['gestion_fiscal'] . '<br>
                                <b>Anotación prev.:</b> ' . $item['cite_anotacion_preventiva'] . '
                            </td>';
            } else {
                $html .= '<td style="font-size:0.75rem;">
                                ' . $item['tipo_respaldo'] . ': ' . $item['documento_respaldo'] . '<br>                
                                <b>Auto concl.:</b> ' . $item['auto_conclusion'] . '<br>
                                
                            </td>';
            }

                $html .= '<td>' . $item['tipo_respaldo'] . '</td>
                <td>' . $item['documento_respaldo'] . '</td>
                <td>' . ($item['monto_retencion_bs'] > 0 ? $item['monto_retencion_bs'] . ' Bs.' : $item['monto_retencion_ufv'] . ' UFV.') . '</td>
                <td>' . $item['documento_tributario'] . "<span  style='font-size:10px;'><br>[".$item['tipo_documento_tributario'].']</span></td>
            </tr>  
        ';
}

$html .= ' 
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
    <hr>
';

/* $resp['cabecera']  = $data;
$resp['items']  = $dataItem; */

$resp['html'] = $html;
$dat = json_encode($resp);
echo $dat;
