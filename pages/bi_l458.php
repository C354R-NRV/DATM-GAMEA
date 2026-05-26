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
    <title>DATM Ley 458</title>
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
    <li class="breadcrumb-item text-white active" aria-current="page">Ley 458</li>
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


                    <h1>LEY MUNICIPAL Nº 458</h1>
                    <input type="hidden" id="recurso_" value="l458">
                    <h1><span id="tituloPrincipal">Ley de actividades clandestinas de expendio y consumo de bebidas alcoholicas</span></h1>

                    <h3>Sr. ANTIOCO CALA APAZA</h3>
                    <h3>PRESIDENTE DEL CONCEJO MUNICIPAL DE EL ALTO</h3>

                    <h2>"CORRESPONSABILIDAD DE LOS PROPIETARIOS O RESPONSABLES DE BIENES INMUEBLES DONDE FUNCIONAN ACTIVIDADES CLANDESTINAS DE EXPENDIO Y CONSUMO DE BEBIDAS ALCOHOLICAS"</h2>

                    <p>Por cuanto la Ley Municipal es una disposición legal que emana del Concejo Municipal es de carácter general su aplicación y cumplimiento, es obligatorio en toda la jurisdicción de El Alto, el Concejo Municipal de El Alto (G.A.M.E.A.), aprueba a siguiente Ley Autónoma Municipal:
                    EXPOSICIÓN DE MOTIVOS:
                    </p>
                    <p>
                    Que, la Constitución Política del Estado en su Artículo 9 numeral 2, establece: "Los fines y funciones esenciales del Estado, para garantizar el bienestar, el desarrollo la seguridad y la protección e igual dignidad de las personas, las naciones, los pueblos y las comunidades, y fomentar el respeto mutuo y el dialogo intra-cultural, intercultural y plurilingüe."<br>
                    </p>
                    <p>
                    Que, la Constitución Política del Estado en su Artículo 283 establece: "El Gobierno Autónomo Municipal está constituido por un Concejo Municipal con facultad deliberativa, fiscalizadora y legislativa municipal, en el ámbito de sus competencias, y un Órgano Ejecutivo, presidido por el la Alcaldesa o Alcalde."<br>
                    </p>
                    <p>
                    Que, la Constitución Política del Estado en su Artículo. 299, Parágrafo II Numeral 13 señala: "La Seguridad Ciudadana es competencias del Gobierno Central y las entidades territoriales autónomas."<br>
                    </p>
                    <p>
                    Que, la Constitución Política del Estado Plurinacional de Bolivia en su Artículo 56 parágrafo II señala: "Se garantiza la propiedad privada siempre que el uso que se haga de ella no sea perjudicial al interés colectivo."<br>
                    </p>
                    <p>
                    Que, Constitución Política del Estado establece en el Artículo 107 determina: "El propietario no puede realizar actos con el único propósito de perjudicar o de ocasionar molestias a otros y en general no le está permitido ejercer su derecho en forma contraria al fin económico o social en vista al cual se le ha conferido el derecho."<br>
                    </p>
                    <p>
                    Que el Código Civil Decreto Ley Nº 12760 en su Artículo 105 numeral l. Establece: "La propiedad es un poder jurídico que permite usar, gozar y disponer de una cosa y debe ejercerse en forma compatible con el interés colectivo, dentro de los límites y con las obligaciones que establece el ordenamiento jurídico."<br>
                    </p>
                    <p>
                    Que, la Ley de Control al Expendio y Consumo de Bebidas Alcohólicas, No. 259 en su Artículo 10 dispone: "El Gobierno Nacional, las Entidades Territoriales Autónomas y las Instituciones Públicas y Privadas; implementarán medidas de promoción de la salud y prevención del consumo de bebidas alcohólicas en el ámbito de sus competencias."
                    </p>
                    <p>
                    Que, la Ley de Control al Expendio y Consumo de Bebidas Alcohólicas, No. 259 en su Artículo
                    12 dispone: "todos los establecimientos que expenden, fabriquen, importen y comercialicen bebidas alcohólicas, serán sujetos al control e inspección periódica por parte de las Entidades/{: Territoriales Autónomas en coordinacián con la Policía Boliviana, en el ámbito de sus competencias."<br>
                    </p>
                    <p>
                    Que, la Ley del Sistema Nacional de Seguridad Ciudadana "Para Una Vida Segura", en su Artículo 11 establece: "Es responsabilidad de las entidades territoriales autónomas municipales, en materia re_ de seguridad ciudadana, ejecutar en el municipio, en concurrencia con el nivel nacional del Estado y las entidades territoriales autónomas, los planes, programas y proyectos municipales en materia de seguridad ciudadana, en sujeción a la Política Pública Nacional de Seguridad
                    Ciudadana."
                    </p>
                    <p>
                    Que, la Ley del Sistema Nacional de Seguridad Ciudadana "Para Una Vida Segura", en su Artículo 23ºestablece: "Los Concejos Departamentales, Regionales, Municipales e Indígena Originario Campesinos, en el ámbito territorial que corresponda, en el marco de sus competencias y responsabilidades, tendrán las atribuciones de: aprobar los planes, programas y proyectos de prevención en materia de seguridad ciudadana, en sujeción al Plan Nacional de Seguridad Ciudadana; evaluar la ejecución de los planes, programas y 'proyectos en materia de seguridad ciudadana; e impulsar mecanismos que aseguren la activa participación de la sociedad civil en la formulación de planes, programas y proyectos de seguridad ciudadana, en el marco del Plan
                    Nacional de Seguridad Ciudadana."
                    </p>
                    <p>
                    Que, la Ley No. 482 de Gobiernos Autónomos Municipales en su Artículo 16 numeral 4 señala: "Las atribuciones del Concejo Municipal: En el ámbito de sus facultades y competencias, dictar leyes municipales y resoluciones, interpretarlas, derogarlas, abrogarlas y modificarlas".
                    Que, el Decreto Municipal No. 20 en su Artículo 23 parágrafo r señala: "Se considera clandestino a todo establecimiento en el que funcione cualquier actividad que de réditos económicos con relación al expendio y consumo de bebidas alcohólicas y otros que no cuenten con la autorización legal de funcionamiento emitida por autoridad competente del G.A.M.E.A. será considerado como una actividad dolosa y fraudulenta que se encuentra en contravención al presente reglamento. Asimismo por el Artículo 85 y siguientes otorga al Ejecutivo Municipal como herramienta para ejercer y ejecutar el control, seguimiento y sanción a las actividades económicas que contravengan lo establecido por normativa vigente los operativos de control Ordinario y Extraordinario."
                    </p>
                    <p>
                    Que, de acuerdo a Resolución Municipal 273/2016 de fecha 23 de octubre de 2016, el Concejo Municipal de el Alto resuelve la Conformación de la Comisión Especial para el tratamiento del Proyecto de Ley "DE SANCIÓN A PROPIETARIOS DE BIENES INMUEBLES DONDE SE ESTABLECEN O ADMITAN LOCALES CLANDESTINOS Y/O ILEGALES DE EXPENDIO Y CONSUMO DE BEBIDAS ALCOHÓLICAS", compuesto por los siguientes concejales: Concejal Francisco Javier Tarqui Torrez, Concejal Dr. Osear Huanca Silva, Concejal. Lic. Nancy Verónica Mamani Flores, Concejal Janneth Chuquimia Tapia.
                    </p>
                    <p>
                    Que, mediante Informe Coordinado N2 001/2017 de fecha 07 de abril de 2017, signado por
                    los concejales: Cjal Francisco Javier Tarqui Torrez Vicepresidente del Concejo Municipal de El Alto, Cjal Dr. Osear Huanca Silva, Presidente de la Comisión Jurídica, Cjal. Janneth Chuquimia Tapia, Presidente de la Comisión de Educación y Cultura del Concejo Municipal de El Alto en el cual en su parte de Conclusiones y Recomendaciones señala: "... La Comisión Especial de revisión del Proyecto de Ley "DE SANCIÓN A PROPIETARIOS DE BIENES INMUEBLES DONDE SE ESTABLECEN O ADMITAN LOCALES CLANDESTINOS Y/O ILEGALES DE EXPENDIO Y CONSUMO DE BEBIDAS ALCOHÓLICAS" recomienda su remisión del mencionado proyecto de Ley, cumpliendo las
                    formalidades administrativas que esta exija para su consideración en el Pleno del Concejo Municipal de El Alto.".
                    </p>
                    <p>
                    Que, en fecha 13 de abril de 2017 se llevo a cabo Sesión Ordinaria del Pleno del Concejo N2025/2017, en la cual se puso en consideración el Proyecto de Ley "DE SANCIÓN A PROPIETARIOS DE BIENES INMUEBLES DONDE SE ESTABLECEN O ADMITAN LOCALES CLANDESTINOS Y/O [LEGALES DE
                    EXPENDIO Y CONSUMO DE BEBIDAS ALCOHÓLICAS, en atención a los argumentos emitidos por el epleno del Concejo Municipal de El Alto, se define que el referido proyecto sea remitido a la Comisión
                    Especial para su revisión y coordinación posterior con el Ejecutivo Municipal.
                    </p>
                    <p>
                    Que, el Informe DRPT/UAJCC/VVB/N2 064/2017, de fecha 11 de mayo de 2017, elaborado por el Director de Recaudaciones y Políticas Tributarias, Lic. Víctor Nava Arce y la Jefa de Unidad de Asesoría Legal y Cobranza Coactiva Abog. Mes. Verónica Virginia Vera Bacarreza, en sus conclusiones señala: "... Por lo expuesto precedentemente, se concluye que el Gobierno Autónomo Municipal de El Alto, tiene la necesidad de contar con un instrumento normativo que permita corresponsabilizar a los propietarios y poseedores de los bienes inmuebles donde se ejerza actividades clandestinas destinadas al consumo y expendio de bebidas alcohólicas y sancionar administrativamente las acciones que violenten o pongan en riesgo la seguridad ciudadana de los estantes y habitantes de esta ciudad.
                    </p>
                    <p>
                    Que, el Informe CITE: DGAL/UNMAA/CPRC/20/2017, de fecha 12 de mayo de 2017, elaborado por la Asesora Legal de la Unidad de Normas Municipales y Asuntos Administrativos Sra. Claudia P. Ríos Cortés en sus conclusiones señala: "...El Proyecto de Ley Municipal sobre Corresponsabilidad de los Propietarios o Responsables de Bienes Inmuebles donde Funcionan Actividades Clandestinas de Expendio y Consumo de Bebidas Alcohólicas, no contraviene normativa vigente. La suscrita asesora, no encuentra impedimento legal para la emisión del "... PROYECTO DE LEY DE CORRESPONSABILIDAD DE LOS PROPIETARIOS O RESPONSABLES DE BIENES INMUEBLES DONDE FUNCIONAN ACTIVIDADES CLANDESTINAS DE EXPENDIO Y CONSUMO DE BEBIDAS ALCOHOLICAS" en sus 7 Artículos, y sus Disposiciones Transitorias y Finales... "
                    </p>
                    <p>
                    Que, el Informe CITE: SMSC/FPP /047 /2017, de fecha 12 de mayo de 2017, elaborado por el Asesor Jurídico de la Secretaría Municipal de Seguridad Ciudadana, Abog. Franolic Patty Patty, concluye: "... Conforme podrá evidenciar su autoridad, se dio cumplimiento a la determinación del Concejo Municipal de Seguridad Ciudadana, contenida en la Resolución Nº 002/2016 emitida por este ente colectivo en fecha 6 de Octubre de 2016, por Jo que producto de las reuniones de coordinación con las diferentes Unidades Organizacionales competentes del Ejecutivo Municipal y los Asesores de la Comisión Especial para el tratamiento del "Proyecto de Ley De Sanciones a Propietarios de Bienes Inmuebles Donde se Establecen o Admitan Locales Clandestinos y/o Ilegales de Expendio y Consumo de Bebidas Alcohólicas". A la fecha se, cuenta con un documento final de Ley denominado "PROYECTO DE LEY DE CORRESPONSABILIDAD DE LOS PROPIETARIOS O RESPONSABLES DE BIENES INMUEBLES DONDE FUNCIONAN ACTIVIDADES CLANDESTINAS DE EXPENDIO Y CONSUMO DE BEBIDAS ALCOHOLICAS"; proyecto de Ley que en su contenido recogió las diferentes aportes de los representantes de la Secretaría Municipal de Seguridad Ciudadana, Dirección General de Asesoría Legal y Dirección de Recaudaciones conjuntamente los Asesores de la Comisión Especial para el tratamiento de este proyecto de Ley. El Proyecto de Ley en su esencia busca respaldar las acciones que desarrolla las diferentes Unidades Organizacionales del G.A.M.E.A., en cumplimiento de la normativa nacional y municipal vigente descrito en el presente. Conforme podrá evidenciar el Proyecto de Ley fue valorado técnica y jurídicamente; por lo que se RECOMIENDA, que a través de la instancia que corresponda, se remita el presente informe conjuntamente sus antecedentes ante la Comisión Especial del Concejo Municipal de El Alto, sea para fines expresados en la nota CITE: CE/CMEA/033/2017... "
                    </p>
                    <p>
                    Que, mediante informe CMEA/JTT/mkv/cmsa/002/2017 de fecha 14 de Agosto de 2017, el cual recomienda:"En merito a todos los antecedentes, consideraciones normativas y sobre la base de los informes DRPT/UAJCC/VVB/Nº064/2017 de la .Dirección de Recaudaciones y Políticas
                    Tributarias, CITE: DGAL/UNMAA/CPRC/20/2017 de la Unidad de Normas Municipales y Asuntos Administrativos y el CITE: SMSC/FPP/047/2017 de la Secretaría Municipal de Seguridad Ciudadana referente al PROYECTO DE LEY DE "CORRESPONSABILIDAD DE LOS PROPIETARIOS O RESPONSABLES DE BIENES INMUEBLES DONDE FUNCIONAN ACTIVIDADES CLANDESTINAS DE EXPENDIO Y CONSUMO DE BEBIDAS ALCOHOLICAS... ".
                    </p> 
                    <br> 
                    <h4>ARTICULO 1.- (OBJETO).</h4>
                    La presente Ley tiene por objeto fortalecer la normativa que regula el expendio y consumo de bebidas
                    alcohólicas en la jurisdicción municipal de El Alto, con la finalidad de prevenir y controlar la proliferación de actividades clandestinas, determinando sanciones por la corresponsabilidad de los propietarios o responsables del bien inmueble donde funcionan esta actividad ilegales. Con el fin de mejorar la seguridad ciudadana de los habitantes y estantes del Municipio de El Alto.
                    <br>
                    <br>    
                    <h4>ARTÍCULO 2.- (MARCO LEGAL).</h4>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;• Constitución Política del Estado de 7 de febrero de 2009.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;• Declaración Universal de Derechos Humanos.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;• Convención Americana de Derechos Humanos.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;• Decreto Ley Nº 12760 (Código Civil).
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;• Código Tributario Boliviano Ley N2 2492, de 2 de agosto de 2003.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;• Ley Marco de Autonomías y Descentralización "Andrés Ibañez" Nº 031 de 19 de julio de 2010.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;• Ley de Gobiernos Autónomos Municipales Nº 482 de 9 de enero de 2014.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;• Ley de Control de Expendio y Consumo de Bebidas Alcohólicas N° 259 de 11 de julio de 2012.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;• Decreto Supremo Nº 1347 de 10 de septiembre de 2012.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;• Ley Nº 264 Sistema nacional de seguridad Ciudadana "Para una vida segura"
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;• Y demás disposiciones conexas en vigencia.
                    <br><br>
                    <h4>ARTÍCULO 3.- (PRINCIPIOS).</h4>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Universalidad.-La protección de los derechos y garantías de los habitantes y estantes del municipio de El Alto.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Legalidad.-Todos los actos del Gobierno Autónomo Municipal de El Alto se encuentran
                    en sujeción a la Ley y disposiciones normativas, por lo que se presume su legitimidad.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Responsabilidad.- Se entenderá como una forma de deber, que surge desde la conciencia moral del individuo, y que es capaz de proyectarse al resto de la sociedad.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Cooperación.-Las instituciones públicas y privadas, deberán colaborar de forma
                    efectiva y responsable en la prevención y lucha frontal contra la inseguridad ciudadana de la ciudad de El Alto.
                    <br><br>
                    <h4>ARTÍCULO 4.- (DEFINICIONES)</h4>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Actividades económicas de expendio y consumo de bebidas alcohólicas clandestinas.-Es el desarrollo de la actividad económica de expendio y consumo de bebidas alcohólicas sin contar con Licencia de Funcionamiento.
                    '
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Licencia de Funcionamiento.-Es la autorización que concede el municipio a toda persona natural o
                    jurídica para el ejercicio de toda actividad económica dentro de la Circunscripción Territorial de El
                    Alto .

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Unidad de Fomento de Vivienda (UFV).-Es un parámetro económico definido por el Banco Central de
                    Bolivia
<br><br>
                    <h4>ARTÍCULO 5.- (CORRESPONSABILIDAD).</h4>
                    <p>Será la responsabilidad atribuible al propietario o responsable del bien inmueble por la actividad ejercida por el titular o responsable de la actividad económica de expendio y consumo de bebidas alcohólicas clandestina
                    que genera obligaciones y consecuencias sancionatorias por ser perjudicial al interés colectivo.
                    </p>
                    <h4>ARTICULO 6.- (SANCIONES).</h4>
                    <p>PRIMERA.- El propietario o en su caso el responsable del bien inmueble que incurra en inobservancia a la presente Ley será sancionado con una multa que irá desde Dos Mil Unidades de Fomento de Vivienda (2.000 UFV's) a Diez Mil Unidades de Fomento de Vivienda (10.000 UFV's).
                    </p><p>
                    SEGUNDA.- Sin perjuicio de existir la posibilidad de ser denunciado ante autoridad competente según la gravedad del hecho ilícito.
                    </p>
                    <h4>ARTICULO 7.- (DE LA APLICACIÓN, EJECUCIÓN Y COBRO DE SANCIONES).</h4>
                    <p>
                    Las atribuciones y competencias para la aplicación, ejecución y cobro de sanciones contenidas en la presente Ley, serán establecidas mediante reglamentación específica.
                    </p>
                    <h4>DISPOSICION TRANSITORIA UNICA</h4>

                    A efectos de cumplimiento de lo dispuesto en el Art. 14 de la Ley Nº 482 de Gobiernos Autónomos Municipales, remítase la presente Ley Municipal al Servicio Estatal de Autonomías en el plazo establecido.

                    <h4>DISPOSICIONES FINALES</h4>
                    
                    <p>
                    PRIMERA.·El Órgano Ejecutivo Municipal, a través de sus Unidades Organizacionales, deberán adecuar el Decreto Municipal Nº 20 de fecha 26 de marzo de 2014 en lo que corresponda a la reglamentación de la presente Ley y generar las modificaciones y actualizaciones necesarias, en un plazo no mayor a ciento veinte (120) días calendario a partir de su publicación.
                    </p>
                    <p>
                    SEGUNDA.- Los medios de comunicación escritos, audio visuales y radio emisoras públicas y privadas en la jurisdicción municipal de El Alto, deberán difundir de manera gratuita la presente Ley Municipal y Reglamento Respectivo, en coordinación con el órgano legislativo y el órgano Ejecutivo del GAMEA".
                    </p>
                    <p>TERCERA.- Queda encargado el Ejecutivo Municipal a través de sus Unidades Organizacionales a realizar las gestiones pertinentes para la programación e inscripción en el POA vigente, así como las gestiones para las modificaciones presupuestarias necesarias para la ejecución de la presente Ley y su reglamentación, en coordinación con el Órgano Legislativo y el Órgano Ejecutivo del Gobierno Autónomo Municipal de El Alto.
                    </p>
                    <p>CUARTA.-La presente Ley Municipal entrará en vigencia plena a partir de su publicación. Remítase al Órgano Ejecutivo Municipal para su respectiva promulgación.
                    Es dada en la Sala de Sesiones del Concejo Municipal de El Alto, a los veintiocho días del mes de noviembre del año dos mil diecisiete.
                    </p>
                    <h4>PROMULGACIÓN DE LA LEY MUNICIPAL Nº 458</h4>

                    EN VIRTUD A SUS ANTECEDENTES Y A LA ATRIBUCIÓN CONFERIDA POR ELART. 26, PUNTO TRES DE LA LEY Nº 482 DE "GOBIERNOS AUTÓNOMOS MUNICIPALES", PROMULGO LA LEY MUNICIPAL Nº 458 DEL 28 DE NOVIEMBRE DE 20171 PARA QUE SE TENGA Y SE CUMPLA
                    COMO LEY DEL GOBIERNO AUTÓNOMO MUNICIPAL DE a, ALTO, A LOS CUATRO DÍAS DEL
                    MES DE DICIEMBRE DEL AÑO DOS MIL DIECISIETE.

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