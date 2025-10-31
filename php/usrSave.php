<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

define('FCPATHpaquete', dirname(__FILE__) . DIRECTORY_SEPARATOR);
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

require_once './conexionpsql.php';

$usr = new stdClass();
foreach ($_POST as $clave => $valor) {
    if (strpos($clave, 'usr_') === 0) {
        $key = str_replace('usr_', '', $clave);
        $usr->$key = addslashes(trim($valor));
    }
}

$pjson = array();
$err = '';
$pjson['err'] = '0';
try {
    $uploadDir = '../static/solicitud_credencial/';
    if (isset($_FILES["usr_archivoPdf"]["tmp_name"])) {
        $fileName = 'usr_' . uniqid() . '.pdf';
        $fileTmpPath = $_FILES["usr_archivoPdf"]["tmp_name"];
        if (!move_uploaded_file($fileTmpPath,   $uploadDir . $fileName)) {
            $pjson['err'] = '1';
            $pjson['log'] .= '<p>[x] Hubo un error al guardar el archivo en el directorio de destino -' .  $uploadDir . $fileName . '-.</p><p>' . error_get_last()['message'] . '</p>';
        } else {
            $pjson['log'] .= '<p>- Archivo subido correctamente.</p>';
        }
        $pdfFile = file_get_contents($uploadDir . $fileName);
    }


    $fecha = new DateTime(date('Y-m-d H:i:s'));
    $fecha_ = $fecha->format('Y-m-d H:i:s');
    $nom_ = ($usr->nombres != '' ? $usr->nombres : $usr->razonSocial);
    $fechaPin  = date('Ymd');

    $usuario = strtoupper($usr->correo);
    $hash = hash('sha256', $cedula_identidad . $fechaPin);
    $pass = substr($hash, 0, 8);

    $conn = new Conexion();
    $cons = $conn->conectar();
    $estado_ = 'DESBLOQUEADO';

    if ($usr->rol != 'CONTRIBUYENTE') {
        $usuario = generarUsuario($nom_, $usr->primer_apellido, $usr->segundo_apellido);
        $pass = $usr->cedula_identidad;
    }

    $query = "INSERT INTO datm_usuario 
                (fecha_registro, cedula_identidad, nombres, 
                primer_apellido, segundo_apellido, usuario, 
                password, codigo_unidad, rol, 
                estado, contacto, cargo, 
                area, 
                correo, tipo_persona, path_documento_solicitud, 
                cite_documento_solicitud, cedula_identidad_complemento, id_documento_identidad_tipo) VALUES (

                :fecha_registro, :cedula_identidad, :nombres, 
                :primer_apellido, :segundo_apellido, :usuario, 
                :passwords, :codigo_unidad, :rol, 
                :estado, :contacto, :cargo, 
                :area, 
                :correo, :tipo_persona, :path_documento_solicitud, 
                :cite_documento_solicitud, :cedula_identidad_complemento, :id_documento_identidad_tipo
                )";
    $stmt = $cons->prepare($query);
    $stmt->bindParam(':fecha_registro',  $fecha_);
    $stmt->bindParam(':cedula_identidad', $usr->cedula_identidad);
    $stmt->bindParam(':nombres', $nom_);
    $stmt->bindParam(':primer_apellido', $usr->primer_apellido);
    $stmt->bindParam(':segundo_apellido', $usr->segundo_apellido);
    $stmt->bindParam(':usuario', strtoupper($usuario));
    $stmt->bindParam(':passwords', MD5($pass));
    $stmt->bindParam(':codigo_unidad', $usr->unidad);
    $stmt->bindParam(':rol', $usr->rol);
    $stmt->bindParam(':estado', $estado_);
    $stmt->bindParam(':contacto', $usr->contacto);
    $stmt->bindParam(':cargo', $usr->cargo);
    $stmt->bindParam(':area', $usr->area);
    $stmt->bindParam(':correo', $usr->correo);
    $stmt->bindParam(':tipo_persona', $usr->tipo_persona);
    $stmt->bindParam(':path_documento_solicitud', $fileName);
    $stmt->bindParam(':cite_documento_solicitud', $usr->hhrr_);
    $stmt->bindParam(':cedula_identidad_complemento', $usr->cedula_identidad_complemento);
    $stmt->bindParam(':id_documento_identidad_tipo', $usr->id_documento_identidad_extension);
    $nErr = $stmt->execute();
    if ($nErr != '1') {
        $pjson['log'] .= "<br>- Problemas en el registro:" . $nErr;
        $pjson['err'] = '1';
    } else {
        $pjson['log'] .= "<p>- Registro sin errores</p>";
    }
    //ahora enviamos el correo electronico al usuario con sus credenciales

    $partes = array_filter([
        trim($usr->nombres),
        trim($usr->primer_apellido),
        trim($usr->segundo_apellido),
        trim($usr->razonSocial)
    ]);

    $resultadoNombre = implode(' ', $partes);
    if ($usr->correo != '') {
        $rssendmail_ = sendMail($usr->correo, $resultadoNombre, $pass, $usuario);
        if ($rssendmail_ != 'ok') {
            $pjson['log'] .= "<p class='rspIncorrecta'>No se logro enviar las credenciales al correo:$correo, por favor vuelva a intentarlo nuevamente." . $rssendmail_ . "</p>";
            $pjson['err'] = '1';
        } else {
            $pjson['log'] .= "<p>- Correo enviado correctamente</p>";
        }
    }
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

function sendMail($destino, $nombre_, $pass_, $usuario)
{
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'gamea.datm@gmail.com';
        $mail->Password   = 'uwyrbhvvceyhzurx';
        $mail->Port       = 587;
        $mail->SMTPSecure = 'tls';
        $mail->setFrom($mail->Username, 'ASIGNACION DE CREDENCIALES - DATM EL ALTO');
        $mail->addAddress($destino, $nombre_);

        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);
        $mail->Subject = 'ASIGNACION DE CREDENCIALES - DATM EL ALTO';
        $mail->Body    = "<span style='color:#000;'><p>Estimado <b>$nombre_</b> a través  del presente le informamos que se le ha asignado la siguiente credencial:</p></span><br>
                    <div style='width:100%;text-align:center; color:#000;'>
                        <div style='width:70%;border:1px #1d7fed solid; margin: 0 auto; border-radius: 10px; '>Usuario:<h2>$usuario</h2><br>Contraseña:<h2>$pass_</h2></div></div>
                    <br>
                    <span style='color:#000;'>Esta credencial, le permitirá acceder al sistema informático de la Dirección de Administración Tributaria Municipal para poder realizar la solicitud de EXENCIÓN, 
                    asi como poder obtener información referente a los bienes registrados a su nombre/entidad, contar con los requisitos para los distintos tramites entre otras funciones.</span>
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

function generarUsuario($nombre, $primer_apellido, $segundo_apellido)
{
    // Obtener la inicial del nombre
    $inicial = mb_substr($nombre, 0, 1, 'UTF-8');

    // Determinar qué apellido usar
    $apellido = !empty($primer_apellido) ? $primer_apellido : $segundo_apellido;

    // Generar el nombre de usuario
    $usuario = $inicial . $apellido . '.IA';

    // Convertir a minúsculas y eliminar acentos
    $usuario = mb_strtolower($usuario, 'UTF-8');
    $usuario = strtr(
        $usuario,
        'áéíóúüñÁÉÍÓÚÜÑ',
        'aeiouunAEIOUUN'
    );

    return $usuario;
}
