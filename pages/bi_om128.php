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
    <title>DATM O.M. 128</title>
    <?php
    echo $twig->render('linkStyle.twig');
    ?>
    <link href="../css/styleRecursoIa.css" rel="stylesheet">

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            text-align: center;
            background-color: #d7d9e1;
            font-weight: bold;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #444444;
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
    <li class="breadcrumb-item"><a class="text-white" href="home.php">Home</a></li>
    <li class="breadcrumb-item"><a class="text-white" href="home.php">Acceso IA</a></li>
    <li class="breadcrumb-item"><a class="text-white" href="biblioteca.php">Biblioteca</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page">Ordenanza Municipal 128</li>
    <?php
    echo $twig->render('prebodyltFin.twig');
    ?>
    <!-- Hero End -->

    <!-- About Start -->
    <div class="containermt-5">
        <div class="row position-relative">

            <div class="col-6" id="main-content">

                <div class="col-12" style="text-align: center;">
                    <div class="search-container col-4 mx-auto">
                        <div class="position-relative w-100 mt-3 mb-2" style="text-align:center;">
                            <input class="form-control border-0 rounded-pill w-100 ps-4 pe-5" type="text" id="search-input" placeholder="Buscar texto..." style="height: 48px;" autocomplete="off">
                            <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2" id="search-button"><i class="fa fa-search fs-4" style="color:#036b8b;"></i></button>
                        </div>
                    </div>
                </div>

                <div class="show-btn"><span onclick="toggleInfoPanel()" id="contenBtn"><img class="img-fluid" src="../img/ia.gif" style="height: 2rem;" alt=""></span></div>
                <div class="contenidoRecurso main-content-container" id="contenidoRecurso">
                    <h1>RESOLUCION ADMINISTRATIVA No. DR/08/2005</h1>
                    <input type="hidden" id="recurso_" value="l812">
                    <h1><span id="tituloPrincipal">ARANCELES DE LA PATENTE MUNICIPAL</span></h1>

                    <br>
                    El Alto. 10 de mayo de 200
        
                    <br>
                    VISTOS Y CONSIDERANDOS:
                    <br>
                    El Art 27 de la Constitución Política del Estado, establece que "Los impuestos y demás carga publicas obligan igualmente a todos. Su creación, distribución y supresión tendrán carácter gen al, debiendo determinarse en relación a un sacrificio igual de los contribuyentes, en forma proporcional o progresiva, según los casos".
                    <br>
                    <br>
                    Que la Ley de Municipalidades otorga al Gobierno Municipal en materia Administrativa y Financiera las competencias de recaudar y administrar /os ingresos municipales de carácter tributario y n tributario concernientes a su jurisdicción territorial, así como de conocer y resolver los asuntos administrativos y financieros, asimismo, el art. 101 de la misma, señala que son ingresos munición pales tributarias los provenientes de impuestos Tasas y Patentes; siendo en consecuencia I
                    recaudación de adeudos tributarias de competencia de la Dirección de Recaudaciones dependiente del GMEA.
                    <br>
                    <br>
                    Que mediante Ordenanza Municipal No 128/2004 de 22 de julio de 2004 se aprueba los aranceles de la patente municipal máxima correspondiente a la gestión 2004, la Tabla de Clasificación de Patentes Municipales y el incentive por el pago antes del vencimiento de los plazos establecidos por Resolución Administrativa expresa emitida por la Máxima Autoridad Tributaria Municipal.
                    <br>
                    <br>
                    Que, el Código Tributario en su Art. 21 y el D. S No. 27310 en su Art 3, establecen que el Sujeto Active de la relación jurídica tributaria es el Estado, cuyas facultades de recaudación, control verificación, inspección previa, fiscalización, liquidación, determinación, ejecución y otras establecidas en el C6digo, son ejercidas por la Dirección de Recaudaciones; asimismo, el Art. 64 de I misma Compilación Tributaria, dispone que la Administración Tributaria, podrá dictar normas administrativas de carácter general a los efectos de la aplicación de las normas tributarias, las que no podrán modificar, ampliar o suprimir el alcance del tributo ni sus elementos constitutivos.
                    <br>
                    <br>
                    Mediante cite No. DGPTI-DAPT 5411 No 190/2004 de fecha 1 3 de octubre de 2004. e Viceministerio de Política Tributaria Interna dependiente del Ministerio de Hacienda, emitir Dictamen Técnico favorable a la Ordenanza Municipal No. 128/2004, que en su parte pertinente textualmente indica "..sugerir al H. Senado Nacional la aprobación de la Patente definida en la orde­nanza Municipal No. 128/2004 de fecha 22/07/04 y las tablas detalladas en anexo adjunto que forma parte de este dictamen... ".
                    <br>
                    Que habiendo la Máxima Autoridad Ejecutiva presentado en fecha 26 de octubre de 2004 mediante carta LETRA: DHAM CITE: 2555/2004 de fecha 20 de octubre de 2004 a la Presidencia de la H. Cámara de Senadores para su consideración y posterior aprobación la O M. 128/2004 y vista del Dictamen Técnico CITE: DGPTI-DAPT 5411 No. 190/2004 emitido par el Vice-Ministro de Política Tributar~ del Ministerio de Hacienda, hasta la fecha no se pronuncio el H. Senado nacional.
                    <br>
                    Considerando el art 105 parágrafo II de la Ley No. 2028 que determina vencido el plazo para la aprobación de la Ordenanza Municipal en el Senado Nacional, dentro el plaza no mayor a las sesenta (60) días a partir de su presentación, se entenderá por aprobadas y entraron en vigencia. Por la incidencia econ6mica que representa para esta Administración Tributaria, a fin de dar cumplimiento al Art 3 parágrafo II de la Ley No. 2492 se emite la presente Resolución Administrativa que disponga la aplicabilidad de la Ordenanza Municipal 128/2004.
                    <br>
                    P0R TANTO: La suscrita Directora de Recaudaciones del Gobierno Municipal de la ciudad de El Alto en uso de sus legitimas atribuciones conferidas par el Art. 21 del C6digo Tributario, Ley de Municipalidades, Resolución Técnica Administrativa 019/2004 y normas conexas.
                    <br>
                    <h4>ARTICULO PRIMERO.-</h4> Aplicar la Ordenanza Municipal No. 128/2004 de aranceles de la patente municipal máxima correspondiente a la gestión 2004 al amparo del art. 105 parágrafo II de la Ley No. 2028 Ley de Municipalidades.
                    <br>
                    <h4>ARTICUL0 SEGUNDO.-</h4> Fijar como plaza improrrogable para el cobra de Patentes de Funcionamiento por Actividades Econ6micas para la gestión 2004 hasta el 31 de agosto de 2005, aplicando el incentivo equivalente al 10% de descuento para todo contribuyente que cumpla su obligación dentro el plaza fijado en el presente articulo.
                    <br>
                    <br>
                    Vencido el plazo señalado anteriormente, se harán pasibles a la liquidación de la deuda tributaria
                    conforme a la dispuesto en el Art. 47 de la Ley No. 2492.
                    <br>
                    Registrese, comuniquese y archivese.
                    <br>
                    ING. MARCELO VASQUEZ VILLAMOR PRESIDENTE DEL H. CONCEJO MUNICIPAL DE EL ALTO

                    CONSIDERANDO:
                    <br>
                    Que la Constitución Política del Estado establece en su Art. 27, que los impuestos y demás cargas publicas obligan igualmente a todos y que su creación, distribución y supresión tendrán carácter general deben determinarse en relación a un sacrificio igual de los contribuyentes, en forma proporcional o progresiva,
                    según los casos.
                    <br>
                    <br>
                    Que el Art. 201 de la Constitución Política del Estado determina como facultad de los Gobiernos Municipales
                    establecer las Tasas y Patentes.
                    <br>
                    <br>
                    Que el Art. 101 de la Ley de Municipalidades, que se consideran ingresos municipales tributarios a los provenientes de: impuestos, tasas y patentes, siendo la Patente Municipal un tributo cuyo hecho generador es el uso o aprovechamiento de bienes de dominio público, así como la obtención de autorizaciones para la
                    realización de actividades econ6micas.
                    <br>
                    <br>
                    Que por el articulo 105 parágrafo I y II de la Ley de Municipalidades, los Gobiernos Municipales tienen la facultad de modificar o enmendar patentes, por su parte el Art. 6 parágrafo II de la ley 2492 de 2 de agosto 2003 Código Tributario, establece que las Patentes Municipales se crearan, modificaran, exencionaran, con.
                    donaran y suprimirán mediante Ordenanza Municipal aprobada por el Honorable Senado Nacional.
                    <br>
                    Que el Ejecutivo Municipal ha presentado al Honorable Concejo Municipal para su consideración el proyecto de Ordenanza Municipal para el cobro de Patentes correspondientes a la gestión 2004; con las adecuaciones a la Ley. No. 2492 de dos de agosto de 2003 C6digo Tributario y Decreto Supremo No. 27310 de fecha 9 de enero de 2004 Reglamento al Código Tributario.
                    <br>
                    <br>
                    Que considerando la difícil situación econ6mica que vive la población boliviana, en particular la Ciudad de El Alto, en el marco de las facultades conferidas par Ley, el Gobierno Municipal de El Alto ha decidido mante­ner los aranceles de las patentes establecidas para la gesti6n 2003.
                    <br>
                    Que por Informe DR-U.C.C/066/04 de la Dirección de Recaudaciones Justifica la Promulgación de la presente Ordenanza, considerando la aparición de otras actividades no contempladas y par un principio de
                    equidad con aquellos sectores econ6micos que si contribuyen, es necesario que cada una de estas activi­dades econ6micas se encuentren debidamente identificadas en la tabla de Clasificación con el respectivo cálculo de la Patente Municipal por la autorización acorde a la realidad económica.
                    <br>
                    <br>
                    EL ALTO - BOLIVIA • 14 de Junio de 2005
                    PATENTES - Gestión 2004
                    <br>
                    PORTANTO:
                    <br>
                    <br>
                    El H. Concejo Municipal de la ciudad de El Alto, en uso especifico de las atribuciones que le confiere la Constitución Política del Estado Art. 200-I y la Ley de Municipalidades Art. 12 numerales 4 , 10y Art. 105-1.
                    <br>
                    <br>
                    RESUELVE:
                    <br>
                    <br>
                    TITULO I
                    <br>
                    PATENTE MUNICIPAL

                    <br>
                    <h5>CAPITULO I</h5>
                    DISPOSICIONES PRELIMINARES

                    <br>
                    <h4>ARTICULO PRIMERO.-</h4> (Aprobación de Aranceles). Aprobar las aranceles de la patente municipal máxima.
                    <br>
                    <br>
                    <h4>ARTICULO SEGUNDO.-</h4> (Aprobación de Tablas de Clasificación). Aprobar la Tabla de Clasificación de la Patente Municipal, establecer su marco conceptual, zonificación y tabla de parámetros de ponderación para su calculo, mismos qua se encuentran detalladas en las tablas especificas que se anexan y que forman parte
                    4,,e@tutiva e indisoluble de la presente Ordenanza Municipal.
                    <br>
                    <br>
                    <h4>ARTICULO TERCERO.-</h4> (Incentivo). Aplicar el incentivo del 10% par el pago antes del vencimiento de los pla­zos establecidos por Resolución Administrativa expresa emitida por la Máxima Autoridad Tributaria Municipal.
                    <br>
                    <br>
                    El pago de la Patente Municipal fuera de los plazos dispuestos en la formas y condiciones señaladas en el párrafo precedente serán pasibles a las sanciones y disposiciones emitidas en la ley 2492 de 2 de agosto de 2003 y normas reglamentarias vigentes.
                    <br>
                    <h4>ARTICULO CUARTO.-</h4> (Objeto). El objeto de la presente Ordenanza Municipal es establecer el marco nor­mativo de la Patente Municipal aplicable en la Jurisdicción Municipal de El Alto conforme a lo dispuesto en la
                    Ley No. 2492 de 2 de agosto de 2003 y demás disposiciones vigentes.
                    <br>
                    <br>
                    <h4>ARTICULO QUINTO.-</h4> (Ámbito de Aplicación). La presente Ordenanza establece el régimen jurídico apli­cable a la Patente Municipal dentro la jurisdicción del Gobierno Municipal de El Alto.
                    <h4>ARTICULO SEXTO.-</h4> (Vigencia). La presente Ordenanza Municipal ser~ aplicable en el cobra de la Patente Municipal para la gestión 2004.
                    <br>
                    <h5>CAPITULO II</h5>

                    PATENTE MUNICIPAL DE FUNCIONAMIENTO

                    <h4>Articulo SEPTIMO.-</h4> (Concepto). En aplicación a lo dispuesto por el Art. 9° parágrafo III del Código Tributario, la Patente Municipal es un tributo de dominio municipal, cuyo hecho generador es el uso o aprovechamiento de bienes de dominio publico, así como la obtención de autorizaciones para la realización
                    de actividades econ6micas.
                    <br>
                    <h4>Artículo OCTAVO.-</h4> (Sujeto Pasivo). EI Sujeto Pasivo de la Patente Municipal es la persona natural o jurídica, tercero responsable, sobre el que se efectiviza el hecho generador quien debe cumplir las obliga­ciones tributarias establecidas en la presente Ordenanza Municipal, Código Tributario y leyes conexas.
                    <br>
                    EL ALTO -BOLIVIA· 14 de Junio de 2005
                    PATENTES - Gestión 2004

                    <h4>ARTICULO NOVENO.-</h4> (Clasificación). La Patente Municipal se clasifica en:
                    <br>
                    <br>
                    1. Patente Municipal Permanente
                    a). Patente Municipal Permanente de Actividades Ecan6micas.
                    I
                    b). Patente Municipal Permanente en sitio Público.
                    <br>(
                    <br>
                    2. Patente Municipal a la Publicidad y Propaganda
                    a). Patente Municipal a la Publicidad y Propaganda Permanente y Eventual.
                    b). Patente Municipal a la Publicidad y Propaganda Permanente y Eventual en sitio Público.
                    1
                    3.
                    Patente Municipal Eventual
                    a). Patente Municipal Eventual.
                    b). Patente Municipal Eventual en sitio Público.
                    <br>
                    <h4>ARTICULO DÉCIMO.-</h4> (Exención). Están exentos del pago de las Patentes Municipales, los siguientes:
                    4
                    a) Asociaciones, Fundaciones e Instituciones Religiosas, educativas, culturales, deportivas,
                    de salud sin fines de lucro.
                    <br>
                    Las personas jurídicas comprendidas en el párrafo anterior, deberán sujetarse a lo previsto por el Art. 104 de
                    la Ley No. 2028 Ley de Municipalidades.
                    <br>
                    <br>
                    b) instituciones Publicas Nacionales, Departamentales y Municipales, excepto las Empresas Publicas.
                    <br>
                    Para las Instituciones descritas en el párrafo anterior, proceder~ este beneficio sin trámite alguno ante la
                    Administración Tributaria Municipal.
                    <br>
                    <br>
                    La exención para sujetos pasivos no descritos en esta Ordenanza Municipal deber~ ser establecida mediante Ordenanza Municipal expresa y aprobada por el H. Senado Nacional.
                    <h4>ARTICULO DÉCIMO PRIMERO.-</h4> (Formas de pago de la Patente Municipal). Se establecen las siguientes
                    formas de pago:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;I. Pago al contado.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;II Pagos Parciales.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;III Plan de Pages.
                    <br>
                    <br>
                    será establecido mediante Resolución Administrativa emitida para cobrarse, las fechas de inicio y vencimiento para el pago de la patente municipal ser establecido mediante

                    Resolución Administrativa emitida por la MATM considerando la fecha máxima señalada.
                    <br>
                    PATENTE MUNICIPAL PERMANENTE
                    <br>
                    Sección I

                    <br>
                    Subseccion I
                    <br>

                    Patente Municipal Permanente de Actividades Económicas

                    <h4>ARTICULO DÉCIMO TERCERO.-</h4> (Hecho Generador). Es el desarrollo de una actividad económica de forma permanente.
                    <br>
                    TABLA DE CLASIFICACION POR TIPO DE ACTIVIDAD PARA LA PATENTE DE FUNCIONAMIENTO PERMANENTE

                    GRAN SUB GRUPO DESCRIPCIÓN ARANCEL
                    GRUPO GRUPO PRIMARIO

                    <table align="center" >
                        <tr>
                            <th>GRAN GRUPO</th>
                            <th>SUBGRUPO</th>
                            <th>GRUPO PRIMARIO</th>
                            <th>DESCRIPCION</th>
                            <th>ARANCEL</th>
                        </tr>
                        <tr>
                            <td>10.</td>
                            <td></td>
                            <td></td>
                            <td>PATENTE DE FUNCIONAMIENTO PERMANENTE</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>10.10</td>
                            <td></td>
                            <td>INDUSTRIA</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.10</td>
                            <td>DE BEBIDAS Y PRODUCTOS ESPECIFICOS</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.10.1</td>
                            <td>Elaboración alcohol etílico</td>
                            <td>18451</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.10.2</td>
                            <td>Elaboración aguardiente</td>
                            <td>18451</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.10.3</td>
                            <td>Elaboración cerveza</td>
                            <td>18451</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.10.4</td>
                            <td>Elaboración chicha</td>
                            <td>18451</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.10.6</td>
                            <td>Elaboración singani - pisco</td>
                            <td>18451</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.10.7</td>
                            <td>Elaboración vinos</td>
                            <td>18451</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.10.8</td>
                            <td>Elaboración whisky</td>
                            <td>18451</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.10.9</td>
                            <td>Elaboración coñac</td>
                            <td>18451</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.10.10</td>
                            <td>Elaboración ron</td>
                            <td>18451</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.10.11</td>
                            <td>Elaboración de bebidas alcohólicas destiladas</td>
                            <td>18451</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.10.12</td>
                            <td>Elaboración malteadas y maltas</td>
                            <td>18451</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.10.13</td>
                            <td>Elaboración de tabacos</td>
                            <td>18451</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.10.14</td>
                            <td>Elaboración de refrescos con esencias artificiales</td>
                            <td>17528</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.10.15</td>
                            <td>Embotelladoras</td>
                            <td>17528</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.10.16</td>
                            <td>Manufacturas de artículos de metales preciosos</td>
                            <td>15684</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.10.17</td>
                            <td>Sucursales y Agencias de Bebidas y Productos Específicos</td>
                            <td>6920</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.20</td>
                            <td>ARTESANAL</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.20.1</td>
                            <td>Industria Artesanal y de metal mecánica</td>
                            <td>928</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.20.2</td>
                            <td>Torrefactoras de Café</td>
                            <td>928</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.20.3</td>
                            <td>Metal mecánica</td>
                            <td>494</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.20.4</td>
                            <td>Maestranzas carpintería</td>
                            <td>494</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.20.5</td>
                            <td>Imprentas Ófset artesanal</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.20.6</td>
                            <td>Agencias y sucursales</td>
                            <td>494</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.20.7</td>
                            <td>Hornos de panificación</td>
                            <td>215</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.20.8</td>
                            <td>Molinos artesanales</td>
                            <td>215</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.30</td>
                            <td>OTRAS INDUSTRIAS</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.30.1</td>
                            <td>Industria en general</td>
                            <td>4641</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.30.2</td>
                            <td>Curtiembres</td>
                            <td>4641</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.30.3</td>
                            <td>Fundidoras</td>
                            <td>4641</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.30.4</td>
                            <td>Sucursales y agencias (de industria)</td>
                            <td>1343</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.40</td>
                            <td>ACTIVIDADES DE EDICION, IMPRESION Y REPRODUCCION</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.40.1</td>
                            <td>Actividades de edición</td>
                            <td>4641</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.40.2</td>
                            <td>Actividades de impresión</td>
                            <td>4641</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.10.40.3</td>
                            <td>Actividades de preproducción</td>
                            <td>4641</td>
                        </tr>
                        <tr>
                            <td>10.</td>
                            <td></td>
                            <td></td>
                            <td>PATENTE DE FUNCIONAMIENTO PERMANENTE</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>10.20</td>
                            <td></td>
                            <td>SERVICIOS</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.10</td>
                            <td>FINANCIEROS</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.10.1</td>
                            <td>Bancos</td>
                            <td>9261</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.10.2</td>
                            <td>Mutuales de Ahorro y Crédito</td>
                            <td>9261</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.10.3</td>
                            <td>Cooperativas de Ahorro y Crédito</td>
                            <td>9261</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.10.4</td>
                            <td>Financieras</td>
                            <td>9261</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.10.5</td>
                            <td>Casas de Crédito</td>
                            <td>9261</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.10.6</td>
                            <td>Seguros</td>
                            <td>9261</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.10.7</td>
                            <td>Reaseguros</td>
                            <td>9261</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.10.8</td>
                            <td>Casas de cambio</td>
                            <td>1250</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.10.9</td>
                            <td>Cajeros automáticos</td>
                            <td>867</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.10.19</td>
                            <td>Sucursales y Agencias de establecimientos financieros, seguros y reaseguros</td>
                            <td>6668</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.20</td>
                            <td>DE TRANSPORTE POR VIA TERRESTRE</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.20.1</td>
                            <td>Transporte por vía férrea</td>
                            <td>2770</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.20.2</td>
                            <td>Transporte de pasajeros interdepartamental y larga distancia</td>
                            <td>2770</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.20.3</td>
                            <td>Servicio de Radio Taxis</td>
                            <td>2770</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.20.4</td>
                            <td>Transporte urbano de carga y/o pasajeros</td>
                            <td>2770</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.20.5</td>
                            <td>Transporte de carga interdepartamental y larga distancia</td>
                            <td>2770</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.20.6</td>
                            <td>Sucursales y Agencias por vía terrestre</td>
                            <td>553</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.30</td>
                            <td>DE TRANSPORTE POR VIA AEREA</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.30.1</td>
                            <td>Transporte regular de pasajeros y carga por vía aérea (Internacional)</td>
                            <td>9697</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.30.2</td>
                            <td>Transporte no regular por vía aérea (Alquiler de aeronaves) (Internacional)</td>
                            <td>9697</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.30.3</td>
                            <td>Sucursales y Agencias (Internacional)</td>
                            <td>1939</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.30.4</td>
                            <td>Transporte regular de pasajeros y carga por vía aérea (Nacional)</td>
                            <td>6920</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.30.5</td>
                            <td>Transporte no regular por vía aérea (Alquiler de aeronaves) (Nacional)</td>
                            <td>6920</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.30.6</td>
                            <td>Sucursales y Agencias (Nacional)</td>
                            <td>1384</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.40</td>
                            <td>DE TRANSPORTE COMPLEMENTARIAS Y AUXILIARES; ACTIVIDADES DE AGENCIA DE VIAJES</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.40.1</td>
                            <td>Manipulación de la Carga</td>
                            <td>1939</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.40.2</td>
                            <td>Alquiler de Vehículos automotores</td>
                            <td>1343</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.40.3</td>
                            <td>Agencia de Viajes y organizadores de viajes</td>
                            <td>1343</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.40.4</td>
                            <td>Servicios de Mudanzas</td>
                            <td>553</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.50</td>
                            <td>DE HOTELERIA Y HOSPEDAJE</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.50.1</td>
                            <td>Hoteles de Tres Estrellas</td>
                            <td>10200</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.50.2</td>
                            <td>Hoteles de Dos Estrellas</td>
                            <td>8796</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.50.3</td>
                            <td>Hoteles</td>
                            <td>5541</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.50.4</td>
                            <td>Servicio de Pernocte momentáneo</td>
                            <td>2217</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.50.5</td>
                            <td>Residenciales</td>
                            <td>2217</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.50.6</td>
                            <td>Hostales</td>
                            <td>2217</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.50.7</td>
                            <td>Servicios de Colonias</td>
                            <td>2217</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.50.8</td>
                            <td>Centros de Vacaciones</td>
                            <td>2217</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.50.9</td>
                            <td>Alojamientos</td>
                            <td>831</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.50.10</td>
                            <td>Albergues de pensiones y dormitorios para estudiantes</td>
                            <td>831</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.60</td>
                            <td>ACTIVIDADES DE SERVICIOS SOCIALES</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.60.1</td>
                            <td>Hogares</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.60.2</td>
                            <td>Albergues</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.60.3</td>
                            <td>Orfanatos</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.60.4</td>
                            <td>Centros de Rehabilitación</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.60.5</td>
                            <td>Guardería infantil</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.70</td>
                            <td>PROFESIONALES Y ACTIVIDADES CONEXAS</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.70.1</td>
                            <td>Inmobiliarias</td>
                            <td>6668</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.70.2</td>
                            <td>Servicios de Seguridad y Vigilancia</td>
                            <td>1384</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.70.3</td>
                            <td>Consultoras</td>
                            <td>377</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.70.4</td>
                            <td>Servicio de Investigación y Desarrollo</td>
                            <td>377</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.70.5</td>
                            <td>Servicios de Estudio de Mercado</td>
                            <td>377</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.70.6</td>
                            <td>Notarías</td>
                            <td>195</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.70.7</td>
                            <td>Profesionales</td>
                            <td>195</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.70.8</td>
                            <td>Actividades de Astrología y Espiritismo</td>
                            <td>195</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.70.9</td>
                            <td>Oficinas contables</td>
                            <td>195</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.70.10</td>
                            <td>Gestorías comerciales</td>
                            <td>195</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.70.11</td>
                            <td>Servicios de Internet</td>
                            <td>195</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.70.12</td>
                            <td>Servicio de Transcripciones</td>
                            <td>195</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.80</td>
                            <td>ACTIVIDADES DE ASOCIACIONES</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.80.1</td>
                            <td>Organizaciones empresariales</td>
                            <td>4153</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.80.2</td>
                            <td>Organizaciones profesionales</td>
                            <td>4153</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.90</td>
                            <td>SERVICIOS DE INFRAESTRUCTURA BÁSICA</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.90.1</td>
                            <td>Suministro de Energía Eléctrica</td>
                            <td>9093</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.90.2</td>
                            <td>Suministro de Agua Potable</td>
                            <td>9093</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.90.3</td>
                            <td>Servicio de Alcantarillado</td>
                            <td>9093</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.90.4</td>
                            <td>Suministro de gas natural</td>
                            <td>9093</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.90.5</td>
                            <td>Instalaciones de gas</td>
                            <td>4263</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.90.6</td>
                            <td>Servicio de Construcción</td>
                            <td>5536</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.90.7</td>
                            <td>Contratistas de Albañilería</td>
                            <td>1384</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.90.8</td>
                            <td>Acondicionamiento de Edificios (Instalación de cañerías, eléctrica, ascensores,</td>
                            <td>1384</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.90.9</td>
                            <td>Terminación de Edificios (Revoque, pintura, revestimientos de pisos, decoracion</td>
                            <td>1384</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.90.10</td>
                            <td>Alquiler de Equipo de Construcción</td>
                            <td>1384</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.90.11</td>
                            <td>Agencias y sucursales</td>
                            <td>4263</td>
                        </tr>
                        <tr>
                            <td>10.</td>
                            <td></td>
                            <td></td>
                            <td>PATENTE DE FUNCIONAMIENTO PERMANENTE</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>10.20</td>
                            <td></td>
                            <td>SERVICIOS</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.100</td>
                            <td>SERVICIO DE ADMINISTRACIÓN Y DEPÓSITOS</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.100.1</td>
                            <td>Administración de Aeropuertos</td>
                            <td>6920</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.100.2</td>
                            <td>Almacenes de Depósitos Aduaneros</td>
                            <td>6920</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.100.3</td>
                            <td>Depósitos de Empresas</td>
                            <td>1384</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.100.4</td>
                            <td>Almacenes de Empresas</td>
                            <td>1384</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.100.5</td>
                            <td>Depósito de Transporte Terrestre</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.100.6</td>
                            <td>Depósito de Transporte Aéreo</td>
                            <td>959</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.100.7</td>
                            <td>Depósitos de Servicios de Infraestructura Básica</td>
                            <td>1364</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.100.8</td>
                            <td>Depósitos de Comercio en general</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.110</td>
                            <td>SERVICIOS DE EDUCACION Y CAPACITACION</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.110.1</td>
                            <td>Universidades</td>
                            <td>4153</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.110.2</td>
                            <td>Colegios</td>
                            <td>693</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.110.3</td>
                            <td>Institutos</td>
                            <td>693</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.110.4</td>
                            <td>Academias de Instrucción Cultural</td>
                            <td>693</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.110.5</td>
                            <td>Academias de Instrucción Deportiva</td>
                            <td>693</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.110.6</td>
                            <td>Academias de Teatro y Danza</td>
                            <td>693</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.110.7</td>
                            <td>Bibliotecas</td>
                            <td>192</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.120</td>
                            <td>SERVICIOS DE COMUNICACIÓN PRENSA SIMILARES</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.120.1</td>
                            <td>Telecomunicaciones</td>
                            <td>6920</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.120.2</td>
                            <td>Telefonía</td>
                            <td>6920</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.120.3</td>
                            <td>Cabinas telefónicas</td>
                            <td>1038</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.120.4</td>
                            <td>Agencias y sucursales de telecomunicaciones</td>
                            <td>4982</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.120.5</td>
                            <td>Canales de Televisión</td>
                            <td>5536</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.120.6</td>
                            <td>Antenas de Televisión</td>
                            <td>1038</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.120.7</td>
                            <td>Sucursales y Agencias de Canales de Televisión</td>
                            <td>1038</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.120.8</td>
                            <td>Radio emisoras</td>
                            <td>4153</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.120.9</td>
                            <td>Antenas de Radio</td>
                            <td>1038</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.120.10</td>
                            <td>Sucursales y Agencias de Radio Emisoras</td>
                            <td>1038</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.120.11</td>
                            <td>Medios de Comunicación Escritos</td>
                            <td>4153</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.120.12</td>
                            <td>Sucursales y Agencias Medios de Comunicación Escritos</td>
                            <td>1038</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.120.13</td>
                            <td>Actividades de Marketing y Publicidad</td>
                            <td>1038</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.120.14</td>
                            <td>Conexión de servicios de Internet</td>
                            <td>1038</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.120.15</td>
                            <td>Video cable</td>
                            <td>1038</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.120.16</td>
                            <td>Courier</td>
                            <td>1038</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.130</td>
                            <td>SERVICIOS DE SALUD</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.130.1</td>
                            <td>Hospitales</td>
                            <td>4153</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.130.2</td>
                            <td>Clínicas</td>
                            <td>4153</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.130.3</td>
                            <td>Laboratorios clínicos</td>
                            <td>693</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.130.4</td>
                            <td>Consultorios médicos</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.130.5</td>
                            <td>Asistencias médicas</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.130.6</td>
                            <td>Fisioterapias</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.130.7</td>
                            <td>Acupuntura y masajes</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.130.8</td>
                            <td>Centros de Rehabilitación de salud</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.130.9</td>
                            <td>Enfermerías</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.130.10</td>
                            <td>Naturistas</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.130.11</td>
                            <td>Centros Físicos Culturales de terapia clínica</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.130.12</td>
                            <td>Veterinarias</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140</td>
                            <td>SERVICIOS ESPECIFICOS</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.1</td>
                            <td>Moteles</td>
                            <td>10949</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.2</td>
                            <td>Lenocinios</td>
                            <td>10949</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.3</td>
                            <td>Casas de Compañía</td>
                            <td>10949</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.4</td>
                            <td>Clubes nocturnos</td>
                            <td>10949</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.5</td>
                            <td>Table Dance</td>
                            <td>10949</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.6</td>
                            <td>Boîte</td>
                            <td>10949</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.7</td>
                            <td>Cabaret</td>
                            <td>10949</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.8</td>
                            <td>Wisquerías</td>
                            <td>10949</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.9</td>
                            <td>Peña Restaurant</td>
                            <td>10949</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.10</td>
                            <td>Video bar</td>
                            <td>10949</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.11</td>
                            <td>Piano bar</td>
                            <td>10949</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.12</td>
                            <td>Locales de espectáculos</td>
                            <td>3244</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.13</td>
                            <td>Karaokes</td>
                            <td>3244</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.14</td>
                            <td>Café concierto</td>
                            <td>3244</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.15</td>
                            <td>Discotecas</td>
                            <td>3244</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.16</td>
                            <td>Penas</td>
                            <td>3244</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.17</td>
                            <td>Restaurantes</td>
                            <td>3244</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.18</td>
                            <td>Pub</td>
                            <td>3244</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.19</td>
                            <td>Chifa</td>
                            <td>3244</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.20</td>
                            <td>Churrasquería</td>
                            <td>3244</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.21</td>
                            <td>Bar</td>
                            <td>3244</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.22</td>
                            <td>Cantinas</td>
                            <td>3244</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.23</td>
                            <td>Chicherías</td>
                            <td>3244</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.24</td>
                            <td>Quintas</td>
                            <td>1216</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.25</td>
                            <td>Bar pensiones</td>
                            <td>1216</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.26</td>
                            <td>Chicharronera</td>
                            <td>1216</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.27</td>
                            <td>Fracasaría</td>
                            <td>1216</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.28</td>
                            <td>Parrilleros</td>
                            <td>1216</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.29</td>
                            <td>Locales de fiesta</td>
                            <td>811</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.30</td>
                            <td>Salones para eventos sociales</td>
                            <td>811</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.31</td>
                            <td>Karaokes sin expendio de Bebidas Alcohólicas</td>
                            <td>811</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.32</td>
                            <td>Api videos</td>
                            <td>811</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.33</td>
                            <td>Café videos</td>
                            <td>811</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.34</td>
                            <td>Salones de Té</td>
                            <td>811</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.35</td>
                            <td>Pastelerías</td>
                            <td>811</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.36</td>
                            <td>Confiterías</td>
                            <td>811</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.37</td>
                            <td>Pensiones familiares</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.38</td>
                            <td>Snacks</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.39</td>
                            <td>Broasteres</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.40</td>
                            <td>Rosticerías</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.41</td>
                            <td>Pizzerías</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.42</td>
                            <td>Venta de Comida Rápida</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.140.43</td>
                            <td>Servicio de Té, café y api</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.150</td>
                            <td>DE TALLERES Y MANTENIMIENTO</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.150.1</td>
                            <td>Servicios de Mantenimiento de Maquinaria y Equipo</td>
                            <td>6920</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.150.2</td>
                            <td>Rectificación de motores</td>
                            <td>6920</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.150.3</td>
                            <td>Taller de Mecánica automotriz</td>
                            <td>693</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.150.4</td>
                            <td>Tornerías</td>
                            <td>693</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.150.5</td>
                            <td>Taller de Repujado en aluminio</td>
                            <td>693</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.150.6</td>
                            <td>Taller de Peletería</td>
                            <td>693</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.150.7</td>
                            <td>Taller de reparación de garrafas</td>
                            <td>693</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.150.8</td>
                            <td>Taller de lavado, engrase y fumigado</td>
                            <td>693</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.150.9</td>
                            <td>Taller de Carrocería</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.150.10</td>
                            <td>Taller de Mantenimiento Mecánico</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.150.11</td>
                            <td>Taller de Chapería y pintura</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.150.12</td>
                            <td>Llanteras</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.150.13</td>
                            <td>Muellearías</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.150.14</td>
                            <td>Garajes</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.150.15</td>
                            <td>Reparaciones de electrodomésticos</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.150.16</td>
                            <td>Taller de Balatas</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.150.17</td>
                            <td>Taller eléctrico</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.150.18</td>
                            <td>Taller de Motocicletas</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.150.19</td>
                            <td>Cerrajería</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.150.20</td>
                            <td>Taller de Soldadura</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.150.21</td>
                            <td>Taller de Letreros de Publicidad</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.150.22</td>
                            <td>Taller de Bicicletas</td>
                            <td>159</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.160</td>
                            <td>SERVICIOS DE DISTRACCIÓN</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.160.1</td>
                            <td>Saunas</td>
                            <td>693</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.160.2</td>
                            <td>Gimnasios</td>
                            <td>693</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.160.3</td>
                            <td>Salones de Billar</td>
                            <td>693</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.160.4</td>
                            <td>Salones de Juegos Electrónicos</td>
                            <td>693</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.160.5</td>
                            <td>Salones de Juegos de Atari</td>
                            <td>693</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.160.6</td>
                            <td>Canchas de Racquet</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.160.7</td>
                            <td>Canchas de Wali y voleibol</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.160.8</td>
                            <td>Canchas de Futbol y Futsal</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.160.9</td>
                            <td>Pistas de Patinaje</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.160.10</td>
                            <td>Futbolines</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.160.11</td>
                            <td>Cines</td>
                            <td>1038</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.160.12</td>
                            <td>Cine videos</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.160.13</td>
                            <td>Club de Videos</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.170</td>
                            <td>SERVICIOS FOTOGRÁFICOS</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.170.1</td>
                            <td>Laboratorios fotográficos</td>
                            <td>1038</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.170.2</td>
                            <td>Foto estudio</td>
                            <td>159</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.180</td>
                            <td>SERVICIOS FÚNEBRES</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.180.1</td>
                            <td>Funerarias</td>
                            <td>1038</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.180.2</td>
                            <td>Agencias o sucursales de funerarias</td>
                            <td>480</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.190</td>
                            <td>OTROS SERVICIOS</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.190.1</td>
                            <td>Estilistas y salones de belleza</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.190.2</td>
                            <td>Mingitorios</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.190.3</td>
                            <td>Duchas</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.190.4</td>
                            <td>Tintorerías</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.190.5</td>
                            <td>Fotocopiadoras</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.190.6</td>
                            <td>Limpieza de ropa en seco v vapor</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.20.190.7</td>
                            <td>Lavanderías de ropa por kilos</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td>10.</td>
                            <td></td>
                            <td></td>
                            <td>PATENTE DE FUNCIONAMIENTO PERMANENTE</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>10.30</td>
                            <td></td>
                            <td>COMERCIO</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10</td>
                            <td>COMERCIO EN GENERAL</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.1</td>
                            <td>Venta de Vehículos Automotores en general</td>
                            <td>9261</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.2</td>
                            <td>Distribuidoras de Productos Específicos</td>
                            <td>6920</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.3</td>
                            <td>Importadoras y/o exportadoras</td>
                            <td>6920</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.4</td>
                            <td>Venta de Combustibles líquidos, gaseosos y productos DS</td>
                            <td>6920</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.5</td>
                            <td>Suministro de kerosene</td>
                            <td>1364</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.6</td>
                            <td>Distribuidoras de comercio en general</td>
                            <td>5536</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.7</td>
                            <td>Exportadoras de productos no tradicionales</td>
                            <td>4153</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.8</td>
                            <td>Cámaras frigoríficas</td>
                            <td>2767</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.9</td>
                            <td>Mataderos</td>
                            <td>2767</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.10</td>
                            <td>Super mercados</td>
                            <td>2767</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.11</td>
                            <td>Micro Marquet</td>
                            <td>2767</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.12</td>
                            <td>Agencia de venta en general</td>
                            <td>1384</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.13</td>
                            <td>Venta de Computadoras, fotocopiadoras y accesorios</td>
                            <td>1384</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.14</td>
                            <td>Ferretería.</td>
                            <td>1038</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.15</td>
                            <td>Venta de repuestos automotores en general</td>
                            <td>1038</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.16</td>
                            <td>Venta de partes de automóviles a media uso</td>
                            <td>693</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.17</td>
                            <td>Venta de electrodomésticos</td>
                            <td>1038</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.18</td>
                            <td>Venta de equipos de sonido</td>
                            <td>1038</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.19</td>
                            <td>Barracas</td>
                            <td>1038</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.20</td>
                            <td>Venta de madera en general</td>
                            <td>1038</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.21</td>
                            <td>Venta de Parabrisas</td>
                            <td>1038</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.22</td>
                            <td>Venta de repuestos electrónicos</td>
                            <td>1038</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.23</td>
                            <td>Venta de aparatos telefónicos</td>
                            <td>1038</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.24</td>
                            <td>Venta de alcohol, cerveza y licores en general</td>
                            <td>693</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.25</td>
                            <td>Venta artesanías</td>
                            <td>693</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.26</td>
                            <td>Farmacias</td>
                            <td>693</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.27</td>
                            <td>Venta de productos químicos medicinales</td>
                            <td>693</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.28</td>
                            <td>Venta de insumos médicos, dentales</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.29</td>
                            <td>Venta de productos de medicina natural</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.30</td>
                            <td>Friales</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.31</td>
                            <td>Venta materiales de construcción.</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.32</td>
                            <td>Venta accesorios para vehículos</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.33</td>
                            <td>Almacenes de abarrotes</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.34</td>
                            <td>Venta de café molido</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.35</td>
                            <td>Venta de muelles</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.36</td>
                            <td>Venta de pernos</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.37</td>
                            <td>Venta de llantas</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.38</td>
                            <td>Venta de baterías</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.39</td>
                            <td>Venta de accesorios para automóviles</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.40</td>
                            <td>Venta de productos textiles</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.41</td>
                            <td>Prendas de vestir y calzados</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.42</td>
                            <td>Ópticas</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.43</td>
                            <td>Venta de bicicletas</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.44</td>
                            <td>Venta de artículos deportivos</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.45</td>
                            <td>Venta de Joyas</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.46</td>
                            <td>Mueblerías</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.47</td>
                            <td>Disqueras</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.48</td>
                            <td>Bazares</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.49</td>
                            <td>Venta de cueros y cuerinas</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.50</td>
                            <td>Venta de alfombras y tapizantes</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.51</td>
                            <td>Venta de artefactos sanitarios para baños y cocinas</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.52</td>
                            <td>Venta de polleras</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.53</td>
                            <td>Venta de luces artificiales</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.54</td>
                            <td>Venta de parlantes</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.55</td>
                            <td>Venta material eléctrico</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.56</td>
                            <td>Venta celulares</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.57</td>
                            <td>Venta de libros, revistas</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.58</td>
                            <td>Venta de utensilios de cocina</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.59</td>
                            <td>Venta de venestas</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.60</td>
                            <td>Venta de Parket</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.61</td>
                            <td>Venta de colchones y esponjas</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.62</td>
                            <td>Venta de muebles de maquinas usadas</td>
                            <td>345</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.63</td>
                            <td>Vidrieras</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.64</td>
                            <td>Perfumerías</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.65</td>
                            <td>Boutiques,</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.66</td>
                            <td>Librerías</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.67</td>
                            <td>Imprentas tipográficas</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.68</td>
                            <td>Venta de ataúdes</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.69</td>
                            <td>Venta de tarjetas telefónicas</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.30.10.70</td>
                            <td>Venta de accesorios para celular</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td>10.</td>
                            <td></td>
                            <td></td>
                            <td>PATENTE DE FUNCIONAMIENTO PERMANENTE</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>10.40</td>
                            <td></td>
                            <td>CONTRIBUYENTES MINORISTAS ARTESANOS Y VIVANDEROS</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10</td>
                            <td>ARTESANOS</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.1</td>
                            <td>Hojalaterías</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.2</td>
                            <td>Talleres de tejido</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.3</td>
                            <td>Joyerías</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.4</td>
                            <td>Repujadoras de ollas</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.5</td>
                            <td>Taller de bordados folk16ricos</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.6</td>
                            <td>Carpinterías</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.7</td>
                            <td>Sombrererías</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.8</td>
                            <td>Zapaterías</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.9</td>
                            <td>Tostadora de pasankalla</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.10</td>
                            <td>Elaboración de dulces</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.11</td>
                            <td>Confección de prendas de vestir</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.12</td>
                            <td>Confección de pelotas</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.13</td>
                            <td>Picado v corte de piedra manual</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.14</td>
                            <td>Peltres</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.15</td>
                            <td>Tejidos a maquina</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.16</td>
                            <td>Tapiceros</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.17</td>
                            <td>Orfebres</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.18</td>
                            <td>Marroquinería</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.19</td>
                            <td>Metal mecánica</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.20</td>
                            <td>Cerrajeros</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.21</td>
                            <td>Productores de calzados</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.22</td>
                            <td>Graficas e imprentas</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.23</td>
                            <td>Talladores</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.24</td>
                            <td>Bisutería</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.25</td>
                            <td>Limpieza de ropa</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.26</td>
                            <td>Gráficos en serigrafia</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.27</td>
                            <td>Muellearía</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.28</td>
                            <td>Sastrerías</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.29</td>
                            <td>Talleres de compostura de zapatos</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.30</td>
                            <td>Foto estudios (artesano)</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.31</td>
                            <td>Peluquerías</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.32</td>
                            <td>Salones de belleza (artesano)</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.33</td>
                            <td>Confección de polleras</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.34</td>
                            <td>Modistas</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.35</td>
                            <td>Taller de cerrajería</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.36</td>
                            <td>Taller de soldadura</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.37</td>
                            <td>Taller de fundición</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.38</td>
                            <td>Taller de herrería</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.39</td>
                            <td>Taller de radiotécnicos</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.10.40</td>
                            <td>Taller compostura de prendas de vestir</td>
                            <td>202</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20</td>
                            <td>COMERCIO MINORISTA</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.1</td>
                            <td>Venta de condimentos</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.2</td>
                            <td>Venta de estuco</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.3</td>
                            <td>Venta de dulces</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.4</td>
                            <td>Venta de lanas</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.5</td>
                            <td>Verdulerías</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.6</td>
                            <td>Venta de pollos</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.7</td>
                            <td>Tambos</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.8</td>
                            <td>Venta de huevos</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.9</td>
                            <td>Venta de ropas usadas</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.10</td>
                            <td>Venta de hierbas medicinales</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.11</td>
                            <td>Venta de cosméticos y artículos de tocador</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.12</td>
                            <td>Venta de lubricantes</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.13</td>
                            <td>Venta de artículos fotográficos</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.14</td>
                            <td>Venta de cotillones</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.15</td>
                            <td>Carnicerías</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.16</td>
                            <td>Venta de semillas</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.17</td>
                            <td>Venta de regalos</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.18</td>
                            <td>Venta de artículos de zapatería</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.19</td>
                            <td>Venta de puertas v ventanas</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.20</td>
                            <td>Compra y venta de moneda extranjera v otros</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.21</td>
                            <td>Tienda de pulpería</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.22</td>
                            <td>Tienda de chiflaría</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.23</td>
                            <td>Venta de ladrillos</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.24</td>
                            <td>Venta de fertilizantes</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.25</td>
                            <td>Venta de bolsas plásticas</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.26</td>
                            <td>Venta de productos para mueblería</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.27</td>
                            <td>Venta de salteñas</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.28</td>
                            <td>Venta de artículos varios (al por menor)</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.29</td>
                            <td>Venta de artículos plásticos</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.30</td>
                            <td>Venta de repuestos electrónicos</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.31</td>
                            <td>Venta de juguetes menudos</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.32</td>
                            <td>Venta de alimentos balanceados</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.33</td>
                            <td>Venta de pasteles</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.34</td>
                            <td>Venta de galletas</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.35</td>
                            <td>Venta de cereales</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.36</td>
                            <td>Venta de productos lácteos</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.37</td>
                            <td>Venta de cristalería</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.38</td>
                            <td>Venta de pasankalla</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.20.39</td>
                            <td>Venta de tarjetas</td>
                            <td>225</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.30</td>
                            <td>VIVANDEROS</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>10.40.30.1</td>
                            <td>Fondas</td>
                            <td>225</td>
                        </tr>
                    </table>

                    TABLAS DE PARAMETROS DE PONDERACION

                    1. TABLA DE PARAMETROS PARA COMERCIO Y SERVICIOS

                    Ponderación para el cálculo de patente anual por zona de Ubicación y superficie.
                    <br>
                    FORMULA:
                    <br>
                    PATENTE= P. Max (% Zona + % Superficie)
                    <br>
                    1.- ZONIFICACION

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;ZONA "A" 50%
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;ZONA "B" 30%
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;ZONA "C"20%
                    <br>
                    2.- SUPERFICIE

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1 A 30 20%
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;31 A 100 30%
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;101 A 300 40%
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;301 Adelante 50%
                    <br> 2. TABLA DE PARAMETROS PARA LA INDUSTRIA

                    <br>
                    1. - ZONIFICACION

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;ZONA "A" 40%
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;ZONA "B" 30%
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;ZONA"C" 20%
                    <br>
                    2.- SUPERFICIE
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1 A 800 20%
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;801 A 1600 30%
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1601 Adelante 60%
                    <br>
                    <br> 3. TABLA DE PARAMETROS PARA SERVICIOS SOCIALES Y DE TURISMO
                    <br>
                    1.- ZONIFICACION

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;ZONA "A" 40%
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;ZONA "B" 30%
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;ZONA"C" 20%
                    <br>
                    2.- SUPERFICIE
                    <br>

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1 A 600 20%
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;601 A 1200 30%
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1201 Adelante 60%
                    <br> 4. TABLA DE PARAMETROS PARA CONTRIBUYENTES MINORISTAS, ARTESANOS Y VIVANDEROS.
                    <br>

                    <table>
                        <thead>
                            <tr>
                                <th>Espacio Físico Ocupado en M2</th>
                                <th>ARTESANOS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1 a 6</td>
                                <td>60</td>
                            </tr>
                            <tr>
                                <td>7 a 13</td>
                                <td>92</td>
                            </tr>
                            <tr>
                                <td>14 a 20</td>
                                <td>122</td>
                            </tr>
                            <tr>
                                <td>21 a 26</td>
                                <td>152</td>
                            </tr>
                            <tr>
                                <td>27 a 30</td>
                                <td>202</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <table>
                        <thead>
                            <tr>
                                <th>Espacio Físico Ocupado en M2</th>
                                <th>COMERCIANTES MINORISTAS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1 a 6</td>
                                <td>55</td>
                            </tr>
                            <tr>
                                <td>7 a 13</td>
                                <td>110</td>
                            </tr>
                            <tr>
                                <td>14 a 20</td>
                                <td>148</td>
                            </tr>
                            <tr>
                                <td>21 a 26</td>
                                <td>184</td>
                            </tr>
                            <tr>
                                <td>27 a 30</td>
                                <td>225</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <table>
                        <thead>
                            <tr>
                                <th>Espacio Físico Ocupado en M2</th>
                                <th>VIVANDEROS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1 a 6</td>
                                <td>70</td>
                            </tr>
                            <tr>
                                <td>7 a 13</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>14 a 20</td>
                                <td>135</td>
                            </tr>
                            <tr>
                                <td>21 a 26</td>
                                <td>173</td>
                            </tr>
                            <tr>
                                <td>27 a 30</td>
                                <td>225</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <br>
                    ARTESANOS
                    <br>

                    5. ZONIFICACION DE LA CIUDAD DE EL ALTO PARA EL CALCULO DE LA PATENTE

                    <h5>ZONA "A"</h5>
                    <ul>
                        <li>12 DE OCTUBRE</li>
                        <li>16 DE JULIO</li>
                        <li>AADA AEROPUERTO</li>
                        <li>ALTO CORAZON DE JESUS</li>
                        <li>BARRIO MINERO</li>
                        <li>BOLIVAR A</li>
                        <li>BOLIVAR B</li>
                        <li>BOLIVAR E</li>
                        <li>BOLIVAR YKK</li>
                        <li>BORIS BANZER</li>
                        <li>FERRO PETROL</li>
                        <li>MILLUNI PLAN 129</li>
                        <li>URBANIZACION FERROVIARIA</li>
                        <li>VILLA DOLORES</li>
                        <li>VIV. OBRERA FERROVIARIA</li>
                        <li>ZONAS ADYACENTES</li>
                        <li>LALENGUETA</li>
                    </ul>

                    <h5>ZONA "B"</h5>
                    <ul>
                        <li>BALLIVIAN</li>
                        <li>BOLIVAR C</li>
                        <li>BOLIVAR D</li>
                        <li>BOLIVAR F</li>
                        <li>CIUDAD SATELITE</li>
                        <li>FARO MURILLO</li>
                        <li>LOS ANDES</li>
                        <li>PACAJES</li>
                        <li>ROSAS PAMPA</li>
                        <li>SANTIAGO I</li>
                        <li>SANTIAGO II</li>
                        <li>SONATEX</li>
                        <li>TEJADA RECTANGULAR</li>
                        <li>TEJADA TRIANGULAR</li>
                        <li>TUNARI FAB</li>
                        <li>VILLA AVAROA</li>
                        <li>VILLA TUNARI</li>
                        <li>ZONAS ADYACENTES</li>
                        <li>F. CRUCE V. ADELA</li>
                    </ul>

                    <h5>ZONA C</h5>
                    <ul>
                        <li>2 DE ABRIL</li>
                        <li>2 DE FEBRERO</li>
                        <li>3 DE MAYO</li>
                        <li>6 DE AGOSTO</li>
                        <li>6 DE JUNIO</li>
                        <li>7 DE SEPTIEMBRE</li>
                        <li>8 DE JUNIO</li>
                        <li>9 DE ABRIL JICHUCIRCA</li>
                        <li>14 DE SEPTIEMBRE</li>
                        <li>14 DE SEPTIEMBRE SENKATA</li>
                        <li>16 DE FEBRERO</li>
                        <li>16 DE NOVIEMBRE</li>
                        <li>16 DE NOVIEMBRE ANEXO</li>
                        <li>21 DE DICIEMBRE</li>
                        <li>23 DE MARZO</li>
                        <li>24 DE DICIEMBRE</li>
                        <li>24 DE JUNIO</li>
                        <li>25 DE DICIEMBRE</li>
                        <li>25 DE JULIO</li>
                        <li>BARRIO LINDO</li>
                        <li>BARRIO MADRID</li>
                        <li>BARRIO PREFECTURAL</li>
                        <li>BARTOLINA SISA</li>
                        <li>BAUTISTA SAAVEDRA</li>
                        <li>BOLIVAR MUNICIPAL</li>
                        <li>BUENA VISTA</li>
                        <li>CALAMA</li>
                        <li>CALUYO</li>
                        <li>CAMACHO</li>
                        <li>CANDELARIA</li>
                        <li>CESAR AUGUSTO</li>
                        <li>COLECTIVEROS</li>
                        <li>COLQUIRI</li>
                        <li>COMANDO MILITAR</li>
                        <li>COMSUR</li>
                        <li>CONAVI</li>
                        <li>CONCEPCION</li>
                        <li>CONO SUR</li>
                        <li>CONVI</li>
                        <li>ESTHER</li>
                        <li>ESTRELLA DE BELEN</li>
                        <li>EXALTACION I, II, III</li>
                        <li>EXCOMBATIENTES</li>
                        <li>FATRAVI</li>
                        <li>FORNO</li>
                        <li>FRANZ TAMAYO</li>
                        <li>GERMAN BUSCH I, II, III</li>
                        <li>GERMAN BUSCH OESTE</li>
                        <li>GRAN PODER</li>
                        <li>GRAN PODER COMPLEMENTO</li>
                        <li>GRAN PODER DE SEQUE RELE</li>
                        <li>HORIZONTES CONVIFAG</li>
                        <li>HUAYNA POTOSI</li>
                        <li>HUAYNA POTOSI ANEXO</li>
                        <li>ILLAMPU</li>
                        <li>ILLIMANI BAJO</li>
                        <li>INTI</li>
                        <li>25 DE JULIO SENKATA</li>
                        <li>COOPERATIVA SAN ROQUE</li>
                        <li>INTI RAYMI</li>
                        <li>25 DE JULIO SUR ACHIRI</li>
                        <li>AIDITA</li>
                        <li>ALCINANCLAS</li>
                        <li>ALPACOMA</li>
                        <li>ALTO DE LA ALIANZA</li>
                        <li>ALTO LA PORTADA</li>
                        <li>ALTO LIMA, I, II, III, IV</li>
                        <li>ALTO SAID VILLA VICTORIA</li>
                        <li>ALUBOL</li>
                        <li>AMERICA</li>
                        <li>AMIG CHACO</li>
                        <li>AMOR DEDIOS</li>
                        <li>ANTOFAGASTA</li>
                        <li>ARCO IRIS</li>
                        <li>AROMA</li>
                        <li>ASUNCION SAN PEDRO</li>
                        <li>ASUNCION YUNGUYO</li>
                        <li>ATIPIRIS</li>
                        <li>BANCO INDUSTRIAL</li>
                        <li>BARRIO LINDO ANEXO MARCASA</li>
                        <li>COPAC</li>
                        <li>COPACABANA</li>
                        <li>CHIJINI</li>
                        <li>CORAZON DE JESUS</li>
                        <li>COSMOS 77, 78, 79</li>
                        <li>COSMOS 79 F</li>
                        <li>CRISTAL</li>
                        <li>CRISTAL II</li>
                        <li>CRUZ DEL SUR</li>
                        <li>CUPILUPACA</li>
                        <li>CHARAPAQUI BAJO</li>
                        <li>CHARAPAQUI II</li>
                        <li>CHARAPAQUI MUNICIPAL</li>
                        <li>CHIJIMARCA</li>
                        <li>EL CARMEN SENKATA</li>
                        <li>EL MIRADOR SENKATA</li>
                        <li>EL PARAISO</li>
                        <li>EL PORVENIR</li>
                        <li>EL TEJAR</li>
                        <li>EL TEJAR NORTE</li>
                        <li>ELIZARDO PEREZ SAN ROQUE</li>
                        <li>JAIME PAZ ZAMORA</li>
                        <li>JANCO KALANI</li>
                        <li>JARDIN</li>
                        <li>JARDIN 81</li>
                        <li>JERUSALEN</li>
                        <li>JESUS OBRERO</li>
                        <li>JUANCITO PINTO</li>
                        <li>JULIANA</li>
                        <li>JUNTHUMA</li>
                        <li>JUNTHUMA I, II</li>
                        <li>KENKO</li>
                        <li>KHANTATI</li>
                        <li>KISWARAS</li>
                        <li>LA MERCED</li>
                        <li>LAS DELICIAS</li>
                        <li>LIBERTAD</li>
                        <li>LITORAL</li>
                        <li>LITORAL SENKATA</li>
                        <li>LOS PINOS</li>
                        <li>LOS POSITOS</li>
                        <li>LUIS ESPINAL ALTO CHIJINI</li>
                        <li>MARCELINA</li>
                        <li>MARISCAL SANTA CRUZ</li>
                        <li>MARISCAL SUCRE</li>
                        <li>MEJILLONES</li>
                        <li>MERCEDARIO</li>
                        <li>MERCEDES SENKATA</li>
                        <li>MERCURIO</li>
                        <li>MIGUELITO</li>
                        <li>MILLUNI</li>
                        <li>MILLUNI SANTIAGO NUEVO</li>
                        <li>MINISTERIO DE DEFENSA</li>
                        <li>MUCOPOL</li>
                        <li>MURURATA</li>
                        <li>NATIVIDAD</li>
                        <li>NATIVIDAD COMPLEMENTO</li>
                        <li>NATIVIDAD CHARAPAQUI</li>
                        <li>NUCLEO BRASIL</li>
                        <li>NUEVA JERUSALEN</li>
                        <li>NUEVA JERUSALEN NORTE</li>
                        <li>NUEVAMARCA</li>
                        <li>NUEVA TILATA</li>
                        <li>SAN SALVADOR</li>
                        <li>SAN SEBASTIAN</li>
                        <li>SAN SEBASTIAN I, II</li>
                        <li>SANTA FE</li>
                        <li>SANTA FE COMPLEMENTO</li>
                        <li>SANTA ISABEL</li>
                        <li>SANTA ROSA</li>
                        <li>SANTA ROSA DE LIMA</li>
                        <li>SANTIAGO CONVIFAG</li>
                        <li>SENAC</li>
                        <li>SENKATA</li>
                        <li>SENKATA 79</li>
                        <li>SENKATA PUCARANI</li>
                        <li>SEÑOR DE LAGUNAS</li>
                        <li>SOL PARCOPATA</li>
                        <li>SOLAR</li>
                        <li>STRONGEST</li>
                        <li>TAHUANTINSUYO</li>
                        <li>TAHUANTINSUYO ANEXO</li>
                        <li>TARAPACA</li>
                        <li>TEJADA ALPACOMA</li>
                        <li>URB. ARGENTINA RIO SECO</li>
                        <li>EL PROGRESO</li>
                        <li>EL PORVENIR I</li>
                        <li>EL PROGRESO</li>
                        <li>21 DE SEPTIEMBRE</li>
                        <li>LAGUNAS ECOLOGICOS</li>
                        <li>NUEVO AMANECER</li>
                        <li>IMPERIAL</li>
                        <li>ALAMOS</li>
                        <li>LAS NIEVES</li>
                        <li>27 DE MAYO</li>
                        <li>NESTOR PAZ ZAMORA CHIJINI ALTO</li>
                        <li>SAN MARTIN DE PORRES</li>
                        <li>AGUA DE LA VIDA I</li>
                        <li>AGUA DE LA VIDA II</li>
                        <li>LORETO</li>
                        <li>LOTES Y SERVICIOS - RIO SECO</li>
                        <li>NUEVA TILATA SEC. I</li>
                        <li>TILATA</li>
                        <li>NUEVOS HORIZONTES I, II, III</li>
                        <li>TOCOPILLA RIO SECO</li>
                        <li>ORIENTAL</li>
                        <li>TOPATER</li>
                        <li>ORO NEGRO</li>
                        <li>TUNARI</li>
                        <li>PANAMERICANA</li>
                        <li>TUNARI ANEXO</li>
                        <li>PANORAMICA I, II</li>
                        <li>PARAISO</li>
                        <li>PEDRO DOMINGO MURILLO</li>
                        <li>PLAN 50</li>
                        <li>CINEMATOGRAFOS</li>
                        <li>PORVENIR</li>
                        <li>PRADOS DE VENTILLA</li>
                        <li>PRIMAVERA</li>
                        <li>PRIMERO DE MAYO</li>
                        <li>PROGRESO</li>
                        <li>PUCARANI</li>
                        <li>PUCARANI SEC. INDUSTRIAL</li>
                        <li>PUCHOCOLLO</li>
                        <li>REMEDIOS</li>
                        <li>RIOSECO</li>
                        <li>RIO SECO DIST. 1 - 9</li>
                        <li>ROMERO PAMPA</li>
                        <li>SAJAMA</li>
                        <li>SAN ANTONIO JICHUSI</li>
                        <li>SAN CRISTOBAL</li>
                        <li>SAN FELIPE DE SEQUE</li>
                        <li>SAN JOSE CHARAPAQUI</li>
                        <li>SAN JOSE DE YUNGUYO</li>
                        <li>EL ALTO - BOLIVIA • 14 de Junio de 2005</li>
                        <li>TUNARI FAB</li>
                        <li>TUPAC KATARI</li>
                        <li>UNIDADES VECINALES D.E.</li>
                        <li>URBANIZACION CLUB DE MADRES</li>
                        <li>URBANIZACION DE QUINO</li>
                        <li>URBANIZACION JUANA AZURDUY</li>
                        <li>URKUPINA</li>
                        <li>VALEROS</li>
                        <li>VENTILLA</li>
                        <li>VENTILLA I</li>
                        <li>VERACRUZ</li>
                        <li>VILA VILA</li>
                        <li>VILLA ADELA</li>
                        <li>VILLA ADELA ALE MANA</li>
                        <li>VILLA ADELA CONAVI</li>
                        <li>VILLA ADELA CONVIFAG</li>
                        <li>VILLA ADELA MOJON COLLPANI</li>
                        <li>VILLA ADELA YUNGUYO</li>
                        <li>VILLA DOLORES</li>
                        <li>VILLA ESPERANZA</li>
                        <li>VILLA INGAVI</li>
                        <li>VILLA INGENIO</li>
                        <li>SAN JUAN</li>
                        <li>SAN JUAN RIO SECO</li>
                        <li>SAN LUIS II</li>
                        <li>SAN LUIS II CHARAPAQUI</li>
                        <li>SAN LUIS PAMPA</li>
                        <li>SAN LUIS PRIMERO DE MAYO</li>
                        <li>SAN LUIS TASA</li>
                        <li>SAN LUIS ZONGO</li>
                        <li>SAN MARTIN DE PORRES</li>
                        <li>SAN NICOLAS</li>
                        <li>SAN PABLO</li>
                        <li>SAN PEDRO</li>
                        <li>SAN PEDRO SENKATA</li>
                        <li>VILLA INGENIO I, II</li>
                    </ul>
                    <br>
                    Sub Sección II

                    PATENTE MUNICIPAL PERMANENTE EN SITIO PÚBLICO

                    <h4>ARTICULO DÉCIMO CUARTO.-</h4> (Hecho Generador). Es el desarrollo de una actividad de forma perma­nente en un bien de sitio público.
                    TABLA PARA LA PATENTE MUNICIPAL PERMANENTE EN SITIO PUBLICO
                    <table border="1">
                        <tr>
                            <th>GRAN GRUPO</th>
                            <th>SUBGRUPO</th>
                            <th>GRUPO PRIMARIO</th>
                            <th>DESCRIPCION</th>
                            <th>ARANCEL</th>
                        </tr>
                        <tr>
                            <td>20 </td>
                            <td>20.10</td>
                            <td></td>
                            <td>PATENTE DE FUNCIONAMIENTO PERMANENTE EN SITIO PUBLICO</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td> </td>
                            <td></td>
                            <td>20.10.10</td>
                            <td>EXTRACCION DE ARIDOS EN LECHOS DE RIO</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td> </td>
                            <td></td>
                            <td>20.10.10.1</td>
                            <td>Por extracción de arena, tierra, cascajo, piedra y similares Industrial (Anual)</td>
                            <td>1066</td>
                        </tr>
                        <tr>
                            <td> </td>
                            <td></td>
                            <td>20.10.10.2</td>
                            <td>Individual (anual)</td>
                            <td>213</td>/
                        <tr>
                        <tr>
                            <td> </td>
                            <td></td>
                            <td>20.10.10.3</td>
                            <td>Colectivo (por participante/anual)</td>
                            <td>160</td>
                        </tr>
                    </table>
                    <br>
                    Sección II

                    PATENTE MUNICIPAL A LA PUBLICIDAD Y PROPAGANDA

                    Sub Sección I

                    PATENTE MUNICIPAL A LA PUBLICIDAD Y PROPAGANDA PERMANENTE Y EVENTUAL

                    <br>
                    <h4>ARTICULO DECIMO QUINTO.-</h4> (Hecho Generador). La exhibición y difusi6n de publicidad y propaganda de forma permanente o eventual

                    <table>
                        <tr>
                            <th>GRAN GRUPO</th>
                            <th>SUB GRUPO</th>
                            <th>GRUPO PRIMARIO</th>
                            <th>DESCRIPCION</th>
                            <th>ARANCEL</th>
                        </tr>
                        <tr>
                            <td>30.</td>
                            <td></td>
                            <td></td>
                            <td>PUBLICIDAD Y PROPAGANDA FRP = 2131 Se anexa tabla 1 de Ponderación de Elementos Publicitarios Fijos</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>30.10</td>
                            <td></td>
                            <td>PUBLICIDAD Y PROPAGANDA PERMANENTE</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.10.10</td>
                            <td>PUBLICIDAD PERMANENTE­ EN PUNTO DE VENTA. Un letrero de identificación de hasta 1,50 m2 pagará solo por el</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.10.10.1</td>
                            <td>Letrero Simple m2 a0 (0,03 FRP)</td>
                            <td>64</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.10.10.2</td>
                            <td>Letrero mural m2/ani0 (0,03 FRP)</td>
                            <td>64</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.10.10.3</td>
                            <td>Letrero Luminoso m2/ an0 - (0,031 FRP) 1 cara</td>
                            <td>66</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.10.10.4</td>
                            <td>Letrero Luminoso m2/ año (0,063 FRP) - 2 caras</td>
                            <td>134</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.10.10.5</td>
                            <td>Kioscos (0,04 FRP) por unid/año</td>
                            <td>85</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.10.10.6</td>
                            <td>Anaqueles (0,0095 FRP) por unid/año</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.10.10.7</td>
                            <td>Toldos -- (0,04) unid/año</td>
                            <td>85</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.10.10.8</td>
                            <td>Máquinas expendedoras (0,05 FRP) Unid/año</td>
                            <td>107</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.10.20</td>
                            <td>PUBLICIDAD PERMANENTE. Se cobrará de acuerdo a la TABLA 1 de ponderación de elementos publicitarios fijos</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.10.20.1</td>
                            <td>Torre Unipolar Especial Prisma Multi pantallas, led luminoso, tablero electrónico y otros de</td>
                            <td>319</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.10.20.2</td>
                            <td>Torre Unipolar - (Para 40 m2 de Sup) m2/año</td>
                            <td>159</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.10.20.3</td>
                            <td>Paletas ~ Banderolas y Vallas pequeñas, 1 1 2 2 (Sup. 3m2) m2/año</td>
                            <td>309</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.10.20.4</td>
                            <td>Estructura Monumental - (Vol 25 m3)-m3/año</td>
                            <td>158</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.10.20.5</td>
                            <td>Vallas - (27 m2) - m2/año</td>
                            <td>62</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.10.20.6</td>
                            <td>Tótems - (8 m2)- m2/aro</td>
                            <td>116</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>30.20</td>
                            <td>PUBLICIDAD Y PROPAGANDA EVENTUAL</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.20.10</td>
                            <td>Pancartas, pasacalles, publicidad colocada en los muros o colgada; de tela, lona, plástico u</td>
                            <td>53</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.20.10.2</td>
                            <td>Banderas y banderines hasta 5 m2 (0,025 FRP) Por Mes</td>
                            <td>53</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.20.10.3</td>
                            <td>Inflables (0,0125 FRP) Por día</td>
                            <td>27</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.20.10.4</td>
                            <td>Inflables a partir de 15 días. (0,0055 FRP) Por Dia</td>
                            <td>12</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.20.10.5</td>
                            <td>Impresos, fotocopias u otro tipo de multicopiados (folletos, panfletos, trípticos y símil.)</td>
                            <td>11</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.20.10.6</td>
                            <td>Mayor a 33x21.5 cm por impresión hasta 1000 Unid. (0,01 FRP)</td>
                            <td>21</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.20.10.7</td>
                            <td>Publicidad en eventos: kermeses, ferias, actividades conmemorativas, para recaudación de fondos </td>
                            <td>11</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.20.10.8</td>
                            <td>A partir de 15 días consecutivos (0,0023 FRP) Por día</td>
                            <td>5</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.20.10.9</td>
                            <td>Publicidad y propaganda audiovisual por día</td>
                            <td>5</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>30.20.10.1</td>
                            <td>(0,0052 FRP) Mas de 15 días consecutivos (0,0023 FRP) Por día</td>
                            <td>11</td>
                        </tr>
                    </table>

                    <br>Sub Sección II

                    <br>PATENTE MUNICIPAL A LA PUBLICIDAD Y PROPAGANDA PERMANENTE Y EVENTUAL EN SITIO PUBLICO

                    <br>
                    <h4>ARTICULO DÉCIMO SEXTO.-</h4> (Hecho Generador). La exhibición y difusión de publicidad y propaganda de forma permanente o eventual en un bien de sitio publico.
                    <br>
                    TABLA DE CLASIFICACION POR TIPO DE ACTIVIDAD-PUBLICIDAD URBANA EN SITIO PUBLICO

                    <table>
                        <tr>
                            <th>GRAN GRUPO</th>
                            <th>SUBGRUPO</th>
                            <th>GRUPO PRIMARIO</th>
                            <th>DESCRIPCION</th>
                            <th>ARANCEL</th>
                        </tr>
                        <tr>
                            <td>40.</td>
                            <td></td>
                            <td></td>
                            <td>PUBLICIDAD Y PROPAGANDA FRP = 2131 Se anexa Tabla 1 de Ponderación de Elementos Publicitarios Fijos.</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>40.10</td>
                            <td></td>
                            <td>PUBLICIDAD PERMANENTE EN PUNTO DE VENTA.EN SITIO PUBLICO Un letrero de identificación de hasta 1,50 m2 pa</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.10.10</td>
                            <td>Letrero Simple m2 año (0,04FRP)</td>
                            <td>85</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.10.10.1</td>
                            <td>Letrero mural m2/año (0,04FRP)</td>
                            <td>85</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.10.10.2</td>
                            <td>Letrero Luminoso m2/ año - (0,041 FRP) 1 cara</td>
                            <td>87</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.10.10.3</td>
                            <td>Letrero Luminoso m2/ año (0,073FRP) - 2 caras</td>
                            <td>156</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.10.10.4</td>
                            <td>Kioscos (0,05 FRP) por unid/ano</td>
                            <td>107</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.10.10.5</td>
                            <td>Anaqueles (0,0195 FRP) por unidad</td>
                            <td>42</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.10.10.6</td>
                            <td>Toldos -- (0,05) unidad</td>
                            <td>107</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.10.10.7</td>
                            <td>Máquinas expendedoras (0,06 FRP) Unid/a1o</td>
                            <td>128</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.10.20</td>
                            <td>PUBLICIDAD PERMANENTE EN SITIO PUBLICO Se cobrara de acuerdo a la TABLA 1 de ponderación de elementos publicitarios públicos (Anexo) los indicados son referenciales, corresponden a los parámetros mas altos (categoría 1 , doble vista y superficie indicada)</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.10.20.1</td>
                            <td>Torre Unipolar Especial - Prisma Multi pantallas, led luminoso, tablero electrónico y otros</td>
                            <td>779</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.10.20.2</td>
                            <td>Torre Unipolar - (Para 40 m2 de Sup) m2/año</td>
                            <td>479</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.10.20.3</td>
                            <td>Paletas ~ Banderolas y Vallas pequeñas (Sup 3m2) m2/año</td>
                            <td>426</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.10.20.4</td>
                            <td>Estructura Monumental - (Vol 25 m3)-m3/an0</td>
                            <td>767</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.10.20.5</td>
                            <td>Vallas - (27 m2) - m2/año</td>
                            <td>158</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.10.20.6</td>
                            <td>Tótems - (8 m2)- m2/an1o</td>
                            <td>120</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>40.20</td>
                            <td></td>
                            <td>PUBLICIDAD y PROPAGANDA EVENTUAL EN SITIO PUBLICO</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.20.10</td>
                            <td>Pancartas, pasacalles, publicidad colocada en los muros o colgada; de tela, lona, plástico</td>
                            <td>16</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.20.10.1</td>
                            <td>A partir de 15 días (0,0052 FRP)unid/día</td>
                            <td>11</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.20.10.2</td>
                            <td>Banderas y banderines hasta 10 m2/día (0,0075 FRP)</td>
                            <td>16</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.20.10.3</td>
                            <td>A partir de 15 días (0,0052FRP) Por día</td>
                            <td>11</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.20.10.4</td>
                            <td>Inflables por día (0,0225FRP)</td>
                            <td>48</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.20.10.5</td>
                            <td>Inflables a partir de 15 días. (0,0155) Por Dia</td>
                            <td>33</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.20.10.6</td>
                            <td>Impresos, fotocopias u otro tipo de multicopiados (folletos, panfletos, trípticos y símil.</td>
                            <td>32</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.20.10.7</td>
                            <td>Mayor a 33x21.5 cm por impresión hasta 1000 Unid. (0,02FRP)</td>
                            <td>43</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.20.10.8</td>
                            <td>Publicidad en eventos: kermeses, ferias, actividades conmemorativas, festivales, promoción</td>
                            <td>23</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.20.10.1</td>
                            <td>A partir de 15 días consecutivos (0,0052 FRP) Por día</td>
                            <td>11</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.20.10.1</td>
                            <td>Publicidad y propaganda audiovisual por día (0,0152 FRP)</td>
                            <td>32</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>40.20.10.1</td>
                            <td>Mas de 15 días consecutivos (0,0152 FRP) Por día</td>
                            <td>11</td>
                        </tr>
                    </table>

                    <!-- ================================================= PARA MEJORAR TABLAS ============================================================== -->

                    TABLA 1 DE PONDERACION DE ELEMENTOS PUBLICITARIOS<br>
                    PATENTES DE PUBLICIDAD Y PROPAGANDA (TOTAL ANUAL)<br>

                    ESTRUCTURAS DE UN SOPORTE ESTRUCTURAS MONUMENTALES ESTRUCTURAS DE DOS O IIAS S0P0RTES
                    TORRE UNIP ESPECIAL
                    TORRE UNIPOLAR A EN TERRAZAS O CUBIERTAS PALETABANDEROLAS/
                    TORRE UNIPOLAR B VALLA PEQUEA
                    TORRE UNIPOLAR C VOLÚMENES EN GRAL VALLAS CAMINERAS
                    PALETA/BANDEROLA TOTEMS

                    Clasificación DESCRIPCIÓN VALOR INDICE INDICE DETERMINADO
                    A SU ACABADO
                    PRISMA MULTIPANTALLAS, AVISOS DE ALTA TENSION, FIBRA OPTICA, LED LUMINOSO, 2.75
                    TABLEROS ELECTRONICOS Y OTROS DE ALTA Tecnóloga. (Torre Unipolar Especiales)
                    VOLUMENES EN DIFERENTES MATERIALES (HA, plancha, acero,etc) 0.70
                    GIGANTOGRAF\AS en general
                    SUPERFICIE DESDE 40 M2 0.75
                    SUP DESDE 10 HASTA 40 M2 0.30
                    PANAFLEX (SIMIL) TEXTOS ADHERIDOS YIO FIGURAS SIMPLES. SUPERFICIES MENORES A 10 M2 0.20
                    PINTADOS EN SUPERFICIES RIGIDAS (PLANCHA, MADERA CONCRETO ETC) 0.15
                    COMBINACION DE MATERIALES 0.20
                    B SUS DIMENSIONES

                    Altura expuesta Soporte Superficie m2 (corresponde a una sola cara)
                    de 8 a 10 metros 1 desde40 m2 1.20
                    de 6 a 8 1 desde 18 hasta menos 40m2 0.65
                    de 4a 5.50 mts. 1 de 3 a 18 m2 0.20
                    de 0.50 a4mts 1 o 2 de 0.20 a 3 m2 0.10
                    desde2,5mts.() 1 o 2 de 2 a 10 m2 0.20
                    de 0,3 a 5 mts 2 o mas de 18 a 40 m2 0.333
                    no tiene corrido de 2 a 8m2 0.10
                    PARA ESTRUCTURAS volúmenes menos de 25 m3 0.30
                    MONUMENTALES volumen desde 25 m3 1.25

                    RIGIDO( Metal, plancha, madera, etc) 0.03
                    FLEXIBLES (Panaflex, lonas, otras fibras) sobre estructura de soporte (armazón) 0.02
                    FLEXIBLES (Panaflex, lonas, otras fibras) sobre superficie rígida (Plancha) 0.03

                    EN SITIO PÚBLICO (realizar la siguiente operación)
                    Superficie mas altura de exposición De acuerdo al resultado obtenido dividir entre =
                    40 + 10 = 50 dese 50(Torres Unip.Esp)..-. . 8.30*
                    Desde 50y Vol mayor a 25m3* .. . 12.43*
                    mas de 40, hasta menos de50.... 20.48*
                    mas de 30y.hasta 40 28.53*
                    mas de 20 hasta 30 36.58*
                    desde····5,5·-hasta 20 45.83\_
                    menos de 5.50 v tótems Constante 0.02
                    En Estructuras monumentales considerar el Volumen (EJ 25m3) y dividirlo entre 6.22

                    OTROS SITIOS 0.01
                    En estructuras monumentales en vez de la superficie considerar el volumen COEFICIENTE OBTENIDO 0.00

                    CATEGORIA 1 CATEGORIA 2 CATEGORIA 3
                    100% 70% 17%

                    DE UNA CARA 1.00 0 0 0
                    DE DOS CARAS 1.50 0 0 0
                    DE MAS DE 2 CARAS 2.50 0 0 0

                    NOTA: La superficie considerada para la determinación del coeficiente corresponde a una sola vista.
                    Para cualquier elemento publicitario que no se encuentre especificado en la clasificación A,B,C D de la presente tabla, Publicidad Urbana, para efectos de ponderación asignará el que mas se asemeje.

                    <!-- ================================================= PARA MEJORAR ============================================================== -->

                    <br>
                    Los patrocinantes de anuncios que no tengan fines de lucro podrán ocupar una superficie del 10% debiendo pagar por el excedente en forma porcentual en relación la superficie total (máxima el 50%) de acuerdo a los
                    aranceles aprobados.
                    <br>
                    TABLA 2 DE PARAMETROS PARA PUBLICIDAD URBANA

                    Se clasifican de acuerdo a su "Impacto Publicitario"
                    <br>
                    CATEGORIA 1.-
                    <br>
                    Pertenecen a esta categoría:
                    <br>
                    Las vías que pertenecen a las Zonas "A" y Avenidas y calles comerciales que pertenecen a la zona ·e·.
                    de la "Zonificación de la ciudad de El Alto para el calculo de patentes ".
                    <br>
                    Las Vías de Primer Orden de la ciudad de El Alto independientemente de su clasificación en el cuadro de
                    , "Zonificación de la ciudad de El Alto para el cálculo de Patentes":
                    <br>
                    Los Puntos de lntersección importantes: "cruces" o intersecciones de vías importantes con avenidas principales, carreteras interprovinciales, etc. (Carretera a Viacha, Carretera Desaguadero, etc.)
                    <br>
                    Los accesos o ingresos principales a diferentes zonas.
                    <br>
                    <br>
                    Las consideradas como de gran impacto publicitario por el GMEA.
                    <br>
                    CATEGORIA 2.-
                    <br>
                    Calles y avenidas que pertenecen a la zona "B" de la "Zonificación de la ciudad de El Alto para el cálculo de patentes" y que no son comerciales.
                    Las consideradas por el G.M.E.A. como de regular impacto publicitario.
                    <br>
                    CATEGORIA 3.­-
                    <br>
                    Calles y avenidas que pertenecen a la zona "C" de la "Zonificación de la ciudad de El Alto para el cálculo de patentes" Las consideradas por el G.M.E.A. como de poco o ningún impacto publicitario.
                    <br>

                    Sección III
                    <br>
                    PATENTE MUNICIPAL EVENTUAL
                    <br>

                    Sub sección I
                    <br>
                    PATENTE MUNICIPAL EVENTUAL
                    <br>

                    <h4>ARTICULO DÉCIMO SEPTIMO.-</h4> (Hecho Generador). El desarrollo de una actividad con carácter no habi­tual por un lapso de tiempo máximo de 90 días.
                    <br>
                    TABLA DE LA PATENTE MUNICIPAL EVENTUAL
                    <br>

                    <table>
                        <tr>
                            <th>GRAN GRUPO</th>
                            <th>SUBGRUPO</th>
                            <th>GRUPO PRIMARIO</th>
                            <th>DESCRIPCION</th>
                            <th>ARANCEL</th>
                        </tr>
                        <tr>
                            <td>50</td>
                            <td>50.10</td>
                            <td></td>
                            <td>PATENTE MUNICIPAL EVENTUAL</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>50.10.10</td>
                            <td>PATENTE A LOS ESPECTACULOS Y RECREACIONES</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>50.10.10.1</td>
                            <td>Bailes en fecha especial: Con cponjuntos nacionales, cada baile</td>
                            <td>299</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>50.10.10.2</td>
                            <td>Bailes en fecha especial: - Con conjuntos internacionales, cada baile</td>
                            <td>538</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>50.10.10.3</td>
                            <td>Bailes en fecha ordinaria: - Baile diurno, cada baile</td>
                            <td>37</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>50.10.10.4</td>
                            <td>Baile en fecha ordinaria - Baile nocturno, cada baile</td>
                            <td>78</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>50.10.10.5</td>
                            <td>Circos y similares, por cada función</td>
                            <td>30</td>
                        </tr>
                    </table>

                    Sub sección II
                    <br>
                    PATENTE MUNICIPAL EVENTUAL EN SITIO PUBLICO
                    <br>

                    <h4>ARTICULO DECIMO OCTAVO.-</h4> (Hecho Generador). El desarrollo de una actividad con carácter no habitu­al por un lapso de tiempo máximo de 90 días en sitio publico.
                    <br>
                    TABLA DE LA PATENTE MUNICIPAL EVENTUAL EN SITIO PUBLICO
                    <br>
                    <table>
                        <tr>
                            <th>GRAN GRUPO</th>
                            <th>SUBGRUPO</th>
                            <th>GRUPO PRIMARIO</th>
                            <th>DESCRIPCION</th>
                            <th>ARANCEL</th>
                        </tr>
                        <tr>
                            <td>60.</td>
                            <td></td>
                            <td></td>
                            <td>PATENTE MUNICIPAL EVENTUAL EN SITIO PUBLICO</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>60.10</td>
                            <td></td>
                            <td>PATENTE A LOS ESPECTACULOS Y RECREACIONES PUBLICAS Eventos deportivos profesionales en general (por cada evento)</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.10.1</td>
                            <td>Nacionales</td>
                            <td>119</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.10.2</td>
                            <td>Internacionales</td>
                            <td>239</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.10.3</td>
                            <td>Circos y similares, por cada función</td>
                            <td>30</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.20</td>
                            <td>RAMPLA DE LAVADO DE AUTOS (Mensual)</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.20.1</td>
                            <td>Ramplas Zona A</td>
                            <td>30</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.20.2</td>
                            <td>Ramplas Zona B</td>
                            <td>25</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.20.3</td>
                            <td>Ramplas Zona C</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.30</td>
                            <td>VENTA DE CALLAPOS (espacio por m2)</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.30.1</td>
                            <td>Pago patente por día</td>
                            <td>0,25</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.40</td>
                            <td>PATENTE POR OCUPACIN DE PLAZAS Y PARQUES PARA EVENTOS RELIGIOSOS Para kermeses y otros similares, cualquiera sea su auspicio, finalidad. tiempo máximo medio dia</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.40.1</td>
                            <td>Eventos Religiosos Zona A</td>
                            <td>15</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.40.2</td>
                            <td>Eventos Religiosos Zona B</td>
                            <td>10</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.40.3</td>
                            <td>Eventos Religiosos Zona C</td>
                            <td>5</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.50</td>
                            <td>PATENTE POR OCUPACION DE PLAZAS Y PARQUES PARA EVENTOS EDUCATIVOS Colegios, centros especiales de rehabilitación y educación, tiempo máximo medio día</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.50.1</td>
                            <td>Eventos Educativos Zona A</td>
                            <td>8</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.50.2</td>
                            <td>Eventos Educativos Zona B</td>
                            <td>6</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.50.3</td>
                            <td>Eventos Educativos Zona C</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.60</td>
                            <td>PATENTE EVENTUAL POR EVENTO En eventos para promocionar productos y artículos de empresas nacionales e internacionales en espacios de sitios públicos, plazas, avenidas y calles que estén fuera de la Ordenanza Municipal 016/95 Tiempo máximo medio día.</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.60.1</td>
                            <td>Empresa de·comunicación Zona A</td>
                            <td>100</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.60.2</td>
                            <td>Empresa de comunicación Zona B</td>
                            <td>70</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.60.3</td>
                            <td>Empresa de comunicación Zona C</td>
                            <td>40</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.60.4</td>
                            <td>Artefactos electr6nicos Zona A</td>
                            <td>100</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.60.5</td>
                            <td>Artefactos electr6nicos Zona B</td>
                            <td>70</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.60.6</td>
                            <td>Artefactos electr6nicos Zona C</td>
                            <td>40</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.60.7</td>
                            <td>Maquinarias y accesorios Zona A</td>
                            <td>100</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.60.8</td>
                            <td>Maquinarias y accesorios Zona B</td>
                            <td>70</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.60.9</td>
                            <td>Maquinarias y accesorios Zona C</td>
                            <td>40</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.60.10</td>
                            <td>Ropa, alimentos y otros Zona A</td>
                            <td>100</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.60.11</td>
                            <td>Ropa, alimentos y otros Zona B</td>
                            <td>70</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.60.12</td>
                            <td>Ropa, alimentos y otros Zona C</td>
                            <td>40</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.70</td>
                            <td>PATENTE USO MULTIFUNCIONAL (Ceja El Alto)</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.70.1</td>
                            <td>10% sobre venta de entradas, que no debe ser inferior a</td>
                            <td>200</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.70.2</td>
                            <td>Sin venta de entradas, por evento</td>
                            <td>520</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.80</td>
                            <td>PATENTE CAMPOS DEPORTIVOS</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.80.1</td>
                            <td>Multifuncional diurno par hora</td>
                            <td>13</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.80.2</td>
                            <td>Multifuncional nocturno por hora</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.80.3</td>
                            <td>Canchas múltiples diurno o nocturno por hora</td>
                            <td>5</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.90</td>
                            <td>PATENTE USO TEATRO MUNICIPAL</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.90.1</td>
                            <td>10% sobre venta de entradas, que no debe ser inferior a</td>
                            <td>200</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.90.2</td>
                            <td>Sin venta de entradas, por evento</td>
                            <td>406</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.100</td>
                            <td>TEATRO ENCUENTRO ANDINO (Al aire libre)</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.100.1</td>
                            <td>10% sobre venta de entradas, que no debe ser inferior a</td>
                            <td>150</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.100.2</td>
                            <td>Sin venta de entradas, por evento</td>
                            <td>206</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.110</td>
                            <td>TEATRO DE CAMARA</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.110.1</td>
                            <td>10% sobre venta de entradas, que no debe ser inferior a</td>
                            <td>60</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>60.10.110.2</td>
                            <td>Sin venta de entradas, por evento</td>
                            <td>120</td>
                        </tr>
                    </table>

                    TITULO II
                    <br>
                    DISPOSICIONES FINALES
                    <br>

                    <h4>ARTICULO DECIMO NOVENO.-</h4> (Reglamentación). EI Ejecutivo Municipal a través de la Dirección de Recaudaciones en uso de las facultades conferidas por las disposiciones tributarias vigentes, dictar~ Resoluciones Administrativas reglamentarias para la correcta aplicación de la presente Ordenanza Municipal.
                    <br>
                    <h4>ARTICULO VIGÉSIMO.-</h4> (Actualización). EI Ejecutivo en cumplimiento de las políticas del Gobierno Municipal podrá actualizar los aranceles a través de Resolución Administrativa expresamente emitida por la Máxima Autoridad Tributaria Municipal, en las formas y condiciones establecidas por la Ley No. 2434 y : Decretos Reglamentarios.
                    <br>
                    <h4>ARTÍCULO VIGESIMO PRIMERO.-</h4> (Vigencia). La presente Ordenanza Municipal entrar~ en vigencia a los sesenta días posteriores a la fecha de publicación en un 6rgano de difusi6n local.
                    <br>
                    EI Ejecutivo Municipal en cumplimiento de la Ley, deber~ proseguir la tramitación ante el Ministerio de
                    Hacienda y el H. Senado Nacional para la aprobación de la presente Ordenanza Municipal.
                    <br>
                    <br>
                    Es dada en la Sala de Sesiones del H. Concejo Municipal de la ciudad de El Alto, a los veintidós días del mes de julio del año dos mil cuatro.
                    <br>
                    Registrese, comuniquese, publiquese, cúmplase y archívese.
                    <br>
                    HABIENDO EL HONORABLE CONCEJO MUNICIPAL DE LA CIUDAD DE EL ALTO, EMITIDO LA PRE­ SENTE ORDE ANZA MUNICIPAL, LA PROMULGA PARA SU FIELY ESTRICTO CUMPLIMIENTO A LOS DOS DIAS DEI MES DE AGOSTO DEL ANO DOS MIL CUATRO.
                    <br>
                    LETRA: DHAM CITE: 2555/2004
                    El Alto, Octubre 20, 2004

                    Señor
                    Lie. Hormando Vacadiez
                    PRESIDENTE DE LAH. CAMARA DE SENADORES
                    La Paz.­

                    De mi mayor consideración:
                    <br>
                    <br>
                    Mediante la presente, adjunto remito a su autoridad para su consideración y posterior aprobación de la O.M. 128/2004, que aprueba el Arancel de patentes para el cobro 2004, (anexas) y el Dictamen Técnico CITE:DGPTI-DAPT5411 No 190/2004, emitido por el Vice-Ministro de Política Tributaria. z

                    Con este motivo, reitero a usted las seguridades de mi mas distinguida consideración.
                    <br>
                    El Alto, 18 de Febrero 2005
                    CITE: DHAM/170/2005

                    Hormando Vacadiez
                    PRESIDENTE DE LA H. CAMARA DE SENADORES

                    <br>
                    Ref.: ORDENANZA MUNICIPAL No. 128/2004

                    De mi consideración:
                    <br>
                    De acuerdo a la atribución establecida en la Constitución Política del estado en su Art. 66 inc. 4, por lo que la Cámara que usted preside es la que aprueba las ordenanzas Municipales re­lativas a Tasas o Patentes; asimismo, habiendo seguido el procedimiento de aprobación regula­ en el Art. 105 de la ley de Municipalidades, se debe indicar lo siguiente:
                    <br>
                    • Mediante Ordenanza Municipal No. 128/2004 elaborada en el marco de la LEY 2492 nuevo Código Tributario.
                    <br>
                    • Dicha Ordenanza Municipal cuenta con la aprobación del Poder Ejecutivo, ya que el Dictamen Técnico CITE: DGP[I-DAPT5411 No. 190/2004 emitido por el Vice­ Ministerio de Política Tributarias favorable. .
                    <br>
                    • Dicha Disposición Municipal y su correspondiente Dictamen fue remitido a la H. Cámara de Senadores para su aprobación dentro el plazo establecido, me­diante cite DHAM 2555/2004 de Fecha 20 de octubre de 2004.
                    <br>
                    • Hasta la presente y superando el plaza (60 días) previsto en el Art. 105 num. III de la Ley de Municipalidades, la misma no fue respondida.
                    <br>
                    Teniendo la necesidad del Gobierno Municipal de EI Alto por aplicar la referida Ordenanza municipal que permitirá el pago de tributo regulado en la misma; además que este instrumento al es fundamental para el cumplimiento de las metas de Recaudación previstos en el POA y así obtener los recurses y cumplimiento de las obligaciones de este Gobierno Municipal.
                    <br>
                    Sin otro particular, me despido con las atenciones mas distinguidas.
                    <br>
                    Despacho
                    Dir. Recaudaciones

                </div>
            </div>
            <div class="col-6" id="info-panel">
                <div class="d-flex justify-content-end">
                    <span class="toggle-btn"></span>
                </div>
                <div class="chat-container border p-3 mt-3">
                    <div id="chat-box" class="chat-box"></div>
                </div>
                <div class="position-relative w-100 mt-3 mb-2">
                    <input class="form-control border-0 rounded-pill w-100 ps-4 pe-5" type="text" id="user-input" placeholder="Escriba su consulta aca ..." style="height: 48px;">
                    <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2 mensajeBtnIa"><i class="fa fa-paper-plane fs-4" style="color:#036b8b;"></i></button>
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
<script defer src="../js/mainRecursoIa.js"></script>

</html>