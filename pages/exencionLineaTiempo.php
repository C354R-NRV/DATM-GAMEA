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
    <title>DETALLE</title>
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

        header {
            text-align: center;
        }

        h1 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        h2 {
            display: inline-block;
            background-color: rgb(8, 105, 114);
            color: #f4f4f4;
            padding: 0.5rem 1rem;
            font-size: 1.2rem;
        }

        .timeline {
            position: relative;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 100%;
            background-color: #0498a5;
        }

        .crisis-item {
            width: 100%;
            /* margin-bottom: 2rem; */
            position: relative;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
        }

        .crisis-item.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .crisis-content {
            width: calc(50% - 30px);
            padding: 0.8rem 1.5rem 0.5rem 1.5rem;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
            position: relative;
            cursor: pointer;
        }

        .crisis-item:nth-child(odd) .crisis-content {
            margin-left: auto;
        }

        .crisis-item:nth-child(odd) .crisis-content::before {
            content: '';
            position: absolute;
            left: -30px;
            top: 20px;
            border: 15px solid transparent;
            border-right-color: white;
        }

        .crisis-item:nth-child(even) .crisis-content::before {
            content: '';
            position: absolute;
            right: -30px;
            top: 20px;
            border: 15px solid transparent;
            border-left-color: white;
        }

        .crisis-content h3 {
            color: rgb(14 76 107);
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
        }

        .location {
            color: #666;
            font-style: italic;
            margin-bottom: 0.5rem;
        }

        .description {
            color: #444;
        }

        @media (max-width: 768px) {
            .timeline::before {
                left: 30px;
            }

            .crisis-content {
                width: calc(100% - 60px);
                margin-left: 60px !important;
            }

            .crisis-item:nth-child(odd) .crisis-content::before,
            .crisis-item:nth-child(even) .crisis-content::before {
                left: -30px;
                border-right-color: white;
                border-left-color: transparent;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 2rem;
            }

            .contenedorDigitaliza {
                padding: 1rem;
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
    <!-- Navbar End -->

    <!-- Hero Start -->
    <?php
    echo $twig->render('prebodyltIni.twig');
    ?>
    <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
    <li class="breadcrumb-item"><a class="text-white">UAJ</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page"> <a class="text-white" href="exencionList.php">EXENCION</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page"> <a class="text-white" href="#">Linea de tiempo</a></li>

    <?php
    echo $twig->render('prebodyltFin.twig');
    ?>
    <!-- Hero End -->

    <!-- About Start -->
    <div class="contenedorDigitaliza">
        <?php


        $query = "select  a.nro_actuado,  to_char(a.fecha_registro, 'YYYY-MM-DD') AS fecha_registro, 
                c.usuario, e.detalle_estado estado_cabecera,  e2.detalle_estado  estado_actuado, a.idactuado, observacion, registro_tributario, 
                d.fecha_culminacion, d.resolucion_path,  COALESCE(d.tipo_solicitud,'') tipo_solicitud, f.rubro 
                from exc_actuado a 
                left join exc_cabecera d on d.idcabecera = a.idcabecera 
                left join exc_estado e on e.idestado =  d.idestado 
                left join exc_estado e2 on e2.idestado =  a.idestado 
                left join datm_usuario c on a.idusuario = c.id 
                left join exc_rubro f on f.idrubro = d.idrubro 
                where a.idcabecera =   " . $_GET['j'] . " and a.estado_ is true order by a.nro_actuado";

        $stmt = $cons->query($query);
        $actuados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ?>
        <header>
            <h2>SOLICITUD: <?php echo $_GET['i'] ?> - <?php echo $actuados[0]['tipo_solicitud'] . " " . $actuados[0]['rubro']; ?></h2>
        </header>

        <div class="timeline">

            <?php
            $nro_actuado_ant = 0;
            foreach ($actuados as $key => $value) {
                $html .= '<div class="crisis-item visible" >
                    <div class="crisis-content">
                        <h3>Fecha de actuado: <b>' . $value['fecha_registro'] . '</b></h3>                        
                        <h3>Estado: <b>' . $value['estado_actuado'] . '</b></h3>
                        <div class="location">';
                $html .= ($value['observacion'] != '' ? 'Observación:<b>' . $value['observacion'] . '</b><br>' : '');

                $html .= '
                Documento tributario: <b>' . $value['registro_tributario'] . '</b>
                <br>Nro de actuado: <b>' . $value['nro_actuado'] . '</b>
                <br>Usuario: <b>' . $value['usuario'] . '</b>';

                if ($value['resolucion_path'] != '' and $value['estado_actuado'] == 'COMPLETADO Y ATENDIDO') {
                    $cadena = $value['resolucion_path'];
                    $partes = explode("/", $cadena);
                    $resultado = end($partes);
                    $html .= '
                    <br>Fecha culminación: <b>' . $value['fecha_culminacion'] . '</b>
                    <br>Resolución: <b>' . $resultado . '</b><a class="btn verDoc" onclick="verDocPopup(\'../static/exencion/' . $value['resolucion_path'] . '\')">
                        <i class="fa fa-eye" aria-hidden="true" style="color:#3d7915; font-size:1.2rem;"></i></a>';
                }
                $html .= '</div>
                        <p class="description" style="display: none;">';

                $query = "
                    select a.idestado, d.detalle_estado , c.detalle, a.documento_path, a.observacion , a.iditem_act
                    from exc_item_actuado  a  
                    left join exc_requisito c on a.idrequisito = c.idrequisito
                    left join exc_estado d on a.idestado = d.idestado
                    where a.idactuado = " . $value['idactuado'] . " 
                    and a.estado_ is true   order by c.orden, a.iditem_act   ";
                $stmt = $cons->query($query);
                $requisitos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $requisitoAnt_ = '';

                foreach ($requisitos as $key => $item) {
                    if ($requisitoAnt_ != $item['detalle']) {
                        $requisitoAnt_ = $item['detalle'];
                        $html .= "<span style='font-size:1.2rem; color:#1b7716; font-weight: 500;'>" . $item['detalle'] . "</span><br>";
                    }

                    if ($item['idestado'] == '6')
                        $html .= " - [" . $item['detalle_estado'] . "]<br>";
                    $html .=
                        (
                            $item['documento_path'] != '' ?
                            " - " . $item['documento_path'] . ' <a class="btn verDoc" onclick="verDocPopup(\'../static/exencion/' . $value['usuario'] . '/' . $item['documento_path'] . '\',\'' . $item['observacion'] . '\'  )">
                                <i class="fa fa-eye" aria-hidden="true" style="color:#3d7915; font-size:1.2rem;"></i></a>' . " <br>"
                            : ""
                        );

                    $html .= ($item['observacion'] != '' ? '<span style="font-size:0.8rem;padding:0 1rem 0 1rem; color:#971806"><i>' . $item['observacion'] . '</i></span><br>' : '');
                }
                $html .= ' 
                        </p>
                    </div>
                </div>';
            }

            echo $html;
            ?>

        </div>
    </div>

    <!-- About End -->
    <!-- JavaScript Libraries -->
    <?php
    echo $twig->render('linkJs.twig');
    ?>
    <!-- Template Javascript -->
</body>
<script src="../js/mainRecursoIa.js"></script>
<script src="../vendor/bootstrap-table-master/dist/bootstrap-table.min.js"></script>
<script src="../vendor/bootstrap-table-master/dist/extensions/export/bootstrap-table-export.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF/jspdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    var verDocPopupSw = false;
    $(document).ready(function() {
        // Function to check if element is in viewporte
        function isElementInViewport(el) {
            const rect = el.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        }

        // Function to handle scroll animation
        function handleScroll() {
            $('.crisis-item').each(function() {

                if (isElementInViewport(this)) {
                    $(this).addClass('visible');
                }

            });
        }

        // Initial check for visible elements
        handleScroll();

        // Add scroll event listener
        $(window).on('scroll resize', handleScroll);

        // Add click handler for crisis items
        $('.crisis-item').click(function() {
            $(this).find('.description').slideToggle(300);
        });

        // Sort crisis items by year
        const timeline = $('.timeline');
        const items = timeline.children('.crisis-item').get();
        items.sort(function(a, b) {
            const yearA = parseInt($(a).data('year'));
            const yearB = parseInt($(b).data('year'));
            return yearA - yearB;
        });
        $.each(items, function(index, item) {
            timeline.append(item);
        });
    });
</script>

</html>