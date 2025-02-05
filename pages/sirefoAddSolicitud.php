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
    <title>SIREFO SOLICITUD</title>
    <?php
    echo $twig->render('linkStyle.twig');
    ?>
    <link href="../css/styleRecursoIa.css" rel="stylesheet">
    <link href="../vendor/bootstrap-table-master/dist/bootstrap-table.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .oculto_ {
            display: none;
        }

        .btn-flotante {
            position: fixed;
            top: 40%;
            right: 20px;
            transform: translateY(-80%);
            z-index: 1000;
        }

        .btn-flotante button {
            border-radius: 20%;
            padding: 10px;
            font-size: 18px;
            cursor: pointer;
        }

        /* .form-trash {
            border-radius: 20%;
            padding: 10px;
            font-size: 18px;
            cursor: pointer;
        } */

        .input-group {
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        #refreshButton {
            margin-left: 5px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            cursor: pointer;
        }

        #refreshButton i {
            font-size: 18px;
            color: #007bff;
        }

        #refreshButton:hover i {
            color: #0056b3;
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
    <li class="breadcrumb-item text-white active" aria-current="page"><a class="text-white" href="sirefoList.php">SIREFO</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page">SOLICITUD</li>
    <?php
    echo $twig->render('prebodyltFin.twig');
    ?>
    <!-- Hero End -->

    <!-- About Start -->
    <div class="btn-flotante">
        <button id="btn-guardar" class="btn btn-primary">
            <i class="fa fa-floppy-o"></i>
        </button>
    </div>
    <div class="contenedorDigitaliza">

        <div class="row cabeceraSolicitud">
            <div class="col-md-3 mb-3">
                <label for="codigoSolicitud">Nro Cite</label>
                <input type="text" id="codigoSolicitud" class="form-control" placeholder="Codigo de solicitud/Nro Cite de nota" value="<?php echo (isset($_GET['cs']) ? $_GET['cs'] : '') ?>">
            </div>
            <div class="col-md-3 mb-3">
                <label for="tipoProceso">Tipo de proceso</label>
                <?php
                $swR = '';
                $swS = 'selected';
                if (isset($_GET['tp']) && $_GET['tp'] == 'R') {
                    $swR = 'selected';
                    $swS = '';
                }
                ?>
                <select class="form-controlSelect" id="tipoProceso">
                    <option value="R" <?php echo $swR; ?>>Retención</option>
                    <option value="S" <?php echo $swS; ?>>Suspención</option>
                </select>

            </div>
            <div class="col-md-3 mb-3">
                <label for="detalleCantidad">Cantidad de items</label>
                <div class="input-group">
                    <input type="number" id="detalleCantidad" onfocus="verificaDB()" class="form-control" placeholder="Cantidad items" value="<?php echo (isset($_GET['dc']) ? $_GET['dc'] : '') ?>">
                    <button id="refreshButton" class="btn btn-outline-secondary" type="button" onclick="addItem(false, false)">
                        <i class="fa fa-refresh"></i>
                    </button>
                </div>
                <input type="hidden" id="detalleCantidadAnterior">
                <input type="hidden" id="id_cabecera_solicitud" value="<?php echo (isset($_GET['id']) ? $_GET['id'] : '') ?>">
                <input type="hidden" id="swEdicionSolicitud" value="<?php echo ((isset($_GET['sw']) && $_GET['sw'] === '1') ? 1 : 0) ?>">
            </div>
            <div class="col-md-3 mb-3">
                <label for="formFilePdf">Adjunto</label>
                <input class="form-control" type="file" id="formFilePdf" accept=".pdf">
                <span id="fileExistente"></span>
            </div>

        </div>
        <hr>

        <div id="contenedorItems">

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
    var cntItem = 0;
    var tipoDoc = [];
    var extension = [];
    var tipoRespaldo = [];
    var swVerificaDb = true;

    $(document).ready(function() {
        $('#btn-guardar').on('click', function() {
            guardarSolicitud(true, 0);
        });
        if ($('#swEdicionSolicitud').val()) {
            verificaDB();
        }
    });

    function quitarItem(nroItem) {
        var id_item_solicitud = $('#id_item_solicitud' + nroItem).val();

        if (id_item_solicitud > 0) {
            $.confirm({
                title: "Dar de baja el item",
                type: "red",
                content: "Esta seguro de quitar el item No. " + (nroItem + 1) + " de la solicitud?",
                buttons: {
                    cancel: {
                        text: "Cerrar",
                        action: function() {}
                    },
                    aceptar: {
                        text: "Aceptar",
                        btnClass: "btn-red",
                        action: function() {
                            $.ajax({
                                type: "POST",
                                url: "../php/sirefoBajaItem.php",
                                data: {
                                    id_item_solicitud: id_item_solicitud,
                                    swActualizaItems: 1
                                },
                                beforeSend: function() {},
                                success: function(response) {
                                    dat = $.parseJSON(response);
                                    if (dat.err.every(Boolean)) {
                                        $('#detalleCantidad').val(dat.nueva_cantidad_detalle);
                                        //actualizamos la estructura
                                        actualizarItemsTrasBaja(nroItem);
                                        verificaDB();
                                    } else {
                                        $.confirm({
                                            title: "Errores de baja del item",
                                            type: "red",
                                            content: dat.err,
                                            buttons: {
                                                cancel: {
                                                    text: "Cerrar",
                                                    action: function() {}
                                                }
                                            }
                                        });
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.log("Error al eliminar el item");
                                }
                            });
                        }
                    }
                }
            });
        } else {
            var detalleCantidadAux = $('#detalleCantidad').val() - 1;

            $('#detalleCantidad').val(detalleCantidadAux);
            cntItem = detalleCantidadAux;
            $.ajax({
                type: "POST",
                url: "../php/sirefoBajaItem.php",
                data: {
                    id_cabecera_solicitud: $('#id_cabecera_solicitud').val(),
                    detalleCantidad: detalleCantidadAux,
                    swActualizaItems: 0
                },
                beforeSend: function() {},
                success: function(response) {
                    dat = $.parseJSON(response);
                    $('#detalleCantidad').val(dat.nueva_cantidad_detalle);
                    actualizarItemsTrasBaja(nroItem);
                },
                error: function(xhr, status, error) {
                    console.log("Error al eliminar el item");
                }
            });
        }
    }

    function actualizarItemsTrasBaja(nroItem) {
        $('#item' + nroItem).remove();

        $('#contenedorItems > div[id^="item"]').each(function(index) {
            var nuevoIndex = index;
            $(this).attr('id', 'item' + nuevoIndex);
            $(this).find('h3').text('Item No ' + (nuevoIndex + 1));
            $(this).find('[id]').each(function() {
                var idOriginal = $(this).attr('id');

                // Buscar el número final en el ID (por ejemplo, "1" en "id_tipo_respaldo1")

                var nuevoId = idOriginal.replace(/\d+$/, nuevoIndex);

                $(this).attr('id', nuevoId);

                // Si el elemento tiene atributos "for", actualizarlos
                var forAttr = $(this).attr('for');
                if (forAttr) {
                    var nuevoFor = forAttr.replace(/\d+$/, nuevoIndex);
                    $(this).attr('for', nuevoFor);
                }

                // Actualizar eventos como "onclick", "onchange" o "onblur" que dependan del número
                var onclickAttr = $(this).attr('onclick');
                if (onclickAttr) {
                    var nuevoOnclick = onclickAttr.replace(/\d+/, nuevoIndex);
                    $(this).attr('onclick', nuevoOnclick);
                }

                var onchangeAttr = $(this).attr('onchange');
                if (onchangeAttr) {
                    var nuevoOnchange = onchangeAttr.replace(/\d+/, nuevoIndex);
                    $(this).attr('onchange', nuevoOnchange);
                }

                var onblurAttr = $(this).attr('onblur');
                if (onblurAttr) {
                    var nuevoOnblur = onblurAttr.replace(/\d+/, nuevoIndex);
                    $(this).attr('onblur', nuevoOnblur);
                }
            });
            cnt = parseInt($('#detalleCantidad').val());
            $('#detalleCantidadAnterior').val(cnt);
        });
    }
    let swValidacionPdf = true;

    function verificaDB() {

        var errores = [];
        var formData = new FormData();

        var codigoSolicitud = $('#codigoSolicitud').val();
        if (swVerificaDb && $.trim(codigoSolicitud) != '') {
            swVerificaDb = false;

            if (codigoSolicitud.length <= 3) {
                errores.push(' -El campo numero de cite no tiene un formato correcto');
            }

            formData.append('cabecera_CodigoSolicitud', codigoSolicitud);
            formData.append('cabecera_TipoProceso', $('#tipoProceso').val());

            if (errores.length > 0) {
                $.confirm({
                    title: "Errores de validación...",
                    type: "red",
                    content: errores.join('<br>'),
                    buttons: {
                        cancel: {
                            text: "Cerrar",
                            action: function() {}
                        }
                    }
                });
                return;
            }
            $.ajax({
                async: true,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                url: "../php/sirefoVerificaDb.php",
                beforeSend: function() {},
                success: function(e) {
                    $('#detalleCantidad').off('keyup');
                    $('#detalleCantidad').off('blur');
                    dat = $.parseJSON(e);
                    if (dat.existeSolicitud != '0') {
                        $('#fileExistente').html(dat.info.adjunto_nombre);
                        if ($('#detalleCantidad').val() == dat.info.detalle_cantidad || $('#detalleCantidad').val() == '')
                            $('#detalleCantidad').val(dat.info.detalle_cantidad);
                        $('#detalleCantidadAnterior').val($('#detalleCantidad').val());
                        $('#id_cabecera_solicitud').val(dat.info.id_cabecera_solicitud);

                        if (dat.info.detalle_cantidad > 0) {
                            addItem('autocompletar', dat.infoItem);
                        }
                    } else {
                        swValidacionPdf = false;
                        $('#detalleCantidadAnterior').val('0');
                    }
                    $('#detalleCantidad').on('keyup', function() {
                        if (event.key === "Enter" || event.keyCode === 13) {
                            addItem(false, false);
                        }
                    });

                    $('#detalleCantidad').on('blur', function() {
                        guardarSolicitud(false, 0);
                    });

                },
                timeout: 16000,
                error: function() {},
            });

        }
    }

    function addItem(swauto = '', datItems) {
        cnt = parseInt($('#detalleCantidad').val());
        var auxDetalleCantidadAnterior = parseInt($('#detalleCantidadAnterior').val());
        if (cnt > 0 && auxDetalleCantidadAnterior <= cnt) {
            $('#detalleCantidadAnterior').val(cnt);
            if (cntItem < cnt) {
                var n = cnt - cntItem;
                $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "html",
                    contentType: "application/x-www-form-urlencoded",
                    url: "../php/sirefoAddItem.php",
                    data: "&cnt=" + n + "&cntItemAct=" + cntItem + "&tipoProceso=" + $('#tipoProceso').val(),
                    beforeSend: function() {},
                    success: function(e) {
                        dat = $.parseJSON(e);
                        // agregar item nuevo a div contenedorItems 
                        $("#contenedorItems").append(dat.items);
                        tipoDoc = dat.tipoDoc;
                        extension = dat.extension;
                        tipoRespaldo = dat.tipoRespaldo;
                        if (swauto === 'autocompletar') {
                            var i = 0;
                            datItems.forEach(item => {
                                $('#tipoPersona' + i).val(item.tipo_persona);
                                reestructuraFormItem(i);
                                $('#id_documento_identidad_tipo' + i).val(item.id_documento_identidad_tipo);
                                $('#id_documento_identidad_extension' + i).val(item.id_documento_identidad_extension);
                                if (item.id_documento_identidad_tipo == 4) {
                                    $('#id_documento_identidad_extension' + i).hide();
                                }
                                $('#documentoIdentidadNumero' + i).val(item.documento_identidad_numero);
                                $('#documentoIdentidadComplemento' + i).val(item.documento_identidad_complemento);
                                $('#razonSocial' + i).val(item.razon_social);
                                $('#nombre' + i).val(item.nombre);
                                $('#apellidoPaterno' + i).val(item.apellido_paterno);
                                $('#apellidoMaterno' + i).val(item.apellido_materno);
                                $('#autoConclusion' + i).val(item.auto_conclusion);
                                $('#id_tipo_respaldo' + i).val(item.id_tipo_respaldo);
                                $('#documentoRespaldo' + i).val(item.documento_respaldo);
                                $('#montoRetencionBs' + i).val(item.monto_retencion_bs);
                                $('#montoRetencionUFV' + i).val(item.monto_retencion_ufv);
                                $('#id_item_solicitud' + i).val(item.id_item_solicitud);
                                i++;
                            });
                        }
                    },
                    timeout: 16000,
                    error: function() {},
                });
            } else {
                var n = cntItem - cnt;
                //quitamos  n ultimos items 
                for (let index = cntItem; index >= cnt; index--) {
                    $("#item" + index).remove();
                }
            }
            cntItem = cnt;
        } else {
            $('#detalleCantidad').val($('#detalleCantidadAnterior').val());
        }
    }

    function reestructuraFormItem(noItem) {
        var tipoPersona = $('#tipoPersona' + noItem).val();
        $("#id_documento_identidad_tipo" + noItem).empty();
        $.each(tipoDoc, function(index, opcion) {
            if (opcion.tipo_persona === tipoPersona) {
                $("#id_documento_identidad_tipo" + noItem).append(
                    $("<option></option>").val(opcion.id_documento_identidad_tipo).text(opcion.documento_identidad_tipo)
                );
            }
        });
        //si el tipo persona es N ocultamos los items con clase juridico_
        if (tipoPersona === "J") {
            $(".natural_" + noItem).hide();
            $(".juridico_" + noItem).show();
        } else if (tipoPersona === "N") {

            $(".natural_" + noItem).show();
            $(".juridico_" + noItem).hide();
        }
    }

    function actExtension(noItem) {

        var tipoPersona = $('#tipoPersona' + noItem).val();
        console.log("en actExtension");
        console.log("tipoPersona:" + tipoPersona);
        console.log("id_documento_identidad_tipo:" + $('#id_documento_identidad_tipo' + noItem).val());
        $('#id_documento_identidad_extension' + noItem).show();
        if (tipoPersona == 'N' && $('#id_documento_identidad_tipo' + noItem).val() == 4) {
            $('#id_documento_identidad_extension' + noItem).hide();
        }
        if (tipoPersona == 'N') {
            //$("#id_documento_identidad_extension" + noItem + " option[value='10']").remove();
            $("#id_documento_identidad_extension" + noItem).empty();
            $("#id_documento_identidad_extension" + noItem).append($("<option></option>").val('1').text('CH'));
            $("#id_documento_identidad_extension" + noItem).append($("<option></option>").val('2').text('LP'));
            $("#id_documento_identidad_extension" + noItem).append($("<option></option>").val('3').text('CB'));
            $("#id_documento_identidad_extension" + noItem).append($("<option></option>").val('4').text('OR'));
            $("#id_documento_identidad_extension" + noItem).append($("<option></option>").val('5').text('PO'));
            $("#id_documento_identidad_extension" + noItem).append($("<option></option>").val('6').text('TJ'));
            $("#id_documento_identidad_extension" + noItem).append($("<option></option>").val('7').text('SC'));
            $("#id_documento_identidad_extension" + noItem).append($("<option></option>").val('8').text('BE'));
            $("#id_documento_identidad_extension" + noItem).append($("<option></option>").val('9').text('PA'));
        }
        if (tipoPersona == 'N' && $('#id_documento_identidad_tipo' + noItem).val() == 5) {
            $("#id_documento_identidad_extension" + noItem).empty();
            $("#id_documento_identidad_extension" + noItem).append(
                $("<option></option>").val('10').text('PE')
            );
            $("#id_documento_identidad_extension" + noItem).val('10').change();
        }
    }

    function guardarSolicitud(swItems, nroitem) {

        var formData = new FormData();
        var fileInput = $('#formFilePdf')[0];
        var errores = [];
        if (swValidacionPdf) {
            if (fileInput.files.length > 0) {
                formData.append('cabecera_archivoPdf', fileInput.files[0]);
            } else {
                if ($('#fileExistente').html().trim() == '')
                    errores.push(' -Tiene que agregar un documento adjunto en PDF segun el reglamento interno.');

            }
        } else {
            swValidacionPdf = true;
        }
        var codigoSolicitud = $('#codigoSolicitud').val();

        if (codigoSolicitud.length <= 3) {
            errores.push(' -El campo numero de cite no tiene un formato correcto');
        }
        formData.append('cabecera_codigo_solicitud', codigoSolicitud);
        formData.append('cabecera_tipo_proceso', $('#tipoProceso').val());

        var detalleCantidad = $('#detalleCantidad').val();
        if (!isNumeric(detalleCantidad)) {
            errores.push(" -Ingrese una cantidad numérica para la cantidad de items que componen la solicitud.");
            $.confirm({
                title: "Errores de validación...",
                type: "red",
                content: errores.join('<br>'),
                buttons: {
                    cancel: {
                        text: "Cerrar",
                        action: function() {}
                    }
                }
            });
            return;
        }

        formData.append('cabecera_detalle_cantidad', detalleCantidad);
        formData.append('cabecera_cntItem', cntItem);
        formData.append('cabecera_swItems', swItems);
        formData.append('cabecera_nroitem', nroitem);
        if (swItems) {

            var auxCntItem = cntItem;
            if (nroitem != 0) {
                auxCntItem = nroitem + 1;
            }
            var cntImpresion = 0;
            for (let index = 0; index < auxCntItem; index++) {
                cntImpresion = index + 1;
                var tipoPersona = $('#tipoPersona' + index).val();
                formData.append('item_tipo_persona' + index, tipoPersona);
                formData.append('item_id_documento_identidad_tipo' + index, $('#id_documento_identidad_tipo' + index).val());
                var documentoIdentidadNumero = $('#documentoIdentidadNumero' + index).val();
                if (!isValidAlphanumeric(documentoIdentidadNumero, 4)) {
                    errores.push(" -El numero de documento de identidad (Item " + cntImpresion + "), tiene que ser del tipo numerico y con mas de 4 caracteres.");
                }
                formData.append('item_documentoIdentidadNumero' + index, documentoIdentidadNumero);

                formData.append('item_documentoIdentidadComplemento' + index, $('#documentoIdentidadComplemento' + index).val());
                formData.append('item_id_documento_identidad_extension' + index, $('#id_documento_identidad_extension' + index).val());
                console.log("id_documento_identidad_extension" + index + $('#id_documento_identidad_extension' + index).val());
                var nombre = $('#nombre' + index).val();
                if (!isValidAlphanumeric(nombre, 3) && tipoPersona === 'N') {
                    errores.push(" -El campo Nombre (Item " + cntImpresion + ") debe tener más de 3 caracteres o contiene caracteres no permitidos");
                }
                formData.append('item_nombre' + index, nombre);
                formData.append('item_apellidoPaterno' + index, $('#apellidoPaterno' + index).val());
                formData.append('item_apellidoMaterno' + index, $('#apellidoMaterno' + index).val());

                var razonSocial = $('#razonSocial' + index).val();
                if (!isValidAlphanumeric(razonSocial, 3) && tipoPersona === 'J') {
                    errores.push(' -El campo Razón social (Item ' + cntImpresion + '), debe contar con más de 3 caracteres o contiene caracteres no permitidos');
                }
                formData.append('item_razonSocial' + index, razonSocial);

                formData.append('item_autoConclusion' + index, $('#autoConclusion' + index).val());
                formData.append('item_id_tipo_respaldo' + index, $('#id_tipo_respaldo' + index).val());
                formData.append('item_documentoRespaldo' + index, $('#documentoRespaldo' + index).val());

                var montoRetencionBs = $('#montoRetencionBs' + index).val();
                var montoRetencionUFV = $('#montoRetencionUFV' + index).val();
                if (!isNumeric(montoRetencionBs)) {
                    errores.push(" -Ingrese un monto de retenciones en bolivianos (Item " + cntImpresion + ")");
                }
                if (!isNumeric(montoRetencionBs)) {
                    montoRetencionBs = 0;
                }
                formData.append('item_montoRetencionBs' + index, montoRetencionBs);
                if (!isNumeric(montoRetencionUFV)) {
                    montoRetencionUFV = 0;
                }
                formData.append('item_montoRetencionUFV' + index, montoRetencionUFV);
            }
        }

        if (errores.length > 0) {
            $.confirm({
                title: "Errores de validación...",
                type: "red",
                content: errores.join('<br>'),
                buttons: {
                    cancel: {
                        text: "Cerrar",
                        action: function() {}
                    }
                }
            });
            return;
        } else {

            toastr.options = {
                "closeButton": true,
                "debug": false,
                "progressBar": true,
                "rtl": true,
                "preventDuplicates": true,
                "onclick": null,
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            $.ajax({
                async: true,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                url: '../php/sirefoSaveSolicitud.php',
                beforeSend: function() {},

                success: function(dat) {
                    //AGREAGAR NOTIFICACION DE GUARDADO CORRECTO 

                    dat = $.parseJSON(dat);
                    if (dat.err == '0') {
                        toastr["success"]("Registros guardados correctamente", dat.log);
                    } else {
                        toastr["error"]("Ocurrio algun error.", dat.log);
                    }


                },
                timeout: 16000,
                error: function(xhr, status, error) {
                    toastr["error"]("Ocurrio algun error.", 'Error: ' + error);
                }
            });

        }
    }

    function isNumeric(value) {
        return !isNaN(parseFloat(value)) && isFinite(value);
    }

    function isValidAlphanumeric(value, minLength) {
        return /^[a-zA-Z0-9\s&'ñÑáéíóúÁÉÍÓÚüÜ.]+$/.test(value) && value.length >= minLength;
    }
</script>

</html>