<?php
session_start();
require_once './conexionpsql.php';

$conn = new Conexion();
$cons = $conn->conectar();
$cabecera = new stdClass();

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
} 

$pjson = array(); 

$query = " select  * 
from datm_deudores_impva  as a
where a.estado_ and a.con_anotacion = ".($impvaAnotado?'true':'false')."; ";
$stmt = $cons->query($query);
$deudores = $stmt->fetchAll(PDO::FETCH_ASSOC); 

$html = "
<hr>
<div class='row align-items-center' style='text-align:center; width:98%;padding:0 0 0 3rem;'>   
    <div class='col-md-12'>
    <table id='tableConAnotacion' data-toggle='table' data-search='true' data-show-toggle='true' 
            data-show-fullscreen='true' data-show-columns='true' data-show-columns-toggle-all='true' 
            data-show-export='true' data-click-to-select='true' data-pagination='true' 
            data-page-list='[10, 25, 50, 100, all]' data-locale='es-ES' class='table table-striped' style='font-size:0.8rem;' data-sort-name='id' data-sort-order='asc'>
                <thead>
                    <th>NOMBRE</th>
                    <th>C.I.</th>
                    <th>PLACA</th>
                    <th>MONTO RETENIDO (Bs.)</th>
                    <th>GESTIONES CON PROCESO</th> 
                    ".($impvaAnotado=='1'?"<th>ANOTACION</th>":"")."
                </thead>
                <tbody> 
                ";

foreach ($deudores as $row) { 
    $html .= " <tr>
                    <td>" . $row['nombre'] . "</td>
                    <td>" . $row['ci'] . "</td>
                    <td>" . $row['placa'] . "</td>
                    <td>" . $row['monto_retenido'] . "</td>
                    <td>" . $row['gestion'] . "</td> 
                    ".($impvaAnotado=='1'?"<td>" . $row['anotacion'] . "</td>":"")."
                </tr> ";
}
$html .= "</tbody>
            </table>
            </div>
            </div>";

$pjson['html'] = $html;
$dat = json_encode($pjson);
echo $dat;
