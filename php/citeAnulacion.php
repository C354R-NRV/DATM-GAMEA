<?php
session_start();
require_once './conexionpsql.php';

try {
    $resp['err'] = 2;
    $resp['message'] = 'Credenciales incorrectas';

    if ($_SESSION['idusuario'] > 0) {

        foreach ($_POST as $clave => $valor) {
            $$clave = addslashes(trim($valor));
        }

        $conn = new Conexion();
        $cons = $conn->conectar();

        $fechaEnvio = new DateTime(date('Y-m-d H:i:s'));

        $query = "UPDATE datm_cites 
                SET estado_ = false, 
                    motivo_anulacion = :observacion, 
                    usuario_anulacion = :usuario, 
                    fecha_anulacion = :fecha 
                WHERE idcite = :idcite";

        $stmt = $cons->prepare($query);

        $stmt->bindParam(':observacion', $observacion, PDO::PARAM_STR);
        $stmt->bindParam(':usuario', $_SESSION['idusuario'], PDO::PARAM_STR);
        $fechaFormateada = $fechaEnvio->format('Y-m-d H:i:s');
        $stmt->bindParam(':fecha', $fechaFormateada, PDO::PARAM_STR);
        $stmt->bindParam(':idcite', $idcite, PDO::PARAM_INT);

        $err = $stmt->execute();

        $resp['err'] = 0;
        $resp['message'] = 'Operation completed successfully';
    }
} catch (PDOException $e) {
    // Handle database-related exceptions
    $resp['err'] = 1;
    $resp['message'] = 'Database error: ' . $e->getMessage();
    // Log the error for debugging purposes
    error_log('Database error: ' . $e->getMessage());
} catch (Exception $e) {
    // Handle any other exceptions
    $resp['err'] = 1;
    $resp['message'] = 'An error occurred: ' . $e->getMessage();
    // Log the error for debugging purposes
    error_log('General error: ' . $e->getMessage());
}
header('Content-Type: application/json');
echo json_encode($resp);
