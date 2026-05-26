<?php
session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$conn = new Conexion();
$cons = $conn->conectar(); 

$query = " select b.numero_inmueble,  upper(concat(d.usuario,' - ', d.nombres, ' ', d.primer_apellido, ' ', d.segundo_apellido))  as usuario , 
a.fecha_estado, c.estado_fiscalizacion, a.observacion
from uf_predial_estado a 
left join uf_predial b on a.idpredial = b.id  
left join uf_estado_fiscalizacion c on a.idestado_fiscalizacion = c.idestado_fiscalizacion 
left join  datm_usuario d on d.id = a.idusuario
where b.numero_inmueble = '$numero_inmueble'
and a.estado_ is true order by a.fecha_estado desc;";

$stmt = $cons->query($query);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$data = array();
print_r(json_encode($result));
