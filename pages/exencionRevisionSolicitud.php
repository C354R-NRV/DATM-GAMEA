<!DOCTYPE html>
<?php
session_start();
require_once '../php/conexionpsql.php';
require_once '../vendor/autoload.php';

$conn = new Conexion();
$cons = $conn->conectar();

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('../views');
$twig = new Environment($loader);
if (!$_SESSION['swlogin']) {
    echo "<script>window.location.href = 'index.php';</script>";
}

// tambien seria IMPORTANTE verificar que la linea de tiempo que se esta viendo corresponde al usuario que la registro!!!
?>
<html lang="es">

<head>
    <title>EXENCION</title>
    <?php
    echo $twig->render('linkStyle.twig');
    ?>
    <link href="../css/styleRecursoIa.css" rel="stylesheet">
    <link href="../vendor/bootstrap-table-master/dist/bootstrap-table.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .containerDetalleSolicitud {
            width: 98%;
            margin: auto;
            /* border: 1px solid #000; */
            border-radius: 10px;
            padding: 1rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
        }

        .headerDetalleSolicitud {
            display: flex;
            justify-content: space-between;
            border: 1px solid #fff;
            /* padding: 10px; */
            /* margin-bottom: 20px; */
            border-radius: 5px;
        }

        .headerDetalleSolicitud p {
            margin: 5px 0;
        }

        .contenedorDigitaliza {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        h1 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        h3 {
            color: rgb(8, 105, 114);
            padding: 0.5rem 0 0 0;
            font-size: 1.2rem;
        }

        /* Contenedor principal */
        .solicitud-container {
            background-color: white;
            padding: 24px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            max-width: 800px;
            margin: 0 auto;
        }

        /* Grid para las columnas */
        .solicitud-grid {
            display: grid;
            grid-template-columns: 1fr;
            /* Por defecto una columna */
            gap: 16px;
        }

        /* Estilos para cada elemento de información */
        .info-item {
            margin-bottom: 12px;
        }

        /* Estilos para títulos y textos */
        .solicitud-titulo {
            font-size: 20px;
            font-weight: bold;
            color: #0d7e7e;
            margin-top: 0;
            margin-bottom: 16px;
        }

        .info-label {
            color: #0d7e7e;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .info-value {
            font-weight: normal;
        }

        /* Media query para pantallas medianas y grandes */
        @media (min-width: 768px) {
            .solicitud-grid {
                grid-template-columns: 1fr 1fr;
                /* Dos columnas en pantallas más grandes */
            }
        }
    </style>
</head>

<body>
    <?php
    echo $twig->render('load.twig');
    ?>
    <!-- Navbar Start -->
    <?php
    echo $twig->render('menuIni.twig');

    if ($_SESSION['swlogin'] == '1') {
        echo $twig->render('menuLogin.twig', array('datSesion' => $_SESSION));
    } else {
        echo $twig->render('menuVisita.twig');
    }

    echo $twig->render('menuFin.twig');
    ?>
    <?php
    echo $twig->render('prebodyltIni.twig');
    ?>
    <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
    <li class="breadcrumb-item"><a class="text-white">UAJ</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page"> <a class="text-white" href="exencionList.php">EXENCION</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page"> <a class="text-white" href="#">Revisión de solicitud</a></li>

    <?php
    echo $twig->render('prebodyltFin.twig');
    ?>
    <div class="contenedorDigitaliza">

        <div class="timeline">

            <?php
            $query = "
            
            select codigo_solicitud, to_char(c.fecha_envio, 'DD/MM/YYYY') AS fecha_envio ,  
            d.cedula_identidad, upper(concat(nombres, ' ', primer_apellido, ' ', segundo_apellido)) nombres,  d.contacto, d.correo, d.usuario,
            nro_actuado, x.idactuado
            from exc_actuado x
            left join exc_cabecera c on c.idcabecera = x.idcabecera
            left join datm_usuario d on d.id = c.uregistro_
            where nro_actuado in (
            select max(b.nro_actuado) nro_actuado
            from exc_actuado b
            where b.idcabecera =  " . $_GET['j'] . "   )
            and  x.idcabecera = " . $_GET['j'];

            $stmt = $cons->query($query);
            $actuados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $html .= '   

            <input type="hidden" id="idactuado" value="' . $_GET['x'] . '">
            <div class="solicitud-container">
                <div class="solicitud-grid">
                    <div class="solicitud-column">
                        <h2 class="solicitud-titulo">Solicitud: ' . $actuados[0]['codigo_solicitud'] . '</h2>
                        <div class="info-item">
                            <p class="info-label">Fecha envío: <span class="info-value">' . $actuados[0]['fecha_envio'] . '</span></p>
                        </div>
                        
                        <div class="info-item">
                            <p class="info-label">Solicitante: <span class="info-value">' . $actuados[0]['nombres'] . '</span></p>
                        </div>
                    </div>
                    
                    <!-- Segunda columna -->
                    <div class="solicitud-column">
                        <div class="info-item">
                            <p class="info-label">Documento: <span class="info-value">' . $actuados[0]['cedula_identidad'] . '</span></p>
                        </div>
                        
                        <div class="info-item">
                            <p class="info-label">Contacto: <span class="info-value">' . $actuados[0]['correo'] . '</span></p>
                        </div>
                        
                        <div class="info-item">
                            <p class="info-label">Contacto: <span className="font-normal">' . $actuados[0]['contacto'] . ' <a href="https://api.whatsapp.com/send?phone=591' . $actuados[0]['contacto'] . '"  target="_blank" ><i class="fa fa-whatsapp fs-4" style="color: green;"></i></a></span></p>
                        </div>
                    </div>
                </div>
            </div> 

            ';

            $query = " 
                select c.detalle, a.observacion , a.iditem_act, 
                e.documento_path, f.detalle_estado as detalle_estado_ant, uant.usuario as usuarioant,
                a.documento_path as documento_path_rev, d.detalle_estado, uact.usuario as usuarioact
                
                from exc_item_actuado a 
                left join datm_usuario uact on uAct.id = a.idusuario 
                left join exc_requisito c on a.idrequisito = c.idrequisito
                left join exc_actuado b on b.idactuado = a.idactuado
                
                left join exc_estado d on d.idestado = a.idestado
                left join exc_item_actuado e on e.iditem_act = a.iditem_actuado_ant
                left join datm_usuario uant on uAnt.id = e.idusuario 
                left join exc_estado f on f.idestado = e.idestado
                where a.idactuado = " . $_GET['x'] . " 
                and a.estado_ is true   order by c.orden, iditem_act ";

            $stmt = $cons->query($query);
            $requisitos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $requisitoAnt_ = '';

            $htmlAux = '';

            foreach ($requisitos as $key => $item) {
                if ($requisitoAnt_ != $item['detalle']) {
                    $requisitoAnt_ = $item['detalle'];
                    $htmlAux .= "<br><span style='font-size:1.2rem; color:#1b7716; font-weight: 500;'>" . $item['detalle'] . "</span>";
                }
                $htmlAux .= "<br> - " . $item['documento_path'] . '[' . $item['detalle_estado_ant'] . ']' .  '  <a class="btn verDoc" onclick="verDocPopup(\'../static/exencion/' .
                    $item['usuarioant'] . '/' . $item['documento_path'] . '\')">
                            <i class="fa fa-eye" aria-hidden="true" style="color:#3d7915; font-size:1.2rem;"></i></a>';

                if ($item['detalle_estado'] == 'RECIBIDO' or $item['detalle_estado'] == 'RECIBIDO EN FISICO' ) {
                    $htmlAux .= ' | <a class="btn verDoc" onclick="revisarActuado(' . $item['iditem_act'] . ',\'' . $actuados[0]['codigo_solicitud'] . '\')">
                            <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:#3d7915; font-size:1.2rem;"></i></a>';
                }

                $htmlAux .= (($item['documento_path_rev'] != '') ? "<br>&ensp;~ " . $item['documento_path_rev'] . '[' . $item['detalle_estado'] . ']' .
                    '  <a class="btn verDoc" onclick="verDocPopup(\'../static/exencion/' .
                    $item['usuarioact'] . '/' . $item['documento_path_rev'] . '\', \'' . $item['observacion'] . '\')">
                                <i class="fa fa-eye" aria-hidden="true" style="color:#3d7915; font-size:1.2rem;"></i></a>' : '<br>[' . $item['detalle_estado'] . ']');

                $htmlAux .=    (($item['observacion'] != '') ? "<br>&ensp;~ <span style='font-size:0.8rem;padding:0 1rem 0 1rem;'><i>" . $item['observacion'] . "</i></span>" : '');
            }
            if ($htmlAux != '') {
                $html .= '<hr>
                <div class="solicitud-container">
                ' . $htmlAux . '
                </div> ';
            }
            echo $html;
            ?>

            <hr>
            <div class="solicitud-container">
                <input type="hidden" id="idcabecera" value="<?php echo  $_GET['j']; ?>" />
                <input type="hidden" id="codigo" value="<?php echo  $_GET['i']; ?>" />
                Observaciones generales:<br>
                <textarea class="form-control" id="obs_gral" rows="5"></textarea>
            </div>
            <div class="btn-flotante" style="text-align: center; padding:1rem;">
                <button id="btn-guardar" class="btn btn-success" onclick="guardarRevision(<?php echo $_GET['w']; ?>)">
                    GUARDAR Y CONCLUIR
                </button>
            </div>
        </div>
    </div> 
    <?php
    echo $twig->render('linkJs.twig');
    ?> 
</body>
<script src="../js/mainRecursoIa.js"></script>
<script src="../vendor/bootstrap-table-master/dist/bootstrap-table.min.js"></script>
<script src="../vendor/bootstrap-table-master/dist/extensions/export/bootstrap-table-export.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF/jspdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    function revisarActuado(idactuado, codigo) {
        window.location.href = './exencionRevisionActuado.php?j=' + idactuado + '&i=' + codigo;
    }

    function guardarRevision(obsEnRecepcionFisica = "0") { 

        datos =
            "&obs_gral=" + ($("#obs_gral").val()).trim()+
            "&idactuado=" + ($("#idactuado").val()).trim()+
            "&idcabecera=" + ($("#idcabecera").val()).trim()
            "&obsEnRecepcionFisica=" +obsEnRecepcionFisica;
            console.log(datos);
        $.ajax({
            async: true,
            type: "POST",
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            url: '../php/exencionSaveRevisionActuado.php',
            data: datos,
            beforeSend: function() {
                loadGralOn();
            },
            success: function(dat) {  
                loadGralOff(); 
                console.log(dat);
                dat = $.parseJSON(dat);
                if (dat.err == '0') {
                    console.log("cargando en localStorage:" + dat.log);
                    localStorage.setItem('toastrMessage', dat.log);
                    localStorage.setItem('toastrTitle', "Registro guardado correctamente");
                    url_ = "exencionList.php"; 
                    window.location.href = url_;

                } else {
                    toastr["error"]("Ocurrio un error.", dat.log);
                }
            },
            timeout: 16000,
            error: function(xhr, status, error) {
                toastr["error"]("Ocurrio algun error.", 'Error: ' + error);
            }
        });
    }
</script>

</html>