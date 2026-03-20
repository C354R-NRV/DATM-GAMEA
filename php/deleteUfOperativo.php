<?php
session_start();
require_once './conexionpsql.php';

$response = ['status' => 'error', 'message' => 'Error desconocido'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idoperativo = isset($_POST['idoperativo']) ? $_POST['idoperativo'] : null;

    if ($idoperativo) {
        $conn = new Conexion();
        $cons = $conn->conectar();

        try {
            $sql = "UPDATE public.uf_operativo SET estado_ = false WHERE idoperativo = :idoperativo";
            $stmt = $cons->prepare($sql);
            $stmt->bindParam(':idoperativo', $idoperativo);

            if ($stmt->execute()) {
                $response = ['status' => 'success', 'message' => 'Operativo eliminado correctamente.'];
            } else {
                $response = ['status' => 'error', 'message' => 'Error al eliminar el operativo.'];
            }
        } catch (PDOException $e) {
            $response = ['status' => 'error', 'message' => 'Error de base de datos: ' . $e->getMessage()];
        }
    } else {
        $response = ['status' => 'error', 'message' => 'ID no proporcionado.'];
    }
}

echo json_encode($response);
?>
