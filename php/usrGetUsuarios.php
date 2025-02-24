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
$sort_ =  ' a.id ';
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
select a.id, a.rol, a.usuario, to_char(a.fecha_registro, 'YYYY-MM-DD HH24:MI:SS') AS fecha_registro, 
a.correo, a.contacto, a.estado
from datm_usuario a 
where   true   $filtro  order by  $sort_  $order_  LIMIT $limit_ OFFSET $offset_;";

$stmt = $cons->query($query);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

$data = array();
foreach ($usuarios as $key => $usuario) {
    $fila = array(
        "id" => $usuario['id'],
        "rol" => $usuario['rol'], 
        "usuario" => $usuario['usuario'], 
        "fecha_registro" => $usuario['fecha_registro'],
        "correo" => $usuario['correo'],
        "contacto" =>  $usuario['contacto'],
        "estado" =>  $usuario['estado'],
        "acciones" => 
            '<a class="btn btn-warning" onclick="editarSolicitud(' . $usuario['id'] . ', \'' . $usuario['usuario'] . '\')" title="Editar usuario" role="button"><i class="fa fa-edit" aria-hidden="true"></i></a> | ' .
            '<a class="btn btn-danger" title="Dar de baja al usuario" onclick="borrarCompendio(' . $usuario['id'] . ', \'' . $usuario['usuario'] . '\')" role="button"><i class="fa fa-trash"></i></a>'
    );
    $data[] = $fila;
}
print_r(json_encode($data)); 
