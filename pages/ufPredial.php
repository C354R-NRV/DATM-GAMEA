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
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
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
            position: relative;
            height: 300px;
        }

        #mapContainer:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Estilos para el mapa en pantalla completa */
        #mapContainer.fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw !important;
            height: 100vh !important;
            z-index: 9999;
            border-radius: 0;
            margin: 0;
        }

        /* Estilos para el botón de pantalla completa */
        .control-button.fullscreen {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .control-button.fullscreen.active {
            background-color: rgba(255, 0, 0, 0.8);
        }

        /* Estilos para el botón de oscurecer */
        .control-button.oscurecer {
            background-color: rgba(50, 50, 50, 0.8);
        }

        .control-button.oscurecer.geojson-active {
            background-color: rgba(75, 75, 75, 0.9);
        }

        .control-button.oscurecer:hover {
            background-color: rgba(75, 75, 75, 0.9);
        }

        /* Estilos para el overlay oscuro */
        .dark-overlay {
            fill: rgba(0, 0, 0, 0.7);
            stroke: rgba(100, 100, 100, 0.8);
            stroke-width: 2;
            stroke-dasharray: 5, 5;
            transition: fill 0.3s ease;
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

        .minimap-controls {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .control-button {
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            border: none;
            border-radius: 4px;
            width: 30px;
            height: 30px;
            font-size: 0.9rem;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            outline: none !important;
            -webkit-tap-highlight-color: transparent;
        }

        .control-button:hover {
            background-color: rgba(0, 0, 0, 0.9);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.4);
            transform: translateY(-1px);
        }

        .control-button:active {
            transform: translateY(0);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        .control-button:disabled {
            background-color: rgba(100, 100, 100, 0.6);
            cursor: not-allowed;
            transform: none;
        }

        .control-button.loading {
            background-color: rgba(50, 50, 50, 0.8);
        }

        .control-button:focus {
            outline: none !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3) !important;
        }

        .control-button.satelital {
            background-color: rgba(29, 25, 22, 0.8);
        }

        .control-button.satelital.tesela-active {
            background-color: rgba(34, 39, 41, 0.9);
            color: white;
        }

        .control-button.satelital:hover {
            background-color: rgba(36, 29, 27, 0.9)
        }

        .control-button.tesela-active:hover {
            background-color: rgba(33, 36, 37, 0.9);
        }

        /* Nuevos estilos para botones de inmuebles y códigos */
        .control-button.geojson-codigos {
            background-color: rgba(255, 165, 0, 0.8);
        }

        .control-button.geojson-codigos.geojson-active {
            background-color: rgba(255, 165, 0, 0.9);
            color: white;
        }

        .control-button.geojson-codigos:hover {
            background-color: rgba(255, 140, 0, 0.9);
        }

        .control-button.geojson-active {
            background-color: rgba(0, 200, 255, 0.9);
            color: white;
        }

        .control-button.geojson-active:hover {
            background-color: rgba(0, 180, 230, 0.9);
        }

        /* Estilos para marcadores de códigos */
        .codigo-marker {
            background-color: #FFA500;
            color: black;
            border: 2px solid white;
            border-radius: 5%;
            width: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            animation: pulseAnimation 6s infinite ease-in-out;
        }

        .codigo-markerInm {
            background-color: #FFA500;
            color: black;
            border: 2px solid white;
            border-radius: 50%;
            width: 1.3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            animation: pulseAnimation 6s infinite ease-in-out;
        }

        @keyframes pulseAnimation {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.15);
                opacity: 0.85;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Indicador de carga dinámica */
        .dynamic-loading-indicator {
            position: absolute;
            top: 60px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            background-color: rgba(0, 200, 255, 0.9);
            color: white;
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 0.75rem;
            display: none;
            animation: pulseAnimation 1s infinite ease-in-out;
        }

        .status-message {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 0.875rem;
            display: none;
            white-space: nowrap;
        }

        .status-message.error {
            background-color: rgba(255, 0, 0, 0.8);
        }

        .status-message.success {
            background-color: rgba(0, 200, 0, 0.8);
        }

        @media (max-width: 768px) {
            .control-button {
                width: 35px;
                height: 35px;
                font-size: 1rem;
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            .minimap-controls {
                top: 5px;
                right: 5px;
                gap: 3px;
            }
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

        #formInmueble select.swal2-input {
            width: 27% !important;
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










        /* Estilos para el botón de pre-puntos */
        .control-button.pre-puntos {
            background-color: rgba(255, 215, 0, 0.8);
            color: black;
        }

        .control-button.pre-puntos.active {
            background-color: rgba(255, 215, 0, 0.9);
            color: black;
        }

        .control-button.pre-puntos:hover {
            background-color: rgba(255, 215, 0, 0.9);
        }

        /* Estilos para los marcadores de pre-puntos */
        .pre-punto-marker {
            background-color: #feff12;
            width: 0.9rem;
            height: 0.9rem;
            border-radius: 50%;
            box-shadow: 0 0 6px #fff, 0 0 0.9rem #fff, 0 0 18px rgb(176, 193, 23), 0 0 24px rgb(193, 190, 23), 0 0 30px rgb(248, 231, 76), 0 0 36px rgb(237, 248, 76);
            border: 2px solid rgb(0, 0, 0);
            animation: pulseAnimation 5s infinite ease-in-out;
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
        <h1>Formulario de Registro de Inmueble</h1>
        <div style="text-align:right;"><button class="buscar_" id="abrirFormulario" type="button">Busqueda de inmueble <i class="fa fa-search" aria-hidden="true"></i> </button></div>
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
                    <div class="form-text">Abrir coordenada en <a id="googlemap" href="#" target="_blank">google maps.</a></div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="mb-3" id="mapContainer" style="height: 300px;">
                        <div id="miniMap" style="height: 100%; width: 100%;"></div>
                        <div class="minimap-controls">
                            <button id="zoomInBtn" type="button" class="control-button" title="Acercar" aria-label="Acercar mapa">+</button>
                            <button id="zoomOutBtn" type="button" class="control-button" title="Alejar" aria-label="Alejar mapa">−</button>
                            <button id="inmueblesBtn" class="control-button geojson-codigos" title="Mostrar/Ocultar Inmuebles" aria-label="Capa Inmuebles" style="outline-style: none;">
                                <i class="fa fa-home" aria-hidden="true"></i>
                            </button>
                            <button id="codigosBtn" class="control-button geojson-codigos" title="Mostrar/Ocultar Códigos" aria-label="Capa Códigos">
                                <i class="fa fa-tags" aria-hidden="true"></i>
                            </button>
                            <button id="satelitalBtn" type="button" class="control-button satelital tesela-active" title="Mostrar/Ocultar Capa Satelital" aria-label="Capa Satelital">
                                <i class="fa fa-globe" aria-hidden="true"></i>
                            </button>
                            <button id="oscurecerBtn" class="control-button oscurecer" title="Oscurecer El Alto" aria-label="Oscurecer El Alto" style="outline-style: none;">
                                <i class="fa fa-moon-o" aria-hidden="true"></i>
                            </button>
                            <button id="fullscreenBtn" class="control-button fullscreen" title="Pantalla Completa" aria-label="Pantalla Completa">
                                <i class="fa fa-expand" aria-hidden="true"></i>
                            </button>
                            <button id="prePuntosBtn" class="control-button pre-puntos" title="Buscar Pre-Puntos" aria-label="Buscar Pre-Puntos">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div id="statusMessage" class="status-message" role="alert"></div>
                        <div id="dynamicLoadingIndicator" class="dynamic-loading-indicator">Cargando datos...</div>
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
                    <label for="hhrr_" class="form-label">Hoja de ruta</label>
                    <input type="text" class="form-control" id="hhrr_" name="hhrr_">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="fechaApersonamiento" class="form-label">fecha de apersonamiento</label>
                    <input type="text" class="form-control" id="fechaApersonamiento" name="fechaApersonamiento" value="<?php $fecha = new DateTime(date('Y-m-d'));
                                                                                                                        $fecha_ = $fecha->format('Y-m-d');
                                                                                                                        echo $fecha_; ?>">
                </div>


                <div class="col-md-6 mb-3">
                    <label for="nombre_titular" class="form-label">Cantidad de actividades economicas<span class="text-danger">*</span></label>
                    <input type="number" min="0" class="form-control" id="cant_act" name="cant_act">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="contactoTitular" class="form-label">Descripción de la(s) act. </label>
                    <textarea class="form-control" id="descripcion_act" name="descripcion_act" rows="1"></textarea>
                </div>


                <div class="col-md-12 mb-3">
                    <h5 class="border-bottom pb-2">Información de Contacto</h5>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nombre_titular" class="form-label">Nombre titular<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nombre_titular" name="nombre_titular" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="contactoTitular" class="form-label">Concato del titular</label>
                    <input type="tel" class="form-control" id="contactoTitular" name="contactoTitular">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nombre_apoderado" class="form-label">Nombre apoderado</label>
                    <input type="text" class="form-control" id="nombre_apoderado" name="nombre_apoderado">
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
<script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
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
            <div style="width:100vh;">
            <label>UBICACION NIVEL 1, DISTRITO</label>   
            <select id= "ubicacion1" class="swal2-input select2_1" onchange="cargarNivel(2);">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="NO DEFINIDO">NO DEFINIDO</option>
                <option value="OTRA JURISDICCION">OTRA JURISDICCION</option>
                <option value="TODOS" selected>TODOS</option>
            </select> 

            <select id= "ubicacion2" class="swal2-input select2_2" multiple onchange="cargarNivel(3);"></select> 

            <select id= "ubicacion3" class="swal2-input select2_3" multiple></select>
            </div>

            <label>NUMERO DE INMUEBLE</label>
            <input type="text" id="numInmueble" class="swal2-input">
        
            <label>CODIGO CATASTRAL</label>
            <input type="text" id="catastral" class="swal2-input" placeholder="XXX-XXX-XXX">

            <label>DOCUMENTO DE IDENTIFICACIÓN</label>
            <input type="text" id="documento" class="swal2-input" placeholder="6022061-1A">

            <label>NOMBRE DE TITULAR</label>
            <input type="text" id="nombreTitular" class="swal2-input" placeholder="Nombres Paterno Materno">
            
            
            <label>NUMERO DE PLACA - VEHICULO CIRCUNDANTE</label>
            <input type="text" id="no_placa" class="swal2-input" placeholder="Numero de placa sin GUION y continuado">
            
            <label>NOMBRE DEL LOCAL COMERCIAL</label>
            <input type="text" id="actividad_eco" class="swal2-input" placeholder="Escriba exactamente el nombre del local comercial expuesto en dicho local, no incluya palabras como : local, salon, tienda.">

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
            didOpen: () => {

                $('.select2_1').select2({
                    dropdownParent: $('.swal2-popup'),
                    placeholder: "Seleccione",
                    allowClear: true,
                    tags: true
                });
            },
            showConfirmButton: false,
            width: '90%',
            customClass: {
                popup: 'swal-wide'
            }
        });
    });

    function buscarInmueble() {
        var errores = [];
        var numInmueble = $("#numInmueble").val();
        var documento = $("#documento").val();
        var nombreTitular = $("#nombreTitular").val();
        var catastral = $("#catastral").val();
        var actividad_eco = $("#actividad_eco").val();
        var no_placa = $("#no_placa").val();
        var ubicacion1 = $("#ubicacion1").val();
        var ubicacion2 = $("#ubicacion2").val();
        var ubicacion3 = $("#ubicacion3").val();



        if (numInmueble && numInmueble.length <= 4) {
            errores.push('El numero del inmueble tiene que tener más de 4 caracteres');
        }
        if (catastral && catastral.length <= 3) {
            errores.push('El codigo catastral tiene que tener más de 4 caracteres');
        }
        if (nombreTitular && nombreTitular.length <= 4) {
            errores.push('Agrega Nombre y/o apellido minimamente de la persona, tambien separado por un espacio, con una cantidad de 4 caracteres');
        }
        if (documento && documento.length <= 4) {
            errores.push('El numero de documento tiene que tener más de 5 digitos');
        }
        if (actividad_eco && actividad_eco.length <= 3) {
            errores.push('El nombre de la actividad economica tiene que tener más de 3 digitos');
        }
        if (no_placa && no_placa.length <= 4) {
            errores.push('El numero de placa tiene que tener más de 4 digitos');
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
            "&actividad_eco=" + actividad_eco +
            "&no_placa=" + no_placa +
            "&catastral=" + catastral +
            "&ubicacion1=" + ubicacion1 +
            "&ubicacion2=" + ubicacion2 +
            "&ubicacion3=" + ubicacion3 +
            "&documento=" + documento;
        console.log(datos);
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
                console.log(dat);
                dat = JSON.parse(dat)
                console.log(dat.sql);
                loadGralOff();
                $('#bodyInmuebles').html(dat.html);

                $("#numInmueble").val('');
                $("#documento").val('');
                $("#nombreTitular").val('');
                $("#catastral").val('');
                $("#no_placa").val('');
                $("#actividad_eco").val('');
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

    function setupGeolocation() {
        const btnObtenerUbicacion = document.getElementById("btnObtenerUbicacion");
        const geolocalizacionInput = document.getElementById("geolocalizacion");
        const geoStatus = document.getElementById("geoStatus");
        const miniMap = document.getElementById("miniMap");

        let map = null;
        let marker = null;
        let satelliteLayer = null;
        let satelitalActive = true;

        // Variables para las nuevas capas GeoJSON
        let codigosGeoJSONData = [];
        let codigosGeoJSONDataInm = [];
        let codigosLayer = null;
        let codigosLayerInm = null;
        let codigosActive = false;
        let inmueblesActive = false;
        let isGeoJsonLoading = false;
        let dynamicLoadingTimer;


        // Variables para la capa de pre-puntos
        let prePuntosLayer = null;
        let prePuntosActive = false;
        let prePuntosData = [];


        // Función para buscar pre-puntos
        function buscarPrePuntos() {
            const bounds = map.getBounds();
            const sw = bounds.getSouthWest();
            const ne = bounds.getNorthEast();

            const datos = {
                minLat: sw.lat,
                maxLat: ne.lat,
                minLng: sw.lng,
                maxLng: ne.lng
            };

            showStatusMessage('Buscando pre-puntos...', 'info');

            $.ajax({
                url: '../php/ufGetPrePuntos.php',
                type: 'POST',
                dataType: 'json',
                data: datos,
                beforeSend: function() {
                    $('#prePuntosBtn').addClass('loading');
                },
                success: function(response) {
                    if (response.success) {
                        prePuntosData = response.data;
                        renderPrePuntos();
                        showStatusMessage(`Se encontraron ${prePuntosData.length} pre-puntos`, 'success');
                    } else {
                        showStatusMessage('Error: ' + response.message, 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error en la búsqueda de pre-puntos:', error);
                    showStatusMessage('Error al buscar pre-puntos', 'error');
                },
                complete: function() {
                    $('#prePuntosBtn').removeClass('loading');
                }
            });
        }

        // Función para renderizar pre-puntos en el mapa
        function renderPrePuntos() {
            // Remover capa anterior si existe
            if (prePuntosLayer && map.hasLayer(prePuntosLayer)) {
                map.removeLayer(prePuntosLayer);
            }

            if (prePuntosData.length === 0) {
                return;
            }

            prePuntosLayer = L.layerGroup();

            prePuntosData.forEach(function(punto, index) {
                const lat = parseFloat(punto.latitud);
                const lng = parseFloat(punto.longitud);

                if (!isNaN(lat) && !isNaN(lng)) {
                    const prePuntoIcon = L.divIcon({
                        className: 'pre-punto-marker-container',
                        html: '<div class="pre-punto-marker"></div>',
                        iconSize: [20, 20],
                        iconAnchor: [10, 10]
                    });

                    const marker = L.marker([lat, lng], {
                        icon: prePuntoIcon
                    });

                    const popupContent = `
                        <div class="popup-content">
                            <div class="popup-description">
                                <strong>Detalle:</strong> ${punto.detalle || 'Sin detalle'}<br>
                                <strong>Creado por:</strong> ${punto.idusuario || 'No especificado'}<br>
                                <strong>Fecha:</strong> ${punto.fregistro_ || 'No especificada'}<br>
                                <strong>Ver en google:</strong> <a target="_blank"  href="https://www.google.com/maps?q=${lat},${lng}"><i class="fa fa-street-view" style="font-size:1.2rem;" aria-hidden="true"></i></a>
                            </div>
                            <div style="text-align:center;"><button class="form-controller" >USAR BASE</button></div>
                        </div>
                    `;

                    marker.bindPopup(popupContent);
                    prePuntosLayer.addLayer(marker);
                }
            });

            map.addLayer(prePuntosLayer);
            prePuntosActive = true;
            $('#prePuntosBtn').addClass('active');
        }

        // Función para alternar la capa de pre-puntos
        function togglePrePuntos() {
            if (prePuntosActive) {
                // Desactivar capa
                if (prePuntosLayer && map.hasLayer(prePuntosLayer)) {
                    map.removeLayer(prePuntosLayer);
                }
                prePuntosActive = false;
                $('#prePuntosBtn').removeClass('active');
                showStatusMessage('Capa de pre-puntos desactivada', 'info');
            } else {
                // Activar capa - buscar pre-puntos
                buscarPrePuntos();
            }
        }


        // Funciones de utilidad para mostrar mensajes
        function showStatusMessage(message, type = 'info') {
            const statusDiv = document.getElementById('statusMessage');
            if (statusDiv) {
                statusDiv.textContent = message;
                statusDiv.className = `status-message ${type}`;
                statusDiv.style.display = 'block';

                setTimeout(() => {
                    statusDiv.style.display = 'none';
                }, 3000);
            }
        }

        function showDynamicLoadingIndicator() {
            const indicator = document.getElementById('dynamicLoadingIndicator');
            if (indicator) {
                indicator.style.display = 'block';
                clearTimeout(dynamicLoadingTimer);
                dynamicLoadingTimer = setTimeout(() => {
                    indicator.style.display = 'none';
                }, 3000);
            }
        }

        function hideDynamicLoadingIndicator() {
            const indicator = document.getElementById('dynamicLoadingIndicator');
            if (indicator) {
                indicator.style.display = 'none';
                clearTimeout(dynamicLoadingTimer);
            }
        }

        // Función para cargar datos GeoJSON dinámicamente
        function loadGeoJSONDataDynamically(modulo, forceReload = false) {
            if (isGeoJsonLoading && !forceReload) {
                console.log('Ya hay una carga de GeoJSON en progreso, saltando...');
                return Promise.resolve();
            }

            const bounds = map.getBounds();
            const zoom = map.getZoom();

            console.log(`Cargando datos GeoJSON dinámicamente - Módulo: ${modulo}, Zoom: ${zoom}`);

            // Verificar zoom mínimo para inmuebles
            if (modulo === 'inmueble' && zoom < 19) {
                showStatusMessage('Zoom mínimo para ver inmuebles es 19', 'info');
                return Promise.resolve();
            }

            isGeoJsonLoading = true;
            showDynamicLoadingIndicator();

            const sw = bounds.getSouthWest();
            const ne = bounds.getNorthEast();

            let pointLimit = 0;
            let url = '';

            if (zoom >= 18) {
                // Calcular límite basado en los dos niveles de zoom disponibles
                if (zoom === 18) {
                    pointLimit = 2000; // Límite para zoom 18
                } else if (zoom >= 19) {
                    // Para zoom 19 (máximo en OSM), usar el límite máximo
                    pointLimit = 4000; // Límite máximo para el zoom más detallado
                }

                url = `../php/ufPredialGetGeoJson.php?minLat=${sw.lat}&maxLat=${ne.lat}&minLng=${sw.lng}&maxLng=${ne.lng}&zoom=${zoom}&limit=${pointLimit}&modulo=${modulo}`;

                console.log(`Zoom OSM: ${zoom}, Límite de puntos: ${pointLimit}`);
            } else {
                // Zoom insuficiente para mostrar información detallada
                console.log(`Zoom insuficiente: ${zoom}. Acerque más el mapa (zoom 18+) para ver información detallada.`);

                // Opcional: Mostrar mensaje al usuario
                // alert("Acerque más el mapa para ver la información detallada");

                // Hacer petición con límite 0 o no hacer petición
                url = `../php/ufPredialGetGeoJson.php?minLat=${sw.lat}&maxLat=${ne.lat}&minLng=${sw.lng}&maxLng=${ne.lng}&zoom=${zoom}&limit=0&modulo=${modulo}`;
            }

            return fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(`Datos recibidos para ${modulo}:`, data);

                    if (data.data && Array.isArray(data.data)) {
                        if (modulo === 'catastro') {
                            codigosGeoJSONData = data.data;
                            updateCodigosLayer();
                        } else if (modulo === 'inmueble') {
                            codigosGeoJSONDataInm = data.data;
                            updateInmueblesLayer();
                        }

                        showStatusMessage(
                            `${modulo === 'catastro' ? 'Códigos' : 'Inmuebles'} actualizados: ${data.data.length} puntos`,
                            'success'
                        );
                    } else {
                        throw new Error('Formato de datos inválido');
                    }
                })
                .catch(error => {
                    console.error(`Error cargando datos de ${modulo}:`, error);
                    showStatusMessage(`Error cargando ${modulo}: ${error.message}`, 'error');
                })
                .finally(() => {
                    isGeoJsonLoading = false;
                    hideDynamicLoadingIndicator();
                });
        }

        // Función para crear capa de códigos GeoJSON
        function createCodigosLayer(data, modulo) {
            if (!data || !Array.isArray(data)) {
                console.error('Datos de códigos GeoJSON inválidos');
                return null;
            }

            const geojsonData = {
                type: "FeatureCollection",
                features: data
            };

            return L.geoJSON(geojsonData, {
                pointToLayer: function(feature, latlng) {
                    let clase_ = (modulo === 'inmueble' ? 'codigo-markerInm' : 'codigo-marker');

                    const codigoIcon = L.divIcon({
                        className: 'codigo-marker-container',
                        html: '<div class="' + clase_ + '">' + feature.properties.Text + '</div>',
                        iconSize: [24, 24],
                        iconAnchor: [12, 12]
                    });

                    return L.marker(latlng, {
                        icon: codigoIcon
                    });
                },
                onEachFeature: function(feature, layer) {
                    if (modulo === 'inmueble') {
                        let popupContent = '<div class="popup-content">';
                        popupContent += '<div class="popup-title">Número de inmueble catastral</div>';
                        popupContent += '<div class="popup-description">';

                        if (feature.properties && feature.properties.Text) {
                            popupContent += `<strong>Código:</strong> ${feature.properties.Text}<br>`;
                        }

                        popupContent += '</div></div>';
                        layer.bindPopup(popupContent);
                    }
                }
            });
        }

        // Funciones para actualizar capas
        function updateCodigosLayer() {
            if (codigosActive && codigosGeoJSONData.length > 0) {
                if (codigosLayer && map.hasLayer(codigosLayer)) {
                    map.removeLayer(codigosLayer);
                }

                codigosLayer = createCodigosLayer(codigosGeoJSONData, 'catastro');
                if (codigosLayer) {
                    map.addLayer(codigosLayer);
                    console.log(`Capa de códigos actualizada: ${codigosGeoJSONData.length} puntos`);
                }
            }
        }

        function updateInmueblesLayer() {
            if (inmueblesActive && codigosGeoJSONDataInm.length > 0) {
                if (codigosLayerInm && map.hasLayer(codigosLayerInm)) {
                    map.removeLayer(codigosLayerInm);
                }

                codigosLayerInm = createCodigosLayer(codigosGeoJSONDataInm, 'inmueble');
                if (codigosLayerInm) {
                    map.addLayer(codigosLayerInm);
                    console.log(`Capa de inmuebles actualizada: ${codigosGeoJSONDataInm.length} puntos`);
                }
            }
        }

        // Función para alternar capa de códigos
        function toggleCodigosLayer() {
            const button = document.getElementById('codigosBtn');

            if (codigosActive) {
                if (codigosLayer && map.hasLayer(codigosLayer)) {
                    map.removeLayer(codigosLayer);
                    codigosLayer = null;
                    codigosGeoJSONData = [];
                }
                button.classList.remove('geojson-active');
                showStatusMessage('Capa de códigos desactivada', 'info');
                codigosActive = false;
            } else {
                const zoom = map.getZoom();
                if (zoom < 19) {
                    showStatusMessage('El zoom mínimo para ver los códigos es 19, zoom actual: ' + zoom, 'error');
                    return;
                }

                codigosActive = true;
                button.classList.add('geojson-active');
                loadGeoJSONDataDynamically('catastro', true);
            }
        }

        // Función para alternar capa de inmuebles
        function toggleInmueblesLayer() {
            const button = document.getElementById('inmueblesBtn');

            if (inmueblesActive) {
                if (codigosLayerInm && map.hasLayer(codigosLayerInm)) {
                    map.removeLayer(codigosLayerInm);
                    codigosLayerInm = null;
                    codigosGeoJSONDataInm = [];
                }
                button.classList.remove('geojson-active');
                showStatusMessage('Capa de inmuebles desactivada', 'info');
                inmueblesActive = false;
            } else {
                const zoom = map.getZoom();
                if (zoom < 19) {
                    showStatusMessage('El zoom mínimo para ver inmuebles es 19, zoom actual: ' + zoom, 'error');
                    return;
                }

                inmueblesActive = true;
                button.classList.add('geojson-active');
                loadGeoJSONDataDynamically('inmueble', true);
            }
        }

        if (typeof L !== "undefined" && miniMap) {
            map = L.map(miniMap, {
                zoomControl: false
            }).setView([-16.5, -68.15], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'DATM'
            }).addTo(map);

            satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                maxZoom: 19
            }).addTo(map);

            // Event listeners para los controles del mapa

            document.getElementById('prePuntosBtn').addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                togglePrePuntos();
                this.blur();
            });

            document.getElementById('zoomInBtn').addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                map.zoomIn();
                this.blur();
            });

            document.getElementById('zoomOutBtn').addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                map.zoomOut();
                this.blur();
            });

            document.getElementById('satelitalBtn').addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                if (satelitalActive) {
                    map.removeLayer(satelliteLayer);
                    this.classList.remove('tesela-active');
                    satelitalActive = false;
                    showStatusMessage('Capa satelital desactivada', 'info');
                } else {
                    map.addLayer(satelliteLayer);
                    this.classList.add('tesela-active');
                    satelitalActive = true;
                    showStatusMessage('Capa satelital activada', 'success');
                }

                this.blur();
            });


            document.getElementById('inmueblesBtn').addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                toggleInmueblesLayer();
                this.blur();
            });

            document.getElementById('codigosBtn').addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                toggleCodigosLayer();
                this.blur();
            });

            map.on('moveend', function() {
                if (codigosActive) {
                    loadGeoJSONDataDynamically('catastro');
                }
                if (inmueblesActive) {
                    const zoom = map.getZoom();
                    if (zoom >= 19) {
                        loadGeoJSONDataDynamically('inmueble');
                    }
                }
            });

            map.on('zoomend', function() {
                if (codigosActive) {
                    loadGeoJSONDataDynamically('catastro');
                }
                if (inmueblesActive) {
                    const zoom = map.getZoom();
                    if (zoom >= 19) {
                        loadGeoJSONDataDynamically('inmueble');
                    }
                }
            });

            if ('ontouchstart' in window) {
                const mapButtons = document.querySelectorAll('.control-button');

                mapButtons.forEach(button => {
                    button.addEventListener('touchstart', function(e) {
                        e.stopPropagation();
                    }, {
                        passive: true
                    });

                    button.addEventListener('touchend', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        this.click();

                        setTimeout(() => {
                            window.scrollTo(0, window.scrollY);
                        }, 10);
                    });
                });
            }

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

                $('#googlemap').attr("href", "https://www.google.com/maps?q=" + lat + "," + lng);

            });
        }

        if (!btnObtenerUbicacion || !geolocalizacionInput || !geoStatus) {
            console.warn("No se encontraron los elementos necesarios para la geolocalización");
            return;
        }

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

                    $('#googlemap').attr("href", "https://www.google.com/maps?q=" + latitude + "," + longitude);

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


        // Variables para pantalla completa
        let isFullscreen = false;
        let darkOverlayLayer = null;
        let darkOverlayActive = false;

        // Coordenadas del polígono de El Alto (ejemplo)
        const elAltoCoordinates = [
            [-16.570318, -68.223770],
            [-16.573455, -68.206022],
            [-16.610100, -68.239861],
            [-16.612269, -68.234636],
            [-16.627248, -68.205689],
            [-16.656082, -68.179661],
            [-16.659251, -68.172585],
            [-16.659179, -68.172489],
            [-16.660389, -68.170263],
            [-16.661391, -68.169179],
            [-16.663472, -68.167951],
            [-16.664783, -68.165821],
            [-16.665024, -68.165928],
            [-16.665631, -68.165274],
            [-16.667039, -68.164673],
            [-16.659443, -68.142507],
            [-16.655938, -68.136896],
            [-16.644765, -68.125556],
            [-16.641979, -68.119397],
            [-16.635164, -68.108250],
            [-16.634444, -68.130877],
            [-16.621173, -68.128340],
            [-16.613339, -68.143923],
            [-16.605638, -68.153558],
            [-16.597793, -68.158638],
            [-16.594123, -68.167334],
            [-16.586719, -68.169651],
            [-16.584190, -68.174007],
            [-16.581126, -68.175080],
            [-16.580591, -68.178749],
            [-16.579501, -68.180144],
            [-16.576354, -68.182118],
            [-16.574833, -68.184693],
            [-16.573146, -68.185015],
            [-16.570123, -68.183534],
            [-16.567141, -68.180509],
            [-16.564734, -68.179414],
            [-16.561649, -68.180594],
            [-16.555664, -68.175960],
            [-16.555294, -68.174114],
            [-16.550131, -68.173707],
            [-16.550131, -68.174222],
            [-16.546902, -68.173385],
            [-16.544948, -68.170810],
            [-16.546984, -68.170316],
            [-16.547262, -68.168728],
            [-16.548887, -68.166357],
            [-16.546943, -68.163729],
            [-16.542397, -68.160381],
            [-16.541523, -68.153772],
            [-16.541945, -68.149953],
            [-16.539846, -68.146359],
            [-16.536823, -68.145919],
            [-16.533737, -68.149384],
            [-16.530518, -68.147287],
            [-16.529469, -68.145608],
            [-16.528636, -68.144857],
            [-16.524897, -68.147104],
            [-16.521626, -68.148311],
            [-16.521374, -68.148327],
            [-16.520443, -68.149422],
            [-16.518345, -68.149894],
            [-16.517717, -68.150575],
            [-16.512615, -68.153005],
            [-16.512667, -68.152587],
            [-16.511823, -68.153177],
            [-16.511726, -68.152876],
            [-16.508696, -68.154561],
            [-16.507379, -68.155757],
            [-16.507858, -68.156186],
            [-16.505368, -68.158686],
            [-16.502452, -68.161840],
            [-16.499922, -68.163310],
            [-16.497982, -68.163455],
            [-16.496722, -68.164667],
            [-16.496835, -68.164834],
            [-16.496357, -68.165199],
            [-16.495745, -68.166615],
            [-16.495431, -68.166835],
            [-16.495164, -68.167639],
            [-16.491543, -68.170536],
            [-16.490648, -68.171083],
            [-16.488353, -68.170933],
            [-16.487937, -68.170456],
            [-16.487613, -68.170434],
            [-16.487150, -68.170499],
            [-16.486954, -68.170418],
            [-16.483868, -68.168197],
            [-16.482134, -68.166915],
            [-16.480478, -68.167275],
            [-16.482510, -68.165392],
            [-16.482633, -68.164265],
            [-16.482284, -68.163503],
            [-16.479866, -68.163815],
            [-16.479537, -68.164963],
            [-16.477170, -68.166647],
            [-16.476440, -68.166711],
            [-16.475946, -68.167398],
            [-16.469907, -68.167967],
            [-16.457776, -68.162162],
            [-16.457385, -68.160338],
            [-16.455245, -68.159072],
            [-16.448186, -68.157442],
            [-16.432957, -68.156991],
            [-16.427997, -68.149459],
            [-16.400354, -68.149588],
            [-16.367930, -68.145940],
            [-16.358089, -68.143644],
            [-16.350224, -68.138494],
            [-16.327615, -68.139868],
            [-16.320263, -68.145533],
            [-16.316515, -68.150382],
            [-16.285169, -68.157613],
            [-16.278681, -68.155575],
            [-16.262656, -68.153708],
            [-16.570318, -68.223770],
            [-16.572028, -68.225361],
            [-16.572079, -68.225484],
            [-16.571830, -68.226146],
            [-16.570251, -68.230969],
            [-16.569403, -68.233632],
            [-16.566791, -68.241765],
            [-16.565084, -68.246934],
            [-16.562822, -68.253422],
            [-16.560796, -68.259398],
            [-16.560780, -68.259478],
            [-16.560467, -68.259197],
            [-16.559559, -68.251263],
            [-16.551157, -68.245456],
            [-16.543755, -68.236749],
            [-16.535774, -68.245161],
            [-16.528492, -68.251941],
            [-16.529376, -68.255707],
            [-16.521662, -68.261061],
            [-16.528965, -68.269022],
            [-16.539661, -68.280351],
            [-16.528615, -68.290436],
            [-16.523781, -68.293676],
            [-16.510461, -68.287675],
            [-16.510378, -68.295657],
            [-16.510728, -68.297374],
            [-16.511140, -68.301622],
            [-16.512806, -68.307330],
            [-16.501794, -68.320105],
            [-16.490020, -68.314769],
            [-16.477613, -68.308482],
            [-16.468415, -68.301058],
            [-16.470720, -68.297625],
            [-16.466861, -68.295382],
            [-16.463116, -68.293000],
            [-16.459278, -68.289621],
            [-16.446602, -68.280094],
            [-16.430075, -68.267498],
            [-16.433204, -68.263593],
            [-16.412539, -68.253250],
            [-16.393025, -68.243551],
            [-16.383556, -68.216000],
            [-16.336778, -68.205357],
            [-16.302841, -68.185101],
            [-16.292543, -68.170166],
            [-16.277713, -68.165617],
            [-16.277381, -68.165585],
            [-16.262676, -68.153719],
            [-16.262656, -68.153708],
        ];

        // Event listener para el botón de pantalla completa
        document.getElementById('fullscreenBtn').addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const mapContainer = document.getElementById('mapContainer');
            const fullscreenIcon = this.querySelector('i');

            if (!isFullscreen) {
                // Activar pantalla completa
                mapContainer.classList.add('fullscreen');
                fullscreenIcon.className = 'fa fa-compress';
                this.classList.add('active');
                this.title = 'Salir de Pantalla Completa';
                isFullscreen = true;
                showStatusMessage('Modo pantalla completa activado', 'success');

                // Invalidar el tamaño del mapa después de un pequeño delay
                setTimeout(() => {
                    map.invalidateSize();
                }, 100);
            } else {
                // Desactivar pantalla completa
                mapContainer.classList.remove('fullscreen');
                fullscreenIcon.className = 'fa fa-expand';
                this.classList.remove('active');
                this.title = 'Pantalla Completa';
                isFullscreen = false;
                showStatusMessage('Modo pantalla completa desactivado', 'info');

                // Invalidar el tamaño del mapa después de un pequeño delay
                setTimeout(() => {
                    map.invalidateSize();
                }, 100);
            }

            this.blur();
        });

        // Event listener para el botón de oscurecer
        document.getElementById('oscurecerBtn').addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            if (darkOverlayActive) {
                // Desactivar overlay oscuro
                if (darkOverlayLayer && map.hasLayer(darkOverlayLayer)) {
                    map.removeLayer(darkOverlayLayer);
                    darkOverlayLayer = null;
                }
                this.classList.remove('geojson-active');
                darkOverlayActive = false;
                showStatusMessage('Overlay oscuro desactivado', 'info');
            } else {
                // Activar overlay oscuro
                darkOverlayLayer = L.polygon(elAltoCoordinates, {
                    className: 'dark-overlay',
                    fillColor: '#000000',
                    fillOpacity: 0.7,
                    color: '#666666',
                    weight: 2,
                    opacity: 0.8,
                    dashArray: '5, 5'
                }).addTo(map);

                this.classList.add('geojson-active');
                darkOverlayActive = true;
                showStatusMessage('Overlay oscuro activado', 'success');
            }

            this.blur();
        });

        // Event listener para salir de pantalla completa con la tecla Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isFullscreen) {
                document.getElementById('fullscreenBtn').click();
            }
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

        $("#imagenPrincipal").after('<div id="imagenPrincipalPreview" class="mt-2 image-preview-container"></div>')
        $("#imagenesAdicionales").after(
            '<div id="imagenesAdicionalesPreview" class="mt-2 d-flex flex-wrap gap-2 image-preview-container"></div>',
        )

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

        let compressedImages = {
            main: null,
            additional: [],
        }

        let compressionQuality = 0.7

        $("#imagenPrincipal").after(`
            <div class="mt-2">
                <label for="compressionQuality" class="form-label">Calidad de compresión: <span id="qualityValue">70%</span></label>
                <input type="range" class="form-range compression-slider" id="compressionQuality" min="0.1" max="1" step="0.1" value="0.7">
                </div>
            `)

        $("#compressionQuality").on("input", function() {
            compressionQuality = Number.parseFloat($(this).val())
            $("#qualityValue").text(Math.round(compressionQuality * 100) + "%")
        })

        $("#imagenPrincipal").on("change", (e) => {
            const file = e.target.files[0]
            if (!file) return

            if (!file.type.match("image.*")) {
                alert("Por favor seleccione una imagen válida")
                return
            }

            $("#imagenPrincipalPreview").empty()

            $("#imagenPrincipalPreview").html(
                '<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Procesando imagen...</div>',
            )

            const reader = new FileReader()
            reader.onload = (e) => {
                const originalSize = (file.size / 1024).toFixed(2)

                compressImage(file, compressionQuality)
                    .then((compressedBlob) => {
                        compressedImages.main = new File([compressedBlob], file.name, {
                            type: "image/jpeg",
                            lastModified: new Date().getTime(),
                        })

                        const compressedSize = (compressedBlob.size / 1024).toFixed(2)
                        const savings = (100 - (compressedBlob.size / file.size) * 100).toFixed(2)


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

        $("#imagenesAdicionales").on("change", (e) => {
            const files = e.target.files
            if (!files || files.length === 0) return

            $("#imagenesAdicionalesPreview").empty()
            compressedImages.additional = []

            Array.from(files).forEach((file, index) => {
                if (!file.type.match("image.*")) {
                    return
                }

                const previewId = `additional-preview-${index}`
                $("#imagenesAdicionalesPreview").append(`
        <div id="${previewId}" class="preview-item" style="width: 200px;">
            <div class="text-center"><i class="fa fa-spinner fa-spin"></i> Procesando...</div>
            </div>
        `)

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

            $("#imagenesAdicionalesPreview").on("click", ".remove-image", function() {
                const index = $(this).data("index")
                $(this).closest(".preview-item").remove()

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

            if ($('#geolocalizacion').val() === '') {
                errores.push('Debe obtener la geolocalización del inmueble');
                $('#geolocalizacion').addClass('is-invalid');
            }

            var telefonoRegex = /^\d{8}$/;
            var numeroInmuebleRegex = /^\d{5}$/;
            if ($('#contactoTitular').val() !== '' && !telefonoRegex.test($('#contactoTitular').val())) {
                errores.push('El teléfono del titular debe tener 8 dígitos');
                $('#contactoTitular').addClass('is-invalid');
            }

            if ($('#contactoApoderado').val() !== '' && !telefonoRegex.test($('#contactoApoderado').val())) {
                errores.push('El teléfono del apoderado debe tener 8 dígitos');
                $('#contactoApoderado').addClass('is-invalid');
            }

            if ($('#numeroInmueble').val() !== '' && !numeroInmuebleRegex.test($('#numeroInmueble').val())) {
                errores.push('El numero de inmueble tiene que tener al menos 5  dígitos');
                $('#numeroInmueble').addClass('is-invalid');
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

            $.data(this, "submitted", true)
            return false
        })

        function compressImage(image, quality) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader()

                reader.onload = (event) => {
                    const img = new Image()
                    img.src = event.target.result

                    img.onload = () => {

                        let width = img.width
                        let height = img.height

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

                        ctx.drawImage(img, 0, 0, width, height)

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
    });

    function cargarNivel(nivel) {
        let dato = {
            ubicacion1: $('#ubicacion1').val(),
            ubicacion2: $('#ubicacion2').val(),
            nivel: nivel
        };

        $.ajax({
            async: true,
            type: "POST",
            dataType: "json",
            contentType: "application/x-www-form-urlencoded",
            url: "../php/ufUbicacionNivel.php",
            data: dato,
            beforeSend: function() {
                loadGralOn();
            },
            success: function(dat) {

                console.log("======================");
                console.log(dat);
                loadGralOff();
                let $select = $('.select2_' + nivel);
                if ($select.hasClass('select2-hidden-accessible')) {
                    $select.select2('destroy');
                }
                $select.html(dat.html);
                $select.attr('multiple', 'multiple');
                $select.select2({
                    dropdownParent: $('.swal2-popup'),
                    placeholder: "Seleccione o escriba",
                    tags: true,
                    width: '26%'
                });
            },
            error: function(xhr) {
                loadGralOff();
                console.error("Error al cargar opciones:", xhr.responseText);
            }
        });
    }
</script>

</html>