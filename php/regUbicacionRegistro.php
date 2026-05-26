<?php
require_once("conexionpsql.php");

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$conn = new Conexion();
$cons = $conn->conectar();

$rs = array();
$rs['html'] = "No se encontro el registro";
if($idregistro){
    $rs['html'] = "Ubicacion fisica registrada";
}

$dat = json_encode($rs);
echo $dat;
