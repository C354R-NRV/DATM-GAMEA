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

$nombre_razon_ant = trim($_POST['nombre_razon_ant']);
$new_nombre = trim($_POST['new_nombre']);

$catastral_ant = trim($_POST['catastral_ant']);
$new_catastro = trim($_POST['new_catastro']);


$conn = new Conexion();
$cons = $conn->conectar();

// Validar que el número de inmueble no esté vacío
if (empty($new_inmueble)) {
    echo json_encode([
        'success' => false,
        'message' => 'El número de inmueble no puede estar vacío'
    ]);
    exit;
}
if (empty($new_catastro) and $catastral_ant != '') {
    echo json_encode([
        'success' => false,
        'message' => 'El codigo catastral no puede estar vacío'
    ]);
    exit;
} else {

    $query = "UPDATE uf_predial SET  codigo_catastral = :new_catastro  where id = :id ";

    $stmt = $cons->prepare($query);
    $stmt->bindParam(':new_catastro', $new_catastro);
    $stmt->bindParam(':id', $id);

    if (!$stmt->execute()) {
        $errorInfo = $stmt->errorInfo();
        throw new Exception("Error al actualizar en la base de datos: " . $errorInfo[2]);
    }

    $campo = 'codigo_catastral';
    agregaHistorial($cons, $id, $campo, $catastral_ant, $new_catastro);
}
if (empty($new_nombre) and $nombre_razon_ant != '') {
    echo json_encode([
        'success' => false,
        'message' => 'El nombre del contribuyente no puede estar vacío'
    ]);
    exit;
} else {

    $query = "UPDATE uf_predial SET  nombre_razon = :new_nombre  where id = :id ";

    $stmt = $cons->prepare($query);
    $stmt->bindParam(':new_nombre', $new_nombre);
    $stmt->bindParam(':id', $id);

    if (!$stmt->execute()) {
        $errorInfo = $stmt->errorInfo();
        throw new Exception("Error al actualizar en la base de datos: " . $errorInfo[2]);
    }

    $campo = 'nombre_razon';
    agregaHistorial($cons, $id, $campo, $nombre_razon_ant, $new_nombre);
}

try {

    $query = "UPDATE uf_predial SET  numero_inmueble = :new_inmueble  where numero_inmueble = :numero_inmueble and estado_";

    $stmt = $cons->prepare($query);
    $stmt->bindParam(':new_inmueble', $new_inmueble);
    $stmt->bindParam(':numero_inmueble', $numero_inmueble);

    if (!$stmt->execute()) {
        $errorInfo = $stmt->errorInfo();
        throw new Exception("Error al actualizar en la base de datos: " . $errorInfo[2]);
    }

    $campo = 'numero_inmueble';
    agregaHistorial($cons, $id, $campo, $numero_inmueble, $new_inmueble);

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


function agregaHistorial($cons, $id, $campo, $anterior, $nuevo)
{
    if ($anterior !=  $nuevo) {
        $query = "INSERT INTO uf_predial_hst 
                (  idpredial, campo, anterior, nuevo, fregistro_, idusuario  ) VALUES 
                (  :idpredial, :campo, :anterior, :nuevo, :fregistro_, :idusuario  )";

        $fecha = new DateTime(date('Y-m-d H:i:s'));
        $fecha_ = $fecha->format('Y-m-d H:i:s');

        $stmt = $cons->prepare($query);
        $stmt->bindParam(':idpredial', $id);
        $stmt->bindParam(':campo', $campo);
        $stmt->bindParam(':anterior', $anterior);
        $stmt->bindParam(':nuevo', $nuevo);
        $stmt->bindParam(':fregistro_', $fecha_);
        $idusuario = $_SESSION['idusuario'];
        $stmt->bindParam(':idusuario', $idusuario);

        if (!$stmt->execute()) {
            $errorInfo = $stmt->errorInfo();
            throw new Exception("Error al insertar en la base de datos: " . $errorInfo[2]);
        }
    }
}
