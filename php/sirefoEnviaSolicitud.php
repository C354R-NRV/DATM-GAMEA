<?php
session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
$conn = new Conexion();
$cons = $conn->conectar();

$query = "select * from datm_parametro";
$stmt = $cons->query($query);
$parametros = $stmt->fetch(PDO::FETCH_ASSOC);

$query = " select * from datm_usuario where estado like 'DESBLOQUEADO' and rol like 'DIRECCION' ";
$stmt = $cons->query($query);
$mae = $stmt->fetch(PDO::FETCH_ASSOC);

$query = "
select *
from srf_cabecera_solicitud a 
left join datm_usuario b on b.id = a.idusuario
where a.estado_   and a.id_cabecera_solicitud = $idsolicitud;";
$stmt = $cons->query($query);
$cabecera = $stmt->fetch(PDO::FETCH_ASSOC);

$cabeceraSolicitud = new stdClass();
$cabeceraSolicitud->Adjunto = $cabecera['adjunto'];
$cabeceraSolicitud->AdjuntoNombre = $cabecera['adjunto_nombre'];
$cabeceraSolicitud->AutoridadCargo = $mae['cargo'];
$cabeceraSolicitud->AutoridadSolicitante = $mae['nombres'] . ' ' . $mae['primer_apellido'] . ' ' . $mae['segundo_apellido'];
$cabeceraSolicitud->CodigoSolicitud  = $cabecera['codigo_solicitud'];
$cabeceraSolicitud->DetalleCantidad  = $cabecera['detalle_cantidad'];
$cabeceraSolicitud->FechaEnvio   = $cabecera['fecha_envio'];
$cabeceraSolicitud->Gerencia  = $parametros['nombre_entidad'];
$cabeceraSolicitud->HashDatos = $cabecera['hash_datos'];
$cabeceraSolicitud->HashImagen = $cabecera['hash_imagen'];
$cabeceraSolicitud->TipoProceso = $cabecera['tipo_proceso'];
$cabeceraSolicitud->Usuario = $cabecera['usuario'];

$query = "select nombre, apellido_paterno, apellido_materno,  
    razon_social,
    documento_identidad_numero, 
    documento_identidad_complemento,
    documento_identidad_extension,
	auto_conclusion, 
	tipo_respaldo, 
	documento_respaldo, 
	monto_retencion_bs, 
	monto_retencion_ufv, 
    a.tipo_persona, 
    cod_documento_identidad_tipo,
    a.id_item_solicitud

from srf_item_solicitud a 
left join srf_documento_identidad_extension b on b.id_documento_identidad_extension = a.id_documento_identidad_extension
left join srf_tipo_respaldo c on  c.id_tipo_respaldo = a.id_tipo_respaldo
left join srf_documento_identidad_tipo  d on d.id_documento_identidad_tipo = a.id_documento_identidad_tipo 
where a.estado_  and a.id_cabecera_solicitud = $idsolicitud order by a.id_item_solicitud asc;";

$stmt = $cons->query($query);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);


$itemsSolicitud_ = array();
foreach ($items as $key => $item) {
    $itemSolicitud = new stdClass();
    $itemSolicitud->ApellidoMaterno = $item['apellido_materno'];
    $itemSolicitud->ApellidoPaterno = $item['apellido_paterno'];
    $itemSolicitud->AutoConclusion = $item['auto_conclusion'];
    $itemSolicitud->DocumentoIdentidadComplemento = $item['documento_identidad_complemento'];
    $itemSolicitud->DocumentoIdentidadExtension = $item['documento_identidad_extension'];
    $itemSolicitud->DocumentoIdentidadNumero = $item['documento_identidad_numero'];
    $itemSolicitud->DocumentoIdentidadTipo = $item['cod_documento_identidad_tipo'];
    $itemSolicitud->DocumentoRespaldo = $item['documento_respaldo'];
    $itemSolicitud->item = $item['id_item_solicitud'];
    $itemSolicitud->MontoRetencionBs = $item['monto_retencion_bs'];
    $itemSolicitud->MontoRetencionUFV = $item['monto_retencion_ufv'];
    $itemSolicitud->Nombres = $item['nombre'];
    $itemSolicitud->RazonSocial = $item['razon_social'];
    $itemSolicitud->TipoRespaldo = $item['tipo_respaldo'];
    $itemsSolicitud_[] = $itemSolicitud;
}

$resp['itemsSolicitud_'] = $itemsSolicitud_;
$resp['cabeceraSolicitud'] = $cabeceraSolicitud;
/* $dat = json_encode($resp);
echo $dat; 
*/
echo json_encode($cabeceraSolicitud);
echo "<hr>";
echo json_encode($itemsSolicitud_);
