<?php
session_start();
require_once("conexionpsql.php");

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$conn = new Conexion();
$cons = $conn->conectar();

//VERIFICAMOS SI EXISTE EL CONTRIBUYENTE "EN EL PADRON" CON EL PIN CORRECTO
//$query = "select * from contribuyente where tipo_documento like '$tipodoc_' and documento_identidad like '$ci_' and  pin = $pin_ and estado_ = 1";
$query = "select * from contribuyente where (documento_identidad LIKE '$ci_' OR documento_identidad_apo LIKE '$ci_'  ) and  pin = $pin_  ";
if ($_SESSION['swlogin'])
    $query = "select * from contribuyente where (documento_identidad LIKE '$ci_' OR documento_identidad_apo LIKE '$ci_'  )  ";

$stmt = $cons->query($query);
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

$documento = "La información proporcionada no fue correcta, por favor asegurese de ingresar los datos correctos.";
$sw = '0';
$rs = array();
$rs['titulo_'] = "No se encontraron resultados";
$rs['color_'] = "red";

if ($resultados) {
    //AHORA OBTENEMOS TODOS LOS RESULTADOS DESDE LA BASE DEL RUAT
    //HACER UN JOIN DE TODOS LOS RUBROS CONSULTANDO POR $ci_  

    $fechaCargado = '31/03/2024';
    $resultados = array();
    $query = "
    SELECT compendio.documento_identidad, 
        SUM(CASE WHEN compendio.origen = 'inmueble' THEN compendio.conteo ELSE 0 END) AS inmueble,
        SUM(CASE WHEN compendio.origen = 'vehiculo' THEN compendio.conteo ELSE 0 END) AS vehiculo,
        SUM(CASE WHEN compendio.origen = 'actividad' THEN compendio.conteo ELSE 0 END) AS actividad,
        SUM(conteo) AS conteo_total 
    FROM (

        (SELECT documento_identidad, COUNT(*) AS conteo, 'inmueble' AS origen
        FROM inmueble_univ AS UN
        WHERE  (documento_identidad LIKE '$ci_' OR documento_identidad_apo LIKE '$ci_'  )
        GROUP BY documento_identidad)
        
        UNION ALL
        
        (SELECT documento_identidad, COUNT(*) AS conteo, 'vehiculo' AS origen
        FROM vehiculo_univ AS UN
        WHERE  (documento_identidad LIKE '$ci_' OR documento_identidad_apo LIKE '$ci_'  )
        GROUP BY documento_identidad)
        
        UNION ALL
        
        (SELECT documento_identidad, COUNT(*) AS conteo, 'actividad' AS origen
        FROM actividad_univ AS UN
        WHERE   (documento_identidad LIKE '$ci_' OR documento_identidad_apo LIKE '$ci_'  )
        GROUP BY documento_identidad)
    ) AS compendio
    GROUP BY compendio.documento_identidad
    ORDER BY compendio.documento_identidad;
    ";
    $rs['query'] = $query;

    $stmt = $cons->query($query);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$resultados) {
        $resultados[0]['inmueble']  = 0;
        $resultados[0]['vehiculo']  = 0;
        $resultados[0]['actividad']  = 0;
    }

    $rs['color_'] = "dark";
    $rs['titulo_'] = "<div style='width:100%;text-align:center;'>$tipodoc_: $ci_</div>";
    $documento =
        "<div class='infgralcontri'>
            <div class='row'>   
                <div class='col-md-6'>
                    <img src='../img/casa2_.png' alt='Inmuebles'>
                </div>                     
                <div class='col-md-6'>
                    <span>" . $resultados[0]['inmueble'] . "</span>
                </div>
            </div>
            <hr>            
            <div class='row'>   
                <div class='col-md-6'>
                    <img src='../img/coche2_.png' alt='Inmuebles'>
                </div>                     
                <div class='col-md-6'>
                    <span>" . $resultados[0]['vehiculo'] . "</span>
                </div>                     
            </div>          
            <hr>                       
            <div class='row'>   
                <div class='col-md-6'>
                    <img src='../img/caseta2_.png' alt='Inmuebles'>
                </div>                     
                <div class='col-md-6'>
                    <span>" . $resultados[0]['actividad'] . "</span>
                </div>                     
            </div>    
        </div>                 
        ";
}
$rs['html'] = $documento;
$dat = json_encode($rs);
echo $dat;
