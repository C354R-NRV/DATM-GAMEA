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
    <title>Configuración de Tipos de CITE</title>
    <?php echo $twig->render('linkStyle.twig'); ?>
    <link href="../css/styleRecursoIa.css" rel="stylesheet">
    <link href="../vendor/bootstrap-table-master/dist/bootstrap-table.min.css" rel="stylesheet">
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
    <li class="breadcrumb-item"><a class="text-white" href="index.php">SIS</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page">Config. CITES</li>
    <?php echo $twig->render('prebodyltFin.twig'); ?>
    <!-- Hero End -->

    <div class="contenedorDigitaliza">
        <div class="form-group d-flex flex-column flex-md-row mb-3">
             <div class="col-md-1">
                <button class="btn btn-success" onclick="formCiteTipoDoc()" title="Nuevo Tipo de Documento"><i class="fa fa-plus"></i> Nuevo</button>
            </div>
        </div>

        <div>
            <table id="tableCiteTipoDoc"
                data-toggle="table"
                data-search="true"
                data-show-toggle="true"
                data-show-columns="true"
                data-pagination="true"
                data-page-list="[10, 25, 50, 100, all]"
                data-locale="es-ES"
                class="table table-striped"
                data-url="../php/getAllCiteTipoDoc.php">
                <thead>
                    <tr>
                        <th data-field="idtipo_doc" data-sortable="true">ID</th>
                        <th data-field="codigo_doc" data-sortable="true">Código</th>
                        <th data-field="detalle_doc" data-sortable="true">Detalle</th>
                        <th data-field="unidad" data-sortable="true">Unidad</th>
                        <th data-field="area" data-sortable="true">Área</th>
                        <th data-formatter="actionFormatter">Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <?php echo $twig->render('linkJs.twig'); ?>
    <script src="../vendor/bootstrap-table-master/dist/bootstrap-table.min.js"></script>
    <script src="../vendor/bootstrap-table-master/dist/extensions/export/bootstrap-table-export.min.js"></script>

    <script>
        function actionFormatter(value, row, index) {
            return [
                '<a class="btn btn-warning btn-sm me-1" href="javascript:void(0)" onclick="formCiteTipoDoc(' + row.idtipo_doc + ', \'' + row.codigo_doc + '\', \'' + row.detalle_doc + '\', \'' + row.unidad + '\', \'' + row.area + '\')" title="Editar">',
                '<i class="fa fa-edit"></i>',
                '</a>',
                '<a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick="deleteCiteTipoDoc(' + row.idtipo_doc + ')" title="Eliminar">',
                '<i class="fa fa-trash"></i>',
                '</a>'
            ].join('');
        }

        const allowedCombinations = {
            'DIR': [''],
            'GA': ['DCV', 'OPB', 'RCG', 'RLT', 'RMCR', ''],
            'SIS': [''],
            'UAJ-CC': [''],
            'UFyR': ['AEyPU', 'ARCH', 'ATP', 'INM_VEH', 'NOT', ''],
            'UICT': ['AE', 'CCI', 'CCII', 'INM', 'OI', 'VEH', '']
        };

        function updateAreaOptions(selectedUnidad, selectedArea = '') {
            const areaSelect = $('#area');
            areaSelect.empty();
            
            if (allowedCombinations[selectedUnidad]) {
                allowedCombinations[selectedUnidad].forEach(area => {
                    // Si el area es vacia, mostrar texto vacio o guion
                    let text = area === '' ? '(Sin Área)' : area;
                    let selected = area === selectedArea ? 'selected' : '';
                    areaSelect.append(`<option value="${area}" ${selected}>${text}</option>`);
                });
            }
        }

        function formCiteTipoDoc(id = null, codigo = '', detalle = '', unidad = '', area = '') {
            let title = id ? 'Editar Tipo de Documento' : 'Nuevo Tipo de Documento';
            
            // Generar opciones de unidad
            let unidadOptions = '';
            for (let u in allowedCombinations) {
                let selected = u === unidad ? 'selected' : '';
                unidadOptions += `<option value="${u}" ${selected}>${u}</option>`;
            }

            let content = `
                <div class="form-group">
                    <label>Unidad</label>
                    <select id="unidad" class="form-control" onchange="updateAreaOptions(this.value)">
                        <option value="">Seleccione Unidad</option>
                        ${unidadOptions}
                    </select>
                    
                    <label>Área</label>
                    <select id="area" class="form-control">
                        <!-- Options filled by JS -->
                    </select>

                    <label>Código Documento</label>
                    <input type="text" id="codigo_doc" class="form-control" value="${codigo}">
                    
                    <label>Detalle</label>
                    <textarea id="detalle_doc" class="form-control">${detalle}</textarea>
                </div>
            `;

            $.confirm({
                title: title,
                content: content,
                type: 'blue',
                boxWidth: '500px',
                useBootstrap: true,
                onContentReady: function () {
                    if(unidad) {
                         updateAreaOptions(unidad, area);
                    }
                },
                buttons: {
                    guardar: {
                        text: 'Guardar',
                        btnClass: 'btn-blue',
                        action: function () {
                            let data = {
                                idtipo_doc: id,
                                codigo_doc: $('#codigo_doc').val(),
                                detalle_doc: $('#detalle_doc').val(),
                                unidad: $('#unidad').val(),
                                area: $('#area').val()
                            };

                            if(!data.unidad) {
                                $.alert('Debe seleccionar una unidad.');
                                return false;
                            }
                            if(!data.codigo_doc) {
                                $.alert('Debe ingresar un código.');
                                return false;
                            }

                            $.ajax({
                                url: '../php/saveCiteTipoDoc.php',
                                type: 'POST',
                                data: data,
                                dataType: 'json',
                                success: function (response) {
                                    if (response.status === 'success') {
                                        $('#tableCiteTipoDoc').bootstrapTable('refresh');
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

        function deleteCiteTipoDoc(id) {
            $.confirm({
                title: 'Eliminar',
                content: '¿Está seguro de eliminar este registro?',
                type: 'red',
                buttons: {
                    eliminar: {
                        text: 'Eliminar',
                        btnClass: 'btn-red',
                        action: function () {
                            $.ajax({
                                url: '../php/deleteCiteTipoDoc.php',
                                type: 'POST',
                                data: { idtipo_doc: id },
                                dataType: 'json',
                                success: function (response) {
                                    if (response.status === 'success') {
                                        $('#tableCiteTipoDoc').bootstrapTable('refresh');
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
