<?php
session_start();
require_once './conexionpsql.php';

$idoperativo = isset($_GET['idoperativo']) ? $_GET['idoperativo'] : null;

if (!$idoperativo) {
    echo json_encode(['status' => 'error', 'message' => 'ID no proporcionado.']);
    exit;
}

$conn = new Conexion();
$cons = $conn->conectar();

try {
    $sql = "SELECT idoperativo, operativo, fecha_operativo FROM public.uf_operativo WHERE idoperativo = :idoperativo AND estado_ = true";
    $stmt = $cons->prepare($sql);
    $stmt->bindParam(':idoperativo', $idoperativo);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($result);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error de base de datos.']);
}
?>
