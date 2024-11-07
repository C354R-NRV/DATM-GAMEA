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
    <title>DATM Ley Mun 12/12</title>
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
    <li class="breadcrumb-item text-white active" aria-current="page">Ley Municipal 012-2012</li>
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


                    <!-- =============================================================================================================== -->
                    <h1>Gobierno Autónomo Municipal de El Alto</h1>

<h2>Honorable Concejo Municipal</h2>

<h1>LEY MUNICIPAL N° 012</h1>

<input type="hidden" id="recurso_" value="m12">
<h1><span id="tituloPrincipal">LEY MUNICIPAL AUTONÓMICA DE COMPLEMENTACION, DE MODIFICACION Y ENMIENDA A LA LEY MUNICIPAL N° 003/2012, DE CREACIÓN DE IMPUESTOS MUNICIPALES.</span></h1>

H. Zacarias Maquera Chura
PRESIDENTE DEL HONORABLE CONCEJO MUNICIPAL

<h2>ARTÍCULO 1°.-</h2> (Objeto) El objeto de la presente Ley Municipal Autonómica es establecer, de manera permanente, un incentivo tributario por pronto pago de los Impuestos Municipales a la Propiedad de Bienes Inmuebles y Vehículos Automotores y modificar la Ley Municipal N° 003/2012, de 07 de diciembre de 2012, de Creación de Impuestos.

<h2>ARTÍCULO 2°.-</h2> (Ámbito de Aplicación) Las disposiciones contenidas en la presente Ley Municipal Autonómica se aplicarán en la jurisdicción del Municipio de El Alto.

<h2>ARTÍCULO 3°.-</h2> Se modifica el Artículo 2 de la Ley Municipal N° 003/2012 de Creación de Impuestos Municipales del Gobierno Autónomo Municipal de EL Alto, por el siguiente texto:
"El Gobierno Autónomo Municipal de El Alto podrá actualizar anualmente los montos establecidos en los distintos tramos de la escala impositiva, sobre la base de la variación de la Unidad de Fomento de la Vivienda (UFV) producida entre el 1° de enero y el 31 de diciembre de cada gestión fiscal."

<h2>ARTÍCULO 4°.-</h2> Se modifica el Artículo 4 de la Ley Municipal N° 003/2012 de la Creación de Impuestos, de la siguiente manera:
Están excluidos de este impuesto:
<br>a. Los inmuebles de propiedad del Nivel Central del Estado, Gobiernos Autónomos Departamentales y Municipales. Esta exclusión no alcanza a los inmuebles de propiedad de las empresas públicas.
<br>b. Los inmuebles pertenecientes a las misiones diplomáticas y consulares extranjeras acreditadas en el país, así como de los organismos internacionales.
<br>c. La pequeña propiedad agraria y la propiedad comunitaria o colectiva con os bienes que se encuentren en ellas, de conformidad a la Constitución Política del Estado Artículo 394 parágrafos II y III y al Artículo 8 inciso a) de la Ley N° 154, de Clasificación de Impuestos de Dominio de los Gobiernos Autónomos.
<br>d. En ningún caso estarán afectados por este impuesto los inmuebles, las construcciones e instalaciones  desde que queden comprometidas en el derecho de vía o dentro de las áreas de operación que integren la concesión , según la naturaleza de cada una de ellas y de sus áreas de servicio adicionales, conforme a lo establecido en el Numeral 1 del Artículo 31 y en el Artículo 60 de la Ley N° 1874 de 22 de junio de 1998, General de Concesiones de Obras Públicas de Transporte, o la ley que la sustituya.

<h2>ARTÍCULO 5°.-</h2> Se modifica el Artículo 7 de la Ley Municipal N° 003/2012 de Creación de Impuestos, de la siguiente manera:
Están exentos de este impuesto:
<br>a. En un 100% del impuesto, los inmuebles afectados a actividades no comerciales, ni industriales de propiedad de asociaciones, fundaciones o instituciones no lucrativas autorizadas legalmente, tales como: religiosas, de caridad, beneficencia, asistencia social, educativas, científicas, ecológicas, artísticas, literarias, culturales, deportivas, políticas, profesionales, sindicales o gremiales.
Esta franquicia procederá siempre que, por disposición expresa de sus estatutos, la totalidad de los ingresos y el patrimonio de las mencionadas instituciones se destinen exclusivamente a los fines enumerados, que en ningún caso se distribuyan directa o indirectamente entre sus asociados y que, en caso de liquidación, su patrimonio se distribuya entre entidades de igual objeto o se done a instituciones públicas.
<br>b. Los inmuebles para vivienda de propiedad de los beneméritos de la Campaña del Chaco o sus viudas y que les sirva de vivienda permanente, hasta el año d su fallecimiento y hasta el tope del primer tramo contemplado en la escala establecida por el artículo 11°
Como condición  para el goce de esta exención, los beneficiarios deberán solicitar la declaratoria de exención ante la Administración Tributaria anualmente.
<br>c. Las personas de 60 o más años, propietarias de inmuebles de interés social o de tipo económico que le sirva de vivienda permanente tendrán una rebaja del 20% en el impuesto, hasta el límite del primer tramo contemplado en la escala establecida en el Artículo 11.
Como condición para el goce de esta exención, los beneficiarios deberán solicitar la declaratoria de exención ante la Administración Tributaria anualmente.
<br>d. Los bienes inmuebles de propiedad de las entidades financieras intervenidas por la Autoridad del Sistema Financiero (ASFI) a partir de la fecha de intervención y solo mientras dure la misma.
Como condición para el goce de esta exención, los beneficiarios deberán solicitar la declaratoria de exención ante la Administración Tributaria anualmente.
<br>e. Las construcciones  y edificaciones nuevas que se realicen para el funcionamiento de industrias y hoteles en el municipio de El Alto, quedan exentas del Impuesto Municipal a la propiedad de Bienes Inmuebles por un período de tres años computables a partir de la fecha de su conclusión.
Como condición para el goce de esta exención, los beneficiarios deberán solicitar la declaratoria de exención ante la Administración Tributaria anualmente.

<h2>ARTÍCULO 6°.-</h2> Se agrega al Artículo 8° de la Ley Municipal N° 003/2012 el siguiente párrafo:
En el caso de las personas jurídicas la base imponible de este impuesto estará constituida por el valor de los bienes inmuebles de su propiedad consignado en sus estados financieros, memoria anual en el caso de las entidades sin fines de lucro o de4 acuerdo al avalúo fiscal establecido en el párrafo anterior, el que fuere mayor.

<h2>ARTÍCULO 7°.-</h2> Se modifica el Artículo 10 de la Ley Municipal N° 003/2012, de Creación de Impuestos, de la siguiente manera:
"El impuesto a pagar se determinará aplicando sobre la base imponible las alícuotas previstas en la escala contenida en el Artículo 11 de la presente Ley Municipal"

<h2>ARTÍCULO 8°.-</h2> Se modifica el Artículo 11 de la Ley Municipal N° 003/2012 de la Creación de impuestos de la siguiente manera:
"Las alícuotas del impuesto son las que se expresan en la siguiente escala:

ESCALA IMPOSITIVA
IMPUESTO MUNICIPAL A LA PROPIEDAD DE BIENES INMUEBLES URBANOS
<table border="1" cellpadding="5" cellspacing="0">
<thead>
    <tr>
    <th>MONTO DE VALUACIÓN (En Bs.)</th>
    <th>CUOTA FIJA (En Bs)</th>
    <th>MAS%</th>
    <th>S/EXCEDENTE DE (En Bs.)</th>
    </tr>
</thead>
<tbody>
    <tr>
    <td>- A 500,428</td>
    <td>-</td>
    <td>0.35</td>
    <td>1</td>
    </tr>
    <tr>
    <td>500,429 A 1,000,855</td>
    <td>1,751</td>
    <td>0.50</td>
    <td>500,428</td>
    </tr>
    <tr>
    <td>1,000,856 A 1,501,281</td>
    <td>4,254</td>
    <td>1.00</td>
    <td>1,000,855</td>
    </tr>
    <tr>
    <td>1,501,282 En adelante</td>
    <td>9,258</td>
    <td>1.50</td>
    <td>1,501,281</td>
    </tr>
</tbody>
</table>

La base imponible para la liquidación del impuesto que grava la propiedad inmueble agraria será la que establezca el propietario de acuerdo al valor que este atribuya a su inmueble. En lo demás se aplicarán las normas comunes de dicho impuesto. El propietario no podrá modificar el valor declarado después de los noventa (90) días del vencimiento del plazo establecido con carácter general para la declaración y pago del impuesto.
En el caso de la propiedad inmueble agraria, el pago del impuesto se determinará aplicando una alícuota del 0.25% a la base imponible definida en el parágrafo I del Artículo 4 de la Ley N° 1715"

<h2>ARTÍCULO 9°.-</h2> Se modifica el Artículo 15° de la Ley Municipal N° 003/2012, de Creación de Impuestos, de la siguiente manera:
"ARTICULO 15 (Exclusiones) Están excluidos de este impuesto:
<br>a. Los vehículos automotores de propiedad del Nivel Central del Estado, de los Gobiernos Autónomos Departamentales y Municipales. Esta exclusión no alcanza a los vehículos automotores de propiedad de las empresas públicas.
<br>b. Los vehículos automotores pertenecientes a las misiones diplomáticas y consulares extranjeras y a sus miembros acreditados en el país, con motivo del directo desempeño de su cargo y a condición de reciprocidad , así como a los organismos internacionales.

<h2>ARTÍCULO 10°.-</h2> Se agrega el Artículo 15°(bis) a la Ley Municipal N° 003/2012, de Creación de Impuestos con el siguiente texto:
"ARTÍCULO 15° Bis.- (Exenciones) Están exentos de este impuesto los vehículos automotores de propiedad de las entidades financieras intervenidas por la Autoridad del Sistema Financiero (ASFI), a partir dela fecha de intervención y solo mientras dure la misma.
Como condición para el goce de esta exención, los beneficiarios deberán solicitar la declaratoria de exención ante la Administración Tributaria anualmente.

<h2>ARTÍCULO 11°.-</h2> Se incorpora como tercer párrafo del Artículo 16° de la Ley Municipal N° 003/2012 el siguiente texto:
"En el caso de las personas jurídicas, la base imponible de este impuesto estará constituida por el valor de los vehículos automotores de su propiedad consignado en sus estados financieros, memoria anual para el caso de las entidades sin fines de lucro  o de acuerdo al valor establecido en el primer párrafo del este artículo, el que fuera mayor".

<h2>ARTÍCULO 12°.-</h2> Se modifica el Artículo 17° de la Ley Municipal N° 003/2012, de la siguiente manera:
El impuesto se determinará aplicando las alícuotas que se indican a continuación sobre los valores determinados de acuerdo al Artículo anterior:
MONTO DE VALUACIÓN	IMPVA

<table  border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>Desde (Bs)</th>
    <th>Hasta (Bs)</th>
    <th>Cuota fija (Bs)</th>
    <th>%</th>
    <th>S/excedente de (Bs)</th>
</tr>
<tr>
    <td>1</td>
    <td>60,897</td>
    <td>-</td>
    <td>1.50%</td>
    <td>1</td>
</tr>
<tr>
    <td>60,898</td>
    <td>182,689</td>
    <td>1,218</td>
    <td>2.00%</td>
    <td>60,898</td>
</tr>
<tr>
    <td>182,690</td>
    <td>365,377</td>
    <td>4,262</td>
    <td>3.00%</td>
    <td>182,690</td>
</tr>
<tr>
    <td>365,378</td>
    <td>730,755</td>
    <td>10,657</td>
    <td>4.00%</td>
    <td>365,378</td>
</tr>
<tr>
    <td>730,756</td>
    <td>Adelante</td>
    <td>27,098</td>
    <td>5.00%</td>
    <td>730,756</td>
</tr>
</table>

En el caso de transporte público de pasajeros y carga urbana y de larga distancia. Siempre que se trate de servicio que cuenten con la correspondiente autorización de la autoridad competente, el impuesto se determinará aplicando el cincuenta por ciento (50%) de las alícuotas que se indican en este artículo."	

<h2>ARTÍCULO 13°.-</h2> Se modifica el Artículo 18 de la Ley Municipal N° 003/2012, de Creación de Impuestos remplazando el texto de la siguiente manera:
<br>I. Créase el Impuesto Municipal a las Transferencias Onerosas de Inmuebles y Vehículos Automotores que grava las transferencias onerosas de inmuebles y vehículos automotores como impuesto de dominio tributario municipal de competencia exclusiva del Gobierno Autónomo Municipal de El Alto.
<br>II. No están alcanzadas por este Impuesto las transferencias onerosas de bienes inmuebles y vehículos automotores realizadas por empresas que sean unipersonales, públicas, mixtas o privadas u otras sociedades comerciales, cualquiera sea su giro de negocio.

<h2>ARTÍCULO 14°.-</h2> Se modifica el Artículo 20 de la Ley Municipal N° 003/2012, de Creación de Impuestos remplazando el texto de la siguiente manera:  
"Son sujetos pasivos del Impuesto municipal a las Transferencias Onerosas de Bienes Inmuebles y vehículos automotores, las personas naturales y jurídicas que lo desarrollen actividades empresariales confirme al Artículo 18 de la presente Ley y que transfieran inmuebles o vehículos automotores inscritos en los registros públicos a sui nombre."

<h2>ARTÍCULO 14°.-</h2> Se derogan el parágrafo II del Artículo 21 y el parágrafo II del Artículo 22 de la Ley Municipal N° 003/2012, de Creación de Impuestos.

<h2>ARTÍCULO 16°.-</h2> Se modifica el Artículo 23 de la Ley Municipal N° 003/2012, de Creación de Impuestos remplazando el texto de la siguiente manera: 
"Sobre la base imponible determinada conforme al Artículo precedente, se aplicará la alícuota del tres por ciento (3%) en el caso de la transferencia de vehículos automotores y la alícuota del tres por ciento (3%) en el caso de transferencia de bienes inmuebles". 

<h2>ARTÍCULO 17°.-</h2>Se modifica el Artículo 24 de la Ley Municipal N° 003/2012, de Creación de Impuestos, de la siguiente manera:
"ARTICULO 24°.- (Exclusiones).-Están excluidas de este impuesto las transferencias onerosas de bienes inmuebles y vehículos automotores efectuadas por el Estado, las misiones diplomáticas y consulares acreditadas en el país, así como los organismos internacionales".

<h2>ARTÍCULO 18°.-</h2> Se incorpora el Artículo 24 (bis) a la Ley Municipal N° 003/2012, de Creación de impuestos, con el siguiente texto:
"ARTICULO 24°.- Bis (Exenciones).- Están exentas del pago de este impuesto en un cien por ciento (100%), las transferencias de bienes inmuebles resultantes de la expropiación por utilidad pública".

<h2>ARTÍCULO 19°.-</h2>Se incorpora el Artículo 25 a la Ley Municipal N° 003/2012, de Creación de Impuestos, con el siguiente texto:
"ARTICULO 25° .- (Plazo).- Se establece como plazo para el pago del Impuesto Municipal a las Transferencias Onerosas de Bienes Inmuebles y Vehículos Automotores, el décimo día hábil posterior al perfeccionamiento del hecho generador".

<h2>ARTÍCULO 20°.-</h2> Se incorpora a la Ley Municipal N° 003/2012, de Creación de Impuestos el TÍTULO V- RÉGIMEN DE INCENTIVOS, de la siguiente manera:

TÍTULO V
RÉGIMEN DE INCENTIVOS

<h2>ARTÍCULO 26°.-</h2> (Plazo para el pago de impuestos). - Se establece corno plazo para el pago de los Impuestos Municipales a la Propiedad de Bienes Inmuebles y Vehículos Automotores, el último día hábil, del mes de diciembre del año siguiente al perfeccionamiento del hecho generador.

<h2>ARTÍCULO 27°.-</h2> (Descuentos por pronto pago).- Se establece un régimen de incentivos por pago oportuno de los Impuestos Municipales a la Propiedad de Bienes Inmuebles y Vehículos Automotores, mediante descuentos que se aplicarán sobre el impuesto determinado, de acuerdo a los siguientes plazos:


<table border="1" cellpadding="5" cellspacing="0">
<thead>
    <tr>
    <th>PLAZO</th>
    <th>DESCUENTOS SOBRE IMPUESTO DETERMINADO</th>
    </tr>
</thead>
<tbody>
    <tr>
    <td>Desde el primer día hábil de Enero hasta el último día hábil de Abril</td>
    <td>20%</td>
    </tr>
    <tr>
    <td>Desde el día siguiente de vencido el plazo anterior hasta el último día hábil de Agosto</td>
    <td>15%</td>
    </tr>
    <tr>
    <td>Desde el día siguiente de vencido el plazo anterior hasta el último día hábil de Diciembre</td>
    <td>10%</td>
    </tr>
</tbody>
</table>

<h2>ARTÍCULO 28°.-</h2> (Excepciones).- El contribuyente que se acoja a planes de pago no será beneficiado con los descuentos establecidos en el Artículo 27 de la presente Ley Municipal.
<br>
DISPOSICIONES TRANSITORIAS
<br>
DISPOSICIÓN TRANSITORIA PRIMERA.- El H. Alcalde Municipal de la ciudad de El Alto, podrá Reglamentar y modificar la alícuota del porcentaje de impuestos a la transferencia de vehículos automotores sobre la base imponible determinada, conforme al artículo veintitrés de la Ley Municipal 003/2012.
<br>
De manera excepcional hasta el 31 de diciembre de la gestión 2013, se aplicará la alícuota del uno punto cinco por ciento (1.5%) en el caso de la transferencia de vehículos automotores, sobre la base imponible determinada conforme al artículo veintitrés de la Ley Municipal No. 003/2012.
<br>
DISPOSICIÓN TRANSITORIA SEGUNDA.-Para el pago de los Impuestos Municipales de Bienes Inmuebles y Vehículos Automotores correspondientes a la gestión 2012, excepcionalmente se aplicará los siguientes descuentos:

<table border="1" cellpadding="5" cellspacing="0">
<thead>
    <tr>
    <th>DESCUENTO</th>
    <th>PLAZO</th>
    </tr>
</thead>
<tbody>
    <tr>
    <td>20%</td>
    <td>Desde la publicación de la resolución Técnica Administrativa de inicio de cobro hasta el último día hábil de Junio de 2013.</td>
    </tr>
    <tr>
    <td>15%</td>
    <td>Desde el día siguiente de vencido el plazo anterior hasta el último día hábil de Septiembre de 2013.</td>
    </tr>
    <tr>
    <td>10%</td>
    <td>Desde el día siguiente de vencido el plazo anterior hasta el último día hábil de Diciembre de 2013.</td>
    </tr>
</tbody>
</table>


Es dado en la sala de sesiones del H. Concejo Municipal de la Ciudad de El Alto a los doce días del mes de junio del dos mil trece años.


                    <!-- =============================================================================================================== -->

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