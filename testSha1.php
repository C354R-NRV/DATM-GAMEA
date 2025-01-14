<?php 
session_start();
require_once './conexionpsql.php';

$pjson = array();
$pjson['log'] =  "";
$pjson['err'] = '0';
$err = '';
 
    $conn = new Conexion();
    $cons = $conn->conectar();

    $query = "UPDATE srf_estado_solicitud 
                SET estado_ = false ";
        $stmt = $cons->prepare($query);
        $err = $stmt->execute();