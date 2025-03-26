<?php
session_start();
require_once './conexionpsql.php';
require_once './sendMail.php';

$conn = new Conexion();
$cons = $conn->conectar();

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$pjson = array();

$fecha_ = new DateTime(date('Y-m-d H:i:s'));
$dias_habiles = 3;
while ($dias_habiles > 0) {
    $fecha_->modify('+1 day');
    // Si es sábado (6) o domingo (0), no se cuenta como día hábil
    if ($fecha_->format('N') < 6) {
        $dias_habiles--;
    }
}

$fecha_validez_token = $fecha_->format('Y-m-d H:i:s');
$token = $codigo_solicitud . '' . $fecha_validez_token;
$hash = hash('sha256', $token);
$token = substr($hash, 0, 6);

$query = "UPDATE exc_actuado 
            SET token = '$token', fecha_validez_token = '$fecha_validez_token' , intentos_token = 0
            where 
            idactuado = 
            (select  max(a.idactuado)
            from exc_actuado a 
            left join exc_cabecera b on a.idcabecera = b.idcabecera 
            where b.codigo_solicitud = '$codigo_solicitud'  and b.idestado = 1 and a.estado_ is true)
            ";
$stmt = $cons->prepare($query);
$err = $stmt->execute();

if ($err) {
    $pjson['log'] = 'Envio exitoso de nuevo token';
    $pjson['err'] = '0';
} else {
    $pjson['log'] = $stmt->errorInfo();
    $pjson['err'] = '1';
}

$aux_  = sendMailToken($_SESSION['correo'], $_SESSION['nombreUsuario'], $codigo_solicitud, $token,  $fecha_validez_token);
$pjson['err'] = $aux_[0];
$pjson['log'] .= $aux_[1];

$dat = json_encode($pjson);
echo $dat;
