<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

define('FCPATHpaquete', dirname(__FILE__) . DIRECTORY_SEPARATOR);
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

require_once("conexionpsql.php");
/* require_once("sendMail.php");
 */
foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$conn = new Conexion();
$cons = $conn->conectar();

$swRegistro = true;
$pin = '';
$estado_pin = 'REASIGNADO';
$destinatiario = "$nombre_ $paterno_";
$correoDestino = $correo_;
$swSendMail = false;
$fechaPin  = date('Ymd');
$fechaRegistroPin = date('Y-m-d');

$sql = "select correo from contribuyente where (documento_identidad ilike '$ci_' OR documento_identidad_apo ilike '$ci_')
        and ( REPLACE(TRIM(COALESCE(nombre_rsocial,'') || COALESCE(nombre_apo,'')), '.', '')  ilike REPLACE(TRIM('%$nombre_%'), '.', '') ) 
        and ( REPLACE(TRIM(COALESCE(primer_apellido_sigla,'') || COALESCE(primer_apellido_apo,'')), '.', '')  ilike REPLACE(TRIM('%$paterno_%'), '.', '') )  ";

$stmt = $cons->query($sql);
$resultadosContri = $stmt->fetchAll(PDO::FETCH_ASSOC);

$rs = array(); 
$rs['titulo_'] = "Información no validada";
$rs['color_'] = "red";
$rs['contenido_'] = "El $tipodoc_ $ci_, con Nombre/Razon social: $nombre_ $paterno_, no se logro validar en los registros de contibuyentes";

//verificamos si el contribuyente ya existe en la base de datos interna del sistema | considerando que previamente se habria cargado con informacion de RUAT los datos de los contribyentes


if ($resultadosContri) {
    $pin = generarPIN($ci_, $fechaPin);
    try {
        $sqlUpdate = "
            UPDATE contribuyente SET estado_ = :estado_, pin = :pin, estado_pin = :estado_pin, 
                    fecha_registro_pin = :fecha_registro_pin, numero_contacto = :numero_contacto, 
                    correo = :correo  
                    WHERE documento_identidad like :documento_identidad or documento_identidad_apo ilike :documento_identidad_apo";
        $stmtUpdate = $cons->prepare($sqlUpdate);
        $estado_ = '1';
        $stmtUpdate->bindParam(':pin', $pin, PDO::PARAM_INT);
        $stmtUpdate->bindParam(':estado_pin', $estado_pin, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':fecha_registro_pin', $fechaRegistroPin, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':documento_identidad', $ci_, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':documento_identidad_apo', $ci_, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':numero_contacto', $cel_, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':correo', $correo_, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':estado_', $estado_, PDO::PARAM_STR);

        //[PENDIENTE] crear un log de los cambios realizados, un historico de registros de esta tabla previo a guardar

        if ($stmtUpdate->execute()) {
            $rs['titulo_'] = "Solicitud procesada!";
            $rs['contenido_'] = "En breve le llegará un correo a: <b>$correoDestino</b>, el cual contiene el numero PIN asignado a su cuenta";
            $rs['color_'] = "green";
            $swSendMail = true;
        } else {
            $rs['titulo_'] =  "Error al actualizar el PIN";
            $rs['contenido_'] = "No se ha logrado actualizar el numero PIN en la base de datos, por favor intentelo nuevamente";
        }

        if ($swSendMail) {
            $rssendmail_ = sendMail($correoDestino, "$nombre_ $paterno_", $pin);
            if ($rssendmail_ != 'ok') {
                $rs['titulo_'] = "Problemas de envio de PIN!";
                $rs['contenido_'] = "No se logro enviar el codigo PIN al corre:$correo_, por favor vuelva a intentarlo nuevamente." . $rssendmail_;
                $rs['color_'] = "red";
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    /* try {
            $pin = generarPIN($ci_, $fechaPin);
            $estado_pin = 'ASIGNADO';
            $sql = "INSERT INTO contribuyente (nombre_rsocial, primer_apellido_sigla, segundo_apellido, apellido_esposo, tipo_documento, documento_identidad, numero_contacto, correo, fecha_nacimiento, pin, fecha_registro_pin, estado_pin) 
            VALUES (:nombre_rsocial, :primer_apellido_sigla, :segundo_apellido, :apellido_esposo, :tipo_documento, :documento_identidad, :numero_contacto, :correo, :fecha_nacimiento, :pin, :fecha_registro_pin, :estado_pin)";
            $stmt = $cons->prepare($sql);
            $stmt->bindParam(':nombre_rsocial', $nombre_, PDO::PARAM_STR);
            $stmt->bindParam(':primer_apellido_sigla', $paterno_, PDO::PARAM_STR);
            $stmt->bindParam(':segundo_apellido', $materno_, PDO::PARAM_STR);
            $stmt->bindParam(':apellido_esposo', $apcasada_, PDO::PARAM_STR);
            $stmt->bindParam(':tipo_documento', $tipodoc_, PDO::PARAM_STR);
            $stmt->bindParam(':documento_identidad', $ci_, PDO::PARAM_STR);
            $stmt->bindParam(':numero_contacto', $cel_, PDO::PARAM_STR);
            $stmt->bindParam(':correo', $correo_, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_nacimiento', $fnacimiento_, PDO::PARAM_STR);
            $stmt->bindParam(':pin', $pin, PDO::PARAM_INT);
            $stmt->bindParam(':estado_pin', $estado_pin, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_registro_pin', $fechaRegistroPin, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $rs['titulo_'] = "Registro exitoso!";
                $rs['contenido_'] = "Se efectuó con éxito el registro de la información proporcionada, en breve le llegará un correo a $correo_, el cual contiene el numero PIN asignado a su cuenta";
                $rs['color_'] = "green";
                $swSendMail = true;
            } else {
                $rs['titulo_'] =  "Error al insertar el registro";
                $rs['contenido_'] = "No se ha logrado realizar el registro en la base de datos, por favor intentelo nuevamente";
            }
        } catch (PDOException $e) {
            $swRegistro = false;
            $rs['titulo_'] = "Excepción!";
            $rs['contenido_'] = "Error: " . $e->getMessage();
        } */
    $rs['titulo_'] = "Contribuyente no encontrado";
    $rs['contenido_'] = "La información proporcionada no coincide con ninguna información de contribuyente registrado en el municipio de El Alto";
    $rs['color_'] = "red";
}

$dat = json_encode($rs);
echo $dat;
function generarPIN($ci, $fechaPin)
{
    $datos_combinados = $ci . $fechaPin;
    $hash = hash('sha256', $datos_combinados);
    $pin = substr($hash, 0, 4);
    $pin_numerico = preg_replace("/[^0-9]/", "0", $pin);
    return $pin_numerico;
}


function sendMail($destino, $nombres, $pin)
{
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'gamea.datm@gmail.com';
        $mail->Password   = 'hugyawubxrsphznl';
        $mail->Port       = 587;
        $mail->SMTPSecure = 'tls';
        $mail->setFrom($mail->Username, 'ASIGNACION DE PIN - DATM');
        $mail->addAddress($destino, $nombres);

        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);
        $mail->Subject = 'ASIGNACION DE PIN - DATM';
        $mail->Body    = "<span style='color:#000;'><p>Estimado <b>$nombres</b> a través  del presente, se le ha asignado el siguiente numero PIN:</p></span><br>
                    <div style='width:100%;text-align:center; color:#000;'><div style='width:40%;border:1px #1d7fed solid; margin: 0 auto; border-radius: 10px; '><h1>$pin</h1></div></div>
                    <br>
                    <span style='color:#000;'>Este número PIN, le permitirá acceder a información general de la cantidad de inmuebles, vehículos o actividades económicas que se encuentran inscritos a su nombre. </span>
                    <br>
                    <br>
                    <span style='color:#6b0d0d;font-size:0.7rem;'>No es necesario que responda a este correo<br></span>
                    <span style='color:gray;font-size:0.7rem;'><br>Área de sistemas<br>Dirección de Administración Tributaria Municipal<br>Gobierno Autónomo Municipal de El Alto</span>
                    ";

        $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));

        $mail->send();

        return 'ok';
    } catch (Exception $e) {
        return "<br><br>El mensaje no pudo ser enviado. Error de PHPMailer: {$mail->ErrorInfo}";
    }
}
