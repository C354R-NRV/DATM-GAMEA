<?php
session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    if (is_array($valor)) {
        $$clave = array_map(function ($v) {
            return addslashes(trim($v));
        }, $valor);
    } else {
        $$clave = addslashes(trim($valor));
    }
}

foreach ($_GET as $clave => $valor) {
    if (is_array($valor)) {
        $$clave = array_map(function ($v) {
            return addslashes(trim($v));
        }, $valor);
    } else {
        $$clave = addslashes(trim($valor));
    }
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

    $filtroNombre = isset($filtroNombre) ? $filtroNombre : '';
    $filtroUnidad = isset($filtroUnidad) ? $filtroUnidad : '';
    $search = isset($search) ? $search : '';
    $offset = isset($offset) ? intval($offset) : 0;
    $limit = isset($limit) ? intval($limit) : 100;
    $sort = isset($sort) ? $sort : 'idfuncionario';
    $order = isset($order) ? $order : 'DESC';

    $whereConditions = ["f.estado_ IS TRUE"];
    
    if (!empty($filtroNombre)) {
        $whereConditions[] = "(f.nombres ILIKE '%$filtroNombre%' OR f.apellido_paterno ILIKE '%$filtroNombre%' OR f.apellido_materno ILIKE '%$filtroNombre%')";
    }
    
    if (!empty($filtroUnidad)) {
        $whereConditions[] = "u.idunidad = $filtroUnidad";
    }
    
    if (!empty($search)) {
        $whereConditions[] = "(f.nombres ILIKE '%$search%' OR f.apellido_paterno ILIKE '%$search%' OR f.apellido_materno ILIKE '%$search%' OR CAST(f.contacto AS TEXT) ILIKE '%$search%')";
    }

    $whereClause = implode(' AND ', $whereConditions);

    $query = "SELECT 
                f.idfuncionario,
                f.nombres,
                f.apellido_paterno,
                f.apellido_materno,
                f.contacto,
                a.area,
                u.unidad,
                CONCAT(f.nombres, ' ', f.apellido_paterno, ' ', COALESCE(f.apellido_materno, '')) as nombre_completo,
                CONCAT(u.unidad, ' - ', a.area) as unidad_area
              FROM pislea_funcionario f
              LEFT JOIN pislea_area a ON f.idarea = a.idarea
              LEFT JOIN pislea_unidad u ON a.idunidad = u.idunidad
              WHERE $whereClause
              ORDER BY $sort $order
              LIMIT $limit OFFSET $offset";

    $stmt = $cons->query($query);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = [];
    foreach ($resultados as $row) {
        $acciones = "
            <button class='btn btn-sm btn-primary' onclick='editarFuncionario({$row['idfuncionario']})' title='Editar'>
                <i class='fa fa-edit' aria-hidden='true'></i>
            </button>
            <button class='btn btn-sm btn-info' onclick='verDetalle({$row['idfuncionario']})' title='Ver Detalle'>
                <i class='fa fa-search' aria-hidden='true'></i>
            </button>
        ";

        $data[] = [
            'idfuncionario' => $row['idfuncionario'],
            'nombre_completo' => $row['nombre_completo'],
            'contacto' => $row['contacto'],
            'unidad_area' => $row['unidad_area'],
            'acciones' => $acciones
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($data);
    exit;

} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
    exit;
}
