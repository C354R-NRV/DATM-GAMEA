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
    <title>DATM Ley Mun 03/12</title>
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
    <li class="breadcrumb-item text-white active" aria-current="page">Ley Municipal 003-2012</li>
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

<h1>GOBIERNO AUTÓNOMO MUNICIPAL DEL EL ALTO</h1>

<h3>23 de diciembre de 2012</h3>

<h2>LEY MUNICIPAL N° 003</h3>

<h3>DE CREACION DE IMPUESTOS MUNICIPALES</h2>

<h3>GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO</h3>

<p>
Arq. Edgar H. Patana Ticona
ALCALDE MUNICIPAL DE EL ALTO
</p>
<p>
Por cuanto el H. Consejo Municipal de la Ciudad de El Alto ha sancionado la siguiente Ley Municipal Autonómica:
</p>
<input type="hidden" id="recurso_" value="m03">
<h1><span id="tituloPrincipal">
LEY MUNICIPAL N° 003
DE CREACION DE IMPUESTOS MUNICIPALES
EL ORGANO LEGISLATIVO DEL GOBIERNO AUTÓNOMO MUNICIPAL EL ALTO</span>
</h1>

<h2>CAPITULO I</h2>

OBJETO

<h4>ARTÍCULO 1</h4> (Objeto de la presente Ley) El objeto de la presente Ley es crear los impuestos de dominio municipal de la propiedad de bienes inmuebles, a la propiedad de vehículos automotores terrestres y a las transferencias onerosas de bienes inmuebles y vehículos automotores de competencia exclusiva del Gobierno Autónomo Municipal de El Alto, conforme a la Constitución Política del Estado, a la Ley N° 031 de la 19 de julio de 2010, Marco de Autonomías y Descentralización y a la Ley N° 154 de 14 de julio de 2011, de Clasificación y Definición de Impuestos y de Regulación para la creación y/o Modificación de Impuestos de Dominio de los Gobiernos Autónomos.

<h4>ARTÍCULO 2</h4> (Actualización) A los fines de aplicación de los Capítulos II y III de la presente Ley Municipal, el Gobierno Autónomo Municipal de El Alto podrá actualizar anualmente los montos establecidos en los distintos tramos de las escalas a que se refieren los Artículos 10 y 16 de esta Ley, sobre la base de la variación de la cotización oficial de la Unidad de Fomento de la Vivienda(UFV) respecto al boliviano, producida entre la fecha de publicación de esta Ley y treinta(30) días antes de la fecha de vencimiento general que se establezca en cada año, tomando en cuenta que el año se encuentra comprendido entre el 1° de enero al 31 de diciembre de cada gestión.
 La actualización se efectuará siempre que haya crecimiento de la UFV respecto del Boliviano y no así cuando existiere decremento del al UFV.
<h2>CAPITULO II</h2>
IMPUESTO MUNICIPAL A LA PROPIEDAD DE BIENES INMUEBLES

<h4>ARTÍCULO 3</h4>(Objeto de impuesto).- Créase impuesto anual municipal a la propiedad inmueble situada en el territorio que comprende el Municipio de El Alto, que se regirá por las disposiciones de este Capítulo.

<h4>ARTÍCULO 4</h4>(Exclusiones).-
I. La pequeña propiedad agraria y la propiedad comunitaria o colectiva con los bienes que se encuentren en ella, están excluidas del pago del impuesto de conformidad a la Constitución Política del Estado <h4>ARTÍCULO 394</h4> parágrafos  II y III y al <h4>ARTÍCULO 8</h4> inciso a) de la Ley N° 154, de la Clasificación y Definición de Impuestos y de la Regulación para la Creación y/o Modificación de Impuestos de Dominio de los Gobiernos Autónomos.
II. En ningún caso estarán afectados a este tipo de inmuebles, las construcciones e instalaciones desde que queden comprendidas en el derecho de vía o dentro de las áreas de operación que integren la concesión, según la naturaleza de cada una de ellas y de sus áreas de servicios adicionales, conforme a lo establecido en la legislación tributaria vigente y lo indicadlo en el numera 1 del <h4>ARTÍCULO 31</h4> y en el <h4>ARTÍCULO 60</h4> de La Ley N° 1874, Ley General de Concesiones de Obras  Públicas de Transporte, de 22 de junio de 1998.

<h4>ARTÍCULO 5</h4> (Sujeto Pasivo).-
I. Son sujetos pasivos de este impuesto las personas jurídicas o naturales y las sucesiones indivisas que sean propietarias de cualquier tipo de inmueble, incluidas tierras rurales obtenidas por títulos ejecutoriales de reforma agraria, dotación, consolidación, adjudicación, por compra y cualquier otra forma de adquisición y/o transferencia. 
II. Los copropietarios de inmuebles pagarán solidariamente este impuesto que grava el bien inmueble, excepto en los regímenes de copropiedad en los que existan áreas o construcciones de propiedad exclusiva. En este último caso, cada propietario responderá por el impuesto aplicable a su propiedad y la fracción ideal que le corresponde sobre la parte común.

<h4>ARTÍCULO 6</h4> (Hecho Generador y su perfeccionamiento).- El hecho generador de este impuesto está constituido por el ejercicio de la propiedad de bienes inmuebles urbanos o rurales, al 31 de diciembre de cada año, a partir de la presente gestión, en la jurisdicción municipal de El Alto.

<h4>ARTÍCULO 7</h4> (Exenciones).- Están exentos de este Impuesto:
a) Los inmuebles de propiedad de Gobierno Central, de las Gobernaciones Departamentales, de los Gobiernos Municipales y de las Instituciones Públicas.
b) Los inmuebles afectados a actividades no comerciales ni industriales propiedad de asociaciones, fundaciones o instituciones no lucrativas autorizadas legalmente, tales como: religiosas, de caridad, de beneficencia, asistencias social, educativas, científicas, ecológicas, artísticas, literarias, deportivas, políticas, profesionales, sindicales o gremiales.
Esta franquicia procederá siempre que, por disposición expresa de sus estatutos, la totalidad de los ingresos y el patrimonio de las mencionadas instituciones se destinen exclusivamente a los fines enumerados, que en ningún caso se distribuyan directamente entre asociados y que, en caso de liquidación, su patrimonio se distribuya entre entidades de igual objeto o se done a instituciones públicas. Como condición para el goce de esta exención, las entidades beneficiarias deberán solicitar su reconocimiento como entidades exentas ante la Administración Tributaria.
c) Los inmuebles pertenecientes a las misiones diplomáticas y consulares extranjeras acreditadas en el país, así como los pertenecientes a organismos internacionales.
d) Los inmuebles para vivienda de propiedad de los beneméritos de la Campaña del Chaco o sus viudas u que les servirá de vivienda permanente, hasta el año de su fallecimiento y hasta el topo del primer tramo contemplado en la escala establecida por el <h4>ARTÍCULO 10</h4> de esta Ley.
e) Las personas de 60 o más años, propietarias de inmuebles de interés social o de tipo económico que le servirá de vivienda permanente, tendrán una rebaja del 20% en el impuesto anual, hasta el límite del primer tramo contemplado en la escala establecida por el <h4>ARTÍCULO 10</h4> de esta Ley.

<h4>ARTÍCULO 8</h4>(Base imponible).- LA Base imponible de este impuesto estará constituida por el avalúo fiscal establecido en la jurisdicción municipal de El Alto en aplicación de las normas catastrales y técnico-tributarias urbanas y rurales emitidas por el Gobierno Autónomo Municipal de El Alto.

<h4>ARTÍCULO 9</h4>(Autoavalúo).-
I. Mientras no se practiquen los avalúos fiscales a que se refiere el Artículo anterior, la base imponible estará dada por el autoavalúo que practicaran los propietarios de acuerdo a lo que establezca la reglamentación que emitirá el Órgano Ejecutivo del Gobierno Autónomo Municipal del EL Alto sentando las bases técnicas sobre las que recaudará este impuesto.
II. Estos avalúos estarán sujetos a fiscalización por la Administración Tributaria Municipal.
III. El autoavalúo practicado por los propietarios será considerado como justiprecio para los efectos de expropiación, de ser el caso.
IV. Los Bienes Inmuebles dedicados exclusivamente a la actividad hotelera y que formen parte de los activos fijos de la empresa hotelera, a efectos del pago del Impuesto Municipal a la Propiedad de Bienes Inmuebles, serán valuados tomando en cuenta el cincuenta por ciento (50%) de la base imponible obtenida de acuerdo a los procedimientos establecidos por el Capítulo II de esta Ley, por el plazo de cuatro (4) años a partir de la promulgación de la presente Ley.

<h4>ARTÍCULO 10</h4>(Alícuotas).- El impuesto a pagar se determinará aplicando sobre la base imponible de las alícuotas previstas en la escala contenida en el <h4>ARTÍCULO 11</h4> de la presente Ley Municipal.

<h4>ARTÍCULO 11</h4>(Escala impositiva).- Las alícuotas del impuesto son las que se expresan en la siguiente escala:
MONTO DE VALUACIÓN
De más de 	Hasta			Bs.	Más el %	s/excedente de
Bs.0		Bs. 430.192	0	0.35		Bs. 0
Bs. 430.193		Bs. 860.382	1.506	0.50		Bs. 430.192
Bs. 860.383		Bs. 1.290.573	3,657	1.00		Bs. 860.382
Bs. 1.290.574	Bs. En adelante 7.959	1.50		Bs. 1.290.573

La base imponible para la liquidación del impuesto que grava la propiedad inmueble agraria será la que establezca el propietario de acuerdo al valor que éste atribuya a su inmueble. En los demás, se aplicarán las normas comunes de dicho. El propietario no podrá modificar el valor declarado después de los noventa (90) días, del vencimiento del plazo legalmente establecido con carácter general para la declaración y pago del impuesto.
En el caso de la propiedad inmueble agraria, el pago del impuesto se determinará aplicando una alícuota del 0.25% a la base imponible definida en el parágrafo I del <h4>ARTÍCULO 4</h4> de la Ley N° 1715
En el plazo para el pago de este impuesto vencerá el 28 de diciembre del año siguiente al periodo fiscal, Para pagos con anterioridad a la fecha de vencimiento, el Ejecutivo Municipal mediante Resolución  Administrativa, podrá establecer el siguiente régimen de incentivos:
* Primer Cuatrimestre , hasta el 20% de descuento al impuesto determinado
* Segundo Cuatrimestre , hasta el 15% de descuento al impuesto determinado
* Tercer Cuatrimestre , hasta el 10% de descuento al impuesto determinado

<h2>CAPÍTULO III</h2>

IMPUESTO MUNICIPAL A LA PROPIEDAD DE VEHÍCULOS AUTOMOTORES TERRESTRES

OBJETO-SUJETO PASIVO

<h4>ARTÍCULO 12</h4> (Objeto de este impuesto y sujeto pasivo).-
Créase un impuesto anual a la propiedad de los vehículos automotores de cualquier clase o categoría: automóviles, camionetas, jeeps, furgonetas, motocicletas, etc., inscritos en el Registro Tributario del Municipio de El Alto, que se regirá por las disposiciones de este Capítulo.

<h4>ARTÍCULO 13</h4>(Sujeto Pasivo).- Son sujetos pasivos de este impuesto las personas jurídicas o naturales y las sucesiones indivisas, propietarias de cualquier vehículo automotor terrestre.

<h4>ARTÍCULO 14</h4>(Hecho Generador y su perfeccionamiento).- El hecho generador de este impuesto está constituido por el ejercicio de la propiedad del vehículo automotor terrestre, al 31 de diciembre de cada año, a partir de la presente gestión, en la jurisdicción municipal de El Alto.

<h4>ARTÍCULO 15</h4>(Exenciones).- Están exentos de este impuesto:
a) Los vehículos automotores de propiedad del Gobierno Central, de las Gobernaciones Departamentales, de los Gobiernos Municipales, y de las Instituciones Públicas. Esta exención  no alcanza a los vehículos automotores de las empresas públicas.
b) Los vehículos automotores pertenecientes a las misiones diplomáticas y consulares extranjeras y a sus miembros acreditados en el país, con motivo del directo desempeño de su cargo y a condición de reciprocidad. Asimismo, están exentos los vehículos automotores de los organismos internacionales así como de los funcionarios extranjeros de organismos internacionales, gobiernos extranjeros e instituciones oficiales extranjeras, con motivo del directo desempeño de su cargo.
<h4>ARTÍCULO 16</h4>(Base Imponible).- La base imponible estará dada por los valores de los vehículos automotores ex aduana que para los modelos correspondientes al último año de aplicación del tributo y anteriores establezca anualmente el Órgano Ejecutivo del Gobierno Municipal de El alto.
Sobre los valores que se determinen de acuerdo a lo dispuesto en el parágrafo precedente, se admitirá una depreciación anual del 20% (veinte por ciento) sobre saldos hasta alcanzar un valor residual mínimo del 10,7% (diez coma siete por ciento) del valor de origen, que se mantendrá fijo hasta que el bien sea dado de baja de circulación.

<h4>ARTÍCULO 17</h4>(Alícuotas).- El impuesto se determinará aplicando sobre la base imponible las alícuotas que se indican a continuación sobre los valores determinados de acuerdo con el artículo anterior.
MONTO DE VALUACIÓN
De más de		Hasta			Bs. 		Mas el %	s/excedente de
Bs. 0			Bs. 54.196		0		1.5		Bs. 0
Bs. 54.197		Bs. 162.585		1.084		2.0		Bs. 54.196
Bs. 162.586		Bs. 325.169		3.793		3.0		Bs. 162.585
Bs. 325.170		Bs. 650.339		9.484		4.0		Bs. 325.169
Bs. 650.340		En adelante 		24.116		5.0		Bs. 650.339
En el caso de transporte público de pasajeros y carga urbana y de larga distancia siempre que se trate de servicios que cuenten con la correspondiente autorización y autoridad competente, el impuesto se determinará aplicando el 50% (cincuenta por ciento) de las alícuotas que se indican en este Artículo.

<h2>CAPITULO IV</h2>

IMPUESTO MUNICIPAL A LAS TRANSFERENCIAS ONEROSAS DE INMUEBLES Y VEHÍCULOS AUTOMOTORES

<h4>ARTÍCULO 18</h4>(Objeto de este impuesto).-
I. Créase el Impuesto Municipal a las Transferencias de Inmuebles y Vehículos Automotores que grava las transferencias onerosas de inmuebles y vehículos automotores como impuesto de dominio tributario municipal, de competencia exclusiva del Gobierno Autónomo Municipal de El Alto.
II. No están alcanzadas por este Impuesto las transferencias que, a pesar de ser onerosas sean efectuadas por personas que tengan por giro de negocio esta actividad o por empresas unipersonales y sociedades  con esa actividad comercial.

<h4>ARTÍCULO 19</h4>(Sujeto activo).- Este impuesto se pagará al Gobierno Autónomo Municipal de El Alto siempre que en su jurisdicción se encuentre ubicado el bien inmueble objeto de la transferencia gravada por este impuesto o en cuyos registros se encuentre inscrito el vehículo automotor objeto de la transferencia.

<h4>ARTÍCULO 20</h4>(Sujeto pasivo).- Las obligaciones tributarias de este impuesto recaen sobre la persona natural o jurídica a cuyo nombre se encuentre registrado el bien objeto de la transferencia.

<h4>ARTÍCULO 21</h4>(Hecho generador).- 
I. El hecho generador queda perfeccionado en la fecha en que tenga lugar la celebración del acto jurídica a título oneroso en virtud del cual se transfiere la propiedad del bien mueble y/o vehículo.
II. En el caso de arrendamiento financiero, el hecho generador queda perfeccionado en el monto del pago final del saldo del precio, cuando el arrendamiento ejerce la opción de compra. En las operaciones de arrendamiento financiero bajo la modalidad de "lease back", la primera transferencia no ésta sujeta a este impuesto.

<h4>ARTÍCULO 22</h4>(Base Imponible).-
I. La base imponible de este impuesto estará dada por el valor efectivamente pagado en dinero y/o en especie por el bien objeto de la transferencia o el que se hubiere determinado para el pago de Impuesto Municipal a la Propiedad de Bienes Inmuebles o para el pago del Impuesto Municipal a la Propiedad de Vehículos Automotores correspondiente a la última gestión vencida, el que fuere mayor.
II. En el caso de arrendamiento financiero, se aplicará lo dispuesto en la primera parte de parágrafo I de este Artículo, únicamente sobre el saldo del precio pagado cuando el arrendamiento ejerce la opción de compra.
III. En los casos en que la transferencia sea realizada con la intervención de terceros intermediarios (inmobiliarias, casas de compra-venta, permuta y/o consignación de inmuebles y/o vehículos automotores) no forman parte de la base imponible de este impuesto las comisiones similares pagadas a dichos terceros, sean éstos personas naturales o jurídicas, debiendo estos terceros intermediarios emitir la factura, nota fiscal o documento equivalente por la comisión recibida de cualquiera o ambas partes.

<h4>ARTÍCULO 23</h4>(Alícuota).- Sobre la base imponible determinada al Artículo precedente se aplicará una alícuota del uno coma cinco por ciento (1.5%) en el caso de transferencia de vehículos automotores entre personas  naturales y la alícuota del tres por ciento (3%) en el caso de transferencias de bienes inmuebles.

<h4>ARTÍCULO 24</h4>(Exenciones).-
I. Están exentos del pago de este impuesto, siempre que sean sujeto pasivo del mismo, el Estado, las misiones diplomáticas y consulares acreditadas en el país y los organismos internacionales.
II. Quedan exentas del pago de este impuesto, las transferencias por concepto de expropiación por utilidad pública, al efecto deberá emitirse la reglamentación respectiva.
III. No están exentas las transferencias de bienes inmuebles o de vehículos automotores de las empresas públicas.

DISPOSICIONES FINALES
Disposición Final Única.- La presente Ley entrará en vigencia a partir de su publicación, debiendo ser posteriormente reglamentada.

DISPOSICIONES ADICIONALES
Disposición Adicional Única.- El Ejecutivo Municipal debe pronunciarse en el plazo de 10 días calendario a partir de la recepción de la presente Ley Autonómica Municipal, posteriormente remitirse a la Autoridad Fiscal en el plazo previsto en el <h4>ARTÍCULO 25</h4> de La Ley 154.
Remítase al Órgano Ejecutivo Municipal para los fines correspondientes de Ley.

Es dada en la Sede de la Federación Andina de Choferes "1ro. De Mayo" ubicada en la zona de Villa Dolores del Distrito Municipal N° 1 de la ciudad de EL Alto a los siete días del mes de diciembre de dos mil doce años.

Firmado por: H. Zacarias Maquera Chura
PRESIDENTE H. CONCEJO MUNICIPAL DE EL ALTO

Walter Alborada Calderon 
CONSEJAL SECRETETARIO H. CONCEJO MUNICIPAL DE EL ALTO

Por lo tanto la promulgo para que se tenga y cumpla como Ley Municipal del Gobierno Autónomo Municipal de El alto, a los veinte días del mes de diciembre del año dos mil doce.





















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