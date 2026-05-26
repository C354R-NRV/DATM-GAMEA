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
    <title>SIREFO</title>
    <?php
    echo $twig->render('linkStyle.twig');
    ?>
    <link href="../css/styleRecursoIa.css" rel="stylesheet">
    <link href="../vendor/bootstrap-table-master/dist/bootstrap-table.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        body {
            margin: 0;
            background-color: #eee;
            background-image: url("../img/backgroundlogin3.jpg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            height: 100vh;
            overflow: hidden;
        }

        .overlay {
            background-color: rgba(255, 255, 255, 0.4);
            width: 100vw;
            height: 100vh;
            position: absolute;
        }

        .card {
            backdrop-filter: blur(5px);
            min-width: 25vh;
            height: 35vh;
            box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.051),
                0px 0px 7.2px rgba(0, 0, 0, 0.073), 0px 0px 13.6px rgba(0, 0, 0, 0.09),
                0px 0px 24.3px rgba(0, 0, 0, 0.107), 0px 0px 45.5px rgba(0, 0, 0, 0.129),
                0px 0px 109px rgba(0, 0, 0, 0.18);
            padding: 0.9rem;
            cursor: pointer;
        }

        .card i {
            text-align: center;
            font-size: 7rem;
            color: rgb(30, 65, 87, 0.8);
            padding: 1rem;
        }

        .card p {
            text-align: center;
            color: rgb(30, 65, 87);
            padding: 1rem;
        }

        .card:hover {
            font-weight: bold;
        }

        .glare-container {
            width: 100%;
            height: 100%;
            overflow: hidden;
            position: relative;
        }

        .glare {
            position: absolute;
            left: 100%;
            bottom: -50%;
            width: 150%;
            height: 150%;
            background: rgb(255, 255, 255);
            background: linear-gradient(90deg,
                    rgba(255, 255, 255, 0.18) 0%,
                    rgba(255, 255, 255, 0) 20%);
            transform: rotateZ(35deg);
            pointer-events: none;
            filter: blur(4px);
        }

        .card-0 {
            background-color: rgba(131, 184, 212, 0.3);
        }

        .card-1 {
            background-color: rgba(229, 255, 209, 0.37);
        }

        .card-2 {
            background-color: rgba(131, 184, 212, 0.3);
        }

        .card-3 {
            background-color: rgba(229, 255, 209, 0.37);
        }

        .card-4 {
            background-color: rgba(131, 184, 212, 0.3);
        }

        .card-5 {
            background-color: rgba(209, 255, 224, 0.37);
        }

        .card-6 {
            background-color: rgba(131, 184, 212, 0.3);
        }

        .card-7 {
            background-color: rgba(209, 255, 224, 0.37);
        }

        .wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            justify-items: center;
            align-items: center;
            height: 85vh;
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
    <li class="breadcrumb-item"><a class="text-white">UAJ</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page"> <a class="text-white" href="sirefoList.php">SIREFO</a></li>
    <?php
    echo $twig->render('prebodyltFin.twig');
    ?>
    <!-- About Start -->
    <div>

        <div class="overlay">
        </div>

        <div class="wrapper">
            <div class="card card-0">
                <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                <hr>
                <p>Remitir Solicitud</p>
                <div class="glare-container">
                    <div class="glare">
                    </div>
                </div>
            </div>

            <div class="card card-1">
            <i class="fa fa-refresh" aria-hidden="true"></i>
                <hr>
                <p>Consulta cabecera</p>
                <div class="glare-container">
                    <div class="glare">
                    </div>
                </div>
            </div>

            <div class="card card-2">
                <i class="fa fa-money" aria-hidden="true"></i>
                <hr>
                <p>Remitir Remisión Fondos</p>
                <div class="glare-container">
                    <div class="glare">
                    </div>
                </div>
            </div>

            <div class="card card-3">
                <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                <hr>
                <p>Remitir Confirmación Entidad</p>
                <div class="glare-container">
                    <div class="glare">
                    </div>
                </div>
            </div>

            <div class="card card-4">
                <i class="fa fa-university" aria-hidden="true"></i>
                <hr>
                <p>Consulta entidad vigente</p>
                <div class="glare-container">
                    <div class="glare">
                    </div>
                </div>
            </div>

            <div class="card card-5">
                <i class="fa fa-question-circle" aria-hidden="true"></i>
                <hr>
                <p>Consultar Estado Envío</p>
                <div class="glare-container">
                    <div class="glare">
                    </div>
                </div>
            </div>

            <div class="card card-6">
                <i class="fa fa-list-ol" aria-hidden="true"></i>
                <hr>
                <p>Consultar Lista Estado Envío</p>
                <div class="glare-container">
                    <div class="glare">
                    </div>
                </div>
            </div>

            <div class="card card-7">
                <i class="fa fa-plug" aria-hidden="true"></i>
                <hr>
                <p>Verifica conexión</p>
                <div class="glare-container">
                    <div class="glare">
                    </div>
                </div>
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
<script src="../js/mainRecursoIa.js"></script>
<script src="../vendor/bootstrap-table-master/dist/bootstrap-table.min.js"></script>
<script src="../vendor/bootstrap-table-master/dist/extensions/export/bootstrap-table-export.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF/jspdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    var limits = 15.0;



    $(".card").mousemove(function(e) {
        var rect = e.target.getBoundingClientRect();
        var x = e.clientX - rect.left;
        var y = e.clientY - rect.top;
        var offsetX = x / rect.width;
        var offsetY = y / rect.height;

        var rotateY = (offsetX) * (limits * 2) - limits;
        var rotateX = (offsetY) * (limits * 2) - limits;

        var shadowOffsetX = (offsetX) * 32 - 16;
        var shadowOffsetY = (offsetY) * 32 - 16;

        $(this).css({
            "box-shadow": (1 / 6) * -shadowOffsetX + "px " + (1 / 6) * -shadowOffsetY + "px 3px rgba(0, 0, 0, 0.051), " +
                (2 / 6) * -shadowOffsetX + "px " + (2 / 6) * -shadowOffsetY + "px 7.2px rgba(0, 0, 0, 0.073), " +
                (3 / 6) * -shadowOffsetX + "px " + (3 / 6) * -shadowOffsetY + "px 13.6px rgba(0, 0, 0, 0.09), " +
                (4 / 6) * -shadowOffsetX + "px " + (4 / 6) * -shadowOffsetY + "px 24.3px rgba(0, 0, 0, 0.107), " +
                (5 / 6) * -shadowOffsetX + "px " + (5 / 6) * -shadowOffsetY + "px 45.5px rgba(0, 0, 0, 0.129), " +
                -shadowOffsetX + "px " + -shadowOffsetY + "px 109px rgba(0, 0, 0, 0.18)",
            transform: "perspective(1000px) rotateX(" + -rotateX + "deg) rotateY(" + rotateY + "deg)"
        });

        var glarePos = rotateX + rotateY + 90;
        $(this)
            .children()
            .children()
            .css("left", glarePos + "%");
    });

    $(".card").mouseleave(function(e) {
        $(".card").css({
            "box-shadow": "0px 0px 3px rgba(0, 0, 0, 0.051), 0px 0px 7.2px rgba(0, 0, 0, 0.073), 0px 0px 13.6px rgba(0, 0, 0, 0.09), 0px 0px 24.3px rgba(0, 0, 0, 0.107), 0px 0px 45.5px rgba(0, 0, 0, 0.129), 0px 0px 109px rgba(0, 0, 0, 0.18)",
            "transform": "scale(1.0)"
        });
        $(".glare").css("left", "100%");
    });

    $('.card-0').click(function() {
        window.location.href = './sirefoList.php';
    }); 
    $('.card-5').click(function() {
        window.location.href = './sirefoList.php';
    });

    $('.card-1').click(function() {
        $.ajax({
            async: true,
            type: "GET",
            dataType: "json",
            url: "../php/preapi.php",
            data: {
                endpoint: 'consultaCabecera'
            },
            beforeSend: function() {
                loadGralOn();
            },
            success: function(data) {
                loadGralOff();
                auxData = data.message;
                auxTitle = 'Atención...';
                if (data.success) {
                    auxTitle = 'SIREFO - CONSULTA CABECERA';
                    auxData = displayAsTable(data.message);
                }
                $.confirm({
                    title: auxTitle,
                    content: auxData,
                    type: data.type,
                    typeAnimated: true,
                    columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
                    buttons: {
                        cancel: {
                            text: "Cerrar",
                            action: function() {},
                        },
                    },
                    onOpenBefore: function() {
                        $('.jconfirm-title-c').css('text-align', 'center');
                    }
                });
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
    });

    $('.card-6').click(function() {

        //SOLICITAMOS FECHA DE REPORTE DESDE DONDE PEDIR INFORMACION AL SIREFO


        // $(".datepicker").flatpickr();

        $.confirm({
            title: "<div style='width:98%;text-align:center;'>Consulta de estado de solicitudes</div>",
            type: "green",
            typeAnimated: true,
            columnClass: "col-md-10 col-md-offset-10 col-xs-8 col-xs-offset-8",
            content: `       
                        <input type="text" class="form-control datepicker flatpickr-input active" value="" id="fecha_" placeholder="Fecha de consulta" readonly="readonly">
                    
            `,
            onContentReady: function() {
                $(".datepicker").flatpickr({
                    dateFormat: "Y-m-d",
                    appendTo: document.body,
                    static: false,
                    position: 'auto',
                    onReady: function(selectedDates, dateStr, instance) {
                        // Añadir clase personalizada al contenedor del calendario
                        instance.calendarContainer.classList.add('high-z-calendar');

                        // Asegurar que el calendario esté fuera del contenedor de jquery-confirm
                        document.body.appendChild(instance.calendarContainer);

                        // Asegurar que el calendario tenga posición fija
                        instance.calendarContainer.style.position = 'fixed';
                    }
                });

                // Añadir estilos necesarios
                const style = document.createElement('style');
                style.textContent = `
                    .jconfirm-content {
                        overflow: visible !important;
                    }
                    .high-z-calendar {
                        z-index: 99999999 !important;
                        position: fixed !important;
                    }
                    .flatpickr-calendar {
                        z-index: 99999999 !important;
                    }
                    .flatpickr-calendar.open {
                        display: inline-block !important;
                        z-index: 99999999 !important;
                        overflow: visible !important;
                    } 
                    /* Asegurar que el calendario no sea cortado */
                    .flatpickr-calendar.arrowTop:before,
                    .flatpickr-calendar.arrowTop:after {
                        display: none;
                    }
                `;
                document.head.appendChild(style);
            },
            buttons: {
                copiar: {
                    text: "Consultar",
                    btnClass: "btn-green",
                    action: function() {
                        $.ajax({
                            async: true,
                            type: "GET",
                            dataType: "json",
                            url: "../php/preapi.php",
                            data: {
                                endpoint: 'consultarListadoEstadoEnvio',
                                fecha_: ($('#fecha_').val()).replace(/-/g, "") 
                            },
                            beforeSend: function() {
                                console.log("fecha_:"+($('#fecha_').val()).replace(/-/g, "") );
                                loadGralOn();
                            },
                            success: function(data) {
                                console.log(data);
                                loadGralOff();
                                auxData = data.message;
                                auxTitle = 'Atención...';
                                if (data.success) {
                                    auxTitle = 'SIREFO - ESTADO DE SOLICITUDES ENVIADAS';
                                    auxData = displayAsTable(data.message);
                                }
                                $.confirm({
                                    title: auxTitle,
                                    content: auxData,
                                    type: data.type,
                                    typeAnimated: true,
                                    columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
                                    buttons: {
                                        cancel: {
                                            text: "Cerrar",
                                            action: function() {},
                                        },
                                    },
                                    onOpenBefore: function() {
                                        $('.jconfirm-title-c').css('text-align', 'center');
                                    }
                                });
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

                    },
                },
                cancel: {
                    text: "Cerrar",
                    action: function() {},
                },
            },
            onOpenBefore: function() {
                $('.jconfirm-title-c').css('text-align', 'center');
            }
        });






    });
    $('.card-4').click(function() {
        console.log("aca estamos en card4");
        $.ajax({
            async: true,
            type: "GET",
            dataType: "json",
            url: "../php/preapi.php",
            data: {
                endpoint: 'consultaEntidadVigente'
            },
            beforeSend: function() {
                loadGralOn();
            },
            success: function(data) {
                console.log(data);
                loadGralOff();
                auxData = data.message;
                auxTitle = 'Atención...';
                if (data.success) {
                    auxTitle = 'SIREFO - ENTIDADES VIGENTES';
                    auxData = displayAsTable(data.message);
                }
                $.confirm({
                    title: auxTitle,
                    content: auxData,
                    type: data.type,
                    typeAnimated: true,
                    columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
                    buttons: {
                        cancel: {
                            text: "Cerrar",
                            action: function() {},
                        },
                    },
                    onOpenBefore: function() {
                        $('.jconfirm-title-c').css('text-align', 'center');
                    }
                });
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
    });

    $('.card-7').click(function() {
        $.ajax({
            async: true,
            type: "POST",
            dataType: "json",
            url: "../php/preapi.php",
            data: {
                endpoint: 'ping',
                ack: 'ok'
            },
            crossDomain: true,
            xhrFields: {
                withCredentials: true
            },
            beforeSend: function(xhr) {
                loadGralOn();
            },
            success: function(data) {
                console.log(data);
                loadGralOff();

                $.confirm({
                    title: "SIREFO - PING",
                    content: data.message,
                    type: data.type,
                    typeAnimated: true,
                    columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
                    buttons: {
                        cancel: {
                            text: "Cerrar",
                            action: function() {},
                        },
                    },
                    onOpenBefore: function() {
                        $('.jconfirm-title-c').css('text-align', 'center');
                    }
                });
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
    });
</script>

</html>