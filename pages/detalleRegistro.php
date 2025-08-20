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
$rubro="Vehiculo";
$identificador="SGE122";
foreach ($_GET as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
?>
<html lang="es">

<head>
    <title>Detalle</title>
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
    <li class="breadcrumb-item"><a class="text-white" >Digitaliza</a></li>
    <li class="breadcrumb-item"><a class="text-white" href="archPanel.php">Compendio</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page">Detalle</li>
    <?php
    echo $twig->render('prebodyltFin.twig');
    ?>
    <!-- Hero End -->

    <!-- About Start -->

    <div class="contenedorDigitaliza">

        <div class="form-group d-flex flex-column flex-md-row">
            <div class="row">
                <h3 style="color:#4a86a3">Detalle de No. de registro: <?php echo "$nreg, $rubro [$identificador]"; ?></h3>
            </div>
        </div>
        <hr>
        <div>


            <table id="tableCompendio" data-toggle="table" data-search="true" data-show-toggle="true" data-show-fullscreen="true" data-show-columns="true" data-show-columns-toggle-all="true" data-show-export="true" data-click-to-select="true" data-pagination="true" data-page-list="[10, 25, 50, 100, all]" data-locale="es-ES" class="table table-striped" data-sort-name="id" data-sort-order="asc">
                <thead>
                    <th data-sortable="true">Usuario</th>
                    <th>Tot. Fojas</th>
                    <th data-sortable="true">Fecha Ini</th>
                    <th data-sortable="true">Fecha Fin</th>
                    <th>Ubicación</th>
                    <th style="width: 35rem !important;">Comentario</th>
                    <th>Recurso</th>
                </thead>
                <tbody>
                    <tr>
                        <td>IQUISPE.SIAT</td>
                        <td>30</td>
                        <td>10/02/2024</td>
                        <td>10/06/2024</td>
                        <td>G2C3S6</td>
                        <td style="width: 35rem !important;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                        <td style="text-align: center;">
                            <a class="btn btn-primary" href="../static/compendio/10000001_1.pdf" target="_blank" role="button" href=""><i class="fa fa-file-pdf-o"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>ATUSCO.SIAT</td>
                        <td>15</td>
                        <td>10/06/2024</td>
                        <td>10/07/2024</td>
                        <td>Gabeta 2, Cajon 1, Seccion 8</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                        <td style="text-align: center;">
                            <a class="btn btn-primary " href="../static/compendio/10000001_2.pdf" target="_blank"  role="button"><i class="fa fa-file-pdf-o"></i></a>
                        </td>
                    </tr> 
                    <tr>
                        <td>IQUISPE.SIAT</td>
                        <td>30</td>
                        <td>10/02/2024</td>
                        <td>10/06/2024</td>
                        <td>G2C3S6</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                        <td style="text-align: center;">
                            <a class="btn btn-primary"  href="../static/compendio/10000001_1.pdf" target="_blank" role="button"><i class="fa fa-file-pdf-o"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>ATUSCO.SIAT</td>
                        <td>15</td>
                        <td>10/06/2024</td>
                        <td>10/07/2024</td>
                        <td>Gabeta 2, Cajon 1, Seccion 8</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                        <td style="text-align: center;">
                            <a class="btn btn-primary " href="../static/compendio/10000001_2.pdf" target="_blank" role="button"><i class="fa fa-file-pdf-o"></i></a>
                        </td>
                    </tr> 
                    <tr>
                        <td>IQUISPE.SIAT</td>
                        <td>30</td>
                        <td>10/02/2024</td>
                        <td>10/06/2024</td>
                        <td>G2C3S6</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                        <td style="text-align: center;">
                            <a class="btn btn-primary " role="button"><i class="fa fa-file-pdf-o"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>ATUSCO.SIAT</td>
                        <td>15</td>
                        <td>10/06/2024</td>
                        <td>10/07/2024</td>
                        <td>Gabeta 2, Cajon 1, Seccion 8</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                        <td style="text-align: center;">
                            <a class="btn btn-primary " role="button"><i class="fa fa-file-pdf-o"></i></a>
                        </td>
                    </tr> 
                    <tr>
                        <td>IQUISPE.SIAT</td>
                        <td>30</td>
                        <td>10/02/2024</td>
                        <td>10/06/2024</td>
                        <td>G2C3S6</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                        <td style="text-align: center;">
                            <a class="btn btn-primary " role="button"><i class="fa fa-file-pdf-o"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>ATUSCO.SIAT</td>
                        <td>15</td>
                        <td>10/06/2024</td>
                        <td>10/07/2024</td>
                        <td>Gabeta 2, Cajon 1, Seccion 8</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                        <td style="text-align: center;">
                            <a class="btn btn-primary " role="button"><i class="fa fa-file-pdf-o"></i></a>
                        </td>
                    </tr> 
                    <tr>
                        <td>IQUISPE.SIAT</td>
                        <td>30</td>
                        <td>10/02/2024</td>
                        <td>10/06/2024</td>
                        <td>G2C3S6</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                        <td style="text-align: center;">
                            <a class="btn btn-primary " role="button"><i class="fa fa-file-pdf-o"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>ATUSCO.SIAT</td>
                        <td>15</td>
                        <td>10/06/2024</td>
                        <td>10/07/2024</td>
                        <td>Gabeta 2, Cajon 1, Seccion 8</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                        <td style="text-align: center;">
                            <a class="btn btn-primary " role="button"><i class="fa fa-file-pdf-o"></i></a>
                        </td>
                    </tr> 
                    <tr>
                        <td>IQUISPE.SIAT</td>
                        <td>30</td>
                        <td>10/02/2024</td>
                        <td>10/06/2024</td>
                        <td>G2C3S6</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                        <td style="text-align: center;">
                            <a class="btn btn-primary " role="button"><i class="fa fa-file-pdf-o"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>ATUSCO.SIAT</td>
                        <td>15</td>
                        <td>10/06/2024</td>
                        <td>10/07/2024</td>
                        <td>Gabeta 2, Cajon 1, Seccion 8</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                        <td style="text-align: center;">
                            <a class="btn btn-primary " role="button"><i class="fa fa-file-pdf-o"></i></a>
                        </td>
                    </tr> 
                    <tr>
                        <td>IQUISPE.SIAT</td>
                        <td>30</td>
                        <td>10/02/2024</td>
                        <td>10/06/2024</td>
                        <td>G2C3S6</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                        <td style="text-align: center;">
                            <a class="btn btn-primary " role="button"><i class="fa fa-file-pdf-o"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>ATUSCO.SIAT</td>
                        <td>15</td>
                        <td>10/06/2024</td>
                        <td>10/07/2024</td>
                        <td>Gabeta 2, Cajon 1, Seccion 8</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                        <td style="text-align: center;">
                            <a class="btn btn-primary " role="button"><i class="fa fa-file-pdf-o"></i></a>
                        </td>
                    </tr> 
                    <tr>
                        <td>IQUISPE.SIAT</td>
                        <td>30</td>
                        <td>10/02/2024</td>
                        <td>10/06/2024</td>
                        <td>G2C3S6</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                        <td style="text-align: center;">
                            <a class="btn btn-primary " role="button"><i class="fa fa-file-pdf-o"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>ATUSCO.SIAT</td>
                        <td>15</td>
                        <td>10/06/2024</td>
                        <td>10/07/2024</td>
                        <td>Gabeta 2, Cajon 1, Seccion 8</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                        <td style="text-align: center;">
                            <a class="btn btn-primary " role="button"><i class="fa fa-file-pdf-o"></i></a>
                        </td>
                    </tr> 
                    <tr>
                        <td>IQUISPE.SIAT</td>
                        <td>30</td>
                        <td>10/02/2024</td>
                        <td>10/06/2024</td>
                        <td>G2C3S6</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                        <td style="text-align: center;">
                            <a class="btn btn-primary " role="button"><i class="fa fa-file-pdf-o"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>ATUSCO.SIAT</td>
                        <td>15</td>
                        <td>10/06/2024</td>
                        <td>10/07/2024</td>
                        <td>Gabeta 2, Cajon 1, Seccion 8</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                        <td style="text-align: center;">
                            <a class="btn btn-primary " role="button"><i class="fa fa-file-pdf-o"></i></a>
                        </td>
                    </tr> 
                </tbody>
            </table>
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



</script>

</html>