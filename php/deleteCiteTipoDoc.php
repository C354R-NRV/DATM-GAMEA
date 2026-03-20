<?php
session_start();
require_once './conexionpsql.php';

$response = ['status' => 'error', 'message' => 'Error desconocido'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idtipo_doc = isset($_POST['idtipo_doc']) ? $_POST['idtipo_doc'] : null;

    if ($idtipo_doc) {
        $conn = new Conexion();
        $cons = $conn->conectar();

        try {
            $sql = "UPDATE public.datm_cite_tipo_doc SET estado_ = false WHERE idtipo_doc = :idtipo_doc";
            $stmt = $cons->prepare($sql);
            $stmt->bindParam(':idtipo_doc', $idtipo_doc);

            if ($stmt->execute()) {
                $response = ['status' => 'success', 'message' => 'Registro eliminado correctamente.'];
            } else {
                $response = ['status' => 'error', 'message' => 'Error al eliminar el registro.'];
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
