<?php
session_start();
require_once './conexionpsql.php';

$idoperativo = isset($_GET['idoperativo']) ? $_GET['idoperativo'] : null;

if (!$idoperativo) {
    echo json_encode(['status' => 'error', 'message' => 'ID de operativo no proporcionado']);
    exit;
}

$conn = new Conexion();
$cons = $conn->conectar();

try {
    // 1. Grupos del operativo (Distinct groups that have assignments)
    // Note: If we want to support empty groups, we might need a separate table or just let the UI handle creating "slots" dynamically.
    // For now, we will fetch distinct groups currently used.
    $sqlGroups = "SELECT DISTINCT grupo FROM public.uf_grupo_operativo WHERE idoperativo = :idoperativo AND estado_ = true ORDER BY grupo";
    $stmtGroups = $cons->prepare($sqlGroups);
    $stmtGroups->bindParam(':idoperativo', $idoperativo);
    $stmtGroups->execute();
    $groups = $stmtGroups->fetchAll(PDO::FETCH_COLUMN);

    // 2. Usuarios asignados, ordenados por grupo
    $sqlAssigned = "SELECT a.id_grupo_operativo, a.idusuario, a.grupo, b.usuario, b.nombres, b.primer_apellido, b.segundo_apellido 
                    FROM public.uf_grupo_operativo a
                    INNER JOIN public.datm_usuario b ON a.idusuario = b.id
                    WHERE a.idoperativo = :idoperativo AND a.estado_ = true AND b.estado = 1";
    $stmtAssigned = $cons->prepare($sqlAssigned);
    $stmtAssigned->bindParam(':idoperativo', $idoperativo);
    $stmtAssigned->execute();
    $assignedUsers = $stmtAssigned->fetchAll(PDO::FETCH_ASSOC);

    // 3. Usuarios disponibles (Rol 'SIS' o 'UFyR' que NO esten en este operativo)
    $sqlAvailable = "SELECT id, usuario, nombres, primer_apellido, segundo_apellido, cargo 
                     FROM public.datm_usuario 
                     WHERE estado = 1 
                     -- AND (rol = 'SIS' OR codigo_unidad = 'UFyR' OR codigo_unidad = 'UICT') -- Ajustar roles según necesidad
                     AND id NOT IN (
                        SELECT idusuario FROM public.uf_grupo_operativo WHERE idoperativo = :idoperativo AND estado_ = true
                     )
                     ORDER BY primer_apellido ASC";
    $stmtAvailable = $cons->prepare($sqlAvailable);
    $stmtAvailable->bindParam(':idoperativo', $idoperativo);
    $stmtAvailable->execute();
    $availableUsers = $stmtAvailable->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => 'success',
        'groups' => $groups,
        'assigned_users' => $assignedUsers,
        'available_users' => $availableUsers
    ]);

} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error de BD: ' . $e->getMessage()]);
}
?>
