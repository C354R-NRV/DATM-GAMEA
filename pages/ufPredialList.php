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
    <title>PANEL GEOESPACIAL</title>
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


        /** estilos para botones de reporte  excel*/


        .icon {
            font-size: 1.2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: #34495e;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .form-input,
        .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e1e8ed;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .date-range {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 0.5rem;
            align-items: center;
        }

        .date-separator {
            color: #7f8c8d;
            font-weight: 500;
        }

        .swal2-confirm {
            background: linear-gradient(45deg, #27ae60, #2ecc71) !important;
            border: none !important;
            border-radius: 5% !important;
            padding: 0.75rem 2rem !important;
            font-weight: 500 !important;
            transition: all 0.3s ease !important;
        }

        .swal2-confirm:hover {
            transform: translateY(-1px) !important;
            box-shadow: 0 10px 20px rgba(46, 204, 113, 0.2) !important;
        }

        .swal2-cancel {
            background: linear-gradient(45deg, #e74c3c, #c0392b) !important;
            border: none !important;
            border-radius: 5% !important;
            padding: 0.75rem 2rem !important;
            font-weight: 500 !important;
            transition: all 0.3s ease !important;
        }

        .swal2-cancel:hover {
            transform: translateY(-1px) !important;
            box-shadow: 0 10px 20px rgba(231, 76, 60, 0.3) !important;
        }

        /* Loading spinner */
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 10px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
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
            padding: 0 0 15px 0;
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
            color: rgb(255, 255, 255);
            border-color: rgb(53, 170, 30);
            background-color: #27ae60;
        }

        .icon-refresh {
            color: rgb(255, 255, 255);
            border-color: #00bfff;
            background-color: rgb(0, 138, 184);
        }

        .icon-warning {
            color: rgb(255, 255, 255);
            border-color: #ff0033;
            background-color: #c60a04;
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

        /** estilos para botones de reporte */
    </style>
</head>

<body>
    <input type="hidden" id="inm_inicial" value="<?php echo $_GET['i']; ?>" />
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
    <li class="breadcrumb-item text-white active" aria-current="page"> <a class="text-white">UF - PANEL</a></li>
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
                    <a class="btn btn-success" href="ufdatmap.php" role="button"><i class="fa fa-map-o" aria-hidden="true"></i></a><!-- |
                    <a class="btn btn-success" onclick="generarReporteOperativo()" role="button"><i class="fa fa-file-excel-o" aria-hidden="true"></i></a> -->
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
                    <th data-field="fecha_apersonamiento" data-sortable="true">Fecha operativo</th>
                    <th data-field="grupo" data-sortable="true">Operativo</th>
                    <th data-field="usuario" data-sortable="true">usuario</th>
                    <th data-field="numero_inmueble" data-sortable="true">No Inmueble</th>
                    <th data-field="codigo_catastral" data-sortable="true">Cod. catastral</th>
                    <th data-field="no_formulario" data-sortable="true">Form.</th>
                    <th data-field="nombre_razon" data-sortable="true">Nombre</th>
                    <th data-field="actividad" data-sortable="true">Actividad</th>
                    <th data-field="estado_fiscalizacion" data-sortable="true">Estado</th>
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
    $(document).ready(function($) {
        if (typeof $('#inm_inicial').val() != "undefined" && $('#inm_inicial').val() != '') {
            verHistorialPredial($('#inm_inicial').val());
        }
    });
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

    /** generar reporte excel */

    function generarReporteOperativo() {
        Swal.fire({
            title: "Generar Reporte Operativo",
            html: `
            <div style="padding:3rem;">
            <div class="form-group" >
                <label class="form-label">📅 Rango de fechas</label>
                <div class="date-range">
                    <input type="text" id="fechaInicial" placeholder="Fecha inicial" class="form-input datepicker2">
                    <span class="date-separator">a</span>
                    <input type="text" id="fechaFinal" placeholder="Fecha final" class="form-input datepicker2">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">👥 Grupo</label>
                <select id="grupoSelect" class="form-select">
                    <option value="Todos">Todos los grupos</option>
                    <option value="G-1">Grupo 1 (G-1)</option>
                    <option value="G-2">Grupo 2 (G-2)</option>  
                    <option value="G-3">Grupo 3 (G-3)</option>
                    <option value="G-4">Grupo 4 (G-4)</option>
                </select>
            </div>
            </div>
        `,
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: "📥 Generar y Descargar",
            cancelButtonText: "❌ Cancelar",
            width: "auto",
            customClass: {
                popup: "swal-wide",
                htmlContainer: "swal-custom-html-container",
            },
            didOpen: () => {
                // Configurar Flatpickr para las fechas
                $(".datepicker2").flatpickr({
                    locale: "es",
                    dateFormat: "Y-m-d",
                    defaultDate: new Date(),
                    allowInput: true,
                    clickOpens: true,
                })

                // Establecer fecha final como hoy por defecto
                $("#fechaFinal").val(new Date().toISOString().split("T")[0])

                // Establecer fecha inicial como hace 7 días por defecto
                const fechaInicial = new Date()
                fechaInicial.setDate(fechaInicial.getDate() - 7)
                $("#fechaInicial").val(fechaInicial.toISOString().split("T")[0])
            },
            preConfirm: () => {
                const fechaInicial = document.getElementById("fechaInicial").value
                const fechaFinal = document.getElementById("fechaFinal").value
                const grupo = document.getElementById("grupoSelect").value

                // Validaciones
                if (!fechaInicial || !fechaFinal) {
                    Swal.showValidationMessage("Por favor, selecciona ambas fechas")
                    return false
                }

                if (new Date(fechaInicial) > new Date(fechaFinal)) {
                    Swal.showValidationMessage("La fecha inicial no puede ser mayor que la fecha final")
                    return false
                }

                return {
                    fechaInicial: fechaInicial,
                    fechaFinal: fechaFinal,
                    grupo: grupo,
                }
            },
        }).then((result) => {
            if (result.isConfirmed) {
                ejecutarGeneracionReporte(result.value)
            }
        })
    }

    function ejecutarGeneracionReporte(parametros) {
        // Mostrar loading
        Swal.fire({
            title: "Generando reporte...",
            html: '<div class="loading-spinner"></div>Por favor espera mientras se genera el archivo Excel',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            customClass: {
                popup: "swal-wide",
            },
        })

        // Realizar petición AJAX
        $.ajax({
            url: "../php/ufGetReporteOperativo.php",
            type: "POST",
            data: {
                fechaInicial: parametros.fechaInicial,
                fechaFinal: parametros.fechaFinal,
                grupo: parametros.grupo,
            },
            xhrFields: {
                responseType: "blob", // Importante para manejar archivos binarios
            },
            success: (data, status, xhr) => {
                // Cerrar loading
                Swal.close()

                // Crear enlace de descarga
                const blob = new Blob([data], {
                    type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                })

                const url = window.URL.createObjectURL(blob)
                const link = document.createElement("a")
                link.href = url

                // Generar nombre del archivo
                const fechaActual = new Date().toISOString().split("T")[0]
                const nombreArchivo = `Reporte_Operativo_${parametros.fechaInicial}_${parametros.fechaFinal}_${parametros.grupo}_${fechaActual}.xlsx`
                link.download = nombreArchivo

                // Descargar archivo
                document.body.appendChild(link)
                link.click()
                document.body.removeChild(link)
                window.URL.revokeObjectURL(url)

                // Mostrar mensaje de éxito
                Swal.fire({
                    icon: "success",
                    title: "¡Reporte generado!",
                    text: "El archivo Excel se ha descargado correctamente",
                    timer: 3000,
                    showConfirmButton: false,
                    customClass: {
                        popup: "swal-wide",
                    },
                })
            },
            error: (xhr, status, error) => {
                Swal.close()

                let errorMessage = "Error desconocido"

                if (xhr.responseText) {
                    try {
                        const response = JSON.parse(xhr.responseText)
                        errorMessage = response.message || response.error || errorMessage
                    } catch (e) {
                        errorMessage = xhr.responseText
                    }
                }

                Swal.fire({
                    icon: "error",
                    title: "Error al generar reporte",
                    text: errorMessage,
                    customClass: {
                        popup: "swal-wide",
                    },
                })
            },
        })
    }

    /** generar reporte excel */



    function getUfPredial() {
        let datos = {
            filtroInmueble: $('#filtroInmueble').val(),
            filtroFechaIni: $('#filtroFechaIni').val(),
            filtroFechaFin: $('#filtroFechaFin').val()
        };
        $.ajax({
            async: true,
            type: 'POST',
            data: datos,
            url: '../php/ufGetDetallePredial.php',
            beforeSend: function() {
                loadGralOn();
            },
            success: function(e) {
                console.log(e);
                loadGralOff();
                $('#tbodyItems').empty();
                dat = $.parseJSON(e);
                /* 

                // Destruir la tabla existente
                $("#tableCompendio").bootstrapTable("destroy")

                // Limpiar y llenar el tbody
                $("#tbodyItems").empty()
                $.each(dat, (index, item) => {
                    var fila = `
                <tr>
                    <td>${item.id}</td>
                    <td>${item.fecha_apersonamiento}</td>
                    <td>${item.grupo}</td>
                    <td>${item.usuario}</td>
                    <td>${item.numero_inmueble}</td>
                    <td>${item.codigo_catastral}</td>
                    <td>${item.no_formulario}</td>
                    <td>${item.nombre_razon}</td>
                    <td>${item.actividad}</td>
                    <td>${item.estado_fiscalizacion}</td>
                    <td>${item.acciones}</td>
                </tr>
                `
                    $("#tbodyItems").append(fila)
                }) 

                $("#tableCompendio").bootstrapTable() */

                // Cargar los datos directamente en Bootstrap Table
                $("#tableCompendio").bootstrapTable("load", dat)

            },
            timeout: 16000,
            error: (xhr, status, error) => {
                alert("Error: " + error)
            },
        });
    }

    function imprimirReporte(idinmueble) {
        datos = "j=" + idinmueble;
        var url_ = "../php/ufRptInmueble.php?" + datos;
        $.ajax({
            url: url_,
            type: 'HEAD',
            success: function() {
                window.open(url_, "_blank");
            },
            error: function() {
                $.confirm({
                    title: "Documento no encontrado!",
                    type: "red",
                    content: "No se ha logrado encontrar el documento solicitado, estamos trabajando en la actualización del recurso.",
                    buttons: {
                        cancel: {
                            text: "Cerrar",
                            action: function() {},
                        },
                    },
                });
            }
        });
    }

    function createInfoBlockHtmlEstado(dat) {

        let html = `
            <div class="property-card">
                <div class="card-header">
                    ${dat[0].numero_inmueble}
                </div> 
                <div class="card-body"> 
    `;

        dat.forEach(element => {

            let color_ = 'red';
            if (element.estado_fiscalizacion == 'PROCESADO')
                color_ = 'green'
            if (element.observacion == 'null' || element.observacion == null)
                element.observacion = '';
            html += `
            <div class="info-grid">         
            <div class="info-item">
                <div class="info-label">ESTADO:</div>
                <div class="info-value" style="color:${color_};"><b>${element.estado_fiscalizacion}</b></div>
            </div>
            <div class="info-item">
                <div class="info-label">FECHA DE ESTADO:</div>
                <div class="info-value">${element.fecha_estado}</div>
            </div>
            
            <div class="info-item">
                <div class="info-label">USUARIO RESP.:</div>
                <div class="info-value">${element.usuario}</div>
            </div>
            <div class="info-item">
                <div class="info-label">OBSERVACION:</div>
                <div class="info-value">${element.observacion}</div>
            </div> `;
            html += ` 
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

    function createInfoBlockHtml(dat) {

        let html = `
            <div class="property-card">
                <div class="card-header">
                    ${dat[0].numero_inmueble}
                </div> 
                <div class="card-body"> 
                    <div class="icon-buttons">
                        <i class="fa fa-check icon-check" aria-hidden="true" title="Inmueble actualizado" onclick="actualizarEstado(${dat[0].id}, '${dat[0].numero_inmueble}',1)"></i>  
                        <i class="fa fa-pencil-square-o icon-refresh" aria-hidden="true" title="Modificar inmueble" onclick="modificaInmueble(${dat[0].id}, '${dat[0].numero_inmueble}')"></i>  
                        <i class="fa fa-print  icon-refresh" aria-hidden="true" onclick="imprimirReporte(${dat[0].id})"></i>     
                        <a target="_blank" href="https://www.google.com/maps?q=${dat[0].latitud},${dat[0].longitud}"><i class="fa fa-street-view icon-refresh" aria-hidden="true"></i></a>   
                        <i class="fa fa-exclamation-triangle icon-warning" aria-hidden="true" title="Desacato a la fiscalización" onclick="actualizarEstado(${dat[0].id}, '${dat[0].numero_inmueble}', 0)"></i> 
                    </div>
    `;

        dat.forEach(element => {
            let videoAux = ((element.video) ? '<a href="' + element.video + '" class="video-link">[VIDEO]</a>' : '');
            let imagenAux1 = ((element.video) ? '<a href="' + element.video + '" class="video-link">[VIDEO]</a>' : '');
            let imagenPrincipal = (element.imagen_principal ? `<div class="photo-box"><img src="../static/ufpredial/${element.imagen_principal}" alt="${element.imagen_principal}"></div>` : '');
            let imagenAdicional = (element.imagen_adicional ? `<div class="photo-box"><img src="../static/ufpredial/${element.imagen_adicional}" alt="${element.imagen_adicional}"></div>` : '');

            html += `
            
            <div class="info-grid">                                                                                    


            <div>
            <div class="info-item">
                <div class="info-label">FECHA DE VISITA:</div>
                <div class="info-value">${element.fecha_apersonamiento} ${videoAux}</div>
            </div>
            <div class="info-item">
                <div class="info-label">No. FORMULARIO:</div>
                <div class="info-value">${element.no_formulario}</div>
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
                <div class="info-value">${element.dato_tecnico_via}</div>
            </div>
            <div class="info-item">
                <div class="info-label">SERVICIOS:</div>
                <div class="info-value">${element.dato_tecnico_servicio}</div>
            </div>
            <div class="info-item">
                <div class="info-label">NÚMERO DE PLANTAS:</div>
                <div class="info-value">${element.construccion_plantas}</div>
            </div> 

            <div class="info-item">
                <div class="info-label">DIRECCIÓN:</div>
                <div class="info-value">${element.direccion}</div>
            </div>
            <div class="info-item">
                <div class="info-label">DESCRIPCIÓN:</div>
                <div class="info-value">${element.descripcion}</div>
            </div>`;
            html += element.cant_act > 0 ? `<div class="info-item">
                <div class="info-label">CANT. ACT. ECONOMICA:</div>
                <div class="info-value">${element.cant_act}</div>
            </div>` : '';

            html += `</div>
            
            <div>
            <div class="info-item">
                <div class="info-label">USUARIO:</div>
                <div class="info-value">${element.usuario}</div>
            </div>
            <div class="info-item">
                <div class="info-label">OPERATIVO:</div>
                <div class="info-value">${element.operativo}/${element.grupo}</div>
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
                <div class="info-value">${element.dato_tecnico_tipologia}</div>
            </div>
            
            <div class="info-item">
                <div class="info-label">CONCLUIDOS:</div>
                <div class="info-value">${element.construccion_concluidas}</div>
            </div>

            <div class="info-item">
                <div class="info-label">EN CONSTRUCCION:</div>
                <div class="info-value">${element.construccion_construccion}</div>
            </div>
            
            <div class="info-item">
                <div class="info-label">CODIGO CATASTRAL:</div>
                <div class="info-value">${element.codigo_catastral}</div>
            </div>
            <div class="info-item">
                <div class="info-label">HHRR:</div>
                <div class="info-value">${element.hhrr}</div>
            </div>`;

            html += element.cant_act > 0 ? `<div class="info-item">
                <div class="info-label">ACTIVIDAD(ES):</div>
                <div class="info-value">${element.descripcion_act}</div>
            </div>` : '';
            html += `</div>
        </div>
        
        <div class="photos-container"> 
                ${imagenPrincipal} 
                ${imagenAdicional} 
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

    function modificaInmueble(id, inmueble) {

        $.confirm({
            title: "Modificación de inmueble",
            content: `Numero de inmueble actual: <b>${inmueble}</b><p>Nuevo numero:<input type="text" id="new_inmueble" placeholder="Numero inmueble" class="form-control"></p>`,
            type: "green",
            typeAnimated: true,
            columnClass: "col-md-6 col-md-offset-6 col-xs-8 col-xs-offset-8",
            buttons: {
                cancel: {
                    text: "Cerrar",
                    action: function() {},
                },
                guardar: {
                    text: "Confirmar",
                    btnClass: "btn-green",
                    action: function() {

                        datos = "&id=" + id + "&inmueble=" + inmueble + "&new_inmueble=" + $('#new_inmueble').val();


                        $.ajax({
                            async: true,
                            type: "POST",
                            dataType: "html",
                            contentType: "application/x-www-form-urlencoded",
                            url: "../php/ufUpdateNumeroInmueble.php",
                            data: datos,
                            beforeSend: function() {
                                loadGralOn();
                            },
                            success: function(e) {
                                loadGralOff();
                                dat = JSON.parse(e)
                                if (dat.success) {
                                    window.location.href = './ufPredialList.php';
                                } else {
                                    $.confirm({
                                        title: " Error",
                                        type: "red",
                                        content: dat.message,
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
                                    window.location.href = './ufPredialList.php';
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

    function verHistorialEstado(numero_inmueble) {
        $.ajax({
            async: true,
            type: 'POST',
            data: {
                numero_inmueble: numero_inmueble,
            },
            url: '../php/ufGetDetallePredialItemEstado.php',
            beforeSend: function() {
                loadGralOn();
            },
            success: function(dat) {
                loadGralOff();
                dat = JSON.parse(dat);
                const historialHtmlContent = createInfoBlockHtmlEstado(dat);
                Swal.fire({
                    html: historialHtmlContent,
                    showCloseButton: true,
                    showConfirmButton: false,
                    width: "auto",
                    customClass: {
                        popup: "swal-wide",
                        htmlContainer: "swal-custom-html-container",
                    },
                });
            },
            timeout: 16000,
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    }

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

    function showImage(imageSrc) {
        $('#image-viewer-popup').remove();
        const $popup = $('<div id="image-viewer-popup"></div>');
        const $closeButton = $('<span id="image-viewer-close">×</span>');
        const $image = $('<img>').attr('src', imageSrc).attr('alt', 'Imagen Ampliada');
        $popup.append($closeButton).append($image);
        $('body').append($popup);
        setTimeout(() => {
            $popup.addClass('show');
        }, 10);
        $closeButton.on('click', function() {
            closeImageViewer();
        });
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
            setTimeout(() => {
                $popup.remove();
            }, 300);
            $(document).off('keydown.imageViewer');
        }
    }
</script>

</html>