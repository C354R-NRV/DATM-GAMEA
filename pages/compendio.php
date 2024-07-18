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
    <title>Compendio</title>
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
    <li class="breadcrumb-item"><a class="text-white">Digitaliza</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page">Compendio</li>
    <?php
    echo $twig->render('prebodyltFin.twig');
    ?>
    <!-- Hero End -->

    <!-- About Start -->

    <div class="contenedorDigitaliza">

        <div class="form-group d-flex flex-column flex-md-row">
            <div class="row">
                <div class="col-md-1 mb-3">
                    <a class="btn btn-success" onclick="formActuado()" role="button"><i class="fa fa-plus"></i></a>
                </div>
                <div class="col-md-4 mb-3">
                    <input type="text" class="form-control" value="" placeholder="Patente, Placa, Num. Inmueble">
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control datepicker" value="" placeholder="Fecha ini">
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control datepicker" value="" placeholder="Fecha fin">
                </div>
                <div class="col-md-1 mb-3">
                    <button class="btn btn-primary">consultar</button>
                </div>
            </div>
        </div>
        <hr>
        <div>


            <table id="tableCompendio" data-toggle="table" data-search="true" data-show-toggle="true" data-show-fullscreen="true" data-show-columns="true" data-show-columns-toggle-all="true" data-show-export="true" data-click-to-select="true" data-pagination="true" data-page-list="[10, 25, 50, 100, all]" data-locale="es-ES" class="table table-striped" data-sort-name="id" data-sort-order="asc">
                <thead>
                    <th>No Registro</th>
                    <th>Usuario</th>
                    <th>Tot. Fojas</th>
                    <th data-sortable="true">Rubro</th>
                    <th>Identificador</th>
                    <th data-sortable="true">Fecha Ini</th>
                    <th data-sortable="true">Fecha Fin</th>
                    <th style="text-align: center;">Acciones</th>
                </thead>
                <tbody>
                    <tr>
                        <td>10000001</td>
                        <td>IQUISPE.SIAT</td>
                        <td>30</td>
                        <td>Vehiculos</td>
                        <td>SGE122</td>
                        <td>10/02/2024</td>
                        <td>10/06/2024</td>
                        <td style="text-align: center;">
                            <a class="btn btn-primary " href="detalleRegistro.php?nreg=10000001" role="button"><i class="fa fa-search"></i></a> |
                            <a class="btn btn-success " onclick="cargaUbicacion(321)" role="button"><i class="fa fa-map-marker"></i></a> |
                            <a class="btn btn-warning " onclick="formActuado(321)" role="button"><i class="fa fa-edit"></i></a> |
                            <a class="btn btn-danger " onclick="borrarCompendio()" role="button"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>10000001</td>
                        <td>ATUSCO.SIAT</td>
                        <td>22</td>
                        <td>Vehiculos</td>
                        <td>SGE122</td>
                        <td>10/06/2024</td>
                        <td>10/07/2024</td>
                        <td style="text-align: center;">
                            <a class="btn btn-primary " href="detalleRegistro.php?nreg=10000001" role="button"><i class="fa fa-search"></i></a> |
                            <a class="btn btn-success " onclick="cargaUbicacion(321)" role="button"><i class="fa fa-map-marker"></i></a> |
                            <a class="btn btn-warning " onclick="formActuado(321)" role="button"><i class="fa fa-edit"></i></a> |
                            <a class="btn btn-danger " onclick="borrarCompendio()" role="button"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>10000002</td>
                        <td>MSALAZAR.SIAT</td>
                        <td>2</td>
                        <td>Inmuebles</td>
                        <td>15005255252</td>
                        <td>01/03/2024</td>
                        <td>07/04/2024</td>
                        <td style="text-align: center;">
                            <a class="btn btn-primary " href="detalleRegistro.php?nreg=10000002" role="button"><i class="fa fa-search"></i></a> |
                            <a class="btn btn-success " onclick="cargaUbicacion(321)" role="button"><i class="fa fa-map-marker"></i></a> |
                            <a class="btn btn-warning " onclick="formActuado(4321)" role="button"><i class="fa fa-edit"></i></a> |
                            <a class="btn btn-danger " onclick="borrarCompendio()" role="button"><i class="fa fa-trash-o"></i></a>
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
    $(".datepicker").flatpickr();

    function cargaUbicacion(idregistro) {
        if (idregistro) { 
            var content_ = `
        <div class="form-group" >
            <div class="row" style="margin-right:0 !important;">
                <div class="col-md-6">
                    <label>Nro Registro</label>
                    <input type="text" disabled id="no_registro_" placeholder="No. Registro" class="form-control" value="10000001" required />
                </div> 
            </div>
            <div class="row" style="margin-right:0 !important;">
                <div class="col-md-6">
                    <label>Rubro</label>
                    <select disabled id="rubro_" class="form-control">
                        <option  value="inmueble">Inmueble</option>
                        <option selected value="vehiculo">Vehiculo</option>
                        <option value="actividad economica">Actividad economica</option>
                        <option value="otros">Otros</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Identificador</label>
                    <input disabled type="text" id="identificador_" placeholder="Placa, No. Inmb. No. Patente" class="form-control" value="SGE122" required />
                </div>
            </div> 
            <div  class="row" style="margin-right:0 !important;">  
                <div class="col-md-6">
                    <label>Estante</label>
                    <select id="estante_" class="form-control">
                        <option  value="1">No 1</option>
                        <option selected value="2">No 2</option>
                        <option value="3">No 3</option>
                        <option value="4">No 4</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Sección</label>
                    <select id="seccion_" class="form-control">
                        <option  value="1A">1A</option>
                        <option selected value="1B">1B</option>
                        <option value="1C">1C</option>
                        <option value="2A">2A</option>
                        <option value="2B">2B</option>
                    </select>
                </div>
            </div>
            <div>
                <div class="col-md-12">
                    <label>Observación</label>
                    <textarea cols="15" rows="4" class="form-control" id='observacion_'></textarea>
                </div>
            </div>
            <hr>
            <div style="color:red;font-size:0.8rem;">
            * Todos son campos obligatorios
            </div>
        </div>
        `;

            var errorContribuyente = true;
            $.confirm({
                title: "<i class='fa fa-map-marker'></i> Registro de ubicación fisica",
                type: "dark",
                content: content_,
                buttons: {
                    formSubmit: {
                        text: "Registrar",
                        btnClass: "btn-blue",
                        action: function() {
                            var formSubmitButton = this.buttons.formSubmit;
                            datos = 
                                "&estante_=" + $("#estante_").val() +
                                "&seccion_=" + $("#seccion_").val() +
                                "&idregistro=" + idregistro +
                                "&observacion_=" + $("#observacion_").val();
                            console.log(datos);
                            $.ajax({
                                async: true,
                                type: "POST",
                                dataType: "html",
                                contentType: "application/x-www-form-urlencoded",
                                url: "../php/regUbicacionRegistro.php",
                                data: datos,
                                beforeSend: function() {
                                    formSubmitButton.setText('Procesando...');
                                    formSubmitButton.disable();
                                    loadGralOn();
                                },
                                success: function(e) {
                                    loadGralOff();
                                    dat = JSON.parse(e)
                                    $.confirm(dat.html);

                                },
                                timeout: 1600,
                                error: function() {},
                            });

                        },
                    },
                    cancel: function() {},
                },
            });

        } else {
            $.confirm({
                title: " Ops...",
                type: "red",
                content: "No se obtuvo correctamente el numero de actuado, vuelva a intentarlo",
            });
        }
    }

    function formActuado(idactuado = 0) {
        var titulo = 'Registro de ';
        if (idactuado) {
            titulo = 'Edición de ';
            //seteamos valores para efectuar la modificacion 
        }
        var content_ = `
        <div class="form-group" >
            <div class="row" style="margin-right:0 !important;">
                <div class="col-md-6">
                    <label>Nro Registro</label>
                    <input type="text" id="no_registro_" placeholder="No. Registro" class="form-control" value="10000001" required />
                </div>
                <div class="col-md-6">
                    <label>Fojas</label>
                    <input type="text" id="fojas_" placeholder="Numero de fojas" class="form-control" value="6" required />
                </div>
            </div>
            <div class="row" style="margin-right:0 !important;">
                <div class="col-md-6">
                    <label>Rubro</label>
                    <select id="rubro_" class="form-control">
                        <option  value="inmueble">Inmueble</option>
                        <option selected value="vehiculo">Vehiculo</option>
                        <option value="actividad economica">Actividad economica</option>
                        <option value="otros">Otros</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Identificador</label>
                    <input type="text" id="identificador_" placeholder="Placa, No. Inmb. No. Patente" class="form-control" value="SGE122" required />
                </div>
            </div>

            <div  class="row" style="margin-right:0 !important;">

                <div class="col-md-6">
                    <label>Nro. Hoja de ruta</label>
                    <input type="text" id="hhrr_" placeholder="DATM/XXX/2024" class="form-control" value="DATM/5238/2024" required />
                </div>
                <div class="col-md-6">
                    <label>Documento</label>
                    <input type="file" id="documento_" class="form-control" placeholder="Cargar documento" />
                </div>
            </div>
            <div>
                <div class="col-md-12">
                <label>Comentario</label>
                <textarea cols="15" rows="4" class="form-control" id='comentario_'></textarea>
                </div>
            </div>
            <hr>
            <div style="color:red;font-size:0.8rem;">
            * Todos son campos obligatorios
            </div>
        </div>
        `;

        var errorContribuyente = true;
        $.confirm({
            title: titulo + " actuado:",
            type: "dark",
            content: content_,
            buttons: {
                formSubmit: {
                    text: "Registrar",
                    btnClass: "btn-blue",
                    action: function() {
                        var formSubmitButton = this.buttons.formSubmit;
                        datos =
                            "&no_registro_=" + $("#no_registro_").val() +
                            "&fojas_=" + $("#fojas_").val() +
                            "&rubro_=" + $("#rubro_").val() +
                            "&identificador_=" + $("#identificador_").val() +
                            "&hhrr_=" + $("#hhrr_").val() +
                            "&documento_=" + $("#documento_").val() +
                            "&idactuado=" + idactuado +
                            "&comentario_=" + $("#comentario_").val();
                        console.log(datos);
                        $.ajax({
                            async: true,
                            type: "POST",
                            dataType: "html",
                            contentType: "application/x-www-form-urlencoded",
                            url: "../php/regeditActuado.php",
                            data: datos,
                            beforeSend: function() {
                                formSubmitButton.setText('Procesando...');
                                formSubmitButton.disable();
                                loadGralOn();
                            },
                            success: function(e) {
                                loadGralOff();
                                dat = JSON.parse(e)
                                $.confirm(dat.html);

                            },
                            timeout: 1600,
                            error: function() {},
                        });

                    },
                },
                cancel: function() {},
            },
        });
    }

    function borrarCompendio() {
        $.confirm('Borrando actuado');
    }
</script>

</html>