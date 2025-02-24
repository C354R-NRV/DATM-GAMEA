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

$query = "INSERT INTO exc_cabecera_hst (
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

$query = "UPDATE exc_cabecera 
            SET  estado_  = false, obs_baja = '".$observacion."' 
            WHERE idcabecera = " . $idsolicitud . ";";

$stmt = $cons->prepare($query);
$err[] = $stmt->execute(); 

$resp['err'] = $err;
$dat = json_encode($resp);
echo $dat;
