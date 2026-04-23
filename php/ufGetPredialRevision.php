<?php
session_start();
require_once './conexionpsql.php';

if (!isset($_SESSION['idusuario'])) {
    echo json_encode([]);
    exit;
}

$idusuario = $_SESSION['idusuario'];

$conn = new Conexion();
$cons = $conn->conectar();

$query = "
SELECT  a.id, numero_inmueble, codigo_catastral,  imagen_principal,   fecha_apersonamiento ,   no_formulario, b.operativo , a.imagen_adicional
FROM uf_predial a 
left join uf_operativo b ON  b.fecha_operativo = CAST(a.fecha_apersonamiento AS date)
WHERE 
a.estado_ = true and 
b.estado_ = true  
and a.idusuario = :idusuario
order by a.id desc
";

$stmt = $cons->prepare($query);
$stmt->bindParam(':idusuario', $idusuario, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$data = array();

foreach ($result as $row) {
    $imgHtml = '';
    $hasImages = false;

    if (!empty($row['imagen_principal'])) {
        $imgHtml .= '<img src="../static/ufpredial/' . htmlspecialchars(trim($row['imagen_principal'])) . '" class="img-revision">';
        $hasImages = true;
    }

    if (!empty($row['imagen_adicional'])) {
        // En caso de que haya múltiples imágenes separadas por coma
        $adicionales = explode(',', $row['imagen_adicional']);
        foreach ($adicionales as $img) {
            $img = trim($img);
            if (!empty($img)) {
                if ($hasImages) {
                    $imgHtml .= '<hr class="img-separator">';
                }
                $imgHtml .= '<img src="../static/ufpredial/' . htmlspecialchars($img) . '" class="img-revision">';
                $hasImages = true;
            }
        }
    }

    $data[] = array(
        "id" => $row['id'],
        "fecha_apersonamiento" => $row['fecha_apersonamiento'],
        "operativo" => $row['operativo'],
        "numero_inmueble" => $row['numero_inmueble'],
        "codigo_catastral" => $row['codigo_catastral'],
        "no_formulario" => $row['no_formulario'],
        "imagenes_html" => $imgHtml
    );
}

header('Content-Type: application/json');
echo json_encode($data);
?>
