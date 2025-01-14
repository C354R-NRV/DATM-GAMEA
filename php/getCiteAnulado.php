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
    END as estado, c.usuario usuario_anulacion, TO_CHAR(a.fecha_anulacion::timestamp, 'DD/MM/YYYY HH24:MI:SS') fecha_anulacion
    from datm_cites a 
    left join datm_usuario b on b.id =  a.usuario_ 
    left join datm_usuario c on c.id =  a.usuario_anulacion
    where idcite = $idcite;";

$stmt = $cons->query($query);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    echo '<div class="cite-detail">'; 
    echo '<ul>';
    echo '<li><span class="label">Fecha de creación:</span> ' . htmlspecialchars($result['fecha']) . '</li>';
    echo '<li><span class="label">Usuario creador:</span> ' . htmlspecialchars($result['usuario']) . '</li>';
    echo '<li><span class="label">Código de Cite:</span> ' . htmlspecialchars($result['cite']) . '</li>';
    echo '<li><span class="label">Referencia:</span> ' . htmlspecialchars($result['referencia']) . '</li>';
    echo '<li><span class="label">Fecha de anulación:</span> ' . htmlspecialchars($result['fecha_anulacion']) . '</li>';
    echo '<li><span class="label">Usuario que anuló:</span> ' . htmlspecialchars($result['usuario_anulacion']) . '</li>';
    echo '<li><span class="label">Motivo de anulación:</span> ' . htmlspecialchars($result['motivo_anulacion']) . '</li>';
    echo '</ul>';
    echo '</div>';
} else {
    echo '<p>No se encontró información para el Cite especificado.</p>';
}
