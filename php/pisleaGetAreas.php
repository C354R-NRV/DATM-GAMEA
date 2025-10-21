<?php
session_start();
require_once './conexionpsql.php';

try {
    if (!isset($_SESSION['idusuario'])) {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'unauthenticated',
            'message' => 'Usuario no autenticado'
        ]);
        exit;
    }

    $conn = new Conexion();
    $cons = $conn->conectar();

    $query = "SELECT 
                a.idarea,
                a.area,
                u.unidad,
                u.idunidad
                FROM pislea_area a
                LEFT JOIN pislea_unidad u ON a.idunidad = u.idunidad
                ORDER BY u.unidad, a.area";

    $stmt = $cons->query($query);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($resultados);
    exit;
} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
    exit;
}
