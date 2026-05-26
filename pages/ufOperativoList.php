<!DOCTYPE html>
<?php
session_start();
require_once '../vendor/autoload.php';

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('../views');
$twig = new Environment($loader);

if (!isset($_SESSION['swlogin']) || $_SESSION['swlogin'] != 1) {
    echo "<script>window.location.href = 'index.php';</script>";
    exit;
}
?>
<html lang="es">

<head>
    <title>Gestión de Operativos</title>
    <?php echo $twig->render('linkStyle.twig'); ?>
    <link href="../css/styleRecursoIa.css" rel="stylesheet">
    <link href="../vendor/bootstrap-table-master/dist/bootstrap-table.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body>
    <?php echo $twig->render('load.twig'); ?>
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

    <!-- Her Start -->
    <?php echo $twig->render('prebodyltIni.twig'); ?>
    <li class="breadcrumb-item"><a class="text-white" href="index.php">UFyR</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page">Gestión Operativos</li>
    <?php echo $twig->render('prebodyltFin.twig'); ?>
    <!-- Hero End -->

    <div class="contenedorDigitaliza">
        <div class="form-group d-flex flex-column flex-md-row mb-3">
             <div class="col-md-1">
                <button class="btn btn-success" onclick="formOperativo()" title="Nuevo Operativo"><i class="fa fa-plus"></i> Nuevo</button>
            </div>
        </div>

        <div>
            <table id="tableOperativos"
                data-toggle="table"
                data-search="true"
                data-show-toggle="true"
                data-show-columns="true"
                data-pagination="true"
                data-page-list="[10, 25, 50, 100, all]"
                data-locale="es-ES"
                data-sort-name="idoperativo"
                data-sort-order="desc"
                class="table table-striped"
                data-url="../php/getOperativos.php">
                <thead>
                    <tr>
                        <th data-field="idoperativo" data-sortable="true">ID</th>
                        <th data-field="operativo" data-sortable="true">Nombre Operativo</th>
                        <th data-field="fecha_operativo" data-sortable="true">Fecha</th>
                        <th data-formatter="actionFormatter">Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <?php echo $twig->render('linkJs.twig'); ?>
    <script src="../vendor/bootstrap-table-master/dist/bootstrap-table.min.js"></script>
    <script src="../vendor/bootstrap-table-master/dist/extensions/export/bootstrap-table-export.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        function actionFormatter(value, row, index) {
            return [
                '<a class="btn btn-info btn-sm me-1" href="ufOperativoAsignacion.php?id=' + row.idoperativo + '" title="Gestionar Grupos y Usuarios">',
                '<i class="fa fa-users"></i> Gestionar',
                '</a> ',
                '<a class="btn btn-warning btn-sm me-1" href="javascript:void(0)" onclick="formOperativo(' + row.idoperativo + ', \'' + row.operativo + '\', \'' + row.fecha_operativo + '\')" title="Editar">',
                '<i class="fa fa-edit"></i>',
                '</a> ',
                '<a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick="deleteOperativo(' + row.idoperativo + ')" title="Eliminar">',
                '<i class="fa fa-trash"></i>',
                '</a>'
            ].join('');
        }

        function formOperativo(id = null, nombre = '', fecha = '') {
            let title = id ? 'Editar Operativo' : 'Nuevo Operativo';
            
            let content = `
                <div class="form-group">
                    <label>Nombre del Operativo</label>
                    <input type="text" id="operativo" class="form-control" value="${nombre}">
                    
                    <label>Fecha</label>
                    <input type="text" id="fecha_operativo" class="form-control datepicker" value="${fecha}">
                </div>
            `;

            $.confirm({
                title: title,
                content: content,
                type: 'blue',
                boxWidth: '500px',
                useBootstrap: true,
                onContentReady: function () {
                    $("#fecha_operativo").flatpickr({
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
                    guardar: {
                        text: 'Guardar',
                        btnClass: 'btn-blue',
                        action: function () {
                            let data = {
                                idoperativo: id,
                                operativo: $('#operativo').val(),
                                fecha_operativo: $('#fecha_operativo').val()
                            };

                            if(!data.operativo || !data.fecha_operativo) {
                                $.alert('Todos los campos son obligatorios.');
                                return false;
                            }

                            $.ajax({
                                url: '../php/saveUfOperativo.php',
                                type: 'POST',
                                data: data,
                                dataType: 'json',
                                success: function (response) {
                                    if (response.status === 'success') {
                                        $('#tableOperativos').bootstrapTable('refresh');
                                        $.alert(response.message);
                                    } else {
                                        $.alert(response.message);
                                    }
                                },
                                error: function () {
                                    $.alert('Error al guardar.');
                                }
                            });
                        }
                    },
                    cancelar: function () { }
                }
            });
        }

        function deleteOperativo(id) {
            $.confirm({
                title: 'Eliminar',
                content: '¿Está seguro de eliminar este operativo?',
                type: 'red',
                buttons: {
                    eliminar: {
                        text: 'Eliminar',
                        btnClass: 'btn-red',
                        action: function () {
                            $.ajax({
                                url: '../php/deleteUfOperativo.php',
                                type: 'POST',
                                data: { idoperativo: id },
                                dataType: 'json',
                                success: function (response) {
                                    if (response.status === 'success') {
                                        $('#tableOperativos').bootstrapTable('refresh');
                                    } else {
                                        $.alert(response.message);
                                    }
                                },
                                error: function () {
                                    $.alert('Error al eliminar.');
                                }
                            });
                        }
                    },
                    cancelar: function () { }
                }
            });
        }
    </script>
</body>
</html>
