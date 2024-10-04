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
$pjson['cabecera'] = $simatCabecera;

if (empty($simatCabecera)) {
    $pjson['existeInmueble'] = '0'; // no existe
} else {
    $pjson['existeInmueble'] = '1'; // si existe 
    //buscamos datos de los items que tenga registrado para autocompletar 
    $query = "select var1, b.barrio||', '||a.tipocalle||' '||a.nombrecall||' #'||a.numcasa  as residencia, 
                        zona, 
                        CASE mat_vias
                        WHEN '1' THEN 'ASFALTO'
                        WHEN '2' THEN 'ADOQUIN'
                        WHEN '3' THEN 'CEMENTO'
                        WHEN '4' THEN 'LOSETA'
                        WHEN '5' THEN 'PIEDRA'
                        WHEN '6' THEN 'RIPIO'
                        WHEN '7' THEN 'TIERRA'
                        WHEN '8' THEN 'LADRILLO'
                        ELSE 'N/D' -- Por si hubiera algún valor fuera del rango
                    END AS tipo_via, agua, luz, alcantari, telefono, superficie, inclinac,
                    CASE viv_unifa
                        WHEN '0' THEN 'N/D'
                        WHEN '1' THEN 'LUJOSO'
                        WHEN '2' THEN 'MUY BUENA'
                        WHEN '3' THEN 'BUENA'
                        WHEN '4' THEN 'ECONOMICO'
                        WHEN '5' THEN 'INT. SOCIAL'
                        WHEN '6' THEN 'MARGINAL'
                        WHEN '7' THEN 'N/D'
                        ELSE 'N/D' END AS   tipo_contruccion, sup_const, bandera as estado
                from simat_pm01inmu as a 
                left join simat_pmbarrio as b on b.codigo = a.cod_barrio
                where a.comun = '" . $simatCabecera['doc_identidad'] . "';";

    $stmt = $cons->query($query);
    $inmuebles = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    $query =  "select  'TIPO DE FORMULARIO' as leyenda, tip_form, lote, fech_lote, folio 
                from simat_pmCONTRO where comun = '" . $simatCabecera['doc_identidad'] . "';";

    $stmt = $cons->query($query);
    $empadronamiento = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    
}

$dat = json_encode($pjson);
echo $dat;
