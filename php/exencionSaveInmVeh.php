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

// Ahora $datos es un array asociativo con la estructura correcta
$gestion = $datos['gestion'];
$tipo_solicitud = $datos['tipo_solicitud'];
$cntItem = $datos['cntItem'];
$ci_ = $_SESSION['cedula_identidad'];

//CODIGO DE SOLICITUD =>  YY-CODIGO DE USUARIO NUMERICO (000X)-NUMERO DE SECUENCIA 001   
$query = "select (coalesce (count(a.idcabecera),0)+1) as cnt 
        from exc_cabecera a left join  datm_usuario b on a.uregistro_ = b.id where b.cedula_identidad = '$ci_';";
$stmt = $cons->query($query);
$cntSolicitudes = $stmt->fetch(PDO::FETCH_ASSOC);
$codigo_solicitud = date('y') . "-" . str_pad($cntSolicitudes['cnt'], 4, '0', STR_PAD_LEFT) . "-" . str_pad($_SESSION['idusuario'], 3, '0', STR_PAD_LEFT);
$pjson['log'] .= "Codigo:" . $codigo_solicitud . "<br>\n";
$fecha_ = new DateTime(date('Y-m-d H:i:s'));
$fecha_registro = $fecha_->format('Y-m-d H:i:s');
$uregistro_ = $_SESSION['idusuario'];
$idestado = 1; // POR ENVIAR
$idrubro =  $datos['idrubro'];
$reg  = $datos['registro_tributario'];
$registro_tributario = implode(", ", $reg);

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

$pjson['err'] = '0';
$pjson['idactuado'] = '0';
try {

    $query = "INSERT INTO exc_cabecera (
            gestion,
            uregistro_,
            codigo_solicitud,
            fecha_registro,
            idestado,
            registro_tributario,
            idrubro,
            tipo_solicitud
                ) VALUES (
                    :gestion,
                    :uregistro_,
                    :codigo_solicitud,
                    :fecha_registro,
                    :idestado,
                    :registro_tributario,
                    :idrubro,
                    :tipo_solicitud
                )";

    $stmt = $cons->prepare($query);
    $stmt->bindParam(':gestion', $gestion);
    $stmt->bindParam(':uregistro_', $uregistro_);
    $stmt->bindParam(':codigo_solicitud', $codigo_solicitud);
    $stmt->bindParam(':fecha_registro', $fecha_registro);
    $stmt->bindParam(':idestado', $idestado);
    $stmt->bindParam(':registro_tributario', $registro_tributario);
    $stmt->bindParam(':idrubro', $idrubro);
    $stmt->bindParam(':tipo_solicitud', $tipo_solicitud);

    if (!$stmt->execute()) {
        $pjson['log'] .= $stmt->errorInfo()." - DURANTE REGISTRO CABECERA";
        $pjson['err'] = '1';
    } else {
        $idcabecera = $cons->lastInsertId();
    }


    //registro de los items (requisitos) -- en este caso de VEHICULO, deberemos registrar un exc_item para cada REQUISITO que esta detallado en exc_requisito, es decir un for para exc_requisito
    /**
    Si en caso los requisitos cambian entre EXENCION y EXCLUSION, se debera a gregar un campo nuevo en exc_requisito para identificar si se trata de exencion o exclusion
    */
    
    $query = "select * from exc_requisito where idrubro = '$idrubro' order by orden";
    $stmt = $cons->query($query);
    $requisitos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $idestado = 1; //PENDIENTE DE ENVIO 
    $nro_actuado = 1;

    //registro de los exc_item (requisitos)
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
    $stmt->bindParam(':idcabecera', $idcabecera);
    $stmt->bindParam(':idestado', $idestado);
    $stmt->bindParam(':fecha_registro', $fecha_registro);
    $stmt->bindParam(':nro_actuado', $nro_actuado);
    $stmt->bindParam(':token', $token);
    $stmt->bindParam(':fecha_validez_token', $fecha_validez_token);

    if (!$stmt->execute()) {
        $pjson['log'] .= $stmt->errorInfo()." EN REGSITRO exc_actuado";
        $pjson['err'] = '1';
    } else {
        $idactuado = $cons->lastInsertId();
        $pjson['idactuado'] = $idactuado;
    }
    foreach ($requisitos as $key => $requisito) {
        /* $pjson['log'] .= " - Registro de item:" . $idactuado . "<br>\n"; */
        //registro de los exc_item_actuado (documentos adjuntos para el requisito)            
        foreach ($datos['documentos']['listaReq' . $requisito['orden']]['docNames'] as $key => $doc) {
            if (!(!isset($doc) || $doc === null)) {
                $documento_path = $doc;

                $query = "INSERT INTO exc_item_actuado ( 
                    documento_path,
                    idusuario,
                    fecha_registro,
                    idestado,
                    idactuado,
                    idrequisito 
                    ) VALUES ( 
                    :documento_path,
                    :idusuario,
                    :fecha_registro,
                    :idestado,
                    :idactuado,
                    :idrequisito 
                    )";
                $stmt = $cons->prepare($query);
                $stmt->bindParam(':documento_path', $documento_path);
                $stmt->bindParam(':idusuario', $uregistro_);
                $stmt->bindParam(':fecha_registro', $fecha_registro);
                $stmt->bindParam(':idestado', $idestado);
                $stmt->bindParam(':idactuado', $idactuado);
                $stmt->bindParam(':idrequisito', $requisito['idrequisito']);
                if (!$stmt->execute()) {
                    $pjson['log'] .= $stmt->errorInfo()." EN REGISTRO exc_item_actuado";
                    $pjson['err'] = '1';
                } else {
                    $iditem_actuado = $cons->lastInsertId();
                    $pjson['log'] .= "   - Registro de actuado:" . $documento_path . ", exitoso<br>\n";
                }
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
