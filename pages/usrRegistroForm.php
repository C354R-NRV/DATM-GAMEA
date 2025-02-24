<!DOCTYPE html>
<?php
session_start();
require_once '../vendor/autoload.php';
require_once '../php/conexionpsql.php';

$conn = new Conexion();
$cons = $conn->conectar();

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
    <title>Usuario Form</title>
    <?php
    echo $twig->render('linkStyle.twig');
    ?>
    <link href="../css/styleRecursoIa.css" rel="stylesheet">
    <link href="../css/styleExencion.css" rel="stylesheet">
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



        .token-container {
            max-width: 400px;
            margin: 20px auto;
            border: 2px solid #1d97b1;
            border-radius: 25px;
            padding: 5px;
            text-align: center;
        }

        .token-title {
            color: #17798e;
            font-size: 1.25rem;
            font-family: Arial, sans-serif;
        }

        .token-input {
            width: 100%;
            font-size: 3rem;
            text-align: center;
            border: none;
            background: transparent;
            font-family: Arial, sans-serif;
            font-weight: 500;
            padding: 10px 0;
            box-sizing: border-box;
        }

        /* Remover flechas del input number */
        .token-input::-webkit-outer-spin-button,
        .token-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .token-input[type=number] {
            -moz-appearance: textfield;
        }

        /* Remover el outline al hacer focus */
        .token-input:focus {
            outline: none;
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
    <li class="breadcrumb-item"><a class="text-white" href="usrList.php">Usuarios</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page"><a class="text-white">Form. Registro</a></li>
    <?php
    echo $twig->render('prebodyltFin.twig');
    ?>
    <!-- Hero End -->

    <!-- About Start -->
    <div class="btn-flotante">
        <button id="btn-guardar" class="btn btn-primary" onclick="guardar()">
            <i class="fa fa-floppy-o"></i>
        </button>
    </div>
    <div class="contenedorDigitaliza">
        <div id="contenedorItems">
            <div id="item" class="itemSolicitud">
                <div class="row">
                    <h3>Registro de contribuyente.</h3>
                </div>
                <h2>Datos de titular</h2>
                <div class="row">

                    <div class="col-md-3 mb-3">
                        <label for="tipo_persona">Tipo de persona</label>
                        <select class="form-controlSelect" onchange="reestructuraFormItem()" id="tipo_persona">
                            <option value="N">Natual</option>
                            <option value="J">Juridico</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="id_documento_identidad_tipo">Tipo de documento</label>
                        <select class="form-controlSelect" onchange="actExtension()" id="id_documento_identidad_tipo">
                            <option value="2">Cédula de identidad</option>
                            <option value="4">Pasaporte</option>
                            <option value="5">Cédula de Ident. persona extranjera</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cedula_identidad">No. Documento</label>
                        <input type="number" id="cedula_identidad" class="form-control" placeholder="Num. documento">
                        <input type="text" id="cedula_identidad_complemento" class="form-control natural_" placeholder="Complemento">
                        <select class="form-controlSelect natural_" id="id_documento_identidad_extension">
                            <?php
                            $query = "select * from srf_documento_identidad_extension";
                            $stmt = $cons->query($query);
                            $extension = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($extension as $row) {
                                echo  "<option value=" . $row['id_documento_identidad_extension'] . ">" . $row['documento_identidad_extension_det'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3" id="forrazonSocial">
                        <label for="razonSocial"><span class="natural_">Nombre completo</span><span class="juridico_ oculto_" style="display: none;">Razón social</span></label>
                        <input type="text" id="razonSocial" class="form-control juridico_ oculto_" placeholder="Razon social" style="display: none;">
                        <input type="text" id="nombres" class="form-control natural_" placeholder="Nombres">
                        <input type="text" id="primer_apellido" class="form-control natural_" placeholder="Apellido Paterno">
                        <input type="text" id="segundo_apellido" class="form-control natural_" placeholder="Apellido Materno">
                    </div>
                </div>
                <hr>
                <h2>Datos de contacto</h2>
                <div class="row">

                    <div class="col-md-6 mb-6">
                        <label for="correo">Correo electronico</label>
                        <input type="email" id="correo" class="form-control" placeholder="Email">
                    </div>
                    <div class="col-md-6 mb-6">
                        <label for="contacto">Contacto</label>
                        <input type="number" id="contacto" class="form-control" placeholder="Número de contacto">
                    </div>
                </div>
                <hr>
                <h2>Datos de la solicitud</h2>
                <div class="row">

                    <div class="col-md-6 mb-6" id="path_documento_solicitud">
                        <label for="formFilePdf">Documento de solicitud de credenciales</label>
                        <input class="form-control" type="file" id="formFilePdf" accept=".pdf">
                    </div>
                    <div class="col-md-6 mb-6" id="cite_documento_solicitud">
                        <label for="hhrr_">HHRR de solicitud</label>
                        <input type="text" id="hhrr_" class="form-control" placeholder="Hoja de ruta de solicitud de credenciales">
                    </div>
                </div>
                <hr>
                <h2>Datos genericos de usuario</h2>
                <div class="row">

                    <div class="col-md-3 mb-3">
                        <label for="rol">Rol</label>
                        <select class="form-controlSelect" id="rol">
                            <option value="CONTRIBUYENTE">Contribuyente</option>
                            <?php
                            $query = "select distinct rol from datm_usuario";
                            $stmt = $cons->query($query);
                            $extension = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($extension as $row) {
                                echo  "<option value=" . $row['rol'] . ">" . $row['rol'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="unidad">Unidad</label>
                        <select class="form-controlSelect" id="unidad">
                            <option value="GAMEA">GAMEA</option>
                            <?php
                            $query = "select distinct codigo_unidad from datm_usuario order by codigo_unidad";
                            $stmt = $cons->query($query);
                            $extension = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($extension as $row) {
                                echo  "<option value=" . $row['codigo_unidad'] . ">" . $row['codigo_unidad'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="area">Area</label>
                        <select class="form-controlSelect" id="area">
                            <option value="">N/A</option>
                            <?php
                            $query = "select distinct concat(codigo_unidad,' - ',area) area_, area  
                                from datm_usuario 
                                where area is not null 
                                order by concat(codigo_unidad,' - ',area)   ";
                            $stmt = $cons->query($query);
                            $extension = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($extension as $row) {
                                echo  "<option value=" . $row['area'] . ">" . $row['area_'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cargo">Cargo</label>
                        <select class="form-controlSelect" id="cargo">
                            <option value="N">Contribuyente</option>
                            <?php
                            $query = "select distinct cargo  
                                from datm_usuario 
                                where cargo is not null and cargo != 'ROOT'  ";
                            $stmt = $cons->query($query);
                            $extension = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($extension as $row) {
                                echo  "<option value=" . $row['cargo'] . ">" . $row['cargo'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <hr>
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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    function guardar() {
        var formData = new FormData();
        var fileInput = $('#formFilePdf')[0];
        var errores = [];
        if (fileInput.files.length > 0) {
            formData.append('usr_archivoPdf', fileInput.files[0]);
        }
        formData.append('usr_tipo_persona', $('#tipo_persona').val());
        formData.append('usr_' + 'id_documento_identidad_tipo', $('#id_documento_identidad_tipo').val());
        formData.append('usr_' + 'cedula_identidad', $('#cedula_identidad').val());
        formData.append('usr_' + 'cedula_identidad_complemento', $('#cedula_identidad_complemento').val());
        formData.append('usr_' + 'id_documento_identidad_extension', $('#id_documento_identidad_extension').val());
        formData.append('usr_' + 'razonSocial', $('#razonSocial').val());
        formData.append('usr_' + 'nombres', $('#nombres').val());
        formData.append('usr_' + 'primer_apellido', $('#primer_apellido').val());
        formData.append('usr_' + 'segundo_apellido', $('#segundo_apellido').val());
        formData.append('usr_' + 'correo', $('#correo').val());
        formData.append('usr_' + 'contacto', $('#contacto').val());
        formData.append('usr_' + 'formFilePdf', $('#formFilePdf').val());
        formData.append('usr_' + 'hhrr_', $('#hhrr_').val());
        formData.append('usr_' + 'rol', $('#rol').val());
        formData.append('usr_' + 'unidad', $('#unidad').val());
        formData.append('usr_' + 'area', $('#area').val());
        formData.append('usr_' + 'cargo', $('#cargo').val());

        console.log(formData);

        $.confirm({
            title: "Confirmar registro",
            type: "green",
            content: "Favor confirmar el registro de nuevo usuario",
            columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
            buttons: {
                confirmar: {
                    text: "Confirmar",
                    btnClass: "btn-green",
                    action: function() {
                        $.ajax({
                            async: true,
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            url: '../php/usrSave.php',
                            beforeSend: function() {
                                loadGralOn();
                            },
                            success: function(e) {
                                console.log(e);
                                dat = JSON.parse(e);
                                if (dat.err == '0') {
                                    $.confirm({
                                        title: "Registro exitoso",
                                        content: dat.log,
                                        type: "green",
                                        buttons: {
                                            ok: {
                                                text: "Aceptar",
                                                action: function() {
                                                    window.location.href = 'usrList.php';
                                                }
                                            }
                                        }
                                    });
                                } else {

                                }
                                loadGralOff();

                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
                                loadGralOff();
                                $.confirm({
                                    title: "Error",
                                    content: "Hubo un problema al conectar con el servidor. Por favor, intenta de nuevo más tarde.",
                                    type: "red",
                                    buttons: {
                                        ok: {
                                            text: "Aceptar",
                                            action: function() {}
                                        }
                                    }
                                });
                            },
                            timeout: 16000
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

    var tipoDoc = [];
    tipoDoc = <?php
                $conn = new Conexion();
                $cons = $conn->conectar();
                $query = "select * from srf_documento_identidad_tipo where estado_ is true";
                $stmt = $cons->query($query);
                $tipoDoc = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($tipoDoc);
                ?>

    function reestructuraFormItem() {
        var tipoPersona = $('#tipo_persona').val();
        $("#id_documento_identidad_tipo").empty();
        console.log(tipoDoc);
        $.each(tipoDoc, function(index, opcion) {
            console.log(opcion.tipo_persona);
            if (opcion.tipo_persona === tipoPersona) {
                $("#id_documento_identidad_tipo").append(
                    $("<option></option>").val(opcion.id_documento_identidad_tipo).text(opcion.documento_identidad_tipo)
                );
            }
        });
        //si el tipo persona es N ocultamos los items con clase juridico_
        if (tipoPersona === "J") {
            $(".natural_").hide();
            $(".juridico_").show();
        } else if (tipoPersona === "N") {

            $(".natural_").show();
            $(".juridico_").hide();
        }
    }

    function actExtension() {

        var tipoPersona = $('#tipoPersona').val();
        console.log("en actExtension");
        console.log("tipoPersona:" + tipoPersona);
        console.log("id_documento_identidad_tipo:" + $('#id_documento_identidad_tipo').val());
        $('#id_documento_identidad_extension').show();
        if (tipoPersona == 'N' && $('#id_documento_identidad_tipo').val() == 4) {
            $('#id_documento_identidad_extension').hide();
        }
        if (tipoPersona == 'N') {
            //$("#id_documento_identidad_extension" + " option[value='10']").remove();
            $("#id_documento_identidad_extension").empty();
            $("#id_documento_identidad_extension").append($("<option></option>").val('1').text('CH'));
            $("#id_documento_identidad_extension").append($("<option></option>").val('2').text('LP'));
            $("#id_documento_identidad_extension").append($("<option></option>").val('3').text('CB'));
            $("#id_documento_identidad_extension").append($("<option></option>").val('4').text('OR'));
            $("#id_documento_identidad_extension").append($("<option></option>").val('5').text('PO'));
            $("#id_documento_identidad_extension").append($("<option></option>").val('6').text('TJ'));
            $("#id_documento_identidad_extension").append($("<option></option>").val('7').text('SC'));
            $("#id_documento_identidad_extension").append($("<option></option>").val('8').text('BE'));
            $("#id_documento_identidad_extension").append($("<option></option>").val('9').text('PA'));
        }
        if (tipoPersona == 'N' && $('#id_documento_identidad_tipo').val() == 5) {
            $("#id_documento_identidad_extension").empty();
            $("#id_documento_identidad_extension").append(
                $("<option></option>").val('10').text('PE')
            );
            $("#id_documento_identidad_extension").val('10').change();
        }
    }
</script>

</html>