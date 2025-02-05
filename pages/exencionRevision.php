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
    <title>EXC. REVISION</title>
    <?php
    echo $twig->render('linkStyle.twig');
    ?>
    <link href="../css/styleRecursoIa.css" rel="stylesheet">
    <style>
        #obs-panel {
            padding: 0 2rem 0 2rem;
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
    <li class="breadcrumb-item"><a class="text-white">EXENCION</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page"> <a class="text-white">REVISION</a></li>
    <?php
    echo $twig->render('prebodyltFin.twig');
    ?>
    <!-- Hero End -->

    <!-- About Start -->
    <div class="contenedorDigitaliza">
        <div class="row position-relative">
            <div class="col-8" id="main-content">
                <div class="show-btn" onclick="toggleObsPanel()"><span  id="contenBtn"><img class="img-fluid" src="../img/ia.gif" style="height: 2rem;" alt=""></span></div>
                <div class="main-content-container">
                    <h1 id="tituloh1" class="">Revision de solicitud GAMEA001_2025</h1>
                    <div class="form-group">
                        <iframe src="pdfjs/web/viewer.html?file=../../../static/pdf/gmof.pdf"
                            width="100%"
                            height="780px"
                            style="border: none;"></iframe>
                    </div>
                </div>
            </div>
            <div class="col-4 hidden" id="obs-panel">
                <div class="d-flex justify-content-end">
                    <span class="toggle-btn"></span>
                </div>
                <div class="chat-container border p-3 mt-3">
                    <textarea type="text" id="recurso_" class="form-control" rows="25"></textarea>
                </div>
                <div class="position-relative w-100 mt-3 mb-2">
                    <input type="file" id="documento_" class="form-control" placeholder="Cargar documento" />
                </div>
                <div class="position-relative w-100 mt-3 mb-2">
                    <button type="button" class="btn btn-success position-absolute top-0 end-0 mt-1 me-2  ">GUARDAR Y SALIR</button>
                </div>
            </div>
        </div>
    </div>

    <!-- About End -->

    <!-- JavaScript Libraries -->
    <?php
    echo $twig->render('linkJs.twig');
    ?>
    <!-- Template Javascript -->
</body>
<script defer src="../js/mainRecursoIa.js"></script>
<script>
    function toggleObsPanel() {
        const $tituloh1 = $('#tituloh1');
        const $infoPanel = $('#obs-panel');
        const $mainContent = $('#main-content');
        const $showBtn = $('#show-btn');

        if ($infoPanel.hasClass('hidden')) {
            $('#contenBtn').html(' >> ');
            $tituloh1.addClass('hidden');
            $infoPanel.removeClass('hidden');
            $mainContent.removeClass('col-12').addClass('col-8');

        } else {
            $('#contenBtn').html(' <img class="img-fluid" src="../img/ia.gif" style="height: 2rem;" alt=""> ');
            $tituloh1.removeClass('hidden');
            $infoPanel.addClass('hidden');
            $mainContent.removeClass('col-8').addClass('col-12');
            $showBtn.addClass('hidden');

            const $chatBox = $('#chat-box');
            let tituloPrincipal = $('#tituloPrincipal').html();
            const botMessage = $('<div>').addClass('chat-message').text(`Hola!, soy DATM inteligente, estoy lista para responder a tus consultas sobre: "${tituloPrincipal}"`);
            $chatBox.append(botMessage);
        }
    }
</script>

</html>