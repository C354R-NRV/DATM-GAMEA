<?php
session_start();
require_once './conexionpsql.php';

$conn = new Conexion();
$cons = $conn->conectar();

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$pjson = array();
$pjson['err'] = '0';
$err = '';

$fecha_ = new DateTime(date('Y-m-d H:i:s'));
$fecha = $fecha_->format('Y-m-d H:i:s');

$query = "SELECT COALESCE((
            select COALESCE(a.idactuado,0) idactuado
            from 
            exc_actuado a left join  exc_cabecera b on b.idcabecera = a.idcabecera
            where b.codigo_solicitud = '$codigo_solicitud' and a.token = '$token_' and a.fecha_validez_token >= '$fecha'
            and a.intentos_token < 3 and a.estado_ is true
            ), 0) AS idactuado;";

$pjson['query'] = $query;
$stmt = $cons->query($query);
$resp = $stmt->fetch(PDO::FETCH_ASSOC);

$pjson['log'] = '';
if ($resp['idactuado'] > 0) {

    $pjson['log'] .= 'El registro se realizo con exito!';
    $pjson['err'] = '0';

    $query = "SELECT * from exc_actuado where idactuado = " . $resp['idactuado'];
    $stmt = $cons->query($query);
    $respActuado = $stmt->fetch(PDO::FETCH_ASSOC);

    //actualizamos estado a ENVIADO, en cabecera como en los items_actuado
    $query = "UPDATE exc_cabecera 
    SET idestado = 2, fecha_envio = '$fecha ' 
    where  idcabecera = " . $respActuado['idcabecera'] . " ";
    $stmt = $cons->prepare($query);
    $err1 = $stmt->execute();
    if (!$err1) {
        $pjson['err'] = '1';
        $pjson['log'] .= $stmt->errorInfo() . "<br>\n";
    }

    $query = "UPDATE exc_actuado 
    SET idestado = 2
    where   idactuado =" . $respActuado['idactuado']  . " and estado_ is true;";

    $stmt = $cons->prepare($query);
    $err2  = $stmt->execute();
    if (!$err2) {
        $pjson['err'] = '1';
        $pjson['log'] .= $stmt->errorInfo() . "<br>\n";
    } 

    $query = "UPDATE exc_item_actuado 
    SET idestado = 2
    where idactuado =" . $respActuado['idactuado']  . "  and estado_ is true;";
    $stmt = $cons->prepare($query);
    $err2  = $stmt->execute();
    if (!$err2) {
        $pjson['err'] = '1';
        $pjson['log'] .= $stmt->errorInfo() . "<br>\n";
    }
} else {

    $query = "SELECT *  from exc_actuado where idactuado = (
    select max(a.idactuado) from exc_actuado a left join exc_cabecera b on a.idcabecera = b.idcabecera 
    where b.codigo_solicitud = '$codigo_solicitud' 
    and a.estado_ is true and a.idestado = 1)";

    $pjson['query'] = $query;
    $stmt = $cons->query($query);
    $respActuado = $stmt->fetch(PDO::FETCH_ASSOC);

    $query = "UPDATE exc_actuado 
    SET intentos_token = (intentos_token+1)
    where idactuado = " . $respActuado['idactuado'] . ";";
    $stmt = $cons->prepare($query);
    $err2  = $stmt->execute();

    $pjson['log'] .= 'El token no es válido o la fecha de validez del token culminó';
    $pjson['err'] = '1';
    $pjson['intentos_token'] = 3 - $respActuado['intentos_token'];
}
$dat = json_encode($pjson);
echo $dat;
