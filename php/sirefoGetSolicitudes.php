<?php
session_start();
require_once './conexionpsql.php';
foreach ($_GET as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
$filtro = '';
if (isset($filtroCodigoSolicitud) and trim($filtroCodigoSolicitud) != '') {
    $filtro .= " and codigo_solicitud like '%$filtroCodigoSolicitud%' ";
}
if (isset($filtroFechaIni) and trim($filtroFechaIni) != '' and isset($filtroFechaFin) and trim($filtroFechaFin) != '') {
    $filtro .= " and fecha_envio::DATE  BETWEEN TO_DATE( '$filtroFechaIni', 'YYYY-MM-DD') AND TO_DATE( '$filtroFechaFin', 'YYYY-MM-DD') ";
}
if (isset($search) and trim($search) != '') {
    $filtro .= " and  concat(a.codigo_solicitud, ' ', a.fecha_envio::DATE, ' ', a.tipo_proceso) like '%$search%' ";
}
$sort_ =  ' a.id_cabecera_solicitud ';
if (isset($sort) and trim($sort) != '')
    $sort_ = $sort;
$order_ =  ' DESC ';
if (isset($order) and trim($order) != '')
    $order_ = $order;

$limit_ = 300;

$offset_ = 0;
if (isset($limit) and trim($limit) != '' and isset($offset) and trim($offset) != '') {
    $limit_ = $limit;
    $offset_ = $offset;
}

$conn = new Conexion();
$cons = $conn->conectar();

$query = "SELECT a.id_cabecera_solicitud, a.codigo_solicitud, a.detalle_cantidad, to_char(a.fecha_registro, 'YYYY-MM-DD HH24:MI:SS') AS fecha_registro, 
to_char(a.fecha_envio, 'YYYY-MM-DD HH24:MI:SS') AS fecha_envio,  a.adjunto_nombre, 
b.usuario, a.tipo_proceso
from srf_cabecera_solicitud a 
left join datm_usuario b on b.id = a.idusuario
where a.estado_ is true   $filtro  order by  $sort_  $order_  LIMIT $limit_ OFFSET $offset_; ";

$stmt = $cons->query($query);
$cabeceras = $stmt->fetchAll(PDO::FETCH_ASSOC);

$html = '';
$data = array();
foreach ($cabeceras as $key => $cabecera) {

    $query = "
        select a.respuesta, a.detalle,   to_char(a.fecha_circular, 'YYYY-MM-DD HH24:MI:SS') AS fecha_circular
        from srf_estado_envio a 
        where a.id_cabecera_solicitud = " . $cabecera['id_cabecera_solicitud'] . " and estado_ is true  limit 1 ";
    $stmt = $cons->query($query);
    $estadoEnvio = $stmt->fetch(PDO::FETCH_ASSOC);

    $query = "
        select a.estado, to_char(a.fecha_circular, 'YYYY-MM-DD HH24:MI:SS') AS fecha_circular
        from srf_estado_solicitud a 
        where a.id_cabecera_solicitud = " . $cabecera['id_cabecera_solicitud'] . " and estado_ is true limit 1 ";
    $stmt = $cons->query($query);
    $estadoSolicitud = $stmt->fetch(PDO::FETCH_ASSOC);


    $query = " 
        SELECT STRING_AGG( 
        concat(nombre, ' ', apellido_paterno, ' ', apellido_materno,' ', razon_social) 
        || ' ' || documento_identidad_numero || ' ' || documento_tributario , ', ') AS concatenado 
        FROM srf_item_solicitud a  
        where a.id_cabecera_solicitud = " . $cabecera['id_cabecera_solicitud'] . " and estado_ is true  ";
    $stmt = $cons->query($query);
    $itemNombres = $stmt->fetch(PDO::FETCH_ASSOC);


    $fila = array(
        "id_cabecera_solicitud" => $cabecera['id_cabecera_solicitud'],
        "tipo_proceso" => ($cabecera['tipo_proceso'] == 'R' ? 'Retencion' : 'Suspencion'),
        "codigo_solicitud" => $cabecera['codigo_solicitud'],
        "detalle_cantidad" => $cabecera['detalle_cantidad'],
        "fecha_registro" => $cabecera['fecha_registro'],
        "fecha_envio" => $cabecera['fecha_envio'],
        "estado_envio" => isset($estadoEnvio['respuesta']) ? $estadoEnvio['respuesta'] : '-',
        "fecha_circular" => isset($estadoEnvio['fecha_circular']) ? $estadoEnvio['fecha_circular'] : '-',
        "estado_solicitud" => isset($estadoSolicitud['estado']) ? $estadoSolicitud['estado'] : '-',
        "usuario" => $cabecera['usuario'],
        "acciones" => '<div style="display:none">'.$itemNombres['concatenado'].'</div>            
            ' . ($cabecera['adjunto_nombre'] != '' ? '<a class="btn btn-primary" href="../static/sirefo/' . $cabecera['adjunto_nombre'] . '" title="Descargar nota de remision" target="_blank" role="button"><i class="fa fa-cloud-download"></i></a>':'') . '

            ' . ($estadoSolicitud['estado'] === 'ENVIADO' ? ($estadoEnvio['respuesta'] === 'Procesado' ? '<a class="btn btn-success" onclick="verDetallesEnvio(' . $cabecera['id_cabecera_solicitud'] . ', \'' . $cabecera['codigo_solicitud'] . '\')" title="Ver detalles del envio de solicitud" role="button"><i class="fa fa-search-plus" aria-hidden="true"></i></a> |' : ('<a class="btn btn-success" onclick="estadoEnvio(' . $cabecera['id_cabecera_solicitud'] . ', \'' . $cabecera['codigo_solicitud'] . '\')" title="Consultar estado del envio de solicitud" role="button"><i class="fa fa-question-circle" aria-hidden="true"></i></a> |')) : '<a class="btn btn-success" onclick="actualizaEstados(' . $cabecera['id_cabecera_solicitud'] . ', \'' . $cabecera['codigo_solicitud'] . '\')" title="Remitir solicitud" role="button"><i class="fa fa-cloud-upload" aria-hidden="true"></i></a> |') . '
            
            ' . ($estadoSolicitud['estado'] != 'ENVIADO' ?
            '<a class="btn btn-warning" title="Editar solicitud" href="./sirefoAddSolicitud.php?id=' . $cabecera['id_cabecera_solicitud'] . '&tp=' . $cabecera['tipo_proceso'] . '&cs=' . $cabecera['codigo_solicitud'] . '&sw=1" role="button"><i class="fa fa-edit"></i></a> |
            <a class="btn btn-danger" title="Dar de baja la solicitud" onclick="borrarCompendio(' . $cabecera['id_cabecera_solicitud'] . ', \'' . $cabecera['codigo_solicitud'] . '\')" role="button"><i class="fa fa-trash"></i></a>' : '')
    );
    $data[] = $fila;
}
print_r(json_encode($data));
