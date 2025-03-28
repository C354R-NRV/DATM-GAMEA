<?php
session_start();
require_once './conexionpsql.php';
require_once './sendMail.php';

$conn = new Conexion();
$cons = $conn->conectar();

$pjson = array();
$err = '';

// Recibir datos JSON
$jsonData = file_get_contents('php://input');
$datos = json_decode($jsonData, true);


$fecha_ = new DateTime(date('Y-m-d H:i:s'));
$fecha_registro = $fecha_->format('Y-m-d H:i:s');
$uregistro_ = $_SESSION['idusuario'];

$dias_habiles = 3;
while ($dias_habiles > 0) {
    $fecha_->modify('+1 day');
    if ($fecha_->format('N') < 6) {
        $dias_habiles--;
    }
}
$codigo_solicitud = $datos['codigo_solicitud'];
$fecha_validez_token = $fecha_->format('Y-m-d H:i:s');
$token = $codigo_solicitud . '' . $fecha_validez_token;
$hash = hash('sha256', $token);
$token = substr($hash, 0, 6);

$pjson['err'] = '0';
$pjson['idactuado'] = '0';
try {

    $idestado = 1; //PENDIENTE DE ENVIO 
    $query = " 
    select max(b.nro_actuado) nro_actuado
    from exc_actuado b
    where b.idcabecera =  " . $datos['idcabecera'] . "  ";
    $stmt = $cons->query($query);
    $ultimoActuado = $stmt->fetch(PDO::FETCH_ASSOC);

    $nro_actuado_ = $ultimoActuado['nro_actuado'] + 1;

    $query = "INSERT INTO exc_actuado (
        idusuario, 
        idcabecera,
        idestado,
        fecha_registro,
        nro_actuado,
        token,
        fecha_validez_token
        ) VALUES (
            :idusuario, 
            :idcabecera,
            :idestado,
            :fecha_registro,
            :nro_actuado,
            :token,
            :fecha_validez_token
        )";
    $stmt = $cons->prepare($query);
    $stmt->bindParam(':idusuario', $uregistro_);
    $stmt->bindParam(':idcabecera', $datos['idcabecera']);
    $stmt->bindParam(':idestado', $idestado);
    $stmt->bindParam(':fecha_registro', $fecha_registro);
    $stmt->bindParam(':nro_actuado', $nro_actuado_);
    $stmt->bindParam(':token', $token);
    $stmt->bindParam(':fecha_validez_token', $fecha_validez_token);

    if (!$stmt->execute()) {
        $pjson['log'] .= $stmt->errorInfo();
        $pjson['err'] = '1';
    } else {
        $idactuado = $cons->lastInsertId();
        $pjson['idactuado'] = $idactuado;
    }

    for ($i = 1; $i <= $datos['cntItem']; $i++) {
        $iditem_act = $datos['documentos']['listaReq' . $i]['iditem_act'];
        $idrequisito = $datos['documentos']['listaReq' . $i]['idrequisito'];

        foreach ($datos['documentos']['listaReq' . $i]['docNames'] as $key => $item_) {

            if (!isset($item_) || $item_ === null) {
                $item_ = '';
            }
            $documento_path = $item_;


            $query = "INSERT INTO exc_item_actuado ( 
                        documento_path,
                        idusuario,
                        fecha_registro,
                        idestado,
                        idactuado,
                        idrequisito 
                        " . ($iditem_act != '' ? ",iditem_actuado_ant" : "") . "
                        ) VALUES ( 
                        :documento_path,
                        :idusuario,
                        :fecha_registro,
                        :idestado,
                        :idactuado,
                        :idrequisito 
                        " . ($iditem_act != '' ? ",:iditem_actuado_ant" : "") . "
                        )";
            $stmt = $cons->prepare($query);
            $stmt->bindParam(':documento_path', $documento_path);
            $stmt->bindParam(':idusuario', $uregistro_);
            $stmt->bindParam(':fecha_registro', $fecha_registro);
            $stmt->bindParam(':idestado', $idestado);
            $stmt->bindParam(':idactuado', $idactuado);
            $stmt->bindParam(':idrequisito', $idrequisito);
            if ($iditem_act != '')
                $stmt->bindParam(':iditem_actuado_ant', $iditem_act);

            if (!$stmt->execute()) {
                $pjson['log'] .= $stmt->errorInfo();
                $pjson['err'] = '1';
            } else {
                $iditem_actuado = $cons->lastInsertId();
            }
        }
    }

    $aux_  = sendMailToken($_SESSION['correo'], $_SESSION['nombreUsuario'], $codigo_solicitud, $token,  $fecha_validez_token);
    $pjson['err'] = $aux_[0];
    $pjson['log'] .= $aux_[1];
    $pjson['codigo_solicitud'] = $codigo_solicitud;
} catch (PDOException $e) {
    $pjson['err'] = '1';
    $pjson['log'] .= "<p class='rspIncorrecta'>[x] Error de base de datos: " . $e->getMessage() . "</p>";
} catch (Exception $e) {
    $pjson['err'] = '1';
    $pjson['log'] .= "<p class='rspIncorrecta'>[x] Error general: " . $e->getMessage() . "</p>";
} finally {
    $dat = json_encode($pjson);
    echo $dat;
}
