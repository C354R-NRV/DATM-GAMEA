<?php
function getInfoInmuebleRpt($cons, $ci_, $numInmueble_)
{
    $query = "select *, TRIM(replace(replace(replace(ubicacion_nivel2, 'LOTE,', ''), 'COMUNIDAD:', ''), 'URBANIZACION,', '')) as auxdireccion  from inmueble_univ where documento_identidad like '$ci_' and numero_inmueble like '$numInmueble_' ";
    $stmt = $cons->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getInfoVehRpt($cons, $ci_, $num_placa_)
{
    $query = "select *  from vehiculo_univ where  (documento_identidad ilike '$ci_' OR documento_identidad_apo ilike '$ci_') and \"NRO_PTA\" like '$num_placa_' ";
    $stmt = $cons->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
} 
function getInfoVeh10_11Rpt($cons, $ci_)
{
    $query = "select *  from vehiculo_univ where  (documento_identidad ilike '$ci_' OR documento_identidad_apo ilike '$ci_')";
    $stmt = $cons->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
} 
function getInfoActRpt($cons, $ci_, $num_act_)
{
    $query = "select *  from actividad_univ where  (documento_identidad ilike '$ci_' OR documento_identidad_apo ilike '$ci_') and \"NUMERO_ACTIVIDAD\" like '$num_act_' ";
    $stmt = $cons->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
} 
function getInfoActBaseCiRpt($cons, $ci_)
{
    $query = "select *  from actividad_univ where  (documento_identidad ilike '$ci_' OR documento_identidad_apo ilike '$ci_')";
    $stmt = $cons->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
} 