<?php
session_start();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
require_once("conexionpsql.php");

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$conn = new Conexion();
$cons = $conn->conectar();

$query = "select id,cedula_identidad, nombres, primer_apellido, 
                segundo_apellido, usuario, codigo_unidad, area, rol, cargo, solicitante_cite, COALESCE(area, '') as area, estado, COALESCE(codigo_usuario, '') as codigo_usuario, contacto, correo,
                sigla_usuario, honorifico
                from datm_usuario u where UPPER(u.usuario) like UPPER('$u_')  and u.password like MD5('$p_'); ";
$stmt = $cons->query($query);

$rs  = array();

$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
$sw = 0;
$obs = '';
$nombre = '';
$_SESSION['rol'] = '';
$_SESSION['swlogin'] = '0';
foreach ($resultados as $row) {
    $_SESSION['swlogin'] = $sw = '1';
    if ($row['estado'] == '1') {

        $query = "select * from datm_parametro";
        $stmt = $cons->query($query);
        $parametros = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['sirefo_ambiente'] = $parametros['sirefo_ambiente'];
        $_SESSION['idusuario'] = $row['id'];
        $_SESSION['sigla_usuario'] = $row['sigla_usuario'];
        $_SESSION['honorifico'] = $row['honorifico'];
        $_SESSION['codigo_unidad'] = $row['codigo_unidad'];
        $_SESSION['codigo_usuario'] = $row['codigo_usuario'];
        $_SESSION['area'] = $row['area'];
        $_SESSION['usuario'] = $row['usuario'];
        $_SESSION['cedula_identidad'] = $row['cedula_identidad'];
        $_SESSION['contacto'] = $row['contacto'];
        $_SESSION['correo'] = $row['correo'];
        $_SESSION['cedula_identidad_complemento'] = $row['cedula_identidad_complemento'];
        $_SESSION['rol'] = $row['rol'];
        $nombre = $row['nombres'] . ' ' . $row['primer_apellido'] . ' ' . $row['segundo_apellido'];
        $nombre = strtolower($nombre);
        $nombre = ucwords($nombre);
        $_SESSION['nombreUsuario']  = $nombre;
    } else {
        $obs = 'Su USUARIO se encuentra bloqueado, favor comuniquese con el area de sistemas';
    }
}
if ($sw == 0) {
    $obs = 'Las credenciales proporcionadas no son válidas, verifique nuevamente su información por favor.';
}
$rs['sw'] = $sw;
$rs['obs'] = $obs;
$rs['rol'] = $_SESSION['rol'];
$rs['nombre'] = $nombre;
$dat = json_encode($rs);
echo $dat;
