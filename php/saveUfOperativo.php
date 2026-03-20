<?php
session_start();
require_once './conexionpsql.php';

$response = ['status' => 'error', 'message' => 'Error desconocido'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idoperativo = isset($_POST['idoperativo']) ? $_POST['idoperativo'] : null;
    $operativo = isset($_POST['operativo']) ? trim($_POST['operativo']) : '';
    $fecha_operativo = isset($_POST['fecha_operativo']) ? trim($_POST['fecha_operativo']) : '';

    if (empty($operativo) || empty($fecha_operativo)) {
        echo json_encode(['status' => 'error', 'message' => 'El nombre y la fecha son obligatorios.']);
        exit;
    }

    $conn = new Conexion();
    $cons = $conn->conectar();

    try {
        if ($idoperativo) {
            // Actualizar
            $sql = "UPDATE public.uf_operativo 
                    SET operativo = :operativo, 
                        fecha_operativo = :fecha_operativo 
                    WHERE idoperativo = :idoperativo";
            $stmt = $cons->prepare($sql);
            $stmt->bindParam(':idoperativo', $idoperativo);
        } else {
            // Insertar
            $sql = "INSERT INTO public.uf_operativo (operativo, fecha_operativo, estado_) 
                    VALUES (:operativo, :fecha_operativo, true)";
            $stmt = $cons->prepare($sql);
        }

        $stmt->bindParam(':operativo', $operativo);
        $stmt->bindParam(':fecha_operativo', $fecha_operativo);

        if ($stmt->execute()) {
            $response = ['status' => 'success', 'message' => 'Operativo guardado correctamente.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error al guardar en la base de datos.'];
        }
    } catch (PDOException $e) {
        $response = ['status' => 'error', 'message' => 'Error de base de datos: ' . $e->getMessage()];
    }
}

echo json_encode($response);
?>
