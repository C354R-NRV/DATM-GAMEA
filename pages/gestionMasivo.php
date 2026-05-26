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
    <title>Masivo</title>
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
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    <li class="breadcrumb-item"><a class="text-white">UFyR</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page"> <a class="text-white" href="#">GESTION DE MENSAJES ENVIADOS</a></li>

    <?php
        echo $twig->render('prebodyltFin.twig');
    ?>
    <!-- Hero End -->

    <!-- About Start -->
    <div class="contenedorDigitaliza">
        <div class="form-group d-flex flex-column flex-md-row">
            <div class="row"> 
                <div class="col-md-4 mb-3">
                    <input type="text" class="form-control" value="" id="filtroCodigoSolicitud" placeholder="NOMBRES, CI">
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control datepicker" value="" id="filtroFechaIni" placeholder="Fecha ini">
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control datepicker" value="" id="filtroFechaFin" placeholder="Fecha fin">
                </div>
                <div class="col-md-1 mb-3">
                    <button class="btn btn-primary" onclick="getMensajes()">consultar</button>
                </div>
            </div>
        </div>
        <hr>
        <div>
            <table id="tableCompendio"
                data-toggle="table"
                data-search="true"
                data-show-toggle="true"
                data-show-fullscreen="true"
                data-show-columns="true"
                data-show-columns-toggle-all="true"
                data-show-export="true"
                data-click-to-select="true"
                data-pagination="true"
                data-page-list="[10, 25, 50, 100, 200, all]"
                data-locale="es-ES"
                class="table table-striped"
                data-sort-name="id"
                data-sort-order="desc"
                data-show-refresh="true"
                data-url="../php/msnjGetall.php"
                data-query-params="filtrosDataTable">
                <thead>
                    <th data-field="id" data-sortable="true">No</th>
                    <th data-field="documento_identidad" data-sortable="true">Ci/Nit</th>
                    <th data-field="nombres" data-sortable="true">Nombres</th>
                    <th data-field="contacto" data-sortable="true">Contacto</th>
                    <th data-field="fecha_envio" data-sortable="true">Envio</th>
                    <th data-field="estado" data-sortable="true">Estado</th>

                    <th data-field="acciones">Acciones</th>
                </thead>
                <tbody id="tbodyItems">
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
    $(".datepicker").flatpickr();
    /*  $(document).ready(function($) {
            getUsuarios();
      }); */
    function filtrosDataTable(p) {
        console.log(p);
        console.log("en filtrosDataTable");
        return {
            filtroCodigoSolicitud: $('#filtroCodigoSolicitud').val(),
            filtroFechaIni: $('#filtroFechaIni').val(),
            filtroFechaFin: $('#filtroFechaFin').val(),
            offset: p.offset,
            limit: p.limit,
            sort: p.sort,
            order: p.order,
            search: p.search
        }
    }

    function getMensajes() {
        console.log($('#filtroCodigoSolicitud').val());
        $.ajax({
            async: true,
            type: 'POST',
            data: {
                filtroCodigoSolicitud: $('#filtroCodigoSolicitud').val(),
                filtroFechaIni: $('#filtroFechaIni').val(),
                filtroFechaFin: $('#filtroFechaFin').val()
            },
            url: '../php/msnjGetall.php',
            beforeSend: function() {
                loadGralOn();
            },
            success: function(e) {
                /* console.log(e); */
                loadGralOff();
                $('#tbodyItems').empty();
                dat = $.parseJSON(e);
                // Iterar sobre los datos recibidos y agregarlos al tbody
                /* $.each(dat, function(index, item) {
                    var fila = `
                    <tr>
                        <td>${item.id}</td> 
                        <td>${item.documento_identidad}</td>
                        <td>${item.nombres}</td>
                        <td>${item.contacto}</td> 
                        <td>${item.fecha_envio}</td> 
                        <td>${item.estado}</td> 
                        <td>${item.acciones}</td>
                    </tr>
                `;
                    $('#tbodyItems').append(fila);
                });
                $('#tableCompendio').bootstrapTable('refresh'); */
                $("#tableCompendio").bootstrapTable("load", dat)
            },
            timeout: 16000,
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    }

    function verDetallesAtencion(idmnsj) {

        $.ajax({
            async: true,
            type: "POST",
            dataType: "html",
            url: "../php/mnsjMasivoDetalleAtencion.php",
            data: {
                idmnsj: idmnsj
            },
            beforeSend: function() {
                loadGralOn();
            },
            success: function(e) {
                console.log(e)
                loadGralOff();
                data = JSON.parse(e);

                $.confirm({
                    title: " <b>Detalles de atención</b>",
                    typeAnimated: true,
                    columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
                    content: data.html,
                    type: "green",
                    buttons: {
                        cerrar: {
                            text: "Cerrar",
                            action: function() {}
                        }
                    }
                });

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
                loadGralOff();
            },
            timeout: 16000
        });

    }

    function marcarAtendido(idmnsj) {

        $.ajax({
            async: true,
            type: "POST",
            dataType: "html",
            url: "../php/setEstadoMnsjMasivo.php",
            data: {
                idmnsj_masivo: idmnsj
            },
            beforeSend: function() {
                loadGralOn();
            },
            success: function(e) {
                console.log(e);
                loadGralOff();
                window.location.href = 'gestionMasivo.php';
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
                loadGralOff();
                $.confirm({
                    title: "Error",
                    content: "Hubo un problema al conectar con el servidor. Por favor, intenta de nuevo más tarde.",
                    type: "red",
                    buttons: {
                        ok: {
                            text: "Aceptar",
                            action: function() {}
                        }
                    }
                });
            },
            timeout: 26000
        });
    }
</script>

</html>