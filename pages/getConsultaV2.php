<?php
require_once '../php/conexionpsql.php';

header('Content-Type: application/json');
foreach ($_GET as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
$auxFiltro = '';
if ($operativo != 'Todos') {
    $auxFiltro = " and o.idoperativo = $operativo ";
}

try {
    $conn = new conexion();
    $cons = $conn->conectar();
    $rs = array();
    $query = "SELECT  COUNT(*) AS total FROM uf_prepredial o WHERE estado_ = true   $auxFiltro";
    $stmt = $cons->query($query);
    $resp = $stmt->fetch(PDO::FETCH_ASSOC);
    $rs['total']  =  $resp['total'];
    $query = "SELECT  
                COUNT(DISTINCT pr.id) AS parcial
            FROM public.uf_predial pr
            LEFT JOIN public.uf_grupo_operativo g 
                ON g.idusuario = pr.idusuario
            LEFT JOIN public.uf_operativo o 
                ON g.idoperativo = o.idoperativo 
                AND o.fecha_operativo = CAST(pr.fecha_apersonamiento AS date)
            WHERE 
                pr.estado_ = true 
                AND pr.clasificacion = 'A'   $auxFiltro  ";
    $stmt = $cons->query($query);
    $resp = $stmt->fetch(PDO::FETCH_ASSOC);
    $rs['parcial']  = $resp['parcial'];
    echo json_encode($rs);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
