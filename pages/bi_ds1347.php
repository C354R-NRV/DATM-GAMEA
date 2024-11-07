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
    <title>DATM D.S. 1347</title>
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
    <li class="breadcrumb-item text-white active" aria-current="page">D.S. 1347</li>
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

                    <h1>Decreto Supremo N° 1347, de 10 de septiembre de 2012, </h1>

                    <input type="hidden" id="recurso_" value="ds1347">
                    <h1><span id="tituloPrincipal">Reglamento a la Ley N° 259 de Expendio y Consumo de bebidas alcohólicas</span></h1>
                    <br>
                    <br>EVO MORALES AYMA PRESIDENTE CONSTITUCIONAL DEL ESTADO PLURINACIONAL DE BOLIVIA
                    <br>
                    <br>C O N S I D E R A N D O:
                    <br>
                    <br>Que el numeral 2 del Artículo 9 de la Constitución Política del Estado, establece que son fines y funciones esenciales del Estado garantizar el bienestar, el desarrollo, la seguridad y la protección e igual dignidad de las personas, las naciones, los pueblos y las comunidades, asimismo el Parágrafo I del Artículo 251 del Texto Constitucional, determina que la Policía Boliviana, como fuerza pública, tiene la misión específica de la defensa de la sociedad y la conservación del orden público y el cumplimiento de las leyes en todo el territorio boliviano.
                    <br>
                    <br>Que el numeral 13 del Parágrafo II del Artículo 299 de la Constitución Política del Estado, señala como una competencia concurrente por el nivel central del Estado y las entidades territoriales autónomas, la seguridad ciudadana.
                    <br>
                    <br>Que la Ley N° 259, de 11 de julio de 2012, de Control al Expendio y Consumo de Bebidas Alcohólicas, es parte integral del Sistema Nacional de Seguridad Ciudadana establecido en la Ley N° 264, de 31 de julio de 2012, como conjunto interrelacionado de políticas, planes, estrategias, procedimientos, institucionalidad y funciones en materia de seguridad ciudadana.
                    <br>
                    <br>Que la Ley N° 259, de 11 de julio de 2012, regula el expendio y consumo de bebidas alcohólicas, las acciones e instancias de prevención, protección, rehabilitación, control, restricción, prohibición y sanciones ante su incumplimiento; y establece un plazo de sesenta (60) días continuos a partir de su publicación para que mediante Decreto Supremo, el Órgano Ejecutivo emita la respectiva reglamentación.
                    <br>
                    <br>Que el Parágrafo I del Artículo 37 de la Ley N° 259, dispone que el control y las sanciones por la vulneración de las prohibiciones de publicidad, en medios de comunicación oral o audiovisual previstas en la Ley, serán establecidas por el Ministerio de Comunicación, de acuerdo a reglamentación.
                    <br>
                    <br>Que la Disposición Final Segunda de la Ley N° 259, establece que el Viceministerio de Seguridad Ciudadana del Ministerio de Gobierno, y el Viceministerio de Defensa de los Derechos del Usuario y del Consumidor del Ministerio de Justicia, coordinarán y ejecutarán el cumplimiento de la Ley y su reglamentación.
                    <br>
                    <br>CONSEJO DE MINISTROS, D E C R E T A:
                    <br>
                    <br>CAPÍTULO I DISPOSICIONES GENERALES
                    <br>
                    <br>
                    <h4>ARTÍCULO 1.-</h4> (OBJETO). El presente Decreto Supremo tiene por objeto reglamentar la Ley N° 259, de 11 de julio de 2012, de Control al Expendio y Consumo de Bebidas Alcohólicas, estableciendo mecanismos y procedimientos para su implementación.
                    <br>
                    <br>
                    <h4>ARTÍCULO 2.-</h4> (DEFINICIONES). Para efectos de reglamentación de la Ley N° 259, se establece las siguientes definiciones:
                    <br>
                    <br>a. Publicidad de bebidas alcohólicas: Es toda forma de comunicación pública que busca promover directa o indirectamente la adquisición y/o consumo de bebidas alcohólicas.
                    <br>
                    <br>b. Medio de Comunicación Oral: Es aquel que se basa en el lenguaje oral para entregar la información apoyándose de sonidos y música para realizarse.
                    <br>
                    <br>c. Medio de Comunicación Audiovisual: Es aquel que se basa en el lenguaje oral para entregar la información y se apoya de sonidos, música, imágenes y movimiento para realizarse.
                    <br>
                    <br>d. Medio de Comunicación Escrito: Es aquel que se basa en el lenguaje escrito para entregar la información y se apoya de ilustraciones, imágenes, dibujos, gráficos, etc., para realizarse.
                    <br>
                    <br>e. Establecimiento de Consumo y Expendio de Bebidas Alcohólicas: Es todo recinto autorizado para el con- sumo y expendio de bebidas alcohólicas como ser bares, cantinas, chicherías, discotecas, salones de baile, boites, barras americanas, whiskerías, clubes nocturnos, cabarets, café concerts, karaokes, restaurantes y choperías.
                    <br>
                    <br>f. Establecimiento de Comercialización de Bebidas Alcohólicas: Es todo recinto autorizado para la comercialización de bebidas alcohólicas como ser licorerías, proveedoras, supermercados, micromercados, almacenes, centros de abasto e importadoras con puntos de venta.
                    <br>
                    <br>CAPÍTULO II
                    <br>REGISTRO DE CONTRAVENCIONES AL CONSUMO DE BEBIDAS ALCOHÓLICAS
                    <br>
                    <br>
                    <h4>ARTÍCULO 3.-</h4> (REGISTRO NACIONAL DE CONTRAVENCIONES AL CONSUMO DE BEBIDAS ALCOHÓLICAS). Se crea el Registro Nacional de Contravenciones al Consumo de Bebidas Alcohólicas, a cargo de la Policía Boliviana, para las siguientes contravenciones:
                    <br>
                    <br>a. Conducción de vehículos automotores públicos o privados en estado de embriaguez;
                    <br>b. Consumo de bebidas alcohólicas al interior de vehículos automotores del transporte público y/o privado;
                    <br>c. Consumo de bebidas alcohólicas en vía pública;
                    <br>d. Consumo de bebidas alcohólicas en espacios públicos de recreación, paseo y en eventos deportivos;
                    <br>e. Consumo de bebidas alcohólicas en espectáculos públicos de concentración masiva, salvo autorización de los Gobiernos Autónomos Municipales;
                    <br>f. Consumo de bebidas alcohólicas en establecimientos de salud y del sistema educativo plurinacional, incluidos los predios universitarios, tanto públicos como privados;
                    <br>g. Consumo de bebidas alcohólicas en compañía de menores de dieciocho (18) años de edad en establecimientos de acceso público, salvo en casos de degustación y/o acompañamiento de alimentos;
                    <br>h. Tránsito peatonal en notorio estado de embriaguez en vía pública en compañía de menores de dieciocho (18) años de edad.
                    <br>
                    <br>
                    <h4>ARTÍCULO 4.-</h4> (REGISTRO). El Registro Nacional de Contravenciones al Consumo de Bebidas Alcohólicas, deberá con- tener mínimamente la siguiente información de la persona infractora:
                    <br>
                    <br>a. Nombres y apellidos paterno y materno;
                    <br>b. Número de la Cédula de Identidad;
                    <br>c. Lugar de nacimiento;
                    <br>d. Nacionalidad;
                    <br>e. Edad;
                    <br>f. Número telefónico de referencia;
                    <br>g. Descripción de la infracción o contravención;
                    <br>h. Descripción de la sanción;
                    <br>i. Resultado de la prueba de alcoholemia, si corresponde.
                    <br>
                    <br>CAPÍTULO III
                    <br>PROCEDIMIENTO PARA EL CUMPLIMIENTO DE SANCIONES A PERSONAS NATURALES
                    <br>
                    <br>
                    <h4>ARTÍCULO 5.-</h4> (TRASLADO A CENTRO POLICIAL). La Policía Boliviana cuando identifique a cualquier persona cometiendo alguna infracción señalada en el Artículo 3 del presente Decreto Supremo, procederá a su traslado al centro policial
                    <br>
                    <br>más cercano, a efectos de realizar el registro y la imposición de la sanción correspondiente, sin que ello implique arresto.
                    <br>
                    <br>
                    <h4>ARTÍCULO 6.-</h4> (REGISTRO). La Policía Boliviana procederá a registrar a la persona infractora en el Registro Nacional de Contravenciones al Consumo de Bebidas Alcohólicas, de acuerdo a lo señalado en el Artículo 4 del presente Decreto Supremo.
                    <br>
                    <br>
                    <h4>ARTÍCULO 7.-</h4> (PAPELETA DE INFRACCIÓN). De acuerdo a la contravención cometida, la Policía Boliviana hará entrega de una papeleta de infracción para el cumplimiento de la sanción, la papeleta deberá contar mínimamente con la siguiente información de la persona sancionada:
                    <br>
                    <br>a. Nombres y apellidos paterno y materno;
                    <br>
                    <br>b. Número de la Cédula de Identidad;
                    <br>
                    <br>c. Fecha y lugar;
                    <br>
                    <br>d. Descripción de la infracción;
                    <br>
                    <br>e. Descripción de la sanción, especificando la forma de su cumplimiento, con el pago de la multa en Unidad de Fomento a la Vivienda - UFVs o trabajo comunitario, si corresponde;
                    <br>
                    <br>f. Monto de la multa en UFVs u horas de trabajo;
                    <br>
                    <br>g. Especificación del número de la cuenta fiscal correspondiente.
                    <br>
                    <br>
                    <h4>ARTÍCULO 8.-</h4> (CUMPLIMIENTO DE LA SANCIÓN).
                    <br>
                    <br>I. Una vez que la persona infractora reciba la papeleta de infracción, el pago de la multa deberá efectuarlo en un plazo máximo de quince (15) días hábiles en la cuenta fiscal correspondiente.
                    <br>
                    <br>II. Para el cumplimiento del Parágrafo anterior el pago de la multa en UFVs se efectuará en su equivalente en bolivianos a la fecha de emisión de la papeleta de infracción.
                    <br>
                    <br>III. Cuando el pago se realice fuera del plazo establecido en el Parágrafo I, el pago de la multa en UFVs se efectuará en su equivalente en bolivianos a la fecha del pago.
                    <br>
                    <br>IV. La persona infractora que elija el trabajo comunitario para el cumplimiento de la sanción, tendrá un plazo máximo de quince (15) días hábiles para presentarse ante la Oficina de Conciliación Ciudadana en los Centros Policiales.
                    <br>
                    <br>V. El Ministerio de Gobierno, mediante Resolución Ministerial, establecerá los mecanismos temporales para efectivizar el cumplimiento de las sanciones a las contravenciones previstas en los incisos b), c), d), e), f), g) y h) del Artículo 3 del presente Decreto Supremo.
                    <br>
                    <br>
                    <h4>ARTÍCULO 9.-</h4> (COBRO DE MULTAS Y DESTINO DE LOS RECURSOS).
                    <br>
                    <br>I. El Ministerio de Economía y Finanzas Públicas a través del Viceministerio de Tesoro y Crédito Público aperturará específicamente una cuenta corriente fiscal recaudadora en el Banco Unión S.A., para su acreditación a la libreta correspondiente por el cobro de multas de contravenciones al consumo de bebidas alcohólicas, así como para el cobro de multas a medios de comunicación por las contravenciones establecidas en la Ley N° 259 y el presente Decreto Supremo.
                    <br>
                    <br>II. Los Gobiernos Autónomos Municipales solicitarán al Ministerio de Economía y Finanzas Públicas la apertura de cuentas corrientes fiscales recaudadoras en el Banco Unión S.A., para el cobro de multas a personas naturales o jurídicas que expendan bebidas alcohólicas en contravención a lo dispuesto en la Ley N° 259.
                    <br>
                    <br>III. Los recursos provenientes de las multas recaudadas en las cuentas corrientes fiscales recaudadoras, establecidas en los Parágrafos I y II del presente Artículo, serán destinados exclusivamente a la formulación y ejecución de políticas de prevención, control, atención y rehabilitación del consumo de bebidas alcohólicas.
                    <br>
                    <br>IV. Los recursos recaudados en la cuenta corriente fiscal señalada en el Parágrafo I del presente Artículo se distribuirán a los Ministerios de Gobierno, de Justicia, de Salud y Deportes, de Educación y de Comunicación, conforme Resolución Multi ministerial.
                    <br>
                    <br>V. El Ministerio de Economía y Finanzas Públicas, en función a la Resolución Multi ministerial, asignará los recursos provenientes de la recaudación por el cobro de multas, a las cuentas de los Ministerios correspondientes.
                    <br>
                    <br>CAPÍTULO IV TRABAJO COMUNITARIO
                    <br>
                    <br>
                    <h4>ARTÍCULO 10.-</h4> (TRABAJO COMUNITARIO). El trabajo comunitario es un servicio a favor de la colectividad, como una forma de sanción alternativa al pago de multas en UFVs en los casos que corresponda.
                    <br>
                    <br>
                    <h4>ARTÍCULO 11.-</h4> (HORARIOS PARA LA PRESTACIÓN DE TRABAJO COMUNITARIO).
                    <br>
                    <br>I. El trabajo comunitario se cumplirá en días y horas no laborales, bajo supervisión de la Policía Boliviana o el Gobierno Autónomo Municipal.
                    <br>
                    <br>II. El cálculo de las horas de trabajo comunitario será equivalente a cincuenta (50) UFVs por cada dos (2) horas de trabajo comunitario.
                    <br>
                    <br>III. Los Gobiernos Autónomos Municipales en coordinación con la Policía Boliviana elaborarán un cronograma en el cual se establezca el lugar, el horario, el objeto, los responsables de la supervisión y el plazo máximo para el cumplimiento del trabajo comunitario.
                    <br>
                    <br>
                    <h4>ARTÍCULO 12.-</h4> (OFICINA DE CONCILIACIÓN CIUDADANA).
                    <br>
                    <br>I. La Oficina de Conciliación Ciudadana, contará con el cronograma de trabajo comunitario establecido por los Gobiernos Autónomos Municipales en coordinación con la Policía Boliviana.
                    <br>
                    <br>II. La persona infractora que deba cumplir con el trabajo comunitario, deberá apersonarse a la Oficina de Conciliación Ciudadana del Centro Policial correspondiente, portando la papeleta de infracción a objeto de definir su plan de trabajo comunitario, en el cual se establecerá los días y las horas para el cumplimiento de la sanción.
                    <br>
                    <br>III. El plan de trabajo comunitario se constituirá en un documento de compromiso de cumplimiento obligatorio que será registrado por la Oficina de Conciliación Ciudadana.
                    <br>
                    <br>CAPÍTULO V
                    <br>PROCEDIMIENTO PARA EL CUMPLIMIENTO DE SANCIONES POR CONDUCCIÓN EN ESTADO DE EMBRIAGUEZ
                    <br>
                    <br>
                    <h4>ARTÍCULO 13.-</h4> (PRUEBA DE ALCOHOLEMIA).
                    <br>
                    <br>I. La Policía Boliviana, a través de los medios técnicos que correspondan, realizará la prueba de alcoholemia a las per- sonas que estén conduciendo vehículos automotores públicos o privados en estado de embriaguez.
                    <br>
                    <br>II. La negativa de la persona a someterse a la prueba de alcoholemia, dará lugar a la aplicación de la sanción establecida a las personas en estado de embriaguez.
                    <br>
                    <br>
                    <h4>ARTÍCULO 14.-</h4> (GRADO ALCOHÓLICO MÁXIMO PERMITIDO).
                    <br>
                    <br>I. Los diferentes mecanismos de medición para realizar la prueba de alcoholemia, tienen igual validez para efectos del presente Decreto Supremo, su aplicación será definida por la Policía Boliviana de acuerdo a las circunstancias y naturaleza de la contravención.
                    <br>
                    <br>II. Se establece como grado alcohólico máximo permitido cero punto cincuenta (0.50) grados en cada mil (1000) ml de sangre o su equivalente en mg/l en el aire espirado dependiendo el mecanismo de medición utilizado, para toda per- sona que esté conduciendo vehículos automotores públicos o privados en estado de embriaguez.
                    <br>
                    <br>
                    <h4>ARTÍCULO 15.-</h4> (PROCEDIMIENTO). La Policía Boliviana, al detectar a cualquier persona en estado de embriaguez conduciendo vehículo automotor público o privado en territorio nacional, deberá implementar los Artículos 5 y 6 del presente Decreto Supremo.
                    <br>
                    <br>
                    <h4>ARTÍCULO 16.-</h4> (INHABILITACIÓN TEMPORAL Y SUSPENSIÓN DEFINITIVA DE LICENCIA DE CONDUCIR). Las sanciones de inhabilitación temporal y suspensión definitiva de licencia de conducir, señaladas en el Artículo 34 de la Ley N° 259, se efectivizarán mediante resolución del Organismo Operativo de Tránsito y puestas en conocimiento de las instancias que correspondan.
                    <br>
                    <br>
                    <h4>ARTÍCULO 17.-</h4> (MEDIDAS CORRECTIVAS Y SOCIOEDUCATIVAS). Las medidas correctivas y socioeducativas serán de:
                    <br>
                    <br>a. Prestación de servicios a la comunidad a través de diez (10) horas de trabajo comunitario de acuerdo a lo establecido en el presente Decreto Supremo;
                    <br>
                    <br>b. Asistir a diez (10) horas de programas de tipo formativo, a cargo de la Policía Boliviana.
                    <br>
                    <br>CAPÍTULO VI
                    <br>PROCEDIMIENTO PARA EL CUMPLIMIENTO DE SANCIONES AL CONSUMO DE BEBIDAS ALCOHÓLI- CAS EN COMPAÑÍA DE MENORES DE DIECIOCHO (18) AÑOS DE EDAD
                    <br>
                    <br>
                    <h4>ARTÍCULO 18.-</h4> (PROCEDIMIENTO).
                    <br>
                    <br>I. La Policía Boliviana, al detectar a cualquier persona que incurra en las causales de los incisos g) y h) del Artículo 3 del presente Decreto Supremo deberá:
                    <br>
                    <br>a. Inmediatamente solicitar el apoyo de la Defensoría de la Niñez y Adolescencia más cercana, a objeto de conducir al menor a custodia de sus padres o tutores, siempre y cuando éstos no sean los infractores;
                    <br>
                    <br>b. En caso de que los padres o tutores del menor de dieciocho (18) años, sean los infractores, la Defensoría de la Niñez y Adolescencia deberá conducir al menor a sus instalaciones a objeto de identificar a algún familiar que se haga cargo del menor;
                    <br>
                    <br>c. La persona infractora deberá ser conducida al centro policial más cercano y cumplir con el procedimiento establecido en el Capítulo III del presente Decreto Supremo.
                    <br>
                    <br>II. La Defensoría de la Niñez y Adolescencia, podrá en el ámbito de sus competencias aplicar medidas de protección social de acuerdo a normativa vigente.
                    <br>
                    <br>
                    <h4>ARTÍCULO 19.-</h4> (UNIDADES ENCARGADAS DE PROTEGER AL MENOR DE 18 AÑOS DE EDAD). En los Municipios donde no exista Defensoría de la Niñez y Adolescencia, podrán intervenir las brigadas de protección a la familia de la Policía Boliviana.
                    <br>
                    <br>CAPÍTULO VII
                    <br>PROCEDIMIENTO PARA EL CUMPLIMIENTO DE SANCIONES POR INCUMPLIMIENTO DE LAS PROHIBICIONES PUBLICITARIAS
                    <br>
                    <br>
                    <h4>ARTÍCULO 20.-</h4> (PUBLICIDAD EN MEDIOS DE COMUNICACIÓN). La publicidad de bebidas alcohólicas en medios de comunicación deberá cumplir con los siguientes procedimientos:
                    <br>
                    <br>a. Cuando se trate de publicidad radial, al final del anunció se deberá expresar en forma clara y pausada las siguientes advertencias: "EL CONSUMO EXCESIVO DE ALCOHOL ES DAÑINO PARA LA SALUD" - "VENTA PROHIBIDA A MENORES DE 18 AÑOS DE EDAD".
                    <br>
                    <br>b. Cuando se trate de publicidad audiovisual, los últimos cinco (5) segundos de la publicidad como mínimo, deberán expresar en forma exclusiva, clara y en letras mayúsculas, legibles, en colores contrastantes al fondo y en pantalla completa la siguiente advertencia: "EL CONSUMO EXCESIVO DE ALCOHOL ES DAÑINO PARA LA SALUD" - "VENTA PROHIBIDA A MENORES DE 18 AÑOS DE EDAD".
                    <br>
                    <br>c. Cuando se trate de publicidad impresa o escrita, al final del anuncio se deberá expresar en forma clara, con letras mayúsculas, legibles, en colores contrastantes al fondo las siguientes advertencias: "EL CONSUMO EXCESIVO DE ALCOHOL ES DAÑINO PARA LA SALUD" - "VENTA PROHIBIDA A MENORES DE 18 AÑOS DE EDAD".
                    <br>
                    <br>d. La presente disposición no limita a que los medios de comunicación incorporen además otros mensajes de prevención al consumo excesivo de bebidas alcohólicas y prohibición de venta a menores de dieciocho (18) años de edad.
                    <br>
                    <br>
                    <h4>ARTÍCULO 21.-</h4> (INFRACCIONES SOBRE PUBLICIDAD). Constituyen infracciones administrativas sancionables con multa, toda publicidad que vulnere:
                    <br>
                    <br>a. Las restricciones contenidas en el Artículo 8 de la Ley N° 259;
                    <br>
                    <br>b. Que omita difundir las advertencias contenidas en el Parágrafo I del Artículo 9 de la Ley N° 259.
                    <br>
                    <br>
                    <h4>ARTÍCULO 22.-</h4> (SANCIÓN AL INCUMPLIMIENTO DE LA RESTRICCIÓN AL CONTENIDO DE LA PUBLICIDAD).
                    <br>
                    <br>I. Los medios de comunicación que difundan publicidad de bebidas alcohólicas y no cumplan con las restricciones al contenido de la publicidad establecidas en el Artículo 8 de la Ley N° 259, serán sancionadas, la primera vez con una multa de UFVs10.000.- (DIEZ MIL 00/100 UNIDADES DE FOMENTO A LA VIVIENDA). En caso de reincidencia serán sancionados con una multa de UFVs15.000.- (QUINCE MIL 00/100 UNIDADES DE FOMENTO A LA VIVIENDA).
                    <br>
                    <br>II. La restricción contenida en el numeral 4 del Artículo 8 de la Ley N° 259, no se aplicará a la publicidad de bebidas alcohólicas emitidas a través de medios de comunicación impreso.
                    <br>
                    <br>III. Los medios de comunicación oral y audiovisual podrán mencionar auspicios sin restricción de franja horaria, siempre y cuando no contengan publicidad.
                    <br>
                    <br>
                    <h4>ARTÍCULO 23.-</h4> (SANCIÓN AL INCUMPLIMIENTO DE LAS PROHIBICIONES Y ADVERTENCIAS PUBLICITARIAS POR MEDIOS DE COMUNICACIÓN). Los medios de comunicación que emitan publicidad de bebidas alcohólicas y omitan la difusión de las advertencias establecidas en el Parágrafo I del Artículo 9 de la Ley N° 259, serán sancionados la primera vez con una multa de UFVs10.000.- (DIEZ MIL 00/100 UNIDADES DE FOMENTO A LA VIVIENDA). En caso de reincidencia serán sancionados con una multa de UFVs15.000.- (QUINCE MIL 00/100 UNIDADES DE FOMENTO A LA VIVIENDA).
                    <br>
                    <br>
                    <h4>ARTÍCULO 24.-</h4> (OBLIGACIÓN DE LOS MEDIOS DE COMUNICACIÓN).
                    <br>
                    <br>I. Es obligación de todos los medios de comunicación remitir al Ministerio de Comunicación reportes del pauteo publicitario de bebidas alcohólicas en forma mensual.
                    <br>
                    <br>II. El Ministerio de Comunicación podrá requerir a los medios de comunicación grabaciones en audio, video o escrito de las emisiones de publicidad que considere pertinente.
                    <br>
                    <br>
                    <h4>ARTÍCULO 25.-</h4> (PROCESO SANCIONADOR POR INFRACCIONES ADMINISTRATIVAS).
                    <br>
                    <br>I. En el marco del Parágrafo I del Artículo 37 de la Ley N° 259, el Ministerio de Comunicación, a través del Viceministerio de Políticas Comunicacionales, de oficio, a denuncia o sobre la base de los reportes de información requeridos a los medios de comunicación, iniciará Proceso Administrativo Sancionador por presuntas infracciones administrativas que vulneren lo establecido en el Artículo 8 y en el Parágrafo I del Artículo 9 de la Ley N° 259.
                    <br>
                    <br>
                    <br>II. Conocida la presunta infracción administrativa, el Viceministerio de Políticas Comunicacionales del Ministerio de Comunicación, iniciará el procedimiento administrativo sancionador contra el medio de comunicación y le concederá un plazo de diez (10) días hábiles, computables a partir de su notificación, para que asuma defensa y presente los descargos correspondientes.
                    <br>
                    <br>
                    <h4>ARTÍCULO 26.-</h4> (EMISIÓN DE LA RESOLUCIÓN DEL PROCESO ADMINISTRATIVO SANCIONADOR).
                    <br>
                    <br>I. Vencido el plazo, con o sin respuesta del medio de comunicación, el Viceministerio de Políticas Comunicacionales del Ministerio de Comunicación, emitirá Resolución Administrativa fundamentada y motivada, en un plazo de cinco (5) días hábiles administrativos.
                    <br>
                    <br>II. Emitida la Resolución Administrativa, el Viceministerio de Políticas Comunicacionales del Ministerio de Comunicación, deberá notificar al medio de comunicación en un plazo máximo de cinco (5) días hábiles administrativos computables a partir del siguiente día hábil de su pronunciamiento.
                    <br>
                    <br>
                    <h4>ARTÍCULO 27.-</h4> (ETAPA RECURSIVA).
                    <br>
                    <br>I. Contra la Resolución Administrativa Sancionatoria, podrá presentarse el Recurso de Revocatoria ante la autoridad que emitió la misma o en su caso, el Recurso Jerárquico si éste se interpusiere ante la Máxima Autoridad Ejecutiva del Ministerio de Comunicación, en el marco del procedimiento establecido en la Ley N° 2341, de 23 de abril de 2002, de Procedimiento Administrativo y el Decreto Supremo N° 27113, de 23 de julio de 2003.
                    <br>
                    <br>II. Agotada la vía administrativa, queda expedita la vía judicial a través del Proceso Contencioso Administrativo.
                    <br>
                    <br>CAPÍTULO VIII MEDIDAS DE PREVENCIÓN
                    <br>
                    <br>
                    <h4>ARTÍCULO 28.-</h4> (MEDIDAS DE PREVENCIÓN). El Viceministerio de Seguridad Ciudadana del Ministerio de Gobierno y el Viceministerio de Defensa de los Derechos del Usuario y del Consumidor del Ministerio de Justicia, coordinarán acciones orientadas a la prevención del consumo excesivo de bebidas alcohólicas.
                    <br>
                    <br>DISPOSICIONES FINALES
                    <br>
                    <br>DISPOSICIÓN FINAL PRIMERA.- Para todo aquello no previsto expresamente en el presente reglamento, se aplicarán las dis- posiciones de la Ley N° 2341, de 23 de abril de 2002, de Procedimiento Administrativo y su Decreto Supremo Reglamentario.
                    <br>
                    <br>DISPOSICIÓN FINAL SEGUNDA.- Se incluyen a las atribuciones del Viceministerio de Políticas Comunicacionales del Ministerio de Comunicación, los incisos h) e i) en el Artículo 5 del Decreto Supremo N° 0793, de 15 de febrero de 2011, con el siguiente texto:
                    <br>
                    <br>"h) Controlar y verificar el contenido de la publicidad de bebidas alcohólicas emitidas por los medios de comunicación." "i) Conocer y resolver los Procesos Administrativos Sancionatorios que se inicien en el marco de la Ley N° 259, de 11 de julio de 2012, de Control al Expendio y Consumo de Bebidas Alcohólicas."
                    <br>
                    <br>Los señores Ministros de Estado en sus respectivos Despachos, quedan encargados de la ejecución y cumplimiento del presente Decreto Supremo.
                    <br>
                    <br>Es dado en el Palacio de Gobierno de la ciudad de La Paz, a los diez días del mes de septiembre del año dos mil doce.
                    <br>
                    <br>FDO. EVO MORALES AYMA, David Choquehuanca Céspedes, Juan Ramón Quintana Taborga, Carlos Gustavo Romero Bonifaz, Rubén Aldo Saavedra Soto, Elba Viviana Caro Hinojosa, Juan José Hernando Sosa Soruco, Ana Teresa Morales Olivera MINISTRA DE DESARROLLO PRODUCTIVO Y ECONOMÍA PLURAL E INTERINA DE ECONOMÍA Y FINANZAS PÚBLICAS, Arturo Vladimir Sánchez Escobar, Mario Virreira Iporre, Cecilia Luisa Ayllon Quinteros, Daniel Santalla Torrez, Juan Carlos Calvimontes Camargo, José Antonio Zamora Gutiérrez, Roberto Iván Aguilar Gómez, Nemesia Achacollo ,Claudia Stacy Peña Claros, Nardy Suxo Iturry, Pablo Cesar Groux Canedo, Amanda Dávila Torres.






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