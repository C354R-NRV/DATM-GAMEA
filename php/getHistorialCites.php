<?php
session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
$conn = new Conexion();
$cons = $conn->conectar();

// Query to get the maximum correlative for the given unit and code
$query = "select TO_CHAR(a.fecha_registro::timestamp, 'DD/MM/YYYY HH24:MI:SS') fecha,  b.usuario, a.cite, a.referencia
    from datm_cites a 
    left join datm_usuario b on b.id =  a.usuario_
    where a.estado_ is true
    order by a.fecha_registro desc limit 50";

$stmt = $cons->query($query);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
$dat = json_encode($result);
echo $dat;
