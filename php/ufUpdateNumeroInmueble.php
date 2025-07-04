<?php
session_start();
require_once './conexionpsql.php'; 


// Verificar que el usuario esté logueado
if (!isset($_SESSION['swlogin']) || $_SESSION['swlogin'] != '1') {
    echo json_encode([
        'success' => false,
        'message' => 'Usuario no autorizado'
    ]);
    exit;
}

// Verificar que se recibieron los datos necesarios
if (!isset($_POST['id']) || !isset($_POST['inmueble']) || !isset($_POST['new_inmueble'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Datos incompletos' 
    ]);
    exit;
}

$id = intval($_POST['id']);
$numero_inmueble = trim($_POST['inmueble']);
$new_inmueble = trim($_POST['new_inmueble']);

// Validar que el número de inmueble no esté vacío
if (empty($new_inmueble)) {
    echo json_encode([
        'success' => false,
        'message' => 'El número de inmueble no puede estar vacío'
    ]);
    exit;
}

try {

    $conn = new Conexion();
    $cons = $conn->conectar();

    $query = "UPDATE uf_predial SET  numero_inmueble = :new_inmueble where numero_inmueble = :numero_inmueble and estado_";

    $stmt = $cons->prepare($query);
    $stmt->bindParam(':new_inmueble', $new_inmueble);
    $stmt->bindParam(':numero_inmueble', $numero_inmueble); 

    if (!$stmt->execute()) {
        $errorInfo = $stmt->errorInfo();
        throw new Exception("Error al actualizar en la base de datos: " . $errorInfo[2]);
    }


    $query = "INSERT INTO uf_predial_hst 
                (  idpredial, campo, anterior, nuevo, fregistro_, idusuario  ) VALUES 
                (  :idpredial, :campo, :anterior, :nuevo, :fregistro_, :idusuario  )";

    $campo = 'numero_inmueble';
    $fecha = new DateTime(date('Y-m-d H:i:s'));
    $fecha_ = $fecha->format('Y-m-d H:i:s');

    $stmt = $cons->prepare($query);
    $stmt->bindParam(':idpredial', $id);
    $stmt->bindParam(':campo', $campo);
    $stmt->bindParam(':anterior', $numero_inmueble);
    $stmt->bindParam(':nuevo', $new_inmueble);
    $stmt->bindParam(':fregistro_', $fecha_);
    $idusuario = $_SESSION['idusuario'];
    $stmt->bindParam(':idusuario', $idusuario);

    if (!$stmt->execute()) {
        $errorInfo = $stmt->errorInfo();
        throw new Exception("Error al insertar en la base de datos: " . $errorInfo[2]);
    }

    echo json_encode([
        'success' => true,
        'message' => 'Número de inmueble actualizado correctamente'
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error del servidor: ' . $e->getMessage()
    ]);
}
