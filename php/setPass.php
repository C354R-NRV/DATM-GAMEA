<?php
session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
$resp = array();
try {
    $conn = new Conexion();
    $cons = $conn->conectar();
    $query = "SELECT usuario
    FROM datm_usuario 
    WHERE id = " . $_SESSION['idusuario'] . " and password = MD5('$passwordAct_');";
    $stmt = $cons->query($query);
    $resultUsuario = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$resultUsuario) {
        throw new Exception('Contraseña incorrecta');
    } else {
        if (strlen(trim($passwordNuevo_)) > 3) {
            $queryUpdate = "UPDATE datm_usuario SET password = MD5(:valor_nuevo) WHERE id = :id";
            $stmtUpdate = $cons->prepare($queryUpdate);
            $stmtUpdate->bindParam(':valor_nuevo', $passwordNuevo_, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':id', $_SESSION['idusuario'], PDO::PARAM_INT);
            $stmtUpdate->execute();
            $resp['message']  = 'Se a realizado el cambio de contraseña exitosamente!';
            $resp['estado'] = 'green';
            $resp['title'] = 'Cambio exitoso!';
        } else {
            throw new Exception('La nueva contraseña es muy corta, longitud proporcionada:' . strlen(trim($passwordNuevo_)));
        }
    }
} catch (Exception $e) {
    $resp['message']  = $e->getMessage();
    $resp['estado'] = 'red';
    $resp['title'] = 'Ocurrio un error';
}
$dat = json_encode($resp);
echo $dat;
