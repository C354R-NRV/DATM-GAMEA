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

        /* Estilos específicos para botones de teselas */
        .control-button.tesela-active {
            background-color: rgba(0, 200, 255, 0.9);
            color: white;
        }

        .control-button.tesela-active:hover {
            background-color: rgba(0, 180, 230, 0.9);
        }

        .control-button.tesela-puntos {
            background-color: rgba(255, 0, 0, 0.8);
        }

        .control-button.tesela-puntos.tesela-active {
            background-color: rgba(255, 0, 0, 0.9);
        }

        .control-button.tesela-lineas {
            background-color: rgba(0, 0, 255, 0.8);
        }

        .control-button.tesela-lineas.tesela-active {
            background-color: rgba(0, 0, 255, 0.9);
        }

        .control-button.tesela-poligonos {
            background-color: rgba(0, 128, 0, 0.8);
        }

        .control-button.tesela-poligonos.tesela-active {
            background-color: rgba(0, 128, 0, 0.9);
        }

        .control-button.satelital {
            background-color: rgba(29, 25, 22, 0.8);
        }

        .control-button.satelital.tesela-active {
            background-color: rgba(29, 25, 22, 0.8);
        }

        .control-button.satelital:hover {
            background-color: rgba(36, 29, 27, 0.9)
        }

        .control-button.oscurecer {
            background-color: rgba(50, 50, 50, 0.8);
        }

        .control-button.oscurecer.tesela-active {
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

        /* Debug info */
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

        /* Spinner de carga */
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

        .individual-pulsing-marker .leaflet-marker-icon {
            animation: pulseAnimation 1.8s infinite ease-in-out;
            transform-origin: center bottom;
        }

        .marker-cluster-small {
            background-color: rgba(255, 183, 183, 0.6) !important;
        }

        .marker-cluster-small div {
            background-color: rgba(255, 0, 0, 0.6) !important;
            animation: pulseAnimation 2.8s infinite ease-in-out;
            color:rgb(255, 255, 255);
            font-weight: bold;
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
            color: #39b6e7;
        }

        .carrusel {
            position: relative;
            width: 100%;
            max-height: 300px;
            overflow: hidden;
        }

        .carrusel-img {
            width: 100%;
            height: auto;
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

        .leaflet-popup-content {
            margin: 5px 2px 13px 2px !important;
        }

        .leaflet-popup-content-wrapper,
        .leaflet-popup-tip {
            background: #313030 !important;
            color: rgb(240, 240, 240) !important;
            box-shadow: 0 3px 14px rgba(0, 0, 0, 0.4);
        }
    </style>
</head>

<body>

    <main>
        <div class="container">
            <div id="map">
                <div class="search-container">
                    <div class="search-input-container">
                        <input
                            type="text"
                            id="searchInput"
                            class="search-input"
                            placeholder="Buscar inmuebles, contribuyentes o números..."
                            aria-label="Buscar inmuebles, contribuyentes o números">
                        <button id="clearSearch" class="clear-search" title="Limpiar búsqueda" aria-label="Limpiar búsqueda">×</button>
                    </div>
                    <div class="search-results">
                        <span id="resultsCount" class="results-count" aria-live="polite"></span>
                        <button id="showAllBtn" class="show-all-btn">Mostrar todos</button>
                    </div>
                </div>
                <div class="map-controls">
                    <button id="locationBtn" class="control-button" title="Mostrar mi ubicación" aria-label="Mostrar mi ubicación"><i class="fa fa-map-marker" aria-hidden="true"></i></button>
                    <button id="zoomInBtn" class="control-button" title="Acercar" aria-label="Acercar mapa">+</button>
                    <button id="zoomOutBtn" class="control-button" title="Alejar" aria-label="Alejar mapa">−</button>
                    <button id="homeBtn" class="control-button" title="Inicio" aria-label="Volver" style="outline-style: none;"><i class="fa fa-home" aria-hidden="true"></i></button>

                    <!-- Botones para controlar teselas vectoriales -->
                    <button id="teselaPuntosBtn" class="control-button" title="Mostrar/Ocultar Puntos Vectoriales" aria-label="Puntos Vectoriales">
                        <i class="fa fa-circle" aria-hidden="true"></i>
                    </button>
                    <button id="teselaLineasBtn" class="control-button" title="Mostrar/Ocultar Líneas Vectoriales" aria-label="Líneas Vectoriales">
                        <i class="fa fa-minus" aria-hidden="true"></i>
                    </button>
                    <button id="teselaPoligonosBtn" class="control-button" title="Mostrar/Ocultar Polígonos Vectoriales" aria-label="Polígonos Vectoriales" style="outline-style: none;">
                        <i class="fa fa-square-o" aria-hidden="true"></i>
                    </button>
                    <!-- Nuevo botón para capa satelital -->
                    <button id="satelitalBtn" class="control-button satelital" title="Mostrar/Ocultar Capa Satelital" aria-label="Capa Satelital" style="outline-style: none;">
                        <i class="fa fa-globe" aria-hidden="true"></i>
                    </button>
                    <button id="oscurecerBtn" class="control-button oscurecer" title="Oscurecer El Alto" aria-label="Oscurecer El Alto" style="outline-style: none;">
                        <i class="fa fa-moon-o" aria-hidden="true"></i>
                    </button>
                </div>
                <div id="statusMessage" class="status-message" role="alert"></div>
                <div id="loader" class="loader"></div>
                <div id="debugInfo" class="debug-info"></div>
            </div>
        </div>
    </main>

    <!-- Scripts en orden correcto -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

    <!-- Cargar VectorGrid después de Leaflet -->
    <script src="https://cdn.jsdelivr.net/npm/leaflet.vectorgrid@1.3.0/dist/Leaflet.VectorGrid.bundled.min.js"></script>

    <script>
        // Verificar que las bibliotecas se cargaron correctamente
        console.log('Leaflet version:', L.version);
        console.log('VectorGrid available:', typeof L.vectorGrid !== 'undefined');

        const map = L.map('map', {
            zoomControl: false,
            maxZoom: 19
        }).setView([-16.5, -68.175], 13);

        // Capa base OpenStreetMap
        const osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19
        }).addTo(map);

        // Capa satelital de ArcGIS
        const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            maxZoom: 19
        }).addTo(map);

        // Definir el polígono de El Alto (coordenadas aproximadas)
        const elAltoCoordinates = [
            [-16.45, -68.25],
            [-16.45, -68.10],
            [-16.55, -68.10],
            [-16.55, -68.25],
            [-16.628626, -68.275051],
            [-16.587372, -68.215312]
        ];

        // Crear el polígono oscuro para El Alto
        const darkOverlay = L.polygon(elAltoCoordinates, {
            className: 'dark-overlay',
            fillColor: 'black',
            fillOpacity: 0.7,
            color: '#666',
            weight: 2,
            dashArray: '5, 5'
        });

        // Variable para controlar el estado del oscurecimiento
        let oscurecerActive = false;


        let userLocationMarker = null;
        let initialMarkerData = [];
        let allLeafletMarkers = [];
        let markerClusterGroup;
        let vectorLayers = {};
        let isDataLoading = false;
        let currentBounds = null;
        let loadedMarkerIds = new Set();
        let debounceTimer;
        let totalMarkersCount = 0;

        // Estado de las teselas vectoriales y capa satelital
        let teselaStates = {
            puntos: false,
            lineas: false,
            poligonos: false
        };

        let satelitalActive = true; // La capa satelital está activa por defecto

        // Configuración mejorada para carga por lotes
        const BATCH_SIZE = 500;
        const BATCH_DELAY = 30;
        const MIN_ZOOM_FOR_LOADING = 10;
        const MAX_ZOOM_FOR_VECTOR = 18;

        // Debug info
        function updateDebugInfo() {
            const debugDiv = document.getElementById('debugInfo');
            const zoom = map.getZoom();
            const center = map.getCenter();
            const markersCount = allLeafletMarkers.length;
            const vectorLayersActive = Object.keys(teselaStates).filter(key => teselaStates[key]).length;

            debugDiv.innerHTML = `
                Zoom: ${zoom} | 
                Marcadores: ${markersCount} | 
                Teselas: ${vectorLayersActive} | 
                Satelital: ${satelitalActive ? 'ON' : 'OFF'} |
                Oscurecer: ${oscurecerActive ? 'ON' : 'OFF'} |
                Lat: ${center.lat.toFixed(4)} | 
                Lng: ${center.lng.toFixed(4)}
            `;
        }

        function toggleDarkOverlay() {
            const button = document.getElementById('oscurecerBtn');

            try {
                if (oscurecerActive) {
                    // Desactivar oscurecimiento
                    if (map.hasLayer(darkOverlay)) {
                        map.removeLayer(darkOverlay);
                        console.log('Capa oscura removida del mapa');
                    }
                    button.classList.remove('tesela-active');
                    showStatusMessage('Oscurecimiento desactivado', 'info');
                    oscurecerActive = false;
                } else {
                    // Activar oscurecimiento
                    if (!map.hasLayer(darkOverlay)) {
                        map.addLayer(darkOverlay);
                        console.log('Capa oscura añadida al mapa');
                    }
                    button.classList.add('tesela-active');
                    showStatusMessage('Oscurecimiento activado', 'success');
                    oscurecerActive = true;
                }

                updateDebugInfo();
            } catch (error) {
                console.error('Error toggling capa oscura:', error);
                showStatusMessage('Error manipulando capa oscura', 'error');
            }
        }

        // Función para alternar la capa satelital
        function toggleSatelliteLayer() {
            const button = document.getElementById('satelitalBtn');

            try {
                if (satelitalActive) {
                    // Desactivar capa satelital
                    if (map.hasLayer(satelliteLayer)) {
                        map.removeLayer(satelliteLayer);
                        console.log('Capa satelital removida del mapa');
                    }
                    button.classList.remove('tesela-active');
                    showStatusMessage('Capa satelital desactivada', 'info');
                    satelitalActive = false;
                } else {
                    // Activar capa satelital
                    if (!map.hasLayer(satelliteLayer)) {
                        map.addLayer(satelliteLayer);
                        console.log('Capa satelital añadida al mapa');
                    }
                    button.classList.add('tesela-active');
                    showStatusMessage('Capa satelital activada', 'success');
                    satelitalActive = true;
                }

                updateDebugInfo();
            } catch (error) {
                console.error('Error toggling capa satelital:', error);
                showStatusMessage('Error manipulando capa satelital', 'error');
            }
        }

        // Inicializar capas vectoriales con configuración mejorada
        function initializeVectorLayers() {
            console.log('Inicializando capas vectoriales...');

            if (typeof L.vectorGrid === 'undefined') {
                console.error('L.vectorGrid no está disponible. Las teselas vectoriales no funcionarán.');
                showStatusMessage('Error: Biblioteca de teselas vectoriales no cargada', 'error');
                return;
            }

            try {
                // Capa de puntos vectoriales - configuración mejorada
                vectorLayers.puntos = L.vectorGrid.protobuf('../static/teselas/puntos/{z}/{x}/{y}.pbf', {
                    vectorTileLayerStyles: {
                        puntos: {
                            radius: function(zoom) {
                                return Math.max(3, Math.min(8, zoom - 8));
                            },
                            color: '#ff0000',
                            fillColor: '#ff3333',
                            weight: 1,
                            opacity: 0.9,
                            fillOpacity: 0.7
                        }
                    },
                    interactive: true,
                    getFeatureId: function(f) {
                        return f.properties.id || f.properties.fid;
                    },
                    maxNativeZoom: 18,
                    minZoom: 8,
                    maxZoom: 19
                });

                // Capa de líneas - configuración mejorada
                vectorLayers.lineas = L.vectorGrid.protobuf('../static/teselas/lineas/{z}/{x}/{y}.pbf', {
                    vectorTileLayerStyles: {
                        lineas: {
                            color: '#0000ff',
                            weight: function(zoom) {
                                return Math.max(1, Math.min(4, zoom - 10));
                            },
                            opacity: 0.8,
                            dashArray: '5, 5'
                        }
                    },
                    interactive: true,
                    getFeatureId: function(f) {
                        return f.properties.id || f.properties.fid;
                    },
                    maxNativeZoom: 18,
                    minZoom: 8,
                    maxZoom: 19
                });

                // Capa de polígonos - configuración mejorada
                vectorLayers.poligonos = L.vectorGrid.protobuf('../static/teselas/poligonos/{z}/{x}/{y}.pbf', {
                    vectorTileLayerStyles: {
                        poligonos: {
                            color: '#008000',
                            weight: function(zoom) {
                                return Math.max(1, Math.min(3, zoom - 12));
                            },
                            opacity: 0.8,
                            fillColor: '#4CAF50',
                            fillOpacity: function(zoom) {
                                return Math.max(0.2, Math.min(0.5, (zoom - 10) * 0.1));
                            }
                        }
                    },
                    interactive: true,
                    getFeatureId: function(f) {
                        return f.properties.id || f.properties.fid;
                    },
                    maxNativeZoom: 18,
                    minZoom: 8,
                    maxZoom: 19
                });

                // Configurar eventos para las capas vectoriales
                Object.keys(vectorLayers).forEach(key => {
                    vectorLayers[key].on('click', function(e) {
                        console.log('Click en capa vectorial:', key, e);
                        if (e.layer && e.layer.properties) {
                            const props = e.layer.properties;
                            const popupContent = `
                                <div class="popup-content">
                                    <div class="popup-title">Tesela ${key.charAt(0).toUpperCase() + key.slice(1)}</div>
                                    <div class="popup-description">
                                        <strong>ID:</strong> ${props.id || props.fid || 'N/A'}<br>
                                        <strong>Tipo:</strong> ${key}<br>
                                        ${props.name ? '<strong>Nombre:</strong> ' + props.name + '<br>' : ''}
                                        ${props.description ? '<strong>Descripción:</strong> ' + props.description : ''}
                                    </div>
                                </div>
                            `;
                            L.popup()
                                .setLatLng(e.latlng)
                                .setContent(popupContent)
                                .openOn(map);
                        }
                    });

                    vectorLayers[key].on('loading', function() {
                        console.log(`Cargando teselas ${key}...`);
                    });

                    vectorLayers[key].on('load', function() {
                        console.log(`Teselas ${key} cargadas`);
                    });

                    vectorLayers[key].on('tileerror', function(e) {
                        console.warn(`Error cargando tesela ${key}:`, e);
                    });
                });

                console.log('Capas vectoriales inicializadas:', Object.keys(vectorLayers));
                showStatusMessage('Capas vectoriales inicializadas correctamente', 'success');

            } catch (error) {
                console.error('Error inicializando capas vectoriales:', error);
                showStatusMessage('Error inicializando teselas vectoriales', 'error');
            }
        }

        function toggleVectorLayer(layerName, forceState = null) {
            if (!vectorLayers[layerName]) {
                console.error(`Capa ${layerName} no existe`);
                showStatusMessage(`Error: Capa ${layerName} no disponible`, 'error');
                return;
            }

            const currentState = forceState !== null ? forceState : !teselaStates[layerName];
            const button = document.getElementById(`tesela${layerName.charAt(0).toUpperCase() + layerName.slice(1)}Btn`);

            console.log(`Toggling ${layerName} to ${currentState}`);

            try {
                if (currentState) {
                    if (!map.hasLayer(vectorLayers[layerName])) {
                        map.addLayer(vectorLayers[layerName]);
                        console.log(`Capa ${layerName} añadida al mapa`);
                    }
                    button.classList.add('tesela-active');
                    showStatusMessage(`Tesela ${layerName} activada`, 'success');
                } else {
                    if (map.hasLayer(vectorLayers[layerName])) {
                        map.removeLayer(vectorLayers[layerName]);
                        console.log(`Capa ${layerName} removida del mapa`);
                    }
                    button.classList.remove('tesela-active');
                    showStatusMessage(`Tesela ${layerName} desactivada`, 'info');
                }

                teselaStates[layerName] = currentState;
                updateDebugInfo();
            } catch (error) {
                console.error(`Error toggling capa ${layerName}:`, error);
                showStatusMessage(`Error manipulando capa ${layerName}`, 'error');
            }
        }

        function initializeMarkers() {
            if (!window.map) {
                console.error("Map not initialized");
                return;
            }

            try {
                if (markerClusterGroup) {
                    map.removeLayer(markerClusterGroup);
                }

                // Crear nuevo grupo de marcadores con manejo de errores
                markerClusterGroup = L.markerClusterGroup({
                    chunkedLoading: true,
                    chunkInterval: 50,
                    chunkDelay: 25,
                    maxClusterRadius: function(zoom) {
                        return zoom < 15 ? 80 : 40;
                    },
                    spiderfyOnMaxZoom: true,
                    showCoverageOnHover: false,
                    zoomToBoundsOnClick: true,
                    disableClusteringAtZoom: 18
                });

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

        function processMarkersInBatches(data, startIndex) {
            try {
                if (!markerClusterGroup) {
                    console.error("markerClusterGroup is undefined");
                    showStatusMessage("Error: Grupo de marcadores no inicializado", "error");
                    hideLoader();
                    return;
                }

                const endIndex = Math.min(startIndex + BATCH_SIZE, data.length);
                const currentBatch = data.slice(startIndex, endIndex);

                const batchMarkers = currentBatch.map(item => {
                    if (loadedMarkerIds.has(item.id)) {
                        return null;
                    }

                    loadedMarkerIds.add(item.id);

                    const marker = L.marker(item.position).bindPopup(item.html);

                    marker.originalData = {
                        id: item.id,
                        title: item.title || '',
                        nombre_razon: item.nombre_razon || '',
                        codigo_catastral: item.codigo_catastral || '',
                        numero_inmueble: item.numero_inmueble || '',
                        description: item.description || '',
                        type: item.numero_inmueble || '',
                        position: item.position,
                        html: item.html
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
                    }, BATCH_DELAY);
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

        function loadMarkersInViewport() {
            if (isDataLoading) return;

            const bounds = map.getBounds();
            const zoom = map.getZoom();

            console.log(`Intentando cargar marcadores - Zoom: ${zoom}, Min requerido: ${MIN_ZOOM_FOR_LOADING}`);

            if (zoom < MIN_ZOOM_FOR_LOADING) {
                console.log('Zoom insuficiente para cargar marcadores');
                return;
            }

            if (currentBounds && currentBounds.contains(bounds)) {
                console.log('Los datos ya están cargados para esta área');
                return;
            }

            isDataLoading = true;
            showLoader();

            const expandedBounds = bounds.pad(0.2);
            currentBounds = expandedBounds;

            const sw = expandedBounds.getSouthWest();
            const ne = expandedBounds.getNorthEast();

            // Usar el backend corregido
            const url = `../php/ufPuntosGet.php?minLat=${sw.lat}&maxLat=${ne.lat}&minLng=${sw.lng}&maxLng=${ne.lng}&zoom=${zoom}&limit=2000`;

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

                            // Asegurarse de que markerClusterGroup esté inicializado
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

        function filterMarkers(searchTerm) {
            const term = searchTerm.toLowerCase().trim();
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

                        const title = String(data.title || '').toLowerCase();
                        const nombre = String(data.nombre_razon || '').toLowerCase();
                        const codigo = String(data.codigo_catastral || '').toLowerCase();
                        const numero = String(data.numero_inmueble || '').toLowerCase();

                        const matchesSearch = term === '' ||
                            title.includes(term) ||
                            nombre.includes(term) ||
                            codigo.includes(term) ||
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

        function updateResultsCount(count, total) {
            const resultsElement = document.getElementById('resultsCount');
            if (total === undefined) total = totalMarkersCount || allLeafletMarkers.length;

            if (count === total && document.getElementById('searchInput').value === '') {
                resultsElement.textContent = `${total} inmuebles encontrados`;
            } else {
                resultsElement.textContent = `${count} de ${total} inmuebles encontrados`;
            }
        }

        function clearSearch() {
            const searchInput = document.getElementById('searchInput');
            searchInput.value = '';
            filterMarkers('');
            searchInput.focus();
        }

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

        function showStatusMessage(message, type = 'info') {
            const statusDiv = document.getElementById('statusMessage');
            statusDiv.textContent = message;
            statusDiv.className = `status-message ${type}`;
            statusDiv.style.display = 'block';

            setTimeout(() => {
                statusDiv.style.display = 'none';
            }, 4000);
        }

        function showLoader() {
            document.getElementById('loader').style.display = 'block';
        }

        function hideLoader() {
            document.getElementById('loader').style.display = 'none';
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

                    const userPopupContent =
                        `<div class="popup-content">
                            <div class="popup-title">Tu estas acá</div> 
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
            window.location.href = "ufPredialList.php"
        }

        function initializeApp() {
            showStatusMessage('Inicializando aplicación...', 'info');
            showLoader();

            try {
                markerClusterGroup = L.markerClusterGroup({
                    chunkedLoading: true,
                    chunkInterval: 50,
                    chunkDelay: 25,
                    maxClusterRadius: function(zoom) {
                        return zoom < 15 ? 80 : 40;
                    },
                    spiderfyOnMaxZoom: true,
                    showCoverageOnHover: false,
                    zoomToBoundsOnClick: true,
                    disableClusteringAtZoom: 18
                });

                console.log("MarkerClusterGroup inicializado en startup:", markerClusterGroup);

                // Inicializar el estado del botón satelital
                const satelitalBtn = document.getElementById('satelitalBtn');
                if (satelitalActive) {
                    satelitalBtn.classList.add('tesela-active');
                }

                setTimeout(() => {
                    initializeVectorLayers();

                    if (markerClusterGroup && !map.hasLayer(markerClusterGroup)) {
                        map.addLayer(markerClusterGroup);
                        console.log("MarkerClusterGroup añadido al mapa");
                    }

                    loadMarkersInViewport();

                    map.on('moveend', function() {
                        clearTimeout(debounceTimer);
                        debounceTimer = setTimeout(() => {
                            loadMarkersInViewport();
                            updateDebugInfo();
                        }, 200);
                    });

                    map.on('zoomend', function() {
                        clearTimeout(debounceTimer);
                        debounceTimer = setTimeout(() => {
                            loadMarkersInViewport();
                            updateDebugInfo();
                        }, 200);
                    });

                    map.on('move', updateDebugInfo);
                    map.on('zoom', updateDebugInfo);

                    const searchInput = document.getElementById('searchInput');
                    const clearButton = document.getElementById('clearSearch');
                    const showAllButton = document.getElementById('showAllBtn');

                    searchInput.addEventListener('input', function(e) {
                        clearTimeout(debounceTimer);
                        debounceTimer = setTimeout(() => {
                            filterMarkers(e.target.value);
                        }, 200);
                    });

                    clearButton.addEventListener('click', clearSearch);

                    showAllButton.addEventListener('click', function() {
                        clearSearch();
                        setTimeout(() => {
                            fitMapToVisibleMarkers();
                        }, 100);
                    });

                    document.getElementById('locationBtn').addEventListener('click', getUserLocation);
                    document.getElementById('zoomInBtn').addEventListener('click', zoomIn);
                    document.getElementById('zoomOutBtn').addEventListener('click', zoomOut);
                    document.getElementById('homeBtn').addEventListener('click', homeBtn);

                    document.getElementById('teselaPuntosBtn').addEventListener('click', function() {
                        toggleVectorLayer('puntos');
                    });

                    document.getElementById('teselaLineasBtn').addEventListener('click', function() {
                        toggleVectorLayer('lineas');
                    });

                    document.getElementById('teselaPoligonosBtn').addEventListener('click', function() {
                        toggleVectorLayer('poligonos');
                    });

                    // Event listener para el botón satelital
                    document.getElementById('satelitalBtn').addEventListener('click', function() {
                        toggleSatelliteLayer();
                    });

                    document.getElementById('oscurecerBtn').addEventListener('click', function() {
                        toggleDarkOverlay();
                    });

                    searchInput.addEventListener('keypress', function(e) {
                        if (e.key === 'Enter') {
                            filterMarkers(e.target.value);
                        }
                    });

                    updateDebugInfo();
                    console.log('Aplicación inicializada correctamente');
                    hideLoader();
                }, 300);
            } catch (error) {
                console.error("Error en inicialización:", error);
                showStatusMessage("Error al inicializar la aplicación", "error");
                hideLoader();
            }
        }

        document.addEventListener('DOMContentLoaded', initializeApp);

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
    </script>
</body>

</html>