<?php
session_start();
require_once './conexionpsql.php';

// Recibir datos JSON
$jsonData = file_get_contents('php://input');
$datos = json_decode($jsonData, true);

// Ahora $datos es un array asociativo con la estructura correcta
$gestion = $datos['gestion'];
$documentos = $datos['documentos'];
$cntItem = $datos['cntItem'];

$pjson = array();
$err = '';

try {
    $conn = new Conexion();
    $cons = $conn->conectar();
    $query = "select * from datm_parametro";
    $stmt = $cons->query($query); 

    $parametros = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $pjson['err'] = '1';
    $pjson['log'] .= "<p class='rspIncorrecta'>[x] Error de base de datos: " . $e->getMessage() . "</p>";
} catch (Exception $e) {
    $pjson['err'] = '1';
    $pjson['log'] .= "<p class='rspIncorrecta'>[x] Error general: " . $e->getMessage() . "</p>";
} finally {
    //$dat = json_encode($pjson); 
    echo $datos;
}
