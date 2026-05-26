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
    <title>DATM Ley 259</title>
    <?php
    echo $twig->render('linkStyle.twig');
    ?>
    <link href="../css/styleRecursoIa.css" rel="stylesheet">
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
    <li class="breadcrumb-item text-white active" aria-current="page">Ley 259</li>
    <?php
    echo $twig->render('prebodyltFin.twig');
    ?>
    <!-- Hero End -->

    <!-- About Start -->
    <div class="containermt-5">
        <div class="row position-relative">

            <div class="col-6" id="main-content">
                <div class="show-btn2"><span onclick="toggleVisionPanel()"   id="contenBtnVision"><img class="img-fluid" src="../img/luna.png" style="height: 2rem;" alt=""></span></div>
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


                    <h1>LEY No 259</h1>

                    <h2>LEY DE 11 DE JULIO DE 2012 EVO MORALES AYMA</h2>

                    <h2>PRESIDENTE CONSTITUCIONAL DEL ESTADO PLURINACIONAL DE BOLIVIA<h2>

                            <p>Por cuanto, la Asamblea Legislativa Plurinacional, ha sancionado la siguiente Ley:</p>

                            <p>LA ASAMBLEA LEGISLATIVA PLURINACIONAL, D E C R E T A:</p>

                            <input type="hidden" id="recurso_" value="l259">
                            <h1><span id="tituloPrincipal">LEY DE CONTROL AL EXPENDIO Y CONSUMO DE BEBIDAS ALCOHÓLICAS </span></h1>

                            <h3>CAPÍTULO I</h3> DISPOSICIONES GENERALES

                            <h4>ARTÍCULO 1.</h4>(OBJETO). La presente Ley tiene por objeto regular el expendio y consumo de bebidas alcohólicas, las acciones e instancias de prevención, protección, rehabilitación, control, restricción y prohibición, estableciendo las sanciones ante el incumplimiento de las mismas.

                            <h4>ARTÍCULO 2.</h4> (ALCANCE). Las disposiciones contenidas en la presente Ley son de cumplimiento obligatorio para todas las personas naturales o jurídicas, que fabriquen, comercialicen, publiciten, importen o consuman bebidas alcohólicas en el territorio nacional.

                            <h4>ARTÍCULO 3.</h4> (COMPETENCIAS). El Gobierno Nacional a través de los Ministerios de Salud y Deportes, Gobierno, Educación, Comunicación y otras entidades del Órgano Ejecutivo, así como la Policía Boliviana, en coordinación con todas las Entidades Territoriales Autónomas, en el ámbito de sus competencias, aplicarán lo dispuesto por la presente Ley.

                            <h3>CAPÍTULO II</h3>
                            EXPENDIO Y CONSUMO DE BEBIDAS ALCOHÓLICAS

                            <h4>ARTÍCULO 4.</h4> (LICENCIA DE FUNCIONAMIENTO O AUTORIZACIÓN). Toda persona natural o jurídica que comercialice bebidas alcohólicas al público, deberá obtener la Licencia de Funcionamiento o Autorización, según corresponda, otorgada por los Gobiernos Autónomos Municipales.

                            <h4>ARTÍCULO 5.</h4> (EFECTOS DE LA LICENCIA DE FUNCIONAMIENTO). La Licencia de Funcionamiento otorgada por los Gobiernos Autónomos Municipales, surtirá efectos únicamente para el establecimiento, su titular, y el inmueble autorizado, no pudiendo extenderse el objeto de la licencia a otra actividad diferente para la cual fue originalmente otorgada.

                            <h4>ARTÍCULO 6.</h4> (PROHIBICIONES A LA LICENCIA DE FUNCIONAMIENTO). Se prohíbe la otorgación de licencia de funcionamiento para el expendio y consumo de bebidas alcohólicas, por parte de los Gobiernos Autónomos Municipales, a los establecimientos que se encuentren situados en la distancia y condiciones delimitadas mediante normativa expresa por los Gobiernos Autónomos Municipales, de infraestructuras educativas, deportivas, de salud y otras establecidas por los Gobiernos Autónomos Municipales en reglamentación específica.

                            <h4>ARTÍCULO 7.</h4> (VIGENCIA DE LA LICENCIA DE FUNCIONAMIENTO). La Licencia de Funcionamiento, tendrá vigencia de dos años computables a partir de la fecha de su otorgamiento, pudiendo ser renovada de acuerdo a reglamentación específica de cada Gobierno Autónomo Municipal, no existiendo la renovación tácita.

                            <h3>CAPÍTULO III</h3>
                            CONTROL DE LA PUBLICIDAD DE BEBIDAS ALCOHÓLICAS <h4>ARTÍCULO 8.</h4> (RESTRICCIÓN AL CONTENIDO DE LA PUBLICIDAD). El contenido de toda publicidad de bebidas alcohólicas, debe sujetarse a las siguientes restricciones:

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;1. No incluir a personas menores de 18 años de edad.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;2. No incitar o inducir al consumo de bebidas alcohólicas, sugiriendo que su consumo promueva el éxito intelectual, social, deportivo o sexual.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;3. No utilizar personajes de dibujos animados.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;4. No emitir publicidad de bebidas alcohólicas en el horario de 06:00 a 21:00 horas.

                            <h4>ARTÍCULO 9.</h4> (ADVERTENCIAS).

                            <br>I. Las bebidas alcohólicas que se fabriquen, importen y se comercialicen en el Estado Plurinacional de Bolivia y la publicidad que se realice sobre las mismas, deberán anunciar las siguientes advertencias:

                            "EL CONSUMO EXCESIVO DE ALCOHOL ES DAÑINO PARA LA SALUD"

                            "VENTA PROHIBIDA A MENORES DE 18 AÑOS DE EDAD"

                            <br>II. Estas advertencias deberán ser impresas o adheridas, en un espacio no menor del diez por ciento (10%) de la etiqueta o marca del producto que contenga la bebida alcohólica y/o elementos publicitarios en letras mayúsculas, legibles, en colores contrastantes al fondo y en lugar visible.

                            <br>III. Los establecimientos que expendan bebidas alcohólicas, deberán colocar las advertencias precitadas en un lugar visible, con letras grandes y legibles.

                            <br>IV. Los mensajes publicitarios de bebidas alcohólicas, escritos o impresos, que promocionen bebidas alcohólicas, deberán llevar el rótulo o mensaje de advertencia previsto en el parágrafo I del presente Artículo.

                            <br>V. La publicidad de bebidas alcohólicas en medios de comunicación audiovisuales o radiodifusión, deberán incorporar la advertencia estipulada en el parágrafo I del presente Artículo.

                            <h3>CAPÍTULO IV</h3>

                            PROMOCIÓN DE LA SALUD, PREVENCIÓN AL CONSUMO Y REHABILITACIÓN.

                            <h4>ARTÍCULO 10.</h4> (MEDIDAS DE PROMOCIÓN Y PREVENCIÓN). El Gobierno Nacional, las Entidades Territoriales Autónomas y las Instituciones Públicas y Privadas;; implementarán medidas de promoción de la salud y prevención del consumo de bebidas alcohólicas en el ámbito de sus competencias, señalándose de manera enunciativa y no limitativa las siguientes:

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Incorporar en su planificación estratégica de desarrollo y su programación operativa anual, actividades de promoción de la salud y prevención del consumo de bebidas alcohólicas con enfoque integral, intersectorial e intercultural;; que signifiquen movilización de la familia y la comunidad;; de acuerdo a la política de Salud Familiar Comunitaria Intercultural.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Promover el diseño e implementación de políticas y programas institucionales de prevención del consumo de bebidas alcohólicas, en el Sistema Educativo Plurinacional.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Coordinar con las instituciones de educación superior mediante el sistema de la Universidad Boliviana y el Ministerio de Educación, el desarrollo de programas especiales de prevención y control del consumo de bebidas alcohólicas, en el sistema educativo plurinacional.

                            <h4>ARTÍCULO 11.</h4> (MEDIDAS DE ATENCION Y REHABILITACION).

                            Las Entidades Territoriales Autónomas, Instituciones Públicas y Privadas implementarán las siguientes medidas de atención y rehabilitación basada en la comunidad:

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Fortalecer las Redes de Servicios de Salud y a las Comunidades Terapéuticas Especializadas, en cuanto a la capacidad de respuesta y atención del personal de salud, en lo que se refiere al tratamiento de la dependencia al alcohol.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Promover el fortalecimiento de instituciones específicas de rehabilitación, basadas en la comunidad a través de la conformación de grupos de autoayuda.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Diseñar e implementar programas, proyectos y acciones dirigidas a la rehabilitación y reinserción a su medio familiar, comunitario-­ social y sobre todo laboral y/o educativo, a través de centros psicosociales y psicopedagógicos.

                            CAPITULO V

                            MEDIDAS DE CONTROL

                            <h4>ARTÍCULO 12.</h4> (CONTROL). Todos los establecimientos que expenden, fabriquen, importen y comercialicen bebidas alcohólicas, serán sujetos al control e inspección periódica por parte de las Entidades Territoriales Autónomas en coordinación con la Policía Boliviana, en el ámbito de sus competencias.

                            <h4>ARTÍCULO 13.</h4> (CONTROL DE EXPENDIO DE BEBIDAS ALCOHÓLICAS).
                            Las personas naturales o jurídicas, dedicadas al expendio de bebidas alcohólicas, deberán brindar la cooperación, colaboración y acceso oportuno e inmediato a sus instalaciones, a los controles ejercidos por las Entidades Territoriales Autónomas en coordinación con la Policía Boliviana, no pudiendo limitar de ninguna forma su acceso ni alegar llamamiento o falta de orden judicial para su ingreso;; bajo sanción establecida en la presente Ley.

                            <h4>ARTÍCULO 14.</h4> (CONTROL EN LA FABRICACIÓN E IMPORTACIÓN DE BEBIDAS ALCOHÓLICAS).

                            <br>I. Las personas naturales o jurídicas, que se dediquen a la actividad de fabricación e importación de bebidas alcohólicas deberán cumplir todos los registros sanitarios.

                            <br>II. El Ministerio de Salud y Deportes, y el Ministerio de Desarrollo Rural y Tierras, a través del Servicio Nacional de Sanidad Agropecuaria e Inocuidad Alimentaria - SENASAG, en coordinación con las Entidades Territoriales Autónomas, fiscalizarán en cualquier momento el cumplimiento de los estándares y registros sanitarios, en la elaboración e importación de bebidas alcohólicas. En el caso de requerirse la fuerza pública, la Policía Boliviana cooperará con las labores de contro<br>l.

                            <br>III. Si se evidenciare el incumplimiento a los estándares de fabricación y/o normas de importación establecidos, se sujetarán a sanciones previstas en la Ley.

                            <h4>ARTÍCULO 15.</h4> (CONTROL EN LA COMERCIALIZACIÓN DE BEBIDAS ALCOHÓLICAS).

                            <br>I. Las personas naturales o jurídicas, que se dediquen a la actividad de comercialización de bebidas alcohólicas deberán sujetar su venta, a las prohibiciones establecidas en la presente Ley y normativa vigente.
                            <br>II. En caso de infracción a la presente Ley, se aplicarán las medidas sancionatorias correspondientes.

                            CAPITULO VI

                            MEDIDAS DE PROHIBICIÓN

                            <h4>ARTÍCULO 16.</h4> (MEDIDAS DE PROHIBICIÓN AL EXPENDIO Y CONSUMO DE BEBIDAS ALCOHÓLICAS). Son medidas de prohibición al expendio y consumo de bebidas alcohólicas todas aquellas que se encuentran reguladas en la presente Ley y otras determinadas por los Gobiernos Autónomos Municipales, con la finalidad de precautelar la salud y seguridad de todas las personas del Estado Plurinacional de Bolivia.

                            <h4>ARTÍCULO 17.</h4> (PROHIBICIÓN EN EL HORARIO DE EXPENDIO Y CONSUMO DE BEBIDAS ALCOHÓLICAS).

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;I. Se prohíbe el expendio y consumo de bebidas alcohólicas a partir de las 03:00 am. hasta las 09:00 am. en establecimientos de acceso público y clubes privados.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;II. En el resto del día el expendio de bebidas alcohólicas deberá sujetarse a las restricciones establecidas por los Gobiernos Autónomos Municipales, mediante reglamentación específica.

                            <h4>ARTÍCULO 18.</h4> (PROHIBICIONES EN EL EXPENDIO Y COMERCIALIZACIÓN DE BEBIDAS ALCOHÓLICAS). Las personas naturales o jurídicas, están prohibidas de expender y comercializar bebidas alcohólicas en los siguientes casos:

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;1. En vía pública, salvo autorización específica para el expendio de bebidas alcohólicas, otorgada por los Gobiernos Autónomos Municipales a personas que tienen como principal y habitual actividad el expendio y comercialización de bebidas alcohólicas.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;2. En espacios públicos de recreación, de paseo y en establecimientos destinados a espectáculos y prácticas deportivas.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;3. En establecimientos de Salud y del Sistema Educativo Plurinacional, incluidos los predios Universitarios, tanto públicos como privados.

                            <h4>ARTÍCULO 19.</h4> (PROHIBICIONES AL CONSUMO DE BEBIDAS ALCOHÓLICAS).

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;I. Queda prohibido el consumo de bebidas alcohólicas a toda persona, en los siguientes casos:
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;1. En vía pública.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;2. En espacios públicos de recreación, paseo y en eventos deportivos.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;3. En espectáculos públicos de concentración masiva, salvo autorización de los Gobiernos Autónomos Municipales.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;4. En establecimientos de Salud y del Sistema Educativo Plurinacional, incluidos los predios Universitarios, tanto públicos como privados.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;5. Al interior de vehículos automotores del transporte público y/o privado.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;II. La Policía Boliviana queda encargada del control de las prohibiciones establecidas en el presente Artículo.

                            <h4>ARTÍCULO 20.</h4> (PROHIBICIÓN DE EXPENDIO DE BEBIDAS ALCOHÓLICAS A MENORES DE 18 AÑOS DE EDAD).
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;I. Queda prohibida la venta de bebidas alcohólicas a menores de 18 años de edad, sujeto a sanciones previstas en la presente Ley.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;II. Los establecimientos de expendio de bebidas alcohólicas, estarán obligados a exigir el documento de identificación original, que permita comprobar la mayoría de edad. En caso de prescindir de esta medida se procederá a la sanción correspondiente del establecimiento de expendio.

                            <h4>ARTÍCULO 21.</h4> (RESTRICCIÓN AL INGRESO A ESTABLECIMIENTOS DE EXPENDIO DE BEBIDAS ALCOHOLICAS DE PERSONAS EN ESTADO DE EMBRIAGUEZ Y MENORES DE 18 AÑOS DE EDAD).

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;I. Queda prohibido el ingreso de personas en estado de embriaguez a establecimientos de expendio de bebidas alcohólicas.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;II. Se prohíbe el ingreso de menores de 18 años de edad, a lugares de expendio de bebidas alcohólicas, sujeto a sanción prevista en la presente Ley.

                            <h4>ARTÍCULO 22.</h4> (RESTRICCIÓN AL CONSUMO DE BEBIDAS ALCOHÓLICAS EN COMPAÑÍA DE MENORES DE 18 AÑOS DE EDAD). Se prohíbe el consumo de bebidas alcohólicas, en compañía de menores de 18 años de edad, en establecimientos de acceso público, salvo en casos de degustación y/o acompañamiento de alimentos. En ningún caso será admisible alcanzar el estado de embriaguez sujeto a la sanción establecida en la presente Ley.

                            <h4>ARTÍCULO 23.</h4> (RESTRICCIÓN AL TRÁNSITO EN VÍA PÚBLICA EN ESTADO DE EMBRIAGUEZ EN COMPAÑÍA DE MENORES DE 18 AÑOS DE EDAD). Se prohíbe el tránsito peatonal en notorio estado de embriaguez en vía pública en compañía de menores de 18 años de edad
                            <h4>ARTÍCULO 24.</h4> (EXCEPCIONES). Los Gobiernos Autónomos Municipales, en el marco de sus competencias, podrán otorgar excepcionalmente autorización especial y transitoria para el expendio y

                            consumo de bebidas alcohólicas en fiestas populares y patronales previa valoración de su pertinencia, mediante norma Municipal expresa.

                            <h3>CAPÍTULO VII</h3>

                            MEDIDAS SANCIONATORIAS

                            <h4>ARTÍCULO 25.</h4> (MEDIDAS SANCIONATORIAS AL CONSUMO Y EXPENDIO DE BEBIDAS ALCOHÓLICAS). Se aplicarán medidas sancionatorias, a todas las personas naturales o jurídicas, que incumplan con las limitaciones y prohibiciones reguladas y determinadas en la presente Ley.

                            <h4>ARTÍCULO 26.</h4> (SANCIONES AL INCUMPLIMIENTO DEL HORARIO DE EXPENDIO DE BEBIDAS ALCOHÓLICAS).

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;I. Las personas naturales y jurídicas que incumplan el horario de expendio de bebidas alcohólicas, establecido en la presente Ley, serán sancionadas con un mínimo de 2.000.-­ UFVs de multa de acuerdo a los parámetros establecidos por los Gobiernos Autónomos Municipales y la clausura temporal de 10 días continuos.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;II. En caso de reincidencia se aplicará la sanción de clausura definitiva del establecimiento.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;III. El incumplimiento flagrante a la clausura definitiva del establecimiento impuesto por los Gobiernos Autónomos Municipales, se entenderá como contravención por desobediencia a la autoridad, debiendo la Policía Boliviana proceder al inmediato arresto, hasta de ocho horas, del propietario del establecimiento.

                            <h4>ARTÍCULO 27.</h4> (SANCIONES AL INCUMPLIMIENTO DE EXPENDIO Y COMERCIALIZACIÓN DE BEBIDAS ALCOHÓLICAS). Las personas naturales y jurídicas, que vulneren las prohibiciones y restricciones establecidas en el Artículo 18 de la presente Ley, serán sancionadas con el decomiso de las bebidas alcohólicas que se encuentren expuestas para su expendio y comercialización.

                            <h4>ARTÍCULO 28.</h4> (SANCIONES A LA NEGACIÓN DE COOPERACIÓN O ACCESO AL CONTROL).

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;I. Las personas naturales y jurídicas que se dediquen al expendio de bebidas alcohólicas, que incumplan lo establecido en el Artículo 13 de la presente Ley, serán sancionadas con:
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;1. La primera vez con una multa mínima de 2000.-­ UFVs.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;2. En caso de reincidencia, con la clausura definitiva del establecimiento.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;II. El incumplimiento flagrante a la clausura definitiva del establecimiento impuesto por los Gobiernos Autónomos Municipales, se entenderá como contravención por desobediencia a la autoridad, debiendo la Policía Boliviana proceder al inmediato arresto, hasta de ocho horas, del propietario del establecimiento.

                            <h4>ARTÍCULO 29.</h4> (SANCIONES AL USO INDEBIDO DE LA LICENCIA DE FUNCIONAMIENTO)
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;I. Los establecimientos que expendan bebidas alcohólicas sin contar con licencia de funcionamiento para el expendio y comercialización de bebidas alcohólicas, serán sancionadas con la clausura del establecimiento y una multa mínima de 2.000.-­ UFVs.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;II. Las personas naturales y jurídicas que ejerzan actividades diferentes a las permitidas en la Licencia de Funcionamiento, establecida en el Artículo 5 de la presente Ley, serán sancionadas con una multa mínima de 2.000.-­ UFVs., y la clausura definitiva del establecimiento.

                            <h4>ARTÍCULO 30.</h4> (SANCIONES AL CONSUMO DE BEBIDAS ALCOHÓLICAS).
                            Las personas naturales que vulneren las prohibiciones determinadas en el Artículo 19 de la presente Ley, serán sancionadas con una multa de 250.-­ UFVs. ó trabajo comunitario en la forma y plazos señalados por los Gobiernos Autónomos Municipales, en coordinación con la Policía Boliviana.

                            <h4>ARTÍCULO 31.</h4> (SANCIONES AL EXPENDIO Y COMERCIALIZACIÓN DE BEBIDAS ALCOHÓLICAS A MENORES DE 18 AÑOS DE EDAD).

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;I. Los establecimientos cuya actividad principal sea el expendio y comercialización de bebidas alcohólicas, que vendan éstas a menores de 18 años de edad, serán sancionados la primera vez con multa de 10.000.- UFVs. y la clausura temporal por 10 días continuos del establecimiento. Si por segunda vez se incurriera en esta prohibición, la sanción será de clausura definitiva.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;II. Los establecimientos cuya actividad principal no sea el expendio y comercialización de bebidas alcohólicas, que incurran en la conducta establecida en el parágrafo precedente serán sancionados de acuerdo a reglamentación Municipal.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;III. Los establecimientos de expendio y comercialización de bebidas alcohólicas que permitan el ingreso de menores de edad, serán sancionados la primera vez con una multa de 10.000.-­ UFVs y la clausura temporal por 10 días continuos del establecimiento. Si por segunda vez, se incumpliera con estas prohibiciones, la sanción será de clausura definitiva del establecimiento.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;IV. El incumplimiento flagrante a la clausura definitiva del establecimiento impuesta por los Gobiernos Autónomos Municipales, se entenderá como contravención por desobediencia a la autoridad, debiendo la Policía Boliviana proceder al inmediato arresto, hasta de ocho horas, del propietario del establecimiento.

                            <h4>ARTÍCULO 32.</h4> (SANCIONES POR INGRESO EN ESTADO DE EMBRIAGUEZ A ESTABLECIMIENTOS DE EXPENDIO DE BEBIDAS ALCOHÓLICAS). Los establecimientos de expendio y comercialización de bebidas alcohólicas que permitan el ingreso de personas con signos evidentes de estado de embriaguez, serán sancionados por primera vez con una multa de 5.000.-­ UFVs. y la clausura temporal por 10 días continuos del establecimiento. Si por segunda vez, se incurriera con estas prohibiciones, la sanción será de clausura definitiva del establecimiento.

                            <h4>ARTÍCULO 33.</h4> (SANCIONES AL CONSUMO DE BEBIDAS ALCOHÓLICAS EN COMPAÑÍA DE MENORES DE 18 AÑOS DE EDAD).

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;I. Las personas que en compañía de menores de 18 años de edad, consuman bebidas alcohólicas en establecimientos de acceso público, serán sancionadas con multa de 500.-­ UFVs. ó trabajo comunitario en la forma y plazos previstos por los Gobiernos Autónomos Municipales, en coordinación con la Policía Boliviana.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;II. Las personas que transiten peatonalmente en notorio estado de embriaguez en compañía de menores de 18 años de edad, serán sancionadas con una multa de 500.-­ UFVs. ó trabajo comunitario en la forma y plazos previstos por los Gobiernos Autónomos Municipales, en coordinación con la Policía Boliviana.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;III. En caso de reincidencia, en ambos casos, se procederá a la rehabilitación obligatoria en los centros establecidos en el Artículo 11 numeral 3 de la presente Ley.

                            <h4>ARTÍCULO 34.</h4> (SANCIONES A CONDUCTORES EN ESTADO DE EMBRIAGUEZ). Toda persona que conduzca vehículos automotores públicos o privados en estado de embriaguez con un grado alcohólico superior al permitido, en reglamentación expresa, será sancionada:

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;1. La primera vez, con la inhabilitación temporal de un (1) año de su licencia de conducir y la aplicación de medidas correctivas y socioeducativas.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;2. En caso de reincidencia, con la suspensión definitiva de su licencia de conducir, y si la misma fuese cometida por un servidor público, en horarios de oficina y/o en vehículos oficiales, la sanción se agravará con la destitución del cargo impuesta por la autoridad competente.

                            <h4>ARTÍCULO 35.</h4> (SANCIONES EN LA FABRICACIÓN, IMPORTACIÓN Y COMERCIALIZACIÓN DE BEBIDAS ALCOHÓLICAS). Las personas naturales o jurídicas, que se dediquen a la actividad de fabricación e importación de bebidas alcohólicas y no cumplan con los registros sanitarios correspondientes, serán sancionadas la primera vez, con el decomiso de la mercadería y una multa de 10.000 UFVs. En caso de reincidencia, serán sancionadas con la multa de 20.000 UFVs. y la clausura definitiva del establecimiento.

                            <h4>ARTÍCULO 36.</h4> (MEDIDAS SOCIOEDUCATIVAS).

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;I. Los menores de 18 años de edad, que consuman bebidas alcohólicas, serán conducidos a las Defensorías de la Niñez y Adolescencia dependientes de los Gobiernos Autónomos Municipales, a efectos de que se establezcan las medidas correctivas y socioeducativas correspondientes. En el caso de no existir Defensorías en el ámbito territorial donde sucedió el hecho, se remitirá al menor de 18 dieciocho años de edad, a la instancia que corresponda sujeto a reglamentación.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;II. Para preservar la seguridad e integridad de menores de 18 años de edad en el traslado, se solicitará la participación de las Defensorías de la Niñez y Adolescencia, Brigadas de Protección de la Familia, o en su defecto un miembro de la Policía Boliviana.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;III. Las medidas socioeducativas se aplicarán de acuerdo a los siguientes lineamientos:
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;1. La primera vez deberán ser recogidos por su padre, madre, tutor o tutora u otra persona adulta que sea responsable del cuidado y control del menor de 18 años de edad, en la forma y plazos previstos por los Gobiernos Autónomos Municipales en coordinación con la Policía Boliviana.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;2. La segunda vez deberán ser recogidos por su padre, madre, tutor o tutora u otra persona adulta que sea responsable del cuidado y control del menor de 18 años de edad, quien asumirá la responsabilidad de que tanto el menor como el padre o tutor asistan a cursos, charlas, terapia familiar o socioeducativa en la forma y plazos previstos por los Gobiernos Autónomos Municipales, en coordinación con la Policía Boliviana.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;IV. Cuando corresponda, previo informe de autoridad competente que establezca la dependencia al alcohol del menor de 18 años de edad, éste será sometido a un proceso de rehabilitación obligatoria en los centros establecidos en el numeral 3 del Artículo 11 de la presente Ley.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;V. En caso de personas mayores de 18 años de edad, que hayan incurrido por primera vez en conducir vehículos en estado de embriaguez, deberán asistir obligatoriamente a cursos certificados de concientización en los Organismos Operativos de Tránsito.

                            <h4>ARTÍCULO 37.</h4>-­ (SANCIÓN A LAS PROHIBICIONES PUBLICITARIAS).
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;I. El control y las sanciones por la vulneración de las prohibiciones de publicidad, en medios de comunicación oral o audiovisual previstas en esta Ley, serán establecidas por el Ministerio de Comunicación, de acuerdo a reglamentación de la presente Ley.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;II. El incumplimiento a las disposiciones establecidas en los parágrafos I y II del Artículo 9 de la presente Ley, será sancionada con una multa mínima de 15.000.-­ UFVs. En caso de reincidencia será sancionada con el decomiso de toda la producción que no contenga las advertencias señaladas.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;III. El incumplimiento a la disposición establecida en el parágrafo III del artículo 9 de la presente Ley, será sancionada con un mínimo de 10.000 UFVs. de multa y la clausura temporal de 10 días continuos. En caso de reincidencia se procederá a la clausura definitiva del establecimiento.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;IV. El incumplimiento a la disposición establecida en el parágrafo IV del artículo 9 de la presente Ley, será sancionada con 10.000.-­ UFVs. En caso de reincidencia la sanción será de 15.000.-­ UFVs. y el decomiso del material objeto de la publicidad.

                            <h4>ARTÍCULO 38.</h4> (DESTINO DE LAS MULTAS). El monto recaudado de las multas impuestas en la presente Ley por sanciones, serán destinadas a la formulación y ejecución de políticas de prevención, control, atención y rehabilitación del consumo de bebidas alcohólicas a cargo del Gobierno Nacional, Entidades Territoriales Autónomas y la Policía Boliviana, en el marco de sus competencias y sujeto a reglamentación.

                            DISPOSICIONES TRANSITORIAS

                            <br>PRIMERA. El Órgano Ejecutivo en el plazo de sesenta (60) días continuos a partir de la publicación de la presente Ley, deberá emitir el Decreto Supremo Reglamentario.

                            <br>SEGUNDA. En un plazo de noventa (90) días continuos a partir de la publicación, los Gobiernos Autónomos Municipales, en el ámbito de sus competencias, elaborarán y aprobarán los instrumentos legales correspondientes para el cumplimiento de la presente Ley.

                            <br>TERCERA. Se otorga un plazo de ciento ochenta (180) días continuos a partir de la publicación de la presente Ley, a las personas naturales y jurídicas, que fabriquen, importan o comercialicen bebidas alcohólicas, para que den cumplimiento a lo establecido en el Artículo 9 de la presente Ley.

                            <br><br>DISPOSICIONES ABROGATORIAS Y DEROGATORIAS

                            <br>PRIMERA. Queda derogado el inciso b) del numeral 3, del parágrafo II del Artículo 234 de la Ley General de Transporte N° 165. Se derogan todas las disposiciones contrarias a la presente Ley.

                            <br>SEGUNDA. Se abrogan todas las disposiciones contrarias a la presente Ley.

                            <br><br>DISPOSICIONES FINALES

                            <br>PRIMERA. El procedimiento para el cobro de las multas, estará sujeta a reglamentación.

                            <br>SEGUNDA. El Viceministerio de Seguridad Ciudadana, dependiente del Ministerio de Gobierno, y el Viceministerio de Defensa de los Derechos del Usuario y del Consumidor, dependiente del Ministerio de Justicia, coordinará y ejecutará el cumplimiento de la presente Ley y su reglamentación.

                            <br>TERCERA.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;I. La Policía Boliviana queda encargada de la imposición y cobro de multas a las personas que hubieren incurrido en la infracción de consumo de bebidas alcohólicas o circulación en estado de ebriedad en vía pública.
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;II. Los Gobiernos Autónomos Municipales son los responsables del cobro de las multas e imposición de clausuras temporales y definitivas a las personas naturales o jurídicas que expendan bebidas alcohólicas en contravención a lo dispuesto en la presente Ley.

                            Remítase al Órgano Ejecutivo, para fines constitucionales.

                            Es dado en la Sala de la Asamblea Legislativa Plurinacional, a los veintiocho días del mes de junio del año dos mil doce.

                            Fdo. Lilly Gabriela Montaño Viaña, Richard Cordel Ramírez, Mary Medina Zabaleta, David Sanchez Heredia, Luis Alfaro Arias, Angel David Cortéz Villegas.

                            Por tanto, la promulgo para que se tenga y cumpla como Ley del Estado Plurinacional de Bolivia.

                            Palacio de Gobierno de la ciudad de La Paz, a los once días del mes de julio del año dos mil doce.

                            FDO. EVO MORALES AYMA, Juan Ramón Quintana Taborga, Carlos Gustavo Romero Bonifaz, Juan Carlos Calvimontes Camargo, Roberto Iván Aguilar Gómez, Claudia Stacy Peña Claros, Amanda Dávila Torres, Nemesia Achacollo Tola.

                            SUSCRIPCION OBLIGATORIA DECRETO SUPREMO No 690

                            03 DE NOVIEMBRE DE 2010 .- Dispone la suscripción obligatoria, sin excepción alguna, de todas las entidades del sector público que conforman la estructura organizativa del Organo Ejecutivo, así como de entidades y empresas públicas que se encuentran bajo su dependencia o tuición, a la Gaceta Oficial de Bolivia, dependiente del Ministerio de la Presidencia, para la obtención física de Leyes, Decretos y Resoluciones Supremas.

                            =================================================================================

                            Decreto Supremo N° 1347, de 10 de septiembre de 2012,

                            Reglamento a la Ley N° 259 de Expendio y Consumo de bebidas alcohólicas

                            EVO MORALES AYMA PRESIDENTE CONSTITUCIONAL DEL ESTADO PLURINACIONAL DE BOLIVIA

                            <br>C O N S I D E R A N D O:

                            <br>Que el numeral 2 del Artículo 9 de la Constitución Política del Estado, establece que son fines y funciones esenciales del Estado garantizar el bienestar, el desarrollo, la seguridad y la protección e igual dignidad de las personas, las naciones, los pueblos y las comunidades, asimismo el Parágrafo I del Artículo 251 del Texto Constitucional, determina que la Policía Boliviana, como fuerza pública, tiene la misión específica de la defensa de la sociedad y la conservación del orden público y el cumplimiento de las leyes en todo el territorio boliviano.

                            <br>Que el numeral 13 del Parágrafo II del Artículo 299 de la Constitución Política del Estado, señala como una competencia concurrente por el nivel central del Estado y las entidades territoriales autónomas, la seguridad ciudadana.

                            <br>Que la Ley N° 259, de 11 de julio de 2012, de Control al Expendio y Consumo de Bebidas Alcohólicas, es parte integral del Sistema Nacional de Seguridad Ciudadana establecido en la Ley N° 264, de 31 de julio de 2012, como conjunto interrelacionado de políticas, planes, estrategias, procedimientos, institucionalidad y funciones en materia de seguridad ciudadana.

                            <br>Que la Ley N° 259, de 11 de julio de 2012, regula el expendio y consumo de bebidas alcohólicas, las acciones e instancias de prevención, protección, rehabilitación, control, restricción, prohibición y sanciones ante su incumplimiento; y establece un plazo de sesenta (60) días continuos a partir de su publicación para que mediante Decreto Supremo, el Órgano Ejecutivo emita la respectiva reglamentación.

                            <br>Que el Parágrafo I del Artículo 37 de la Ley N° 259, dispone que el control y las sanciones por la vulneración de las prohibiciones de publicidad, en medios de comunicación oral o audiovisual previstas en la Ley, serán establecidas por el Ministerio de Comunicación, de acuerdo a reglamentación.

                            <br>Que la Disposición Final Segunda de la Ley N° 259, establece que el Viceministerio de Seguridad Ciudadana del Ministerio de Gobierno, y el Viceministerio de Defensa de los Derechos del Usuario y del Consumidor del Ministerio de Justicia, coordinarán y ejecutarán el cumplimiento de la Ley y su reglamentación.

                            <br><br>CONSEJO DE MINISTROS, D E C R E T A:

                            <h3>CAPÍTULO I</h3> DISPOSICIONES GENERALES

                            <h4>ARTÍCULO 1.</h4>- (OBJETO). El presente Decreto Supremo tiene por objeto reglamentar la Ley N° 259, de 11 de julio de 2012, de Control al Expendio y Consumo de Bebidas Alcohólicas, estableciendo mecanismos y procedimientos para su implementación.

                            <h4>ARTÍCULO 2.</h4>- (DEFINICIONES). Para efectos de reglamentación de la Ley N° 259, se establece las siguientes definiciones:

                            <br>a. Publicidad de bebidas alcohólicas: Es toda forma de comunicación pública que busca promover directa o indirectamente la adquisición y/o consumo de bebidas alcohólicas.

                            <br>b. Medio de Comunicación Oral: Es aquel que se basa en el lenguaje oral para entregar la información apoyándose de sonidos y música para realizarse.

                            <br>c. Medio de Comunicación Audiovisual: Es aquel que se basa en el lenguaje oral para entregar la información y se apoya de sonidos, música, imágenes y movimiento para realizarse.

                            <br>d. Medio de Comunicación Escrito: Es aquel que se basa en el lenguaje escrito para entregar la información y se apoya de ilustraciones, imágenes, dibujos, gráficos, etc., para realizarse.

                            <br>e. Establecimiento de Consumo y Expendio de Bebidas Alcohólicas: Es todo recinto autorizado para el con- sumo y expendio de bebidas alcohólicas como ser bares, cantinas, chicherías, discotecas, salones de baile, boites, barras americanas, whiskerías, clubes nocturnos, cabarets, café concerts, karaokes, restaurantes y choperías.

                            <br>f. Establecimiento de Comercialización de Bebidas Alcohólicas: Es todo recinto autorizado para la comercialización de bebidas alcohólicas como ser licorerías, proveedoras, supermercados, micromercados, almacenes, centros de abasto e importadoras con puntos de venta.

                            <h3>CAPÍTULO II</h3>
                            REGISTRO DE CONTRAVENCIONES AL CONSUMO DE BEBIDAS ALCOHÓLICAS

                            <h4>ARTÍCULO 3.</h4>- (REGISTRO NACIONAL DE CONTRAVENCIONES AL CONSUMO DE BEBIDAS ALCOHÓLICAS). Se crea el Registro Nacional de Contravenciones al Consumo de Bebidas Alcohólicas, a cargo de la Policía Boliviana, para las siguientes contravenciones:

                            <br>a. Conducción de vehículos automotores públicos o privados en estado de embriaguez;
                            <br>b. Consumo de bebidas alcohólicas al interior de vehículos automotores del transporte público y/o privado;
                            <br>c. Consumo de bebidas alcohólicas en vía pública;
                            <br>d. Consumo de bebidas alcohólicas en espacios públicos de recreación, paseo y en eventos deportivos;
                            <br>e. Consumo de bebidas alcohólicas en espectáculos públicos de concentración masiva, salvo autorización de los Gobiernos Autónomos Municipales;
                            <br>f. Consumo de bebidas alcohólicas en establecimientos de salud y del sistema educativo plurinacional, incluidos los predios universitarios, tanto públicos como privados;
                            <br>g. Consumo de bebidas alcohólicas en compañía de menores de dieciocho (18) años de edad en establecimientos de acceso público, salvo en casos de degustación y/o acompañamiento de alimentos;
                            <br>h. Tránsito peatonal en notorio estado de embriaguez en vía pública en compañía de menores de dieciocho (18) años de edad.

                            <h4>ARTÍCULO 4.</h4>- (REGISTRO). El Registro Nacional de Contravenciones al Consumo de Bebidas Alcohólicas, deberá con- tener mínimamente la siguiente información de la persona infractora:

                            <br>a. Nombres y apellidos paterno y materno;
                            <br>b. Número de la Cédula de Identidad;
                            <br>c. Lugar de nacimiento;
                            <br>d. Nacionalidad;
                            <br>e. Edad;
                            <br>f. Número telefónico de referencia;
                            <br>g. Descripción de la infracción o contravención;
                            <br>h. Descripción de la sanción;
                            <br>i. Resultado de la prueba de alcoholemia, si corresponde.

                            <h3>CAPÍTULO III</h3>
                            PROCEDIMIENTO PARA EL CUMPLIMIENTO DE SANCIONES A PERSONAS NATURALES

                            <h4>ARTÍCULO 5.</h4>- (TRASLADO A CENTRO POLICIAL). La Policía Boliviana cuando identifique a cualquier persona cometiendo alguna infracción señalada en el Artículo 3 del presente Decreto Supremo, procederá a su traslado al centro policial

                            más cercano, a efectos de realizar el registro y la imposición de la sanción correspondiente, sin que ello implique arresto.

                            <h4>ARTÍCULO 6.</h4>- (REGISTRO). La Policía Boliviana procederá a registrar a la persona infractora en el Registro Nacional de Contravenciones al Consumo de Bebidas Alcohólicas, de acuerdo a lo señalado en el Artículo 4 del presente Decreto Supremo.

                            <h4>ARTÍCULO 7.</h4>- (PAPELETA DE INFRACCIÓN). De acuerdo a la contravención cometida, la Policía Boliviana hará entrega de una papeleta de infracción para el cumplimiento de la sanción, la papeleta deberá contar mínimamente con la siguiente información de la persona sancionada:

                            <br>a. Nombres y apellidos paterno y materno;

                            <br>b. Número de la Cédula de Identidad;

                            <br>c. Fecha y lugar;

                            <br>d. Descripción de la infracción;

                            <br>e. Descripción de la sanción, especificando la forma de su cumplimiento, con el pago de la multa en Unidad de Fomento a la Vivienda - UFVs o trabajo comunitario, si corresponde;

                            <br>f. Monto de la multa en UFVs u horas de trabajo;

                            <br>g. Especificación del número de la cuenta fiscal correspondiente.

                            <h4>ARTÍCULO 8.</h4>- (CUMPLIMIENTO DE LA SANCIÓN).

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;I. Una vez que la persona infractora reciba la papeleta de infracción, el pago de la multa deberá efectuarlo en un plazo máximo de quince (15) días hábiles en la cuenta fiscal correspondiente.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;II. Para el cumplimiento del Parágrafo anterior el pago de la multa en UFVs se efectuará en su equivalente en bolivianos a la fecha de emisión de la papeleta de infracción.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;III. Cuando el pago se realice fuera del plazo establecido en el Parágrafo I, el pago de la multa en UFVs se efectuará en su equivalente en bolivianos a la fecha del pago.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;IV. La persona infractora que elija el trabajo comunitario para el cumplimiento de la sanción, tendrá un plazo máximo de quince (15) días hábiles para presentarse ante la Oficina de Conciliación Ciudadana en los Centros Policiales.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;V. El Ministerio de Gobierno, mediante Resolución Ministerial, establecerá los mecanismos temporales para efectivizar el cumplimiento de las sanciones a las contravenciones previstas en los incisos b), c), d), e), f), g) y h) del Artículo 3 del presente Decreto Supremo.

                            <h4>ARTÍCULO 9.</h4>- (COBRO DE MULTAS Y DESTINO DE LOS RECURSOS).

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;I. El Ministerio de Economía y Finanzas Públicas a través del Viceministerio de Tesoro y Crédito Público aperturará específicamente una cuenta corriente fiscal recaudadora en el Banco Unión S.A., para su acreditación a la libreta correspondiente por el cobro de multas de contravenciones al consumo de bebidas alcohólicas, así como para el cobro de multas a medios de comunicación por las contravenciones establecidas en la Ley N° 259 y el presente Decreto Supremo.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;II. Los Gobiernos Autónomos Municipales solicitarán al Ministerio de Economía y Finanzas Públicas la apertura de cuentas corrientes fiscales recaudadoras en el Banco Unión S.A., para el cobro de multas a personas naturales o jurídicas que expendan bebidas alcohólicas en contravención a lo dispuesto en la Ley N° 259.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;III. Los recursos provenientes de las multas recaudadas en las cuentas corrientes fiscales recaudadoras, establecidas en los Parágrafos I y II del presente Artículo, serán destinados exclusivamente a la formulación y ejecución de políticas de prevención, control, atención y rehabilitación del consumo de bebidas alcohólicas.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;IV. Los recursos recaudados en la cuenta corriente fiscal señalada en el Parágrafo I del presente Artículo se distribuirán a los Ministerios de Gobierno, de Justicia, de Salud y Deportes, de Educación y de Comunicación, conforme Resolución Multi ministerial.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;V. El Ministerio de Economía y Finanzas Públicas, en función a la Resolución Multi ministerial, asignará los recursos provenientes de la recaudación por el cobro de multas, a las cuentas de los Ministerios correspondientes.

                            <h3>CAPÍTULO IV</h3> TRABAJO COMUNITARIO

                            <h4>ARTÍCULO 10.</h4>- (TRABAJO COMUNITARIO). El trabajo comunitario es un servicio a favor de la colectividad, como una forma de sanción alternativa al pago de multas en UFVs en los casos que corresponda.

                            <h4>ARTÍCULO 11.</h4>- (HORARIOS PARA LA PRESTACIÓN DE TRABAJO COMUNITARIO).

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;I. El trabajo comunitario se cumplirá en días y horas no laborales, bajo supervisión de la Policía Boliviana o el Gobierno Autónomo Municipal.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;II. El cálculo de las horas de trabajo comunitario será equivalente a cincuenta (50) UFVs por cada dos (2) horas de trabajo comunitario.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;III. Los Gobiernos Autónomos Municipales en coordinación con la Policía Boliviana elaborarán un cronograma en el cual se establezca el lugar, el horario, el objeto, los responsables de la supervisión y el plazo máximo para el cumplimiento del trabajo comunitario.

                            <h4>ARTÍCULO 12.</h4>- (OFICINA DE CONCILIACIÓN CIUDADANA).

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;I. La Oficina de Conciliación Ciudadana, contará con el cronograma de trabajo comunitario establecido por los Gobiernos Autónomos Municipales en coordinación con la Policía Boliviana.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;II. La persona infractora que deba cumplir con el trabajo comunitario, deberá apersonarse a la Oficina de Conciliación Ciudadana del Centro Policial correspondiente, portando la papeleta de infracción a objeto de definir su plan de trabajo comunitario, en el cual se establecerá los días y las horas para el cumplimiento de la sanción.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;III. El plan de trabajo comunitario se constituirá en un documento de compromiso de cumplimiento obligatorio que será registrado por la Oficina de Conciliación Ciudadana.

                            <h3>CAPÍTULO V</h3>
                            PROCEDIMIENTO PARA EL CUMPLIMIENTO DE SANCIONES POR CONDUCCIÓN EN ESTADO DE EMBRIAGUEZ

                            <h4>ARTÍCULO 13.</h4>- (PRUEBA DE ALCOHOLEMIA).

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;I. La Policía Boliviana, a través de los medios técnicos que correspondan, realizará la prueba de alcoholemia a las per- sonas que estén conduciendo vehículos automotores públicos o privados en estado de embriaguez.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;II. La negativa de la persona a someterse a la prueba de alcoholemia, dará lugar a la aplicación de la sanción establecida a las personas en estado de embriaguez.

                            <h4>ARTÍCULO 14.</h4>- (GRADO ALCOHÓLICO MÁXIMO PERMITIDO).

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;I. Los diferentes mecanismos de medición para realizar la prueba de alcoholemia, tienen igual validez para efectos del presente Decreto Supremo, su aplicación será definida por la Policía Boliviana de acuerdo a las circunstancias y naturaleza de la contravención.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;II. Se establece como grado alcohólico máximo permitido cero punto cincuenta (0.50) grados en cada mil (1000) ml de sangre o su equivalente en mg/l en el aire espirado dependiendo el mecanismo de medición utilizado, para toda per- sona que esté conduciendo vehículos automotores públicos o privados en estado de embriaguez.

                            <h4>ARTÍCULO 15.</h4>- (PROCEDIMIENTO). La Policía Boliviana, al detectar a cualquier persona en estado de embriaguez conduciendo vehículo automotor público o privado en territorio nacional, deberá implementar los Artículos 5 y 6 del presente Decreto Supremo.

                            <h4>ARTÍCULO 16.</h4>- (INHABILITACIÓN TEMPORAL Y SUSPENSIÓN DEFINITIVA DE LICENCIA DE CONDUCIR). Las sanciones de inhabilitación temporal y suspensión definitiva de licencia de conducir, señaladas en el Artículo 34 de la Ley N° 259, se efectivizarán mediante resolución del Organismo Operativo de Tránsito y puestas en conocimiento de las instancias que correspondan.

                            <h4>ARTÍCULO 17.</h4>- (MEDIDAS CORRECTIVAS Y SOCIOEDUCATIVAS). Las medidas correctivas y socioeducativas serán de:

                            <br>a. Prestación de servicios a la comunidad a través de diez (10) horas de trabajo comunitario de acuerdo a lo establecido en el presente Decreto Supremo;

                            <br>b. Asistir a diez (10) horas de programas de tipo formativo, a cargo de la Policía Boliviana.

                            <h3>CAPÍTULO VI</h3>
                            PROCEDIMIENTO PARA EL CUMPLIMIENTO DE SANCIONES AL CONSUMO DE BEBIDAS ALCOHÓLI- CAS EN COMPAÑÍA DE MENORES DE DIECIOCHO (18) AÑOS DE EDAD

                            <h4>ARTÍCULO 18.</h4>- (PROCEDIMIENTO).

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;I. La Policía Boliviana, al detectar a cualquier persona que incurra en las causales de los incisos g) y h) del Artículo 3 del presente Decreto Supremo deberá:

                            <br>a. Inmediatamente solicitar el apoyo de la Defensoría de la Niñez y Adolescencia más cercana, a objeto de conducir al menor a custodia de sus padres o tutores, siempre y cuando éstos no sean los infractores;

                            <br>b. En caso de que los padres o tutores del menor de dieciocho (18) años, sean los infractores, la Defensoría de la Niñez y Adolescencia deberá conducir al menor a sus instalaciones a objeto de identificar a algún familiar que se haga cargo del menor;

                            <br>c. La persona infractora deberá ser conducida al centro policial más cercano y cumplir con el procedimiento establecido en el <h3>Capítulo III</h3> del presente Decreto Supremo.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;II. La Defensoría de la Niñez y Adolescencia, podrá en el ámbito de sus competencias aplicar medidas de protección social de acuerdo a normativa vigente.

                            <h4>ARTÍCULO 19.</h4>- (UNIDADES ENCARGADAS DE PROTEGER AL MENOR DE 18 AÑOS DE EDAD). En los Municipios donde no exista Defensoría de la Niñez y Adolescencia, podrán intervenir las brigadas de protección a la familia de la Policía Boliviana.

                            <h3>CAPÍTULO VII</h3>
                            PROCEDIMIENTO PARA EL CUMPLIMIENTO DE SANCIONES POR INCUMPLIMIENTO DE LAS PROHIBICIONES PUBLICITARIAS

                            <h4>ARTÍCULO 20.</h4>- (PUBLICIDAD EN MEDIOS DE COMUNICACIÓN). La publicidad de bebidas alcohólicas en medios de comunicación deberá cumplir con los siguientes procedimientos:

                            <br>a. Cuando se trate de publicidad radial, al final del anunció se deberá expresar en forma clara y pausada las siguientes advertencias: "EL CONSUMO EXCESIVO DE ALCOHOL ES DAÑINO PARA LA SALUD" - "VENTA PROHIBIDA A MENORES DE 18 AÑOS DE EDAD".

                            <br>b. Cuando se trate de publicidad audiovisual, los últimos cinco (5) segundos de la publicidad como mínimo, deberán expresar en forma exclusiva, clara y en letras mayúsculas, legibles, en colores contrastantes al fondo y en pantalla completa la siguiente advertencia: "EL CONSUMO EXCESIVO DE ALCOHOL ES DAÑINO PARA LA SALUD" - "VENTA PROHIBIDA A MENORES DE 18 AÑOS DE EDAD".

                            <br>c. Cuando se trate de publicidad impresa o escrita, al final del anuncio se deberá expresar en forma clara, con letras mayúsculas, legibles, en colores contrastantes al fondo las siguientes advertencias: "EL CONSUMO EXCESIVO DE ALCOHOL ES DAÑINO PARA LA SALUD" - "VENTA PROHIBIDA A MENORES DE 18 AÑOS DE EDAD".

                            <br>d. La presente disposición no limita a que los medios de comunicación incorporen además otros mensajes de prevención al consumo excesivo de bebidas alcohólicas y prohibición de venta a menores de dieciocho (18) años de edad.

                            <h4>ARTÍCULO 21.</h4>- (INFRACCIONES SOBRE PUBLICIDAD). Constituyen infracciones administrativas sancionables con multa, toda publicidad que vulnere:

                            <br>a. Las restricciones contenidas en el Artículo 8 de la Ley N° 259;

                            <br>b. Que omita difundir las advertencias contenidas en el Parágrafo I del Artículo 9 de la Ley N° 259.

                            <h4>ARTÍCULO 22.</h4>- (SANCIÓN AL INCUMPLIMIENTO DE LA RESTRICCIÓN AL CONTENIDO DE LA PUBLICIDAD).

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;I. Los medios de comunicación que difundan publicidad de bebidas alcohólicas y no cumplan con las restricciones al contenido de la publicidad establecidas en el Artículo 8 de la Ley N° 259, serán sancionadas, la primera vez con una multa de UFVs10.000.- (DIEZ MIL 00/100 UNIDADES DE FOMENTO A LA VIVIENDA). En caso de reincidencia serán sancionados con una multa de UFVs15.000.- (QUINCE MIL 00/100 UNIDADES DE FOMENTO A LA VIVIENDA).

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;II. La restricción contenida en el numeral 4 del Artículo 8 de la Ley N° 259, no se aplicará a la publicidad de bebidas alcohólicas emitidas a través de medios de comunicación impreso.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;III. Los medios de comunicación oral y audiovisual podrán mencionar auspicios sin restricción de franja horaria, siempre y cuando no contengan publicidad.

                            <h4>ARTÍCULO 23.</h4>- (SANCIÓN AL INCUMPLIMIENTO DE LAS PROHIBICIONES Y ADVERTENCIAS PUBLICITARIAS POR MEDIOS DE COMUNICACIÓN). Los medios de comunicación que emitan publicidad de bebidas alcohólicas y omitan la difusión de las advertencias establecidas en el Parágrafo I del Artículo 9 de la Ley N° 259, serán sancionados la primera vez con una multa de UFVs10.000.- (DIEZ MIL 00/100 UNIDADES DE FOMENTO A LA VIVIENDA). En caso de reincidencia serán sancionados con una multa de UFVs15.000.- (QUINCE MIL 00/100 UNIDADES DE FOMENTO A LA VIVIENDA).

                            <h4>ARTÍCULO 24.</h4>- (OBLIGACIÓN DE LOS MEDIOS DE COMUNICACIÓN).

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;I. Es obligación de todos los medios de comunicación remitir al Ministerio de Comunicación reportes del pauteo publicitario de bebidas alcohólicas en forma mensual.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;II. El Ministerio de Comunicación podrá requerir a los medios de comunicación grabaciones en audio, video o escrito de las emisiones de publicidad que considere pertinente.

                            <h4>ARTÍCULO 25.</h4>- (PROCESO SANCIONADOR POR INFRACCIONES ADMINISTRATIVAS).

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;I. En el marco del Parágrafo I del Artículo 37 de la Ley N° 259, el Ministerio de Comunicación, a través del Viceministerio de Políticas Comunicacionales, de oficio, a denuncia o sobre la base de los reportes de información requeridos a los medios de comunicación, iniciará Proceso Administrativo Sancionador por presuntas infracciones administrativas que vulneren lo establecido en el Artículo 8 y en el Parágrafo I del Artículo 9 de la Ley N° 259.


                            <br>&nbsp;&nbsp;&nbsp;&nbsp;II. Conocida la presunta infracción administrativa, el Viceministerio de Políticas Comunicacionales del Ministerio de Comunicación, iniciará el procedimiento administrativo sancionador contra el medio de comunicación y le concederá un plazo de diez (10) días hábiles, computables a partir de su notificación, para que asuma defensa y presente los descargos correspondientes.

                            <h4>ARTÍCULO 26.</h4>- (EMISIÓN DE LA RESOLUCIÓN DEL PROCESO ADMINISTRATIVO SANCIONADOR).

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;I. Vencido el plazo, con o sin respuesta del medio de comunicación, el Viceministerio de Políticas Comunicacionales del Ministerio de Comunicación, emitirá Resolución Administrativa fundamentada y motivada, en un plazo de cinco (5) días hábiles administrativos.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;II. Emitida la Resolución Administrativa, el Viceministerio de Políticas Comunicacionales del Ministerio de Comunicación, deberá notificar al medio de comunicación en un plazo máximo de cinco (5) días hábiles administrativos computables a partir del siguiente día hábil de su pronunciamiento.

                            <h4>ARTÍCULO 27.</h4>- (ETAPA RECURSIVA).

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;I. Contra la Resolución Administrativa Sancionatoria, podrá presentarse el Recurso de Revocatoria ante la autoridad que emitió la misma o en su caso, el Recurso Jerárquico si éste se interpusiere ante la Máxima Autoridad Ejecutiva del Ministerio de Comunicación, en el marco del procedimiento establecido en la Ley N° 2341, de 23 de abril de 2002, de Procedimiento Administrativo y el Decreto Supremo N° 27113, de 23 de julio de 2003.

                            <br>&nbsp;&nbsp;&nbsp;&nbsp;II. Agotada la vía administrativa, queda expedita la vía judicial a través del Proceso Contencioso Administrativo.

                            <h3>CAPÍTULO VIII</h3> MEDIDAS DE PREVENCIÓN

                            <h4>ARTÍCULO 28.</h4>- (MEDIDAS DE PREVENCIÓN). El Viceministerio de Seguridad Ciudadana del Ministerio de Gobierno y el Viceministerio de Defensa de los Derechos del Usuario y del Consumidor del Ministerio de Justicia, coordinarán acciones orientadas a la prevención del consumo excesivo de bebidas alcohólicas.

                            DISPOSICIONES FINALES<br>

                            <br>DISPOSICIÓN FINAL PRIMERA.- Para todo aquello no previsto expresamente en el presente reglamento, se aplicarán las dis- posiciones de la Ley N° 2341, de 23 de abril de 2002, de Procedimiento Administrativo y su Decreto Supremo Reglamentario.

                            <br>DISPOSICIÓN FINAL SEGUNDA.- Se incluyen a las atribuciones del Viceministerio de Políticas Comunicacionales del Ministerio de Comunicación, los incisos h) e i) en el Artículo 5 del Decreto Supremo N° 0793, de 15 de febrero de 2011, con el siguiente texto:

                            "h) Controlar y verificar el contenido de la publicidad de bebidas alcohólicas emitidas por los medios de comunicación." "i) Conocer y resolver los Procesos Administrativos Sancionatorios que se inicien en el marco de la Ley N° 259, de 11 de julio de 2012, de Control al Expendio y Consumo de Bebidas Alcohólicas."

                            Los señores Ministros de Estado en sus respectivos Despachos, quedan encargados de la ejecución y cumplimiento del presente Decreto Supremo.

                            Es dado en el Palacio de Gobierno de la ciudad de La Paz, a los diez días del mes de septiembre del año dos mil doce.

                            FDO. EVO MORALES AYMA, David Choquehuanca Céspedes, Juan Ramón Quintana Taborga, Carlos Gustavo Romero Bonifaz, Rubén Aldo Saavedra Soto, Elba Viviana Caro Hinojosa, Juan José Hernando Sosa Soruco, Ana Teresa Morales Olivera MINISTRA DE DESARROLLO PRODUCTIVO Y ECONOMÍA PLURAL E INTERINA DE ECONOMÍA Y FINANZAS PÚBLICAS, Arturo Vladimir Sánchez Escobar, Mario Virreira Iporre, Cecilia Luisa Ayllon Quinteros, Daniel Santalla Torrez, Juan Carlos Calvimontes Camargo, José Antonio Zamora Gutiérrez, Roberto Iván Aguilar Gómez, Nemesia Achacollo ,Claudia Stacy Peña Claros, Nardy Suxo Iturry, Pablo Cesar Groux Canedo, Amanda Dávila Torres.

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