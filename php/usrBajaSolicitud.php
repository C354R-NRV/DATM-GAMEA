<?php
session_start();
require_once './conexionpsql.php';

// Recibir datos POST
$idusuario = isset($_POST['idusuario']) ? addslashes(trim($_POST['idusuario'])) : '';
$observacion = isset($_POST['observacion']) ? addslashes(trim($_POST['observacion'])) : '';

// Validar datos requeridos
if (empty($idusuario)) {
    $response = array(
        'success' => false,
        'message' => 'ID de usuario requerido',
        'log' => 'ID de usuario vacío'
    );
    echo json_encode($response);
    exit;
}

try {
    $conn = new Conexion();
    $cons = $conn->conectar();

    // Verificar que el usuario existe y está activo
    $queryVerify = "SELECT usuario FROM datm_usuario WHERE id = $idusuario AND estado = 1";
    $stmtVerify = $cons->query($queryVerify);
    $usuario = $stmtVerify->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        $response = array(
            'success' => false,
            'message' => 'El usuario no existe o ya está dado de baja',
            'log' => 'Usuario no encontrado'
        );
        echo json_encode($response);
        exit;
    }

    $queryUpdate = "UPDATE datm_usuario 
                   SET estado = 0,
                   motivo_baja = '$observacion'
                   WHERE id = $idusuario";

    $cons->exec($queryUpdate);

    $response = array(
        'success' => true,
        'message' => 'Usuario dado de baja correctamente',
        'log' => 'Baja lógica realizada para usuario: ' . $usuario['usuario'] . '. Observación: ' . $observacion
    );
    echo json_encode($response);
} catch (Exception $e) {
    $response = array(
        'success' => false,
        'message' => 'Error al dar de baja el usuario',
        'log' => $e->getMessage()
    );
    echo json_encode($response);
}
