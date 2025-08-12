<?php
session_start();
require_once './conexionpsql.php';


foreach ($_POST as $clave => $valor) {
    if (is_array($valor)) {
        $$clave = array_map(function ($v) {
            return addslashes(trim($v));
        }, $valor);
    } else {
        $$clave = addslashes(trim($valor));
    }
}

// Initialize response array
$pjson = array(
    'err' => '0',
    'message' => '',
    'log' => ''
);

try {
    if (!isset($_SESSION['idusuario'])) {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'unauthenticated',
            'message' => 'Usuario no autenticado'
        ]);
        exit;
    }



    $conn = new Conexion();
    $cons = $conn->conectar();


    $query = "INSERT INTO uf_prepredial 
                (  latitud, longitud, detalle, idusuario, fregistro_, color  ) VALUES (
                    :latitud, :longitud, :detalle, :idusuario, :fregistro_  , :color
                )";

    $idestado_fiscalizacion = 1;

    $stmt = $cons->prepare($query);
    $stmt->bindParam(':latitud', $latitud);
    $stmt->bindParam(':longitud', $longitud);
    $stmt->bindParam(':detalle', $detalle);
    $stmt->bindParam(':color', $color);

    $idusuario = $_SESSION['idusuario'];
    $stmt->bindParam(':idusuario', $idusuario);

    $fecha = new DateTime(date('Y-m-d H:i:s'));
    $fecha_ = $fecha->format('Y-m-d H:i:s');
    $stmt->bindParam(':fregistro_', $fecha_);

    $idpredial = '';

    if (!$stmt->execute()) {
        $errorInfo = $stmt->errorInfo();
        throw new Exception("Error al insertar en la base de datos: " . $errorInfo[2]);
    } else {
        $idpredial = $cons->lastInsertId();
    }

    $pjson['message'] = 'Registro guardado exitosamente';
    $pjson['id'] = $idpredial;
    $pjson['status'] = "success";
} catch (Exception $e) {
    $pjson['err'] = '1';
    $pjson['message'] = $e->getMessage();
    $pjson['log'] = $e->getTraceAsString();
    $pjson['status'] = "success";
} catch (PDOException $e) {
    $pjson['err'] = '1';
    $pjson['message'] = 'Error de base de datos';
    $pjson['log'] = $e->getMessage();
} catch (Error $e) {
    $pjson['err'] = '1';
    $pjson['message'] = 'Error interno del servidor';
    $pjson['log'] = $e->getMessage();
} finally {
    // Always return a JSON response
    header('Content-Type: application/json');
    echo json_encode($pjson);
    exit;
}
