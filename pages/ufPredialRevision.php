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
    <title>REVISIÓN DE REGISTROS</title>
    <?php
    echo $twig->render('linkStyle.twig');
    ?>
    <link href="../css/styleRecursoIa.css" rel="stylesheet">
    <link href="../vendor/bootstrap-table-master/dist/bootstrap-table.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .containerDetalleSolicitud { width: 98%; margin: auto; border-radius: 10px; padding: 1rem; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .img-revision {
            max-height: 23vh;
            width: auto;
            max-width: 100%;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }
        .img-separator {
            margin: 10px 0;
            border: 0;
            border-top: 2px dashed #ddd;
        }
    </style>
</head>

<body>
    <?php
    echo $twig->render('load.twig');
    echo $twig->render('menuIni.twig');

    if ($_SESSION['swlogin'] == '1') {
        echo $twig->render('menuLogin.twig', array('datSesion' => $_SESSION));
    } else {
        echo $twig->render('menuVisita.twig');
    }

    echo $twig->render('menuFin.twig');
    echo $twig->render('prebodyltIni.twig');
    ?>
    <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
    <li class="breadcrumb-item"><a class="text-white" href="ufPredialList.php">UF - PANEL</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page"> <a class="text-white">REVISIÓN MIS REGISTROS</a></li>
    <?php
    echo $twig->render('prebodyltFin.twig');
    ?>

    <div class="contenedorDigitaliza" style="padding: 1rem;">
        <div class="form-group d-flex flex-column flex-md-row">
            <div class="row">
                <div class="col-md-2 mb-3">
                     <a class="btn btn-primary" href="ufPredialList.php" role="button" title="Volver al panel principal"><i class="fa fa-arrow-left"></i> Volver</a>
                </div>
            </div>
        </div>
        <hr>
        <div>
            <table id="tableRevision"
                data-toggle="table"
                data-unique-id="id"
                data-search="true"
                data-show-toggle="true"
                data-show-fullscreen="true"
                data-show-columns="true"
                data-show-export="false"
                data-pagination="true"
                data-page-list="[10, 25, 50]"
                data-locale="es-ES"
                class="table table-striped table-bordered"
                data-sort-name="id"
                data-sort-order="desc"
                data-show-refresh="true"
                data-url="../php/ufGetPredialRevision.php">
                <thead class="thead-dark">
                    <th data-field="id" data-sortable="true" data-width="5" data-width-unit="%">Id</th>
                    <th data-field="fecha_apersonamiento" data-sortable="true" data-width="10" data-width-unit="%">Fecha Operativo</th>
                    <th data-field="operativo" data-sortable="true" data-width="15" data-width-unit="%">Operativo</th>
                    <th data-field="numero_inmueble" data-sortable="true" data-width="10" data-width-unit="%">No Inmueble</th>
                    <th data-field="codigo_catastral" data-sortable="true" data-width="15" data-width-unit="%">Cod. Catastral</th>
                    <th data-field="no_formulario" data-sortable="true" data-width="10" data-width-unit="%">Formulario</th>
                    <th data-field="imagenes_html" data-width="35" data-width-unit="%">Imágenes (Principal / Adicional)</th>
                </thead>
                <tbody id="tbodyItems">
                </tbody>
            </table>
        </div>
    </div>

    <?php
    echo $twig->render('linkJs.twig');
    ?>
    <script src="../vendor/bootstrap-table-master/dist/bootstrap-table.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
