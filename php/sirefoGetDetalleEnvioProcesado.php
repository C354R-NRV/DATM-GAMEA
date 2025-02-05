<?php
session_start();
require_once './conexionpsql.php';
foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
$conn = new Conexion();
$cons = $conn->conectar();
$resp = array();
try {

    $query = "
select respuesta,  to_char(fecha_circular, 'YYYY-MM-DD HH24:MI:SS') AS fecha_circular, to_char(fecha_consulta, 'YYYY-MM-DD HH24:MI:SS') AS fecha_consulta, circular, usuario
from srf_estado_envio a 
left join datm_usuario b on b.id = a.uconsulta_
where a.estado_  is true and a.id_cabecera_solicitud = $idsolicitud limit 1;";
    $stmt = $cons->query($query);
    $inf = $stmt->fetch(PDO::FETCH_ASSOC);
    $data = array();

    $html_ = '<div class="element-detail">';
    $html_ .= '<ul>';
    $html_ .= '<li><span class="element-label">Estado de solicitud en SIREFO:</span> ' . $inf['respuesta'] . '</li>';
    $html_ .= '<li><span class="element-label">Circular:</span> ' . $inf['circular'] . '</li>';
    $html_ .= '<li><span class="element-label">Fecha de circular:</span> ' . $inf['fecha_circular'] . '</li>';
    $html_ .= '<li><span class="element-label">Fecha de ultima actualización:</span> ' . $inf['fecha_consulta'] . '</li>';
    $html_ .= '<li><span class="element-label">Usuario ultima actualización:</span> ' . $inf['usuario'] . '</li>';
    $html_ .= '</ul>';
    $html_ .= '</div>';
    $resp['html'] = $html_;
} catch (Exception $th) {
    $resp['html'] = $th;
} finally {

    $dat = json_encode($resp);
    echo $dat;
}
