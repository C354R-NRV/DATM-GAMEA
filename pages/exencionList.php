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
    <title>EXENCION</title>
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
    <li class="breadcrumb-item"><a class="text-white">UAJ</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page"> <a class="text-white" href="exencionList.php">EXENCION</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page"> <a class="text-white" href="#">LISTADO DE SOLICITUDES</a></li>

    <?php
    echo $twig->render('prebodyltFin.twig');
    echo '<input type="hidden" id="rolUser" value="' . $_SESSION['rol'] . '">';
    ?>
    <!-- Hero End -->

    <!-- About Start -->
    <div class="contenedorDigitaliza">
        <div class="form-group d-flex flex-column flex-md-row">
            <div class="row">
                <div class="col-md-1 mb-3">
                    <?php
                    if ($_SESSION['rol'] == 'CONTRIBUYENTE' or $_SESSION['rol'] == 'DESARROLLO')
                        echo '<a class="btn btn-success" href="exencionPanel.php" role="button"><i class="fa fa-plus"></i></a>';
                    ?>
                </div>
                <div class="col-md-4 mb-3">
                    <input type="text" class="form-control" value="" id="filtroCodigoSolicitud" placeholder="Codigo de solicitud">
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control datepicker" value="" id="filtroFechaIni" placeholder="Fecha ini">
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control datepicker" value="" id="filtroFechaFin" placeholder="Fecha fin">
                </div>
                <div class="col-md-1 mb-3">
                    <button class="btn btn-primary" onclick="getSolicitudes()">consultar</button>
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
                data-sort-name="fecha_actuado"
                data-sort-order="desc"
                data-show-refresh="true"
                data-url="../php/exencionGetSolicitudes.php"
                data-query-params="filtrosDataTable">
                <thead>
                    <th data-field="idcabecera" data-sortable="true">Id</th>
                    <th data-field="idactuado" data-sortable="true">Act</th>
                    <th data-field="tipo_solicitud" data-sortable="true">Solicitud</th>
                    <?php
                    if ($_SESSION['rol'] != 'CONTRIBUYENTE') {
                        echo '<th data-field="usuario" data-sortable="true">Usuario</th>
                                <th data-field="cedula_identidad" data-sortable="true">CI/NIT</th>
                                <th data-field="contacto" data-sortable="true">Contacto</th>';
                    }
                    ?>
                    <th data-field="rubro" data-sortable="true">Tipo</th> 
                    <th data-field="registro_tributario" data-sortable="true">Reg. Trib.</th>
                    <th data-field="codigo_solicitud" data-sortable="true">Cod. solicitud</th>
                    <th data-field="fecha_inicio" data-sortable="true">Fecha inicio</th>
                    <th data-field="fecha_actuado" data-sortable="true">Fecha actuado</th>
                    <th data-field="detalle_estado" data-sortable="true">Estado</th>
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
            getSolicitudes();
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

    function getSolicitudes() {
        $.ajax({
            async: true,
            type: 'POST',
            data: {
                filtroCodigoSolicitud: $('#filtroCodigoSolicitud').val(),
                filtroFechaIni: $('#filtroFechaIni').val(),
                filtroFechaFin: $('#filtroFechaFin').val()
            },
            url: '../php/exencionGetSolicitudes.php',
            beforeSend: function() {
                loadGralOn();
            },
            success: function(dat) {
                console.log(dat);
                loadGralOff();
                $('#tbodyItems').empty();
                dat = $.parseJSON(dat);
                // Iterar sobre los datos recibidos y agregarlos al tbody
                $.each(dat.info, function(index, item) {

                    var fila = `
                    <tr>
                        <td>${item.idcabecera}</td>
                        <td>${item.idactuado}</td>
                        <td>${item.tipo_solicitud}</td> 
                        `;

                    if ($('#rolUser').val() != 'CONTRIBUYENTE') {
                        fila += `
                                <td>${item.usuario}</td>
                                <td>${item.cedula_identidad}</td>
                                <td>${item.contacto}</td>
                            `;
                    }

                    fila += `<td>${item.rubro}</td>
                        <td>${item.registro_tributario}</td>
                        <td>${item.codigo_solicitud}</td>
                        <td>${item.fecha_inicio}</td>
                        <td>${item.fecha_actuado}</td> 
                        <td>${item.detalle_estado}</td> 
                        <td>${item.acciones}</td>
                    </tr>
                `;


                    $('#tbodyItems').append(fila);
                });

                // Recargar la tabla para que Bootstrap Table detecte los nuevos datos
                console.log("previo resfrescar")
                $('#tableCompendio').bootstrapTable('refresh');
                console.log("resfrescamos")

            },
            timeout: 16000,
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    }

    function revisarSolicitud(idcabecera, idactuado, codigoSolicitud, sw) {
        window.location.href = './exencionRevisionSolicitud.php?j=' + idcabecera + '&i=' + codigoSolicitud + '&w=' + sw+'&x='+idactuado;
    }

    function cambiarARecibido(idsolicitud, codigoSolicitud) {
        $.confirm({
            title: "Recepción de solitud",
            type: "orange",
            content: "Confirme la recepción de la solicitud: <b>" + idsolicitud + "</b>, con código de solicitud: <b>" + codigoSolicitud + "</b>",
            columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
            buttons: {
                confirmar: {
                    text: "Confirmar",
                    btnClass: "btn-warning",
                    action: function() {
                        var datos = {
                            idsolicitud: idsolicitud,
                        };
                        $.ajax({
                            async: true,
                            type: 'POST',
                            data: datos,
                            url: '../php/exencionRecepcionSolicitud.php',
                            beforeSend: function() {
                                loadGralOn();
                            },
                            success: function(dat) {
                                console.log(dat);
                                loadGralOff();
                                //AGREAGAR NOTIFICACION DE GUARDADO CORRECTO 
                                dat = $.parseJSON(dat);
                                window.location.href = './exencionList.php';
                            },
                            timeout: 16000,
                            error: function(xhr, status, error) {
                                alert('Error: ' + error);
                            }
                        });
                    }
                },
                cancel: {
                    text: "Cerrar",
                    action: function() {}
                }
            }
        });
    }

    function subsanarObservaciones(idcabecera, codigoSolicitud) {
        window.location.href = './exencionSubsanarObservaciones.php?i=' + idcabecera + '&c=' + codigoSolicitud;
    }

    function cambiarAEntregaFisico(idcabecera, codigoSolicitud) {
        $.confirm({
            title: "Confirmación de entrega",
            type: "orange",
            content: "Por favor, confirme la <b>entrega de los requisitos en fisico</b> de la solicitud: <b>" + idcabecera + "</b>, con código de solicitud: <b>" + codigoSolicitud + "</b>",
            columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
            buttons: {
                confirmar: {
                    text: "Confirmar",
                    btnClass: "btn-warning",
                    action: function() {
                        $.ajax({
                            async: true,
                            type: 'POST',
                            data: {
                                idcabecera: idcabecera,
                                codigoSolicitud: codigoSolicitud,
                            },
                            url: '../php/exencionEntregaFisica.php',
                            beforeSend: function() {
                                loadGralOn();
                            },
                            success: function(dat) {
                                console.log(dat);
                                loadGralOff();
                                //AGREAGAR NOTIFICACION DE GUARDADO CORRECTO  
                                dat = $.parseJSON(dat);
                                window.location.href = './exencionList.php';
                            },
                            timeout: 16000,
                            error: function(xhr, status, error) {
                                alert('Error: ' + error);
                            }
                        });
                    }
                },
                cancel: {
                    text: "Cancelar",
                    action: function() {}
                }
            }
        });

    }

    function cambiarAtendido(idcabecera, codigoSolicitud) {
        $.confirm({
            title: "Confirmación de cambio de estado",
            type: "orange",
            content: "Por favor, confirme el cambio de estado a <b>COMPLETADO Y ATENDIDO</b> de la solicitud: <b>" + idcabecera + "</b>, con código de solicitud: <b>" + codigoSolicitud + "</b> y <b>Adjunte la RESOLUCION ADMINISTRATIVA</b><br><input type='file' id='formFilePdf' class='form-control' placeholder='Cargar documento'>",
            columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
            buttons: {
                confirmar: {
                    text: "Confirmar",
                    btnClass: "btn-warning",
                    action: function() {

                        var formData = new FormData();
                        var fileInput = $('#formFilePdf')[0];
                        formData.append('archivoPdf', fileInput.files[0]);
                        formData.append('idcabecera', idcabecera);
                        formData.append('codigoSolicitud', codigoSolicitud);
                        
                        $.ajax({ 
                            async: true,
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false, 
                            url: '../php/exencionAtentido.php', 
                            beforeSend: function() {
                                loadGralOn();
                            },
                            success: function(dat) {
                                console.log(dat);
                                loadGralOff();
                                //AGREAGAR NOTIFICACION DE GUARDADO CORRECTO  
                                dat = $.parseJSON(dat);
                                window.location.href = './exencionList.php';
                            },
                            timeout: 16000,
                            error: function(xhr, status, error) {
                                alert('Error: ' + error);
                            }
                        });
                    }
                },
                cancel: {
                    text: "Cancelar",
                    action: function() {}
                }
            }
        });
    }

    function cambiarARecibidoFisico(idcabecera, codigoSolicitud) {

        $.confirm({
            title: "Confirmación de recepción en fisico",
            type: "orange",
            content: "Por favor, confirme la <b>recepción de los requisitos en fisico</b> de la solicitud: <b>" + idcabecera + "</b>, con código de solicitud: <b>" + codigoSolicitud + "</b>",
            columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
            buttons: {
                confirmar: {
                    text: "Confirmar",
                    btnClass: "btn-warning",
                    action: function() {
                        $.ajax({
                            async: true,
                            type: 'POST',
                            data: {
                                idcabecera: idcabecera,
                                codigoSolicitud: codigoSolicitud,
                            },
                            url: '../php/exencionRecepcionFisica.php',
                            beforeSend: function() {
                                loadGralOn();
                            },
                            success: function(dat) {
                                console.log(dat);
                                loadGralOff();
                                //AGREAGAR NOTIFICACION DE GUARDADO CORRECTO  
                                dat = $.parseJSON(dat);
                                window.location.href = './exencionList.php';
                            },
                            timeout: 16000,
                            error: function(xhr, status, error) {
                                alert('Error: ' + error);
                            }
                        });
                    }
                },
                cancel: {
                    text: "Cancelar",
                    action: function() {}
                }
            }
        });

        
    }

    function verLineaTiempo(idsolicitud, codigoSolicitud) {
        console.log("verLineaTiempo solicitud" + idsolicitud + ", para:" + codigoSolicitud);
        window.location.href = './exencionLineaTiempo.php?j=' + idsolicitud + '&i=' + codigoSolicitud;
    }

    function enviarSolicitud(idsolicitud, codigoSolicitud) {
        console.log("Enviando solicitud" + idsolicitud + ", para:" + codigoSolicitud);

    } 

    function borrarCompendio(idsolicitud, codigoSolicitud) {
        $.confirm({
            title: "Eliminación de solicitud",
            type: "red",
            content: "Confirme la eliminacion de la solicitud: <b>" + idsolicitud + "</b>, con código de solicitud: <b>" + codigoSolicitud + "</b> y detalle brevemente la(s) razon(es):<br> <textarea id='observacion' rows='6' cols='40' class= 'form-control' placeholder='Escribe aquí el detalle...'></textarea><br><br>",
            columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
            buttons: {
                confirmar: {
                    text: "Confirmar",
                    btnClass: "btn-red",
                    action: function() {
                        var datos = {
                            idsolicitud: idsolicitud,
                            observacion: $('#observacion').val(),
                        };
                        $.ajax({
                            async: true,
                            type: 'POST',
                            data: datos,
                            url: '../php/exencionBajaSolicitud.php',
                            beforeSend: function() {
                                loadGralOn();
                            },
                            success: function(dat) {
                                loadGralOff();
                                //AGREAGAR NOTIFICACION DE GUARDADO CORRECTO 
                                dat = $.parseJSON(dat);
                                window.location.href = './exencionList.php';

                            },
                            timeout: 16000,
                            error: function(xhr, status, error) {
                                alert('Error: ' + error);
                            }
                        });
                    }
                },
                cancel: {
                    text: "Cerrar",
                    action: function() {}
                }
            }
        });
    }

    function verDetalleReversion(idsolicitud, codigoSolicitud) {
        var datos = {
            idsolicitud: idsolicitud,
            observacion: $('#observacion').val(),
        };
        $.ajax({
            async: true,
            type: 'POST',
            data: datos,
            url: '../php/exencionDetalleBajaSolicitud.php',
            beforeSend: function() {
                loadGralOn();
            },
            success: function(dat) {
                loadGralOff();
                $.confirm({
                    title: "Detalles de solicitud revertida",
                    type: "green",
                    content: dat,
                    columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
                    buttons: {
                        volver: {
                            text: "Volver",
                            action: function() {}
                        }
                    }
                });

            },
            timeout: 16000,
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    }
</script>

</html>