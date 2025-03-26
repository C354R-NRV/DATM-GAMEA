<?php
session_start();
require_once './conexionpsql.php';
require_once './whatsappNotificacion.php';


foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}


$conn = new Conexion();
$cons = $conn->conectar();

$pjson = array();
$err = '';
$pjson['err'] = '0';
$itemObservadoSw = true;

$uploadDir = '../static/exencion/' . $_SESSION['usuario'];
try {

    $swExisteFile = false;
    if (isset($_FILES["archivoPdf"]["tmp_name"])) {
        $swExisteFile = true;
        $fileName = str_replace(".pdf", "", $documento_path) . '_rev.pdf';
        $fileTmpPath = $_FILES["archivoPdf"]["tmp_name"];

        // Si la carpeta del usuario no existe, crearla
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (!move_uploaded_file($fileTmpPath,   $uploadDir . '/' . $fileName)) {
            $err .= "Hubo un error al guardar el archivo en el directorio de destino.";
            $pjson['err'] = '1';
            $pjson['log'] .= '<p>[x] Hubo un error al guardar el archivo en el directorio de destino <br>-' .  $uploadDir . '<br>' . $fileName . '-.</p><br><p>' . error_get_last()['message'] . '</p>';
        } else {
            $pjson['log'] .= '<p>- Archivo subido correctamente.</p>';
        }
    }


    //GUARDAR ACTUADO
    $idestado = 5;
    if ($observacion === '' and !$swExisteFile) {
        $idestado  = 6;
        $itemObservadoSw = false;
    }


    $query = "UPDATE exc_item_actuado 
            SET  idestado  = $idestado , idusuario = " . $_SESSION['idusuario'] . "  , observacion  = '" . $observacion . "', documento_path = '" . $fileName . "'  
            WHERE iditem_act = $iditem_act;";

    $stmt = $cons->prepare($query);
    if (!$stmt->execute()) {
        $pjson['log'] .= $stmt->errorInfo();
        $pjson['err'] = '1';
    }

    
    $idestado = 4;  

    $query = "UPDATE exc_actuado 
            SET  idestado  = $idestado  
            WHERE idactuado = $idactuado;";
    $stmt = $cons->prepare($query);
    if (!$stmt->execute()) {
        $pjson['log'] .= $stmt->errorInfo();
        $pjson['err'] = '1';
    }

    $query = "UPDATE exc_cabecera 
            SET  idestado  = $idestado  
            WHERE idcabecera = $idcabecera;";
    $stmt = $cons->prepare($query);
    if (!$stmt->execute()) {
        $pjson['log'] .= $stmt->errorInfo();
        $pjson['err'] = '1';
    }

    $fechaEnvio = new DateTime(date('Y-m-d H:i:s'));
    $fecha_envio = $fechaEnvio->format('Y-m-d H:i:s');
    $campo = 'idestado';
    $valor_anterior = true;
    $valor_nuevo = $idestado;

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
    $stmt->bindParam(':idcabecera', $idcabecera);
    $stmt->bindParam(':campo', $campo);
    $stmt->bindParam(':valor_anterior', $valor_anterior);
    $stmt->bindParam(':valor_nuevo', $valor_nuevo);
    $stmt->bindParam(':fecha_modificacion', $fecha_envio);
    $stmt->bindParam(':idusuario', $_SESSION['idusuario']);
    if (!$stmt->execute()) {
        $pjson['log'] .= $stmt->errorInfo();
        $pjson['err'] = '1';
    }
    
} catch (PDOException $e) {
    $pjson['err'] = '1';
    $pjson['log'] .= "<p class='rspIncorrecta'>[x] Error de base de datos: " . $e->getMessage() . "</p>";
} catch (Exception $e) {
    $pjson['err'] = '1';
    $pjson['log'] .= "<p class='rspIncorrecta'>[x] Error general: " . $e->getMessage() . "</p>";
} finally {


    if ($pjson['err'] == 0 and  $itemObservadoSw) {
        $query = " 
        select b.detalle, a.observacion, ant.documento_path , d.contacto,  upper(concat(nombres, ' ', primer_apellido, ' ', segundo_apellido)) nombres, c.codigo_solicitud
        from exc_item_actuado a  
        left join exc_requisito b on b.idrequisito = a.idrequisito 
        left join exc_actuado e on e.idactuado = a.idactuado
        left join exc_cabecera c on c.idcabecera = e.idcabecera
        left join exc_item_actuado ant on ant.iditem_act = a.iditem_actuado_ant
        left join datm_usuario d on d.id = c.uregistro_
        where a.iditem_act = $iditem_act ;";
        $stmt = $cons->query($query);
        $itemobservado = $stmt->fetch(PDO::FETCH_ASSOC);

        $contacto_ = $itemobservado['contacto'];
        $nombre_ = $itemobservado['nombres'];

        $mensaje = '🚨 Esta es una notificación automática desde *D.A.T.M.*
(No responda a este mensaje por favor).

*Estimad@ ' . trim($nombre_) . '*

En el requisito de *' . $itemobservado['detalle'] . '*, se tiene la siguiente observación:

" _' . trim($itemobservado['observacion']) . '_ "

Para el documento: ' . $itemobservado['documento_path'] . '

Ingrese al sistema, modulo: EXENCIÓN, solicitud: ' . $itemobservado['codigo_solicitud'] . ' para ver más detalles.
https://datm.elalto.gob.bo/ 

¡La Dirección de Administración Tributaria Municipal de El Alto esta a su servicio!';

        //[PENDIENTE] completar manejo de posibles errores
        enviarMensajeWhatsApp('591' . $contacto_, $mensaje);
    }

    $dat = json_encode($pjson);
    echo $dat;
}
