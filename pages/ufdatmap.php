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
    <title>Monitor geoespacial | El Alto</title>

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

        /* Nuevos estilos para botones de inmuebles y códigos */
        .control-button.geojson-codigos {
            background-color: rgba(34, 39, 41, 0.9);
        }

        .control-button.geojson-codigos.geojson-active {
            background-color: rgba(255, 165, 0, 0.8);
            color: white;
        }

        .control-button.geojson-codigos:hover {
            background-color: rgba(36, 37, 38, 0.9);
        }

        .control-button.geojson-active {
            background-color: rgba(255, 165, 0, 0.8);
            color: white;
        }

        .control-button.geojson-active:hover {
            background-color: rgba(36, 37, 38, 0.9);
        }

        .control-button.satelital {
            background-color: rgba(29, 25, 22, 0.8);
        }

        .control-button.satelital.geojson-active {
            background-color: rgba(255, 165, 0, 0.8);
        }

        .control-button.satelital:hover {
            background-color: rgba(36, 29, 27, 0.9)
        }

        .control-button.oscurecer {
            background-color: rgba(50, 50, 50, 0.8);
        }

        .control-button.oscurecer.geojson-active {
            background-color: rgba(255, 165, 0, 0.8);
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
            /* animation: pulseAnimation 2.8s infinite ease-in-out; */
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
            /* box-shadow:
                0 0 6px #fff,
                0 0 0.9rem #fff,
                0 0 18px #17b9c1,
                0 0 24px #17b9c1,
                0 0 30px #4cf0f8,
                0 0 36px #4cf0f8; */
            border: 2px solid #fff;
            /* animation: pulseAnimation 5s infinite ease-in-out; */
        }

        /* Nuevo estilo para marcadores de hoy */
        .puntoMarcaHoy {
            background-color: rgb(0, 47, 255);
            width: 0.9rem;
            height: 0.9rem;
            border-radius: 50%;
            /* box-shadow:
                0 0 6px #fff,
                0 0 0.9rem #fff,
                0 0 18px rgb(9, 106, 216),
                0 0 24px rgb(9, 81, 216),
                0 0 30px rgb(0, 119, 255),
                0 0 36px rgb(0, 132, 255); */
            border: 2px solid #fff;
            /* animation: pulseAnimation 1.5s infinite ease-in-out; */
        }

        .puntoActualizado {
            background-color: #0ecc08;
            width: 0.9rem;
            height: 0.9rem;
            border-radius: 50%;
            /* box-shadow:
                0 0 6px #fff,
                0 0 0.9rem #fff,
                0 0 18px #0ecc08,
                0 0 24px #0ecc08,
                0 0 30px #0ecc08,
                0 0 36px #0ecc08; */
            border: 2px solid #fff;
            /* animation: pulseAnimation 1.5s infinite ease-in-out; */
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
            /* animation: pulseAnimation 2.8s infinite ease-in-out; */
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
            /* animation: pulseAnimation 1s infinite ease-in-out; */
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
            top: 3vh;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            border: 0.2rem solid #00C8FF;
            border-radius: 0.5rem;
            padding: 1.2rem;
            box-shadow: 0 0.3rem 1.2rem rgba(0, 0, 0, 0.3);
            z-index: 2000;
            width: 90vw;
            max-width: 28rem;
            /* Aproximadamente 450px */
            box-sizing: border-box;
            font-size: 1rem;
        }

        .custom-popup h3 {
            margin: 0 0 1rem 0;
            color: #00C8FF;
            text-align: center;
            font-size: 1.2rem;
        }

        .custom-popup input[type="text"],
        .custom-popup input[type="color"] {
            width: 100%;
            padding: 0.6rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 0.4rem;
            font-size: 1rem;
            box-sizing: border-box;
        }

        .color-picker-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .color-picker-label {
            flex: 1;
            display: flex;
            align-items: center;
            font-size: 1rem;
            color: #333;
        }

        .color-picker-input {
            margin-left: 0.5rem;
            height: 2.2rem;
            width: 3rem;
            border: none;
            cursor: pointer;
        }

        .custom-popup-buttons {
            display: flex;
            justify-content: space-between;
            gap: 0.8rem;
        }

        .custom-popup-buttons button {
            flex: 1;
            font-size: 1rem;
            border: none;
            border-radius: 0.4rem;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-save {
            background-color: #00C8FF;
            color: white;
        }

        .btn-closeMap {
            background-color: #FF4B4B;
            color: white;
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
            background-color: rgba(29, 25, 22, 0.9);
        }

        .control-button.pre-puntos.active {
            background-color: rgba(255, 165, 0, 0.8);
        }

        .control-button.pre-puntos:hover {
            background-color: rgba(36, 37, 38, 0.9);
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



        /* Estilos para el selector de color */
        .color-picker-container {
            /* margin: 10px 0; */
        }

        .color-picker-label {
            display: block;
            font-size: 12px;
            color: #666;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .color-picker-input {
            width: 70%;
            height: 40px;
            border: 2px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            background: #fff;
            transition: border-color 0.3s ease;
        }

        .color-picker-input:hover {
            border-color: #007bff;
        }

        .color-picker-input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        .color-preview {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 3px;
            border: 1px solid #ccc;
            margin-left: 8px;
            vertical-align: middle;
        }

        .color-value-display {
            font-size: 11px;
            color: #888;
            margin-top: 3px;
            font-family: monospace;
        }



        /* Estilos para el botón de distritos */
        .control-button.distritos {
            background-color: rgba(34, 39, 41, 0.9);
        }

        .control-button.distritos.geojson-active {
            background-color: rgba(255, 165, 0, 0.8);
            color: white;
        }

        .control-button.distritos:hover {
            background-color: rgba(33, 36, 37, 0.9);
        }

        /* Estilos para los polígonos de distritos */
        .distrito-polygon {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        /* Estilos para el tooltip */
        .distrito-tooltip {
            background-color: rgba(0, 0, 0, 0.8) !important;
            color: white !important;
            border: none !important;
            border-radius: 4px !important;
            padding: 8px 12px !important;
            font-size: 14px !important;
            font-weight: bold !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3) !important;
        }

        .distrito-tooltip::before {
            border-top-color: rgba(0, 0, 0, 0.8) !important;
        }

        /* Estilos específicos para cada distrito */
        .distrito-1 {
            border-color: #FF6B6B !important;
        }

        .distrito-2 {
            border-color: #4ECDC4 !important;
        }

        .distrito-3 {
            border-color: #45B7D1 !important;
        }

        .distrito-4 {
            border-color: #96CEB4 !important;
        }

        .distrito-5 {
            border-color: #FFEAA7 !important;
        }

        .distrito-6 {
            border-color: #DDA0DD !important;
        }

        .distrito-7 {
            border-color: #98D8C8 !important;
        }

        .distrito-8 {
            border-color: #F7DC6F !important;
        }

        .distrito-9 {
            border-color: #BB8FCE !important;
        }

        .distrito-10 {
            border-color: #85C1E9 !important;
        }

        .distrito-11 {
            border-color: #F8C471 !important;
        }

        .distrito-12 {
            border-color: #82E0AA !important;
        }

        .distrito-13 {
            border-color: #F1948A !important;
        }

        .distrito-14 {
            border-color: #AED6F1 !important;
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

                <button id="distritosBtn" class="control-button distritos" title="Mostrar/Ocultar Distritos" aria-label="Capa Distritos">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
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

        // Variables para distritos
        let distritosLayerGroup = null;
        let distritosActive = false;
        let currentTooltip = null; // Para el tooltip

        const distritosData = {
            distrito1: [
                [-16.507841, -68.156198],
                [-16.507841, -68.156197],
                [-16.507382, -68.155737],
                [-16.507884, -68.155289],
                [-16.508726, -68.154538],
                [-16.508893, -68.154446],
                [-16.508978, -68.154399],
                [-16.51172, -68.152886],
                [-16.511721, -68.152887],
                [-16.511721, -68.152889],
                [-16.511765, -68.153002],
                [-16.511821, -68.153148],
                [-16.511821, -68.153148],
                [-16.511822, -68.153147],
                [-16.512434, -68.152744],
                [-16.51265, -68.152601],
                [-16.51265, -68.152603],
                [-16.51265, -68.152605],
                [-16.512642, -68.152663],
                [-16.512633, -68.152736],
                [-16.512598, -68.153002],
                [-16.5126, -68.153001],
                [-16.5126, -68.153001],
                [-16.51261, -68.152996],
                [-16.512796, -68.152908],
                [-16.516695, -68.151065],
                [-16.51675, -68.151039],
                [-16.517177, -68.150835],
                [-16.517977, -68.150794],
                [-16.517813, -68.150498],
                [-16.518319, -68.149897],
                [-16.519204, -68.149787],
                [-16.519204, -68.149787],
                [-16.520421, -68.149428],
                [-16.521368, -68.148341],
                [-16.521618, -68.148304],
                [-16.524877, -68.147106],
                [-16.528789, -68.144554],
                [-16.52879, -68.144555],
                [-16.528791, -68.144557],
                [-16.529371, -68.145697],
                [-16.529372, -68.145698],
                [-16.530511, -68.147284],
                [-16.531354, -68.147847],
                [-16.531362, -68.147851],
                [-16.533688, -68.149403],
                [-16.533688, -68.149403],
                [-16.533901, -68.149166],
                [-16.536798, -68.145928],
                [-16.539842, -68.146387],
                [-16.539842, -68.146388],
                [-16.540445, -68.147502],
                [-16.540498, -68.1476],
                [-16.541005, -68.148536],
                [-16.541509, -68.149341],
                [-16.541883, -68.14994],
                [-16.541883, -68.149941],
                [-16.541649, -68.152298],
                [-16.541626, -68.152531],
                [-16.5415, -68.153793],
                [-16.541685, -68.155197],
                [-16.54175, -68.155684],
                [-16.542371, -68.160398],
                [-16.542372, -68.160399],
                [-16.544525, -68.16199],
                [-16.545005, -68.162344],
                [-16.546873, -68.163724],
                [-16.548855, -68.166314],
                [-16.54886, -68.16632],
                [-16.548859, -68.166321],
                [-16.548129, -68.167406],
                [-16.547215, -68.168763],
                [-16.546983, -68.169579],
                [-16.54695, -68.170329],
                [-16.546473, -68.170441],
                [-16.544918, -68.170806],
                [-16.545698, -68.171862],
                [-16.545868, -68.172092],
                [-16.546844, -68.173413],
                [-16.546845, -68.173413],
                [-16.548985, -68.173638],
                [-16.548985, -68.173638],
                [-16.549272, -68.173793],
                [-16.549932, -68.174149],
                [-16.550075, -68.174226],
                [-16.550075, -68.174226],
                [-16.550074, -68.174213],
                [-16.550072, -68.174111],
                [-16.550066, -68.173821],
                [-16.550065, -68.173728],
                [-16.551638, -68.17384],
                [-16.554375, -68.174037],
                [-16.555262, -68.1741],
                [-16.555262, -68.174102],
                [-16.555294, -68.174259],
                [-16.555441, -68.174995],
                [-16.555469, -68.175133],
                [-16.55553, -68.175436],
                [-16.555541, -68.17549],
                [-16.555648, -68.17602],
                [-16.555675, -68.176511],
                [-16.555675, -68.176511],
                [-16.55553, -68.177059],
                [-16.554535, -68.179582],
                [-16.554438, -68.179828],
                [-16.549412, -68.178108],
                [-16.545168, -68.176655],
                [-16.540598, -68.175062],
                [-16.535679, -68.173468],
                [-16.535666, -68.173464],
                [-16.535603, -68.173442],
                [-16.534576, -68.17309],
                [-16.533195, -68.172622],
                [-16.529812, -68.171477],
                [-16.523647, -68.169461],
                [-16.523454, -68.169397],
                [-16.523303, -68.169348],
                [-16.522868, -68.169206],
                [-16.522677, -68.169143],
                [-16.51938, -68.16806],
                [-16.516272, -68.167046],
                [-16.516244, -68.167035],
                [-16.512095, -68.165503],
                [-16.51207, -68.165789],
                [-16.51177, -68.169185],
                [-16.511739, -68.169536],
                [-16.511616, -68.169532],
                [-16.511567, -68.169487],
                [-16.507357, -68.165598],
                [-16.507089, -68.165351],
                [-16.506587, -68.164889],
                [-16.506483, -68.164779],
                [-16.50621, -68.164493],
                [-16.506052, -68.164329],
                [-16.505366, -68.163614],
                [-16.505349, -68.163597],
                [-16.505348, -68.163596],
                [-16.505331, -68.163578],
                [-16.504778, -68.16307],
                [-16.503986, -68.16279],
                [-16.503702, -68.162691],
                [-16.502227, -68.162551],
                [-16.502012, -68.162084],
                [-16.502011, -68.162082],
                [-16.502444, -68.161829],
                [-16.502814, -68.161429],
                [-16.502843, -68.161397],
                [-16.503113, -68.161104],
                [-16.503118, -68.161099],
                [-16.503403, -68.160791],
                [-16.503639, -68.160535],
                [-16.505118, -68.158933],
                [-16.507841, -68.156198]
            ],
            distrito2: [
                [-16.555675, -68.176511],
                [-16.555675, -68.176511],
                [-16.555648, -68.17602],
                [-16.557795, -68.177678],
                [-16.561586, -68.180599],
                [-16.563567, -68.179845],
                [-16.564407, -68.179525],
                [-16.564673, -68.179424],
                [-16.564673, -68.179424],
                [-16.566156, -68.180107],
                [-16.566261, -68.180155],
                [-16.566495, -68.180263],
                [-16.567075, -68.18053],
                [-16.567457, -68.180903],
                [-16.568148, -68.181577],
                [-16.569656, -68.183049],
                [-16.570061, -68.183445],
                [-16.570242, -68.183535],
                [-16.571257, -68.184042],
                [-16.571295, -68.184061],
                [-16.571777, -68.184302],
                [-16.573172, -68.184999],
                [-16.573557, -68.184925],
                [-16.573571, -68.184971],
                [-16.573804, -68.185724],
                [-16.573805, -68.185725],
                [-16.573807, -68.185731],
                [-16.570615, -68.185947],
                [-16.568799, -68.188282],
                [-16.56795, -68.189373],
                [-16.566325, -68.191463],
                [-16.566263, -68.191543],
                [-16.566464, -68.191744],
                [-16.567652, -68.192937],
                [-16.568924, -68.193499],
                [-16.569146, -68.193274],
                [-16.570863, -68.194946],
                [-16.573371, -68.197768],
                [-16.572539, -68.198908],
                [-16.572558, -68.198997],
                [-16.572326, -68.199292],
                [-16.571695, -68.19877],
                [-16.571562, -68.198924],
                [-16.570899, -68.199691],
                [-16.570128, -68.200512],
                [-16.569011, -68.201492],
                [-16.567674, -68.200128],
                [-16.564805, -68.1972],
                [-16.564134, -68.196515],
                [-16.563135, -68.195495],
                [-16.561641, -68.19397],
                [-16.561639, -68.193968],
                [-16.559985, -68.197956],
                [-16.559959, -68.198021],
                [-16.559241, -68.199751],
                [-16.559241, -68.199752],
                [-16.558671, -68.201127],
                [-16.55814, -68.202388],
                [-16.558083, -68.202523],
                [-16.557712, -68.20342],
                [-16.557712, -68.20342],
                [-16.555145, -68.209655],
                [-16.55513, -68.209692],
                [-16.55506, -68.20963],
                [-16.554962, -68.209641],
                [-16.552232, -68.207017],
                [-16.550104, -68.20505],
                [-16.549092, -68.204117],
                [-16.549078, -68.204105],
                [-16.546858, -68.202057],
                [-16.545575, -68.200873],
                [-16.544009, -68.199429],
                [-16.542617, -68.198145],
                [-16.542611, -68.19814],
                [-16.542577, -68.198109],
                [-16.540763, -68.196436],
                [-16.539979, -68.195714],
                [-16.539979, -68.195714],
                [-16.538152, -68.194033],
                [-16.536998, -68.192975],
                [-16.536941, -68.192923],
                [-16.536712, -68.192713],
                [-16.536302, -68.192331],
                [-16.53455, -68.190718],
                [-16.53308, -68.189366],
                [-16.532715, -68.18903],
                [-16.531658, -68.188065],
                [-16.529372, -68.185933],
                [-16.527831, -68.184494],
                [-16.527045, -68.183768],
                [-16.526661, -68.183421],
                [-16.52665, -68.183411],
                [-16.526645, -68.183407],
                [-16.524828, -68.181763],
                [-16.524707, -68.181653],
                [-16.523436, -68.180498],
                [-16.522382, -68.179534],
                [-16.521442, -68.178675],
                [-16.520334, -68.177662],
                [-16.517243, -68.174833],
                [-16.516299, -68.17397],
                [-16.516251, -68.173927],
                [-16.516225, -68.173903],
                [-16.516234, -68.17262],
                [-16.516267, -68.167733],
                [-16.516267, -68.167732],
                [-16.516271, -68.167176],
                [-16.516272, -68.167046],
                [-16.51938, -68.16806],
                [-16.522677, -68.169143],
                [-16.522868, -68.169206],
                [-16.523303, -68.169348],
                [-16.523454, -68.169397],
                [-16.523647, -68.169461],
                [-16.529812, -68.171477],
                [-16.533195, -68.172622],
                [-16.534576, -68.17309],
                [-16.535603, -68.173442],
                [-16.535666, -68.173464],
                [-16.535679, -68.173468],
                [-16.540598, -68.175062],
                [-16.545168, -68.176655],
                [-16.549412, -68.178108],
                [-16.554438, -68.179828],
                [-16.554535, -68.179582],
                [-16.55553, -68.177059],
                [-16.555675, -68.176511]
            ],
            distrito3: [
                [-16.521689, -68.192517],
                [-16.521803, -68.192382],
                [-16.518009, -68.188892],
                [-16.517425, -68.188354],
                [-16.517423, -68.188353],
                [-16.517424, -68.18833],
                [-16.517468, -68.186802],
                [-16.517575, -68.183477],
                [-16.515964, -68.183406],
                [-16.51606, -68.179767],
                [-16.516181, -68.175471],
                [-16.516225, -68.173903],
                [-16.516251, -68.173927],
                [-16.516299, -68.17397],
                [-16.517243, -68.174833],
                [-16.520334, -68.177662],
                [-16.521442, -68.178675],
                [-16.522382, -68.179534],
                [-16.523436, -68.180498],
                [-16.524707, -68.181653],
                [-16.524828, -68.181763],
                [-16.526645, -68.183407],
                [-16.52665, -68.183411],
                [-16.526661, -68.183421],
                [-16.527045, -68.183768],
                [-16.527831, -68.184494],
                [-16.529372, -68.185933],
                [-16.531658, -68.188065],
                [-16.532715, -68.18903],
                [-16.53308, -68.189366],
                [-16.53455, -68.190718],
                [-16.536302, -68.192331],
                [-16.536712, -68.192713],
                [-16.536941, -68.192923],
                [-16.536998, -68.192975],
                [-16.538152, -68.194033],
                [-16.539979, -68.195714],
                [-16.539979, -68.195714],
                [-16.540763, -68.196436],
                [-16.542577, -68.198109],
                [-16.542611, -68.19814],
                [-16.542617, -68.198145],
                [-16.544009, -68.199429],
                [-16.545575, -68.200873],
                [-16.546858, -68.202057],
                [-16.549078, -68.204105],
                [-16.549092, -68.204117],
                [-16.550104, -68.20505],
                [-16.552232, -68.207017],
                [-16.554962, -68.209641],
                [-16.554673, -68.210311],
                [-16.554646, -68.210375],
                [-16.55457, -68.210571],
                [-16.553974, -68.212097],
                [-16.55388, -68.21232],
                [-16.551985, -68.217164],
                [-16.550554, -68.220811],
                [-16.550327, -68.220623],
                [-16.550294, -68.220596],
                [-16.549553, -68.222428],
                [-16.549424, -68.222761],
                [-16.549287, -68.222881],
                [-16.548808, -68.223955],
                [-16.548776, -68.224038],
                [-16.548652, -68.224351],
                [-16.548649, -68.224358],
                [-16.548275, -68.225229],
                [-16.547395, -68.227305],
                [-16.54652, -68.229375],
                [-16.545744, -68.231211],
                [-16.545261, -68.232355],
                [-16.544451, -68.23454],
                [-16.544024, -68.235694],
                [-16.543771, -68.236423],
                [-16.543739, -68.236514],
                [-16.543697, -68.236742],
                [-16.543508, -68.236775],
                [-16.543412, -68.236792],
                [-16.541276, -68.237164],
                [-16.539445, -68.237491],
                [-16.535214, -68.238016],
                [-16.531856, -68.238456],
                [-16.530371, -68.238592],
                [-16.529668, -68.238657],
                [-16.529585, -68.238598],
                [-16.528972, -68.23816],
                [-16.528859, -68.238079],
                [-16.528857, -68.238077],
                [-16.528165, -68.237165],
                [-16.527895, -68.236502],
                [-16.527792, -68.236248],
                [-16.527751, -68.236148],
                [-16.52762, -68.235826],
                [-16.52699, -68.232937],
                [-16.526927, -68.232647],
                [-16.526916, -68.232626],
                [-16.526861, -68.232513],
                [-16.526098, -68.230965],
                [-16.52525, -68.229659],
                [-16.525247, -68.229658],
                [-16.524254, -68.228976],
                [-16.5234, -68.228389],
                [-16.522212, -68.227573],
                [-16.521711, -68.226566],
                [-16.520927, -68.224994],
                [-16.520918, -68.224975],
                [-16.520857, -68.22491],
                [-16.520831, -68.224883],
                [-16.520483, -68.224515],
                [-16.518961, -68.222907],
                [-16.517406, -68.221265],
                [-16.516874, -68.22059],
                [-16.516312, -68.219889],
                [-16.515713, -68.219151],
                [-16.515012, -68.218312],
                [-16.515011, -68.218311],
                [-16.514729, -68.218096],
                [-16.514478, -68.2179],
                [-16.513254, -68.216794],
                [-16.513181, -68.216329],
                [-16.51265, -68.215512],
                [-16.512648, -68.21542],
                [-16.512647, -68.215351],
                [-16.512647, -68.215328],
                [-16.512798, -68.215333],
                [-16.513206, -68.215347],
                [-16.51324, -68.213873],
                [-16.51324, -68.213854],
                [-16.513249, -68.213854],
                [-16.513579, -68.213839],
                [-16.514127, -68.212599],
                [-16.515113, -68.212593],
                [-16.515113, -68.212593],
                [-16.515122, -68.212593],
                [-16.515134, -68.212174],
                [-16.515135, -68.212139],
                [-16.515135, -68.212129],
                [-16.515136, -68.212119],
                [-16.515355, -68.204217],
                [-16.515722, -68.191343],
                [-16.515724, -68.191265],
                [-16.517636, -68.1931],
                [-16.519624, -68.195009],
                [-16.519664, -68.194961],
                [-16.521127, -68.193193],
                [-16.521689, -68.192517]
            ],
            distrito4: [
                [-16.500982, -68.192042],
                [-16.5033, -68.195526],
                [-16.50318, -68.196346],
                [-16.502809, -68.199006],
                [-16.502982, -68.199179],
                [-16.50482, -68.201016],
                [-16.506185, -68.20238],
                [-16.509746, -68.205939],
                [-16.510601, -68.206796],
                [-16.510503, -68.209881],
                [-16.510423, -68.212423],
                [-16.510511, -68.212427],
                [-16.511288, -68.212463],
                [-16.511759, -68.213806],
                [-16.511762, -68.213814],
                [-16.512126, -68.213793],
                [-16.512103, -68.214651],
                [-16.512401, -68.215022],
                [-16.512647, -68.215328],
                [-16.512647, -68.215351],
                [-16.512648, -68.21542],
                [-16.51265, -68.215512],
                [-16.513181, -68.216329],
                [-16.513205, -68.216481],
                [-16.513227, -68.216618],
                [-16.513254, -68.216794],
                [-16.514478, -68.2179],
                [-16.514496, -68.217914],
                [-16.514729, -68.218096],
                [-16.515011, -68.218311],
                [-16.515012, -68.218312],
                [-16.515713, -68.219151],
                [-16.51577, -68.219221],
                [-16.516312, -68.219889],
                [-16.516874, -68.22059],
                [-16.517406, -68.221265],
                [-16.518961, -68.222907],
                [-16.520483, -68.224515],
                [-16.520831, -68.224883],
                [-16.520857, -68.22491],
                [-16.520918, -68.224975],
                [-16.520927, -68.224994],
                [-16.521711, -68.226566],
                [-16.522212, -68.227573],
                [-16.5234, -68.228389],
                [-16.524254, -68.228976],
                [-16.525247, -68.229658],
                [-16.52525, -68.229659],
                [-16.526098, -68.230965],
                [-16.526861, -68.232513],
                [-16.526916, -68.232626],
                [-16.526927, -68.232647],
                [-16.52699, -68.232937],
                [-16.52762, -68.235826],
                [-16.527751, -68.236148],
                [-16.527792, -68.236248],
                [-16.527895, -68.236502],
                [-16.528165, -68.237165],
                [-16.528857, -68.238077],
                [-16.528859, -68.238079],
                [-16.528972, -68.23816],
                [-16.529585, -68.238598],
                [-16.529668, -68.238657],
                [-16.530371, -68.238592],
                [-16.531856, -68.238456],
                [-16.535214, -68.238016],
                [-16.539445, -68.237491],
                [-16.541276, -68.237164],
                [-16.543412, -68.236792],
                [-16.543508, -68.236775],
                [-16.543697, -68.236742],
                [-16.543681, -68.236759],
                [-16.54351, -68.236939],
                [-16.543159, -68.237306],
                [-16.538694, -68.241991],
                [-16.535018, -68.245849],
                [-16.534499, -68.246393],
                [-16.53444, -68.246455],
                [-16.533946, -68.246972],
                [-16.5298, -68.250668],
                [-16.528403, -68.251913],
                [-16.529346, -68.255762],
                [-16.521667, -68.26103],
                [-16.521608, -68.261071],
                [-16.517114, -68.256141],
                [-16.51677, -68.255764],
                [-16.516309, -68.254987],
                [-16.515989, -68.254565],
                [-16.515984, -68.25456],
                [-16.515912, -68.254488],
                [-16.513044, -68.251666],
                [-16.512943, -68.251491],
                [-16.512781, -68.250852],
                [-16.512434, -68.249486],
                [-16.512283, -68.248992],
                [-16.511827, -68.248235],
                [-16.511753, -68.248181],
                [-16.511458, -68.247968],
                [-16.511185, -68.247906],
                [-16.510945, -68.247851],
                [-16.510317, -68.247811],
                [-16.509646, -68.247769],
                [-16.50938, -68.247709],
                [-16.509054, -68.247637],
                [-16.50851, -68.247401],
                [-16.50825, -68.247131],
                [-16.508056, -68.246929],
                [-16.508001, -68.246872],
                [-16.507974, -68.246836],
                [-16.506616, -68.24502],
                [-16.505521, -68.243569],
                [-16.505211, -68.243086],
                [-16.505079, -68.242655],
                [-16.504898, -68.242065],
                [-16.504829, -68.241839],
                [-16.50463, -68.24148],
                [-16.503924, -68.240479],
                [-16.50311, -68.239324],
                [-16.502949, -68.239133],
                [-16.502432, -68.238525],
                [-16.502269, -68.238371],
                [-16.501972, -68.23809],
                [-16.500879, -68.237374],
                [-16.500255, -68.237125],
                [-16.499208, -68.236522],
                [-16.498995, -68.236399],
                [-16.498955, -68.236374],
                [-16.498768, -68.236257],
                [-16.498355, -68.235999],
                [-16.497984, -68.235633],
                [-16.497474, -68.234959],
                [-16.497287, -68.234713],
                [-16.496867, -68.234159],
                [-16.496833, -68.23412],
                [-16.496556, -68.233804],
                [-16.495725, -68.233045],
                [-16.495377, -68.232714],
                [-16.49514, -68.232421],
                [-16.494765, -68.231792],
                [-16.493794, -68.230604],
                [-16.493405, -68.230215],
                [-16.493179, -68.2297],
                [-16.493173, -68.229686],
                [-16.493168, -68.229674],
                [-16.492776, -68.229634],
                [-16.492648, -68.229621],
                [-16.490319, -68.229384],
                [-16.489901, -68.229305],
                [-16.489104, -68.229157],
                [-16.48801, -68.228954],
                [-16.487043, -68.228713],
                [-16.486698, -68.228615],
                [-16.4861, -68.228446],
                [-16.485762, -68.22835],
                [-16.485712, -68.228336],
                [-16.485869, -68.227594],
                [-16.485996, -68.227003],
                [-16.486399, -68.225107],
                [-16.486758, -68.223422],
                [-16.486762, -68.223401],
                [-16.486778, -68.223329],
                [-16.48692, -68.222659],
                [-16.487693, -68.218971],
                [-16.487802, -68.218432],
                [-16.488474, -68.215161],
                [-16.488677, -68.214173],
                [-16.488866, -68.213253],
                [-16.489267, -68.211294],
                [-16.489339, -68.210942],
                [-16.489374, -68.210771],
                [-16.489466, -68.210321],
                [-16.489475, -68.210277],
                [-16.489923, -68.208071],
                [-16.490469, -68.205381],
                [-16.490681, -68.204342],
                [-16.491065, -68.202446],
                [-16.491071, -68.202416],
                [-16.491096, -68.202293],
                [-16.49116, -68.201969],
                [-16.491172, -68.201911],
                [-16.491259, -68.201494],
                [-16.491265, -68.201465],
                [-16.491412, -68.200989],
                [-16.491451, -68.200861],
                [-16.491689, -68.200255],
                [-16.492509, -68.198358],
                [-16.493177, -68.196814],
                [-16.493999, -68.194944],
                [-16.494014, -68.194909],
                [-16.494214, -68.194456],
                [-16.494251, -68.194373],
                [-16.494314, -68.19423],
                [-16.494403, -68.194028],
                [-16.495122, -68.192407],
                [-16.49523, -68.192163],
                [-16.496393, -68.187866],
                [-16.496412, -68.187871],
                [-16.496531, -68.187907],
                [-16.497924, -68.188317],
                [-16.498236, -68.188426],
                [-16.49873, -68.188598],
                [-16.500639, -68.191526],
                [-16.500982, -68.192042]
            ],
            distrito5: [
                [-16.473735, -68.179379],
                [-16.475891, -68.181401],
                [-16.477042, -68.182629],
                [-16.481294, -68.186753],
                [-16.484346, -68.189714],
                [-16.484354, -68.189721],
                [-16.485037, -68.190383],
                [-16.486811, -68.192078],
                [-16.494214, -68.194456],
                [-16.494014, -68.194909],
                [-16.493999, -68.194944],
                [-16.493177, -68.196814],
                [-16.491689, -68.200255],
                [-16.491451, -68.200861],
                [-16.491265, -68.201465],
                [-16.491172, -68.201911],
                [-16.491096, -68.202293],
                [-16.490681, -68.204342],
                [-16.490469, -68.205381],
                [-16.489923, -68.208071],
                [-16.489475, -68.210277],
                [-16.489374, -68.210771],
                [-16.488866, -68.213253],
                [-16.488677, -68.214173],
                [-16.488474, -68.215161],
                [-16.487802, -68.218432],
                [-16.487693, -68.218971],
                [-16.48692, -68.222659],
                [-16.486762, -68.223401],
                [-16.486399, -68.225107],
                [-16.485996, -68.227003],
                [-16.485869, -68.227594],
                [-16.485712, -68.228336],
                [-16.482739, -68.227718],
                [-16.48166, -68.227465],
                [-16.480192, -68.226947],
                [-16.479827, -68.226781],
                [-16.479072, -68.226332],
                [-16.478771, -68.226152],
                [-16.477605, -68.225218],
                [-16.476579, -68.224252],
                [-16.475713, -68.22345],
                [-16.474789, -68.222681],
                [-16.474202, -68.222104],
                [-16.473404, -68.221407],
                [-16.474526, -68.219526],
                [-16.474785, -68.219091],
                [-16.474558, -68.218866],
                [-16.473289, -68.217609],
                [-16.471772, -68.216855],
                [-16.470284, -68.216118],
                [-16.468788, -68.209881],
                [-16.468571, -68.208988],
                [-16.468421, -68.20835],
                [-16.468393, -68.208238],
                [-16.467557, -68.205287],
                [-16.467019, -68.203389],
                [-16.466279, -68.200905],
                [-16.466279, -68.200904],
                [-16.465779, -68.199231],
                [-16.465655, -68.198817],
                [-16.464497, -68.195823],
                [-16.464459, -68.195745],
                [-16.46337, -68.193498],
                [-16.462683, -68.192116],
                [-16.462001, -68.190703],
                [-16.461411, -68.189587],
                [-16.461102, -68.188866],
                [-16.460552, -68.188075],
                [-16.45955, -68.186719],
                [-16.459094, -68.186007],
                [-16.458955, -68.185806],
                [-16.458145, -68.184532],
                [-16.455668, -68.181468],
                [-16.455518, -68.181291],
                [-16.453871, -68.179265],
                [-16.453539, -68.17886],
                [-16.452025, -68.176926],
                [-16.45136, -68.176093],
                [-16.449573, -68.173843],
                [-16.449017, -68.173165],
                [-16.446965, -68.171095],
                [-16.444525, -68.168682],
                [-16.443015, -68.167268],
                [-16.443914, -68.157351],
                [-16.444218, -68.157359],
                [-16.448077, -68.157465],
                [-16.448078, -68.157466],
                [-16.451141, -68.158292],
                [-16.451226, -68.158309],
                [-16.451703, -68.158404],
                [-16.451929, -68.158449],
                [-16.453392, -68.158742],
                [-16.454197, -68.159662],
                [-16.457122, -68.162992],
                [-16.457499, -68.16356],
                [-16.463124, -68.168985],
                [-16.467411, -68.173356],
                [-16.467501, -68.173437],
                [-16.468839, -68.174773],
                [-16.472793, -68.17846],
                [-16.473735, -68.179379]
            ],
            distrito6: [
                [-16.479892, -68.163806],
                [-16.482276, -68.163516],
                [-16.482598, -68.164267],
                [-16.48248, -68.165413],
                [-16.481693, -68.166179],
                [-16.480459, -68.167287],
                [-16.481467, -68.167062],
                [-16.482117, -68.166916],
                [-16.482118, -68.166917],
                [-16.482118, -68.166917],
                [-16.482118, -68.166917],
                [-16.484115, -68.168367],
                [-16.486576, -68.170154],
                [-16.486589, -68.170164],
                [-16.486957, -68.170446],
                [-16.486991, -68.170472],
                [-16.487134, -68.170496],
                [-16.487321, -68.170484],
                [-16.48737, -68.170481],
                [-16.487417, -68.170478],
                [-16.487447, -68.17047],
                [-16.487609, -68.170424],
                [-16.487916, -68.170468],
                [-16.488097, -68.170638],
                [-16.488192, -68.170724],
                [-16.488342, -68.170927],
                [-16.488344, -68.170927],
                [-16.490649, -68.171082],
                [-16.491538, -68.170535],
                [-16.49154, -68.170534],
                [-16.491577, -68.170504],
                [-16.492407, -68.16983],
                [-16.495126, -68.167622],
                [-16.49542, -68.166831],
                [-16.495705, -68.166634],
                [-16.495726, -68.166619],
                [-16.496354, -68.165241],
                [-16.496372, -68.165201],
                [-16.496798, -68.164824],
                [-16.496798, -68.164824],
                [-16.496801, -68.164822],
                [-16.496705, -68.164669],
                [-16.498016, -68.163605],
                [-16.499898, -68.163316],
                [-16.499906, -68.163311],
                [-16.502011, -68.162082],
                [-16.502013, -68.162084],
                [-16.502227, -68.162551],
                [-16.503702, -68.162691],
                [-16.503986, -68.16279],
                [-16.504778, -68.16307],
                [-16.505331, -68.163578],
                [-16.505348, -68.163596],
                [-16.505349, -68.163597],
                [-16.505366, -68.163614],
                [-16.506053, -68.164329],
                [-16.50621, -68.164493],
                [-16.506484, -68.164779],
                [-16.506587, -68.164889],
                [-16.507089, -68.165351],
                [-16.507357, -68.165598],
                [-16.511568, -68.169487],
                [-16.511616, -68.169532],
                [-16.511739, -68.169536],
                [-16.51177, -68.169185],
                [-16.51207, -68.165789],
                [-16.512096, -68.165503],
                [-16.516244, -68.167035],
                [-16.516272, -68.167046],
                [-16.516271, -68.167176],
                [-16.516267, -68.167732],
                [-16.516267, -68.167733],
                [-16.516234, -68.17262],
                [-16.516225, -68.173903],
                [-16.516181, -68.175471],
                [-16.51606, -68.179767],
                [-16.515964, -68.183406],
                [-16.517575, -68.183477],
                [-16.517468, -68.186802],
                [-16.517424, -68.18833],
                [-16.517424, -68.188353],
                [-16.517425, -68.188354],
                [-16.518009, -68.188892],
                [-16.521803, -68.192382],
                [-16.52169, -68.192517],
                [-16.521127, -68.193193],
                [-16.519664, -68.194961],
                [-16.519625, -68.195009],
                [-16.517636, -68.1931],
                [-16.515724, -68.191265],
                [-16.515722, -68.191343],
                [-16.515356, -68.204217],
                [-16.515136, -68.212119],
                [-16.515136, -68.212129],
                [-16.515135, -68.212139],
                [-16.515134, -68.212174],
                [-16.515123, -68.212593],
                [-16.515113, -68.212593],
                [-16.515113, -68.212593],
                [-16.514127, -68.212599],
                [-16.513579, -68.213839],
                [-16.513249, -68.213854],
                [-16.51324, -68.213854],
                [-16.51324, -68.213873],
                [-16.513207, -68.215347],
                [-16.512798, -68.215333],
                [-16.512647, -68.215328],
                [-16.512402, -68.215022],
                [-16.512103, -68.214651],
                [-16.512126, -68.213793],
                [-16.511762, -68.213814],
                [-16.511759, -68.213806],
                [-16.511288, -68.212463],
                [-16.510511, -68.212427],
                [-16.510423, -68.212423],
                [-16.510504, -68.209881],
                [-16.510602, -68.206796],
                [-16.509746, -68.205939],
                [-16.506185, -68.20238],
                [-16.504821, -68.201016],
                [-16.502983, -68.199179],
                [-16.50281, -68.199006],
                [-16.503181, -68.196346],
                [-16.5033, -68.195526],
                [-16.500982, -68.192042],
                [-16.500639, -68.191526],
                [-16.49873, -68.188598],
                [-16.498236, -68.188426],
                [-16.497925, -68.188317],
                [-16.496532, -68.187907],
                [-16.496412, -68.187871],
                [-16.496394, -68.187866],
                [-16.49523, -68.192163],
                [-16.495122, -68.192407],
                [-16.494403, -68.194028],
                [-16.494214, -68.194456],
                [-16.486811, -68.192078],
                [-16.485037, -68.190383],
                [-16.484354, -68.189721],
                [-16.484346, -68.189714],
                [-16.481295, -68.186753],
                [-16.477043, -68.182629],
                [-16.475892, -68.181401],
                [-16.473736, -68.179379],
                [-16.472793, -68.17846],
                [-16.46884, -68.174773],
                [-16.467502, -68.173437],
                [-16.467412, -68.173356],
                [-16.463125, -68.168985],
                [-16.457499, -68.16356],
                [-16.457122, -68.162992],
                [-16.454197, -68.159662],
                [-16.453392, -68.158742],
                [-16.455207, -68.159105],
                [-16.45617, -68.159697],
                [-16.457304, -68.160393],
                [-16.457679, -68.162243],
                [-16.45803, -68.162427],
                [-16.460069, -68.163495],
                [-16.460502, -68.163722],
                [-16.468833, -68.167445],
                [-16.468833, -68.167445],
                [-16.469229, -68.167624],
                [-16.469901, -68.167933],
                [-16.474104, -68.16771],
                [-16.475941, -68.167348],
                [-16.475944, -68.167345],
                [-16.476331, -68.166882],
                [-16.476442, -68.16675],
                [-16.477142, -68.166614],
                [-16.478639, -68.165792],
                [-16.47953, -68.164938],
                [-16.479892, -68.163806]
            ],
            distrito7: [
                [-16.49556, -68.277335],
                [-16.493665, -68.279921],
                [-16.493633, -68.279964],
                [-16.492694, -68.281225],
                [-16.492571, -68.281391],
                [-16.490383, -68.284329],
                [-16.48968, -68.285273],
                [-16.490723, -68.286375],
                [-16.491258, -68.286673],
                [-16.490275, -68.287953],
                [-16.490086, -68.288202],
                [-16.487982, -68.290965],
                [-16.487366, -68.291774],
                [-16.486564, -68.291205],
                [-16.485963, -68.290778],
                [-16.482676, -68.288464],
                [-16.482575, -68.288466],
                [-16.480236, -68.288501],
                [-16.479976, -68.288818],
                [-16.479974, -68.28882],
                [-16.477273, -68.287726],
                [-16.477268, -68.287724],
                [-16.474602, -68.291528],
                [-16.471837, -68.289214],
                [-16.471474, -68.289134],
                [-16.470164, -68.288845],
                [-16.468955, -68.291244],
                [-16.466886, -68.29535],
                [-16.462516, -68.292061],
                [-16.42998, -68.26758],
                [-16.432758, -68.264197],
                [-16.433203, -68.263654],
                [-16.433204, -68.263654],
                [-16.433203, -68.263653],
                [-16.433228, -68.263622],
                [-16.433294, -68.263538],
                [-16.439819, -68.255253],
                [-16.44641, -68.246783],
                [-16.447639, -68.2458],
                [-16.454042, -68.237753],
                [-16.458419, -68.230873],
                [-16.459483, -68.232062],
                [-16.461183, -68.235054],
                [-16.462062, -68.236553],
                [-16.462688, -68.237258],
                [-16.46477, -68.239077],
                [-16.465482, -68.239829],
                [-16.465953, -68.240444],
                [-16.466869, -68.241358],
                [-16.468212, -68.242361],
                [-16.469191, -68.242674],
                [-16.470515, -68.243288],
                [-16.473826, -68.247756],
                [-16.473999, -68.247312],
                [-16.474329, -68.24647],
                [-16.475095, -68.246845],
                [-16.475492, -68.245841],
                [-16.47579, -68.245192],
                [-16.4764, -68.244003],
                [-16.476678, -68.243607],
                [-16.47796, -68.243528],
                [-16.477961, -68.243527],
                [-16.478564, -68.24349],
                [-16.478815, -68.243487],
                [-16.479204, -68.243512],
                [-16.479859, -68.243551],
                [-16.480073, -68.243563],
                [-16.480255, -68.243602],
                [-16.481204, -68.243902],
                [-16.481746, -68.243962],
                [-16.48228, -68.244021],
                [-16.481289, -68.248311],
                [-16.481154, -68.248892],
                [-16.481154, -68.248892],
                [-16.481267, -68.248933],
                [-16.48171, -68.249096],
                [-16.482814, -68.246871],
                [-16.483856, -68.244776],
                [-16.484634, -68.244801],
                [-16.485298, -68.244986],
                [-16.485688, -68.245147],
                [-16.486499, -68.24551],
                [-16.487381, -68.245888],
                [-16.487484, -68.245888],
                [-16.487484, -68.245888],
                [-16.48782, -68.24589],
                [-16.488125, -68.24599],
                [-16.488491, -68.246176],
                [-16.489272, -68.246562],
                [-16.489889, -68.246723],
                [-16.490486, -68.24703],
                [-16.492075, -68.247163],
                [-16.492751, -68.247749],
                [-16.492755, -68.247752],
                [-16.493513, -68.248135],
                [-16.494056, -68.248317],
                [-16.494957, -68.249039],
                [-16.495662, -68.249498],
                [-16.496052, -68.249892],
                [-16.496556, -68.250231],
                [-16.497761, -68.251601],
                [-16.498267, -68.251886],
                [-16.498277, -68.251892],
                [-16.498618, -68.25199],
                [-16.498823, -68.25205],
                [-16.498522, -68.254882],
                [-16.498307, -68.256785],
                [-16.498161, -68.257832],
                [-16.498101, -68.25827],
                [-16.497952, -68.258899],
                [-16.497785, -68.259621],
                [-16.497643, -68.260239],
                [-16.497459, -68.260899],
                [-16.497021, -68.262478],
                [-16.49687, -68.263044],
                [-16.496671, -68.263788],
                [-16.496544, -68.264201],
                [-16.496518, -68.264285],
                [-16.496493, -68.26436],
                [-16.496099, -68.26555],
                [-16.496049, -68.265703],
                [-16.496041, -68.26573],
                [-16.495731, -68.266782],
                [-16.495678, -68.266963],
                [-16.495677, -68.266966],
                [-16.495397, -68.267908],
                [-16.495311, -68.268198],
                [-16.495307, -68.268208],
                [-16.493711, -68.273556],
                [-16.493332, -68.27459],
                [-16.492977, -68.275363],
                [-16.492898, -68.275536],
                [-16.49556, -68.277335]
            ],
            distrito8: [
                [-16.572326, -68.199292],
                [-16.572558, -68.198997],
                [-16.572539, -68.198908],
                [-16.573371, -68.197768],
                [-16.570863, -68.194946],
                [-16.569146, -68.193274],
                [-16.568924, -68.193499],
                [-16.567652, -68.192937],
                [-16.566464, -68.191744],
                [-16.566263, -68.191543],
                [-16.566325, -68.191463],
                [-16.56795, -68.189373],
                [-16.568799, -68.188282],
                [-16.570615, -68.185947],
                [-16.573807, -68.185731],
                [-16.573805, -68.185725],
                [-16.573804, -68.185724],
                [-16.573571, -68.184971],
                [-16.573557, -68.184925],
                [-16.574762, -68.184694],
                [-16.574829, -68.184585],
                [-16.575038, -68.18425],
                [-16.575153, -68.184065],
                [-16.576346, -68.182148],
                [-16.579052, -68.180373],
                [-16.579417, -68.180121],
                [-16.580505, -68.178762],
                [-16.581075, -68.175178],
                [-16.584003, -68.174124],
                [-16.584931, -68.173119],
                [-16.585409, -68.172602],
                [-16.585632, -68.171925],
                [-16.585746, -68.17158],
                [-16.586535, -68.169663],
                [-16.590565, -68.168417],
                [-16.590742, -68.168363],
                [-16.591909, -68.168002],
                [-16.592045, -68.16796],
                [-16.594104, -68.167324],
                [-16.596793, -68.16097],
                [-16.597094, -68.160258],
                [-16.597775, -68.158649],
                [-16.605578, -68.153554],
                [-16.61228, -68.145227],
                [-16.612942, -68.147986],
                [-16.6131, -68.148646],
                [-16.613366, -68.149337],
                [-16.613579, -68.149889],
                [-16.613714, -68.150239],
                [-16.613983, -68.151361],
                [-16.615085, -68.153577],
                [-16.615705, -68.154822],
                [-16.616174, -68.156115],
                [-16.616915, -68.158156],
                [-16.617737, -68.160423],
                [-16.618393, -68.162231],
                [-16.619067, -68.164089],
                [-16.621078, -68.163142],
                [-16.622636, -68.162408],
                [-16.622902, -68.162283],
                [-16.623668, -68.161755],
                [-16.625158, -68.160728],
                [-16.626529, -68.159783],
                [-16.627717, -68.158965],
                [-16.62867, -68.158308],
                [-16.629158, -68.157972],
                [-16.629733, -68.157756],
                [-16.631994, -68.156908],
                [-16.633267, -68.156431],
                [-16.633619, -68.156299],
                [-16.633863, -68.156207],
                [-16.633979, -68.156645],
                [-16.634074, -68.157008],
                [-16.633965, -68.157244],
                [-16.633868, -68.157455],
                [-16.633772, -68.159967],
                [-16.633606, -68.164289],
                [-16.63352, -68.166534],
                [-16.633447, -68.168455],
                [-16.633516, -68.168481],
                [-16.636332, -68.169547],
                [-16.639963, -68.170922],
                [-16.642432, -68.171858],
                [-16.644273, -68.172555],
                [-16.644017, -68.174131],
                [-16.64677, -68.175526],
                [-16.644926, -68.177981],
                [-16.644873, -68.178102],
                [-16.643741, -68.180677],
                [-16.643141, -68.182043],
                [-16.64294, -68.1825],
                [-16.642776, -68.182874],
                [-16.642526, -68.183158],
                [-16.641324, -68.184527],
                [-16.64017, -68.185841],
                [-16.639138, -68.187016],
                [-16.636482, -68.19004],
                [-16.633583, -68.19334],
                [-16.631696, -68.195489],
                [-16.630509, -68.196839],
                [-16.629941, -68.197487],
                [-16.627646, -68.19899],
                [-16.626304, -68.19987],
                [-16.62628, -68.199886],
                [-16.625391, -68.200469],
                [-16.622445, -68.202399],
                [-16.619851, -68.204099],
                [-16.618284, -68.205126],
                [-16.597658, -68.218641],
                [-16.602276, -68.223825],
                [-16.601435, -68.224618],
                [-16.600143, -68.225835],
                [-16.604592, -68.230692],
                [-16.602435, -68.232829],
                [-16.600812, -68.231336],
                [-16.600812, -68.231336],
                [-16.588838, -68.220317],
                [-16.582464, -68.214451],
                [-16.580892, -68.213007],
                [-16.575272, -68.207843],
                [-16.573909, -68.206589],
                [-16.573909, -68.206589],
                [-16.573623, -68.206326],
                [-16.57351, -68.206222],
                [-16.573427, -68.206147],
                [-16.573425, -68.206159],
                [-16.573422, -68.206177],
                [-16.573419, -68.206196],
                [-16.572605, -68.21086],
                [-16.572231, -68.212936],
                [-16.572103, -68.213665],
                [-16.571169, -68.218985],
                [-16.570913, -68.220554],
                [-16.570329, -68.223615],
                [-16.570299, -68.223774],
                [-16.569171, -68.222687],
                [-16.566801, -68.220492],
                [-16.566356, -68.22008],
                [-16.565597, -68.219377],
                [-16.561977, -68.216024],
                [-16.560552, -68.214704],
                [-16.56044, -68.2146],
                [-16.557205, -68.211604],
                [-16.55513, -68.209692],
                [-16.555145, -68.209655],
                [-16.557712, -68.20342],
                [-16.557712, -68.20342],
                [-16.558083, -68.202523],
                [-16.55814, -68.202388],
                [-16.558671, -68.201127],
                [-16.559241, -68.199752],
                [-16.559241, -68.199751],
                [-16.559959, -68.198021],
                [-16.559985, -68.197956],
                [-16.561639, -68.193968],
                [-16.561641, -68.19397],
                [-16.563135, -68.195495],
                [-16.564134, -68.196515],
                [-16.564805, -68.1972],
                [-16.567674, -68.200128],
                [-16.569011, -68.201492],
                [-16.570128, -68.200512],
                [-16.570899, -68.199691],
                [-16.571562, -68.198924],
                [-16.571695, -68.19877],
                [-16.572326, -68.199292]
            ],
            distrito9: [
                [-16.470164, -68.288845],
                [-16.471474, -68.289134],
                [-16.471837, -68.289214],
                [-16.474602, -68.291528],
                [-16.477268, -68.287724],
                [-16.477273, -68.287726],
                [-16.479974, -68.28882],
                [-16.479976, -68.288818],
                [-16.480236, -68.288501],
                [-16.482575, -68.288466],
                [-16.482676, -68.288464],
                [-16.485963, -68.290778],
                [-16.486564, -68.291205],
                [-16.487366, -68.291774],
                [-16.487982, -68.290965],
                [-16.490086, -68.288202],
                [-16.490275, -68.287953],
                [-16.491258, -68.286673],
                [-16.490723, -68.286375],
                [-16.48968, -68.285273],
                [-16.490383, -68.284329],
                [-16.492571, -68.281391],
                [-16.492694, -68.281225],
                [-16.493633, -68.279964],
                [-16.493665, -68.279921],
                [-16.495604, -68.277275],
                [-16.510372, -68.287664],
                [-16.510308, -68.295737],
                [-16.510313, -68.295757],
                [-16.510723, -68.29731],
                [-16.511107, -68.3016],
                [-16.511363, -68.30262],
                [-16.512204, -68.305063],
                [-16.512294, -68.305325],
                [-16.51279, -68.30692],
                [-16.512931, -68.307365],
                [-16.505831, -68.315467],
                [-16.50176, -68.32013],
                [-16.489927, -68.314623],
                [-16.477447, -68.308413],
                [-16.468235, -68.301111],
                [-16.470738, -68.297592],
                [-16.466886, -68.29535],
                [-16.468955, -68.291244],
                [-16.470164, -68.288845]
            ],
            distrito10: [
                [-16.597658, -68.218641],
                [-16.618284, -68.205126],
                [-16.619851, -68.204099],
                [-16.622445, -68.202399],
                [-16.625391, -68.200469],
                [-16.62628, -68.199886],
                [-16.626304, -68.19987],
                [-16.627646, -68.19899],
                [-16.629941, -68.197487],
                [-16.630509, -68.196839],
                [-16.631696, -68.195489],
                [-16.633583, -68.19334],
                [-16.636482, -68.19004],
                [-16.639138, -68.187016],
                [-16.64017, -68.185841],
                [-16.641324, -68.184527],
                [-16.642526, -68.183158],
                [-16.642776, -68.182874],
                [-16.64294, -68.1825],
                [-16.643141, -68.182043],
                [-16.643741, -68.180677],
                [-16.644873, -68.178102],
                [-16.644926, -68.177981],
                [-16.64677, -68.175526],
                [-16.644017, -68.174131],
                [-16.644273, -68.172555],
                [-16.642432, -68.171858],
                [-16.639963, -68.170922],
                [-16.636332, -68.169547],
                [-16.633516, -68.168481],
                [-16.633447, -68.168455],
                [-16.63352, -68.166534],
                [-16.633606, -68.164289],
                [-16.633772, -68.159967],
                [-16.633868, -68.157455],
                [-16.633965, -68.157244],
                [-16.634074, -68.157008],
                [-16.633979, -68.156645],
                [-16.633863, -68.156207],
                [-16.633619, -68.156299],
                [-16.633267, -68.156431],
                [-16.631994, -68.156908],
                [-16.629733, -68.157756],
                [-16.629158, -68.157972],
                [-16.62867, -68.158308],
                [-16.627717, -68.158965],
                [-16.626529, -68.159783],
                [-16.625158, -68.160728],
                [-16.623668, -68.161755],
                [-16.622902, -68.162283],
                [-16.622636, -68.162408],
                [-16.621078, -68.163142],
                [-16.619067, -68.164089],
                [-16.618393, -68.162231],
                [-16.617737, -68.160423],
                [-16.616915, -68.158156],
                [-16.616174, -68.156115],
                [-16.615705, -68.154822],
                [-16.615085, -68.153577],
                [-16.613983, -68.151361],
                [-16.613714, -68.150239],
                [-16.613579, -68.149889],
                [-16.613366, -68.149337],
                [-16.6131, -68.148646],
                [-16.612942, -68.147986],
                [-16.61228, -68.145227],
                [-16.613366, -68.143878],
                [-16.614272, -68.142076],
                [-16.61438, -68.141862],
                [-16.618747, -68.133174],
                [-16.62118, -68.128335],
                [-16.634389, -68.130861],
                [-16.634395, -68.130862],
                [-16.635121, -68.108266],
                [-16.635121, -68.108265],
                [-16.641928, -68.119411],
                [-16.644773, -68.125552],
                [-16.655882, -68.136892],
                [-16.659385, -68.142564],
                [-16.659868, -68.144114],
                [-16.659869, -68.144115],
                [-16.662885, -68.153799],
                [-16.66389, -68.156836],
                [-16.664292, -68.158054],
                [-16.666838, -68.164222],
                [-16.666984, -68.164688],
                [-16.666983, -68.164689],
                [-16.665616, -68.165276],
                [-16.665616, -68.165276],
                [-16.664995, -68.165916],
                [-16.664995, -68.165916],
                [-16.66476, -68.165823],
                [-16.664759, -68.165824],
                [-16.664613, -68.165914],
                [-16.664114, -68.16712],
                [-16.663459, -68.167937],
                [-16.663459, -68.167937],
                [-16.663177, -68.168062],
                [-16.662402, -68.168609],
                [-16.661364, -68.169214],
                [-16.660734, -68.169741],
                [-16.660508, -68.170109],
                [-16.660366, -68.170268],
                [-16.659163, -68.172495],
                [-16.659236, -68.172579],
                [-16.656035, -68.179672],
                [-16.627217, -68.205683],
                [-16.616757, -68.226164],
                [-16.616502, -68.226662],
                [-16.611615, -68.236229],
                [-16.611468, -68.236516],
                [-16.610094, -68.239876],
                [-16.602435, -68.232829],
                [-16.604592, -68.230692],
                [-16.600143, -68.225835],
                [-16.601435, -68.224618],
                [-16.602276, -68.223825],
                [-16.597658, -68.218641]
            ],
            distrito11: [
                [-16.49556, -68.277335],
                [-16.492898, -68.275536],
                [-16.492977, -68.275363],
                [-16.493332, -68.27459],
                [-16.493711, -68.273556],
                [-16.495307, -68.268208],
                [-16.495311, -68.268198],
                [-16.495397, -68.267908],
                [-16.495677, -68.266966],
                [-16.495678, -68.266963],
                [-16.506774, -68.265884],
                [-16.508476, -68.27221],
                [-16.510654, -68.270026],
                [-16.515873, -68.264526],
                [-16.516963, -68.263867],
                [-16.517826, -68.263346],
                [-16.519862, -68.262117],
                [-16.519989, -68.262041],
                [-16.520242, -68.261888],
                [-16.521608, -68.261071],
                [-16.525326, -68.265062],
                [-16.525379, -68.265118],
                [-16.539667, -68.280456],
                [-16.539667, -68.280456],
                [-16.528793, -68.290251],
                [-16.523745, -68.293691],
                [-16.510374, -68.287665],
                [-16.510372, -68.287664],
                [-16.495604, -68.277275],
                [-16.49556, -68.277335]
            ],
            distrito12: [
                [-16.571721, -68.225089],
                [-16.572089, -68.225429],
                [-16.571887, -68.22602],
                [-16.569888, -68.232042],
                [-16.569861, -68.232137],
                [-16.569296, -68.234072],
                [-16.565595, -68.245495],
                [-16.563357, -68.251714],
                [-16.560833, -68.259307],
                [-16.560774, -68.259486],
                [-16.560651, -68.259377],
                [-16.560651, -68.259377],
                [-16.560468, -68.259215],
                [-16.560438, -68.258944],
                [-16.560019, -68.255219],
                [-16.55976, -68.252918],
                [-16.55976, -68.252918],
                [-16.55976, -68.252918],
                [-16.559722, -68.252584],
                [-16.559574, -68.251263],
                [-16.551138, -68.245459],
                [-16.54963, -68.243691],
                [-16.547997, -68.241779],
                [-16.54643, -68.239943],
                [-16.546061, -68.23951],
                [-16.545365, -68.238696],
                [-16.544256, -68.237397],
                [-16.543752, -68.236805],
                [-16.543697, -68.236742],
                [-16.543739, -68.236514],
                [-16.543771, -68.236423],
                [-16.544024, -68.235694],
                [-16.544451, -68.23454],
                [-16.545261, -68.232355],
                [-16.545744, -68.231211],
                [-16.54652, -68.229375],
                [-16.547395, -68.227305],
                [-16.548275, -68.225229],
                [-16.548649, -68.224358],
                [-16.548652, -68.224351],
                [-16.548776, -68.224038],
                [-16.548808, -68.223955],
                [-16.549287, -68.222881],
                [-16.549424, -68.222761],
                [-16.549553, -68.222428],
                [-16.550294, -68.220596],
                [-16.550327, -68.220623],
                [-16.550554, -68.220811],
                [-16.551985, -68.217164],
                [-16.55388, -68.21232],
                [-16.553974, -68.212097],
                [-16.55457, -68.210571],
                [-16.554646, -68.210375],
                [-16.554673, -68.210311],
                [-16.554962, -68.209641],
                [-16.55506, -68.20963],
                [-16.55513, -68.209692],
                [-16.557205, -68.211604],
                [-16.56044, -68.2146],
                [-16.560552, -68.214704],
                [-16.561977, -68.216024],
                [-16.565597, -68.219377],
                [-16.566356, -68.22008],
                [-16.566801, -68.220492],
                [-16.569171, -68.222687],
                [-16.570299, -68.223774],
                [-16.570566, -68.224021],
                [-16.570892, -68.224322],
                [-16.571719, -68.225087],
                [-16.571721, -68.225089]
            ],
            distrito13: [
                [-16.433203, -68.263653],
                [-16.432991, -68.263547],
                [-16.392718, -68.243374],
                [-16.383461, -68.216311],
                [-16.336542, -68.205485],
                [-16.302625, -68.185324],
                [-16.292807, -68.170295],
                [-16.277377, -68.165584],
                [-16.262662, -68.153722],
                [-16.262684, -68.153724],
                [-16.262695, -68.153726],
                [-16.278695, -68.155565],
                [-16.285073, -68.157644],
                [-16.28508, -68.157642],
                [-16.316459, -68.150355],
                [-16.320282, -68.145565],
                [-16.327627, -68.139918],
                [-16.340143, -68.13921],
                [-16.350243, -68.138503],
                [-16.358009, -68.143554],
                [-16.367961, -68.145928],
                [-16.367965, -68.145928],
                [-16.400429, -68.149585],
                [-16.427974, -68.149443],
                [-16.429407, -68.151667],
                [-16.432874, -68.157047],
                [-16.433252, -68.157058],
                [-16.433282, -68.157058],
                [-16.43904, -68.157217],
                [-16.443914, -68.157351],
                [-16.443914, -68.157351],
                [-16.443815, -68.158447],
                [-16.443295, -68.164175],
                [-16.443065, -68.16672],
                [-16.443015, -68.167268],
                [-16.444525, -68.168682],
                [-16.446965, -68.171095],
                [-16.449017, -68.173165],
                [-16.449573, -68.173843],
                [-16.45136, -68.176093],
                [-16.452025, -68.176926],
                [-16.453539, -68.17886],
                [-16.453756, -68.179124],
                [-16.453769, -68.179141],
                [-16.453871, -68.179265],
                [-16.455518, -68.181291],
                [-16.455668, -68.181468],
                [-16.458145, -68.184532],
                [-16.458955, -68.185806],
                [-16.459094, -68.186007],
                [-16.45955, -68.186719],
                [-16.460552, -68.188075],
                [-16.461102, -68.188866],
                [-16.461411, -68.189587],
                [-16.462001, -68.190703],
                [-16.462683, -68.192116],
                [-16.46337, -68.193498],
                [-16.464297, -68.195411],
                [-16.464459, -68.195745],
                [-16.462963, -68.196045],
                [-16.462795, -68.196212],
                [-16.461398, -68.196848],
                [-16.461893, -68.19716],
                [-16.463474, -68.197741],
                [-16.463965, -68.197921],
                [-16.463675, -68.198123],
                [-16.462989, -68.198729],
                [-16.462546, -68.199194],
                [-16.46227, -68.199087],
                [-16.461934, -68.198958],
                [-16.460021, -68.197974],
                [-16.45892, -68.199228],
                [-16.458365, -68.198937],
                [-16.457236, -68.201235],
                [-16.456504, -68.201],
                [-16.456199, -68.200952],
                [-16.455331, -68.200802],
                [-16.45459, -68.202377],
                [-16.455357, -68.202474],
                [-16.455469, -68.204106],
                [-16.455443, -68.204337],
                [-16.454997, -68.205927],
                [-16.453286, -68.206983],
                [-16.454861, -68.207365],
                [-16.455553, -68.207533],
                [-16.454737, -68.208668],
                [-16.453923, -68.208413],
                [-16.453879, -68.2084],
                [-16.453866, -68.208477],
                [-16.453724, -68.209318],
                [-16.455437, -68.209812],
                [-16.455356, -68.210603],
                [-16.454256, -68.213211],
                [-16.454218, -68.213548],
                [-16.454183, -68.213937],
                [-16.459771, -68.214257],
                [-16.459776, -68.214257],
                [-16.462294, -68.213463],
                [-16.463487, -68.213904],
                [-16.464007, -68.21409],
                [-16.464005, -68.214093],
                [-16.463236, -68.215475],
                [-16.463959, -68.216068],
                [-16.461588, -68.219906],
                [-16.461276, -68.220371],
                [-16.460904, -68.22086],
                [-16.460024, -68.222628],
                [-16.45916, -68.224109],
                [-16.456823, -68.229089],
                [-16.458233, -68.230665],
                [-16.458284, -68.230722],
                [-16.458419, -68.230873],
                [-16.454042, -68.237753],
                [-16.447639, -68.2458],
                [-16.44641, -68.246783],
                [-16.439819, -68.255253],
                [-16.433294, -68.263538],
                [-16.433228, -68.263622],
                [-16.433203, -68.263653]
            ],
            distrito14: [
                [-16.455443, -68.204337],
                [-16.455469, -68.204106],
                [-16.455357, -68.202474],
                [-16.45459, -68.202377],
                [-16.455331, -68.200802],
                [-16.456199, -68.200952],
                [-16.456504, -68.201],
                [-16.457236, -68.201235],
                [-16.458365, -68.198937],
                [-16.45892, -68.199228],
                [-16.460021, -68.197974],
                [-16.461934, -68.198958],
                [-16.46227, -68.199087],
                [-16.462546, -68.199194],
                [-16.462989, -68.198729],
                [-16.463675, -68.198123],
                [-16.463965, -68.197921],
                [-16.463474, -68.197741],
                [-16.461893, -68.19716],
                [-16.461398, -68.196848],
                [-16.462795, -68.196212],
                [-16.462963, -68.196045],
                [-16.464459, -68.195745],
                [-16.464497, -68.195823],
                [-16.464706, -68.196364],
                [-16.465655, -68.198817],
                [-16.465779, -68.199231],
                [-16.466279, -68.200904],
                [-16.466279, -68.200905],
                [-16.467019, -68.203389],
                [-16.467557, -68.205287],
                [-16.468393, -68.208238],
                [-16.468421, -68.20835],
                [-16.468571, -68.208988],
                [-16.468788, -68.209881],
                [-16.470284, -68.216118],
                [-16.471772, -68.216855],
                [-16.472468, -68.217201],
                [-16.473289, -68.217609],
                [-16.473385, -68.217704],
                [-16.474017, -68.21833],
                [-16.474558, -68.218866],
                [-16.474785, -68.219091],
                [-16.474751, -68.219148],
                [-16.474526, -68.219526],
                [-16.473404, -68.221407],
                [-16.474202, -68.222104],
                [-16.474789, -68.222681],
                [-16.475713, -68.22345],
                [-16.476579, -68.224252],
                [-16.477605, -68.225218],
                [-16.478771, -68.226152],
                [-16.479072, -68.226332],
                [-16.479827, -68.226781],
                [-16.480192, -68.226947],
                [-16.48166, -68.227465],
                [-16.482739, -68.227718],
                [-16.485712, -68.228336],
                [-16.485762, -68.22835],
                [-16.4861, -68.228446],
                [-16.486698, -68.228615],
                [-16.487043, -68.228713],
                [-16.48801, -68.228954],
                [-16.489104, -68.229157],
                [-16.489901, -68.229305],
                [-16.490319, -68.229384],
                [-16.492648, -68.229621],
                [-16.492776, -68.229634],
                [-16.493168, -68.229674],
                [-16.493173, -68.229686],
                [-16.493179, -68.2297],
                [-16.493405, -68.230215],
                [-16.493794, -68.230604],
                [-16.494765, -68.231792],
                [-16.49514, -68.232421],
                [-16.495377, -68.232714],
                [-16.495725, -68.233045],
                [-16.496556, -68.233804],
                [-16.496833, -68.23412],
                [-16.496867, -68.234159],
                [-16.497287, -68.234713],
                [-16.497474, -68.234959],
                [-16.497984, -68.235633],
                [-16.498355, -68.235999],
                [-16.498768, -68.236257],
                [-16.498955, -68.236374],
                [-16.498995, -68.236399],
                [-16.499208, -68.236522],
                [-16.500255, -68.237125],
                [-16.500879, -68.237374],
                [-16.501972, -68.23809],
                [-16.502269, -68.238371],
                [-16.502432, -68.238525],
                [-16.502949, -68.239133],
                [-16.50311, -68.239324],
                [-16.503924, -68.240479],
                [-16.50463, -68.24148],
                [-16.504829, -68.241839],
                [-16.504898, -68.242065],
                [-16.505079, -68.242655],
                [-16.505211, -68.243086],
                [-16.505521, -68.243569],
                [-16.506616, -68.24502],
                [-16.507974, -68.246836],
                [-16.508001, -68.246872],
                [-16.508056, -68.246929],
                [-16.50825, -68.247131],
                [-16.50851, -68.247401],
                [-16.509054, -68.247637],
                [-16.50938, -68.247709],
                [-16.509646, -68.247769],
                [-16.510317, -68.247811],
                [-16.510945, -68.247851],
                [-16.511185, -68.247906],
                [-16.511458, -68.247968],
                [-16.511753, -68.248181],
                [-16.511827, -68.248235],
                [-16.512283, -68.248992],
                [-16.512434, -68.249486],
                [-16.512781, -68.250852],
                [-16.512943, -68.251491],
                [-16.513044, -68.251666],
                [-16.515912, -68.254488],
                [-16.515984, -68.25456],
                [-16.515989, -68.254565],
                [-16.516309, -68.254987],
                [-16.51677, -68.255764],
                [-16.517114, -68.256141],
                [-16.521608, -68.261071],
                [-16.520242, -68.261888],
                [-16.519989, -68.262041],
                [-16.519862, -68.262117],
                [-16.517826, -68.263346],
                [-16.516963, -68.263867],
                [-16.515873, -68.264526],
                [-16.510654, -68.270026],
                [-16.508476, -68.27221],
                [-16.506774, -68.265884],
                [-16.497037, -68.266831],
                [-16.495678, -68.266963],
                [-16.495731, -68.266782],
                [-16.496041, -68.26573],
                [-16.496049, -68.265703],
                [-16.496099, -68.26555],
                [-16.496493, -68.26436],
                [-16.496518, -68.264285],
                [-16.496544, -68.264201],
                [-16.496671, -68.263788],
                [-16.49687, -68.263044],
                [-16.497021, -68.262478],
                [-16.497459, -68.260899],
                [-16.497643, -68.260239],
                [-16.497785, -68.259621],
                [-16.497952, -68.258899],
                [-16.498101, -68.25827],
                [-16.498161, -68.257832],
                [-16.498307, -68.256785],
                [-16.498522, -68.254882],
                [-16.498823, -68.25205],
                [-16.498618, -68.25199],
                [-16.498277, -68.251892],
                [-16.498267, -68.251886],
                [-16.497761, -68.251601],
                [-16.496556, -68.250231],
                [-16.496052, -68.249892],
                [-16.495662, -68.249498],
                [-16.494957, -68.249039],
                [-16.494056, -68.248317],
                [-16.493513, -68.248135],
                [-16.492755, -68.247752],
                [-16.492751, -68.247749],
                [-16.492075, -68.247163],
                [-16.490486, -68.24703],
                [-16.489889, -68.246723],
                [-16.489272, -68.246562],
                [-16.488491, -68.246176],
                [-16.488125, -68.24599],
                [-16.48782, -68.24589],
                [-16.487484, -68.245888],
                [-16.487484, -68.245888],
                [-16.487381, -68.245888],
                [-16.486499, -68.24551],
                [-16.485688, -68.245147],
                [-16.485298, -68.244986],
                [-16.484634, -68.244801],
                [-16.483856, -68.244776],
                [-16.482814, -68.246871],
                [-16.48171, -68.249096],
                [-16.481267, -68.248933],
                [-16.481154, -68.248892],
                [-16.481154, -68.248892],
                [-16.481289, -68.248311],
                [-16.48228, -68.244021],
                [-16.481746, -68.243962],
                [-16.481204, -68.243902],
                [-16.480255, -68.243602],
                [-16.480073, -68.243563],
                [-16.479859, -68.243551],
                [-16.479204, -68.243512],
                [-16.478815, -68.243487],
                [-16.478564, -68.24349],
                [-16.477961, -68.243527],
                [-16.47796, -68.243528],
                [-16.476678, -68.243607],
                [-16.4764, -68.244003],
                [-16.47579, -68.245192],
                [-16.475492, -68.245841],
                [-16.475095, -68.246845],
                [-16.474329, -68.24647],
                [-16.473999, -68.247312],
                [-16.473826, -68.247756],
                [-16.470515, -68.243288],
                [-16.469191, -68.242674],
                [-16.468212, -68.242361],
                [-16.466869, -68.241358],
                [-16.465953, -68.240444],
                [-16.465482, -68.239829],
                [-16.46477, -68.239077],
                [-16.462688, -68.237258],
                [-16.462062, -68.236553],
                [-16.461183, -68.235054],
                [-16.459483, -68.232062],
                [-16.458284, -68.230722],
                [-16.458233, -68.230665],
                [-16.456823, -68.229089],
                [-16.45916, -68.224109],
                [-16.460024, -68.222628],
                [-16.460904, -68.22086],
                [-16.461276, -68.220371],
                [-16.461588, -68.219906],
                [-16.463959, -68.216068],
                [-16.463236, -68.215475],
                [-16.464005, -68.214093],
                [-16.464007, -68.21409],
                [-16.463487, -68.213904],
                [-16.462294, -68.213463],
                [-16.459776, -68.214257],
                [-16.459771, -68.214257],
                [-16.454183, -68.213937],
                [-16.454218, -68.213548],
                [-16.454256, -68.213211],
                [-16.455356, -68.210603],
                [-16.455437, -68.209812],
                [-16.453724, -68.209318],
                [-16.453866, -68.208477],
                [-16.453879, -68.2084],
                [-16.453923, -68.208413],
                [-16.454737, -68.208668],
                [-16.455553, -68.207533],
                [-16.454861, -68.207365],
                [-16.453286, -68.206983],
                [-16.454997, -68.205927],
                [-16.455443, -68.204337]
            ]
        };

        // Colores para cada distrito
        const distritosColors = {
            distrito1: '#FF6B6B',
            distrito2: '#4ECDC4',
            distrito3: '#45B7D1',
            distrito4: '#96CEB4',
            distrito5: '#FFEAA7',
            distrito6: '#DDA0DD',
            distrito7: '#98D8C8',
            distrito8: '#F7DC6F',
            distrito9: '#BB8FCE',
            distrito10: '#85C1E9',
            distrito11: '#F8C471',
            distrito12: '#82E0AA',
            distrito13: '#F1948A',
            distrito14: '#AED6F1'
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
                    Distritos: ${distritosActive ? 'ON' : 'OFF'} |
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

        function normalizarCodigo(cadena) {
            return String(cadena || '')
                .split('-')
                .map(parte => parte.replace(/^0+/, ''))
                .join('-')
                .toLowerCase();
        }

        function filterMarkers(searchTerm) {
            const term = searchTerm.toLowerCase().trim()
            let visibleCount = 0

            if (!markerClusterGroup || !allLeafletMarkers) return

            markerClusterGroup.clearLayers()

            if (term.length > 0 && term.length < 3) {
                showStatusMessage("Ingrese al menos 3 caracteres para buscar", "info")
                return
            }

            showLoader()

            setTimeout(() => {
                const filteredLeafletMarkers = []

                function processFilterBatch(startIndex) {
                    const endIndex = Math.min(startIndex + 300, allLeafletMarkers.length)

                    for (let i = startIndex; i < endIndex; i++) {
                        const marker = allLeafletMarkers[i]
                        const data = marker.originalData || {}

                        // Normalizar y limpiar todos los campos
                        const title = String(data.title || "")
                            .toLowerCase()
                            .trim()
                        const nombre = String(data.nombre_razon || "")
                            .toLowerCase()
                            .trim()
                        const codigo = normalizarCodigo(
                            String(data.codigo_catastral || "")
                            .toLowerCase()
                            .trim(),
                        )
                        const termNormalizado = normalizarCodigo(term)
                        const numero = String(data.numero_inmueble || "")
                            .toLowerCase()
                            .trim()
                        const usuario = String(data.usuario || "")
                            .toLowerCase()
                            .trim()
                        const no_formulario = String(data.no_formulario || "")
                            .toLowerCase()
                            .trim()
                        const fecha_apersonamiento = String(data.fecha_apersonamiento || "")
                            .toLowerCase()
                            .trim()

                        let matchesSearch = false

                        if (term === "") {
                            matchesSearch = true
                        } else {
                            // Primero verificar coincidencias exactas (tienen prioridad)
                            if (no_formulario === term || numero === term) {
                                matchesSearch = true
                            }
                            // Si no hay coincidencia exacta, verificar coincidencias parciales en otros campos
                            else if (
                                title.includes(term) ||
                                nombre.includes(term) ||
                                codigo.includes(termNormalizado) ||
                                fecha_apersonamiento.includes(term) ||
                                usuario.includes(term)
                            ) {
                                matchesSearch = true
                            }
                        }

                        if (matchesSearch) {

                            console.log("term:" + term);
                            console.log("numero:" + numero);
                            if (/^inm-\d+$/i.test(term)) {
                                if (term === numero) {
                                    console.log("no_formulario:" + no_formulario);
                                    filteredLeafletMarkers.push(marker)
                                    visibleCount++
                                }
                            } else {
                                filteredLeafletMarkers.push(marker)
                            }

                        }
                    }

                    if (endIndex < allLeafletMarkers.length) {
                        setTimeout(() => {
                            processFilterBatch(endIndex)
                        }, 5)
                    } else {
                        markerClusterGroup.addLayers(filteredLeafletMarkers)
                        updateResultsCount(visibleCount, totalMarkersCount || allLeafletMarkers.length)
                        updateDebugInfo()
                        hideLoader()

                        if (filteredLeafletMarkers.length > 0 && term !== "") {
                            setTimeout(() => {
                                fitMapToVisibleMarkers()
                            }, 100)
                        }
                    }
                }

                processFilterBatch(0)
            }, 25)
        }

        // Declare functions before using them
        function showStatusMessage(message, type) {
            console.log(`Status Message: ${message} (Type: ${type})`)
        }

        function showLoader() {
            console.log("Loader shown")
        }

        function normalizarCodigo(codigo) {
            return codigo.replace(/[^a-z0-9]/gi, "")
        }

        function updateResultsCount(visibleCount, totalCount) {
            console.log(`Visible Count: ${visibleCount}, Total Count: ${totalCount}`)
        }

        function updateDebugInfo() {
            console.log("Debug info updated")
        }

        function hideLoader() {
            console.log("Loader hidden")
        }

        function fitMapToVisibleMarkers() {
            console.log("Map fitted to visible markers")
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
                if (zoom < 18) {
                    showStatusMessage('El zoom mínimo para ver inmuebles es 18, zoom actual:' + zoom, 'error');
                    return;
                }

                inmueblesActive = true;
                button.classList.add('geojson-active');
                loadGeoJSONDataDynamically('inmueble', true);
            }

            updateDebugInfo();
        }

        // Función para manejar movimiento del mapa con carga dinámica (MEJORADA)
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

                // NUEVO: Actualizar pre-puntos si están activos
                if (prePuntosActive) {
                    logDebug(' ============ Mapa movido prePuntosActive ==================');
                    debouncedBuscarPrePuntos();
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

        // Función de debounce para evitar llamadas excesivas a pre-puntos
        const debouncedBuscarPrePuntos = debounce(function() {
            if (prePuntosActive) {
                buscarPrePuntos(false); // false para no mostrar mensajes en actualizaciones automáticas
            }
        }, 500); // 500ms de delay

        // Función debounce genérica si no existe
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }


        function buscarPrePuntos(showMessage = true) {
            const bounds = map.getBounds();
            const sw = bounds.getSouthWest();
            const ne = bounds.getNorthEast();

            const datos = {
                minLat: sw.lat,
                maxLat: ne.lat,
                minLng: sw.lng,
                maxLng: ne.lng,
                modulo: 'gerencial',
            };

            // Solo mostrar mensaje si se solicita explícitamente
            if (showMessage) {
                showStatusMessage('Buscando pre-puntos...', 'info');
            }

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

                        // Solo mostrar mensaje de éxito si se solicita explícitamente
                        if (showMessage) {
                            showStatusMessage(`Se encontraron ${prePuntosData.length} pre-puntos`, 'success');
                        }
                    } else {
                        if (showMessage) {
                            showStatusMessage('Error: ' + response.message, 'error');
                        }
                        console.error('Error en búsqueda de pre-puntos:', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error en la búsqueda de pre-puntos:', error);
                    if (showMessage) {
                        showStatusMessage('Error al buscar pre-puntos', 'error');
                    }
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

            // Función auxiliar para generar box-shadow con el mismo color NEON
            function generarBoxShadow(colorHex) {
                return `
                    0 0 2px #fff,
                    0 0 0.2rem #fff,
                    0 0 3px ${colorHex},
                    0 0 2px ${colorHex},
                    0 0 2px ${colorHex},
                    0 0 2px ${colorHex}
                `;
                /* return ''; */
            }

            prePuntosLayer = L.layerGroup();


            prePuntosData.forEach(function(punto, index) {
                const lat = parseFloat(punto.latitud);
                const lng = parseFloat(punto.longitud);
                const color = (punto.color || '#fff');
                let borde_ = '#000';
                if (punto.idpredial_asociado > 0) {
                    borde_ = '#fff';
                }
                console.log("borde_:" + borde_);
                if (!isNaN(lat) && !isNaN(lng)) {
                    const boxShadow = generarBoxShadow(color);

                    const prePuntoIcon = L.divIcon({
                        className: 'pre-punto-marker-container',
                        html: `
                        <div style="
                            background-color: ${color};
                            width: 0.9rem;
                            height: 0.9rem;
                            border-radius: 50%;
                            box-shadow: ${boxShadow};
                            border: 2px solid ${borde_};"></div>
                    `,
                        iconSize: [20, 20],
                        iconAnchor: [10, 10]
                    });

                    const marker = L.marker([lat, lng], {
                        icon: prePuntoIcon
                    });

                    let inmueble_ = '';
                    if (punto.numero_inmueble && punto.numero_inmueble != '' && punto.numero_inmueble != 'null') {
                        inmueble_ = `<strong>Inmueble: </strong> 
                                        <span style="cursor:pointer; font-weight: bold; color:#22cfdd; " 
                                            >
                                            ${punto.numero_inmueble} [${punto.id}]
                                        </span><br>`;
                    }
                    const popupContent = `
                            <div class="popup-content">
                                <div class="popup-description">
                                    ${inmueble_}
                                    <strong>Detalle:</strong> ${punto.detalle || 'Sin detalle'}<br>
                                    <strong>Creado por:</strong> ${punto.idusuario || 'No especificado'}<br>
                                    <strong>Fecha:</strong> ${punto.fregistro_ || 'No especificada'}<br>
                                    <strong>Ver en google:</strong> 
                                    <a target="_blank" href="https://www.google.com/maps?q=${lat},${lng}">
                                        <i class="fa fa-street-view" style="font-size:1.2rem; color: yellow" aria-hidden="true"></i>
                                    </a>
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

            if (prePuntosActive) {
                // Desactivar capa
                if (prePuntosLayer && map.hasLayer(prePuntosLayer)) {
                    map.removeLayer(prePuntosLayer);
                }
                prePuntosActive = false;
                prePuntosData = []; // Limpiar datos
                $('#prePuntosBtn').removeClass('active');
                showStatusMessage('Capa de pre-puntos desactivada', 'info');
            } else {
                // Activar capa - buscar pre-puntos con mensaje
                prePuntosActive = true; // Activar antes de buscar
                $('#prePuntosBtn').addClass('active');
                buscarPrePuntos(true); // true para mostrar mensajes
            }

            updateDebugInfo(); // Actualizar info de debug
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


            // Crear marcador en el punto clickeado
            const pointIcon = L.divIcon({
                className: 'new-point-marker-container',
                html: '<div style="background-color: ' + colorPrevio + '; width: 12px; height: 12px; border-radius: 50%; border: 2px solid white; box-shadow: 0 0 8px rgba(206, 206, 206, 0.8); "></div>',
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
        let colorPrevio = '#ff6b35';

        function showCustomPopup(lat, lng) {
            // Guardar datos del punto actual
            currentPointData = {
                lat: lat,
                lng: lng,
                marker: newPointMarker,
                saved: false,
                color: colorPrevio
            };

            // Crear overlay
            const overlay = document.createElement('div');
            overlay.className = 'popup-overlay';

            // Crear popup con selector de color
            const popup = document.createElement('div');
            popup.className = 'custom-popup';
            popup.innerHTML = `          
        <div class="color-picker-container">
            <label class="color-picker-label" for="pointColorPicker">
                Color: 
                <span class="color-preview" id="colorPreview" style=" DISPLAY:NONE; background-color:rgb(255, 235, 53);"></span>
                <input type="color" id="pointColorPicker" class="color-picker-input" value="${colorPrevio}" /> 
            </label> 
        </div>

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

            // Configurar event listeners para el selector de color
            setTimeout(() => {
                const colorPicker = document.getElementById('pointColorPicker');
                const colorPreview = document.getElementById('colorPreview');

                if (colorPicker) {
                    colorPicker.addEventListener('input', function(e) {
                        const selectedColor = e.target.value;
                        console.log("colorPrevio:" + colorPrevio + " selectedColor:" + selectedColor)
                        if (colorPrevio != selectedColor) {
                            colorPrevio = selectedColor;
                        }

                        // Actualizar preview
                        colorPreview.style.backgroundColor = selectedColor;

                        // Guardar color en currentPointData
                        if (currentPointData) {
                            currentPointData.color = selectedColor;
                        }

                        // Actualizar el marcador en tiempo real
                        if (newPointMarker) {
                            updateMarkerColor(newPointMarker, selectedColor);
                        }

                        console.log('Color seleccionado:', selectedColor);
                    });
                }

                // Enfocar input después de configurar eventos
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


        // Función para actualizar el color del marcador
        function updateMarkerColor(marker, color) {
            console.log("en updateMarkerColor:" + color);

            /* html: `<div style="background-color: ${color}; width: 12px; height: 12px; border-radius: 50%; border: 2px solid white; box-shadow: 0 0 8px ${color}80; animation: pulseAnimation 1.5s infinite ease-in-out;"></div>`, */
            const newIcon = L.divIcon({
                className: 'new-point-marker-container',
                html: `<div style="background-color: ${color}; width: 12px; height: 12px; border-radius: 50%; border: 2px solid white; box-shadow: 0 0 8px ${color}80;"></div>`,
                iconSize: [16, 16],
                iconAnchor: [8, 8]
            });
            marker.setIcon(newIcon);
        }

        // Función para guardar nuevo punto
        function saveNewPoint() {
            const input = document.getElementById('pointInput');
            const description = input.value.trim();
            const selectedColor = currentPointData ? currentPointData.color : colorPrevio;

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

            // Cambiar el estilo del marcador a "guardado" con el color seleccionado
            if (newPointMarker) {
                // Crear nuevo icono para punto guardado con color personalizado

                /* html: `<div style="background-color: ${selectedColor}; width: 0.9rem; height: 0.9rem; border-radius: 50%; box-shadow: 0 0 6px #fff, 0 0 0.9rem #fff, 0 0 18px ${selectedColor}, 0 0 24px ${selectedColor}, 0 0 30px ${selectedColor}, 0 0 36px ${selectedColor}; border: 2px solid #fff; animation: pulseAnimation 5s infinite ease-in-out;"></div>`, */

                const savedPointIcon = L.divIcon({
                    className: 'saved-point-marker-container',
                    html: `<div style="background-color: ${selectedColor}; width: 0.9rem; height: 0.9rem; border-radius: 50%; border: 2px solid #fff;"></div>`,
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
                    <strong>Color:</strong> <span style="display: inline-block; width: 15px; height: 15px; background-color: ${selectedColor}; border: 1px solid #ccc; border-radius: 3px; vertical-align: middle;"></span> ${selectedColor.toUpperCase()}<br>
                    <strong>Coordenadas:</strong> ${currentPointData.lat.toFixed(6)}, ${currentPointData.lng.toFixed(6)}<br>
                    <small style="color: ${selectedColor};">Guardado: ${new Date().toLocaleString()}</small>
                </div>
            </div>`;

                // Actualizar el popup del marcador
                newPointMarker.bindPopup(savedPopupContent);

                // Agregar a la lista de puntos guardados
                savedPoints.push({
                    id: Date.now(),
                    marker: newPointMarker,
                    lat: currentPointData.lat,
                    lng: currentPointData.lng,
                    description: description,
                    color: selectedColor, // Guardar el color seleccionado
                    timestamp: currentPointData.timestamp
                });

                console.log('Punto guardado con color:', savedPoints[savedPoints.length - 1]);
            }

            // Datos para enviar al backend (incluyendo color)
            const data = {
                latitud: currentPointData.lat,
                longitud: currentPointData.lng,
                detalle: description,
                color: selectedColor
            };

            console.log('Datos a enviar:', data);

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
                     dat = JSON.parse(dat);
                    console.log(dat.status);

                    loadGralOff();
                    if (dat.status === 'unauthenticated') {
                        window.location.href = 'index.php';
                    } else if (dat.status === 'success') {
                        showStatusMessage(`Punto guardado correctamente con color ${selectedColor.toUpperCase()}. Total puntos: ${savedPoints.length}`, 'success');
                        closeCustomPopup(true);
                        newPointMarker = null;
                        currentPointData = null;
                    } else {
                        showStatusMessage("Error: " + dat.message);
                    }
                },
                error: function(xhr, status, error) {
                    loadGralOff();
                    console.error("Error en la solicitud AJAX:", error);
                }
            });


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
        document.addEventListener('DOMContentLoaded', function() {
            initializeMarkers();
            document.getElementById('addPointBtn').addEventListener('click', function(e) {
                e.stopPropagation();
                e.preventDefault();
                toggleAddPointMode(e);
            });
            document.addEventListener('keydown', function(e) {
                if (e.ctrlKey && (e.key === 'q' || e.key === 'Q')) {
                    e.preventDefault(); // Prevenir comportamiento por defecto
                    toggleAddPointMode(e); // Ejecutar la función
                }
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

            document.addEventListener('keydown', function(e) {
                if (e.ctrlKey && (e.key === 'g' || e.key === 'G')) {
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

        // Event listener para el botón de distritos
        document.getElementById('distritosBtn').addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            if (distritosActive) {
                // Desactivar capa de distritos
                if (distritosLayerGroup && map.hasLayer(distritosLayerGroup)) {
                    map.removeLayer(distritosLayerGroup);
                    distritosLayerGroup = null;
                }
                // Remover tooltip si existe
                if (currentTooltip) {
                    map.closeTooltip(currentTooltip);
                    currentTooltip = null;
                }
                this.classList.remove('geojson-active');
                distritosActive = false;
                showStatusMessage('Capa de distritos desactivada', 'info');
            } else {
                // Activar capa de distritos - crear todos los polígonos
                distritosLayerGroup = L.layerGroup();

                // Crear un polígono para cada distrito
                Object.keys(distritosData).forEach(distritoKey => {
                    const distritoNum = distritoKey.replace('distrito', '');
                    const coordinates = distritosData[distritoKey];
                    const color = distritosColors[distritoKey];

                    const polygon = L.polygon(coordinates, {
                        className: `distrito-polygon distrito-${distritoNum}`,
                        fillColor: color,
                        fillOpacity: 0.3,
                        color: color,
                        weight: 2,
                        opacity: 0.8,
                        dashArray: '3, 3'
                    });

                    // Agregar popup para click
                    polygon.bindPopup(`
                <div class="popup-content"> 
                    <div class="popup-description">
                        <strong>Área:</strong> Distrito ${distritoNum} de El Alto<br> 
                    </div>
                </div>
            `);

                    // Agregar eventos para tooltip al pasar el mouse
                    polygon.on('mouseover', function(e) {
                        // Cambiar estilo al pasar el mouse
                        this.setStyle({
                            fillOpacity: 0.5,
                            weight: 3
                        });

                        // Crear tooltip
                        currentTooltip = L.tooltip({
                                permanent: false,
                                direction: 'top',
                                className: 'distrito-tooltip'
                            })
                            .setContent(`<strong>Distrito ${distritoNum}</strong>`)
                            .setLatLng(e.latlng)
                            .addTo(map);
                    });

                    polygon.on('mouseout', function(e) {
                        // Restaurar estilo original
                        this.setStyle({
                            fillOpacity: 0.3,
                            weight: 2
                        });

                        // Remover tooltip
                        if (currentTooltip) {
                            map.closeTooltip(currentTooltip);
                            currentTooltip = null;
                        }
                    });

                    polygon.on('mousemove', function(e) {
                        // Actualizar posición del tooltip mientras se mueve el mouse
                        if (currentTooltip) {
                            currentTooltip.setLatLng(e.latlng);
                        }
                    });

                    // Agregar el polígono al grupo
                    distritosLayerGroup.addLayer(polygon);
                });

                // Agregar el grupo completo al mapa
                distritosLayerGroup.addTo(map);

                this.classList.add('geojson-active');
                distritosActive = true;
                showStatusMessage('Todos los distritos activados', 'success');
            }

            this.blur();
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
            $('.leaflet-control-attribution').hide();
        });
    </script>
</body>

</html>