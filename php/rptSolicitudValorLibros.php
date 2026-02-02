<?php 
require_once('html2pdf/html2pdf.class.php'); 

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

    $query = "select * from inmueble_univ where documento_identidad like '$ci_' and numero_inmueble like '$numInmueble_' ";  
    $stmt = $cons->query($query); 

    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
    $documento = "
    <style type='text/css'>
        ul.main { width: 95%; list-style-type: square; }
        ul.main li { padding-bottom: 2mm; }
    </style> 
    ";  
    foreach ($resultados as $row) { 
        $apll = $row['primer_apellido_sigla']." ".$row['segundo_apellido']." ".$row['apellido_esposo'];
        $nombre = $row['nombre_rsocial'];
        if($apll)
            $nombre .= " ".$apll;
            $documento .= "
            <page format='272x210' style='font: arial; color: #222222;'>
            <!--136=14cm y 210=21.5cm--> 
            <div style='margin:55px;'>
                <div style='text-align: right; margin-bottom: 20px;'>
                    <p>El Alto - Bolivia, <span id='fechaActual'>".date("d")." de ".$conn->obtenerNombreMes(intval(date("m")))." de ".date("Y")."</span></p>
                </div>
                <div style='margin-bottom: 20px;'>
                    <p>Señor:</p>
                    <p>Ing. Veronica Judith Mancilla Nina<br>
                    Director de Administración Tributaria Municipal de El Alto</p>
                    <p>Presente:</p>
                </div>
                <div style='text-align: right; margin-bottom: 20px;'>
                    <span style='text-decoration:underline;'><b>REF.: VALOR EN LIBROS INMUEBLES GESTION $gestion_</b></span>
                </div>
                <div style='text-align: justify;'>
                    <p>De mi consideracion,</p>
                    <p>Mediante la presente, solicito a su digna autoridad, otorgarnos la liquidación <b>valor en libros</b> del inmueble con numero de REGISTRO TRIBUTARIO: ".$row['numero_inmueble'].", 
                    perteneciente a $nombre con número de documento de identidad ".$row['tipo_documento'].":$ci_.
                    </p>
                    <p>Sin otro particular, me despido de usted muy atentamente,</p>
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
} 
?>