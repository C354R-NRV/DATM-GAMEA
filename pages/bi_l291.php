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
    <title>DATM Ley 291</title>
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
    <li class="breadcrumb-item text-white active" aria-current="page">Ley 291</li>
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


                    <h1>Ley Municipal 291</h1>  
                    <input type="hidden" id="recurso_" value="l291">
                    <h1><span id="tituloPrincipal">Ley de uso provisional de espacios de dominio público municipal y pago de patentes</span></h1>  

                    <h2>DEL USO PROVISIONAL DE ESPACIOS DE DOMINI0 PÚBLICO MUNICIPAL Y PAGO DE PATENTES</h2>

                    <br>(COMERCIANTES MINORISTAS)

                    <h3>DR. OSCAR HUANCA SILVA
                        PRESIDENTE DEL CONCEJO MUNICIPAL DE EL ALTO</h3>

                    <p>Por cuanto, la Ley Municipal es una disposici6n legal que emana del Concejo Municipal, es de carácter general, su aplicaci6n y cumplimiento es obligatorio en toda la jurisdicci6n de la ciudad de El Alto, el Concejo Municipal de El Alto, aprueba la siguiente Ley Aut6noma Municipal.
                    </p>
                    <h4>VISTOS:</h4>

                    <p>Que, por H.RR. 1143/015, nota LETRA: DAM CITE: 0€81/2015 de fecha 26 de agosto 2015, suscrita por la Lic. C. Soledad Chapetón Tancara "Alcaldesa Municipal de la Ciudad de EI Alto", proyecto de ley, con sus respectivos informes, solicitando su consideración al pleno del Concejo Municipal.
                    </p>
                    <p>
                        EXPOSICION DE MOTIVOS
                    </p>
                    <p>

                        Que, la gestion municipal actual plantea la revalorizaci6n del espíritu de trabajo y esfuerzo del pueblo alteño, la vigencia del estado de derecho, la institucionalidad y el principio de honestidad y transparencia, en apego a las competencias establecidas en la Constituci6n Política del Estado Plurinacional y las leyes vigentes, éstas directrices son las que van a conducir a una mejora de la calidad de vida de la ciudadanía alteña, la mejora de atención de los servicios municipales, así como el fortalecimiento de su desarrollo, elevándola como líder del Eje Metropolitano Paceño conformado por municipios de La Paz, de Viacha, de
                        Zongo, de Pucarani, de Laja y Achocalla.
                    </p>
                    <p>
                        Que, el Censo Nacional de Poblaci6n y Vivienda - 2012, sea la que la ciudad de El Alto, es la segunda ciudad mas poblada del Estado Plurinacional de Bolivia, después de la ciudad de Santa Cruz de la Sierra con sus 848.840 habitantes registrados. Este hito tan importante nos hace ver, que esta ciudad necesita despegar su desarrollo económico productivo, por ello su institución ms importante como es el Gobierno Autónomo Municipal debe otorgar condiciones favorables a su matriz productiva, en especial en el sector gremial del comercio minorista. •
                    </p>
                    <p>
                        Que, el sector gremial de la ciudad de El Alto en particular ha solicitado de manera pública y reiterada, mediante medias de comunicación escrita, de circulación nacional, el pago de patentes municipales directo al Gobierno Autónomo Municipal de EI Alto, mismos que se encuentran reflejadas en las publicaciones realizadas en el matutino de "La Razón", de fechas 30 de junio y 1 de julio del 2015, y en el Periódico "El Diario" el 16 de abril de 2015.
                    </p>
                    <p>
                        Que, según los Informes Técnicos Legales emitidos por las diferentes Secretarias del Ejecutivo Municipal, en conclusiones señalan que el ordenamiento jurídico legal municipal referente al uso provisional de los bienes de dominio público municipal fue vulnerado debido al incumplimiento de las prohibiciones estipuladas en ellas, generando caos peatonal y congestionamiento vehicular de las vías publicas del municipio. Asimismo manifiestan la inviabilidad de suscripción de convenios ampliatorios en virtud a una serie de observaciones debidamente respaldadas.
                    </p>
                    <p>
                        Considerando los informes del Ejecutivo Municipal:
                    </p>
                    <p>
                        Que el informe: SMPIU/WAP/041/2015 del Asesor Legal de Secretaria Municipal de Planificación de infraestructura Urbana en su parte ANALISIS CONCLUSIONES indica: "Siendo que los proyectos, se recomienda y conforme a normativa y competencia municipal la administraci6n de las mismos corresponde al Municipio, aspecto que debe ser tornado en cuenta en el citado proyecto de ampliación de convenio gremial. Con relaci6n al Articulo D~CIMO CUARTO del proyecto de convenio, referente a la retroactividad a partir de la gestión 2005, solo en materia Social y Penal se establece la retroactividad de la norma. En el presente caso se recomienda establecer para lo venidero. Por otro lado, en cumplimiento al Convenio Gremial de fecha 15 de agosto de 2005, claramente establece en la parte pertinente de la cláusula D~CIMO CUARTA que el pago anual de patente no sufrir~ actualización ni mantenimiento de valor por el lapso de diez años, lapso que se cumplir~ el 15 de agosto de 2015, una vez cumplido este plazo fatal se recomienda actualizar el pago de patente anual por zonas en el proyecto de ampliaci6n del Convenio Gremial. Con relación a la creación del Banco Municipal, establecida en la cláusula DECIMO NOVENA del citado proyecto de ampliación de convenio gremial, ~sta competencia no es de los municipios. Por Ultimo de los antecedentes y análisis que le ha correspondido el proyecto de Ampliación de Convenio Gremial a favor de la Federación de Trabajadores Gremiales, Artesanos, Comerciantes Minoristas y Vivanderos de la ciudad de EI Alto, es inviable conforme a las observaciones citadas",
                    </p>
                    <p>
                        Que, INFORME CITE: SMSM/0056/15 de la Ora. Miriam Yujra Gutierrez Asesora Legal de Secretaria Municipal de Servicios Municipales, en su parte conclusiva indica, con respecto a la CLAUSULA D~CIMA SEGUNDA: "(...) se manifiesta lo siguiente la Secretaria de Servicios Municipales a través de sus Direcciones no opera en el trámite de instalación de energía eléctrica, ni de instalación de piletas ya que los mismos son realizados por las entidades correspondientes coma ser EPSAS y DELAPAZ RECOMENDACIONES.- AI leer y analizar el proyecto de ampliación de convenio se puede evidenciar de que no seria un convenio ya que el significado del mismo como tal es un pacto o un tratado de partes en donde las partes se comprometen a tener derechos corno obligaciones a respetar las mismos y hacerlos cumplir, pero en el presente se pudo comprobar que no existiría participación a favor del GAMEA, en las clausulas estipuladas ya que solo tiene referencias y preferencias para el sector gremial donde no existiría obligaciones para las mismos en cuanto a compromisos par parte de ellos hacia el municipio de El Alto
                        coma a su Alcaldía Municipal.
                    </p>
                    <p>
                        Que, el INFORME CITE: SMSC/039/2015 del Abog. Franolic Patty Patty Asesor Juridico-SMSC (SECRETARIA MUNICIPAL DE SEGURIDAD CIUDADANA), en su parte conclusiones y sugerencias indica: "sin entrar en mayores consideraciones, habiendo realizado el análisis respectivo del Convenio de Referencia elacionado a la Secretaria Municipal de Seguridad Ciudadana y sus Unidades Dependientes, EL SUSCRITO NO VE LA PERTINENCIA de las clausulas Quinta y Vigésima Primera del Convenio de Referencia, par los extremos señalados en el presente".
                    </p>
                    <p>
                        El informe CITE: SMMUS/MCC/004/2015 de fecha 12 de agosto de 2015, de Maritza Calzada Condori Asesora Legal de Secretaria de Movilidad Urbana Sostenible, en su parte conclusiva indica: "establecer % que la Secretaria de Movilidad Urbana Sostenible, no tiene la facultad de realizar las inspecciones de asentamientos que se encuentran en las lugres que prohíbe la Ordenanza Municipal 106/2004"
                    </p>
                    <p>
                        Que, el informe DRyPT/OI/8/2015 de 12 agosto de 2015, de Lic. Fernando Terán Vargas, Encargado Área Otros ingresos, en su parte RECOMENDACIONES: "de lo antecedido y en cumplimiento a lo establecido en la Ley N° 2492 de 2 de agosto 2003, respecto al cobro de los patentes municipales no puede estar sujetas a requisitos de entes privados, pues la obligación tributaria constituye un vínculo de carácter personal entre el municipio y el sujeto pasivo obligado al pago, establecido en el articulo 13 de la Mencionada Ley. Se debe mantener el "Pago Único Anual de la Patente Eventual de Actividades Económicas Desarrollado en Sitio Público".
                    </p>
                    <p>
                        Que, el informe SMDE/DFM/001/2015, de 12 de agosto de 2015, de Heriberto Castañeta Cruz, Director de Ferias y Mercados a.i., en su parte conclusiva indica: "El análisis realizado al proyecto de convenio gremial específicamente en cuanto a la implementaci6n de infraestructura y requerimiento de servicios, previa
                        coordinación con el sector el GAMEA se encuentra en la capacidad de gestionar e implementar programas y proyectos que vayan en beneficio del sector. Asimismo es importante el pronunciamiento técnico y legal en referencia a los diferentes instancias municipales que tienen competencias respecto a la problemática del sector gremial.
                    </p>
                    <p>
                        Que, el INFORME TÉCNICO LEGAL CITE SDME-AL-09/2015 de fecha 14 de agosto 2015, de Mercedes Sandy Plata Lopez, Asesora Legal Secretaria Municipal Desarrollo Económico, en su parte de recomendaciones señala: "En virtud a los antecedentes se recomienda regular el uso temporal de espacios de dominio público municipal y establecer el pago de patentes (que hace referencia la cláusula décimo cuarto del proyecto de ampliación de convenio) mediante una ley municipal y reglamentos específicos que establezcan procedimientos claros para su aplicación. Los mismos que no podrán determinar que el GAMEA interfiera en la vida orgánica de las instituciones gremiales debiendo anular cualquier tipo de exigencias y/o autorizaciones, mas que las establecidas por el ordenamiento jurídico vigente".
                    </p>
                    <p>
                        Que, el INFORME CITE: DGAL/UNMAAIFSR/237/2015 de fecha 18 de agosto de 2015, de Abog. Freddy Segales Ronquilla, Asesor Jurídico UNMAA de la Dirección General de Asesoría Legal, en su parte RECOMENDACIONES indica: "considerando las atribuciones del GAMEA conferidas a través del Art. 302 de la Constitución Política del Estado, Art. 5 y7 de la Ley N° 031 Marco de Autonomías "Andrés Ibañez", Art. 16 numeral 4 y el punto 3 d)del presente informe, corresponde que a través del Concejo Municipal de El Alto se emita una Ley Municipal que regule el uso temporal espacios de dominio municipal estableciendo en la misma el pago de la patente municipal conforme normativa vigente".
                    </p>
                    <p>
                        Que, según los Informes Técnicos Legales emitidos por las diferentes Secretarias del Ejecutivo Municipal, en conclusiones recomendaciones señalan que es inviable la ampliación de Convenio Gremial por 20 años, es más señalan que el ordenamiento jurídico legal municipal referente al uso provisional de bienes de
                        dominio publico municipal habría sido vulnerado debido al incumplimiento de las mismas. Asimismo señalan que es prudente que el Concejo Municipal en uso de sus atribuciones señaladas por ley regule el uso provisional de espacios de dominio público por una ley.
                    </p>
                    <p>
                        Que, además existiendo pedidos de varios sectores sobre el pago directo de patentes, tal como se evidencia en la carpeta adjunta.
                    </p>
                    <p>
                        CONSIDERANDO:
                    </p>
                    <p>
                        Que, el Art. 283 de la Constituci6n Política del Estado establece: El Gobierno Autónomo Municipal esta constituido por un Concejo Municipal con facultad deliberativa, fiscalizadora y legislativa municipal en el ámbito de sus competencias; y un órgano ejecutivo presidido por Alcaldesa o el Alcalde.
                    </p>
                    <p>
                        Que, el Articulo·410, parágrafo ll de la Constitución Política del Estado establece sobre la primacía de la normativa constitucional de la siguiente forma: "La Constituci6n es la norma suprema de! ordenamiento jurídico boliviano y goza de primacía frente a cualquier otra disposición normativa". Complementariamente
                        a la misma el articulo 9, numeral 4 de la merituada Norma Suprema del Estado Plurinacional establece:
                    </p>
                    <p>
                        "Son fines y funciones esenciales del Estado, además de los que establece la Constituci6n y la ley: Garantizar el cumplimiento de los principios, valores, derechos y deberes reconocidos y consagrados en esta Constitución".
                    </p>
                    <p>
                        Que, el Estado Plurinacional de Bolivia garantiza el derecho a la asociación, tal como lo dispone el articulo 21, numeral 4 de la merituada Constitución Política del Estado, señalando que: "Las bolivianas y los bolivianos tienen los siguientes derechos: A la libertad de reunión y asociación, en forma publica y privada, con fines lícitos". Complementariamente a la anterior el articulo 314 dispone que: "Se prohíbe el monopolio y el oligopolio privado, así como cualquier otra forma de asociación o acuerdo de personas naturales o jurídicas privadas, bolivianas o extranjeras, que pretendan el control y la exclusividad en la producci6n y comercialización de bienes y servicios".
                    </p>
                    <p>
                        Que, el trabajo gremial goza de la protección del Estado, así como de sus niveles territoriales municipales, tal como lo establece La Constitución Política del Estado Boliviano en su articulo 47 parágrafo II "Las trabajadoras y los trabajadores de pequeñas unidades productivas urbanas o rurales, por cuenta propia, y gremialistas en general, gozaran por parte del Estado de un régimen de protección especial, mediante una política de intercambio comercial equitativo y de precios justos para sus productos, así como la asignación preferente de recursos económicos financieros para incentivar su producción".
                    </p>
                    <p>
                        Que, el articulo 302, parágrafo I, numeral 20 de la tan mentada Constitución Política del Estado establece: "Son competencias exclusivas de los gobiernos municipales autónomos, en su jurisdicción: Creación y administración de tasas, patentes a la actividad económica y contribuciones especiales de carácter municipal.
                    </p>
                    <p>
                        Que, el articulo 272 de la Constitución Política del Estado establece: "La autonomía implica la elección directa de sus autoridades por las ciudadanas y ciudadanos, la administración de sus recursos económicos, y el ejercicio de las facultades legislativa, reglamentaria, fiscalizadora y ejecutiva, por sus órganos del gobierno autónomo en el ~ámbito de su jurisdicción y competencias y atribuciones. Concordante con esta disposición constitucional, el art. 6, parágrafo II, numeral 3 de la Ley N° 031 Marco de Autonomías y Descentralización "Andrés Ibañez" establece que la "autonomía es la cualidad gubernativa que adquiere una entidad territorial de acuerdo a las condiciones y procedimientos establecidos en la Constitución Política del Estado y la presente Ley, que implica la igualdad jerárquica o de rango constitucional entre entidades territoriales autónomas, la elección directa de sus autoridades por las ciudadanas y los ciudadanos, la administración de sus recursos económicos y el ejercicio de facultades legislativa, reglamentaria, fiscalizadora y ejecutiva por sus órganos de gobierno autónomo, en el ~ámbito de su jurisdicción territorial y de las competencias y atribuciones establecidas por la Constitución Política del Estado y la ley".
                    </p>
                    <p>
                        Que, el articulo 339 de la Constitución Política del Estado concordante con el articulo 31 de la Ley de Gobiernos Autónomos Municipales establece, sobre la naturaleza de los bienes de dominio público del Estado de la siguiente forma; "Los bienes de patrimonio del Estado y de las entidades publicas constituyen propiedad del pueblo boliviano, inviolable, inembargable, imprescriptible e inexpropiable; no podrán ser empleados en provecho particular alguno. Su calificación, inventario, administración, disposición, registro obligatorio y formas de reivindicación serán regulados por la ley".
                    </p>
                    <p> .
                        Que, la Ley N° 2492 (Régimen Tributario Boliviano) en su articulo 21, concordante con el articulo 302, parágrafo I, numeral 20 de la Constitución Política del Estado establece que el (Sujeto Activo) en materia tributaria es:" es el Estado, cuyas facultades de recaudación, control, verificación, valoración, inspección previa, fiscalización, liquidación, determinación, ejecución y otras establecidas en este Código son ejercidas por la Administraci6n Tributaria nacional, departamental y municipal dispuestas por Ley. Estas facultades constituyen actividades inherentes al Estado".
                    </p>
                    <p>
                        Que, la Ley 2341 (Procedimiento Administrativo) en su articulo 4, inciso g señala los principios generales de la administración publica: que son: Principio de legalidad y presunción de legitimidad: Las actuaciones de la Administración Publica por estar sometidas plenamente a la Ley, se presumen legitimas, salvo expresa declaración judicial en contrario;

                        Que, el Ministerio de Economía y Finanzas Públicas, por nota MEFPIVPTIDGT/UTTRE/N° 334/2015 de fecha 5 de agosto de 2015, con referencia a PAGO DE PATENTES MUNICIPALES: indica: "En gestiones pasadas, este despacho aclaró reiteradamente al GAMEA que el cobra de las patentes Municipales y por ende la autorización para la realización de actividades económicas, no puede estar sujeta a requisitos de certificaciones y/o afiliaciones a entes privados, considerando que la obligación tributaria constituye un vinculo de carácter personal entre el Estado y el sujeto pasivo obligado al pago, conforme lo establece el articulo 13 de la Ley N° 2492 Código Tributario Boliviano (CTB).
                    </p>
                    <p>
                        Que, por otra parte con referencia a los (Bienes Municipales de Dominio Público), la Ley N° 482 (de Gobiernos Autónomos Municipales) en su articulo 31 establece categóricamente que son: aquellos destinados al uso irrestricto de la comunidad, estos bienes comprenden, sin que esta descripción sea limitativa:
                    </p>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Calles, avenidas, aceras, cordones de acera, pasos a nivel, puentes, pasarelas, pasajes, caminos vecinales; y comunales, túneles y demás vías de tránsito.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Plazas, parques, bosques declarados públicos, áreas protegidas municipales y otras áreas verdes y espacios destinados al esparcimiento colectivo y a la preservación del patrimonio cultural.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Bienes declarados vacantes por autoridad competente, en favor del Gobierno Autónomo Municipal
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Ríos hasta veinticinco (25) metros a cada lado del borde de máxima crecida, riachuelos, torrenteras y quebradas con sus lechos, aires y taludes hasta su coronamiento.

                    <p>
                        Que, el articulo 5 de la mentada Ley N° 482 (de Gobiernos Autónomos Municipales) establece la atribución especifica para dl órgano Ejecutivo Municipal sobre el (USO TEMPORAL DE BIENES DE DOMINIO PUBLICO) de la siguiente forma: "Corresponde al Órgano Ejecutivo Municipal proponer al Concejo Municipal, regule mediante Ley el uso temporal de Bienes de Dominio Público Municipal".
                    </p>
                    <p>
                        Que, la Ley Autonómica Municipal N° 87 de Convenios Intergubernamentales e Interinstitucionales del Gobierno Autónomo Municipal de El Alto, en su articulo 13 establece que el: "Concejo Municipal tiene la atribución y competencia conforme normativa vigente, aprobar, ratificar o rechazar mediante Lev Municipal todos las convenios remitidos por el Ejecutivo Municipal.
                    </p>
                    <p>
                        Que, el articulo 86 del Reglamento General del Concejo Municipal de EI Alto establece que: "la ley municipal, es la disposici6n legal que emana del Concejo Municipal emergente del ejercicio de su facultad legislativa,... es de carácter general su aplicaci6n y cumplimiento es obligatorio desde el momento de su publicación. Concordante con la misma el articulo 84 inc. "g" del referido reglamento general establece que: "los proyecto de ley y resoluciones municipales podrán ser presentadas a iniciativa de: las Concejalas y Concejales".
                    </p>
                    <p>
                        Que, finalmente la Constitución Política del Estado, no solo establece derechos y obligaciones para las bolivianas y bolivianos, sino también deberes imperativos que cada uno de las ciudadanas y ciudadanos debemos cumplir, en ese entendido articulo 108, numerales 1 y 3 establecen: "Son deberes de las
                        bolivianas y los bolivianos: Conocer, cumplir y hacer cumplir la Constitución y las leyes; Promover y difundir la práctica de los valores y principios que proclama la Constitución".
                    </p>
                    <p>
                        EL CONCEJO MUNICIPAL DE EL ALTO
                        DECRETA
                        LEY MUNICIPAL N° 291

                        DEL USO PROVISIONAL DE ESPACIOS DE DOMINIO PUBLICO MUNICIPAL Y PAGO DE PATENTES ;

                        (COMERCIANTES MINORISTAS)
                    </p>

                    <h4>DISPOSICIONES GENERALES</h4>

                    <p>
                        Articulo 1.- (OBJETO).- La presente ley tiene por objeto regular el uso temporal de espacios de dominio publico municipal por parte de asentamientos (de Trabajadores Gremiales, Artesanos, Comerciantes Minoristas y Vivanderos de la Ciudad de _El Alto) legalmente constituidos y establecer el pago de patentes directo al Gobierno Autónomo Municipal de El Alto.
                    </p>
                    <p>
                        Articulo 2.- (MARCO LEGAL).-La presente ley tiene como marco a las disposiciones previstas en la Constitución Política del Estado Plurinacional de Bolivia; la disposición adicional primera de la Ley 031 (Marco de Autonomías y Descentralización "Andrés Ibañez"), Ley N° 482 (De Gobiernos Autónomos Municipales); Ley N° 2341 (Procedimiento Administrativo); Ley N° 2492 (Código Tributario Boliviano); Ley Municipal N' 87 de Convenios Intergubernamentales e Interinstitucionales del Gobierno Aut6nomo Municipal de El Alto; Resoluci6n Municipal N"° 170/2014 (Reglamento General del Concejo Municipal de El Alto) y otras aplicables.
                    </p>
                    <p>
                        Articulo 3.- (AMBITO DE APLICACION).- La presente ley se aplicar~ a todos los asentamientos temporales (de Trabajadores Gremiales, Artesanos, Comerciantes Minoristas y Vivanderos de la Ciudad de EI Alto) legalmente establecidos y que se encuentren en espacios de dominio publico municipal pertenecientes al Gobierno Autónomo Municipal de El Alto.
                    </p>
                    <p>
                        Articulo 4.- (DEFINICIONES).- Para fines de aplicación e interpretación de la presente ley municipal se utilizarán las siguientes definiciones:

                        <br>&nbsp;&nbsp;&nbsp;&nbsp;ASENTAMIENTO: Es la acción de usar de forma provisional y temporal los espacios públicos del Gobierno Autónomo Municipal de El Alto por parte de los comerciantes gremiales que se encuentren legalmente establecidos para ejercer sus actividades económicas.

                        <br>&nbsp;&nbsp;&nbsp;&nbsp;ASENTAMIENTO COLECTIVO: Es la actividad ejercida por un conjunto de personas que se encuentran asociadas y organizadas en gremio, bajo un mismo fin licito y que cuentan con una representación debidamente conformada y legalmente establecidos en la jurisdicción territorial del Gobierno Autónomo Municipal de El Alto.

                        <br>&nbsp;&nbsp;&nbsp;&nbsp;ASOCIACION: Es una relación que une a una persona a un grupo de personas, los cuales tienen fines y objetivos comunes, siendo la misma representado por una Directiva y que se encuentran enmarcados por lo dispuesto en la Constitución Política del Estado y demás disposiciones normativas vigentes.
                    </p>
                    <p>
                        Articulo 5.- (BIENES MUNICIPALES DE DOMINIO PÚBLICO).- Los Bienes Municipales de Dominio Publico son aquellos que se encuentran plenamente establecidos en el Articulo 31 de la Ley N"° 482 (de Gobiernos Autónomos Municipales)
                    </p>
                    <p>
                        Articulo 6.- (ASENTAMIENTOS).- Se reconocen los asentamientos colectivos (por Asociaciones) legalmente constituidos que cuenten con Ordenanza Municipal y/o Ley Municipal que lo respalde y que hayan sido promulgados hasta la fecha de publicación de la presente ley municipal. Los cuales tienen carácter provisional y temporal, al estar en espacios de dominio publico dentro de la Jurisdicción de la ciudad de EI Alto.
                    </p>
                    <p>
                        Articulo 7.- (DEBERES DE LAS Y LOS COMERCIANTES MINORISTAS ASENTADOS).- Son deberes de las y los comerciantes minoristas:
                        <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Cuidar, preservar las obras públicas construidas en las vías y espacios de dominio público de la ciudad de El Alto.
                        <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Contribuir de manera obligatoria al aseo de las vías y espacios de su uso provisional y que son de dominio publico en coordinación con la Empresa Municipal de Aseo El Alto y las demás instancias pertenecientes al Gobierno Autónomo Municipal de El Alto.
                        <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Cumplir oportunamente con el pago de patente anual correspondiente por el uso de espacios públicos en la Dirección de Recaudaciones y/o las entidades bancarias autorizadas por el Gobierno Autónomo Municipal de El Alto según reglamento especifico.
                    </p>
                    <p>
                        Articulo 8.- (PROHIBICIONES).- Quedan prohibidas:

                        <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Toda autorizaci6n de nuevos asentamientos y ampliaciones individuales y/o colectivos de comerciantes minoristas en la Ceja de El Alto; Avenidas: Juan Pablo II, Antofagasta, Tiahuanaco, Panorámica, 6 de Marzo, Bolivia, Avenida Satélite, Del Policía, Alfonso Ugarte, 16 de Julio, Periférica, Carretera a Viacha, Plazas Públicas y Puentes de la Ciudad de El Alto.
                        <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Se prohíbe la ampliación de todos los asentamientos legalmente constituidos hasta la fecha de publicaci6n de la presente ley, en toda la jurisdicci6n municipal de El Alto.
                        <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Se prohíben los asentamientos que produzcan obstrucci6n peatonal y congestionamiento vehicular de las vías publicas.
                    </p>
                    <p>
                        Articulo 9.- (NUEVOS ASENTAMIENTOS).- Los nuevos asentamientos pueden establecerse en espacios que no se encuentran señalados en el articulo anterior y que no obstaculicen la

                        circulación de peatones vehículos, extremos que serán verificados y certificados por la Unidad de Ferias y Unidad de gráfico y Vialidad. La administración municipal reglamentara los procedimientos técnicos administrativos complementarios para su correcta aplicaci6n, mismos que serán para nuevos y antiguos asentamientos.
                    </p>
                    <p>
                        Articulo 10.- (ATRIBUCIONES Y FUNCIONES DEL GOBIERNO AUTNOMO MUNICIPAL DE EL ALTO).- EI Gobierno Autónomo Municipal de EI Alto, a través de sus unidades operativas referentes a la materia tendrán las siguientes atribuciones: y

                        <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Cumplir y hacer cumplir la Constitución Política del Estado, Leyes del Estado Plurinacional, Leyes Municipales, Resoluciones Municipales y demás disposiciones legales vigentes.
                        <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Verificar, controlar y sancionar a los asentamientos establecidos en los espacios de dominio público municipal de EI Alto que no cumplan la norma en vigencia a través de sus unidades operativas.
                        <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Retirar y sancionar conforme reglamento a los infractores que obstruyan las vías y espacios de dominio publico municipal, así como también retirar los asentamientos ilegales establecidos y que no cuenten con autorización del municipio.
                        <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Mantener expedita las vías y plazas públicas, para que las mismas est~n al servicio de la ciudadanía alteña.
                    </p>
                    <p>
                        Articulo 11.- (COORDINACIN PARA EL CONTROL).- Con el objeto de tener una ciudad más ordenada, la Secretaria Municipal de Desarrollo Económico coordinar~ de manera principal con la Secretaria Municipal de Seguridad Ciudadana y la Secretaria Municipal Movilidad Urbana Sostenible en lo que se refiere a la Intendencia Municipal, la Guardia Municipal, Unidad de Ferias y Unidad de Tráfico y Vialidad y de manera accesoria y según los requerimientos coordinara con las demás unidades del Ejecutivo Municipal para ejercer mayor control de los asentamientos ilegales.
                    </p>
                    <p>
                        Articulo 12.- (PAGO DE PATENTE MUNICIPAL).- La Patente Municipal que se paga será al Gobierno Autónomo Municipal de El Alto de manera directa.
                    </p>
                    <p>
                        Articulo 13.- (HECHO GENERADOR DE LA PATENTE MUNICIPAL).- La Patente Municipal es un tributo cuyo hecho generador es el uso o aprovechamiento de bienes de dominio publico para la realizaci6n de la actividad gremial.
                    </p>
                    <p>
                        Articulo 14.- (ARANCEL DEL PAGO DE PATENTE) Para el arancel del pago de patentes por el uso o aprovechamiento de espacios de dominio publico municipal y la zonificación gremial se proceder~ conforme a la tabla establecida por zonas:

                        <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Zona "A" Bs. 20.
                        <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Zona "B" Bs. 13.
                        <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Zona "C" Bs. 6.

                        La modificación de la presente zonificación estará sujeta a reglamentaci6n en coordinaci6n entre la Direcci6n de Recaudaciones y el Sector Gremial.
                    </p>
                    <p>
                        Articulo 15.- (INCUMPLIMIENTO DEL PAGO DE PATENTE MUNICIPAL).- El incumplimiento del pago oportuno de patentes municipales establecido conforme a la Constituci6n Política del Estado, el Código Tributario Boliviano y la presente Ley, dará lugar a la aplicaci6n de las sanciones establecidas por las normas tributarias vigentes.
                    </p>
                    <p>
                        Articulo 16.- (CUMPLIMIENTO).- Son encargadas de hacer cumplir las disposiciones de la presente ley los Órganos Legislativo y Ejecutivo del Gobierno Autónomo Municipal de El Alto.

                        <br><br>DISPOSICIONES TRANSITORIAS
                        <br>&nbsp;&nbsp;&nbsp;&nbsp;PRIMERA.- Los asentamientos legalmente constituidos deberán realizar la cancelación de las patentes adeudadas de gestiones anteriores en el plazo de 120 (ciento veinte) días a partir de la publicación del reglamento especifico. La Administración, Tributaria Municipal reglamentarán los procedimientos administrativos complementarios para la correcta aplicación de las patentes municipales.
                        .
                        <br>&nbsp;&nbsp;&nbsp;&nbsp;SEGUNDA.- Queda encargado del estudio de la implementación del Seguro de Salud Gremial el Órgano Ejecutivo del Gobierno Autónomo Municipal de El Alto, a través de la Secretaria correspondiente, con recursos provenientes de las recaudaciones del pago de patentes municipales del sector.

                        <br>&nbsp;&nbsp;&nbsp;&nbsp;TERCERA.- El Ejecutivo Municipal elaborar los reglamentos específicos de la presente ley municipal autonómica a en el plazo de (60) sesenta días_ calendario, computables a partir de la publicación de la presente Ley.

                        <br>&nbsp;&nbsp;&nbsp;&nbsp;CUARTA.- El cumplimiento de la presente ley, no exime de obligaciones respecto a otras disposiciones legales en vigencia.

                        <br><br>DISPOSICIONES ABROGATORIAS

                        <br>&nbsp;&nbsp;&nbsp;&nbsp;PRIMERA.- Se abrogan las siguientes normas municipales: la Ordenanza Municipal 106/2004 de 24 de junio de 200$ Ordenanza Municipal 175/2005; La Ordenanza Municipal 051/2006 de 11 abril de 2006; la Ordenanza Municipal 117/2006 de 27 de junio de 2006; la Ordenanza Municipal N° 177/2010 de 11 de noviembre de 2010 y demás ratificatorias; la Ordenanza Municipal 170/2008, la Ley Municipal N° 177 de 03 de diciembre de 2014 y todas las disposiciones contrarias a la presente ley.

                        <br>&nbsp;&nbsp;&nbsp;&nbsp;SEGUNDA.- Se abrogan de manera general todas las disposiciones de igual o inferior jerarquía contrarias a la presente Ley Auton6mica Municipal.

                        <br><br>DISPOSICIÓN ADICIONAL ÚNICA

                        <br>Se sugiere que a la brevedad posible el Órgano Ejecutivo Municipal inicie la auditoria especial correspondiente a la Unidad de Asentamientos en Vías Publicas (actual Unidad de Ferias) y Unidad de Otros ingresos del GAMEA.

                        <br>Remitas al ejecutivo Municipal para su respectiva promulgación y publicación, quedando encargado del estricto cumplimiento de lo establecido en la presente Ley Autonómica Municipal.

                        <br>Es dada en la Sala de Sesiones del Concejo Municipal de El Alto, a los veintiocho días del mes agosto de dos mil quince años.

                        <br>PROMULGACIÓN DE LA LEY MUNICIPAL N" 291

                        EN VIRTUD A SUS ANTECEDENTES Y A LA ATRIBUCIN CONFERIDA POR EL ART. 26, PUNTO TRES DE LA LEY N" 482 DE "GOBIERNOS AUTNOMOS MUNICIPALES", PROMULGO LA LEY MUNICIPAL N" 291 DEL 28 DE AGOSTO DE 2015, PARA QUE SE TENGA Y SE CUMPLA COMO LEY DEL GOBIERNO AUTNOMO MUNICIPAL DE EL ALTO, A LOS TREINTA Y UNO DÍAS DEL MES DE AGOSTO DEL AÑO DOS MIL QUINCE.
                    </p>

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