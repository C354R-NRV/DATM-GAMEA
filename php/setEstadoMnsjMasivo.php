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
    $estado = 'ATENDIDO';
    $queryUpdate = "UPDATE uf_mnsj_masivo SET estado = :estado, idusuario_atencion = :idusuario_atencion,  fecha_atencion = :fecha_atencion  WHERE idmnsj_masivo = :idmnsj_masivo";
    $stmtUpdate = $cons->prepare($queryUpdate);
    $stmtUpdate->bindParam(':idmnsj_masivo', $idmnsj_masivo, PDO::PARAM_INT);
    $stmtUpdate->bindParam(':estado', $estado,  PDO::PARAM_STR);
    $stmtUpdate->bindParam(':idusuario_atencion', $_SESSION['idusuario'], PDO::PARAM_INT);
    $fechaEnvio = new DateTime(date('Y-m-d H:i:s'));
    $fregistro_ = $fechaEnvio->format('Y-m-d H:i:s');
    $stmtUpdate->bindParam(':fecha_atencion', $fregistro_);

    if ($stmtUpdate->execute()) {
        $rs['titulo_'] = "Solicitud procesada!";
        $rs['contenido_'] = "Estado actualizado a atendido";
        $rs['color_'] = "green";
        $swSendMail = true;
    } else {
        $rs['titulo_'] =  "Error durante el registro";
        $rs['contenido_'] = "No se ha logrado actualizar, por favor intentelo nuevamente";
    }
} catch (Exception $e) {
    $resp['message']  = $e->getMessage();
    $resp['estado'] = 'red';
    $resp['title'] = 'Ocurrio un error';
}
$dat = json_encode($resp);
echo $dat;
