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
$pjson['error'] = false;
try {
	$query = " select count(*) as cnt
	from simat_pm01cont  as a
	left join simat_pmbarrio as b on b.codigo = a.cod_barrio
	left join siim_satnombr as c on c.documento = a.comun 
	where ";
	if ($tipo_ == 'doc') {
		$query .= "   a.comun = '$ci_' ";
	}
	if ($tipo_ == 'pmcAnt') {
		$query .= "   c.pmc = '$ci_'; ";
	}
	if ($tipo_ == 'numInm') {
		$query = "  select count(*) as cnt from simat_inmgen where numero = '$ci_';";
	}

	$stmt = $cons->query($query);

	$simatCabecera = $stmt->fetch(PDO::FETCH_ASSOC);


	$pjson['cnt'] = $simatCabecera['cnt'];
	if ($simatCabecera['cnt'] > 0) {
		$pjson['existeInmueble'] = '1'; // si existe  
	} else {
		$pjson['existeInmueble'] = '0'; // no existe
	}

	$dat = json_encode($pjson);
	echo $dat;
} catch (PDOException $e) {
	$pjson['error'] = true;
	$pjson['message'] = "Database error: " . $e->getMessage();
	$pjson['code'] = $e->getCode();
	error_log("Database error in " . __FILE__ . ": " . $e->getMessage());
	echo json_encode($pjson);
} catch (Exception $e) {
	$pjson['error'] = true;
	$pjson['message'] = "Unexpected error: " . $e->getMessage();
	$pjson['code'] = $e->getCode();
	error_log("Unexpected error in " . __FILE__ . ": " . $e->getMessage());
	echo json_encode($pjson);
}
