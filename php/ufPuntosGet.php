<?php
session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$conn = new Conexion();
$cons = $conn->conectar();


$query = "SELECT a.numero_inmueble, a.codigo_catastral, 
a.nombre_razon,  to_char( a.fecha_apersonamiento, 'DD/MM/YYYY') AS  fecha_apersonamiento ,
a.latitud, a.longitud, a.geom, a.imagen_principal, a.imagen_adicional, c.usuario
FROM uf_predial a 
INNER JOIN ( 
    SELECT numero_inmueble, MAX(id) AS max_id 
    FROM uf_predial 
    GROUP BY numero_inmueble 
) b ON a.numero_inmueble = b.numero_inmueble AND a.id = b.max_id   
left join datm_usuario  c on c.id = a.idusuario
ORDER BY a.id;";

$stmt = $cons->query($query);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$data = array();
foreach ($result as $key => $item) {
    $imagenes = [];
    if (!empty($item['imagen_principal'])) $imagenes[] = $item['imagen_principal'];
    if (!empty($item['imagen_adicional'])) $imagenes[] = $item['imagen_adicional'];

    $numeroCabecera = $item['numero_inmueble'];
    $imgJson = htmlspecialchars(json_encode($imagenes), ENT_QUOTES, 'UTF-8'); // para JavaScript seguro

    $html = '
        <div class="card-inmueble" data-images="' . $imgJson . '" data-index="0" id="card-' . $numeroCabecera . '">
            <div class="header-numero">' . $item['numero_inmueble'] . '</div>

            <div class="carrusel">
                <button class="carrusel-btn left" onclick="prevImage(\'' . $numeroCabecera . '\')">&#x25C0;</button>
                <img class="carrusel-img" id="img-' . $numeroCabecera . '" src="../static/ufpredial/' . $imagenes[0] . '" alt="Imagen del inmueble">
                <button class="carrusel-btn right" onclick="nextImage(\'' . $numeroCabecera . '\')">&#x25B6;</button>
            </div>

            <div class="info-inmueble">
                <strong>CODIGO CATASTRAL:</strong> ' . $item['codigo_catastral'] . '<br>
                <strong>TITULAR:</strong> ' . $item['nombre_razon'] . '<br>
                <strong>FECHA DE ULTIMA VISITA:</strong> ' . $item['fecha_apersonamiento'] . '<br>
                <strong>USUARIO:</strong> ' . $item['usuario'] . '
            </div>
        </div>';

    $fila = array(
        "title" =>  $item['numero_inmueble'],
        "codigo_catastral" => $item['codigo_catastral'],
        "nombre_razon" => $item['nombre_razon'],
        "fecha_apersonamiento" =>  $item['fecha_apersonamiento'],
        "imagen_principal" => $img1,
        "imagen_adicional" => $img2,
        "latitud" => $item['latitud'],
        "longitud" => $item['longitud'],
        "position" => [(float)$item['latitud'], (float)$item['longitud']],
        "html" => $html
    );
    $data[] = $fila;
}

echo json_encode($data);
