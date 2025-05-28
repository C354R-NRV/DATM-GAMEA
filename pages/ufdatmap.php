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

        @media (max-width: 1024px) and (min-width: 768px) {
            .search-container {
                min-width: 250px;
                padding: 8px;
            }

            .search-input {
                font-size: 0.8rem;
                padding: 7px 30px 7px 10px;
            }

            .control-button {
                width: 36px;
                height: 36px;
                font-size: 1.1rem;
                border-radius: 3px;
            }

            .search-results {
                font-size: 0.7rem;
            }
        }

        @media (max-width: 767px) and (min-width: 481px) {
            .search-container {
                min-width: 200px;
                max-width: calc(100vw - 70px);
                padding: 6px;
                top: 8px;
                left: 8px;
            }

            .search-input {
                font-size: 0.75rem;
                padding: 6px 28px 6px 8px;
            }

            .search-input::placeholder {
                font-size: 0.75rem;
            }

            .control-button {
                width: 32px;
                height: 32px;
                font-size: 1rem;
                border-radius: 3px;
            }

            .map-controls {
                top: 8px;
                right: 8px;
                gap: 3px;
            }

            .search-results {
                font-size: 0.65rem;
                flex-direction: column;
                gap: 2px;
                align-items: flex-start;
            }

            .show-all-btn {
                font-size: 0.65rem;
            }

            .clear-search {
                width: 18px;
                height: 18px;
                font-size: 1rem;
            }

            .status-message {
                font-size: 0.75rem;
                padding: 6px 10px;
                top: 8px;
            }
        }

        @media (max-width: 480px) {
            .search-container {
                min-width: 160px;
                max-width: calc(100vw - 60px);
                padding: 5px;
                top: 5px;
                left: 5px;
            }

            .search-input {
                font-size: 0.7rem;
                padding: 5px 25px 5px 6px;
            }

            .search-input::placeholder {
                font-size: 0.7rem;
            }

            .control-button {
                width: 28px;
                height: 28px;
                font-size: 0.9rem;
                border-radius: 2px;
            }

            .map-controls {
                top: 5px;
                right: 5px;
                gap: 2px;
            }

            .search-results {
                font-size: 0.6rem;
                flex-direction: column;
                gap: 1px;
                align-items: flex-start;
                margin-bottom: 2px;
            }

            .show-all-btn {
                font-size: 0.6rem;
            }

            .clear-search {
                width: 16px;
                height: 16px;
                font-size: 0.9rem;
                right: 6px;
            }

            .status-message {
                font-size: 0.7rem;
                padding: 5px 8px;
                top: 5px;
                max-width: calc(100vw - 20px);
            }
        }

        @media (max-width: 320px) {
            .search-container {
                min-width: 140px;
                max-width: calc(100vw - 50px);
                padding: 4px;
            }

            .search-input {
                font-size: 0.65rem;
                padding: 4px 22px 4px 5px;
            }

            .control-button {
                width: 24px;
                height: 24px;
                font-size: 0.8rem;
                border-radius: 2px;
            }

            .search-results {
                font-size: 0.55rem;
            }

            .show-all-btn {
                font-size: 0.55rem;
            }

            .clear-search {
                width: 14px;
                height: 14px;
                font-size: 0.8rem;
            }
        }

        @media (min-width: 1025px) {
            header .container {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .logo {
                margin-bottom: 0;
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
            background-color: rgba(226, 140, 140, 0.6) !important;

        }

        .marker-cluster-small div {
            background-color: rgba(255, 49, 49, 0.6) !important;
            animation: pulseAnimation 2.8s infinite ease-in-out;
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
            color: #0f6c91;
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
                            placeholder="Buscar inmuebles, contribuyentes o tipos..."
                            aria-label="Buscar inmuebles, contribuyentes o tipos">
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
                    <button id="homeBtn" class="control-button" title="Inicio" aria-label="Volver"><i class="fa fa-home" aria-hidden="true"></i></button>
                </div>
                <div id="statusMessage" class="status-message" role="alert"></div>
            </div>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

    <script>
        const dateOptions = {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric'
        };
        const map = L.map('map', {
            zoomControl: false,
            maxZoom: 20
        }).setView([-16.5, -68.175], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 20
        }).addTo(map);

        let userLocationMarker = null;
        let initialMarkerData = [];
        let allLeafletMarkers = [];
        let markerClusterGroup;

        function initializeMarkers() {
            if (!window.map) return;

            // Eliminar grupo de clúster anterior si existe
            if (markerClusterGroup) {
                map.removeLayer(markerClusterGroup);
            }

            // Crear nuevo grupo de clúster
            markerClusterGroup = L.markerClusterGroup({
                // Puedes personalizar estas opciones si lo necesitas
                // maxClusterRadius: 80,
                // disableClusteringAtZoom: 18
            });

            // Crear y almacenar marcadores con popup y originalData
            allLeafletMarkers = initialMarkerData.map((item, index) => {
                const marker = L.marker(item.position).bindPopup(item.html);

                // AQUÍ ESTÁ LA CORRECCIÓN: Asignar originalData con todos los datos del item
                marker.originalData = {
                    title: item.title || '',
                    nombre_razon: item.nombre_razon || '',
                    codigo_catastral: item.codigo_catastral || '',
                    description: item.description || '',
                    type: item.type || '',
                    position: item.position,
                    html: item.html
                };

                console.log("Marker creado con originalData:", marker.originalData);
                return marker;
            });
            console.log("allLeafletMarkers:" + allLeafletMarkers);

            markerClusterGroup.addLayers(allLeafletMarkers);

            map.addLayer(markerClusterGroup);
        }

        function filterMarkers(searchTerm) {
            const term = searchTerm.toLowerCase().trim();
            console.log("Filtramos para:", term);
            let visibleCount = 0;

            if (!markerClusterGroup || !allLeafletMarkers) return;

            markerClusterGroup.clearLayers();

            const filteredLeafletMarkers = [];

            allLeafletMarkers.forEach(marker => {
                const data = marker.originalData || {};
                console.log("Datos del marker para filtrar:", data);

                const title = String(data.title || '').toLowerCase();
                const nombre = String(data.nombre_razon || '').toLowerCase();
                const codigo = String(data.codigo_catastral || '').toLowerCase();

                const matchesSearch = term === '' || title.includes(term) || nombre.includes(term) || codigo.includes(term);
                console.log("matchesSearch:" + matchesSearch);
                if (matchesSearch) {

                    filteredLeafletMarkers.push(marker);
                    visibleCount++;
                }
            });

            markerClusterGroup.addLayers(filteredLeafletMarkers);
            updateResultsCount(visibleCount, initialMarkerData.length);
        }

        function showAllMarkers() {
            if (!markerClusterGroup) return; // Guard
            markerClusterGroup.clearLayers();
            markerClusterGroup.addLayers(allLeafletMarkers);
            updateResultsCount(allLeafletMarkers.length, initialMarkerData.length);
        }

        function updateResultsCount(count, total) {
            const resultsElement = document.getElementById('resultsCount');
            if (total === undefined) total = initialMarkerData.length;

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
                const allMarkersGroup = L.featureGroup(allLeafletMarkers);
                if (allMarkersGroup.getLayers().length > 0) {
                    map.fitBounds(allMarkersGroup.getBounds().pad(0.1));
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
            }, 3000);
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

        // Functions for custom zoom controls
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
            showStatusMessage('Cargando datos del mapa...', 'info');

            fetch('../php/ufPuntosGet.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (Array.isArray(data)) {
                        initialMarkerData = data;
                        showStatusMessage('Datos cargados correctamente.', 'success');
                    } else {
                        console.error("Data received is not an array:", data);
                        initialMarkerData = [];
                        showStatusMessage('Error: Formato de datos incorrecto.', 'error');
                    }

                    // Crear y agregar marcadores al mapa
                    initializeMarkers();

                    // Actualizar conteo de resultados
                    updateResultsCount(initialMarkerData.length, initialMarkerData.length);
                })
                .catch(error => {
                    console.error("Error al obtener los datos del mapa:", error);
                    showStatusMessage('Error al cargar los datos del mapa. Verifique la consola.', 'error');
                    initialMarkerData = [];
                    initializeMarkers();
                    updateResultsCount(0, 0);
                })
                .finally(() => {
                    const searchInput = document.getElementById('searchInput');
                    const clearButton = document.getElementById('clearSearch');
                    const showAllButton = document.getElementById('showAllBtn');

                    searchInput.addEventListener('input', function(e) {
                        filterMarkers(e.target.value);
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

                    searchInput.addEventListener('keypress', function(e) {
                        if (e.key === 'Enter') {
                            filterMarkers(e.target.value);
                            setTimeout(() => {
                                fitMapToVisibleMarkers();
                            }, 100);
                        }
                    });
                });
        }

        // Initialize when the DOM is ready
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