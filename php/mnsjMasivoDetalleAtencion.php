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
            select a.documento_identidad, a.nombres, a.contacto, a.estado, a.fecha_envio, a.fecha_atencion, b.nombres as nombre_usuario 
            from uf_mnsj_masivo a 
            left join datm_usuario b on b.id = a.idusuario_atencion 
            where a.estado_  is true and a.idmnsj_masivo = $idmnsj limit 1;";
    $stmt = $cons->query($query);
    $inf = $stmt->fetch(PDO::FETCH_ASSOC);
    $data = array();

    $html_ = '<div class="element-detail">';                            
    $html_ .= '<ul>';
    $html_ .= '<li><span class="element-label">CI:</span> ' . $inf['documento_identidad']  . '</li>';                   
    $html_ .= '<li><span class="element-label">Nombres:</span> ' . $inf['nombres'] . '</li>';                           
    $html_ .= '<li><span class="element-label">Estado:</span> ' . $inf['estado'] . '</li>';                             
    $html_ .= '<li><span class="element-label">Fecha de envio:</span> ' . $inf['fecha_envio'] . '</li>';                
    $html_ .= '<li><span class="element-label">Fecha de atención:</span> ' . $inf['fecha_atencion'] . '</li>';          
    $html_ .= '<li><span class="element-label">Usuario responsable:</span> ' . $inf['nombre_usuario'] . '</li>';        
    $html_ .= '</ul>';
    $html_ .= '</div>';

    $resp['html'] = $html_;
} catch (Exception $th) {
    $resp['html'] = $th;
} finally {
    $dat = json_encode($resp);
    echo $dat;
}
