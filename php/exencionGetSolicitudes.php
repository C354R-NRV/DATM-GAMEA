<?php
session_start();
require_once './conexionpsql.php';
foreach ($_GET as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$pjson = array();
$filtro = '';
if (isset($filtroCodigoSolicitud) and trim($filtroCodigoSolicitud) != '') {
    $filtro .= " and codigo_solicitud like '%$filtroCodigoSolicitud%' ";
}
if (isset($filtroFechaIni) and trim($filtroFechaIni) != '' and isset($filtroFechaFin) and trim($filtroFechaFin) != '') {
    $filtro .= " and fecha_envio::DATE  BETWEEN TO_DATE( '$filtroFechaIni', 'YYYY-MM-DD') AND TO_DATE( '$filtroFechaFin', 'YYYY-MM-DD') ";
}
if (isset($search) and trim($search) != '') {
    $filtro .= " and  concat(c.codigo_solicitud, ' ', a.fecha_registro::DATE, ' ', registro_tributario) like '%$search%' ";
}
if ($_SESSION['rol'] == 'CONTRIBUYENTE') {
    $filtro .= " and uregistro_ = " . $_SESSION['idusuario'] . "  ";
}
$sort_ =  ' a.idcabecera ';
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
$data = array();

$query = "SELECT 
    c.idcabecera,
    a.idactuado, 
    b2.usuario, b2.cedula_identidad, b2.contacto,    
    d.rubro,
    c.registro_tributario,
    c.codigo_solicitud, 
    to_char(c.fecha_registro, 'YYYY-MM-DD HH24:MI:SS') AS fecha_inicio, 
    to_char(a.fecha_registro, 'YYYY-MM-DD HH24:MI:SS') AS fecha_actuado, 
    a.nro_actuado,
    e.detalle_estado,
    e.codigo_estado,
    c.uregistro_
FROM 
    exc_cabecera c
INNER JOIN 
    (
        SELECT 
            idcabecera,
            MAX(idactuado) AS max_idactuado
        FROM 
            exc_actuado
        where estado_ is true
        GROUP BY 
            idcabecera
    ) latest_act ON c.idcabecera = latest_act.idcabecera
INNER JOIN 
    exc_actuado a ON a.idactuado = latest_act.max_idactuado 
INNER JOIN exc_rubro d on d.idrubro =  c.idrubro   
INNER JOIN exc_estado e on e.idestado = a.idestado
INNER  join datm_usuario b2 on b2.id = c.uregistro_
    where  a.nro_actuado>0 and a.estado_ is true and c.estado_ is true  $filtro  order by  $sort_  $order_  LIMIT $limit_ OFFSET $offset_;";


$stmt = $cons->query($query);
$cabeceras = $stmt->fetchAll(PDO::FETCH_ASSOC);

//EDICION '<a class="btn btn-warning" onclick="editarSolicitud(' . $cabecera['idcabecera'] . ', \'' . $cabecera['codigo_solicitud'] . '\')" title="Editar solicitud" role="button"><i class="fa fa-edit" aria-hidden="true"></i></a> | ' .
foreach ($cabeceras as $key => $cabecera) {
    $acciones = '';
    if ($cabecera['codigo_estado'] == 'PE' and $cabecera['uregistro_'] == $_SESSION['idusuario'])
        $acciones .= '<a class="btn btn-success" title="Enviar solicitud" onclick="enviarDocumentosExencion( \'' . $cabecera['codigo_solicitud'] . '\')" role="button"><i class="fa fa-cloud-upload"></i></a>  <a class="btn btn-danger" title="Dar de baja la solicitud" onclick="borrarCompendio(' . $cabecera['idcabecera'] . ', \'' . $cabecera['codigo_solicitud'] . '\')" role="button"><i class="fa fa-trash"></i></a> ';

    if ($cabecera['codigo_estado'] === 'REVT') {
        $acciones .= '<a class="btn btn-success" onclick="verDetalleReversion(' . $cabecera['idcabecera'] . ', \'' . $cabecera['codigo_solicitud'] . '\')" title="Ver detalles de la reversion" role="button"><i class="fa fa-search-plus" aria-hidden="true"></i></a> ';
    } else {
        $acciones .= '<a class="btn btn-success" onclick="verLineaTiempo(' . $cabecera['idcabecera'] . ', \'' . $cabecera['codigo_solicitud'] . '\')" title="Ver detalles del envio de solicitud" role="button"><i class="fa fa-search-plus" aria-hidden="true"></i></a> ';
    }

    if ($_SESSION['rol'] != 'CONTRIBUYENTE') {
        if ($cabecera['codigo_estado'] === 'ENV')
            $acciones .= '<a class="btn btn-warning" title="Recibir solicitud" onclick="cambiarARecibido( ' . $cabecera['idcabecera'] . ', \'' . $cabecera['codigo_solicitud'] . '\')" role="button"><i class="fa fa-hand-lizard-o" aria-hidden="true"></i></a> ';
        if ($cabecera['codigo_estado'] === 'RCB' or $cabecera['codigo_estado'] === 'EREV')
            $acciones .= '<a class="btn btn-warning" title="Revisar solicitud" onclick="revisarSolicitud(' . $cabecera['idcabecera'] . ', ' . $cabecera['idactuado'] . ', \'' . $cabecera['codigo_solicitud'] . '\',0)" role="button"><i class="fa fa-cog" aria-hidden="true"></i></a> ';
        if ($cabecera['codigo_estado'] === 'ENVFIS')
            $acciones .= '<a class="btn btn-danger" title="Recibir en fisico" onclick="cambiarARecibidoFisico( ' . $cabecera['idcabecera'] . ', \'' . $cabecera['codigo_solicitud'] . '\')" role="button"><i class="fa fa-clipboard" aria-hidden="true"></i></a> ';
        if ($cabecera['codigo_estado'] === 'RCBFIS') {
            $acciones .= '<a class="btn btn-danger" title="Marcar como atendido y completado" onclick="cambiarAtendido( ' . $cabecera['idcabecera'] . ', \'' . $cabecera['codigo_solicitud'] . '\')" role="button"><i class="fa fa-flag-checkered" aria-hidden="true"></i></a> ';
            $acciones .= '<a class="btn btn-warning" title="Agregar observaciones" onclick="revisarSolicitud( ' . $cabecera['idcabecera'] . ',' . $cabecera['idactuado'] . ', \'' . $cabecera['codigo_solicitud'] . '\',1)" role="button"><i class="fa fa-bug" aria-hidden="true"></i></a> ';
        }
    }
    if ($_SESSION['rol'] == 'CONTRIBUYENTE') {
        if ($cabecera['codigo_estado'] === 'REV')
            $acciones .= '<a class="btn btn-danger" title="Entregar en fisico" onclick="cambiarAEntregaFisico( ' . $cabecera['idcabecera'] . ', \'' . $cabecera['codigo_solicitud'] . '\')" role="button"><i class="fa fa-share-square-o" aria-hidden="true"></i></a> ';
        if ($cabecera['codigo_estado'] === 'REVOBS')
            $acciones .= '<a class="btn btn-warning" title="Subsanar observacion" onclick="subsanarObservaciones( ' . $cabecera['idcabecera'] . ', \'' . $cabecera['codigo_solicitud'] . '\')" role="button"><i class="fa fa-recycle" aria-hidden="true"></i></a> ';
    }

    $fila = array(
        "idcabecera" => $cabecera['idcabecera'],
        "idactuado" => $cabecera['idactuado'],
        "rubro" => $cabecera['rubro'],
        "registro_tributario" => $cabecera['registro_tributario'],
        "codigo_solicitud" => $cabecera['codigo_solicitud'],
        "fecha_inicio" => $cabecera['fecha_inicio'],
        "fecha_actuado" => $cabecera['fecha_actuado'],
        "detalle_estado" =>  $cabecera['detalle_estado'],
        "usuario" =>  $cabecera['usuario'],
        "cedula_identidad" =>  $cabecera['cedula_identidad'],
        "contacto" =>  $cabecera['contacto'],
        "acciones" => $acciones
    );
    $data[] = $fila;
}
print_r(json_encode($data));
