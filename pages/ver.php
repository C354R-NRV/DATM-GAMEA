<!DOCTYPE html>
<html lang="es">
<?php
session_start();
require_once '../vendor/autoload.php';

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('../views');
$twig = new Environment($loader);
?>

<head>
    <meta charset="utf-8">
    <title>Verificación</title>
    <?php
    echo $twig->render('linkStyle.twig');
    ?>
    <style>
        #hash {
            word-wrap: break-word;
            /* Permite que el texto se ajuste al contenedor y haga saltos de línea si es necesario */
            overflow-wrap: break-word;
            /* Propiedad similar a 'word-wrap' para navegadores más antiguos */
        }
    </style>
</head>

<?php
$hash = $_GET['id'];
$swVerificado = false;
if ($hash == 'e2c39295b134a9c6efb1d8851c36d940') {
    $swVerificado = true;
}
?>

<body>
    <!-- Spinner Start -->
    <?php
    echo $twig->render('load.twig');
    ?>
    <!-- Spinner End -->

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
    <li class="breadcrumb-item"><a class="text-white" href="home.php">Index</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page">Verificación</li>
    <?php
    echo $twig->render('prebodyltFin.twig');
    ?>
    <!-- Hero End -->


    <!-- Full Screen Search Start -->
    <!-- <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(20, 24, 62, 0.7);">
                <div class="modal-header border-0">
                    <button type="button" class="btn btn-square bg-white btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <input type="text" class="form-control bg-transparent border-light p-3"
                            placeholder="Type search keyword">
                        <button class="btn btn-light px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Full Screen Search End -->


    <?php
    if ($swVerificado) {
    ?>
        <!-- body Start -->
        <div class="container-fluid py-2">
            <div class="container py-2">
                <div class="containerFlex">
                    <div class="rowFlex">
                        <div class="columnFlex">
                            <h2>RESUMEN DE COMPROBANTE DE PAGO 002258</h2>
                        </div>
                    </div>
                    <hr>
                    <div class="rowFlex">
                        <div class="columnFlex">
                            <label for="nombre">Nombre completo o razón social:</label>
                            <span id="nombre">JUAN PEREZ</span>
                        </div>
                        <div class="columnFlex">
                            <label for="ci">CI/NIT:</label>
                            <span id="ci">12345678010</span>
                        </div>
                    </div>
                    <div class="rowFlex">
                        <div class="columnFlex">
                            <label for="direccion">Dirección:</label>
                            <span id="direccion">AV. CORRECTA, ZONA CORRECTA, No. 123</span>
                        </div>
                        <div class="columnFlex">
                            <label for="actividad">Actividad:</label>
                            <span id="actividad">NRO TRAM 51212</span>
                        </div>
                    </div>
                    <div class="rowFlex">
                        <div class="columnFlex">
                            <label for="direccion">Importe total:</label>
                            <span id="direccion">Bs. 10.022,00</span>
                        </div>
                        <div class="columnFlex">
                            <label for="fecha">Fecha y hora del proceso:</label>
                            <span id="fecha">26/04/2024 11:30:25</span>
                        </div>
                    </div>
                    <div class="rowFlex">
                        <div class="columnFlex">
                            <label for="direccion">Verificador:</label>
                            <span id="direccion">Lic. Rogelio Quispe</span>
                        </div>
                        <div class="columnFlex">
                            <label for="actividad">Cajero:</label>
                            <span id="actividad">Lic. Mario Quispe</span>
                        </div>
                    </div>
                    <div class="rowFlex">
                        <div class="columnFlex">
                            <label for="hash">HASH: </label>
                            <span id="hash">
                                <?php $hash_sha256 = hash('md5', "002258|12345678010|2210022.00|26/04/2024 11:30:25");
                                echo $hash_sha256; // Calcula el hash SHA-256 
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="rowFlex">
                        <div class="columnFlex" style="text-align: center;">
                            <h5 style="color:green;width:100%;">INFORMACIÓN VALIDADA EN SERVIDOR</h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- body End -->
        <?php
    } else {
        ?>
            <div class="container-fluid py-2">
                <div class="container py-2">
                    <div class="containerFlex">
                        <div class="rowFlex">
                            <div class="columnFlex">
                                <h2>VERIFICACIÓN DE COMPROBANTE DE PAGO</h2>
                            </div>
                        </div>
                        <hr>
                        <div style="text-align:center;width:100%;">
                            <h5 style="color:RED;">EL CODIGO DE CONTROL ENCRIPTADO NO FUE ENCONTRADO EN EL SERVIDOR<br><br><b>COMPROBANTE NO VÁLIDO</b></h5>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
        ?>

        <!-- Footer Start -->
        <?php
        echo $twig->render('footer.twig');
        ?>
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="index.php#" class="btn btn-lg btn-primary btn-lg-square back-to-top pt-2"><i class="fa fa-sort-asc"></i></a>


        <!-- JavaScript Libraries -->
        <?php
        echo $twig->render('linkJs.twig');
        ?>
</body>

</html>