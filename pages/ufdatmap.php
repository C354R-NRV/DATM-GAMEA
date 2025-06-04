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

        /* Estilos específicos para botones de capas GeoJSON */
        .control-button.geojson-active {
            background-color: rgba(0, 200, 255, 0.9);
            color: white;
        }

        .control-button.geojson-active:hover {
            background-color: rgba(0, 180, 230, 0.9);
        }

        .control-button.geojson-puntos {
            background-color: rgba(255, 0, 0, 0.8);
        }

        .control-button.geojson-puntos.geojson-active {
            background-color: rgba(255, 0, 0, 0.9);
        }

        .control-button.geojson-lineas {
            background-color: rgba(0, 0, 255, 0.8);
        }

        .control-button.geojson-lineas.geojson-active {
            background-color: rgba(0, 0, 255, 0.9);
        }

        .control-button.geojson-poligonos {
            background-color: rgba(0, 128, 0, 0.8);
        }

        .control-button.geojson-poligonos.geojson-active {
            background-color: rgba(0, 128, 0, 0.9);
        }

        /* Nuevo estilo para la capa de códigos */
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

        .marker-cluster-small {
            background-color: rgba(255, 183, 183, 0.6) !important;
        }

        .marker-cluster-small div {
            background-color: rgba(255, 0, 0, 0.6) !important;
            animation: pulseAnimation 2.8s infinite ease-in-out;
            color: rgb(255, 255, 255);
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

        .puntoMarca {
            background-color: #00f3ff;
            width: 12px;
            height: 12px;
            border-radius: 50%;

            box-shadow:
                0 0 4px #fff,
                0 0 8px #fff,
                0 0 12px #17b9c1,
                0 0 18px #17b9c1,
                0 0 24px #4cf0f8,
                0 0 30px #4cf0f8;

            border: none;

            animation: pulseAnimation 2s infinite ease-in-out;
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
            width: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            animation: pulseAnimation 6s infinite ease-in-out;
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
                    <button id="locationBtn" class="control-button" title="Mostrar mi ubicación" aria-label="Mostrar mi ubicación"><i class="fa fa-map-marker" aria-hidden="true"></i></button>
                    <button id="zoomInBtn" class="control-button" title="Acercar" aria-label="Acercar mapa">+</button>
                    <button id="zoomOutBtn" class="control-button" title="Alejar" aria-label="Alejar mapa">−</button>
                    <button id="homeBtn" class="control-button" title="Inicio" aria-label="Volver" style="outline-style: none;">

                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </button> 

                    <!-- Nuevo botón para la capa de códigos -->
                    <button id="inmueblesBtn" class="control-button geojson-codigos" title="Mostrar/Ocultar Códigos" aria-label="Capa Códigos">
                        <i class="fa fa-home" aria-hidden="true"></i>
                    </button>

                    <button id="codigosBtn" class="control-button geojson-codigos" title="Mostrar/Ocultar Códigos" aria-label="Capa Códigos">
                        <i class="fa fa-tags" aria-hidden="true"></i>
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

    <script>
        // Verificar que las bibliotecas se cargaron correctamente
        console.log('Leaflet version:', L.version);

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

        // Datos GeoJSON de códigos (embebidos directamente)


        let codigosGeoJSONData = {};
        let codigosGeoJSONDataInm = {};

        // Definir el polígono de El Alto (coordenadas aproximadas)
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

        // Crear el polígono oscuro para El Alto
        const darkOverlay = L.polygon(elAltoCoordinates, {
            className: 'dark-overlay',
            fillColor: 'black',
            fillOpacity: 0.7,
            color: '#666',
            weight: 2,
            dashArray: '5, 5'
        });

        let oscurecerActive = false;
        let userLocationMarker = null;
        let clickedCoordinatesMarker = null;
        let initialMarkerData = [];
        let allLeafletMarkers = [];
        let markerClusterGroup;
        let isDataLoading = false;
        let currentBounds = null;
        let loadedMarkerIds = new Set();
        let debounceTimer;
        let totalMarkersCount = 0;

        // Variables para capas GeoJSON
        let geojsonLayer = null;
        let geojsonData = null;
        let geojsonActive = false;

        // Variables para la nueva capa de códigos
        let codigosLayer = null;
        let codigosLayerInm = null;
        let codigosActive = false;
        let inmueblesActive = false;

        // Estado de la capa satelital
        let satelitalActive = true;

        // Configuración mejorada para carga por lotes
        const BATCH_SIZE = 500;
        const BATCH_DELAY = 30;
        const MIN_ZOOM_FOR_LOADING = 10;

        // Función para crear la capa de códigos GeoJSON
        function createCodigosLayer(data, modulo) {
            if (!data) {
                console.error('Datos de códigos GeoJSON inválidos');
                return null;
            }

            return L.geoJSON(data, {
                pointToLayer: function(feature, latlng) {
                    // Crear marcador personalizado para códigos
                    let clase_ = (modulo == 'inmueble' ? 'codigo-markerInm' : 'codigo-marker');

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
                    if (modulo == 'inmueble') {
                        // Crear popup con información del código
                        let popupContent = '<div class="popup-content">';
                        popupContent += '<div class="popup-title">Numero de inmueble catastral</div>';
                        popupContent += '<div class="popup-description">';

                        // Mostrar el texto principal
                        if (feature.properties && feature.properties.Text) {
                            popupContent += `<strong>Código:</strong> ${feature.properties.Text}<br>`;
                        }

                        // Mostrar coordenadas
                        const coords = feature.geometry.coordinates;

                        popupContent += '</div></div>';

                        layer.bindPopup(popupContent);

                        // Agregar eventos
                        layer.on('click', function(e) {
                            console.log('Click en código:', feature.properties.Text);
                        });
                    }
                }
            });
        }

        // Función para alternar la capa de códigos
        function toggleCodigosLayer() {

            const button = document.getElementById('codigosBtn');

            try {
                if (codigosActive) {
                    // Desactivar capa de códigos
                    if (codigosLayer && map.hasLayer(codigosLayer)) {
                        map.removeLayer(codigosLayer);
                        console.log('Capa de códigos removida del mapa');
                        codigosLayer = null;
                        codigosGeoJSONData = {};
                    }
                    button.classList.remove('geojson-active');
                    showStatusMessage('Capa de códigos desactivada', 'info');
                    codigosActive = false;
                    updateDebugInfo();
                } else {

                    const bounds = map.getBounds()
                    const zoom = map.getZoom()

                    console.log(`Cargando datos GeoJSON - Zoom: ${zoom}`)

                    isDataLoading = true
                    showLoader()

                    const sw = bounds.getSouthWest()
                    const ne = bounds.getNorthEast()

                    // Determinar límite basado en zoom
                    let pointLimit = 500 // Valor por defecto para zoom 13
                    if (zoom > 16) {
                        // Incrementar el límite a medida que aumenta el zoom
                        pointLimit = 500 + (zoom - 13) * 250
                    } else if (zoom < 16) {
                        // Reducir el límite para zoom menor a 13
                        pointLimit = Math.max(100, 500 - (13 - zoom) * 100)
                    }

                    const url_ = `../php/ufPredialGetGeoJson.php?minLat=${sw.lat}&maxLat=${ne.lat}&minLng=${sw.lng}&maxLng=${ne.lng}&zoom=${zoom}&limit=${pointLimit}&modulo=catastro`;

                    $.ajax({
                        async: true,
                        type: "POST",
                        dataType: "html",
                        contentType: "application/x-www-form-urlencoded",
                        url: url_,
                        beforeSend: function() {},
                        success: function(dat) {
                            console.log("=========toggleCodigosLayer CATASTRO============");
                            dat = JSON.parse(dat)

                            codigosGeoJSONData = dat.data;
                            console.log(codigosGeoJSONData);
                            if (!codigosLayer) {
                                codigosLayer = createCodigosLayer(codigosGeoJSONData, 'catastro');
                                if (!codigosLayer) {
                                    showStatusMessage('Error creando capa de códigos', 'error');
                                    return;
                                }
                            }
                            if (!map.hasLayer(codigosLayer)) {
                                map.addLayer(codigosLayer);
                                console.log('Capa de códigos añadida al mapa');
                            }
                            button.classList.add('geojson-active');
                            showStatusMessage(`Capa de códigos activada (${codigosGeoJSONData.length} puntos)`, 'success');
                            codigosActive = true;
                            updateDebugInfo();
                        },
                    });
                }


            } catch (error) {
                console.error('Error toggling capa de códigos:', error);
                showStatusMessage('Error manipulando capa de códigos', 'error');
            } finally {
                hideLoader();
            }
        }

        function toggleInmueblesLayer() {

            const button = document.getElementById('inmueblesBtn');

            try {
                if (inmueblesActive) {
                    // Desactivar capa de códigos
                    if (codigosLayerInm && map.hasLayer(codigosLayerInm)) {
                        map.removeLayer(codigosLayerInm);
                        codigosLayerInm = null
                        codigosGeoJSONDataInm = {};
                        console.log('Capa de inmuebles removida del mapa');
                    }
                    button.classList.remove('geojson-active');
                    showStatusMessage('Capa de inmuebles desactivada', 'info');
                    inmueblesActive = false;
                    updateDebugInfo();
                } else {

                    const bounds = map.getBounds()
                    const zoom = map.getZoom()

                    console.log(`Cargando datos GeoJSON - Zoom: ${zoom}`)

                    isDataLoading = true
                    showLoader()

                    const sw = bounds.getSouthWest()
                    const ne = bounds.getNorthEast()

                    // Determinar límite basado en zoom
                    let pointLimit = 500 // Valor por defecto para zoom 13
                    if (zoom > 16) {
                        // Incrementar el límite a medida que aumenta el zoom
                        pointLimit = 500 + (zoom - 13) * 250


                        const url_ = `../php/ufPredialGetGeoJson.php?minLat=${sw.lat}&maxLat=${ne.lat}&minLng=${sw.lng}&maxLng=${ne.lng}&zoom=${zoom}&limit=${pointLimit}&modulo=inmueble`;

                        $.ajax({
                            async: true,
                            type: "POST",
                            dataType: "html",
                            contentType: "application/x-www-form-urlencoded",
                            url: url_,
                            beforeSend: function() {},
                            success: function(dat) {
                                console.log("=========togglecodigosLayerInm INMUEBLE============");
                                dat = JSON.parse(dat)

                                codigosGeoJSONDataInm = dat.data;
                                console.log(codigosGeoJSONDataInm);
                                if (!codigosLayerInm) {
                                    codigosLayerInm = createCodigosLayer(codigosGeoJSONDataInm, 'inmueble');
                                    if (!codigosLayerInm) {
                                        showStatusMessage('Error creando capa de códigos', 'error');
                                        return;
                                    }
                                }
                                if (!map.hasLayer(codigosLayerInm)) {
                                    map.addLayer(codigosLayerInm);
                                    console.log('Capa de códigos añadida al mapa');
                                }
                                button.classList.add('geojson-active');
                                showStatusMessage(`Capa de códigos activada (${codigosGeoJSONDataInm.length} puntos)`, 'success');
                                inmueblesActive = true;
                                updateDebugInfo();
                            },
                        });
                    } else {
                        alert("el zoom minimo para ver inmuebles es 16");
                    }
                }

            } catch (error) {
                console.error('Error toggling capa de códigos:', error);
                showStatusMessage('Error manipulando capa de códigos', 'error');
            } finally {
                hideLoader();
            }
        }

        // Función para cargar archivo GeoJSON
        async function loadGeoJSONData() {
            try {
                showStatusMessage('Cargando datos GeoJSON...', 'info');
                showLoader();

                // Intentar cargar el archivo GeoJSON
                const response = await fetch('../static/geojson/cod_elalto2.geojson');

                if (!response.ok) {
                    throw new Error(`Error HTTP: ${response.status} - ${response.statusText}`);
                }

                const data = await response.json();

                if (!data || !data.features) {
                    throw new Error('Archivo GeoJSON inválido o sin features');
                }

                geojsonData = data;
                console.log('Datos GeoJSON cargados:', data);
                console.log('Número de features:', data.features.length);

                showStatusMessage(`GeoJSON cargado: ${data.features.length} features`, 'success');
                return data;

            } catch (error) {
                console.error('Error cargando GeoJSON:', error);
                showStatusMessage(`Error cargando GeoJSON: ${error.message}`, 'error');
                return null;
            } finally {
                hideLoader();
            }
        }

        // Función para crear la capa GeoJSON con estilos
        function createGeoJSONLayer(data) {
            if (!data || !data.features) {
                console.error('Datos GeoJSON inválidos');
                return null;
            }

            return L.geoJSON(data, {
                style: function(feature) {
                    // Estilos basados en el tipo de geometría
                    const geometryType = feature.geometry.type;

                    switch (geometryType) {
                        case 'Point':
                        case 'MultiPoint':
                            return {
                                radius: 6,
                                    fillColor: '#ff0000',
                                    color: '#ff3333',
                                    weight: 2,
                                    opacity: 0.9,
                                    fillOpacity: 0.7
                            };
                        case 'LineString':
                        case 'MultiLineString':
                            return {
                                color: '#0000ff',
                                    weight: 3,
                                    opacity: 0.8,
                                    dashArray: '5, 5'
                            };
                        case 'Polygon':
                        case 'MultiPolygon':
                            return {
                                color: '#008000',
                                    weight: 2,
                                    opacity: 0.8,
                                    fillColor: '#4CAF50',
                                    fillOpacity: 0.3
                            };
                        default:
                            return {
                                color: '#666666',
                                    weight: 2,
                                    opacity: 0.7
                            };
                    }
                },
                pointToLayer: function(feature, latlng) {
                    // Para puntos, crear marcadores circulares
                    return L.circleMarker(latlng, {
                        radius: 6,
                        fillColor: '#ff0000',
                        color: '#ff3333',
                        weight: 2,
                        opacity: 0.9,
                        fillOpacity: 0.7
                    });
                },
                onEachFeature: function(feature, layer) {
                    // Agregar popup con información de la feature
                    let popupContent = '<div class="popup-content">';
                    popupContent += '<div class="popup-title">Feature GeoJSON</div>';
                    popupContent += '<div class="popup-description">';

                    // Mostrar propiedades de la feature
                    if (feature.properties) {
                        Object.keys(feature.properties).forEach(key => {
                            const value = feature.properties[key];
                            if (value !== null && value !== undefined && value !== '') {
                                popupContent += `<strong>${key}:</strong> ${value}<br>`;
                            }
                        });
                    }

                    popupContent += `<strong>Tipo:</strong> ${feature.geometry.type}<br>`;
                    popupContent += '</div></div>';

                    layer.bindPopup(popupContent);

                    // Agregar eventos
                    layer.on('click', function(e) {
                        console.log('Click en feature GeoJSON:', feature);
                    });
                }
            });
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
                        <small style="color: #00C8FF;">✓ Copiado al portapapeles</small>
                    </div>
                </div>
            `;

            clickedCoordinatesMarker.bindPopup(popupContent).openPopup();

            // Mostrar mensaje de confirmación
            showStatusMessage('Coordenadas obtenidas y copiadas al portapapeles', 'success');

            // Log para debug
            console.log('Coordenadas clickeadas:', {
                lat,
                lng
            });
            console.log('Coordenadas copiadas:', coordinatesArray);
        }

        // Función para copiar texto al portapapeles
        function copyToClipboard(text) {
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(() => {
                    console.log('Coordenadas copiadas al portapapeles:', text);
                }).catch(err => {
                    console.error('Error al copiar al portapapeles:', err);
                    fallbackCopyToClipboard(text);
                });
            } else {
                fallbackCopyToClipboard(text);
            }
        }

        // Función fallback para copiar al portapapeles
        function fallbackCopyToClipboard(text) {
            try {
                const textArea = document.createElement('textarea');
                textArea.value = text;
                textArea.style.position = 'fixed';
                textArea.style.left = '-999999px';
                textArea.style.top = '-999999px';
                document.body.appendChild(textArea);

                textArea.focus();
                textArea.select();

                const successful = document.execCommand('copy');
                document.body.removeChild(textArea);

                if (successful) {
                    console.log('Coordenadas copiadas al portapapeles (fallback):', text);
                } else {
                    console.error('Error al copiar al portapapeles con método fallback');
                    showStatusMessage('Error al copiar coordenadas al portapapeles', 'error');
                }
            } catch (err) {
                console.error('Error en fallback de copia:', err);
                showStatusMessage('Error al copiar coordenadas al portapapeles', 'error');
            }
        }

        // Debug info
        function updateDebugInfo() {
            const debugDiv = document.getElementById('debugInfo');
            const zoom = map.getZoom();
            const center = map.getCenter();
            const markersCount = allLeafletMarkers.length;

            debugDiv.innerHTML = `
                Zoom: ${zoom} | 
                Marcadores: ${markersCount} | 
                GeoJSON: ${geojsonActive ? 'ON' : 'OFF'} | 
                Códigos: ${codigosActive ? 'ON' : 'OFF'} | 
                Inmuebles: ${inmueblesActive ? 'ON' : 'OFF'} | 
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
                    if (map.hasLayer(darkOverlay)) {
                        map.removeLayer(darkOverlay);
                        console.log('Capa oscura removida del mapa');
                    }
                    button.classList.remove('geojson-active');
                    showStatusMessage('Oscurecimiento desactivado', 'info');
                    oscurecerActive = false;
                } else {
                    if (!map.hasLayer(darkOverlay)) {
                        map.addLayer(darkOverlay);
                        console.log('Capa oscura añadida al mapa');
                    }
                    button.classList.add('geojson-active');
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
                    if (map.hasLayer(satelliteLayer)) {
                        map.removeLayer(satelliteLayer);
                        console.log('Capa satelital removida del mapa');
                    }
                    button.classList.remove('geojson-active');
                    showStatusMessage('Capa satelital desactivada', 'info');
                    satelitalActive = false;
                } else {
                    if (!map.hasLayer(satelliteLayer)) {
                        map.addLayer(satelliteLayer);
                        console.log('Capa satelital añadida al mapa');
                    }
                    button.classList.add('geojson-active');
                    showStatusMessage('Capa satelital activada', 'success');
                    satelitalActive = true;
                }

                updateDebugInfo();
            } catch (error) {
                console.error('Error toggling capa satelital:', error);
                showStatusMessage('Error manipulando capa satelital', 'error');
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

                    const pulsingIcon = L.divIcon({
                        className: 'pulsing-marker',
                        html: '<div class="puntoMarca"></div>',
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

            if (clickedCoordinatesMarker) {
                map.removeLayer(clickedCoordinatesMarker);
                clickedCoordinatesMarker = null;
            }

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
                    satelitalBtn.classList.add('geojson-active');
                }

                setTimeout(() => {
                    if (markerClusterGroup && !map.hasLayer(markerClusterGroup)) {
                        map.addLayer(markerClusterGroup);
                        console.log("MarkerClusterGroup añadido al mapa");
                    }

                    loadMarkersInViewport();

                    // Habilitar clicks en el mapa para obtener coordenadas
                    /* map.on('click', handleMapClick); */

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

                    // Event listener para el nuevo botón de códigos
                    document.getElementById('codigosBtn').addEventListener('click', function() {
                        toggleCodigosLayer();
                    });
                    document.getElementById('inmueblesBtn').addEventListener('click', function() {
                        toggleInmueblesLayer();
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

        $(document).ready(function() {
            toggleDarkOverlay();
        });
    </script>
</body>

</html>