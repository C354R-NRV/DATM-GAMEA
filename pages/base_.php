<!DOCTYPE html>
<?php
session_start();
require_once '../vendor/autoload.php';

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('../views');
$twig = new Environment($loader);
if (!$_SESSION['swlogin']) {
    echo "<script>window.location.href = 'index.php';</script>";
}
?>
<html lang="es">

<head>
    <title>PISLEA FORM</title>
    <?php
    echo $twig->render('linkStyle.twig');
    ?>
    <link href="../css/styleRecursoIa.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>

    </style>
</head>

<body>
    <input type="hidden" id="inm_inicial" value="<?php echo $_GET['i']; ?>" />
    <?php
    echo $twig->render('load.twig');
    ?>
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
    <li class="breadcrumb-item text-white active" aria-current="page"> <a class="text-white" href="ufPredialList.php">UF - PANEL</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page"> <a class="text-white">UF - CHART</a></li>
    <?php
    echo $twig->render('prebodyltFin.twig');
    ?>
    <!-- Hero End -->
    <!-- About Start -->
    <div class="contenedorDigitaliza">
        <div class="form-group d-flex flex-column flex-md-row">
            <div class="row">
                <div class="col-md-2 mb-3">
                    <a class="btn btn-success" href="ufPredial.php" role="button"><i class="fa fa-plus"></i></a> |
                    <a class="btn btn-success" href="ufdatmap.php" role="button"><i class="fa fa-map-o" aria-hidden="true"></i></a><!-- |
                    <a class="btn btn-success" onclick="generarReporteOperativo()" role="button"><i class="fa fa-file-excel-o" aria-hidden="true"></i></a> -->
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control" value="" id="filtroInmueble" placeholder="Numero inmueble">
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control datepicker" value="" id="filtroFechaIni" placeholder="Fecha ini">
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control datepicker" value="" id="filtroFechaFin" placeholder="Fecha fin">
                </div>

                <div class="col-md-1 mb-3">
                    <button class="btn btn-primary" onclick="getUfPredial()">consultar</button>
                </div>
            </div>
        </div>

        <hr>
        <div>

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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    
</script>

</html>