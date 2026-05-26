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
$pjson = array();
try {
    $conn = new Conexion();
    $cons = $conn->conectar();

    $campos = new stdClass();
    foreach ($_POST as $clave => $valor) {
        if (strpos($clave, 'campos_') === 0) {
            $key = str_replace('campos_', '', $clave);
            $campos->$key = addslashes(trim($valor));
        }
    }
    $idproceso = $campos->idproceso;
    $uploadDir = '../static/uaj_procesos/';

    if (isset($_FILES["path_archivo"]["tmp_name"])) {
        $fileName = 'prc_' . $campos->numero_tributario . '_' . uniqid() . '.pdf';
        $fileTmpPath = $_FILES["path_archivo"]["tmp_name"];

        if (!move_uploaded_file($fileTmpPath,   $uploadDir . $fileName)) {
            $err .= "Hubo un error al guardar el archivo en el directorio de destino.";
            $pjson['err'] = '1';
            $pjson['log'] .= '<p>[x] Hubo un error al guardar el archivo en el directorio de destino -' .  $uploadDir . $fileName . '-.</p><p>' . error_get_last()['message'] . '</p>';
        } else {
            $pjson['log'] .= '<p>- Archivo subido correctamente.</p>';
        }
        $pdfFile = file_get_contents($uploadDir . $fileName);
    }

    $pjson = array();
    $pjson['err'] = '0';
    if ($idproceso > 0) {
        $pjson['html'] = "Edicion completatada";
    } else {
        $pjson['html'] = "Registro completado";

        $query = "INSERT INTO  uaj_procesos 
            (resolucion_determinativa,
            gestion_fiscal,
            piet,
            fecha_piet,
            acto_ejecucion_tributaria,
            fecha_notificacion,
            cancelacion_determinacion_tributaria,
            auto_conclusion,
            cierre_definitivo_proceso,
            observaciones,
            path_archivo, 
            numero_tributario,
            idrubro,
            fregistro_,idusuario_) values
            (:resolucion_determinativa,
            :gestion_fiscal,
            :piet,
            :fecha_piet,
            :acto_ejecucion_tributaria,
            :fecha_notificacion,
            :cancelacion_determinacion_tributaria,
            :auto_conclusion,
            :cierre_definitivo_proceso,
            :observaciones,
            :path_archivo, 
            :numero_tributario,
            :idrubro,
            :fregistro_,
            :idusuario_)";

        $stmt = $cons->prepare($query);
        $stmt->bindParam(':resolucion_determinativa', $campos->resolucion_determinativa);
        $stmt->bindParam(':gestion_fiscal', $campos->gestion_fiscal);
        $stmt->bindParam(':piet', $campos->piet);
        $stmt->bindParam(':fecha_piet', $campos->fecha_piet);
        $stmt->bindParam(':acto_ejecucion_tributaria', $campos->acto_ejecucion_tributaria);
        $stmt->bindParam(':fecha_notificacion', $campos->fecha_notificacion);
        $stmt->bindParam(':cancelacion_determinacion_tributaria', $campos->cancelacion_determinacion_tributaria);
        $stmt->bindParam(':auto_conclusion', $campos->auto_conclusion);
        $stmt->bindParam(':cierre_definitivo_proceso', $campos->cierre_definitivo_proceso);
        $stmt->bindParam(':observaciones', $campos->observaciones);
        $stmt->bindParam(':path_archivo', $fileName);
        $stmt->bindParam(':numero_tributario', $campos->numero_tributario);
        $stmt->bindParam(':idrubro', $campos->idrubro);
        $stmt->bindParam(':fregistro_', $fregistro_);
        $stmt->bindParam(':idusuario_', $_SESSION['idusuario']);
        if (!$stmt->execute()) {
            $pjson['log'] .= $stmt->errorInfo();
            $pjson['err'] = '1';
        } else {
            $idarchivo = $cons->lastInsertId();
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
