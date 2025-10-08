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
        <hr>
        <button id="btn-generar" class="btn btn-success">
            <i class="fa fa-file-text-o"></i>
        </button>
    </div>
    <div class="contenedorDigitaliza">

        <div class="row cabeceraSolicitud">
            <div class="col-md-3 mb-3">
                <label for="codigoSolicitud">Nro Cite</label>
                <input type="text" id="codigoSolicitud" class="form-control" placeholder="Codigo de solicitud/Nro Cite de nota"
                    value="<?php echo (isset($_GET['cs']) ? $_GET['cs'] : '') ?>" <?php echo (isset($_GET['id']) ? ' disabled="disabled" ' : '') ?>>
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
                <select class="form-controlSelect" id="tipoProceso" <?php echo (isset($_GET['id']) ? ' disabled="disabled" ' : '') ?>>
                    <option value="R" <?php echo $swR; ?>>Retención</option>
                    <option value="S" <?php echo $swS; ?>>Suspención</option>
                </select>

            </div>
            <div class="col-md-3 mb-3">
                <label for="detalleCantidad">Cantidad de items</label>
                <div class="input-group">
                    <input type="number" id="detalleCantidad" onfocus="verificaDB()" class="form-control" placeholder="Cantidad items" value="<?php

                                                                                                                                                require_once '../php/conexionpsql.php';
                                                                                                                                                $conn = new Conexion();
                                                                                                                                                $cons = $conn->conectar();

                                                                                                                                                $query = "select * from srf_cabecera_solicitud where id_cabecera_solicitud = " . (isset($_GET['id']) ? $_GET['id'] : '0') . " limit 1;";
                                                                                                                                                $stmt = $cons->query($query);
                                                                                                                                                $cabecera = $stmt->fetch(PDO::FETCH_ASSOC);
                                                                                                                                                echo $cabecera['detalle_cantidad'];
                                                                                                                                                ?>">
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
        $('#btn-generar').on('click', function() {
            var url_ = "../php/rptSirefoNota.php?id=" + $('#id_cabecera_solicitud').val();
            window.open(url_, "_blank");
        });
        if ($('#swEdicionSolicitud').val()) {
            verificaDB();
        }
    });


    document.addEventListener('DOMContentLoaded', function() {
        var toastrMessage = localStorage.getItem('toastrMessage');
        var toastrTitle = localStorage.getItem('toastrTitle');
        console.log("en addevenlistener");
        console.log("toastrMessage:" + toastrMessage);
        if (toastrMessage) {
            toastr["success"](toastrMessage, toastrTitle);
            localStorage.removeItem('toastrMessage');
            localStorage.removeItem('toastrTitle');
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

    function buscaContribuyente(nroItem) {
        $("#retencionDetalle" + nroItem).html("");
        let rubro = $('#tipo_documento_tributario' + nroItem).val();
        let documentoTributario = $('#documentoTributario' + nroItem).val();

        console.log("rubro:" + rubro + ", documentoTributario:" + documentoTributario);
        if (rubro != 'PUB') {
            $.ajax({
                async: true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url: "../php/sirefoGetContribuyente.php",
                data: "&rubro=" + rubro + "&documentoTributario=" + documentoTributario + "&nroItem=" + nroItem,
                beforeSend: function() {

                },
                success: function(e) {
                    console.log(e);
                    dat = $.parseJSON(e);
                    console.log(dat.contribuyente);
                    console.log("cntRetenciones" + dat.cntRetenciones);

                    var tipo_contribuyente_ = tipoContribuyente[dat.contribuyente.tipo_contribuyente];
                    $("#tipoPersona" + nroItem).val(tipo_contribuyente_);

                    actExtension(nroItem);

                    $("#id_documento_identidad_extension" + nroItem).val(dataMap[dat.contribuyente.expedido]);

                    var tipoDocumentoAux = tipoDocumento[dat.contribuyente.tipo_documento];
                    var documentoAux = dat.contribuyente.documento_identidad;
                    var complementoAux = '';
                    var nombre = '';
                    var paterno = '';
                    var materno = '';
                    var razonSocialAux = dat.contribuyente.nombre_rsocial;
                    if (tipo_contribuyente_ == 'N' && dat.contribuyente.tipo_documento == 'CI') {
                        razonSocialAux = '';
                        nombre = dat.contribuyente.nombre_rsocial;
                        paterno = dat.contribuyente.primer_apellido_sigla;
                        materno = dat.contribuyente.segundo_apellido;
                        var match = documentoAux.match(/^(\d+)-?(\w+)?$/);
                        if (match) {
                            documentoAux = match[1];
                            complementoAux = match[2] || '';
                        }
                    }
                    reestructuraFormItem(nroItem);
                    $("#razonSocial" + nroItem).val(razonSocialAux);
                    $("#nombre" + nroItem).val(nombre);
                    $("#apellidoPaterno" + nroItem).val(paterno);
                    $("#apellidoMaterno" + nroItem).val(materno);
                    $("#documentoIdentidadNumero" + nroItem).val(documentoAux);
                    $("#documentoIdentidadComplemento" + nroItem).val(complementoAux);
                    $("#id_documento_identidad_tipo" + nroItem).val(tipoDocumento[dat.contribuyente.tipo_documento]);

                    if (dat.cntRetenciones > 0 && $("#tipoProceso" + nroItem).val() == 'S') {
                        $("#retencionDetalle" + nroItem).html(dat.htmlRetenciones);
                    }
                    console.log("dat.contribuyente.tipo_apoderado:" + dat.contribuyente.tipo_apoderado);
                    //-- completamos info para apoderado si existe
                    if (dat.contribuyente.tipo_apoderado != 'x' && dat.contribuyente.tipo_apoderado != '' && dat.contribuyente.tipo_apoderado != undefined) {
                        let tipoApoderado = (dat.contribuyente.tipo_apoderado == 'REP' ? 'REPRESENTANTE LEGAL' : 'APODERADO');
                        $('#tipo_apoderado' + nroItem).val(tipoApoderado);
                        $('#documento_identidad_apo' + nroItem).val(dat.contribuyente.documento_identidad_apo);
                        $('#nombre_apo' + nroItem).val(dat.contribuyente.nombre_apo);
                        $('.data_apoderado_' + nroItem).show();
                    } else {
                        $('.data_apoderado_' + nroItem).hide();
                    }
                },
                timeout: 16000,
                error: function() {},
            });
        }
    }

    const tipoContribuyente = {
        "NATURAL": 'N',
        "JURIDICO": 'J',
        "": 'J'
    }
    const tipoDocumento = {
        "ASN": '3',
        "CN": '2',
        "NIT": '1',
        "AG": '2',
        "CI": '2',
        "RUN": '2',
        "CEX": '5',
        "PAS": '4',
        "RUC": '3'
    }

    const dataMap = {
        "BA": 8,
        "BE": 8,
        "CH": 1,
        "CO": 3,
        "CU": 2,
        "LI": 2,
        "JU": 2,
        "LP": 2,
        "OR": 4,
        "PA": 9,
        "PO": 5,
        "SC": 7,
        "SP": 7,
        "TA": 6,
        "TC": 6,
        "": 2
    };

    function setearRetenciones(nroItem) {
        console.log("valor a setear:" + $("#retenciones_" + nroItem).val());
        let retencionesAux = $("#retenciones_" + nroItem).val();
        if (retencionesAux) {
            const arrayAux = (retencionesAux).split("_");
            $('#id_tipo_respaldo' + nroItem).val(arrayAux[0]);
            $('#documentoRespaldo' + nroItem).val(arrayAux[1]);
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
                                $('#documentoTributario' + i).val(item.documento_tributario);
                                $('#tipo_documento_tributario' + i).val(item.tipo_documento_tributario);
                                $('#id_documento_identidad_extension' + i).val(item.id_documento_identidad_extension);
                                if (item.id_documento_identidad_tipo == 4) {
                                    $('#id_documento_identidad_extension' + i).hide();
                                }
                                if (item.tipo_apoderado != 'x' && item.tipo_apoderado != '') {
                                    $('#tipo_apoderado' + i).val(item.tipo_apoderado);
                                    $('#documento_identidad_apo' + i).val(item.documento_identidad_apo);
                                    $('#nombre_apo' + i).val(item.nombre_apo);
                                    $('.data_apoderado_' + i).show();
                                } else {
                                    $('.data_apoderado_' + i).hide();
                                }
                                $('#documentoIdentidadNumero' + i).val(item.documento_identidad_numero);
                                $('#documentoIdentidadComplemento' + i).val(item.documento_identidad_complemento);
                                $('#razonSocial' + i).val(item.razon_social);
                                $('#nombre' + i).val(item.nombre);
                                $('#apellidoPaterno' + i).val(item.apellido_paterno);
                                $('#apellidoMaterno' + i).val(item.apellido_materno);
                                $('#autoConclusion' + i).val(item.auto_conclusion);
                                $('#gestionFiscal' + i).val(item.gestion_fiscal);
                                $('#cite_anotacion_preventiva' + i).val(item.cite_anotacion_preventiva);
                                $('#resolucionDeterminativa' + i).val(item.resolucion_determinativa);
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
                /* if ($('#fileExistente').html().trim() == '')
                    errores.push(' -Tiene que agregar un documento adjunto en PDF segun el reglamento interno.'); */

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
        

                if (tipoPersona == '' || tipoPersona == 'null' || tipoPersona == null ) {
                    errores.push(" -Debe indicar el tipo de persona (Item " + cntImpresion + ")");
                }
                formData.append('item_tipo_persona' + index, tipoPersona);
                formData.append('item_id_documento_identidad_tipo' + index, $('#id_documento_identidad_tipo' + index).val());
                var documentoIdentidadNumero = $.trim($('#documentoIdentidadNumero' + index).val());
                if (!isValidAlphanumeric(documentoIdentidadNumero, 4)) {
                    errores.push(" -El numero de documento de identidad (Item " + cntImpresion + "), tiene que ser del tipo numerico y con mas de 4 caracteres.");
                }
                formData.append('item_documentoIdentidadNumero' + index, documentoIdentidadNumero);
                var documentoTributario = $.trim($('#documentoTributario' + index).val());
                if (!isValidAlphanumeric(documentoTributario, 3)) {
                    errores.push(" -El campo documento tributario (Item " + cntImpresion + ") debe tener más de 3 caracteres o contiene caracteres no permitidos");
                }
                formData.append('item_documentoTributario' + index, documentoTributario);

                formData.append('item_tipo_documento_tributario' + index, $('#tipo_documento_tributario' + index).val());
                formData.append('item_documentoIdentidadComplemento' + index, $('#documentoIdentidadComplemento' + index).val());

                var extension = $.trim($('#id_documento_identidad_extension' + index).val());
                
                if (extension == '' && tipoPersona == 'N') {
                    errores.push(" -El campo Extension (Item " + cntImpresion + ") no puede ser vacio");
                }
                formData.append('item_id_documento_identidad_extension' + index, extension); 
                
                var nombre = $.trim($('#nombre' + index).val());
                if (!isValidAlphanumeric(nombre, 3) && tipoPersona === 'N') {
                    errores.push(" -El campo Nombre (Item " + cntImpresion + ") debe tener más de 3 caracteres o contiene caracteres no permitidos");
                }
                formData.append('item_nombre' + index, nombre);
                formData.append('item_apellidoPaterno' + index, $.trim($('#apellidoPaterno' + index).val()));
                formData.append('item_apellidoMaterno' + index, $.trim($('#apellidoMaterno' + index).val()));

                var razonSocial = $.trim($('#razonSocial' + index).val());
                if (!isValidAlphanumeric(razonSocial, 3) && tipoPersona === 'J') {
                    errores.push(' -El campo Razón social (Item ' + cntImpresion + '), debe contar con más de 3 caracteres o contiene caracteres no permitidos');
                }
                formData.append('item_razonSocial' + index, razonSocial);

                formData.append('item_autoConclusion' + index, $.trim($('#autoConclusion' + index).val()));
                formData.append('item_resolucionDeterminativa' + index, $.trim($('#resolucionDeterminativa' + index).val()));
                formData.append('item_gestionFiscal' + index, $.trim($('#gestionFiscal' + index).val()));
                formData.append('item_cite_anotacion_preventiva' + index, $.trim($('#cite_anotacion_preventiva' + index).val()));
                formData.append('item_id_tipo_respaldo' + index, $('#id_tipo_respaldo' + index).val());
                let documentoRespaldo = $.trim($('#documentoRespaldo' + index).val());

                if (documentoRespaldo == '') {
                    errores.push(' -El campo documento de respaldo (Item ' + cntImpresion + '), esta vacio.');
                }
                formData.append('item_documentoRespaldo' + index, documentoRespaldo);

                var montoRetencionBs = $('#montoRetencionBs' + index).val();
                var montoRetencionUFV = $('#montoRetencionUFV' + index).val();
                var id_item_solicitud = $('#id_item_solicitud' + index).val();

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
                formData.append('item_id_item_solicitud' + index, id_item_solicitud);

                formData.append('tipo_apoderado' + index, $('#tipo_apoderado' + index).val());
                formData.append('documento_identidad_apo' + index, $('#documento_identidad_apo' + index).val());
                formData.append('nombre_apo' + index, $('#nombre_apo' + index).val());

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
            console.log(formData);
            $.ajax({
                async: true,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                url: '../php/sirefoSaveSolicitud.php',
                beforeSend: function() {
                    loadGralOn();
                },

                success: function(dat) {
                    loadGralOff();
                    //AGREAGAR NOTIFICACION DE GUARDADO CORRECTO 
                    console.log(dat);
                    dat = $.parseJSON(dat);
                    if (dat.err == '0') {
                        console.log("cargando en localStorage:" + dat.log);
                        localStorage.setItem('toastrMessage', dat.log);
                        localStorage.setItem('toastrTitle', "Registros guardados correctamente");
                        window.location.href = "sirefoAddSolicitud.php?id=" + dat.idsolicitud + "&tp=" + dat.tipoProceso + "&cs=" + dat.codigo + "&sw=" + dat.sw;
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
        return /^[a-zA-Z0-9\s&'ñÑáéíóúÁÉÍÓÚüÜ/.\-]+$/.test(value) && value.length >= minLength;
    }
</script>

</html>