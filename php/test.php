<?php   
require_once("conexionpsql.php");

$conn = new Conexion();
$cons = $conn->conectar(); 

try {
    $query = "select * from inmueble where DOCUMENTO_IDENTIDAD like '479664'";
    $stmt = $cons->query($query);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultados as $row) {
        echo $row['NUMERO_INMUEBLE'] . " | " . $row['documento_identidad'] . "<br/>";
    }
} catch (PDOException $e) {
    echo "Error al ejecutar la consulta: " . $e->getMessage();
} 
?>