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
    <title>DATM Ley 2341</title>
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
    <li class="breadcrumb-item text-white active" aria-current="page">Ley 2341</li>
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


                    <h1>LEY 2341</h1>
                    <h2>LEY DE 23 DE ABRIL DE 2002</h2>
                    JORGE QUIROGA RAMIREZ PRESIDENTE CONSTITUCIONAL DE LA REPUBLICA
                    <br>Por cuanto, el Honorable Congreso Nacional, ha sancionado la siguiente Ley:
                    <br>EL HONORABLE CONGRESO NACIONAL,
                    <br>DECRETA:
                    <input type="hidden" id="recurso_" value="l2341">
                    <h1><span id="tituloPrincipal">LEY DE PROCEDIMIENTO ADMINISTRATIVO</span></h1>
                    <br>DISPOSICIONES GENERALES
                    <br> 
                    <br>
                    <h4>ARTICULO 1.-</h4> (Objeto de la Ley).- La presente Ley tiene por objeto:
                    <br>
                    <br>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Establecer las normas que regulan la actividad administrativa y el procedimiento administrativo del sector público;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Hacer efectivo el ejercicio del derecho de petición ante la Administración Pública;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Regular la impugnación de actuaciones administrativas que afecten derechos subjetivos o intereses legítimos de los administrados; y,
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Regular procedimientos especiales.
                    <br>
                    <br>
                    <br>
                    <h4>ARTICULO 2.-</h4> (Ambito de Aplicación).
                    <br>I. La Administración Pública ajustará todas sus actuaciones a las disposiciones de la presente Ley. A los efectos de esta Ley, la Administración Pública se encuentra conformada por:
                    <br>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) El Poder Ejecutivo, que comprende la administración nacional, las administraciones departamentales, las entidades descentralizadas o desconcentradas y los Sistemas de Regulación SIRESE, SIREFI y SIRENARE; y,
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Gobiernos Municipales y Universidades Públicas.
                    <br>
                    <br>
                    <br>II. Los Gobiernos Municipales aplicarán las disposiciones contenidas en la presente Ley, en el marco de lo establecido en la Ley de Municipalidades.
                    <br>
                    <br>III. Las Universidades Públicas, aplicarán la presente Ley en el marco de la Autonomía Universitaria.
                    <br>
                    <br>IV. Las entidades que cumplan función administrativa por delegación estatal adecuarán necesariamente sus procedimientos a la presente Ley.
                    <br>
                    <br>
                    <h4>ARTICULO 3.-</h4> (Exclusiones y Salvedades).
                    <br>I. La presente Ley se aplica a todos los actos de la Administración Pública, salvo excepción contenida en ley expresa.
                    <br>
                    <br>II. No están sujetos al ámbito de aplicación de la presente Ley:
                    <br>
                    <br>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Los actos de Gobierno referidos a las facultades de libre nombramiento y remoción de autoridades;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) La Defensoría del Pueblo;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) El Ministerio Público;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Los Regímenes agrario, electoral y del sistema de control gubernamental, que se regirán por su propios procedimientos;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Los Actos de la Administración Pública, que por su naturaleza, se encuentren regulados por normas de derecho privado; y,
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) Los procedimientos internos militares y de policía que se exceptúen por ley expresa.
                    <br>
                    <br>
                    <h4>ARTICULO 4.-</h4> (Principios Generales de la Actividad Administrativa).- La actividad administrativa se regirá por los siguientes principios:
                    <br>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Principio fundamental: El desempeño de la función pública está destinado exclusivamente a servir los intereses de la colectividad;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Principio de autotutela: La Administración Pública dicta actos que tienen efectos sobre los ciudadanos y podrá ejecutar según corresponda por sí misma sus propios actos, sin perjuicio del control judicial posterior;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Principio de sometimiento pleno a la ley: La Administración Pública regirá sus actos con sometimiento pleno a la ley, asegurando a los administrados el debido proceso;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Principio de verdad material: La Administración Pública investigará la verdad material en oposición a la verdad formal que rige el procedimiento civil;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Principio de buena fe: En la relación de los particulares con la Administración Pública se presume el principio de buena fe. La confianza, la cooperación y la lealtad en la actuación de los servidores públicos y de los ciudadanos, orientarán el procedimiento administrativo;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) Principio de imparcialidad: Las autoridades administrativas actuarán en defensa del interés general, evitando todo género de discriminación o diferencia entre los administrados;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;g) Principio de legalidad y presunción de legitimidad: Las actuaciones de la Administración Pública por estar sometidas plenamente a la Ley, se presumen legítimas, salvo expresa declaración judicial en contrario;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;h) Principio de jerarquía normativa: La actividad y actuación administrativa y, particularmente las facultades reglamentarias atribuidas por esta Ley, observarán la jerarquía normativa establecida por la Constitución Política del Estado y las leyes;
                    <br>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i) Principio de control judicial: El Poder Judicial, controla la actividad de la Administración Pública conforme a la Constitución Política del Estado y las normas legales aplicables;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;j) Principio de eficacia: Todo procedimiento administrativo debe lograr su finalidad, evitando dilaciones indebidas;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;k) Principio de economía, simplicidad y celeridad: Los procedimientos administrativos se desarrollarán con economía, simplicidad y celeridad, evitando la realización de trámites, formalismos o diligencias innecesarias;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;l) Principio de informalismo: La inobservancia de exigencias formales no esenciales por parte del administrado, que puedan ser cumplidas posteriormente, podrán ser excusadas y ello no interrumpirá el procedimiento administrativo;
                    <br>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;m) Principio de publicidad: La actividad y actuación de la Administración es pública, salvo que ésta u otras leyes la limiten;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;n) Principio de impulso de oficio: La Administración Pública está obligada a impulsar el procedimiento en todos los trámites en los que medie el interés público;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;o) Principio de gratuidad: Los particulares sólo estarán obligados a realizar prestaciones personales o patrimoniales en favor de la Administración Pública, cuando la Ley o norma jurídica expresamente lo establezca; y,
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;p) Principio de proporcionalidad: La Administración Pública actuará con sometimiento a los fines establecidos en la presente Ley y utilizará los medios adecuados para su cumplimiento.
                    <br>
                    <br>TITULO PRIMERO PROCEDIMIENTO ADMINISTRATIVO
                    <br>
                    <br>CAPITULO I REGIMEN DE LOS SUJETOS
                    <br>
                    <br>SECCION PRIMERA SUJETOS PUBLICOS
                    <br>
                    <br>
                    <h4>ARTICULO 5.-</h4> (Competencia).
                    <br>I. Los órganos administrativos tendrán competencia para conocer y resolver un asunto administrativo cuando éste emane, derive o resulte expresamente de la Constitución Política del Estado, las leyes y las disposiciones reglamentarias.
                    <br>II. La competencia atribuida a un órgano administrativo es irrenunciable, inexcusable y de ejercicio obligatorio y sólo puede ser delegada, sustituida o avocada conforme a lo previsto en la presente Ley.
                    <br>
                    <br>
                    <h4>ARTICULO 6.-</h4> (Conflictos de Competencia).
                    <br>I. La autoridad administrativa, de oficio o a instancia de parte, podrá pronunciarse respecto a su competencia para conocer un asunto.
                    <br>
                    <br>II. Los conflictos por razón de competencia entre autoridades administrativas serán resueltos por la autoridad que corresponda conforme a reglamentación especial establecida para cada sistema de
                    <br>
                    <br>organización administrativa aplicable a los órganos de la Administración Pública comprendidos en el artículo 2.- de la presente Ley. Contra esta resolución no cabe recurso alguno.
                    <br>
                    <br>
                    <h4>ARTICULO 7.-</h4> (Delegación).
                    <br>I. Las autoridades administrativas podrán delegar el ejercicio de su competencia para conocer determinados asuntos administrativos, por causa justificada, mediante resolución expresa, motivada y pública. Esta delegación se efectuará únicamente dentro de la entidad pública a su cargo.
                    <br>
                    <br>II. El delegante y el delegado serán responsables solidarios por el resultado y desempeño de las funciones, deberes y atribuciones emergentes del ejercicio de la delegación, conforme a la Ley No 1178, de Administración y Control Gubernamentales de 20 de julio de 1990 y disposiciones reglamentarias.
                    <br>
                    <br>III. En ningún caso podrán ser objeto de delegación las competencias relativas a:
                    <br>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Las facultades que la Constitución Política del Estado confiere a los poderes públicos;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) La potestad reglamentaria;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) La resolución de recursos jerárquicos, en el órgano administrativo que haya dictado el acto objeto del recurso;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Las competencias que se ejercen por delegación; y,
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Las materias excluidas de delegación por la Constitución Política de Estado, o por una ley.
                    <br>
                    <br>IV. Las resoluciones administrativas dictadas por delegación indicarán expresamente esta circunstancia y se considerarán dictadas por el órgano delegante, sin perjuicio de lo dispuesto en el numeral II de este artículo.
                    <br>
                    <br>V. La delegación es libremente revocable, en cualquier tiempo, por el órgano que la haya conferido sin que ello afecte ni pueda afectar los actos dictados antes de la revocación
                    <br>
                    <br>VI. La delegación de competencia y su revocación surtirán efecto a partir de la fecha de su publicación en un órgano de prensa de circulación nacional.
                    <br>
                    <br>
                    <h4>ARTICULO 8.-</h4> (Sustitución).
                    <br>I. Los titulares de los órganos administrativos podrán ser sustituidos temporalmente en el ejercicio de sus funciones en casos de vacancia, ausencia, enfermedad, excusa o recusación. El sustituto será designado conforme a reglamentación especial para cada sistema de organización administrativa aplicable a los órganos de la Administración Pública comprendidos en el Artículo 2.- de la presente Ley.
                    <br>
                    <br>II. La sustitución no implica alteración de las competencias y cesará tan pronto como cese la causa que la hubiera motivado.
                    <br>
                    <br>
                    <h4>ARTICULO 9.-</h4> (Avocación).
                    <br>I. Las autoridades administrativas jerárquicas podrán avocar para sí la competencia de conocer asuntos que correspondan a sus órganos o autoridades administrativas dependientes. La avocación se realizará mediante resolución expresa, motivada, pública y cuando concurran circunstancias de índole técnica, económica o legal que así lo justifiquen.
                    <br>
                    <br>II. La autoridad administrativa jerárquica avocante será exclusivamente responsable por el resultado y desempeño de las funciones, deberes y atribuciones emergentes de la avocación, conforme a la Ley No 1178, de Administración y Control Gubernamentales y disposiciones reglamentarias.
                    <br>
                    <br>III. La avocación no será aplicable en las relaciones administrativas de tuición ni en los Sistemas de Regulación señalados en el Artículo 2.-, parágrafo I, inciso a) de la presente Ley.
                    <br>
                    <br>SECCION SEGUNDA EXCUSA Y RECUSACION
                    <br>
                    <br>
                    <h4>ARTICULO 10.-</h4> (Excusa y Recusación).
                    <br>I. En observancia del principio de imparcialidad, las excusas y recusaciones serán procesadas conforme a reglamentación especial para cada sistema de organización administrativa, aplicable a los órganos de la Administración Pública comprendidos en el Artículo 2.- de la presente Ley.
                    <br>
                    <br>II. Será causal de excusa y recusación para la autoridad administrativa competente en la emisión de actos administrativos:
                    <br>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) El parentesco con el interesado en línea directa o colateral hasta el segundo grado; y,
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) La relación de negocios con el interesado o participación directa en cualquier empresa que intervenga en el proceso administrativo.
                    <br>
                    <br>III. Los procedimientos de excusa y recusación no suspenderán los efectos de los actos administrativos ni los plazos para las actuaciones administrativas de mero trámite.
                    <br>
                    <br>IV. La omisión de excusa será causal de responsabilidad de acuerdo a la Ley N° 1178 de Administración y Control Gubernamental y disposiciones reglamentarias.
                    <br>
                    <br>CAPITULO II ADMINISTRADOS
                    <br>
                    <br>SECCION PRIMERA LEGITIMACION
                    <br>
                    <br>
                    <h4>ARTICULO 11.-</h4> (Acción Legítima del Administrado).
                    <br>I. Toda persona individual o colectiva, pública o privada, cuyo derecho subjetivo o interés legítimo se vea afectado por una actuación administrativa, podrá apersonarse ante la autoridad competente para hacer valer sus derechos o intereses, conforme corresponda.
                    <br>
                    <br>II. Cualquier persona podrá intervenir como denunciante, sin necesidad de acreditar interés personal y directo en relación al hecho o acto que motiva su intervención.
                    <br>
                    <br>III. El Defensor del Pueblo, podrá actuar en el procedimiento administrativo, de conformidad a la Constitución Política del Estado y la Ley.
                    <br>
                    <br>
                    <h4>ARTICULO 12.-</h4> (Terceros Interesados).- Cuando de los antecedentes de una actuación administrativa se estableciera que, además de las personas comparecidas, otras pudiesen tener un derecho subjetivo o interés legítimo que pueda verse afectado, se les notificará con las actuaciones para su participación en el proceso, sin que proceda retrotraer el procedimiento.
                    <br>
                    <br>
                    <h4>ARTICULO 13.-</h4> (Representación).
                    <br>
                    <br>I. Toda persona que formule solicitudes a la Administración Pública podrá actuar por sí o por medio de su representante o mandatario debidamente acreditado.
                    <br>
                    <br>II. El representante o mandatario, deberá exhibir poder notariado para todas las actuaciones administrativas, excepto en los casos señalados en el Artículo 59.- del Código de Procedimiento Civil, debiendo entenderse para este caso que la obligación de dar por bien hecho lo actuado, debe ocurrir antes de dictarse la resolución administrativa de carácter definitivo y con dispensa de fianza de resultas.
                    <br>
                    <br>III. La representación de las comunidades campesinas y organizaciones territoriales de base podrá acreditarse a través de la presentación de actas o instrumentos legales conforme a Ley.
                    <br>
                    <br>
                    <h4>ARTICULO 14.-</h4> (Gestores o Tramitadores).- Las actuaciones administrativas de mero trámite, podrán ser realizadas por gestores o tramitadores debidamente facultados mediante carta notariada. El Poder Ejecutivo mediante Decreto Supremo regulará los requisitos para el ejercicio de esta actividad.
                    <br>
                    <br>
                    <h4>ARTICULO 15.-</h4> (Pluralidad de Interesados).
                    <br>I. Cuando en la actuación administrativa intervengan varios interesados con derechos, intereses y fundamentos comunes, la autoridad competente, de oficio o a pedido de parte, podrá conminar a unificar su representación, otorgándoles para el efecto un plazo de cinco (5) días, bajo alternativa de designar como representante común al que figure en primer término.
                    <br>II. La unificación de representación podrá ser revocada de oficio o a pedido de parte, mediando causa justificada debidamente fundamentada.
                    <br>
                    <br>SECCION SEGUNDA DERECHOS DE LAS PERSONAS
                    <br>
                    <br>
                    <h4>ARTICULO 16.-</h4> (Derechos de las Personas).- En su relación con la Administración Pública, las personas tienen los siguientes derechos:
                    <br>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) A formular peticiones ante la Administración Pública, individual o colectivamente;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) A iniciar el procedimiento como titular de derechos subjetivos e intereses legítimos;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) A participar en un procedimiento ya iniciado cuando afecte sus derechos subjetivos e intereses legítimos;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) A conocer el estado del procedimiento en que sea parte;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) A formular alegaciones y presentar pruebas;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) A no presentar documentos que estuviesen en poder de la entidad pública actuante;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;g) A que se rectifiquen los errores que obren en registros o documentos públicos, mediante la aportación de los elementos que correspondan;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;h) A obtener una respuesta fundada y motivada a las peticiones y solicitudes que formulen;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i) A exigir que las actuaciones se realicen dentro de los términos y plazos del procedimiento;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;j) A obtener certificados y copias de los documentos que estén en poder de la Administración Pública, con las excepciones que se establezcan expresamente por ley o disposiciones reglamentarias especiales;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;k) A acceder a registros y archivos administrativos en la forma establecida por ley;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;l) A ser tratados con dignidad, respeto, igualdad y sin discriminación; y,
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;m) A exigir que la autoridad y servidores públicos actúen con responsabilidad en el ejercicio de sus funciones.
                    <br>
                    <br>
                    <h4>ARTICULO 17.-</h4> (Obligación de Resolver y Silencio Administrativo).
                    <br>I. La Administración Pública está obligada a dictar resolución expresa en todos los procedimientos, cualquiera que sea su forma de iniciación.
                    <br>
                    <br>II. El plazo máximo para dictar la resolución expresa será de seis (6) meses desde la iniciación del procedimiento, salvo plazo distinto establecido conforme a reglamentación especial para cada sistema de organización administrativa aplicable a los órganos de la Administración Pública comprendidos en el Artículo 2.- de la presente Ley.
                    <br>
                    <br>III. Transcurrido el plazo previsto sin que la Administración Pública hubiera dictado la resolución expresa, la persona podrá considerar desestimada su solicitud, por silencio administrativo negativo, pudiendo deducir el recurso administrativo que corresponda o, en su caso jurisdiccional.
                    <br>
                    <br>IV. La autoridad o servidor público que en el plazo determinado para el efecto, no dictare resolución expresa que resuelva los procedimientos regulados por la presente Ley, podrá ser objeto de la
                    <br>
                    <br>aplicación del régimen de responsabilidad por la función pública, conforme a lo previsto en la Ley N.- 1178 de Administración y Control Gubernamentales y disposiciones reglamentarias.
                    <br>
                    <br>V. El silencio de la administración será considerado como una decisión positiva, exclusivamente en aquellos trámites expresamente previstos en disposiciones reglamentarias especiales, debiendo el interesado actuar conforme se establezca en estas disposiciones.
                    <br>
                    <br>
                    <h4>ARTICULO 18.-</h4> (Acceso a Archivos y Registros y Obtención de Copias).
                    <br>I. Las personas tienen derecho a acceder a los archivos, registros públicos y a los documentos que obren en poder de la Administración Pública, así como a obtener certificados o copias legalizadas de tales documentos cualquiera que sea la forma de expresión, gráfica, sonora, en imagen u otras, o el tipo de soporte material en que figuren.
                    <br>
                    <br>II. Toda limitación o reserva de la información debe ser específica y estar regulada por disposición legal expresa o determinación de autoridad administrativa con atribución legal establecida al efecto, identificando el nivel de limitación. Se salvan las disposiciones legales que establecen privilegios de confidencialidad o secreto profesional y aquellas de orden judicial que conforme a la ley, determinen medidas sobre el acceso a la información.
                    <br>
                    <br>III. A los efectos previstos en el numeral anterior del derecho de acceso y obtención de certificados y copias no podrá ser ejercido sobre los siguientes expedientes:
                    <br>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Los que contengan información relativa a la defensa nacional, a la seguridad del Estado o al ejercicio de facultades constitucionales por parte de los poderes del Estado.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Los sujetos a reserva o los protegidos por los secretos comercial, bancario, industrial, tecnológico y financiero, establecidos en disposiciones legales.
                    <br>
                    <br>TITULO SEGUNDO ACTOS ADMINISTRATIVOS
                    <br>
                    <br>CAPITULO I TERMINOS Y PLAZOS
                    <br>
                    <br>
                    <h4>ARTICULO 19.-</h4> (Días y Horas Hábiles).- Las actuaciones administrativas se realizarán los días y horas hábiles administrativos.
                    <br>
                    <br>De oficio o a pedido de parte y siempre por motivos fundados, la autoridad administrativa competente podrá habilitar días y horas extraordinarios.
                    <br>
                    <br>
                    <h4>ARTICULO 20.-</h4> (Cómputo).
                    <br>I. El cómputo de los plazos establecidos en esta Ley será el siguiente:
                    <br>
                    <br>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Si el plazo se señala por días sólo se computarán los días hábiles administrativos
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Si el plazo se fija en meses, éstos se computarán de fecha a fecha y si en el mes de vencimiento no hubiera día equivalente al inicial del cómputo, se entenderá que el plazo acaba el último día del mes.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Si el plazo se fija en años se entenderán siempre como años calendario.
                    <br>
                    <br>II. En cualquier caso, cuando el último día del plazo sea inhábil, se entenderá siempre prorrogado al primer día hábil siguiente.
                    <br>
                    <br>
                    <h4>ARTICULO 21.-</h4> (Términos y Plazos).
                    <br>I. Los términos y plazos para la tramitación de los procedimientos administrativos se entienden como máximos y son obligatorios para las autoridades administrativas, servidores públicos y los interesados.
                    <br>
                    <br>II. Los términos y plazos comenzarán a correr a partir del día siguiente hábil a aquél en que tenga lugar la notificación o publicación del acto y concluyen al final de la última hora del día de su vencimiento.
                    <br>
                    <br>III. Las actuaciones administrativas que deban ser realizadas por personas que tengan su domicilio en un Municipio distinto al de la sede de la entidad pública que corresponda, tendrán un plazo adicional de cinco (5) días, a partir del día de cumplimiento del plazo.
                    <br>
                    <br>CAPITULO II ACTUACIONES ADMINISTRATIVAS
                    <br>
                    <br>
                    <h4>ARTICULO 22.-</h4> (Registros).- Las entidades públicas llevarán un registro general en el que se hará constar todo escrito o comunicación que se haya presentado o que se reciba en cualquier unidad administrativa. También se anotarán en el mismo registro las salidas de los escritos y comunicaciones oficiales dirigidas a otros órganos o a particulares.
                    <br>
                    <br>
                    <h4>ARTICULO 23.-</h4> (Formación de Expedientes).- Se deberá formar expediente de todas las actuaciones administrativas relativas a una misma solicitud o procedimiento. Los escritos, documentos, informes u otros que formen parte de un expediente, deberán estar debida y correlativamente foliados.
                    <br>
                    <br>
                    <h4>ARTICULO 24.-</h4> (Desglose).- El desglose de documentos deberá ser solicitado por escrito, debiendo la autoridad administrativa o el servidor público proceder al mismo en el plazo máximo de tres (3) días, dejando copia de ellos en el expediente.
                    <br>
                    <br>
                    <h4>ARTICULO 25.-</h4> (Reposición del Expediente).
                    <br>I. En caso de pérdida de un expediente o documentación integrante de éste, la autoridad administrativa correspondiente, ordenará su reposición inmediata. El interesado aportará copia de todo escrito, diligencia o documentos que cursen en su poder. Por su parte, la Administración Pública repondrá copias de los instrumentos que estén a su cargo.
                    <br>
                    <br>II. Además de la responsabilidad por la función pública que pudiera corresponderles, los servidores públicos encargados de la custodia y guarda de los expedientes, deberán correr con los gastos de la reposición.
                    <br>
                    <br>
                    <h4>ARTICULO 26.-</h4> (Medidas para mejor Proveer).- La autoridad administrativa podrá, en caso de necesidad justificada y siguiendo las disposiciones de contratación por excepción previstas en las Normas Básicas del Sistema de Administración Pública de Bienes y Servicios, contratar servicios profesionales independientes de apoyo jurídico o técnico, para fines de mejor y experto proveer.
                    <br>
                    <br>CAPITULO III
                    <br>REQUISITOS DE LOS ACTOS ADMINISTRATIVOS
                    <br>
                    <br>
                    <h4>ARTICULO 27.-</h4> (Acto Administrativo).- Se considera acto administrativo, toda declaración, disposición o decisión de la Administración Pública, de alcance general o particular, emitida en ejercicio de la potestad administrativa, normada o discrecional, cumpliendo con los requisitos y formalidades establecidos en la presente Ley, que produce efectos jurídicos sobre el administrado. Es obligatorio, exigible, ejecutable y se presume legítimo.
                    <br>
                    <br>
                    <h4>ARTICULO 28.-</h4> (Elementos Esenciales del Acto Administrativo).- Son elementos esenciales del acto administrativo los siguientes:
                    <br>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Competencia: Ser dictado por autoridad competente;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Causa: Deberá sustentarse en los hechos y antecedentes que le sirvan de causa y en el derecho aplicable;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Objeto: El objeto debe ser cierto, lícito y materialmente posible.;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Procedimiento: Antes de su emisión deben cumplirse los procedimientos esenciales y sustanciales previstos, y los que resulten aplicables del ordenamiento jurídico;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Fundamento: Deberá ser fundamentado, expresándose en forma concreta las razones que inducen a emitir el acto, consignando, además, los recaudos indicados en el inciso b) del presente artículo; y,
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) Finalidad: Deberá cumplirse con los fines previstos en el ordenamiento jurídico.
                    <br>
                    <br>
                    <br>
                    <h4>ARTICULO 29.-</h4> (Contenido de los Actos Administrativos).- Los actos administrativos se emitirán por el órgano administrativo competente y su contenido se ajustará a lo dispuesto en el ordenamiento jurídico. Los actos serán proporcionales y adecuados a los fines previstos por el ordenamiento jurídico.
                    <br>
                    <br>
                    <h4>ARTICULO 30.-</h4> (Actos Motivados).- Los actos administrativos serán motivados con referencia a hechos y fundamentos de derecho cuando:
                    <br>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Resuelvan recursos administrativos;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Dispongan la suspensión de un acto, cualquiera que sea el motivo de éste;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Se separen del criterio seguido en actuaciones precedentes o del dictamen de órganos consultivos o de control; y,
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Deban serlo en virtud de disposición legal o reglamentaria expresa.
                    <br>
                    <br>
                    <h4>ARTICULO 31.-</h4> (Correcciones de Errores).- Las entidades públicas corregirán en cualquier momento, de oficio o a instancia de los interesados, los errores materiales, de hecho o aritméticos que existan en sus actos, sin alterar sustancialmente la Resolución.
                    <br>
                    <br>CAPITULO IV
                    <br>VALIDEZ Y EFICACIA DE LOS ACTOS ADMINISTRATIVOS
                    <br>
                    <br>
                    <br>
                    <h4>ARTICULO 32.-</h4> (Validez y Eficacia).
                    <br>I. Los actos de la Administración Pública sujetos a esta Ley se presumen válidos y producen efectos desde la fecha de su notificación o publicación.
                    <br>
                    <br>II. La eficacia del acto quedará suspendida cuando así lo señale su contenido.
                    <br>
                    <br>
                    <br>
                    <h4>ARTICULO 33.-</h4> (Notificación).
                    <br>I. La Administración Pública notificará a los interesados todas las resoluciones y actos administrativos que afecten a sus derechos subjetivos o intereses legítimos.
                    <br>
                    <br>II. Las notificaciones se realizarán en el plazo, forma, domicilio y condiciones señaladas en los numerales III, IV, V y VI del presente artículo, salvo lo expresamente establecido en la reglamentación especial de los sistemas de organización administrativa aplicable a los órganos de la Administración Pública comprendidos en el Artículo 2.- de la presente Ley.
                    <br>
                    <br>III. La notificación deberá ser realizada en el plazo máximo de cinco (5) días a partir de la fecha en la que el acto haya sido dictado y deberá contener el texto íntegro del mismo. La notificación será practicada en el lugar que éstos hayan señalado expresamente como domicilio a este efecto, el mismo que deberá estar dentro de la jurisdicción municipal de la sede de funciones de la entidad pública. Caso contrario, la misma será practicada en la Secretaría General de la entidad pública.
                    <br>
                    <br>IV. Si el interesado no estuviera presente en su domicilio en el momento de entregarse la notificación, podrá hacerse cargo de ella cualquier persona que se encontrare en él, debiendo hacer constar su identidad y su relación con el interesado. Si se rechazase la notificación, se hará constar ello en el expediente, especificándose las circunstancias del intento de notificación y se tendrá por efectuado el trámite siguiéndose el procedimiento en todo caso.
                    <br>
                    <br>V. Las notificaciones se practicarán por cualquier medio que permita tener constancia:
                    <br>
                    <br>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) De la recepción por el interesado;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) De la fecha de la notificación;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) De la identidad del notificado o de quien lo represente; y,
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Del contenido del acto notificado.
                    <br>
                    <br>
                    <br>VI. Cuando los interesados en un procedimiento sean desconocidos, se ignore el domicilio de ellos o, intentada la notificación, ésta no hubiera podido ser practicada, la notificación se hará mediante edicto publicado por una vez en un órgano de prensa de amplia circulación nacional o en un medio de difusión local de la sede del órgano administrativo.
                    <br>
                    <br>VII. Las notificaciones por correo, fax y cualquier medio electrónico de comunicación, podrán constituirse en modalidad válida previa reglamentación expresa.
                    <br>
                    <br>
                    <h4>ARTICULO 34.-</h4> (Publicación).- Los actos administrativos serán objeto de publicación cuando así lo establezcan las normas de cada procedimiento especial o cuando lo aconsejen razones de interés público. La publicación se realizará por una sola vez en un órgano de prensa de amplia circulación nacional o en su defecto cuando corresponda, en un medio de difusión local de la sede del órgano administrativo.
                    <br>
                    <br>CAPITULO V NULIDAD Y ANULABILIDAD
                    <br>
                    <br>
                    <h4>ARTICULO 35.-</h4> (Nulidad del Acto).-
                    <br>I. Son nulos de pleno derecho los actos administrativos en los casos siguientes:
                    <br>
                    <br>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Los que hubiesen sido dictados por autoridad administrativa sin competencia por razón de la materia o del territorio;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Los que carezcan de objeto o el mismo sea ilícito o imposible;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Los que hubiesen sido dictados prescindiendo total y absolutamente del procedimiento legalmente establecido;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Los que sean contrarios a la Constitución Política del Estado; y,
                    <br>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Cualquier otro establecido expresamente por ley.
                    <br>
                    <br>
                    <br>II. Las nulidades podrán invocarse únicamente mediante la interposición de los recursos administrativos previstos en la presente Ley.
                    <br>
                    <br>
                    <h4>ARTICULO 36.-</h4> (Anulabilidad del Acto).
                    <br>I. Serán anulables los actos administrativos que incurran en cualquier infracción del ordenamiento jurídico distinta de las previstas en el artículo anterior.
                    <br>
                    <br>II. No obstante lo dispuesto en el numeral anterior, el defecto de forma sólo determinará la anulabilidad cuando el acto carezca de los requisitos formales indispensables para alcanzar su fin o dé lugar a la indefensión de los interesados.
                    <br>
                    <br>III. La realización de actuaciones administrativas fuera del tiempo establecido para ellas sólo dará lugar a la anulabilidad del acto cuando así lo imponga la naturaleza del término o plazo.
                    <br>
                    <br>IV. Las anulabilidades podrán invocarse únicamente mediante la interposición de los recursos administrativos previstos en la presente Ley.
                    <br>
                    <br>
                    <h4>ARTICULO 37.-</h4> (Convalidación y Saneamiento).
                    <br>I. Los actos anulables pueden ser convalidados, saneados o rectificados por la misma autoridad administrativa que dictó el acto, subsanando los vicios de que adolezca.
                    <br>
                    <br>II. La autoridad administrativa deberá observar los límites y modalidades señalados por disposición legal aplicable, debiendo salvar los derechos subjetivos o intereses legítimos que la convalidación o saneamiento pudiese generar.
                    <br>
                    <br>III. Si la infracción consistiera en la incompetencia jerárquica, la convalidación podrá realizarla el órgano competente cuando sea superior jerárquico del que dictó el acto
                    <br>
                    <br>IV. Si la infracción consistiese en la falta de alguna autorización, el acto podrá ser convalidado mediante el otorgamiento de ella por el órgano competente.
                    <br>
                    <br>
                    <h4>ARTICULO 38.-</h4> (Efectos de la Nulidad o Anulabilidad).
                    <br>
                    <br>I. La nulidad o anulabilidad de un acto administrativo, no implicará la nulidad o anulabilidad de los sucesivos en el procedimiento, siempre que sean independientes del primero.
                    <br>
                    <br>II. La nulidad o anulabilidad de una parte del acto administrativo no implicará la de las demás partes del mismo acto que sean independientes de aquélla.
                    <br>
                    <br>TITULO TERCERO PROCEDIMIENTO ADMINISTRATIVO GENERAL
                    <br>
                    <br>CAPITULO I INICIACION DEL PROCEDIMIENTO
                    <br>
                    <br>
                    <h4>ARTICULO 39.-</h4> (Clases de Iniciación).- Los procedimientos administrativos podrán iniciarse de oficio o a solicitud de persona interesada.
                    <br>
                    <br>
                    <h4>ARTICULO 40.-</h4> (Iniciación de Oficio).
                    <br>I. Los procedimientos se iniciarán de oficio cuando así lo decida el órgano competente. Esta decisión podrá adoptarse por propia iniciativa del órgano, como consecuencia de una orden superior, a petición razonada de otros órganos o motivada por denuncia de terceros.
                    <br>
                    <br>II. Antes de adoptar la decisión de iniciar el procedimiento, el órgano administrativo competente podrá abrir un período de información previa con el fin de conocer y determinar las circunstancias del caso.
                    <br>
                    <br>
                    <h4>ARTICULO 41.-</h4> (Iniciación a Solicitud de los Interesados).- Si el procedimiento se inicia a solicitud de los interesados, el escrito que ellos
                    <br>presenten hará constar lo siguiente:
                    <br>
                    <br>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) El órgano o unidad administrativa al que se dirija;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) El nombre y apellidos del interesado y, en su caso, de la persona que lo represente;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) El domicilio a efectos de notificación, el cual deberá estar en la jurisdicción del Municipio en que tenga su sede el órgano administrativo, asimismo señalar con precisión su domicilio o residencia;
                    <br>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Los hechos, motivos y solicitud en la que se concrete con toda claridad lo que se pretende;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Ofrecer toda la prueba de la que el interesado pueda favorecerse;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) El lugar y fecha; y,
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;g) La firma del solicitante o acreditación de la autenticidad de la voluntad, expresada por cualquier medio.
                    <br>
                    <br>
                    <h4>ARTICULO 42.-</h4> (Calificación del Procedimiento).- El órgano administrativo calificará y determinará el procedimiento que corresponda a la naturaleza de la cuestión planteada, si las partes incurrieran en error en su aplicación o designación.
                    <br>
                    <br>
                    <h4>ARTICULO 43.-</h4> (Subsanación de Defectos).- Si la solicitud de iniciación del procedimiento no reúne los requisitos legales esenciales, la Administración Pública requerirá al interesado para que en un plazo no superior a cinco (5) días subsane la deficiencia o acompañe los documentos necesarios, con indicación de que, si así no lo hiciera, se dictará resolución teniendo por desistida su solicitud.
                    <br>
                    <br>
                    <h4>ARTICULO 44.-</h4> (Acumulación).
                    <br>I. El órgano administrativo que inicie o tramite un procedimiento, cualquiera que haya sido la forma de su iniciación, podrá disponer de oficio o a instancia de parte su acumulación a otro u otros procedimientos cuando éstos tengan idéntico interés y objeto.
                    <br>
                    <br>II. Cuando los procedimientos se estuvieran tramitando ante distintos órganos administrativos, la acumulación, de ser procedente, se efectuará ante el órgano que primero hubiera iniciado el procedimiento. Si se suscita conflicto sobre la procedencia de la acumulación, se resolverá según lo previsto para los conflictos de competencia establecidos en el Artículo 7.- de esta Ley.
                    <br>
                    <br>III. Contra el acuerdo de acumulación no procederá recurso alguno en vía administrativa, sin perjuicio de que los interesados puedan formular las alegaciones que procedan en el recurso que interpongan contra la resolución que ponga fin al procedimiento.
                    <br>
                    <br> ARTICULO 45.- (Intervención del Ministerio Público).- El Ministerio Público podrá participar y actuar en procedimientos administrativos, conforme a su ley orgánica, cuando de manera fundada, establezcan la necesidad de vigilar la legalidad de los procedimientos y la primacía
                    <br>
                    <br>de la Constitución y las leyes. No podrá invocarse la nulidad de actuación administrativa alguna, fundada en la ausencia de intervención del Ministerio Público.
                    <br>
                    <br>CAPITULO II TRAMITACION DEL PROCEDIMIENTO
                    <br>
                    <br>
                    <h4>ARTICULO 46.-</h4> (Tramitación).
                    <br>I. El procedimiento administrativo se impulsará de oficio en todas sus etapas y se tramitará de acuerdo con los principios establecidos en la presente Ley.
                    <br>
                    <br>II. En cualquier momento del procedimiento, los interesados podrán formular argumentaciones y aportar documentos u otros elementos de juicio, los cuales serán tenidos en cuenta por el órgano competente al redactar la correspondiente resolución.
                    <br>
                    <br>
                    <h4>ARTICULO 47.-</h4> (Prueba).
                    <br>I. Los hechos relevantes para la decisión de un procedimiento podrán acreditarse por cualquier medio de prueba admisible en derecho.
                    <br>
                    <br>II. El plazo y la forma de producción de la prueba será la determinada en el numeral III del presente artículo, salvo lo expresamente establecido conforme a reglamentación especial establecida para cada sistema de organización administrativa, aplicable a los órganos de la Administración Pública comprendidos en el Artículo 2.- de la presente Ley.
                    <br>
                    <br>III. La autoridad administrativa, mediante providencias expresas, determinará el procedimiento para la producción de las pruebas admitidas. El plazo de prueba será de quince (15) días. Este plazo podrá prorrogarse por motivos justificados, por una sola vez y por un plazo adicional de diez
                    <br>(10) días.
                    <br>IV. La autoridad podrá rechazar las pruebas que a su juicio sean manifiestamente improcedentes o innecesarias. Las pruebas serán valoradas de acuerdo al principio de la sana crítica.
                    <br>
                    <br>V. Los gastos de aportación y producción de las pruebas correrán por cuenta de los interesados que las soliciten.
                    <br>
                    <br>
                    <h4>ARTICULO 48.-</h4> (Informes).
                    <br>
                    <br>I. Para emitir la resolución final del procedimiento, se solicitarán aquellos informes que sean obligatorios por disposiciones legales y los que se juzguen necesarios para dictar la misma, debiendo citarse la norma que lo exija o fundamentando, en su caso, la conveniencia de ellos.
                    <br>
                    <br>II. Salvo disposición legal en contrario, los informes serán facultativos y no obligarán a la autoridad administrativa a resolver conforme a ellos.
                    <br>
                    <br>III. Si el informe debiera ser emitido por una entidad pública distinta de la que tramita el procedimiento y hubiese transcurrido el plazo sin evacuar el mismo, podrá seguirse con las actuaciones y el informe emitido fuera de plazo podrá no ser tenido en cuenta al dictarse la correspondiente resolución.
                    <br>
                    <br>
                    <h4>ARTICULO 49.-</h4> (Alegatos).- Producida la prueba o vencido el plazo para su producción, la administración decretará la clausura del periodo probatorio y si lo considera necesario por la complejidad de los hechos y las pruebas producidas, otorgará un plazo de cinco (5) días al interesado para que tome vista del expediente y alegue sobre la prueba producida.
                    <br>
                    <br>
                    <h4>ARTICULO 50.-</h4> (Audiencia Pública).
                    <br>I. El órgano al que corresponda la resolución del procedimiento podrá potestativamente convocar a audiencia pública cuando la naturaleza del procedimiento lo requiera o afecte a sectores profesionales, económicos o sociales legalmente organizados. La audiencia será obligatoria cuando la reglamentación especial establecida para cada sistema de organización administrativa aplicable a los órganos de la Administración Pública comprendidos en el Artículo 2.- de la presente Ley, así lo dispongan.
                    <br>
                    <br>II. La incomparecencia en este trámite de audiencia pública, no impedirá en ningún caso a los interesados la interposición de los recursos que sean procedentes contra la resolución definitiva del procedimiento.
                    <br>
                    <br>CAPITULO III TERMINACION DEL PROCEDIMIENTO
                    <br>
                    <br>
                    <h4>ARTICULO 51.-</h4> (Formas de Terminación).
                    <br>
                    <br>I. El procedimiento administrativo terminará por medio de una resolución dictada por el órgano administrativo competente, salvando los recursos establecidos por Ley.
                    <br>II. También pondrán fin al procedimiento administrativo, el desistimiento, la extinción del derecho, la renuncia al derecho en que se funde la solicitud y la imposibilidad material de continuarlo por causas sobrevinientes.
                    <br>
                    <br>
                    <h4>ARTICULO 52.-</h4> (Contenido de la Resolución).
                    <br>I. Los procedimientos administrativos, deberán necesariamente concluir con la emisión de una resolución administrativa que declare la aceptación o rechazo total o parcial de la pretensión del administrado, sin perjuicio de lo previsto en el parágrafo III del Artículo 17.- de la presente Ley.
                    <br>
                    <br>II. La Administración Pública no podrá dejar de resolver el asunto sometido a su conocimiento aduciendo falta, oscuridad o insuficiencia de los preceptos legales aplicables.
                    <br>
                    <br>III. La aceptación de informes o dictámenes servirá de fundamentación a la resolución cuando se incorporen al texto de ella.
                    <br>
                    <br>
                    <h4>ARTICULO 53.-</h4> (Desistimiento y Renuncia).
                    <br>I. Los interesados en cualquier momento, y en forma escrita, podrán desistir de su pretensión o renunciar a su derecho si éste es renunciable, lo que importará la conclusión del trámite y el archivo de las actuaciones.
                    <br>
                    <br>II. La autoridad administrativa dictará un acto aceptando el desistimiento o la renuncia en forma pura y simple y sin lugar a ninguna otra formalidad, salvo que afecte al interés público o de terceros legalmente apersonados.
                    <br>
                    <br>III. El desistimiento no importa la renuncia al derecho de iniciar un nuevo procedimiento conforme a la ley.
                    <br>
                    <br>CAPITULO IV EJECUCION
                    <br>
                    <br>
                    <h4>ARTICULO 54.-</h4> (Causa).- La Administración Pública no iniciará ninguna ejecución que limite los derechos de los particulares sin que previamente haya concluido el correspondiente procedimiento legal mediante resolución con el debido fundamento jurídico que le sirva de causa.
                    <br>
                    <br>
                    <h4>ARTICULO 55.-</h4> (Fuerza Ejecutiva).
                    <br>I. Las resoluciones definitivas de la Administración Pública, una vez notificadas, serán ejecutivas y la Administración Pública podrá proceder a su ejecución forzosa por medio de los órganos competentes en cada caso.
                    <br>
                    <br>II. Se exceptúan de lo dispuesto en el numeral anterior los casos en los que se suspenda la ejecución de acuerdo con el numeral II del Artículo 59.- de esta Ley, y aquellos otros en los que se necesite aprobación o autorización superior.
                    <br>
                    <br>III. La Administración Pública ejecutará por si misma sus propios actos administrativos conforme a reglamentación especial establecida para cada sistema de organización administrativa aplicable a los órganos de la Administración Pública comprendidos en el Artículo 2.- de la presente Ley.
                    <br>
                    <br>CAPITULO V
                    <br>PROCEDIMIENTO DE LOS RECURSOS ADMINISTRATIVOS
                    <br>
                    <br>SECCION PRIMERA DISPOSICIONES GENERALES
                    <br>
                    <br>
                    <h4>ARTICULO 56.-</h4> (Procedencia).
                    <br>I. Los recursos administrativos proceden contra toda clase de resolución de carácter definitivo o actos administrativos que tengan carácter equivalente, siempre que dichos actos administrativos a criterio de los interesados afecten, lesionen o pudieren causar perjuicio a sus derechos subjetivos o intereses legítimos.
                    <br>
                    <br>II. Para efectos de esta Ley, se entenderán por resoluciones definitivas o actos administrativos, que tengan carácter equivalente a aquellos actos administrativos que pongan fin a una actuación administrativa.
                    <br>
                    <br>
                    <h4>ARTICULO 57.-</h4> (Improcedencia).- No proceden recursos administrativos contra los actos de carácter preparatorio o de mero trámite, salvo que se trate de actos que determinen la imposibilidad de continuar el procedimiento o produzcan indefensión.
                    <br>
                    <br>
                    <h4>ARTICULO 58.-</h4> (Forma de Presentación).- Los recursos se presentarán de manera fundada, cumpliendo con los requisitos y formalidades, en los plazos que establece la presente Ley.
                    <br>
                    <br>
                    <h4>ARTICULO 59.-</h4> (Criterios de Suspensión).
                    <br>I. La interposición de cualquier recurso no suspenderá la ejecución del acto impugnado.
                    <br>
                    <br>
                    <br>II. No obstante lo dispuesto en el numeral anterior, el órgano administrativo competente para resolver el Recurso, podrá suspender la ejecución del acto recurrido, de oficio o a solicitud del recurrente, por razones de interés público o para evitar grave perjuicio al solicitante.
                    <br>
                    <br>
                    <h4>ARTICULO 60.-</h4> (Terceros afectados).- Si con la impugnación de una resolución se afectasen derechos subjetivos o intereses legítimos de terceras personas, individuales o colectivas, la autoridad administrativa deberá hacerles conocer la correspondiente impugnación, mediante notificación personal o por edictos a efectos de que los afectados se apersonen y presenten sus alegatos en el plazo de diez (10) días.
                    <br>
                    <br>
                    <h4>ARTICULO 61.-</h4> (Formas de la Resolución).- Los recursos administrativos previstos en la presente Ley, serán resueltos confirmando o revocando total o parcialmente la resolución impugnada, o en su caso, desestimando el recurso si éste estuviese interpuesto fuera de término, no cumpliese las formalidades señaladas expresamente en disposiciones aplicables o si no cumpliese el requisito de legitimación establecido en el Artículo 11.- de la presente Ley.
                    <br>
                    <br>
                    <h4>ARTICULO 62.-</h4> (Término de Prueba).
                    <br>I. La autoridad administrativa, de oficio o a pedido de parte, podrá determinar la apertura de un término de prueba realizando al efecto las diligencias correspondientes.
                    <br>
                    <br>II. El plazo para la prueba, en esta instancia, será de diez (10) días, salvo lo expresamente determinado conforme a reglamentación especial para cada sistema de organización administrativa aplicable a los órganos de la Administración Pública comprendidos en el Artículo 2.- de la presente Ley.
                    <br>
                    <br>III. El término de prueba procederá sólo cuando hayan nuevos hechos o documentos que no estén considerados en el expediente . A estos efectos, el escrito del recurso y los informes no tendrán carácter de documentos nuevos ni tampoco lo tendrán aquéllos que el interesado pudo adjuntar al expediente antes de dictarse la resolución recurrida.
                    <br>
                    <br>IV. Los recursos administrativos se ajustarán al procedimiento establecido en el presente Capítulo y supletoriamente a las normas de los capítulos I, II, III y IV del Título Tercero de esta Ley.
                    <br>
                    <br>
                    <h4>ARTICULO 63.-</h4> (Alcance de la Resolución).
                    <br>I. Dentro del término establecido en disposiciones reglamentarias especiales para resolver los recursos administrativos, deberá dictarse la correspondiente resolución, que expondrá en forma motivada los aspectos de hecho y de derecho en los que se fundare.
                    <br>
                    <br>II. La resolución se referirá siempre a las pretensiones formuladas por el recurrente, sin que en ningún caso pueda agravarse su situación inicial como consecuencia exclusiva de su propio recurso.
                    <br>
                    <br>SECCION SEGUNDA RECURSO DE REVOCATORIA
                    <br>
                    <br>
                    <h4>ARTICULO 64.-</h4> (Recurso de Revocatoria).- El recurso de revocatoria deberá ser interpuesto por el interesado ante la autoridad administrativa que pronunció la resolución impugnada, dentro del plazo de diez (10) días siguientes a su notificación.
                    <br>
                    <br>
                    <h4>ARTICULO 65.-</h4> (Plazo y Alcance de la Resolución).- El órgano autor de la resolución recurrida tendrá para sustanciar y resolver el recurso de revocatoria un plazo de veinte (20) días, salvo lo expresamente determinado de acuerdo a reglamentación especial establecida para cada sistema de organización administrativa aplicable a los órganos comprendidos en el Artículo 2.- de la presente Ley. Si vencido el plazo no se dictare resolución, el recurso se tendrá por denegado pudiendo el interesado interponer Recurso Jerárquico.
                    <br>
                    <br>SECCION TERCERA RECURSO JERARQUICO
                    <br>
                    <br>
                    <h4>ARTICULO 66.-</h4> (Recurso Jerárquico).
                    <br>I. Contra la resolución que resuelva el recurso de revocatoria, el interesado o afectado únicamente podrá interponer el Recurso Jerárquico.
                    <br>
                    <br>II. El Recurso Jerárquico se interpondrá ante la misma autoridad administrativa competente para resolver el recurso de revocatoria, dentro del plazo de diez (10) días siguientes a su notificación, o al día en que se venció el plazo para resolver el recurso de revocatoria.
                    <br>
                    <br>III. En el plazo de tres (3) días de haber sido interpuesto, el Recurso Jerárquico y sus antecedentes deberán ser remitidos a la autoridad competente para su conocimiento y resolución.
                    <br>
                    <br>IV. La autoridad competente para resolver los recursos jerárquicos será la máxima autoridad ejecutiva de la entidad o la establecida conforme a reglamentación especial para cada sistema de organización administrativa, aplicable a los órganos de la Administración Pública comprendidos en el artículo 2.- de la presente Ley.
                    <br>
                    <br>
                    <h4>ARTICULO 67.-</h4> (Plazo de Resolución).
                    <br>I. Para sustanciar y resolver el recurso jerárquico, la autoridad administrativa competente de la entidad pública, tendrá el plazo de noventa (90) días, salvo lo expresamente determinado conforme a reglamentación especial, establecida para cada sistema de organización administrativa aplicable a los órganos de la Administración Pública comprendidos en el Artículo 2.- de la presente Ley.
                    <br>
                    <br>II. El plazo se computará a partir de la interposición del recurso. Si vencido dicho plazo no se dicta resolución, el recurso se tendrá por aceptado y en consecuencia revocado el acto recurrido, bajo responsabilidad de la autoridad pertinente.
                    <br>
                    <br>
                    <h4>ARTICULO 68.-</h4> (Alcance de la Resolución del Recurso Jerárquico).
                    <br>I. Las resoluciones de los recursos jerárquicos deberán definir el fondo del asunto en trámite y en ningún caso podrán disponer que la autoridad inferior dicte una nueva resolución, excepto lo dispuesto en el numeral II del presente artículo.
                    <br>
                    <br>II. El alcance de las resoluciones de los recursos jerárquicos de los Sistemas de Regulación tales como SIRESE, SIREFI y SIRENARE serán establecidas por reglamento, de acuerdo a la competencia y características de cada sistema.
                    <br>
                    <br>SECCION CUARTA
                    <br>FIN DE LA VIA ADMINISTRATIVA
                    <br>
                    <br>
                    <br>
                    <h4>ARTICULO 69.-</h4> (Agotamiento de la vía Administrativa).- La vía administrativa quedará agotada en los casos siguientes:
                    <br>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Cuando se trate de resoluciones que resuelvan los recursos jerárquicos interpuestos;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Cuando se trate de actos administrativos contra los cuales no proceda ningún recurso en vía administrativa conforme a lo dispuesto en esta o en otras leyes;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Cuando se trate de resoluciones de los órganos administrativos que carezcan de superior jerárquico, salvo que una ley establezca lo contrario; y,
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Cuando se trate de resoluciones distintas de las señaladas en los literales anteriores, siempre que una ley así lo establezca.
                    <br>
                    <br>
                    <h4>ARTICULO 70.-</h4> (Proceso Contencioso Administrativo).- Resuelto el Recurso Jerárquico, el interesado podrá acudir a la impugnación judicial por la vía del proceso contencioso- administrativo, ante la Corte Suprema de Justicia.
                    <br>
                    <br>CAPITULO VI PROCEDIMIENTO SANCIONADOR
                    <br>
                    <br>SECCION PRIMERA PRINCIPIOS GENERALES
                    <br>
                    <br>
                    <h4>ARTICULO 71.-</h4> (Principios Sancionadores).- Las sanciones administrativas que las autoridades competentes deban imponer a las personas, estarán inspiradas en los principios de legalidad, tipicidad, presunción de inocencia, proporcionalidad, procedimiento punitivo e irretroactividad.
                    <br>
                    <br>
                    <h4>ARTICULO 72.-</h4> (Principio de Legalidad).- Las sanciones administrativas solamente podrán ser impuestas cuando éstas hayan sido previstas por norma expresa, conforme al procedimiento establecido en la presente Ley y disposiciones reglamentarias aplicables.
                    <br>
                    <br>
                    <h4>ARTICULO 73.-</h4> (Principio de Tipicidad).
                    <br>I. Son infracciones administrativas las acciones u omisiones expresamente definidas en las leyes y disposiciones reglamentarias.
                    <br>
                    <br>II. Sólo podrán imponerse aquellas sanciones administrativas expresamente establecidas en las leyes y disposiciones reglamentarias.
                    <br>
                    <br>III. Las sanciones administrativas, sean o no de naturaleza pecuniaria, no podrán implicar en ningún caso ni directa ni indirectamente la privación de libertad.
                    <br>
                    <br>
                    <h4>ARTICULO 74.-</h4> (Principio de Presunción de Inocencia).- En concordancia con la prescripción constitucional, se presume la inocencia de las personas mientras no se demuestre lo contrario en idóneo procedimiento administrativo.
                    <br>
                    <br>
                    <h4>ARTICULO 75.-</h4> (Principio de Proporcionalidad).- El establecimiento de sanciones pecuniarias deberá prever que la comisión de las infracciones tipificadas no resulte más beneficiosa para el infractor que el cumplimiento de las normas infringidas.
                    <br>
                    <br>
                    <h4>ARTICULO 76.-</h4> (Principio de Procedimiento Punitivo).- No se podrá imponer sanción administrativa alguna a las personas, sin la previa aplicación de procedimiento punitivo establecido en la presente Ley o en las disposiciones sectoriales aplicables.
                    <br>
                    <br>
                    <h4>ARTICULO 77.-</h4> (Principio de Irretroactividad).- Sólo serán aplicables las disposiciones sancionadoras que estuvieran vigentes en el momento de producirse los hechos que constituyan la infracción administrativa.
                    <br>
                    <br>
                    <h4>ARTICULO 78.-</h4> (Responsabilidad).
                    <br>I. Sólo podrán ser sancionados por hechos constitutivos de infracción administrativa, las personas individuales o colectivas que resulten responsables.
                    <br>
                    <br>II. Cuando el cumplimiento de las obligaciones previstas en una disposición legal corresponda a varias personas conjuntamente, todas ellas responderán en forma solidaria por las infracciones que en su caso se cometan y por las sanciones que se impongan.
                    <br>
                    <br>
                    <h4>ARTICULO 79.-</h4> (Prescripción de Infracciones y Sanciones).- Las infracciones prescribirán en el término de dos (2) años. Las sanciones impuestas se extinguirán en el término de un (1) año. La prescripción de las sanciones quedará interrumpida mediante la iniciación del procedimiento de cobro, conforme a reglamentación especial para los órganos de la Administración Pública, comprendidos en el Artículo 2.- de la presente Ley.
                    <br>
                    <br>SECCION SEGUNDA
                    <br>ETAPAS DEL PROCEDIMIENTO SANCIONADOR
                    <br>
                    <br>
                    <br>
                    <h4>ARTICULO 80.-</h4> (Normas Aplicables).
                    <br>I. El procedimiento sancionador se regirá por lo previsto en este Capítulo y por las disposiciones de los capítulos I, II. III y IV del Título Tercero de esta Ley.
                    <br>
                    <br>II. Los procedimientos administrativos sancionadores que se establezcan para cada sistema de organización administrativa aplicable a los órganos de la Administración Pública comprendidos en el Artículo 2.- de la presente Ley, deberán considerar inexcusablemente las sucesivas etapas de iniciación, tramitación y terminación previstas en este Capítulo y respecto de ellos el procedimiento sancionador contenido en esta Ley, tendrá en todo caso, carácter supletorio.
                    <br>
                    <h4>ARTICULO 81.-</h4> (Diligencias Preliminares).
                    <br>I. En forma previa al inicio de los procedimientos sancionadores, los funcionarios determinados expresamente para el efecto por la autoridad administrativa competente, organizarán y reunirán todas las actuaciones preliminares necesarias, donde se identificarán a las personas individuales o colectivas presuntamente responsables de los hechos susceptibles de iniciación del procedimiento, las normas o previsiones expresamente vulneradas y otras circunstancias relevantes para el caso.
                    <br>
                    <br>II. Cuando así esté previsto en las normas que regulen los procedimientos sancionadores particulares, se podrá proceder mediante resolución motivada a la adopción de medidas preventivas que aseguren la eficacia de la resolución final que pudiera dictarse.
                    <br>
                    <br>
                    <h4>ARTICULO 82.-</h4> (Etapa de Iniciación).- La etapa de iniciación se formalizará con la notificación a los presuntos infractores con los cargos imputados, advirtiendo a los mismos que de no presentar pruebas de descargo o alegaciones en el término previsto por esta Ley, se podrá emitir la resolución correspondiente.
                    <br>
                    <br>
                    <h4>ARTICULO 83.-</h4> (Etapa de Tramitación).
                    <br>I. Los presuntos infractores en el plazo de quince (15) días a partir de su notificación podrán presentar todas las pruebas, alegaciones, documentos e informaciones que crean convenientes a sus intereses.
                    <br>
                    <br>II. Serán aceptados todos los medios de prueba legalmente establecidos.
                    <br> 
                    <br>
                    <h4>ARTICULO 84.-</h4> (Etapa de Terminación).- Vencido el término de prueba, la autoridad administrativa correspondiente en el plazo de diez (10) días emitirá resolución que imponga o desestime la sanción administrativa. Contra la resolución de referencia procederán los recursos administrativos previstos en la presente Ley.
                    <br>
                    <br>DISPOSICIONES TRANSITORIAS Y FINALES DISPOSICIONES TRANSITORIAS
                    <br>Disposición Transitoria Primera.
                    <br>
                    <br>I. En el plazo máximo de ocho (8) meses a partir de la promulgación de la presente Ley, el Poder Ejecutivo a través de los Ministerios de Justicia y Derechos Humanos y de la Presidencia de la República, procederá al análisis y presentación de los proyectos reglamentarios para cada sistema de organización administrativa, conforme establece el Artículo 2.- de esta Ley.
                    <br>En el mismo plazo, el Poder Judicial y el Poder Legislativo deberán elaborar las normas internas respectivas.
                    <br>
                    <br>II. En tanto se dicten las disposiciones reglamentarias señaladas en el numeral I, los sistemas de regulación del SIRESE, SIREFI y SIRENARE, aplicarán los procedimientos administrativos consignados en sus disposiciones legales sectoriales correspondientes.
                    <br>
                    <br>Disposición Transitoria Segunda.- Las disposiciones reglamentarias de carácter general y los actos administrativos que hayan sido dictados con anterioridad a la entrada en vigencia de la presente Ley en las materias a las que ésta se refiere, conservarán su vigencia en todo aquello que no sea contrario a ella.
                    <br>
                    <br>Disposición Transitoria Tercera.
                    <br>I. Los procedimientos administrativos que se hallen en trámite a la entrada en vigencia de esta Ley, se regirán por las leyes y disposiciones anteriores.
                    <br>
                    <br>II. Los recursos administrativos, cualquiera que sea su denominación y régimen jurídico, que se hallen en trámite a la entrada en vigencia de esta Ley se regirán por las leyes y disposiciones anteriores en todas sus fases e instancias y contra la resolución final que se dicte en dichos recursos quedará expedita la vía contencioso - administrativa.
                    <br>
                    <br>Disposición Transitoria Cuarta.- Las disposiciones sobre el procedimiento sancionador contenidas en el Capítulo IV del Título Tercero de la presente Ley, serán aplicables a los hechos causantes que se produzcan a partir de la fecha de entrada en vigencia de la presente Ley.
                    <br>
                    <br>DISPOSICIONES FINALES
                    <br>
                    <br>Disposición Final Primera.- Se derogan todas las disposiciones de igual o inferior jerarquía contrarias a la presente Ley.
                    <br>
                    <br>Disposición Final Segunda.- La presente Ley entrará en vigencia a los doce (12) meses de su publicación.
                    <br>
                    <br>Remítase al Poder Ejecutivo para fines constitucionales.
                    <br>
                    <br>
                    <br>Es dada en la Sala de Sesiones del Honorable Congreso Nacional, a los veintidós días del mes de abril de dos mil dos años.
                    <br>
                    <br>Fdo. Enrique Toro Tejada, Luis Angel Vásquez Villamor, Wilson Lora Espada, Félix Alanoca Gonzáles, Fernando Rodríguez Calvo, Juan Huanca Colque.
                    <br>
                    <br>Por tanto, la promulgo para que se tenga y cumpla como Ley de la República.
                    <br>
                    <br>
                    <br>Palacio de Gobierno de la ciudad de La Paz, a los veintitrés días del mes de abril de dos mil dos años.
                    <br>
                    <br>FDO. JORGE QUIROGA RAMIREZ, Alberto Leytón Aviles, José Luis Lupo Flores, Oscar Guilarte Luján, Jacques Trigo Loubiere, Carlos Alberto Goitia Caballero, Carlos Kempff Bruno, Amalia Anaya Jaldín, Ramiro Cavero Uriona.
                    <br> 
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