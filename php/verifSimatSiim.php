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

$query = " select a.id, a.comun as  doc_identidad, c.pmc,  TRIM(
			COALESCE(a.nombre, '') || 
			CASE 
				WHEN a.paterno IS NOT NULL AND a.nombre IS NOT NULL THEN ' ' ELSE '' END || 
			COALESCE(a.paterno, '') || 
			CASE 
				WHEN a.materno IS NOT NULL AND (a.nombre IS NOT NULL OR a.paterno IS NOT NULL) THEN ' ' ELSE '' END || 
			COALESCE(a.materno, '')
		) AS nombre_completo,
		b.barrio||', '||a.tipocalle||' '||a.nombrecall||' #'||a.numcasa as residencia
from simat_pm01cont  as a
left join simat_pmbarrio as b on b.codigo = a.cod_barrio
left join siim_satnombr as c on c.documento = a.comun
where a.comun = '$ci_' or c.pmc = '$ci_'; ";

$stmt = $cons->query($query);

$simatCabecera = $stmt->fetch(PDO::FETCH_ASSOC); 

if (empty($simatCabecera)) {
    $pjson['existeInmueble'] = '0'; // no existe
} else {
    $pjson['existeInmueble'] = '1'; // si existe  
}

$dat = json_encode($pjson);
echo $dat;
