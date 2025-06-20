<?php
session_start();
if (!$_SESSION['swlogin']) {
    echo "<script>window.location.href = 'index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor predial | El Alto</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        header {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 1rem;
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .logo a {
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
        }

        .logo-red {
            color: #FF0000;
        }

        .logo-cyan {
            color: #00C8FF;
        }

        nav {
            display: flex;
            gap: 2rem;
        }

        nav a {
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
        }

        .nav-cyan {
            color: #00C8FF;
        }

        .nav-cyan:hover {
            color: #00A3D9;
        }

        .nav-red {
            color: #FF0000;
        }

        .nav-red:hover {
            color: #CC0000;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            padding: 1rem;
        }

        h1 {
            color: #00C8FF;
            text-align: center;
            font-size: 2rem;
        }

        .date {
            text-align: center;
            color: #666;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        #map {
            height: 100vh;
            width: 100% !important;
            border-radius: 4px;
            position: relative;
        }

        .popup-content {
            text-align: center;
        }

        .popup-title {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .popup-description {
            font-size: 0.875rem;
        }

        .map-controls {
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
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
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

        .control-button.geojson-active {
            background-color: rgba(0, 200, 255, 0.9);
            color: white;
        }

        .control-button.geojson-active:hover {
            background-color: rgba(0, 180, 230, 0.9);
        }

        .control-button.geojson-codigos {
            background-color: rgba(255, 165, 0, 0.8);
        }

        .control-button.geojson-codigos.geojson-active {
            background-color: rgba(255, 165, 0, 0.9);
        }

        .control-button.satelital {
            background-color: rgba(29, 25, 22, 0.8);
        }

        .control-button.satelital.geojson-active {
            background-color: rgba(29, 25, 22, 0.8);
        }

        .control-button.satelital:hover {
            background-color: rgba(36, 29, 27, 0.9)
        }

        .control-button.oscurecer {
            background-color: rgba(50, 50, 50, 0.8);
        }

        .control-button.oscurecer.geojson-active {
            background-color: rgba(75, 75, 75, 0.9);
        }

        .control-button.oscurecer:hover {
            background-color: rgba(75, 75, 75, 0.9);
        }

        .dark-overlay {
            fill: rgba(0, 0, 0, 0.7);
            stroke: rgba(100, 100, 100, 0.8);
            stroke-width: 2;
            stroke-dasharray: 5, 5;
            transition: fill 0.3s ease;
        }

        .search-container {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 1000;
            background-color: white;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            padding: 10px;
            min-width: 280px;
            max-width: calc(100vw - 80px);
        }

        .search-input-container {
            position: relative;
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .search-input {
            width: 100%;
            padding: 8px 35px 8px 12px;
            border: 2px solid #e0e0e0;
            border-radius: 4px;
            font-size: 0.875rem;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .search-input:focus {
            border-color: #00C8FF;
        }

        .search-input::placeholder {
            color: #999;
        }

        .clear-search {
            position: absolute;
            right: 8px;
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            color: #999;
            padding: 0;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .clear-search:hover {
            color: #FF0000;
        }

        .search-results {
            font-size: 0.75rem;
            color: #666;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .results-count {
            color: #00C8FF;
            font-weight: 500;
        }

        .show-all-btn {
            background: none;
            border: none;
            color: #00C8FF;
            cursor: pointer;
            font-size: 0.75rem;
            text-decoration: underline;
            padding: 0;
        }

        .show-all-btn:hover {
            color: #00A3D9;
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

        .leaflet-control-zoom {
            display: none !important;
        }

        .debug-info {
            position: absolute;
            bottom: 10px;
            left: 10px;
            z-index: 1000;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-family: monospace;
        }

        .loader {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #00C8FF;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            display: none;
        }

        @keyframes spin {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
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

        .marker-cluster-small {
            background-color: rgba(255, 183, 183, 0.6) !important;
        }

        .marker-cluster-small div {
            background-color: rgba(255, 0, 0, 0.6) !important;
            animation: pulseAnimation 2.8s infinite ease-in-out;
            color: rgb(255, 255, 255);
            font-weight: bold;
        }

        .leaflet-popup-content {
            margin: 5px 2px 13px 2px !important;
            width: 40vh !important;
        }

        .leaflet-popup-content-wrapper,
        .leaflet-popup-tip {
            background: #191c1c !important;
            color: rgb(240, 240, 240) !important;
            box-shadow: 0 3px 14px rgba(0, 0, 0, 0.4);
        }

        .puntoMarca {
            background-color: #00f3ff;
            width: 0.9rem;
            height: 0.9rem;
            border-radius: 50%;
            box-shadow:
                0 0 6px #fff,
                0 0 0.9rem #fff,
                0 0 18px #17b9c1,
                0 0 24px #17b9c1,
                0 0 30px #4cf0f8,
                0 0 36px #4cf0f8;
            border: 2px solid #fff;
            animation: pulseAnimation 5s infinite ease-in-out;
        }

        /* Nuevo estilo para marcadores de hoy */
        .puntoMarcaHoy {
            background-color: #fbff00;
            width: 0.9rem;
            height: 0.9rem;
            border-radius: 50%;
            box-shadow:
                0 0 6px #fff,
                0 0 0.9rem #fff,
                0 0 18px #d5d809,
                0 0 24px #d5d809,
                0 0 30px #fbff00,
                0 0 36px #fbff00;
            border: 2px solid #fff;
            animation: pulseAnimation 1.5s infinite ease-in-out;
        }

        .puntoActualizado {
            background-color: #0ecc08;
            width: 0.9rem;
            height: 0.9rem;
            border-radius: 50%;
            box-shadow:
                0 0 6px #fff,
                0 0 0.9rem #fff,
                0 0 18px #0ecc08,
                0 0 24px #0ecc08,
                0 0 30px #0ecc08,
                0 0 36px #0ecc08;
            border: 2px solid #fff;
            animation: pulseAnimation 1.5s infinite ease-in-out;
        }

        .puntoRevelde {
            background-color: #ff0040;
            width: 0.9rem;
            height: 0.9rem;
            border-radius: 50%;
            box-shadow:
                0 0 6px #fff,
                0 0 0.9rem #fff,
                0 0 18px #ff0040,
                0 0 24px #ff0040,
                0 0 30px #ff0040,
                0 0 36px #ff0040;
            border: 2px solid #fff;
            animation: pulseAnimation 1.5s infinite ease-in-out;
        }

        .pulsing-marker div {
            animation: pulseAnimation 2.8s infinite ease-in-out;
        }

        .individual-pulsing-marker .leaflet-marker-icon {
            animation: pulseAnimation 1.8s infinite ease-in-out;
            transform-origin: center bottom;
        }

        .clicked-coordinates-marker {
            background-color: #ff6b35;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 0 8px rgba(255, 107, 53, 0.8);
            animation: pulseAnimation 1.5s infinite ease-in-out;
        }

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

        .card-inmueble {
            max-width: 100%;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .header-numero {
            font-weight: bold;
            font-size: 1.1rem;
            margin-bottom: 8px;
            text-align: center;
            color: #01f3ff;
        }

        .carrusel {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .carrusel-img {
            width: 100%;
            max-height: 40vh;
            display: block;
            object-fit: contain;
        }

        .carrusel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            border: none;
            color: white;
            padding: 4px 10px;
            cursor: pointer;
            z-index: 10;
        }

        .carrusel-btn.left {
            left: 5px;
        }

        .carrusel-btn.right {
            right: 5px;
        }

        .info-inmueble {
            font-size: 14px;
            margin-top: 10px;
            word-wrap: break-word;
            padding-left: 0.4rem;
        }

        @media (max-width: 500px) {
            .info-inmueble p {
                font-size: 13px;
            }

            .header-numero {
                font-size: 14px;
            }
        }

        .info-container {
            display: flex;
            flex-wrap: wrap;
            max-width: 600px;
            margin: 0 auto;
        }

        .info-row {
            display: flex;
            width: 100%;
            padding: 4px 0;
            border-bottom: 1px solid #313437;
        }

        .info-label {
            flex: 1;
            font-weight: bold;
            min-width: 120px;
            color: #00c7d1;
        }

        .info-value {
            flex: 2;
        }

        @media (max-width: 500px) {
            .info-row {
                flex-direction: column;
            }

            .info-label,
            .info-value {
                flex: none;
                width: 100%;

            }

            .info-label {
                font-size: 10px;
            }
        }


        .icon-buttons {
            display: flex;
            justify-content: space-around;
            align-items: center;
            text-align: center;
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            padding: 10px 0;
        }

        .icon-buttons i {
            font-size: 0.9rem;
            padding: 10px;
            border: 2px solid;
            border-radius: 8px;
            transition: transform 0.2s, box-shadow 0.3s;
            cursor: pointer;
        }

        .icon-buttons i:hover {
            transform: scale(1.1);
            box-shadow: 0 0 8px;
        }

        .icon-check {
            color: #00ff00;
            border-color: #00ff00;
            box-shadow: 0 0 4px #00ff00;
        }

        .icon-refresh {
            color: #00bfff;
            border-color: #00bfff;
            box-shadow: 0 0 4px #00bfff;
        }

        .icon-warning {
            color: #ff0033;
            border-color: #ff0033;
            box-shadow: 0 0 4px #ff0033;
        }

        .loadGralOn {
            position: fixed;
            z-index: 999;
            top: 0;
            left: 0;
            height: 100vh;
            width: 100%;
            background-color: #121212;
            opacity: 0.8;
            filter: alpha(opacity=80);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loadGralOn img {
            height: 6em;
        }

        .loadGralOff {
            display: none;
            height: 0%;
            width: 0%;
        }


        .custom-popup {
            position: fixed;
            top: 15%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border: 2px solid #00C8FF;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            z-index: 2000;
            min-width: 300px;
        }

        .custom-popup h3 {
            margin: 0 0 15px 0;
            color: #00C8FF;
            text-align: center;
        }

        .custom-popup input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .custom-popup-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .custom-popup-buttons button {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-save {
            background-color: #00C8FF;
            color: white;
        }

        .btn-save:hover {
            background-color: #00A3D9;
        }

        .btn-closeMap {
            background-color: #ff4444;
            color: white;
        }

        .btn-closeMap:hover {
            background-color: #cc0000;
        }

        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1999;
        }

        .leaflet-container.crosshair-cursor-enabled {
            cursor: crosshair !important;
        }

        .new-point-marker-container {
            pointer-events: none;
        }

        /* Agregar al final de los estilos CSS */
        #addPointBtn.geojson-active {
            background-color: rgba(255, 107, 53, 0.9) !important;
            color: white !important;
        }

        #addPointBtn.geojson-active:hover {
            background-color: rgba(255, 87, 33, 0.9) !important;
        }

        /* Mejorar el cursor del mapa cuando está en modo agregar punto */
        .leaflet-container.adding-point-mode {
            cursor: crosshair !important;
        }

        .leaflet-container.adding-point-mode * {
            cursor: crosshair !important;
        }

        /* Agregar al final de los estilos CSS */
        .saved-point-marker-container {
            pointer-events: auto;
        }

        .saved-point-marker-container:hover {
            transform: scale(1.1);
            transition: transform 0.2s ease;
        }

        /* Estilo para contador de puntos en debug */
        .points-counter {
            position: absolute;
            bottom: 50px;
            left: 10px;
            z-index: 1000;
            background-color: rgba(40, 167, 69, 0.9);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-family: monospace;
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
    <div class="loadGral"></div>
    <main>
        <div id="map">
            <div class="search-container">
                <div class="search-input-container">
                    <input
                        type="text"
                        id="searchInput"
                        class="search-input"
                        placeholder="Buscar inmuebles, contribuyentes o números... (Click en el mapa para obtener coordenadas)"
                        aria-label="Buscar inmuebles, contribuyentes o números">
                    <button id="clearSearch" class="clear-search" title="Limpiar búsqueda" aria-label="Limpiar búsqueda">×</button>
                </div>
                <div class="search-results">
                    <span id="resultsCount" class="results-count" aria-live="polite"></span>
                    <button id="showAllBtn" class="show-all-btn">Mostrar todos</button>
                </div>
            </div>
            <div class="map-controls">
                <button id="homeBtn" class="control-button" title="Inicio" aria-label="Volver" style="outline-style: none;">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </button>
                <!-- <button id="locationBtn" class="control-button" title="Mostrar mi ubicación" aria-label="Mostrar mi ubicación"><i class="fa fa-map-marker" aria-hidden="true"></i></button> -->
                <button id="addPointBtn" class="control-button" title="Agregar punto" aria-label="Agregar punto">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                </button>
                <button id="zoomInBtn" class="control-button" title="Acercar" aria-label="Acercar mapa">+</button>
                <button id="zoomOutBtn" class="control-button" title="Alejar" aria-label="Alejar mapa">−</button>

                <button id="inmueblesBtn" class="control-button geojson-codigos" title="Mostrar/Ocultar Inmuebles" aria-label="Capa Inmuebles">
                    <i class="fa fa-home" aria-hidden="true"></i>
                </button>

                <button id="codigosBtn" class="control-button geojson-codigos" title="Mostrar/Ocultar Códigos" aria-label="Capa Códigos">
                    <i class="fa fa-tags" aria-hidden="true"></i>
                </button>

                <button id="satelitalBtn" class="control-button satelital" title="Mostrar/Ocultar Capa Satelital" aria-label="Capa Satelital" style="outline-style: none;">
                    <i class="fa fa-globe" aria-hidden="true"></i>
                </button>
                <button id="oscurecerBtn" class="control-button oscurecer" title="Oscurecer El Alto" aria-label="Oscurecer El Alto" style="outline-style: none;">
                    <i class="fa fa-moon-o" aria-hidden="true"></i>
                </button>

                <button id="prePuntosBtn" class="control-button pre-puntos" title="Buscar Pre-Puntos" aria-label="Buscar Pre-Puntos">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
            <div id="statusMessage" class="status-message" role="alert"></div>
            <div id="dynamicLoadingIndicator" class="dynamic-loading-indicator">Cargando datos...</div>
            <div id="loader" class="loader"></div>
            <div id="debugInfo" class="debug-info"></div>
        </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/jquery-confirm.js"></script>
    <script>
        console.log('Leaflet version:', L.version);

        const map = L.map('map', {
            zoomControl: false,
            maxZoom: 19
        }).setView([-16.5, -68.175], 13);

        // Capas base
        const osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'DATM',
            maxZoom: 19
        }).addTo(map);

        const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            maxZoom: 19
        }).addTo(map);


        let prePuntosLayer = null;
        let prePuntosActive = false;
        let prePuntosData = [];

        // Variables globales
        let codigosGeoJSONData = {};
        let codigosGeoJSONDataInm = {};
        let codigosLayer = null;
        let codigosLayerInm = null;
        let codigosActive = false;
        let inmueblesActive = false;
        let satelitalActive = true;
        let oscurecerActive = false;
        let userLocationMarker = null;
        let clickedCoordinatesMarker = null;
        let initialMarkerData = [];
        let allLeafletMarkers = [];
        let markerClusterGroup;
        let isDataLoading = false;
        let isGeoJsonLoading = false;
        let currentBounds = null;
        let loadedMarkerIds = new Set();
        let debounceTimer;
        let totalMarkersCount = 0;
        let dynamicLoadingTimer;


        let isAddingPoint = false;
        let newPointMarker = null;
        let customPopupElement = null;

        // Variables para puntos guardados
        let savedPoints = []; // Array para almacenar puntos guardados
        let savedPointsLayer = null; // Capa para puntos guardados
        let currentPointData = null; // Datos del punto actual

        // NUEVA VARIABLE: Control para puntos agrupados
        let ALLOW_GROUPED_POINTS = false; // Cambiar a false para desactivar agrupación

        // Configuración para carga dinámica
        const DYNAMIC_LOADING_CONFIG = {
            BATCH_SIZE: 500,
            BATCH_DELAY: 30,
            MIN_ZOOM_FOR_LOADING: 10,
            DEBOUNCE_DELAY: 300,
            BOUNDS_PADDING: 0.2,
            MAX_POINTS_PER_REQUEST: 2000
        };

        // Polígono de El Alto
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

        const darkOverlay = L.polygon(elAltoCoordinates, {
            className: 'dark-overlay',
            fillColor: 'black',
            fillOpacity: 0.7,
            color: '#666',
            weight: 2,
            dashArray: '5, 5'
        });

        // Funciones de utilidad
        function logDebug(message) {
            console.log(`[DynamicMap] ${message}`);
        }

        function showDynamicLoadingIndicator() {
            const indicator = document.getElementById('dynamicLoadingIndicator');
            indicator.style.display = 'block';

            // Auto-hide después de 3 segundos
            clearTimeout(dynamicLoadingTimer);
            dynamicLoadingTimer = setTimeout(() => {
                indicator.style.display = 'none';
            }, 3000);
        }

        function hideDynamicLoadingIndicator() {
            const indicator = document.getElementById('dynamicLoadingIndicator');
            indicator.style.display = 'none';
            clearTimeout(dynamicLoadingTimer);
        }

        function showStatusMessage(message, type = 'info') {
            const statusDiv = document.getElementById('statusMessage');
            statusDiv.textContent = message;
            statusDiv.className = `status-message ${type}`;
            statusDiv.style.display = 'block';

            setTimeout(() => {
                statusDiv.style.display = 'none';
            }, 5000);
        }

        function showLoader() {
            document.getElementById('loader').style.display = 'block';
        }

        function hideLoader() {
            document.getElementById('loader').style.display = 'none';
        }

        function updateDebugInfo() {
            const debugDiv = document.getElementById('debugInfo');
            const zoom = map.getZoom();
            const center = map.getCenter();
            const markersCount = allLeafletMarkers.length;

            debugDiv.innerHTML = `
                Zoom: ${zoom} | 
                Marcadores: ${markersCount} | 
                Códigos: ${codigosActive ? 'ON' : 'OFF'} | 
                Inmuebles: ${inmueblesActive ? 'ON' : 'OFF'} | 
                Satelital: ${satelitalActive ? 'ON' : 'OFF'} |
                Oscurecer: ${oscurecerActive ? 'ON' : 'OFF'} |
                Agrupados: ${ALLOW_GROUPED_POINTS ? 'ON' : 'OFF'} |
                Lat: ${center.lat.toFixed(4)} | 
                Lng: ${center.lng.toFixed(4)}
            `;
        }

        // NUEVA FUNCIÓN: Verificar si una fecha es hoy
        function isToday(dateString) {
            if (!dateString) return false;

            const today = new Date();
            const checkDate = new Date(dateString);

            return today.getFullYear() === checkDate.getFullYear() &&
                today.getMonth() === checkDate.getMonth() &&
                today.getDate() === checkDate.getDate();
        }

        // Función para cargar marcadores desde la base de datos (MEJORADA)
        function loadMarkersInViewport() {
            if (isDataLoading) return;

            const bounds = map.getBounds();
            const zoom = map.getZoom();

            console.log(`Intentando cargar marcadores - Zoom: ${zoom}, Min requerido: ${DYNAMIC_LOADING_CONFIG.MIN_ZOOM_FOR_LOADING}`);

            if (zoom < DYNAMIC_LOADING_CONFIG.MIN_ZOOM_FOR_LOADING) {
                console.log('Zoom insuficiente para cargar marcadores');
                return;
            }

            // MEJORA: Solo cargar si no hay capas GeoJSON activas o si ambas están activas
            if (codigosActive && !inmueblesActive) {
                console.log('Solo códigos activos, no cargar marcadores individuales');
                return;
            }

            if (currentBounds && currentBounds.contains(bounds)) {
                console.log('Los datos ya están cargados para esta área');
                return;
            }

            isDataLoading = true;
            showLoader();

            const expandedBounds = bounds.pad(DYNAMIC_LOADING_CONFIG.BOUNDS_PADDING);
            currentBounds = expandedBounds;

            const sw = expandedBounds.getSouthWest();
            const ne = expandedBounds.getNorthEast();

            const url = `../php/ufPuntosGet.php?minLat=${sw.lat}&maxLat=${ne.lat}&minLng=${sw.lng}&maxLng=${ne.lng}&zoom=${zoom}&limit=${DYNAMIC_LOADING_CONFIG.MAX_POINTS_PER_REQUEST}`;

            console.log('Cargando datos desde:', url);

            fetch(url)
                .then(response => {
                    console.log('Respuesta del servidor:', response.status, response.statusText);
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status} - ${response.statusText}`);
                    }
                    return response.text();
                })
                .then(text => {
                    console.log('Respuesta cruda del servidor:', text.substring(0, 500) + '...');
                    try {
                        const response = JSON.parse(text);
                        return response;
                    } catch (parseError) {
                        console.error('Error parseando JSON:', parseError);
                        console.error('Texto recibido:', text);
                        throw new Error('Respuesta del servidor no es JSON válido');
                    }
                })
                .then(response => {
                    console.log('Datos parseados:', response);

                    let data, meta;

                    if (response.data && response.meta) {
                        data = response.data;
                        meta = response.meta;
                        totalMarkersCount = meta.total;
                        console.log(`Datos con metadatos - Total: ${meta.total}, Cargados: ${data.length}`);
                    } else if (Array.isArray(response)) {
                        data = response;
                        meta = null;
                        console.log(`Datos como array - Elementos: ${data.length}`);
                    } else if (response.error) {
                        throw new Error(`Error del servidor: ${response.error} - ${response.message}`);
                    } else {
                        throw new Error('Formato de respuesta inválido');
                    }

                    if (data && data.length > 0) {
                        const newData = data.filter(item => !loadedMarkerIds.has(item.id));

                        if (newData.length > 0) {
                            console.log(`Procesando ${newData.length} nuevos marcadores`);

                            if (!markerClusterGroup) {
                                console.log("Inicializando markerClusterGroup");
                                initializeMarkers();
                            }

                            processMarkersInBatches(newData, 0);
                            showStatusMessage(`Cargados ${newData.length} puntos adicionales`, 'success');
                        } else {
                            console.log('No hay nuevos datos para cargar');
                            hideLoader();
                        }
                    } else {
                        console.log('No se recibieron datos');
                        showStatusMessage('No hay datos disponibles para esta área', 'info');
                        hideLoader();
                    }
                })
                .catch(error => {
                    console.error("Error detallado al obtener datos del mapa:", error);
                    showStatusMessage(`Error al cargar datos: ${error.message}`, 'error');
                    hideLoader();
                })
                .finally(() => {
                    isDataLoading = false;
                    updateDebugInfo();
                });
        }

        // Función para inicializar marcadores (MEJORADA)
        function initializeMarkers() {
            if (!window.map) {
                console.error("Map not initialized");
                return;
            }

            try {
                if (markerClusterGroup) {
                    map.removeLayer(markerClusterGroup);
                }

                // MEJORA: Configurar clustering basado en la variable de control
                const clusterOptions = {
                    chunkedLoading: true,
                    chunkInterval: 50,
                    chunkDelay: 25,
                    maxClusterRadius: ALLOW_GROUPED_POINTS ? function(zoom) {
                        return zoom < 15 ? 80 : 40;
                    } : 0, // 0 desactiva el clustering
                    spiderfyOnMaxZoom: true,
                    showCoverageOnHover: false,
                    zoomToBoundsOnClick: true,
                    disableClusteringAtZoom: ALLOW_GROUPED_POINTS ? 18 : 1
                };

                markerClusterGroup = L.markerClusterGroup(clusterOptions);

                console.log("MarkerClusterGroup initialized:", markerClusterGroup);

                if (initialMarkerData.length > 0) {
                    processMarkersInBatches(initialMarkerData, 0);
                } else {
                    map.addLayer(markerClusterGroup);
                    hideLoader();
                }
            } catch (error) {
                console.error("Error initializing markers:", error);
                showStatusMessage("Error al inicializar marcadores", "error");
                hideLoader();
            }
        }

        // Función para procesar marcadores en lotes (MEJORADA)
        function processMarkersInBatches(data, startIndex) {
            try {
                if (!markerClusterGroup) {
                    console.error("markerClusterGroup is undefined");
                    showStatusMessage("Error: Grupo de marcadores no inicializado", "error");
                    hideLoader();
                    return;
                }

                const endIndex = Math.min(startIndex + DYNAMIC_LOADING_CONFIG.BATCH_SIZE, data.length);
                const currentBatch = data.slice(startIndex, endIndex);

                const batchMarkers = currentBatch.map(item => {
                    if (loadedMarkerIds.has(item.id)) {
                        return null;
                    }

                    loadedMarkerIds.add(item.id);

                    // MEJORA: Verificar si es visita de hoy y usar marcador apropiado
                    const isVisitToday = item.is_visit_today;
                    console.log("===> numero_inmueble:" + item.numero_inmueble);
                    console.log("===> isVisitToday:" + isVisitToday);

                    console.log("item.estado_fiscalizacion:" + item.estado_fiscalizacion);

                    let markerClass = isVisitToday ? 'puntoMarcaHoy' : 'puntoMarca';
                    if (item.estado_fiscalizacion == 'PROCESADO')
                        markerClass = 'puntoActualizado';
                    if (item.estado_fiscalizacion == 'DESACATO')
                        markerClass = 'puntoRevelde';

                    const pulsingIcon = L.divIcon({
                        className: 'pulsing-marker',
                        html: `<div class="${markerClass}"></div>`,
                        iconSize: [16, 16],
                        iconAnchor: [8, 8]
                    });

                    const marker = L.marker(item.position, {
                        icon: pulsingIcon,
                        className: 'individual-pulsing-marker'
                    }).bindPopup(item.html);

                    marker.originalData = {
                        id: item.id,
                        title: item.title || '',
                        nombre_razon: item.nombre_razon || '',
                        codigo_catastral: item.codigo_catastral || '',
                        numero_inmueble: item.numero_inmueble || '',
                        description: item.description || '',
                        type: item.numero_inmueble || '',
                        position: item.position,
                        html: item.html,
                        fecha_apersonamiento: item.fecha_apersonamiento || null,
                        usuario: item.usuario || null,
                        no_formulario: item.no_formulario || null,
                        isVisitToday: isVisitToday
                    };

                    return marker;
                }).filter(marker => marker !== null);

                if (batchMarkers.length > 0) {
                    markerClusterGroup.addLayers(batchMarkers);
                    allLeafletMarkers = allLeafletMarkers.concat(batchMarkers);
                }

                if (endIndex < data.length) {
                    setTimeout(() => {
                        processMarkersInBatches(data, endIndex);
                    }, DYNAMIC_LOADING_CONFIG.BATCH_DELAY);
                } else {
                    if (!map.hasLayer(markerClusterGroup)) {
                        map.addLayer(markerClusterGroup);
                    }
                    updateResultsCount(allLeafletMarkers.length, totalMarkersCount);
                    updateDebugInfo();
                    hideLoader();
                }
            } catch (error) {
                console.error("Error processing markers batch:", error);
                showStatusMessage("Error procesando marcadores", "error");
                hideLoader();
            }
        }

        // Función para filtrar marcadores
        function filterMarkers(searchTerm) {
            const term = searchTerm.toLowerCase().trim();
            console.log("term:" + term);
            let visibleCount = 0;

            if (!markerClusterGroup || !allLeafletMarkers) return;

            markerClusterGroup.clearLayers();

            if (term.length > 0 && term.length < 3) {
                showStatusMessage('Ingrese al menos 3 caracteres para buscar', 'info');
                return;
            }

            showLoader();

            setTimeout(() => {
                const filteredLeafletMarkers = [];

                function processFilterBatch(startIndex) {
                    const endIndex = Math.min(startIndex + 300, allLeafletMarkers.length);

                    for (let i = startIndex; i < endIndex; i++) {
                        const marker = allLeafletMarkers[i];
                        const data = marker.originalData || {};
                        console.log(data);
                        const title = String(data.title || '').toLowerCase();
                        const nombre = String(data.nombre_razon || '').toLowerCase();
                        const codigo = String(data.codigo_catastral || '').toLowerCase();
                        const numero = String(data.numero_inmueble || '').toLowerCase();
                        const usuario = String(data.usuario || '').toLowerCase();
                        const no_formulario = String(data.no_formulario || '').toLowerCase();
                        const fecha_apersonamiento = String(data.fecha_apersonamiento || '').toLowerCase();

                        console.log("fecha_apersonamiento:" + fecha_apersonamiento);
                        const matchesSearch = term === '' ||
                            title.includes(term) ||
                            nombre.includes(term) ||
                            codigo.includes(term) ||
                            fecha_apersonamiento.includes(term) ||
                            usuario.includes(term) ||
                            no_formulario.includes(term) ||
                            numero.includes(term);

                        if (matchesSearch) {
                            filteredLeafletMarkers.push(marker);
                            visibleCount++;
                        }
                    }

                    if (endIndex < allLeafletMarkers.length) {
                        setTimeout(() => {
                            processFilterBatch(endIndex);
                        }, 5);
                    } else {
                        markerClusterGroup.addLayers(filteredLeafletMarkers);
                        updateResultsCount(visibleCount, totalMarkersCount || allLeafletMarkers.length);
                        updateDebugInfo();
                        hideLoader();

                        if (filteredLeafletMarkers.length > 0 && term !== '') {
                            setTimeout(() => {
                                fitMapToVisibleMarkers();
                            }, 100);
                        }
                    }
                }

                processFilterBatch(0);
            }, 25);
        }

        // Función para mostrar todos los marcadores
        function showAllMarkers() {
            if (!markerClusterGroup) return;

            showLoader();

            setTimeout(() => {
                markerClusterGroup.clearLayers();

                const batchSize = 500;
                let currentIndex = 0;

                function addBatch() {
                    const endIndex = Math.min(currentIndex + batchSize, allLeafletMarkers.length);
                    const currentBatch = allLeafletMarkers.slice(currentIndex, endIndex);

                    markerClusterGroup.addLayers(currentBatch);
                    currentIndex = endIndex;

                    if (currentIndex < allLeafletMarkers.length) {
                        setTimeout(addBatch, 25);
                    } else {
                        updateResultsCount(allLeafletMarkers.length, totalMarkersCount || allLeafletMarkers.length);
                        updateDebugInfo();
                        hideLoader();
                    }
                }

                addBatch();
            }, 25);
        }

        // Función para actualizar contador de resultados
        function updateResultsCount(count, total) {
            const resultsElement = document.getElementById('resultsCount');
            if (total === undefined) total = totalMarkersCount || allLeafletMarkers.length;

            if (count === total && document.getElementById('searchInput').value === '') {
                resultsElement.textContent = `${total} inmuebles encontrados`;
            } else {
                resultsElement.textContent = `${count} de ${total} inmuebles encontrados`;
            }
        }

        // Función para limpiar búsqueda
        function clearSearch() {
            const searchInput = document.getElementById('searchInput');
            searchInput.value = '';

            if (clickedCoordinatesMarker) {
                map.removeLayer(clickedCoordinatesMarker);
                clickedCoordinatesMarker = null;
            }

            filterMarkers('');
            searchInput.focus();
        }

        // Función para ajustar el mapa a los marcadores visibles
        function fitMapToVisibleMarkers() {
            if (markerClusterGroup && markerClusterGroup.getLayers().length > 0) {
                const bounds = markerClusterGroup.getBounds();
                if (bounds.isValid()) {
                    map.fitBounds(bounds.pad(0.1));
                }
            } else if (allLeafletMarkers.length > 0 && document.getElementById('searchInput').value === '') {
                const batchSize = 500;
                let validBounds = null;

                for (let i = 0; i < allLeafletMarkers.length; i += batchSize) {
                    const batch = allLeafletMarkers.slice(i, i + batchSize);
                    const tempGroup = L.featureGroup(batch);
                    const tempBounds = tempGroup.getBounds();

                    if (tempBounds.isValid()) {
                        if (validBounds === null) {
                            validBounds = tempBounds;
                        } else {
                            validBounds.extend(tempBounds);
                        }
                    }
                }

                if (validBounds !== null) {
                    map.fitBounds(validBounds.pad(0.1));
                }
            }
        }

        // Función mejorada para carga dinámica de datos GeoJSON (CORREGIDA)
        function loadGeoJSONDataDynamically(modulo, forceReload = false) {
            if (isGeoJsonLoading && !forceReload) {
                logDebug('Ya hay una carga de GeoJSON en progreso, saltando...');
                return Promise.resolve();
            }

            const bounds = map.getBounds();
            const zoom = map.getZoom();

            logDebug(`Cargando datos GeoJSON dinámicamente - Módulo: ${modulo}, Zoom: ${zoom}`);

            // Verificar zoom mínimo para inmuebles
            if (modulo === 'inmueble' && zoom < 16) {
                showStatusMessage('Zoom mínimo para ver inmuebles es 16', 'info');
                return Promise.resolve();
            }

            isGeoJsonLoading = true;
            showDynamicLoadingIndicator();

            const sw = bounds.getSouthWest();
            const ne = bounds.getNorthEast();

            // Determinar límite basado en zoom
            let pointLimit = DYNAMIC_LOADING_CONFIG.MAX_POINTS_PER_REQUEST;
            if (zoom > 16) {
                pointLimit = Math.min(pointLimit + (zoom - 16) * 250, 5000);
            } else if (zoom < 13) {
                pointLimit = Math.max(100, pointLimit - (13 - zoom) * 100);
            }

            const url = `../php/ufPredialGetGeoJson.php?minLat=${sw.lat}&maxLat=${ne.lat}&minLng=${sw.lng}&maxLng=${ne.lng}&zoom=${zoom}&limit=${pointLimit}&modulo=${modulo}`;

            return fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    logDebug(`Datos recibidos para ${modulo}:`, data);

                    if (data.data && Array.isArray(data.data)) {
                        // Actualizar datos según el módulo
                        if (modulo === 'catastro') {
                            codigosGeoJSONData = data.data;
                            updateCodigosLayer();
                            console.log("updateCodigosLayer");
                        } else if (modulo === 'inmueble') {
                            codigosGeoJSONDataInm = data.data;
                            updateInmueblesLayer();
                            console.log("updateInmueblesLayer");
                        }

                        // Mostrar información de tiles cargados si está disponible
                        if (data.meta && data.meta.loadedTiles) {
                            const tilesInfo = data.meta.loadedTiles.map(tile =>
                                `${tile.tileKey}: ${tile.totalFeaturesLoaded}/${tile.totalFeaturesInTile}`
                            ).join(', ');
                            logDebug(`Tiles cargados: ${tilesInfo}`);
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
                    updateDebugInfo();
                });
        }

        // Función para crear capa de códigos GeoJSON
        function createCodigosLayer(data, modulo) {
            if (!data || !Array.isArray(data)) {
                console.error('Datos de códigos GeoJSON inválidos');
                return null;
            }

            // Convertir array de features a formato GeoJSON
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
                // Remover capa anterior si existe
                if (codigosLayer && map.hasLayer(codigosLayer)) {
                    map.removeLayer(codigosLayer);
                }

                // Crear nueva capa
                codigosLayer = createCodigosLayer(codigosGeoJSONData, 'catastro');
                if (codigosLayer) {
                    map.addLayer(codigosLayer);
                    logDebug(`Capa de códigos actualizada: ${codigosGeoJSONData.length} puntos`);
                }
            }
        }

        function updateInmueblesLayer() {
            if (inmueblesActive && codigosGeoJSONDataInm.length > 0) {
                // Remover capa anterior si existe
                if (codigosLayerInm && map.hasLayer(codigosLayerInm)) {
                    map.removeLayer(codigosLayerInm);
                }

                // Crear nueva capa
                codigosLayerInm = createCodigosLayer(codigosGeoJSONDataInm, 'inmueble');
                if (codigosLayerInm) {
                    map.addLayer(codigosLayerInm);
                    logDebug(`Capa de inmuebles actualizada: ${codigosGeoJSONDataInm.length} puntos`);
                }
            }
        }

        // Función para alternar capa de códigos con carga dinámica
        function toggleCodigosLayer() {
            const button = document.getElementById('codigosBtn');

            if (codigosActive) {
                // Desactivar capa
                if (codigosLayer && map.hasLayer(codigosLayer)) {
                    map.removeLayer(codigosLayer);
                    codigosLayer = null;
                    codigosGeoJSONData = [];
                }
                button.classList.remove('geojson-active');
                showStatusMessage('Capa de códigos desactivada', 'info');
                codigosActive = false;
            } else {
                // Activar capa
                const zoom = map.getZoom();
                if (zoom < 18) {
                    showStatusMessage('El zoom mínimo para ver los codigos es 16, zoom actual:' + zoom, 'error');
                    return;
                }

                codigosActive = true;
                button.classList.add('geojson-active');
                loadGeoJSONDataDynamically('catastro', true);
            }

            updateDebugInfo();
        }

        // Función para alternar capa de inmuebles con carga dinámica
        function toggleInmueblesLayer() {
            const button = document.getElementById('inmueblesBtn');

            if (inmueblesActive) {
                // Desactivar capa
                if (codigosLayerInm && map.hasLayer(codigosLayerInm)) {
                    map.removeLayer(codigosLayerInm);
                    codigosLayerInm = null;
                    codigosGeoJSONDataInm = [];
                }
                button.classList.remove('geojson-active');
                showStatusMessage('Capa de inmuebles desactivada', 'info');
                inmueblesActive = false;
            } else {
                // Activar capa
                const zoom = map.getZoom();
                if (zoom < 19) {
                    showStatusMessage('El zoom mínimo para ver inmuebles es 19, zoom actual:' + zoom, 'error');
                    return;
                }

                inmueblesActive = true;
                button.classList.add('geojson-active');
                loadGeoJSONDataDynamically('inmueble', true);
            }

            updateDebugInfo();
        }

        // Función para manejar movimiento del mapa con carga dinámica (MEJORADA)
        function handleMapMovement() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                logDebug('Mapa movido, verificando si necesita cargar datos...');

                // MEJORA: Cargar marcadores solo si no hay capas GeoJSON activas o ambas están activas
                if (!codigosActive || inmueblesActive) {
                    loadMarkersInViewport();
                }

                // Cargar datos para capas GeoJSON activas
                const promises = [];

                if (codigosActive) {
                    logDebug(' ============ Mapa movido codigosActive ==================');
                    promises.push(loadGeoJSONDataDynamically('catastro'));
                }

                if (inmueblesActive) {
                    const zoom = map.getZoom();
                    if (zoom >= 16) {
                        logDebug(' ============ Mapa movido inmueblesActive ==================');
                        promises.push(loadGeoJSONDataDynamically('inmueble'));
                    } else {
                        logDebug('Zoom insuficiente para cargar inmuebles');
                    }
                }

                // Actualizar debug info después de todas las cargas
                Promise.all(promises).then(() => {
                    updateDebugInfo();
                });

            }, DYNAMIC_LOADING_CONFIG.DEBOUNCE_DELAY);
        }

        // Funciones de control del mapa
        function toggleSatelliteLayer() {
            const button = document.getElementById('satelitalBtn');

            if (satelitalActive) {
                if (map.hasLayer(satelliteLayer)) {
                    map.removeLayer(satelliteLayer);
                }
                button.classList.remove('geojson-active');
                showStatusMessage('Capa satelital desactivada', 'info');
                satelitalActive = false;
            } else {
                if (!map.hasLayer(satelliteLayer)) {
                    map.addLayer(satelliteLayer);
                }
                button.classList.add('geojson-active');
                showStatusMessage('Capa satelital activada', 'success');
                satelitalActive = true;
            }

            updateDebugInfo();
        }

        function toggleDarkOverlay() {
            const button = document.getElementById('oscurecerBtn');

            if (oscurecerActive) {
                if (map.hasLayer(darkOverlay)) {
                    map.removeLayer(darkOverlay);
                }
                button.classList.remove('geojson-active');
                showStatusMessage('Oscurecimiento desactivado', 'info');
                oscurecerActive = false;
            } else {
                if (!map.hasLayer(darkOverlay)) {
                    map.addLayer(darkOverlay);
                }
                button.classList.add('geojson-active');
                showStatusMessage('Oscurecimiento activado', 'success');
                oscurecerActive = true;
            }

            updateDebugInfo();
        }


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
            console.log(prePuntosData);
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
                                <strong>Ver en google:</strong> <a target="_blank"  href="https://www.google.com/maps?q=${lat},${lng}"><i class="fa fa-street-view" style="font-size:1.2rem; COLOR: yellow" aria-hidden="true"></i></a>
                            </div> 
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
            console.log("togglePrePuntos:" + togglePrePuntos);

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


        function getUserLocation() {
            const locationBtn = document.getElementById('locationBtn');

            if (!navigator.geolocation) {
                showStatusMessage('Tu navegador no soporta geolocalización', 'error');
                return;
            }

            locationBtn.disabled = true;
            locationBtn.classList.add('loading');

            const options = {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 60000
            };

            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    if (userLocationMarker) {
                        map.removeLayer(userLocationMarker);
                    }

                    const userIcon = L.divIcon({
                        className: 'user-location-marker',
                        html: '<div style="background-color:rgb(216, 0, 0); width: 15px; height: 15px; border-radius: 50%; border: 3px solid white; box-shadow: 0 0 10px rgba(0,0,0,0.3);"></div>',
                        iconSize: [15, 15],
                        iconAnchor: [10, 10]
                    });

                    userLocationMarker = L.marker([lat, lng], {
                        icon: userIcon
                    }).addTo(map);

                    const userPopupContent = `
                        <div class="popup-content">
                            <div class="popup-title">Tu estás acá</div> 
                        </div>`;
                    userLocationMarker.bindPopup(userPopupContent).openPopup();
                    map.setView([lat, lng], 16);
                    showStatusMessage('Ubicación encontrada correctamente', 'success');
                    locationBtn.disabled = false;
                    locationBtn.classList.remove('loading');
                },
                function(error) {
                    let errorMessage = '';
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            errorMessage = 'Permiso de ubicación denegado';
                            break;
                        case error.POSITION_UNAVAILABLE:
                            errorMessage = 'Ubicación no disponible';
                            break;
                        case error.TIMEOUT:
                            errorMessage = 'Tiempo de espera agotado';
                            break;
                        default:
                            errorMessage = 'Error desconocido al obtener ubicación';
                            break;
                    }
                    showStatusMessage(errorMessage, 'error');
                    locationBtn.disabled = false;
                    locationBtn.classList.remove('loading');
                },
                options
            );
        }

        function zoomIn() {
            map.zoomIn();
        }

        function zoomOut() {
            map.zoomOut();
        }

        function homeBtn() {
            window.location.href = "ufPredialList.php";
        }

        // NUEVA FUNCIÓN: Alternar agrupación de puntos
        function toggleGroupedPoints() {
            ALLOW_GROUPED_POINTS = !ALLOW_GROUPED_POINTS;

            // Reinicializar marcadores con nueva configuración
            if (markerClusterGroup) {
                const currentMarkers = allLeafletMarkers.slice(); // Copia de marcadores
                allLeafletMarkers = [];
                loadedMarkerIds.clear();

                // Reinicializar con nueva configuración
                initializeMarkers();

                // Recargar marcadores
                if (currentMarkers.length > 0) {
                    const markerData = currentMarkers.map(marker => marker.originalData);
                    processMarkersInBatches(markerData, 0);
                }
            }

            showStatusMessage(
                `Agrupación de puntos ${ALLOW_GROUPED_POINTS ? 'activada' : 'desactivada'}`,
                'success'
            );
            updateDebugInfo();
        }

        // Función para manejar clicks en el mapa y obtener coordenadas
        function handleMapClick(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;

            // Formatear las coordenadas con 6 decimales
            const formattedCoordinates = `Lat: ${lat.toFixed(6)}, Lng: ${lng.toFixed(6)}`;
            const coordinatesArray = `[${lat.toFixed(6)}, ${lng.toFixed(6)}]`;

            // Mostrar las coordenadas en el input de búsqueda
            const searchInput = document.getElementById('searchInput');
            searchInput.value = formattedCoordinates;

            // Copiar coordenadas al portapapeles
            copyToClipboard(coordinatesArray);

            // Remover marcador anterior si existe
            if (clickedCoordinatesMarker) {
                map.removeLayer(clickedCoordinatesMarker);
            }

            // Crear un marcador en el punto clickeado
            const clickedIcon = L.divIcon({
                className: 'clicked-coordinates-marker-container',
                html: '<div class="clicked-coordinates-marker"></div>',
                iconSize: [20, 20],
                iconAnchor: [10, 10]
            });

            clickedCoordinatesMarker = L.marker([lat, lng], {
                icon: clickedIcon
            }).addTo(map);

            // Crear popup con las coordenadas
            const popupContent = `
                <div class="popup-content">
                    <div class="popup-title">Coordenadas Seleccionadas</div>
                    <div class="popup-description">
                        <strong>[${lat.toFixed(6)}, ${lng.toFixed(6)}]</strong><br>
                        <small style="color: #00C8FF;">Coordenadas copiadas al portapapeles</small>
                    </div>
                </div>`;

            clickedCoordinatesMarker.bindPopup(popupContent).openPopup();

            showStatusMessage('Coordenadas copiadas al portapapeles', 'success');
        }

        // Función para copiar al portapapeles
        function copyToClipboard(text) {
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).catch(err => {
                    console.error('Error al copiar al portapapeles:', err);
                });
            } else {
                // Fallback para navegadores más antiguos
                const textArea = document.createElement('textarea');
                textArea.value = text;
                textArea.style.position = 'fixed';
                textArea.style.left = '-999999px';
                textArea.style.top = '-999999px';
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                try {
                    document.execCommand('copy');
                } catch (err) {
                    console.error('Error al copiar al portapapeles:', err);
                }
                document.body.removeChild(textArea);
            }
        }
        // Función para activar modo agregar punto
        function toggleAddPointMode(event) {
            // IMPORTANTE: Prevenir propagación del evento del botón
            if (event) {
                event.stopPropagation();
                event.preventDefault();
            }

            const button = document.getElementById('addPointBtn');

            if (isAddingPoint) {
                // Desactivar modo
                isAddingPoint = false;
                button.classList.remove('geojson-active');
                showStatusMessage('Modo agregar punto desactivado', 'info');

                // Remover event listener temporal
                map.off('click', handleAddPointClick);

                // Restaurar cursor normal
                map.getContainer().style.cursor = '';
            } else {
                // Activar modo
                isAddingPoint = true;
                button.classList.add('geojson-active');
                showStatusMessage('Haga clic en el mapa para agregar un punto', 'success');

                // Cambiar cursor para indicar modo activo
                map.getContainer().style.cursor = 'crosshair';

                // Agregar event listener para agregar punto CON DELAY
                setTimeout(() => {
                    map.on('click', handleAddPointClick);
                }, 100); // Pequeño delay para evitar captura inmediata
            }
            debugAddPoint();
        }
        // Función para manejar click al agregar punto
        function handleAddPointClick(e) {
            console.log('handleAddPointClick ejecutado', e);

            // Verificar que realmente estamos en modo agregar punto
            if (!isAddingPoint) {
                console.log('No está en modo agregar punto, ignorando click');
                return;
            }

            // Prevenir propagación
            if (e.originalEvent) {
                e.originalEvent.stopPropagation();
            }
            L.DomEvent.stopPropagation(e);

            const lat = e.latlng.lat;
            const lng = e.latlng.lng;

            console.log('Creando punto en:', lat, lng);

            // Crear marcador en el punto clickeado
            const pointIcon = L.divIcon({
                className: 'new-point-marker-container',
                html: '<div style="background-color: #ff6b35; width: 12px; height: 12px; border-radius: 50%; border: 2px solid white; box-shadow: 0 0 8px rgba(255, 107, 53, 0.8); animation: pulseAnimation 1.5s infinite ease-in-out;"></div>',
                iconSize: [16, 16],
                iconAnchor: [8, 8]
            });

            newPointMarker = L.marker([lat, lng], {
                icon: pointIcon
            }).addTo(map);

            // Mostrar popup personalizado inmediatamente
            showCustomPopup(lat, lng);

            // Desactivar modo agregar punto INMEDIATAMENTE
            isAddingPoint = false;
            const button = document.getElementById('addPointBtn');
            button.classList.remove('geojson-active');
            map.off('click', handleAddPointClick);

            // Restaurar cursor normal
            map.getContainer().style.cursor = '';

            showStatusMessage('Punto creado. Complete la información.', 'info');
        }
        // Función para mostrar popup personalizado
        function showCustomPopup(lat, lng) {
            // Guardar datos del punto actual
            currentPointData = {
                lat: lat,
                lng: lng,
                marker: newPointMarker,
                saved: false
            };

            // Crear overlay
            const overlay = document.createElement('div');
            overlay.className = 'popup-overlay';

            // Crear popup
            const popup = document.createElement('div');
            popup.className = 'custom-popup';
            popup.innerHTML = `
                <h3>Nuevo Punto</h3>
                <p style="font-size: 12px; color: #666; margin-bottom: 10px;">
                    Coordenadas: ${lat.toFixed(6)}, ${lng.toFixed(6)}
                </p>
                <input type="text" id="pointInput" placeholder="Ingrese descripción del punto..." />
                <div class="custom-popup-buttons">
                    <button class="btn-save" onclick="saveNewPoint()">Guardar</button>
                    <button class="btn-closeMap" onclick="closeCustomPopup(false)">Cerrar</button>
                </div>
            `;

            // Agregar al DOM
            document.body.appendChild(overlay);
            document.body.appendChild(popup);

            customPopupElement = popup;

            // Enfocar input después de un breve delay
            setTimeout(() => {
                const input = document.getElementById('pointInput');
                if (input) {
                    input.focus();
                    input.select();
                }
            }, 150);

            // Cerrar con overlay (sin guardar)
            overlay.addEventListener('click', () => closeCustomPopup(false));

            // Manejar Enter para guardar
            setTimeout(() => {
                const input = document.getElementById('pointInput');
                if (input) {
                    input.addEventListener('keypress', function(e) {
                        if (e.key === 'Enter') {
                            saveNewPoint();
                        }
                    });
                }
            }, 100);
        }

        // Función para guardar nuevo punto
        function saveNewPoint() {
            const input = document.getElementById('pointInput');
            const description = input.value.trim();

            if (description === '') {
                showStatusMessage('Por favor ingrese una descripción', 'error');
                return;
            }

            // Marcar como guardado
            if (currentPointData) {
                currentPointData.saved = true;
                currentPointData.description = description;
                currentPointData.timestamp = new Date().toISOString();
            }

            // Cambiar el estilo del marcador a "guardado"
            if (newPointMarker) {
                // Crear nuevo icono para punto guardado
                const savedPointIcon = L.divIcon({
                    className: 'saved-point-marker-container',
                    html: '<div style="background-color: #feff12; width: 0.9rem; height: 0.9rem; border-radius: 50%; box-shadow: 0 0 6px #fff, 0 0 0.9rem #fff, 0 0 18px rgb(176, 193, 23), 0 0 24px rgb(193, 190, 23), 0 0 30px rgb(248, 231, 76), 0 0 36px rgb(237, 248, 76); border: 2px solid #fff;   animation: pulseAnimation 5s infinite ease-in-out;"></div>',
                    iconSize: [18, 18],
                    iconAnchor: [9, 9]
                });

                // Actualizar el icono del marcador
                newPointMarker.setIcon(savedPointIcon);

                // Crear popup para el punto guardado
                const savedPopupContent = `
            <div class="popup-content">
                <div class="popup-title">Punto Guardado</div>
                <div class="popup-description">
                    <strong>Descripción:</strong> ${description}<br>
                    <strong>Coordenadas:</strong> ${currentPointData.lat.toFixed(6)}, ${currentPointData.lng.toFixed(6)}<br>
                    <small style="color: #feff12;">Guardado: ${new Date().toLocaleString()}</small>
                </div>
            </div>`;

                // Actualizar el popup del marcador
                newPointMarker.bindPopup(savedPopupContent);

                // Agregar a la lista de puntos guardados
                savedPoints.push({
                    id: Date.now(), // ID único basado en timestamp
                    marker: newPointMarker,
                    lat: currentPointData.lat,
                    lng: currentPointData.lng,
                    description: description,
                    timestamp: currentPointData.timestamp
                });

                console.log('Punto guardado:', savedPoints[savedPoints.length - 1]);
            }
            const data = {
                latitud: currentPointData.lat,
                longitud: currentPointData.lng,
                detalle: description
            };
            console.log(data);
            $.ajax({
                async: true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url: "../php/ufSavePrePunto.php",
                data: data,
                beforeSend: function() {
                    loadGralOn();
                },
                success: function(dat) {
                    console.log(dat);
                    loadGralOff();
                },
            });

            // Cerrar popup (con guardado = true)
            closeCustomPopup(true);

            showStatusMessage(`Punto guardado correctamente. Total puntos: ${savedPoints.length}`, 'success');

            // Resetear variables para permitir crear nuevo punto
            newPointMarker = null;
            currentPointData = null;
        }
        // Función para cerrar popup personalizado
        function closeCustomPopup(wasSaved = false) {
            // Remover popup y overlay
            const overlay = document.querySelector('.popup-overlay');
            if (overlay) {
                overlay.remove();
            }

            if (customPopupElement) {
                customPopupElement.remove();
                customPopupElement = null;
            }

            // Solo remover marcador si NO fue guardado
            if (!wasSaved && newPointMarker) {
                map.removeLayer(newPointMarker);
                newPointMarker = null;
                showStatusMessage('Punto cancelado', 'info');
            }

            // Si fue guardado, solo resetear la referencia (el marcador queda en el mapa)
            if (wasSaved) {
                newPointMarker = null;
            }

            // Resetear datos del punto actual
            currentPointData = null;

            // Asegurar que el modo esté desactivado
            if (isAddingPoint) {
                isAddingPoint = false;
                const button = document.getElementById('addPointBtn');
                button.classList.remove('geojson-active');
                map.off('click', handleAddPointClick);
                map.getContainer().style.cursor = '';
            }
        }



        // Event Listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar marcadores
            initializeMarkers();

            // Event listeners para controles
            /* document.getElementById('locationBtn').addEventListener('click', getUserLocation); */

            // En la sección de Event Listeners, cambiar esta línea:
            document.getElementById('addPointBtn').addEventListener('click', function(e) {
                e.stopPropagation();
                e.preventDefault();
                toggleAddPointMode(e);
            });

            document.getElementById('zoomInBtn').addEventListener('click', zoomIn);
            document.getElementById('zoomOutBtn').addEventListener('click', zoomOut);
            document.getElementById('homeBtn').addEventListener('click', homeBtn);
            document.getElementById('codigosBtn').addEventListener('click', toggleCodigosLayer);
            document.getElementById('inmueblesBtn').addEventListener('click', toggleInmueblesLayer);
            document.getElementById('satelitalBtn').addEventListener('click', toggleSatelliteLayer);
            document.getElementById('oscurecerBtn').addEventListener('click', toggleDarkOverlay);

            document.getElementById('prePuntosBtn').addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                togglePrePuntos();
                this.blur();
            });

            // Event listeners para búsqueda
            const searchInput = document.getElementById('searchInput');
            const clearSearchBtn = document.getElementById('clearSearch');
            const showAllBtn = document.getElementById('showAllBtn');

            searchInput.addEventListener('input', function() {
                filterMarkers(this.value);
            });

            clearSearchBtn.addEventListener('click', clearSearch);
            showAllBtn.addEventListener('click', showAllMarkers);

            // Event listeners para el mapa
            map.on('moveend', handleMapMovement);
            map.on('zoomend', handleMapMovement);
            /* map.on('click', handleMapClick);   -- para mostrar coordenadas segun se haga click en el mapa*/

            // NUEVO: Event listener para alternar agrupación (tecla G)
            document.addEventListener('keydown', function(e) {
                if (e.key === 'g' || e.key === 'G') {
                    toggleGroupedPoints();
                }
            });

            // Cargar datos iniciales
            setTimeout(() => {
                loadMarkersInViewport();
            }, 1000);

            // Actualizar debug info inicial
            updateDebugInfo();

            console.log('Sistema de mapas dinámico inicializado correctamente');
        });

        // Actualizar debug info cuando cambie el zoom
        map.on('zoomend', updateDebugInfo);
        map.on('moveend', updateDebugInfo);

        console.log('Script de mapa cargado completamente');

        /* document.addEventListener('DOMContentLoaded', initializeApp); */

        function nextImage(id) {
            const container = document.getElementById(`card-${id}`);
            const images = JSON.parse(container.dataset.images);
            let index = parseInt(container.dataset.index, 10);
            index = (index + 1) % images.length;
            container.dataset.index = index;
            document.getElementById(`img-${id}`).src = "../static/ufpredial/" + images[index];
        }

        function prevImage(id) {
            const container = document.getElementById(`card-${id}`);
            const images = JSON.parse(container.dataset.images);
            let index = parseInt(container.dataset.index, 10);
            index = (index - 1 + images.length) % images.length;
            container.dataset.index = index;
            document.getElementById(`img-${id}`).src = "../static/ufpredial/" + images[index];
        }

        function actualizarEstado(id, inmueble, estado) {
            let estado_ = (estado ? 'ACTUALIZADO SIN OBSERVACIONES' : 'CONTRIBUYENTE DESACATÓ LA FISCALIZACIÓN');
            let type = (estado ? 'green' : 'red');
            let btnClass = (estado ? 'btn-green' : 'btn-red');
            $.confirm({
                title: "Confirme",
                content: `Por favor confirme el cambio de estado a ${estado_} del inmueble  ${inmueble}<br><textarea id="observacionEstado" placeholder="Redacte la observción o anotacion técnica si corresponde" class="form-control"></textarea>`,
                type: type,
                typeAnimated: true,
                columnClass: "col-md-6 col-md-offset-6 col-xs-8 col-xs-offset-8",
                buttons: {
                    cancel: {
                        text: "Cerrar",
                        action: function() {},
                    },
                    guardar: {
                        text: "Confirmar",
                        btnClass: btnClass,
                        action: function() {
                            console.log("ajax para actualizar estado");
                            datos = "&id=" + id + "&estado=" + (estado ? '2' : '3') + "&inmueble=" + inmueble + "&observacionEstado=" + $('#observacionEstado').val();
                            $.ajax({
                                async: true,
                                type: "POST",
                                dataType: "html",
                                contentType: "application/x-www-form-urlencoded",
                                url: "../php/ufSaveCambioEstado.php",
                                data: datos,
                                beforeSend: function() {
                                    loadGralOn();
                                },
                                success: function(e) {
                                    console.log(e);
                                    loadGralOff();
                                    dat = JSON.parse(e)
                                    if (dat.err == '0') {
                                        window.location.href = './ufdatmap.php';
                                    } else {
                                        $.confirm({
                                            title: " Error",
                                            type: "red",
                                            content: dat.log,
                                        });
                                    }

                                },
                                error: function() {},
                            });
                        }
                    },
                },
                onOpenBefore: function() {
                    $('.jconfirm-title-c').css('text-align', 'center');
                }
            });
            console.log("en funcion, no se presento: " + inmueble);
        }

        // Agregar esta función temporal para debug
        function debugAddPoint() {
            console.log('Estado actual:');
            console.log('isAddingPoint:', isAddingPoint);
            console.log('Button classes:', document.getElementById('addPointBtn').className);
            console.log('Map cursor:', map.getContainer().style.cursor);
        }

        // Función para actualizar contador de puntos
        function updatePointsCounter() {
            const counterElement = document.getElementById('pointsCounter');
            if (counterElement) {
                counterElement.textContent = `Puntos guardados: ${savedPoints.length}`;
            }
        }

        // Llamar esta función después de guardar un punto (agregar en saveNewPoint)
        updatePointsCounter();


        function loadGralOn() {
            $(".loadGral").addClass("loadGralOn");
            $(".loadGral").removeClass("loadGralOff");
            $(".loadGral").html("<img src='../img/ia.gif'>");

        }

        function loadGralOff() {
            $(".loadGral").removeClass("loadGralOn");
            $(".loadGral").addClass("loadGralOff");
        }



        $(document).ready(function() {
            toggleDarkOverlay();


        });
    </script>
</body>

</html>