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
            border-left: 4px solid #05b0f3ff;
        }

        .form-section h5 {
            color: #0095daff;
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
                    <a class="btn btn-info text-white" href="#" role="button" onclick="exportarF1()"><span style="font-size: 8px;">F1</span> <i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                </div>
                <div class="col-md-1 mb-3">
                    <a class="btn btn-warning text-white" href="#" role="button" onclick="exportarF2()"><span style="font-size: 8px;">F2</span> <i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                </div>
                <div class="col-md-1 mb-3">
                    <a class="btn btn-primary text-white" href="#" role="button" onclick="exportarF3()"><span style="font-size: 8px;">F3</span> <i class="fa fa-file-text-o" aria-hidden="true"></i></a>
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

    <!-- Removed Bootstrap modals, now using $.confirm -->

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
    let modalRegistroInstance = null;

    $(document).ready(function() {
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
        console.log('[v0] Cargando áreas...');
        $.ajax({
            type: 'POST',
            url: '../php/pisleaGetAreas.php',
            success: function(response) {
                console.log('[v0] Áreas recibidas:', response);
                let select = $('#idarea');
                console.log('[v0] Select encontrado:', select.length);
                select.empty();
                select.append('<option value="">Seleccione un área</option>');
                $.each(response, function(index, item) {
                    select.append(`<option value="${item.idarea}">${item.unidad} - ${item.area}</option>`);
                });
                console.log('[v0] Áreas cargadas exitosamente');
            },
            error: function(xhr, status, error) {
                console.error('[v0] Error al cargar áreas:', error);
            }
        });
    }

    function cargarUnidades() {
        $.ajax({
            type: 'POST',
            url: '../php/pisleaGetUnidades.php',
            success: function(response) {
                let select = $('#filtroUnidad');
                select.empty();
                select.append('<option value="">Todas las unidades</option>');
                $.each(response, function(index, item) {
                    select.append(`<option value="${item.idunidad}">${item.unidad}</option>`);
                });
            }
        });
    }

    function abrirModalRegistro() {
        equipoIndex = 1;
        softwareIndex = 1;
        
        modalRegistroInstance = $.confirm({
            title: '<i class="fa fa-user-plus"></i> Registro de Funcionario',
            columnClass: 'col-md-12',
            content: generarFormularioHTML(),
            onContentReady: function() {
                console.log('[v0] Modal renderizado, cargando áreas...');
                cargarAreas();
            },
            buttons: {
                guardar: {
                    text: '<i class="fa fa-save"></i> Guardar',
                    btnClass: 'btn-primary',
                    action: function() {
                        guardarFuncionario();
                        return false; // Prevent modal from closing
                    }
                },
                cancelar: {
                    text: 'Cancelar',
                    btnClass: 'btn-secondary'
                }
            }
        });
    }

    function generarFormularioHTML(datos = null) {
        return `
            <form id="formFuncionario" style="max-height: 70vh; overflow-y: auto;">
                <input type="hidden" id="idfuncionario" name="idfuncionario" value="${datos?.funcionario?.idfuncionario || ''}">
                
                <!-- Sección Datos del Funcionario -->
                <div class="form-section">
                    <h5><i class="fa fa-user"></i> Datos del Funcionario</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nombres <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nombres" name="nombres" value="${datos?.funcionario?.nombres || ''}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Apellido Paterno <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" value="${datos?.funcionario?.apellido_paterno || ''}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Apellido Materno</label>
                                <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" value="${datos?.funcionario?.apellido_materno || ''}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Contacto <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="contacto" name="contacto" value="${datos?.funcionario?.contacto || ''}" required>
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
                                <label>Nivel de Conocimiento PISLEA</label>
                                <select class="form-control" id="idnivel_know" name="idnivel_know">
                                    <option value="">Seleccione nivel</option>
                                    <option value="1" ${datos?.funcionario?.idnivel_know == 1 ? 'selected' : ''}>NINGUNO</option>
                                    <option value="2" ${datos?.funcionario?.idnivel_know == 2 ? 'selected' : ''}>BÁSICO</option>
                                    <option value="3" ${datos?.funcionario?.idnivel_know == 3 ? 'selected' : ''}>MEDIO</option>
                                    <option value="4" ${datos?.funcionario?.idnivel_know == 4 ? 'selected' : ''}>ALTO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección Equipos -->
                <div class="form-section">
                    <h5><i class="fa fa-desktop"></i> Equipos Asignados</h5>
                    <div id="equiposContainer">
                        ${generarEquipoHTML(0, datos?.equipos?.[0])}
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-add-more" onclick="agregarEquipo()">
                        <i class="fa fa-plus"></i> Agregar Otro Equipo
                    </button>
                </div>

                <!-- Sección Software -->
                <div class="form-section">
                    <h5><i class="fa fa-code"></i> Software Asignado</h5>
                    <div id="softwareContainer">
                        ${generarSoftwareHTML(0, datos?.software?.[0])}
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-add-more" onclick="agregarSoftware()">
                        <i class="fa fa-plus"></i> Agregar Otro Software
                    </button>
                </div>
            </form>
        `;
    }

    function generarEquipoHTML(index, equipo = null) {
        return `
            <div class="dynamic-item equipo-item" data-index="${index}">
                ${equipo?.idequipo ? `<input type="hidden" name="equipos[${index}][idequipo]" value="${equipo.idequipo}">` : ''}
                <button type="button" class="btn btn-sm btn-danger btn-remove-item" onclick="removerEquipo(${index})" style="${index === 0 ? 'display:none;' : ''}">
                    <i class="fa fa-times"></i>
                </button>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sistema Operativo</label>
                            <select class="form-control" name="equipos[${index}][sistema_operativo]">
                                <option value="">Seleccione</option>
                                <option value="WINDOWS 7" ${equipo?.sistema_operativo === 'WINDOWS 7' ? 'selected' : ''}>WINDOWS 7</option>
                                <option value="WINDOWS 8" ${equipo?.sistema_operativo === 'WINDOWS 8' ? 'selected' : ''}>WINDOWS 8</option>
                                <option value="WINDOWS 10" ${equipo?.sistema_operativo === 'WINDOWS 10' ? 'selected' : ''}>WINDOWS 10</option>
                                <option value="WINDOWS 11" ${equipo?.sistema_operativo === 'WINDOWS 11' ? 'selected' : ''}>WINDOWS 11</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Ofimática</label>
                            <select class="form-control" name="equipos[${index}][ofimatica]">
                                <option value="">Seleccione</option>
                                <option value="MICROSOFT OFFICE" ${equipo?.ofimatica === 'MICROSOFT OFFICE' ? 'selected' : ''}>MICROSOFT OFFICE</option>
                                <option value="LIBRE OFFICE" ${equipo?.ofimatica === 'LIBRE OFFICE' ? 'selected' : ''}>LIBRE OFFICE</option>
                                <option value="WPS" ${equipo?.ofimatica === 'WPS' ? 'selected' : ''}>WPS</option>
                                <option value="OTRO" ${equipo?.ofimatica === 'OTRO' ? 'selected' : ''}>OTRO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>MAC Address</label>
                            <input type="text" class="form-control" name="equipos[${index}][mac_address]" value="${equipo?.mac_address || ''}" placeholder="00:00:00:00:00:00">
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    function generarSoftwareHTML(index, software = null) {
        return `
            <div class="dynamic-item software-item" data-index="${index}">
                ${software?.idsoftware ? `<input type="hidden" name="software[${index}][idsoftware]" value="${software.idsoftware}">` : ''}
                <button type="button" class="btn btn-sm btn-danger btn-remove-item" onclick="removerSoftware(${index})" style="${index === 0 ? 'display:none;' : ''}">
                    <i class="fa fa-times"></i>
                </button>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombre del Software</label>
                            <input type="text" class="form-control" name="software[${index}][nombre_software]" value="${software?.nombre_software || ''}" placeholder="L335PrinterDriver">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fabricante/Proveedor</label>
                            <input type="text" class="form-control" name="software[${index}][fabricante_proveedor]" value="${software?.fabricante_proveedor || ''}" placeholder="EPSON">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Hardware Asociado</label>
                            <input type="text" class="form-control" name="software[${index}][hardware_asociado]" value="${software?.hardware_asociado || ''}" placeholder="IMPRESORA MULTIFUNCIONAL">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Uso Específico</label>
                            <input type="text" class="form-control" name="software[${index}][uso_especifico]" value="${software?.uso_especifico || ''}" placeholder="Impresión y escaneo de documentos">
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    function agregarEquipo() {
        let html = generarEquipoHTML(equipoIndex);
        $('#equiposContainer').append(html);
        equipoIndex++;
        actualizarBotonesRemover();
    }

    function removerEquipo(index) {
        $(`.equipo-item[data-index="${index}"]`).remove();
        actualizarBotonesRemover();
    }

    function agregarSoftware() {
        let html = generarSoftwareHTML(softwareIndex);
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
                if (response.status === 'success') {
                    $.alert({
                        title: 'Éxito',
                        content: response.message,
                        type: 'green',
                        buttons: {
                            ok: {
                                text: 'Aceptar',
                                btnClass: 'btn-success',
                                action: function() {
                                    if (modalRegistroInstance) {
                                        modalRegistroInstance.close();
                                    }
                                    getFuncionarios();
                                }
                            }
                        }
                    });
                } else {
                    $.alert({
                        title: 'Error',
                        content: response.message,
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
            data: { idfuncionario: idfuncionario, modo: 'editar' },
            beforeSend: function() {
                loadGralOn();
            },
            success: function(response) {
                loadGralOff();
                
                // Reset indexes based on loaded data
                equipoIndex = response.equipos.length || 1;
                softwareIndex = response.software.length || 1;
                
                modalRegistroInstance = $.confirm({
                    title: '<i class="fa fa-edit"></i> Editar Funcionario',
                    columnClass: 'col-md-12',
                    content: generarFormularioHTML(response),
                    onContentReady: function() {
                        $.ajax({
                            type: 'POST',
                            url: '../php/pisleaGetAreas.php',
                            success: function(areasResponse) {
                                let select = $('#idarea');
                                select.empty();
                                select.append('<option value="">Seleccione un área</option>');
                                $.each(areasResponse, function(index, item) {
                                    let selected = item.idarea == response.funcionario.idarea ? 'selected' : '';
                                    select.append(`<option value="${item.idarea}" ${selected}>${item.unidad} - ${item.area}</option>`);
                                });
                            }
                        });
                        
                        // Load additional equipment items
                        if (response.equipos.length > 1) {
                            for (let i = 1; i < response.equipos.length; i++) {
                                $('#equiposContainer').append(generarEquipoHTML(i, response.equipos[i]));
                            }
                        }
                        
                        // Load additional software items
                        if (response.software.length > 1) {
                            for (let i = 1; i < response.software.length; i++) {
                                $('#softwareContainer').append(generarSoftwareHTML(i, response.software[i]));
                            }
                        }
                        
                        actualizarBotonesRemover();
                    },
                    buttons: {
                        guardar: {
                            text: '<i class="fa fa-save"></i> Guardar',
                            btnClass: 'btn-primary',
                            action: function() {
                                guardarFuncionario();
                                return false;
                            }
                        },
                        cancelar: {
                            text: 'Cancelar',
                            btnClass: 'btn-secondary'
                        }
                    }
                });
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
            data: { idfuncionario: idfuncionario, modo: 'ver' },
            beforeSend: function() {
                loadGralOn();
            },
            success: function(response) {
                loadGralOff();
                
                let html = `
                    <div class="containerDetalleSolicitud" style="max-height: 70vh; overflow-y: auto;">
                        <div class="form-section">
                            <h5><i class="fa fa-user"></i> Información del Funcionario</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Nombre Completo:</strong> ${response.funcionario.nombres} ${response.funcionario.apellido_paterno} ${response.funcionario.apellido_materno || ''}</p>
                                    <p><strong>Contacto:</strong> ${response.funcionario.contacto}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Unidad - Área:</strong> ${response.funcionario.unidad} - ${response.funcionario.area}</p>
                                    <p><strong>Nivel de Conocimiento:</strong> ${response.funcionario.nivel || 'No especificado'}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h5><i class="fa fa-desktop"></i> Equipos Asignados (${response.equipos.length})</h5>
                            ${response.equipos.length > 0 ? `
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sistema Operativo</th>
                                            <th>Ofimática</th>
                                            <th>MAC Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${response.equipos.map(eq => `
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
                            <h5><i class="fa fa-code"></i> Software Asignado (${response.software.length})</h5>
                            ${response.software.length > 0 ? `
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
                                        ${response.software.map(sw => `
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
                
                $.confirm({
                    title: '<i class="fa fa-info-circle"></i> Detalle del Funcionario',
                    columnClass: 'col-md-12',
                    content: html,
                    buttons: {
                        cerrar: {
                            text: 'Cerrar',
                            btnClass: 'btn-secondary'
                        }
                    }
                });
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
