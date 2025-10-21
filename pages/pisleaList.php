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
    <title>PISLEA DATM - GESTIÓN DE FUNCIONARIOS</title>
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
            border-radius: 10px;
            padding: 1rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .headerDetalleSolicitud {
            display: flex;
            justify-content: space-between;
            border: 1px solid #fff;
            border-radius: 5px;
        }

        .headerDetalleSolicitud p {
            margin: 5px 0;
        }

        .modal-xl {
            max-width: 90%;
        }

        .form-section {
            background: #f8f9fa;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            border-left: 4px solid #007bff;
        }

        .form-section h5 {
            color: #007bff;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .dynamic-item {
            background: white;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #dee2e6;
            position: relative;
        }

        .btn-remove-item {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .btn-add-more {
            width: 100%;
            border-style: dashed;
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
    <li class="breadcrumb-item"><a class="text-white">PISLEA DATM</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page"> <a class="text-white" href="#">GESTIÓN DE FUNCIONARIOS</a></li>

    <?php
    echo $twig->render('prebodyltFin.twig');
    ?>
    <!-- Hero End -->

    <!-- About Start -->
    <div class="contenedorDigitaliza">
        <div class="form-group d-flex flex-column flex-md-row">
            <div class="row">
                <div class="col-md-1 mb-3">
                    <a class="btn btn-success" href="#" role="button" onclick="abrirModalRegistro()"><i class="fa fa-plus"></i></a>
                </div>
                <div class="col-md-1 mb-3">
                    <a class="btn btn-info text-white" href="#" role="button" onclick="exportarF1()">F1 <i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                </div>
                <div class="col-md-1 mb-3">
                    <a class="btn btn-warning text-white" href="#" role="button" onclick="exportarF2()">F2 <i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                </div>
                <div class="col-md-1 mb-3">
                    <a class="btn btn-primary text-white" href="#" role="button" onclick="exportarF3()">F3 <i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                </div>
                <div class="col-md-4 mb-3">
                    <input type="text" class="form-control" value="" id="filtroNombre" placeholder="Buscar por nombre">
                </div>
                <div class="col-md-3 mb-3">
                    <select class="form-control" id="filtroUnidad">
                        <option value="">Todas las unidades</option>
                    </select>
                </div>
                <div class="col-md-1 mb-3">
                    <button class="btn btn-primary" onclick="getFuncionarios()">Consultar</button>
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
                data-sort-name="idfuncionario"
                data-sort-order="desc"
                data-show-refresh="true"
                data-url="../php/pisleaGetFuncionarios.php"
                data-query-params="filtrosDataTable">
                <thead>
                    <th data-field="idfuncionario" data-sortable="true">ID</th>
                    <th data-field="nombre_completo" data-sortable="true">Nombre Completo</th>
                    <th data-field="contacto" data-sortable="true">Contacto</th>
                    <th data-field="unidad_area" data-sortable="true">Unidad - Área</th>
                    <th data-field="acciones">Acciones</th>
                </thead>
                <tbody id="tbodyItems">
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Registro/Edición -->
    <div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="modalRegistroLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalRegistroLabel">Registro de Funcionario</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formFuncionario">
                        <input type="hidden" id="idfuncionario" name="idfuncionario">

                        <!-- Sección Datos del Funcionario -->
                        <div class="form-section">
                            <h5><i class="fa fa-user"></i> Datos del Funcionario</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nombres <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nombres" name="nombres" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Apellido Paterno <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Apellido Materno</label>
                                        <input type="text" class="form-control" id="apellido_materno" name="apellido_materno">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Contacto <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="contacto" name="contacto" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Área <span class="text-danger">*</span></label>
                                        <select class="form-control" id="idarea" name="idarea" required>
                                            <option value="">Seleccione un área</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nivel de Conocimiento</label>
                                        <select class="form-control" id="idnivel_know" name="idnivel_know">
                                            <option value="">Seleccione nivel</option>
                                            <option value="1">NINGUNO</option>
                                            <option value="2">BÁSICO</option>
                                            <option value="3">MEDIO</option>
                                            <option value="4">ALTO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sección Equipos -->
                        <div class="form-section">
                            <h5><i class="fa fa-desktop"></i> Equipos Asignados</h5>
                            <div id="equiposContainer">
                                <div class="dynamic-item equipo-item" data-index="0">
                                    <button type="button" class="btn btn-sm btn-danger btn-remove-item" onclick="removerEquipo(0)" style="display:none;">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Sistema Operativo</label>
                                                <select class="form-control" name="equipos[0][sistema_operativo]">
                                                    <option value="">Seleccione</option>
                                                    <option value="WINDOWS 7">WINDOWS 7</option>
                                                    <option value="WINDOWS 8">WINDOWS 8</option>
                                                    <option value="WINDOWS 10">WINDOWS 10</option>
                                                    <option value="WINDOWS 11">WINDOWS 11</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Ofimática</label>
                                                <select class="form-control" name="equipos[0][ofimatica]">
                                                    <option value="">Seleccione</option>
                                                    <option value="MICROSOFT OFFICE">MICROSOFT OFFICE</option>
                                                    <option value="LIBRE OFFICE">LIBRE OFFICE</option>
                                                    <option value="WPS">WPS</option>
                                                    <option value="OTRO">OTRO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>MAC Address</label>
                                                <input type="text" class="form-control" name="equipos[0][mac_address]" placeholder="00:00:00:00:00:00">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-add-more" onclick="agregarEquipo()">
                                <i class="fa fa-plus"></i> Agregar Otro Equipo
                            </button>
                        </div>

                        <!-- Sección Software -->
                        <div class="form-section">
                            <h5><i class="fa fa-code"></i> Software Asignado</h5>
                            <div id="softwareContainer">
                                <div class="dynamic-item software-item" data-index="0">
                                    <button type="button" class="btn btn-sm btn-danger btn-remove-item" onclick="removerSoftware(0)" style="display:none;">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nombre del Software</label>
                                                <input type="text" class="form-control" name="software[0][nombre_software]" placeholder="L335PrinterDriver">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Fabricante/Proveedor</label>
                                                <input type="text" class="form-control" name="software[0][fabricante_proveedor]" placeholder="EPSON">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Hardware Asociado</label>
                                                <input type="text" class="form-control" name="software[0][hardware_asociado]" placeholder="IMPRESORA MULTIFUNCIONAL">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Uso Específico</label>
                                                <input type="text" class="form-control" name="software[0][uso_especifico]" placeholder="Impresión y escaneo de documentos">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-add-more" onclick="agregarSoftware()">
                                <i class="fa fa-plus"></i> Agregar Otro Software
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="guardarFuncionario()">
                        <i class="fa fa-save"></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detalle -->
    <div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="modalDetalleLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="modalDetalleLabel">Detalle del Funcionario</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="detalleContent">
                    <!-- Contenido dinámico -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
<script src="../js/mainRecursoIa.js"></script>
<script src="../vendor/bootstrap-table-master/dist/bootstrap-table.min.js"></script>
<script src="../vendor/bootstrap-table-master/dist/extensions/export/bootstrap-table-export.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF/jspdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    let equipoIndex = 1;
    let softwareIndex = 1;

    $(document).ready(function() {
        cargarAreas();
        cargarUnidades();
    });

    function filtrosDataTable(p) {
        return {
            filtroNombre: $('#filtroNombre').val(),
            filtroUnidad: $('#filtroUnidad').val(),
            offset: p.offset,
            limit: p.limit,
            sort: p.sort,
            order: p.order,
            search: p.search
        }
    }

    function getFuncionarios() {
        $('#tableCompendio').bootstrapTable('refresh');
    }

    function cargarAreas() {
        $.ajax({
            type: 'POST',
            url: '../php/pisleaGetAreas.php',
            success: function(response) {
                console.log(response)
                let data = JSON.parse(response);
                let select = $('#idarea');
                select.empty();
                select.append('<option value="">Seleccione un área</option>');
                $.each(data, function(index, item) {
                    select.append(`<option value="${item.idarea}">${item.unidad} - ${item.area}</option>`);
                });
            }
        });
    }

    function cargarUnidades() {
        $.ajax({
            type: 'POST',
            url: '../php/pisleaGetUnidades.php',
            success: function(response) {
                let data = JSON.parse(response);
                let select = $('#filtroUnidad');
                select.empty();
                select.append('<option value="">Todas las unidades</option>');
                $.each(data, function(index, item) {
                    select.append(`<option value="${item.idunidad}">${item.unidad}</option>`);
                });
            }
        });
    }

    function abrirModalRegistro() {
        $('#modalRegistroLabel').text('Registro de Funcionario');
        $('#formFuncionario')[0].reset();
        $('#idfuncionario').val('');

        // Reset equipos
        $('#equiposContainer').html(`
            <div class="dynamic-item equipo-item" data-index="0">
                <button type="button" class="btn btn-sm btn-danger btn-remove-item" onclick="removerEquipo(0)" style="display:none;">
                    <i class="fa fa-times"></i>
                </button>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sistema Operativo</label>
                            <select class="form-control" name="equipos[0][sistema_operativo]">
                                <option value="">Seleccione</option>
                                <option value="WINDOWS 7">WINDOWS 7</option>
                                <option value="WINDOWS 8">WINDOWS 8</option>
                                <option value="WINDOWS 10">WINDOWS 10</option>
                                <option value="WINDOWS 11">WINDOWS 11</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Ofimática</label>
                            <select class="form-control" name="equipos[0][ofimatica]">
                                <option value="">Seleccione</option>
                                <option value="MICROSOFT OFFICE">MICROSOFT OFFICE</option>
                                <option value="LIBRE OFFICE">LIBRE OFFICE</option>
                                <option value="WPS">WPS</option>
                                <option value="OTRO">OTRO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>MAC Address</label>
                            <input type="text" class="form-control" name="equipos[0][mac_address]" placeholder="00:00:00:00:00:00">
                        </div>
                    </div>
                </div>
            </div>
        `);

        // Reset software
        $('#softwareContainer').html(`
            <div class="dynamic-item software-item" data-index="0">
                <button type="button" class="btn btn-sm btn-danger btn-remove-item" onclick="removerSoftware(0)" style="display:none;">
                    <i class="fa fa-times"></i>
                </button>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombre del Software</label>
                            <input type="text" class="form-control" name="software[0][nombre_software]" placeholder="L335PrinterDriver">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fabricante/Proveedor</label>
                            <input type="text" class="form-control" name="software[0][fabricante_proveedor]" placeholder="EPSON">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Hardware Asociado</label>
                            <input type="text" class="form-control" name="software[0][hardware_asociado]" placeholder="IMPRESORA MULTIFUNCIONAL">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Uso Específico</label>
                            <input type="text" class="form-control" name="software[0][uso_especifico]" placeholder="Impresión y escaneo de documentos">
                        </div>
                    </div>
                </div>
            </div>
        `);

        equipoIndex = 1;
        softwareIndex = 1;

        $('#modalRegistro').modal('show');
    }

    function agregarEquipo() {
        let html = `
            <div class="dynamic-item equipo-item" data-index="${equipoIndex}">
                <button type="button" class="btn btn-sm btn-danger btn-remove-item" onclick="removerEquipo(${equipoIndex})">
                    <i class="fa fa-times"></i>
                </button>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sistema Operativo</label>
                            <select class="form-control" name="equipos[${equipoIndex}][sistema_operativo]">
                                <option value="">Seleccione</option>
                                <option value="WINDOWS 7">WINDOWS 7</option>
                                <option value="WINDOWS 8">WINDOWS 8</option>
                                <option value="WINDOWS 10">WINDOWS 10</option>
                                <option value="WINDOWS 11">WINDOWS 11</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Ofimática</label>
                            <select class="form-control" name="equipos[${equipoIndex}][ofimatica]">
                                <option value="">Seleccione</option>
                                <option value="MICROSOFT OFFICE">MICROSOFT OFFICE</option>
                                <option value="LIBRE OFFICE">LIBRE OFFICE</option>
                                <option value="WPS">WPS</option>
                                <option value="OTRO">OTRO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>MAC Address</label>
                            <input type="text" class="form-control" name="equipos[${equipoIndex}][mac_address]" placeholder="00:00:00:00:00:00">
                        </div>
                    </div>
                </div>
            </div>
        `;
        $('#equiposContainer').append(html);
        equipoIndex++;
        actualizarBotonesRemover();
    }

    function removerEquipo(index) {
        $(`.equipo-item[data-index="${index}"]`).remove();
        actualizarBotonesRemover();
    }

    function agregarSoftware() {
        let html = `
            <div class="dynamic-item software-item" data-index="${softwareIndex}">
                <button type="button" class="btn btn-sm btn-danger btn-remove-item" onclick="removerSoftware(${softwareIndex})">
                    <i class="fa fa-times"></i>
                </button>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombre del Software</label>
                            <input type="text" class="form-control" name="software[${softwareIndex}][nombre_software]" placeholder="L335PrinterDriver">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fabricante/Proveedor</label>
                            <input type="text" class="form-control" name="software[${softwareIndex}][fabricante_proveedor]" placeholder="EPSON">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Hardware Asociado</label>
                            <input type="text" class="form-control" name="software[${softwareIndex}][hardware_asociado]" placeholder="IMPRESORA MULTIFUNCIONAL">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Uso Específico</label>
                            <input type="text" class="form-control" name="software[${softwareIndex}][uso_especifico]" placeholder="Impresión y escaneo de documentos">
                        </div>
                    </div>
                </div>
            </div>
        `;
        $('#softwareContainer').append(html);
        softwareIndex++;
        actualizarBotonesRemover();
    }

    function removerSoftware(index) {
        $(`.software-item[data-index="${index}"]`).remove();
        actualizarBotonesRemover();
    }

    function actualizarBotonesRemover() {
        // Mostrar botones de remover solo si hay más de un item
        if ($('.equipo-item').length > 1) {
            $('.equipo-item .btn-remove-item').show();
        } else {
            $('.equipo-item .btn-remove-item').hide();
        }

        if ($('.software-item').length > 1) {
            $('.software-item .btn-remove-item').show();
        } else {
            $('.software-item .btn-remove-item').hide();
        }
    }

    function guardarFuncionario() {
        let formData = new FormData($('#formFuncionario')[0]);

        $.ajax({
            type: 'POST',
            url: '../php/pisleaSaveFuncionario.php',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                loadGralOn();
            },
            success: function(response) {
                loadGralOff();
                let data = JSON.parse(response);
                if (data.status === 'success') {
                    $.alert({
                        title: 'Éxito',
                        content: data.message,
                        type: 'green',
                        buttons: {
                            ok: {
                                text: 'Aceptar',
                                btnClass: 'btn-success',
                                action: function() {
                                    $('#modalRegistro').modal('hide');
                                    getFuncionarios();
                                }
                            }
                        }
                    });
                } else {
                    $.alert({
                        title: 'Error',
                        content: data.message,
                        type: 'red'
                    });
                }
            },
            error: function() {
                loadGralOff();
                $.alert({
                    title: 'Error',
                    content: 'Error al procesar la solicitud',
                    type: 'red'
                });
            }
        });
    }

    function editarFuncionario(idfuncionario) {
        $.ajax({
            type: 'POST',
            url: '../php/pisleaGetDetalle.php',
            data: {
                idfuncionario: idfuncionario,
                modo: 'editar'
            },
            beforeSend: function() {
                loadGralOn();
            },
            success: function(response) {
                loadGralOff();
                let data = JSON.parse(response);

                $('#modalRegistroLabel').text('Editar Funcionario');
                $('#idfuncionario').val(data.funcionario.idfuncionario);
                $('#nombres').val(data.funcionario.nombres);
                $('#apellido_paterno').val(data.funcionario.apellido_paterno);
                $('#apellido_materno').val(data.funcionario.apellido_materno);
                $('#contacto').val(data.funcionario.contacto);
                $('#idarea').val(data.funcionario.idarea);
                $('#idnivel_know').val(data.funcionario.idnivel_know);

                // Cargar equipos
                $('#equiposContainer').empty();
                if (data.equipos.length > 0) {
                    $.each(data.equipos, function(index, equipo) {
                        let html = `
                            <div class="dynamic-item equipo-item" data-index="${index}">
                                <input type="hidden" name="equipos[${index}][idequipo]" value="${equipo.idequipo}">
                                <button type="button" class="btn btn-sm btn-danger btn-remove-item" onclick="removerEquipo(${index})" ${index === 0 ? 'style="display:none;"' : ''}>
                                    <i class="fa fa-times"></i>
                                </button>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Sistema Operativo</label>
                                            <select class="form-control" name="equipos[${index}][sistema_operativo]">
                                                <option value="">Seleccione</option>
                                                <option value="WINDOWS 7" ${equipo.sistema_operativo === 'WINDOWS 7' ? 'selected' : ''}>WINDOWS 7</option>
                                                <option value="WINDOWS 8" ${equipo.sistema_operativo === 'WINDOWS 8' ? 'selected' : ''}>WINDOWS 8</option>
                                                <option value="WINDOWS 10" ${equipo.sistema_operativo === 'WINDOWS 10' ? 'selected' : ''}>WINDOWS 10</option>
                                                <option value="WINDOWS 11" ${equipo.sistema_operativo === 'WINDOWS 11' ? 'selected' : ''}>WINDOWS 11</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ofimática</label>
                                            <select class="form-control" name="equipos[${index}][ofimatica]">
                                                <option value="">Seleccione</option>
                                                <option value="MICROSOFT OFFICE" ${equipo.ofimatica === 'MICROSOFT OFFICE' ? 'selected' : ''}>MICROSOFT OFFICE</option>
                                                <option value="LIBRE OFFICE" ${equipo.ofimatica === 'LIBRE OFFICE' ? 'selected' : ''}>LIBRE OFFICE</option>
                                                <option value="WPS" ${equipo.ofimatica === 'WPS' ? 'selected' : ''}>WPS</option>
                                                <option value="OTRO" ${equipo.ofimatica === 'OTRO' ? 'selected' : ''}>OTRO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>MAC Address</label>
                                            <input type="text" class="form-control" name="equipos[${index}][mac_address]" value="${equipo.mac_address || ''}" placeholder="00:00:00:00:00:00">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        $('#equiposContainer').append(html);
                    });
                    equipoIndex = data.equipos.length;
                }

                // Cargar software
                $('#softwareContainer').empty();
                if (data.software.length > 0) {
                    $.each(data.software, function(index, soft) {
                        let html = `
                            <div class="dynamic-item software-item" data-index="${index}">
                                <input type="hidden" name="software[${index}][idsoftware]" value="${soft.idsoftware}">
                                <button type="button" class="btn btn-sm btn-danger btn-remove-item" onclick="removerSoftware(${index})" ${index === 0 ? 'style="display:none;"' : ''}>
                                    <i class="fa fa-times"></i>
                                </button>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nombre del Software</label>
                                            <input type="text" class="form-control" name="software[${index}][nombre_software]" value="${soft.nombre_software || ''}" placeholder="L335PrinterDriver">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Fabricante/Proveedor</label>
                                            <input type="text" class="form-control" name="software[${index}][fabricante_proveedor]" value="${soft.fabricante_proveedor || ''}" placeholder="EPSON">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Hardware Asociado</label>
                                            <input type="text" class="form-control" name="software[${index}][hardware_asociado]" value="${soft.hardware_asociado || ''}" placeholder="IMPRESORA MULTIFUNCIONAL">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Uso Específico</label>
                                            <input type="text" class="form-control" name="software[${index}][uso_especifico]" value="${soft.uso_especifico || ''}" placeholder="Impresión y escaneo de documentos">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        $('#softwareContainer').append(html);
                    });
                    softwareIndex = data.software.length;
                }

                actualizarBotonesRemover();
                $('#modalRegistro').modal('show');
            },
            error: function() {
                loadGralOff();
                $.alert({
                    title: 'Error',
                    content: 'Error al cargar los datos',
                    type: 'red'
                });
            }
        });
    }

    function verDetalle(idfuncionario) {
        $.ajax({
            type: 'POST',
            url: '../php/pisleaGetDetalle.php',
            data: {
                idfuncionario: idfuncionario,
                modo: 'ver'
            },
            beforeSend: function() {
                loadGralOn();
            },
            success: function(response) {
                loadGralOff();
                let data = JSON.parse(response);

                let html = `
                    <div class="containerDetalleSolicitud">
                        <div class="form-section">
                            <h5><i class="fa fa-user"></i> Información del Funcionario</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Nombre Completo:</strong> ${data.funcionario.nombres} ${data.funcionario.apellido_paterno} ${data.funcionario.apellido_materno || ''}</p>
                                    <p><strong>Contacto:</strong> ${data.funcionario.contacto}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Unidad - Área:</strong> ${data.funcionario.unidad} - ${data.funcionario.area}</p>
                                    <p><strong>Nivel de Conocimiento:</strong> ${data.funcionario.nivel || 'No especificado'}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h5><i class="fa fa-desktop"></i> Equipos Asignados (${data.equipos.length})</h5>
                            ${data.equipos.length > 0 ? `
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sistema Operativo</th>
                                            <th>Ofimática</th>
                                            <th>MAC Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${data.equipos.map(eq => `
                                            <tr>
                                                <td>${eq.sistema_operativo || '-'}</td>
                                                <td>${eq.ofimatica || '-'}</td>
                                                <td>${eq.mac_address || '-'}</td>
                                            </tr>
                                        `).join('')}
                                    </tbody>
                                </table>
                            ` : '<p class="text-muted">No hay equipos registrados</p>'}
                        </div>
                        
                        <div class="form-section">
                            <h5><i class="fa fa-code"></i> Software Asignado (${data.software.length})</h5>
                            ${data.software.length > 0 ? `
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Fabricante</th>
                                            <th>Hardware Asociado</th>
                                            <th>Uso Específico</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${data.software.map(sw => `
                                            <tr>
                                                <td>${sw.nombre_software || '-'}</td>
                                                <td>${sw.fabricante_proveedor || '-'}</td>
                                                <td>${sw.hardware_asociado || '-'}</td>
                                                <td>${sw.uso_especifico || '-'}</td>
                                            </tr>
                                        `).join('')}
                                    </tbody>
                                </table>
                            ` : '<p class="text-muted">No hay software registrado</p>'}
                        </div>
                    </div>
                `;

                $('#detalleContent').html(html);
                $('#modalDetalle').modal('show');
            },
            error: function() {
                loadGralOff();
                $.alert({
                    title: 'Error',
                    content: 'Error al cargar el detalle',
                    type: 'red'
                });
            }
        });
    }

    function exportarF1() {
        window.open('../php/pisleaExportF1.php', '_blank');
    }

    function exportarF2() {
        window.open('../php/pisleaExportF2.php', '_blank');
    }

    function exportarF3() {
        window.open('../php/pisleaExportF3.php', '_blank');
    }
</script>

</html>