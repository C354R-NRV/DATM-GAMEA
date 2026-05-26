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
    <title>Procesos</title>
    <?php
    echo $twig->render('linkStyle.twig');
    ?>
    <link href="../css/styleRecursoIa.css" rel="stylesheet">
    <link href="../vendor/bootstrap-table-master/dist/bootstrap-table.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .custom-form-container {
            background: #ffffff;
            border-radius: 10px;
            padding: 25px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }

        .custom-form-container label {
            font-weight: 600;
            color: #2c3e50;
            font-size: 0.95rem;
            display: block;
            margin-bottom: 5px;
        }

        .custom-form-container .form-value {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 8px 12px;
            font-size: 0.95rem;
            color: #495057;
        }

        .custom-form-container .row>div {
            margin-bottom: 15px;
        }

        .custom-form-container .form-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 20px;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 5px;
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
    <li class="breadcrumb-item text-white active" aria-current="page">Procesos</li>
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
                data-sort-name="idproceso"
                data-sort-order="desc"
                data-show-refresh="true"
                data-url="../php/getProcesosUaj.php"
                data-query-params="filtrosDataTable">
                <thead>
                    <th data-field="idproceso" data-sortable="true">Id</th>
                    <th data-field="rubro" data-sortable="true">Rubro</th>
                    <th data-field="numero_tributario" data-sortable="true">No. tributario</th>
                    <th data-field="resolucion_determinativa" data-sortable="true">Resolucion determinativa</th>
                    <th data-field="gestion_fiscal" data-sortable="true">Gestion fiscal</th>
                    <th data-field="piet" data-sortable="true">PIET</th>
                    <th data-field="fecha_piet" data-sortable="true">F.PIET</th>
                    <th data-field="acto_ejecucion_tributaria" data-sortable="true">Act. ejec. trib.</th>
                    <th data-field="fecha_notificacion" data-sortable="true">F. Not.</th>
                    <th data-field="cancelacion_determinacion_tributaria" data-sortable="true">Canc. Det. Trib.</th>
                    <th data-field="auto_conclusion" data-sortable="true">Auto Conc.</th>
                    <th data-field="cierre_definitivo_proceso" data-sortable="true">Cierre def.</th>
                    <th data-field="usuario" data-sortable="true">Usuario</th>
                    <th data-field="fregistro_" data-sortable="true">F.Reg</th>
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
            url: '../php/getProcesosUaj.php',
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
                        <td>${item.numero_tributario}</td>
                        <td>${item.resolucion_determinativa}</td>
                        <td>${item.gestion_fiscal}</td>
                        <td>${item.piet}</td>
                        <td>${item.fecha_piet}</td>
                        <td>${item.acto_ejecucion_tributaria}</td>
                        <td>${item.fecha_notificacion}</td>
                        <td>${item.cancelacion_determinacion_tributaria}</td>
                        <td>${item.auto_conclusion}</td>
                        <td>${item.cierre_definitivo_proceso}</td>
                        <td>${item.usuario}</td> 
                        <td>${item.fregistro_}</td>
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

    function verDetalle(idproceso = 0) {
        $.ajax({
            async: true,
            type: 'POST',
            data: '&idproceso=' + idproceso,
            url: "../php/detalleProcesoUaj.php",
            beforeSend: function() {
                loadGralOn();
            },
            success: function(e) {
                dat = JSON.parse(e);
                loadGralOff();
                $.confirm({
                    title: "Detalle proceso",
                    type: "dark",
                    content: dat.html,
                    columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
                });
            },
            timeout: 16000,
            error: function() {},
        });


    }

    function formActuado(idproceso = 0) {
        var titulo = 'Registro de ';
        if (idproceso) {
            titulo = 'Edición de ';
        }
        var content_ = `
            <div class="form-group">
                <div class="row g-3" style="margin-right:0 !important;">
                    <div class="col-lg-6 col-md-12">
                        <label>No. DOCUMENTO TRIBUTARIO</label>
                        <input type="text" id="numero_tributario"  class="form-control" required />
                    </div> 
                    <div class="col-lg-6 col-md-12">
                        <label>Rubro</label>
                        <select id="idrubro" class="form-control"> 
                            <option value="2">Inmueble</option>
                            <option selected value="1">Vehiculo</option>
                            <option value="3">Actividad economica</option>
                            <option value="4">Tasas y patentes</option>
                            <option value="5">Otros</option>
                        </select>
                    </div> 
                    <div class="col-lg-6 col-md-12">
                        <label>REGISTRO DE LA  RESOLUCIÓN DETERMINATIVA</label>
                        <input type="text" id="resolucion_determinativa"  class="form-control" required />
                    </div> 
                    <div class="col-lg-6 col-md-12">
                        <label>REGISTRO DE LAS GESTIONES QUE  FISCALIZA</label>
                        <input type="text" id="gestion_fiscal"  class="form-control" required />
                    </div> 
                    <div class="col-lg-6 col-md-12">
                        <label>REGISTRO DE LA EMISIÓN DEL PIET</label>
                        <input type="text" id="piet"  class="form-control" required />
                    </div> 
                    <div class="col-lg-6 col-md-12">
                        <label>FECHA DE NOTIFICACIÓN DEL PIET</label>
                        <input type="text" id="fecha_piet"  class="form-control datepicker2" required />
                    </div> 
                    <div class="col-lg-6 col-md-12">
                        <label>ACTO ADMINISTRATIVO REALIZADO PARA LA EJECUCIÓN TRIBUTARIA</label>
                        <input type="text" id="acto_ejecucion_tributaria"  class="form-control" required />
                    </div> 
                    <div class="col-lg-6 col-md-12">
                        <label>FECHA DE NOTIFICACIÓN </label>
                        <input type="text" id="fecha_notificacion"  class="form-control datepicker2" required />
                    </div> 
                    <div class="col-lg-6 col-md-12">
                        <label>CANCELACIÓN DE DETERMINACIÓN TRIBUTARIA</label>
                        <input type="text" id="cancelacion_determinacion_tributaria"  class="form-control" required />
                    </div> 
                    <div class="col-lg-6 col-md-12">
                        <label>N° DE AUTO DE CONCLUSIÓN DEL PROCESO</label>
                        <input type="text" id="auto_conclusion"  class="form-control" required />
                    </div> 
                    <div class="col-lg-6 col-md-12">
                        <label>CIERRE DEFINITIVO DEL PROCESO DE FISCALIZACIÓN </label>
                        <input type="text" id="cierre_definitivo_proceso"  class="form-control" required />
                    </div> 
                    <div class="col-lg-6 col-md-12">
                        <label>DOCUMENTO DE RESPALDO</label>
                        <input class="form-control" type="file" id="path_archivo" accept=".pdf">
                    </div> 
                </div>  


                <div class="col-md-12">
                    <label>Observaciones</label>
                    <textarea cols="15" rows="4" class="form-control" id='observaciones'></textarea>
                </div>
                <hr>
                <div style="color:red;font-size:0.8rem;">
                * Todos son campos obligatorios
                </div>
            </div>
            `;

        $.confirm({
            title: titulo + " proceso:",
            type: "dark",
            content: content_,
            columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",

            onContentReady: function() {
                $(".datepicker2").flatpickr({
                    dateFormat: "Y-m-d",
                    appendTo: document.body,
                    static: false,
                    position: 'auto',
                    onReady: function(selectedDates, dateStr, instance) {
                        instance.calendarContainer.classList.add('high-z-calendar');
                        document.body.appendChild(instance.calendarContainer);
                        instance.calendarContainer.style.position = 'fixed';
                    }
                });

                const style = document.createElement('style');
                style.textContent = `
                    .jconfirm-content {
                        overflow: visible !important;
                    }
                    .high-z-calendar {
                        z-index: 99999999 !important;
                        position: fixed !important;
                    }
                    .flatpickr-calendar {
                        z-index: 99999999 !important;
                    }
                    .flatpickr-calendar.open {
                        display: inline-block !important;
                        z-index: 99999999 !important;
                        overflow: visible !important;
                    } 
                    /* Asegurar que el calendario no sea cortado */
                    .flatpickr-calendar.arrowTop:before,
                    .flatpickr-calendar.arrowTop:after {
                        display: none;
                    }
                `;
                document.head.appendChild(style);
            },
            buttons: {
                formSubmit: {
                    text: "Registrar",
                    btnClass: "btn-blue",
                    action: function() {
                        var errores = [];
                        if ($("#idrubro").val().trim() === "") {
                            errores.push("• Debe seleccionar un rubro.");
                        }
                        var formSubmitButton = this.buttons.formSubmit;
                        var formData = new FormData();

                        var fileInput = $('#path_archivo')[0];
                        var errores = [];
                        if (fileInput.files.length > 0) {
                            formData.append('path_archivo', fileInput.files[0]);
                        } else {
                            errores.push("• Tiene que agregar un documento adjunto en PDF");

                        }
                        formData.append('campos_numero_tributario', $('#numero_tributario').val());
                        formData.append('campos_idrubro', $('#idrubro').val());
                        formData.append('campos_idproceso', idproceso);
                        formData.append('campos_resolucion_determinativa', $('#resolucion_determinativa').val());
                        formData.append('campos_gestion_fiscal', $('#gestion_fiscal').val());
                        formData.append('campos_piet', $('#piet').val());
                        formData.append('campos_fecha_piet', $('#fecha_piet').val());
                        formData.append('campos_acto_ejecucion_tributaria', $('#acto_ejecucion_tributaria').val());
                        formData.append('campos_fecha_notificacion', $('#fecha_notificacion').val());
                        formData.append('campos_cancelacion_determinacion_tributaria', $('#cancelacion_determinacion_tributaria').val());
                        formData.append('campos_auto_conclusion', $('#auto_conclusion').val());
                        formData.append('campos_cierre_definitivo_proceso', $('#cierre_definitivo_proceso').val());
                        formData.append('campos_observaciones', $('#observaciones').val());
                        if (errores.length > 0) {
                            $.confirm({
                                title: 'Validación de campos',
                                content: errores.join("<br>"),
                                type: 'red',
                                buttons: {
                                    ok: function() {}
                                }
                            });
                            return false;
                        }
                        formData.forEach((value, key) => {
                            console.log(key, value);
                        });
                        $.ajax({
                            async: true,
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            url: "../php/regeditProcesoUaj.php",
                            beforeSend: function() {
                                formSubmitButton.setText('Procesando...');
                                formSubmitButton.disable();
                                loadGralOn();
                            },
                            success: function(e) {
                                console.log(e);
                                loadGralOff();
                                window.location.href = './archProcesosUaj.php';
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