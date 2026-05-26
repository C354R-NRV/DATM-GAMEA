<?php
session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

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

    // Obtener datos del funcionario
    $queryFunc = "SELECT 
                    f.*,
                    a.area,
                    u.unidad,
                    n.nivel
                  FROM pislea_funcionario f
                  LEFT JOIN pislea_area a ON f.idarea = a.idarea
                  LEFT JOIN pislea_unidad u ON a.idunidad = u.idunidad
                  LEFT JOIN pislea_nivelknow n ON f.idnivel_know = n.idnivel_know
                  WHERE f.idfuncionario = :idfuncionario";

    $stmtFunc = $cons->prepare($queryFunc);
    $stmtFunc->bindParam(':idfuncionario', $idfuncionario);
    $stmtFunc->execute();
    $funcionario = $stmtFunc->fetch(PDO::FETCH_ASSOC);

    // Obtener equipos
    $queryEquipos = "SELECT * FROM pislea_equipo 
                     WHERE idfuncionario = :idfuncionario AND estado_ IS TRUE";
    $stmtEquipos = $cons->prepare($queryEquipos);
    $stmtEquipos->bindParam(':idfuncionario', $idfuncionario);
    $stmtEquipos->execute();
    $equipos = $stmtEquipos->fetchAll(PDO::FETCH_ASSOC);

    // Obtener software
    $querySoftware = "SELECT * FROM pislea_software 
                      WHERE idfuncionario = :idfuncionario AND estado_ IS TRUE";
    $stmtSoftware = $cons->prepare($querySoftware);
    $stmtSoftware->bindParam(':idfuncionario', $idfuncionario);
    $stmtSoftware->execute();
    $software = $stmtSoftware->fetchAll(PDO::FETCH_ASSOC);

    $response = [
        'status' => 'success',
        'funcionario' => $funcionario,
        'equipos' => $equipos,
        'software' => $software
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;

} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
    exit;
}
