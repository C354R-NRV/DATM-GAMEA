<!DOCTYPE html>
<?php
session_start();
require_once '../vendor/autoload.php';

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('../views');
$twig = new Environment($loader);
/* if (!$_SESSION['swlogin']) {
    echo "<script>window.location.href = 'index.php';</script>";
} */
?>
<html lang="es">

<head>
    <title>DATM Ley 2492</title>
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

    if (isset($_SESSION['swlogin']) and $_SESSION['swlogin'] == '1') {
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
    <li class="breadcrumb-item text-white active" aria-current="page">Ley 2492</li>
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


                    <h1>Código Tributario Boliviano Ley Nº 2492 de 2 de Agosto de 2003</h1>

                    <h2>GONZALO SANCHEZ DE LOZADA PRESIDENTE CONSTITUCIONAL DE LA REPUBLICA</h2>

                    Por cuanto, el Honorable Congreso Nacional, ha sancionado la siguiente Ley: EL HONORABLE CONGRESO NACIONAL, DECRETA:

                    <h3>CÓDIGO TRIBUTARIO BOLIVIANO TÍTULO I</h3>

                    <h3>NORMAS SUSTANTIVAS Y MATERIALES</h3>

                    <h3>CAPÍTULO I DISPOSICIONES PRELIMINARES</h3>

                    <h4>Sección I: ÁMBITO DE APLICACIÓN, VIGENCIA Y PLAZOS

                        <h4>Artículo 1</h4> (Ámbito de Aplicación). Las disposiciones de este Código establecen los principios, instituciones, procedimientos y las normas fundamentales que regulan el régimen jurídico del sistema tributario boliviano y son aplicables a todos los tributos de carácter nacional, departamental, municipal y universitario.

                        <h4>Artículo 2</h4> (Ámbito Espacial). Las normas tributarias tienen aplicación en el ámbito territorial sometido a la facultad normativa del órgano competente para dictarlas, salvo que en ellas se establezcan límites territoriales más restringidos.
                        Tratándose de tributos aduaneros, salvo lo dispuesto en convenios internacionales o leyes especiales, el ámbito espacial está constituido por el territorio nacional y las áreas geográficas de territorios extranjeros donde rige la potestad aduanera, en virtud a Tratados o Convenios Internacionales suscritos por el Estado.

                        <h4>Artículo 3</h4> (Vigencia). Las normas tributarias regirán a partir de su publicación oficial o desde la fecha que ellas determinen, siempre que hubiera publicación previa.
                        Las Ordenanzas Municipales de Tasas y Patentes serán publicadas juntamente con la Resolución Senatorial.

                        <h4>Artículo 4</h4> (Plazos y Términos). Los plazos relativos a las normas tributarias son perentorios y se computarán en la siguiente forma:
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Los plazos en meses se computan de fecha a fecha y si en el mes de vencimiento no hubiera día equivalente, se entiende que el plazo acaba el último día del mes. Si el plazo se fija en años, se entenderán siempre como años calendario.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Los plazos en días que determine este Código, cuando la norma aplicable no disponga expresamente lo contrario, se entenderán siempre referidos a días hábiles administrativos en tanto no excedan de diez (10) días y siendo más extensos se computarán por días corridos.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Los plazos y términos comenzarán a correr a partir del día siguiente hábil a aquel en que tenga lugar la notificación o publicación del acto y concluyen al final de la última hora del día de su vencimiento.
                        En cualquier caso, cuando el último día del plazo sea inhábil se entenderá siempre prorrogado al primer día hábil siguiente.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;4. Se entienden por momentos y días hábiles administrativos, aquellos en los que la Administración Tributaria correspondiente cumple sus funciones, por consiguiente, los plazos que vencieren en día inhábil para la Administración Tributaria, se entenderán prorrogados hasta el día hábil siguiente. En el cómputo de plazos y términos previstos en este Código, no surte efecto el término de la distancia.

                        <h3>Sección II: FUENTES DEL DERECHO TRIBUTARIO</h3>

                        <h4>Artículo 5</h4> (Fuente, Prelación Normativa y Derecho Supletorio).
                        <br> I. Con carácter limitativo, son fuente del Derecho Tributario con la siguiente prelación normativa:
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;1. La Constitución Política del Estado.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Los Convenios y Tratados Internacionales aprobados por el Poder Legislativo.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;3. El presente Código Tributario.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;4. Las Leyes
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;5. Los Decretos Supremos.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;6. Resoluciones Supremas.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;7. Las demás disposiciones de carácter general dictadas por los órganos administrativos facultados al efecto con las limitaciones y requisitos de formulación establecidos en este Código.
                        También constituyen fuente del Derecho Tributario las Ordenanzas Municipales de tasas y patentes, aprobadas por el Honorable Senado Nacional, en el ámbito de su jurisdicción y competencia.
                        <br> II. Tendrán carácter supletorio a este Código, cuando exista vacío en el mismo, los principios generales del Derecho Tributario y en su defecto los de otras ramas jurídicas que correspondan a la naturaleza y fines del caso particular.

                        <h4>Artículo 6</h4> (Principio de Legalidad o Reserva de Ley).
                        <br> I. Sólo la Ley puede:
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Crear, modificar y suprimir tributos, definir el hecho generador de la obligación tributaria; fijar la base imponible y alícuota o el límite máximo y mínimo de la misma; y designar al sujeto pasivo.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Excluir hechos económicos gravables del objeto de un tributo.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Otorgar y suprimir exenciones, reducciones o beneficios.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;4. Condonar total o parcialmente el pago de tributos, intereses y sanciones.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;5. Establecer los procedimientos jurisdiccionales.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;6. Tipificar los ilícitos tributarios y establecer las respectivas sanciones.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;7. Establecer privilegios y preferencias para el cobro de las obligaciones tributarias.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;8. Establecer regímenes suspensivos en materia aduanera.
                        <br> II. Las tasas o patentes municipales, se crearán, modificarán, exencionarán, condonarán y suprimirán mediante Ordenanza Municipal aprobada por el Honorable Senado Nacional.

                        <h4>Artículo 7</h4> (Gravamen Arancelario). Conforme lo dispuesto en los acuerdos y convenios internacionales ratificados constitucionalmente, el Poder Ejecutivo mediante Decreto Supremo establecerá la alícuota del Gravamen Arancelario aplicable a la importación de mercancías cuando corresponda los derechos de compensación y los derechos antidumping.

                        <h4>Artículo 8</h4> (Métodos de Interpretación y Analogía).
                        <br> I. Las normas tributarias se interpretarán con arreglo a todos los métodos admitidos en Derecho, pudiéndose llegar a resultados extensivos o restrictivos de los términos contenidos en aquellas. En exenciones tributarias serán interpretados de acuerdo al método literal.
                        <br> II. Cuando la norma relativa al hecho generador se refiera a situaciones definidas por otras ramas jurídicas, sin remitirse ni apartarse expresamente de ellas, la interpretación deberá asignar el significado que más se adapte a la realidad económica. Para determinar la verdadera naturaleza del hecho generador o imponible, se tomará en cuenta:
                        &nbsp;&nbsp;&nbsp;&nbsp;a)Cuando el sujeto pasivo adopte formas jurídicas manifiestamente inapropiadas o atípicas a la realidad económica de los hechos gravados, actos o relaciones económicas subyacentes en tales formas, la norma tributaria se aplicará prescindiendo de esas formas, sin perjuicio de la eficacia jurídica que las mismas tengan en el ámbito civil u otro.
                        &nbsp;&nbsp;&nbsp;&nbsp;b)En los actos o negocios en los que se produzca simulación, el hecho generador gravado será el efectivamente realizado por las partes con independencia de las formas o denominaciones jurídicas utilizadas por los interesados. El negocio simulado será irrelevante a efectos tributarios.
                        <br> III. La analogía será admitida para llenar los vacíos legales, pero en virtud de ella no se podrán crear tributos, establecer exclusiones ni exenciones, tipificar delitos y definir contravenciones, aplicar sanciones, ni modificar normas existentes.

                        <h3>CAPITULO II LOS TRIBUTOS</h3>

                        <h4>Artículo 9</h4> (Concepto y Clasificación).
                        <br> I. Son tributos las obligaciones en dinero que el Estado, en ejercicio de su poder de imperio, impone con el objeto de obtener recursos para el cumplimiento de sus fines.
                        <br> II. Los tributos se clasifican en: impuestos, tasas, contribuciones especiales; y
                        <br> III. Las Patentes Municipales establecidas conforme a lo previsto por la Constitución Política del Estado, cuyo hecho generador es el uso o aprovechamiento de bienes de dominio público, así como la obtención de autorizaciones para la realización de actividades económicas.

                        <h4>Artículo 10</h4> (Impuesto). Impuesto es el tributo cuya obligación tiene como hecho generador una situación prevista por Ley, independiente de toda actividad estatal relativa al contribuyente.

                        <h4>Artículo 11</h4> (Tasa).
                        <br> I. Las tasas son tributos cuyo hecho imponible consiste en la prestación de servicios o la realización de actividades sujetas a normas de Derecho Público individualizadas en el sujeto pasivo, cuando concurran las dos (2) siguientes circunstancias:
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Que dichos servicios y actividades sean de solicitud o recepción obligatoria por los administrados.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Que para los mismos, esté establecida su reserva a favor del sector público por referirse a la manifestación del ejercicio de autoridad.
                        <br> II. No es tasa el pago que se recibe por un servicio de origen contractual o la contraprestación recibida del usuario en pago de servicios no inherentes al Estado.
                        <br> III. La recaudación por el cobro de tasas no debe tener un destino ajeno al servicio o actividad que constituye la causa de la obligación.

                        <h4>Artículo 12</h4> (Contribuciones Especiales). Las contribuciones especiales son los tributos cuya obligación tiene como hecho generador, beneficios derivados de la realización de determinadas obras o actividades estatales y cuyo producto no debe tener un destino ajeno a la financiación de dichas obras o actividades que constituyen el presupuesto de la obligación. El tratamiento de las contribuciones especiales emergentes de los aportes a los servicios de seguridad social se sujetará a disposiciones especiales, teniendo el presente Código carácter supletorio.

                        <h3>CAPITULO III RELACIÓN JURIDICA TRIBUTARIA</h3>

                        <h3>Sección I: OBLIGACIÓN TRIBUTARIA</h3>

                        <h4>Artículo 13</h4> (Concepto). La obligación tributaria constituye un vínculo de carácter personal, aunque su cumplimiento se asegure mediante garantía real o con privilegios especiales.
                        En materia aduanera la obligación tributaria y la obligación de pago se regirán por Ley especial.

                        <h4>Artículo 14</h4> (Inoponibilidad).
                        <br> I. Los convenios y contratos celebrados entre particulares sobre materia tributaria en ningún caso serán oponibles al fisco, sin perjuicio de su eficacia o validez en el ámbito civil, comercial u otras ramas del derecho.

                        <br> II. Las estipulaciones entre sujetos de derecho privado y el Estado, contrarias a las leyes tributarias, son nulas de pleno derecho.

                        <h4>Artículo 15</h4> (Válidez de los Actos). La obligación tributaria no será afectada por ninguna circunstancia relativa a la validez o nulidad de llos actos, la naturaleza del contrato celebrado, la causa, el objeto perseguido por las partes, ni por los efectos que los hechos o actos gravados tengan en otras ramas jurídicas.

                        <h3>Sección II: HECHO GENERADOR</h3>

                        <h4>Artículo 16</h4> (Definición). Hecho generador o imponible es el presupuesto de naturaleza jurídica o económica expresamente establecido por Ley para configurar cada tributo, cuyo acaecimiento origina el nacimiento de la obligación tributaria.
                        <h4>Artículo 17</h4> (Perfeccionamiento). Se considera ocurrido el hecho generador y existentes sus resultados:
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;1. En las situaciones de hecho, desde el momento en que se hayan completado o realizado las circunstancias materiales previstas por Ley.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;2. En las situaciones de derecho, desde el momento en que están definitivamente constituidas de conformidad con la norma legal aplicable.

                        <h4>Artículo 18</h4> (Condición Contractual). En los actos jurídicos sujetos a condición contractual, si las normas jurídicas tributarias especiales no disponen lo contrario, el hecho generador se considerará perfeccionado:
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;1. En el momento de su celebración, si la condición fuera resolutoria.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Al cumplirse la condición, si ésta fuera suspensiva.

                        <h4>Artículo 19</h4> (Exención, Condiciones, Requisitos y Plazo).
                        <br> I. Exención es la dispensa de la obligación tributaria materia; establecida expresamente por Ley.
                        <br> II. La Ley que establezca exenciones, deberá especificar las condiciones y requisitos exigidos para su procedencia, los tributos que comprende, si es total o parcial y en su caso, el plazo de su duración.

                        <h4>Artículo 20</h4> (Vigencia e Inafectabilidad de las Exenciones).
                        <br> I. Cuando la Ley disponga expresamente que las exenciones deben ser formalizadas ante la Administración correspondiente, las exenciones tendrán vigencia a partir de su formalización.
                        <br> II. La exención no se extiende a los tributos instituidos con posterioridad a su establecimiento.
                        <br> III. La exención, con plazo indeterminado aún cuando fuera otorgada en función de ciertas condiciones de hecho, puede ser derogada o modificada por Ley posterior.
                        <br> IV. Cuando la exención esté sujeta a plazo de duración determinado, la modificación o derogación de la Ley que la establezca no alcanzará a los sujetos que la hubieran formalizado o se hubieran acogido a la exención, quienes gozarán del beneficio hasta la extinción de su plazo.

                        <h3>Sección III: SUJETOS DE LA RELACION JURIDICA TRIBUTARIA</h3>

                        <h3>Subsección I: SUJETO ACTIVO</h3>

                        <h4>Artículo 21</h4> (Sujeto Activo). El sujeto activo de la relación jurídica tributaria es el Estado, cuyas facultades de recaudación, control, verificación, valoración, inspección previa, fiscalización, liquidación, determinación, ejecución y otras establecidas en este Código son ejercidas por la Administración Tributaria nacional, departamental y municipal dispuestas por Ley. Estas facultades constituyen actividades inherentes al Estado.
                        Las actividades mencionadas en el párrafo anterior, podrán ser otorgadas en concesión a empresas o sociedades privadas.

                        <h4>Subsección II: SUJETO PASIVO</h4>

                        <h4>Artículo 22</h4> (Sujeto Pasivo). Es sujeto pasivo el contribuyente o sustituto del mismo, quien debe cumplir las obligaciones tributarias establecidas conforme dispone este Código y las Leyes.

                        <h4>Artículo 23</h4> (Contribuyente). Contribuyente es el sujeto pasivo respecto del cual se verifica el hecho generador de la obligación tributaria. Dicha condición puede recaer:
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;1. En las personas naturales prescindiendo de su capacidad según el derecho privado.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;2. En las personas jurídicas y en los demás entes colectivos a quienes las Leyes atribuyen calidad de sujetos de derecho.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;3. En las herencias yacentes, comunidades de bienes y demás entidades carentes de personalidad jurídica que constituyen una unidad económica o un patrimonio separado, susceptible de imposición. Salvando los patrimonios autónomos emergentes de procesos de titularización y los fondos de inversión administrados por Sociedades Administradoras de Fondos de Inversión y demás fideicomisos.

                        <h4>Artículo 24</h4> (Intransmisibilidad). No perderá su condición de sujeto pasivo, quien según la norma jurídica respectiva deba cumplir con la prestación, aunque realice la traslación de la obligación tributaria a otras personas.

                        <h4>Artículo 25</h4> (Sustituto). Es sustituto la persona natural o jurídica genéricamente definida por disposición normativa tributaria, quien en lugar del contribuyente debe cumplir las obligaciones tributarias, materiales y formales, de acuerdo con las siguientes reglas:
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Son sustitutos en calidad de agentes de retención o de percepción, las personas naturales o jurídicas que en razón de sus funciones, actividad, oficio o profesión intervengan en actos u operaciones en los cuales deban efectuar la retención o percepción de tributos, asumiendo la obligación de empozar su importe al Fisco.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Son agentes de retención las personas naturales o jurídicas designadas para retener el tributo que resulte de gravar operaciones establecidas por Ley.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Son agentes de percepción las personas naturales o jurídicas designadas para obtener junto con el monto de las operaciones que originan la percepción, el tributo autorizado.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;4. Efectuada la retención o percepción, el sustituto es el único responsable ante el Fisco por el importe retenido o percibido, considerándose extinguida la deuda para el sujeto pasivo por dicho importe. De no realizar la retención o percepción, responderá solidariamente con el contribuyente, sin perjuicio del derecho de repetición contra éste.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;5. El agente de retención es responsable ante el contribuyente por las retenciones efectuadas sin normas legales o reglamentarias que las autoricen.

                        <h4>Subsección III: SOLIDARIDAD Y EFECTOS</h4>

                        <h4>Artículo 26</h4> (Deudores Solidarios).
                        <br> I. Están solidariamente obligados aquellos sujetos pasivos respecto de los cuales se verifique un mismo hecho generador, salvo que la Ley especial dispusiere lo contrario. En los demás casos la solidaridad debe ser establecida expresamente por Ley.
                        <br> II. Los efectos de la solidaridad son:
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;1. La obligación puede ser exigida totalmente a cualquiera de los deudores a elección del sujeto activo.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;2. El pago total efectuado por uno de los deudores libera a los demás, sin perjuicio de su derecho a repetir civilmente contra los demás.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;3. El cumplimiento de una obligación formal por parte de uno de los obligados libera a los demás.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;4. La exención de la obligación alcanza a todos los beneficiarios, salvo que el beneficio haya sido concedido a determinada persona. En este caso, el sujeto activo podrá exigir el cumplimiento a los demás con deducción de la parte proporcional del beneficio.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;5. Cualquier interrupción o suspensión de la prescripción, a favor o en contra de uno de los deudores, favorece o perjudica a los demás.

                        <h4>Subsección IV: TERCEROS RESPONSABLES</h4>

                        <h4>Artículo 27</h4> (Terceros Responsables). Son terceros responsables las personas que sin tener el carácter de sujeto pasivo deben, por mandato expreso del presente Código o disposiciones legales, cumplir las obligaciones atribuidas a aquél.
                        El carácter de tercero responsable se asume por la administración de patrimonio ajeno o por la sucesión de obligaciones como efecto de la transmisión gratuita u onerosa de bienes.

                        <h4>Artículo 28</h4> (Responsables por la Administración de Patrimonio Ajeno).
                        <br> I. Son responsables del cumplimiento de las obligaciones tributarias que derivan del patrimonio que administren:
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Los padres, albaceas, tutores y curadores de los incapaces.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Los directores, administradores, gerentes y representantes de las personas jurídicas y demás entes colectivos con personalidad legalmente reconocida.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Los que dirijan, administren o tengan la disponibilidad de los bienes de entes colectivos que carecen de personalidad jurídica.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;4. Los mandatarios o gestores voluntarios respecto de los bienes que administren y dispongan.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;5. Los síndicos de quiebras o concursos, los liquidadores e interventores y los representantes de las sociedades en liquidación o liquidadas, así como los administradores judiciales o particulares de las sucesiones.
                        <br> II. Esta responsabilidad alcanza también a las sanciones que deriven del incumplimiento de las obligaciones tributarias a que se refiere este Código y demás disposiciones normativas.

                        <h4>Artículo 29</h4> (Responsables por Representación). La ejecución tributaria se realizará siempre sobre el patrimonio del sujeto pasivo, cuando dicho patrimonio exista al momento de iniciarse la ejecución. En este caso, las personas a que se refiere el Artículo precedente asumirán la calidad de responsable por representación del sujeto pasivo y responderán por la deuda tributaria hasta el límite del valor del patrimonio que se está administrando.

                        <h4>Artículo 30</h4> (Responsables Subsidiarios). Cuando el patrimonio del sujeto pasivo no llegara a cubrir la deuda tributaria, el responsable por representación del sujeto pasivo pasará a la calidad de responsable subsidiario de la deuda impaga, respondiendo ilimitadamente por el saldo con su propio patrimonio, siempre y cuando se hubiera actuado con dolo.
                        La responsabilidad subsidiaria también alcanza a quienes administraron el patrimonio, por el total de la deuda tributaria, cuando éste fuera inexistente al momento de iniciarse la ejecución tributaria por haber cesado en sus actividades las personas jurídicas o por haber fallecido la persona natural titular del patrimonio, siempre y cuando se hubiera actuado con dolo.
                        Quienes administren patrimonio ajeno serán responsables subsidiarios por los actos ocurridos durante su gestión y serán responsables solidarios con los que les antecedieron, por las irregularidades en que éstos hubieran incurrido, si conociéndolas no realizaran los actos que fueran necesarios para remediarlas o enmendarlas a excepción de los síndicos de quiebras o concursos, los liquidadores e interventores, los representantes de las sociedades en liquidación o liquidadas, así como los administradores judiciales o particulares de las sucesiones, quiénes serán responsables subsidiarios sólo a partir de la fecha de su designación contractual o judicial.

                        <h4>Artículo 31</h4> (Solidaridad entre Responsables). Cuando sean dos o más los responsables por representación o subsidiarios de una misma deuda, su responsabilidad será solidaria y la deuda podrá exigirse integramente a cualquiera de ellos, sin perjuicio del derecho de éste a repetir en la vía civil contra los demás responsables en la proporción que les corresponda.

                        <h4>Artículo 32</h4> (Derivación de la Acción Administrativa). La derivación de la acción administrativa para exigir, a quienes resultaran responsables subsidiarios, el pago del total de la deuda tributaria, requerirá un acto administrativo previo en el que se declare agotado el patrimonio del deudor principal, se determine su responsabilidad y cuantía, bajo responsabilidad funcionaria.

                        <h4>Artículo 33</h4> (Notificación e Impugnación). El acto de derivación de la acción administrativa será notificado personalmente a quienes resulten responsables subsidiarios, indicando todos los antecedentes del acto. El notificado podrá impugnar el acto que lo designa como responsable subsidiario utilizando los recursos establecidos en el presente Código. La impugnación solamente se referirá a la designación como responsable subsidiario y no podrá afectar la cuantía de la deuda en ejecución.

                        <h4>Artículo 34</h4> (Responsables Solidarios por Sucesión a Título Particular). Son responsables solidarios con el sujeto pasivo en calidad de sucesores a título particular:
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Los donatarios y los legatarios, por los tributos devengados con anterioridad a la transmisión.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Los adquirentes de bienes mercantiles por la explotación de estos bienes y los demás sucesores en la titularidad o explotación de empresas o entes colectivos con personalidad jurídica o sin ella. La responsabilidad establecida en este artículo está limitada al valor de los bienes que se reciban, a menos que los sucesores hubieran actuado con dolo.
                        La responsabilidad prevista en el numeral 2 de este Artículo cesará a los doce (12) meses de efectuada la transferencia, si ésta fue expresa y formalmente comunicada a la autoridad tributaria con treinta (30) días de anticipación por lo menos.

                        <h4>Artículo 35</h4> (Sucesores de las Personas Naturales a Título Universal).
                        <br> I. Los derechos y obligaciones del sujeto pasivo y el tercero responsable fallecido serán ejercitados o en su caso, cumplidos por el heredero universal sin perjuicio de que éste pueda acogerse al beneficio de inventario.
                        <br> II. En ningún caso serán transmisibles las sanciones, excepto las multas ejecutoriadas antes del fallecimiento del causante que puedan ser pagadas con el patrimonio de éste.

                        <h4>Artículo 36</h4> (Transmisión de Obligaciones de las Personas Jurídicas).
                        <br> I. Ningún socio podrá recibir, a ningún título, la parte que le corresponda, mientras no queden extinguidas las obligaciones tributarias de la sociedad o entidad que se liquida o disuelve.
                        <br> II. Las obligaciones tributarias que se determinen de sociedades o entidades disueltas o liquidadas se transmitirán a los socios o partícipes en el capital, que responderán de ellas solidariamente hasta el límite del valor de la cuota de liquidación que se les hubiera adjudicado.
                        En ambos casos citados se aplicarán los beneficios establecidos para los trabajadores en la Ley General del Trabajo y los privilegios establecidos en el <h4>Artículo 49</h4>º de este Código.

                        <h4>Subsección V: DOMICILIO TRIBUTARIO</h4>

                        <h4>Artículo 37</h4> (Domicilio en el Territorio Nacional). Para efectos tributarios las personas naturales y jurídicas deben fijar su domicilio dentro del territorio nacional, preferentemente en el lugar de su actividad comercial o productiva.

                        <h4>Artículo 38</h4> (Domicilio de las Personas Naturales). Cuando la persona natural no tuviera domicilio señalado o teniéndolo señalado, éste fuera inexistente, a todos los efectos tributarios se presume que el domicilio en el país de las personas naturales es:
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;1. El lugar de su residencia habitual o su vivienda permanente.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;2. El lugar donde desarrolle su actividad principal, en caso de no conocerse la residencia o existir dificultad para determinarla.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;3. El lugar donde ocurra el hecho generador, en caso de no existir domicilio en los términos de los numerales precedentes.
                        La notificación así practicada se considerará válida a todos los efectos legales.

                        <h4>Artículo 39</h4> (Domicilio de las Personas Jurídicas). Cuando la persona jurídica no tuviera domicilio señalado o teniéndolo señalado, éste fuera inexistente, a todos los efectos tributarios se presume que el domicilio en el país de las personas jurídicas es:
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;1. El lugar donde se encuentra su dirección o administración efectiva.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;2. El lugar donde se halla su actividad principal, en caso de no conocerse dicha dirección o administración.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;3. El señalado en la escritura de constitución, de acuerdo al Código de Comercio.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;4. El lugar donde ocurra el hecho generador, en caso de no existir domicilio en los términos de los numerales precedentes.
                        Para las Asociaciones de hecho o unidades económicas sin personalidad jurídica, se aplicarán las reglas establecidas a partir del numeral 2 de éste Artículo.
                        La notificación así practicada se considerará válida a todos los efectos legales.

                        <h4>Artículo 40</h4> (Domicilio de los No Inscritos). Se tendrá por domicilio de las personas naturales y asociaciones o unidades económicas sin personalidad jurídica que no estuvieran inscritas en los registros respectivos de las Administraciones Tributarias correspondientes, el lugar donde ocurra el hecho generador.

                        <h4>Artículo 41</h4> (Domicilio Especial). El sujeto pasivo y el tercero responsable podrán fijar un domicilio especial dentro el territorio nacional a los efectos tributarios con autorización expresa de la Administración Tributaria.
                        El domicilio así constituido será el único válido a todos los efectos tributarios, en tanto la Administración Tributaria no notifique al sujeto pasivo o al tercero responsable la revocatoria fundamentada de la autorización concedida, o éstos no soliciten formalmente su cancelación.

                        <h4>Sección IV: BASE IMPONIBLE Y ALÍCUOTA</h4>

                        <h4>Artículo 42</h4> (Base Imponible). Base imponible o gravable es la unidad de medida, valor o magnitud, obtenidos de acuerdo a las normas legales respectivas, sobre la cual se aplica la alícuota para determinar el tributo a pagar.

                        <h4>Artículo 43</h4> (Métodos de Determinación de la Base Imponible). La base imponible podrá determinarse por los siguientes métodos:
                        <br> I. Sobre base cierta, tomando en cuenta los documentos e informaciones que permitan conocer en forma directa e indubitable los hechos generadores del tributo.
                        <br> II. Sobre base presunta, en mérito a los hechos y circunstancias que, por su vinculación o conexión normal con el hecho generador de la obligación, permitan deducir la existencia y cuantía de la obligación cuando concurra alguna de las circunstancias reguladas en el artículo siguiente.
                        <br> III. Cuando la Ley encomiende la determinación al sujeto activo prescindiendo parcial o totalmente del sujeto pasivo, ésta deberá practicarse sobre base cierta y sólo podrá realizarse la determinación sobre base presunta de acuerdo a lo establecido en el Artículo siguiente, según corresponda.
                        En todos estos casos la determinación podrá ser impugnada por el sujeto pasivo, aplicando los procedimientos previstos en el Título III del presente Código.

                        <h4>Artículo 44</h4> (Circunstancias para la Determinación sobre Base Presunta). La Administración Tributaria podrá determinar la base imponible usando el método sobre base presunta, sólo cuando habiéndolos requerido, no posea los datos necesarios para su determinación sobre base cierta por no haberlos proporcionado el sujeto pasivo, en especial, cuando se verifique al menos alguna de las siguientes circunstancias relativas a éste último:
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Que no se hayan inscrito en los registros tributarios correspondientes.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Que no presenten declaración o en ella se omitan datos básicos para la liquidación del tributo, conforme al procedimiento determinativo en casos especiales previsto por este Código.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Que se asuman conductas que en definitiva no permitan la iniciación o desarrollo de sus facultades de fiscalización.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;4. Que no presenten los libros y registros de contabilidad, la documentación respaldatoria o no proporcionen los informes relativos al cumplimiento de las disposiciones normativas.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;5. Que se den algunas de las siguientes circunstancias:
                        &nbsp;&nbsp;&nbsp;&nbsp;a)Omisión del registro de operaciones, ingresos o compras, así como alteración del precio y costo.
                        &nbsp;&nbsp;&nbsp;&nbsp;b)Registro de compras, gastos o servicios no realizados o no recibidos.
                        &nbsp;&nbsp;&nbsp;&nbsp;c)Omisión o alteración en el registro de existencias que deban figurar en los inventarios o registren dichas existencias a precios distintos de los de costo.
                        &nbsp;&nbsp;&nbsp;&nbsp;d)No cumplan con las obligaciones sobre valuación de inventarios o no lleven el procedimiento de control de los mismos a que obligan las normas tributarias.
                        &nbsp;&nbsp;&nbsp;&nbsp;e)Alterar la información tributaria contenida en medios magnéticos, electrónicos, ópticos o informáticos que imposibiliten la determinación sobre base cierta.
                        &nbsp;&nbsp;&nbsp;&nbsp;f)Existencia de más de un juego de libros contables, sistemas de registros manuales o informáticos, registros de cualquier tipo o contabilidades, que contengan datos y/o información de interés fiscal no coincidentes para una misma actividad comercial.
                        &nbsp;&nbsp;&nbsp;&nbsp;g)Destrucción de la documentación contable antes de que se cumpla el término de la prescripción.
                        &nbsp;&nbsp;&nbsp;&nbsp;h)La sustracción a los controles tributarios, la no utilización o utilización indebida de etiquetas, sellos, timbres, precintos y demás medios de control; la alteración de las características de mercancías, su ocultación, cambio de destino, falsa descripción o falsa indicación de procedencia.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;6. Que se adviertan situaciones que imposibiliten el conocimiento cierto de sus operaciones, o en cualquier circunstancia que no permita efectuar la determinación sobre base cierta.
                        Practicada por la Administración Tributaria la determinación sobre base presunta, subsiste la responsabilidad por las diferencias en más que pudieran corresponder derivadas de una posterior determinación sobre base cierta.

                        <h4>Artículo 45</h4> (Medios para la Determinación Sobre Base Presunta).
                        <br> I. Cuando proceda la determinación sobre base presunta, ésta se practicará utilizando cualquiera de los siguientes medios que serán precisados a través de la norma reglamentaria correspondiente:
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Aplicando datos, antecedentes y elementos indirectos que permitan deducir la existencia de los hechos imponibles en su real magnitud.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Utilizando aquellos elementos que indirectamente acrediten la existencia de bienes y rentas, así como de los ingresos, ventas, costos y rendimientos que sean normales en el respectivo sector económico, considerando las características de las unidades económicas que deban compararse en términos tributarios.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Valorando signos, índices, o módulos que se den en los respectivos contribuyentes según los datos o antecedentes que se posean en supuestos similares o equivalentes.
                        <br> II. En materia aduanera se aplicará lo establecido en la Ley Especial.

                        <h4>Artículo 46</h4> (Alícuota). Es el valor fijo o porcentual establecido por Ley, que debe aplicarse a la base imponible para determinar el tributo a pagar.

                        <h4>Sección V: LA DEUDA TRIBUTARIA</h4>

                        <h4>Artículo 47</h4> (Componentes de la Deuda Tributaria). Deuda Tributaria (DT) es el monto total que debe pagar el sujeto pasivo después de vencido el plazo para el cumplimiento de la obligación tributaria, ésta constituida por el Tributo Omitido (TO), las Multas (M) cuando correspondan, expresadas en Unidades de Fomento de la Vivienda (UFV´s) y los intereses (r), de acuerdo a lo siguiente:
                        DT = TO x (1 + r/360)n +M
                        El Tributo Omitido (TO) expresado en Unidades de Fomento a la Vivienda (UFV´s) es el resultado de dividir el tributo omitido en moneda nacional entre la Unidad de Fomento de la Vivienda (UFV) del día de vencimiento de la obligación tributaria. La Unidad de Fomento de la Vivienda (UFV) utilizada para el cálculo será la publicada oficialmente por el Banco Central de Bolivia.
                        En la relación anterior (r) constituye la tasa anual de interés activa promedio para operaciones en Unidades de Fomento de la Vivienda (UFV) publicada por el Banco Central de Bolivia, incrementada en tres (3) puntos.
                        El número de días de mora (n), se computará desde la fecha de vencimiento hasta la fecha de pago de la obligación tributaria.
                        Los pagos parciales una vez transformados a Unidades de Fomento de la Vivienda (UFV), serán convertidos a Valor Presente a la fecha de vencimiento de la obligación tributaria, utilizando el factor de conversión para el cálculo de intereses de la relación descrita anteriormente y se deducirán del total de la Deuda Tributaria sin intereses.
                        La obligación de pagar la Deuda Tributaria (DT) por el contribuyente o responsable, surge sin la necesidad de intervención o requerimiento de la administración tributaria.
                        El momento de hacer efectivo el pago de la Deuda Tributaria total expresada en UFV's, la misma deberá ser convertida a moneda nacional, utilizando la Unidad de Fomento de la Vivienda (UFV) de la fecha de pago.
                        También se consideran como Tributo Omitido (TO), los montos indebidamente devueltos por la Administración Tributaria expresados en Unidades de Fomento de la Vivienda (UFV).

                        <h4>Sección VI: GARANTIA</h4>

                        <h4>Artículo 48</h4> (Garantía de las Obligaciones Tributarias). El patrimonio del sujeto pasivo o del subsidiario cuando corresponda, constituye garantía de las obligaciones tributarias.

                        <h4>Artículo 49</h4> (Privilegio). La deuda tributaria tiene privilegio respecto de las acreencias de terceros, con excepción de los señalados en el siguiente orden:
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Los salarios, sueldos y aguinaldos devengados de los trabajadores.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Los beneficios sociales de los trabajadores y empleados, las pensiones de asistencia familiar fijadas u homologadas judicialmente y las contribuciones y aportes patronales y laborales a la Seguridad Social.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Los garantizados con derecho real o bienes muebles sujetos a registro, siempre que ellos se hubieran constituido e inscrito en el Registro de Derechos Reales o en los registros correspondientes, respectivamente, con anterioridad a la notificación con la Resolución Determinativa, en los casos que no hubiera fiscalización, con anterioridad a la ejecución tributaria.

                        <h4>Artículo 50</h4> (Exclusión). Los tributos retenidos y percibidos por el sustituto deberán ser excluidos de la masa de liquidación por tratarse de créditos extra concursales y privilegiados.

                        Sección VII: FORMAS DE EXTINCIÓN DE LA OBLIGACIÓN TRIBUTARIA Y DE LA OBLIGACIÓN DE PAGO EN ADUANAS

                        <h4>Subsección I: PAGO</h4>

                        <h4>Artículo 51</h4> (Pago Total). La obligación tributaria y la obligación de pago en aduanas, se extinguen con el pago total de la deuda tributaria.

                        <h4>Artículo 52</h4> (Subrogación de Pago). Los terceros extraños a la obligación tributaria también pueden realizar el pago, previo conocimiento del deudor, subrogándose en el derecho al crédito, garantías, preferencias y privilegios sustanciales.

                        <h4>Artículo 53</h4> (Condiciones y Requisitos).
                        <br> I. El pago debe efectuarse en el lugar, la fecha y la forma que establezcan las disposiciones normativas que se dicten al efecto.
                        <br> II. Existe pago respecto al contribuyente cuando se efectúa la retención o percepción de tributo en la fuente o en el lugar y la forma que la Administración Tributaria lo disponga.
                        <br> III. La Administración Tributaria podrá disponer fundadamente y con carácter general prórrogas de oficio para el pago de tributos. En este caso no procede la convertibilidad del tributo en Unidades de Fomento de la Vivienda, la aplicación de intereses ni de sanciones por el tiempo sujeto a prórroga.
                        <br> IV. El pago de la deuda tributaria se acreditará o probará mediante certificación de pago en los originales de las declaraciones respectivas, los documentos bancarios de pago o las certificaciones expedidas por la Administración Tributaria.

                        <h4>Artículo 54</h4> (Diversidad de Deudas).
                        <br> I. Cuando la deuda sea por varios tributos y por distintos períodos, el pago se imputará a la deuda elegida por el deudor; de no hacerse esta elección, la imputación se hará a la obligación más antigua y entre éstas a la que sea de menor monto y así, sucesivamente, a las deudas mayores.
                        <br> II. En ningún caso y bajo responsabilidad funcionaria, la Administración Tributaria podrá negarse a recibir los pagos que efectúen los contribuyentes sean éstos parciales o totales, siempre que los mismos se realicen conforme a lo dispuesto en el artículo anterior.

                        <h4>Artículo 55</h4> (Facilidades de Pago).
                        <br> I. La Administración Tributaria podrá conceder por una sola vez con carácter improrrogable facilidades para el pago de la deuda tributaria a solicitud expresa del contribuyente, en cualquier momento, inclusive estando iniciada la ejecución tributaria, en los casos y en la forma que reglamentariamente se determinen. Estas facilidades no procederán en ningún caso para retenciones y percepciones. Si las facilidades se solicitan antes del vencimiento para el pago del tributo, no habrá lugar a la aplicación de sanciones.
                        <br> II. Para la concesión de facilidades de pago deberán exigirse las garantías que la Administración Tributaria establezca mediante norma reglamentaria de carácter general, hasta cubrir el monto de la deuda tributaria. El rechazo de las garantías por parte de la Administración Tributaria deberá ser fundamentado.
                        <br> III. En caso de estar en curso la ejecución tributaria, la facilidad de pago tendrá efecto simplemente suspensivo, por cuanto el incumplimiento del pago en los términos definidos en norma reglamentaria, dará lugar automáticamente a la ejecución de las medidas que correspondan adoptarse por la Administración Tributaria según sea el caso.

                        <h4>Subsección II : COMPENSACIÓN</h4>

                        <h4>Artículo 56</h4> (Casos en los que Procede). La deuda tributaria podrá ser compensada total o parcialmente, de oficio o a petición de parte, en las condiciones que reglamentariamente se establezcan, con cualquier crédito tributario líquido y exigible del interesado, proveniente de pagos indebidos o en exceso, por los que corresponde la repetición o la devolución previstas en el presente Código.
                        La deuda tributaria a ser compensada deberá referirse a períodos no prescritos comenzando por los más antiguos y aunque provengan de distintos tributos, a condición de que sean recaudados por el mismo órgano administrativo.
                        Iniciado el trámite de compensación, éste deberá ser sustanciado y resuelto por la Administración Tributaria dentro del plazo máximo de tres (3) meses, bajo responsabilidad de los funcionarios encargados del mismo.
                        A efecto del cálculo para la compensación, no correrá ningún tipo de actualización sobre los débitos y créditos que se solicitan compensar desde el momento en que se inicie la misma.

                        <h4>Subsección III: CONFUSIÓN</h4>

                        <h4>Artículo 57</h4> (Confusión). Se producirá la extinción por confusión cuando la Administración Tributaria titular de la deuda tributaria, quedara colocada en la situación de deudor de la misma, como consecuencia de la transmisión de bienes o derechos sujetos al tributo.

                        Subsección IV: CONDONACIÓN

                        <h4>Artículo 58</h4> (Condonación). La deuda tributaria podrá condonarse parcial o totalmente, sólo en virtud de una Ley dictada con alcance general, en la cuantía y con los requisitos que en la misma se determinen.

                        <h4>Subsección V: PRESCRIPCIÓN</h4>

                        <h4>Artículo 59</h4> (Prescripción).
                        <br> I. Prescribirán a los cuatro (4) años las acciones de la Administración Tributaria para:
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Controlar, investigar, verificar, comprobar y fiscalizar tributos.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Determinar la deuda tributaria.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Imponer sanciones administrativas.
                        <br> &nbsp;&nbsp;&nbsp;&nbsp;4. Ejercer su facultad de ejecución tributaria.
                        <br> II. El término precedente se ampliará a siete (7) años cuando el sujeto pasivo o tercero responsable no cumpliera con la obligación de inscribirse en los registros pertinentes o se inscribiera en un régimen tributario que no le corresponda
                        <br> III. El término para ejecutar las sanciones por contravenciones tributarias prescribe a los dos (2) años.

                        <h4>Artículo 60</h4> (Cómputo).
                        <br> I. Excepto en el numeral 4 del parágrafo I del Artículo anterior, el término de la prescripción se computará desde el 1 de enero del año calendario siguiente a aquel en que se produjo el vencimiento del período de pago respectivo.
                        <br> II. En el supuesto 4 del parágrafo I del Artículo anterior, el término se computará desde la notificación con los títulos de ejecución tributaria.
                        <br> III. En el supuesto del parágrafo III del Artículo anterior, el término se computará desde el momento que adquiera la calidad de título de ejecución tributaria.

                        <h4>Artículo 61</h4> (Interrupción). La prescripción se interrumpe por:
                        &nbsp;&nbsp;&nbsp;&nbsp;a)La notificación al sujeto pasivo con la Resolución Determinativa.
                        &nbsp;&nbsp;&nbsp;&nbsp;b)El reconocimiento expreso o tácito de la obligación por parte del sujeto pasivo o tercero responsable, o por la solicitud de facilidades de pago.
                        Interrumpida la prescripción, comenzará a computarse nuevamente el término a partir del primer día hábil del mes siguiente a aquél en que se produjo la interrupción.

                        <h4>Artículo 62</h4> (Suspensión). El curso de la prescripción se suspende con:
                        <br> I. La notificación de inicio de fiscalización individualizada en el contribuyente. Esta suspensión se inicia en la fecha de la notificación respectiva y se extiende por seis (6) meses.
                        <br> II. La interposición de recursos administrativos o procesos judiciales por parte del contribuyente. La suspensión se inicia con la presentación de la petición o recurso y se extiende hasta la recepción formal del expediente por la Administración Tributaria para la ejecución del respectivo fallo.

                    </h4>Subsección VI: OTRAS FORMAS DE EXTINCIÓN EN MATERIA ADUANERA

                    <h4>Artículo 63</h4> (Otras Formas de Extinción en Materia Aduanera).
                    <br> I. La obligación tributaria en materia aduanera y la obligación de pago en Aduanas se extinguen por:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Desistimiento de la Declaración de Mercancías de Importación dentro los tres días de aceptada la declaración.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Abandono expreso o de hecho de las mercancías.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Destrucción total o parcial de las mercancías.
                    <br> II. El desistimiento de la declaración de mercancías deberá ser presentado a la Administración Aduanera en forma escrita, antes de efectuar el pago de los tributos aduaneros. Una vez que la Aduana Nacional admita el desistimiento la mercancía quedará desvinculada de la obligación tributaria aduanera.
                    <br> III. La destrucción total o parcial, o en su caso, la merma de las mercancías por causa de fuerza mayor o caso fortuito que hubiera sido así declarada en forma expresa por la Administración Aduanera, extingue la obligación tributaria aduanera.
                    En los casos de destrucción parcial o merma de la mercancía, la obligación tributaria se extingue sólo para la parte afectada y no retirada del depósito aduanero.

                    <h4>TÍTULO II</h4>
                    <h4>GESTIÓN Y APLICACIÓN DE LOS TRIBUTOS</h4>

                    <h4>CAPÍTULO I</h4>
                    <h4>DERECHOS Y DEBERES DE LOS SUJETOS DE LA RELACIÓN JURÍDICA TRIBUTARIA Sección I: DERECHOS Y DEBERES DE LA ADMINISTRACIÓN TRIBUTARIA</h4>
                    <h4>Artículo 64</h4> (Normas Reglamentarias Administrativas). La Administración Tributaria, conforme a este Código y leyes especiales, podrá dictar normas administrativas de carácter general a los efectos de la aplicación de las normas tributarias, las que no podrán modificar, ampliar o suprimir el alcance del tributo ni sus elementos constitutivos.

                    <h4>Artículo 65</h4> (Presunción de Legitimidad). Los actos de la Administración Tributaria por estar sometidos a la Ley se presumen legítimos y serán ejecutivos, salvo expresa declaración judicial en contrario emergente de los procesos que este Código establece.
                    No obstante lo dispuesto, la ejecución de dichos actos se suspenderá únicamente conforme lo prevé este Código en el Capítulo II del Título <br> III.

                    <h4>Artículo 66</h4> (Facultades Específicas). La Administración Tributaria tiene las siguientes facultades específicas:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Control, comprobación, verificación, fiscalización e investigación;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Determinación de tributos;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Recaudación;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;4. Cálculo de la deuda tributaria;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;5. Ejecución de medidas precautorias, previa autorización de la autoridad competente establecida en este Código;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;6. Ejecución tributaria;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;7. Concesión de prórrogas y facilidades de pago;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;8. Revisión extraordinaria de actos administrativos conforme a lo establecido en el Artículo 145 del presente Código;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;9. Sanción de contravenciones, que no constituyan delitos;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;10. Designación de sustitutos y responsables subsidiarios, en los términos dispuestos por este Código;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;11. Aplicar los montos mínimos establecidos mediante reglamento a partir de los cuales las operaciones de devolución impositiva deban ser respaldadas por los contribuyentes y/o responsables a través de documentos bancarios como cheques, tarjetas de crédito y cualquier otro medio fehaciente de pago establecido legalmente. La ausencia del respaldo hará presumir la inexistencia de la transacción;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;12. Prevenir y reprimir los ilícitos tributarios dentro del ámbito de su competencia, asimismo constituirse en el órgano técnico de investigación de delitos tributarios y promover como víctima los procesos penales tributarios;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;13. Otras facultades asignadas por las disposiciones legales especiales.
                    Sin perjuicio de lo expresado en los numerales anteriores, en materia aduanera, la Administración Tributaria tiene las siguientes facultades:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Controlar, vigilar y fiscalizar el paso de mercancías por las fronteras, puertos y aeropuertos del país, con facultades de inspección, revisión y control de mercancías, medios y unidades de transporte;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Intervenir en el tráfico internacional para la recaudación de los tributos aduaneros y otros que determinen las leyes;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Administrar los regímenes y operaciones aduaneras;

                    <h4>Artículo 67</h4> (Confidencialidad de la Información Tributaria).
                    <br> I. Las declaraciones y datos individuales obtenidos por la Administración Tributaria, tendrán carácter reservado y sólo podrán ser utilizados para la efectiva aplicación de los tributos o procedimientos cuya gestión tenga encomendada y no podrán ser informados, cedidos o comunicados a terceros salvo mediante orden judicial fundamentada, o solicitud de información de conformidad a lo establecido por el Artículo 70 de la Constitución Política del Estado.
                    <br> II. El servidor público de la Administración Tributaria que divulgue por cualquier medio hechos o documentos que conozca en razón de su cargo y que por su naturaleza o disposición de la Ley fueren reservados, será sancionado conforme a reglamento, sin perjuicio de la responsabilidad civil o penal que de dicho acto resultare.
                    <br> III. La información agregada o estadística general es pública.

                    <h4>Sección II: DERECHOS Y DEBERES DEL SUJETO PASIVO Y TERCEROS RESPONSABLES</h4>

                    <h4>Artículo 68</h4> (Derechos). Constituyen derechos del sujeto pasivo los siguientes:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. A ser informado y asistido en el cumplimiento de sus obligaciones tributarias y en el ejercicio de sus derechos.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. A que la Administración Tributaria resuelva expresamente las cuestiones planteadas en los procedimientos previstos por este Código y disposiciones reglamentarias, dentro de los plazos establecidos.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. A solicitar certificación y copia de sus declaraciones juradas presentadas.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;4. A la reserva y confidencialidad de los datos, informes o antecedentes que obtenga la Administración Tributaria, en el ejercicio de sus funciones, quedando las autoridades, funcionarios, u otras personas a su servicio, obligados a guardar estricta reserva y confidencialidad, bajo responsabilidad funcionaria, con excepción de lo establecido en el Artículo 67º del presente Código.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;5. A ser tratado con el debido respeto y consideración por el personal que desempeña funciones en la Administración Tributaria.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;6. Al debido proceso y a conocer el estado de la tramitación de los procesos tributarios en los que sea parte interesada a través del libre acceso a las actuaciones y documentación que respalde los cargos que se le formulen, ya sea en forma personal o a través de terceros autorizados, en los términos del presente Código.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;7. A formular y aportar, en la forma y plazos previstos en este Código, todo tipo de pruebas y alegatos que deberán ser tenidos en cuenta por los órganos competentes al redactar la correspondiente Resolución.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;8. A ser informado al inicio y conclusión de la fiscalización tributaria acerca de la naturaleza y alcance de la misma, así como de sus derechos y obligaciones en el curso de tales actuaciones.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;9. A la Acción de Repetición conforme lo establece el presente Código
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;10. A ser oído o juzgado de conformidad a lo establecido en el Artículo 16º de la Constitución Política del Estado

                    <h4>Artículo 69</h4> (Presunción a favor del Sujeto Pasivo). En aplicación al principio de buena fe y transparencia, se presume que el sujeto pasivo y los terceros responsables han cumplido sus obligaciones tributarias cuando han observado sus obligaciones materiales y formales, hasta que en debido proceso de determinación, de prejudicialidad o jurisdiccional, la Administración Tributaria pruebe lo contrario, conforme a los procedimientos establecidos en este Código, Leyes y Disposiciones Reglamentarias.

                    <h4>Artículo 70</h4> (Obligaciones Tributarias del Sujeto Pasivo). Constituyen obligaciones tributarias del sujeto pasivo:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Determinar, declarar y pagar correctamente la deuda tributaria en la forma, medios, plazos y lugares establecidos por la Administración Tributaria, ocurridos los hechos previstos en la Ley como generadores de una obligación tributaria.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Inscribirse en los registros habilitados por la Administración Tributaria y aportar los datos que le fueran requeridos comunicando ulteriores modificaciones en su situación tributaria.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Fijar domicilio y comunicar su cambio, caso contrario el domicilio fijado se considerará subsistente, siendo válidas las notificaciones practicadas en el mismo.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;4. Respaldar las actividades y operaciones gravadas, mediante libros, registros generales y especiales, facturas, notas fiscales, así como otros documentos y/o instrumentos públicos, conforme se establezca en las disposiciones normativas respectivas.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;5. Demostrar la procedencia y cuantía de los créditos impositivos que considere le correspondan, aunque los mismos se refieran a periodos fiscales prescritos. Sin embargo, en este caso la Administración Tributaria no podrá determinar deudas tributarias que oportunamente no las hubiere determinado y cobrado.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;6. Facilitar las tareas de control, determinación, comprobación, verificación, fiscalización, investigación y recaudación que realice la Administración Tributaria, observando las obligaciones que les impongan las leyes, decretos reglamentarios y demás disposiciones.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;7. Facilitar el acceso a la información de sus estados financieros cursantes en Bancos y otras instituciones financieras.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;8. Conforme a lo establecido por disposiciones tributarias y en tanto no prescriba el tributo, considerando incluso la ampliación del plazo, hasta siete (7) años conservar en forma ordenada en el domicilio tributario los libros de contabilidad, registros especiales, declaraciones, informes, comprobantes, medios de almacenamiento, datos e información computarizada y demás documentos de respaldo de sus actividades; presentar, exhibir y poner a disposición de la Administración Tributaria los mismos, en la forma y plazos en que éste los requiera. Asimismo, deberán permitir el acceso y facilitar la revisión de toda la información, documentación, datos y bases de datos relacionadas con el equipamiento de computación y los programas de sistema (software básico) y los programas de aplicación (software de aplicación), incluido el código fuente, que se utilicen en los sistemas informáticos de registro y contabilidad de las operaciones vinculadas con la materia imponible.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;9. Permitir la utilización de programas y aplicaciones informáticas provistos por la Administración Tributaria, en los equipos y recursos de computación que utilizarán, así como el libre acceso a la información contenida en la base de datos.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;10. Constituir garantías globales o especiales mediante boletas de garantía, prenda, hipoteca u otras, cuando así lo requiera la norma.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;11. Cumplir las obligaciones establecidas en este Código, leyes tributarias especiales y las que defina la Administración Tributaria con carácter general.

                    <h4>Sección III: AGENTES DE INFORMACIÓN</h4>

                    <h4>Artículo 71</h4> (Obligación de Informar).
                    <br> I. Toda persona natural o jurídica de derecho público o privado, sin costo alguno, está obligada a proporcionar a la Administración Tributaria toda clase de datos, informes o antecedentes con efectos tributarios, emergentes de sus relaciones económicas, profesionales o financieras con otras personas, cuando fuere requerido expresamente por la Administración Tributaria.
                    <br> II. Las obligaciones a que se refiere el parágrafo anterior, también serán cumplidas por los agentes de información cuya designación, forma y plazo de cumplimiento será establecida reglamentariamente.
                    <br> III. El incumplimiento de la obligación de informar no podrá ampararse en: disposiciones normativas, estatutarias, contractuales y reglamentos internos de funcionamiento de los referidos organismos o entes estatales o privados.
                    <br> IV. Los profesionales no podrán invocar el secreto profesional a efecto de impedir la comprobación de su propia situación tributaria.

                    <h4>Artículo 72</h4> (Excepciones a la Obligación de Informar). No podrá exigirse información en los siguientes casos:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Cuando la declaración sobre un tercero, importe violación del secreto profesional, de correspondencia epistolar o de las comunicaciones privadas salvo orden judicial.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Cuando su declaración estuviera relacionada con hechos que pudieran motivar la aplicación de penas privativas de libertad de sus parientes hasta cuarto grado de consanguinidad o segundo de afinidad, salvo los casos en que estuvieran vinculados por alguna actividad económica.

                    <h4>Artículo 73</h4> (Obligaciones de los Servidores Públicos). Las autoridades de todos los niveles de la organización del Estado cualquiera que sea su naturaleza, y quienes en general ejerzan funciones públicas, están obligados a suministrar a la Administración Tributaria cuantos datos y antecedentes con efectos tributarios requiera, mediante disposiciones de carácter general o a través de requerimientos concretos y a prestarle a ella y a sus funcionarios apoyo, auxilio y protección para el ejercicio de sus funciones.
                    Para proporcionar la información, los documentos y otros antecedentes, bastará la petición de la Administración Tributaria sin necesidad de orden judicial. Asimismo, deberán denunciar ante la Administración Tributaria correspondiente la comisión de ilícitos tributarios que lleguen a su conocimiento en cumplimiento de sus funciones.
                    A requerimiento de la Administración Tributaria, los juzgados y tribunales deberán facilitarle cuantos datos con efectos tributarios se desprendan de las actuaciones judiciales que conozcan, o el acceso a los expedientes o cuadernos en los que cursan estos datos. El suministro de aquellos datos de carácter personal contenidos en registros públicos u oficiales, no requerirá del consentimiento de los afectados.

                    <h4>CAPITULO II PROCEDIMIENTOS TRIBUTARIOS</h4>

                    <h4>Sección I: DISPOSICIONES COMUNES</h4>

                    <h4>Artículo 74</h4> (Principios, Normas Principales y Supletorias). Los procedimientos tributarios se sujetarán a los principios constitucionales de naturaleza tributaria, con arreglo a las siguientes ramas específicas del Derecho, siempre que se avengan a la naturaleza y fines de la materia tributaria:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Los procedimientos tributarios administrativos se sujetarán a los principios del Derecho Administrativo y se sustanciarán y resolverán con arreglo a las normas contenidas en el presente Código. Sólo a falta de disposición expresa, se aplicarán supletoriamente las normas de la Ley de Procedimiento Administrativo y demás normas en materia administrativa.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Los procesos tributarios jurisdiccionales se sujetarán a los principios del Derecho Procesal y se sustanciarán y resolverán con arreglo a las normas contenidas en el presente Código. Sólo a falta de disposición expresa, se aplicarán supletoriamente las normas del Código de Procedimiento Civil y del Código de Procedimiento Penal, según corresponda.

                    ARÍCULO 75 (Personería y Vista de Actuaciones).
                    <br> I. Los interesados podrán actuar personalmente o por medio de sus representantes mediante instrumento público, conforme a lo que reglamentariamente se establezca.
                    <br> II. Los interesados o sus representantes y sus abogados, tendrán acceso a las actuaciones administrativas y podrán consultarlas sin más exigencia que la demostración de su identidad, excepto cuando la Administración Tributaria requiera la reserva temporal de sus actuaciones, dada la naturaleza de algunos procedimientos. En aplicación del principio de confidencialidad de la Información Tributaria, ninguna otra persona ajena a la Administración Tributaria podrá acceder a estas actuaciones.

                    <h4>Sección II: PRUEBA</h4>

                    <h4>Artículo 76</h4> (Carga de la Prueba). En los procedimientos tributarios administrativos y jurisdiccionales quien pretenda hacer valer sus derechos deberá probar los hechos constitutivos de los mismos. Se entiende por ofrecida y presentada la prueba por el sujeto pasivo o tercero responsable cuando estos señalen expresamente que se encuentran en poder de la Administración Tributaria.

                    <h4>Artículo 77</h4> (Medios de Prueba).
                    <br> I. Podrán invocarse todos los medios de prueba admitidos en Derecho.
                    La prueba testifical sólo se admitirá con validez de indicio, no pudiendo proponerse más de dos (2) testigos sobre cada punto de la controversia. Si se propusieren más, a partir del tercero se tendrán por no ofrecidos.
                    <br> II. Son también medios legales de prueba los medios informáticos y las impresiones de la información contenida en ellos, conforme a la reglamentación que al efecto se dicte.
                    <br> III. Las actas extendidas por la Administración Tributaria en su función fiscalizadora, donde se recogen hechos, situaciones y actos del sujeto pasivo que hubieren sido verificados y comprobados, hacen prueba de los hechos recogidos en ellas, salvo que se acredite lo contrario.
                    <br> IV. En materia procesal penal, el ofrecimiento, producción, y presentación de medios de prueba se sujetará a lo dispuesto por el Código de Procedimiento Penal y demás disposiciones legales.

                    <h4>Artículo 78</h4> (Declaración Jurada).
                    <br> I. Las declaraciones juradas son la manifestación de hechos, actos y datos comunicados a la Administración Tributaria en la forma, medios, plazos y lugares establecidos por las reglamentaciones que ésta emita, se presumen fiel reflejo de la verdad y comprometen la responsabilidad de quienes las suscriben en los términos señalados por este Código.
                    <br> II. Podrán rectificarse a requerimiento de la Administración Tributaria o por iniciativa del sujeto pasivo o tercero responsable, cuando la rectificación tenga como efecto el aumento del saldo a favor del Fisco o la disminución del saldo a favor del declarante.
                    También podrán rectificarse a libre iniciativa del declarante, cuando la rectificación tenga como efecto el aumento del saldo a favor del sujeto pasivo o la disminución del saldo a favor del Fisco, previa verificación de la Administración Tributaria. Los límites, formas, plazos y condiciones de las declaraciones rectificatorias serán establecidos mediante Reglamento.
                    En todos los casos, la Declaración Jurada rectificatoria sustituirá a la original con relación a los datos que se rectifican.
                    <br> III. No es rectificatoria la Declaración Jurada que actualiza cualquier información o dato brindado a la Administración Tributaria no vinculados a la determinación de la Deuda Tributaria. En estos casos, la nueva información o dato brindados serán los que tome como válidos la Administración Tributaria a partir de su presentación.

                    <h4>Artículo 79</h4> (Medios e Instrumentos Tecnológicos).
                    <br> I. La facturación, la presentación de declaraciones juradas y de toda otra información de importancia fiscal, la retención, percepción y pago de tributos, el llevado de libros, registros y anotaciones contables así como la documentación de las obligaciones tributarias y conservación de dicha documentación, siempre que sean autorizados por la Administración Tributaria a los sujetos pasivos y terceros responsables, así como las comunicaciones y notificaciones que aquella realice a estos últimos, podrán efectuarse por cualquier medio tecnológicamente disponible en el país, conforme a la normativa aplicable a la materia.
                    Estos medios, incluidos los informáticos, electrónicos, ópticos o de cualquier otra tecnología, deberán permitir la identificación de quien los emite, garantizar la verificación de la integridad de la información y datos en ellos contenidos de forma tal que cualquier modificación de los mismos ponga en evidencia su alteración, y cumplir los requisitos de pertenecer únicamente a su titular y encontrarse bajo su absoluto y exclusivo control.
                    <br> II. Las Vistas de Cargo y Resoluciones Determinativas y todo documento relativo a los tramites en la Administración Tributaria, podrán expedirse por sistemas informáticos, debiendo las mismas llevar inscrito el cargo y nombre de la autoridad que las emite, su firma en facsímil, electrónica o por cualquier otro medio tecnológicamente disponible, conforme a lo dispuesto reglamentariamente.

                    ARTICULO 80 (Régimen de Presunciones Tributarias).
                    <br> I. Las presunciones establecidas por leyes tributarias no admiten prueba en contrario, salvo en los casos en que aquellas lo determinen expresamente.
                    <br> II. En las presunciones legales que admiten prueba en contrario, quien se beneficie con ellas, deberá probar el hecho conocido del cual resulte o se deduzca la aplicación de la presunción. Quien pretenda desvirtuar la presunción deberá aportar la prueba correspondiente.
                    <br> III. Las presunciones no establecidas por la Ley serán admisibles como medio de prueba siempre que entre el hecho demostrado y aquél que se trate de deducir haya un enlace lógico y directo según las reglas del sentido común. Estas presunciones admitirán en todos los casos prueba en contrario.

                    <h4>Artículo 81</h4> (Apreciación, Pertinencia y Oportunidad de Pruebas). Las pruebas se apreciarán conforme a las reglas de la sana crítica siendo admisibles sólo aquéllas que cumplan con los requisitos de pertinencia y oportunidad, debiendo rechazarse las siguientes:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Las manifiestamente inconducentes, meramente dilatorias, superfluas o ilícitas.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Las que habiendo sido requeridas por la Administración Tributaria durante el proceso de fiscalización, no hubieran sido presentadas, ni se hubiera dejado expresa constancia de su existencia y compromiso de presentación, hasta antes de la emisión de la Resolución Determinativa.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Las pruebas que fueran ofrecidas fuera de plazo.
                    En los casos señalados en los numerales 2 y 3 cuando el sujeto pasivo de la obligación tributaria pruebe que la omisión no fue por causa propia podrá presentarlas con juramento de reciente obtención.

                    <h4>Artículo 82</h4> (Clausura Extraordinaria del Periodo de Prueba). El periodo de prueba quedará clausurado antes de su vencimiento por renuncia expresa de las partes.

                    Sección III: FORMAS Y MEDIOS DE NOTIFICACIÓN

                    <h4>Artículo 83</h4> (Medios de Notificación).
                    <br> I. Los actos y actuaciones de la Administración Tributaria se notificarán por uno de los medios siguientes, según corresponda:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Personalmente;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Por Cédula;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Por Edicto;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;4. Por correspondencia postal certificada, efectuada mediante correo público o privado o por sistemas de comunicación electrónicos, facsímiles o similares;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;5. Tácitamente;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;6. Masiva;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;7. En Secretaría;
                    <br> II. Es nula toda notificación que no se ajuste a las formas anteriormente descritas. Con excepción de las notificaciones por correspondencia, edictos y masivas, todas las notificaciones se practicarán en días y horas hábiles administrativos, de oficio o a pedido de parte. Siempre por motivos fundados, la autoridad administrativa competente podrá habilitar días y horas extraordinarios.

                    <h4>Artículo 84</h4> (Notificación Personal).
                    <br> I. Las Vistas de Cargo y Resoluciones Determinativas que superen la cuantía establecida por la reglamentación a que se refiere el Artículo 89 de este Código; así como los actos que impongan sanciones, decreten apertura de término de prueba y la derivación de la acción administrativa a los subsidiarios serán notificados personalmente al sujeto pasivo, tercero responsable, o a su representante legal.
                    <br> II. La notificación personal se practicará con la entrega al interesado o su representante legal de la copia íntegra de la resolución o documento que debe ser puesto en su conocimiento, haciéndose constar por escrito la notificación por el funcionario encargado de la diligencia, con indicación literal y numérica del día, hora y lugar legibles en que se hubiera practicado.
                    <br> III. En caso que el interesado o su representante legal rechace la notificación se hará constar este hecho en la diligencia respectiva con intervención de testigo debidamente identificado y se tendrá la notificación por efectuada a todos los efectos legales.

                    <h4>Artículo 85</h4> (Notificación por Cédula).
                    <br> I. Cuando el interesado o su representante no fuera encontrado en su domicilio, el funcionario de la Administración dejará aviso de visita a cualquier persona mayor de dieciocho (18) años que se encuentre en él, o en su defecto a un vecino del mismo, bajo apercibimiento de que será buscado nuevamente a hora determinada del día hábil siguiente.
                    <br> II. Si en esta ocasión tampoco pudiera ser habido, el funcionario bajo responsabilidad formulará representación jurada de las circunstancias y hechos anotados, en mérito de los cuales la autoridad de la respectiva Administración Tributaria instruirá se proceda a la notificación por cédula.
                    <br> III. La cédula estará constituida por copia del acto a notificar, firmada por la autoridad que lo expidiera y será entregada por el funcionario de la Administración en el domicilio del que debiera ser notificado a cualquier persona mayor de dieciocho (18) años, o fijada en la puerta de su domicilio, con intervención de un testigo de actuación que también firmará la diligencia.

                    <h4>Artículo 86</h4>°. (Notificación por Edictos). Cuando no sea posible practicar la notificación personal o por cédula, por desconocerse el domicilio del interesado, o intentada la notificación en cualquiera de las formas previstas, en este Código ésta no hubiera podido ser realizada, se practicará la notificación por edictos publicados en dos (2) oportunidades con un intervalo de por lo menos tres
                    (3) días corridos entre la primera y segunda publicación, en un órgano de prensa de circulación nacional. En este caso, se considerará como fecha de notificación la correspondiente a la publicación del último edicto.
                    Las Administraciones Tributarias quedan facultadas para efectuar publicaciones mediante órganos de difusión oficial que tengan circulación nacional.

                    <h4>Artículo 87</h4> (Por Correspondencia Postal y Otros Sistemas de Comunicación). Para casos en lo que no proceda la notificación personal, será válida la notificación practicada por correspondencia postal certificada, efectuada mediante correo público o privado. También será válida la notificación que se practique mediante sistemas de comunicación electrónicos, facsímiles, o por cualquier otro medio tecnológicamente disponible, siempre que los mismos permitan verificar su recepción.
                    En las notificaciones practicadas en esta forma, los plazos empezarán a correr desde el día de su recepción tratándose de día hábil administrativo; de lo contrario, se tendrá por practicada la notificación a efectos de cómputo, a primera hora del día hábil administrativo siguiente.

                    <h4>Artículo 88</h4> (Notificación Tácita). Se tiene por practicada la notificación tácita, cuando el interesado a través de cualquier gestión o petición, efectúa cualquier acto o hecho que demuestre el conocimiento del acto administrativo. En este caso, se considerará como fecha de notificación el momento de efectuada la gestión, petición o manifestación.

                    <h4>Artículo 89</h4> (Notificaciones Masivas). Las Vistas de Cargo, las Resoluciones Determinativas y Resoluciones Sancionatorias, emergentes del procedimiento determinativo en casos especiales establecido en el Artículo 97 del presente Código que afecten a una generalidad de deudores tributarios y que no excedan de la cuantía fijada por norma reglamentaria, podrán notificarse en la siguiente forma:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. La Administración Tributaria mediante publicación en órganos de prensa de circulación nacional citará a los sujetos pasivos y terceros responsables para que dentro del plazo de cinco (5) días computables a partir de la publicación, se apersonen a sus dependencias a efecto de su notificación.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Transcurrido dicho plazo sin que se hubieran apersonado, la Administración Tributaria efectuará una segunda y última publicación, en los mismos medios, a los quince (15) días posteriores a la primera en las mismas condiciones. Si los interesados no comparecieran en esta segunda oportunidad, previa constancia en el expediente se tendrá por practicada la notificación.

                    <h4>Artículo 90</h4> (Notificación en Secretaria). Los actos administrativos que no requieran notificación personal serán notificados en Secretaría de la Administración Tributaria, para cuyo fin deberá asistir ante la instancia administrativa que sustancia el trámite, todos los miércoles de cada semana, para notificarse con todas las actuaciones que se hubieran producido. La diligencia de notificación se hará constar en el expediente correspondiente. La inconcurrencia del interesado no impedirá que se practique la diligencia de notificación.
                    En el caso de Contrabando, el Acta de Intervención y la Resolución Determinativa serán notificadas bajo este medio.

                    <h4>Artículo 91</h4> (Notificación a Representantes). La notificación en el caso de empresas unipersonales y personas jurídicas se podrá practicar válidamente en la persona que estuviera registrada en la Administración Tributaria como representante legal. El cambio de representante legal solamente tendrá efectos a partir de la comunicación y registro del mismo ante la Administración Tributaria correspondiente.

                    </h4>Sección IV: DETERMINACIÓN DE LA DEUDA TRIBUTARIA

                    <h4>Artículo 92</h4> (Definición). La determinación es el acto por el cual el sujeto pasivo o la Administración Tributaria declara la existencia y cuantía de una deuda tributaria o su inexistencia.

                    <h4>Artículo 93</h4> (Formas de Determinación).
                    <br> I. La determinación de la deuda tributaria se realizará:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Por el sujeto pasivo o tercero responsable, a través de declaraciones juradas, en las que se determina la deuda tributaria.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Por la Administración Tributaria, de oficio en ejercicio de las facultades otorgadas por Ley.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Mixta, cuando el sujeto pasivo o tercero responsable aporte los datos en mérito a los cuales la Administración Tributaria fija el importe a pagar.
                    <br> II. La determinación practicada por la Administración Tributaria podrá ser total o parcial. En ningún caso podrá repetirse el objeto de la fiscalización ya practicada, salvo cuando el contribuyente o tercero responsable hubiera ocultado dolosamente información vinculada a hechos gravados.

                    <h4>Subsección I: DETERMINACIÓN POR EL SUJETO PASIVO O TERCERO RESPONSABLE</h4>

                    <h4>Artículo 94</h4> (Determinación por el Sujeto Pasivo o Tercero Responsable).
                    <br> I. La determinación de la deuda tributaria por el sujeto pasivo o tercero responsable es un acto de declaración de éste a la Administración Tributaria.
                    <br> II. La deuda tributaria determinada por el sujeto pasivo o tercero responsable y comunicada a la Administración Tributaria en la correspondiente declaración jurada, podrá ser objeto de ejecución tributaria sin necesidad de intimación ni determinación administrativa previa, cuando la Administración Tributaria compruebe la inexistencia de pago o su pago parcial.

                    <h4>Subsección II: DETERMINACIÓN POR LA ADMINISTRACIÓN TRIBUTARIA</h4>

                    <h4>Artículo 95</h4> (Control, Verificación, Fiscalización e Investigación).
                    <br> I. Para dictar la Resolución Determinativa la Administración Tributaria debe controlar, verificar, fiscalizar ó investigar los hechos, actos, datos, elementos, valoraciones y demás circunstancias que integren o condicionen el hecho imponible declarados por el sujeto pasivo, conforme a las facultades otorgadas por este Código y otras disposiciones legales tributarias.
                    <br> II. Asimismo, podrá investigar los hechos, actos y elementos del hecho imponible no declarados por el sujeto pasivo, conforme a lo dispuesto por este Código.

                    <h4>Artículo 96</h4> (Vista de Cargo o Acta de Intervención).
                    <br> I. La Vista de Cargo, contendrá los hechos, actos, datos, elementos y valoraciones que fundamenten la Resolución Determinativa, procedentes de la declaración del sujeto pasivo o tercero responsable, de los elementos de prueba en poder de la Administración Tributaria o de los resultados de las actuaciones de control, verificación, fiscalización e investigación. Asimismo, fijará la base imponible, sobre base cierta o sobre base presunta, según corresponda, y contendrá la liquidación previa del tributo adeudado.
                    <br> II. En Contrabando, el Acta de Intervención que fundamente la Resolución Determinativa, contendrá la relación circunstanciada de los hechos, actos, mercancías, elementos, valoración y liquidación, emergentes del operativo aduanero correspondiente y dispondrá la monetización inmediata de las mercancías decomisadas, cuyo procedimiento será establecido mediante Decreto Supremo.
                    <br> III. La ausencia de cualquiera de los requisitos esenciales establecidos en el reglamento viciará de nulidad la Vista de Cargo o el Acta de Intervención, según corresponda.

                    <h4>Artículo 97</h4> (Procedimiento Determinativo en Casos Especiales).
                    <br> I. Cuando la Administración Tributaria establezca la existencia de errores aritméticos contenidos en las Declaraciones Juradas, que hubieran originado un menor valor a pagar o un mayor saldo a favor del sujeto pasivo, la Administración Tributaria efectuará de oficio los ajustes que correspondan y no deberá elaborar Vista de Cargo, emitiendo directamente Resolución Determinativa.
                    En este caso, la Administración Tributaria requerirá la presentación de declaraciones juradas rectificatorias.
                    El concepto de error aritmético comprende las diferencias aritméticas de toda naturaleza, excepto los datos declarados para la determinación de la base imponible.
                    <br> II. Cuando el sujeto pasivo o tercero responsable no presenten la declaración jurada o en ésta se omitan datos básicos para la liquidación del tributo, la Administración Tributaria los intimará a su presentación o, a que se subsanen las ya presentadas.
                    A tiempo de intimar al sujeto pasivo o tercero responsable, la Administración Tributaria deberá notificar, en unidad de acto, la Vista de Cargo que contendrá un monto presunto calculado de acuerdo a lo dispuesto por normas reglamentarias.
                    Dentro del plazo previsto en el Artículo siguiente, el sujeto pasivo o tercero responsable aún podrá presentar la declaración jurada extrañada o, alternativamente, pagar el monto indicado en la Vista de Cargo.
                    Si en el plazo previsto no hubiera optado por alguna de las alternativas, la Administración Tributaria dictará la Resolución Determinativa que corresponda.
                    El monto determinado por la Administración Tributaria y pagado por el sujeto pasivo o tercero responsable se tomará a cuenta del impuesto que en definitiva corresponda pagar, en caso que la Administración Tributaria ejerciera su facultad de control, verificación, fiscalización e investigación. La impugnación de la Resolución Determinativa a que se refiere este parágrafo no podrá realizarse fundándose en hechos, elementos o documentos distintos a los que han servido de base para la determinación de la base presunta y que no hubieran sido puestos oportunamente en conocimiento de la Administración Tributaria, salvo que el impugnante pruebe que la omisión no fue por causa propia, en cuyo caso deberá presentarlos con juramento de reciente obtención.
                    <br> III. La liquidación que resulte de la determinación mixta y refleje fielmente los datos proporcionados por el contribuyente, tendrá el carácter de una Resolución Determinativa, sin perjuicio de que la Administración Tributaria pueda posteriormente realizar una determinación de oficio ejerciendo sus facultades de control, verificación, fiscalización e investigación.
                    <br> IV. En el Caso de Contrabando, el Acta de Intervención equivaldrá en todos sus efectos a la Vista de Cargo.

                    <h4>Artículo 98</h4> (Descargos). Una vez notificada la Vista de Cargo, el sujeto pasivo o tercero responsable tiene un plazo perentorio e improrrogable de treinta (30) días para formular y presentar los descargos que estime convenientes.
                    Practicada la notificación con el Acta de Intervención por Contrabando, el interesado presentará sus descargos en un plazo perentorio e improrrogable de tres (3) días hábiles administrativos.

                    <h4>Artículo 99</h4> (Resolución Determinativa).
                    <br> I. Vencido el plazo de descargo previsto en el primer párrafo del Artículo anterior, se dictará y notificará la Resolución Determinativa dentro el plazo de sesenta (60) días y para Contrabando dentro el plazo de diez (10) días hábiles administrativos, aun cuando el sujeto pasivo o tercero responsable hubiera prestado su conformidad y pagado la deuda tributaria, plazo que podrá ser prorrogado por otro similar de manera excepcional, previa autorización de la máxima autoridad normativa de la Administración Tributaria.
                    En caso que la Administración Tributaria no dictara Resolución Determinativa dentro del plazo previsto, no se aplicarán intereses sobre el tributo determinado desde el día en que debió dictarse, hasta el día de la notificación con dicha resolución.
                    <br> II. La Resolución Determinativa que dicte la Administración deberá contener como requisitos mínimos; Lugar y fecha, nombre o razón social del sujeto pasivo, especificaciones sobre la deuda tributaria, fundamentos de hecho y de derecho, la calificación de la conducta y la sanción en el caso de contravenciones, así como la firma, nombre y cargo de la autoridad competente. La ausencia de cualquiera de los requisitos esenciales, cuyo contenido será expresamente desarrollado en la reglamentación que al efecto se emita, viciará de nulidad la Resolución Determinativa.
                    <br> III. La Resolución Determinativa tiene carácter declarativo y no constitutivo de la obligación tributaria.

                    <h4>Sección V: CONTROL, VERIFICACIÓN, FISCALIZACIÓN E INVESTIGACIÓN</h4>

                    <h4>Artículo 100</h4> (Ejercicio de la Facultad). La Administración Tributaria dispondrá indistintamente de amplias facultades de control, verificación, fiscalización e investigación, a través de las cuales, en especial, podrá:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Exigir al sujeto pasivo o tercero responsable la información necesaria, así como cualquier libro, documento y correspondencia con efectos tributarios.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Inspeccionar y en su caso secuestrar o incautar registros contables, comerciales, aduaneros, datos, bases de datos, programas de sistema (software de base) y programas de aplicación (software de aplicación), incluido el código fuente, que se utilicen en los sistemas informáticos de registro y contabilidad, la información contenida en las bases de datos y toda otra documentación que sustente la obligación tributaria o la obligación de pago, conforme lo establecido en el Artículo 102º parágrafo <br> II.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Realizar actuaciones de inspección material de bienes, locales, elementos, explotaciones e instalaciones relacionados con el hecho imponible. Requerir el auxilio inmediato de la fuerza pública cuando fuera necesario o cuando sus funcionarios tropezaran con inconvenientes en el desempeño de sus funciones.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;4. Realizar controles habituales y no habituales de los depósitos aduaneros, zonas francas, tiendas libres y otros establecimientos vinculados o no al comercio exterior, así como practicar avalúos o verificaciones físicas de toda clase de bienes
                    o mercancías, incluso durante su transporte o tránsito.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;5. Requerir de las entidades públicas, operadores de comercio exterior, auxiliares de la función pública aduanera y terceros, la información y documentación relativas a operaciones de comercio exterior, así como la presentación de dictámenes técnicos elaborados por profesionales especializados en la materia.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;6. Solicitar informes a otras Administraciones Tributarias, empresas o instituciones tanto nacionales como extranjeras, así como a organismos internacionales.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;7. Intervenir los ingresos económicos de los espectáculos públicos que no hayan sido previamente puestos a conocimiento de la Administración Tributaria para su control tributario.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;8. Embargar preventivamente dinero y mercancías en cuantía suficiente para asegurar el pago de la deuda tributaria que corresponda exigir por actividades lucrativas ejercidas sin establecimiento y que no hubieran sido declaradas.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;9. Recabar del juez cautelar de turno, orden de allanamiento y requisa que deberá ser despachada dentro de las cinco (5) horas siguientes a la presentación del requerimiento fiscal, con habilitación de días y horas inhábiles si fueran necesarias, bajo responsabilidad.
                    Las facultades de control, verificación, fiscalización e investigación descritas en este Artículo, son funciones administrativas inherentes a la Administración Tributaria de carácter prejudicial y no constituye persecución penal.

                    <h4>Artículo 101</h4> (Lugar donde se Desarrollan las Actuaciones).
                    <br> I. La facultad de control, verificación, fiscalización e investigación, se podrá desarrollar indistintamente:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. En el lugar donde el sujeto pasivo tenga su domicilio tributario o en el del representante que a tal efecto hubiera designado.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Donde se realicen total o parcialmente las actividades gravadas o se encuentren los bienes gravados.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Donde exista alguna prueba al menos parcial, de la realización del hecho imponible.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;4. En casos debidamente justificados, estas facultades podrán ejercerse en las oficinas públicas; en estos casos la documentación entregada por el contribuyente deberá ser debidamente preservada, bajo responsabilidad funcionaria.
                    <br> II. Los funcionarios de la Administración Tributaria en ejercicio de sus funciones podrán ingresar a los almacenes, establecimientos, depósitos o lugares en que se desarrollen actividades o explotaciones sometidas a gravamen para ejercer las funciones previstas en este Código.

                    <h4>Artículo 102</h4> (Medidas para la Conservación de Pruebas).
                    <br> I. Para la conservación de la documentación y de cualquier otro medio de prueba relevante para la determinación de la deuda tributaria, incluidos programas informáticos y archivos en soporte magnético, la autoridad competente de la Administración Tributaria correspondiente podrá disponer la adopción de las medidas que se estimen precisas a objeto de impedir su desaparición, destrucción o alteración.
                    <br> II. Las medidas serán adecuadas al fin que se persiga y deberán estar debidamente justificadas.
                    <br> III. Las medidas consistirán en el precintado del lugar o depósito de mercancías o bienes o productos sometidos a gravamen, así como en la intervención, decomiso, incautación y secuestro de mercancías, libros, registros, medios o unidades de transporte y toda clase de archivos, inclusive los que se realizan en medios magnéticos, computadoras y otros documentos inspeccionados, adoptándose los recaudos para su conservación.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. En materia informática, la incautación se realizará tomando una copia magnética de respaldo general (Backup) de las bases de datos, programas, incluido el código fuente, datos e información a que se refiere el numeral 2 del Artículo 100 del presente Código; cuando se realicen estas incautaciones, la autoridad a cargo de los bienes incautados será responsable legalmente por su utilización o explotación al margen de los estrictos fines fiscales que motivaron su incautación.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Cuando se prive al sujeto pasivo o tercero responsable de la disponibilidad de sus documentos, la adopción de estas medidas deberá estar debidamente justificada y podrá extenderse en tanto la prueba sea puesta a disposición de la autoridad que deba valorarlas. Al momento de incautar los documentos, la Administración Tributaria queda obligada a su costo, a proporcionar al sujeto pasivo o tercero responsable un juego de copias legalizadas de dichos documentos.
                    <br> IV. Las medidas para la conservación de pruebas se levantarán si desaparecen las circunstancias que justificaron su adopción.

                    <h4>Artículo 103</h4> (Verificación del Cumplimiento de Deberes Formales y de la Obligación de Emitir Factura). La Administración Tributaria podrá verificar el cumplimiento de los deberes formales de los sujetos pasivos y de su obligación de emitir factura, sin que se requiera para ello otro trámite que el de la identificación de los funcionarios actuantes y en caso de verificarse cualquier tipo de incumplimiento se levantará un acta que será firmada por los funcionarios y por el titular del establecimiento o quien en ese momento se hallara a cargo del mismo. Si éste no supiera o se negara a firmar, se hará constar el hecho con testigo de actuación.
                    Se presume, sin admitir prueba en contrario, que quien realiza tareas en un establecimiento lo hace como dependiente del titular del mismo, responsabilizando sus actos y omisiones inexcusablemente a este último.

                    <h4>Artículo 104</h4> (Procedimiento de Fiscalización).
                    <br> I. Sólo en casos en los que la Administración, además de ejercer su facultad de control, verificación, é investigación efectúe un proceso de fiscalización, el procedimiento se iniciará con Orden de Fiscalización emitida por autoridad competente de la Administración Tributaria, estableciéndose su alcance, tributos y períodos a ser fiscalizados, la identificación del sujeto pasivo, así como la identificación del o los funcionarios actuantes, conforme a lo dispuesto en normas reglamentarias que a este efecto se emitan.
                    <br> II. Los hechos u omisiones conocidos por los funcionarios públicos durante su actuación como fiscalizadores, se harán constar en forma circunstanciada en acta, los cuales junto con las constancias y los descargos presentados por el fiscalizado, dentro los alcances del Artículo 68º de éste Código, harán prueba preconstituida de la existencia de los mismos.
                    <br> III. La Administración Tributaria, siempre que lo estime conveniente, podrá requerir la presentación de declaraciones, la ampliación de éstas, así como la subsanación de defectos advertidos. Consiguientemente estas declaraciones causarán todo su efecto a condición de ser validadas expresamente por la fiscalización actuante, caso contrario no surtirán efecto legal alguno, pero en todos los casos los pagos realizados se tomarán a cuenta de la obligación que en definitiva adeudaran.
                    <br> IV. A la conclusión de la fiscalización, se emitirá la Vista de Cargo correspondiente.
                    <br> V. Desde el inicio de la fiscalización hasta la emisión de la Vista de Cargo no podrán transcurrir más de doce (12) meses, sin embargo cuando la situación amerite un plazo más extenso, previa solicitud fundada, la máxima autoridad ejecutiva de la Administración Tributaria podrá autorizar una prórroga hasta por seis (6) meses más.
                    <br> VI. Si al concluir la fiscalización no se hubiera efectuado reparo alguno o labrado acta de infracción contra el fiscalizado, no habrá lugar a la emisión de Vista de Cargo, debiéndose en este caso dictar una Resolución Determinativa que declare la inexistencia de la deuda tributaria.

                    <h4>Sección VI: RECAUDACIÓN Y MEDIDAS PRECAUTORIAS</h4>

                    <h4>Artículo 105</h4> (Facultad de Recaudación). La Administración Tributaria está facultada para recaudar las deudas tributarias en todo momento, ya sea a instancia del sujeto pasivo o tercero responsable, o ejerciendo su facultad de ejecución tributaria.

                    <h4>Artículo 106</h4>º (Medidas Precautorias).
                    <br> I. Cuando exista fundado riesgo de que el cobro de la deuda tributaria determinada o del monto indebidamente devuelto, se verá frustrado o perjudicado, la Administración Tributaria esta facultada para adoptar medidas precautorias, previa autorización de la Superintendencia Regional, bajo responsabilidad funcionaria. Si el proceso estuviera en conocimiento de las Superintendencias, la Administración podrá solicitar a las mismas la adopción de medidas precautorias.
                    <br> II. Las medidas adoptadas serán proporcionales al daño que se pretende evitar.
                    <br> III. Dichas medidas podrán consistir en:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Anotación preventiva en los registros públicos sobre los bienes, acciones y derechos del deudor.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Embargo preventivo de los bienes del deudor.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Retención del pago de devoluciones tributarias o de otros pagos que deba realizar el Estado, en la cuantía estrictamente necesaria para asegurar el cobro de la deuda tributaria.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;4. Retención de fondos del deudor en la cuantía necesaria para asegurar el cobro de la deuda tributaria. Esta medida se adoptará cuando las anteriores no pudieren garantizar el pago de la deuda tributaria.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;5. Decomiso preventivo de mercancías, bienes y medios de transporte, en materia aduanera.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;6. Otras medidas permitidas por el Código de Procedimiento Civil.
                    <br> IV. Las medidas precautorias se aplicarán con liberación del pago de valores, derechos y almacenaje, que hubieran en los respectivos registros e instituciones públicas. Las medidas precautorias se aplicarán con diferimiento de pago en instituciones privadas.
                    <br> V. Si el pago de la deuda tributaria se realizara dentro de los plazos previstos en este Código o, si las circunstancias que justificaron la adopción de medidas precautorias desaparecieran, la Administración Tributaria procederá al levantamiento inmediato de las medidas precautorias adoptadas, no estando el contribuyente obligado a cubrir los gastos originados por estas diligencias.
                    <br> VI. El deudor podrá solicitar a la Administración Tributaria el cambio de una medida precautoria por otra que le resultara menos perjudicial, siempre que ésta garantice suficientemente el derecho del Fisco.
                    <br> VII. Las medidas precautorias adoptadas por la Administración Tributaria mantendrán su vigencia durante la sustanciación de los recursos administrativos previstos en el Título III de este Código, sin perjuicio de la facultad de la Administración Tributaria de levantarlas con arreglo a lo dispuesto en el parágrafo <br> VI. Asimismo, podrá adoptar cualquier otra medida establecida en este artículo que no hubiere adoptado.
                    <br> VIII. No se embargarán los bienes y derechos declarados inembargables por Ley.
                    <br> IX. En el decomiso de medios o unidades de transporte en materia aduanera, será admisible la sustitución de garantías por garantías reales equivalentes.
                    <br> X. El costo de mantenimiento y conservación de los bienes embargados o secuestrados estará a cargo del depositario conforme a lo dispuesto en los Códigos Civil y de Procedimiento Civil.

                    <h4>Sección VII: EJECUCIÓN TRIBUTARIA</h4>

                    <h4>Artículo 107</h4> (Naturaleza de la Ejecución Tributaria).
                    <br> I. La ejecución tributaria, incluso de los fallos firmes dictados en la vía judicial será exclusivamente administrativa, debiendo la Administración Tributaria conocer todos sus incidentes, conforme al procedimiento descrito en la presente sección.
                    <br> II. La ejecución tributaria no será acumulable a los procesos judiciales ni a otros procedimientos de ejecución. Su iniciación o continuación no se suspenderá por la iniciación de aquellos, salvo en los casos en que el ejecutado esté sometido a un proceso de reestructuración voluntaria.

                    <h4>Artículo 108</h4> (Títulos de Ejecución Tributaria).
                    <br> I. La ejecución tributaria se realizará por la Administración Tributaria con la notificación de los siguientes títulos:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Resolución Determinativa o Sancionatoria firmes, por el total de la deuda tributaria o sanción que imponen.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Autos de Multa firmes.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Resolución firme dictada para resolver el Recurso de Alzada.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;4. Resolución que se dicte para resolver el Recurso Jerárquico.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;5. Sentencia Judicial ejecutoriada por el total de la deuda tributaria que impone.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;6. Declaración Jurada presentada por el sujeto pasivo que determina la deuda tributaria, cuando ésta no ha sido pagada o ha sido pagada parcialmente, por el saldo deudor.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;7. Liquidación efectuada por la Administración, emergente de una determinación mixta, siempre que ésta refleje fielmente los datos aportados por el contribuyente, en caso que la misma no haya sido pagada, o haya sido pagada parcialmente.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;8. Resolución que concede planes de facilidades de pago, cuando los pagos han sido incumplidos total o parcialmente, por los saldos impagos.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. R<br> &nbsp;&nbsp;&nbsp;&nbsp;1. <br> &nbsp;&nbsp;&nbsp;&nbsp;9. Resolución administrativa firme que exija la restitución de lo indebidamente devuelto.
                    <br> II. El Ministerio de Hacienda queda facultado para establecer montos mínimos, a propuesta de la Administración Tributaria, a partir de los cuales ésta deba efectuar el inicio de su ejecución tributaria. En el caso de las Administraciones Tributarias Municipales, éstos montos serán fijados por la máxima autoridad ejecutiva.

                    <h4>Artículo 109</h4> (Suspensión y Oposición de la Ejecución Tributaria).
                    <br> I. La ejecución tributaria se suspenderá inmediatamente en los siguientes casos:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Autorización de un plan de facilidades de pago, conforme al Artículo 55 de este Código;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Si el sujeto pasivo o tercero responsable garantiza la deuda tributaria en la forma y condiciones que reglamentariamente se establezca.
                    <br> II. Contra la ejecución fiscal, sólo serán admisibles las siguientes causales de oposición.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Cualquier forma de extinción de la deuda tributaria prevista por este Código.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Resolución firme o sentencia con autoridad de cosa juzgada que declare la inexistencia de la deuda.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Dación en pago, conforme se disponga reglamentariamente.
                    Estas causales sólo serán válidas si se presentan antes de la conclusión de la fase de ejecución tributaria.

                    <h4>Artículo 110</h4> (Medidas Coactivas). La Administración Tributaria podrá, entre otras, ejecutar las siguientes medidas coactivas:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Intervención de la gestión del negocio del deudor, correspondiente a la deuda.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Prohibición de celebrar el deudor actos o contratos de transferencia o disposición sobre determinados bienes.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Retención de pagos que deban realizar terceros privados, en la cuantía estrictamente necesaria para asegurar el cobro de la deuda tributaria.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;4. Prohibición de participar en los procesos de adquisición de bienes y contratación de servicios en el marco de lo dispuesto por la Ley Nº 1178 de Administración y Control Gubernamental.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;5. Otras medidas previstas por Ley, relacionadas directamente con la ejecución de deudas.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;6. Clausura del o los establecimientos, locales, oficinas o almacenes del deudor hasta el pago total de la deuda tributaria. Esta medida sólo será ejecutada cuando la deuda tributaria no hubiera sido pagada con la aplicación de las anteriores y de acuerdo a lo establecido en el parágrafo IV del Artículo 164°.

                    <h4>Artículo 111</h4> (Remate).
                    <br> I. La enajenación de los bienes decomisados, incautados, secuestrados o embargados se ejecutará mediante acto de remate en subasta pública, concurso o adjudicación directa, en los casos, forma y condiciones que se fijen reglamentariamente.
                    <br> II. En cualquier momento anterior a la adjudicación de los bienes, se podrán librar los bienes embargados o secuestrados, pagando la deuda tributaria y los gastos incurridos.
                    <br> III. Queda prohibido adquirir los bienes que se enajenen, objeto de medidas precautorias o coactivas, por sí o mediante interpósita persona, a todos aquellos que hubieran intervenido en la ejecución tributaria y remate. Su infracción será sancionada con la nulidad de la adjudicación, sin perjuicio de las responsabilidades que se determinen.
                    <br> IV. El remate de bienes o mercancías objeto de medidas precautorias, coactivas o garantías, se realizará por la Administración Tributaria en forma directa o a través de terceros autorizados para este fin. El lugar, plazos y forma del remate se establecerá por la Administración Tributaria en función de procurar el mayor beneficio para el Estado.
                    <br> V. En materia aduanera la base del remate de mercancías será el valor CIF de importación rebajado en un cuarenta por ciento (40%), en el estado en que se encuentre, debiendo el adjudicatario asumir por cuenta propia el pago de los tributos aduaneros de importación aplicables para el despacho aduanero a consumo, acompañando el acta de adjudicación aprobada y cumplir con las demás formalidades para el despacho aduanero. Los tributos aduaneros se determinarán sobre el valor de la adjudicación.
                    <br> VI. El procedimiento de remate se sujetará a reglamentación específica.

                    <h4>Artículo 112</h4> (Tercerías Admisibles). En cualquier estado de la causa y hasta antes del remate, se podrán presentar tercerías de dominio excluyente y derecho preferente, siempre que en el primer caso, el derecho propietario este inscrito en los registros correspondientes o en el segundo, esté justificado con la presentación del respectivo título inscrito en el registro correspondiente.
                    En el remate de mercancías abandonadas, decomisadas o retenidas como prenda por la Administración Tributaria Aduanera no procederán las tercerías de dominio excluyente, pago preferente o coadyuvante.

                    <h4>Artículo 113</h4> (Procesos Concursales). Durante la etapa de ejecución tributaria no procederán los procesos concursales salvo en los casos de reestructuración voluntaria de empresas y concursos preventivos que se desarrollen conforme a Leyes especiales y el Código de Comercio, debiendo procederse, como cuando corresponda, al levantamiento de las medidas precautorias y coactivas que se hubieren adoptado a favor de la Administración Tributaria.

                    <h4>Artículo 114</h4> (Quiebra). El procedimiento de quiebra se sujetará a las disposiciones previstas en el Código de Comercio y leyes específicas.

                    <h4>Sección VIII: PROCEDIMIENTOS ESPECIALES</h4>

                    <h4>Subsección I: LA CONSULTA</h4>

                    <h4>Artículo 115</h4> (Legitimidad).
                    <br> I. Quien tuviera un interés personal y directo, podrá consultar sobre la aplicación y alcance de la disposición normativa correspondiente a una situación de hecho concreta, siempre que se trate de temas tributarios confusos y/o controvertibles.
                    <br> II. La consulta se formulará por escrito y deberá cumplir los requisitos que reglamentariamente se establezcan.
                    <br> III. Cuando la consulta no cumpla con los requisitos descritos en el respectivo reglamento, la Administración Tributaria no la admitirá, devolviéndola al consultante para que en el término de diez (10) días la complete; caso contrario la considerará no presentada.

                    <h4>Artículo 116</h4> (Presentación y Plazo de Respuesta).
                    <br> I. La consulta será presentada a la máxima autoridad ejecutiva de la Administración Tributaria, debiendo responderla dentro del plazo de treinta (30) días prorrogables a treinta (30) días más computables desde la fecha de su admisión, mediante resolución motivada. El incumplimiento del plazo fijado, hará responsables a los funcionarios encargados de la absolución de consultas.
                    <br> II. La presentación de la Consulta no suspende el transcurso de plazos ni justifica el incumplimiento de las obligaciones a cargo de los consultantes.

                    <h4>Artículo 117</h4> (Efecto Vinculante). La respuesta a la consulta tendrá efecto vinculante para la Administración Tributaria que la absolvió, únicamente sobre el caso concreto consultado, siempre y cuando no se hubieran alterado las circunstancias, antecedentes y demás datos que la motivaron. Si la Administración Tributaria cambiara de criterio, el efecto vinculante cesará a partir de la notificación con la resolución que revoque la respuesta a la consulta.

                    <h4>Artículo 118</h4> (Consultas Institucionales). Las respuestas a consultas formuladas por colegios profesionales, cámaras oficiales, organizaciones patronales y empresariales, sindicales o de carácter gremial, cuando se refieran a aspectos tributarios que conciernan a la generalidad de sus miembros o asociados, no tienen ningún efecto vinculante para la Administración Tributaria, constituyendo criterios meramente orientadores o simplemente informativos sobre la aplicación de normas tributarias.

                    <h4>Artículo 119</h4> (Improcedencia de Recursos). Contra la respuesta a la consulta no procede recurso alguno, sin perjuicio de la impugnación que pueda interponer el consultante contra el acto administrativo que aplique el criterio que responde a la Consulta.

                    <h4>Artículo 120</h4> (Nulidad de la Consulta). Será nula la respuesta a la Consulta cuando sea absuelta:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Sobre la base de datos, información y/o documentos falsos o inexactos proporcionados por el consultante.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Por manifiesta infracción de la Ley.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Por autoridades que no gozan de jurisdicción y competencia.

                    <h4>Subsección II: ACCIÓN DE REPETICIÓN</h4>

                    <h4>Artículo 121</h4> (Concepto). Acción de repetición es aquella que pueden utilizar los sujetos pasivos y/o directos interesados para reclamar a la Administración Tributaria la restitución de pagos indebidos o en exceso efectuados por cualquier concepto tributario.

                    <h4>Artículo 122</h4> (Del Procedimiento).
                    <br> I. El directo interesado que interponga la acción de repetición, deberá acompañar la documentación que la respalde; la Administración Tributaria verificará previamente si el solicitante tiene alguna deuda tributaria líquida y exigible, en cuyo caso procederá a la compensación de oficio, dando curso a la repetición sobre el saldo favorable al contribuyente, si lo hubiera.
                    Cuando proceda la repetición, la Administración Tributaria se pronunciará, dentro de los cuarenta y cinco (45) días posteriores a la solicitud, mediante resolución administrativa expresa rechazando o aceptando total o parcialmente la repetición solicitada y autorizando la emisión del instrumento de pago correspondiente que la haga efectiva.
                    <br> II. En el cálculo del monto a repetir se aplicará la variación de la Unidad de Fomento de la Vivienda publicada por el Banco Central de Bolivia producida entre el día del pago indebido o en exceso hasta la fecha de autorización de la emisión del instrumento de pago correspondiente.
                    <br> III. Lo pagado para satisfacer una obligación prescrita no puede ser objeto de repetición, aunque el pago se hubiera efectuado en desconocimiento de la prescripción operada.
                    <br> IV. Cuando se niegue la acción, el sujeto pasivo tiene expedita la vía de impugnación prevista en el Título III de este Código.

                    <h4>Artículo 123</h4> (Repetición Solicitada por Sustitutos). Los agentes de retención o percepción podrán solicitar la repetición de los tributos retenidos o percibidos indebidamente o en exceso y empozados al Fisco, siempre que hubiera Poder Notariado expreso del contribuyente.

                    <h4>Artículo 124</h4> (Prescripción de la Acción de Repetición).
                    <br> I. Prescribirá a los tres (3) años la acción de repetición para solicitar lo pagado indebidamente o en exceso.
                    <br> II. El término se computará a partir del momento en que se realizó el pago indebido o en exceso.
                    <br> III. En estos casos, el curso de la prescripción se suspende por las mismas causales, formas y plazos dispuestos por este Código.

                    <h4>Subsección III: DEVOLUCIÓN TRIBUTARIA</h4>

                    <h4>Artículo 125</h4> (Concepto). La devolución es el acto en virtud del cual el Estado por mandato de la Ley, restituye en forma parcial o total impuestos efectivamente pagados a determinados sujetos pasivos o terceros responsables que cumplan las condiciones establecidas en la Ley que dispone la devolución, la cual establecerá su forma, requisitos y plazos.

                    <h4>Artículo 126</h4> (Procedimiento).
                    <br> I. Las normas dictadas por el Poder Ejecutivo regularán las modalidades de devolución tributaria, estableciendo cuando sea necesario parámetros, coeficientes, indicadores u otros, cuyo objetivo será identificar la cuantía de los impuestos a devolver y el procedimiento aplicable, así como el tipo de garantías que respalden las devoluciones.
                    <br> II. La Administración Tributaria competente deberá revisar y evaluar los documentos pertinentes que sustentan la solicitud de devolución tributaria. Dicha revisión no es excluyente de las facultades que asisten a la Administración Tributaria para controlar, verificar, fiscalizar e investigar el comportamiento tributario del sujeto pasivo o tercero responsable, según las previsiones y plazos establecidos en el presente Código.
                    <br> III. La Administración Tributaria competente deberá previamente verificar si el solicitante tiene alguna deuda tributaria, en cuyo caso procederá a la compensación de oficio. De existir un saldo, la Administración Tributaria se pronunciará mediante resolución expresa devolviendo el saldo si éste fuera a favor del beneficiario.

                    <h4>Artículo 127</h4> (Ejecución de Garantía). Si la modalidad de devolución se hubiera sujetado a la presentación de una garantía por parte del solicitante, la misma podrá ser ejecutada sin mayor trámite a solo requerimiento de la Administración Tributaria, en la proporción de lo indebidamente devuelto, cuando ésta hubiera identificado el incumplimiento de las condiciones que justificaron la devolución, sin perjuicio de la impugnación que pudiera presentarse.

                    <h4>Subsección IV: RESTITUCIÓN</h4>

                    <h4>Artículo 128</h4> (Restitución de lo Indebidamente Devuelto). Cuando la Administración Tributaria hubiera comprobado que la devolución autorizada fue indebida o se originó en documentos falsos o que reflejen hechos inexistentes, emitirá una Resolución Administrativa consignando el monto indebidamente devuelto expresado en Unidades de Fomento de la Vivienda, cuyo cálculo se realizará desde el día en que se produjo la devolución indebida, para que en el término de veinte
                    (20) días, computables a partir de su notificación, el sujeto pasivo o tercero responsable pague o interponga los recursos establecidos en el presente Código, sin perjuicio que la Administración Tributaria ejercite las actuaciones necesarias para el procesamiento por el ilícito correspondiente.

                    <h4>Subsección V: CERTIFICACIONES</h4>

                    <h4>Artículo 129</h4> (Tramite). Cuando el sujeto pasivo o tercero responsable deba acreditar el cumplimiento de sus obligaciones formales tributarias, podrá solicitar un certificado a la Administración Tributaria, cuya autoridad competente deberá expedirlo en un plazo no mayor a quince (15) días, bajo responsabilidad funcionaria y conforme a lo que reglamentariamente se establezca.

                    </h3>TITULO III</h3>

                    <h4>IMPUGNACIÓN DE LOS ACTOS DE LA ADMINISTRACIÓN</h4>

                    <h4>CAPITULO I IMPUGNACIÓN DE NORMAS</h4>

                    <h4>Artículo 130</h4> (Impugnación de Normas Administrativas).
                    <br> I. Las normas administrativas que con alcance general dicte la Administración Tributaria en uso de las facultades que le reconoce este Código, respecto de tributos que se hallen a su cargo, podrán ser impugnadas en única instancia por asociaciones o entidades representativas o por personas naturales o jurídicas que carezcan de una entidad representativa, dentro de los veinte (20) días de publicadas, aplicando el procedimiento que se establece en el presente Capítulo.
                    <br> II. Dicha impugnación deberá presentarse debidamente fundamentada ante el Ministro de Hacienda. En el caso de los Gobiernos Municipales, la presentación será ante la máxima autoridad ejecutiva.
                    <br> III. La impugnación presentada no tendrá efectos suspensivos.
                    <br> IV. La autoridad que conozca de la impugnación deberá pronunciarse dentro de los cuarenta (40) días computables a partir de la presentación, bajo responsabilidad. La falta de pronunciamiento dentro del término, equivale a silencio administrativo negativo.
                    <br> V. El rechazo o negación del recurso agota el procedimiento en sede administrativa.
                    <br> VI. La Resolución que declare probada la impugnación, surtirá efectos para todos los sujetos pasivos y terceros responsables alcanzados por dichas normas, desde la fecha de su notificación o publicación.
                    <br> VII. Sin perjuicio de lo anterior, la Administración Tributaria podrá dictar normas generales que modifiquen o dejen sin efecto la Resolución impugnada.

                    <h4>CAPITULO II RECURSOS ADMINISTRATIVOS</h4>

                    <h4>Artículo 131</h4> (Recursos Admisibles). Contra los actos de la Administración Tributaria de alcance particular podrá interponerse Recurso de Alzada en los casos, forma y plazo que se establece en el presente Título. Contra la resolución que resuelve el Recurso de Alzada solamente cabe el Recurso Jerárquico, que se tramitará conforme al procedimiento que establece este Código.
                    Ambos recursos se interpondrán ante las autoridades competentes de la Superintendencia Tributaria que se crea por mandato de esta norma legal.
                    La interposición del Recurso de Alzada así como el del Jerárquico tienen efecto suspensivo.
                    La vía administrativa se agotará con la resolución que resuelva el Recurso Jerárquico, pudiendo acudir el contribuyente y/o tercero responsable a la impugnación judicial por la vía del proceso
                    contencioso administrativo ante la Sala competente de la Corte Suprema de Justicia.
                    La interposición del proceso contencioso administrativo, no inhibe la ejecución de la resolución dictada en el Recurso Jerárquico, salvo solicitud expresa de suspensión formulada a la Administración Tributaria por el contribuyente y/o responsable, presentada dentro del plazo perentorio de cinco (5) días siguientes a la notificación con la resolución que resuelve dicho recurso. La solicitud deberá contener además, el ofrecimiento de garantías suficientes y el compromiso de constituirlas dentro de los noventa (90) días siguientes.
                    Si el proceso fuera rechazado o si dentro de los noventa (90) días señalados, no se constituyeren las garantías ofrecidas, la Administración Tributaria procederá a la ejecución tributaria de la deuda impaga.

                    <h4>CAPÍTULO III SUPERINTENDENCIA TRIBUTARIA</h4>

                    <h4>Artículo 132</h4> (Creación, Objeto, Competencias y Naturaleza). Créase la Superintendencia Tributaria como parte del Poder Ejecutivo, bajo la tuición del Ministerio de Hacienda como órgano autárquico de derecho público, con autonomía de gestión administrativa, funcional, técnica y financiera, con jurisdicción y competencia en todo el territorio nacional.
                    La Superintendencia Tributaria tiene como objeto, conocer y resolver los recursos de alzada y jerárquico que se interpongan contra los actos definitivos de la Administración Tributaria.

                    <h4>Artículo 133</h4> (Recursos Financieros). Las actividades de la Superintendencia Tributaria se financiarán con:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Hasta uno (1) por ciento del total de las recaudaciones tributarias de dominio nacional percibidas en efectivo, que se debitará automáticamente, según se disponga mediante Resolución Suprema.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Otros ingresos que pudiera gestionar de fuentes nacionales o internacionales.

                    <h4>Artículo 134</h4> (Composición de la Superintendencia Tributaria). La Superintendencia Tributaria está compuesta por un Superintendente Tributario General con sede en la ciudad de La Paz y cuatro (4) Superintendentes Tributarios Regionales con sede en las capitales de los Departamentos de Chuquisaca, La Paz, Santa Cruz y Cochabamba.
                    También formarán parte de la Superintendencia Tributaria, los intendentes que, previa aprobación del Superintendente Tributario General, serán designados por el Superintendente Regional en las capitales de departamento donde no existan Superintendencias Regionales, los mismos que sólo ejercerán funciones técnicas y administrativas que garanticen el uso inmediato de los recursos previstos por este Código, sin tener facultad para resolverlos.
                    La estructura administrativa y el alcance de la competencia territorial de las Superintendencias Tributarias Regionales se establecerán por reglamento.

                    <h4>Artículo 135</h4> (Designación de los Superintendentes Tributarios). El Superintendente Tributario General y los Superintendentes Tributarios Regionales serán designados por el Presidente de la República de terna propuesta por dos tercios (2/3) de votos de los miembros presentes de la Honorable Cámara de Senadores, de acuerdo a los mecanismos establecidos por la señalada Cámara.
                    En caso de renuncia, fallecimiento o término del mandato del Superintendente General Tributario, se designará al interino mediante Resolución Suprema, conforme el inciso 16) del <h4>Artículo 96</h4>º de la Constitución Política del Estado, quién ejercerá funciones en tanto se designe al titular.

                    <h4>Artículo 136</h4> (Requisitos para ser Designado Superintendente Tributario). Para ser designado Superintendente Tributario General o Regional se requiere cumplir los siguientes requisitos:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Ser de nacionalidad boliviana.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Tener reconocida idoneidad en materia tributaria.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Tener como mínimo título universitario a nivel de licenciatura y diez (10) años de experiencia profesional. A estos efectos se tomará en cuenta el ejercicio de la cátedra, la investigación científica, títulos y grados académicos, cargos y funciones que denoten amplio conocimiento de la materia.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;4. No haber sido sancionado con pena privativa de libertad o destituido por procesos judiciales o administrativos con resolución ejecutoriada. Si dicha sanción fuese impuesta durante el ejercicio de sus funciones como Superintendente Tributario, por hechos ocurridos antes de su nombramiento, tal situación dará lugar a su inmediata remoción del cargo.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;5. No tener Pliego de Cargo ni Nota de Cargo ejecutoriado pendiente de pago en su contra.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;6. No tener relación de parentesco de consanguinidad hasta el cuarto grado, en línea directa o colateral, o de afinidad hasta el segundo grado inclusive, con el Presidente o Vicepresidente de la República, las máximas autoridades de la Administración Tributaria, o entre Superintendentes Tributarios.

                    <h4>Artículo 137</h4> (Incompatibilidades). Las funciones de los Superintendentes Tributarios, tanto General como Regionales, son incompatibles con el ejercicio de todo otro cargo público remunerado, con excepción de las funciones docentes universitarias y de las comisiones codificadoras. Son igualmente incompatibles con las funciones directivas de instituciones privadas, mercantiles, políticas y sindicales. La aceptación de cualquiera de estas funciones implica renuncia tácita a la función como Superintendente Tributario, quedando nulos sus actos a partir de dicha aceptación.

                    <h4>Artículo 138</h4> (Periodo de Funciones y Destitución de Superintendentes Tributarios). El Superintendente Tributario General desempeñará sus funciones por un período de siete (7) años y los Superintendentes Tributarios Regionales por un período de cinco (5) años, no pudiendo ser reelegidos sino pasado un tiempo igual al que hubiese ejercido su mandato.
                    Los Superintendentes Tributarios gozan de caso de corte conforme al numeral 6) del artículo 118 de la Constitución Política del Estado y serán destituidos de sus cargos únicamente con sentencia condenatoria ejecutoriada por delitos cometidos contra la función pública.

                    ARTICULO 139 (Atribuciones y Funciones del Superintendente Tributario General). El Superintendente Tributario General tiene las siguientes atribuciones y funciones:
                    &nbsp;&nbsp;&nbsp;&nbsp;a)Dirigir y representar a la Superintendencia Tributaria General.
                    &nbsp;&nbsp;&nbsp;&nbsp;b)Conocer y resolver, de manera fundamentada, los Recursos Jerárquicos contra las Resoluciones de los Superintendentes Tributarios Regionales, de acuerdo a reglamentación específica;
                    &nbsp;&nbsp;&nbsp;&nbsp;c)Conocer y resolver la Revisión Extraordinaria conforme a lo establecido en este Código.
                    &nbsp;&nbsp;&nbsp;&nbsp;d)Dirimir y resolver los conflictos de competencias que se susciten entre los Superintendentes Tributarios Regionales;
                    &nbsp;&nbsp;&nbsp;&nbsp;e)Formular las políticas de desarrollo y controlar el cumplimiento de los objetivos, planes y programas administrativos de la Superintendencia General y las Regionales;
                    &nbsp;&nbsp;&nbsp;&nbsp;f)Considerar y aprobar los proyectos de normas internas de la Superintendencia General y de las Superintendencias Regionales, así como dirigir y evaluar la gestión administrativa del órgano;
                    &nbsp;&nbsp;&nbsp;&nbsp;g)Suscribir contratos y convenios en nombre y representación de la Superintendencia Tributaria General para el desarrollo de sus actividades administrativas y técnicas;
                    &nbsp;&nbsp;&nbsp;&nbsp;h)Designar al personal técnico y administrativo de la Superintendencia Tributaria General y destituirlo conforme a las normas aplicables;
                    &nbsp;&nbsp;&nbsp;&nbsp;i)Aprobar y aplicar las políticas salariales y de recursos humanos de la Superintendencia Tributaria General y Regionales, en base a lo propuesto por las mismas, así como la estructura general administrativa del órgano;
                    &nbsp;&nbsp;&nbsp;&nbsp;j)Aprobar el presupuesto institucional de la Superintendencia Tributaria, a cuyo efecto considerará las propuestas presentadas por las Superintendencias Regionales, para su presentación al Ministerio de Hacienda y su incorporación al Presupuesto General de la Nación;
                    &nbsp;&nbsp;&nbsp;&nbsp;k)Administrar los recursos económicos y financieros de la Superintendencia Tributaria en el marco de las normas del Sistema Nacional de Administración Financiera y Control Gubernamental;
                    &nbsp;&nbsp;&nbsp;&nbsp;l)Mantener el Registro Público de la Superintendencia Tributaria, en el que se archivarán copias de las resoluciones que hubiera dictado resolviendo los Recursos Jerárquicos, así como copias de las resoluciones que los Superintendentes Tributarios Regionales dictaran para resolver los Recursos de Alzada;
                    &nbsp;&nbsp;&nbsp;&nbsp;m)Proponer al Poder Ejecutivo normas relacionadas con la Superintendencia Tributaria y cumplir las que éste dicte sobre la materia;
                    &nbsp;&nbsp;&nbsp;&nbsp;n)Adoptar las medidas administrativas y disciplinarias necesarias para que los Superintendentes Regionales cumplan sus funciones de acuerdo con la Ley, libres de influencias indebidas de cualquier origen;
                    &nbsp;&nbsp;&nbsp;&nbsp;o)Fiscalizar y emitir opinión sobre la eficiencia y eficacia de la gestión de las Superintendencias Regionales;
                    &nbsp;&nbsp;&nbsp;&nbsp;p)Adoptar medidas precautorias conforme lo dispuesto por este Código, previa solicitud de la Administración Tributaria;
                    &nbsp;&nbsp;&nbsp;&nbsp;q)Realizar los actos que sean necesarios para el cumplimiento de sus funciones.

                    <h4>Artículo 140</h4> (Atribuciones y Funciones de los Superintendentes Tributarios Regionales). Los Superintendentes Tributarios Regionales tienen las siguientes atribuciones y funciones:
                    &nbsp;&nbsp;&nbsp;&nbsp;a)Conocer y resolver, de manera fundamentada, los Recursos de Alzada contra los actos de la Administración Tributaria, de acuerdo al presente Código;
                    &nbsp;&nbsp;&nbsp;&nbsp;b)Admitir o rechazar los Recursos Jerárquicos contra las resoluciones que resuelvan los Recursos de Alzada y remitir a conocimiento del Superintendente Tributario General;
                    &nbsp;&nbsp;&nbsp;&nbsp;c)Remitir al Registro Público de la Superintendencia Tributaria General copias de las Resoluciones que hubieran dictado resolviendo los Recursos de Alzada;
                    &nbsp;&nbsp;&nbsp;&nbsp;d)Seleccionar, designar, evaluar, promover y remover al personal técnico y administrativo de la Superintendencia Tributaria Regional, conforme a su reglamento interno y al presupuesto que se le hubiera asignado;
                    &nbsp;&nbsp;&nbsp;&nbsp;e)Designar intendentes en las capitales de departamento en las que no hubiere Superintendencias Regionales, de acuerdo a sus necesidades y como parte de la estructura general;
                    &nbsp;&nbsp;&nbsp;&nbsp;f)Resolver los asuntos que sean puestos en su conocimiento por los intendentes;
                    &nbsp;&nbsp;&nbsp;&nbsp;g)Suscribir contratos y convenios en nombre y representación de la Superintendencia Regional para el desarrollo de sus actividades administrativas y técnicas;
                    &nbsp;&nbsp;&nbsp;&nbsp;h)Autorizar y/o adoptar medidas precautorias, previa solicitud formulada por la Administración Tributaria, conforme lo dispuesto por este Código;
                    &nbsp;&nbsp;&nbsp;&nbsp;i)Realizar los actos que sean necesarios para el cumplimiento de sus responsabilidades.
                    &nbsp;&nbsp;&nbsp;&nbsp;j)Ejercer simultáneamente suplencia de otro Superintendente Tributario Regional, cuando este hubiere muerto, renunciado, se hallare impedido o su mandato hubiera concluido. Dicha suplencia durará hasta la designación del sustituto.

                    <h4>Artículo 141</h4> (Organización). La organización, estructura y procedimientos administrativos internos aplicables por la Superintendencia General, serán aprobados mediante Resolución Suprema. En el caso de las Superintendencias Regionales, esta aprobación se realizará mediante Resolución Administrativa emitida por la Superintendencia General.

                    <h4>Artículo 142</h4> (Normas Aplicables). Los recursos administrativos se sustanciarán y resolverán con arreglo al procedimiento establecido en este Título y en la reglamentación que al efecto se dicte.

                    <h3>CAPITULO IV</h3>

                    <4>RECURSOS ANTE LAS SUPERINTENDENCIAS TRIBUTARIAS</4>

                    <h4>Artículo 143</h4> (Recurso de Alzada). El Recurso de Alzada será admisible sólo contra los siguientes actos definitivos:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Las resoluciones determinativas.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Las resoluciones sancionatorias.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Las resoluciones que denieguen solicitudes de exención, compensación, repetición o devolución de impuestos.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;4. Las resoluciones que exijan restitución de lo indebidamente devuelto en los casos de devoluciones impositivas.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;5. Los actos que declaren la responsabilidad de terceras personas en el pago de obligaciones tributarias en defecto o en lugar del sujeto pasivo.
                    Este Recurso deberá interponerse dentro del plazo perentorio de veinte (20) días improrrogables, computables a partir de la notificación con el acto a ser impugnado.

                    <h4>Artículo 144</h4> (Recurso Jerárquico). Quién considere que la resolución que resuelve el Recurso de Alzada lesione sus derechos, podrá interponer de manera fundamentada, Recurso Jerárquico ante el Superintendente Tributario Regional que resolvió el Recurso de Alzada, dentro del plazo de veinte (20) días improrrogables, computables a partir de la notificación con la respectiva Resolución. El Recurso Jerárquico será sustanciado por el Superintendente Tributario General conforme dispone el Artículo 139 inciso b) de este Código.

                    <h4>Artículo 145</h4> (Revisión Extraordinaria).

                    <br> I. Únicamente por medio de su máxima autoridad ejecutiva, la Administración Tributaria y las Superintendencias podrán revisar, de oficio o a instancia de parte, dentro del plazo de dos (2) años, sus actos administrativos firmes, en los siguientes supuestos:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Cuando exista error de identidad en las personas.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Cuando después de dictado el acto se recobren o descubran documentos decisivos detenidos por fuerza mayor o por obra de la parte a favor de la cual se hubiera dictado el acto, previa sentencia declarativa de estos hechos y ejecutoriada.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Cuando dichos actos tengan como base documentos declarados falsos por sentencia judicial ejecutoriada o bien cuando su falsedad se desconocía al momento de su dictado.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;4. Cuando dichos actos se hubieran dictado como consecuencia de prevaricato, cohecho, violencia u otra acción delictiva y se haya declarado así en sentencia judicial ejecutoriada.
                    <br> II. La resolución que se emita declarará la nulidad del acto revisado o su anulabilidad total o parcial.
                    <br> III. La declaratoria de nulidad o anulabilidad total o parcial del acto o resolución, cuando corresponda, deberá emitirse en un plazo máximo de sesenta (60) días a contar desde la presentación de la solicitud del interesado cuando sea a instancia de parte, en mérito a pruebas que la acrediten.
                    <br> IV. Ante la declaración de nulidad o anulabilidad total o parcial del acto o resolución, la Administración Tributaria o el Superintendente deberá emitir, según corresponda, un nuevo acto o resolución que corrija al anterior, procediendo contra este nuevo, los Recursos Administrativos previstos en este Título.

                    <h4>Artículo 146</h4> (Reglamentación). Los procedimientos de los Recursos de Alzada y Jerárquico se sujetarán a los plazos, términos, condiciones, requisitos y forma dispuestos por Decreto Supremo Reglamentario.

                    <h4>Artículo 147</h4> (Proceso Contencioso Administrativo). Conforme a la atribución Séptima del parágrafo I del Artículo 118º de la Constitución Política del Estado, el proceso contencioso administrativo contra la resolución que resuelva el Recurso Jerárquico será conocido por la Corte Suprema de Justicia sujetándose al trámite contenido en el Código de Procedimiento Civil y se resolverá por las siguientes causales:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Cuando la autoridad que emitió la resolución que resuelve el Recurso Jerárquico carezca de competencia en razón de la materia o del territorio.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Cuando en el trámite administrativo se hubiere omitido alguna formalidad esencial dispuesta por Ley.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Cuando la Resolución impugnada contenga violación, interpretación errónea o aplicación indebida de la Ley
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;4. Cuando la Resolución contuviere disposiciones contradictorias
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;5. Cuando en la apreciación de pruebas se hubiere incurrido en error de derecho o en error de hecho, debiendo en este último caso evidenciarse el error por documentos o actos auténticos que demostraren la equivocación manifiesta del Superintendente Tributario General.
                    Si el fallo judicial que resuelve el Proceso Contencioso Administrativo fuera favorable al demandante, la Administración Tributaria en ejecución de sentencia, reembolsará, dentro los veinte
                    (20) días siguientes al de su notificación, previa cuantificación del importe, el monto total pagado o el costo de la garantía aportada para suspender la ejecución de la deuda tributaria. Cuando la deuda tributaria sea declarada parcialmente improcedente, el reembolso alcanzará a la parte proporcional del pago realizado o del costo de la referida garantía.
                    Las cantidades reembolsadas serán actualizadas conforme al Artículo 47º de éste Código, aplicando la tasa de interés activa promedio para Unidades de Fomento de la Vivienda, desde la fecha en que se realizó el pago o se incurrió en el costo de la garantía, hasta la fecha en que se notificó a la Administración Tributaria con el fallo judicial firme. En caso de incumplirse el plazo para efectuar el reembolso, la tasa de interés se aplicará hasta el día en que efectivamente se realice el mismo.

                    <h3>TÍTULO IV ILÍCITOS TRIBUTARIOS</h3>

                    <h4>CAPÍTULO I DISPOSICIONES GENERALES</h4>

                    <h4>Artículo 148</h4> (Definición y Clasificación). Constituyen ilícitos tributarios las acciones u omisiones que violen normas tributarias materiales o formales, tipificadas y sancionadas en el presente Código y demás disposiciones normativas tributarias.
                    Los ilícitos tributarios se clasifican en contravenciones y delitos.

                    <h4>Artículo 149</h4> (Normativa Aplicable).
                    <br> I. El procedimiento para establecer y sancionar las contravenciones tributarias se rige sólo por las normas del presente Código, disposiciones normativas tributarias y subsidiariamente por la Ley de Procedimientos Administrativos.
                    <br> II. La investigación y juzgamiento de los delitos tributarios se rigen por las normas de este Código, por otras leyes tributarias, por el Código de Procedimiento Penal y el Código Penal en su parte general con las particularidades establecidas en la presente norma.

                    <h4>Artículo 150</h4> (Retroactividad). Las normas tributarias no tendrán carácter retroactivo, salvo aquellas que supriman ilícitos tributarios, establezcan sanciones más benignas o términos de prescripción más breves o de cualquier manera beneficien al sujeto pasivo o tercero responsable.

                    <h4>Artículo 151</h4> (Responsabilidad por Ilícitos Tributarios). Son responsables directos del ilícito tributario, las personas naturales o jurídicas que cometan las contravenciones o delitos previstos en este Código, disposiciones legales tributarias especiales o disposiciones reglamentarias.
                    De la comisión de contravenciones tributarias surge la responsabilidad por el pago de la deuda tributaria y/o por las sanciones que correspondan, las que serán establecidas conforme a los procedimientos del presente Código.
                    De la comisión de un delito tributario, que tiene carácter personal, surgen dos responsabilidades: una penal tributaria y otra civil.

                    <h4>Artículo 152</h4> (Responsabilidad Solidaria por Daño Económico). Si del resultado del ilícito tributario emerge daño económico en perjuicio del Estado, los servidores públicos y quienes hubieran participado en el mismo, así como los que se beneficien con su resultado, serán responsables solidarios e indivisibles para resarcir al Estado el daño ocasionado. A los efectos de este Código, los tributos omitidos y las sanciones emergentes del ilícito, constituyen parte principal del daño económico al Estado.

                    <h4>Artículo 153</h4> (Causales de Exclusión de Responsabilidad).
                    <br> I. Sólo son causales de exclusión de responsabilidad en materia tributaria las siguientes:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. La fuerza mayor;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. El error de tipo o error de prohibición, siempre que el sujeto pasivo o tercero responsable hubiera presentado una declaración veraz y completa antes de cualquier actuación de la Administración Tributaria;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. En los supuestos de decisión colectiva, el haber salvado el voto o no haber asistido a la reunión en que se tomó la decisión, siempre y cuando este hecho conste expresamente en el acta correspondiente;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;4. Las causales de exclusión en materia penal aduanera establecidas en Ley especial como eximentes de responsabilidad.
                    <br> II. Las causales de exclusión sólo liberan de la aplicación de sanciones y no así de los demás componentes de la deuda tributaria.
                    <br> III. Si el delito de Contrabando se cometiere en cualquier medio de transporte público de pasajeros, por uno o más de éstos y sin el concurso del transportador, no se aplicará a éste la sanción de comiso de dicho medio de transporte, siempre y cuando se trate de equipaje acompañado de un pasajero que viaje en el mismo medio de transporte, o de encomiendas debidamente manifestadas

                    <h4>Artículo 154</h4> (Prescripción, Interrupción y Suspensión).
                    <br> I. La acción administrativa para sancionar contravenciones tributarias prescribe, se suspende e interrumpe en forma similar a la obligación tributaria, esté o no unificado el procedimiento sancionatorio con el determinativo.
                    <br> II. La acción penal para sancionar delitos tributarios prescribe conforme a normas del Código de Procedimiento Penal.
                    <br> III. La acción para sancionar delitos tributarios se suspenderá durante la fase de determinación y prejudicialidad tributaria.
                    <br> IV. La acción administrativa para ejecutar sanciones prescribe a los dos (2) años.

                    <h4>Artículo 155</h4> (Agravantes). Constituyen agravantes de ilícitos tributarios las siguientes circunstancias:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. La reincidencia, cuando el autor hubiere sido sancionado por resolución administrativa firme o sentencia ejecutoriada por la comisión de un ilícito tributario del mismo tipo en un periódo de cinco
                    (5) años;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. La resistencia manifiesta a la acción de control, investigación o fiscalización de la Administración Tributaria;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. La insolvencia tributaria fraudulenta, cuando intencionalmente se provoca o agrava la insolvencia propia o ajena, frustrando en todo o en parte el cumplimiento de obligaciones tributarias;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;4. Los actos de violencia empleados para cometer el ilícito;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;5. El empleo de armas o explosivos;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;6. La participación de tres o más personas;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;7. El uso de bienes del Estado para la comisión del ilícito;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;8. El tráfico internacional ilegal de bienes que formen parte del patrimonio histórico, cultural, turístico, biológico, arqueológico, tecnológico, patente y científico de la Nación, así como de otros bienes cuya preservación esté regulada por disposiciones legales especiales;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;9. El empleo de personas inimputables o personas interpuestas;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;10. La participación de profesionales vinculados a la actividad tributaria, auxiliares de la función pública aduanera o de operadores de comercio exterior;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;11. Los actos que ponen en peligro la salud pública;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;12. La participación de funcionarios públicos.
                    Las agravantes mencionadas anteriormente para el caso de contravenciones determinarán que la multa sea incrementada en un treinta por ciento (30%) por cada una de ellas.
                    Tratándose de delitos tributarios, la pena privativa de libertad a aplicarse podrá incrementarse hasta en una mitad.

                    <h4>Artículo 156</h4> (Reducción de Sanciones).
                    Las sanciones pecuniarias establecidas en este Código para ilícitos tributarios, con excepción de los ilícitos de contrabando se reducirán conforme a los siguientes criterios:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. El pago de la deuda tributaria después de iniciada la fiscalización o efectuada cualquier notificación inicial o requerimiento de la Administración Tributaria y antes de la notificación con la, Resolución Determinativa o Sancionatoria determinará la reducción de la sanción aplicable en el ochenta (80%) por ciento.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. El pago de la deuda tributaria efectuado después de notificada la Resolución Determinativa o Sancionatoria y antes de la presentación del Recurso a la Superintendencia Tributaria Regional, determinará la reducción de la sanción en el sesenta (60%) por ciento.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. El pago de la deuda tributaria efectuado después de notificada la Resolución de la Superintendencia Tributaria Regional y antes de la presentación del recurso a la Superintendencia Tributaria Nacional, determinará la reducción de la sanción en el cuarenta (40%) por ciento.

                    <h4>Artículo 157</h4> (Arrepentimiento Eficaz). Cuando el sujeto pasivo o tercero responsable pague la totalidad de la deuda tributaria antes de cualquier actuación de la Administración Tributaria, quedará automáticamente extinguida la sanción pecuniaria por el ilícito tributario. Salvando aquellas provenientes de la falta de presentación de Declaraciones Juradas.
                    En el caso de delito de Contrabando, se extingue la sanción pecuniaria cuando antes del comiso se entregue voluntariamente a la Administración Tributaria la mercancía ilegalmente introducida al país.
                    En ambos casos se extingue la acción penal.

                    CAPÍTULO II CONTRAVENCIONES TRIBUTARIAS

                    <h4>Artículo 158</h4> (Responsabilidad por Actos y Hechos de Representantes y Terceros). Cuando el tercero responsable, un mandatario, representante, dependiente, administrador o encargado, incurriera en una contravención tributaria, sus representados serán responsables de las sanciones que correspondieran, previa comprobación, sin perjuicio del derecho de éstos a repetir contra aquellos.
                    Se entiende por dependiente al encargado, a cualquier título, del negocio o actividad comercial.

                    <h4>Artículo 159</h4> (Extinción de la Acción y Sanción). La potestad para ejercer la acción por contravenciones tributarias y ejecutar las sanciones se extingue por:
                    &nbsp;&nbsp;&nbsp;&nbsp;a)Muerte del autor, excepto cuando la sanción pecuniaria por contravención esté ejecutoriada y pueda ser pagada con el patrimonio del causante, no procede la extinción.
                    &nbsp;&nbsp;&nbsp;&nbsp;b)Pago total de la deuda tributaria y las sanciones que correspondan
                    &nbsp;&nbsp;&nbsp;&nbsp;c)Prescripción;
                    &nbsp;&nbsp;&nbsp;&nbsp;d)Condonación.

                    <h4>Artículo 160</h4> (Clasificación). Son contravenciones tributarias:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Omisión de inscripción en los registros tributarios;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. No emisión de factura, nota fiscal o documento equivalente;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Omisión de pago;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;4. Contrabando cuando se refiera al último párrafo del Artículo 181°;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;5. Incumplimiento de otros deberes formales;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;6. Las establecidas en leyes especiales;

                    <h4>Artículo 161</h4>°. (Clases de Sanciones). Cada conducta contraventora será sancionada de manera independiente, según corresponda con:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Multa;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Clausura;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Pérdida de concesiones, privilegios y prerrogativas tributarias;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;4. Prohibición de suscribir contratos con el Estado por el término de tres (3) meses a cinco (5) años. Esta sanción será comunicada a la Contraloría General de la República y a los Poderes del Estado que adquieran bienes y contraten servicios, para su efectiva aplicación bajo responsabilidad funcionaria;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;5. Comiso definitivo de las mercancías a favor del Estado;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;6. Suspensión temporal de actividades.

                    <h4>Artículo 162</h4> (Incumplimiento de Deberes Formales).
                    <br> I. El que de cualquier manera incumpla los deberes formales establecidos en el presente Código, disposiciones legales tributarias y demás disposiciones normativas reglamentarias, será sancionado con una multa que irá desde cincuenta Unidades de Fomento de la Vivienda (<br> &nbsp;&nbsp;&nbsp;&nbsp;50.- UFV's) a cinco mil Unidades de Fomento de la Vivienda (<br> &nbsp;&nbsp;&nbsp;&nbsp;5.000 UFV's). La sanción para cada una de las conductas contraventoras se establecerá en esos límites mediante norma reglamentaria.
                    <br> II. Darán lugar a la aplicación de sanciones en forma directa, prescindiendo del procedimiento sancionatorio previsto por este Código las siguientes contravenciones: 1) La falta de presentación de declaraciones juradas dentro de los plazos fijados por la Administración Tributaria; 2) La no emisión de factura, nota fiscal o documento equivalente verificada en operativos de control tributario; y, 3) Las contravenciones aduaneras previstas con sanción especial.

                    <h4>Artículo 163</h4> (Omisión de Inscripción en los Registros Tributarios).
                    <br> I. El que omitiera su inscripción en los registros tributarios correspondientes, se inscribiera o permaneciera en un régimen tributario distinto al que le corresponda y de cuyo resultado se produjeran beneficios o dispensas indebidas en perjuicio de la Administración Tributaria, será sancionado con la clausura del establecimiento hasta que regularice su inscripción y una multa de dos mil quinientas Unidades de Fomento de la Vivienda (<br> &nbsp;&nbsp;&nbsp;&nbsp;2.<br> &nbsp;&nbsp;&nbsp;&nbsp;500.- UFV's), sin perjuicio del derecho de la Administración Tributaria a inscribir de oficio, recategorizar, fiscalizar y determinar la deuda tributaria dentro del término de la prescripción.
                    <br> II. La inscripción voluntaria en los registros pertinentes o la corrección de la inscripción, previa a cualquier actuación de la Administración Tributaria, exime de la clausura y multa, pero en ningún caso del pago de la deuda tributaria.

                    <h4>Artículo 164</h4> (No Emisión de Factura, Nota Fiscal o Documento Equivalente).
                    <br> I. Quien en virtud de lo establecido en disposiciones normativas, esté obligado a la emisión de facturas, notas fiscales o documentos equivalentes y omita hacerlo, será sancionado con la clausura del establecimiento donde desarrolla la actividad gravada, sin perjuicio de la fiscalización y determinación de la deuda tributaria.
                    <br> II. La sanción será de seis (6) días continuos hasta un máximo de cuarenta y ocho (48) días atendiendo el grado de reincidencia del contraventor. La primera contravención será penada con el mínimo de la sanción y por cada reincidencia será agravada en el doble de la anterior hasta la sanción mayor, con este máximo se sancionará cualquier reincidencia posterior.
                    <br> III. Para efectos de cómputo en los casos de reincidencia, los establecimientos registrados a nombre de un mismo contribuyente, sea persona natural o jurídica, serán tratados como si fueran una sola entidad, debiéndose cumplir la clausura, solamente en el establecimiento donde se cometió la contravención.
                    <br> IV. Durante el período de clausura cesará totalmente la actividad comercial del establecimiento pasible a la misma, salvo la que fuera imprescindible para la conservación y custodia de los bienes depositados en su interior, o para la continuidad de los procesos de producción que no pudieran interrumpirse por razones inherentes a la naturaleza de los insumos y materias primas.

                    <h4>Artículo 165</h4> (Omisión de Pago). El que por acción u omisión no pague o pague de menos la deuda tributaria, no efectúe las retenciones a que está obligado u obtenga indebidamente beneficios y valores fiscales, será sancionado con el cien por ciento (100%) del monto calculado para la deuda tributaria.

                    <h3>CAPÍTULO III</h3>

                    <h4>PROCEDIMIENTO PARA SANCIONAR CONTRAVENCIONES TRIBUTARIAS</h4>

                    <h4>Artículo 166</h4> (Competencia). Es competente para calificar la conducta, imponer y ejecutar las sanciones por contravenciones, la Administración Tributaria acreedora de la deuda tributaria. Las sanciones se impondrán mediante Resolución Determinativa o Resolución Sancionatoria, salvando las sanciones que se impusieren en forma directa conforme a lo dispuesto por este Código.

                    <h4>Artículo 167</h4> (Denuncia de Particulares). En materia de contravenciones, cualquier persona podrá interponer denuncia escrita y formal ante la Administración Tributaria respectiva, la cual tendrá carácter reservado. El denunciante será responsable si presenta una denuncia falsa o calumniosa, haciéndose pasible a las sanciones correspondientes. Se levantará la reserva cuando la denuncia sea falsa o calumniosa.

                    <h4>Artículo 168</h4> (Sumario Contravencional).
                    <br> I. Siempre que la conducta contraventora no estuviera vinculada al procedimiento de determinación del tributo, el procesamiento administrativo de las contravenciones tributarias se hará por medio de un sumario, cuya instrucción dispondrá la autoridad competente de la Administración Tributaria mediante cargo en el que deberá constar claramente, el acto u omisión que se atribuye al responsable de la contravención. Al ordenarse las diligencias preliminares podrá disponerse reserva temporal de las actuaciones durante un plazo no mayor a quince (15) días. El cargo será notificado al presunto responsable de la contravención, a quien se concederá un plazo de veinte
                    (20) días para que formule por escrito su descargo y ofrezca todas las pruebas que hagan a su derecho.
                    <br> II. Transcurrido el plazo a que se refiere el parágrafo anterior, sin que se hayan aportado pruebas, o compulsadas las mismas, la Administración Tributaria deberá pronunciar resolución final del sumario en el plazo de los veinte (20) días siguientes. Dicha Resolución podrá ser recurrible en la forma y plazos dispuestos en el Título III de este Código.
                    <br> III. Cuando la contravención sea establecida en acta, ésta suplirá al auto inicial de sumario contravencional, en la misma deberá indicarse el plazo para presentar descargos y vencido éste, se emitirá la resolución final del sumario.
                    <br> IV. En casos de denuncias, la Administración Tributaria podrá verificar el correcto cumplimiento de las obligaciones del sujeto pasivo o tercero responsable, utilizando el procedimiento establecido en el presente artículo, reduciéndose los plazos a la mitad.

                    <h4>Artículo 169</h4> (Unificación de Procedimientos).
                    <br> I. La Vista de Cargo hará las veces de auto inicial de sumario contravencional y de apertura de término de prueba y la Resolución Determinativa se asimilará a una Resolución Sancionatoria. Por tanto, cuando el sujeto pasivo o tercero responsable no hubiera pagado o hubiera pagado, en todo o en parte, la deuda tributaria después de notificado con la Vista de Cargo, igualmente se dictará Resolución Determinativa que establezca la existencia o inexistencia de la deuda tributaria e imponga la sanción por contravención.
                    <br> II. Si la deuda tributaria hubiera sido pagada totalmente, antes de la emisión de la Vista de Cargo, la Administración Tributaria deberá dictar una Resolución Determinativa que establezca la inexistencia de la deuda tributaria y disponga el inicio de sumario contravencional.

                    <h4>Artículo 170</h4> (Procedimiento de Control Tributario). La Administración Tributaria podrá de oficio verificar el correcto cumplimiento de la obligación de emisión de factura, nota fiscal o documento equivalente mediante operativos de control. Cuando advierta la comisión de esta contravención tributaria, los funcionarios de la Administración Tributaria actuante deberán elaborar un acta donde se identifique la misma, se especifiquen los datos del sujeto pasivo o tercero responsable, los funcionarios actuantes y un testigo de actuación, quienes deberán firmar el acta, caso contrario se dejará expresa constancia de la negativa a esta actuación. Concluida la misma, procederá la clausura inmediata del negocio por tres (3) días continuos.
                    El sujeto pasivo podrá converitir la sanción de clausura por el pago inmediato de una multa equivalente a diez (10) veces el monto de lo no facturado, siempre que sea la primera vez. En adelante no se aplicará la convertibilidad.
                    Tratándose de servicios de salud, educación y hotelería la convertibilidad podrá aplicarse más de una vez.
                    Ante al imposibilidad física de aplicar la sanción de clausura se procedera al decomiso temporal de las mercancías por los plazos previstos para dicha sanción, debiendo el sujeto pasivo o tercero responsable cubrir los gastos.
                    La sanción de clausura no exime al sujeto pasivo del cumplimiento de las obligaciones tributarias, sociales y laborales correspondientes.

                    <h3>CAPITULO IV DELITOS TRIBUTARIOS</h3>

                    <h4>Artículo 171</h4> (Responsabilidad). De la comisión de un delito tributario surgen dos responsabilidades: una penal tributaria para la investigación del hecho, su juzgamiento y la imposición de las penas o medida de seguridad correspondientes; y una responsabilidad civil para la reparación de los daños y perjuicios emergentes.
                    La responsabilidad civil comprende el pago del tributo omitido, su actualización e intereses cuando no se hubieran pagado en la etapa de determinación o de prejudicialidad, así como los gastos administrativos y judiciales incurridos.
                    La acción civil podrá ser ejercida en proceso penal tributario contra el autor y los participes del delito y en su caso contra el civilmente responsable.

                    <h4>Artículo 172</h4> (Responsable Civil). Son civilmente responsables a los efectos de este Código:
                    &nbsp;&nbsp;&nbsp;&nbsp;a)Las personas jurídicas o entidades, tengan o no personalidad jurídica, en cuyo nombre o representación hubieren actuado los partícipes del delito.
                    &nbsp;&nbsp;&nbsp;&nbsp;b)Los representantes, directores, gerentes, administradores, mandatarios, síndicos o las personas naturales o jurídicas que se hubieren beneficiado con el ilícito tributario.
                    Los civilmente responsables responderán solidaria e indivisiblemente de los daños causados al Estado.

                    <h4>Artículo 173</h4> (Extinción de la Acción). Salvo en el delito de Contrabando, la acción penal en delitos tributarios se extingue conforme a lo establecido en el artículo 27 del Código de Procedimiento Penal. A este efecto, se entiende por reparación integral del daño causado el pago del total de la deuda tributaria más el cien por ciento (100%) de la multa correspondiente, siempre que lo admita la Administración Tributaria en calidad de víctima.

                    <h4>Artículo 174</h4> (Efectos del Acto Firme o Resolución Judicial Ejecutoriada). El acto administrativo firme emergente de la fase de determinación o de prejudicialidad, que incluye la resolución judicial ejecutoriada emergente de proceso contencioso administrativo producirá efecto de cosa juzgada en el proceso penal tributario en cuanto a la determinación de la cuantía de la deuda tributaria.
                    La sentencia que se dicte en proceso penal tributario no afectará la cuantía de la deuda tributaria así determinada.

                    <h4>Artículo 175</h4> (Clasificación). Son delitos tributarios:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Defraudación tributaria;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Defraudación aduanera;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Instigación pública a no pagar tributos;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;4. Violación de precintos y otros controles tributarios;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;5. Contrabando;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;6. Otros delitos aduaneros tipificados en leyes especiales.

                    <h4>Artículo 176</h4>°(Penas). Los delitos tributarios serán sancionados con las siguientes penas, independientemente de las sanciones que por contravenciones correspondan:
                    <br> I. Pena Principal: Privación de libertad.
                    <br> II. Penas Accesorias:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Multa;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Comiso de las mercancías y medios o unidades de transporte;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Inhabilitación especial:
                    &nbsp;&nbsp;&nbsp;&nbsp;a)Inhabilitación para ejercer directa o indirectamente actividades relacionadas con operaciones aduaneras y de comercio de importación y exportación por el tiempo de uno (1) a cinco (5) años.
                    &nbsp;&nbsp;&nbsp;&nbsp;b)Inhabilitación para el ejercicio del comercio, por el tiempo de uno a tres años.
                    &nbsp;&nbsp;&nbsp;&nbsp;c)Pérdida de concesiones, beneficios, exenciones y prerrogativas tributarias que gocen las personas naturales o jurídicas.

                    <h4>Artículo 177</h4> (Defraudación Tributaria).
                    El que dolosamente, en perjuicio del derecho de la Administración Tributaria a percibir tributos, por acción u omisión disminuya o no pague la deuda tributaria, no efectúe las retenciones a que está obligado u obtenga indebidamente beneficios y valores fiscales, cuya cuantía sea mayor o igual a UFV's <br> &nbsp;&nbsp;&nbsp;&nbsp;10.000 Diez Mil Unidades de Fomento de la Vivienda), será sancionado con la pena privativa de libertad de tres (3) a seis (6) años y una multa equivalente al cien por ciento (100%) de la deuda tributaria establecida en el procedimiento de determinación o de prejudicialidad. Estas penas serán establecidas sin perjuicio de imponer inhabilitación especial. En el caso de tributos de carácter municipal y liquidación anual, la cuantía deberá ser mayor a UFV's <br> &nbsp;&nbsp;&nbsp;&nbsp;10.000 (Diez Mil Unidades de Fomento de la Vivienda) por cada periodo impositivo,
                    A efecto de determinar la cuantía señalada, si se trata de tributos de declaración anual, el importe de lo defraudado se referirá a cada uno de los doce (12) meses del año natural (UFV's <br> &nbsp;&nbsp;&nbsp;&nbsp;120.000). En otros supuestos, la cuantía se entenderá referida a cada uno de los conceptos por los que un hecho imponible sea susceptible de liquidación.

                    <h4>Artículo 178</h4> (Defraudación Aduanera).
                    Comete delito de defraudación aduanera, el que dolosamente perjudique el derecho de la Administración Tributaria a percibir tributos a través de las conductas que se detallan, siempre y cuando la cuantía sea mayor o igual a <br> &nbsp;&nbsp;&nbsp;&nbsp;50.<br> &nbsp;&nbsp;&nbsp;&nbsp;000.- UFV's (Cincuenta mil Unidades de Fomento de la Vivienda) del valor de los tributos omitidos por cada operación de despacho aduanero.
                    &nbsp;&nbsp;&nbsp;&nbsp;a)Realice una descripción falsa en las declaraciones de mercancías cuyo contenido sea redactado por cualquier medio;
                    &nbsp;&nbsp;&nbsp;&nbsp;b)Realice una operación aduanera declarando cantidad, calidad, valor, peso u origen diferente de las mercancías objeto del despacho aduanero;
                    &nbsp;&nbsp;&nbsp;&nbsp;c)Induzca en error a la Administración Tributaria, de los cuales resulte un pago incorrecto de los tributos de importación;
                    &nbsp;&nbsp;&nbsp;&nbsp;d)Utilice o invoque indebidamente documentos relativos a inmunidades, privilegios o concesión de exenciones;
                    El delito será sancionado con la pena privativa de libertad de tres (3) a seis (6) años y una multa equivalente al cien por ciento (100%) de la deuda tributaria establecida en el procedimiento de determinación o de prejudicialidad.
                    Estas penas serán establecidas sin perjuicio de imponer inhabilitación especial.

                    <h4>Artículo 179</h4> (Instigación Pública a no Pagar Tributos). El que instigue públicamente a través de acciones de hecho, amenazas o maniobras a no pagar, rehusar, resistir o demorar el pago de tributos será sancionado con pena privativa de libertad de tres (3) a seis (6) años y multa de <br> &nbsp;&nbsp;&nbsp;&nbsp;10.000 UFV's (Diez mil Unidades de Fomento de la Vivienda).

                    <h4>Artículo 180</h4> (Violación de Precintos y Otros Controles Tributarios). El que para continuar su actividad o evitar controles sobre la misma, violara, rompiera o destruyera precintos y demás medios de control o instrumentos de medición o de seguridad establecidos mediante norma previa por la Administración Tributaria respectiva, utilizados para el cumplimiento de clausuras o para la correcta liquidación, verificación, fiscalización, determinación o cobro del tributo, será sancionado con pena privativa de libertad de tres (3) a cinco (5) años y multa de <br> &nbsp;&nbsp;&nbsp;&nbsp;6.000 UFV's (seis mil Unidades de Fomento de la Vivienda).
                    En el caso de daño o destrucción de instrumentos de medición, el sujeto pasivo deberá además reponer los mismos o pagar el monto equivalente, costos de instalación y funcionamiento.

                    <h4>Artículo 181</h4> (Contrabando). Comete contrabando el que incurra en alguna de las conductas descritas a continuación:

                    &nbsp;&nbsp;&nbsp;&nbsp;a)Introducir o extraer mercancías a territorio aduanero nacional en forma clandestina o por rutas u horarios no habilitados, eludiendo el control aduanero. Será considerado también autor del delito el consignatario o propietario de dicha mercancía.
                    &nbsp;&nbsp;&nbsp;&nbsp;b)Realizar tráfico de mercancías sin la documentación legal o infringiendo los requisitos esenciales exigidos por normas aduaneras o por disposiciones especiales.
                    &nbsp;&nbsp;&nbsp;&nbsp;c)Realizar transbordo de mercancías sin autorización previa de la Administración Tributaria, salvo fuerza mayor comunicada en el día a la Administración Tributaria más próxima.
                    &nbsp;&nbsp;&nbsp;&nbsp;d)El transportador, que descargue o entregue mercancías en lugares distintos a la aduana, sin autorización previa de la Administración Tributaria.
                    &nbsp;&nbsp;&nbsp;&nbsp;e)El que retire o permita retirar de la zona primaria mercancías no comprendidas en la Declaración de Mercancías que ampare el régimen aduanero al que debieran ser sometidas.
                    &nbsp;&nbsp;&nbsp;&nbsp;f)El que introduzca, extraiga del territorio aduanero nacional, se encuentre en posesión o comercialice mercancías cuya importación o exportación, según sea el caso, se encuentre prohibida.
                    &nbsp;&nbsp;&nbsp;&nbsp;g)La tenencia o comercialización de mercancías extranjeras sin que previamente hubieren sido sometidas a un régimen aduanero que lo permita.
                    El contrabando no quedará desvirtuado aunque las mercancías no estén gravadas con el pago de tributos aduaneros.
                    Las sanciones aplicables en sentencia por el Tribunal de Sentencia en materia tributaria, son:
                    <br> I. Privación de libertad de tres (3) a seis (6) años, cuando el valor de los tributos omitidos de la mercancía decomisada sea superior a UFV's <br> &nbsp;&nbsp;&nbsp;&nbsp;10.000 (Diez Mil Unidades de Fomento de la Vivienda).
                    <br> II. Comiso de mercancías. Cuando las mercancías no puedan ser objeto de comiso, la sanción económica consistirá en el pago de una multa igual a cien por ciento (100%) del valor de las mercancías objeto de contrabando.
                    <br> III. Comiso de los medios o unidades de transporte o cualquier otro instrumento que hubiera servido para el contrabando, excepto de aquellos sobre los cuales el Estado tenga participación, en cuyo caso los servidores públicos estarán sujetos a la responsabilidad penal establecida en la presente Ley, sin perjuicio de las responsabilidades de la Ley <br> &nbsp;&nbsp;&nbsp;&nbsp;1178. Cuando el valor de los tributos omitidos de la mercancía sea igual o menor a UFV's <br> &nbsp;&nbsp;&nbsp;&nbsp;10.000 (Diez Mil Unidades de Fomento de la Vivienda), se aplicará la multa del cincuenta por ciento (50%) del valor de la mercancía en sustitución del comiso del medio o unidad de transporte.
                    Cuando las empresas de transporte aéreo o férreo autorizadas por la Administración Tributaria para el transporte de carga utilicen sus medios y unidades de transporte para cometer delito de Contrabando, se aplicará al transportador internacional una multa equivalente al cien por ciento (100%) del valor de la mercancía decomisada en sustitución de la sanción de comiso del medio de transporte. Si la unidad o medio de transporte no tuviere autorización de la Administración Tributaria para transporte internacional de carga o fuere objeto de contrabando, se le aplicará la sanción de comiso definitivo.
                    <br> IV. Se aplicará la sanción accesoria de inhabilitación especial, sólo en los casos de contrabando sancionados con pena privativa de libertad.
                    Cuando el valor de los tributos omitidos de la mercancía objeto de contrabando, sea igual o menor a UFV's <br> &nbsp;&nbsp;&nbsp;&nbsp;10.000 (Diez Mil Unidades de Fomento de la Vivienda), la conducta se considerará contravención tributaria debiendo aplicarse el procedimiento establecido en el Capítulo III del Título IV del presente Código.

                    <h3>CAPÍTULO V PROCEDIMIENTO PENAL TRIBUTARIO</h3>

                    <h4>Sección I: DISPOSICIONES GENERALES</h4>

                    <h4>Artículo 182</h4> (Normativa Aplicable). La tramitación de procesos penales por delitos tributarios se regirá por las normas establecidas en el Código de Procedimiento Penal, con las salvedades dispuestas en el presente Código.

                    Sección II: ESPECIFICIDADES EN EL PROCESO PENAL TRIBUTARIO

                    <h4>Artículo 183</h4> (Acción Penal por Delitos Tributarios). La acción penal tributaria es de orden público y será ejercida de oficio por el Ministerio Público, con la participación que este Código reconoce a la Administración Tributaria acreedora de la deuda tributaria en calidad de víctima, que podrá constituirse en querellante. El ejercicio de la acción penal tributaria no se podrá suspender, interrumpir ni hacer cesar, salvo los casos previstos en el Código de Procedimiento Penal.

                    <h4>Artículo 184</h4> (Jurisdicción Penal Tributaria). En cumplimiento de lo establecido en el artículo 43 del Código de Procedimiento Penal, los Tribunales de Sentencia en Materia Tributaria estarán compuestos por dos jueces técnicos especializados en materia tributaria y tres jueces ciudadanos. Tanto los Tribunales de Sentencia en Materia Tributaria como los Jueces de Instrucción en materia penal tributaria tendrán competencia departamental y asiento judicial en las capitales de departamento.

                    <h4>Artículo 185</h4> (Dirección y Órgano Técnico de Investigación). El Ministerio Público dirigirá la investigación de los delitos tributarios y promoverá la acción penal tributaria ante los órganos jurisdiccionales, con el auxilio de equipos multidisciplinarios de investigación de la Administración Tributaria, de acuerdo con las atribuciones, funciones y responsabilidades establecidas en el presente Código, el Código de Procedimiento Penal y la Ley Orgánica del Ministerio Público.
                    Los equipos multidisciplinarios de investigación de la Administración Tributaria son el órgano técnico de investigación de los ilícitos tributarios, actuarán directamente o bajo dirección del Ministerio Público.
                    La Administración Tributaria para el cumplimiento de sus funciones podrá solicitar la colaboración de la Policía Nacional y del Instituto de Investigaciones Forenses.

                    <h4>Artículo 186</h4> (Acción Preventiva).
                    <br> I. Cuando la Administración Tributaria Aduanera tenga conocimiento, por cualquier medio, de la comisión del delito de contrabando o de otro delito tributario aduanero, procederá directamente o bajo la dirección del fiscal al arresto de los presentes en el lugar del hecho, a la aprehensión de los presuntos autores o participes y al comiso preventivo de las mercancías, medios e instrumentos del delito, acumulará y asegurará las pruebas, ejecutará las diligencias y actuaciones que serán dispuestas por el fiscal que dirija la investigación, así como ejercerá amplias facultades de investigación en la acción preventiva y durante la etapa preparatoria, pudiendo al efecto requerir el auxilio de la fuerza pública.
                    Cuando el fiscal no hubiere participado en el operativo, las personas aprehendidas serán puestas a su disposición dentro las ocho horas siguientes, asimismo se le comunicará sobre las mercancías, medios y unidades de transporte decomisados preventivamente, para que asuma la dirección funcional de la investigación y solicite al Juez de la Instrucción en lo Penal la medida cautelar que corresponda.
                    Cuando la aprehensión se realice en lugares distantes a la sede del fiscal o de la autoridad jurisdiccional competente, para el cómputo de los plazos se aplicará el término de la distancia previsto en el Código de Procedimiento Civil.
                    En el caso de otras Administraciones Tributarias, la acción preventiva sólo se ejercitará cuando el delito sea flagrante.
                    <br> II. Cuando en la etapa de la investigación existan elementos de juicio que hagan presumir la fuga del o de los imputados y si las medidas cautelares que se adopten no garantizaran la presencia de éstos en la investigación o juicio penal, el Ministerio Público o la Administración Tributaria solicitarán a la autoridad judicial competente la detención preventiva del o los imputados, con auxilio de la fuerza pública, sin que aquello implique prejuzgamiento.

                    <h4>Artículo 187</h4>°(Acta de Intervención en Delitos Tributarios Aduaneros). La Administración Tributaria Aduanera documentará su intervención en un acta en la que constará:
                    &nbsp;&nbsp;&nbsp;&nbsp;a)La identificación de la autoridad administrativa que efectuó la intervención y del Fiscal, si intervino.
                    &nbsp;&nbsp;&nbsp;&nbsp;b)Una relación circunstanciada de los hechos, con especificación de tiempo y lugar.
                    &nbsp;&nbsp;&nbsp;&nbsp;c)La identificación de las personas aprehendidas; de las sindicadas como autores, cómplices o encubridores del delito aduanero si fuera posible.
                    &nbsp;&nbsp;&nbsp;&nbsp;d)La identificación de los elementos de prueba asegurados y, en su caso, de los medios empleados para la comisión del delito.
                    &nbsp;&nbsp;&nbsp;&nbsp;e)El detalle de la mercancía decomisada y de los instrumentos incautados.
                    &nbsp;&nbsp;&nbsp;&nbsp;f)Otros antecedentes, elementos y medios que sean pertinentes.
                    En el plazo de 48 horas, la Administración Tributaria Aduanera y el Fiscal, informarán al Juez competente respecto a las mercancías, medios y unidades de transporte decomisados y las personas aprehendidas, sin que ello signifique comprometer la imparcialidad de la autoridad jurisdiccional.

                    <h4>Artículo 188</h4> (Medidas Cautelares). Las medidas cautelares de carácter personal se sujetarán a las disposiciones y reglas del Código de Procedimiento Penal.
                    Se podrán aplicar las siguientes medidas cautelares de carácter real:
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Decomiso preventivo de las mercancías, medios de transporte e instrumentos utilizados en la comisión del delito o vinculados al objeto del tributo, que forma parte de la deuda tributaria en ejecución;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Retención de valores por devoluciones tributarias o de otros pagos que deba realizar el Estado y terceros privados, en la cuantía necesaria para asegurar el cobro de la deuda tributaria;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;3. Anotación preventiva en los registros públicos sobre los bienes, derechos y acciones de los responsables o participes del delito tributario y del civilmente responsable;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;4. Embargo de los bienes del imputado;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;5. Retención de depósitos de dinero o valores efectuados en entidades del sistema de intermediación financiera;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;6. Secuestro de los bienes del imputado;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;7. Intervención de la gestión del negocio del imputado, correspondiente a la deuda tributaria;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;8. Clausura del o los establecimientos o locales del deudor hasta el pago total de la deuda tributaria;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;9. Prohibición de celebrar actos o contratos de transferencia o disposición sobre bienes determinados;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;10. Hipoteca legal;
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;11. Renovación de garantía si hubiera, por el tiempo aproximado que dure el proceso, bajo alternativa de ejecución de la misma.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;12. Otras dispuestas por Ley.
                    Las medidas cautelares se aplicarán con liberación del pago de valores, derechos y almacenaje que hubieran en los respectivos registros e instituciones públicas, y con diferimiento de pago en el caso de instituciones privadas.

                    <h4>Artículo 189</h4> (Conciliación). Procederá la conciliación en materia penal tributaria de acuerdo a lo previsto en el Código de Procedimiento Penal y la Ley Orgánica del Ministerio Público.
                    En el delito de Contrabando procederá la conciliación si el imputado renuncia a las mercancías y acepta su comiso definitivo y remate a favor de la Administración Tributaria previo pago de la Obligación de Pago en Aduanas. En caso de no haberse incautado las mercancías, la conciliación procederá previo pago del monto equivalente al 100% de su valor. Con relación al medio de transporte, procederá la conciliación si el transportador previamente paga la multa equivalente al 50% del valor de la mercancía en sustitución al comiso del medio o unidad de transporte, salvo lo dispuesto en convenios internacionales suscritos por el Estado.
                    En los delitos de defraudación tributaria o defraudación aduanera procederá la conciliación si el imputado previamente paga la deuda tributaria y la multa establecida para el delito correspondiente.
                    La Administración Tributaria participará en la audiencia de conciliación en calidad de víctima.

                    <h4>Artículo 190</h4> (Suspensión Condicional del Proceso). En materia penal tributaria procederá la suspensión condicional del proceso en los términos establecidos en el Código de Procedimiento Penal con las siguientes particularidades:

                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Para los delitos de defraudación tributaria, defraudación aduanera o falsificación de documentos aduaneros, se entenderá por reparación integral del daño ocasionado, el pago de la deuda tributaria y la multa establecida para el delito correspondiente.
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Para los delitos de contrabando o sustracción de prenda aduanera, se entenderá por reparación del daño ocasionado la renuncia en favor de la Administración Tributaria de la totalidad de la mercancía de contrabando o sustraída; en caso de no haberse decomisado la mercancía el pago del cien por ciento (100%) de su valor. Con relación al medio de transporte utilizado, el pago por parte del transportador del cincuenta por ciento (50%) del valor de la mercancía en sustitución del comiso del medio o unidad de transporte, salvo lo dispuesto en convenios internacionales suscritos por el Estado.

                    <h4>Artículo 191</h4> (Contenido de la Sentencia Condenatoria). Cuando la sentencia sea condenatoria, el Tribunal de Sentencia impondrá, cuando corresponda:
                    &nbsp;&nbsp;&nbsp;&nbsp;a)La privación de libertad.
                    &nbsp;&nbsp;&nbsp;&nbsp;b)El comiso definitivo de las mercancías a favor del Estado, cuando corresponda.
                    &nbsp;&nbsp;&nbsp;&nbsp;c)El comiso definitivo de los medios y unidades de transporte, cuando corresponda.
                    &nbsp;&nbsp;&nbsp;&nbsp;d)La multa.
                    &nbsp;&nbsp;&nbsp;&nbsp;e)Otras sanciones accesorias.
                    &nbsp;&nbsp;&nbsp;&nbsp;f)La obligación de pagar en suma líquida y exigible la deuda tributaria.
                    &nbsp;&nbsp;&nbsp;&nbsp;g)El resarcimiento de los daños civiles ocasionados a la Administración Tributaria por el uso de depósitos aduaneros y otros gastos, así como las costas judiciales.
                    Las medidas cautelares reales se mantendrán subsistentes hasta el resarcimiento de los tributos y los daños civiles calificados.

                    <h4>Artículo 192</h4> (Remate y Administración de Bienes). Cuando las medidas cautelares de carácter real recayeren sobre mercancías de difícil conservación, acelerada depreciación tecnológica, o desactualización por moda o temporada, consumibles o perecederas, en la etapa preparatoria o de juicio, el Juez Instructor o el Tribunal de Sentencia en materia tributaria, respectivamente, a petición de parte deberán disponer su venta inmediata en subasta pública dentro las veinticuatro (24) horas aún sin consentimiento del propietario.
                    Respecto a las demás mercancías, transcurrido noventa (90) días sin que exista sentencia ejecutoriada, a fin de evitar una depreciación mayor del valor de las mercancías por el transcurso del tiempo, el Juez de Instrucción, el Tribunal de Sentencia Tributario o el Tribunal de Alzada correspondiente, deberá disponer su venta inmediata en subasta pública a pedido de parte.
                    Con el producto del remate, depósitos retenidos o recursos resultantes de la ejecución de garantías, se resarcirá la deuda tributaria, a este efecto dicho producto será depositado en cuentas fiscales.
                    Cuando el Estado no haya sido resarcido totalmente, el Tribunal de Sentencia ampliará el embargo contra los bienes del deudor.
                    El procedimiento de registro, administración y control de bienes sujetos a comiso, embargo, secuestro o incautación en materia tributaria y aduanera corresponderá a la Administración Tributaria competente, con las mismas obligaciones y atribuciones señaladas por el Código de Procedimiento Penal para la Dirección de Registro, Control y Administración de Bienes Incautados, con las salvedades establecidas en el presente Código.
                    La forma, requisitos, condiciones, plazo del remate, administración de bienes y distribución del producto del remate, será determinado por Reglamento.

                    <h3>DISPOSICIONES TRANSITORIAS</h3>

                    Primera. Los procedimientos administrativos o procesos judiciales en trámite a la fecha de publicación del presente Código, serán resueltos hasta su conclusión por las autoridades competentes conforme a las normas y procedimientos establecidos en las leyes N 1340, de 28 de mayo de 1992; N 1455, de 18 de febrero de 1993; y, N 1990, de 28 de julio de 1999 y demás disposiciones complementarias.<br>

                    Segunda. Los procedimientos administrativos o procesos jurisdiccionales, iniciados a partir de la vigencia plena del presente Código, serán sustanciados y resueltos bajo este Código.<br>

                    Tercera. Con la finalidad de implementar el nuevo Código Tributario, se establece un Programa Transitorio, Voluntario y Excepcional para el tratamiento de adeudos tributarios en mora al treinta y uno (31) de diciembre de 2002, respetando las particularidades de cada Administración Tributaria, que se sujetará a lo siguiente:<br>
                    <br> I. Opciones excluyentes para la regularización de obligaciones tributarias cuya recaudación corresponda al Servicio de Impuestos Nacionales:<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;a)Pago único definitivo<br>
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Se establece un pago equivalente al 10% del total de las ventas brutas declaradas en un año. A tal efecto se deberá tomar como base de cálculo, el año de mayores ventas de las últimas cuatro (4) gestiones. Dicho pago deberá realizarse al contado dentro de los noventa (90) días perentorios siguientes a la publicación del Reglamento del presente programa, el mismo supone la regularización de todas las obligaciones tributarias (impuestos, sanciones y accesorios) pendientes por las gestiones fiscales no prescritas, con excepción de las correspondientes al Impuesto al Régimen Complementario al Valor Agregado (RC-IVA). Este pago implica la renuncia a los saldos a favor y las pérdidas que hubieran acumulado los contribuyentes y/o responsables.<br>
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. En el caso del Régimen Complementario al Valor Agregado (RC-IVA), el contribuyente y/o responsable que se acogiera al Programa, deberá pagar el monto equivalente al 5% (cinco por ciento) calculado sobre el ingreso, sueldo o retribución neta percibida en la gestión 2002, dentro el término de ciento ochenta (180) días perentorios siguientes a la publicación del Código Tributario. La regularización en este impuesto, implica la renuncia a los saldos a favor que hubieran acumulado los contribuyentes y/o responsables, así como la extinción de las obligaciones tributarias no prescritas por este impuesto. Los contribuyentes y/o responsables que no se acojan a la modalidad descrita, serán considerados en la primera etapa de la programación de acciones que adopte la Administración Tributaria conforme a lo dispuesto en el parágrafo diez.<br>
                    El pago total definitivo en efectivo, implicará que las Administraciones Tributarias no ejerzan en lo posterior, sus facultades de fiscalización, determinación y recaudación sobre los impuestos y períodos comprendidos dentro del presente Programa.<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;b)Plan de Pagos.<br>
                    Los contribuyentes y/o responsables que se acojan a la modalidad de plan de pagos se beneficiarán con la condonación de sanciones pecuniarias e intereses emergentes del incumplimiento de obligaciones tributarias, debiendo presentar su solicitud dentro del plazo de noventa (90) días perentorios siguientes a la publicación del Código Tributario. La Administración Tributaria correspondiente otorgará, por una sola vez, plan de pagos para la cancelación del tributo omitido actualizado en Unidades de Fomento de la Vivienda, mediante cuotas mensuales, iguales y consecutivas, por un plazo máximo de hasta cinco (5) años calendario, sin previa constitución de garantías y con una tasa de interés del cinco por ciento (5%) anual. Para la actualización del tributo, se aplicará el procedimiento dispuesto en la Ley N 2434 y su reglamento.<br>
                    Cuando los adeudos tributarios no se encuentren liquidados por la Administración Tributaria, los contribuyentes y/o responsables podrán solicitar un plan de pagos para la cancelación del tributo adeudado actualizado, presentando una Declaración Jurada no rectificable que consigne todas sus deudas conforme a lo que reglamentariamente se determine.<br>
                    La solicitud de un plan de pagos determina la suspensión del cobro coactivo de la obligación tributaria, correspondiendo el levantamiento de las medidas coactivas adoptadas, excepto la anotación preventiva de bienes, salvo cuando el levantamiento de las medidas sea necesaria par cumplir obligaciones tributarias, previa autorización de la Administración Tributaria.<br>
                    El incumplimiento de cualquiera de las cuotas del plan de pagos otorgado por la Administración Tributaria, dará lugar a la pérdida de los beneficios del presente programa correspondiendo la exigibilidad de toda la obligación.<br>
                    La concesión de planes de pago no inhibe el ejercicio de las facultades de fiscalización, determinación y recaudación de la Administración Tributaria dentro del término de la prescripción.<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;c)Pago al contado Los contribuyentes y/o responsables que se acojan a esta modalidad por obligaciones tributarias que se hubieran determinado por la Administración Tributaria, se beneficiarán con la condonación de intereses, sanciones y el diez (10%) por ciento del tributo omitido, siempre que realicen el pago al contado dentro de los noventa (90) días perentorios siguientes a la publicación del Reglamento del presente programa. El pago al contado en efectivo implicará que las Administraciones Tributarias no ejerzan en lo posterior, sus facultades de fiscalización, determinación y recaudación sobre los impuestos y períodos comprendidos en dicho pago.<br>
                    También podrán acogerse a esta modalidad las obligaciones tributarias no determinadas por la Administración, siempre que los contribuyentes y/o responsables presenten una Declaración Jurada no rectificable que consigne sus deudas. En estos casos, no se inhibe el ejercicio de las facultades de fiscalización, determinación y recaudación de la Administración Tributaria dentro del término de la prescripción.<br>
                    <br> II. Quienes a la fecha de entrada en vigencia de esta norma tengan recursos o procesos de impugnación en vía administrativa o jurisdiccional, podrán pagar sus obligaciones tributarias mediante las modalidades dispuestas en los incisos b) y c) del parágrafo I, previo desistimiento del recurso o acción interpuesta, tomando como base de liquidación el último acto emitido dentro del recurso administrativo. Asimismo, los contribuyentes de las situaciones descritas podrán acogerse a la opción del inciso a) en las condiciones y formas dispuestas.<br>
                    <br> III. En el caso de obligaciones tributarias cuya recaudación corresponda al Servicio de Impuestos Nacionales, la regularización del tributo omitido, intereses y sanciones pecuniarias por incumplimiento a deberes formales, en las modalidades desarrolladas en los incisos a), b) y c) del parágrafo I, procederá además, si los contribuyentes que desarrollan actividades gravadas se inscriben en el Nuevo Padrón Nacional, dentro del plazo fijado por norma reglamentaria.<br>
                    <br> IV. En el ámbito municipal, el Programa Transitorio, Voluntario y Excepcional alcanzará al Impuesto a la Propiedad de Bienes Inmuebles y Vehículos Automotores y Patentes Municipales anuales, cuyos hechos generadores se hubieran producido hasta el 31 de diciembre de 2001 y al Impuesto Municipal a las Transferencias, Tasas y Patentes eventuales por hechos generadores ocurridos hasta el 31 de diciembre de <br> &nbsp;&nbsp;&nbsp;&nbsp;2002. La Regularización realizada por los contribuyentes y/o responsables en este ámbito, bajo una de las modalidades que con carácter excluyente se establecen, dará lugar a la condonación de sanciones pecuniarias e intereses generados por el incumplimiento.<br>
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;1. Pago al contado del tributo omitido actualizado, dentro de los noventa (90) días perentorios posteriores a la publicación del presente Código.<br>
                    <br> &nbsp;&nbsp;&nbsp;&nbsp;2. Pago del tributo omitido actualizado en cuotas mensuales, iguales y consecutivas por un plazo máximo de hasta dos (2) años, sin previa constitución de garantías y con una tasa de interés del cinco (5) por ciento anual. La concesión del plan de pagos se otorgará por una sola vez, siempre que los contribuyentes y/o responsables formulen su solicitud dentro de los noventa (90) días perentorios siguientes a la publicación del presente Código.<br>
                    En los demás aspectos, el Programa Transitorio, Voluntario y Excepcional se sujetará a lo establecido con carácter general en los parágrafos siguientes, respetando las especificidades dispuestas.<br>
                    <br> V. En materia aduanera, para los cargos tributarios establecidos en informes de fiscalización, notas de cargo, resoluciones administrativas, actas de intervención u otro instrumento administrativo o judicial, emergente de la comisión de ilícitos aduaneros, se establece el pago de los tributos aduaneros omitidos determinados por la Administración Tributaria, que implicará la regularización de todas las obligaciones tributarias (impuestos, accesorios y las sanciones que correspondan, incluyendo el recargo por abandono) y la extinción de la acción penal prevista en las leyes aplicables.<br>
                    En los casos de contrabando de mercancías, que sean regularizados con el pago de los tributos omitidos, los medios y unidades de transporte decomisados serán devueltos al transportador, previo pago de un monto equivalente al cincuenta por ciento (50%) de dichos tributos.<br>
                    En los demás aspectos, el Programa Transitorio, Voluntario y Excepcional se sujetará a lo establecido con carácter general en los parágrafos siguientes, respetando las especificidades dispuestas.<br>
                    <br> VI. Las deudas tributarias emergentes de Autos Supremos que hubieran alcanzado la autoridad de cosa juzgada podrán acogerse al Programa Transitorio, Voluntario y Excepcional en la modalidad dispuesta en el inciso b) del parágrafo I, salvo la aplicación de la condonación dispuesta en el mismo, que no procederá en ningún caso.<br>
                    Por otra parte, los responsables solidarios cuyo obligación sea emergente de transmisiones de obligaciones tributarias sin contraprestación, deberán cumplir con el pago de la parte proporcional que les corresponda, por lo recibido.<br>
                    <br> VII. Lo pagado en aplicación de este Programa en cualquiera de sus modalidades, no implica para el contribuyente y/o tercero responsable el reconocimiento de su calidad de deudor ni de la condición de autor de ilícitos tributarios.<br>
                    <br> VIII. Los pagos realizados en aplicación de esta Ley, se consolidarán a favor del Sujeto Activo, no pudiendo ser reclamados a éste en vía de repetición.<br>
                    <br> IX. Los contribuyentes y/o responsables que actualmente estuvieran cumpliendo un plan de pagos, podrán acogerse a la reprogramación del mismo, únicamente por el saldo adeudado con los beneficios establecidos para cada caso, en el presente Programa.<br>
                    <br> X. Las Administraciones Tributarias quedan obligadas a la programación de fiscalizaciones a los contribuyentes y/o responsables que no se hubieran acogido al Programa y que tuvieran obligaciones tributarias pendientes. A tal efecto, en caso de encontrar facturas falsificadas, las Administraciones Tributarias quedan, bajo responsabilidad funcionaria, obligadas a iniciar las acciones penales por el delito de uso de instrumento falsificado en contra de quienes resultaren autores, cómplices o encubridores. Asimismo, si como producto de la fiscalización se detectara que existieron retenciones tributarias no empozadas al fisco, las Administraciones Tributarias quedan obligadas a iniciar acciones penales por los delitos tipificados por el Código Penal boliviano.<br>
                    <br> XI. A efecto de la depuración del actual registro del Servicio de Impuestos Nacionales y la implementación mediante decreto supremo de un Nuevo Padrón Nacional de Contribuyentes, se dispone la condonación de sanciones pecuniarias por incumplimiento a deberes formales y se autoriza a la Administración Tributaria a proceder a la cancelación de oficio del Registro de aquellos contribuyentes que no cumplieron el proceso de recarnetización, o que habiéndolo hecho no tuvieron actividad gravada de acuerdo a lo que reglamentariamente se determine.<br>
                    <br> XII. En el marco de la política de reactivación económica, el Poder Ejecutivo reglamentará un Programa Transitorio de reprogramación de adeudos a la Seguridad Social de corto plazo, Sistema de Reparto, aportes a la vivienda y patentes, con la condonación de multas e intereses.<br>

                    <h3>DISPOSICION ADICIONAL</h3>

                    ÚNICA. La limitación establecida en el inciso a) del parágrafo I del Artículo 11 de la Ley N 2027, de 27 de octubre de 1999; del párrafo sexto del Artículo 35 de la Ley N 1990, de 28 de julio de 1999; y del inciso f) del Artículo 8 de la Ley N 2166, de 22 de diciembre de 2000, referentes a la imposibilidad para miembros del Directorio de desempeñar otro cargo público remunerado, no será aplicable para los miembros del Directorio que desempeñen simultáneamente funciones en el Servicio de Impuestos Nacionales y la Aduana Nacional, no pudiendo ejercer funciones a tiempo completo, ni otras funciones públicas.

                    <h3>DISPOSICIONES FINALES</h3>

                    PRIMERA. A la vigencia del presente Código quedará derogado el literal B) del Artículo 157 de la Ley Nº 1455, de 18 de febrero de 1993, Ley de Organización Judicial.<br>

                    SEGUNDA. Sustitúyase el Artículo 231 del Código Penal, por el siguiente texto:
                    "Son delitos tributarios los tipificados en el Código Tributario y la Ley General de Aduanas, los que serán sancionados y procesados conforme a lo dispuesto por el Título IV del presente Código".<br>

                    TERCERA. Se modifican las penas de privación de libertad previstas en los Artículos 171 a 177 de la Ley General de Aduanas, en la siguiente forma:<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;a)De tres a seis años de privación de libertad para los delitos tipificados en los artículos 171°, 172°, 173°, 174°, 175 y para el cohecho activo tipificado en el artículo 176°.<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;b)De tres a ocho años de privación de libertad para el delito de tráfico de influencias en la actividad aduanera tipificado en el Artículo 177 y para el cohecho pasivo tipificado en el artículo 176°.<br>

                    CUARTA. Sustitúyase el inciso b) y el último párrafo del Artículo 45 de la Ley N 1990, por el siguiente texto:<br>
                    "b) Efectuar despachos aduaneros por cuenta de terceros, debiendo suscribir personalmente las declaraciones aduaneras incluyendo su número de licencia.<br>
                    El Despachante de Aduana puede ejercer funciones a nivel nacional previa autorización del Directorio de la Aduana Nacional".<br>

                    QUINTA. Sustitúyase en el Artículo 52 de la Ley N 1990, Aduana Nacional por Ministerio de Hacienda.<br>

                    SEXTA. Modifíquese el párrafo sexto del Articulo 29º de la Ley No. 1990 de 28 de julio de 1999 con el siguiente texto: "El Presupuesto anual de funcionamiento e inversión con recursos del Tesoro General de la Nación asignado a la Aduana Nacional, no será superior al dos (2 %) por ciento de la recaudación anual de tributos en efectivo."<br>

                    SEPTIMA. Añádase como párrafo adicional del Artículo 183 de la Ley No. 1990, el siguiente texto: "Se excluyen de este eximente los casos en los cuáles se presenten cualquiera de las formas de participación criminal establecidas en el Código Penal, garantizando para el auxiliar de la función pública aduanera el derecho de comprobar la información proporcionada por sus comitentes, consignantes o consignatarios y propietarios".<br>

                    OCTAVA. Sustitúyase el Artículo 187 de la Ley N°. 1990, con el siguiente texto: "Las contravenciones en materia aduanera serán sancionadas con:<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;a)Multa que irá desde cincuenta Unidades de Fomento de la Vivienda (<br> &nbsp;&nbsp;&nbsp;&nbsp;50.- UFV's) a cinco mil Unidades de Fomento de la Vivienda (<br> &nbsp;&nbsp;&nbsp;&nbsp;5.<br> &nbsp;&nbsp;&nbsp;&nbsp;000.- UFV's). La sanción para cada una de las conductas contraventoras se establecerá en esos límites mediante norma reglamentaria.<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;b)Suspensión temporal de actividades de los auxiliares de la función pública aduanera y de los operadores de comercio exterior por un tiempo de (10) diez a noventa (90) días.<br>
                    La Administración Tributaria podrá ejecutar total o parcialmente las garantías constituidas a objeto de cobrar las multas indicadas en el presente artículo".<br>

                    NOVENA. A partir de la entrada en vigencia del presente Código, queda abrogada la Ley N 1340, de 28 de mayo de 1992, y se derogan todas las disposiciones contrarias al presente texto legal.<br>

                    DECIMA. El presente Código entrará en vigencia noventa (90) días después de su publicación en la Gaceta Oficial de Bolivia, con excepción de las Disposiciones Transitorias que entrarán en vigencia a la publicación de su Reglamento.<br>

                    DECIMA PRIMERA. Se derogan los Títulos Décimo Primero y Décimo Segundo así como los siguientes artículos de la Ley General de Aduanas N 1990, de 28 de julio de 1999: 14°, párrafo 5to, 15°; 16°, 17°, 18°, 19°, 20°, 21°, 22°, 23°, 24°, 31°, 33°, 158°, 159°, 160°, 161°, 162°, 163°, 164°, 165°, 166°, 167°, 168°, 169°, 170°, 177º párrafo 2do,178°, 179°, 180°, 181°, 182°, 184°, 185°, 262°, 264°, 265°, 266 y 267°.<br>
                    Asimismo, se autoriza al Poder Ejecutivo a ordenar por Decreto Supremo el Texto de Código Tributario, incorporando las disposiciones no derogadas por esta norma que se encuentran establecidas en el Título Décimo de la Ley N 1990, de 28 de julio de <br> &nbsp;&nbsp;&nbsp;&nbsp;1999.<br>

                    DECIMA SEGUNDA. El Poder Ejecutivo procederá, mediante Decreto Supremo, a ordenar e integrar en un solo cuerpo los textos de las siguientes leyes: N 1990, de 28 de Julio de 1999; N 843, de 20 de mayo de 1986 (Texto ordenado vigente); y, N 2166, de 22 de diciembre de 2000 .<br>

                    Devuélvase al Honorable Senado Nacional, con modificaciones.<br>

                    Es dado en la Sala de Sesiones de la Honorable Cámara de Diputados, a los veinticinco días del mes de julio de dos mil tres años.<br>


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