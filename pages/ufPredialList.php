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
    <title>CITES</title>
    <?php
    echo $twig->render('linkStyle.twig');
    ?>
    <link href="../css/styleRecursoIa.css" rel="stylesheet">
    <link href="../vendor/bootstrap-table-master/dist/bootstrap-table.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .containerDetalleSolicitud {
            width: 98%;

            margin: auto;
            /* border: 1px solid #000; */
            border-radius: 10px;
            padding: 1rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .headerDetalleSolicitud {
            display: flex;
            justify-content: space-between;
            border: 1px solid #fff;
            /* padding: 10px; */
            /* margin-bottom: 20px; */
            border-radius: 5px;
        }

        .headerDetalleSolicitud p {
            margin: 5px 0;
        }

        .show-btn3 {
            position: absolute;
            /* Ajusta la distancia desde la parte superior */
            top: 9.5rem;
            right: -3px;
            /* Ajusta la distancia desde la parte derecha */
            background-color: #020e10;
            /* Color de fondo del botón */
            color: white;
            /* Color del texto del botón */
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .chat-message2 {
            margin-bottom: 10px;
            /* color: rgb(23, 83, 129); */
            color: rgb(0, 5, 8);
        }

        .text-end2 {
            color: rgb(27, 95, 64);
            text-align: right;
            font-size: 13px;
        }

        #sendMessageIa:hover i {
            color: rgb(17, 71, 47);
        }

        #chat-box h1 {
            /* color: rgb(56, 94, 143); */
            color: rgb(0, 5, 8);
            font-weight: bold;
            font-size: 1.2rem;

        }



        .thinking {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            color: #0f4562;
        }

        .thinking-dots {
            display: flex;
            color: #0f4562;
        }

        .thinking-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #000;
            margin: 0 3px;
            opacity: 0;
            animation: pulse 1.5s infinite;
            color: #0f4562;
        }

        .thinking-dot:nth-child(2) {
            animation-delay: 0.5s;
        }

        .thinking-dot:nth-child(3) {
            animation-delay: 1s;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 0;
            }

            50% {
                opacity: 1;
            }
        }




        :root {
            --primary-color: #3f8dad;
            --secondary-color: #f8f9fa;
            --border-color: #e0e0e0;
            --text-color: #333;
            --accent-color: #5c8db8;
        }  

        .property-card {
            max-width: 100%;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            padding: 15px 20px;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 0.5px;
            border-radius: 12px 12px 0 0;
            text-align: center;
        }

        .card-body {
            padding: 20px;
            text-align: left;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        .info-item {
            display: flex;
            margin-bottom: 8px;
        }

        .info-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--primary-color);
            width: 140px;
            flex-shrink: 0;
        }

        .info-value {
            font-size: 14px;
            color: var(--text-color);
            flex-grow: 1;
        }

        .video-link {
            color: var(--accent-color);
            text-decoration: none;
            margin-left: 10px;
            font-size: 12px;
            font-weight: 600;
        }

        .video-link:hover {
            text-decoration: underline;
        }

        /* Estilos para el visor de imágenes */

        .photos-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin: 20px 0;
        }

        .photo-box {
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
            height: 200px;
            position: relative;
            cursor: pointer;
        }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .photo-box:hover img {
            transform: scale(1.05);
        }

        .divider {
            height: 1px;
            background-color: #ddd;
            margin: 20px 0;
        }

        .video-link {
            color: #3498db;
            text-decoration: none;
            margin-left: 5px;
        }

        .video-link:hover {
            text-decoration: underline;
        }

        /* Estilos para SweetAlert */
        .swal-wide {
            max-width: 900px !important;
            width: 90% !important;
        }

        .swal-custom-html-container {
            padding: 0 !important;
        }

        /* Estilos para el visor de imágenes */
        .zoom-hint {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .photo-box:hover .zoom-hint {
            opacity: 1;
        }

        .image-viewer-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10000;
            opacity: 0;
            transition: opacity 0.3s;
            pointer-events: none;
        }

        .image-viewer-overlay.active {
            opacity: 1;
            pointer-events: all;
        }

        .image-viewer-content {
            position: relative;
            max-width: 90%;
            max-height: 90%;
        }

        .image-viewer-content img {
            max-width: 100%;
            max-height: 90vh;
            display: block;
            margin: 0 auto;
        }

        .image-viewer-close {
            position: absolute;
            top: -40px;
            right: 0;
            color: white;
            background: transparent;
            border: none;
            font-size: 24px;
            cursor: pointer;
        }

        .image-viewer-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            background: rgba(0, 0, 0, 0.5);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .image-viewer-prev {
            left: 10px;
        }

        .image-viewer-next {
            right: 10px;
        }

        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }

            .photos-container {
                grid-template-columns: 1fr;
            }
        }



        #image-viewer-popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.85);
            /* Fondo oscuro semitransparente */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10000;
            /* Asegúrate de que esté por encima de SweetAlert */
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        #image-viewer-popup.show {
            opacity: 1;
            visibility: visible;
        }

        #image-viewer-popup img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            /* Mantiene la relación de aspecto sin recortar */
            border: 3px solid white;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.5);
        }

        #image-viewer-close {
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 30px;
            color: white;
            cursor: pointer;
            font-weight: bold;
            text-shadow: 0 0 5px black;
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
    <li class="breadcrumb-item text-white active" aria-current="page"> <a class="text-white">UF PREDIAL</a></li>
    <?php
    echo $twig->render('prebodyltFin.twig');
    ?>
    <!-- Hero End -->
    <!-- About Start -->
    <div class="contenedorDigitaliza">
        <div class="form-group d-flex flex-column flex-md-row">
            <div class="row">
                <div class="col-md-2 mb-3">
                    <a class="btn btn-success" href="ufPredial.php" role="button"><i class="fa fa-plus"></i></a> | 
                    <a class="btn btn-success" href="ufdatmap.php" role="button"><i class="fa fa-map-o" aria-hidden="true"></i></a>
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control" value="" id="filtroInmueble" placeholder="Numero inmueble">
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control datepicker" value="" id="filtroFechaIni" placeholder="Fecha ini">
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control datepicker" value="" id="filtroFechaFin" placeholder="Fecha fin">
                </div>

                <div class="col-md-1 mb-3">
                    <button class="btn btn-primary" onclick="getUfPredial()">consultar</button>
                </div>
            </div>
        </div>

        <hr>
        <div>
            <table id="tableCompendio"
                data-toggle="table"
                data-search="true"
                data-show-toggle="true"
                data-show-fullscreen="true"
                data-show-columns="true"
                data-show-columns-toggle-all="true"
                data-show-export="true"
                data-export-types='["csv","excel"]'
                data-click-to-select="true"
                data-pagination="true"
                data-page-list="[10, 25, 50, 100, all]"
                data-locale="es-ES"
                class="table table-striped"
                data-sort-name="id"
                data-sort-order="desc"
                data-show-refresh="true"
                data-url="../php/ufGetDetallePredial.php"
                data-query-params="filtrosDataTable">
                <thead>
                    <th data-field="id" data-sortable="true">Id</th>
                    <th data-field="numero_inmueble" data-sortable="true">No Inmueble</th>
                    <th data-field="codigo_catastral" data-sortable="true">Cod. catastral</th>
                    <th data-field="nombre_razon" data-sortable="true">Nombre</th>
                    <th data-field="fecha_apersonamiento" data-sortable="true">Ultima visita</th>
                    <th data-field="acciones">Acciones</th>
                </thead>
                <tbody id="tbodyItems">
                </tbody>
            </table>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF/jspdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $(".datepicker").flatpickr();

    function filtrosDataTable(p) {
        console.log("en filtrosDataTable");
        return {
            filtroInmueble: $('#filtroInmueble').val(),
            filtroFechaIni: $('#filtroFechaIni').val(),
            filtroFechaFin: $('#filtroFechaFin').val(),
            offset: p.offset,
            limit: p.limit,
            sort: p.sort,
            order: p.order,
            search: p.search
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        var toastrMessage = localStorage.getItem('toastrMessage');
        if (toastrMessage) {
            toastr["success"](toastrMessage);
            localStorage.removeItem('toastrMessage');
        }
    });


    function getUfPredial() {
        $.ajax({
            async: true,
            type: 'POST',
            data: {
                filtroCodigoSolicitud: $('#filtroCodigoSolicitud').val(),
                filtroFechaIni: $('#filtroFechaIni').val(),
                filtroFechaFin: $('#filtroFechaFin').val()
            },
            url: '../php/ufGetDetallePredial.php',
            beforeSend: function() {
                loadGralOn();
            },
            success: function(dat) {
                loadGralOff();
                $('#tbodyItems').empty();
                dat = $.parseJSON(dat);
                $.each(dat, function(index, item) {
                    var fila = `
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.numero_inmueble}</td>
                        <td>${item.codigo_catastral}</td>
                        <td>${item.nombre_razon}</td> 
                        <td>${item.fecha_apersonamiento}</td> 
                        <td>${item.acciones}</td> 
                    </tr>
                `;
                    $('#tbodyItems').append(fila);
                });
                $('#tableCompendio').bootstrapTable('refresh');
            },
            timeout: 16000,
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    }



    function createInfoBlockHtml(dat) {

        let html = `
                    <div class="property-card">
                        <div class="card-header">
                            HISTORIAL DE INMUEBLE ${dat[0].numero_inmueble}
                        </div> 
                        <div class="card-body">
    `;

        dat.forEach(element => {
            let videoAux = ((element.video) ? '<a href="' + element.video + '" class="video-link">[VIDEO]</a>' : '');
            let imagenAux1 = ((element.video) ? '<a href="' + element.video + '" class="video-link">[VIDEO]</a>' : '');
            let imagenPrincipal = (element.imagen_principal ? `<img src="../static/ufpredial/${element.imagen_principal}" alt="${element.imagen_principal}">` : '');
            let imagenAdicional = (element.imagen_adicional ? `<img src="../static/ufpredial/${element.imagen_adicional}" alt="${element.imagen_adicional}">` : '');

            html += `<div class="info-grid">                                                                                    
            <div>
            <div class="info-item">
                <div class="info-label">FECHA DE VISITA:</div>
                <div class="info-value">${element.fecha_apersonamiento} ${videoAux}</div>
            </div>
            <div class="info-item">
                <div class="info-label">NOMBRE DE TITULAR:</div>
                <div class="info-value">${element.nombre_razon}</div>
            </div>
            <div class="info-item">
                <div class="info-label">NOMBRE APODERADO:</div>
                <div class="info-value">${element.nombre_apoderado}</div>
            </div>
            <div class="info-item">
                <div class="info-label">MATERIAL VÍA:</div>
                <div class="info-value">${element.via}</div>
            </div>

            <div class="info-item">
                <div class="info-label">NÚMERO DE PLANTAS:</div>
                <div class="info-value">${element.no_plantas}</div>
            </div>
            
            <div class="info-item">
                <div class="info-label">SERVICIOS:</div>
                <div class="info-value">${element.servicios}</div>
            </div>
   
            <div class="info-item">
                <div class="info-label">DIRECCIÓN:</div>
                <div class="info-value">${element.ubicacion_nivel1} ${element.ubicacion_nivel2} ${element.ubicacion_nivel3} ${element.no_puerta}</div>
            </div>
            <div class="info-item">
                <div class="info-label">DESCRIPCIÓN:</div>
                <div class="info-value">${element.descripcion}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Nº FORM:</div>
                <div class="info-value">${element.no_formulario}</div>
            </div>
            </div>
            
            <div>
            <div class="info-item">
                <div class="info-label">USUARIO:</div>
                <div class="info-value">${element.usuario}</div>
            </div>
            <div class="info-item">
                <div class="info-label">CONTACTO TITULAR:</div>
                <div class="info-value">${element.contacto_titular}</div>
            </div>
            <div class="info-item">
                <div class="info-label">CONTACTO APO.:</div>
                <div class="info-value">${element.contacto_apoderado}</div>
            </div>
            <div class="info-item">
                <div class="info-label">TIPOLOGÍA:</div>
                <div class="info-value">${element.tipologia}</div>
            </div>
            
            <div class="info-item">
                <div class="info-label">CONCLUIDOS:</div>
                <div class="info-value">${element.no_concluidos}</div>
            </div>

            <div class="info-item">
                <div class="info-label">EN CONSTRUCCION:</div>
                <div class="info-value">${element.no_brutos}</div>
            </div>
            <div class="info-item">
                <div class="info-label">HHRR:</div>
                <div class="info-value">${element.hhrr}</div>
            </div>
            </div>
        </div>
        
        <div class="photos-container">
            <div class="photo-box">
                ${imagenPrincipal}
            </div>
            <div class="photo-box"> 
                ${imagenAdicional}
            </div>
        </div>
        
        <div class="divider"></div> 
    `;
        });
        html += `

                        </div>
                    </div>
                `;


        return html;
    }

    // Función para mostrar el historial predial
    function verHistorialPredial(numero_inmueble) {

        $.ajax({
            async: true,
            type: 'POST',
            data: {
                numero_inmueble: numero_inmueble,
            },
            url: '../php/ufGetDetallePredialItem.php',
            beforeSend: function() {
                loadGralOn();
            },
            success: function(dat) {
                loadGralOff();
                dat = JSON.parse(dat);
                const historialHtmlContent = createInfoBlockHtml(dat);
                Swal.fire({
                    html: historialHtmlContent,
                    showCloseButton: true,
                    showConfirmButton: false,
                    width: "auto",
                    customClass: {
                        popup: "swal-wide",
                        htmlContainer: "swal-custom-html-container",
                    },
                    didOpen: () => {
                        $(".photo-box").each(function() {
                            $(this).append('<div class="zoom-hint">Click para ampliar</div>');
                        });
                        $(Swal.getHtmlContainer()).on("click", ".photo-box img", function() {
                            showImage($(this).attr('src'));
                        });
                    },
                });


            },
            timeout: 16000,
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    }

    // Función para crear y mostrar el visor de imágenes
    function showImage(imageSrc) {
        // Si ya existe un popup, lo eliminamos para evitar duplicados
        $('#image-viewer-popup').remove();

        // Crear los elementos del popup
        const $popup = $('<div id="image-viewer-popup"></div>');
        const $closeButton = $('<span id="image-viewer-close">×</span>');
        const $image = $('<img>').attr('src', imageSrc).attr('alt', 'Imagen Ampliada');

        // Ensamblar el popup
        $popup.append($closeButton).append($image);

        // Añadir el popup al body
        $('body').append($popup);

        // Mostrar el popup con una transición (requiere la clase .show y CSS)
        // Usamos un pequeño timeout para asegurar que el navegador aplique la transición
        setTimeout(() => {
            $popup.addClass('show');
        }, 10); // Un pequeño delay es suficiente

        // Evento para cerrar el popup
        $closeButton.on('click', function() {
            closeImageViewer();
        });

        // Opcional: Cerrar con la tecla Escape
        $(document).on('keydown.imageViewer', function(e) {
            if (e.key === "Escape") {
                closeImageViewer();
            }
        });
    }

    function closeImageViewer() {
        const $popup = $('#image-viewer-popup');
        if ($popup.length) {
            $popup.removeClass('show');
            // Esperar a que termine la transición antes de eliminar el elemento
            setTimeout(() => {
                $popup.remove();
            }, 300); // Debe coincidir con la duración de la transición en CSS
            $(document).off('keydown.imageViewer'); // Remover el listener de la tecla Escape
        }
    }
</script>

</html>