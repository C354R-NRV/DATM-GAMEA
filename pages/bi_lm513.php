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
    <title>DATM Ley Mun. 513</title>
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
    <li class="breadcrumb-item text-white active" aria-current="page">Ley municipal 513</li>
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
                    <h1>LEY MUNICIPAL N° 513</h1>

                    <br>
                    <input type="hidden" id="recurso_" value="lm513">
                    <h2><span id="tituloPrincipal">RESTRICCION ADMINISTRATIVA PARA LA EXTENSION DE LICENCIAS DE FUNCIONAMIENTO A ACTIVIDADES ECONOMICAS DE EXPENDIO, CONSUMO, COMERCIALIZACIN, ALMACEN, TRANSPORTE Y VENTA DE BEBIDAS ALCOHOLICAS EN EL MUNICIPIO DE EL ALTO</span></h2>
                    <br>
                    <br>
                    SR. MARCELO FERNANDEZ TANCARA PRESIDENTE DEL CONCEJO MUNICIPAL DE EL ALTO

                    <br>
                    Por cuanto la Ley Municipal es una disposici6n legal que emana del Concejo Municipal y es de carácter general su aplicación y cumplimiento es obligatorio, en toda la jurisdicci6n de El Alto:
                    <br>
                    <br>
                    EXPOSICIÓN DE MOTIVOS:
                    <br>
                    Que la Constitución Política del Estado en su Articulo 9 numeral 2, establece: "Los fines de funciones esenciales del Estado, para garantizar el bienestar, el desarrollo, la seguridad y la protección en igual dignidad de las personas, las naciones, los pueblos y las comunidades, y fomentar el respeto mutuo y el diálogo intra-cultural y plurilingüe."
                    <br>
                    Que, la Constitución Política del Estado en su Articulo 283 establece: "El Gobierno Autónomo Municipal esté constituido por un Concejo Municipal con facultad deliberativa, fiscalizadora legislativa municipal, en el ámbito de sus competencias, y un Órgano Ejecutivo, presidido por I alcaldesa o Alcalde."
                    <br>
                    Que la Constitución Política del Estado en su Articulo 299,
                    Seguridad Ciudadana es competencias del Gobierno Central y las entidades territoriales autónomas."
                    <br>
                    Que la Ley de Control al Expendio y Consumo de Bebidas Alcoh61icas N°259 en su Articulo l 0 dispone: "EI Gobierno Nacional, las Entidades Territoriales Autónomas y las Instituciones Públicas y Privadas; implementar medidas de promoción de la salud y prevención del consumo de bebidas alcohólicas en el ámbito de sus competencias."
                    <br>
                    Que la Ley de Control al Expendio y Consumo de Bebidas Alcoh61icas, N° 259 en su Articulo 12 dispone: "todos los establecimientos que expenden, fabriquen, importen y comercialicen bebidas alcohólicas, serán sujetos a control e inspección periódico por parte de las Entidades Territoriales Aut6nomas en coordinación con la Policía Boliviana, en el ámbito de sus competencias."
                    <br>
                    Que, la Ley del Sistema Nacional de Seguridad Ciudadana "Para Una Vida Segura", en su artículo 11 establece; "Es responsabilidad de las entidades territoriales aut6nomas municipales, en materia de seguridad ciudadana, ejecutar en el municipio, en concurrencia con el nivel Nacional del Estado y las entidades territoriales aut6nomas los planes, programas y proyectos municipales". En materia de Seguridad Ciudadana en sujeción a la Política Publica Nacional de Seguridad Ciudadana."
                    <br>
                    <br>
                    Que es la Ley del Sistema Nacional de Seguridad Ciudadana "Para Una Vida Segura", en su Articulo 23 establece "Los Consejos Departamentales Regionales Municipales e indígenas Originarios Campesinos, en el ámbito territorial que corresponda en el marco de sus competencias y responsabilidades, tendrán las atribuciones de: aprobar los planes, programas y proyectos de prevención en materia de Seguridad Ciudadana, en sujeción al Plan Nacional de Seguridad Ciudadana; evaluar la ejecución de los planes, programas y proyectos en materia de Seguridad Ciudadana; e impulsar mecanismos que aseguren la activa participación de la sociedad civil en la formulaci6n de planes, programas y proyectos de Seguridad Ciudadana, en el marco del Plan Nacional de Seguridad Ciudadana."
                    <br>
                    Que, la Ley N° 482 de Gobiernos Aut6nomos Municipales en su Articulo 16 numeral 4 señala: "Las atribuciones del Concejo Municipal: En el ~ámbito de sus facultades y competencias, dictar leyes municipales y resoluciones, interpretarlas, derogarlas, abrogarlas y modificarlas".
                    <br>
                    Que, el Decreto Municipal No. 20 en su Articulo 23 parágrafo l señala: "Se considera clandestino a todo establecimiento en el que funcione cualquier actividad que de réditos económicos con relación a expendio y consumo de bebidas alcohólicas y otros que no cuenten con la autorización legal de funcionamiento emitida por la autoridad competente del G.A.M.E.A. ser considerado como una actividad dolosa y fraudulenta que se encuentra en contravención a presente reglamento. Asimismo por el articulo 85 y siguientes otorga al Ejecutivo Municipal con herramienta para ejercer y ejecutar el control, seguimiento y sanción a las actividades económicas que contravengan lo establecido por normativa vigente los operativos de contra Ordinario y Extraordinario."
                    <br>
                    Que, la Ley de Régimen Electoral de fecha 30 de junio de 2010 establece en su Articulo, 3°.• (Ámbitos) Los ámbitos territoriales del Referendo son los siguientes: inc. c) Referendo Municipal, en circunscripci6n municipal, nicamente para las materias de competencia exclusiva municipal, expresamente establecidas en la Constituci6n. La misma concordante con la Constituci6n Policita del Estado Articulo 302 Par6grafo I, numeral 3, que establece /iniciativa y convocatoria de consultas y referendos municipales en las materias de su competencia."
                    <br>
                    Que, la Ordenanza Municipal 084/2008 de fecha l O de abril de 2008 establece ARTICULO PRIMERO.- "imponer restricción administrativa sabre las bienes inmuebles de propiedad privada que se encuentran ubicados en el Distrito municipal N° 8, entendida coma las limitaciones al derecho de uso y disfrute de las bienes inmuebles. Restricci6n Administrativa que impide a sus propietarios y terceros, instalar casas de prostituci6n conocidas coma "lenocinios", "casas de cita tolerancia", "clubes privados" u otros, en las que se practique prostituci6n; en raz6n de existir interés colectivo sabre esta medida par parte de la vecindad de/ Distrito N° 8Disposici~n normativa que al presente se hallo vigente.
                    <br>
                    Que, por Resoluci6n Municipal 366/2006 de fecha 17 de octubre de 2006 el Concejo Municipal ha resuelto que: "ARTICULO PR/MERO.- Se dispone congelar todos los Trámites Administrativos Municipal/es relativo a las autorizaciones de apertura de bares, cantinas, café~ shop, karaokes, discotecas, whiskerías, lenocinios, clubes nocturnos, cabaret y otros negocios relacionados al expendio de bebidas alcohólicas, en tanto, se proceda a la reconsideración de la Ordenanza Municipal N° 074/04 de fecha 20 de mayo de 2004. Disposición normativa que al presente se halla vigente.
                    <br>
                    Que por informe PCJ/MAR/005/2018 de fecha 17 de octubre de 2018 suscrito por Abog. Miguel Ángel Rojas, concluye que el proyecto de Ley Municipal cumple a cabalidad con los requisitos establecidos por el articulo 87 del Reglamento General del Concejo Municipal, en cuanto a su texto, fundamento jurídico e informe legal y es acorde a lo establecido por el articulo 22 de la Ley 482 facultad de iniciativa legislativa que recae sobre las Concejalas o Concejales. En ese sentido el suscrito recomienda a su autoridad salvo mejor criterio, se remita el presente Proyect de Ley Municipal ante Presidencia del Concejo Municipal y de conformidad al articulo 87 inc. se incorpore en agenda y tratamiento ante el pleno concejal.
                    <br>
                    <br>"RESTRICCIÓN ADMINISTRATIVA PARA LA EXTENSION DE LICENCIAS DE FUNCIONAMIENTO A ACTIVIDADES ECONÓMICAS DE EXPENDIO, CONSUMO, COMERCIALIZACION, ALMACÉN, TRANSPORTE Y VENTA DE BEBIDAS ALCOHLICAS EN EL MUNICIPIO DE EL ALTO"
                    <br>
                    <br>
                    <h4>ARTÍCULO 1.</h4> (OBJETO).- La presente Ley tiene por objeto, restringir administrativamente la extensión de licencias de funcionamiento de nuevas Actividades Económicas de expendio, consumo, comercialización, almacén, transporte y venta de bebidas alcohólicas en la jurisdicci6n municipal de El Alto, hasta que la Alcaldesa o Alcalde Municipal realice la iniciativa y convocatoria a Consulta a la población.
                    <br>
                    <br>
                    <h4>ARTÍCULO 2.</h4> (FINALIDAD). La finalidad de la presente Ley es la de prevenir y controlar la proliferaci6n de bares, cantinas y otros en la ciudad de El Alto, que induzcan a la ciudadana y ciudadano al consume excesivo de bebidas alcohólicas, como medida de prevención, inseguridad, violencia, adicción, atentado a la salud publica, atentado a la integridad familiar,
                    entre otros riesgos.
                    <br>
                    <br>
                    <h4>ARTÍCULO 3.</h4> (ALCANCE). Las disposiciones contenidas en la presente Ley son de cumplimiento obligatorio para todas las personas naturales o jurídicas, que expendan, comercialicen, bebidas alcohólicas en la jurisdicción de El Alto.
                    <br>
                    <br>
                    <h4>ARTÍCULO 4.</h4> (DE LA RESTRICCIN).- Queda restringido la extensión de nuevas licencias de funcionamiento a actividades econ6micas de expendio, consumo, comercialización, almacén, transporte y venta de bebidas alcoh61icas, establecidas en las categorías C y D, en el Decreto Municipal N° 20 de fechas 26 de Marzo del 2014, dentro de la jurisdicci6n de! Gobierno Aut6nomo Municipal de El Alto, hasta que la Alcaldesa o Alcalde Municipal realice una consulta a la poblaci6n en el marco de los establecido por la Constituci6n Política de! Estado Articulo 302
                    parágrafo I, nm. 3.
                    <br>
                    <br>
                    <br>
                    <h4>ARTÍCULO 5.</h4> (CONTROL DE EXPENDIO DE BEBIDAS ALCOHLICAS). Las personas naturales o jurídicas, dedicadas al expendio de bebidas alcoh61icas, deberán brindar la cooperación, colaboración y acceso oportuno e inmediato a sus instalaciones, a los controles ejercidos por el Gobierno Aut6nomo Municipal de El Alto en coordinaci6n con la Policía Boliviana, no pudiendo limitar de ninguna forma su acceso ni alegar allanamiento o falta de orden judicial para ingreso; bajo sanci6n establecida en la presente Ley.
                    <br>
                    <br>
                    <h4>ARTÍCULO 6.</h4> (APLICACIN).- EI cumplimiento de la presente Ley es obligatoria para los habita y servidores públicos del Municipio de EI Alto, su inobservancia genera responsabilidad correspondientes a su naturaleza.
                    <br>
                    <br>
                    DISPOSICIÓN ADICIONAL
                    <br>

                    DISPOSICIÓN ADICIONAL ÚNICA.- Quedan sin efecto los actos administrativos emitidas por el Ejecutivo Municipal y sus dependencias, referentes a la emisi6n de autorizaci6n y/o otorgaci6n de licencias de funcionamiento de actividades econ6micas establecidas en las categorías C y D el Decreto Municipal N° 20 de fecha 26 de Marzo 2014 en los periodos 2017 y 2018.
                    <br>
                    DISPOSICIÓN TRANSITORIA
                    <br>

                    DISPOSICIÓN TRANSITORIA ~NICA.- A efectos de cumplimiento de lo dispuesto en el Art. 14 de la Ley N° 482 de Gobiernos Autónomos Municipales, remítase la presente Ley Municipal al Servicio Estatal de Autónomas en el plazo establecido.
                    <br>
                    DISPOSICIONES FINALES
                    <br>

                    DISPOSICIN FINAL PRIMERO (MODIFICACIN).- La presente Ley Municipal puede ser modificado y actualizado en por el pleno de! Concejo Municipal en funci6n a los resultados de su aplicación, asimismo cuando se emita nuevas normas administrativas municipales y nacionales que regulan ese tipo de actividades económicas.
                    <br>
                    DISPOSICIÓN FINAL SEGUNDA (CUMPLIMIENTO).- Queda encargado el Ejecutivo Municipal a troves de sus Unidades Organizacionales dar estricto cumplimiento a la presente Ley Municipal.
                    <br>
                    DISPOSICIÓN FINAL TERCERA (VIGENCIA).- La presente Ley Municipal entrar en vigencia plena a partir de su publicaci6n.
                    <br>
                    DISPOSICIÓN FINAL CUARTA (REMISIN).- Remítase el Órgano Ejecutivo Municipal para su respectiva promulgación.
                    <br>
                    Remítase al Órgano Ejecutivo para fines correspondiente de Ley.
                    <br>
                    Es dado en la Urbanizaci6n Rio Seco Libertad" del Distrito Municipal N° 4 de la ciudad de El Alto, a los veintitrés días del mes de octubre de dos mil dieciocho años.
                    <br>
                    <br>"PROMULGADA DE OFICIO POR EL PRESIDENTE DEL CONCEJO MUNICIPAL DE EL ALTO"
                    <br>
                    PROMULGACION DE LA LEY MUNICIPAL N· 513<br>

                    POR TANTO DE CONFORMIDAD A LA LEY N° 482 ART. 23 INC. K) DE GOBIERNOS AUTONOMOS MUNICIPALES, CONCORDANTE CON EL ART. 89 INC. BJ DEL REGLAMENTO GENERAL DEL CONCEJO MUNICIPAL, SE PROMULGA PARA QUE SE TENGA Y SE CUMPLA COMO LEY DI GOBIERNO AUTONOMO MUNICIP_• ALTO, A LOS OCHO DIAS DEI IES DE NOVI IBRE DE DOS DIECIOK ~NOS.
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