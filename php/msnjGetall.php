<?php
session_start();
require_once './conexionpsql.php';

/* error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
file_put_contents("debug_msnj.log", print_r($_GET, true), FILE_APPEND);
 */
try {
    foreach ($_POST as $clave => $valor) {
        $$clave = addslashes(trim($valor));
    }
    /* foreach ($_GET as $clave => $valor) {
        $$clave = addslashes(trim($valor));
    } */
    $filtro = '';
    if (isset($filtroCodigoSolicitud) && trim($filtroCodigoSolicitud) != '') {
        $filtro .= " and concat(documento_identidad,' ', nombres, ' ', contacto ) like '%$filtroCodigoSolicitud%' ";
    }

    if (isset($filtroFechaIni) && trim($filtroFechaIni) != '' && isset($filtroFechaFin) && trim($filtroFechaFin) != '') {
        $filtro .= " and fecha_registro::DATE BETWEEN TO_DATE('$filtroFechaIni', 'YYYY-MM-DD') AND TO_DATE('$filtroFechaFin', 'YYYY-MM-DD') ";
    }

    $sort_ = 'a.idmnsj_masivo';
    if (isset($sort) && trim($sort) != '') {
        $sort_ = $sort;
    }

    $order_ = 'DESC';
    if (isset($order) && trim($order) != '') {
        $order_ = $order;
    }

    $limit_ = 500;
    $offset_ = 0;
    if (isset($limit) && trim($limit) != '' && isset($offset) && trim($offset) != '') {
        $limit_ = $limit;
        $offset_ = $offset;
    }

    $conn = new Conexion();
    $cons = $conn->conectar();

    $query = "
        SELECT *
        FROM uf_mnsj_masivo a 
        WHERE estado_ is true  $filtro  
        ORDER BY $sort_ $order_  
        LIMIT $limit_ OFFSET $offset_;
    ";

    $stmt = $cons->query($query);
    $mnsjs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = array();
    foreach ($mnsjs as $key => $mnsj) {

        $accion = $mnsj['estado'] == 'ENVIADO' ? '<a class="btn btn-success" onclick="marcarAtendido(' . $mnsj['idmnsj_masivo'] . ')" title="Marcar como atendido" role="button"><i class="fa fa-check" aria-hidden="true"></i></a> ' : '';
        $accion .= $mnsj['estado'] == 'ATENDIDO' ? '<a class="btn btn-success" onclick="verDetallesAtencion(' . $mnsj['idmnsj_masivo'] . ', \'' . $cabecera['codigo_solicitud'] . '\')" title="Ver detalles de la atencion" role="button"><i class="fa fa-search-plus" aria-hidden="true"></i></a>' : '';

        $fila = array(
            "id" => $mnsj['idmnsj_masivo'],
            "documento_identidad" => $mnsj['documento_identidad'],
            "nombres" => $mnsj['nombres'],
            "contacto" => $mnsj['contacto'],
            "fecha_envio" => $mnsj['fecha_envio'],
            "estado" => $mnsj['estado'],
            "acciones" => $accion
        );
        $data[] = $fila;
    }

    echo json_encode($data);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "error" => true,
        "mensaje" => $e->getMessage(),
        "linea" => $e->getLine(),
        "archivo" => $e->getFile()
    ]);
}
