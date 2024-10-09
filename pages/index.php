<!DOCTYPE html>
<?php
session_start();
require_once '../vendor/autoload.php';

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('../views');
$twig = new Environment($loader);

?>
<html lang="es">

<head>
    <title>DATM</title>
    <?php
    echo $twig->render('linkStyle.twig');
    ?>
    <style>
        .rubrosInfo {
            text-align: center;
        }

        .rubrosInfo .row {
            margin-right: 0 !important;
        }

        .rubrosInfo img {
            height: 3.5rem !important;
        }

        .rubrosInfo span {
            text-align: center;
            font-size: 1.3rem !important;
        }
    </style>
    <link href="../vendor/bootstrap-table-master/dist/bootstrap-table.min.css" rel="stylesheet">
</head>

<body>
    <div class="loadGral"></div>
    <!-- Spinner Start -->
    <?php
    $auxRequisito = '0';
    if (isset($_GET['r']))
        $auxRequisito  = $_GET['r'];
    echo "<input type='hidden' id='requisito_get' value='$auxRequisito'>";

    echo $twig->render('load.twig');
    ?>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <?php
    echo $twig->render('menuIni.twig');

    if (isset($_SESSION['swlogin']) and $_SESSION['swlogin'] == '1') {
        echo $twig->render('menuLogin.twig', array('datSesion' => $_SESSION));
    } else {
        echo $twig->render('menuVisita.twig');
    }

    echo $twig->render('menuFin.twig');
    ?>

    <!-- Navbar End -->


    <!-- Hero Start -->

    <div class="container-fluid pt-5 bg-sandia hero-header">


        <div class="container pt-5" id="inicial_">
            <div class="row g-5 pt-5">
                <div class="col-lg-6 align-self-center text-center text-lg-start mb-lg-5" id="datmtxt">
                    <div class="row">
                        <!-- <div class="col-md-3 col-lg-4">
                            <img class="img-fluid" src="../img/eva2.png" alt="" style="max-height: 300px;">
                        </div> -->
                        <div class="col-md-12 col-lg-10" style="text-align: left;">
                            <span class="display-4 text-white mb-4 animated slideInRight" style="font-size: 2.5rem; text-align: left;">Dirección de <br>Administración <br>Tributaria Municipal</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 align-self-center text-center text-lg-end ">

                    <!-- <div id="containerImgEva">
                        <img class="img-fluid" src="../img/eva2.png" alt="" style="max-height: 150px;">
                    </div> -->

                    <div class='containerBotones'>
                        <div class="btn btn-sm rounded-pill px-3 mb-3" style="cursor:auto;color: white; background-color: brown; font-size: 1.2rem;"><b>REQUISITOS DE TRÁMITES</b></div><br>
                        <div class="button-container__">
                            <div onclick="getEstructuraContenido('inmuebles','blue')">
                                <button class="button__">
                                    <img src="../img/casa_.png" alt="Descripción de la imagen" class="button-image__">
                                </button>
                                <br><span>Inmuebles</span>
                            </div>
                            <div onclick="getEstructuraContenido('vehiculos','orange')">
                                <button class="button__">
                                    <img src="../img/coche_.png" alt="Descripción de la imagen" class="button-image__">
                                </button>
                                <br><span>Vehículos</span>
                            </div>
                            <div onclick="getEstructuraContenido('actividades economicas','dark')">
                                <button class="button__">
                                    <img src="../img/caseta_.png" alt="Descripción de la imagen" class="button-image__"><br>
                                </button>
                                <br><span>Actividad<br>Económica</span>
                            </div>
                        </div>
                        <br>
                        <div class="btn btn-sm rounded-pill px-3 mb-3 mensajeProformaBtn"><b><i class="fa fa-file-text-o fs-5"></i> Proformas</b></div><span style="padding: 1rem;"></span>
                        <div class="btn btn-sm rounded-pill px-3 mb-3 mensajeTramitepBtn"><b><i class="fa fa-folder-open-o  fs-5"></i> Tramites</b></div><span style="padding: 1rem;"></span>
                        <div class="btn btn-sm rounded-pill px-3 mb-3 miRegistroBtn"><b><i class="fa fa-database fs-5"></i> Tus bienes</b></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->



    <!-- Full Screen Search Start -->
    <!-- <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(24, 63, 78, 0.7);">
                <div class="modal-header border-0">
                    <button type="button" class="btn btn-square bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <input type="text" class="form-control bg-transparent border-light p-3" placeholder="Que es lo que busca?">
                        <button class="btn btn-light px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Full Screen Search End -->

    <!-- Feature Start -->
    <div class="container-fluid feature pt-5" style="background-color: #424f53  !important;">
        <div class="container pt-5">
            <div class="row g-5">
                <div class="col-lg-6 align-self-center mb-md-5 pb-md-5 wow fadeIn" data-wow-delay="0.3s">
                    <h1 class="text-white mb-4">Pago de impuestos por QR</h1>
                    <!-- <div class="btn btn-sm border rounded-pill text-white px-3 mb-3"><span style="color:#c3d3d8"> Tu municipio</span></div> -->
                    <p class="text-light mb-4" style="text-align: justify;">Descarga la aplicación <b>"Tu municipio 24/7"</b> para pago de impuestos del RUAT</p>
                    <div class="d-flex align-items-center mt-4">
                        <a class="btn btn-sandia rounded-pill px-4 me-3" href="https://play.google.com/store/apps/details?id=org.ruat.tumunicipio" target="_blank"><i class="fa fa-android fs-4" style="color:#ffff;"></i> PlayStore</a>
                        <a class="btn btn-sandia rounded-pill px-4 me-3" href="https://apps.apple.com/bo/app/tu-municipio-24-7/id6472496515" target="_blank"><i class="fa fa-apple  fs-4" style="color:#ffff;"></i> AppStore</a>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.4s">
                    <div style="text-align: center; margin-bottom: 3rem; color: #4fd2cf; cursor:pointer;">
                        <a onclick="verEnlacesQr()" target="_blank"> PAGOS QR RUAT </a><br>
                        <img class="img-fluid" src="../img/qr_codew.png" style="height: 13rem;" alt="">
                    </div>
                </div>
            </div>
        
        </div>
    </div>

    <!-- Feature Start -->
    <div class="container-fluid feature  " style="background-color: #1f2527  !important;">
        <div class="container pt-5">
            <div class="row g-5">

                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.4s">
                    <div style="text-align: center; margin-bottom: 3rem; color: #4fd2cf; cursor:pointer;">
                        <br><br><br><br>
                        <a href = "https://prensa.evacopa.bo/" target="_blank"><img class="img-fluid" src="../img/obras.png" style="max-width: 24rem;" alt=""></a>
                    </div>
                </div>

                <div class="col-lg-6 align-self-center mb-md-5 pb-md-5 wow fadeIn" style="text-align: right;" data-wow-delay="0.3s">
                    <h1 class="text-white mb-4">¡Paga tus impuestos a tiempo y contribuye al crecimiento de El Alto!</h1>
                    <!-- <div class="btn btn-sm border rounded-pill text-white px-3 mb-3"><span style="color:#c3d3d8"> Tu municipio</span></div> -->
                    <p class="text-light mb-4" style="text-align: rigth;">Tus aportes se traducen en más obras y mejores servicios para todos. ¿Te gustaría hacer seguimiento al progreso de las obras? Haz clic en el enlace a continuación para estar al tanto de cada avance:</p><a href = "https://obras.evacopa.bo/" target="_blank"> Ver obras </a>
                </div>
            </div>
        </div>
    </div>


    <!-- Feature End -->


    <!-- About Start -->
    <div class="container-fluid py-5" style="background-color: #c7d5d9 !important;">
        <div class="container">
            <div class="row g-5 align-items-center" id="inmuebles_">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.3s">
                    <div class="about-img">
                        <img class="img-fluid" src="../img/inmuebles.gif" alt="">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" style="text-align: right;" data-wow-delay="0.5s">
                    <div class="btn btn-sm border rounded-pill text-primary px-3 mb-3">Inmuebles</div>
                    <h1 class="mb-4">Impuesto a la Propiedad Inmobiliaria</h1>
                    <p class="mb-4" style="text-align: justify;">Estos impuestos suelen ser una fuente importante de ingresos para el Gobierno Municipal
                        y se utilizan para financiar servicios públicos, proyectos de infraestructura y desarrollo local; a continuación en los siguientes enlaces te mostramos los requisitos para cada caso.</p>
                    <div style="text-align: right;">
                        <a class="btn btn-sandia rounded-pill px-4" onclick="getEstructuraContenido('inmuebles','blue')"><i class="fa fa-eye"></i> Ver requisitos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->



    <!-- Feature Start -->
    <div class="container-fluid bg-primary feature pt-5" id="vehiculos_">
        <div class="container pt-5">
            <div class="row g-5">
                <div class="col-lg-6 align-self-center mb-md-5 pb-md-5 wow fadeIn" data-wow-delay="0.3s">
                    <div class="btn btn-sm border rounded-pill text-white px-3 mb-3">Vehículos</div>
                    <h1 class="text-white mb-4">Impuesto a la propiedad Vehicular Automotor</h1>
                    <p class="text-light mb-4" style="text-align: justify;">El impuesto vehicular se paga para financiar los servicios públicos y proyectos de relacionados
                        con el transporte, y sobre todo, para promover un sistema de transporte más eficiente y sostenible en la ciudad.</p>
                    <div class="d-flex align-items-center mt-4">
                        <a class="btn btn-sandia rounded-pill px-4 me-3" onclick="getEstructuraContenido('vehiculos','orange')"><i class="fa fa-eye"></i> Ver requisitos</a>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.4s">
                    <div class="trnsp-img2">
                        <img class="img-fluid" src="../img/vehiculos.gif" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->


    <!-- Service Start -->
    <div class="container-fluid bg-light py-5">
        <div class="container" id="mercados_">
            <div class="row align-items-center">

                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.4s">
                    <div class="trnsp-img">
                        <img class="img-fluid" src="../img/actividad.gif">
                    </div>
                </div>

                <div class="col-lg-6 wow fadeIn" style="text-align: right;" data-wow-delay="0.3s">
                    <div class="btn btn-sm border rounded-pill text-primary px-3 mb-3">Ferias&Mercados</div>
                    <h1 class="mb-4">Impuesto a la Actividad Económica</h1>
                    <p class="mb-4" style="text-align: justify;">Este rubro juega un papel fundamental en la vida económica, social y urbana de la ciudad, promoviendo la cohesión social y proporcionando ingresos tributarios para el bienestar general de la comunidad. Encuentra más información sobre los requisitos en los enlaces proporcionados:</p>

                    <div style="text-align: right;">
                        <a class="btn btn-sandia rounded-pill" onclick="getEstructuraContenido('actividades economicas','dark')"><i class="fa fa-eye"></i> Ver requisitos</a>
                    </div>
                </div>




            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- FAQs Start -->
    <div class="container-fluid py-5">
        <div class="container py-5" id="faqs_">
            <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 500px;">
                <div class="btn btn-sm border rounded-pill text-primary px-3 mb-3">FAQs</div>
                <h1 class="mb-4">Preguntas frecuentes</h1>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="accordion" id="accordionFAQ1">
                        <div class="accordion-item wow fadeIn" data-wow-delay="0.1s">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    ¿Cuánto demora la entrega de la Licencia de Funcionamiento para una actividad económica?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionFAQ1">
                                <div class="accordion-body">
                                    El tiempo estimado de entrega de la Licencia de Funcionamiento es de 10 a 15 días hábiles después del trámite, dependiendo al tipo de actividad económica.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeIn" data-wow-delay="0.2s">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    ¿Cómo se calcula el pago por el Impuesto Municipal a la Transferencia Onerosa de bienes inmuebles?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFAQ1">
                                <div class="accordion-body">
                                    Se calcula el 3% de la base imponible actualizada o al monto declarado en la minuta (mayor cifra).
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item wow fadeIn" data-wow-delay="0.2s">
                            <h2 class="accordion-header" id="heading3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    ¿Por qué continúo pagando impuestos de una casa que la vendí hace varios años?
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordionFAQ1">
                                <div class="accordion-body">
                                    Estimado contribuyente, usted continua generando el impuesto municipal a la propiedad de bienes inmueble IMPBI con su nombre, pues al momento de vender su bien, no se cumplió con el deber formal de realizar el tramite administrativo de transferencia del bien inmueble en cuestión, omitiendo el pago del impuesto municipal a las transferencias (IMT), o el impuesto Municipal a las Transferencias Onerosas (IMTO). Cabe señalar que el tramite de transferencia lo puede realizar el vendedor, el comprador o el apoderado legal.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeIn" data-wow-delay="0.2s">
                            <h2 class="accordion-header" id="heading4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                    ¿Soy de la tercera edad, tengo algún descuento?
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionFAQ1">
                                <div class="accordion-body">
                                    Los descuentos son aplicados a los titulares, a solicitud de parte cumpliendo con los requisitos de la Resolución Administrativa 006/2022 descuento de 20%
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeIn" data-wow-delay="0.2s">
                            <h2 class="accordion-header" id="heading5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                    ¿Porque me hicieron la retención de cuentas de una casa que la vendí hace años?
                                </button>
                            </h2>
                            <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordionFAQ1">
                                <div class="accordion-body">
                                    Debido a no concluir con la transferencia de su bien inmueble, ahora bien por un tema de levantamiento, el contribuyente tendría que cancelar las gestiones fiscalizadas y posteriormente solicitar la baja del registro tributario.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="accordion" id="accordionFAQ2">

                        <div class="accordion-item wow fadeIn" data-wow-delay="0.3s">
                            <h2 class="accordion-header" id="headingTree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTree" aria-expanded="false" aria-controls="collapseTree">
                                    ¿Quién es el responsable de pagar el impuesto a la trasferencia de un vehículo?
                                </button>
                            </h2>
                            <div id="collapseTree" class="accordion-collapse collapse" aria-labelledby="headingTree" data-bs-parent="#accordionFAQ1">
                                <div class="accordion-body">
                                    Según el Decreto Supremo 24054, Art. 5 del Código Tributario, establece que la persona natural o jurídica a cuyo nombre se encuentre registrado el vehículo, es el responsable de realizar y pagar el impuesto a la transferencia onerosa del vehículo al momento de su venta.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeIn" data-wow-delay="0.3s">
                            <h2 class="accordion-header" id="heading7">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                                    ¿Porque aumentó tanto el impuesto si solo subí un piso?
                                </button>
                            </h2>
                            <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading7" data-bs-parent="#accordionFAQ1">
                                <div class="accordion-body">
                                    Esto suele suceder en los casos en que el contribuyente no realizo efectivamente la actualización de los datos técnicos de su bien inmueble (aplicaciones, mejoras en servicios, zona de valor, tipo de construcción, material de vía, superficie de construcción, superficie de terreno), esta acción provoca una acumulación monetaria relacionada a los datos técnicos rectificados.
                                    <br>Si tiene dudas, siéntase libre de solicitar un INSPECCIÓN EN SITIO, y un experto de ATP realizara la verificación INSITU para evaluar posibles observaciones.
                                    <br>Considere que los cálculos de los montos monetarios por concepto de impuestos, están sujetos a la Ley 2492 y la Ordenanza Municipal 215/2007

                                </div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeIn" data-wow-delay="0.3s">
                            <h2 class="accordion-header" id="heading8">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                    ¿si mi vehículo no circula y esta parado ya hace tiempo, porque se me sigue cobrando impuestos?
                                </button>
                            </h2>
                            <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="heading8" data-bs-parent="#accordionFAQ1">
                                <div class="accordion-body">
                                    El impuesto aplicado a los vehículos automotores, es aplicado hacia la propiedad de los mismos, indistintamente de si estos son utilizados o no por su propietario. Si usted como propietario ya no desea realizar el pago de estos tributos, debe de realizar los tramites necesarios
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeIn" data-wow-delay="0.3s">
                            <h2 class="accordion-header" id="heading9">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                                    ¿si realice la venta de mi vehículo y también hice mi tramite de transferencia, porque aun el vehículo figura como de mi propiedad?
                                </button>
                            </h2>
                            <div id="collapse9" class="accordion-collapse collapse" aria-labelledby="heading9" data-bs-parent="#accordionFAQ1">
                                <div class="accordion-body">
                                    Tras realizarse el tramite de transferencia en DATM, es necesario que se realice el pago efectivo de 3%, con la finalidad de concluir correctamente la transferencia
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeIn" data-wow-delay="0.2s">
                            <h2 class="accordion-header" id="heading10">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
                                    ¿Si deseo realizar el pago de impuestos de mi vehículo en la ciudad de El Alto, que tramite debo de realizar?
                                </button>
                            </h2>
                            <div id="collapse10" class="accordion-collapse collapse" aria-labelledby="heading10" data-bs-parent="#accordionFAQ1">
                                <div class="accordion-body">
                                    La DATM realiza cobros por concepto de impuestos a la propiedad de vehículos automotores, solo en los casos en que estos se encuentren con ratificatoria en el GAM de El Alto, en caso de que usted haya migrado a la ciudad de El Alto, deberá realizar el tramite de CAMBIO DE RADICATORIA, este tramite da inicio en DERECHOS REALES.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 


    <!-- Team Start -->
    <div class="container-fluid bg-light py-5">
        <div class="container py-5" id="nosotros_">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                    <div class="btn btn-sm border rounded-pill text-primary px-3 mb-3"><b>D.A.T.M.</b></div>
                    <h1 class="mb-4">Modernizamos la Dirección de Administración Tributaria Municipal</h1>
                    <p class="mb-4" style="text-align: justify;">El equipo de la Dirección de Administración Tributaria Municipal de la ciudad de El Alto se distingue por su compromiso, eficiencia y profesionalismo en el cumplimiento de sus responsabilidades. Compuesto por un grupo de expertos en gestión tributaria y administración pública, este equipo trabaja incansablemente para garantizar el adecuado funcionamiento de los sistemas de recaudación de impuestos municipales.</p>
                    <p class="mb-4" style="text-align: justify;">Con un enfoque orientado al servicio y la transparencia, los miembros de este equipo se esfuerzan por brindar una atención personalizada a los contribuyentes, proporcionando información clara y precisa sobre los diferentes aspectos relacionados con sus obligaciones fiscales. Su objetivo es promover el cumplimiento voluntario de las obligaciones tributarias, fomentando así el desarrollo sostenible de la ciudad y el bienestar de sus habitantes.</p>
                    <a class="btn btn-sandia rounded-pill px-4" href="datminfo.html">Ver más</a>
                </div>
                <div class="col-lg-7 wow fadeIn" data-wow-delay="0.1s">
                    <div class="trnsp-img">
                        <img class="img-fluid" src="../img/datmv2.gif">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->
    <!-- Newsletter Start -->
    <div class="container-fluid bg-sandia newsletter py-5">
        <div class="container" id="contactanos_">
            <div class="row g-5 align-items-center">
                <div class="col-md-5 ps-lg-0 pt-5 pt-md-0 text-start wow fadeIn" data-wow-delay="0.3s">
                    <img class="img-fluid" src="../img/newsletter.png" alt="">
                </div>
                <div class="col-md-7 py-5 newsletter-text wow fadeIn" data-wow-delay="0.5s">
                    <div class="btn btn-sm border rounded-pill text-white px-3 mb-3">Contáctanos</div>
                    <h1 class="text-white mb-4">Estamos listos para poder absorber tus dudas</h1>
                    <div class="position-relative w-100 mt-3 mb-2">
                        <input class="form-control border-0 rounded-pill w-100 ps-4 pe-5" type="text" id="mensajeWtsp" placeholder="Mensaje via por whatsapp" style="height: 48px;">
                        <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2 mensajeWtspBtn"><i class="fa fa-whatsapp fs-4" style="color: green;"></i></button>
                    </div>
                    <small class="text-white-50">Horarios de atención de lunes a viernes, de 08:00 a 16:00</small>
                </div>
            </div>
        </div>
    </div>
    <!-- Newsletter End -->


    <!-- Footer Start -->

    <?php
    echo $twig->render('footer.twig');
    ?>
    <!-- Footer End -->
    <!-- Back to Top -->
    <a href="#inicial_" class="btn btn-lg btn-primary btn-lg-square back-to-top pt-2 bg-celesteLgt"><i class="fa fa-sort-asc"></i></a>
    <!-- JavaScript Libraries -->
    <?php
    echo $twig->render('linkJs.twig');
    ?>
    <script src="../vendor/bootstrap-table-master/dist/bootstrap-table.min.js"></script>
    <script>
        $(document).ready(function($) {
            var requisitoGet = $('#requisito_get').val();
            console.log("requisitoGet:" + requisitoGet);
            if (requisitoGet > 0 && requisitoGet <= 3) {
                var modulo_ = 'inmuebles';
                var color_ = 'blue';
                switch (requisitoGet) {
                    case '2': {
                        modulo_ = 'vehiculos';
                        color_ = 'orange';
                        break;
                    }
                    case '3': {
                        modulo_ = 'actividades economicas';
                        color_ = 'dark';
                        break;
                    }
                }
                getEstructuraContenido(modulo_, color_);
            }
        });

        function verEnlacesQr() {
            $.confirm({
                title: "<div style='width:100%;text-align:center;'>De que rubro desea generar el QR de pago?</div>",
                type: "blue",
                typeAnimated: true,
                containerFluid: true,
                content: ` 
                        <div class='rubrosInfo'>
                            <div class='row align-items-center'>   
                                <div class='col-md-6'>
                                    <a href="https://www.ruat.gob.bo/pagosqr/InicioBusquedaInm.jsf?SDG3WF24=2" target="blank_" class="btn btn-sm">
                                        <span style='color: #1BA9D0;'>Inmuebles</span></a>
                                </div>
                                <div class='col-md-6'>
                                    <a href="https://www.ruat.gob.bo/pagosqr/InicioBusquedaInm.jsf?SDG3WF24=2" target="blank_" class="btn btn-sm"><img src='../img/casa2_.png' alt='Inmuebles'></a>
                                </div>                     
                            </div>
                            <hr>            
                            <div class='row align-items-center'>   
                                <div class='col-md-6'>
                                    <a href="https://www.ruat.gob.bo/pagosqr/InicioBusquedaVehiculo.jsf?SDG3WF24=1" target="blank_" class="btn btn-sm">
                                    <span style='color: #1BA9D0;'>Vehiculos</span></a>
                                </div>                     
                                <div class='col-md-6'>
                                    <a href="https://www.ruat.gob.bo/pagosqr/InicioBusquedaVehiculo.jsf?SDG3WF24=1" target="blank_" class="btn btn-sm"><img src='../img/coche2_.png' alt='Vehiculo'></a>
                                </div>                     
                            </div>          
                            <hr>                       
                            <div class='row align-items-center'>   
                                <div class='col-md-6'>
                                    <a href="https://www.ruat.gob.bo/pagosqr/InicioBusquedaActEco.jsf?SDG3WF24=4" target="blank_" class="btn btn-sm">
                                    <span style='color: #1BA9D0;'>Actividad Económica</span></a>
                                </div>                     
                                <div class='col-md-6'>
                                    <a href="https://www.ruat.gob.bo/pagosqr/InicioBusquedaActEco.jsf?SDG3WF24=4" target="blank_" class="btn btn-sm"><img src='../img/caseta2_.png' alt='Actividad Economica'></a>
                                </div>                     
                            </div>    
                        </div>   
                        `,
                buttons: {
                    cancel: {
                        text: "Cerrar",
                        action: function() {},
                    },
                },
            });
        }

        function generarSolicitud(elemt,
            subelemt, ci_, numInmueble_, nombre_,
            numlote_, manzano_, superficie_,
            ubicacion_, nuevonombre_, tipodoc_,
            gestion_, contacto_, correo_,
            num_placa_, gestionIni_, gestionFin_,
            num_act_
        ) {
            //subelemt == 'inm_20'
            datos =
                "&ci_=" + ci_ + "&numInmueble_=" + numInmueble_ + "&nombre_=" + nombre_ +
                "&numlote_=" + numlote_ + "&manzano_=" + manzano_ + "&superficie_=" + superficie_ +
                "&ubicacion_=" + ubicacion_ + "&nuevonombre_=" + nuevonombre_ + "&tipodoc_=" + tipodoc_ +
                "&gestion_=" + gestion_ + "&contacto_=" + contacto_ + "&correo_=" + correo_ +
                "&num_placa_=" + num_placa_ + "&gestionIni_=" + gestionIni_ + "&gestionFin_=" + gestionFin_ + "&num_act_=" + num_act_;

            mainDialog1.close();
            $.ajax({
                async: true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url: "../php/prevSolicitud.php",
                data: datos,
                beforeSend: function() {
                    loadGralOn();
                },
                success: function(e) {
                    loadGralOff();
                    dat = $.parseJSON(e);
                    if (dat.rsp || subelemt == 'inm_3') {
                        var url_ = "../php/rpt" + subelemt + ".php?" + datos;
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

                    } else {
                        var numid = numInmueble_;
                        var tit_ = 'inmueble';
                        if (elemt == 'vehiculos') {
                            numid = num_placa_;
                            tit_ = 'placa de vehiculo';
                        }
                        if (elemt == 'mercados') {
                            numid = num_act_;
                            tit_ = 'actividad económica';
                        }
                        $.confirm({
                            title: "No se encontraron registros!",
                            type: "red",
                            content: "El C.I.:<b>" + ci_ + "</b>, con el número de " + tit_ + ": <b>" + numid + "</b>, no se encuentra en la base de datos, asegurese de ingresar correctamente la información.",
                            buttons: {
                                cancel: {
                                    text: "Cerrar",
                                    action: function() {},
                                },
                            },
                        });
                    }
                },
                timeout: 16000,
                error: function(th) {
                    $.confirm({
                        title: "Ocurrio un error",
                        type: "red",
                        content: th,
                        buttons: {
                            cancel: {
                                text: "Cerrar",
                                action: function() {},
                            },
                        },
                    });

                },
            });
        }
    </script>
</body>

</html>