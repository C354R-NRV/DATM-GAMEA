<?php
session_start();
require_once './conexionpsql.php';

$conn = new Conexion();
$cons = $conn->conectar();
$cabecera = new stdClass();

foreach ($_POST as $clave => $valor) {
    if (strpos($clave, 'cabecera_') === 0) {
        $key = str_replace('cabecera_', '', $clave);
        $cabecera->$key = addslashes(trim($valor));
    }
}

$pjson = array();

$query = " select adjunto_nombre, detalle_cantidad,  id_cabecera_solicitud
from srf_cabecera_solicitud 
where  codigo_solicitud = '" . $cabecera->CodigoSolicitud . "'  
and tipo_proceso = '" . $cabecera->TipoProceso . "' and estado_ ";
$stmt = $cons->query($query);
$srfCabecera = $stmt->fetch(PDO::FETCH_ASSOC);
$pjson['info'] = $srfCabecera;
if (empty($srfCabecera)) {
    $pjson['existeSolicitud'] = '0'; // no existe
} else {
    $pjson['existeSolicitud'] = '1'; // si existe 
    //buscamos datos de los items que tenga registrado para autocompletar 
    $query = " select tipo_persona, id_documento_identidad_tipo, documento_identidad_numero, documento_identidad_complemento,
    id_documento_identidad_extension, razon_social, nombre, apellido_paterno, apellido_materno, 
    auto_conclusion, id_tipo_respaldo, documento_respaldo, monto_retencion_bs, monto_retencion_ufv, id_item_solicitud 
    from srf_item_solicitud 
    where  id_cabecera_solicitud = " . $srfCabecera['id_cabecera_solicitud'] . "  and estado_    order by id_item_solicitud asc;";
    $stmt = $cons->query($query);
    $srfItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $pjson['infoItem'] = $srfItems;
}

$dat = json_encode($pjson);
echo $dat;
