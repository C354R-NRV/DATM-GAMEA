<?php    
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; 
require '../vendor/autoload.php';

// Crear una instancia de PHPMailer
$mail = new PHPMailer(true);

$destino = 'cesar.nrv@gmail.com';
$nombres = 'Cesar Rojas';
$pin = '6014';

try {
    // Configuración del servidor SMTP
    $mail->SMTPDebug = 2; 
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // Dirección del servidor SMTP
    $mail->SMTPAuth   = true;
    $mail->Username   = 'gamea.datm@gmail.com'; // Tu dirección de correo electrónico
    $mail->Password   = 'hugyawubxrsphznl'; // Tu contraseña de correo electrónico
    $mail->Port       = 587; // Puerto TCP para TLS
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Habilitar encriptación TLS
    //$mail->SMTPSecure = 'tls'; 

    // Remitente y destinatarios
    $mail->setFrom($mail->Username, 'ASIGNACION DE PIN - DATM');
    $mail->addAddress($destino, $nombres); // Añadir un destinatario
    
    $mail->CharSet = 'UTF-8'; 
    // Contenido del correo electrónico
    $mail->isHTML(true); // Configurar el formato del correo a HTML
    $mail->Subject = 'ASIGNACION DE PIN - DATM';
    $mail->Body    = "<p>Estimado <b>$nombres</b> a travez del presente, se le ha asignado el siguiente numero PIN:</p><br>
                    <h2>$pin</h2>
                    <br>
                    Este numero PIN, le permitirá acceder a información general de la cantidad de inmuebles, vehiculos o actividades economicas que se encuentran inscritos a su nombre. 
                    ";
    // Enviar el correo electrónico
    
    //$mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ));

    $mail->send();
    echo 'El mensaje ha sido enviado';
} catch (Exception $e) {
    echo "El mensaje no pudo ser enviado. Error de PHPMailer: {$mail->ErrorInfo}";
}
?> 