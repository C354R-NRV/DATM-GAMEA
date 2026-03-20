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
    $query = "select idoperativo, fecha_operativo, operativo from uf_operativo order by idoperativo DESC ;";
    $stmt = $cons->query($query);
    $resp = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $resp['message']  = $e->getMessage();
    $resp['estado'] = 'red';
    $resp['title'] = 'Ocurrio un error';
}
$dat = json_encode($resp);
echo $dat;
