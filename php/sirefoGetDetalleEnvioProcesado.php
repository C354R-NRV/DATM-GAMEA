<?php
session_start();
require_once './conexionpsql.php';
foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
$conn = new Conexion();
$cons = $conn->conectar();
$resp = array();
try {

    $query = "
select respuesta,  to_char(fecha_circular, 'YYYY-MM-DD HH24:MI:SS') AS fecha_circular, to_char(fecha_consulta, 'YYYY-MM-DD HH24:MI:SS') AS fecha_consulta, circular, usuario, c.tipo_proceso
from srf_estado_envio a 
left join datm_usuario b on b.id = a.uconsulta_
left join srf_cabecera_solicitud c on c.id_cabecera_solicitud = a.id_cabecera_solicitud
where a.estado_  is true and a.id_cabecera_solicitud = $idsolicitud limit 1;";
    $stmt = $cons->query($query);
    $inf = $stmt->fetch(PDO::FETCH_ASSOC);
    $data = array();

    $html_ = '<div class="element-detail">';
    $html_ .= '<ul>';
    $html_ .= '<li><span class="element-label">Tipo de proceso:</span> ' . ($inf['tipo_proceso'] == 'R' ? 'Retención' : 'Suspención') . '</li>';
    $html_ .= '<li><span class="element-label">Estado de solicitud en SIREFO:</span> ' . $inf['respuesta'] . '</li>';
    $html_ .= '<li><span class="element-label">Circular:</span> ' . $inf['circular'] . '</li>';
    $html_ .= '<li><span class="element-label">Fecha de circular:</span> ' . $inf['fecha_circular'] . '</li>';
    $html_ .= '<li><span class="element-label">Fecha de ultima actualización:</span> ' . $inf['fecha_consulta'] . '</li>';
    $html_ .= '<li><span class="element-label">Usuario ultima actualización:</span> ' . $inf['usuario'] . '</li>';
    $html_ .= '</ul>';
    $html_ .= '</div>';

    $html_ .=  '<hr>
        <div class="row">
            <div class="col-md-12">
                <table class="striped-table">
                    <thead>
                        <tr>
                            <th>CI/NIT</th>
                            <th>NOMBRES/R. SOCIAL</th> 
                            <th>DETALLES DE SOLICITUD</th> 
                            <th>IMPORTE</th>
                            <th>DOC. TRIBUTARIO</th>
                            <th>ACCION</th>
                        </tr>
                    </thead>
                    <tbody> ';
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
	a.id_cabecera_solicitud, a.id_item_solicitud,  documento_tributario, tipo_documento_tributario , gestion_fiscal, resolucion_determinativa, cite_anotacion_preventiva
    from srf_item_solicitud a 
    left join srf_documento_identidad_extension b on b.id_documento_identidad_extension = a.id_documento_identidad_extension
    left join srf_tipo_respaldo c on  c.id_tipo_respaldo = a.id_tipo_respaldo
    where a.estado_  and a.id_cabecera_solicitud = $idsolicitud order by a.id_item_solicitud asc;";

    $stmt = $cons->query($query);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);


    foreach ($items as $key => $item) {

        /* $fila = array(
        "documento_identidad_numero" => $item['documento_identidad_numero'] . ($item['tipo_persona'] == 'N' ? (trim($item['documento_identidad_complemento']) != '' ? '-' . $item['documento_identidad_complemento'] : '') : ' ' . $item['documento_identidad_extension']),
        "nombres" => ($item['tipo_persona'] == 'N' ? $item['nombres'] : $item['razon_social']),
        "auto_conclusion" => $item['auto_conclusion'],
        "tipo_respaldo" => $item['tipo_respaldo'], 
        "documento_respaldo" => $item['documento_respaldo'],
        "monto_retencion" => ($item['codigo_solicitud'] > 0 ? $item['monto_retencion_bs'] . ' Bs.' : $item['monto_retencion_ufv'] . ' UFV.')
    ); */
        $html_ .= ' 
            <tr>
                <td>' . $item['documento_identidad_numero'] . ($item['tipo_persona'] == 'N' ? (trim($item['documento_identidad_complemento']) != '' ? '-' . str_replace("-", "", $item['documento_identidad_complemento'] ): '') . ' ' . $item['documento_identidad_extension'] : '') . '</td>
                <td>' . ($item['tipo_persona'] == 'N' ? $item['nombres'] : $item['razon_social']) . '</td> ';

        if ($inf['tipo_proceso'] == 'R') {
            $html_ .= '<td style="font-size:0.75rem;">
                            <b>' . $item['tipo_respaldo'] . ':</b> ' . $item['documento_respaldo'] . '<br>                
                            <b>Res. determinativa:</b> ' . $item['resolucion_determinativa'] . '<br>
                            <b>Gestión fiscal:</b> ' . $item['gestion_fiscal'] . '<br>
                            <b>Anotación prev.:</b> ' . $item['cite_anotacion_preventiva'] . '
                        </td>';
        } else {
            $html_ .= '<td style="font-size:0.75rem;">
                            ' . $item['tipo_respaldo'] . ': ' . $item['documento_respaldo'] . '<br>                
                            Auto concl.: ' . $item['auto_conclusion'] . '<br>
                            
                        </td>';
        }

        $html_ .= ' <td>' . ($item['monto_retencion_bs'] > 0 ? $item['monto_retencion_bs'] . ' Bs.' : $item['monto_retencion_ufv'] . ' UFV.') . '</td>
                <td>' . $item['documento_tributario'] . ' <span style="font-size:10px">[' . $item['tipo_documento_tributario'] . ']</span></td> 
                <td style="text-align:center;"><button  onclick="getDocumentoCircular(' . $item['id_item_solicitud'] . ')" class="btn btn-success"><i class="fa fa-file-text-o"></i></button></td>
            </tr>  
        ';
    }
    $html_ .= ' 
        </tbody>
    </table>
    </div>
    </div> 
    ';

    $resp['html'] = $html_;
} catch (Exception $th) {
    $resp['html'] = $th;
} finally {

    $dat = json_encode($resp);
    echo $dat;
}
