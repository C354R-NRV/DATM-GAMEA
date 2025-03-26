<?php
session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
$conn = new Conexion();
$cons = $conn->conectar();
$err = array();
$fechaEnvio = new DateTime(date('Y-m-d H:i:s'));
$fecha_envio = $fechaEnvio->format('Y-m-d H:i:s'); 
$campo = 'estado_';
$valor_anterior = true;
$valor_nuevo = false;

$query = "INSERT INTO exc_cabecera_hst (
            idcabecera, 
            campo,
            valor_anterior,
            valor_nuevo,
            fecha_modificacion,
            idusuario  
    ) VALUES (
        :idcabecera,  
        :campo,  
        :valor_anterior,  
        :valor_nuevo,  
        :fecha_modificacion,  
        :idusuario  
    )";

$stmt = $cons->prepare($query);
$stmt->bindParam(':idcabecera', $idsolicitud);
$stmt->bindParam(':campo', $campo);
$stmt->bindParam(':valor_anterior', $valor_anterior);
$stmt->bindParam(':valor_nuevo', $valor_nuevo);
$stmt->bindParam(':fecha_modificacion', $fecha_envio);
$stmt->bindParam(':idusuario', $_SESSION['idusuario']);  
$stmt->execute();


$query = "UPDATE exc_cabecera 
            SET  estado_  = false, obs_baja = '".$observacion."' , idestado = 10 , ubaja_=". $_SESSION['idusuario'].", fbaja_='".$fecha_envio."' 
            WHERE idcabecera = " . $idsolicitud . ";"; 
$stmt = $cons->prepare($query);
$err[] = $stmt->execute(); 

$resp['err'] = $err;
$dat = json_encode($resp);
echo $dat;
