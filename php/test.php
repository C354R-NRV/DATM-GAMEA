<?php   
require_once("conexionpsql.php");

$conn = new Conexion();
$cons = $conn->conectar(); 

try {
    $query = "select * from inmueble where documento_identidad like '479664'";
    $stmt = $cons->query($query);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultados as $row) {
        echo $row['numero_inmueble'] . " | " . $row['documento_identidad'] . "<br/>";
    }
} catch (PDOException $e) {
    echo "Error al ejecutar la consulta: " . $e->getMessage();
} 
?>