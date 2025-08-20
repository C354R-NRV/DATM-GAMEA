<?php
session_start();
require_once '../php/conexionpsql.php';
$conn = new Conexion();
$cons = $conn->conectar();
$ip_equipo = getClientIP();

if (!$_SESSION['swlogin']) {
    echo "<script>window.location.href = 'index.php';</script>";
}

// Verificar rubro
if (!isset($_GET['r']) || trim($_GET['r']) === '') {
    http_response_code(400);
    echo "Rubro no especificado.";
    exit;
}

$rubro  = $_GET['r'];
$carpeta = '2_INMUEBLES';
switch ($rubro) {
    case '1':
        $carpeta = '1_VEHICULOS';
        break;
    case '3':
        $carpeta = '3_ACT_ECON';
        break;
    case '4':
        $carpeta = '4_TASAS_PATENTES';
        break;
    case '5':
        $carpeta = '5_OTROS';
        break;
}

$base_dir = '/mnt/scanner_datm/' . $carpeta;

// Verificar archivo
if (!isset($_GET['file']) || trim($_GET['file']) === '') {
    http_response_code(400);
    echo "Archivo no especificado.";
    exit;
}

$filename = basename($_GET['file']); // evita traversal
$filepath = $base_dir . DIRECTORY_SEPARATOR . $filename;


if (!file_exists($filepath) || !is_file($filepath) || !is_readable($filepath)) {
    http_response_code(404);
    echo "Archivo no encontrado.";
    exit;
}

$query = "INSERT INTO  ga_log 
            (idusuario, accion, idarchivo , fregistro_, ip_equipo, codigo_archivo) values
            (:idusuario, :accion, :idarchivo , :fregistro_, :ip_equipo, :codigo_archivo)";

$accion = 'DESCARGA DE ARCHIVO';
$stmt = $cons->prepare($query);
$stmt->bindParam(':idusuario', $_SESSION['idusuario']);
$stmt->bindParam(':accion', $accion);
if (isset($_GET['i']) and trim($_GET['i']) != '') {
    $stmt->bindParam(':idarchivo', $_GET['i']);
}
$stmt->bindParam(':codigo_archivo', $filename);
$fechaEnvio = new DateTime(date('Y-m-d H:i:s'));
$fregistro_ = $fechaEnvio->format('Y-m-d H:i:s');
$stmt->bindParam(':fregistro_', $fregistro_);
$stmt->bindParam(':ip_equipo', $ip_equipo);

if (!$stmt->execute()) {
    $pjson['log'] .= $stmt->errorInfo();
    $pjson['err'] = '1';
    echo "Archivo no encontrado.- " . $pjson['log'];
    exit;
}

// Si el archivo termina en .pdf (sin importar mayúsculas/minúsculas) -> mostrar en navegador
if (preg_match('/\.pdf$/i', $filename)) {
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . $filename . '"');
    header('Content-Length: ' . filesize($filepath));
    header('Accept-Ranges: bytes');
    header('Cache-Control: public, max-age=0');
    header('Pragma: public');
} else {
    // Otros tipos -> descargar
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $filepath);
    finfo_close($finfo);

    header('Content-Type: ' . ($mime ?: 'application/octet-stream'));
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filepath));
}

// Enviar archivo
$chunkSize = 8192;
$fh = fopen($filepath, 'rb');
if ($fh === false) {
    http_response_code(500);
    echo "No se pudo abrir el archivo.";
    exit;
}
while (!feof($fh)) {
    echo fread($fh, $chunkSize);
    flush();
}
fclose($fh);
exit;
