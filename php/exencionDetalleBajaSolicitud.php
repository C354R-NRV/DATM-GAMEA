<?php
session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
$conn = new Conexion();
$cons = $conn->conectar();

$query = "select obs_baja, a.codigo_solicitud, a.gestion, b.usuario, a.fbaja_, a.idcabecera  
            from exc_cabecera a left join datm_usuario b on a.ubaja_ = b.id  where a.idcabecera = $idsolicitud";
$stmt = $cons->query($query);
$solicitud = $stmt->fetch(PDO::FETCH_ASSOC);

$html = '<p>Código de solicitud: <b>' . $solicitud['codigo_solicitud'] . '</b></p>';
$html .= '<p>Gestión solicitada: <b>' . $solicitud['gestion'] . '</b></p>';
$html .= '<p>Revertido por: <b>' . $solicitud['usuario'] . '</b></p>';
$html .= '<p>Fecha de reversion: <b>' . $solicitud['fbaja_'] . '</b></p>';
$html .= '<p>Detalle de baja: <b>' . $solicitud['obs_baja'] . '</b></p>';

$query = "select c.detalle, a.documento_path  
from exc_item_actuado a  
left join exc_actuado b on a.idactuado = b.idactuado  
left join exc_requisito c on a.idrequisito = c.idrequisito 
where a.estado_ is true and b.idcabecera = $idsolicitud";

$stmt = $cons->query($query);
$actuados = $stmt->fetchAll(PDO::FETCH_ASSOC);
$html .= '
<table class="striped-table">
    <thead>
        <tr>
            <th>Requisito</th>
            <th>Codigo de documento generado</th>
            <th>Visualizar</th>
        </tr>
    </thead> 
    <tbody>
';
foreach ($actuados as $key => $value) {

    $html .= '
    
        <tr>
            <td>' . $value['detalle'] . '</td>
            <td>' . $value['documento_path'] . '</td>
            <td><a class="btn verDoc" onclick="verDocPopup(\'../static/exencion/' . $solicitud['usuario'] . '/' . $value['documento_path'] . '\')">
                <i class="fa fa-eye" aria-hidden="true" style="color:#3d7915; font-size:1.2rem;"></i></a>
            </td>
        </tr>
    
    ';
}
$html .= '  
    </tbody>
    </table>
';

echo $html;
