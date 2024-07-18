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
    <title>DATM Ley 812</title>
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
    <li class="breadcrumb-item text-white active" aria-current="page">Ley 812</li>
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

                <h1>LEY N°812</h1>

<h2>LEY DE 30 DE JUNIO DE 2016</h2>

<h2>PRESIDENTE CONSTITUCIONAL DEL ESTADO PLURINACIONAL DE BOLIVIA</h2>

<h4>Por cuanto, la Asamblea Legislativa Plurinacional, ha sancionado la siguiente Ley:</h4>

<h4>LA ASAMBLEA LEGISLATIVA PLURINACIONAL,</h4>

<p>DECRETA:</p>

<p><h4>Artículo 1. (OBJETO)</h4>. La presente Ley tiene por objeto modificar la Ley N°2492 de 2 de agosto de 2003, “Código Tributario Boliviano”.</p>

<h4>Artículo 2. (MODIFICACIONES).</h4>

<p>I. Se modifica el Artículo 47° de la Ley N°2492 de 2 de agosto de 2003, “Código Tributario Boliviano”, con el siguiente texto:</p>

<br>“Artículo 47°. (COMPONENTES DE LA DEUDA TRIBUTARIA).

<br>I. La Deuda Tributaria (DT) es el tributo omitido expresado en Unidades de Fomento de Vivienda más intereses (I) que debe pagar el sujeto pasivo después de vencido el plazo para el cumplimiento de la obligación tributaria, sin la necesidad de intervención o requerimiento alguno de la Administración Tributaria, de acuerdo a la siguiente fórmula:

<br>DT = TO + I

<br>Donde:

<br>I = TO *((1+r/360) **n – 1)

<br>El Tributo Omitido (TO) será expresado en Unidades de Fomento de Vivienda publicada por el Banco Central de Bolivia, del día de vencimiento de pago de la obligación tributaria.

<br>La tasa de interés (r) podrá variar de acuerdo a los días de mora (n: n1, n2, n3) y será:

<br>&nbsp;&nbsp;&nbsp;&nbsp;1. Del cuatro por ciento (4%) anual, desde el día siguiente al vencimiento del plazo para el pago de la obligación tributaria, hasta el último día del cuarto año o hasta la fecha de pago dentro de este periodo, según corresponda ( ).

<br>&nbsp;&nbsp;&nbsp;&nbsp;2. Del seis por ciento (6%) anual, desde el primer día del quinto año de mora, hasta el último día del séptimo año o hasta la fecha de pago dentro de este periodo, según corresponda ( ).

<br>&nbsp;&nbsp;&nbsp;&nbsp;3. Del diez por ciento (10%) anual, desde el primer día del octavo año de mora, hasta la fecha de pago ( ).

<p>El total de la deuda tributaria estará constituido por el Tributo Omitido actualizado en Unidades de Fomento de Vivienda, más los intereses aplicados en cada uno de los períodos de tiempo de mora descritos precedentemente, hasta el día de pago.</p>

<br>&nbsp;&nbsp;&nbsp;&nbsp;II. La deuda tributaria expresada en Unidades de Fomento de Vivienda, al momento del pago deberá ser convertida en moneda nacional, utilizando la Unidad de Fomento de Vivienda de la fecha de pago.

<br>&nbsp;&nbsp;&nbsp;&nbsp;III. Los pagos parciales una vez transformados a Unidades de Fomento de Vivienda, serán convertidos a valor presente a la fecha de vencimiento de la obligación tributaria, utilizando como factor de conversión para el cálculo de intereses, la relación descrita en el Parágrafo I del presente Artículo, y se deducirán del total de la deuda tributaria sin intereses.

<br>&nbsp;&nbsp;&nbsp;&nbsp;IV. Los montos indebidamente devueltos por la Administración Tributaria, serán restituidos por el beneficiario según la variación de la Unidad de Fomento de Vivienda e intereses, de acuerdo a lo previsto en el presente Artículo, calculados a partir de la fecha de la devolución indebida hasta la fecha de pago.”

<br><br>II. Se modifican los Parágrafos I y II del Artículo 59° de la Ley N°2492 de 2 de agosto de 2003, “Código Tributario Boliviano”, con el siguiente texto:

<p>“I. Las acciones de la Administración Tributaria prescribirán a los ocho (8) años, para:

1. Controlar, investigar, verificar, comprobar y fiscalizar tributos.

2. Determinar la deuda tributaria.

3. Imponer sanciones administrativas.

II. El término de prescripción precedente se ampliará en dos (2) años adicionales, cuando el sujeto pasivo o tercero responsable no cumpliera con la obligación de inscribirse en los registros pertinentes, se inscribiera en un régimen tributario diferente al que corresponde, incurra en delitos tributarios o realice operaciones comerciales y/o financieras en países de baja o nula
tributación.”</p>

<br><br>III. Se modifica el Artículo 83° de la Ley N°2492 de 2 de agosto de 2003, “Código Tributario Boliviano”, con el siguiente texto:

<p>“Artículo 83°. (MEDIOS DE NOTIFICACIÓN).

<br>&nbsp;&nbsp;&nbsp;&nbsp;I. Los actos y actuaciones de la Administración Tributaria se notificarán por uno de los siguientes medios, según corresponda:
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. Por medios electrónicos;
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. Personalmente;
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. Por Cédula;
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4. Por Edicto;
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5. Por correspondencia postal certificada, efectuada mediante correo público o privado o por sistemas de comunicación electrónicos, facsímiles o similares;
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6. Tácitamente;
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7. Masiva;
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8. En Secretaría.

<br>&nbsp;&nbsp;&nbsp;&nbsp;II. Es nula toda notificación que no se ajuste a las formas anteriormente descritas. Con excepción de las notificaciones por correspondencia, edictos y masivas, todas las notificaciones se practicarán en días y horas hábiles administrativos, de oficio o a pedido de parte. Siempre por motivos fundados, la autoridad administrativa competente podrá habilitar días y horas extraordinarias.”</p>

<br><br>IV. Se modifica el Artículo 156° de la Ley N° 2492 de 2 de agosto de 2003, “Código Tributario Boliviano”, con el siguiente texto:

<p>“Artículo 156°. (REDUCCIÓN DE SANCIONES). Las sanciones pecuniarias establecidas en este Código para la contravención de omisión de pago, se reducirán conforme a los siguientes criterios:

<br>&nbsp;&nbsp;&nbsp;&nbsp;1. El pago de la deuda tributaria después del décimo día de la notificación con la Vista de Cargo o Auto Inicial y hasta antes de la notificación con la Resolución Determinativa o Sancionatoria, determinará la reducción de la sanción aplicable en el ochenta por ciento (80%).

<br>&nbsp;&nbsp;&nbsp;&nbsp;2. El pago de la deuda tributaria efectuado después de notificada la Resolución Determinativa o Sancionatoria hasta antes de la presentación del recurso de alzada ante la Autoridad Regional de Impugnación Tributaria, determinará la reducción de la sanción en el sesenta por ciento (60%).

<br>&nbsp;&nbsp;&nbsp;&nbsp;3. El pago de la deuda tributaria efectuado después de la interposición del recurso de alzada y antes de la presentación del recurso jerárquico ante la Autoridad General de Impugnación Tributaria, determinará la reducción de la sanción en el cuarenta por ciento (40%).”</p>

<br><br>V. Se modifica el Primer Párrafo del Artículo 157° de la Ley N° 2492 de 2 de agosto de 2003, “Código Tributario Boliviano”, con el siguiente texto:

<p>“Artículo 157°. (ARREPENTIMIENTO EFICAZ). Quedará automáticamente extinguida la sanción pecuniaria por contravención de omisión de pago, cuando el sujeto pasivo o tercero responsable pague la deuda tributaria hasta el décimo día de notificada la Vista de Cargo o Auto Inicial, o hasta antes del inicio de la ejecución tributaria de las declaraciones juradas que determinen tributos y no hubiesen sido pagados totalmente.”</p>

<h4>Artículo 3. (INCORPORACIONES).</h4>

<p>I. Se incorpora el Artículo 83° Bis, a la Ley N°2492 de 2 de agosto de 2003, “Código Tributario Boliviano”, con el siguiente texto:</p>

<br>&nbsp;&nbsp;&nbsp;&nbsp;“Artículo 83° Bis. (NOTIFICACIÓN POR MEDIOS ELECTRÓNICOS).

<br>&nbsp;&nbsp;&nbsp;&nbsp;I. Para los casos en que el contribuyente o tercero responsable señale un correo electrónico o éste le sea asignado por la Administración Tributaria, la vista de cargo, auto inicial de sumario, resolución determinativa, resolución sancionatoria, resolución definitiva y cualquier otra actuación de la Administración Tributaria, podrá ser notificado por correo electrónico, oficina virtual u otros medios electrónicos disponibles. La notificación realizada por estos medios tendrá la misma validez y eficacia que la notificación personal.

En las notificaciones practicadas en esta forma, los plazos se computarán de acuerdo al Artículo 4 del presente Código Tributario.

<br>&nbsp;&nbsp;&nbsp;&nbsp;II. La Administración Tributaria contará con los medios electrónicos necesarios para garantizar la notificación a los contribuyentes.

<br>Los contribuyentes que proporcionen a la Administración Tributaria su correo electrónico, número de celular o teléfono fijo, recibirán comunicados por estos medios.”

<br>&nbsp;&nbsp;&nbsp;&nbsp;II. Se incorpora como Sexto Párrafo del Artículo 157° de la Ley N°2492 de 2 de agosto de 2003, “Código Tributario Boliviano”, el siguiente texto:

<p>“Cuando el tributo pagado con el beneficio previsto en el presente Artículo sea objeto de una fiscalización o determinación posterior, en caso de existir diferencias a favor del Fisco, la sanción aplicable sólo será respecto al tributo por determinarse de oficio.”</p>

<h4>DISPOSICIONES TRANSITORIAS</h4>

<br>&nbsp;&nbsp;&nbsp;&nbsp;PRIMERA. Los sujetos pasivos con deudas tributarias a favor del nivel central del Estado a la fecha de publicación de la presente Ley, hasta el 31 de diciembre del presente año podrán pagar o solicitar un plan de pagos de acuerdo al Código Tributario Boliviano y sus disposiciones reglamentarias, con el interés único del cuatro por ciento (4%) anual aplicable a todo el período de la mora, con los siguientes incentivos:

<br>&nbsp;&nbsp;&nbsp;&nbsp;1. Sin multa por arrepentimiento eficaz según el Artículo 157° del Código Tributario Boliviano modificado por la presente Ley, cuando se traten de deudas tributarias determinadas por el sujeto pasivo o que se encuentren en procesos de fiscalización, verificación o determinación de oficio hasta el décimo día de notificada la vista de cargo.

<br>&nbsp;&nbsp;&nbsp;&nbsp;2. Con una rebaja del ochenta por ciento (80%) de la multa por omisión de pago en las deudas tributarias en procesos de determinación, después de los diez días de notificada la vista de cargo y hasta antes de la impugnación de la Resolución Determinativa.

<br>&nbsp;&nbsp;&nbsp;&nbsp;3. Con una rebaja del sesenta por ciento (60%) de la multa por omisión de pago en las deudas tributarias establecidas en Resolución Determinativa firme o que se encuentren en la fase de ejecución o cobranza coactiva resultante de aquellos actos de la Administración Tributaria que no hubiesen sido objeto de recursos judiciales o administrativos, y hasta antes del acto de remate o adjudicación directa.

<br>&nbsp;&nbsp;&nbsp;&nbsp;4. Con una rebaja del sesenta por ciento (60%) de la multa por omisión de pago en las deudas tributarias con Resolución Determinativa impugnada previo desistimiento del recurso, incluso hasta antes de la notificación con el pronunciamiento del Tribunal Supremo de Justicia.

<br>Aquellas deudas tributarias en procesos de ejecución resultantes del cumplimiento de fallos dictados por el Tribunal Supremo de Justicia, continuarán su trámite de ejecución de acuerdo a la Ley aplicable y en cumplimiento de las resoluciones que así lo determinaron en su oportunidad.

<p>Para las deudas tributarias con facilidades de pago en curso, las cuotas adeudadas a la fecha de publicación de la presente Ley, serán cumplidas con la tasa de interés del cuatro por ciento (4%).</p>

<p>El incumplimiento de las facilidades de pago, dará lugar a la pérdida de los beneficios establecidos en la presente Disposición Transitoria.</p>

<p>SEGUNDA. Las multas por contravenciones de omisión de pago en proceso, con Resolución Sancionatoria firme o ejecutoriada o que se encuentren en ejecución tributaria y hasta antes del acto de remate o adjudicación directa, podrán ser pagadas con la reducción del sesenta por ciento (60%), hasta el 31 de diciembre de 2016.</p>

<p>TERCERA. Los sujetos pasivos que paguen sus obligaciones tributarias o multas en el marco de lo establecido en las Disposiciones Transitorias Primera y Segunda de la presente Ley, gozarán de los siguientes incentivos:

<br>&nbsp;&nbsp;&nbsp;&nbsp;1. Una rebaja del diez por ciento (10%) de la multa aplicable a la fecha de pago, hasta el 31 de agosto de la gestión 2016;

<br>&nbsp;&nbsp;&nbsp;&nbsp;2. Una rebaja del cinco por ciento (5%) de la multa aplicable a la fecha de pago, hasta el 31 de octubre de la gestión 2016.</p>

<h4>DISPOSICIONES FINALES</h4>

<p>PRIMERA. Las deudas tributarias existentes a la fecha de vigencia de la presente Ley, que no se cumplan de acuerdo a lo establecido en la Disposición Transitoria Primera, serán calculadas y pagadas conforme a lo dispuesto en el Artículo 47° del Código Tributario Boliviano, modificado por la presente Ley.</p>

<p>SEGUNDA. El Servicio de Impuestos Nacionales y la Aduana Nacional podrán establecer mecanismos de incentivos a la facturación y la generación de cultura tributaria, mediante la entrega de premios, incentivos o reconocimientos al contribuyente, usuarios y/o consumidores, de forma directa o a través de sorteos, juegos, actividades lúdicas, cualquier otro medio de acceso, ferias u otros, de acuerdo a reglamento específico.

Para estos fines, el Tesoro General de la Nación asignará recursos de acuerdo a disponibilidad financiera o en su caso se priorizará la entrega y/o transferencia de mercancías comisadas por contrabando y/o abandono, a través del procedimiento establecido en la Ley N°615 de 15 de diciembre de 2014 y su Reglamento.</p>

<p>TERCERA. El Ministerio de Economía y Finanzas Públicas instruirá al Servicio de Impuestos Nacionales, mediante el convenio anual de compromisos por resultados, priorizar la ejecución de fiscalizaciones de las gestiones más recientes y la mejora de la eficiencia administrativa, debiendo evaluar trimestralmente su cumplimiento.</p>

<p>CUARTA. El Servicio de Impuestos Nacionales desarrollará e implementará una plataforma virtual que permita realizar gestiones tributarias y la notificación de las actuaciones administrativas mediante medios electrónicos.

Una vez implementada esta plataforma, las notificaciones personales serán excepcionales, debiendo reglamentarse mediante Resolución Administrativa los casos en los que proceda.</p>

<h4>DISPOSICIÓN ABROGATORIA Y DEROGATORIA</h4>

<p>ÚNICA. Se abrogan y derogan todas las normas contrarias a la presente Ley.</p>


<p>Remítase al Órgano Ejecutivo para fines constitucionales.</p>

Es dada en la Sala de Sesiones de la Asamblea Legislativa Plurinacional, a los veintinueve días del mes de junio del año dos mil dieciséis.

Fdo. José Alberto Gonzales Samaniego, Víctor Ezequiel Borda Belzu, Víctor Hugo Zamora Castedo, Noemi Natividad Díaz Taborga, Mario Mita Daza, Ana Vidal Velasco.

Por tanto, la promulgo para que se tenga y cumpla como Ley del Estado Plurinacional de Bolivia.

Palacio de Gobierno de la ciudad de La Paz, a los treinta días del mes de junio del año dos mil dieciséis.

FDO. EVO MORALES AYMA, Juan Ramón Quintana Taborga, Luis Alberto Arce Catacora, Virginia Velasco Condori, Marianela Paco Durán.</p>


<p>SUSCRIPCIÓN OBLIGATORIA</p>
DECRETO SUPREMO N°690, 

03 DE NOVIEMBRE DE 2010.- Dispone la suscripción obligatoria, sin excepción alguna, de todas las entidades del sector público que conforman la estructura organizativa del Órgano Ejecutivo, así como de entidades y empresas públicas que se encuentran bajo su dependencia o tuición, a la Gaceta Oficial de Bolivia, dependiente del Ministerio de la Presidencia, para la obtención física de Leyes, Decretos y Resoluciones Supremas.

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
                    <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2 mensajeBtnIa"  ><i class="fa fa-paper-plane fs-4" style="color:#036b8b;"></i></button>
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