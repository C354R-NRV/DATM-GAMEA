<?php
session_start();
require_once './conexionpsql.php';

// Definir las combinaciones permitidas
$allowedCombinations = [
    'DIR' => [''],
    'GA' => ['DCV', 'OPB', 'RCG', 'RLT', 'RMCR', ''],
    'SIS' => [''],
    'UAJ-CC' => [''],
    'UFyR' => ['AEyPU', 'ARCH', 'ATP', 'INM_VEH', 'NOT', ''],
    'UICT' => ['AE', 'CCI', 'CCII', 'INM', 'OI', 'VEH', '']
];

$response = ['status' => 'error', 'message' => 'Error desconocido'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idtipo_doc = isset($_POST['idtipo_doc']) ? $_POST['idtipo_doc'] : null;
    $codigo_doc = isset($_POST['codigo_doc']) ? trim($_POST['codigo_doc']) : '';
    $detalle_doc = isset($_POST['detalle_doc']) ? trim($_POST['detalle_doc']) : '';
    $unidad = isset($_POST['unidad']) ? trim($_POST['unidad']) : '';
    $area = isset($_POST['area']) ? trim($_POST['area']) : '';

    if (!array_key_exists($unidad, $allowedCombinations)) {
        echo json_encode(['status' => 'error', 'message' => 'Unidad no válida.']);
        exit;
    }

    if (!in_array($area, $allowedCombinations[$unidad])) {
        echo json_encode(['status' => 'error', 'message' => 'Combinación de Unidad y Área no válida.']);
        exit;
    }

    $conn = new Conexion();
    $cons = $conn->conectar();

    try {
        if ($idtipo_doc) {
            // Actualizar
            $sql = "UPDATE public.datm_cite_tipo_doc 
                    SET codigo_doc = :codigo_doc, 
                        detalle_doc = :detalle_doc, 
                        unidad = :unidad, 
                        area = :area 
                    WHERE idtipo_doc = :idtipo_doc";
            $stmt = $cons->prepare($sql);
            $stmt->bindParam(':idtipo_doc', $idtipo_doc);
        } else {
            // Insertar
            $sql = "INSERT INTO public.datm_cite_tipo_doc (codigo_doc, detalle_doc, unidad, area, estado_) 
                    VALUES (:codigo_doc, :detalle_doc, :unidad, :area, true)";
            $stmt = $cons->prepare($sql);
        }

        $stmt->bindParam(':codigo_doc', $codigo_doc);
        $stmt->bindParam(':detalle_doc', $detalle_doc);
        $stmt->bindParam(':unidad', $unidad);
        $stmt->bindParam(':area', $area);

        if ($stmt->execute()) {
            $response = ['status' => 'success', 'message' => 'Operación realizada correctamente.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error al guardar en la base de datos.'];
        }
    } catch (PDOException $e) {
        $response = ['status' => 'error', 'message' => 'Error de base de datos: ' . $e->getMessage()];
    }
}

echo json_encode($response);
?>
