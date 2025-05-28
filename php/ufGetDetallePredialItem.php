<?php
session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$conn = new Conexion();
$cons = $conn->conectar();

$query = "select fecha_apersonamiento,  b.usuario, a.nombre_razon, a.contacto_titular, 
a.nombre_apoderado, a.contacto_apoderado, a.tipologia, a.via, a.no_plantas, 
a.no_concluidos, a.no_brutos, a.hhrr, a.descripcion, a.no_formulario, 
TRIM(replace(replace(replace(replace(ubicacion_nivel1, 'DISTRITO:', ''), 'LOTE,', ''), 'COMUNIDAD:', ''), 'URBANIZACION,', '')) ubicacion_nivel1, 
    TRIM(replace(replace(replace(ubicacion_nivel2, 'LOTE,', ''), 'COMUNIDAD:', ''), 'URBANIZACION,', '')) ubicacion_nivel2, 
    TRIM(replace(replace(replace(ubicacion_nivel3, 'LOTE,', ''), 'COMUNIDAD:', ''), 'URBANIZACION,', '')) ubicacion_nivel3,
    a.no_puerta, a.imagen_principal, a.imagen_adicional, a.video,    (SELECT string_agg(s.servicio, ', ') 
        FROM uf_predrial_servicio ps 
        JOIN uf_servicios s ON ps.idservicio = s.idservicio 
        WHERE ps.idpredial = a.id ) servicios,   a.numero_inmueble 
        from uf_predial   a 
        left join datm_usuario b on a.idusuario = b.id  
        where a.numero_inmueble = '$numero_inmueble' order by a.id desc ";

$stmt = $cons->query($query);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$data = array();
/* $cnt = 1;
foreach ($result as $key => $item) { 

    $fila = array(
        "id" => $cnt,
        "numero_inmueble" =>  $item['numero_inmueble'],
        "codigo_catastral" => $item['codigo_catastral'],
        "nombre_razon" => $item['nombre_razon'],
        "fecha_apersonamiento" =>  $item['fecha_apersonamiento'], 
    );
    $cnt++;
    $data[] = $fila;
} */
print_r(json_encode($result));

