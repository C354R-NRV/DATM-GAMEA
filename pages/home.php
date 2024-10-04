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
    <title>Home</title>
    <?php
    echo $twig->render('linkStyle.twig');
    ?>
    <link href="../css/styleCardIa.css" rel="stylesheet">
</head>

<body>
    <?php
    echo "<input type='hidden' value='" . $_SESSION['nombreUsuario'] . "' id='nombreUsuario'>";

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
    <li class="breadcrumb-item"><a class="text-white" href="index.php">Inicio</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page">Acceso IA</li>
    <?php
    echo $twig->render('prebodyltFin.twig');
    ?>
    <!-- Hero End -->


    <!-- About Start -->
    <div class="container-fluid" style="background-color: #19232b;">
        <div class="container">
            <div class="containerFlex">
                <!-- <div class="rowFlex">
                    <div class="columnFlex">
                        <h2>Biblioteca</h2>
                    </div>
                </div> -->
                <div class="rowFlex">
                    <div class="columnFlex">

                        <div class="box-containerIa">
                            <div class="box-itemIa">
                                <div class="flip-boxIa">
                                    <div class="flip-boxIa-front text-centerCarIa cardIa1">
                                        <div class="inner color-whiteIa">
                                            <!-- <h3 class="flip-boxIa-header color-white">Custom Domains</h3> -->
                                            <!-- <p>A short sentence describing this callout is.</p> -->
                                            <img src="https://s25.postimg.cc/65hsttv9b/cta-arrow.png" alt="" class="flip-boxIa-img">
                                        </div>
                                    </div>
                                    <div class="flip-boxIa-back text-centerCarIa cardIa1">
                                        <div class="inner color-whiteIa">
                                            <!-- <h3 class="flip-boxIa-header color-white">Custom Domains</h3> -->
                                            <!-- <p>A short sentence describing this callout is.</p> -->
                                            <button class="flip-boxIa-button" onclick="redirecciona(this.id)" id="copilot_">Acceder</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if ($_SESSION['rol'] == 'JEFATURA' or $_SESSION['rol'] == 'DIRECCION' ) {
                            ?>
                                <div class="box-itemIa">
                                    <div class="flip-boxIa">
                                        <div class="flip-boxIa-front text-centerCarIa filter- cardIa2">
                                            <div class="inner color-whiteIa">
                                                <!-- <h3 class="flip-boxIa-header color-white">Dedicated</h3>
                                            <p>A short sentence describing this callout is.</p> -->
                                                <img src="https://s25.postimg.cc/65hsttv9b/cta-arrow.png" alt="" class="flip-boxIa-img">
                                            </div>
                                        </div>
                                        <div class="flip-boxIa-back text-centerCarIa cardIa2">
                                            <div class="inner color-whiteIa">
                                                <!-- <h3 class="flip-boxIa-header color-white">Dedicated</h3>
                                            <p>A short sentence describing this callout is.</p> -->
                                                <button class="flip-boxIa-button" onclick="redirecciona(this.id)" id="chatgpt_">Acceder</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->



    <!-- Footer Start -->
    <?php
    echo $twig->render('footer.twig');
    ?>
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <?php
    echo $twig->render('linkJs.twig');
    ?>
    <!-- Template Javascript -->
    <script>
        $(document).ready(function($) {

            const ahora = new Date();
            const hora = ahora.getHours();
            var saludo = '';
            var nombre = $("#nombreUsuario").val();
            if (hora >= 0 && hora < 12) {
                saludo = "Buenos días";
            } else if (hora >= 12 && hora < 18) {
                saludo = "Buenas tardes";
            } else {
                saludo = "Buenas noches";
            }
            console.log("nombre:" + nombre + ", saludo:" + saludo);
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "progressBar": true,
                "rtl": true,

                "preventDuplicates": true,
                "onclick": null,
                "showDuration": 300,
                "hideDuration": 1000,
                "timeOut": 3000,
                "extendedTimeOut": 1000,
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr["success"](nombre, saludo);

        });

        function redirecciona(codigo) {
            if (codigo == 'copilot_') {
                window.location.href = "biblioteca.php";
            }
            if (codigo == 'chatgpt_') {
                window.open("https://aistudio.google.com/app/prompts/new_chat?pli=1", "_blank");
            }
        }
    </script>
</body>

</html>