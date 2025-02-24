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
$limit_ = 500;
$offset_ = 0;
if (isset($limit) and trim($limit) != '' and isset($offset) and trim($offset) != '') {
    $limit_ = $limit;
    $offset_ = $offset;
}

$conn = new Conexion();
$cons = $conn->conectar();

$query = "
select a.idcabecera, a.codigo_solicitud, to_char(a.fecha_registro, 'YYYY-MM-DD HH24:MI:SS') AS fecha_registro, 
to_char(a.fecha_envio, 'YYYY-MM-DD HH24:MI:SS') AS fecha_envio,  c.detalle_estado, c.codigo_estado, d.rubro, a.registro_tributario
from exc_cabecera a 
left join exc_estado c on c.idestado = a.idestado
left join exc_rubro d on d.idrubro = a.idrubro
left join datm_usuario b on b.id = a.idusuario
where a.estado_ is true   $filtro  order by  $sort_  $order_  LIMIT $limit_ OFFSET $offset_;";

$stmt = $cons->query($query);
$cabeceras = $stmt->fetchAll(PDO::FETCH_ASSOC);

$html = '';
$data = array();
foreach ($cabeceras as $key => $cabecera) {
    $fila = array(
        "idcabecera" => $cabecera['idcabecera'],
        "rubro" => $cabecera['rubro'],
        "registro_tributario" => $cabecera['registro_tributario'],
        "codigo_solicitud" => $cabecera['codigo_solicitud'],
        "fecha_registro" => $cabecera['fecha_registro'],
        "fecha_envio" => $cabecera['fecha_envio'],
        "detalle_estado" =>  $cabecera['detalle_estado'],
        "acciones" => ($cabecera['codigo_estado'] === 'PE' ?
            '<a class="btn btn-success" title="Enviar solicitud" onclick="enviarSolicitud(' . $cabecera['idcabecera'] . ', \'' . $cabecera['codigo_solicitud'] . '\')" role="button"><i class="fa-cloud-upload"></i></a> | ' .
            '<a class="btn btn-warning" onclick="editarSolicitud(' . $cabecera['idcabecera'] . ', \'' . $cabecera['codigo_solicitud'] . '\')" title="Editar solicitud" role="button"><i class="fa fa-edit" aria-hidden="true"></i></a> | ' .
            '<a class="btn btn-danger" title="Dar de baja la solicitud" onclick="borrarCompendio(' . $cabecera['idcabecera'] . ', \'' . $cabecera['codigo_solicitud'] . '\')" role="button"><i class="fa fa-trash"></i></a>'
            : '<a class="btn btn-success" onclick="verLineaTiempo(' . $cabecera['idcabecera'] . ', \'' . $cabecera['codigo_solicitud'] . '\')" title="Ver detalles del envio de solicitud" role="button"><i class="fa fa-search-plus" aria-hidden="true"></i></a> ')
    );
    $data[] = $fila;
}
print_r(json_encode($data));
