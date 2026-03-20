<?php
session_start();
require_once './conexionpsql.php';

$response = ['status' => 'error', 'message' => 'Error desconocido'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : ''; // 'assign', 'move', 'unassign'
    $idoperativo = isset($_POST['idoperativo']) ? $_POST['idoperativo'] : null;
    $idusuario = isset($_POST['idusuario']) ? $_POST['idusuario'] : null;
    $grupo = isset($_POST['grupo']) ? trim($_POST['grupo']) : '';

    if (!$idoperativo || !$idusuario) {
        echo json_encode(['status' => 'error', 'message' => 'Faltan datos obligatorios.']);
        exit;
    }

    $conn = new Conexion();
    $cons = $conn->conectar();

    try {
        if ($action === 'assign' || $action === 'move') {
            if (empty($grupo)) {
                echo json_encode(['status' => 'error', 'message' => 'El grupo es obligatorio para asignar.']);
                exit;
            }

            
            $checkSql = "SELECT id_grupo_operativo FROM public.uf_grupo_operativo WHERE idoperativo = :idoperativo AND idusuario = :idusuario";
            $stmtCheck = $cons->prepare($checkSql);
            $stmtCheck->bindParam(':idoperativo', $idoperativo);
            $stmtCheck->bindParam(':idusuario', $idusuario);
            $stmtCheck->execute();
            $existing = $stmtCheck->fetch(PDO::FETCH_ASSOC);

            if ($existing) {
                $updateSql = "UPDATE public.uf_grupo_operativo SET grupo = :grupo, estado_ = true WHERE id_grupo_operativo = :id_grupo_operativo";
                $stmtUpdate = $cons->prepare($updateSql);
                $stmtUpdate->bindParam(':grupo', $grupo);
                $stmtUpdate->bindParam(':id_grupo_operativo', $existing['id_grupo_operativo']);
                $stmtUpdate->execute();
            } else {
                $insertSql = "INSERT INTO public.uf_grupo_operativo (idusuario, idoperativo, grupo, estado_) VALUES (:idusuario, :idoperativo, :grupo, true)";
                $stmtInsert = $cons->prepare($insertSql);
                $stmtInsert->bindParam(':idusuario', $idusuario);
                $stmtInsert->bindParam(':idoperativo', $idoperativo);
                $stmtInsert->bindParam(':grupo', $grupo);
                $stmtInsert->execute();
            }
            $response = ['status' => 'success', 'message' => 'Usuario asignado correctamente.'];

        } elseif ($action === 'unassign') {
            $deleteSql = "UPDATE public.uf_grupo_operativo SET estado_ = false WHERE idoperativo = :idoperativo AND idusuario = :idusuario";
            $stmtDelete = $cons->prepare($deleteSql);
            $stmtDelete->bindParam(':idoperativo', $idoperativo);
            $stmtDelete->bindParam(':idusuario', $idusuario);
            
            if ($stmtDelete->execute()) {
                 $response = ['status' => 'success', 'message' => 'Usuario removido del operativo.'];
            } else {
                 $response = ['status' => 'error', 'message' => 'Error al remover usuario.'];
            }
        } else {
             $response = ['status' => 'error', 'message' => 'Acción no válida.'];
        }

    } catch (PDOException $e) {
        $response = ['status' => 'error', 'message' => 'Error de BD: ' . $e->getMessage()];
    }
}

echo json_encode($response);
?>
