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
    <li class="breadcrumb-item text-white active" aria-current="page">Panel</li>
    <?php
    echo $twig->render('prebodyltFin.twig');
    ?>
    <!-- Hero End -->

    <!-- About Start -->
    <div class="contenedorDigitaliza">

        <div class="form-group d-flex flex-column flex-md-row">
            <div class="row">
                <div class="col-md-2 mb-3">
                    <a class="btn btn-success" onclick="formActuado()" role="button"><i class="fa fa-plus"></i></a> |
                    <a class="btn btn-success" href="https://aistudio.google.com/prompts/new_chat" role="button"><i class="fa fa-connectdevelop" aria-hidden="true"></i></a>
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control" value="" placeholder="Patente, Placa, Num. Inmueble" id="no_registro">
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control datepicker" value="" placeholder="Fecha ini">
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control datepicker" value="" placeholder="Fecha fin">
                </div>
                <div class="col-md-1 mb-3">
                    <button class="btn btn-primary" onclick="getArchivos()">consultar</button>
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
                data-export-types='["csv","excel"]'
                data-click-to-select="true"
                data-pagination="true"
                data-page-list="[10, 25, 50, 100, all]"
                data-locale="es-ES"
                class="table table-striped"
                data-sort-name="idarchivo"
                data-sort-order="desc"
                data-show-refresh="true"
                data-url="../php/getArchivoDigital.php"
                data-query-params="filtrosDataTable">
                <thead>
                    <th data-field="idarchivo" data-sortable="true">Id</th>
                    <th data-field="rubro" data-sortable="true">Rubro</th>
                    <th data-field="codigo_archivo" data-sortable="true">Codigo archivo</th>
                    <th data-field="estante" data-sortable="true">Estante</th>
                    <th data-field="nivel" data-sortable="true">Nivel</th>
                    <th data-field="fregistro" data-sortable="true">Registro</th>
                    <th data-field="usuario" data-sortable="true">Usuario</th>
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

    function filtrosDataTable(p) {
        console.log("en filtrosDataTable");
        return {
            no_registro: $('#no_registro').val(),
            filtroFechaIni: $('#filtroFechaIni').val(),
            filtroFechaFin: $('#filtroFechaFin').val(),
            offset: p.offset,
            limit: p.limit,
            sort: p.sort,
            order: p.order,
            search: p.search
        }
    }

    function getArchivos() {
        $.ajax({
            async: true,
            type: 'POST',
            data: {
                no_registro: $('#no_registro').val(),
                filtroFechaIni: $('#filtroFechaIni').val(),
                filtroFechaFin: $('#filtroFechaFin').val()
            },
            url: '../php/getArchivoDigital.php',
            beforeSend: function() {
                loadGralOn();
            },
            success: function(dat) {
                loadGralOff();
                $('#tbodyItems').empty();
                dat = $.parseJSON(dat);
                // Iterar sobre los datos recibidos y agregarlos al tbody
                $.each(dat, function(index, item) {
                    var fila = `
                    <tr>
                        <td>${item.idarchivo}</td>
                        <td>${item.rubro}</td>
                        <td>${item.codigo_archivo}</td>
                        <td>${item.estante}</td>
                        <td>${item.nivel}</td>
                        <td>${item.fregistro}</td>
                        <td>${item.usuario}</td> 
                        <td>${item.acciones}</td> 
                    </tr>
                `;
                    $('#tbodyItems').append(fila);
                });
                $('#tableCompendio').bootstrapTable('refresh');
            },
            timeout: 16000,
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    }

    function formActuado(idactuado = 0) {
        var titulo = 'Registro de ';
        if (idactuado) {
            titulo = 'Edición de ';
            //seteamos valores para efectuar la modificacion 
        }
        var content_ = `
    <div class="form-group">
        <div class="row" style="margin-right:0 !important;">
            <div class="col-md-12">
                <label>Codigo documento</label>
                <input type="text" id="codigo_archivo" placeholder="Pj. 1510133909_20250812_00001.pdf" class="form-control" required />
            </div> 
        </div> 
        <div class="row" style="margin-right:0 !important;">
            <div class="col-md-12">
                <label>Rubro</label>
                <select id="idrubro" class="form-control">
                    <option value="">-- Seleccione --</option>
                    <option value="2">Inmueble</option>
                    <option selected value="1">Vehiculo</option>
                    <option value="3">Actividad economica</option>
                    <option value="4">Tasas y patentes</option>
                    <option value="5">Otros</option>
                </select>
            </div> 
        </div>
        <div class="row" style="margin-right:0 !important;">
            <div class="col-md-6">
                <label>Estante</label>
                <input type="number" id="estante" placeholder="Numero de estante" class="form-control" required /> 
            </div>
            <div class="col-md-6">
                <label>Nivel</label>
                <select id="nivel" class="form-control">
                    <option value="">-- Seleccione --</option>
                    <option selected value="1">Nivel 1</option>
                    <option value="2">Nivel 2</option>
                    <option value="3">Nivel 3</option>
                    <option value="4">Nivel 4</option>
                    <option value="5">Nivel 5</option>
                    <option value="6">Nivel 6</option>
                    <option value="7">Nivel 7</option>
                    <option value="8">Nivel 8</option>
                    <option value="9">Nivel 9</option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <label>Comentario</label>
            <textarea cols="15" rows="4" class="form-control" id='comentario'></textarea>
        </div>
        <hr>
        <div style="color:red;font-size:0.8rem;">
        * Todos son campos obligatorios
        </div>
    </div>
    `;

        $.confirm({
            title: titulo + " archivo digital:",
            type: "dark",
            content: content_,
            buttons: {
                formSubmit: {
                    text: "Registrar",
                    btnClass: "btn-blue",
                    action: function() {
                        var errores = [];

                        if ($("#codigo_archivo").val().trim() === "") {
                            errores.push("• Debe ingresar el código del documento.");
                        }
                        if ($("#idrubro").val().trim() === "") {
                            errores.push("• Debe seleccionar un rubro.");
                        }
                        if ($("#estante").val().trim() === "") {
                            errores.push("• Debe ingresar el número de estante.");
                        }
                        if ($("#nivel").val().trim() === "") {
                            errores.push("• Debe seleccionar un nivel.");
                        }

                        // Si hay errores, mostrar listado y cancelar envío
                        if (errores.length > 0) {
                            $.confirm({
                                title: 'Validación de campos',
                                content: errores.join("<br>"),
                                type: 'red',
                                buttons: {
                                    ok: function() {}
                                }
                            });
                            return false; // Evita ejecutar el AJAX
                        }

                        var formSubmitButton = this.buttons.formSubmit;
                        var datos =
                            "&codigo_archivo=" + $("#codigo_archivo").val() +
                            "&idrubro=" + $("#idrubro").val() +
                            "&estante=" + $("#estante").val() +
                            "&nivel=" + $("#nivel").val() +
                            "&idactuado=" + idactuado +
                            "&comentario=" + $("#comentario").val();

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
                                console.log(e);
                                loadGralOff();
                            },
                            timeout: 16000,
                            error: function() {},
                        });
                    },
                },
                cancel: function() {},
            },
        });
    }

    /* function editarUbicacion(idarchivo = 0, codigo_archivo, estante = 0, nivel = 0) {
        var titulo = 'Registro de ';
        if (idarchivo) {
            titulo = 'Edición de ';
            //seteamos valores para efectuar la modificacion 
        }

        // Generar opciones dinámicas de nivel (1 a 9)
        let nivelOptions = `<option value="">-- Seleccione --</option>`;
        for (let i = 1; i <= 9; i++) {
            nivelOptions += `<option value="${i}" ${nivel == i ? "selected" : ""}>Nivel ${i}</option>`;
        }

        // Construir el HTML
        let content_ = `
                <div class="form-group">
                    <div class="row" style="margin-right:0 !important;">
                        <div class="col-md-12">
                            <label>Codigo documento</label>
                            <b>${codigo_archivo}</b>
                        </div> 
                    </div>  
                    <div class="row" style="margin-right:0 !important;">
                        <div class="col-md-6">
                            <label>Estante</label>
                            <input type="number" id="estante" placeholder="Numero de estante" class="form-control" value="${estante}" required /> 
                        </div>
                        <div class="col-md-6">
                            <label>Nivel</label>
                            <select id="nivel" class="form-control">
                                ${nivelOptions}
                            </select>
                        </div>
                    </div> 
                    <hr>
                    <div style="color:red;font-size:0.8rem;">
                    * Todos son campos obligatorios
                    </div>
                </div>`;

        $.confirm({
            title: titulo + " archivo digital:",
            type: "dark",
            content: content_,
            buttons: {
                formSubmit: {
                    text: "Guardar",
                    btnClass: "btn-blue",
                    action: function() {
                        var errores = [];
                        if ($("#estante").val().trim() === "") {
                            errores.push("• Debe ingresar el número de estante.");
                        }
                        if ($("#nivel").val().trim() === "") {
                            errores.push("• Debe seleccionar un nivel.");
                        }

                        // Si hay errores, mostrar listado y cancelar envío
                        if (errores.length > 0) {
                            $.confirm({
                                title: 'Validación de campos',
                                content: errores.join("<br>"),
                                type: 'red',
                                buttons: {
                                    ok: function() {}
                                }
                            });
                            return false; // Evita ejecutar el AJAX
                        }

                        var formSubmitButton = this.buttons.formSubmit;
                        var datos =
                            "&codigo_archivo=" + $("#codigo_archivo").val() +
                            "&estante=" + $("#estante").val() +
                            "&estante_ant=" + estante +
                            "&nivel=" + $("#nivel").val() +
                            "&nivel_ant=" + nivel +
                            "&idarchivo=" + idarchivo;

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
                                console.log(e);
                                loadGralOff();
                            },
                            timeout: 16000,
                            error: function() {},
                        });
                    },
                },
                cancel: function() {},
            },
        });
    } */

    function editarUbicacion(idarchivo = 0, codigo_archivo, estante = 0, nivel = 0) {
        var titulo = 'Registro de ';
        if (idarchivo) {
            titulo = 'Edición de ';
            //seteamos valores para efectuar la modificacion 
        }

        // Generar opciones dinámicas de nivel (1 a 9)
        let nivelOptions = `<option value="">-- Seleccione --</option>`;
        for (let i = 1; i <= 9; i++) {
            nivelOptions += `<option value="${i}" ${nivel == i ? "selected" : ""}>Nivel ${i}</option>`;
        }

        // Construir el HTML
        let content_ = `
                <div class="form-group">
                    <div class="row" style="margin-right:0 !important;">
                        <div class="col-md-12">
                            <label>Codigo documento</label>
                            <b>${codigo_archivo}</b>
                        </div> 
                    </div>  
                    <div class="row" style="margin-right:0 !important;">
                        <div class="col-md-6">
                            <label>Estante</label>
                            <input type="number" id="estante" placeholder="Numero de estante" class="form-control" value="${estante}" required /> 
                        </div>
                        <div class="col-md-6">
                            <label>Nivel</label>
                            <select id="nivel" class="form-control">
                                ${nivelOptions}
                            </select>
                        </div>
                    </div> 
                    <hr>
                    <div style="color:red;font-size:0.8rem;">
                    * Todos son campos obligatorios
                    </div>
                </div>`;

        $.confirm({
            title: titulo + " archivo digital:",
            type: "dark",
            content: content_,
            buttons: {
                formSubmit: {
                    text: "Guardar",
                    btnClass: "btn-blue",
                    action: function() {
                        var errores = [];
                        if ($("#estante").val().trim() === "") {
                            errores.push("• Debe ingresar el número de estante.");
                        }
                        if ($("#nivel").val().trim() === "") {
                            errores.push("• Debe seleccionar un nivel.");
                        }

                        // Si hay errores, mostrar listado y cancelar envío
                        if (errores.length > 0) {
                            $.confirm({
                                title: 'Validación de campos',
                                content: errores.join("<br>"),
                                type: 'red',
                                buttons: {
                                    ok: function() {}
                                }
                            });
                            return false; // Evita ejecutar el AJAX
                        }

                        var formSubmitButton = this.buttons.formSubmit;
                        var nuevoEstante = $("#estante").val();
                        var nuevoNivel = $("#nivel").val();

                        var datos =
                            "&codigo_archivo=" + $("#codigo_archivo").val() +
                            "&estante=" + nuevoEstante +
                            "&estante_ant=" + estante +
                            "&nivel=" + nuevoNivel +
                            "&nivel_ant=" + nivel +
                            "&idarchivo=" + idarchivo;

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
                                console.log(e);
                                loadGralOff();

                                try {
                                    var respuesta = JSON.parse(e);
                                    if (respuesta.err === '0') {
                                        // Actualizar la fila específica en la tabla
                                        actualizarFilaTabla(idarchivo, nuevoEstante, nuevoNivel);

                                        // Mostrar mensaje de éxito
                                        $.confirm({
                                            title: 'Éxito',
                                            content: 'Ubicación actualizada correctamente',
                                            type: 'green',
                                            buttons: {
                                                ok: function() {}
                                            }
                                        });
                                    } else {
                                        // Mostrar error del servidor
                                        $.confirm({
                                            title: 'Error',
                                            content: 'Error al actualizar: ' + (respuesta.log || 'Error desconocido'),
                                            type: 'red',
                                            buttons: {
                                                ok: function() {}
                                            }
                                        });
                                    }
                                } catch (error) {
                                    console.error('Error al parsear respuesta:', error);
                                    $.confirm({
                                        title: 'Error',
                                        content: 'Error al procesar la respuesta del servidor',
                                        type: 'red',
                                        buttons: {
                                            ok: function() {}
                                        }
                                    });
                                }
                            },
                            timeout: 16000,
                            error: function() {
                                loadGralOff();
                                $.confirm({
                                    title: 'Error',
                                    content: 'Error de conexión con el servidor',
                                    type: 'red',
                                    buttons: {
                                        ok: function() {}
                                    }
                                });
                            },
                        });
                    },
                },
                cancel: function() {},
            },
        });
    }

    function actualizarFilaTabla(idarchivo, nuevoEstante, nuevoNivel) {
        // Buscar la fila en la tabla Bootstrap Table
        var $table = $('#tableCompendio');
        var data = $table.bootstrapTable('getData');

        // Encontrar el índice del registro a actualizar
        var indiceRegistro = -1;
        for (var i = 0; i < data.length; i++) {
            if (data[i].idarchivo == idarchivo) {
                indiceRegistro = i;
                break;
            }
        }

        if (indiceRegistro !== -1) {
            // Actualizar los datos en el array
            data[indiceRegistro].estante = nuevoEstante;
            data[indiceRegistro].nivel = nuevoNivel;

            // Recargar la tabla con los datos actualizados
            $table.bootstrapTable('load', data);

            console.log('Fila actualizada correctamente para ID:', idarchivo);
        } else {
            console.warn('No se encontró la fila con ID:', idarchivo);
            // Como fallback, refrescar toda la tabla
            $table.bootstrapTable('refresh');
        }
    }

    function borrarCompendio() {
        $.confirm('Borrando actuado');
    }
</script>

</html>