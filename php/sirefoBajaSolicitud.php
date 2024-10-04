<?php
session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
$conn = new Conexion();
$cons = $conn->conectar();

$fechaEnvio = new DateTime(date('Y-m-d H:i:s'));
$fecha_envio = $fechaEnvio->format('Y-m-d H:i:s');

$query = "INSERT INTO srf_cabecera_solicitud_hst (
                id_cabecera_solicitud,
                campo,
                valor_anterior,
                valor_nuevo,
                fecha_modificacion,
                idusuario
            ) VALUES (
                " .  $idsolicitud . ",
                'estado_',
                true,
                false,
                '" . $fecha_envio . "',
                " . $_SESSION['idusuario'] . "
            )";
$stmt = $cons->prepare($query); 
$err[] = $stmt->execute(); 

$query = "UPDATE srf_cabecera_solicitud 
            SET  estado_  = false, obs_baja = '".$observacion."' 
            WHERE id_cabecera_solicitud = " . $idsolicitud . ";";

$stmt = $cons->prepare($query);
$err[] = $stmt->execute(); 

$resp['err'] = $err;
$dat = json_encode($resp);
echo $dat;
