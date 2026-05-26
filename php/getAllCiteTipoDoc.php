<?php
session_start();
require_once './conexionpsql.php';

$conn = new Conexion();
$cons = $conn->conectar();

$query = "SELECT * FROM public.datm_cite_tipo_doc WHERE estado_ = true ORDER BY idtipo_doc DESC";
$stmt = $cons->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);
?>
