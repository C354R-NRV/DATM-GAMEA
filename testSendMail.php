<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

define('FCPATHpaquete', dirname(__FILE__) . DIRECTORY_SEPARATOR);
require 'php/PHPMailer/src/PHPMailer.php';
require 'php/PHPMailer/src/SMTP.php';
require 'php/PHPMailer/src/Exception.php';

$destino = "cesar.nrv@gmail.com";
$nombres = "Cesar Rojas";
$pin = "5443";
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'gamea.datm@gmail.com';
    $mail->Password   = 'hugyawubxrsphznl';
    $mail->Port       = 587;
    $mail->SMTPSecure = 'tls';
    $mail->setFrom($mail->Username, 'DATM - ASIGNACION DE PIN');
    $mail->addAddress($destino, $nombres);

    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);
    $mail->Subject = 'DATM - ASIGNACION DE PIN';
    $mail->Body    = "<span style='color:#000;'><p>Estimado <b>$nombres</b> a través  del presente, se le ha asignado el siguiente numero PIN:</p></span><br>
                    <div style='width:100%;text-align:center; color:#000;'><div style='width:40%;border:1px #1d7fed solid; margin: 0 auto; border-radius: 10px; '><h1>$pin</h1></div></div>
                    <br>
                    <span style='color:#000;'>Este número PIN, le permitirá acceder a información general de la cantidad de inmuebles, vehículos o actividades económicas que se encuentran inscritos a su nombre. </span>
                    <br>
                    <br>
                    <span style='color:#6b0d0d;font-size:0.7rem;'>No es necesario que responda a este correo<br></span>
                    <span style='color:gray;font-size:0.7rem;'><br>Área de sistemas<br>Dirección de Adminitración Tributaria Municipal<br>Gobierno Autónomo Municipal de El Alto</span>
                    ";

    $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));

    $mail->send();
    echo 'ok';
} catch (Exception $e) {
    echo "El mensaje no pudo ser enviado. Error de PHPMailer: {$mail->ErrorInfo}";
}
