<?php
session_start();
require_once './conexionpsql.php';

$conn = new Conexion();
$cons = $conn->conectar();
$cabecera = new stdClass();

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
} 

$pjson = array();  

// verificar si el numero de documento tiene deuda, solo en caso de que tenga deuda se mostrara un detalle
/**
 * SI ES TIPO CI, buscamos en los tres rubros
 */ 

if($tipoIdentificador_ == 'ci'){
	$query = "SELECT 'existe' AS resultado, '$documento_' as documento_identidad
			WHERE EXISTS (SELECT 1 FROM ruat_vehiculo_mora WHERE documento_identidad = '$documento_' OR documento_identidad_apo = '$documento_' )
			OR EXISTS (SELECT 1 FROM ruat_inmueble_mora WHERE documento_identidad = '$documento_' OR documento_identidad_apo = '$documento_')
			OR EXISTS (SELECT 1 FROM ruat_actividad_economica_mora WHERE documento_identidad = '$documento_' OR documento_identidad_apo = '$documento_')";
}
if($tipoIdentificador_ == 'veh'){
	$query = "SELECT 'existe' AS resultado, documento_identidad  FROM ruat_vehiculo_mora WHERE nro_pta = '$documento_'";
}
if($tipoIdentificador_ == 'inm'){
	$query = "SELECT 'existe' AS resultado, documento_identidad  FROM ruat_inmueble_mora WHERE numero_inmueble = '$documento_'";
}
if($tipoIdentificador_ == 'act'){
	$query = "SELECT 'existe' AS resultado, documento_identidad  FROM ruat_actividad_economica_mora WHERE numero_actividad = '$documento_'";
}  
$stmt = $cons->query($query);

$resp = $stmt->fetch(PDO::FETCH_ASSOC); 
$pjson['info'] = $resp;

if (empty($resp)) {
    $pjson['existe'] = '0'; 
} else {
    $pjson['existe'] = '1'; 
}

$dat = json_encode($pjson);
echo $dat;
