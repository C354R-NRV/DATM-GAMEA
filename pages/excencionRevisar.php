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
            <title>REVISION</title>
            <?php
            echo $twig->render('linkStyle.twig');
            ?>
            <link href="../css/styleRecursoIa.css" rel="stylesheet">
            <link href="../vendor/bootstrap-table-master/dist/bootstrap-table.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    </head>

<body>
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
    <li class="breadcrumb-item"><a class="text-white">UAJ</a></li>
    <li class="breadcrumb-item"><a class="text-white">EXENCION</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page"> <a class="text-white">REVISION</a></li>
    <?php
    echo $twig->render('prebodyltFin.twig');
    ?> 
    <div class="contenedorDigitaliza">
        <h1>Revision de solicitud GAMEA001_2025</h1>
        <div class="form-group">
            <div class="row">
                <div class="col-md-8 mb-8">
                    <iframe src="pdfjs/web/viewer.html?file=../../../static/pdf/gmof.pdf"
                        width="100%"
                        height="700px"
                        style="border: none;"></iframe>
                </div>
                <div class="col-md-4 mb-4">
                    <label>Observaciones</label>
                    <input type="text" class="form-control">
                </div>
            </div>
        </div>
    </div> 
    <?php
    echo $twig->render('linkJs.twig');
    ?>
</body>
<script src="../js/mainRecursoIa.js"></script>
<script>

</script>

</html>