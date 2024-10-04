<?php
require_once("conexionpsql.php");

setlocale(LC_TIME, 'es_ES.UTF-8');

$err = array();
$err['err'] = '';
foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$conn = new Conexion();
$cons = $conn->conectar();
try {

    if ($numInmueble_ && $numInmueble_ != 'undefined')
        $query = "select * from inmueble_univ where (documento_identidad ilike '$ci_' OR documento_identidad_apo ilike '$ci_') and numero_inmueble  ilike '$numInmueble_' ";

    if ($num_placa_ && $num_placa_ != 'undefined')
        $query = "select * from vehiculo_univ where (documento_identidad ilike '$ci_' OR documento_identidad_apo ilike '$ci_') and \"NRO_PTA\"  ilike '$num_placa_' ";

    if ($num_act_ && $num_act_ != 'undefined')
        $query = "select * from actividad_univ where (documento_identidad ilike '$ci_' OR documento_identidad_apo ilike '$ci_') and \"NUMERO_ACTIVIDAD\"  ilike '$num_act_' ";

    $stmt = $cons->query($query);
    $err['sql'] = $query;
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    /* $err['sql'] .= "=====".json_encode($resultados); */
    if ($resultados) {
        $err['rsp'] = 1;
    } else
        $err['rsp'] = 0;
} catch (PDOException $e) {
    $err['err']  = "Error al ejecutar la consulta: " . $e->getMessage();
}
$dat = json_encode($err);
echo $dat;
