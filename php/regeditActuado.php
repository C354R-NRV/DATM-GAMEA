<?php
session_start();
require_once("conexionpsql.php");

error_reporting(E_ALL); // Mostrar todos los errores y advertencias
ini_set('display_errors', 1); // Mostrar en pantalla
ini_set('log_errors', 1); // Habilitar log
ini_set('error_log', __DIR__ . '/errores_php.log'); // Guardar en archivo errores_php.log

$ip_equipo = getClientIP();
$fechaEnvio = new DateTime(date('Y-m-d H:i:s'));
$fregistro_ = $fechaEnvio->format('Y-m-d H:i:s');
try {
    foreach ($_POST as $clave => $valor) {
        $$clave = addslashes(trim($valor));
    }
    $conn = new Conexion();
    $cons = $conn->conectar();

    $pjson = array();
    $pjson['err'] = '0';
    if ($idarchivo > 0) {
        $pjson['html'] = "Edicion completatada";


        $query = "UPDATE ga_archivo 
                SET estante = :estante , nivel = :nivel
                WHERE idarchivo = :idarchivo";

        $stmt = $cons->prepare($query);

        $stmt->bindParam(':estante', $estante);
        $stmt->bindParam(':nivel', $nivel);
        $stmt->bindParam(':idarchivo', $idarchivo);

        if (!$stmt->execute()) {
            $pjson['log'] .= $stmt->errorInfo();
            $pjson['err'] = '1';
        } else {


            $accion = 'MODIFICACION DE ESTANTE';
            if ($estante_ant != $estante) {
                $query = "INSERT INTO  ga_log 
                (idusuario, accion, idarchivo , fregistro_, ip_equipo, valor_ant, valor_act ) values
                (:idusuario, :accion, :idarchivo , :fregistro_, :ip_equipo, :valor_ant, :valor_act )";

                $stmt = $cons->prepare($query);
                $stmt->bindParam(':idusuario', $_SESSION['idusuario']);
                $stmt->bindParam(':idarchivo', $idarchivo);
                $stmt->bindParam(':fregistro_', $fregistro_);
                $stmt->bindParam(':ip_equipo', $ip_equipo);
                $stmt->bindParam(':accion', $accion);
                $stmt->bindParam(':valor_ant', $estante_ant);
                $stmt->bindParam(':valor_act', $estante);

                if (!$stmt->execute()) {
                    $pjson['log'] .= $stmt->errorInfo();
                    $pjson['err'] = '1';
                }
            }
            if ($nivel_ant != $nivel) {

                $query = "INSERT INTO  ga_log 
                (idusuario, accion, idarchivo , fregistro_, ip_equipo, valor_ant, valor_act ) values
                (:idusuario, :accion, :idarchivo , :fregistro_, :ip_equipo, :valor_ant, :valor_act )";

                $stmt = $cons->prepare($query);
                $stmt->bindParam(':idusuario', $_SESSION['idusuario']);
                $stmt->bindParam(':idarchivo', $idarchivo);
                $stmt->bindParam(':fregistro_', $fregistro_);
                $stmt->bindParam(':ip_equipo', $ip_equipo);
                $stmt->bindParam(':accion', $accion);
                $stmt->bindParam(':valor_ant', $nivel_ant);
                $stmt->bindParam(':valor_act', $nivel);

                if (!$stmt->execute()) {
                    $pjson['log'] .= $stmt->errorInfo();
                    $pjson['err'] = '1';
                }
            }
        }
    } else {
        $pjson['html'] = "Registro completado";


        $codigo_archivo = trim($codigo_archivo);

        if (!preg_match('/\.pdf$/i', $codigo_archivo)) {
            $codigo_archivo .= '.pdf';
        }

        $query = "INSERT INTO  ga_archivo 
            (codigo_archivo, idrubro, estante , nivel, comentario, fregistro_, idusuario_) values
            (:codigo_archivo, :idrubro, :estante , :nivel, :comentario, :fregistro_, :idusuario_)";


        $stmt = $cons->prepare($query);
        $stmt->bindParam(':codigo_archivo', $codigo_archivo);
        $stmt->bindParam(':idrubro', $idrubro);
        $stmt->bindParam(':estante', $estante);
        $stmt->bindParam(':nivel', $nivel);
        $stmt->bindParam(':comentario', $comentario);
        $stmt->bindParam(':fregistro_', $fregistro_);
        $stmt->bindParam(':idusuario_', $_SESSION['idusuario']);
        $idarchivo = 0;
        if (!$stmt->execute()) {
            $pjson['log'] .= $stmt->errorInfo();
            $pjson['err'] = '1';
        } else {
            $idarchivo = $cons->lastInsertId();
        }

        $query = "INSERT INTO  ga_log 
            (idusuario, accion, idarchivo , fregistro_, ip_equipo) values
            (:idusuario, :accion, :idarchivo , :fregistro_, :ip_equipo)";

        $accion = 'NUEVO REGISTRO';
        $stmt = $cons->prepare($query);
        $stmt->bindParam(':idusuario', $_SESSION['idusuario']);
        $stmt->bindParam(':accion', $accion);
        $stmt->bindParam(':idarchivo', $idarchivo);
        $stmt->bindParam(':fregistro_', $fregistro_);
        $stmt->bindParam(':ip_equipo', $ip_equipo);

        if (!$stmt->execute()) {
            $pjson['log'] .= $stmt->errorInfo();
            $pjson['err'] = '1';
        }
    }
    $dat = json_encode($pjson);
    echo $dat;
} catch (Throwable $e) {
    $pjson['err'] = '1';
    $pjson['log'] = $e->getMessage();
    $dat = json_encode($pjson);
    echo $dat;
}
