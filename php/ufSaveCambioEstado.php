<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$pjson = array();
$pjson['err'] = '0';
$pjson['log'] = '';
$conn = new Conexion();
$cons = $conn->conectar();

try {

    $fecha_cambio_estado = (new DateTime())->format('Y-m-d H:i:s');
    $query = "UPDATE uf_predial 
                SET idestado_fiscalizacion = :estado,  
                fecha_cambio_estado = :fecha_cambio_estado,
                observacion_estado = :observacionEstado,
                idusuario_cambio_estado = :idusuario
            WHERE id = :id";

    $stmt = $cons->prepare($query);

    $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
    $stmt->bindParam(':fecha_cambio_estado', $fecha_cambio_estado);
    $stmt->bindParam(':observacionEstado', $observacionEstado);
    $stmt->bindParam(':idusuario', $_SESSION['idusuario']);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if (!$stmt->execute()) {
        $pjson['err'] = '1';
        $errorInfo = $stmt->errorInfo();
        $pjson['log'] .= "<p class='rspIncorrecta'>[x] Error SQL: " . $errorInfo[2] . "</p>";
    }

    $fecha_  = (new DateTime())->format('Y-m-d H:i:s');
    $query = "INSERT INTO uf_predial_estado  
                (idestado_fiscalizacion, fecha_estado, observacion, idusuario, idpredial   ) values (:estado,  
                :fecha_, :observacion, :idusuario, :id) ";

    $stmt = $cons->prepare($query);

    $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
    $stmt->bindParam(':fecha_', $fecha_);
    $stmt->bindParam(':observacion', $observacionEstado);
    $stmt->bindParam(':idusuario', $_SESSION['idusuario']);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if (!$stmt->execute()) {
        $pjson['err'] = '1';
        $errorInfo = $stmt->errorInfo();
        $pjson['log'] .= "<p class='rspIncorrecta'>[x] Error SQL: " . $errorInfo[2] . "</p>";
    }
} catch (PDOException $e) {
    $pjson['err'] = '1';
    $pjson['log'] .= "<p class='rspIncorrecta'>[x] Error de base de datos: " . $e->getMessage() . "</p>";
} catch (Exception $e) {
    $pjson['err'] = '1';
    $pjson['log'] .= "<p class='rspIncorrecta'>[x] Error general: " . $e->getMessage() . "</p>";
} finally {
    echo json_encode($pjson);
}
