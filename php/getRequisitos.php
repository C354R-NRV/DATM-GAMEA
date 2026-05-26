<?php
require_once("conexionpsql.php");

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$conn = new Conexion();
$cons = $conn->conectar();

if ($categoria_ == 'actividades economicas')
    $categoria_ = 'mercados';
$query = "select * from requisitos where categoria like '$categoria_' and estado_ order by orden; ";
$stmt = $cons->query($query);

$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
$documento = '';
$cnt = 0;
foreach ($resultados as $row) {
    $categoria = $row['categoria'];
    $codigo = $row['codigo'];
    $color = $row['color'];
    $generaDocumento = $row['generaDocumento'];
    $detalle = $row['detalle'];
    if ($cnt == 0) {
        $documento .= "<div style='padding:0 0 0 2em;' class= 'row'>";
    }

    $documento .=
        "<div class='col-sm-6' >                        
            <p><a class='link_' onclick='getcontenido(\"$categoria\",\"$color\", \"$codigo\" , \"$detalle\", $generaDocumento)' ><i class='fa fa-cloud-download text-verde me-2' ></i> $detalle";

    if ($generaDocumento == 1) {
        $documento .= " *";
    }

    $documento .=  "</a></p>
            </div>  
        ";

    $cnt++;
    if ($cnt == 2) {
        $cnt = 0;
        $documento .= "</div>";
    }
}
if ($cnt <= 2) {
    $documento .= "</div>";
}

$rs['html'] = $documento;
$dat = json_encode($rs);
echo $dat;
