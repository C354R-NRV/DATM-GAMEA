<!DOCTYPE html>
<?php
session_start();

$_SESSION['preguntas'] = '';
$_SESSION['respuestas'] = '';

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
    <meta charset="utf-8">
    <title>BibliotecaIA</title>
    <?php
    echo $twig->render('linkStyle.twig');
    ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
    <link href="../css/styleSlide.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <?php
    echo $twig->render('load.twig');
    ?>
    <!-- Spinner End -->


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
    <div class="container-fluid pt-5 hero-header3">
        <div class="container pt-5">
            <div class="row g-5 pt-5">
                <div class="col-lg-12 align-self-center text-center text-lg-start mb-lg-10" style="text-align:center !important;">
                    <!-- <h2 class="display-4 text-white mb-6 animated slideInRight">GAMEA-SMAF-DATM</h2> -->
                    <img class="img-fluid" src="../img/ia.gif" style="height: 6rem;" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(20, 24, 62, 0.7);">
                <div class="modal-header border-0">
                    <button type="button" class="btn btn-square bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <input type="text" class="form-control bg-transparent border-light p-3" placeholder="Type search keyword">
                        <button class="btn btn-light px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->

    <!-- About Start -->
    <section>
        <div class="swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide swiper-slide--one" id="cpe" onclick="abrirRecurso(this.id)">
                    <div>
                        <div class="contItemSlide">
                            <div><span class="titleSub"></span><span class="titleCenter">C.P.E.</span></div>
                            <div><span class="detalle" style="font-size: 0.9rem;padding: 0.5rem;">Constitución Política del Estado</div>
                        </div>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            </svg>
                        </p>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide--one" id="l2492" onclick="abrirRecurso(this.id)">
                    <div>
                        <div class="contItemSlide">
                            <div><span class="titleSub">Ley</span><span class="titleCenter">2492</span></div>
                            <div><span style="color: #ffff; font-weight: bolder; font-size: 1.5rem;">2023</span><br><span class="detalle">Código tributario Boliviano</div>
                        </div>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <!-- <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /> -->
                            </svg>
                        </p>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide--one" id="l2492_21" onclick="abrirRecurso(this.id)">
                    <div>
                        <div class="contItemSlide">
                            <div><span class="titleSub">Ley</span><span class="titleCenter">2492</span></div>
                            <div><span style="color: #ffff; font-weight: bolder; font-size: 1.5rem;">2021</span><br><span class="detalle">Código tributario Boliviano</div>
                        </div>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <!-- <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /> -->
                            </svg>
                        </p>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide--one" id="l2492_03" onclick="abrirRecurso(this.id)">
                    <div>
                        <div class="contItemSlide">
                            <div><span class="titleSub">Ley</span><span class="titleCenter">2492</span></div>
                            <div><span style="color: #ffff; font-weight: bolder; font-size: 1.5rem;">2003</span><br><span class="detalle">Código tributario Boliviano</div>
                        </div>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <!-- <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /> -->
                            </svg>
                        </p>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide--one" id="l2341" onclick="abrirRecurso(this.id)">
                    <div>
                        <div class="contItemSlide">
                            <div><span class="titleSub">Ley</span><span class="titleCenter">2341</span></div>
                            <div><span class="detalle" style="font-size: 0.9rem;padding: 0.5rem;">Ley de Procedimiento Administrativo</div>
                        </div>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <!-- <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /> -->
                            </svg>
                        </p>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide--one" id="l259" onclick="abrirRecurso(this.id)">
                    <div>
                        <div class="contItemSlide">
                            <div><span class="titleSub">Ley</span><span class="titleCenter">259</span></div>
                            <div><span class="detalle" style="font-size: 0.9rem;padding: 0.5rem;">Ley de Control al Expendio y Consumo de Bebidas Alcohólicas</div>
                        </div>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <!-- <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /> -->
                            </svg>
                        </p>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide--one" id="ds1347" onclick="abrirRecurso(this.id)">
                    <div>
                        <div class="contItemSlide">
                            <div><span class="titleSub">D.S.</span><span class="titleCenter">1347</span></div>
                            <div><span class="detalle" style="font-size: 0.9rem;padding: 0.5rem;">Reglamento a la Ley N° 259</div>
                        </div>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <!-- <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /> -->
                            </svg>
                        </p>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide--two" id="l843" onclick="abrirRecurso(this.id)">
                    <div>
                        <div class="contItemSlide">
                            <div><span class="titleSub">Ley</span><span class="titleCenter">843</span></div>
                            <div><span class="detalle">Ley General de Tributación</span></div>
                        </div>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <!--  <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /> -->
                            </svg>
                        </p>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide--two" id="l317" onclick="abrirRecurso(this.id)">
                    <div>
                        <div class="contItemSlide">
                            <div><span class="titleSub">Ley</span><span class="titleCenter">317</span></div>
                            <div><span class="detalle" style="font-size: 0.9rem;padding: 0.5rem;">Ley del Presupuesto General del Estado</span></div>
                        </div>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <!--  <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /> -->
                            </svg>
                        </p>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide--two" id="l812" onclick="abrirRecurso(this.id)">
                    <div>
                        <div class="contItemSlide">
                            <div><span class="titleSub">Ley</span><span class="titleCenter">812</span></div>
                            <div><span class="detalle">Modificación al Código Tributario Boliviano</span></div>
                        </div>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <!--  <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /> -->
                            </svg>
                        </p>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide--three" id="om128" onclick="abrirRecurso(this.id)">
                    <div>
                        <div class="contItemSlide">
                            <div><span class="titleSub">O.M.</span><span class="titleCenter">128</span></div>
                            <div><span class="detalle" style="font-size: 0.9rem;padding: 0.5rem;">Ordenanza Municipal - Aranceles de la patente municipal</span></div>
                        </div>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <!--  <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /> -->
                            </svg>
                        </p>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide--three" id="l291" onclick="abrirRecurso(this.id)">
                    <div>
                        <div class="contItemSlide">
                            <div><span class="titleSub">Ley</span><span class="titleCenter">291</span></div>
                            <div><span class="detalle" style="font-size: 0.9rem;padding: 0.5rem;">Uso Provisional De Espacios de Dominio Público Municipal y Pago De Patentes</span></div>
                        </div>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <!--  <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /> -->
                            </svg>
                        </p>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide--three" id="l458" onclick="abrirRecurso(this.id)">
                    <div>
                        <div class="contItemSlide">
                            <div><span class="titleSub">Ley</span><span class="titleCenter">458</span></div>
                            <div><span class="detalle" style="font-size: 0.9rem;padding: 0.5rem;">Actividades Clandestinas De Expendio y Consumo De Bebidas Alcoholicas</span></div>
                        </div>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <!--  <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /> -->
                            </svg>
                        </p>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide--three" id="m03" onclick="abrirRecurso(this.id)">
                    <!-- <span>history</span> -->
                    <div>
                        <div class="contItemSlide">
                            <div> <span class="titleCenter" style="font-size: 2rem !important;">Ley Municipal 03/2012</span></div>
                            <!-- <div><span class="detalle">Creación de impuestos municipales</span></div> -->
                        </div>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <!-- <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /> -->
                            </svg>
                            <!-- Paris, France -->
                        </p>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide--three" id="m12" onclick="abrirRecurso(this.id)">
                    <!-- <span>history</span> -->
                    <div>
                        <div class="contItemSlide">
                            <div> <span class="titleCenter" style="font-size: 2rem !important;">Ley Municipal 12/2012</span></div>
                            <!-- <div><span class="detalle">Creación de impuestos municipales</span></div> -->
                        </div>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <!-- <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /> -->
                            </svg>
                            <!-- Paris, France -->
                        </p>
                    </div>
                </div> 
                <div class="swiper-slide swiper-slide--three" id="lm513" onclick="abrirRecurso(this.id)">
                    <div>
                        <div class="contItemSlide">
                            <div> <span class="titleCenter" style="font-size: 2rem !important;">Ley Municipal 513</span></div>
                            <div><span class="detalle" style="font-size: 0.9rem;padding: 0.5rem;">Restricción Administrativa Licencias De Funcionamiento Act. Eco. de Bebidas Alcoholicas</span></div>
                        </div>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            </svg>
                        </p>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide--three" id="ra006" onclick="abrirRecurso(this.id)">
                    <div>
                        <div class="contItemSlide">
                            <div> <span class="titleCenter" style="font-size: 2rem !important;">R.A. 006/2022</span></div>
                            <div><span class="detalle" style="font-size: 1rem;padding: 0.5rem;">Requisitos para tramites tributarios del GAMEA</span></div>
                        </div>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            </svg>
                        </p>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide--three" id="datm" onclick="abrirRecurso(this.id)">
                    <div>
                        <div class="contItemSlide">
                            <div> <span class="titleCenter" style="font-size: 2rem !important;">DATM - iA</span></div>
                            <div><span class="detalle" style="font-size: 1rem;padding: 0.5rem;">Generalidades</span></div>
                        </div>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            </svg>
                        </p>
                    </div>
                </div>
                <!-- <div class="swiper-slide swiper-slide--two" id="test" onclick="abrirRecurso(this.id)">
                    <div>
                        <div class="contItemSlide">
                            <div><span class="titleCenter">MOF</span></div>
                            <div><span class="detalle">Manual de Organización y Funciones</span></div>
                        </div>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            </svg>
                        </p>
                    </div>
                </div>

                <div class="swiper-slide swiper-slide--three" id="g259" onclick="abrirRecurso(this.id)">
                    
                    <div>
                        <div class="contItemSlide">
                            <div><span class="titleSub">Ley</span><span class="titleCenter">259</span></div>
                            <div><span class="detalle">Control al Expendio y Consumo de Bebidas Alchólicas</span></div>
                        </div>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                
                            </svg>                            
                        </p>
                    </div>
                </div>

                <div class="swiper-slide swiper-slide--one" id="g006" onclick="abrirRecurso(this.id)">
                    
                    <div>
                        <div class="contItemSlide">
                            <div><span class="titleSub">RA</span><span class="titleCenter">006</span></div>
                            <div><span class="detalle">Actualización de requisitos para trámites</span></div>
                        </div>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                    
                        </p>
                    </div>
                </div> -->

                <!-- <div class="swiper-slide swiper-slide--five">
                    <span>native</span>
                    <div>
                        <h2>The most popular yachting destination</h2>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                            Whitsunday Islands, Australia
                        </p>
                    </div>
                </div> -->
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- About End -->

    <!-- Footer Start -->
    <?php
    echo $twig->render('footer.twig');
    ?>
    <!-- Footer End -->
    <!-- JavaScript Libraries -->
    <?php
    echo $twig->render('linkJs.twig');
    ?>
    <!-- Template Javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js"></script>
    <script src="../js/scriptSlide.js"></script>
    <script>
        function abrirRecurso(codigoPdf) {
            window.location.href = 'bi_' + codigoPdf + '.php';
            /* window.location.href = 'bi_l2492.php'; */
        }
    </script>
</body>

</html>