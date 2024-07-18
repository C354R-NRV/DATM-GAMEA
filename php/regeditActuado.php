<?php
require_once("conexionpsql.php");

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}



$conn = new Conexion();
$cons = $conn->conectar();

$rs = array();
$rs['html'] = "Registro completado";
if($idactuado){
    $rs['html'] = "Edicion completatada";
}

$dat = json_encode($rs);
echo $dat;
