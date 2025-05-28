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
    <title>UF-PREDIAL</title>
    <?php
    echo $twig->render('linkStyle.twig');
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <style>
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


        .contenedorDigitaliza {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .card-header {
            padding: 15px 20px;
        }

        .card-body {
            padding: 25px;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            border-radius: 6px;
            padding: 10px 15px;
            border: 1px solid #ced4da;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn {
            border-radius: 6px;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background-color: #03c1f2;
            border-color: rgb(0, 139, 173);
        }

        .btn-primary:hover {
            background-color: rgb(11, 157, 215);
            border-color: rgb(10, 148, 202);
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5c636a;
            border-color: #565e64;
        }

        .btn-outline-secondary {
            color: #6c757d;
            border-color: #6c757d;
        }

        .btn-outline-secondary:hover {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
        }

        @media (max-width: 768px) {
            .contenedorDigitaliza {
                padding: 10px;
            }

            .card-body {
                padding: 15px;
            }

            .btn {
                width: 100%;
                margin-bottom: 10px;
            }

            .btn+.btn {
                margin-left: 0 !important;
            }
        }

        .flatpickr-calendar {
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .flatpickr-day.selected {
            background: #0d6efd;
            border-color: #0d6efd;
        }

        .flatpickr-day.selected:hover {
            background: #0b5ed7;
            border-color: #0a58ca;
        }

        .img-thumbnail {
            border-radius: 6px;
            border: 1px solid #dee2e6;
            transition: all 0.2s ease;
        }

        .img-thumbnail:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #mapContainer {
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        #mapContainer:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .buscar_ {
            margin: 0;
            border: 0;
            color: #14afdf;
            background: #ffffff;
        }

        .buscar_:hover {
            margin: 0;
            border: 0;
            color: rgb(6, 136, 196);
            background: #ffffff;
        }


        #btnObtenerUbicacion {
            white-space: nowrap;
        }

        #geoStatus {
            min-height: 24px;
        }

        @media (max-width: 768px) {
            #btnObtenerUbicacion {
                margin-top: 10px;
                border-radius: 6px;
            }

            .input-group {
                flex-direction: column;
            }

            .input-group>.form-control {
                width: 100%;
                border-radius: 6px !important;
            }

            #mapContainer {
                height: 180px;
                margin-top: 10px;
            }
        }

        #miniMap {
            z-index: 0;
        }



        #formInmueble {
            text-align: left;
            width: 100%;
        }

        #formInmueble label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
            font-size: 0.8rem;
        }

        #formInmueble input.swal2-input {
            width: 100% !important;
            margin: 5px 0 15px 0;
        }

        .table-container {
            overflow-x: auto;
        }

        .result-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .result-table th,
        .result-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
            font-size: 0.9rem;
        }

        .result-table th {
            background-color: #f2f2f2;
        }

        .seleccionar-btn {
            padding: 5px 10px;
            background-color: #3085d6;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .seleccionar-btn:hover {
            background-color: #2564a8;
        }

        .btn-buscar_ {
            padding: 5px 10px;
            background-color: #3085d6;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-buscar_:hover {
            background-color: #2564a8;
        }

        .swal-wide {
            max-width: 900px;
        }

        @media (max-width: 600px) {

            .result-table th,
            .result-table td {
                font-size: 12px;
                padding: 6px;
            }

            .swal2-popup {
                width: 95% !important;
            }
        }
    </style>
</head>

<body>
    <?php
    echo $twig->render('load.twig');
    ?>
    <?php
    echo $twig->render('menuIni.twig');

    if ($_SESSION['swlogin'] == '1') {
        echo $twig->render('menuLogin.twig', array('datSesion' => $_SESSION));
    } else {
        echo $twig->render('menuVisita.twig');
    }
    echo $twig->render('menuFin.twig');
    ?>
    <?php
    echo $twig->render('prebodyltIni.twig');
    ?>
    <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
    <li class="breadcrumb-item"><a class="text-white">UF</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page"><a class="text-white" href="ufPredialList.php">Predial</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page">Formulario</li>
    <?php
    echo $twig->render('prebodyltFin.twig');
    ?>

    <div class="container mt-5">
        <h1>Formulario de Registro de Inmueble <button class="buscar_" id="abrirFormulario"> <i class="fa fa-search" aria-hidden="true"></i> </button> </h1>
        <form id="formularioInmueble">
            <div class="row">

                <div class="col-md-12 mb-3">
                    <h5 class="border-bottom pb-2">Ubicación Geográfica</h5>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="geolocalizacion" class="form-label">Georreferencia <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="geolocalizacion" name="geolocalizacion" placeholder="Latitud, Longitud" readonly required>
                        <button class="btn btn-primary" type="button" id="btnObtenerUbicacion">
                            <i class="fa fa-map-marker me-1"></i> Obtener Ubicación
                        </button>
                    </div>
                    <div class="form-text">Haga clic en el botón para obtener la ubicación actual desde su dispositivo.</div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="mb-3" id="mapContainer" style="height: 300px;">
                        <div id="miniMap" style="height: 100%; width: 100%;"></div>
                    </div>
                    <div id="geoStatus" class="mt-2 small"></div>
                </div>


                <div class="col-md-6 mb-3">
                    <label for="numeroInmueble" class="form-label">Número de Inmueble</label>
                    <input type="number" class="form-control" id="numeroInmueble" min="1" name="numeroInmueble">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="codigo_catastro" class="form-label">Código catastral</label>
                    <input type="text" class="form-control" id="codigo_catastro" name="codigo_catastro">
                </div>
                <div class="col-md-12 mb-3">
                    <h5 class="border-bottom pb-2">Información del Inmueble</h5>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tipologia" class="form-label">Tipología <span class="text-danger">*</span></label>
                    <select class="form-select" id="tipologia" name="tipologia" required>
                        <option value="">Seleccione...</option>
                        <option value="MARGINAL">MARGINAL</option>
                        <option value="ECONOMICA">ECONOMICA</option>
                        <option value="INTERES SOCIAL">INTERES SOCIAL</option>
                        <option value="BUENA">BUENA</option>
                        <option value="MUY BUENA">MUY BUENA</option>
                        <option value="LUJOSO">LUJOSO</option>
                        <option value="NO DETERMINADO">NO DETERMINADO</option>
                        <option value="NO CORRESPONDE">NO CORRESPONDE</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="via" class="form-label">Material via <span class="text-danger">*</span></label>
                    <select class="form-select" id="via" name="via" required>
                        <option value="">Seleccione...</option>
                        <option value="TIERRA">TIERRA</option>
                        <option value="RIPIO">RIPIO</option>
                        <option value="PIEDRA">PIEDRA</option>
                        <option value="ADOQUIN">ADOQUIN</option>
                        <option value="LOSETA">LOSETA</option>
                        <option value="CEMENTO">CEMENTO</option>
                        <option value="LADRILLO">LADRILLO</option>
                        <option value="ASFALTO">ASFALTO</option>
                        <option value="NO DETERMINADO">NO DETERMINADO</option>
                        <option value="NO CORRESPONDE">NO CORRESPONDE</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="servicio" class="form-label">Servicios <span class="text-danger">*</span></label>
                    <div class="border rounded p-3">
                        <div class="row">
                            <div class="col-6 col-lg-4 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="servicioTodos" name="servicio[]">
                                    <label class="form-check-label" for="servicioTodos">Todos</label>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="2" id="servicioLuz" name="servicio[]">
                                    <label class="form-check-label" for="servicioLuz">LUZ</label>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="3" id="servicioAgua" name="servicio[]">
                                    <label class="form-check-label" for="servicioAgua">AGUA</label>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="4" id="servicioAlc" name="servicio[]">
                                    <label class="form-check-label" for="servicioAlc">ALCANTARILLADO</label>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="5" id="servicioGas" name="servicio[]">
                                    <label class="form-check-label" for="servicioGas">GAS</label>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="6" id="servicioTel" name="servicio[]">
                                    <label class="form-check-label" for="servicioTel">TELEFONO</label>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="7" id="servicioND" name="servicio[]">
                                    <label class="form-check-label" for="servicioND">NO DETERMINADO</label>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="8" id="servicioNC" name="servicio[]">
                                    <label class="form-check-label" for="servicioNC">NO CORRESPONDE</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="no_plantas" class="form-label">Número de plantas <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="no_plantas" min="1" name="no_plantas" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="no_concluidos" class="form-label">Construcciones concluidas <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="no_concluidos" min="1" name="no_concluidos" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="no_bruto" class="form-label">Construcciones en bruto</label>
                    <input type="number" class="form-control" id="no_bruto" min="1" name="no_bruto">
                </div>
                <div class="col-md-12 mb-3">
                    <h5 class="border-bottom pb-2">Ubicación</h5>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="distrito" class="form-label">Distrito <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="distrito" name="distrito" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="zona" class="form-label">Zona <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="zona" name="zona" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="calle" class="form-label">Calle(s) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="calle" name="calle" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="no_puerta" class="form-label">No puerta</label>
                    <input type="text" class="form-control" id="no_puerta" name="no_puerta">
                </div>
                <div class="col-md-12 mb-3">
                    <h5 class="border-bottom pb-2">Información Adicional</h5>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="descripcion" class="form-label">Descripción del Inmueble</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="no_formulario" class="form-label">No formulario</label>
                    <input type="text" class="form-control" id="no_formulario" name="no_formulario">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="hhrr_" class="form-label">HHRR</label>
                    <input type="text" class="form-control" id="hhrr_" name="hhrr_">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="fechaApersonamiento" class="form-label">fecha de apersonamiento</label>
                    <input type="text" class="form-control" id="fechaApersonamiento" name="fechaApersonamiento" value="<?php $fecha = new DateTime(date('Y-m-d'));
                                                                                                                        $fecha_ = $fecha->format('Y-m-d');
                                                                                                                        echo $fecha_; ?>">
                </div>
                <div class="col-md-12 mb-3">
                    <h5 class="border-bottom pb-2">Información de Contacto</h5>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nombre_titular" class="form-label">Nombre titular<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nombre_titular" name="nombre_titular" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nombre_apoderado" class="form-label">Nombre apoderado</label>
                    <input type="text" class="form-control" id="nombre_apoderado" name="nombre_apoderado">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="contactoTitular" class="form-label">Concato del titular</label>
                    <input type="tel" class="form-control" id="contactoTitular" name="contactoTitular">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="contactoApoderado" class="form-label">Contacto del apoderado</label>
                    <input type="tel" class="form-control" id="contactoApoderado" name="contactoApoderado">
                </div>
                <div class="col-md-12 mb-3">
                    <h5 class="border-bottom pb-2">Imágenes del Inmueble</h5>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="imagenPrincipal" class="form-label">Imagen Principal <span class="text-danger">*</span></label>
                    <input class="form-control" type="file" id="imagenPrincipal" name="imagenPrincipal" accept="image/*" capture="environment"
                        required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="imagenesAdicionales" class="form-label">Imágen Adicional</label>
                    <input class="form-control" type="file" id="imagenesAdicionales" name="imagenesAdicionales"
                        accept="image/*" capture="environment">
                </div>
                <div class="col-md-12 mb-3">
                    <h5 class="border-bottom pb-2">Video del Inmueble (Opcional)</h5>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="videoInmueble" class="form-label">URL del Video (YouTube, Vimeo, etc.)</label>
                    <input type="url" class="form-control" id="videoInmueble" name="videoInmueble">
                </div>
                <div class="col-md-12" style="text-align: center;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-floppy-o me-1"></i> Guardar
                    </button>
                    <span style="padding-left: 5rem;padding-right: 5rem;">|</span>
                    <button type="reset" class="btn btn-warning">
                        <i class="fa fa-eraser" aria-hidden="true"></i> Limpiar</button>
                </div>

            </div>

        </form>
    </div>
    <hr>
    <br>
    <?php
    echo $twig->render('linkJs.twig');
    ?>
</body>
<script src="../js/mainRecursoIa.js"></script>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
    $('#abrirFormulario').on('click', function() {
        Swal.fire({
            title: 'BÚSQUEDA DE INMUEBLE',
            html: `
            <div class="loadGral"></div>
        <div id="formInmueble">
            <label>NUMERO DE INMUEBLE</label>
            <input type="number" id="numInmueble" class="swal2-input">
        
            <label>CODIGO CATASTRAL</label>
            <input type="text" id="catastral" class="swal2-input" placeholder="XXX-XXX-XXX">

            <label>DOCUMENTO DE IDENTIFICACIÓN</label>
            <input type="text" id="documento" class="swal2-input" placeholder="6022061-1A">

            <label>NOMBRE DE TITULAR</label>
            <input type="text" id="nombreTitular" class="swal2-input" placeholder="Nombres Paterno Materno">


            <button id="buscarBtn" onclick="buscarInmueble()" class="swal2-confirm swal2-styled btn-buscar_"  >BUSCAR</button>

            <div id="resultados" style="margin-top:20px;">
                <h3 style="text-align:left;">RESULTADOS</h3>
                <div class="table-container">
                    <table class="result-table">
                        <thead>
                            <tr>
                                <th>No INMUEBLE</th>
                                <th>Catastro</th>
                                <th>C.I.</th>
                                <th>NOMBRE</th>
                                <th>DIRECCIÓN</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="bodyInmuebles"> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        `,
            showConfirmButton: false,
            width: '90%',
            customClass: {
                popup: 'swal-wide'
            }
        });
    });

    function buscarInmueble() {
        //#bodyInmuebles 

        var errores = [];
        var numInmueble = $("#numInmueble").val();
        var documento = $("#documento").val();
        var nombreTitular = $("#nombreTitular").val();
        var catastral = $("#catastral").val();
        if (numInmueble && numInmueble.length <= 8) {
            errores.push('El numero del inmueble tiene que tener mas de 8 caracteres');
        }
        if (catastral && catastral.length <= 5) {
            errores.push('El codigo catastral tiene que tener mas de 6 caracteres');
        }
        if (nombreTitular && nombreTitular.length <= 5) {
            errores.push('Agrega Nombre y apellido minimamente de la persona separado por un espacio');
        }
        if (documento && documento.length <= 4) {
            errores.push('El numero de documento tiene que tener mas de 5 digitos');
        }

        if (errores.length > 0) {
            var mensajeError = '<ul>';
            $.each(errores, function(index, error) {
                mensajeError += '<li>' + error + '</li>';
            });
            mensajeError += '</ul>';

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error de validación',
                    html: mensajeError
                });
            } else {
                alert('Por favor corrija los siguientes errores:\n' + errores.join('\n'));
            }
            return false;
        }

        datos =
            "&numInmueble=" + numInmueble +
            "&nombreTitular=" + nombreTitular +
            "&documento=" + documento;

        $.ajax({
            async: true,
            type: "POST",
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            url: "../php/ufPredialGet.php",
            data: datos,
            beforeSend: function() {
                loadGralOn();
            },
            success: function(dat) {
                dat = JSON.parse(dat)
                loadGralOff();
                $('#bodyInmuebles').html(dat.html);

                $("#numInmueble").val();
                $("#documento").val('');
                $("#nombreTitular").val('');
                $("#catastral").val('');
            },
        });


    }

    function seleccionarInmueble(cnt) {

        Swal.close();
        $('#numeroInmueble').val($('#numero_inmueble' + cnt).val());
        $('#codigo_catastro').val($('#codigo_catastral' + cnt).val());
        $('#nombre_titular').val($('#nombre_tit' + cnt).val());
        $('#nombre_apoderado').val($('#nombre_apo' + cnt).val());
        $('#contactoTitular').val($('#telefono_celular' + cnt).val());
        $('#distrito').val($('#ubicacion_nivel1' + cnt).val());
        $('#zona').val($('#ubicacion_nivel2' + cnt).val());
        $('#calle').val($('#ubicacion_nivel3' + cnt).val());
        $('#no_puerta').val($('#numero_puerta' + cnt).val());
        $('#descripcion').val($('#direccion_descriptiva' + cnt).val());
        $('#via').val($('#material_via' + cnt).val());
        $('#tipologia').val($('#tipo_construccion' + cnt).val());

        $('#no_plantas').val($('#no_plantas' + cnt).val());
        $('#no_concluidos').val($('#no_concluidos' + cnt).val());
        $('#no_bruto').val($('#no_brutos' + cnt).val());
        $('#contacto_apoderado').val($('#contacto_apoderado' + cnt).val());

        var servicio = ($('#servicio_uf' + cnt).val() ? $('#servicio_uf' + cnt).val() : $('#servicio' + cnt).val());

        // Convertir la cadena a un array y limpiar espacios
        var listaServicios = servicio.split(',').map(function(item) {
            return item.trim().toUpperCase();
        });

        $('input[name="servicio[]"]').each(function() {
            var labelTexto = $(this).closest('.form-check').find('label').text().trim().toUpperCase();

            if (listaServicios.includes(labelTexto)) {
                $(this).prop('checked', true);
            } else {
                $(this).prop('checked', false);
            }
        });

    }

    /* function setupGeolocation() {
        const btnObtenerUbicacion = document.getElementById("btnObtenerUbicacion");
        const geolocalizacionInput = document.getElementById("geolocalizacion");
        const geoStatus = document.getElementById("geoStatus");
        const mapContainer = document.getElementById("mapContainer");
        const miniMap = document.getElementById("miniMap");

        if (!btnObtenerUbicacion || !geolocalizacionInput || !geoStatus) {
            console.warn("No se encontraron los elementos necesarios para la geolocalización");
            return;
        }

        btnObtenerUbicacion.addEventListener("click", () => {
            // Verificar si el navegador soporta geolocalización
            if (!navigator.geolocation) {
                geoStatus.innerHTML = '<span class="text-danger">Error: Su navegador no soporta geolocalización.</span>';
                return;
            }

            // Mostrar estado de carga
            geoStatus.innerHTML = '<span class="text-info"><i class="fa fa-spinner fa-spin"></i> Obteniendo ubicación...</span>';

            // Opciones para la geolocalización
            const options = {
                enableHighAccuracy: true, // Alta precisión
                timeout: 10000, // 10 segundos de timeout
                maximumAge: 0, // No usar cache
            };

            // Obtener la posición actual
            navigator.geolocation.getCurrentPosition(
                // Éxito
                (position) => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    const accuracy = position.coords.accuracy;

                    // Formatear y mostrar las coordenadas
                    geolocalizacionInput.value = `${latitude}, ${longitude}`;
                    geoStatus.innerHTML = `<span class="text-success">
                    <i class="fa fa-check-circle"></i> Ubicación obtenida con precisión de ${Math.round(accuracy)} metros
                </span>`;

                    // Mostrar el mapa
                    if (mapContainer && miniMap) {
                        mapContainer.style.display = "block";

                        // Verificar si Leaflet está disponible
                        if (typeof L !== "undefined") {
                            // Inicializar el mapa con Leaflet
                            const map = L.map(miniMap).setView([latitude, longitude], 15);

                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            }).addTo(map);

                            L.marker([latitude, longitude]).addTo(map);
                        } else {
                            // Alternativa si Leaflet no está disponible
                            miniMap.innerHTML = `
                            <div class="d-flex justify-content-center align-items-center h-100 bg-light">
                                <p class="text-center text-muted">
                                    <i class="fa fa-map-marker fa-2x mb-2"></i><br>
                                    Ubicación capturada:<br>
                                    Lat: ${latitude.toFixed(6)}<br>
                                    Lng: ${longitude.toFixed(6)}
                                </p>
                            </div>
                        `;
                            console.warn('Leaflet (L) no está disponible. Asegúrate de incluir la biblioteca correctamente.');
                        }
                    }
                },
                // Error
                (error) => {
                    let errorMessage = "";
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            errorMessage = "Usuario denegó la solicitud de geolocalización.";
                            break;
                        case error.POSITION_UNAVAILABLE:
                            errorMessage = "La información de ubicación no está disponible.";
                            break;
                        case error.TIMEOUT:
                            errorMessage = "Se agotó el tiempo para obtener la ubicación.";
                            break;
                        case error.UNKNOWN_ERROR:
                            errorMessage = "Ocurrió un error desconocido.";
                            break;
                    }
                    geoStatus.innerHTML = `<span class="text-danger"><i class="fa fa-exclamation-circle"></i> Error: ${errorMessage}</span>`;
                    if (mapContainer) {
                        mapContainer.style.display = "none";
                    }
                },
                options
            );
        });
    } */

    function setupGeolocation() {
        const btnObtenerUbicacion = document.getElementById("btnObtenerUbicacion");
        const geolocalizacionInput = document.getElementById("geolocalizacion");
        const geoStatus = document.getElementById("geoStatus");
        const miniMap = document.getElementById("miniMap");

        let map = null;
        let marker = null;

        // Inicializar el mapa visible por defecto en El Alto
        if (typeof L !== "undefined" && miniMap) {
            map = L.map(miniMap).setView([-16.5, -68.15], 13); // Vista predeterminada

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'DATM'
            }).addTo(map);

            // Permitir selección manual en cualquier momento
            map.on('click', function(e) {
                const {
                    lat,
                    lng
                } = e.latlng;

                if (marker) {
                    marker.setLatLng([lat, lng]);
                } else {
                    marker = L.marker([lat, lng]).addTo(map);
                }

                geolocalizacionInput.value = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
                geoStatus.innerHTML = `<span class="text-success">
                <i class="fa fa-check-circle"></i> Ubicación seleccionada manualmente.
            </span>`;
            });
        }

        if (!btnObtenerUbicacion || !geolocalizacionInput || !geoStatus) {
            console.warn("No se encontraron los elementos necesarios para la geolocalización");
            return;
        }

        // Botón de geolocalización automática
        btnObtenerUbicacion.addEventListener("click", () => {
            if (!navigator.geolocation) {
                geoStatus.innerHTML = '<span class="text-danger">Error: Su navegador no soporta geolocalización.</span>';
                return;
            }

            geoStatus.innerHTML = '<span class="text-info"><i class="fa fa-spinner fa-spin"></i> Obteniendo ubicación...</span>';

            const options = {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0,
            };

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    const accuracy = position.coords.accuracy;

                    geolocalizacionInput.value = `${latitude}, ${longitude}`;
                    geoStatus.innerHTML = `<span class="text-success">
                    <i class="fa fa-check-circle"></i> Ubicación obtenida con precisión de ${Math.round(accuracy)} metros
                </span>`;

                    if (map) {
                        map.setView([latitude, longitude], 15);

                        if (marker) {
                            marker.setLatLng([latitude, longitude]);
                        } else {
                            marker = L.marker([latitude, longitude]).addTo(map);
                        }
                    }
                },
                (error) => {
                    let errorMessage = "";
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            errorMessage = "Usuario denegó la solicitud de geolocalización.";
                            break;
                        case error.POSITION_UNAVAILABLE:
                            errorMessage = "La información de ubicación no está disponible.";
                            break;
                        case error.TIMEOUT:
                            errorMessage = "Se agotó el tiempo para obtener la ubicación.";
                            break;
                        default:
                            errorMessage = "Ocurrió un error desconocido.";
                    }
                    geoStatus.innerHTML = `<span class="text-danger"><i class="fa fa-exclamation-circle"></i> Error: ${errorMessage}</span>`;
                },
                options
            );
        });
    }


    $(document).ready(function() {

        setupGeolocation();

        $('.select2Servicio').select2({
            placeholder: "Selecciona",
            allowClear: true
        });

        if (typeof flatpickr !== "undefined") {
            flatpickr("#fechaApersonamiento", {
                dateFormat: "Y-m-d",
                locale: "es",
                maxDate: "today",
                altInput: true,
                altFormat: "d/m/Y",
                allowInput: true,
            })
        } else {
            console.warn("Flatpickr no está disponible. Asegúrate de incluir la librería.")
        }

        // Create preview containers
        $("#imagenPrincipal").after('<div id="imagenPrincipalPreview" class="mt-2 image-preview-container"></div>')
        $("#imagenesAdicionales").after(
            '<div id="imagenesAdicionalesPreview" class="mt-2 d-flex flex-wrap gap-2 image-preview-container"></div>',
        )

        // Add CSS for preview containers
        $("head").append(`
    <style>
      .image-preview-container {
        min-height: 100px;
      }
      .preview-item {
        position: relative;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
        margin-bottom: 10px;
        background-color: #f8f9fa;
      }
      .preview-item img {
        max-width: 100%;
        max-height: 200px;
        display: block;
        margin: 0 auto;
      }
      .preview-item .preview-info {
        font-size: 12px;
        color: #6c757d;
        margin-top: 5px;
        text-align: center;
      }
      .preview-item .remove-image {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: rgba(255, 255, 255, 0.7);
        border-radius: 50%;
        width: 24px;
        height: 24px;
        text-align: center;
        line-height: 24px;
        cursor: pointer;
        color: #dc3545;
      }
      .compression-slider {
        width: 100%;
        margin: 10px 0;
      }
      .compression-value {
        text-align: center;
        font-weight: bold;
      }
    </style>
  `)

        // Global variable to store compressed images
        let compressedImages = {
            main: null,
            additional: [],
        }

        // Default compression quality
        let compressionQuality = 0.7

        // Add compression quality slider
        $("#imagenPrincipal").after(`
    <div class="mt-2">
        <label for="compressionQuality" class="form-label">Calidad de compresión: <span id="qualityValue">70%</span></label>
        <input type="range" class="form-range compression-slider" id="compressionQuality" min="0.1" max="1" step="0.1" value="0.7">
        </div>
    `)

        // Update compression quality value when slider changes
        $("#compressionQuality").on("input", function() {
            compressionQuality = Number.parseFloat($(this).val())
            $("#qualityValue").text(Math.round(compressionQuality * 100) + "%")
        })

        // Handle main image selection
        $("#imagenPrincipal").on("change", (e) => {
            const file = e.target.files[0]
            if (!file) return

            if (!file.type.match("image.*")) {
                alert("Por favor seleccione una imagen válida")
                return
            }

            // Clear previous preview
            $("#imagenPrincipalPreview").empty()

            // Show loading indicator
            $("#imagenPrincipalPreview").html(
                '<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Procesando imagen...</div>',
            )

            // Create preview with original image
            const reader = new FileReader()
            reader.onload = (e) => {
                const originalSize = (file.size / 1024).toFixed(2)

                // Compress the image
                compressImage(file, compressionQuality)
                    .then((compressedBlob) => {
                        compressedImages.main = new File([compressedBlob], file.name, {
                            type: "image/jpeg",
                            lastModified: new Date().getTime(),
                        })

                        const compressedSize = (compressedBlob.size / 1024).toFixed(2)
                        const savings = (100 - (compressedBlob.size / file.size) * 100).toFixed(2)

                        // Create preview element
                        $("#imagenPrincipalPreview").html(`
          <div class="preview-item">
            <img src="${URL.createObjectURL(compressedBlob)}" alt="Vista previa">
            <div class="preview-info">
              <strong>${file.name}</strong><br>
              Original: ${originalSize} KB | Comprimido: ${compressedSize} KB | Ahorro: ${savings}%
            </div>
            <div class="remove-image" title="Eliminar imagen"><i class="fa fa-times"></i></div>
          </div>
        `)

                        // Handle remove button
                        $(".remove-image").on("click", () => {
                            $("#imagenPrincipal").val("")
                            $("#imagenPrincipalPreview").empty()
                            compressedImages.main = null
                        })
                    })
                    .catch((err) => {
                        console.error("Error comprimiendo imagen:", err)
                        $("#imagenPrincipalPreview").html('<div class="alert alert-danger">Error al procesar la imagen</div>')
                    })
            }
            reader.readAsDataURL(file)
        })

        // Handle additional images selection
        $("#imagenesAdicionales").on("change", (e) => {
            const files = e.target.files
            if (!files || files.length === 0) return

            // Clear previous previews
            $("#imagenesAdicionalesPreview").empty()
            compressedImages.additional = []

            // Process each file
            Array.from(files).forEach((file, index) => {
                if (!file.type.match("image.*")) {
                    return
                }

                // Create a placeholder for this image
                const previewId = `additional-preview-${index}`
                $("#imagenesAdicionalesPreview").append(`
        <div id="${previewId}" class="preview-item" style="width: 200px;">
            <div class="text-center"><i class="fa fa-spinner fa-spin"></i> Procesando...</div>
            </div>
        `)

                // Compress the image
                compressImage(file, compressionQuality)
                    .then((compressedBlob) => {
                        const compressedFile = new File([compressedBlob], file.name, {
                            type: "image/jpeg",
                            lastModified: new Date().getTime(),
                        })

                        compressedImages.additional.push(compressedFile)

                        const originalSize = (file.size / 1024).toFixed(2)
                        const compressedSize = (compressedBlob.size / 1024).toFixed(2)
                        const savings = (100 - (compressedBlob.size / file.size) * 100).toFixed(2)

                        // Update the placeholder with the actual preview
                        $(`#${previewId}`).html(`
            <img src="${URL.createObjectURL(compressedBlob)}" alt="Vista previa">
            <div class="preview-info">
                <strong>${file.name.substring(0, 15)}${file.name.length > 15 ? "..." : ""}</strong><br>
                Original: ${originalSize} KB | Comprimido: ${compressedSize} KB
            </div>
            <div class="remove-image" data-index="${index}" title="Eliminar imagen"><i class="fa fa-times"></i></div>
        `)
                    })
                    .catch((err) => {
                        console.error("Error comprimiendo imagen adicional:", err)
                        $(`#${previewId}`).html('<div class="alert alert-danger">Error al procesar</div>')
                    })
            })

            // Handle remove buttons for additional images (delegated event)
            $("#imagenesAdicionalesPreview").on("click", ".remove-image", function() {
                const index = $(this).data("index")
                $(this).closest(".preview-item").remove()

                // We can't easily remove just one file from the file input, so we'll handle this during form submission
                compressedImages.additional[index] = null
            })
        })

        $("#formularioInmueble").submit(function(event) {
            if ($.data(this, "submitted")) return true

            event.preventDefault();

            var errores = [];

            $('input[required], select[required], textarea[required]').each(function() {
                if ($(this).val() === '') {
                    var labelText = $(this).prev('label').text().replace(' *', '');
                    errores.push('El campo "' + labelText + '" es obligatorio');
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            // Validar geolocalización
            if ($('#geolocalizacion').val() === '') {
                errores.push('Debe obtener la geolocalización del inmueble');
                $('#geolocalizacion').addClass('is-invalid');
            }

            // Validar formato de teléfono
            var telefonoRegex = /^\d{8}$/;
            if ($('#contactoTitular').val() !== '' && !telefonoRegex.test($('#contactoTitular').val())) {
                errores.push('El teléfono del titular debe tener 8 dígitos');
                $('#contactoTitular').addClass('is-invalid');
            }

            if ($('#contactoApoderado').val() !== '' && !telefonoRegex.test($('#contactoApoderado').val())) {
                errores.push('El teléfono del apoderado debe tener 8 dígitos');
                $('#contactoApoderado').addClass('is-invalid');
            }

            if ($('#imagenPrincipal')[0].files.length === 0) {
                errores.push('Debe seleccionar una imagen principal');
                $('#imagenPrincipal').addClass('is-invalid');
            }

            if (errores.length > 0) {

                var mensajeError = '<ul>';
                $.each(errores, function(index, error) {
                    mensajeError += '<li>' + error + '</li>';
                });
                mensajeError += '</ul>';

                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de validación',
                        html: mensajeError
                    });
                } else {
                    alert('Por favor corrija los siguientes errores:\n' + errores.join('\n'));
                }

                return false;
            }

            const formData = new FormData(this)

            if (compressedImages.main) {
                formData.set("imagenPrincipal", compressedImages.main)
            }

            formData.delete("imagenesAdicionales")

            compressedImages.additional.forEach((file, index) => {
                if (file) {
                    formData.append("imagenesAdicionales[]", file)
                }
            })

            if (typeof Swal !== "undefined") {
                Swal.fire({
                    title: "Enviando datos",
                    text: "Por favor espere mientras se suben las imágenes comprimidas...",
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    },
                })
            }

            $.ajax({
                url: "../php/ufPredialSave.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    console.log("Respuesta del servidor:", response);

                    if (typeof response === 'string') {
                        try {
                            response = JSON.parse(response);
                        } catch (e) {
                            console.error("Error parsing JSON response:", e);
                        }
                    }

                    if (response.err === '0') {
                        if (typeof Swal !== "undefined") {
                            Swal.fire({
                                icon: "success",
                                title: "Éxito",
                                text: response.msg || "Los datos se han guardado correctamente",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "ufPredialList.php";
                                }
                            });
                        } else {
                            alert("Los datos se han guardado correctamente");
                        }

                        // Reset the form
                        $("#formularioInmueble")[0].reset();
                        $("#imagenPrincipalPreview, #imagenesAdicionalesPreview").empty();
                        compressedImages = {
                            main: null,
                            additional: []
                        };
                    } else {
                        if (typeof Swal !== "undefined") {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: response.msg || "Ocurrió un error al guardar los datos",
                            });
                        } else {
                            alert("Error: " + (response.msg || "Ocurrió un error al guardar los datos"));
                        }
                        console.error("Error details:", response.log);
                    }
                },
                error: (xhr, status, error) => {
                    console.error("Error en la solicitud Ajax:", error);

                    // Try to parse response if available
                    let errorMessage = "No se pudo conectar con el servidor. Por favor, inténtelo de nuevo.";
                    try {
                        if (xhr.responseText) {
                            const errorResponse = JSON.parse(xhr.responseText);
                            if (errorResponse.msg) {
                                errorMessage = errorResponse.msg;
                            }
                        }
                    } catch (e) {
                        console.error("Error parsing error response:", e);
                    }

                    if (typeof Swal !== "undefined") {
                        Swal.fire({
                            icon: "error",
                            title: "Error de conexión",
                            text: errorMessage,
                        });
                    } else {
                        alert("Error de conexión: " + errorMessage);
                    }
                },
            });

            // Mark as submitted to prevent double submission
            $.data(this, "submitted", true)
            return false
        })

        // Image compression function
        function compressImage(image, quality) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader()

                reader.onload = (event) => {
                    const img = new Image()
                    img.src = event.target.result

                    img.onload = () => {
                        // Calculate new dimensions while maintaining aspect ratio
                        let width = img.width
                        let height = img.height

                        // Limit max dimensions to 1600px (optional, for very large images)
                        const maxDimension = 1600
                        if (width > maxDimension || height > maxDimension) {
                            if (width > height) {
                                height = Math.round(height * (maxDimension / width))
                                width = maxDimension
                            } else {
                                width = Math.round(width * (maxDimension / height))
                                height = maxDimension
                            }
                        }

                        const canvas = document.createElement("canvas")
                        const ctx = canvas.getContext("2d")

                        canvas.width = width
                        canvas.height = height

                        // Draw image on canvas
                        ctx.drawImage(img, 0, 0, width, height)

                        // Convert to blob with specified quality
                        canvas.toBlob(
                            (blob) => {
                                resolve(blob)
                            },
                            "image/jpeg",
                            quality,
                        )
                    }

                    img.onerror = (error) => {
                        reject(error)
                    }
                }

                reader.onerror = (error) => {
                    reject(error)
                }

                reader.readAsDataURL(image)
            })
        }
    })
</script>

</html>