<?php  

require '../vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
require_once("conexionpsql.php"); 

foreach ($_GET as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}  
// $nombreRegularizado   --> sera una variable enviada desde el formulario, que representa el nuevo nombre a ser regularizado
/**
 * en el formulario se solicitara el numero de inmueble, CI del titular y nombre a ser regularizado
 */

$conn = new Conexion();
$cons = $conn->conectar(); 

try {

    $query = "select * from inmueble where documento_identidad like '$ci_' and numero_inmueble like '$numInmueble_' ";
    /* echo $query; */ 
    $stmt = $cons->query($query);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
    $documento = "
    <style type='text/css'>
        ul.main { width: 95%; list-style-type: square; }
        ul.main li { padding-bottom: 2mm; } 
    </style> 
    ";    

    $aux_qr = "<qrcode value='" . $codigoQr. "' ec='Q' style='width: 30mm; border: none;' ></qrcode>";
    
    
    foreach ($resultados as $row) { 

        $codigoQr = '';

        $apll = $row['primer_apellido_sigla']." ".$row['segundo_apellido']." ".$row['apellido_esposo'];
        $nombre = $row['nombre_rsocial'];
        if($apll)
            $nombre .= " ".$apll;
        $documento .= "
            <page format='272x210' style='font: arial; color: #222222;'>
            <!--136=14cm y 210=21.5cm--> 
            <div style='margin:55px;'>
                <div style='text-align: right; margin-bottom: 20px;'>
                    <p>El Alto - Bolivia, <span id='fechaActual'>".date("d")." de ".obtenerNombreMes(intval(date("m")))." de ".date("Y")."</span></p>
                </div>
                <div style='margin-bottom: 20px;'>
                    <p>Señor:</p>
                    <p>Lic. Jhon Villalba Camacho<br>
                    Director de Administración Tributaria Municipal de El Alto<br>
                    GOBIERNO AUTONOMO MUNICIPAL DE EL ALTO</p>
                    <p>Presente:</p>
                </div>
                <div style='text-align: right; margin-bottom: 20px;'>
                    <span style='text-decoration:underline;'><b>REF.: SOLICITUD DE REGULARIZACIÓN DE PROPIEDAD MÁS TRANSFERENCIA/b></span>
                </div>
                <div>
                    <p>Mediante la presente tengo a bien saludarle y desearle éxito en el cargo que desempeña.</p>
                    <p>El motivo de la misma es para solicitarle muy respetuosamente instruya por la unidad que corresponda 
                    a LA <b>REGULARIZACIÓN DE PROPIEDAD MAS TRANSFERENCIA</b> del INMUEBLE CON REGISTRO TRIBUTARIO No. ".$row['numero_inmueble'].", 
                    ya que se encuentra a nombre de $nombre, y requiero que se regularice a $nombreRegularizado.</p> 
                    <p>No dudando de su gentil aceptación sin otro particular y agradecido de antemano a la presente solicitud 
                    me despido con las consideraciones que el caso amerita.</p>
                    <p>Atentamente,</p>
                    <p></p>
                    </div>
                </div>
                <table style='text-align: center; border-top: solid 1px; width: 35%' align='center'><tr><td style='width: 100%'>
                $nombre<br>
                ".$row['tipo_documento']." $ci_</td></tr>
                </table> 
            ";

        $documento .="</page>";  
    } 
    if($resultados){
        $path = '/static/solicitudes/'.$numInmueble_. rand(111, 999) . '.pdf';
        /* echo $documento; */
        $html2pdf = new Html2Pdf();
        $html2pdf->writeHTML($documento); 
        $html2pdf->Output();
    }else  
        echo "No se logro recuperar los registros";
       
} catch (PDOException $e) {
    echo "Error al ejecutar la consulta: " . $e->getMessage();
}    $aux_qr = "<qrcode value='" . $codigoQr. "' ec='Q' style='width: 30mm; border: none;' ></qrcode>";
function obtenerNombreMes($numero_mes) {
    // Array asociativo para mapear números de mes a nombres en español
    $meses = array(
        1 => 'enero',
        2 => 'febrero',
        3 => 'marzo',
        4 => 'abril',
        5 => 'mayo',
        6 => 'junio',
        7 => 'julio',
        8 => 'agosto',
        9 => 'septiembre',
        10 => 'octubre',
        11 => 'noviembre',
        12 => 'diciembre'
    );
    
    // Verificar si el número de mes está en el rango válido
    if ($numero_mes < 1 || $numero_mes > 12) {
        return 'Mes inválido';
    }
    
    // Obtener el nombre del mes del array asociativo
    return $meses[$numero_mes];
}
?>