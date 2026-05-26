<?php
session_start();
require_once("conexionpsql.php");

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$conn = new Conexion();
$cons = $conn->conectar();


$documento = "El numero de documento de identidad $ci_ no tiene retenciones registradas.";
$sw = '0';
$rs = array();
$rs['titulo_'] = "No se encontraron resultados";
$rs['color_'] = "red";

$swApoderado = false;
$swTitular = false;

$resultadosTitular = array();
$resultadosApoderado = array();

try {

    $query = "select count(a.rubro) as cantidad_retenciones ,  a.documento, a.rubro , 
    STRING_AGG(distinct a.gestion_retencion::text, ', ') AS gestiones
from datm_uaj_retenciones a 
where a.estado_
group by a.documento, a.rubro 
having TRIM(UPPER(a.documento)) like '$ci_';";
    $stmt = $cons->query($query);
    $resultadosCi = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $documento = "<div style='text-align:center; vertical-align: middle; width:97%;'>";

    if ($resultadosCi) {

        $rs['titulo_'] = "El número de documento <b>$ci_</b> tiene retención bancaria por concepto de:";
        $rs['color_'] = "red";
        foreach ($resultadosCi as $key => $value) {
            $documento .=
                "
            
            <hr> 
            <div class='row'>   
                <div class='col-md-6'>";

            switch ($value['rubro']) {
                case 'INMUEBLE':
                    $documento .= "<img src='../img/casa2_.png' style='max-width:4.5rem;' alt='Inmuebles'>";
                    break;
                case 'ACTIVIDAD ECONOMICA':
                    $documento .= "<img src='../img/caseta2_.png'  style='max-width:4.5rem;' alt='Actividad economica'>";
                    break;
                case 'PUBLICIDAD':
                    $documento .= "<img src='../img/publi_.jpg'  style='max-width:4.5rem;' alt='Publicidad'>";
                    break;
                default:
                    $documento .= "<img src='../img/coche2_.png' style='max-width:4.5rem;' alt='Vehiculo'>";
                    break;
            }

            $documento .= "</div>                     
            <div class='col-md-6'>
                <span style='font-size:2.5rem !important'>" . $value['cantidad_retenciones'] . "</span>
            </div>
            <!-- <div class='col-md-4'>
                <span>" . $value['gestiones'] . "</span>
            </div> -->
        </div>                            
    ";
        }
    }
    $documento .= "</div><hr><span style='font-size:0.6rem;color:gray;'>* Datos actualizados al 18 de octubre de 2024</span>";
    $rs['color_'] = "dark";
    $rs['html'] = $documento;
    $dat = json_encode($rs);
    echo $dat;
} catch (PDOException $e) {
    echo $query;
    // Captura el error de PDO y muestra el mensaje
    echo "Error en la consulta: " . $e->getMessage();
}
