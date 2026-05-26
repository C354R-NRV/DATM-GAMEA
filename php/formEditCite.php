<?php
session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
$conn = new Conexion();
$cons = $conn->conectar();

// Query to get the maximum correlative for the given unit and code
$query = "select TO_CHAR(a.fecha_registro::timestamp, 'DD/MM/YYYY HH24:MI:SS') fecha,  b.usuario, a.cite, a.referencia, 
        a.motivo_anulacion, CASE 
        WHEN a.estado_ IS TRUE THEN 'Activo'
        WHEN a.estado_ IS FALSE THEN 'Revertido'
    END as estado, c.usuario usuario_anulacion, TO_CHAR(a.fecha_anulacion::timestamp, 'DD/MM/YYYY HH24:MI:SS') fecha_anulacion, hhrr_, destino
    from datm_cites a 
    left join datm_usuario b on b.id =  a.usuario_ 
    left join datm_usuario c on c.id =  a.usuario_anulacion
    where idcite = $idcite;";

$stmt = $cons->query($query);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    echo '<div class="element-detail">'; 
    echo '<ul>';
    echo '<li><span class="element-label">Usuario creador:</span> ' . htmlspecialchars($result['usuario']) . '</li>'; 
    echo '<li><span class="element-label">Fecha de CITE:</span><input class="form-control" type="text" id="fecha_registro" value="' .$result['fecha'] . '"/></li>';
    echo '<li><span class="element-label">Hoja de ruta:</span><input class="form-control" type="text" id="hhrr_" value=" ' . htmlspecialchars($result['hhrr_']) . '"></li>';
    echo '<li><span class="element-label">Referencia:</span><input class="form-control" type="text" id="referencia" value=" ' . htmlspecialchars($result['referencia']) . '"></li>';
    echo '<li><span class="element-label">Destinatario:</span><input  class="form-control" type="text" id="destino" value=" ' . htmlspecialchars($result['destino']) . '"></li>';
    echo '</ul>';
    echo '</div>';
} else {
    echo '<p>No se encontró información para el Cite especificado.</p>';
}
