<?php
session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$conn = new Conexion();
$cons = $conn->conectar();

$resp = array();

$resp['cntRetenciones'] = 0;
try {
    $rubroAux = 'actividad_univ';
    $filtro = 'numero_actividad';
    switch ($rubro) {
        case 'VEH': {
                $rubroAux = 'vehiculo_univ';
                $filtro = 'nro_pta';
                break;
            }
        case 'INM': {
                $rubroAux = 'inmueble_univ';
                $filtro = 'numero_inmueble';
                break;
            }
    }

    $query = "
    select tipo_contribuyente, tipo_documento,documento_identidad ,   expedido, nombre_rsocial, primer_apellido_sigla,  segundo_apellido , apellido_esposo,
    COALESCE (tipo_apoderado,'x') tipo_apoderado, trim(upper(concat(nombre_apo, ' ', primer_apellido_apo, ' ', segundo_apellido_apo))) nombre_apo, 
    trim(concat(tipo_documento_apo, ' ', documento_identidad_apo, ' ',  expedido_apo  )   ) as documento_identidad_apo
    from  $rubroAux   
    where  $filtro = '$documentoTributario';";

    $stmt = $cons->query($query);
    $contribuyente_ = $stmt->fetch(PDO::FETCH_ASSOC);
    $resp['contribuyente']  = $contribuyente_;

    $query = " 
    select b.id_tipo_respaldo, c.tipo_respaldo_det, b.documento_respaldo, b.id_item_solicitud, a.id_cabecera_solicitud, a.fecha_envio
    from srf_cabecera_solicitud a 
    left join srf_item_solicitud b on a.id_cabecera_solicitud = b.id_cabecera_solicitud
    left join srf_tipo_respaldo c on c.id_tipo_respaldo = b.id_tipo_respaldo
    where a.tipo_proceso = 'R'
    and b.documento_tributario = '$documentoTributario'  
    and b.tipo_documento_tributario = '$rubro'  
    and b.estado_ is true
    and b.id_item_solicitud not in (
    select x.id_item_solicitud  
    from  
    srf_cabecera_solicitud y 
    left join srf_item_solicitud x on x.id_cabecera_solicitud = y.id_cabecera_solicitud  
    where x.estado_ is true and  x.documento_tributario = '$documentoTributario'   
    and x.tipo_documento_tributario = '$rubro' and y.tipo_proceso = 'S'
    ) ; ";
    $stmt = $cons->query($query);
    $retenciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $resp['htmlRetenciones']  = "";
    if (count($retenciones) > 0) {
        $resp['htmlRetenciones']  .= "<br><select id='retenciones_$nroItem' class='form-controlSelect' onchange='setearRetenciones($nroItem)'>
        <option value=''>Seleccione</option>
        ";
        foreach ($retenciones as $key => $value) {
            $resp['htmlRetenciones']  .= "<option value='" . $value['id_tipo_respaldo'] . "_" . $value['documento_respaldo'] . "'>" . $value['tipo_respaldo_det'] . ": " . $value['documento_respaldo'] . " [" . $value['fecha_envio'] . "]</option>";
        }
        $resp['htmlRetenciones']  .= "</select>";
    }
    $resp['estado'] = '';
    $resp['cntRetenciones'] = count($retenciones);
} catch (Exception $e) {
    $resp['message']  = $e->getMessage();
    $resp['estado'] = 'red';
    $resp['title'] = 'Ocurrio un error';
}
$dat = json_encode($resp);
echo $dat;
