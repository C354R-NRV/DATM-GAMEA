<?php
session_start();
require_once("conexionpsql.php");

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$conn = new Conexion();
$cons = $conn->conectar();


$documento = "El numero de documento de identidad $ci_ no se encuentra registrado.";
$sw = '0';
$rs = array();
$rs['titulo_'] = "No se encontraron resultados";
$rs['color_'] = "red";

$swApoderado = false;
$swTitular = false;

$resultadosTitular = array();
$resultadosApoderado = array();


$query = "select * from contribuyente where (documento_identidad LIKE '$ci_' OR documento_identidad_apo LIKE '$ci_'  )";
$stmt = $cons->query($query);
$resultadosCi = $stmt->fetch(PDO::FETCH_ASSOC);


if ($resultadosCi) {

    //VERIFICAMOS SI EXISTE EL CONTRIBUYENTE "EN EL PADRON" CON EL PIN CORRECTO
    //$query = "select * from contribuyente where tipo_documento like '$tipodoc_' and documento_identidad like '$ci_' and  pin = $pin_ and estado_ = 1";
    $query = "select * from contribuyente where (documento_identidad LIKE '$ci_' OR documento_identidad_apo LIKE '$ci_'  ) and  pin = $pin_ ";
    if ($_SESSION['swlogin'])
        $query = "select * from contribuyente where (documento_identidad LIKE '$ci_' OR documento_identidad_apo LIKE '$ci_'  )  ";

    $stmt = $cons->query($query);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $documento = "El número PIN no corresponde al numero de documento proporcionado.";
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
    SELECT compendio.tipo_documento,compendio.documento_identidad, 
        SUM(CASE WHEN compendio.origen = 'inmueble' THEN compendio.conteo ELSE 0 END) AS inmueble,
        SUM(CASE WHEN compendio.origen = 'vehiculo' THEN compendio.conteo ELSE 0 END) AS vehiculo,
        SUM(CASE WHEN compendio.origen = 'actividad' THEN compendio.conteo ELSE 0 END) AS actividad,
        SUM(conteo) AS conteo_total 
    FROM (

        (SELECT  tipo_documento, documento_identidad, COUNT(*) AS conteo, 'inmueble' AS origen
        FROM inmueble_univ AS UN
        WHERE  ( documento_identidad_apo LIKE '$ci_'  )
        GROUP BY tipo_documento,documento_identidad)
        
        UNION ALL
        
        (SELECT tipo_documento,documento_identidad, COUNT(*) AS conteo, 'vehiculo' AS origen
        FROM vehiculo_univ AS UN
        WHERE  ( documento_identidad_apo LIKE '$ci_'  )
        GROUP BY tipo_documento,documento_identidad)
        
        UNION ALL
        
        (SELECT tipo_documento,documento_identidad, COUNT(*) AS conteo, 'actividad' AS origen
        FROM actividad_univ AS UN
        WHERE   ( documento_identidad_apo LIKE '$ci_'  )
        GROUP BY tipo_documento,documento_identidad)
    ) AS compendio
    GROUP BY compendio.tipo_documento, compendio.documento_identidad
    ORDER BY compendio.tipo_documento, compendio.documento_identidad;
    ";
        $rs['query'] = $query;

        $stmt = $cons->query($query);

        $resultadosApoderado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (isset($resultadosApoderado[0]['documento_identidad'])) {
            $swApoderado = true;
        }
        $query = "
    SELECT 
        compendio.tipo_documento, 
        compendio.documento_identidad, 
        SUM(CASE WHEN compendio.origen = 'inmueble' THEN compendio.conteo ELSE 0 END) AS inmueble,
        SUM(CASE WHEN compendio.origen = 'vehiculo' THEN compendio.conteo ELSE 0 END) AS vehiculo,
        SUM(CASE WHEN compendio.origen = 'actividad' THEN compendio.conteo ELSE 0 END) AS actividad,
        SUM(conteo) AS conteo_total,
        MAX(CASE WHEN compendio.origen = 'inmueble' THEN compendio.numeros ELSE NULL END) AS numeros_inmueble,
        MAX(CASE WHEN compendio.origen = 'vehiculo' THEN compendio.numeros ELSE NULL END) AS numeros_vehiculo,
        MAX(CASE WHEN compendio.origen = 'actividad' THEN compendio.numeros ELSE NULL END) AS numeros_actividad
    FROM ( 
        (SELECT 
            tipo_documento,
            documento_identidad, 
            COUNT(*) AS conteo, 
            'inmueble' AS origen,
            STRING_AGG(CAST(numero_inmueble AS TEXT), ', ') AS numeros
        FROM inmueble_univ AS UN
        WHERE (documento_identidad LIKE '$ci_')
        GROUP BY tipo_documento, documento_identidad)
        
        UNION ALL
        
        (SELECT 
            tipo_documento,
            documento_identidad, 
            COUNT(*) AS conteo, 
            'vehiculo' AS origen,
            STRING_AGG(nro_pta, ', ') AS numeros
        FROM vehiculo_univ AS UN
        WHERE (documento_identidad LIKE '$ci_')
        GROUP BY tipo_documento, documento_identidad)
        
        UNION ALL
        
        (SELECT 
            tipo_documento,
            documento_identidad, 
            COUNT(*) AS conteo, 
            'actividad' AS origen,
            STRING_AGG(CAST(numero_actividad AS TEXT), ', ') AS numeros
        FROM actividad_univ AS UN
        WHERE (documento_identidad LIKE '$ci_')
        GROUP BY tipo_documento, documento_identidad)
    ) AS compendio
    GROUP BY compendio.tipo_documento, compendio.documento_identidad
    ORDER BY compendio.tipo_documento, compendio.documento_identidad;
    ";
        $rs['query'] = $query;

        $stmt = $cons->query($query);

        $resultadosTitular = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (isset($resultadosTitular[0]['documento_identidad'])) {
            $swTitular = true;
        }

        if (!$swTitular) {
            $resultadosTitular[0]['inmueble']  = 0;
            $resultadosTitular[0]['vehiculo']  = 0;
            $resultadosTitular[0]['actividad']  = 0;

            
            $resultadosTitular[0]['documento_identidad'] = '';
            $resultadosTitular[0]['tipo_documento'] = '';
            if ($ci_ !=  $resultadosApoderado[0]['documento_identidad']) {
                $resultadosTitular[0]['documento_identidad'] = $ci_;
                $resultadosTitular[0]['tipo_documento'] = $tipodoc_;
            }
        }
        if ($swApoderado) {
            $rs['titulo_'] = "";
            $documento =
                "<div class='infgralcontri'>
                    <div class='row'>   
                        <div class='col-md-4'> 
                        </div>                     
                        <div class='col-md-4'>
                            <span style='font-size:1rem !important; font-weight:bold;'>" . $resultadosTitular[0]['tipo_documento'] . ' ' . $resultadosTitular[0]['documento_identidad'] . "</span>
                        </div>
                        <div class='col-md-4'>
                            <span style='font-size:1rem !important; font-weight:bold;'>" . $resultadosApoderado[0]['tipo_documento'] . ' ' . $resultadosApoderado[0]['documento_identidad'] . "</span>
                        </div>
                    </div> 
                    <div class='row'>   
                        <div class='col-md-4'>
                            <img src='../img/casa2_.png' alt='Inmuebles'>
                        </div>                     
                        <div class='col-md-4'>
                            <span>" . $resultadosTitular[0]['inmueble'] . "</span>
                            ".(($_SESSION['idusuario'] and $resultadosTitular[0]['inmueble']>0) ?'<br>'.$resultadosTitular[0]['numeros_inmueble']:'')."
                        </div>
                        <div class='col-md-4'>
                            <span>" . $resultadosApoderado[0]['inmueble'] . "</span> 
                        </div>
                    </div>
                    <hr>            
                    <div class='row'>   
                        <div class='col-md-4'>
                            <img src='../img/coche2_.png' alt='Vehiculo'>
                        </div>                     
                        <div class='col-md-4'>
                            <span>" . $resultadosTitular[0]['vehiculo'] .  "</span>
                            ".(($_SESSION['idusuario'] and $resultadosTitular[0]['vehiculo']>0) ?'<br>'.$resultadosTitular[0]['numeros_vehiculo']:'')."
                        </div>                     
                        <div class='col-md-4'>
                            <span>" . $resultadosApoderado[0]['vehiculo'] . "</span>
                        </div>                     
                    </div>          
                    <hr>                       
                    <div class='row'>   
                        <div class='col-md-4'>
                            <img src='../img/caseta2_.png' alt='Actividad Economica'>
                        </div>                     
                        <div class='col-md-4'>
                            <span>" . $resultadosTitular[0]['actividad'] . "</span>
                            ".(($_SESSION['idusuario'] and $resultadosTitular[0]['actividad']>0) ?'<br>'.$resultadosTitular[0]['numeros_actividad']:'')."
                        </div>                     
                        <div class='col-md-4'>
                            <span>" . $resultadosApoderado[0]['actividad'] . "</span>
                        </div>                     
                    </div>    
                </div>                 
                ";
        } else {
            $rs['titulo_'] = "<div style='width:100%;text-align:center;'>" . $resultadosTitular[0]['tipo_documento'] . ": " . $resultadosTitular[0]['documento_identidad'] . "</div>";
            $documento =
                "<div class='infgralcontri'>
        <div class='row'>   
            <div class='col-md-6'>
                <img src='../img/casa2_.png' alt='Inmuebles'>
            </div>                     
            <div class='col-md-6'>
                <span>" . $resultadosTitular[0]['inmueble'] . "</span>
                ".(($_SESSION['idusuario'] and $resultadosTitular[0]['inmueble']>0) ?'<br>'.$resultadosTitular[0]['numeros_inmueble']:'')."
            </div>
        </div>
        <hr>            
        <div class='row'>   
            <div class='col-md-6'>
                <img src='../img/coche2_.png' alt='Vehiculo'>
            </div>                     
            <div class='col-md-6'>
                <span>" . $resultadosTitular[0]['vehiculo'] . "</span>
                ".(($_SESSION['idusuario'] and $resultadosTitular[0]['vehiculo']>0) ?'<br>'.$resultadosTitular[0]['numeros_vehiculo']:'')."
            </div>                     
        </div>          
        <hr>                       
        <div class='row'>   
            <div class='col-md-6'>
                <img src='../img/caseta2_.png' alt='Actividad Economica'>
            </div>                     
            <div class='col-md-6'>
                <span>" . $resultadosTitular[0]['actividad'] . "</span>
                ".(($_SESSION['idusuario'] and $resultadosTitular[0]['actividad']>0) ?'<br>'.$resultadosTitular[0]['numeros_actividad']:'')."
            </div>                     
        </div>    
    </div>                 
    ";
        }
    }
}
$rs['color_'] = "dark";
$rs['html'] = $documento;
$dat = json_encode($rs);
echo $dat;
