<?php
session_start();
require_once './conexionpsql.php';

/* // Recibir datos POST
$id = isset($_POST['id']) ? addslashes(trim($_POST['id'])) : '';
$usuario = isset($_POST['usuario']) ? addslashes(trim($_POST['usuario'])) : '';
$correo = isset($_POST['correo']) ? addslashes(trim($_POST['correo'])) : '';
$contacto = isset($_POST['contacto']) ? addslashes(trim($_POST['contacto'])) : '';
$rol = isset($_POST['rol']) ? addslashes(trim($_POST['rol'])) : '';
 */

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

// Validar datos requeridos
if (empty($id) || empty($usuario) || empty($rol)) {
    $response = array(
        'success' => false,
        'message' => 'Todos los campos son requeridos',
        'log' => 'Campos incompletos'
    );
    echo json_encode($response);
    exit;
}

try {
    $conn = new Conexion();
    $cons = $conn->conectar();

    // Verificar que el usuario existe (sin filtro de estado para poder reactivar)
    $queryVerify = "SELECT id FROM datm_usuario WHERE id = $id";
    $stmtVerify = $cons->query($queryVerify);
    $usuarioExiste = $stmtVerify->fetch(PDO::FETCH_ASSOC);

    if (!$usuarioExiste) {
        $response = array(
            'success' => false,
            'message' => 'El usuario no existe',
            'log' => 'Usuario no encontrado'
        );
        echo json_encode($response);
        exit;
    }

    $passwordUpdate = "";
    if (!empty($password)) {
        $passwordUpdate = ", password = MD5('$password')";
    }

    $estado_ = isset($estado) ? intval($estado) : 1;

    // Actualizar datos del usuario
    $queryUpdate = "UPDATE datm_usuario 
                    SET usuario = '$usuario', 
                        correo = '$correo', 
                        nombres = '$nombre', 
                        primer_apellido = '$paterno', 
                        segundo_apellido = '$materno', 
                        contacto = '$contacto',
                        rol = '$rol',
                        codigo_unidad = '$unidad',
                        area = '$area',
                        cargo = '$cargo',
                        estado = $estado_
                        $passwordUpdate
                    WHERE id = $id";

    $cons->exec($queryUpdate);

    $response = array(
        'success' => true,
        'message' => 'Usuario actualizado correctamente',
        'log' => 'Actualización exitosa del usuario: ' . $usuario
    );
    echo json_encode($response);
} catch (Exception $e) {
    $response = array(
        'success' => false,
        'message' => 'Error al actualizar el usuario',
        'log' => $e->getMessage()
    );
    echo json_encode($response);
}
