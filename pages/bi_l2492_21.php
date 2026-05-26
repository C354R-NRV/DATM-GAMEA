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


                    <h1>LEY 2492 (2021)</h1>
                    <input type="hidden" id="recurso_" value="l2492_21">
                    <h2><span id="tituloPrincipal">CODIGO TRIBUTARIO BOLIVIANO - 2021</span></h2>

                    <h2>Y DECRETOS REGLAMENTARIOS TEXTO ORDENADO, COMPLEMENTADO Y ACTUALIZADO AL 31/03/2021</h2>

                    Los editores aclaran que el texto contenido en la presente publicación persigue solamente fines de divulgación y socialización de la Normativa Tributaria, reservándose la fidelidad de las mismas. Para cualquier referencia de orden legal los lectores deberán remitirse a las publicaciones oficiales realizadas por la Gaceta Oficial del Estado Plurinacional de Bolivia.<br>

                    N° de Depósito Legal:<br>
                    18 19 P.O.<br>

                    <h3>"LA LEY DE 17 DE DICIEMBRE DE 1956 Y LOS DECRETOS SUPREMOS N° 27466 Y N° 27113 HAN ENCOMENDADO A LA GACETA OFICIAL DE BOLIVIA, EL REGISTRO Y PUBLICACIÓN DE TODOS LOS TEXTOS PROMULGADOS Y APROBADOS POR EL PODER EJECUTIVO, ACTUAL ÓRGANO EJECUTIVO, POR LO QUE LA PRESENTE PUBLICACIÓN, NO SUSTITUYE A LA REALIZADA POR LA GACETA OFICIAL DE BOLIVIA"</h3>

                    <h3>Título I
                        NORMAS SUSTANTIVAS Y MATERIALES</h3>

                    <h3>CAPÍTULO I
                        DISPOSICIONES PRELIMINARES</h3>

                    <h4>SECCIÓN I:
                        ÁMBITO DE APLICACIÓN, VIGENCIA Y PLAZOS</h4>

                    <h4>ARTÍCULO 1</h4> (ÁMBITO DE APLICACIÓN). Las disposiciones de este Código establecen los principios, instituciones, procedimientos y las normas fundamentales que regulan el régimen jurídico del sistema tributario boliviano y son aplicables a todos los tributos de carácter nacional, departamental, municipal y universitario.

                    <h4>ARTÍCULO 2</h4> (ÁMBITO ESPACIAL). Las normas tributarias tienen aplicación en el ámbito territorial sometido a la facultad normativa del órgano competente para dictarlas, salvo que en ellas se establezcan límites territoriales más restringidos.

                    Tratándose de tributos aduaneros, salvo lo dispuesto en convenios internacionales o leyes especiales, el ámbito espacial está constituido por el territorio nacional y las áreas geográficas de territorios extranjeros donde rige la potestad aduanera, en virtud a Tratados o Convenios Internacionales suscritos por el Estado.

                    <h4>ARTÍCULO 3</h4> (VIGENCIA). Las normas tributarias regirán a partir de su publicación oficial o desde la fecha que ellas determinen, siempre que hubiera publicación previa.

                    <h5>Nota del Editor:</h5>
                    Ley N° 031 de 19/07/2010; Ley Marco de Autonomías y Descentralización "Andrés Ibáñez", mediante las Disposiciones Abrogatorias y Derogatorias, Disposiciones Derogatorias, Numeral 1, derogó el Segundo Párrafo del Artículo precedente.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 2, señala lo siguiente:

                    "ARTÍCULO 2 (VIGENCIA).
                    <br>I. A efecto de la aplicación de lo dispuesto en el Artículo 3 de la Ley N° 2492, en tanto
                    la Administración Tributaria no cuente con órganos de difusión propios, será válida la
                    publicación realizada en al menos un medio de prensa de circulación nacional.

                    <br>II. En el caso de tributos municipales, la publicación de las Ordenanzas Municipales de Tasas y Patentes se realizará juntamente con la Resolución Senatorial respectiva.
                    Tanto ésta como las normas reglamentarias administrativas, podrán publicarse en un medio de prensa de circulación nacional o local y en los que no existiera, se difundirán a través de otros medios de comunicación locales".

                    <h5>Nota del Editor:</h5>
                    Ley N° 031 de 19/07/2010; Ley Marco de Autonomías y Descentralización "Andrés Ibáñez", mediante las Disposiciones Abrogatorias y Derogatorias, Disposiciones Derogatorias, Numeral 1, derogó implícitamente la primera parte del Parágrafo II del Artículo precedente.

                    <h4>ARTÍCULO 4</h4> (PLAZOS Y TÉRMINOS). Los plazos relativos a las normas tributarias son perentorios y se computarán en la siguiente forma:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Los plazos en meses se computan de fecha a fecha y si en el mes de vencimiento no hubiera día equivalente, se entiende que el plazo acaba el último día del mes. Si el plazo se fija en años, se entenderán siempre como años calendario.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Los plazos en días que determine este Código, cuando la norma aplicable no disponga expresamente lo contrario, se entenderán siempre referidos a días hábiles administrativos en tanto no excedan de diez (10) días y siendo más extensos se computarán por días corridos.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Los plazos y términos comenzarán a correr a partir del día siguiente hábil a aquel en que tenga lugar la notificación o publicación del acto y concluyen al final de la última hora del día de su vencimiento.
                    En cualquier caso, cuando el último día del plazo sea inhábil se entenderá siempre prorrogado al primer día hábil siguiente.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. Se entienden por momentos y días hábiles administrativos, aquellos en los que la Administración Tributaria correspondiente cumple sus funciones, por consiguiente, los plazos que vencieren en día inhábil para la Administración Tributaria, se entenderán prorrogados hasta el día hábil siguiente.

                    En el cómputo de plazos y términos previstos en este Código, no surte efecto el término de la distancia.

                    Sentencia Constitucional 0079/2006, de 16 de octubre de 2006: En el Recurso Indirecto o Incidental de Inconstitucionalidad, en el cual se demanda la Inconstitucionalidad del último párrafo del Artículo 4 de la Ley N° 2492 (Código Tributario Boliviano CTB), por considerarlo contrario al principio de igualdad y al debido proceso consagrados por los Artículos 6 Parágrafo I y 16 Parágrafo IV de la Constitución Política del Estado (CPE).

                    El Tribunal Constitucional declara INCONSTITUCIONAL el último párrafo del Artículo 4 del Código Tributario Boliviano (CTB). Con los efectos derogatorios establecidos en el Artículo 58, Parágrafo III de la Ley del Tribunal Constitucional.

                    <h4>SECCIÓN II:
                        FUENTES DEL DERECHO TRIBUTARIO</h4>

                    <h4>ARTÍCULO 5</h4> (FUENTE, PRELACIÓN NORMATIVA Y DERECHO SUPLETORIO).

                    <br>I. Con carácter limitativo, son fuente del Derecho Tributario con la siguiente prelación normativa:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. La Constitución Política del Estado.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Los Convenios y Tratados Internacionales aprobados por el Poder Legislativo.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. El presente Código Tributario.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. Las Leyes.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;5. Los Decretos Supremos.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;6. Resoluciones Supremas.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;7. Las demás disposiciones de carácter general dictadas por los órganos administrativos facultados al efecto con las limitaciones y requisitos de formulación establecidos en este Código.

                    También constituyen fuente del Derecho Tributario las Ordenanzas Municipales de tasas y patentes, aprobadas por el Honorable Senado Nacional, en el ámbito de su jurisdicción y competencia.

                    <br>II. Tendrán carácter supletorio a este Código, cuando exista vacío en el mismo, los principios generales del Derecho Tributario y en su defecto los de otras ramas jurídicas que correspondan a la naturaleza y fines del caso particular.

                    <h4>ARTÍCULO 6</h4> (PRINCIPIO DE LEGALIDAD O RESERVA DE LEY).

                    <br>I. Sólo la Ley puede:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Crear, modificar y suprimir tributos, definir el hecho generador de la obligación tributaria; fijar la base imponible y alícuota o el límite máximo y mínimo de la misma; y designar al sujeto pasivo.<br>

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Excluir hechos económicos gravables del objeto de un tributo.<br>

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Otorgar y suprimir exenciones, reducciones o beneficios.<br>

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. Condonar total o parcialmente el pago de tributos, intereses y sanciones.<br>

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;5. Establecer los procedimientos jurisdiccionales.<br>

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;6. Tipificar los ilícitos tributarios y establecer las respectivas sanciones.<br>

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;7. Establecer privilegios y preferencias para el cobro de las obligaciones tributarias.<br>

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;8. Establecer regímenes suspensivos en materia aduanera.<br>

                    <h5>Nota del Editor:</h5>
                    Ley N° 031 de 19/07/2010; Ley Marco de Autonomías y Descentralización "Andrés Ibáñez", mediante las Disposiciones Abrogatorias y Derogatorias, Disposiciones Derogatorias, Numeral 1, derogó el Parágrafo II del Artículo precedente.

                    <h4>ARTÍCULO 7</h4> (GRAVAMEN ARANCELARIO). Conforme lo dispuesto en los acuerdos y convenios internacionales ratificados constitucionalmente, el Poder Ejecutivo mediante Decreto Supremo establecerá la alícuota del Gravamen Arancelario aplicable a la importación de mercancías cuando corresponda los derechos de compensación y los derechos antidumping.

                    <h4>ARTÍCULO 8</h4> (MÉTODOS DE INTERPRETACIÓN Y ANALOGÍA).

                    <br>I. Las normas tributarias se interpretarán con arreglo a todos los métodos admitidos en Derecho, pudiéndose llegar a resultados extensivos o restrictivos de los términos contenidos en aquellas. En exenciones tributarias serán interpretados de acuerdo al método literal.

                    <br>II. Cuando la norma relativa al hecho generador se refiera a situaciones definidas por otras ramas jurídicas, sin remitirse ni apartarse expresamente de ellas, la interpretación deberá asignar el significado que más se adapte a la realidad económica. Para determinar la verdadera naturaleza del hecho generador o imponible, se tomará en cuenta:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Cuando el sujeto pasivo adopte formas jurídicas manifiestamente inapropiadas o atípicas a la realidad económica de los hechos gravados, actos o relaciones económicas subyacentes en tales formas, la norma tributaria se aplicará prescindiendo de esas formas, sin perjuicio de la eficacia jurídica que las mismas tengan en el ámbito civil u otro.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) En los actos o negocios en los que se produzca simulación, el hecho generador gravado será el efectivamente realizado por las partes con independencia de las formas o denominaciones jurídicas utilizadas por los interesados. El negocio simulado será irrelevante a efectos tributarios.

                    <br>III. La analogía será admitida para llenar los vacíos legales, pero en virtud de ella no se podrán crear tributos, establecer exclusiones ni exenciones, tipificar delitos y definir contravenciones, aplicar sanciones, ni modificar normas existentes.

                    <h3>CAPÍTULO II
                        LOS TRIBUTOS</h3>

                    <h4>ARTÍCULO 9</h4> (CONCEPTO Y CLASIFICACIÓN).

                    <br>I. Son tributos las obligaciones en dinero que el Estado, en ejercicio de su poder de imperio, impone con el objeto de obtener recursos para el cumplimiento de sus fines.

                    <br>II. Los tributos se clasifican en: impuestos, tasas, contribuciones especiales; y

                    <br>III. Las Patentes Municipales establecidas conforme a lo previsto por la Constitución Política del Estado, cuyo hecho generador es el uso o aprovechamiento de bienes de dominio público, así como la obtención de autorizaciones para la realización de actividades económicas.

                    <h4>ARTÍCULO 10</h4> (IMPUESTO). Impuesto es el tributo cuya obligación tiene como hecho generador una situación prevista por Ley, independiente de toda actividad estatal relativa al contribuyente.

                    <h4>ARTÍCULO 11</h4> (TASA).

                    <br>I. Las tasas son tributos cuyo hecho imponible consiste en la prestación de servicios o la realización de actividades sujetas a normas de Derecho Público individualizadas en el sujeto pasivo, cuando concurran las dos (2) siguientes circunstancias:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Que dichos servicios y actividades sean de solicitud o recepción obligatoria por los administrados.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Que para los mismos, esté establecida su reserva a favor del sector público por referirse a la manifestación del ejercicio de autoridad.

                    <br>II. No es tasa el pago que se recibe por un servicio de origen contractual o la contraprestación recibida del usuario en pago de servicios no inherentes al Estado.

                    <br>III. La recaudación por el cobro de tasas no debe tener un destino ajeno al servicio o actividad que constituye la causa de la obligación.

                    <h4>ARTÍCULO 12</h4> (CONTRIBUCIONES ESPECIALES). Las contribuciones especiales son los tributos cuya obligación tiene como hecho generador, beneficios derivados de la realización de determinadas obras o actividades estatales y cuyo producto no debe tener un destino ajeno a la financiación de dichas obras o actividades que constituyen el presupuesto de la obligación. El tratamiento de las contribuciones especiales emergentes de los aportes a los servicios de seguridad social se sujetará a disposiciones especiales, teniendo el presente Código carácter supletorio.

                    <h3>CAPÍTULO III
                        RELACIÓN JURÍDICA TRIBUTARIA</h3>

                    <h4>SECCIÓN I: OBLIGACIÓN TRIBUTARIA</h4>

                    <h4>ARTÍCULO 13</h4> (CONCEPTO). La obligación tributaria constituye un vínculo de carácter personal, aunque su cumplimiento se asegure mediante garantía real o con privilegios especiales.

                    En materia aduanera la obligación tributaria y la obligación de pago se regirán por Ley especial.

                    <h4>ARTÍCULO 14</h4> (INOPONIBILIDAD).

                    <br>I. Los convenios y contratos celebrados entre particulares sobre materia tributaria en ningún caso serán oponibles al fisco, sin perjuicio de su eficacia o validez en el ámbito civil, comercial u otras ramas del derecho.

                    <br>II. Las estipulaciones entre sujetos de derecho privado y el Estado, contrarias a las leyes tributarias, son nulas de pleno derecho.

                    <h4>ARTÍCULO 15</h4> (VALIDEZ DE LOS ACTOS). La obligación tributaria no será afectada por ninguna circunstancia relativa a la validez o nulidad de los actos, la naturaleza del contrato celebrado, la causa, el objeto perseguido por las partes, ni por los efectos que los hechos o actos gravados tengan en otras ramas jurídicas.

                    <h4>SECCIÓN II: HECHO GENERADOR</h4>

                    <h4>ARTÍCULO 16</h4> (DEFINICIÓN). Hecho generador o imponible es el presupuesto de naturaleza jurídica o económica expresamente establecido por Ley para configurar cada tributo, cuyo acaecimiento origina el nacimiento de la obligación tributaria.

                    <h4>ARTÍCULO 17</h4> (PERFECCIONAMIENTO). Se considera ocurrido el hecho generador y existentes sus resultados:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. En las situaciones de hecho, desde el momento en que se hayan completado o realizado las circunstancias materiales previstas por Ley.<br>

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. En las situaciones de derecho, desde el momento en que están definitivamente constituidas de conformidad con la norma legal aplicable.<br>
                    16
                    <h4>ARTÍCULO 18</h4> (CONDICIÓN CONTRACTUAL). En los actos jurídicos sujetos a condición contractual, si las normas jurídicas tributarias especiales no disponen lo contrario, el hecho generador se considerará perfeccionado:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. En el momento de su celebración, si la condición fuera resolutoria.<br>

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Al cumplirse la condición, si ésta fuera suspensiva.<br>

                    <h4>ARTÍCULO 19</h4> (EXENCIÓN, CONDICIONES, REQUISITOS Y PLAZO).

                    <br>I. Exención es la dispensa de la obligación tributaria materia; establecida expresamente por Ley.

                    <br>II. La Ley que establezca exenciones, deberá especificar las condiciones y requisitos exigidos para su procedencia, los tributos que comprende, si es total o parcial y en su caso, el plazo de su duración.

                    <h4>ARTÍCULO 20</h4> (VIGENCIA E INAFECTABILIDAD DE LAS EXENCIONES).

                    <br>I. Cuando la Ley disponga expresamente que las exenciones deben ser formalizadas ante la Administración correspondiente, las exenciones tendrán vigencia a partir de su formalización.

                    <br>II. La exención no se extiende a los tributos instituidos con posterioridad a su establecimiento.

                    <br>III. La exención, con plazo indeterminado aún cuando fuera otorgada en función de ciertas condiciones de hecho, puede ser derogada o modificada por Ley posterior.

                    <br>IV. Cuando la exención esté sujeta a plazo de duración determinado, la modificación o derogación de la Ley que la establezca no alcanzará a los sujetos que la hubieran formalizado o se hubieran acogido a la exención, quienes gozarán del beneficio hasta la extinción de su plazo.

                    <h4>SECCIÓN III:
                        SUJETOS DE LA RELACIÓN JURÍDICA TRIBUTARIA</h4>

                    <h4>SUBSECCIÓN I: SUJETO ACTIVO</h4>

                    <h4>ARTÍCULO 21</h4> (SUJETO ACTIVO). El sujeto activo de la relación jurídica tributaria es el Estado, cuyas facultades de recaudación, control, verificación, valoración, inspección previa, fiscalización, liquidación, determinación, ejecución y otras establecidas en este Código son ejercidas por la Administración Tributaria nacional, departamental y municipal dispuestas por Ley. Estas facultades constituyen actividades inherentes al Estado.

                    Disposiciones Relacionadas: Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 3, Parágrafos I y II, señala lo siguiente:
                    "ARTÍCULO 3 (SUJETO ACTIVO).
                    <br>I. A efectos de la Ley N° 2492, se entiende por Administración o Administración Tributaria a cualquier ente público con facultades de gestión tributaria expresamente otorgadas por Ley.

                    <br>II. En el ámbito municipal, las facultades a que se refiere el Artículo 21 de la Ley citada, serán ejercitadas por la Dirección de Recaudaciones o el órgano facultado para cumplir estas funciones mediante Resolución Técnica Administrativa emitida por la máxima autoridad ejecutiva municipal.
                    (...)".

                    Las actividades mencionadas en el párrafo anterior, podrán ser otorgadas en concesión a empresas o sociedades privadas.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en sus Artículos 3 Parágrafos III y IV, 48 y 49, señalan lo siguiente:

                    "ARTÍCULO 3 (SUJETO ACTIVO).
                    (...)
                    <br>III. La concesión a terceros de actividades de alcance tributario previstas en la Ley N° 2492, requerirá la autorización previa de la máxima autoridad normativa del Servicio de Impuestos Nacionales o de la Aduana Nacional y de una Ordenanza Municipal en el caso de los Gobiernos Municipales, acorde con lo establecido en el Artículo 21 de la mencionada ley.
                    En el caso de la Aduana Nacional, si dichas actividades o servicios no son otorgados en concesión, serán prestados por dicha entidad con arreglo a lo dispuesto en el inciso a) del Artículo 29 del Reglamento a la Ley General de Aduanas.
                    <br>IV. Por medio de su máxima autoridad ejecutiva y cumpliendo las normas legales de control gubernamental, las Administraciones Tributarias podrán suscribir convenios o contratos con entidades públicas y privadas para colaborar en las gestiones propias de su actividad institucional, estableciendo la remuneración correspondiente por la realización de tales servicios, debiendo asegurar, en todos los casos, que se resguarde el interés fiscal y la confidencialidad de la información tributaria.
                    (...)".
                    "ARTÍCULO 48 (FACULTADES DE CONTROL). La Aduana Nacional ejercerá las facultades de control establecidas en los Artículos 21 y 100 de la Ley N° 2492 en las fases de: control anterior, control durante el despacho (aforo) u otra operación aduanera y control diferido. La verificación de calidad, valor en aduana, origen u otros aspectos que no puedan ser evidenciados durante estas fases, podrán ser objeto de fiscalización posterior".
                    "ARTÍCULO 49 (FACULTADES DE FISCALIZACIÓN). La Aduana Nacional ejercerá las facultades de fiscalización en aplicación de lo dispuesto en los Artículos 21, 100 y 104 de la Ley N° 2492.

                    Dentro del alcance del Artículo 100 de la Ley N° 2492, podrá:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Practicar las medidas necesarias para determinar el tipo, clase, especie, naturaleza, pureza, cantidad, calidad, medida, origen, procedencia, valor, costo de producción, manipulación, transformación, transporte y comercialización de las mercancías.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Realizar inspección e inventario de mercancías en establecimientos vinculados con el comercio exterior, para lo cual el operador de comercio exterior deberá prestar el apoyo logístico correspondiente (estiba, desestiba, descarga y otros).

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Realizar, en coordinación con las autoridades aduaneras del país interesado, investigaciones fuera del territorio nacional, con el objeto de obtener elementos de juicio para prevenir, investigar, comprobar o reprimir delitos y contravenciones aduaneras.

                    Las labores de fiscalización se realizarán con la presentación de la orden de fiscalización suscrita por la autoridad aduanera competente y previa identificación de los funcionarios aduaneros en cualquier lugar, edificio o establecimiento de personas naturales o jurídicas. En caso de resistencia, la Aduana Nacional recabará orden de allanamiento y requisa de la autoridad competente y podrá recurrir al auxilio de la fuerza pública.

                    Dentro del marco establecido en el Artículo 104 de la Ley N° 2492, la máxima autoridad normativa de la Aduana Nacional mediante resolución aprobará los procedimientos de fiscalización aduanera".


                    <h4>SUBSECCIÓN II: SUJETO PASIVO</h4>

                    <h4>ARTÍCULO 22</h4> (SUJETO PASIVO). Es sujeto pasivo el contribuyente o sustituto del mismo, quien debe cumplir las obligaciones tributarias establecidas conforme dispone este Código y las Leyes.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano en su Artículo 4, Inciso a) señala lo siguiente:

                    "ARTÍCULO 4 (RESPONSABLES DE LA OBLIGACIÓN TRIBUTARIA). Son responsables de la obligación tributaria: 19
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) El Sujeto pasivo en calidad de contribuyente o su sustituto en los términos definidos en la Ley N° 2492.
                    (...)".

                    <h4>ARTÍCULO 23</h4> (CONTRIBUYENTE). Contribuyente es el sujeto pasivo respecto del cual se verifica el hecho generador de la obligación tributaria. Dicha condición puede recaer:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. En las personas naturales prescindiendo de su capacidad según el derecho privado.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. En las personas jurídicas y en los demás entes colectivos a quienes las Leyes atribuyen calidad de sujetos de derecho.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. En las herencias yacentes, comunidades de bienes y demás entidades carentes de personalidad jurídica que constituyen una unidad económica o un patrimonio separado, susceptible de imposición. Salvando los patrimonios autónomos emergentes de procesos de titularización y los fondos de inversión administrados por Sociedades Administradoras de Fondos de Inversión y demás fideicomisos.

                    <h4>ARTÍCULO 24</h4> (INTRANSMISIBILIDAD). No perderá su condición de sujeto pasivo, quien según la norma jurídica respectiva deba cumplir con la prestación, aunque realice la traslación de la obligación tributaria a otras personas.

                    <h4>ARTÍCULO 25</h4> (SUSTITUTO). Es sustituto la persona natural o jurídica genéricamente definida por disposición normativa tributaria, quien en lugar del contribuyente debe cumplir las obligaciones tributarias, materiales y formales, de acuerdo con las siguientes reglas:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Son sustitutos en calidad de agentes de retención o de percepción, las personas naturales o jurídicas que en razón de sus funciones, actividad, oficio o profesión intervengan en actos u operaciones en los cuales deban efectuar la retención o percepción de tributos, asumiendo la obligación de empozar su importe al Fisco.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Son agentes de retención las personas naturales o jurídicas designadas para retener el tributo que resulte de gravar operaciones establecidas por Ley.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Son agentes de percepción las personas naturales o jurídicas designadas para obtener junto con el monto de las operaciones que originan la percepción, el tributo autorizado.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. Efectuada la retención o percepción, el sustituto es el único responsable ante el Fisco por el importe retenido o percibido, considerándose extinguida la deuda para el sujeto pasivo por dicho importe. De no realizar la retención o percepción, responderá solidariamente con el contribuyente, sin perjuicio del derecho de repetición contra éste.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;5. El agente de retención es responsable ante el contribuyente por las retenciones efectuadas sin normas legales o reglamentarias que las autoricen.

                    <h4>SUBSECCIÓN III: SOLIDARIDAD Y EFECTOS</h4>

                    <h4>ARTÍCULO 26</h4> (DEUDORES SOLIDARIOS).

                    <br>I. Están solidariamente obligados aquellos sujetos pasivos respecto de los cuales se verifique un mismo hecho generador, salvo que la Ley especial dispusiere lo contrario. En los demás casos la solidaridad debe ser establecida expresamente por Ley.

                    <br>II. Los efectos de la solidaridad son:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. La obligación puede ser exigida totalmente a cualquiera de los deudores a elección del sujeto activo.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. El pago total efectuado por uno de los deudores libera a los demás, sin perjuicio de su derecho a repetir civilmente contra los demás.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. El cumplimiento de una obligación formal por parte de uno de los obligados libera a los demás.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. La exención de la obligación alcanza a todos los beneficiarios, salvo que el beneficio haya sido concedido a determinada persona. En este caso, el sujeto activo podrá exigir el cumplimiento a los demás con deducción de la parte proporcional del beneficio.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;5. Cualquier interrupción o suspensión de la prescripción, a favor o en contra de uno de los deudores, favorece o perjudica a los demás.

                    <h4>SUBSECCIÓN IV: TERCEROS RESPONSABLES</h4>

                    <h4>ARTÍCULO 27</h4> (TERCEROS RESPONSABLES). Son terceros responsables las personas que sin tener el carácter de sujeto pasivo deben, por mandato expreso del presente Código o disposiciones legales, cumplir las obligaciones atribuidas a aquél.

                    El carácter de tercero responsable se asume por la administración de patrimonio ajeno o por la sucesión de obligaciones como efecto de la transmisión gratuita u onerosa de bienes.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano,en su Artículo 4, Inciso b) señala lo siguiente:

                    "ARTÍCULO 4 (RESPONSABLES DE LA OBLIGACIÓN TRIBUTARIA). Son responsables de la obligación tributaria:
                    (...)
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Los terceros responsables por representación o por sucesión, conforme a lo previsto en la ley citada y los responsables establecidos en la Ley N° 1990 y su reglamento".

                    <h4>ARTÍCULO 28</h4> (RESPONSABLES POR LA ADMINISTRACIÓN DE PATRIMONIO AJENO).

                    <br>I. Son responsables del cumplimiento de las obligaciones tributarias que derivan del patrimonio que administren:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Los padres, albaceas, tutores y curadores de los incapaces.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Los directores, administradores, gerentes y representantes de las personas jurídicas y demás entes colectivos con personalidad legalmente reconocida.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Los que dirijan, administren o tengan la disponibilidad de los bienes de entes colectivos que carecen de personalidad jurídica.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. Los mandatarios o gestores voluntarios respecto de los bienes que administren y dispongan.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;5. Los síndicos de quiebras o concursos, los liquidadores e interventores y los representantes de las sociedades en liquidación o liquidadas, así como los administradores judiciales o particulares de las sucesiones.

                    <br>II. Esta responsabilidad alcanza también a las sanciones que deriven del incumplimiento de las obligaciones tributarias a que se refiere este Código y demás disposiciones normativas.

                    <h4>ARTÍCULO 29</h4> (RESPONSABLES POR REPRESENTACIÓN). La ejecución tributaria se realizará siempre sobre el patrimonio del sujeto pasivo, cuando dicho patrimonio exista al momento de iniciarse la ejecución. En este caso, las personas a que se refiere el Artículo precedente asumirán la calidad de responsable por representación del sujeto pasivo y responderán por la deuda tributaria hasta el límite del valor del patrimonio que se está administrando.

                    <h4>ARTÍCULO 30</h4> (RESPONSABLES SUBSIDIARIOS). Cuando el patrimonio del sujeto pasivo no llegara a cubrir la deuda tributaria, el responsable por representación del sujeto pasivo pasará a la calidad de responsable subsidiario de la deuda impaga, respondiendo ilimitadamente por el saldo con su propio patrimonio, siempre y cuando se hubiera actuado con dolo.

                    La responsabilidad subsidiaria también alcanza a quienes administraron el patrimonio, por el total de la deuda tributaria, cuando éste fuera inexistente al momento de iniciarse la ejecución tributaria por haber cesado en sus actividades las personas jurídicas o por haber fallecido la persona natural titular del patrimonio, siempre y cuando se hubiera actuado con dolo.

                    Quienes administren patrimonio ajeno serán responsables subsidiarios por los actos ocurridos durante su gestión y serán responsables solidarios con los que les antecedieron, por las irregularidades en que éstos hubieran incurrido, si conociéndolas no realizaran los actos que fueran necesarios para remediarlas o enmendarlas a excepción de los síndicos de quiebras o concursos, los liquidadores e interventores, los representantes de las sociedades en liquidación o liquidadas, así como los administradores judiciales o particulares de las sucesiones, quiénes serán responsables subsidiarios sólo a partir de la fecha de su

                    <h4>ARTÍCULO 31</h4> (SOLIDARIDAD ENTRE RESPONSABLES). Cuando sean dos o más los responsables por representación o subsidiarios de una misma deuda, su responsabilidad será solidaria y la deuda podrá exigirse íntegramente a cualquiera de ellos, sin perjuicio del derecho de éste a repetir en la vía civil contra los demás responsables en la proporción que les corresponda.

                    <h4>ARTÍCULO 32</h4> (DERIVACIÓN DE LA ACCIÓN ADMINISTRATIVA). La derivación de la acción administrativa para exigir, a quienes resultaran responsables subsidiarios, el pago del total de la deuda tributaria, requerirá un acto administrativo previo en el que se declare agotado el patrimonio del deudor principal, se determine su responsabilidad y cuantía, bajo responsabilidad funcionaria.

                    <h4>ARTÍCULO 33</h4> (NOTIFICACIÓN E IMPUGNACIÓN). El acto de derivación de la acción administrativa será notificado personalmente a quienes resulten responsables subsidiarios, indicando todos los antecedentes del acto. El notificado podrá impugnar el acto que lo designa como responsable subsidiario utilizando los recursos establecidos en el presente Código. La impugnación solamente se referirá a la designación como responsable subsidiario y no podrá afectar la cuantía de la deuda en ejecución.

                    <h4>ARTÍCULO 34</h4> (RESPONSABLES SOLIDARIOS POR SUCESIÓN A TÍTULO PARTICULAR).
                    Son responsables solidarios con el sujeto pasivo en calidad de sucesores a título particular:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Los donatarios y los legatarios, por los tributos devengados con anterioridad a la transmisión.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Los adquirentes de bienes mercantiles por la explotación de estos bienes y los demás sucesores en la titularidad o explotación de empresas o entes colectivos con personalidad jurídica o sin ella.

                    La responsabilidad establecida en este artículo está limitada al valor de los bienes que se reciban, a menos que los sucesores hubieran actuado con dolo.

                    La responsabilidad prevista en el numeral 2 de este Artículo cesará a los doce (12) meses de efectuada la transferencia, si ésta fue expresa y formalmente comunicada a la autoridad tributaria con treinta (30) días de anticipación por lo menos.

                    <h4>ARTÍCULO 35</h4> (SUCESORES DE LAS PERSONAS NATURALES A TÍTULO UNIVERSAL).

                    <br>I. Los derechos y obligaciones del sujeto pasivo y el tercero responsable fallecido serán ejercitados o en su caso, cumplidos por el heredero universal sin perjuicio de que éste pueda acogerse al beneficio de inventario.

                    <br>II. En ningún caso serán transmisibles las sanciones, excepto las multas ejecutoriadas antes del fallecimiento del causante que puedan ser pagadas con el patrimonio de éste.

                    <h4>ARTÍCULO 36</h4> (TRANSMISIÓN DE OBLIGACIONES DE LAS PERSONAS JURÍDICAS).

                    <br>I. Ningún socio podrá recibir, a ningún título, la parte que le corresponda, mientras no queden extinguidas
                    las obligaciones tributarias de la sociedad o entidad que se liquida o disuelve. 23
                    <br>II. Las obligaciones tributarias que se determinen de sociedades o entidades disueltas o liquidadas se transmitirán a los socios o partícipes en el capital, que responderán de ellas solidariamente hasta el límite del valor de la cuota de liquidación que se les hubiera adjudicado.

                    En ambos casos citados se aplicarán los beneficios establecidos para los trabajadores en la Ley General del
                    Trabajo y los privilegios establecidos en el Artículo 49 de este Código.

                    <h4>SUBSECCIÓN V: DOMICILIO TRIBUTARIO</h4>

                    <h4>ARTÍCULO 37</h4> (DOMICILIO EN EL TERRITORIO NACIONAL). Para efectos tributarios las personas naturales y jurídicas deben fijar su domicilio dentro del territorio nacional, preferentemente en el lugar de su actividad comercial o productiva.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 22, señala lo siguiente:
                    "ARTÍCULO 22 (DOMICILIO MUNICIPAL). Para el ámbito municipal, el domicilio legal deberá ser fijado dentro la jurisdicción territorial del municipio respectivo".

                    <h4>ARTÍCULO 38</h4> (DOMICILIO DE LAS PERSONAS NATURALES). Cuando la persona natural no tuviera domicilio señalado o teniéndolo señalado, éste fuera inexistente, a todos los efectos tributarios se presume que el domicilio en el país de las personas naturales es:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. El lugar de su residencia habitual o su vivienda permanente.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. El lugar donde desarrolle su actividad principal, en caso de no conocerse la residencia o existir dificultad para determinarla.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. El lugar donde ocurra el hecho generador, en caso de no existir domicilio en los términos de los numerales precedentes.

                    La notificación así practicada se considerará válida a todos los efectos legales.

                    <h4>ARTÍCULO 39</h4> (DOMICILIO DE LAS PERSONAS JURÍDICAS). Cuando la persona jurídica no
                    tuviera domicilio señalado o teniéndolo señalado, éste fuera inexistente, a todos los efectos tributarios se
                    presume que el domicilio en el país de las personas jurídicas es:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. El lugar donde se encuentra su dirección o administración efectiva.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. El lugar donde se halla su actividad principal, en caso de no conocerse dicha dirección o administración.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. El señalado en la escritura de constitución, de acuerdo al Código de Comercio.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. El lugar donde ocurra el hecho generador, en caso de no existir domicilio en los términos de los numerales precedentes.

                    Para las Asociaciones de hecho o unidades económicas sin personalidad jurídica, se aplicarán las reglas establecidas a partir del numeral 2 de éste Artículo.

                    La notificación así practicada se considerará válida a todos los efectos legales.

                    <h4>ARTÍCULO 40</h4> (DOMICILIO DE LOS NO INSCRITOS). Se tendrá por domicilio de las personas naturales y asociaciones o unidades económicas sin personalidad jurídica que no estuvieran inscritas en los registros respectivos de las Administraciones Tributarias correspondientes, el lugar donde ocurra el hecho generador.

                    <h4>ARTÍCULO 41</h4> (DOMICILIO ESPECIAL). El sujeto pasivo y el tercero responsable podrán fijar un domicilio especial dentro el territorio nacional a los efectos tributarios con autorización expresa de la Administración Tributaria.

                    El domicilio así constituido será el único válido a todos los efectos tributarios, en tanto la Administración Tributaria no notifique al sujeto pasivo o al tercero responsable la revocatoria fundamentada de la autorización concedida, o éstos no soliciten formalmente su cancelación.

                    <h4>SECCIÓN IV:
                        BASE IMPONIBLE Y ALÍCUOTA</h4>

                    <h4>ARTÍCULO 42</h4> (BASE IMPONIBLE). Base imponible o gravable es la unidad de medida, valor o magnitud, obtenidos de acuerdo a las normas legales respectivas, sobre la cual se aplica la alícuota para determinar el tributo a pagar.

                    <h4>ARTÍCULO 43</h4> (MÉTODOS DE DETERMINACIÓN DE LA BASE IMPONIBLE). La base imponible podrá determinarse por los siguientes métodos:

                    <br>I. Sobre base cierta, tomando en cuenta los documentos e informaciones que permitan conocer en forma directa e indubitable los hechos generadores del tributo.

                    <br>II. Sobre base presunta, en mérito a los hechos y circunstancias que, por su vinculación o conexión normal con el hecho generador de la obligación, permitan deducir la existencia y cuantía de la obligación cuando concurra alguna de las circunstancias reguladas en el artículo siguiente.

                    <br>III. Cuando la Ley encomiende la determinación al sujeto activo prescindiendo parcial o totalmente del sujeto pasivo, ésta deberá practicarse sobre base cierta y sólo podrá realizarse la determinación
                    sobre base presunta de acuerdo a lo establecido en el Artículo siguiente, según corresponda.
                    En todos estos casos la determinación podrá ser impugnada por el sujeto pasivo, aplicando los procedimientos previstos en el Título III del presente Código.

                    <h4>ARTÍCULO 44</h4> (CIRCUNSTANCIAS PARA LA DETERMINACIÓN SOBRE BASE PRESUNTA). La Administración Tributaria podrá determinar la base imponible usando el método sobre base presunta, sólo cuando habiéndolos requerido, no posea los datos necesarios para su determinación sobre base cierta por no haberlos proporcionado el sujeto pasivo, en especial, cuando se verifique al menos alguna de las siguientes circunstancias relativas a éste último:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Que no se hayan inscrito en los registros tributarios correspondientes.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Que no presenten declaración o en ella se omitan datos básicos para la liquidación del tributo, conforme al procedimiento determinativo en casos especiales previsto por este Código.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Que se asuman conductas que en definitiva no permitan la iniciación o desarrollo de sus facultades de fiscalización.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. Que no presenten los libros y registros de contabilidad, la documentación respaldatoria o no proporcionen los informes relativos al cumplimiento de las disposiciones normativas.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;5. Que se den algunas de las siguientes circunstancias:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Omisión del registro de operaciones, ingresos o compras, así como alteración del precio y costo.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Registro de compras, gastos o servicios no realizados o no recibidos.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Omisión o alteración en el registro de existencias que deban figurar en los inventarios o registren dichas existencias a precios distintos de los de costo.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) No cumplan con las obligaciones sobre valuación de inventarios o no lleven el procedimiento de control de los mismos a que obligan las normas tributarias.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Alterar la información tributaria contenida en medios magnéticos, electrónicos, ópticos o informáticos que imposibiliten la determinación sobre base cierta.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) Existencia de más de un juego de libros contables, sistemas de registros manuales o informáticos, registros de cualquier tipo o contabilidades, que contengan datos y/o información de interés fiscal no coincidentes para una misma actividad comercial.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;g) Destrucción de la documentación contable antes de que se cumpla el término de la prescripción.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;h) La sustracción a los controles tributarios, la no utilización o utilización indebida de etiquetas, sellos, timbres, precintos y demás medios de control; la alteración de las características de mercancías, su ocultación, cambio de destino, falsa descripción o falsa indicación de procedencia.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;6. Que se adviertan situaciones que imposibiliten el conocimiento cierto de sus operaciones, o en cualquier circunstancia que no permita efectuar la determinación sobre base cierta.


                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano,
                    en su Artículo 23, señala lo siguiente:
                    "ARTÍCULO 23 (DETERMINACIÓN SOBRE BASE PRESUNTA EN EL ÁMBITO MUNICIPAL). En el marco de lo dispuesto en el Numeral 6 del Artículo 44 de la Ley N° 2492, en el ámbito municipal también se justificará la determinación sobre base presunta, cuando se verifique en el registro del padrón municipal una actividad distinta a la realizada".

                    Practicada por la Administración Tributaria la determinación sobre base presunta, subsiste la responsabilidad por las diferencias en más que pudieran corresponder derivadas de una posterior determinación sobre base cierta.

                    <h4>ARTÍCULO 45</h4> (MEDIOS PARA LA DETERMINACIÓN SOBRE BASE PRESUNTA).

                    <br>I. Cuando proceda la determinación sobre base presunta, ésta se practicará utilizando cualquiera de los siguientes medios que serán precisados a través de la norma reglamentaria correspondiente:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Aplicando datos, antecedentes y elementos indirectos que permitan deducir la existencia de los hechos imponibles en su real magnitud.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Utilizando aquellos elementos que indirectamente acrediten la existencia de bienes y rentas, así como de los ingresos, ventas, costos y rendimientos que sean normales en el respectivo sector económico, considerando las características de las unidades económicas que deban compararse en términos tributarios.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Valorando signos, índices, o módulos que se den en los respectivos contribuyentes según los datos o antecedentes que se posean en supuestos similares o equivalentes.

                    <br>II. En materia aduanera se aplicará lo establecido en la Ley Especial.

                    <h4>ARTÍCULO 46</h4> (ALÍCUOTA). Es el valor fijo o porcentual establecido por Ley, que debe aplicarse a la base imponible para determinar el tributo a pagar.

                    <h4>SECCIÓN V:
                        LA DEUDA TRIBUTARIA</h4>

                    <h4>ARTÍCULO 47</h4> (COMPONENTES DE LA DEUDA TRIBUTARIA).

                    <br>I. La Deuda Tributaria (DT) es el tributo omitido expresado en Unidades de Fomento de Vivienda más intereses (I) que debe pagar el sujeto pasivo después de vencido el plazo para el cumplimiento de la obligación tributaria, sin la necesidad de intervención o requerimiento alguno de la Administración Tributaria, de acuerdo a la siguiente fórmula:<br>


                    Donde:<br>

                    DT = TO + I<br>
                    I = TO * ( ( 1 + r/360 )**n 1)<br>


                    El Tributo Omitido (TO) será expresado en Unidades de Fomento de Vivienda publicada por el Banco Central de Bolivia, del día de vencimiento de pago de la obligación tributaria.<br>

                    La tasa de interés (r) podrá variar de acuerdo a los días de mora (n: n1, n2, n3) y será:<br>

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Del cuatro por ciento (4%) anual, desde el día siguiente al vencimiento del plazo para el pago de la obligación tributaria hasta el último día del cuarto año o hasta la fecha de pago dentro de este periodo, según corresponda (nl).<br>

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 2993 de 23/11/2016, Modificaciones al Decreto Supremo N°27310 de 09/01/2004 que reglamenta la Ley N° 2492 de 02/08/2003 Código Tributario Boliviano, en su Anexo 1, Inciso a, señala lo siguiente:
                    "El interés de la deuda tributaria se calculará de acuerdo a la siguiente metodología:<br>

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Interés de la deuda tributaria para los primeros cuatro años de mora<br>

                    I = TO *((1 +4%/360)**n 1)<br>

                    Donde:<br>
                    TO = es el Tributo Omitido expresados en UFVs.<br>
                    n1 = número de días de mora transcurridos a partir del día siguiente del vencimiento del plazo para el cumplimiento de la obligación tributaria hasta la fecha de pago, que no excederá el último día del cuarto año".<br>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Del seis por ciento (6%) anual, desde el primer día del quinto año de mora, hasta el último día del séptimo año o hasta la fecha de pago dentro de este periodo, según corresponda (n2).<br>

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 2993 de 23/11/2016, Modificaciones al Decreto Supremo N° 27310 de 09/01/2004 que reglamenta la Ley N° 2492 de 02/08/2003 Código Tributario Boliviano, en su Anexo 1, Inciso b señala lo siguiente:<br>

                    "b) Interés de la deuda tributaria para el quinto, sexto y séptimo año de mora<br>

                    I = TO *((1 +4%/360)**n 1) + TO *((1 +6%/360)**n1)<br>

                    Donde:<br>
                    n1 = número de días transcurridos a partir del día siguiente del vencimiento del plazo para el cumplimiento de la obligación tributaria hasta el último día del cuarto año de mora.<br>
                    n2 = número de días transcurridos a partir del primer día del quinto año de mora, hasta la fecha de pago, que no excederá el último día del séptimo año".<br>

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Del diez por ciento (10%) anual, desde el primer día del octavo año de mora hasta la fecha de pago (n3).<br>
                    El total de la deuda tributaria estará constituido por el Tributo Omitido actualizado en Unidades de Fomento de Vivienda, más los intereses aplicados en cada uno de los periodos de tiempo de mora descritos precedentemente, hasta el día de pago.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 2993 de 23/11/2016, Modificaciones al Decreto Supremo N° 27310 de 09/01/2004 que reglamenta la Ley N° 2492 de 02/08/2003 Código Tributario Boliviano, en su Anexo 1, Inciso c, señala lo siguiente:<br>

                    "c) Interés de la deuda tributaria a partir del octavo año de mora<br>
                    <br>
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I = TO *((1 +4%/360)**n1 1) + TO *((1 +6%/360)**n2 1) + TO *((1 +10%/360)**n3 1)<br>
                    <br>
                    <br>

                    Donde:<br>
                    n1 = número de días transcurridos a partir del día siguiente del vencimiento del plazo para el cumplimiento de la obligación tributaria hasta el último día del cuarto año de mora.<br>
                    n2 = número de días transcurridos a partir del primer día del quinto año de mora, hasta el último día del séptimo año.<br>
                    n3 = número de días transcurridos a partir del primer día del octavo año de mora hasta la fecha de pago.<br>
                    Cada período anual citado precedentemente se computará a partir del día siguiente de vencimiento del plazo de pago de la obligación tributaria o del día equivalente del año que corresponda".<br>

                    <br>II. La deuda tributaria expresada en Unidades de Fomento de Vivienda, al momento del pago deberá ser convertida en moneda nacional, utilizando la Unidad de Fomento de Vivienda de la fecha de pago.<br>

                    <br>III. Los pagos parciales una vez transformados a Unidades de Fomento de Vivienda, serán convertidos a valor presente a la fecha de vencimiento de la obligación tributaria, utilizando como factor de conversión para el cálculo de intereses, la relación descrita en el Parágrafo I del presente Artículo, y se deducirán del total de la deuda tributaria sin intereses.<br>

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 2993 de 23/11/2016, Modificaciones al Decreto Supremo N° 27310 de 09/01/2004 que reglamenta la Ley N° 2492 de 02/08/2003 Código Tributario Boliviano, en su Anexo 2, señala lo siguiente:<br>

                    "El valor presente para la deuda tributaria se calculará de acuerdo a la siguiente metodología:<br>

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Valor presente para deudas tributarias de hasta 4 años de mora<br>

                    VP = PP/(1 +(4%/360)**n1 1)<br>

                    Donde:<br>
                    PP = Pago Parcial<br>

                    n1 = Número de días de mora transcurridos a partir de la fecha de vencimiento del plazo para el cumplimiento de la obligación tributaria hasta la fecha de pago, que no excederá el cuarto año.<br>

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Valor presente para deudas tributarias de hasta 7 años de mora:<br>

                    VP = PP/(1 +(4%/360)**n1 1) + PP/(1 +(6%/360)**n2 1)<br>

                    Donde:<br>
                    PP = Pago Parcial<br>
                    n1 = Número de días de mora transcurridos a partir de la fecha de vencimiento del plazo para el cumplimiento de la obligación tributaria hasta el último día del cuarto año de mora.<br>
                    n2 = Número de días transcurridos a partir del primer día del quinto año de mora, hasta la fecha de pago, que no excederá el séptimo año.<br>

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Valor presente para deudas tributarias de 8 años de mora en adelante:<br>

                    VP = PP/(1 +(4%/360)**n1 1) + PP/(1 +(6%/360)**n2 1) + PP/(1 +(10%/360)**n3 1)<br>

                    Donde:<br>

                    PP = Pago parcial<br>
                    n1 = Número de días de mora transcurridos a partir de la fecha de vencimiento del plazo para el cumplimiento de la obligación tributaria hasta el último día del cuarto año de mora.<br>
                    n2 = Número de días transcurridos a partir del primer día del quinto año de mora, hasta el último día del séptimo año.<br>
                    n3 = Número de días transcurridos a partir del primer día del octavo año de mora hasta la fecha de pago.<br>
                    Cada período anual citado precedentemente se computará a partir del día siguiente de vencimiento del plazo de pago de la obligación tributaria o del día equivalente del año que corresponda".<br>

                    <h5>Nota del Editor:</h5>
                    Ley Nº 812 de 30/06/2016, en sus Disposiciones Finales Primera, establece:
                    "PRIMERA Las deudas tributarias existentes a la fecha de vigencia de la presente Ley que no se cumplan de acuerdo a lo establecido en la Disposición Transitoria Primera, serán calculadas
                    y pagadas conforme a lo dispuesto en el Artículo 47 del Código Tributario Boliviano, modificado 31
                    por la presente Ley".

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 2993 de 23/11/2016, en sus Disposiciones Adicionales Primera, señala lo siguiente:
                    "Disposición Adicional Primera Conforme a lo establecido en la Disposición Final Primera de la Ley N° 812, de 30 de junio de 2016, las deudas tributarias con el Servicio de Impuestos Nacionales y la Aduana Nacional, existentes con anterioridad a la vigencia de la citada Ley, que no sean regularizadas hasta el 31 de diciembre de 2016 o se encuentren excluidas por la Disposición Transitoria Primera, serán calculadas de acuerdo a lo previsto en el Artículo 47 de la Ley N° 2492, modificado por la Ley N° 812".

                    <br>IV. Los montos indebidamente devueltos por la Administración Tributaria serán restituidos por el beneficiario según la variación de la Unidad de Fomento de Vivienda e intereses, de acuerdo a lo previsto en el presente Artículo, calculados a partir de la fecha de la devolución indebida hasta la fecha de pago.

                    <h5>Nota del Editor:</h5>
                    Ley Nº 812 de 30/06/2016, en su Artículo 2 Parágrafo I, modificó el Artículo precedente.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en sus Artículos 9 y 46 Primer y Segundo Párrafo, señalan lo siguiente:
                    "ARTÍCULO 9 (INTERESES). El importe del interés (I) generado en todo el período de la mora, será resultado de la sumatoria de los intereses calculados con la tasa que corresponda a cada uno de los períodos de tiempo establecidos en el Artículo 47 de la Ley N° 2492, y se determinarán de acuerdo al cálculo establecido en el Anexo 1 que forma parte íntegra e indivisible del presente Reglamento".

                    <h5>Nota del Editor</h5>
                    Decreto Supremo N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo II,
                    modificó el Artículo precedente.

                    "ARTÍCULO 46 (PAGO). Se modifica los Párrafos Tercero y Cuarto del Artículo 10 del Reglamento a la Ley General de Aduanas, con el siguiente texto:
                    "El pago realizado fuera del plazo establecido genera la aplicación de intereses y la actualización automática del importe de los tributos aduaneros, con arreglo a lo señalado en el Artículo 47 de la Ley N° 2492.
                    En caso de incumplimiento de pago, la Administración Aduanera procederá a notificar al sujeto pasivo, requiriéndole para que realice el pago de la deuda aduanera, bajo
                    apercibimiento de ejecución tributaria"".

                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 10, señala lo siguiente:

                    "ARTÍCULO 10 (PAGOS PARCIALES Y PAGOS A CUENTA).

                    <br>I. Los pagos parciales de la deuda tributaria, incluidas las cuotas pagadas en facilidades de pago incumplidas, serán convertidos a valor presente a la fecha de vencimiento del plazo de pago de la obligación tributaria, de acuerdo a lo establecido en el Anexo 2 del presente Decreto Supremo y se deducirán como pago a cuenta de dicha deuda.

                    <h5>Nota del Editor</h5>
                    Decreto Supremo N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo III, modificó el Parágrafo precedente.

                    <br>II. En el ámbito municipal, mediante norma administrativa de carácter general se podrán establecer la forma, modalidades y procedimientos para recibir pagos a cuenta de tributos cuyo vencimiento no se hubiera producido".

                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en sus Artículos 8 y 45, y Decreto Supremo N° 27874 de 26/11/2004; Reglamenta Algunos Aspectos del Código Tributario Boliviano, en su Artículo 11 señalan lo siguiente:

                    ARTÍCULO 8 (DETERMINACIÓN Y COMPOSICIÓN DE LA DEUDA TRIBUTARIA). La deuda tributaria se configura al día siguiente de la fecha de vencimiento del plazo para el pago de la obligación tributaria, sin necesidad de actuación alguna de la Administración Tributaria y debe incluir su actualización en Unidades de Fomento de Vivienda UFV's e intereses de acuerdo a lo dispuesto en el Artículo 47 de la Ley N° 2492.

                    El período de la mora para el pago de la deuda tributaria, se computará a partir del día siguiente a la fecha de vencimiento del plazo para el pago de la obligación tributaria, hasta el día de pago.

                    La deuda tributaria expresada en UFV's, al momento de hacerse efectivo el pago deberá ser convertida en moneda nacional, utilizando la UFV de la fecha de pago.

                    A efectos del cálculo de los montos indebidamente devueltos, se considerará el mantenimiento de valor e intereses, desde la fecha de la devolución indebida hasta la 33 fecha de su restitución, sin perjuicio de la aplicación de la multa por contravención de
                    omisión de pago que corresponda".

                    <h5>Nota del Editor</h5>
                    Decreto Supremo N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo I, modificó el Artículo precedente.

                    "ARTÍCULO 45 (DEUDA ADUANERA).
                    <br>I. La deuda aduanera se genera al día siguiente del vencimiento del plazo para el cumplimiento de la obligación tributaria aduanera o de la obligación de pago en aduanas.

                    La deuda aduanera se determinará con los siguientes componentes:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) El monto de los tributos aduaneros expresados en UFV's;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) El interés definido en el Artículo 9 del presente Reglamento.

                    <br>II. Las disposiciones del Capítulo II del presente Reglamento, serán aplicadas en materia aduanera en cuanto sean compatibles".

                    <h5>Nota del Editor</h5>
                    Decreto Supremo N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo X, modificó el Artículo precedente.

                    "ARTÍCULO 11 (DEUDA TRIBUTARIA). A efecto de delimitar la aplicación temporal de la norma, deberá tomarse en cuenta la naturaleza sustantiva de las disposiciones que desarrollan el concepto de deuda tributaria vigente a la fecha de acaecimiento del hecho generador".

                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en sus Artículos 19 y 27 Parágrafos II y III, señalan lo siguiente:

                    "ARTÍCULO 19 (RESOLUCIÓN DETERMINATIVA). La Resolución Determinativa deberá consignar los requisitos mínimos establecidos en el Artículo 99 de la Ley N° 2492.

                    Las especificaciones sobre la deuda tributaria se refieren al origen, concepto y determinación del adeudo tributario calculado de acuerdo a lo establecido en el Artículo
                    47 de dicha Ley.

                    En el ámbito aduanero, los fundamentos de hecho y derecho contemplaran una descripción concreta de la declaración aduanera, acto o hecho y de las disposiciones legales aplicables al caso".

                    "ARTÍCULO 27 (RECTIFICATORIAS A FAVOR DEL FISCO).
                    (...)

                    <br>II. La diferencia resultante de una Rectificatoria a favor del Fisco, que hubiera sido utilizada indebidamente como crédito, será considerada como tributo omitido. El importe será calculado de acuerdo a lo establecido en el Artículo 47 de la Ley N° 2492 desde el día siguiente de la fecha de vencimiento del impuesto al que corresponde la declaración jurada rectificatoria.

                    <br>III. Cuando la Rectificatoria a Favor del Fisco disminuya el saldo a favor del contribuyente y éste no alcance para cubrir el "crédito IVA comprometido" para la devolución de títulos valores, la diferencia se considerará como tributo omitido y será calculado de acuerdo a lo establecido en el Artículo 47 de la Ley N° 2492 desde el día siguiente de la fecha de vencimiento del impuesto al que corresponde la declaración jurada rectificatoria".

                    <h4>SECCIÓN VI: GARANTÍA</h4>

                    <h4>ARTÍCULO 48</h4> (GARANTÍA DE LAS OBLIGACIONES TRIBUTARIAS). El patrimonio del sujeto pasivo o del subsidiario cuando corresponda, constituye garantía de las obligaciones tributarias.

                    <h4>ARTÍCULO 49</h4> (PRIVILEGIO). La deuda tributaria tiene privilegio respecto de las acreencias de terceros, con excepción de los señalados en el siguiente orden:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Los salarios, sueldos y aguinaldos devengados de los trabajadores.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Los beneficios sociales de los trabajadores y empleados, las pensiones de asistencia familiar fijadas u homologadas judicialmente y las contribuciones y aportes patronales y laborales a la Seguridad Social.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Los garantizados con derecho real o bienes muebles sujetos a registro, siempre que ellos se hubieran constituido e inscrito en el Registro de Derechos Reales o en los registros correspondientes, respectivamente, con anterioridad a la notificación con la Resolución Determinativa, en los casos que no hubiera fiscalización, con anterioridad a la ejecución tributaria.

                    <h4>ARTÍCULO 50</h4> (EXCLUSIÓN). Los tributos retenidos y percibidos por el sustituto deberán ser excluidos de la masa de liquidación por tratarse de créditos extra concursales y privilegiados. 35

                    <h4>SECCIÓN VII:
                        FORMAS DE EXTINCIÓN DE LA OBLIGACIÓN TRIBUTARIA Y DE LA OBLIGACIÓN DE PAGO EN ADUANAS</h4>


                    <H4>SUBSECCIÓN I: PAGO</H4>

                    <h4>ARTÍCULO 51</h4> (PAGO TOTAL). La obligación tributaria y la obligación de pago en aduanas, se extinguen con el pago total de la deuda tributaria.

                    <h4>ARTÍCULO 52</h4> (SUBROGACIÓN DE PAGO). Los terceros extraños a la obligación tributaria también pueden realizar el pago, previo conocimiento del deudor, subrogándose en el derecho al crédito, garantías, preferencias y privilegios sustanciales.

                    <h4>ARTÍCULO 53</h4> (CONDICIONES Y REQUISITOS).

                    <br>I. El pago debe efectuarse en el lugar, la fecha y la forma que establezcan las disposiciones normativas que se dicten al efecto.

                    <br>II. Existe pago respecto al contribuyente cuando se efectúa la retención o percepción de tributo en la fuente o en el lugar y la forma que la Administración Tributaria lo disponga.

                    <br>III. La Administración Tributaria podrá disponer fundadamente y con carácter general prórrogas de oficio para el pago de tributos. En este caso no procede la convertibilidad del tributo en Unidades de Fomento de la Vivienda, la aplicación de intereses ni de sanciones por el tiempo sujeto a prórroga.

                    <br>IV. El pago de la deuda tributaria se acreditará o probará mediante certificación de pago en los originales de las declaraciones respectivas, los documentos bancarios de pago o las certificaciones expedidas por la Administración Tributaria.

                    <h4>ARTÍCULO 54</h4> (DIVERSIDAD DE DEUDAS).

                    <br>I. Cuando la deuda sea por varios tributos y por distintos períodos, el pago se imputará a la deuda elegida por el deudor; de no hacerse esta elección, la imputación se hará a la obligación más antigua y entre éstas a la que sea de menor monto y así, sucesivamente, a las deudas mayores.

                    <br>II. En ningún caso y bajo responsabilidad funcionaria, la Administración Tributaria podrá negarse
                    36 a recibir los pagos que efectúen los contribuyentes sean éstos parciales o totales, siempre que
                    <h4>ARTÍCULO 55</h4> (FACILIDADES DE PAGO).

                    <br>I. La Administración Tributaria podrá conceder por una sola vez con carácter improrrogable facilidades para el pago de la deuda tributaria a solicitud expresa del contribuyente, en cualquier momento, inclusive estando iniciada la ejecución tributaria, en los casos y en la forma que reglamentariamente se determinen. Estas facilidades no procederán en ningún caso para retenciones y percepciones. Si las facilidades se solicitan antes del vencimiento para el pago del tributo, no habrá lugar a la aplicación de sanciones.

                    <br>II. Para la concesión de facilidades de pago deberán exigirse las garantías que la Administración Tributaria establezca mediante norma reglamentaria de carácter general, hasta cubrir el monto de la deuda tributaria. El rechazo de las garantías por parte de la Administración Tributaria deberá ser fundamentado.

                    <br>III. En caso de estar en curso la ejecución tributaria, la facilidad de pago tendrá efecto simplemente suspensivo, por cuanto el incumplimiento del pago en los términos definidos en norma reglamentaria, dará lugar automáticamente a la ejecución de las medidas que correspondan adoptarse por la Administración Tributaria según sea el caso.



                    <h5>Nota del Editor:</h5>
                    Ley N° 812 de 30/06/2016, en sus Disposiciones Transitorias Primera, establece:

                    "PRIMERA. Los sujetos pasivos con deudas tributarias a favor del nivel central del Estado a la fecha de publicación de la presente Ley, hasta el 31 de diciembre del presente año podrán pagar o solicitar un plan de pagos de acuerdo al Código Tributario Boliviano y sus disposiciones reglamentarias, con el interés único del cuatro por ciento (4%) anual aplicable a todo el periodo de la mora, con los siguientes incentivos:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Sin multa por arrepentimiento eficaz según el Artículo 157 del Código Tributario modificado por la presente Ley, cuando se traten de deudas tributarias determinadas por el sujeto pasivo o que se encuentren en procesos de fiscalización, verificación o determinación de oficio hasta el décimo día de notificada la vista de cargo.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2.Con una rebaja del ochenta por ciento (80%) de la multa por omisión de pago en las deudas tributarias en procesos de determinación, después de los diez días de notificada la vista de cargo y hasta antes de la impugnación de la Resolución Determinativa.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Con una rebaja del sesenta por ciento (60%) de la multa por omisión de pago en las deudas tributarias establecidas en Resolución Determinativa firme o que se encuentren en la fase de ejecución o cobranza coactiva resultante de aquellos actos de la Administración Tributaria que no hubiesen sido objeto de recursos judiciales o administrativos, y hasta antes del acto de remate o adjudicación directa.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4.Con una rebaja del sesenta por ciento (60%) de la multa por omisión de pago en las deudas tributarias con Resolución Determinativa impugnada previo desistimiento del recurso, incluso hasta antes de la notificación con el pronunciamiento del Tribunal Supremo de Justicia.

                    Aquellas deudas tributarias en procesos de ejecución resultantes del cumplimiento de fallos dictados por el Tribunal Supremo de Justicia, continuaran su trámite de ejecución de acuerdo a la Ley aplicable y en cumplimiento de las resoluciones que así lo determinaron en su oportunidad.

                    Para las deudas tributarias con facilidades de pago en curso, las cuotas adeudadas a la fecha de publicación de la presente Ley, serán cumplidas con la tasa de interés del cuatro por ciento (4%).

                    El incumplimiento de las facilidades de pago dará lugar a la pérdida de los beneficios establecidos en la presente Disposición Transitoria".

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 24, señala lo siguiente:

                    "ARTÍCULO 24 (FACILIDADES DE PAGO).
                    <br>I. Conforme lo dispuesto por el Artículo 55 de la Ley Nº 2492, las Administraciones Tributarias podrán, mediante resolución administrativa de carácter particular, conceder facilidades de pago para las obligaciones generadas antes o después del vencimiento de los tributos que los dieron origen, tomando en cuenta las siguientes condiciones:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Tasa de Interés Tasa de interés r, definida en el Artículo 9 de este Decreto Supremo.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Plazo y numero de cuotas El plazo podrá ser de hasta sesenta (60) meses, en cuotas mensuales, computables a partir del primer día del mes siguiente a la fecha de la notificación de la Resolución Administrativa.
                    A partir de la presentación de la solicitud, la Administración Tributaria contara con (20) veinte días de plazo para emitir y notificar la Resolución Administrativa de aceptación o rechazo.

                    <h5>Nota del Editor</h5>
                    D.S. N° 3442 de 27/12/2017, en su Artículo 2, Parágrafo I, modificó el Inciso precedente.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Pago Inicial, garantías y otras condiciones en la forma definida en la reglamentación que emita la Administración Tributaria.

                    <br>II. No se podrán conceder facilidades de pago para retenciones y percepciones de tributos o para aquellos tributos cuyo pago sea requisito en los trámites administrativos, judiciales o transferencia del derecho propietario, excepto cuando la deuda tributaria sea establecida en un procedimiento de determinación de oficio.

                    <h5>Nota del Editor</h5>
                    D.S. N° 3442 de 27/12/2017, en su Artículo 2, Parágrafo II, modificó el Parágrafo precedente.

                    <br>III. Los sujetos pasivos o terceros responsables que incumplan la facilidad de pago otorgada, no podrán volver a solicitar facilidades de pago por la misma deuda o sus saldos y dará lugar a la ejecución de las garantías y medidas coactivas señaladas en la Ley N° 2492, si corresponde.

                    Asimismo, el sujeto pasivo o tercero responsable que haya solicitado facilidades de pago con el beneficio del arrepentimiento eficaz o reducción de sanciones, perderá estos beneficios debiendo la Administración Tributaria iniciar o continuar el sumario contravencional que corresponda, aplicando o imponiendo la multa por omisión de pago calculado sobre el tributo omitido actualizado pendiente de pago.

                    En las facilidades de pago otorgadas después de notificada la vista de cargo o auto inicial de sumario contravencional, la resolución administrativa que concede la facilidad de pago tendrá por efecto la conclusión del proceso de determinación y la suspensi6n del sumario contravencional así como del término de la prescripción, debiendo continuar el computo de los plazos a partir del día siguiente a la fecha de incumplimiento.

                    En la deuda tributaria con facilidad de pago incumplida, los sucesores de las personas naturales, las personas colectivas o jurídicas sucesoras en los pasivos tributarios de otra y los socios o accionistas que asuman la responsabilidad de sociedades en liquidación o disolución, podrán solicitar una nueva facilidad de pago, por única vez.

                    <h5>Nota del Editor</h5>
                    D.S. N° 3442 de 27/12/2017, en su Artículo 2, Parágrafo III, modificó el Parágrafo precedente.

                    <br>IV. En el ámbito municipal no procederá la transferencia de bienes inmuebles ni vehículos automotores, ni el cambio de radicatoria de estos, en tanto exista un plan de facilidades de pago vigente relacionado con el impuesto que grava la propiedad de los mismos.

                    <br>V. Las Administraciones Tributarias están facultadas a emitir los reglamentos que complementen lo dispuesto en el presente Artículo".

                    <H4>SUBSECCIÓN II: COMPENSACIÓN</H4>

                    <h4>ARTÍCULO 56</h4> (CASOS EN LOS QUE PROCEDE). La deuda tributaria podrá ser compensada total o parcialmente, de oficio o a petición de parte, en las condiciones que reglamentariamente se establezcan, con cualquier crédito tributario líquido y exigible del interesado, proveniente de pagos indebidos o en exceso, por los que corresponde la repetición o la devolución previstas en el presente Código.

                    La deuda tributaria a ser compensada deberá referirse a períodos no prescritos comenzando por los más antiguos y aunque provengan de distintos tributos, a condición de que sean recaudados por el mismo órgano administrativo.

                    Iniciado el trámite de compensación, éste deberá ser sustanciado y resuelto por la Administración Tributaria dentro del plazo máximo de tres (3) meses, bajo responsabilidad de los funcionarios encargados del mismo.

                    A efecto del cálculo para la compensación, no correrá ningún tipo de actualización sobre los débitos y créditos que se solicitan compensar desde el momento en que se inicie la misma.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario
                    Boliviano, en su Artículo 15, señala lo siguiente:
                    "ARTÍCULO 15 (COMPENSACIÓN). La compensación a que se refiere el Artículo 56 de la Ley N° 2492 también procederá sobre las solicitudes que los sujetos pasivos o terceros responsables realicen antes del vencimiento del tributo que desean sea compensado. Sin embargo estas solicitudes no eximen del pago de las sanciones y la liquidación de la deuda tributaria conforme lo dispuesto en el Artículo 47 de la referida Ley, en caso que la solicitud resulte improcedente.

                    La compensación de oficio procederá únicamente sobre deudas tributarias firmes y exigibles.

                    Los procedimientos y mecanismos de compensación serán reglamentados por la Administración Tributaria".

                    <H4>SUBSECCIÓN III: CONFUSIÓN</H4>

                    <h4>ARTÍCULO 57</h4> (CONFUSIÓN). Se producirá la extinción por confusión cuando la Administración Tributaria titular de la deuda tributaria, quedara colocada en la situación de deudor de la misma, como consecuencia de la transmisión de bienes o derechos sujetos al tributo.

                    <H4>SUBSECCIÓN IV: CONDONACIÓN</H4>

                    <h4>ARTÍCULO 58</h4> (CONDONACIÓN). La deuda tributaria podrá condonarse parcial o totalmente, sólo en virtud de una Ley dictada con alcance general, en la cuantía y con los requisitos que en la misma se determinen.

                    <H4>SUBSECCIÓN V: PRESCRIPCIÓN</H4>

                    <h4>ARTÍCULO 59</h4> (PRESCRIPCIÓN).

                    <br>I. Las acciones de la Administración Tributaria prescribirán a los ocho (8) años, para:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Controlar, investigar, verificar, comprobar y fiscalizar tributos.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Determinar la deuda tributaria.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Imponer sanciones administrativas.

                    <h5>Nota del Editor:</h5> 41
                    Ley Nº 812 de 30/06/2016, en su Artículo 2, Parágrafo II modificó el Parágrafo precedente.

                    <br>II. El término de prescripción precedente se ampliará en dos (2) años adicionales, cuando el sujeto pasivo o tercero responsable no cumpliera con la obligación de inscribirse en los registros pertinentes, se inscribiera en un régimen tributario diferente al que corresponde, incurra en delitos tributarios o realice operaciones comerciales y / o financieras en países de baja o nula tributación.

                    <h5>Nota del Editor:</h5>
                    Ley Nº 812 de 30/06/2016, en su Artículo 2, Parágrafo II modificó el Parágrafo precedente.

                    <br>III. El término para ejecutar las sanciones por contravenciones tributarias prescribe a los cinco (5) años.

                    <br>IV. La facultad de ejecutar la deuda tributaria determinada, es imprescriptible.

                    <h5>Nota del Editor:</h5>
                    Ley N° 291 de 22/09/2012; Ley de Modificaciones al Presupuesto General del Estado (PGE 2012), mediante su Disposición Adicional Quinta, modificó el Artículo precedente; posteriormente la Ley Nº 317 de 11/12/2012; Ley del Presupuesto General del Estado Gestión 2013, en sus Disposiciones Derogatorias y Abrogatorias, Primera, derogó el Último Párrafo del Parágrafo I del Artículo precedente.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 5, señala lo siguiente:
                    "ARTÍCULO 5 (PRESCRIPCIÓN). El sujeto pasivo o tercero responsable podrá solicitar la prescripción tanto en sede administrativa como judicial inclusive en la etapa de ejecución tributaria.
                    A efectos de la prescripción prevista en los Artículos 59 y 60 de la Ley N° 2492, los términos se computarán a partir del primero de enero del año calendario siguiente a aquel en que se produjo el vencimiento del plazo de pago".

                    <h4>ARTÍCULO 60</h4> (CÓMPUTO).

                    <br>I. Excepto en el Numeral 3, del Parágrafo I, del Artículo anterior, el término de la prescripción se
                    <br>II. En el supuesto 3, del Parágrafo I del Artículo anterior, el término se computará desde el primer día del año siguiente a aquel en que se cometió la contravención tributaria.
                    <br>III. En el supuesto del Parágrafo III del Artículo anterior, el término se computará desde el momento que adquiera la calidad de título de ejecución tributaria.

                    <h5>Nota del Editor:</h5>
                    Ley N° 291 de 22/09/2012; Ley de Modificaciones al Presupuesto General del Estado (PGE 2012), mediante la Disposición Adicional Sexta modificó el Artículo precedente, posteriormente la Ley N° 317 de 11/12/2012; Ley del Presupuesto General del Estado Gestión 2013, mediante las Disposiciones Adicionales, Disposición Décima Segunda, modificó los Parágrafos I y II precedentes.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano en su Artículo 5, señala lo siguiente:

                    "ARTÍCULO 5 (PRESCRIPCIÓN). El sujeto pasivo o tercero responsable podrá solicitar la prescripción tanto en sede administrativa como judicial inclusive en la etapa de ejecución tributaria.
                    A efectos de la prescripción prevista en los Artículos 59 y 60 de la Ley N° 2492, los términos se computarán a partir del primero de enero del año calendario siguiente a aquel en que se produjo el vencimiento del plazo de pago".

                    <h4>ARTÍCULO 61</h4> (INTERRUPCIÓN). La prescripción se interrumpe por:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) La notificación al sujeto pasivo con la Resolución Determinativa.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) El reconocimiento expreso o tácito de la obligación por parte del sujeto pasivo o tercero responsable, o por la solicitud de facilidades de pago.

                    Interrumpida la prescripción, comenzará a computarse nuevamente el término a partir del primer día hábil del mes siguiente a aquél en que se produjo la interrupción.

                    <h4>ARTÍCULO 62</h4> (SUSPENSIÓN). El curso de la prescripción se suspende con:

                    <br>I. La notificación de inicio de fiscalización individualizada en el contribuyente. Esta suspensión se inicia en la fecha de la notificación respectiva y se extiende por seis (6) meses.
                    <br>II. La interposición de recursos administrativos o procesos judiciales por parte del contribuyente. La suspensión se inicia con la presentación de la petición o recurso y se extiende hasta la recepción formal del expediente por la Administración Tributaria para la ejecución del respectivo fallo.

                    <H4>SUBSECCIÓN VI:
                        OTRAS FORMAS DE EXTINCIÓN EN MATERIA ADUANERA</H4>

                    <h4>ARTÍCULO 63</h4> (OTRAS FORMAS DE EXTINCIÓN EN MATERIA ADUANERA).

                    <br>I. La obligación tributaria en materia aduanera y la obligación de pago en Aduanas se extinguen por:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Desistimiento de la Declaración de Mercancías de Importación dentro los tres días de aceptada la declaración.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Abandono expreso o de hecho de las mercancías.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Destrucción total o parcial de las mercancías.

                    <br>II. El desistimiento de la declaración de mercancías deberá ser presentado a la Administración Aduanera en forma escrita, antes de efectuar el pago de los tributos aduaneros. Una vez que la Aduana Nacional admita el desistimiento la mercancía quedará desvinculada de la obligación tributaria aduanera.

                    <br>III. La destrucción total o parcial, o en su caso, la merma de las mercancías por causa de fuerza mayor o caso fortuito que hubiera sido así declarada en forma expresa por la Administración Aduanera, extingue la obligación tributaria aduanera.

                    En los casos de destrucción parcial o merma de la mercancía, la obligación tributaria se extingue sólo para la parte afectada y no retirada del depósito aduanero.

                    <H3>Título II
                        GESTIÓN Y APLICACIÓN DE LOS TRIBUTOS</H3>

                    <h3>CAPÍTULO I DERECHOS Y DEBERES DE LOS SUJETOS DE LA RELACIÓN JURÍDICA TRIBUTARIA</h3>

                    <h4>SECCIÓN I:
                        DERECHOS Y DEBERES DE LA ADMINISTRACIÓN TRIBUTARIA</h4>

                    <h4>ARTÍCULO 64</h4> (NORMAS REGLAMENTARIAS ADMINISTRATIVAS). La Administración Tributaria, conforme a este Código y leyes especiales, podrá dictar normas administrativas de carácter general a los efectos de la aplicación de las normas tributarias, las que no podrán modificar, ampliar o suprimir el alcance del tributo ni sus elementos constitutivos.

                    <h4>ARTÍCULO 65</h4> (PRESUNCIÓN DE LEGITIMIDAD). Los actos de la Administración Tributaria por estar sometidos a la Ley se presumen legítimos y serán ejecutivos, salvo expresa declaración judicial en contrario emergente de los procesos que este Código establece.

                    No obstante lo dispuesto, la ejecución de dichos actos se suspenderá únicamente conforme lo prevé este
                    Código en el Capítulo II del Título III.

                    <h4>ARTÍCULO 66</h4> (FACULTADES ESPECÍFICAS). La Administración Tributaria tiene las siguientes facultades específicas:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Control, comprobación, verificación, fiscalización e investigación;


                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 2993 de 23/11/2016, Modificaciones al Decreto Supremo N° 27310 de 09/01/2004 que reglamento la Ley N° 2492 de 02/08/2003 Código Tributario Boliviano, en sus Disposiciones Adicionales Segunda, señala lo siguiente:
                    "DISPOSICIÓN ADICIONAL SEGUNDA A efecto de lo establecido en el Artículo 59 de la Ley N° 2492, modificado por la Ley N° 812, y lo dispuesto en los Artículos 45, 45 bis y 45 ter de la Ley N° 843 (Texto Ordenado Vigente), se consideran países o regiones de baja o nula tributación a aquellos que se encuentren identificados como países o regiones no cooperantes de acuerdo a la Organización para la Cooperación y el Desarrollo Económico OCDE y aquellos que estén listados como tales en cuatro o más legislaciones de Sud América.
                    Las Administraciones Tributarias, mediante norma administrativa establecerán y actualizarán el listado de los países o regiones considerados de baja o nula tributación a efectos del control y fiscalización de los precios de transferencia".

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Determinación de tributos;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Recaudación;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. Cálculo de la deuda tributaria;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;5. Ejecución de medidas precautorias, previa autorización de la autoridad competente establecida en este Código;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;6. Ejecución tributaria;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;7. Concesión de prórrogas y facilidades de pago;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;8. Revisión extraordinaria de actos administrativos conforme a lo establecido en el Artículo 145 del presente Código;

                    Sentencia Constitucional 0009/2004, de 28 de enero de 2004: En el Recurso Directo o Abstracto de Inconstitucionalidad, en el cual se demanda la Inconstitucionalidad de los Artículos 139 en sus Incisos b) y c), 140 Incisos a) y b), 143, 144, 145, 146 y 147 de la Ley N° 2492 (Código Tributario Boliviano CTB), por infringir los Artículos 16 Parágrafos I) y IV), 116 Parágrafos II) y III) y 118 de la Constitución Política del Estado (CPE).

                    El Tribunal Constitucional declara: 1° La INCONSTITUCIONALIDAD, 1) Por omisión normativa del Artículo 131, 2) Por contradicción de los Artículos 131 Tercer Párrafo, 139 Inciso c), 141, 145, 146 y 147 del Código Tributario Boliviano (CTB). Con los efectos previstos por el Artículo 58, Parágrafo III de la Ley del Tribunal Constitucional, y

                    2° La CONSTITUCIONALIDAD de los Artículos 139 Inciso b), 140 Incisos a) y b), 143 y 144 del Código Tributario Boliviano (CTB).


                    <br>&nbsp;&nbsp;&nbsp;&nbsp;9. Sanción de contravenciones, que no constituyan delitos;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;10. Designación de sustitutos y responsables subsidiarios, en los términos dispuestos por este Código;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;11. Aplicar los montos mínimos establecidos mediante Decreto Supremo a partir de los cuales los pagos por la adquisición y venta de bienes y servicios deban ser respaldadas por los contribuyentes y/o responsables a través de documentos reconocidos por el sistema bancario y de intermediación financiera regulada por la Autoridad de Supervisión Financiera (ASFI). La falta de respaldo mediante la documentación emitida por las referidas entidades, hará presumir la inexistencia de la transacción para fines de liquidación de impuestos e implicará que el comprador no tendrá derecho al cómputo del crédito fiscal, así como la obligación del
                    vendedor de liquidar el impuesto sin deducción de crédito fiscal alguno.

                    <h5>Nota del Editor:</h5>
                    Ley N° 062 de 28/11/2010; Ley del Presupuesto General del Estado Gestión 2011, mediante su Artículo 20, modificó el Numeral 11 precedente.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 37, señala lo siguiente:
                    "ARTÍCULO 37 (MEDIOS FEHACIENTES DE PAGO). Se establece el monto mínimo de Bs50.000 (CINCUENTA MIL 00/100 BOLIVIANOS) a partir del cual todo pago por operaciones de compra y venta de bienes y servicios, debe estar respaldado con documento emitido por una entidad de intermediación financiera regulada por la Autoridad de Supervisión del Sistema Financiero ASFI.

                    La obligación de respaldar el pago con la documentación emitida por entidades de intermediación financiera, debe ser por el valor total de cada transacción, independientemente a que sea al contado, al crédito o se realice mediante pagos parciales, de acuerdo al reglamento que establezca el Servicio de Impuestos Nacionales y la Aduana Nacional, en el ámbito de sus atribuciones".

                    <h5>Nota del Editor:</h5>
                    Decreto Supremo N° 0772 de 19/01/2011, en su Disposición Final Cuarta, reemplazó el Artículo 37 del Decreto Supremo N° 27310 de 09/01/2004, modificado por el Parágrafo III del Artículo 12 del Decreto Supremo N° 27874 de 26/11/2004.
                    Decreto Supremo N° 3050 de 11/01/2017, en su Artículo 5, señala lo siguiente: "ARTÍCULO 5 (BANCARIZACIÓN). Los pagos emergentes de transacciones de compra y venta de bienes y/o prestación de servicios cuyo valor total sea igual o mayor al monto establecido en el Artículo 37 del Decreto Supremo Nº 27310, de 9 enero de 2004, modificado por el Decreto Supremo Nº 0772, de 19 de enero de 2011, efectuados por el comprador final, deberán ser respaldados con documentos emitidos o reconocidos por el sistema financiero, a nombre del comitente".

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;12. Prevenir y reprimir los ilícitos tributarios dentro del ámbito de su competencia, asimismo constituirse en el órgano técnico de investigación de delitos tributarios y promover como víctima los procesos penales tributarios;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;13. Otras facultades asignadas por las disposiciones legales especiales.
                    Sin perjuicio de lo expresado en los numerales anteriores, en materia aduanera, la Administración Tributaria tiene las siguientes facultades:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Controlar, vigilar y fiscalizar el paso de mercancías por las fronteras, puertos y aeropuertos del país, con facultades de inspección, revisión y control de mercancías, medios y unidades de transporte;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Intervenir en el tráfico internacional para la recaudación de los tributos aduaneros y otros que determinen las leyes;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Administrar los regímenes y operaciones aduaneras;

                    <h4>ARTÍCULO 67</h4> (CONFIDENCIALIDAD DE LA INFORMACIÓN TRIBUTARIA).

                    <br>I. Las declaraciones y datos individuales obtenidos por la Administración Tributaria, tendrán carácter reservado y sólo podrán ser utilizados para la efectiva aplicación de los tributos o procedimientos cuya gestión tenga encomendada y no podrán ser informados, cedidos o comunicados a terceros salvo mediante orden judicial fundamentada, o solicitud de información de conformidad a lo establecido por el Artículo 70 de la Constitución Política del Estado.

                    <br>II. El servidor público de la Administración Tributaria que divulgue por cualquier medio hechos o documentos que conozca en razón de su cargo y que por su naturaleza o disposición de la Ley fueren reservados, será sancionado conforme a reglamento, sin perjuicio de la responsabilidad civil o penal que de dicho acto resultare.


                    <h5>Nota del Editor:</h5>
                    Ley N° 1357 de 22/12/2020; en su Disposición Adicional Única, Parágrafo I, establece "I. Se incorpora el inciso g) en el Parágrafo I del Artículo 473 de la Ley N° 393 de 21 de agosto de 2013 de Servicios Financieros, con el siguiente texto:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;g) El Servicio de Impuestos Nacionales, para el intercambio de información en el marco de los Tratados, Convenios y otros instrumentos jurídicos internacionales, así como para la investigación de grandes fortunas y operaciones financieras relacionadas con personas naturales o jurídicas, constituidas o situadas en países de baja o nula tributación. Las servidoras y los servidores públicos, y las ex servidoras y los ex servidores públicos del Servicio de Impuestos Nacionales no podrán divulgar, ceder o comunicar la información obtenida en razón de su cargo, que por disposición de la Ley es reservada, bajo responsabilidad administrativa, civil o penal que de dicho acto resultare."

                    <br>III. La información agregada o estadística general es pública.

                    <h5>Nota del Editor:</h5>
                    Decreto Supremo Nº 077 de 15/04/2009, establece los alcances de la transferencia e intercambio de la información proporcionada por la Administración Tributaria, considerando "no terceros" a las entidades públicas del Órgano Ejecutivo Nacional con atribuciones de control, verificación, fiscalización, investigación y formulación de políticas económicas y sociales y elaboración de estadísticas oficiales. Se aclara que las Administraciones Tributarias proporcionarán la información solicitada por las entidades públicas consideradas "no terceros"; los servidores públicos que reciban esta información no podrán divulgar, ceder o comunicar la misma en forma individualizada bajo responsabilidad administrativa, civil o penal. Así mismo el Decreto Supremo Nº 0122 de 13/05/2009, en su Artículo Único derogó el Parágrafo III del Artículo 3 del Decreto Supremo Nº 077 de 15/04/2009.

                    <br>IV. La Administración Tributaria otorgará información a las Administraciones Tributarias de otros países, en el marco de instrumentos jurídicos internacionales para el intercambio de información.

                    <h5>Nota del Editor:</h5>
                    Ley Nº 1105 de 28/09/2018, en su Disposición Adicional Única, incorporó el Parágrafo precedente.

                    <h4>SECCIÓN II:
                        DERECHOS Y DEBERES DEL SUJETO PASIVO Y TERCEROS RESPONSABLES</h4>

                    <h4>ARTÍCULO 68</h4> (DERECHOS). Constituyen derechos del sujeto pasivo los siguientes:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. A ser informado y asistido en el cumplimiento de sus obligaciones tributarias y en el ejercicio de sus derechos.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. A que la Administración Tributaria resuelva expresamente las cuestiones planteadas en los procedimientos previstos por este Código y disposiciones reglamentarias, dentro de los plazos establecidos.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. A solicitar certificación y copia de sus declaraciones juradas presentadas.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. A la reserva y confidencialidad de los datos, informes o antecedentes que obtenga la Administración Tributaria, en el ejercicio de sus funciones, quedando las autoridades, funcionarios, u otras personas a su servicio, obligados a guardar estricta reserva y confidencialidad, bajo responsabilidad funcionaria, con excepción de lo establecido en el Artículo 67 del presente Código.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;5. A ser tratado con el debido respeto y consideración por el personal que desempeña funciones en la Administración Tributaria.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;6. Al debido proceso y a conocer el estado de la tramitación de los procesos tributarios en los que sea parte interesada a través del libre acceso a las actuaciones y documentación que respalde los cargos que se le formulen, ya sea en forma personal o a través de terceros autorizados, en los términos del presente Código.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;7. A formular y aportar, en la forma y plazos previstos en este Código, todo tipo de pruebas y alegatos que deberán ser tenidos en cuenta por los órganos competentes al redactar la correspondiente Resolución. 51

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;8. A ser informado al inicio y conclusión de la fiscalización tributaria acerca de la naturaleza y alcance de la misma, así como de sus derechos y obligaciones en el curso de tales actuaciones.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;9. A la Acción de Repetición conforme lo establece el presente Código.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;10. A ser oído o juzgado de conformidad a lo establecido en el Artículo 16 de la Constitución Política del Estado.

                    <h4>ARTÍCULO 69</h4> (PRESUNCIÓN A FAVOR DEL SUJETO PASIVO). En aplicación al principio de buena fe y transparencia, se presume que el sujeto pasivo y los terceros responsables han cumplido sus obligaciones tributarias cuando han observado sus obligaciones materiales y formales, hasta que en debido proceso de determinación, de prejudicialidad o jurisdiccional, la Administración Tributaria pruebe lo contrario, conforme a los procedimientos establecidos en este Código, Leyes y Disposiciones Reglamentarias.

                    <h4>ARTÍCULO 70</h4> (OBLIGACIONES TRIBUTARIAS DEL SUJETO PASIVO). Constituyen obligaciones tributarias del sujeto pasivo:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1.
                    Determinar, declarar y pagar correctamente la deuda tributaria en la forma, medios, plazos y lugares establecidos por la Administración Tributaria, ocurridos los hechos previstos en la Ley como generadores de una obligación tributaria.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2.
                    Inscribirse en los registros habilitados por la Administración Tributaria y aportar los datos que le fueran requeridos comunicando ulteriores modificaciones en su situación tributaria.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3.
                    Fijar domicilio y comunicar su cambio, caso contrario el domicilio fijado se considerará subsistente, siendo válidas las notificaciones practicadas en el mismo.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4.
                    Respaldar las actividades y operaciones gravadas, mediante libros, registros generales y especiales, facturas, notas fiscales, así como otros documentos y/o instrumentos públicos, conforme se establezca en las disposiciones normativas respectivas.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;5.
                    Demostrar la procedencia y cuantía de los créditos impositivos que considere le correspondan, aunque los mismos se refieran a periodos fiscales prescritos. Sin embargo, en este caso la Administración Tributaria no podrá determinar deudas tributarias que oportunamente no las hubiere determinado y cobrado.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;6.
                    Facilitar las tareas de control, determinación, comprobación, verificación, fiscalización, investigación y recaudación que realice la Administración Tributaria, observando las obligaciones que les impongan las leyes, decretos reglamentarios y demás disposiciones.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;7.
                    Facilitar el acceso a la información de sus estados financieros cursantes en Bancos y otras instituciones financieras.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;8.
                    En tanto no prescriba el tributo, considerando incluso la ampliación del plazo, conservar en forma

                    ordenada en el domicilio tributario los libros de contabilidad, registros especiales, declaraciones,

                    informes, comprobantes, medios de almacenamiento, datos e información computarizada y
                    52
                    demás documentos de respaldo de sus actividades; presentar, exhibir y poner a disposición de la

                    Administración Tributaria los mismos, en la forma y plazos en que éste los requiera. Asimismo,

                    deberán permitir el acceso y facilitar la revisión de toda la información, documentación, datos y bases de datos relacionadas con el equipamiento de computación y los programas de sistema (software básico) y los programas de aplicación (software de aplicación), incluido el código fuente, que se utilicen en los sistemas informáticos de registro y contabilidad de las operaciones vinculadas con la materia imponible.

                    <h5>Nota del Editor:</h5>
                    Ley N° 291 de 22/09/2012; Ley de Modificaciones al Presupuesto General del Estado (PGE 2012), mediante su Disposición Adicional Octava, modificó el Numeral 8 precedente.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;9. Permitir la utilización de programas y aplicaciones informáticas provistos por la Administración Tributaria, en los equipos y recursos de computación que utilizarán, así como el libre acceso a la información contenida en la base de datos.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;10. Constituir garantías globales o especiales mediante boletas de garantía, prenda, hipoteca u otras, cuando así lo requiera la norma.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;11. Cumplir las obligaciones establecidas en este Código, leyes tributarias especiales y las que defina la Administración Tributaria con carácter general.

                    <h4>SECCIÓN III: AGENTES DE INFORMACIÓN</h4>

                    <h4>ARTÍCULO 71</h4> (OBLIGACIÓN DE INFORMAR).

                    <br>I. Toda persona natural o jurídica de derecho público o privado, sin costo alguno, está obligada a proporcionar a la Administración Tributaria toda clase de datos, informes o antecedentes con efectos tributarios, emergentes de sus relaciones económicas, profesionales o financieras con otras personas, cuando fuere requerido expresamente por la Administración Tributaria.

                    <br>II. Las obligaciones a que se refiere el parágrafo anterior, también serán cumplidas por los agentes de información cuya designación, forma y plazo de cumplimiento será establecida reglamentariamente.

                    <br>III. El incumplimiento de la obligación de informar no podrá ampararse en: disposiciones normativas, estatutarias, contractuales y reglamentos internos de funcionamiento de los referidos organismos o entes estatales o privados.

                    <br>IV. Los profesionales no podrán invocar el secreto profesional a efecto de impedir la comprobación de su propia situación tributaria.

                    <h4>ARTÍCULO 72</h4> (EXCEPCIONES A LA OBLIGACIÓN DE INFORMAR). No podrá exigirse información en los siguientes casos:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Cuando la declaración sobre un tercero, importe violación del secreto profesional, de correspondencia epistolar o de las comunicaciones privadas salvo orden judicial.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Cuando su declaración estuviera relacionada con hechos que pudieran motivar la aplicación de penas privativas de libertad de sus parientes hasta cuarto grado de consanguinidad o segundo de afinidad, salvo los casos en que estuvieran vinculados por alguna actividad económica.

                    <h4>ARTÍCULO 73</h4> (OBLIGACIONES DE LOS SERVIDORES PÚBLICOS). Las autoridades de todos los niveles de la organización del Estado cualquiera que sea su naturaleza, y quienes en general ejerzan funciones públicas, están obligados a suministrar a la Administración Tributaria cuantos datos y antecedentes con efectos tributarios requiera, mediante disposiciones de carácter general o a través de requerimientos concretos y a prestarle a ella y a sus funcionarios apoyo, auxilio y protección para el ejercicio de sus funciones.

                    Para proporcionar la información, los documentos y otros antecedentes, bastará la petición de la Administración Tributaria sin necesidad de orden judicial. Asimismo, deberán denunciar ante la Administración Tributaria correspondiente la comisión de ilícitos tributarios que lleguen a su conocimiento en cumplimiento de sus funciones.

                    A requerimiento de la Administración Tributaria, los juzgados y tribunales deberán facilitarle cuantos datos con efectos tributarios se desprendan de las actuaciones judiciales que conozcan, o el acceso a los expedientes o cuadernos en los que cursan estos datos. El suministro de aquellos datos de carácter personal contenidos en registros públicos u oficiales, no requerirá del consentimiento de los afectados.

                    <h3>CAPÍTULO II
                        PROCEDIMIENTOS TRIBUTARIOS</h3>
                    <h4>SECCIÓN I:
                        DISPOSICIONES COMUNES</h4>

                    <h4>ARTÍCULO 74</h4> (PRINCIPIOS, NORMAS PRINCIPALES Y SUPLETORIAS). Los procedimientos tributarios se sujetarán a los principios constitucionales de naturaleza tributaria, con arreglo a las siguientes ramas específicas del Derecho, siempre que se avengan a la naturaleza y fines de la materia tributaria:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Los procedimientos tributarios administrativos se sujetarán a los principios del Derecho Administrativo y se sustanciarán y resolverán con arreglo a las normas contenidas en el presente Código. Sólo a falta de disposición expresa, se aplicarán supletoriamente las normas de la Ley de Procedimiento Administrativo y demás normas en materia administrativa.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Los procesos tributarios jurisdiccionales se sujetarán a los principios del Derecho Procesal y se de disposición expresa, se aplicarán supletoriamente las normas del Código de Procedimiento Civil y del Código de Procedimiento Penal, según corresponda.

                    <h4>ARTÍCULO 75</h4> (PERSONERÍA Y VISTA DE ACTUACIONES).

                    <br>I. Los interesados podrán actuar personalmente o por medio de sus representantes mediante instrumento público, conforme a lo que reglamentariamente se establezca.

                    <br>II. Los interesados o sus representantes y sus abogados, tendrán acceso a las actuaciones administrativas y podrán consultarlas sin más exigencia que la demostración de su identidad, excepto cuando la Administración Tributaria requiera la reserva temporal de sus actuaciones, dada la naturaleza de algunos procedimientos. En aplicación del principio de confidencialidad de la Información Tributaria, ninguna otra persona ajena a la Administración Tributaria podrá acceder a estas actuaciones.

                    <h4>SECCIÓN II: PRUEBA</h4>

                    <h4>ARTÍCULO 76</h4> (CARGA DE LA PRUEBA). En los procedimientos tributarios administrativos y jurisdiccionales quien pretenda hacer valer sus derechos deberá probar los hechos constitutivos de los mismos. Se entiende por ofrecida y presentada la prueba por el sujeto pasivo o tercero responsable cuando estos señalen expresamente que se encuentran en poder de la Administración Tributaria.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 26, señala lo siguiente:
                    "ARTÍCULO 26 (MEDIOS, CARGA Y APRECIACIÓN DE LA PRUEBA).
                    <br>I. Podrá hacerse uso de todos los medios de prueba admitidos en Derecho, con excepción de la prueba confesoria de autoridad y funcionarios del ente público recurrido.
                    <br>II. Son aplicables en los Recursos Administrativos todas las disposiciones establecidas en los Artículos 76 al 82 del Código Tributario Boliviano".

                    <h4>ARTÍCULO 77</h4> (MEDIOS DE PRUEBA).

                    <br>I. Podrán invocarse todos los medios de prueba admitidos en Derecho.
                    La prueba testifical sólo se admitirá con validez de indicio, no pudiendo proponerse más de dos (2) testigos sobre cada punto de la controversia. Si se propusieren más, a partir del tercero se tendrán por no ofrecidos.
                    <br>II. Son también medios legales de prueba los medios informáticos y las impresiones de la informaciónm contenida en ellos, conforme a la reglamentación que al efecto se dicte.
                    <br>III. Las actas extendidas por la Administración Tributaria en su función fiscalizadora, donde se recogen hechos, situaciones y actos del sujeto pasivo que hubieren sido verificados y comprobados, hacen prueba de los hechos recogidos en ellas, salvo que se acredite lo contrario.
                    <br>IV. En materia procesal penal, el ofrecimiento, producción, y presentación de medios de prueba se sujetará a lo dispuesto por el Código de Procedimiento Penal y demás disposiciones legales.


                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 26, señala lo siguiente:

                    "ARTÍCULO 26 (MEDIOS, CARGA Y APRECIACIÓN DE LA PRUEBA).
                    <br>I. Podrá hacerse uso de todos los medios de prueba admitidos en Derecho, con excepción de la prueba confesoria de autoridad y funcionarios del ente público recurrido.
                    <br>II. Son aplicables en los Recursos Administrativos todas las disposiciones establecidas en los Artículos 76 al 82 del Código Tributario Boliviano".

                    <h4>ARTÍCULO 78</h4> (DECLARACIÓN JURADA).

                    <br>I. Las declaraciones juradas son la manifestación de hechos, actos y datos comunicados a la Administración Tributaria en la forma, medios, plazos y lugares establecidos por las reglamentaciones que ésta emita, se presumen fiel reflejo de la verdad y comprometen la responsabilidad de quienes las suscriben en los términos señalados por este Código.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 25, Primer Párrafo, señala lo siguiente:
                    "ARTÍCULO 25 (DECLARACIONES JURADAS EN EL ÁMBITO MUNICIPAL). En el ámbito municipal, la declaración que realizan los sujetos pasivos o terceros responsables sobre las características de sus bienes gravados, que sirven para determinar la base imponible de los impuestos bajo su dominio, se entiende que son declaraciones juradas.
                    (...)".


                    <br>II. Podrán rectificarse a requerimiento de la Administración Tributaria o por iniciativa del sujeto pasivo o tercero responsable, cuando la rectificación tenga como efecto el aumento del saldo a favor del Fisco o la disminución del saldo a favor del declarante.
                    También podrán rectificarse a libre iniciativa del declarante, cuando la rectificación tenga como efecto el aumento del saldo a favor del sujeto pasivo o la disminución del saldo a favor del Fisco, previa verificación de la Administración Tributaria. Los límites, formas, plazos y condiciones de las declaraciones rectificatorias serán establecidos mediante Reglamento.
                    En todos los casos, la Declaración Jurada rectificatoria sustituirá a la original con relación a los datos que se rectifican.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en sus Artículos 25, Segundo Párrafo, 26, 27 y 28, señalan lo siguiente:
                    "ARTÍCULO 25 (DECLARACIONES JURADAS EN EL ÁMBITO MUNICIPAL).
                    (...)
                    Estas declaraciones pueden ser rectificadas o modificadas por los sujetos pasivos o terceros responsables o a requerimiento de la Administración Tributaria, en los formularios que para este efecto se establezcan".
                    "ARTÍCULO 26 (DECLARACIONES JURADAS RECTIFICATORIAS).
                    <br>I. En el caso del Servicio de Impuestos Nacionales, las declaraciones juradas rectificatorias pueden ser de dos tipos;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Las que incrementen el saldo a favor del fisco o disminuyan el saldo a favor del contribuyente, que se denominarán "Rectificatorias a favor del Fisco".

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Las que disminuyan el saldo a favor del fisco o incrementen el saldo a favor del contribuyente, que se denominarán "Rectificatorias a favor del Contribuyente".

                    <br>II. Se faculta al Servicio de Impuestos Nacionales a reglamentar el tratamiento de los débitos y/o créditos producto de la presentación de declaraciones juradas rectificatorias".
                    "ARTÍCULO 27 (RECTIFICATORIAS A FAVOR DEL FISCO).
                    <br>I. El contribuyente o tercero responsable podrá rectificar su Declaración Jurada con saldo a favor del fisco en cualquier momento.
                    Las Declaraciones Juradas rectificatorias presentadas una vez iniciada la fiscalización o verificación, no tendrán efecto en la determinación de oficio. Los pagos a que den lugar estas declaraciones, serán considerados como pagos a cuenta de la deuda a determinarse por la Administración Tributaria.
                    La presentación de la Declaración Jurada Rectificatoria no suspende el proceso de ejecución iniciado por la Declaración Jurada original o la última presentada.
                    Cuando la Declaración Jurada Rectificatoria sea por un importe mayor al tributo determinado en la Declaración Jurada Original o la última presentada, la Administración Tributaria procederá a su ejecución únicamente por la diferencia del impuesto determinado.

                    <h5>Nota del Editor</h5>
                    Decreto Supremo N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo V, modificó el Parágrafo precedente.

                    <br>II. La diferencia resultante de una Rectificatoria a favor del Fisco, que hubiera sido utilizada indebidamente como crédito, será considerada como tributo omitido. El importe será calculado de acuerdo a lo establecido en el Artículo 47 de la Ley N° 2492 desde el día siguiente de la fecha de vencimiento del impuesto al que corresponde la declaración jurada rectificatoria.
                    <br>III. Cuando la Rectificatoria a Favor del Fisco disminuya el saldo a favor del contribuyente y éste no alcance para cubrir el "crédito IVA comprometido" para la devolución de títulos valores, la diferencia se considerará como tributo omitido y será calculado de acuerdo a lo establecido en el Artículo 47 de la Ley N° 2492 desde el día siguiente de la fecha de vencimiento del impuesto al que corresponde la declaración jurada rectificatoria".

                    "ARTÍCULO 28 (RECTIFICATORIA A FAVOR DEL CONTRIBUYENTE).
                    <br>I. La Declaración Jurada Rectificatoria que incremente saldos a favor del contribuyente podrá ser efectuada por una sola vez, por cada impuesto y período fiscal.

                    <h5>Nota del Editor</h5>
                    Decreto Supremo N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo VI, modificó el Parágrafo precedente.

                    <br>II. Esta rectificatoria, conforme lo dispuesto en el párrafo segundo del Parágrafo II del Artículo 78 de la Ley N° 2492, deberá ser aprobada por la Administración Tributaria antes de su presentación. La aprobación será resultado de la verificación de los documentos que respalden la determinación del tributo, conforme se establezca en la reglamentación que emita la Administración Tributaria.

                    <h5>Nota del Editor</h5>
                    Decreto Supremo N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo VI, modificó el Parágrafo precedente.

                    <br>III. Previa aceptación del interesado, si la Rectificatoria originara un pago indebido o en exceso, éste será considerado como un crédito a favor del contribuyente, salvando su derecho a solicitar su devolución mediante la Acción de Repetición.

                    <br>IV. La solicitud de rectificación de la Declaración Jurada podrá ser presentada hasta antes de que concluya el período de prescripción, o hasta antes del inicio de la Fiscalización o Verificación, lo que ocurra primero."

                    <h5>Nota del Editor</h5>
                    Decreto Supremo N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo VI, modificó el Parágrafo precedente.

                    <br>III. No es rectificatoria la Declaración Jurada que actualiza cualquier información o dato brindado a la Administración Tributaria no vinculados a la determinación de la Deuda Tributaria. En estos casos, la nueva información o datos brindados serán los que tome como válidos la Administración Tributaria a partir de su presentación.


                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 26, señala lo siguiente:

                    "ARTÍCULO 26 (MEDIOS, CARGA Y APRECIACIÓN DE LA PRUEBA).
                    <br>I. Podrá hacerse uso de todos los medios de prueba admitidos en Derecho, con excepción de la prueba confesoria de autoridad y funcionarios del ente público recurrido.
                    <br>II. Son aplicables en los Recursos Administrativos todas las disposiciones establecidas en los Artículos 76 al 82 del Código Tributario Boliviano".


                    <h4>ARTÍCULO 79</h4> (MEDIOS E INSTRUMENTOS TECNOLÓGICOS).

                    <br>I. La facturación, la presentación de declaraciones juradas y de toda otra información de importancia fiscal, la retención, percepción y pago de tributos, el llevado de libros, registros y anotaciones contables así como la documentación de las obligaciones tributarias y conservación de dicha documentación, siempre que sean autorizados por la Administración Tributaria a los sujetos pasivos y terceros responsables, así como las comunicaciones y notificaciones que aquella realice a estos últimos, podrán efectuarse por cualquier medio tecnológicamente disponible en el país, conforme a la normativa aplicable a la materia.
                    Estos medios, incluidos los informáticos, electrónicos, ópticos o de cualquier otra tecnología, deberán permitir la identificación de quien los emite, garantizar la verificación de la integridad de la información y datos en ellos contenidos de forma tal que cualquier modificación de los mismos ponga en evidencia su alteración, y cumplir los requisitos de pertenecer únicamente a su titular y encontrarse bajo su absoluto y exclusivo control.
                    <br>II. Las Vistas de Cargo y Resoluciones Determinativas y todo documento relativo a los trámites en la Administración Tributaria, podrán expedirse por sistemas informáticos, debiendo las mismas llevar inscrito el cargo y nombre de la autoridad que las emite, su firma en facsímil, electrónica o por cualquier otro medio tecnológicamente disponible, conforme a lo dispuesto reglamentariamente.


                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 7 y Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 26, señalan lo siguiente:
                    "ARTÍCULO 7 (MEDIOS E INSTRUMENTOS TECNOLÓGICOS). Las operaciones electrónicas realizadas y registradas en el sistema informático de la Administración Tributaria por un usuario autorizado surten efectos jurídicos. La información generada, enviada, recibida, almacenada o comunicada a través de los sistemas informáticos o medios electrónicos, por cualquier usuario autorizado que de cómo resultado un registro electrónico, tiene validez probatoria.
                    Salvo prueba en contrario, se presume que toda operación electrónica registrada en el sistema informático de la Administración Tributaria pertenece al usuario autorizado. A efectos del ejercicio de las facultades previstas en el Artículo 21 de la Ley 2492, la Administración Tributaria establecerá y desarrollará bases de datos o de información actualizada, propia o procedente de terceros, a las que accederá con el objeto de contar con información objetiva.
                    Las impresiones o reproducciones de los registros electrónicos generados por los sistemas informáticos de la Administración Tributaria, tienen validez probatoria siempre que sean certificados o acreditados por el servidor público a cuyo cargo se encuentren dichos registros. A fin de asegurar la inalterabilidad y seguridad de los registros electrónicos, la Administración Tributaria adoptará procedimientos y medios tecnológicos de respaldo o duplicación.
                    Asimismo, tendrán validez probatoria las impresiones o reproducciones que obtenga la Administración Tributaria de los registros electrónicos generados por los sistemas informáticos de otras administraciones tributarias y de entidades públicas o privadas. Las Administraciones Tributarias dictarán las disposiciones reglamentarias y procedimentales para la aplicación del presente Artículo".

                    "ARTÍCULO 26 (MEDIOS, CARGA Y APRECIACIÓN DE LA PRUEBA).
                    <br>I. Podrá hacerse uso de todos los medios de prueba admitidos en Derecho, con excepción de la prueba confesoria de autoridad y funcionarios del ente público recurrido.
                    60 II. Son aplicables en los Recursos Administrativos todas las disposiciones establecidas en los Artículos 76 al 82 del Código Tributario Boliviano".

                    <h4>ARTÍCULO 80</h4> (RÉGIMEN DE PRESUNCIONES TRIBUTARIAS).

                    <br>I. Las presunciones establecidas por leyes tributarias no admiten prueba en contrario, salvo en los casos en que aquellas lo determinen expresamente.

                    <br>II. En las presunciones legales que admiten prueba en contrario, quien se beneficie con ellas, deberá probar el hecho conocido del cual resulte o se deduzca la aplicación de la presunción. Quien pretenda desvirtuar la presunción deberá aportar la prueba correspondiente.

                    <br>III. Las presunciones no establecidas por la Ley serán admisibles como medio de prueba siempre que entre el hecho demostrado y aquél que se trate de deducir haya un enlace lógico y directo según las reglas del sentido común. Estas presunciones admitirán en todos los casos prueba en contrario.


                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el
                    Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante
                    la Superintendencia Tributaria, en su Artículo 26, señala lo siguiente:

                    "ARTÍCULO 26 (MEDIOS, CARGA Y APRECIACIÓN DE LA PRUEBA).
                    <br>I. Podrá hacerse uso de todos los medios de prueba admitidos en Derecho, con excepción de la prueba confesoria de autoridad y funcionarios del ente público recurrido.
                    <br>II. Son aplicables en los Recursos Administrativos todas las disposiciones establecidas en los Artículos 76 al 82 del Código Tributario Boliviano".

                    <h4>ARTÍCULO 81</h4> (APRECIACIÓN, PERTINENCIA Y OPORTUNIDAD DE PRUEBAS). Las pruebas se apreciarán conforme a las reglas de la sana crítica siendo admisibles sólo aquéllas que cumplan con los requisitos de pertinencia y oportunidad, debiendo rechazarse las siguientes:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Las manifiestamente inconducentes, meramente dilatorias, superfluas o ilícitas.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Las que habiendo sido requeridas por la Administración Tributaria durante el proceso de fiscalización, no hubieran sido presentadas, ni se hubiera dejado expresa constancia de su existencia y compromiso de presentación, hasta antes de la emisión de la Resolución Determinativa.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Las pruebas que fueran ofrecidas fuera de plazo.
                    En los casos señalados en los numerales 2 y 3 cuando el sujeto pasivo de la obligación tributaria pruebe que la omisión no fue por causa propia podrá presentarlas con juramento de reciente obtención.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimientoy Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 26, y Decreto Supremo N° 27874 de 26/11/2004, Reglamenta Algunos Aspectos del Código Tributario Boliviano, en su Artículo 2, señalan lo siguiente:

                    "ARTÍCULO 26 (MEDIOS, CARGA Y APRECIACIÓN DE LA PRUEBA).
                    <br>I. Podrá hacerse uso de todos los medios de prueba admitidos en Derecho, con excepción de la prueba confesoria de autoridad y funcionarios del ente público recurrido.
                    <br>II. Son aplicables en los Recursos Administrativos todas las disposiciones establecidas en los Artículos 76 al 82 del Código Tributario Boliviano".
                    "ARTÍCULO 2 (PRUEBAS DE RECIENTE OBTENCIÓN). A efecto de la aplicación de lo dispuesto en el Artículo 81 de la Ley N° 2492 de 2 de agosto de 2003, en el procedimiento administrativo de determinación tributaria, las pruebas de reciente obtención, para que sean valoradas por la Administración Tributaria, sólo podrán ser presentadas hasta el último día de plazo concedido por Ley a la Administración para la emisión de la resolución Determinativa o Sancionatoria".


                    <h4>ARTÍCULO 82</h4> (CLAUSURA EXTRAORDINARIA DEL PERÍODO DE PRUEBA). El periodo de prueba quedará clausurado antes de su vencimiento por renuncia expresa de las partes.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 26, señala lo siguiente:

                    "ARTÍCULO 26 (MEDIOS, CARGA Y APRECIACIÓN DE LA PRUEBA).
                    <br>I. Podrá hacerse uso de todos los medios de prueba admitidos en Derecho, con excepción de la prueba confesoria de autoridad y funcionarios del ente público recurrido.
                    <br>II. Son aplicables en los Recursos Administrativos todas las disposiciones establecidas en los Artículos 76 al 82 del Código Tributario Boliviano".

                    <h4>SECCIÓN III:
                        FORMAS Y MEDIOS DE NOTIFICACIÓN</h4>

                    <h4>ARTÍCULO 83</h4> (MEDIOS DE NOTIFICACIÓN).
                    <br>I. Los actos y actuaciones de la Administración Tributaria se notificarán por uno de los siguientes medios, según corresponda:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Por medios electrónicos;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Personalmente;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Por Cédula;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. Por Edicto;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;5. Por correspondencia postal certificada, efectuada mediante correo público o privado o por sistemas de comunicación electrónicos, facsímiles o similares;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;6. Tácitamente;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;7. Masiva;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;8. En Secretaria.

                    <br>II. Es nula toda notificación que no se ajuste a las formas anteriormente descritas. Con excepción de las notificaciones por correspondencia, edictos y masivas, todas las notificaciones se practicarán en días y horas hábiles administrativos, de oficio o a pedido de parte. Siempre por motivos fundados, la autoridad administrativa competente podrá habilitar días y horas extraordinarias.


                    <h5>Nota del Editor:</h5>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i) Ley Nº 812 de 30/06/2016, en su Artículo 2, Parágrafo III modificó el Artículo precedente.
                    ii) Ley Nº 812 de 30/06/2016, en sus Disposiciones Finales Cuarta, establece:
                    "CUARTA El Servicio de Impuestos Nacionales desarrollará e implementará una plataforma virtual que permita realizar gestiones tributarias y la notificación de las actuaciones administrativas mediante medios electrónicos.
                    Una vez implementada esta plataforma, las notificaciones personales serán excepcionales, debiendo reglamentarse mediante Resolución Administrativa los casos en los que proceda".


                    <h4>ARTÍCULO 83</h4> Bis (NOTIFICACIÓN POR MEDIOS ELECTRÓNICOS).

                    <br>I. Para los casos en que el contribuyente o tercero responsable señale un correo electrónico o éste le sea asignado por la Administración Tributaria, la vista de cargo, auto inicial de sumario, resolución determinativa, resolución sancionatoria, resolución definitivas y cualquier otra actuación de la Administración Tributaria, podrá ser notificado por correo electrónico, oficina virtual u otros medios electrónicos disponibles. La notificación realizada por estos medios tendrá la misma validez y eficacia que la notificación personal.
                    En las notificaciones practicadas en esta forma, los plazos se computarán de acuerdo al Artículo 4 del presente Código Tributario.
                    <br>II. La Administración Tributaria contará con los medios electrónicos necesarios para garantizar la notificación a los contribuyentes.
                    Los contribuyentes que proporcionen a la Administración Tributaria su correo electrónico, número de celular o teléfono fijo, recibirán comunicados por estos medios.

                    <h5>Nota del Editor:</h5>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i) Ley Nº 812 de 30/06/2016, en su Artículo 3, Parágrafo I incorporó el Artículo precedente.
                    ii) Ley Nº 812 de 30/06/2016, en sus Disposiciones Finales Cuarta, establece:
                    "CUARTA El Servicio de Impuestos Nacionales desarrollará e implementará una plataforma virtual que permita realizar gestiones tributarias y la notificación de las actuaciones administrativas mediante medios electrónicos.
                    Una vez implementada esta plataforma, las notificaciones personales serán excepcionales, debiendo reglamentarse mediante Resolución Administrativa los casos en los que proceda".

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano en su Artículo 12, señala lo siguiente:

                    "ARTÍCULO 12 (NOTIFICACIÓN ELECTRÓNICA).
                    <br>I. Para efectos de lo dispuesto en el Artículo 83 Bis de la Ley N° 2492, la Vista de Cargo, Auto Inicial de Sumario, Resolución Determinativa, Resolución Sancionatoria, proveído que dé inicio a la ejecución tributaria y cualquier Resolución Definitiva, podrán ser notificados por correo electrónico u otros medios electrónicos, en una dirección electrónica fijada por el contribuyente o tercero responsable o asignada por la Administración Tributaria.
                    La notificación electrónica se tendrá por efectuada en los siguientes casos, lo que ocurra primero:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. En la fecha en que el contribuyente o tercero responsable proceda a la apertura del documento enviado;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. A los cinco (5) días posteriores a:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) La fecha de recepción de la notificación en el correo electrónico; o
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) La fecha de envío al medio electrónico implementado por la Administración Tributaria.

                    El soporte físico de la apertura del documento notificado o de la constancia de recepción en el correo electrónico o envío al medio electrónico, según corresponda, deberá ser adjuntado al expediente, consignando la firma, nombre y cargo del servidor público responsable de la notificación.
                    Cuando no sea posible la notificación por medios electrónicos, la Administración Tributaria procederá a la notificación del sujeto pasivo o tercero responsable de acuerdo al procedimiento establecido en los Artículos 84, 85 y 86 de la Ley N° 2492, según corresponda.

                    <br>II. La Administración Tributaria, a través de medios electrónicos, teléfono fijo o móvil, proporcionará a los contribuyentes o terceros responsables información referida a fechas de vencimiento, existencia de actuaciones administrativas, alertas, recordatorios y cualquier otra de naturaleza tributaria. De igual manera, deberá habilitar los medios para que el contribuyente efectúe consultas, reclamos, denuncias, trámites administrativos y otros por los mismos mecanismos.

                    <br>III. A efectos de la aplicación del presente Artículo, la Administración Tributaria emitirá norma administrativa reglamentaria.

                    <h5>Nota del Editor</h5>
                    Decreto Supremo N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo IV, modificó el Artículo precedente.

                    <h4>ARTÍCULO 84</h4> (NOTIFICACIÓN PERSONAL).

                    <br>I. Las Vistas de Cargo y Resoluciones Determinativas que superen la cuantía establecida por la reglamentación a que se refiere el Artículo 89 de este Código; así como los actos que impongan sanciones, decreten apertura de término de prueba y la derivación de la acción administrativa a los subsidiarios serán notificados personalmente al sujeto pasivo, tercero responsable, o a su representante legal.

                    <br>II. La notificación personal se practicará con la entrega al interesado o su representante legal de la copia íntegra de la resolución o documento que debe ser puesto en su conocimiento, haciéndose constar por escrito la notificación por el funcionario encargado de la diligencia, con indicación literal y numérica del día, hora y lugar legibles en que se hubiera practicado.

                    <br>III. En caso que el interesado o su representante legal rechace la notificación se hará constar este hecho en la diligencia respectiva con intervención de testigo debidamente identificado y se tendrá la notificación por efectuada a todos los efectos legales.

                    <h4>ARTÍCULO 85</h4> (NOTIFICACIÓN POR CÉDULA).

                    <br>I. Cuando el interesado o su representante no fuera encontrado en su domicilio, el funcionario de la Administración dejará aviso de visita a cualquier persona mayor de dieciocho (18) años que se encuentre en él, o en su defecto a un vecino del mismo, bajo apercibimiento de que será buscado nuevamente a hora determinada del día hábil siguiente.

                    <br>II. Si en esta ocasión tampoco pudiera ser habido, el funcionario bajo responsabilidad formulará representación jurada de las circunstancias y hechos anotados, en mérito de los cuales la autoridad de la respectiva Administración Tributaria instruirá se proceda a la notificación por cédula.

                    <br>III. La cédula estará constituida por copia del acto a notificar, firmada por la autoridad que lo expidiera y será entregada por el funcionario de la Administración en el domicilio del que debiera ser notificado a cualquier persona mayor de dieciocho (18) años, o fijada en la puerta de su domicilio, con intervención de un testigo de actuación que también firmará la diligencia.

                    <h4>ARTÍCULO 86</h4> (NOTIFICACIÓN POR EDICTOS). Cuando no sea posible practicar la notificación personal o por cédula, por desconocerse el domicilio del interesado, o intentada la notificación en cualquiera de las formas previstas, en este Código, ésta no hubiera podido ser realizada, se practicará la notificación por edictos publicados en dos (2) oportunidades con un intervalo de por lo menos tres (3) días corridos entre la primera y segunda publicación, en un órgano de prensa de circulación nacional. En este caso, se considerará como fecha de notificación la correspondiente a la publicación del último edicto.

                    Las Administraciones Tributarias quedan facultadas para efectuar publicaciones mediante órganos de difusión oficial que tengan circulación nacional.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27874 de 26/11/2004, Reglamenta Algunos Aspectos del Código Tributario Boliviano, en su Artículo 5, señala lo siguiente:
                    "ARTÍCULO 5 (NOTIFICACIÓN POR EDICTO). Las notificaciones por edictos deben señalar como mínimo, el nombre o razón social del sujeto pasivo y/o tercero responsable, su número de registro en la Administración Tributaria, la identificación del acto administrativo y las especificaciones sobre la deuda tributaria (períodos, impuestos y montos)".

                    <h4>ARTÍCULO 87</h4> (POR CORRESPONDENCIA POSTAL Y OTROS SISTEMAS DE COMUNICACIÓN). Para casos en lo que no proceda la notificación personal, será válida la notificación practicada por correspondencia postal certificada, efectuada mediante correo público o privado. También será válida la notificación que se practique mediante sistemas de comunicación electrónicos, facsímiles, o por cualquier otro medio tecnológicamente disponible, siempre que los mismos permitan verificar su
                    En las notificaciones practicadas en esta forma, los plazos empezarán a correr desde el día de su recepción tratándose de día hábil administrativo; de lo contrario, se tendrá por practicada la notificación a efectos de cómputo, a primera hora del día hábil administrativo siguiente.

                    <h4>ARTÍCULO 88</h4> (NOTIFICACIÓN TÁCITA). Se tiene por practicada la notificación tácita, cuando el interesado a través de cualquier gestión o petición, efectúa cualquier acto o hecho que demuestre el conocimiento del acto administrativo. En este caso, se considerará como fecha de notificación el momento de efectuada la gestión, petición o manifestación.

                    <h4>ARTÍCULO 89</h4> (NOTIFICACIONES MASIVAS). Las Vistas de Cargo, las Resoluciones Determinativas y Resoluciones Sancionatorias, emergentes del procedimiento determinativo en casos especiales establecido en el Artículo 97 del presente Código que afecten a una generalidad de deudores tributarios y que no excedan de la cuantía fijada por norma reglamentaria, podrán notificarse en la siguiente forma:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. La Administración Tributaria mediante publicación en órganos de prensa de circulación nacional citará a los sujetos pasivos y terceros responsables para que dentro del plazo de cinco (5) días computables a partir de la publicación, se apersonen a sus dependencias a efecto de su notificación.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Transcurrido dicho plazo sin que se hubieran apersonado, la Administración Tributaria efectuará una segunda y última publicación, en los mismos medios, a los quince (15) días posteriores a la primera en las mismas condiciones. Si los interesados no comparecieran en esta segunda oportunidad, previa constancia en el expediente se tendrá por practicada la notificación.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano en su Artículo 13, señala lo siguiente:

                    "ARTÍCULO 13 (NOTIFICACIONES MASIVAS).
                    <br>I. Las notificaciones masivas deben señalar el nombre del sujeto pasivo o tercero responsable, su número de registro en la Administración Tributaria, la identificación del acto administrativo y la dependencia donde debe apersonarse.

                    <br>II. Las Administraciones Tributarias podrán utilizar las notificaciones masivas para cualquier acto que no esté sujeto a un medio específico de notificación, conforme lo dispuesto por la Ley N° 2492.

                    <br>III. Las cuantías para practicar esta forma de notificación serán:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Para el Servicio de Impuestos Nacionales y la Aduana Nacional, hasta diez mil Unidades de Fomento de la Vivienda (10.000 UFV's) por cada acto administrativo.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Para los Gobiernos Municipales, las que establezcan mediante resolución de la máxima autoridad tributaria".

                    <h4>ARTÍCULO 90</h4> (NOTIFICACIÓN EN SECRETARIA). Los actos administrativos que no requieran notificación personal serán notificados en Secretaría de la Administración Tributaria, para cuyo fin deberá asistir ante la instancia administrativa que sustancia el trámite, todos los miércoles de cada semana, para notificarse con todas las actuaciones que se hubieran producido. La diligencia de notificación se hará constar en el expediente correspondiente. La inconcurrencia del interesado no impedirá que se practique la diligencia de notificación.

                    En el caso de Contrabando, el Acta de Intervención y la Resolución Determinativa serán notificadas bajo este medio.

                    <h4>ARTÍCULO 91</h4> (NOTIFICACIÓN A REPRESENTANTES). La notificación en el caso de empresas unipersonales y personas jurídicas se podrá practicar válidamente en la persona que estuviera registrada en la Administración Tributaria como representante legal. El cambio de representante legal solamente tendrá efectos a partir de la comunicación y registro del mismo ante la Administración Tributaria correspondiente.

                    <h4>SECCIÓN IV: DETERMINACIÓN DE LA DEUDA TRIBUTARIA</h4>

                    <h4>ARTÍCULO 92</h4> (DEFINICIÓN). La determinación es el acto por el cual el sujeto pasivo o la Administración Tributaria declara la existencia y cuantía de una deuda tributaria o su inexistencia.

                    <h4>ARTÍCULO 93</h4> (FORMAS DE DETERMINACIÓN). I. La determinación de la deuda tributaria se realizará:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Por el sujeto pasivo o tercero responsable, a través de declaraciones juradas, en las que se determina la deuda tributaria.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Por la Administración Tributaria, de oficio en ejercicio de las facultades otorgadas por Ley.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 29, señala lo siguiente:

                    "ARTÍCULO 29 (DETERMINACIÓN DE LA DEUDA POR PARTE DE LA ADMINISTRACIÓN). La determinación de la deuda tributaria por parte de la Administración se realizará mediante los procesos de fiscalización, verificación, control o investigación realizados por el Servicio de Impuestos Nacionales que, por su alcance respecto a los impuestos, períodos y hechos, se clasifican en:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Determinación total, que comprende la fiscalización de todos los impuestos de por lo menos una gestión fiscal.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Determinación parcial, que comprende la fiscalización de uno o más impuestos de uno o más períodos.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Verificación y control puntual de los elementos, hechos, transacciones económicas y circunstancias que tengan incidencia sobre el importe de los impuestos pagados o por pagar.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Verificación y control del cumplimiento a los deberes formales.

                    Si en la aplicación de los procedimientos señalados en los literales a), b) y c) se detectara la falta de cumplimiento a los deberes formales, se incorporará los cargos que correspondieran".

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Mixta, cuando el sujeto pasivo o tercero responsable aporte los datos en mérito a los cuales la Administración Tributaria fija el importe a pagar.

                    <br>II. La determinación practicada por la Administración Tributaria podrá ser total o parcial. En ningún caso podrá repetirse el objeto de la fiscalización ya practicada, salvo cuando el contribuyente o tercero responsable hubiera ocultado dolosamente información vinculada a hechos gravados.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 30, señala lo siguiente:

                    "ARTÍCULO 30 (RESTRICCIÓN A LAS FACULTADES DE CONTROL, VERIFICACIÓN, INVESTIGACIÓN Y FISCALIZACIÓN). A los efectos de lo dispuesto por el Parágrafo II del Artículo 93 de la Ley N° 2492, la Administración Tributaria podrá efectuar el proceso de determinación de impuestos, hechos, transacciones económicas y elementos que no hubiesen sido afectados dentro del alcance de un proceso de determinación o verificación anterior, salvo cuando el sujeto pasivo o tercero responsable hubiera ocultado dolosamente información vinculada a hechos gravados".

                    <H4>SUBSECCIÓN I:
                        DETERMINACIÓN POR EL SUJETO PASIVO O TERCERO RESPONSABLE</H4>

                    <h4>ARTÍCULO 94</h4> (DETERMINACIÓN POR EL SUJETO PASIVO O TERCERO RESPONSABLE).
                    <br>I. La determinación de la deuda tributaria por el sujeto pasivo o tercero responsable es un acto de declaración de éste a la Administración Tributaria.
                    <br>II. La deuda tributaria determinada por el sujeto pasivo o tercero responsable y comunicada a la Administración Tributaria en la correspondiente declaración jurada, podrá ser objeto de ejecución tributaria sin necesidad de intimación ni determinación administrativa previa, cuando la Administración Tributaria compruebe la inexistencia de pago o su pago parcial.

                    <H4>SUBSECCIÓN II:</H4>
                    DETERMINACIÓN POR LA ADMINISTRACIÓN TRIBUTARIA

                    <h4>ARTÍCULO 95</h4> (CONTROL, VERIFICACIÓN, FISCALIZACIÓN E INVESTIGACIÓN).

                    <br>I. Para dictar la Resolución Determinativa la Administración Tributaria debe controlar, verificar, fiscalizar o investigar los hechos, actos, datos, elementos, valoraciones y demás circunstancias que integren o condicionen el hecho imponible declarados por el sujeto pasivo, conforme a las facultades otorgadas por este Código y otras disposiciones legales tributarias.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 32, señala lo siguiente:
                    "ARTÍCULO 32 (PROCEDIMIENTOS DE VERIFICACIÓN Y CONTROL PUNTUAL). El procedimiento de verificación y control de elementos, hechos y circunstancias que tengan incidencia sobre el importe pagado o por pagar de impuestos, se iniciará con la notificación al sujeto pasivo o tercero responsable con una Orden de Verificación que se sujetará a los requisitos y procedimientos definidos por reglamento de la Administración Tributaria".

                    <br>II. Asimismo, podrá investigar los hechos, actos y elementos del hecho imponible no declarados por el sujeto pasivo, conforme a lo dispuesto por este Código.

                    <h5>Nota del Editor:</h5>

                    Ley N° 1357 de 22/12/2020; en su Disposición Adicional Única, establece:
                    "I. Se incorpora el inciso g) en el Parágrafo I del Artículo 473 de la Ley N° 393 de 21 de agosto de 2013 de Servicios Financieros, con el siguiente texto:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;g) El Servicio de Impuestos Nacionales, para el intercambio de información en el marco de los Tratados, Convenios y otros instrumentos jurídicos internacionales, así como para la investigación de grandes fortunas y operaciones financieras relacionadas con personas naturales o jurídicas, constituidas o situadas en países de baja o nula tributación. Las servidoras y los servidores públicos, y las ex servidoras y los ex servidores públicos del Servicio de Impuestos Nacionales no podrán divulgar, ceder o comunicar la información obtenida en razón de su cargo, que por disposición de la Ley es reservada, bajo responsabilidad administrativa, civil o penal que de dicho acto resultare.
                    <br>II. Se modifica el Parágrafo II del Artículo 473 de la Ley N° 393 de 21 de agosto de 2013, de
                    Servicios Financieros, con el siguiente texto:
                    <br>II. En el caso de los incisos a), c) y g), el requerimiento de información se canalizará a través de la Autoridad de Supervisión del Sistema Financiero ASFI. El requerimiento de información señalado en el inciso b), podrá realizarse directamente a las entidades financieras, las mismas que estarán obligadas a proporcionar la información con copia a la ASFI."

                    <h4>ARTÍCULO 96</h4> (VISTA DE CARGO O ACTA DE INTERVENCIÓN).

                    <br>I. La Vista de Cargo, contendrá los hechos, actos, datos, elementos y valoraciones que fundamenten la Resolución Determinativa, procedentes de la declaración del sujeto pasivo o tercero responsable, de los elementos de prueba en poder de la Administración Tributaria o de los resultados de las actuaciones de control, verificación, fiscalización e investigación. Asimismo, fijará la base imponible, sobre base cierta o sobre base presunta, según corresponda, y contendrá la liquidación previa del tributo adeudado.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 18, señala lo siguiente:

                    "ARTÍCULO 18 (VISTA DE CARGO). La Vista de Cargo que dicte la Administración, deberá consignar los siguientes requisitos esenciales:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Número de la Vista de Cargo. b) Fecha.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Nombre o razón social del sujeto pasivo.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Número de registro tributario, cuando corresponda.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Indicación del tributo (s) y, cuando corresponda, período (s) fiscal (es).

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) Liquidación previa de la deuda tributaria.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;g) Acto u omisión que se atribuye al presunto autor, así como la calificación de la sanción en el caso de las contravenciones tributarias y requerimiento a la presentación de descargos, en el marco de lo dispuesto en el Parágrafo I del Artículo 98 de la Ley N° 2492.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;h) Firma, nombre y cargo de la autoridad competente".

                    <br>II. En Contrabando, el Acta de Intervención que fundamente la Resolución Sancionatoria o Determinativa, contendrá la relación circunstanciada de los hechos, actos, mercancías, elementos, valoración y liquidación, emergentes del operativo aduanero correspondiente, el cual deberá ser elaborado en un plazo no mayor a diez (10) días hábiles siguientes al inicio de la intervención.


                    <h5>Nota del Editor:</h5>
                    Ley N° 317 de 11/12/2012; Ley del Presupuesto General del Estado Gestión 2013, mediante su Disposición Adicional Décima Tercera, modificó el Parágrafo precedente.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en sus Artículos 66, 60, 61 y 63, señalan lo siguiente:

                    "ARTÍCULO 66 (ACTA DE INTERVENCIÓN). El Acta de Intervención por contravención de contrabando deberá contener los siguientes requisitos esenciales:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Número del Acta de Intervención.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Fecha.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Relación circunstanciada de los hechos.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Identificación de los presuntos responsables, cuando corresponda. e) Descripción de la mercancía y de los instrumentos decomisados.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) Valoración preliminar de la mercancía decomisada y liquidación previa de los tributos. g) Disposición de monetización inmediata de las mercancías.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;h) Firma, nombre y cargo de los funcionarios intervinientes".
                    "ARTÍCULO 60 (REMATE EN CASO DE CONTRAVENCIONES ADUANERAS).
                    El remate de bienes decomisados, incautados, secuestrados o embargados en casos de contravenciones aduaneras, se realizará por la Administración Aduanera directamente o a través de terceros autorizados por la misma para este fin, en la forma y según medios que se establecerá mediante resolución de la máxima autoridad normativa de la Aduana Nacional. Los bienes se rematarán en los lugares que disponga la Administración Aduanera en función de procurar el mayor beneficio para el Estado.

                    En casos de contravención aduanera de contrabando, la administración tributaria procederá al remate de las mercancías decomisadas, dentro de los diez (10) días siguientes a la elaboración del acta de intervención, en aplicación del Parágrafo II del Artículo 96 de la Ley N° 2492.

                    El valor base del remate será el valor CIF de importación que se determinará según la base de precios referenciales de la Aduana Nacional, rebajado en un cuarenta por ciento (40%), no incluirá tributos aduaneros y el adjudicatario asumirá, por cuenta propia, el pago de dichos tributos y el cumplimiento de los requisitos y formalidades aduaneras para la nacionalización de la mercancía. No será necesaria la presentación de autorizaciones previas, con excepción de mercancías que constituyan sustancias controladas reguladas por la Ley N° 1008 y tratándose de mercancías que requieren certificados sanitarios, sólo se exigirá la presentación del certificado sanitario emitido por autoridad nacional.

                    La liquidación de los tributos aduaneros de importación se efectuará sobre el valor de adjudicación como base imponible.

                    Cuando en el acto de remate no se presenten postores, la Administración Aduanera procederá a la venta directa a la mejor propuesta presentada, pudiendo realizarse a través de medios informáticos o electrónicos, conforme a procedimiento aprobado por la máxima autoridad normativa.

                    Tratándose de productos perecibles, alimentos o medicamentos, la publicación del edicto de notificación y del aviso de remate se efectuará en forma conjunta con 24 horas de anticipación a la fecha del remate. Se procederá al remate sin precio base y se adjudicará al mejor postor. En caso de que dichas mercancías requieran certificados sanitarios, la Administración Aduanera solicitará en forma previa la certificación oficial del órgano competente que deberá ser emitida con anterioridad al acto del remate. Cuando en el acto del remate no se presenten postores y se trate de mercancías perecederas, alimentos o medicamentos de próximo vencimiento que imposibilite su remate dentro de los plazos establecidos al efecto, la Administración Aduanera en representación del Estado dispondrá la adjudicación gratuita a entidades públicas de asistencia social, de educación o de salud".

                    "ARTÍCULO 61 (REMATE EN CASO DE DELITOS ADUANEROS). Las mercancías, medios y unidades de transporte decomisadas por delitos aduaneros, así como los demás bienes embargados o gravados en los registros públicos, serán rematados por la Administración Aduanera o por empresas privadas contratadas al efecto.

                    El valor base del remate será el precio promedio de mercado local con la rebaja del cuarenta por ciento (40%) y, para tal efecto, la Administración Aduanera podrá contratar empresas privadas especializadas en peritaje de valor. En forma alternativa, podrá disponer la venta directa de mercancías a la mejor propuesta presentada a través de medios informáticos o electrónicos, conforme a procedimiento aprobado por su máxima autoridad normativa.

                    El adjudicatario asumirá por cuenta propia el pago de los tributos aduaneros de importación aplicables para el despacho aduanero a consumo y el cumplimiento de las demás formalidades para el despacho aduanero. Los tributos aduaneros se determinarán sobre el valor adjudicado.

                    El Reglamento de Administración de Bienes Incautados, Decomisados y Confiscados aprobado mediante Decreto Supremo N° 26143 de 6 de abril de 2001, será aplicable en la administración y remate de mercancías decomisadas, con las salvedades establecidas en las normas de la Ley N° 2492 y el presente Reglamento. Para tal efecto, la máxima autoridad normativa de la Aduana Nacional dictará las disposiciones administrativas respectivas".

                    "ARTÍCULO 63 (DESTRUCCIÓN DE MERCANCÍAS DECOMISADAS). La Administración Aduanera procederá a la destrucción inmediata de mercancías decomisadas, previa comunicación al Fiscal y sin perjuicio del proceso penal aduanero que corresponda, en los siguientes casos:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Mercancías prohibidas de ingreso al territorio nacional por el Artículo 117 del Reglamento a la Ley General de Aduanas.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Mercancías descritas en el Artículo 119 del Reglamento a la Ley General de Aduanas, cuando el organismo competente determine que son nocivas a la salud o al medio ambiente.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Cigarrillos, puros o bolsas de tabaco, conforme a lo previsto en el Parágrafo II del Artículo 15 del Decreto Supremo N° 27053 de 26 de mayo de 2003.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Otras mercancías prohibidas por disposiciones legales.

                    En todos los casos, la Administración Aduanera remitirá el acta de destrucción a conocimiento de la autoridad jurisdiccional competente. Los gastos que demande la destrucción deberán ser atribuidos a los imputados o procesados en sede administrativa o en sede jurisdiccional, según corresponda".

                    <br>III. La ausencia de cualquiera de los requisitos esenciales establecidos en el reglamento viciará de nulidad la Vista de Cargo o el Acta de Intervención, según corresponda.

                    <h4>ARTÍCULO 97</h4> (PROCEDIMIENTO DETERMINATIVO EN CASOS ESPECIALES).

                    <br>I. Cuando la Administración Tributaria establezca la existencia de errores aritméticos contenidos en las Declaraciones Juradas, que hubieran originado un menor valor a pagar o un mayor saldo a favor del sujeto pasivo, la Administración Tributaria efectuará de oficio los ajustes que correspondan y no deberá elaborar Vista de Cargo, emitiendo directamente Resolución Determinativa.
                    En este caso, la Administración Tributaria requerirá la presentación de declaraciones juradas rectificatorias.

                    El concepto de error aritmético comprende las diferencias aritméticas de toda naturaleza, excepto los datos declarados para la determinación de la base imponible.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 34, Parágrafo I, señala lo siguiente:

                    "ARTÍCULO 34 (DETERMINACIÓN EN CASOS ESPECIALES).

                    <br>I. A efecto de lo dispuesto en el Parágrafo I del Artículo 97 de la Ley N° 2492, constituyen errores aritméticos las diferencias establecidas por la Administración Tributaria en la revisión de los cálculos efectuados por los sujetos pasivos o terceros responsables en las declaraciones juradas presentadas cuyo resultado derive en un menor importe pagado o un saldo a favor del sujeto pasivo mayor al que corresponda.

                    Cuando la diferencia genere un saldo a favor del fisco, la Administración Tributaria emitirá una Resolución Determinativa por el importe impago.

                    Si la diferencia genera un saldo a favor del sujeto pasivo mayor al que le corresponde, la Administración Tributaria emitirá una conminatoria para que presente una Declaración Jurada Rectificatoria.

                    La calificación de la conducta y la sanción por el ilícito tributario será determinada mediante un sumario contravencional, por lo cual no se consignará en la Resolución Determinativa o en la conminatoria para la presentación de la Declaración Jurada Rectificatoria.

                    La deuda tributaria o la disminución del saldo a favor del sujeto pasivo así determinada, no inhibe a la Administración Tributaria a ejercitar sus facultades de fiscalización sobre el tributo declarado.
                    (...)".

                    <br>II. Cuando el sujeto pasivo o tercero responsable no presenten la declaración jurada o en ésta se omitan datos básicos para la liquidación del tributo, la Administración Tributaria los intimará a su presentación o, a que se subsanen las ya presentadas.

                    A tiempo de intimar al sujeto pasivo o tercero responsable, la Administración Tributaria deberá notificar, en unidad de acto, la Vista de Cargo que contendrá un monto presunto calculado de acuerdo a lo dispuesto por normas reglamentarias.

                    Dentro del plazo previsto en el Artículo siguiente, el sujeto pasivo o tercero responsable aún podrá presentar la declaración jurada extrañada o, alternativamente, pagar el monto indicado en la Vista de Cargo.

                    Si en el plazo previsto no hubiera optado por alguna de las alternativas, la Administración Tributaria dictará la Resolución Determinativa que corresponda.

                    El monto determinado por la Administración Tributaria y pagado por el sujeto pasivo o tercero responsable se tomará a cuenta del impuesto que en definitiva corresponda pagar, en caso que la Administración Tributaria ejerciera su facultad de control, verificación, fiscalización e investigación.

                    La impugnación de la Resolución Determinativa a que se refiere este parágrafo no podrá realizarse fundándose en hechos, elementos o documentos distintos a los que han servido de base para la determinación de la base presunta y que no hubieran sido puestos oportunamente en conocimiento de la Administración Tributaria, salvo que el impugnante pruebe que la omisión no fue por causa propia, en cuyo caso deberá presentarlos con juramento de reciente obtención.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 34, Parágrafo II, señala lo siguiente:

                    "ARTÍCULO 34 (DETERMINACIÓN EN CASOS ESPECIALES).
                    (...)

                    <br>II. A efecto de lo dispuesto en el Parágrafo II del mismo Artículo, se entiende por dato básico aquél que permite identificar al sujeto pasivo o tercero responsable y a la obligación tributaria. La omisión de un dato básico en una declaración jurada, obliga a la Administración a presumir la falta de presentación de dicha declaración.

                    Para determinar el monto presunto por omisión de datos básicos o falta de presentación de declaraciones juradas, se tomará el mayor tributo mensual declarado o determinado dentro de los doce (12) períodos inmediatamente anteriores al de la omisión del cumplimiento de esta obligación, seis (6) períodos trimestrales anteriores en el caso de impuestos trimestrales y cuatro (4) períodos anteriores en el caso de impuestos anuales. Este monto debe ser expresado en Unidades de Fomento de la Vivienda considerando la fecha de vencimiento del período tomado como base de determinación del monto presunto. Si no se hubieran presentado declaraciones juradas por los períodos citados, se utilizarán las gestiones anteriores no prescritas.

                    De no contarse con la información necesaria para determinar el monto presunto, se determinará la obligación, aplicando lo dispuesto por el Artículo 45 de la Ley N° 2492.

                    El importe del monto presunto así calculado, si fuera cancelado por el sujeto pasivo o tercero responsable, se tomará como pago a cuenta del impuesto que en definitiva corresponda.

                    Alternativamente, el sujeto pasivo o tercero responsable podrá presentar la declaración jurada extrañada o corregir el error material ocasionado por la falta del dato básico, en la forma que la Administración Tributaria defina mediante reglamento, el cual señalará además, la forma en que serán tratados los débitos y/o créditos producto de la falta de presentación de declaraciones juradas u omisión de datos básicos".

                    <br>III. La liquidación que resulte de la determinación mixta y refleje fielmente los datos proporcionados por el contribuyente, tendrá el carácter de una Resolución Determinativa, sin perjuicio de que la Administración Tributaria pueda posteriormente realizar una determinación de oficio ejerciendo sus facultades de control, verificación, fiscalización e investigación.

                    <br>IV. En el Caso de Contrabando, el Acta de Intervención equivaldrá en todos sus efectos a la Vista de Cargo.

                    <h4>ARTÍCULO 98</h4> (DESCARGOS). Una vez notificada la Vista de Cargo, el sujeto pasivo o tercero responsable tiene un plazo perentorio e improrrogable de treinta (30) días para formular y presentar los descargos que estime convenientes.

                    Practicada la notificación con el Acta de Intervención por Contrabando, el interesado presentará sus descargos en un plazo perentorio e improrrogable de tres (3) días hábiles administrativos.

                    <h4>ARTÍCULO 99</h4> (RESOLUCIÓN DETERMINATIVA).

                    <br>I. Vencido el plazo de descargo previsto en el primer párrafo del Artículo anterior, se dictará y notificará la Resolución Determinativa dentro el plazo de sesenta (60) días y para Contrabando dentro el plazo de diez (10) días hábiles administrativos, aun cuando el sujeto pasivo o tercero responsable hubiera prestado su conformidad y pagado la deuda tributaria, plazo que podrá ser prorrogado por otro similar de manera excepcional, previa autorización de la máxima autoridad normativa de la Administración Tributaria.

                    En caso que la Administración Tributaria no dictara Resolución Determinativa dentro del plazo previsto, no se aplicarán intereses sobre el tributo determinado desde el día en que debió dictarse, hasta el día de la notificación con dicha resolución.

                    <br>II. La Resolución Determinativa que dicte la Administración deberá contener como requisitos mínimos; Lugar y fecha, nombre o razón social del sujeto pasivo, especificaciones sobre la deuda tributaria, fundamentos de hecho y de derecho, la calificación de la conducta y la sanción en el caso de contravenciones, así como la firma, nombre y cargo de la autoridad competente. La ausencia de cualquiera de los requisitos esenciales, cuyo contenido será expresamente desarrollado en la reglamentación que al efecto se emita, viciará de nulidad la Resolución Determinativa.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 19, señala lo siguiente: 77
                    "ARTÍCULO 19 (RESOLUCIÓN DETERMINATIVA). La Resolución Determinativa deberá consignar los requisitos mínimos establecidos en el Artículo 99 de la Ley N° 2492.
                    Las especificaciones sobre la deuda tributaria se refieren al origen, concepto y determinación del adeudo tributario calculado de acuerdo a lo establecido en el Artículo 47 de dicha Ley.
                    En el ámbito aduanero, los fundamentos de hecho y de derecho contemplarán una descripción concreta de la declaración aduanera, acto o hecho y de las disposiciones legales aplicables al caso".

                    <br>III. La Resolución Determinativa tiene carácter declarativo y no constitutivo de la obligación tributaria.

                    <h4>SECCIÓN V:
                        CONTROL, VERIFICACIÓN, FISCALIZACIÓN E INVESTIGACIÓN</h4>

                    <h4>ARTÍCULO 100</h4> (EJERCICIO DE LA FACULTAD). La Administración Tributaria dispondrá indistintamente de amplias facultades de control, verificación, fiscalización e investigación, a través de las cuales, en especial, podrá:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Exigir al sujeto pasivo o tercero responsable la información necesaria, así como cualquier libro, documento y correspondencia con efectos tributarios.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Inspeccionar y en su caso secuestrar o incautar registros contables, comerciales, aduaneros, datos, bases de datos, programas de sistema (software de base) y programas de aplicación (software de aplicación), incluido el código fuente, que se utilicen en los sistemas informáticos de registro y contabilidad, la información contenida en las bases de datos y toda otra documentación que sustente la obligación tributaria o la obligación de pago, conforme lo establecido en el Artículo 102 parágrafo II.


                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano,

                    "ARTÍCULO 17 (SECUESTRO O INCAUTACIÓN DE DOCUMENTACIÓN E INFORMACIÓN). La Administración Tributaria podrá secuestrar o incautar documentación y obtener copias de la información contenida en sistemas informáticos y/o unidades de almacenamiento cuando el sujeto pasivo o tercero responsable no presente la información o documentación requerida o cuando considere que existe riesgo para conservar la prueba que sustente la determinación de la deuda tributaria, aplicando el siguiente procedimiento:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) La autoridad competente de la Administración Tributaria solicitará la participación de un representante del Ministerio Público, quien tendrá la obligación de asistir a sólo requerimiento de la misma, para efectuar el secuestro o incautación de documentación o copia de la información electrónica del contribuyente.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) En presencia de dicha autoridad se procederá al secuestro de la documentación y, en su caso, a la copia de la información de los sistemas informáticos del sujeto pasivo.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Finalmente se labrará un Acta de Secuestro o Incautación de Documentación o Información Electrónica, que deberá ser firmada por los actuantes y el sujeto pasivo o tercero responsable o la persona que se encontrara en el lugar, salvo que no quisiera hacerlo, en cuyo caso con la intervención de un testigo de actuación se deberá dejar constancia del hecho".

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Realizar actuaciones de inspección material de bienes, locales, elementos, explotaciones e instalaciones relacionados con el hecho imponible. Requerir el auxilio inmediato de la fuerza pública cuando fuera necesario o cuando sus funcionarios tropezaran con inconvenientes en el desempeño de sus funciones.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4.
                    Realizar controles habituales y no habituales de los depósitos aduaneros, zonas francas, tiendas libres y otros establecimientos vinculados o no al comercio exterior, así como practicar avalúos o verificaciones físicas de toda clase de bienes o mercancías, incluso durante su transporte o tránsito.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;5.
                    Requerir de las entidades públicas, operadores de comercio exterior, auxiliares de la función pública aduanera y terceros, la información y documentación relativas a operaciones de comercio exterior, así como la presentación de dictámenes técnicos elaborados por profesionales especializados en la materia.


                    <br>&nbsp;&nbsp;&nbsp;&nbsp;6.
                    Solicitar informes a otras Administraciones Tributarias, empresas o instituciones tanto nacionales como extranjeras, así como a organismos internacionales.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;7.
                    Intervenir los ingresos económicos de los espectáculos públicos que no hayan sido previamente puestos a conocimiento de la Administración Tributaria para su control tributario.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;8.
                    Embargar preventivamente dinero y mercancías en cuantía suficiente para asegurar el pago de la deuda tributaria que corresponda exigir por actividades lucrativas ejercidas sin establecimiento y que no hubieran sido declaradas.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;9.
                    Recabar del juez cautelar de turno, orden de allanamiento y requisa que deberá ser

                    despachada dentro de las cinco (5) horas siguientes a la presentación del requerimiento

                    fiscal, con habilitación de días y horas inhábiles si fueran necesarias, bajo responsabilidad.

                    Las facultades de control, verificación, fiscalización e investigación descritas en este Artículo, son funciones administrativas inherentes a la Administración Tributaria de carácter prejudicial y no constituye persecución penal.


                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 Reglamento al Código Tributario Boliviano de 09/01/2004, en sus Artículos 48 y 49, señalan lo siguiente:

                    "ARTÍCULO 48 (FACULTADES DE CONTROL). La Aduana Nacional ejercerá las facultades de control establecidas en los Artículos 21 y 100 de la ley N° 2492 en las fases de: control anterior, control durante el despacho (aforo) u otra operación aduanera y control diferido. La verificación de calidad, valor en aduana, origen u otros aspectos que no puedan ser evidenciados durante estas fases, podrán ser objeto de fiscalización posterior".
                    "ARTÍCULO 49 (FACULTADES DE FISCALIZACIÓN). La Aduana Nacional ejercerá las facultades de fiscalización en aplicación de lo dispuesto en los Artículos 21, 100 y 104 de la Ley N° 2492.

                    Dentro del alcance del Artículo 100 de la Ley N° 2492, podrá:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Practicar las medidas necesarias para determinar el tipo, clase, especie, naturaleza, pureza, cantidad, calidad, medida, origen, procedencia, valor, costo de producción, manipulación, transformación, transporte y comercialización de las mercancías.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Realizar inspección e inventario de mercancías en establecimientos vinculados con el comercio exterior, para lo cual el operador de comercio exterior deberá prestar el apoyo logístico correspondiente (estiba, desestiba, descarga y otros).

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Realizar, en coordinación con las autoridades aduaneras del país interesado, investigaciones fuera del territorio nacional, con el objeto de obtener elementos de juicio para prevenir, investigar, comprobar o reprimir delitos y contravenciones aduaneras.

                    Las labores de fiscalización se realizarán con la presentación de la orden de fiscalización suscrita por la autoridad aduanera competente y previa identificación de los funcionarios aduaneros en cualquier lugar, edificio o establecimiento de personas naturales o jurídicas. En caso de resistencia, la Aduana Nacional recabará orden de allanamiento y requisa de la autoridad competente y podrá recurrir al auxilio de la fuerza pública.

                    Dentro del marco establecido en el Artículo 104 de la Ley N° 2492, la máxima autoridad normativa de la Aduana Nacional mediante resolución aprobará los procedimientos de fiscalización aduanera".

                    <h4>ARTÍCULO 101</h4> (LUGAR DONDE SE DESARROLLAN LAS ACTUACIONES).

                    <br>I. La facultad de control, verificación, fiscalización e investigación, se podrá desarrollar indistintamente:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. En el lugar donde el sujeto pasivo tenga su domicilio tributario o en el del representante que a tal efecto hubiera designado.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Donde se realicen total o parcialmente las actividades gravadas o se encuentren los bienes gravados.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Donde exista alguna prueba al menos parcial, de la realización del hecho imponible.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. En casos debidamente justificados, estas facultades podrán ejercerse en las oficinas públicas; en estos casos la documentación entregada por el contribuyente deberá ser debidamente preservada, bajo responsabilidad funcionaria.

                    <br>II. Los funcionarios de la Administración Tributaria en ejercicio de sus funciones podrán ingresar a los almacenes, establecimientos, depósitos o lugares en que se desarrollen actividades o explotaciones sometidas a gravamen para ejercer las funciones previstas en este Código.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 33, señala lo siguiente:

                    "ARTÍCULO 33 (LUGAR DONDE SE DESARROLLAN LAS ACTUACIONES). Cuando los elementos sobre los que se realicen las verificaciones puedan ser examinados en las oficinas de la Administración, éstas se desarrollarán en las mismas oficinas, sin que sea necesaria autorización superior específica.
                    La Administración Tributaria podrá realizar controles, verificaciones, fiscalizaciones e investigaciones en días y horas inhábiles para la misma, cuando las circunstancias del hecho o la actividad económica del sujeto pasivo así lo requieran.
                    Cuando la persona bajo cuya custodia se halle la propiedad, local o edificio, se opusiere a la entrada de los fiscalizadores, éstos podrán llevar a cabo su actuación solicitando el auxilio de la fuerza pública o recabando Orden de Allanamiento".

                    <h4>ARTÍCULO 102</h4> (MEDIDAS PARA LA CONSERVACIÓN DE PRUEBAS).

                    <br>I. Para la conservación de la documentación y de cualquier otro medio de prueba relevante para la determinación de la deuda tributaria, incluidos programas informáticos y archivos en soporte magnético, la autoridad competente de la Administración Tributaria correspondiente podrá disponer 81 la adopción de las medidas que se estimen precisas a objeto de impedir su desaparición, destrucción o alteración.

                    <br>II. Las medidas serán adecuadas al fin que se persiga y deberán estar debidamente justificadas.

                    <br>III. Las medidas consistirán en el precintado del lugar o depósito de mercancías o bienes o productos sometidos a gravamen, así como en la intervención, decomiso, incautación y secuestro de mercancías, libros, registros, medios o unidades de transporte y toda clase de archivos, inclusive los que se realizan en medios magnéticos, computadoras y otros documentos inspeccionados, adoptándose los recaudos para su conservación.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. En materia informática, la incautación se realizará tomando una copia magnética de respaldo general (Backup) de las bases de datos, programas, incluido el código fuente, datos e información a que se refiere el numeral 2 del Artículo 100 del presente Código; cuando se realicen estas incautaciones, la autoridad a cargo de los bienes incautados será responsable legalmente por su utilización o explotación al margen de los estrictos fines fiscales que motivaron su incautación.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 17, señala lo siguiente:
                    "ARTÍCULO 17 (SECUESTRO O INCAUTACIÓN DE DOCUMENTACIÓN E INFORMACIÓN). La Administración Tributaria podrá secuestrar o incautar documentación y obtener copias de la información contenida en sistemas informáticos y/o unidades de almacenamiento cuando el sujeto pasivo o tercero responsable no presente la información o documentación requerida o cuando considere que existe riesgo para conservar la prueba que sustente la determinación de la deuda tributaria, aplicando el siguiente procedimiento:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) La autoridad competente de la Administración Tributaria solicitará la participación de un representante del Ministerio Público, quien tendrá la obligación de asistir a sólo requerimiento de la misma, para efectuar el secuestro o incautación de documentación o copia de la información electrónica del contribuyente.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) En presencia de dicha autoridad se procederá al secuestro de la documentación y, en su caso, a la copia de la información de los sistemas informáticos del sujeto pasivo.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Finalmente se labrará un Acta de Secuestro o Incautación de Documentación o Información Electrónica, que deberá ser firmada por los actuantes y el sujeto pasivo o tercero responsable o la persona que se encontrara en el lugar, salvo que no quisiera hacerlo, en cuyo caso con la intervención de un testigo de actuación se deberá dejar constancia del hecho".

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Cuando se prive al sujeto pasivo o tercero responsable de la disponibilidad de sus documentos, la prueba sea puesta a disposición de la autoridad que deba valorarlas. Al momento de incautar los documentos, la Administración Tributaria queda obligada a su costo, a proporcionar al sujeto pasivo o tercero responsable un juego de copias legalizadas de dichos documentos.

                    <br>IV. Las medidas para la conservación de pruebas se levantarán si desaparecen las circunstancias que justificaron su adopción.

                    <h4>ARTÍCULO 103</h4> (VERIFICACIÓN DEL CUMPLIMIENTO DE DEBERES FORMALES Y DE LA OBLIGACIÓN DE EMITIR FACTURA). La Administración Tributaria podrá verificar el cumplimiento de los deberes formales de los sujetos pasivos y de su obligación de emitir factura, sin que se requiera para ello otro trámite que el de la identificación de los funcionarios actuantes y en caso de verificarse cualquier tipo de incumplimiento se levantará un acta que será firmada por los funcionarios y por el titular del establecimiento o quien en ese momento se hallara a cargo del mismo. Si éste no supiera o se negara a firmar, se hará constar el hecho con testigo de actuación.

                    Se presume, sin admitir prueba en contrario, que quien realiza tareas en un establecimiento lo hace como dependiente del titular del mismo, responsabilizando sus actos y omisiones inexcusablemente a este último.

                    <h4>ARTÍCULO 104</h4> (PROCEDIMIENTO DE FISCALIZACIÓN).

                    <br>I. Sólo en casos en los que la Administración, además de ejercer su facultad de control, verificación, e investigación efectúe un proceso de fiscalización, el procedimiento se iniciará con Orden de Fiscalización emitida por autoridad competente de la Administración Tributaria, estableciéndose su alcance, tributos y períodos a ser fiscalizados, la identificación del sujeto pasivo, así como la identificación del o los funcionarios actuantes, conforme a lo dispuesto en normas reglamentarias que a este efecto se emitan.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 31, señala lo siguiente:
                    "ARTÍCULO 31 (REQUISITOS PARA EL INICIO DE LOS PROCEDIMIENTOS DE DETERMINACIÓN TOTAL O PARCIAL). Conforme a lo establecido en el Parágrafo I del Artículo 104 de la Ley N° 2492, las determinaciones totales y parciales se iniciarán con la notificación al sujeto pasivo o tercero responsable con la Orden de Fiscalización que estará suscrita por la autoridad competente determinada por la Administración Tributaria consignando, como mínimo, la siguiente información:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Número de Orden de Fiscalización.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Lugar y fecha.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Nombre o razón social del sujeto pasivo.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Objeto (s) y alcance de fiscalización.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Nombre de los funcionarios actuantes de la Administración Tributaria. f) Firma de la autoridad competente.
                    La referida orden podrá ser reasignada a otros funcionarios de acuerdo a lo que establezca la Administración Tributaria".

                    <br>II. Los hechos u omisiones conocidos por los funcionarios públicos durante su actuación como fiscalizadores, se harán constar en forma circunstanciada en acta, los cuales junto con las constancias y los descargos presentados por el fiscalizado, dentro los alcances del Artículo 68º de éste Código, harán prueba preconstituida de la existencia de los mismos.

                    <br>III. La Administración Tributaria, siempre que lo estime conveniente, podrá requerir la presentación de declaraciones, la ampliación de éstas, así como la subsanación de defectos advertidos. Consiguientemente estas declaraciones causarán todo su efecto a condición de ser validadas expresamente por la fiscalización actuante, caso contrario no surtirán efecto legal alguno, pero en todos los casos los pagos realizados se tomarán a cuenta de la obligación que en definitiva adeudaran.

                    <br>IV. A la conclusión de la fiscalización, se emitirá la Vista de Cargo correspondiente.

                    <br>V. Desde el inicio de la fiscalización hasta la emisión de la Vista de Cargo no podrán transcurrir más de doce (12) meses, sin embargo cuando la situación amerite un plazo más extenso, previa solicitud fundada, la máxima autoridad ejecutiva de la Administración Tributaria podrá autorizar una prórroga hasta por seis (6) meses más.

                    <h5>Nota del Editor:</h5>
                    Ley Nº 549 de 21/07/2014; en su Disposición Adicional, Única, establece, que en los casos en que la Administración Tributaria verifique el valor de transacción de las partes vinculadas, la prórroga establecida en el Parágrafo precedente, podrá ser autorizada hasta doce meses.
                    Asimismo en su Disposición Final, Única, señala que esta Ley entrará en vigencia al día siguiente del cierre de la gestión fiscal en curso del IUE.

                    <br>VI. Si al concluir la fiscalización no se hubiera efectuado reparo alguno o labrado acta de infracción contra el fiscalizado, no habrá lugar a la emisión de Vista de Cargo, debiéndose en este caso dictar una Resolución Determinativa que declare la inexistencia de la deuda tributaria.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 49, señala lo siguiente:
                    "ARTÍCULO 49 (FACULTADES DE FISCALIZACIÓN). La Aduana Nacional ejercerá las facultades de fiscalización en aplicación de lo dispuesto en los Artículos 21, 100 y 104 de la Ley N° 2492.

                    Dentro del alcance del Artículo 100 de la Ley N° 2492, podrá:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Practicar las medidas necesarias para determinar el tipo, clase, especie, naturaleza, pureza, cantidad, calidad, medida, origen, procedencia, valor, costo de producción, manipulación, transformación, transporte y comercialización de las mercancías.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Realizar inspección e inventario de mercancías en establecimientos vinculados con el comercio exterior, para lo cual el operador de comercio exterior deberá prestar el apoyo logístico correspondiente (estiba, desestiba, descarga y otros).

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Realizar, en coordinación con las autoridades aduaneras del país interesado, investigaciones fuera del territorio nacional, con el objeto de obtener elementos de juicio para prevenir, investigar, comprobar o reprimir delitos y contravenciones aduaneras.

                    Las labores de fiscalización se realizarán con la presentación de la orden de fiscalización suscrita por la autoridad aduanera competente y previa identificación de los funcionarios aduaneros en cualquier lugar, edificio o establecimiento de personas naturales o jurídicas. En caso de resistencia, la Aduana Nacional recabará orden de allanamiento y requisa de la autoridad competente y podrá recurrir al auxilio de la fuerza pública.

                    Dentro del marco establecido en el Artículo 104 de la Ley N° 2492, la máxima autoridad normativa de la Aduana Nacional mediante resolución aprobará los procedimientos de fiscalización aduanera".


                    <h4>SECCIÓN VI:
                        RECAUDACIÓN Y MEDIDAS PRECAUTORIAS</h4>

                    <h4>ARTÍCULO 105</h4> (FACULTAD DE RECAUDACIÓN). La Administración Tributaria está facultada para recaudar las deudas tributarias en todo momento, ya sea a instancia del sujeto pasivo o tercero responsable, o ejerciendo su facultad de ejecución tributaria.

                    <h4>ARTÍCULO 106</h4> (MEDIDAS PRECAUTORIAS).

                    <br>I. Cuando exista fundado riesgo de que el cobro de la deuda tributaria determinada o del monto indebidamente devuelto, se verá frustrado o perjudicado, la Administración Tributaria está facultada para adoptar medidas precautorias, previa autorización de la Superintendencia Regional, bajo responsabilidad funcionaria. Si el proceso estuviera en conocimiento de las Superintendencias, la Administración podrá solicitar a las mismas la adopción de medidas precautorias. 85

                    <h5>Nota del Editor:</h5>
                    Ley N° 3092 de 07/07/2005, mediante su Disposición Final, Primera complementa el Parágrafo I precedente:
                    "PRIMERA Conforme al Parágrafo I del Artículo 106 de la Ley N° 2492, para el decomiso preventivo de mercancías, bienes y medios de transporte en materia aduanera, la Superintendencia Tributaria podrá mediante Resolución Administrativa de carácter general, autorizar a la Aduana Nacional de Bolivia la adopción de estas medidas precautorias, sin perjuicio de las facultades de acción preventiva prevista en el Artículo 186 de la Ley Nº 2492".

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 33, señala lo siguiente:
                    "ARTÍCULO 33 (AUTORIZACIÓN). Conforme al Parágrafo I del Artículo 106 de la Ley N° 2492 Código Tributario Boliviano, para el decomiso preventivo de mercaderías, bienes y medios de transporte en materia aduanera, la Superintendencia Tributaria podrá mediante Resolución Administrativa de carácter general, autorizar a la Aduana Nacional de Bolivia la adopción de estas medidas precautorias, sin perjuicio de las facultades de acción preventiva prevista en el Artículo 186 del Código Tributario Boliviano".


                    <br>II. Las medidas adoptadas serán proporcionales al daño que se pretende evitar.

                    <br>III. Dichas medidas podrán consistir en:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Anotación preventiva en los registros públicos sobre los bienes, acciones y derechos del deudor.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Embargo preventivo de los bienes del deudor.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Retención del pago de devoluciones tributarias o de otros pagos que deba realizar el Estado, en la cuantía estrictamente necesaria para asegurar el cobro de la deuda tributaria.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. Retención de fondos del deudor en la cuantía necesaria para asegurar el cobro de la deuda tributaria. Esta medida se adoptará cuando las anteriores no pudieren garantizar el pago de la deuda tributaria.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;5. Decomiso preventivo de mercancías, bienes y medios de transporte, en materia aduanera.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;6. Otras medidas permitidas por el Código de Procedimiento Civil.

                    <br>IV. Las medidas precautorias se aplicarán con liberación del pago de valores, derechos y almacenaje, que hubieran en los respectivos registros e instituciones públicas. Las medidas precautorias se aplicarán con diferimiento de pago en instituciones privadas.

                    <br>V. Si el pago de la deuda tributaria se realizara dentro de los plazos previstos en este Código o, si las circunstancias que justificaron la adopción de medidas precautorias desaparecieran, la Administración Tributaria procederá al levantamiento inmediato de las medidas precautorias adoptadas, no estando el contribuyente obligado a cubrir los gastos originados por estas diligencias.

                    <br>VI. El deudor podrá solicitar a la Administración Tributaria el cambio de una medida precautoria por otra que le resultara menos perjudicial, siempre que ésta garantice suficientemente el derecho del Fisco.

                    <br>VII. Las medidas precautorias adoptadas por la Administración Tributaria mantendrán su vigencia durante la sustanciación de los recursos administrativos previstos en el Título III de este Código, sin perjuicio de la facultad de la Administración Tributaria de levantarlas con arreglo a lo dispuesto en el parágrafo VI. Asimismo, podrá adoptar cualquier otra medida establecida en este artículo que no hubiere adoptado.

                    <br>VIII. No se embargarán los bienes y derechos declarados inembargables por Ley.

                    <br>IX. En el decomiso de medios o unidades de transporte en materia aduanera, será admisible la sustitución de garantías por garantías reales equivalentes.

                    <br>X. El costo de mantenimiento y conservación de los bienes embargados o secuestrados estará a cargo del depositario conforme a lo dispuesto en los Códigos Civil y de Procedimiento Civil.


                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 11, señala lo siguiente:

                    "ARTÍCULO 11 (MEDIDAS PRECAUTORIAS).
                    <br>I. Para efectos de la aplicación de las medidas precautorias señaladas en el Artículo 106 de la Ley N° 2492, se entenderá que existe riesgo fundado de que el cobro de la deuda tributaria o del monto indebidamente devuelto se vea frustrado o perjudicado, cuando se presenten entre otras, cualquiera de las siguientes situaciones:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Inactivación del número de registro.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Inicio de quiebra o solicitud de concurso de acreedores, así como la existencia de juicios coactivos y ejecutivos.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Cambio de domicilio sin la comunicación correspondiente a la Administración Tributaria o casos de domicilio falso o inexistente.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Cuando la realidad económica, financiera y/o patrimonial del sujeto pasivo o tercero responsable no garantice el cumplimiento de la obligación tributaria.

                    <br>II. La autorización para la adopción de medidas precautorias por parte de la Superintendencia Tributaria a la que se hace referencia en la norma señalada, se realizará siguiendo el procedimiento establecido en el Artículo 31 del Decreto Supremo N° 27241 de 14 de noviembre de 2003 que establece los procedimientos administrativos ante la Superintendencia Tributaria.

                    <br>III. Cuando se requiera la utilización de medios de propiedad privada para la ejecución de las medidas precautorias, el pago por sus servicios será realizado por el sujeto pasivo o tercero responsable afectado con dicha medida".

                    <h4>SECCIÓN VII: EJECUCIÓN TRIBUTARIA</h4>

                    <h4>ARTÍCULO 107</h4> (NATURALEZA DE LA EJECUCIÓN TRIBUTARIA).

                    <br>I. La ejecución tributaria, incluso de los fallos firmes dictados en la vía judicial será exclusivamente administrativa, debiendo la Administración Tributaria conocer todos sus incidentes, conforme al procedimiento descrito en la presente sección.

                    Sentencia Constitucional 0018/2004, de 2 de marzo de 2004: En el Recurso Directo o Abstracto de Inconstitucionalidad, en el cual se demanda la Inconstitucionalidad de los Artículos 107, 131
                    Parágrafo Tercero, 132, 147 Parágrafo Segundo y Disposición Final Primera de la Ley N° 2492 (Código Tributario Boliviano CTB), porque vulnerarían los Artículos 16 y 116 de la Constitución Política del Estado (CPE).

                    El Tribunal Constitucional establece: 1° La CONSTITUCIONALIDAD del Artículo 132 del Código Tributario Boliviano (CTB), y

                    2° La INCONSTITUCIONALIDAD del Artículo 107 Parágrafo I y de la Disposición Final Primera del Código Tributario Boliviano (CTB).

                    <br>II. La ejecución tributaria no será acumulable a los procesos judiciales ni a otros procedimientos de ejecución. Su iniciación o continuación no se suspenderá por la iniciación de aquellos, salvo en los casos en que el ejecutado esté sometido a un proceso de reestructuración voluntaria.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27874 de 26/11/2004, Reglamenta Algunos Aspectos del Código Tributario Boliviano en su Artículo 3, señala lo siguiente:
                    "ARTÍCULO 3 (NATURALEZA DE LA EJECUCIÓN TRIBUTARIA). La ejecución tributaria de resoluciones Administrativas o Judiciales siempre es de naturaleza administrativa, salvo el caso en que la Resolución Judicial ejecutoriada declare probada la pretensión del sujeto pasivo, caso en el cual corresponde su ejecución por la autoridad judicial que dictó la Resolución".

                    <h4>ARTÍCULO 108</h4> (TÍTULOS DE EJECUCIÓN TRIBUTARIA).

                    <br>I. La ejecución tributaria se realizará por la Administración Tributaria con la notificación de los siguientes títulos:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Resolución Determinativa o Sancionatoria firmes, por el total de la deuda tributaria o sanción que imponen.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Autos de Multa firmes.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Resolución firme dictada para resolver el Recurso de Alzada.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. Resolución que se dicte para resolver el Recurso Jerárquico.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;5. Sentencia Judicial ejecutoriada por el total de la deuda tributaria que impone.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;6. Declaración Jurada presentada por el sujeto pasivo que determina la deuda tributaria, cuando ésta no ha sido pagada o ha sido pagada parcialmente, por el saldo deudor.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;7. Liquidación efectuada por la Administración, emergente de una determinación mixta, siempre que ésta refleje fielmente los datos aportados por el contribuyente, en caso que la misma no haya sido pagada, o haya sido pagada parcialmente.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;8. Resolución que concede planes de facilidades de pago, cuando los pagos han sido incumplidos total o parcialmente, por los saldos impagos.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;9. Resolución administrativa firme que exija la restitución de lo indebidamente devuelto.


                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27874 de 26/11/2004, Reglamenta Algunos Aspectos del Código Tributario Boliviano, en su Artículo 4, señala lo siguiente:

                    "ARTÍCULO 4 (TÍTULOS DE EJECUCIÓN TRIBUTARIA). La ejecutabilidad de los títulos listados en el Parágrafo I del Artículo 108 de la Ley N° 2492, procede al tercer día siguiente de la notificación con el proveído que dé inicio a la ejecución
                    tributaria, acto que, de conformidad a las normas vigentes, es inimpugnable". 89

                    <br>II. El Ministerio de Hacienda queda facultado para establecer montos mínimos, a propuesta de la Administración Tributaria, a partir de los cuales ésta deba efectuar el inicio de su ejecución tributaria. En el caso de las Administraciones Tributarias Municipales, estos montos serán fijados por la máxima autoridad ejecutiva.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 20 y Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 9, señalan lo siguiente:

                    D.S. N° 27310: "ARTÍCULO 20 (MONTOS MÍNIMOS PARA LA EJECUCIÓN TRIBUTARIA). La facultad otorgada al Ministerio de Hacienda para establecer montos mínimos a partir de los cuales el Servicio de Impuestos Nacionales y la Aduana Nacional deban efectuar el inicio de la ejecución tributaria, será ejercitada mediante la emisión de una Resolución Ministerial expresa. Los montos así definidos estarán expresados en Unidades de Fomento de la Vivienda UFV's".

                    D.S. N° 27350: "ARTÍCULO 9 (EFECTOS). En aplicación del Artículo 108 del Código Tributario Boliviano, los actos administrativos impugnados mediante los recursos de alzada y jerárquico, en tanto no adquieran la condición de firmes no constituyen, título de ejecución tributaria. La Resolución que se dicte resolviendo el Recursos Jerárquico agota la vía administrativa".


                    <h4>ARTÍCULO 109</h4> (SUSPENSIÓN Y OPOSICIÓN DE LA EJECUCIÓN TRIBUTARIA).

                    <br>I. La ejecución tributaria se suspenderá inmediatamente en los siguientes casos:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Autorización de un plan de facilidades de pago, conforme al Artículo 55 de este Código;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Si el sujeto pasivo o tercero responsable garantiza la deuda tributaria en la forma y condiciones que reglamentariamente se establezca.


                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 35, señala lo siguiente:

                    "ARTÍCULO 35 (SUSPENSIÓN DE LA EJECUCIÓN TRIBUTARIA).
                    <br>I. La solicitud de suspensión podrá abarcar la totalidad o parte del acto impugnado, siempre que éste sea susceptible de ejecución separada.

                    <br>II. Los medios para garantizar la deuda tributaria que implican la suspensión de la ejecución tributaria, serán establecidos en la disposición reglamentaria que al efecto dicte cada Administración Tributaria.

                    <br>III. Aun cuando no se hubiera constituido garantía suficiente sobre la deuda tributaria, la Administración podrá suspender la ejecución tributaria de oficio o a solicitud del sujeto pasivo o tercero responsable por razones de interés público. La suspensión procederá una vez emitida una resolución particular en la que se anotará el motivo de la misma, las medidas alternativas que serán ejecutadas para viabilizar el cobro de la deuda tributaria, cuando corresponda y el tiempo que durará dicha suspensión. Si la suspensión se origina en una solicitud del sujeto pasivo o tercero responsable, este deberá presentar, con anterioridad a que se ejecute la suspensión, una solicitud en la que exponga las razones que justifican la misma. El pronunciamiento de la Administración, en caso de ser negativo, no admitirá recurso alguno".

                    <br>II. Contra la ejecución fiscal, sólo serán admisibles las siguientes causales de oposición.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Cualquier forma de extinción de la deuda tributaria prevista por este Código.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Resolución firme o sentencia con autoridad de cosa juzgada que declare la inexistencia de la deuda.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Dación en pago, conforme se disponga reglamentariamente.

                    Estas causales sólo serán válidas si se presentan antes de la conclusión de la fase de ejecución tributaria.

                    <h4>ARTÍCULO 110</h4> (MEDIDAS COACTIVAS). La Administración Tributaria podrá, entre otras, ejecutar las siguientes medidas coactivas:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Intervención de la gestión del negocio del deudor, correspondiente a la deuda.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Prohibición de celebrar el deudor actos o contratos de transferencia o disposición sobre determinados bienes.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Retención de pagos que deban realizar terceros privados, en la cuantía estrictamente necesaria para asegurar el cobro de la deuda tributaria.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. Prohibición de participar en los procesos de adquisición de bienes y contratación de servicios en el marco de lo dispuesto por la Ley Nº 1178 de Administración y Control Gubernamental.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;5. Otras medidas previstas por Ley, relacionadas directamente con la ejecución de deudas.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;6. Clausura del o los establecimientos, locales, oficinas o almacenes del deudor, hasta el pago total de la deuda tributaria. Esta medida sólo será ejecutada cuando la deuda tributaria no hubiera sido pagada por efecto de la aplicación de las medidas coactivas previstas en los numerales precedentes o por no ser posible su aplicación, y de acuerdo a lo establecido en el Parágrafo IV del Artículo 164.

                    <h5>Nota del Editor:</h5>
                    Ley N° 396 de 26/08/2013; Ley de Modificaciones al Presupuesto General del Estado (PGE 2013), mediante su Disposición Adicional Primera modificó el Numeral 6 precedente.

                    Los bienes embargados, con anotación definitiva en los registros públicos, secuestrados, aceptados en garantía mediante prenda o hipoteca, así como los recibidos en dación en pago por la Administración Tributaria, por deudas tributarias, serán dispuestos en ejecución tributaria mediante remate en subasta pública o adjudicación directa, en la forma y condiciones que se fijen mediante norma reglamentaria.

                    <h5>Nota del Editor:</h5>
                    Ley N° 396 de 26/08/2013; Ley de Modificaciones al Presupuesto General del Estado (PGE 2013), mediante su Disposición Adicional Segunda, incorporó el Segundo Párrafo precedente.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 36, señala lo siguiente:
                    "ARTÍCULO 36 (REMATE).
                    <br>I. Los bienes embargados, con anotación definitiva en los registros públicos, secuestrados, aceptados en garantía mediante prenda o hipoteca, así como los recibidos en dación en pago por la Administración Tributaria, serán dispuestos en ejecución tributaria mediante remate en subasta pública o adjudicación directa, en la forma y condiciones que se fije mediante norma administrativa.
                    <br>II. El remate de bienes se realizará por la Administración Tributaria en forma directa o a través de terceros autorizados para este fin.
                    <br>III. Los bienes aceptados en dación de pago, podrán ser adjudicados de forma directa a entidades del sector público, mediante resolución administrativa expresa de acuerdo a norma administrativa emitida por la Administración Tributaria.
                    <br>IV. En cualquier momento y hasta antes de la adjudicación, la Administración Tributaria liberará los bienes objeto de ejecución tributaria, siempre que el obligado pague la deuda tributaria y los gastos de ejecución ocasionados.
                    <br>V. Los servidores públicos de la Administración Tributaria que hubieran intervenido en la ejecución tributaria, por sí o mediante terceros, no podrán adquirir los bienes objeto de ejecución. Su infracción dará lugar a la nulidad de la adjudicación, sin perjuicio de las responsabilidades que se determinen.
                    <br>VI. Las Administraciones Tributarias están facultadas a emitir las normas administrativas que permitan la aplicación del presente Artículo".

                    <h5>Nota del Editor:</h5>
                    Decreto Supremo N° 1859 de 08/01/2014, mediante su Artículo Único modificó el Artículo precedente.

                    <h4>ARTÍCULO 111</h4> (DENUNCIA Y DISTRIBUCIÓN).

                    <br>I. En contravenciones y delitos flagrantes de contrabando de importación y exportación, las mercancías decomisadas aptas para su uso y consumo, serán entregadas con posterioridad al Acta de Intervención, a título gratuito, exentas del pago de tributos, sin pago por servicio de almacenaje y de otros gastos emergentes, de la siguiente forma:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Veinte por ciento (20%) para el denunciante individual, o cuarenta por ciento (40%) a la comunidad o pueblo denunciante.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. En caso de productos alimenticios, ochenta por ciento (80%) para la entidad pública encargada de su comercialización, que puede rebajar al sesenta por ciento (60%) en caso de que el denunciante sea la comunidad o pueblo.

                    <br>II. En caso de que las mercancías requieran certificados sanitarios, fitosanitarios, de inocuidad alimentaria u otras certificaciones para el despacho aduanero, la Administración Tributaria Aduanera previa a la entrega, solicitará la certificación oficial del órgano competente, la cual deberá ser emitida en un plazo no mayor a tres (3) días hábiles administrativos a partir de su requerimiento, sin costo, bajo responsabilidad del Ministerio cabeza de sector.

                    <br>III. Las mercancías que se encuentren prohibidas de importación conforme a normativa específica, aquellas que no sean susceptibles de división o partición, las que no puedan ser sujetas a certificación y las que necesiten una autorización previa emitida por autoridad competente para su despacho aduanero, serán dispuestas por la Aduana Nacional conforme a normativa en vigencia, no siendo susceptibles de entrega para el denunciante. 93

                    <br>IV. A efectos de dar cumplimiento al incentivo por la denuncia de contrabando de las mercancías señaladas en el Parágrafo III del presente Artículo, la Aduana Nacional entregará al denunciante de la comisión del ilícito, el monto de dinero en efectivo y en moneda nacional equivalente al diez por ciento (10 %) del valor de las mercancías definido en el informe de valoración efectuado por la administración aduanera.


                    <h5>Nota del Editor:</h5>
                    Ley N° 975 de 13/09/2017; Ley de Modificaciones al Presupuesto General del Estad Gestión 2017, en sus Disposiciones Adicionales Quinta, modificó el Artículo precedente, anteladamente modificado por la Ley N° 317 de 11/12/2012; Ley del Presupuesto General del Estado Gestión 2013.

                    <h4>ARTÍCULO 112</h4> (TERCERÍAS ADMISIBLES). En cualquier estado de la causa y hasta antes del remate, se podrán presentar tercerías de dominio excluyente y derecho preferente, siempre que en el primer caso, el derecho propietario esté inscrito en los registros correspondientes o en el segundo, esté justificado con la presentación del respectivo título inscrito en el registro correspondiente.

                    En el remate de mercancías abandonadas, decomisadas o retenidas como prenda por la Administración Tributaria Aduanera no procederán las tercerías de dominio excluyente, pago preferente o coadyuvante.

                    <h4>ARTÍCULO 113</h4> (PROCESOS CONCURSALES). Durante la etapa de ejecución tributaria no procederán los procesos concursales salvo en los casos de reestructuración voluntaria de empresas y concursos preventivos que se desarrollen conforme a Leyes especiales y el Código de Comercio, debiendo procederse, como cuando corresponda, al levantamiento de las medidas precautorias y coactivas que se hubieren adoptado a favor de la Administración Tributaria.

                    <h4>ARTÍCULO 114</h4> (QUIEBRA). El procedimiento de quiebra se sujetará a las disposiciones previstas en el Código de Comercio y leyes específicas.

                    <h4>SECCIÓN VIII: PROCEDIMIENTOS ESPECIALES</h4>

                    <h4>SUBSECCIÓN I: LA CONSULTA</h4>

                    <h4>ARTÍCULO 115</h4> (LEGITIMIDAD).

                    <br>I. Quien tuviera un interés personal y directo, podrá consultar sobre la aplicación y alcance de la
                    <br>II. La consulta se formulará por escrito y deberá cumplir los requisitos que reglamentariamente se establezcan.
                    <br>III. Cuando la consulta no cumpla con los requisitos descritos en el respectivo reglamento, la Administración Tributaria no la admitirá, devolviéndola al consultante para que en el término de diez (10) días la complete; caso contrario la considerará no presentada.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 14, Segundo Párrafo señala lo siguiente:
                    "ARTÍCULO 14 (CONSULTA).
                    (...)

                    La consulta deberá contener los siguientes requisitos mínimos:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Nombre o razón social del consultante.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Personería y representación.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Domicilio.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Descripción del hecho, acto u operación concreta y real.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Indicación de la disposición normativa sobre cuya aplicación o alcance se efectúa la consulta.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) Opinión fundada sobre la aplicación y alcance de la norma tributaria, confusa o controvertible.

                    Las Administraciones Tributarias, mediante resolución expresa, definirán otros requisitos, forma y procedimientos para la presentación, admisión y respuesta a las consultas".

                    <h4>ARTÍCULO 116</h4> (PRESENTACIÓN Y PLAZO DE RESPUESTA).

                    <br>I. La consulta será presentada a la máxima autoridad ejecutiva de la Administración Tributaria, debiendo responderla dentro del plazo de treinta (30) días prorrogables a treinta (30) días más computables desde la fecha de su admisión, mediante resolución motivada.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 14, Primer Párrafo señala lo siguiente:
                    "ARTÍCULO 14 (CONSULTA). La consulta se presentara ante la máxima autoridad ejecutiva de la Administración Tributaria. En el ámbito municipal se presentara ante la Dirección de Recaudaciones o la autoridad equivalente en cada jurisdicción municipal.
                    (...)".

                    El incumplimiento del plazo fijado, hará responsables a los funcionarios encargados de la absolución de consultas.

                    <br>II. La presentación de la Consulta no suspende el transcurso de plazos ni justifica el incumplimiento de las obligaciones a cargo de los consultantes.

                    <h4>ARTÍCULO 117</h4> (EFECTO VINCULANTE). La respuesta a la consulta tendrá efecto vinculante para la Administración Tributaria que la absolvió, únicamente sobre el caso concreto consultado, siempre y cuando no se hubieran alterado las circunstancias, antecedentes y demás datos que la motivaron.

                    Si la Administración Tributaria cambiara de criterio, el efecto vinculante cesará a partir de la notificación con la resolución que revoque la respuesta a la consulta.

                    <h4>ARTÍCULO 118</h4> (CONSULTAS INSTITUCIONALES). Las respuestas a consultas formuladas por colegios profesionales, cámaras oficiales, organizaciones patronales y empresariales, sindicales o de carácter gremial, cuando se refieran a aspectos tributarios que conciernan a la generalidad de sus miembros o asociados, no tienen ningún efecto vinculante para la Administración Tributaria, constituyendo criterios meramente orientadores o simplemente informativos sobre la aplicación de normas tributarias.

                    <h4>ARTÍCULO 119</h4> (IMPROCEDENCIA DE RECURSOS). Contra la respuesta a la consulta no procede recurso alguno, sin perjuicio de la impugnación que pueda interponer el consultante contra el acto administrativo que aplique el criterio que responde a la Consulta.

                    <h4>ARTÍCULO 120</h4> (NULIDAD DE LA CONSULTA). Será nula la respuesta a la Consulta cuando sea absuelta:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Sobre la base de datos, información y/o documentos falsos o inexactos proporcionados
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Por manifiesta infracción de la Ley.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Por autoridades que no gozan de jurisdicción y competencia.

                    <h4>SUBSECCIÓN II: ACCIÓN DE REPETICIÓN</h4>

                    <h4>ARTÍCULO 121</h4> (CONCEPTO). Acción de repetición es aquella que pueden utilizar los sujetos pasivos y/o directos interesados para reclamar a la Administración Tributaria la restitución de pagos indebidos o en exceso efectuados por cualquier concepto tributario.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 16, señala lo siguiente:

                    "ARTÍCULO 16 (REPETICIÓN).
                    <br>I. La acción de repetición dispuesta en los Artículos 121 y siguientes de la Ley N° 2492 comprende los tributos, intereses y multas pagados indebidamente o en exceso, quedando facultada, la Administración Tributaria, a detallar los casos por los cuales no corresponde su atención.
                    <br>II. La Administración Tributaria que hubiera recibido el pago indebido o en exceso es competente para resolver la acción de repetición en el término máximo de cuarenta y cinco (45) días computables a partir del día siguiente hábil de la presentación de la documentación requerida; en caso de ser procedente, la misma Administración Tributaria emitirá la nota de crédito fiscal por el monto autorizado en la resolución correspondiente".

                    <h4>ARTÍCULO 122</h4> (DEL PROCEDIMIENTO).

                    <br>I. El directo interesado que interponga la acción de repetición, deberá acompañar la documentación que la respalde; la Administración Tributaria verificará previamente si el solicitante tiene alguna deuda tributaria líquida y exigible, en cuyo caso procederá a la compensación de oficio, dando curso a la repetición sobre el saldo favorable al contribuyente, si lo hubiera. Cuando proceda la repetición, la Administración Tributaria se pronunciará, dentro de los cuarenta y cinco (45) días posteriores a la solicitud, mediante resolución administrativa expresa rechazando o aceptando total o parcialmente la repetición solicitada y autorizando la emisión del instrumento de pago correspondiente que la haga efectiva.
                    <br>II. En el cálculo del monto a repetir se aplicará la variación de la Unidad de Fomento de la Vivienda publicada por el Banco Central de Bolivia producida entre el día del pago indebido o en exceso hasta la fecha de autorización de la emisión del instrumento de pago correspondiente.
                    <br>III. Lo pagado para satisfacer una obligación prescrita no puede ser objeto de repetición, aunque el pago se hubiera efectuado en desconocimiento de la prescripción operada.
                    <br>IV. Cuando se niegue la acción, el sujeto pasivo tiene expedita la vía de impugnación prevista en el Título III de este Código.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 16, señala lo siguiente:
                    "ARTÍCULO 16 (REPETICIÓN).
                    <br>I. La acción de repetición dispuesta en los Artículos 121 y siguientes de la Ley N° 2492 comprende los tributos, intereses y multas pagados indebidamente o en exceso, quedando facultada, la Administración Tributaria, a detallar los casos por los cuales no corresponde su atención.
                    <br>II. La Administración Tributaria que hubiera recibido el pago indebido o en exceso es competente para resolver la acción de repetición en el término máximo de cuarenta y cinco (45) días computables a partir del día siguiente hábil de la presentación de la documentación requerida; en caso de ser procedente, la misma Administración Tributaria emitirá la nota de crédito fiscal por el monto autorizado en la resolución correspondiente".

                    <h4>ARTÍCULO 123</h4> (REPETICIÓN SOLICITADA POR SUSTITUTOS). Los agentes de retención o percepción podrán solicitar la repetición de los tributos retenidos o percibidos indebidamente o en exceso y empozados al Fisco, siempre que hubiera Poder Notariado expreso del contribuyente.


                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 16, señala lo siguiente:
                    "ARTÍCULO 16 (REPETICIÓN).
                    <br>I. La acción de repetición dispuesta en los Artículos 121 y siguientes de la Ley N° 2492 comprende los tributos, intereses y multas pagados indebidamente o en exceso, quedando facultada, la Administración Tributaria, a detallar los casos por los cuales no corresponde su atención.
                    <br>II. La Administración Tributaria que hubiera recibido el pago indebido o en exceso es competente para resolver la acción de repetición en el término máximo de cuarenta y cinco (45) días computables a partir del día siguiente hábil de la presentación de la documentación requerida; en caso de ser procedente, la misma Administración Tributaria emitirá la nota de crédito fiscal por el monto autorizado en la resolución correspondiente".

                    <h4>ARTÍCULO 124</h4> (PRESCRIPCIÓN DE LA ACCIÓN DE REPETICIÓN).

                    <br>I. Prescribirá a los tres (3) años la acción de repetición para solicitar lo pagado indebidamente o en exceso.

                    <br>II. El término se computará a partir del momento en que se realizó el pago indebido o en exceso.

                    <br>III. En estos casos, el curso de la prescripción se suspende por las mismas causales, formas y plazos dispuestos por este Código.


                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 16, señala lo siguiente:
                    "ARTÍCULO 16 (REPETICIÓN).
                    <br>I. La acción de repetición dispuesta en los Artículos 121 y siguientes de la Ley N° 2492 comprende los tributos, intereses y multas pagados indebidamente o en exceso, quedando facultada, la Administración Tributaria, a detallar los casos por los cuales no corresponde su atención.
                    <br>II. La Administración Tributaria que hubiera recibido el pago indebido o en exceso es competente para resolver la acción de repetición en el término máximo de cuarenta y cinco (45) días computables a partir del día siguiente hábil de la presentación de la documentación requerida; en caso de ser procedente, la misma Administración Tributaria emitirá la nota de crédito fiscal por el monto autorizado en la resolución correspondiente".


                    <h4>SUBSECCIÓN III: DEVOLUCIÓN TRIBUTARIA</h4>

                    <h4>ARTÍCULO 125</h4> (CONCEPTO). La devolución es el acto en virtud del cual el Estado por mandato de la Ley, restituye en forma parcial o total impuestos efectivamente pagados a determinados sujetos pasivos o terceros responsables que cumplan las condiciones establecidas en la Ley que dispone la devolución, la cual establecerá su forma, requisitos y plazos.

                    <h4>ARTÍCULO 126</h4> (PROCEDIMIENTO).

                    <br>I. Las normas dictadas por el Poder Ejecutivo regularán las modalidades de devolución tributaria, estableciendo cuando sea necesario parámetros, coeficientes, indicadores u otros, cuyo objetivo será identificar la cuantía de los impuestos a devolver y el procedimiento aplicable, así como el tipo de garantías que respalden las devoluciones.

                    <br>II. La Administración Tributaria competente deberá revisar y evaluar los documentos pertinentes que sustentan la solicitud de devolución tributaria. Dicha revisión no es excluyente de las facultades que asisten a la Administración Tributaria para controlar, verificar, fiscalizar e investigar el comportamiento tributario del sujeto pasivo o tercero responsable, según las previsiones y plazos establecidos en el presente Código.

                    <br>III. La Administración Tributaria competente deberá previamente verificar si el solicitante tiene alguna deuda tributaria, en cuyo caso procederá a la compensación de oficio. De existir un saldo, la Administración Tributaria se pronunciará mediante resolución expresa devolviendo el saldo si éste fuera a favor del beneficiario.

                    <h4>ARTÍCULO 127</h4> (EJECUCIÓN DE GARANTÍA). Si la modalidad de devolución se hubiera sujetado a la presentación de una garantía por parte del solicitante, la misma podrá ser ejecutada sin mayor trámite a solo requerimiento de la Administración Tributaria, en la proporción de lo indebidamente devuelto, cuando ésta hubiera identificado el incumplimiento de las condiciones que justificaron la devolución, sin perjuicio de la impugnación que pudiera presentarse.


                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27874 de 26/11/2004, Reglamenta Algunos Aspectos del Código Tributario Boliviano, en su Artículo 6, señala lo siguiente:
                    "ARTÍCULO 6 (EJECUCIÓN DE LA GARANTÍA POR MONTOS INDEBIDAMENTE DEVUELTOS). En aplicación de lo dispuesto en el Artículo 127 de la Ley N° 2492, la Administración Tributaria ejecutará la garantía presentada como respaldo a la devolución, sin perjuicio de la impugnación de la Resolución Administrativa que consigna el monto indebidamente devuelto expresado en Unidades de Fomento a la Vivienda, así como, los intereses respectivos.

                    La ejecución de la garantía presentada, sólo podrá suspenderse si el solicitante presenta una nueva garantía conforme a lo establecido en las disposiciones operativas dictadas por la Administración Tributaria, que deberá mantenerse vigente mientras dure el proceso de impugnación".

                    <h4>SUBSECCIÓN IV: RESTITUCIÓN</h4>

                    <h4>ARTÍCULO 128</h4> (RESTITUCIÓN DE LO INDEBIDAMENTE DEVUELTO). Cuando la Administración Tributaria hubiera comprobado que la devolución autorizada fue indebida o se originó en documentos falsos o que reflejen hechos inexistentes, emitirá una Resolución Administrativa consignando el monto indebidamente devuelto expresado en Unidades de Fomento de la Vivienda, cuyo cálculo se realizará desde el día en que se produjo la devolución indebida, para que en el término de veinte (20) días, computables a partir de su notificación, el sujeto pasivo o tercero responsable pague o interponga los recursos establecidos en el presente Código, sin perjuicio que la Administración Tributaria ejercite las actuaciones necesarias para el procesamiento por el ilícito correspondiente.

                    <h4>SUBSECCIÓN V: CERTIFICACIONES</h4>

                    <h4>ARTÍCULO 129</h4> (TRÁMITE). Cuando el sujeto pasivo o tercero responsable deba acreditar el cumplimiento de sus obligaciones formales tributarias, podrá solicitar un certificado a la Administración Tributaria, cuya autoridad competente deberá expedirlo en un plazo no mayor a quince (15) días, bajo responsabilidad funcionaria y conforme a lo que reglamentariamente se establezca.

                    <h3>Título III

                        IMPUGNACIÓN DE LOS ACTOS DE LA ADMINISTRACIÓN</h3>

                    <h3>CAPÍTULO I
                        IMPUGNACIÓN DE NORMAS</h3>

                    <h4>ARTÍCULO 130</h4> (IMPUGNACIÓN DE NORMAS ADMINISTRATIVAS).

                    <br>I. Las normas administrativas que con alcance general dicte la Administración Tributaria en uso de las facultades que le reconoce este Código, respecto de tributos que se hallen a su cargo, podrán ser impugnadas en única instancia por asociaciones o entidades representativas o por personas naturales o jurídicas que carezcan de una entidad representativa, dentro de los veinte (20) días de publicadas, aplicando el procedimiento que se establece en el presente Capítulo.

                    <br>II. Dicha impugnación deberá presentarse debidamente fundamentada ante el Ministro de Hacienda. En el caso de los Gobiernos Municipales, la presentación será ante la máxima autoridad ejecutiva.

                    <br>III. La impugnación presentada no tendrá efectos suspensivos.

                    <br>IV. La autoridad que conozca de la impugnación deberá pronunciarse dentro de los cuarenta (40) días computables a partir de la presentación, bajo responsabilidad. La falta de pronunciamiento dentro del término, equivale a silencio administrativo negativo.

                    <br>V. El rechazo o negación del recurso agota el procedimiento en sede administrativa.

                    <br>VI. La Resolución que declare probada la impugnación, surtirá efectos para todos los sujetos pasivos y terceros responsables alcanzados por dichas normas, desde la fecha de su notificación o publicación.

                    <br>VII. Sin perjuicio de lo anterior, la Administración Tributaria podrá dictar normas generales que modifiquen o dejen sin efecto la Resolución impugnada.


                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 3, Parágrafo V, señala lo siguiente:
                    "ARTÍCULO 3 (SUJETO ACTIVO).
                    (...)
                    <br>V. Las normas administrativas que con alcance general dicte la Aduana Nacional,

                    <h3>CAPÍTULO II
                        RECURSOS ADMINISTRATIVOS</h3>

                    <h4>ARTÍCULO 131</h4> (RECURSOS ADMISIBLES). Contra los actos de la Administración Tributaria de alcance particular podrá interponerse Recurso de Alzada en los casos, forma y plazo que se establece en el presente Título. Contra la resolución que resuelve el Recurso de Alzada solamente cabe el Recurso Jerárquico, que se tramitará conforme al procedimiento que establece este Código. Ambos recursos se interpondrán ante las autoridades competentes de la Superintendencia Tributaria que se crea por mandato de esta norma legal.

                    La interposición del Recurso de Alzada así como el del Jerárquico tienen efecto suspensivo.

                    La vía administrativa se agotará con la resolución que resuelva el Recurso Jerárquico, pudiendo acudir el contribuyente y/o tercero responsable a la impugnación judicial por la vía del proceso contencioso administrativo ante la Sala competente de la Corte Suprema de Justicia.

                    La interposición del proceso contencioso administrativo, no inhibe la ejecución de la resolución dictada en el Recurso Jerárquico, salvo solicitud expresa de suspensión formulada a la Administración Tributaria por el contribuyente y/o responsable, presentada dentro del plazo perentorio de cinco (5) días siguientes a la notificación con la resolución que resuelve dicho recurso. La solicitud deberá contener además, el ofrecimiento de garantías suficientes y el compromiso de constituirlas dentro de los noventa (90) días siguientes.

                    Si el proceso fuera rechazado o si dentro de los noventa (90) días señalados, no se constituyeren las garantías ofrecidas, la Administración Tributaria procederá a la ejecución tributaria de la deuda impaga.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i) Sentencia Constitucional 0009/2004, de 28 de enero de 2004: En el Recurso Directo o Abstracto de Inconstitucionalidad, en el cual se demanda la Inconstitucionalidad de los Artículos 139 en sus Incisos b) y c), 140 Incisos a) y b), 143, 144, 145, 146 y 147 de la Ley N° 2492 (Código Tributario Boliviano CTB), por infringir los Artículos 16 Parágrafos I) y IV), 116 Parágrafos II) y III) y 118 de la Constitución Política del Estado (CPE).

                    El Tribunal Constitucional declara: 1° La INCONSTITUCIONALIDAD, 1) Por omisión normativa del Artículo 131, 2) Por contradicción de los Artículos 131 Tercer Párrafo, 139 Inciso c), 141, 145, 146 y 147 del Código Tributario Boliviano (CTB). Con los efectos previstos por el Artículo 58, Parágrafo III de la Ley del Tribunal Constitucional, y

                    2° La CONSTITUCIONALIDAD de los Artículos 139 Inciso b), 140 Incisos a) y b), 143 y 144 del Código Tributario Boliviano (CTB).
                    ii) Sentencia Constitucional 0090/2006, de 17 de noviembre de 2006: En el recurso Indirecto o Incidental de Inconstitucionalidad, demandando la Inconstitucionalidad del Primer Párrafo del Artículo 2 de la Ley N° 3092, de 07/07/2005, por vulnerar los Artículos 6, 7 Incisos a) y h), 14, 16, 32, 116 Parágrafos I y III, 117 Parágrafo I, 118 Parágrafo I, 228 y 229 de la Constitución Política del Estado (CPE).

                    El Tribunal Constitucional declara: 1. INCONSTITUCIONAL la frase contenida en el Primer Párrafo del Artículo 2 de la Ley N° 3092, de 07/07/2005: "el sujeto pasivo y/o tercero responsable".

                    2 Queda el primer párrafo del Artículo 2 de la Ley N° 3092, de la siguiente manera: "Se establece que la resolución administrativa dictada por el Superintendente Tributario General para resolver el Recurso Jerárquico agota la vía administrativa, pudiendo acudirse a la impugnación judicial por la vía del proceso contencioso administrativo según lo establecido en la Constitución Política del Estado".

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. EXHORTA al Poder Legislativo, que con carácter de urgencia sancione la Ley que establezca los casos y presupuestos en los que la Administración Tributaria tenga legitimación activa para interponer el proceso contencioso administrativo.

                    <h3>CAPÍTULO III
                        SUPERINTENDENCIA TRIBUTARIA</h3>

                    <h4>ARTÍCULO 132</h4> (CREACIÓN, OBJETO, COMPETENCIAS Y NATURALEZA). Crease la Superintendencia Tributaria como parte del Poder Ejecutivo, bajo la tuición del Ministerio de Hacienda como órgano autárquico de derecho público, con autonomía de gestión administrativa, funcional, técnica y financiera, con jurisdicción y competencia en todo el territorio nacional.

                    La Superintendencia Tributaria tiene como objeto, conocer y resolver los recursos de alzada y jerárquico que se interpongan contra los actos definitivos de la Administración Tributaria.

                    <h4>ARTÍCULO 133</h4> (RECURSOS FINANCIEROS). Las actividades de la Superintendencia
                    Tributaria se financiarán con:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Hasta uno (1) por ciento del total de las recaudaciones tributarias de dominio nacional percibidas en efectivo, que se debitará automáticamente, según se disponga mediante Resolución Suprema.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Otros ingresos que pudiera gestionar de fuentes nacionales o internacionales.

                    <h4>ARTÍCULO 134</h4> (COMPOSICIÓN DE LA SUPERINTENDENCIA TRIBUTARIA). La Superintendencia Tributaria está compuesta por un Superintendente Tributario General con sede en la ciudad de La Paz y cuatro (4) Superintendentes Tributarios Regionales con sede en las capitales de los Departamentos de Chuquisaca, La Paz, Santa Cruz y Cochabamba.

                    También formarán parte de la Superintendencia Tributaria, los intendentes que, previa aprobación del Superintendente Tributario General, serán designados por el Superintendente Regional en las capitales de departamento donde no existan Superintendencias Regionales, los mismos que ejercerán funciones técnicas y administrativas que garanticen el uso inmediato de los recursos previstos por este Código, sin tener facultad para resolverlos.

                    La estructura administrativa y competencia territorial de las Superintendencias Tributarias Regionales se establecerán por reglamento.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en sus Artículos 2 y 3 Parágrafos I, II y III señalan lo siguiente:
                    "ARTÍCULO 2 (COMPOSICIÓN). La Superintendencia Tributaria está compuesta por un Superintendente Tributario General con sede en la ciudad de La Paz, cuatro (4) Superintendentes Tributarios Regionales con sede en las capitales de los Departamentos de Chuquisaca, La Paz, Santa Cruz y Cochabamba, respectivamente, y cinco (5) intendentes Departamentales, cada uno de ellos con asiento en las capitales de los Departamentos de Pando, Beni, Oruro, Tarija y Potosí".
                    "ARTÍCULO 3 (COMPETENCIA TERRITORIAL Y ESTRUCTURA).
                    <br>I. Cada intendente Departamental tiene competencia sobre el Departamento en cuya capital tiene sede; está a su cargo dirigir la intendencia Departamental de la que es titular, con las atribuciones y funciones que le otorgan la Ley y el presente Decreto Supremo.
                    <br>II. Cada Superintendente Tributario Regional tiene competencia sobre el Departamento en cuya capital tiene sede y sobre el o los Departamentos constituidos en intendencia Departamental con las atribuciones y funciones que le otorgan la Ley y el presente Decreto Supremo, conforme a lo siguiente:
                    • Superintendente Tributario Regional de Chuquisaca: IntendenciaDepartamental de Potosí.
                    • Superintendente Tributario Regional de La Paz: Intendencia Departamental de Oruro.
                    • Superintendente Tributario Regional de Santa Cruz: Intendencias Departamentales de Pando y Beni.
                    • Superintendente Tributario Regional de Cochabamba: Intendencia Departamental de Tarija.
                    <br>III. El Superintendente Tributario General tiene competencia en todo el territorio de la República; está a su cargo dirigir y representar la Superintendencia Tributaria General, con las atribuciones y funciones que le otorgan la Ley y el presente Decreto Supremo.
                    (...)".

                    <h4>ARTÍCULO 135</h4> (DESIGNACIÓN DE LOS SUPERINTENDENTES TRIBUTARIOS). El Superintendente Tributario General y los Superintendentes Tributarios Regionales serán designados por el Presidente de la República de terna propuesta por dos tercios (2/3) de votos de los miembros presentes de la Honorable Cámara de Senadores, de acuerdo a los mecanismos establecidos por la señalada Cámara.

                    En caso de renuncia, fallecimiento o término del mandato del Superintendente General Tributario, se designará al interino mediante Resolución Suprema, conforme el inciso 16) del Artículo 96º de la Constitución Política del Estado, quién ejercerá funciones en tanto se designe al titular.

                    <h4>ARTÍCULO 136</h4> (REQUISITOS PARA SER DESIGNADO SUPERINTENDENTE TRIBUTARIO). Para ser designado Superintendente Tributario General o Regional se requiere cumplir los siguientes requisitos:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Ser de nacionalidad boliviana.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Tener reconocida idoneidad en materia tributaria.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Tener como mínimo título universitario a nivel de licenciatura y diez (10) años de experiencia profesional. A estos efectos se tomará en cuenta el ejercicio de la cátedra, la investigación científica, títulos y grados académicos, cargos y funciones que denoten amplio conocimiento de la materia.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. No haber sido sancionado con pena privativa de libertad o destituido por procesos judiciales o administrativos con resolución ejecutoriada. Si dicha sanción fuese impuesta durante el ejercicio de sus funciones como Superintendente Tributario, por hechos ocurridos antes de su nombramiento, tal situación dará lugar a su inmediata remoción del cargo.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;5. No tener Pliego de Cargo ni Nota de Cargo ejecutoriado pendiente de pago en su contra.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;6. No tener relación de parentesco de consanguinidad hasta el cuarto grado, en línea directa o colateral, o de afinidad hasta el segundo grado inclusive, con el Presidente o Vicepresidente de la República, las máximas autoridades de la Administración Tributaria, o entre Superintendentes Tributarios.

                    <h4>ARTÍCULO 137</h4> (INCOMPATIBILIDADES). Las funciones de los Superintendentes Tributarios, tanto General como Regionales, son incompatibles con el ejercicio de todo otro cargo público remunerado, con excepción de las funciones docentes universitarias y de las comisiones codificadoras. Son igualmente incompatibles con las funciones directivas de instituciones privadas, mercantiles, políticas y sindicales. La aceptación de cualquiera de estas funciones implica renuncia tácita a la función como Superintendente Tributario, quedando nulos sus actos a partir de dicha aceptación.

                    <h4>ARTÍCULO 138</h4> (PERÍODO DE FUNCIONES Y DESTITUCIÓN DE SUPERINTENDENTES TRIBUTARIOS). El Superintendente Tributario General desempeñará sus funciones por un período de siete (7) años y los Superintendentes Tributarios Regionales por un período de cinco (5) años, no pudiendo ser reelegidos sino pasado un tiempo igual al que hubiese ejercido su mandato.

                    Los Superintendentes Tributarios gozan de caso de corte conforme al numeral 6) del Artículo 118 de la Constitución Política del Estado y serán destituidos de sus cargos únicamente con sentencia condenatoria ejecutoriada por delitos cometidos contra la función pública.

                    <h4>ARTÍCULO 139</h4> (ATRIBUCIONES Y FUNCIONES DEL SUPERINTENDENTE TRIBUTARIO GENERAL). El Superintendente Tributario General tiene las siguientes atribuciones y funciones:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Dirigir y representar a la Superintendencia Tributaria General;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Conocer y resolver, de manera fundamentada, los Recursos Jerárquicos contra las Resoluciones de los Superintendentes Tributarios Regionales, de acuerdo a reglamentación específica;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Conocer y resolver la Revisión Extraordinaria conforme a lo establecido en este Código;

                    Sentencia Constitucional 0009/2004, de 28 de enero de 2004: En el Recurso Directo o Abstracto de Inconstitucionalidad, en el cual se demanda la Inconstitucionalidad de los Artículos 139 en sus Incisos b) y c), 140 Incisos a) y b), 143, 144, 145, 146 y 147 de la Ley N° 2492 (Código Tributario Boliviano CTB), por infringir los Artículos 16 Parágrafos I) y IV), 116 Parágrafos II) y III) y 118 de la Constitución Política del Estado (CPE).

                    El Tribunal Constitucional declara: 1° La INCONSTITUCIONALIDAD, 1) Por omisión normativa del Artículo 131, 2) Por contradicción de los Artículos 131 Tercer Párrafo, 139 Inciso c), 141, 145, 146 y 147 del Código Tributario Boliviano (CTB). Con los efectos previstos por el Artículo 58, Parágrafo III de la Ley del Tribunal Constitucional, y

                    2° La CONSTITUCIONALIDAD de los Artículos 139 Inciso b), 140 Incisos a) y b), 143 y 144 del Código Tributario Boliviano (CTB).

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Dirimir y resolver los conflictos de competencias que se susciten entre los SuperintendentesTributarios Regionales;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Formular las políticas de desarrollo y controlar el cumplimiento de los objetivos, planes y programas administrativos de la Superintendencia General y las Regionales;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) Considerar y aprobar los proyectos de normas internas de la Superintendencia General y de las Superintendencias Regionales, así como dirigir y evaluar la gestión administrativa del órgano;


                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 3 Parágrafo V, señala lo siguiente:
                    "ARTÍCULO 3 (COMPETENCIA TERRITORIAL Y ESTRUCTURA).
                    (...)
                    <br>V. Los procedimientos internos para el trámite de los recursos en la Superintendencia Tributaria serán aprobados por el Superintendente Tributario General, en aplicación de las atribuciones que le confiere el inciso f) del Artículo 139 del Código Tributario Boliviano".

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;g) Suscribir contratos y convenios en nombre y representación de la Superintendencia Tributaria General para el desarrollo de sus actividades administrativas y técnicas;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;h) Designar al personal técnico y administrativo de la Superintendencia Tributaria General y destituirlo conforme a las normas aplicables;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i) Aprobar y aplicar las políticas salariales y de recursos humanos de la Superintendencia Tributaria General y Regionales, en base a lo propuesto por las mismas, así como la estructura general administrativa del órgano;

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 3, Parágrafo IV señala lo siguiente:“ARTÍCULO 3 (COMPETENCIA TERRITORIAL Y ESTRUCTURA).
                    (…)
                    <br>IV. La estructura orgánica y funcional de la Superintendencia Tributaria General y las que corresponden a las Superintendencias Tributarias Regionales, serán aprobadas mediante Resolución Administrativa del Superintendente Tributario General, en aplicación de las atribuciones que le confiere el inciso i) del Artículo 139 del Código Tributario Boliviano.
                    (…)”.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;j) Aprobar el presupuesto institucional de la Superintendencia Tributaria, a cuyo efecto considerará las propuestas presentadas por las Superintendencias Regionales, para su presentación al Ministerio de Hacienda y su incorporación al Presupuesto General de la Nación;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;k) Administrar los recursos económicos y financieros de la Superintendencia Tributaria en el marco de las normas del Sistema Nacional de Administración Financiera y Control Gubernamental;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;l) Mantener el Registro Público de la Superintendencia Tributaria, en el que se archivarán copias de las resoluciones que hubiera dictado resolviendo los Recursos Jerárquicos, así como copias de las resoluciones que los Superintendentes Tributarios Regionales dictaran para resolver los Recursos de Alzada;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;m) Proponer al Poder Ejecutivo normas relacionadas con la Superintendencia Tributaria y cumplir las que éste dicte sobre la materia;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;n) Adoptar las medidas administrativas y disciplinarias necesarias para que los Superintendentes Regionales cumplan sus funciones de acuerdo con la Ley, libres de influencias indebidas de cualquier origen;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;o) Fiscalizar y emitir opinión sobre la eficiencia y eficacia de la gestión de las Superintendencias Regionales;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;p) Adoptar medidas precautorias conforme lo dispuesto por este Código, previa solicitud de la Administración Tributaria;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;q) Realizar los actos que sean necesarios para el cumplimiento de sus funciones.

                    <h4>ARTÍCULO 140</h4> (ATRIBUCIONES Y FUNCIONES DE LOS SUPERINTENDENTES TRIBUTARIOS REGIONALES). Los Superintendentes Tributarios Regionales tienen las siguientes atribuciones y funciones:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Conocer y resolver, de manera fundamentada, los Recursos de Alzada contra los actos de la Administración Tributaria, de acuerdo al presente Código;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Admitir o rechazar los Recursos Jerárquicos contra las resoluciones que resuelvan los Recursos de Alzada y remitir a conocimiento del Superintendente Tributario General;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Remitir al Registro Público de la Superintendencia Tributaria General copias de las Resoluciones que hubieran dictado resolviendo los Recursos de Alzada;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Designar intendentes en las capitales de departamento en las que no hubiere Superintendencias Regionales, de acuerdo a sus necesidades y como parte de la estructura general;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) Resolver los asuntos que sean puestos en su conocimiento por los intendentes;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;g) Suscribir contratos y convenios en nombre y representación de la Superintendencia Regional para el desarrollo de sus actividades administrativas y técnicas;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;h) Autorizar y/o adoptar medidas precautorias, previa solicitud formulada por la Administración Tributaria, conforme lo dispuesto por este Código;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i) Realizar los actos que sean necesarios para el cumplimiento de sus responsabilidades;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;j) Ejercer simultáneamente suplencia de otro Superintendente Tributario Regional, cuando este hubiere muerto, renunciado, se hallare impedido o su mandato hubiera concluido. Dicha suplencia durará hasta la designación del sustituto.

                    <h4>ARTÍCULO 141</h4> (ORGANIZACIÓN). La organización, estructura y procedimientos administrativos internos aplicables por la Superintendencia General, serán aprobados mediante Resolución Suprema. En el caso de las Superintendencias Regionales, esta aprobación se realizará mediante Resolución Administrativa emitida por la Superintendencia General.

                    Sentencia Constitucional 0009/2004, de 28 de enero de 2004: En el Recurso Directo o Abstracto de Inconstitucionalidad, en el cual se demanda la Inconstitucionalidad de los Artículos 139 en sus Incisos b) y c), 140 Incisos a) y b), 143, 144, 145, 146 y 147 de la Ley N° 2492 (Código Tributario Boliviano CTB), por infringir los Artículos 16º Parágrafos I) y IV), 116 Parágrafos II) y III) y 118 de la Constitución Política del Estado (CPE).
                    El Tribunal Constitucional declara: 1° La INCONSTITUCIONALIDAD, 1) Por omisión normativa del Artículo 131, 2) Por contradicción de los Artículos 131 Tercer Párrafo, 139 Inciso c), 141, 145, 146 y 147 del Código Tributario Boliviano (CTB). Con los efectos previstos por el Artículo 58, Parágrafo III de la Ley del Tribunal Constitucional, y

                    2° La CONSTITUCIONALIDAD de los Artículos 139 Inciso b), 140 Incisos a) y b), 143 y 144 del Código Tributario Boliviano (CTB).

                    <h4>ARTÍCULO 142</h4> (NORMAS APLICABLES). Los recursos administrativos se sustanciarán y resolverán con arreglo al procedimiento establecido en este Título y en la reglamentación que al efecto se dicte.

                    <h3>CAPÍTULO IV
                        RECURSOS ANTE LAS SUPERINTENDENCIAS TRIBUTARIAS</h3>

                    <h4>ARTÍCULO 143</h4> (RECURSO DE ALZADA). El Recurso de Alzada será admisible sólo contra los siguientes actos definitivos:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Las resoluciones determinativas.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Las resoluciones sancionatorias.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Las resoluciones que denieguen solicitudes de exención, compensación, repetición o devolución de impuestos.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. Las resoluciones que exijan restitución de lo indebidamente devuelto en los casos de devoluciones impositivas.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;5. Los actos que declaren la responsabilidad de terceras personas en el pago de obligaciones tributarias en defecto o en lugar del sujeto pasivo.

                    Este Recurso deberá interponerse dentro del plazo perentorio de veinte (20) días improrrogables, computables a partir de la notificación con el acto a ser impugnado.

                    <h5>Nota del Editor:</h5>
                    Ley N° 3092 de 07/07/2005, mediante su Artículo 4 aclara que:
                    "Artículo 4 Además de lo dispuesto por el Artículo 143 de Código Tributario Boliviano, el Recurso de Alzada ante la Superintendencia Tributaria será admisible también contra:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Acto administrativo que rechaza la solicitud de presentación de Declaraciones Juradas Rectificatorias.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Acto administrativo que rechaza la solicitud de planes de facilidades de pago.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Acto administrativo que rechaza la extinción de la obligación tributaria por prescripción, pago o condonación.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. Todo otro acto administrativo definitivo de carácter particular emitido por la Administración Tributaria".

                    <h4>ARTÍCULO 144</h4> (RECURSO JERÁRQUICO). Quién considere que la resolución que resuelve el Recurso de Alzada lesione sus derechos, podrá interponer de manera fundamentada, Recurso Jerárquico ante el Superintendente Tributario Regional que resolvió el Recurso de Alzada, dentro del plazo de veinte (20) días improrrogables, computables a partir de la notificación con la respectiva Resolución. El Recurso Jerárquico será sustanciado por el Superintendente Tributario General conforme dispone el Artículo 139 inciso b) de este Código.

                    <h4>ARTÍCULO 145</h4> (REVISIÓN EXTRAORDINARIA).

                    <br>I. Únicamente por medio de su máxima autoridad ejecutiva, la Administración Tributaria y las Superintendencias podrán revisar, de oficio o a instancia de parte, dentro del plazo de dos (2) años, sus actos administrativos firmes, en los siguientes supuestos:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Cuando exista error de identidad en las personas.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Cuando después de dictado el acto se recobren o descubran documentos decisivos detenidos por fuerza mayor o por obra de la parte a favor de la cual se hubiera dictado el acto, previa sentencia declarativa de estos hechos y ejecutoriada.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Cuando dichos actos tengan como base documentos declarados falsos por sentencia judicial ejecutoriada o bien cuando su falsedad se desconocía al momento de su dictado.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. Cuando dichos actos se hubieran dictado como consecuencia de prevaricato, cohecho, violencia u otra acción delictiva y se haya declarado así en sentencia judicial ejecutoriada.

                    <br>II. La resolución que se emita declarará la nulidad del acto revisado o su anulabilidad total o parcial.

                    <br>III. La declaratoria de nulidad o anulabilidad total o parcial del acto o resolución, cuando corresponda, deberá emitirse en un plazo máximo de sesenta (60) días a contar desde la presentación de la solicitud del interesado cuando sea a instancia de parte, en mérito a pruebas que la acrediten.

                    <br>IV. Ante la declaración de nulidad o anulabilidad total o parcial del acto o resolución, la Administración Tributaria o el Superintendente deberá emitir, según corresponda, un nuevo acto o resolución que corrija al anterior, procediendo contra este nuevo, los Recursos Administrativos previstos en este Título.

                    Sentencia Constitucional 0009/2004, de 28 de enero de 2004: En el Recurso Directo o Abstracto de Inconstitucionalidad, en el cual se demanda la Inconstitucionalidad de los Artículos 139 en sus Incisos b) y c), 140 Incisos a) y b), 143, 144, 145, 146 y 147 de la Ley N° 2492 (Código Tributario Boliviano CTB), por infringir los Artículos 16 Parágrafos I) y IV), 116 Parágrafos II) y III) y 118 de la Constitución Política del Estado (CPE).

                    El Tribunal Constitucional declara: 1° La INCONSTITUCIONALIDAD, 1) Por omisión
                    115
                    normativa del Artículo 131, 2) Por contradicción de los Artículos 131 Tercer Párrafo, 139 Inciso

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c), 141, 145, 146 y 147 del Código Tributario Boliviano (CTB). Con los efectos previstos por el Artículo 58, Parágrafo III de la Ley del Tribunal Constitucional, y
                    2° La CONSTITUCIONALIDAD de los Artículos 139 Inciso b), 140 Incisos a) y b), 143 y 144 del Código Tributario Boliviano (CTB).

                    <h4>ARTÍCULO 146</h4> (REGLAMENTACIÓN). Los procedimientos de los Recursos de Alzada y Jerárquico se sujetarán a los plazos, términos, condiciones, requisitos y forma dispuestos por Decreto Supremo Reglamentario.

                    Sentencia Constitucional 0009/2004, de 28 de enero de 2004: En el Recurso Directo o Abstracto de Inconstitucionalidad, en el cual se demanda la Inconstitucionalidad de los Artículos 139 en sus Incisos b) y c), 140 Incisos a) y b), 143, 144, 145, 146 y 147 de la Ley N° 2492 (Código Tributario Boliviano CTB), por infringir los Artículos 16 Parágrafos I) y IV), 116 Parágrafos II) y III) y 118 de la Constitución Política del Estado (CPE).
                    El Tribunal Constitucional declara: 1° La INCONSTITUCIONALIDAD, 1) Por omisión normativa del Artículo 131, 2) Por contradicción de los Artículos 131 Tercer Párrafo, 139 Inciso c), 141, 145, 146 y 147 del Código Tributario Boliviano (CTB). Con los efectos previstos por el Artículo 58, Parágrafo III de la Ley del Tribunal Constitucional, y
                    2° La CONSTITUCIONALIDAD de los Artículos 139 Inciso b), 140 Incisos a) y b), 143 y 144 del Código Tributario Boliviano (CTB).


                    <h4>ARTÍCULO 147</h4> (PROCESO CONTENCIOSO ADMINISTRATIVO). Conforme a la atribución Séptima del parágrafo I del Artículo 118 de la Constitución Política del Estado, el proceso contencioso administrativo contra la resolución que resuelva el Recurso Jerárquico será conocido por la Corte Suprema de Justicia sujetándose al trámite contenido en el Código de Procedimiento Civil y se resolverá por las siguientes causales:


                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1.
                    Cuando la autoridad que emitió la resolución que resuelve el Recurso Jerárquico carezca de competencia en razón de la materia o del territorio.


                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2.
                    Cuando en el trámite administrativo se hubiere omitido alguna formalidad esencial dispuesta por Ley.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3.
                    Cuando la Resolución impugnada contenga violación, interpretación errónea o aplicación indebida de la Ley.
                    116
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4.
                    Cuando la Resolución contuviere disposiciones contradictorias.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;5. Cuando en la apreciación de pruebas se hubiere incurrido en error de derecho o en error de hecho, debiendo en este último caso evidenciarse el error por documentos oactos auténticos que demostraren la equivocación manifiesta del Superintendente Tributario General.

                    Si el fallo judicial que resuelve el Proceso Contencioso Administrativo fuera favorable al demandante, la Administración Tributaria en ejecución de sentencia, reembolsará, dentro los veinte (20) días siguientes al de su notificación, previa cuantificación del importe, el monto total pagado o el costo de la garantía aportada para suspender la ejecución de la deuda tributaria. Cuando la deuda tributaria sea declarada parcialmente improcedente, el reembolso alcanzará a la parte proporcional del pago realizado o del costo de la referida garantía.

                    Las cantidades reembolsadas serán actualizadas conforme al Artículo 47 de éste Código, aplicando la tasa de interés activa promedio para Unidades de Fomento de la Vivienda, desde la fecha en que se realizó el pago o se incurrió en el costo de la garantía, hasta la fecha en que se notificó a la Administración Tributaria con el fallo judicial firme. En caso de incumplirse el plazo para efectuar el reembolso, la tasa de interés se aplicará hasta el día en que efectivamente se realice el mismo.


                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i) Sentencia Constitucional 0009/2004, de 28 de enero de 2004: En el Recurso Directo o Abstracto de Inconstitucionalidad, en el cual se demanda la Inconstitucionalidad de los Artículos 139 en sus Incisos b) y c), 140 Incisos a) y b), 143, 144, 145, 146 y 147 de la Ley N° 2492 (Código Tributario Boliviano CTB), por infringir los Artículos 16 Parágrafos I) y IV), 116 Parágrafos II) y III) y 118 de la Constitución Política del Estado (CPE).
                    El Tribunal Constitucional declara: 1° La INCONSTITUCIONALIDAD, 1) Por omisión normativa del Artículo 131, 2) Por contradicción de los Artículos 131 Tercer Párrafo, 139 Inciso c), 141, 145, 146 y 147 del Código Tributario Boliviano (CTB).
                    Con los efectos previstos por el Artículo 58, Parágrafo III de la Ley del Tribunal Constitucional, y 2° La CONSTITUCIONALIDAD de los Artículos 139 Inciso b), 140 Incisos a) y b), 143 y 144 del Código Tributario Boliviano (CTB).

                    ii) Sentencia Constitucional 0076/2004, de 16 de julio de 2004: En el Recurso Indirecto o Incidental de Inconstitucionalidad, demandando la Inconstitucionalidad de la Disposición Final Novena de la Ley N° 2492 (Código Tributario Boliviano CTB), por ser contraria a los Artículos 7 Inciso a) y 16 Parágrafos II y IV de la Constitución Política del Estado (CPE).
                    El Tribunal Constitucional declara la CONSTITUCIONALIDAD de la Disposición Final Novena del Código Tributario Boliviano (CTB), con vigencia temporal de un año a partir de la fecha la citación con esta Sentencia, y EXHORTA al Poder Legislativo para que en dicho plazo subsane el vacío legal inherente a la ausencia de un procedimiento contencioso tributario, bajo conminatoria en caso de incumplimiento, de que la indicada disposición legal quedará expulsada del ordenamiento jurídico nacional, en lo que respecta a la abrogatoria del procedimiento contencioso tributario establecido en el Título VI, Artículos 214 a 302 del Código Tributario Boliviano (CTB).

                    iii) Ley N° 3092 de 07/07/2005; mediante su Artículo 2 aclara que:

                    "Artículo 2 Se establece que la resolución administrativa dictada por el Superintendente Tributario General para resolver el Recurso Jerárquico agota la vía administrativa, pudiendo acudir el sujeto pasivo y/o tercero responsable a la impugnación judicial por la vía del proceso contencioso administrativo según lo establecido en la Constitución Política del Estado.

                    El Poder Judicial deberá presentar, en el plazo de sesenta (60) días posteriores a la publicación de la presente Ley, un Proyecto de Ley que establezca un procedimiento contencioso administrativo que responda fundamentalmente a los principios constitucionales de separación de poderes, debido proceso, presunción de inocencia y tutela judicial efectiva.

                    La ejecución de la Resolución dictada en el recurso jerárquico, podrá ser suspendida a solicitud expresa de suspensión formulada por el contribuyente y/o responsable presentada dentro del plazo perentorio de cinco (5) días de su notificación con la resolución que resuelva dicho recurso. La solicitud deberá contener además, el ofrecimiento de garantías suficientes y el compromiso de constituirlas dentro de los noventa (90) días siguientes".

                    iv) Sentencia Constitucional 0090/2006, de 17 de noviembre de 2006: En el recurso Indirecto o Incidental de Inconstitucionalidad, demandando la Inconstitucionalidad del Primer Párrafo del Artículo 2 de la Ley N° 3092, de 07/07/2005, por vulnerar los Artículos 6, 7 Incisos a) y h), 14, 16, 32, 116 Parágrafos I y III, 117 Parágrafo I, 118 Parágrafo I, 228 y 229 de la Constitución Política del Estado (CPE).

                    El Tribunal Constitucional declara: 1. INCONSTITUCIONAL la frase contenida en el Primer Párrafo del Artículo 2 de la Ley N° 3092, de 07/07/2005: "el sujeto pasivo y/o tercero responsable".

                    2 Queda el primer párrafo del Artículo 2 de la Ley N° 3092, de la siguiente manera: "Se establece que la resolución administrativa dictada por el Superintendente Tributario General para resolver el Recurso Jerárquico agota la vía administrativa, pudiendo acudirse a la impugnación judicial por la vía del proceso contencioso administrativo según lo establecido en la Constitución Política del Estado".

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. EXHORTA al Poder Legislativo, que con carácter de urgencia sancione la Ley que establezca los casos y presupuestos en los que la Administración Tributaria tenga legitimación activa para interponer el proceso contencioso administrativo.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;v) Ley N° 212 de 23/12/2011; Ley de Transición para el Tribunal Supremo de Justicia, Tribunal Agroambiental, Consejo de la Magistratura y Tribunal Constitucional Plurinacional, mediante su Artículo 10, Parágrafo II, incorporó al Artículo 228 de la Ley N° 1340 de 28/05/1992, el Inciso 7); mismo que fue declarado Inconstitucional por la SC 0967/2014 de 23 de mayo de 2014.

                    "ARTÍCULO 228 La demanda deberá reunir los siguientes requisitos:

                    1) Que sea presentada por escrito en papel sellado y con los timbres de Ley.

                    2) El nombre completo del actor y domicilio.

                    3) La designación de la administración o ente demandado.

                    4) Que se adjunte copia legalizada de la resolución o acto impugnado, o se señale el archivo o lugar en que se encuentra.

                    5) Que se acompañe el poder de representación en juicio y los documentos justificativos de la personería del demandante.

                    6) Los fundamentos de hecho y derecho, en que se apoya la demanda, fijando con claridad lo que se pide.

                    7) Cuando el monto determinado sea igual o superior a quince mil Unidades de Fomento a la Vivienda (15.000 UFV´s), el contribuyente deberá acompañar a la demanda el comprobante de pago total del tributo omitido actualizado en UFV´s e intereses consignados en la Resolución Determinativa. En caso de que la resolución impugnada sea revocada total o parcialmente mediante resolución judicial ejecutoriada, el importe pagado indebidamente será devuelto por la Administración Tributaria expresado en UFV´s entre el día del pago y la fecha de devolución al sujeto pasivo".


                    <h5>Nota del Editor:</h5>
                    SENTENCIA CONSTITUCIONAL PLURINACIONAL 0967/2014 de 23 de mayo de 2013: En la Acción de Inconstitucionalidad Abstracta del Artículo 10 Parágrafo II de la Ley Nº 212 de 23 de diciembre de 2011; y Artículo 1, Parágrafo II, de la Resolución Regulatoria 0 0001 11, por vulnerar presuntamente los Artículos 8, Parágrafo II, 9, Parágrafo I, 14, Parágrafos II y III, 23, Parágrafo I, 115, Parágrafos I y II, 116, Parágrafo II, 117, Parágrafo I, 119, Parágrafos I y II, 120, Parágrafo I, 178, Parágrafo I y 180, Parágrafos I y II de la Constitución Política del Estado (CPE); Artículo 8, Numeral 2, Inciso h), Artículos 24 y 25 de la Convención Americana sobre Derechos Humanos; y Artículo 14 del Pacto Internacional de Derechos Civiles y Políticos (PIDCP).

                    La Sala Plena del Tribunal Constitucional Plurinacional declara: 1º La IMPROCEDENCIA de la acción respecto al Artículo 1, Parágrafo II de la Resolución Regulatoria 0 0001 11, que incorpora el Artículo 54, por existir cosa juzgada constitucional.

                    2º Declarar la INCONSTITUCIONALIDAD del Artículo 10, Parágrafo II de la Ley Nº 212, por ser incompatible con los Artículos 8, Parágrafo II, 14, Parágrafo II, 115, 117, Parágrafo I y 119 de la Constitución Política del Estado (CPE); Artículos 8, Numeral 2, Inciso h), 24 y 25 de la Convención Americana sobre Derechos Humanos; y, Artículo 14 del Pacto Internacional de Derechos Civiles y Políticos (PIDCP).

                    vi) Ley Nº 620 de 29/12/2014, Ley Transitoria para la Tramitación de los Procesos Contencioso y Contencioso Administrativo, creó en la estructura del Tribunal Supremo de Justicia y en los Tribunales Departamentales de Justicia, Salas en Materia Contenciosa y Contenciosa Administrativa.

                    <h3>Título IV
                        ILÍCITOS TRIBUTARIOS</h3>

                    <h3>CAPÍTULO I
                        DISPOSICIONES GENERALES</h3>

                    <h4>ARTÍCULO 148</h4> (DEFINICIÓN Y CLASIFICACIÓN).

                    <br>I. Constituyen ilícitos tributarios las acciones u omisiones que violen normas tributarias materiales o formales, tipificadas y sancionadas en el presente Código y demás disposiciones normativas tributarias.

                    Los ilícitos tributarios se clasifican en contravenciones y delitos.

                    <br>II. Los delitos tributario aduaneros son considerados como delitos públicos colectivos de múltiples víctimas y se considerará la pena principal más las agravantes como base de la sanción penal.

                    <h5>Nota del Editor:</h5>
                    Ley Nº 037 de 10/08/2010; Ley que Modifica el Código Tributario y la Ley General de Aduanas, mediante su Artículo 2, incorporó el Parágrafo II precedente.

                    <br>III. En materia de contrabando no se admiten las medidas sustitutivas a la detención preventiva.

                    <h5>Nota del Editor:</h5>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i) Ley Nº 037 de 10/08/2010; Ley que Modifica el Código Tributario y la Ley General de Aduanas, mediante su Artículo 2, incorporó el Parágrafo III del Artículo precedente.

                    ii) Sentencia Constitucional Plurinacional 1663/2013, de 4 de octubre de 2013: En las Acciones de Inconstitucionalidad Concreta demandando la Inconstitucionalidad del Artículo 2 de la Ley N° 037 de 10/08/2010, Ley que Modifica el Código Tributario y la Ley General de Aduanas, en relación al Artículo 148 Parágrafos II y III de la Ley N° 2492 (Código Tributario Boliviano CTB), por ser presuntamente contrarios a los Artículos 22, 23 Parágrafos I y V, 109 Parágrafos I y II, 115 Parágrafo II, 116 Parágrafos I y II, 117 Parágrafo I, 119 Parágrafo I y II, 123 y 410 Parágrafos I y II de la Constitución Política del Estado (CPE).

                    La Sala Plena del Tribunal Constitucional Plurinacional declara la INCONSTITUCIONALIDAD del Artículo 2 Parágrafo III de la Ley N° 037 de 10/08/2010, Ley que Modifica el Código Tributario Boliviano y la Ley General de Aduanas, en relación al Artículo 148 Parágrafo III del Código Tributario Boliviano (CTB), en su frase "En materia de contrabando no se admiten las medidas sustitutivas a la detención preventiva".

                    <h4>ARTÍCULO 149</h4> (NORMATIVA APLICABLE).

                    <br>I. El procedimiento para establecer y sancionar las contravenciones tributarias se rige sólo por las normas del presente Código, disposiciones normativas tributarias y subsidiariamente por la Ley del Procedimiento Administrativo.

                    <br>II. La investigación y juzgamiento de los delitos tributarios se rigen por las normas de este Código, por otras leyes tributarias, por el Código de Procedimiento Penal y el Código Penal en su parte general con sus particularidades establecidas en la presente norma.

                    <br>III. En delitos tributarios aduaneros flagrantes corresponde la aplicación directa del Procedimiento Inmediato para Delitos Flagrantes contenido en el Título V de la Ley Nº 007 de 18 de mayo de 2010.

                    <h5>Nota del Editor:</h5>
                    Ley Nº 037 de 10/08/2010; Ley que Modifica el Código Tributario y la Ley General de Aduanas, mediante su Artículo 3, incorporó el Parágrafo III del Artículo precedente.

                    <h4>ARTÍCULO 150</h4> (RETROACTIVIDAD). Las normas tributarias no tendrán carácter retroactivo, salvo aquellas que supriman ilícitos tributarios, establezcan sanciones más benignas o términos de prescripción más breves o de cualquier manera beneficien al sujeto pasivo o tercero responsable.

                    <h4>ARTÍCULO 151</h4> (RESPONSABILIDAD POR ILÍCITOS TRIBUTARIOS). Son responsables directos del ilícito tributario, las personas naturales o jurídicas que cometan las contravenciones o delitos previstos en este Código, disposiciones legales tributarias especiales o disposiciones reglamentarias.

                    De la comisión de contravenciones tributarias surge la responsabilidad por el pago de la deuda tributaria y/o por las sanciones que correspondan, las que serán establecidas conforme a los procedimientos del presente Código.

                    De la comisión de un delito tributario, que tiene carácter personal, surgen dos responsabilidades: una penal tributaria y otra civil.

                    <h4>ARTÍCULO 152</h4> (RESPONSABILIDAD SOLIDARIA POR DAÑO ECONÓMICO). Si del resultado del ilícito tributario emerge daño económico en perjuicio del Estado, los servidores públicos y quienes hubieran participado en el mismo, así como los que se beneficien con su resultado, serán responsables solidarios e indivisibles para resarcir al Estado el daño ocasionado. A los efectos de este Código, los tributos omitidos y las sanciones emergentes del ilícito, constituyen parte principal del daño económico al Estado.

                    <h4>ARTÍCULO 153</h4> (CAUSALES DE EXCLUSIÓN DE RESPONSABILIDAD).

                    <br>I. Sólo son causales de exclusión de responsabilidad en materia tributaria las siguientes:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. La fuerza mayor;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. El error de tipo o error de prohibición, siempre que el sujeto pasivo o tercero responsable hubiera presentado una declaración veraz y completa antes de cualquier actuación de la Administración Tributaria;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. En los supuestos de decisión colectiva, el haber salvado el voto o no haber asistido a la reunión en que se tomó la decisión, siempre y cuando este hecho conste expresamente en el acta correspondiente;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. Las causales de exclusión en materia penal aduanera establecidas en Ley especial como eximentes de responsabilidad.

                    <br>II. Las causales de exclusión sólo liberan de la aplicación de sanciones y no así de los demás componentes de la deuda tributaria.

                    <br>III. Si el delito de Contrabando se cometiere en cualquier medio de transporte público de pasajeros, por uno o más de éstos y sin el concurso del transportador, no se aplicará a éste la sanción de comiso de dicho medio de transporte, siempre y cuando se trate de equipaje acompañado de un pasajero que viaje en el mismo medio de transporte, o de encomiendas debidamente manifestadas.

                    <h4>ARTÍCULO 153 bis</h4> Quedará eximido de responsabilidad de las penas privativas de libertad por delito aduanero, el auxiliar de la función pública aduanera que en ejercicio de sus funciones, efectúe declaraciones aduaneras por terceros, transcribiendo con fidelidad los documentos que reciba de sus comitentes, consignantes o consignatarios y propietarios de las mercancías, no obstante que se establezcan diferencias de calidad, cantidad, peso o valor u origen entre lo declarado en la factura comercial y demás documentos aduaneros transcritos y lo encontrado en el momento del despacho aduanero.

                    Se excluyen de este eximente los casos en los cuales se presenten cualquiera de las formas de participación criminal establecidas en el Código Penal, garantizando para el auxiliar de la función pública aduanera el derecho de comprobar la información proporcionada por sus comitentes, consignantes o consignatarios y propietarios.

                    <h5>Nota del Editor:</h5>
                    Ley N° 2492 de 02/08/2003; Código Tributario Boliviano, en su Disposición Final Décimo Primera, incorporó el Artículo 183 de la Ley N° 1990 de 28/07/1999; Ley General de Aduanas, como Artículo 153 bis precedente.

                    <h4>ARTÍCULO 154</h4> (PRESCRIPCIÓN, INTERRUPCIÓN Y SUSPENSIÓN).

                    <br>I. La acción administrativa para sancionar contravenciones tributarias prescribe, se suspende e interrumpe en forma similar a la obligación tributaria, esté o no unificado el procedimiento sancionatorio con el determinativo.

                    <br>II. La acción penal para sancionar delitos tributarios prescribe conforme a normas del Código de Procedimiento Penal.

                    <br>III. La prescripción de la acción para sancionar delitos tributarios se suspenderá durante la fase de determinación y prejudicialidad tributaria.

                    <h5>Nota del Editor:</h5>
                    Ley N° 291 de 22/09/2012; Ley de Modificaciones al Presupuesto General del Estado (PG 2012), mediante su Disposición Adicional Séptima, modificó el Parágrafo III precedente.

                    <br>IV. La acción administrativa para ejecutar sanciones prescribe a los cinco (5) años.

                    <h5>Nota del Editor:</h5>
                    Ley N° 291 de 22/09/2012; Ley de Modificaciones al Presupuesto General del Estado (PG 2012), mediante su Disposición Adicional Séptima, modificó el Parágrafo IV precedente.

                    <h4>ARTÍCULO 155</h4> (AGRAVANTES). Constituyen agravantes de ilícitos tributarios las siguientes circunstancias:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. La reincidencia, cuando el autor hubiere sido sancionado por resolución administrativa firme o sentencia ejecutoriada por la comisión de un ilícito tributario del mismo tipo en un período de cinco (5) años;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. La resistencia manifiesta a la acción de control, investigación o fiscalización de la Administración
                    Tributaria;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. La insolvencia tributaria fraudulenta, cuando intencionalmente se provoca o agrava la insolvencia propia o ajena, frustrando en todo o en parte el cumplimiento de obligaciones tributarias;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. Los actos de violencia o intimidación empleados para cometer el ilícito o evitar su descubrimiento;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;5. El empleo de armas o explosivos;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;6. La participación de tres o más personas;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;7. El uso de bienes del Estado para la comisión del ilícito;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;8. El tráfico internacional ilegal de bienes que formen parte del patrimonio histórico, cultural, turístico, biológico, arqueológico, tecnológico, patente y científico de la Nación, así como de otros bienes cuya preservación esté regulada por disposiciones legales especiales;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;9. El empleo de personas inimputables o personas interpuestas;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;10. La participación de profesionales vinculados a la actividad tributaria, auxiliares de la función pública aduanera o de operadores de comercio exterior;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;11. Los actos que ponen en peligro la salud pública;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;12. La participación de servidores públicos que aprovecharen de su cargo o función o se encontraren vinculados al control y lucha contra el contrabando;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;13. El autor o partícipe integre un grupo que califique como asociación delictuosa u organización criminal;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;14. El hecho sea cometido en lugar despoblado; o,

                    15 El hecho sea cometido en ocasión de un estrago, conmoción popular, aprovechándose de un accidente o de un infortunio particular.

                    Las agravantes mencionadas anteriormente para el caso de contravenciones determinarán que la multa sea incrementada en un treinta por ciento (30%) por cada una de ellas.



                    <h5>Disposiciones Relacionadas:</h5>

                    Decreto Supremo N° 27874 de 26/11/2004, Reglamenta Algunos Aspectos del Código Tributario Boliviano, en su Artículo 8, señala lo siguiente:
                    "ARTÍCULO 8 (AGRAVANTES). Procederá la aplicación de la agravante de reincidencia, siempre que el ilícito tributario sancionado por Resolución Administrativa firme o sentencia ejecutoriada, se refiera a la misma conducta ilícita dentro del tipo que corresponda".

                    Tratándose de delitos tributarios, la pena privativa de libertad se incrementará hasta en una mitad.
                    Cuando en el contrabando concurra alguna de las circunstancias previstas en los numerales 1, 4 y 5 del presente Artículo, el ilícito constituirá delito de contrabando previsto en el Artículo 181 de este Código.

                    <h5>Nota del Editor:</h5>
                    Ley N° 1053 de 25/04/2018; Ley de Fortalecimiento de la Lucha contra el Contrabando, en sus Disposiciones Adicionales Primera, Parágrafo I modificó el Artículo precedente.

                    <h4>ARTÍCULO 156</h4> (REDUCCIÓN DE SANCIONES). Las sanciones pecuniarias establecidas en este Código para la contravención de omisión de pago, se reducirán conforme a los siguientes criterios:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. El pago de la deuda tributaria después del décimo día de la notificación con la Vista de Cargo o Auto Inicial y hasta antes de la notificación con la Resolución Determinativa o Sancionatoria, determinara la reducción de la sanción aplicable en el ochenta por ciento (80%).

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. El pago de la deuda tributaria efectuado después de notificada la Resolución Determinativa o Sancionatoria hasta antes de la presentación del recurso de alzada ante la Autoridad Regional de Impugnación Tributaria, determinara la reducción de la sanción en el sesenta por ciento (60%).

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. El pago de la deuda tributaria efectuado después de la interposición del recurso de alzada y antes de la presentación del recurso jerárquico ante la Autoridad General de Impugnación Tributaria, determinará la reducción de la sanción en el cuarenta por ciento (40%).

                    <h5>Nota del Editor:</h5>

                    Ley N° 812 de 30/06/2016, en su Artículo 2, Parágrafo IV modificó el Artículo precedente.

                    <h5>Disposiciones Relacionadas:</h5>

                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano en su Artículo 38 y Decreto Supremo N° 27874 de 26/11/2004, Reglamenta Algunos Aspectos del Código Tributario Boliviano, en su Artículo 9, señalan lo siguiente:

                    "ARTÍCULO 38 (REDUCCIÓN DE SANCIONES). La reducción de sanciones por la contravención de omisión de pago establecida en el Artículo 156 de la Ley N° 2492, procederá previo pago o constitución de facilidades de pago de la deuda tributaria.

                    De efectuarse el pago de la deuda tributaria, la Administración Tributaria emitirá la Resolución Determinativa que declare pagada la misma. De no estar pagadas las sanciones por contravenciones tributarias, la resolución establecerá la existencia de las mismas e impondrá las sanciones que correspondan.

                    De solicitarse facilidades de pago por la deuda tributaria y/o multas, la Administración Tributaria emitirá la Resolución Administrativa aceptando el beneficio, si corresponde. El incumplimiento de la facilidad de pago, dará lugar a la pérdida del beneficio de la reducción de sanción y a la ejecución de la Resolución Administrativa que acepta las facilidades de pago.

                    Cuando exista una pluralidad de deudas, el pago de la deuda tributaria por uno o más períodos y/o tributos determinados, dará lugar a la reducción de sanciones respecto al o los tributos pagados."

                    <h5>Nota del Editor</h5>

                    Decreto Supremo N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo VII, modificó el Artículo precedente.
                    "ARTÍCULO 9 (REDUCCIÓN DE SANCIONES). En caso de ocurrir lo previsto en el Parágrafo II del Artículo 51 de la Ley N° 2341 de 23 de abril de 2002 Ley de procedimiento Administrativo, la Resolución que disponga el consiguiente archivo de obrados, surtirá los efectos de la resolución de la Superintendencia Tributaria Regional a que se refiere el Numeral 3 del Artículo 156 de la Ley N° 2492".

                    <h4>ARTÍCULO 157</h4> (ARREPENTIMIENTO EFICAZ). Quedará automáticamente extinguida la sanción pecuniaria por contravención de omisión de pago, cuando el sujeto pasivo o tercero responsable pague la deuda tributaria hasta el décimo día de notificada la Vista de Cargo o Auto Inicial, o hasta antes del inicio de la ejecución tributaria de las declaraciones juradas que determinen tributos y no hubiesen sido pagados totalmente.

                    <h5>Nota del Editor:</h5>
                    Ley N° 812 de 30/06/2016, en su Artículo 2, Parágrafo V modificó el Párrafo precedente.

                    En el caso de delito de Contrabando, se extingue la sanción pecuniaria cuando antes del comiso se entregue voluntariamente a la Administración Tributaria la mercancía ilegalmente introducida al país. Si el contrabando consistiere en la salida ilícita de mercancías del territorio nacional, procederá el arrepentimiento eficaz cuando antes de la intervención de la Administración Tributaria, se pague una multa igual al cien por ciento (100%) del valor de la mercancía.

                    <h5>Nota del Editor:</h5>
                    Ley N° 3467 de 12/09/2006, mediante su Artículo 1 Parágrafo I, sustituyó el Párrafo precedente.

                    En el caso de ilícito de contrabando de mercancías cuyo derecho propietario deba ser inscrito en registro público, en sustitución al comiso de las mercancías ilegalmente introducidas al país, se aplicará una multa equivalente a un porcentaje del valor de los tributos aduaneros omitidos, de acuerdo a lo siguiente: durante el primer año multa del sesenta por ciento (60%); durante el segundo año multa del ochenta por ciento (80%) y a partir del tercer año multa del cien por ciento (100%), computables a partir de la vigencia de la presente Ley, siempre que se cumplan las siguientes condiciones:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. La presentación física de la mercancía ante la Administración Tributaria, antes de cualquier actuación de ésta última.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. El pago de la totalidad de los tributos aduaneros aplicables bajo el régimen general de importación y el cumplimiento de las normas y procedimientos vigentes.

                    <h5>Nota del Editor:</h5>
                    Ley N° 3467 de 12/09/2006, mediante su Artículo 1 Parágrafo II, incluyó el Párrafo precedente.

                    En todos los casos previstos en este Artículo se extingue la acción penal o contravencional.

                    <h5>Nota del Editor:</h5>
                    Ley N° 3467 de 12/09/2006, mediante su Artículo 1, Parágrafo III, incluyó el Párrafo precedente.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 39, señala lo siguiente:
                    "ARTÍCULO 39 (ARREPENTIMIENTO EFICAZ).
                    <br>I. La extinción automática de la sanción pecuniaria por arrepentimiento eficaz, previsto en el Artículo 157 de la Ley N° 2492, procederá en los siguientes casos:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) La deuda tributaria en proceso de fiscalización, verificación o con Vista de Cargo, siempre que se realice el pago o se acoja a facilidades de pago, por período fiscal y/o tributo, hasta el décimo día de notificada la Vista de Cargo;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) La deuda tributaria determinada por el contribuyente en la declaración jurada, siempre que realice el pago o se acoja a facilidades de pago, hasta el décimo día de notificado el Auto Inicial de Sumario Contravencional o hasta la notificación del proveído que dé inicio a la ejecución tributaria, lo que ocurra primero, de acuerdo a la norma administrativa reglamentaria.

                    La Administración Tributaria podrá ejercer posteriormente su facultad de fiscalización a la declaración jurada, pudiendo establecer diferencias a favor del fisco, en cuyo caso, la sanción por contravención de omisión de pago aplicable, sólo será establecida respecto al monto del tributo por determinarse de oficio;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) En la Declaración Jurada con errores aritméticos que ocasionen diferencias a favor del fisco establecidas en la Resolución Determinativa, la contravención por omisión de pago se establecerá por la diferencia. De pagarse la deuda tributaria hasta el décimo día de notificado el Auto Inicial, el contribuyente o tercero responsable se beneficiará con el arrepentimiento eficaz.

                    <h5>Nota del Editor</h5>
                    Decreto Supremo N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo VIII, modificó el Parágrafo precedente.
                    <br>II. En el ámbito municipal, a efecto de la aplicación del arrepentimiento eficaz, la liquidación emitida por la Administración Tributaria, a solicitud del sujeto pasivo o tercero responsable, no se entenderá como intervención de la misma".

                    Cuando el tributo pagado con el beneficio previsto en el presente Artículo sea objeto de una fiscalización o determinación posterior, en caso de existir diferencias a favor del Fisco, la sanción aplicable sólo será respecto al tributo por determinarse de oficio.

                    <h5>Nota del Editor:</h5>
                    Ley N° 812 de 30/06/2016, en su Artículo 3, Parágrafo II incorporó el Párrafo precedente.

                    <h3>CAPÍTULO II
                        CONTRAVENCIONES TRIBUTARIAS</h3>

                    <h4>ARTÍCULO 158</h4> (RESPONSABILIDAD POR ACTOS Y HECHOS DE REPRESENTANTES Y TERCEROS). Cuando el tercero responsable, un mandatario, representante, dependiente, administrador o encargado, incurriera en una contravención tributaria, sus representados serán responsables de las sanciones que correspondieran, previa comprobación, sin perjuicio del derecho de éstos a repetir contra aquellos.

                    Se entiende por dependiente al encargado, a cualquier título, del negocio o actividad comercial.

                    <h4>ARTÍCULO 159</h4> (EXTINCIÓN DE LA ACCIÓN Y SANCIÓN). La potestad para ejercer la acción por contravenciones tributarias y ejecutar las sanciones se extingue por:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Muerte del autor, excepto cuando la sanción pecuniaria por contravención esté ejecutoriada y pueda ser pagada con el patrimonio del causante, no procede la extinción.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Pago total de la deuda tributaria y las sanciones que correspondan.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Prescripción;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Condonación.

                    <h4>ARTÍCULO 160</h4> (CLASIFICACIÓN). Son contravenciones tributarias:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Omisión de inscripción en los registros tributarios;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. No emisión de factura, nota fiscal o documento equivalente;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Omisión de pago;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. Contrabando cuando se refiera al último párrafo del Artículo 181;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;5. Incumplimiento de otros deberes formales;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;6. Las establecidas en leyes especiales.

                    <h4>ARTÍCULO 161</h4> (CLASES DE SANCIONES). Cada conducta contraventora será sancionada de manera independiente, según corresponda con:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Multa;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Clausura;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Pérdida de concesiones, privilegios y prerrogativas tributarias;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. Prohibición de suscribir contratos con el Estado por el término de tres (3) meses a cinco (5) años. Esta sanción será comunicada a la Contraloría General de la República y a los Poderes del Estado que adquieran bienes y contraten servicios, para su efectiva aplicación bajo responsabilidad funcionaria;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;5. Comiso definitivo de las mercancías a favor del Estado;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;6. Suspensión temporal de actividades.

                    <h4>ARTÍCULO 162</h4> (INCUMPLIMIENTO DE DEBERES FORMALES).
                    <br>I. El que de cualquier manera incumpla los deberes formales establecidos en el presente Código, disposiciones legales tributarias y demás disposiciones normativas reglamentarias, será sancionado con una multa que irá desde cincuenta Unidades de Fomento de la Vivienda (50 UFV's) a cinco mil Unidades de Fomento de la Vivienda (5.000 UFV's). La sanción para cada una de las conductas contraventoras se establecerá en esos límites mediante norma reglamentaria.
                    <br>II. Darán lugar a la aplicación de sanciones en forma directa, prescindiendo del procedimiento sancionatorio previsto por este Código las siguientes contravenciones: 1) La falta de presentación de declaraciones juradas dentro de los plazos fijados por la Administración Tributaria; 2) La no emisión de facturas, notas fiscales o documentos equivalentes y en la omisión de inscripción en los registros tributarios, verificadas en operativos de control tributario; y,
                    3) Las contravenciones aduaneras previstas con sanción especial.

                    <h5>Nota del Editor:</h5>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i) Ley N° 291 de 22/09/2012; Ley de Modificaciones al Presupuesto General del Estado (PGE 2012) mediante su Disposición Adicional Décima Primera, modificó el Numeral 2) del Parágrafo II del Artículo precedente.
                    ii) Sentencia Constitucional 0100/2014, de 10 de enero de 2014: En la Acción de Inconstitucionalidad Abstracta, en la cual se demanda la Inconstitucionalidad de las Disposiciones Adicionales Quinta y Sexta de la Ley del Presupuesto General del Estado (LPGE) Gestión 2013, por infringir las normas de los Artículos 1, 8 Parágrafos I y II, 9 Inciso 4), 14 Parágrafo II, 22, 46 Parágrafo I Incisos 1 y 2 y Parágrafo II, 47 Parágrafo I, 108 Incisos 1, 2 y 3, 109 Parágrafo II, 115 Parágrafo II, 116 Parágrafos I y II, 117 Parágrafo I, 120 Parágrafo I, 306 Parágrafos I, II y III, 308 Parágrafos I y II, 318 Parágrafo II, 323 Parágrafo I, 334 Inciso 4) y 410 Parágrafos I y II de la Constitución Política del Estado (CPE); (...)
                    La Sala Plena del Tribunal Constitucional Plurinacional declara: 1) La Inconstitucionalidad de la frase de la Disposición Adicional Quinta de la Ley del Presupuesto General del Estado Gestión 2013, que señala: "Concluida la misma, procederá la clausura inmediata del negocio de acuerdo a las sanciones establecidas en el Parágrafo II del Artículo 164 de este Código. En caso de reincidencia, después de la máxima aplicada, se procederá a la clausura definitiva del local intervenido". La declaratoria de Inconstitucionalidad de la frase señalada, no implica la declaratoria de Inconstitucionalidad del contenido del Parágrafo II del Artículo 164 de la Ley N° 2492 (Código Tributario Boliviano CTB), por no haberse sometido a control de constitucionalidad.
                    2) La INCONSTITUCIONALIDAD de la Disposición Adicional Sexta de la Ley del Presupuesto General del Estado Gestión 2013.
                    3) La INCONSTITUCIONALIDAD por conexitud de la frase, "La no emisión de facturas, notas fiscales o documentos equivalentes y", del Artículo 162 Parágrafo II, Inciso 2) del Código Tributario Boliviano (CTB).
                    4) Se EXHORTA al Órgano Legislativo, a que en el plazo de seis meses, regule el procedimiento administrativo sancionador que responda a la naturaleza de la contravención de la no emisión de facturas, notas fiscales o documentos equivalentes, verificados en operativos de control tributario; en tanto se proceda con la regulación de dicho procedimiento sancionador y en el marco de una interpretación previsora, se aplicara el procedimiento contravencional establecido en el Artículo 168 del Código Tributario Boliviano (CTB).

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en sus Artículos 27, Parágrafo I y Artículo 40, señalan lo siguiente:
                    "ARTÍCULO 27 (RECTIFICATORIAS A FAVOR DEL FISCO).
                    <br>I. El contribuyente o tercero responsable podrá rectificar su Declaración Jurada con saldo a favor del fisco en cualquier momento.
                    Las Declaraciones Juradas rectificatorias presentadas una vez iniciada la fiscalización o verificación, no tendrán efecto en la determinación de oficio. Los pagos a que den lugar estas declaraciones, serán considerados como pagos a cuenta de la deuda a determinarse por la Administración Tributaria.
                    La presentación de la Declaración Jurada Rectificatoria no suspende el proceso de ejecución iniciado por la Declaración Jurada original o la última presentada.
                    Cuando la Declaración Jurada Rectificatoria sea por un importe mayor al tributo determinado en la Declaración Jurada Original o la última presentada, la Administración Tributaria procederá a su ejecución únicamente por la diferencia del impuesto determinado.

                    <h5>Nota del Editor</h5>
                    Decreto Supremo N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo V, modificó el Parágrafo precedente.
                    "ARTÍCULO 40 (INCUMPLIMIENTO A DEBERES FORMALES).
                    <br>I. Conforme lo establecido por el Parágrafo I del Artículo 162 de la Ley N° 2492, las Administraciones Tributarias dictarán las resoluciones administrativas que contemplen el detalle de sanciones para cada una de las conductas contraventoras tipificadas como incumplimiento a los deberes formales.
                    <br>II. La falta de presentación en término de la declaración de pago emitida por las Administraciones Tributarias Municipales será sancionada de manera automática con una multa del diez por ciento (10%) del tributo omitido expresado en Unidades de Fomento de la Vivienda, monto que no podrá ser superior a dos mil cuatrocientas Unidades de Fomento de la Vivienda (2400 UFV's), ni menor a cincuenta Unidades de Fomento de la Vivienda (50 UFV's). Cuando no hubiera tributo omitido, la sanción será de cincuenta Unidades de Fomento de la Vivienda (50 UFV's) para el caso de personas naturales y doscientas cuarenta Unidades de Fomento de la Vivienda (240 UFV's), para personas jurídicas, incluidas las empresas unipersonales".

                    <h4>ARTÍCULO 163</h4> (OMISIÓN DE INSCRIPCIÓN EN LOS REGISTROS TRIBUTARIOS).
                    <br>I. El que omitiera su inscripción en los registros tributarios correspondientes, se inscribiera o permaneciera en un régimen tributario distinto al que le corresponda y de cuyo resultado se produjera beneficios o dispensas indebidas en perjuicio de la Administración Tributaria, será sancionado con la clausura del establecimiento hasta que regularice su inscripción. Sin perjuicio del derecho de la Administración Tributaria a inscribir de oficio, recategorizar, fiscalizar y determinar la deuda tributaria dentro el término de prescripción.

                    <h5>Nota del Editor:</h5>
                    Ley Nº 317 de 11/12/2012; Ley del Presupuesto General del Estado Gestión 2013, en su Disposición Adicional Cuarta, modificó el Parágrafo precedente.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 41, señala lo siguiente:
                    "ARTÍCULO 41 (OMISIÓN DE INSCRIPCIÓN EN LOS REGISTROS TRIBUTARIOS MUNICIPALES). En el ámbito municipal, a efecto de la aplicación de la atribución otorgada a la Administración Tributaria por el Parágrafo I del Artículo 163 de la Ley N° 2492, sólo se considerarán las actuaciones administrativas que sean parte del procedimiento previsto por ley para sancionar la contravención tributaria, por tanto la notificación de requerimientos de inscripción o corrección no afectará la eficacia del arrepentimiento del contraventor en estos casos".

                    <br>II. La inscripción voluntaria en los registros pertinentes o la corrección de la inscripción, previa a cualquier actuación de la Administración Tributaria, exime de la clausura y multa, pero en ningún caso del pago de la deuda tributaria.

                    <h4>ARTÍCULO 164</h4> (NO EMISIÓN DE FACTURA, NOTA FISCAL O DOCUMENTO EQUIVALENTE).
                    <br>I. Quien en virtud de lo establecido en disposiciones normativas, esté obligado a la emisión de facturas, notas fiscales o documentos equivalentes y omita hacerlo, será sancionado con la clausura del establecimiento donde desarrolla la actividad gravada, sin perjuicio de la fiscalización y determinación de la deuda tributaria.
                    <br>II. La sanción será de seis (6) días continuos hasta un máximo de cuarenta y ocho (48) días atendiendo el grado de reincidencia del contraventor. La primera contravención será penada con el mínimo de la sanción y por cada reincidencia será agravada en el doble de la anterior hasta la sanción mayor, con este máximo se sancionará cualquier reincidencia posterior.

                    Sentencia Constitucional 0100/2014, de 10 de enero de 2014: En la Acción de Inconstitucionalidad Abstracta, en la cual se demanda la Inconstitucionalidad de las Disposiciones Adicionales Quinta y Sexta de la Ley del Presupuesto General del Estado (LPGE) Gestión 2013, por infringir las normas de los Artículos 1, 8 Parágrafos I y II, 9 Inciso 4), 14 Parágrafo II, 22, 46 Parágrafo I Incisos 1 y 2 y Parágrafo II, 47 Parágrafo I, 108 Incisos 1, 2 y 3, 109 Parágrafo II, 115 Parágrafo II, 116 Parágrafos I y II, 117 Parágrafo I, 120 Parágrafo I, 306 Parágrafos I, II y III, 308 Parágrafos I y II, 318 Parágrafo II, 323 Parágrafo I, 334 Inciso 4) y 410 Parágrafos I y II de la Constitución Política del Estado (CPE); (...)
                    La Sala Plena del Tribunal Constitucional Plurinacional declara: 1) La INCONSTITUCIONALIDAD de la frase de la Disposición Adicional Quinta de la Ley del Presupuesto General del Estado Gestión 2013, que señala: "Concluida la misma, procederá la clausura inmediata del negocio de acuerdo a las sanciones establecidas en el Parágrafo II del Artículo 164 de este Código. En caso de reincidencia, después de la máxima aplicada, se procederá a la clausura definitiva del local intervenido". La declaratoria de Inconstitucionalidad de la frase señalada, no implica la declaratoria de Inconstitucionalidad del contenido del Parágrafo II del Artículo 164 de la Ley N° 2492 (Código Tributario Boliviano CTB), por no haberse sometido a control de constitucionalidad.
                    2) La INCONSTITUCIONALIDAD de la Disposición Adicional Sexta de la Ley del PresupuestoGeneral del Estado Gestión 2013.
                    3) La INCONSTITUCIONALIDAD por conexitud de la frase, "La no emisión de facturas, notas fiscales o documentos equivalentes y", del Artículo 162 Parágrafo II, Inciso 2) del Código Tributario Boliviano (CTB).
                    4) Se EXHORTA al Órgano Legislativo, a que en el plazo de seis meses, regule el procedimiento administrativo sancionador que responda a la naturaleza de la contravención de la no emisión de facturas, notas fiscales o documentos equivalentes, verificados en operativos de control tributario; en tanto se proceda con la regulación de dicho procedimiento sancionador y en el marco de una interpretación previsora, se aplicara el procedimiento contravencional establecido en el Artículo 168 del Código Tributario Boliviano (CTB).

                    <br>III. Para efectos de cómputo en los casos de reincidencia, los establecimientos registrados a nombre de un mismo contribuyente, sea persona natural o jurídica, serán tratados como si fueran una sola entidad, debiéndose cumplir la clausura, solamente en el establecimiento donde se cometió la contravención.
                    <br>IV. Durante el período de clausura cesará totalmente la actividad comercial del establecimiento pasible a la misma, salvo la que fuera imprescindible para la conservación y custodia de los bienes depositados en su interior, o para la continuidad de los procesos de producción que no pudieran interrumpirse por
                    <br>V. Cuando se verifique la no emisión de factura, nota fiscal o documento equivalente por la venta de gasolinas, diésel oíl y gas natural vehicular en estaciones de servicio autorizadas por la entidad competente, la sanción consistirá en la clausura definitiva del establecimiento.

                    <h5>Nota del Editor:</h5>
                    Ley N° 100 de 04/04/2011, mediante su Artículo 19 Parágrafo I, incorporó el Parágrafo V del Artículo precedente.

                    <h4>ARTÍCULO 165</h4> (OMISIÓN DE PAGO). El que por acción u omisión no pague o pague de menos la deuda tributaria, no efectúe las retenciones a que está obligado u obtenga indebidamente beneficios y valores fiscales, será sancionado con el cien por ciento (100%) del monto calculado para la deuda tributaria.


                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en sus Artículos 42 y 50, y Decreto Supremo N° 27874 de 26/11/2004, Reglamenta Algunos Aspectos del Código Tributario Boliviano, en sus Artículos 7 y 10, señalan lo siguiente:
                    "ARTÍCULO 42 (OMISIÓN DE PAGO). La multa por la contravención de omisión de pago a la que se refiere el Artículo 165 de la Ley N° 2492, será determinada en el importe equivalente al tributo omitido actualizado en UFV's, por tributo y/o período pendiente de pago al vencimiento del décimo día de notificada la Vista de Cargo, al vencimiento del décimo día de notificado el Auto Inicial de Sumario Contravencional o al inicio de la ejecución tributaria de las declaraciones juradas, lo que ocurra primero."

                    <h5>Nota del Editor</h5>
                    Decreto Supremo N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo IX,modificó el Artículo precedente.

                    "ARTÍCULO 7 (NOM BIS IN IDEM). La Administración Tributaria no impondrá sanción por contravención de omisión de pago cuando, como resultado del procesamiento del delito tributario respectivo, el Fiscal de manera fundamentada decrete el sobreseimiento o la autoridad judicial respectiva dicte sentencia absolutoria".

                    "ARTÍCULO 10 (OBTENCIÓN INDEBIDA DE BENEFICIOS Y VALORES FISCALES). De acuerdo a lo dispuesto en el Artículo 165 de la Ley N° 2492, la base para la aplicación de la sanción pecuniaria en el caso de la omisión de pago, por no haberse efectuado las retenciones o por haberse obtenido indebidamente beneficios y valores fiscales, es el 100% (CIEN POR CIENTO) del monto no retenido o del monto indebidamente devuelto, respectivamente, ambos expresados en Unidades de Fomento a la Vivienda".

                    D.S. N° 27310: "ARTÍCULO 50 (RESULTADOS DEL AFORO). Se modifica el Párrafo Tercero del Artículo 108 del Reglamento a la Ley General de Aduanas, con el siguiente texto:

                    "Cuando la observación en el Acta de Reconocimiento establezca disminución u omisión en el pago de los tributos aduaneros por una cuantía menor a Cincuenta mil Unidades de Fomento de la Vivienda (50.000 UFV's) o, siendo el monto igual o mayor a esta cuantía, no se hubiere configurado las conductas detalladas en el Artículo 178 de la Ley N° 2492, el consignatario podrá reintegrar los tributos aduaneros con el pago de la multa prevista en el Artículo 165 de la Ley N° 2492 ó constituir garantía suficiente por el importe total para continuar con el despacho aduanero"".

                    <h4>ARTÍCULO 165 bis</h4> Comete contravención aduanera quien en el desarrollo de una operación o gestión aduanera incurra en actos u omisiones que infrinjan o quebranten la presente Ley y disposiciones administrativas de índole aduanera que no constituyan delitos aduaneros. Las contravenciones aduaneras son las siguientes:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Los errores de trascripción en declaraciones aduaneras que no desnaturalicen la precisión de aforo de las mercancías o liquidación de los tributos aduaneros.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) La cita de disposiciones legales no pertinentes, cuando de ello no derive un pago menor de tributos aduaneros.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) El vencimiento de plazos registrados en aduana, cuando en forma oportuna el responsable del despacho aduanero eleve, a consideración de la administración aduanera, la justificación que impide el cumplimiento oportuno de una obligación aduanera.

                    En este caso, si del incumplimiento del plazo nace la obligación de pago de tributos aduaneros, estos serán pagados con los recargos pertinentes actualizados.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) El cambio de destino de una mercancía que se encuentre en territorio aduanero nacional siempre que esta haya sido entregada a una administración aduanera por el transportista internacional, diferente a la consignada como aduana de destino en el manifiesto internacional de carga o la declaración de tránsito aduanero.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) La resistencia a órdenes e instrucciones emitidas por la Aduana Nacional a los auxiliares de la función pública aduanera, a los transportadores internacionales de mercancía, a propietarios de mercancías y consignatorios de las mismas y a operadores de comercio exterior.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) La falta de información oportuna solicitada por la Aduana Nacional a los auxiliares de la función pública aduanera y a los transportadores internacionales de mercancías.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;g) Cuando se contravenga lo dispuesto en el literal c) del Artículo 12 de la presente Ley.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;h) Los que contravengan a la presente Ley y sus reglamentos y que no constituyan delitos.

                    <h5>Nota del Editor:</h5>
                    Ley N° 2492 de 02/08/2003; Código Tributario Boliviano, en su Disposición Final Décimo Primera, incorporó el Artículo 186 de la Ley N° 1990 de 28/07/1999; Ley General de Aduanas, como Artículo 165 bis precedente.

                    <h4>ARTÍCULO 165 ter</h4> Las contravenciones en materia aduanera serán sancionadas con:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Multa que irá desde cincuenta Unidades de Fomento de la Vivienda (50 UFV's) a cinco mil Unidades de Fomento de la Vivienda (5000. UFV's). La sanción para cada una de las conductas contraventoras se establecerá en estos límites mediante norma reglamentaria.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Suspensión temporal de actividades de los auxiliares de la función pública aduanera y de los operadores de comercio exterior por un tiempo de (10) diez, a noventa (90) días.

                    La Administración Tributaria podrá ejecutar total o parcialmente las garantías constituidas a objeto de cobrar las multas indicadas en el presente Artículo.


                    <h5>Nota del Editor:</h5>
                    Ley N° 2492 de 02/08/2003; Código Tributario Boliviano, en su Disposición Final Primeram incorporó el Artículo 187 de la Ley N° 1990 de 28/07/1999; Ley de Aduanas, como Artículo 165 ter precedente.

                    <h3>CAPÍTULO III
                        PROCEDIMIENTO PARA SANCIONAR CONTRAVENCIONES TRIBUTARIAS</h3>

                    <h4>ARTÍCULO 166</h4> (COMPETENCIA). Es competente para calificar la conducta, imponer y ejecutar las sanciones por contravenciones, la Administración Tributaria acreedora de la deuda tributaria. Las sanciones se impondrán mediante Resolución Determinativa o Resolución Sancionatoria, salvando las sanciones que se impusieren en forma directa conforme a lo dispuesto por este Código.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 34, señala lo siguiente:
                    "ARTÍCULO 34 (IMPUGNACIÓN). Las Resoluciones Determinativas, dictadas conforme a la Ley N° 1340 de 28 de mayo de 1992, que fueran impugnadas ante los Superintendentes Regionales en merito a la Ley N° 2492 y que contuvieran calificación de conducta como delito tributario, deberán ser sustanciadas conforme al Título II del presente Decreto Supremo, absteniéndose los Superintendentes y la Corte Suprema de Justicia en su Sala Social de Minería y Administrativa de emitir pronunciamiento sobre la calificación de la conducta. Concluida la etapa de prejudicialidad penal, el procesamiento penal correspondiente, se efectuara conforme al Título IV de la Ley N° 2492".

                    <h4>ARTÍCULO 167</h4> (DENUNCIA DE PARTICULARES). En materia de contravenciones, cualquier persona podrá interponer denuncia escrita y formal ante la Administración Tributaria respectiva, la cual tendrá carácter reservado. El denunciante será responsable si presenta una denuncia falsa o calumniosa, haciéndose pasible a las sanciones correspondientes. Se levantará la reserva cuando la denuncia sea falsa o calumniosa.

                    <h4>ARTÍCULO 168</h4> (SUMARIO CONTRAVENCIONAL).

                    <br>I. Siempre que la conducta contraventora no estuviera vinculada al procedimiento de determinación del tributo, el procesamiento administrativo de las contravenciones tributarias se hará por medio de un sumario, cuya instrucción dispondrá la autoridad competente de la Administración Tributaria mediante cargo en el que deberá constar claramente, el acto u omisión que se atribuye al responsable de la contravención. Al ordenarse las diligencias preliminares podrá disponerse reserva temporal de las actuaciones durante un plazo no mayor a quince (15) días. El cargo será notificado al presunto responsable de la contravención, a quien se concederá un plazo de veinte (20) días para que formule por escrito su descargo y ofrezca todas las pruebas que hagan a su derecho.

                    <br>II. Transcurrido el plazo a que se refiere el parágrafo anterior, sin que se hayan aportado pruebas, o compulsadas las mismas, la Administración Tributaria deberá pronunciar resolución final del sumario en el plazo de los veinte (20) días siguientes. Dicha Resolución podrá ser recurrible en la forma y plazos dispuestos en el Título III de este Código.

                    <br>III. Cuando la contravención sea establecida en acta, ésta suplirá al auto inicial de sumario contravencional, en la misma deberá indicarse el plazo para presentar descargos y vencido éste, se emitirá la resolución final del sumario.


                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 21, señala lo siguiente:

                    "ARTÍCULO 21 (PROCEDIMIENTO PARA SANCIONAR CONTRAVENCIONES TRIBUTARIAS). El procedimiento administrativo para sancionar contravenciones tributarias podrá realizarse:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) De forma independiente, cuando la contravención se hubiera detectado a través de acciones que no emergen del procedimiento de determinación.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) De forma consecuente, cuando el procedimiento de determinación concluye antes de la emisión de la Vista de Cargo, debido al pago total de la deuda tributaria, surgiendo la necesidad de iniciar un sumario contravencional.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) De forma simultánea, cuando el sumario contravencional se subsume en el procedimiento de determinación, siendo éste el que establece la comisión o no de una contravención tributaria.

                    La Administración Tributaria queda facultada para establecer las disposiciones e instrumentos necesarios para la implantación de estos procedimientos".

                    <br>IV. En casos de denuncias, la Administración Tributaria podrá verificar el correcto cumplimiento de las obligaciones del sujeto pasivo o tercero responsable, utilizando el procedimiento establecido en el presente artículo, reduciéndose los plazos a la mitad.

                    <h4>ARTÍCULO 169</h4> (UNIFICACIÓN DE PROCEDIMIENTOS).

                    <br>I. La Vista de Cargo hará las veces de auto inicial de sumario contravencional y de apertura de término de prueba y la Resolución Determinativa se asimilará a una Resolución Sancionatoria. Por tanto, cuando el sujeto pasivo o tercero responsable no hubiera pagado o hubiera pagado, en todo o en parte, la deuda tributaria después de notificado con la Vista de Cargo, igualmente se dictará Resolución Determinativa que establezca la existencia o inexistencia de la deuda tributaria e imponga la sanción por contravención.
                    <br>II. Si la deuda tributaria hubiera sido pagada totalmente, antes de la emisión de la Vista de Cargo, la Administración Tributaria deberá dictar una Resolución Determinativa que establezca la inexistencia de la deuda tributaria y disponga el inicio de sumario contravencional.

                    <h4>ARTÍCULO 170</h4> (PROCEDIMIENTO DE CONTROL TRIBUTARIO). La Administración Tributaria podrá de oficio verificar el correcto cumplimiento de la obligación de emisión de factura, nota fiscal o documento equivalente mediante operativos de control. Cuando advierta la comisión de esta contravención tributaria, los funcionarios de la Administración Tributaria actuante deberán elaborar un acta donde se identifique la misma, se especifiquen los datos del sujeto pasivo o tercero responsable, los funcionarios actuantes y un testigo de actuación, quienes deberán firmar el acta, caso contrario se dejara expresa constancia de la negativa a esta actuación. Concluida la misma, procederá la clausura inmediata del negocio de acuerdo a las sanciones establecidas en el Parágrafo II del Artículo 164 de este Código. En caso de reincidencia, después de la máxima aplicada, se procederá a la clausura definitiva del local intervenido.

                    <h5>Nota del Editor:</h5>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i) Ley N° 317 de 11/12/2012; Ley del Presupuesto General del Estado Gestión 2013, en su Disposición Adicional Quinta, modificó el Párrafo precedente.
                    ii) Sentencia Constitucional 0100/2014, de 10 de enero de 2014: En la Acción de Inconstitucionalidad Abstracta, en la cual se demanda la Inconstitucionalidad de las Disposiciones Adicionales Quinta y Sexta de la Ley del Presupuesto General del Estado (LPGE) Gestión 2013, por infringir las normas de los Artículos 1, 8 Parágrafos I y II, 9 Inciso 4), 14 Parágrafo II, 22, 46 Parágrafo I Incisos 1 y 2 y Parágrafo II, 47 Parágrafo I, 108 Incisos 1, 2 y 3, 109 Parágrafo II, 115 Parágrafo II, 116 Parágrafos I y II, 117 Parágrafo I, 120 Parágrafo I, 306 Parágrafos I, II y III, 308 Parágrafos I y II, 318 Parágrafo II, 323 Parágrafo I, 334 Inciso 4) y 410 Parágrafos I y II de la Constitución Política del Estado (CPE); (...)
                    La Sala Plena del Tribunal Constitucional Plurinacional declara: 1) La INCONSTITUCIONALIDAD de la frase de la Disposición Adicional Quinta de la Ley del Presupuesto General del Estado Gestión 2013, que señala: "Concluida la misma, procederá la clausura inmediata del negocio de acuerdo a las sanciones establecidas en el Parágrafo II del Artículo 164 de este Código. En caso de reincidencia, después de la máxima aplicada, se procederá a la clausura definitiva del local intervenido". La declaratoria de Inconstitucionalidad de la frase señalada, no implica la declaratoria de Inconstitucionalidad del contenido del Parágrafo II del Artículo 164 de la Ley N° 2492 (Código Tributario Boliviano CTB), por no haberse sometido a control de constitucionalidad.

                    2) La INCONSTITUCIONALIDAD de la Disposición Adicional Sexta de la Ley del Presupuesto General del Estado Gestión 2013.

                    3) La INCONSTITUCIONALIDAD por conexitud de la frase, "La no emisión de facturas, notas fiscales o documentos equivalentes y", del Artículo 162 Parágrafo II, Inciso 2) del Código Tributario Boliviano (CTB).

                    4) Se EXHORTA al Órgano Legislativo, a que en el plazo de seis meses, regule el procedimiento administrativo sancionador que responda a la naturaleza de la contravención de la no emisión de facturas, notas fiscales o documentos equivalentes, verificados en operativos de control tributario; en tanto se proceda con la regulación de dicho procedimiento sancionador y en el marco de una interpretación previsora, se aplicara el procedimiento contravencional establecido en el Artículo 168 del Código Tributario Boliviano (CTB).

                    El sujeto pasivo podrá convertir la sanción de clausura por el pago inmediato de una multa equivalente a diez (10) veces el monto de lo no facturado, siempre que sea la primera vez. En adelante no se aplicará la convertibilidad.

                    Tratándose de servicios de salud, educación y hotelería la convertibilidad podrá aplicarse más de Ante la imposibilidad física de aplicar la sanción de clausura se procederá al decomiso temporal de las mercancías por los plazos previstos para dicha sanción, debiendo el sujeto pasivo o tercero responsable cubrir los gastos.

                    Ante la imposibilidad física de aplicar la sanción de clausura se procederá al decomiso temporal de las mercancías por los plazos previstos para dicha sanción, debiendo el sujeto pasivo o tercero responsable cubrir los gastos.

                    La sanción de clausura no exime al sujeto pasivo del cumplimiento de las obligaciones tributarias, sociales y laborales correspondientes.

                    Tratándose de la venta de gasolinas, diésel oíl y gas natural vehicular en estaciones de servicio autorizadas por la entidad competente, la sanción consistirá en la clausura definitiva del establecimiento, sin posibilidad de que la misma sea convertida en multa.

                    <h5>Nota del Editor:</h5>
                    Ley N° 100 de 04/04/2011, en su Artículo 19 Parágrafo II, incluyó el último Párrafo al Artículo precedente.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 28247 de 14/07/2005, Reglamento Control de Oficio de la Obligación de Emitir Factura, en sus Artículos 2, 3, 4 y 5, señalan lo siguiente:
                    "ARTÍCULO 2 (EMISIÓN DE FACTURAS, NOTAS FISCALES O DOCUMENTOS EQUIVALENTES). Una vez perfeccionado el hecho imponible, conforme lo establece el Artículo 4 de la Ley Nº 843 (Texto Ordenado Vigente), la factura, nota fiscal o documento equivalente debe ser extendida obligatoriamente.
                    El Servicio de Impuestos Nacionales SIN en ejercicio de la facultad que el confiere el Artículo 170 del Código Tributario Boliviano, verificará el correcto cumplimiento de esta obligación, a través de las modalidades descritas en el Artículo 3 del presente Decreto Supremo.
                    "ARTÍCULO 3 (VERIFICACIÓN). Además de las modalidades de verificación establecidas por el SIN, a efecto de lo dispuesto en el Artículo 170 del Código Tributario Boliviano, se utilizarán las siguientes modalidades:
                    A. Observación Directa: Procedimiento mediante el cual los servidores públicos del Servicio de Impuestos Nacionales (SIN) expresamente autorizados, observan el proceso de compra de bienes y/o contratación de servicios realizado por un tercero y verifican si el vendedor emite la factura, nota fiscal o documento equivalente.
                    La observación se llevará a cabo en el interior del establecimiento o fuera del mismo, de acuerdo a las condiciones o características de éste.
                    B. Compras de Control: Procedimiento por el cual, servidores públicos del SIN u otras personas contratadas por el SIN en el marco de lo dispuesto por el Artículo 6 de la Ley Nº 2027 de 27 de octubre de 1999 Estatuto del Funcionario Público, expresamente autorizadas al efecto, efectúan la compra de bienes y/o contratación de servicios, con la finalidad de verificar la emisión de la factura, nota fiscal o documento equivalente".
                    "ARTÍCULO 4 (RECUPERACIÓN DE IMPORTES DE TRANSACCIÓN Y DEVOLUCIÓN DE BIENES). Los sujetos pasivos y/o terceros responsables o sus dependientes, tienen la obligación de devolver el importe de la transacción una vez que los sea restituido el bien o el monto del servicio objeto de la Compra de Control, en las mismas condiciones en que fue adquirido, según la reglamentación que el SIN emita.
                    Independientemente de la devolución del importe de la transacción por los sujetos pasivos y/o terceros responsables o sus dependientes y la restitución del bien por parte de los funcionarios del SIN, subsiste la Contravención de no emisión de factura, nota fiscal o documento equivalente consignada en el Acta de Verificación y Clausura.
                    Si durante la ejecución del operativo de control, los funcionarios del SIN procedieran a la compra de alimentos y/o bebidas, así como a la compra de otros bienes o contratación de servicios que por su naturaleza no pueden ser objeto de devolución, el contribuyente y/o dependiente queda liberado de la devolución del importe recibido.
                    Los bienes adquiridos durante la ejecución de operativos de control, a través de la modalidad de Compras de Control, que por su naturaleza no fuesen devueltos a los sujetos pasivos y/o terceros responsables o sus dependientes, serán donados a entidades de beneficencia o asistencia social, conforme a reglamentación que emita el SIN".
                    "ARTÍCULO 5 (APOYO OPERATIVO). La ejecución de procesos de control, verificación e investigación del SIN, así como la ejecución del procedimiento de clausura inmediata establecido en el Artículo 170 del Código Tributario Boliviano, a requerimiento del SIN podrá ser asistida por miembros de la Policía Nacional de Bolivia declarados en comisión, efecto para el cual se conformará la Unidad de Apoyo Operativo cuyo objetivo será ejecutar tareas de seguridad y resguardo.
                    La selección de personal que conformará dicha Unidad, se realizará en base a parámetros y requisitos establecidos por el SIN.
                    Con el objetivo de coordinar e implementar la Unidad de Apoyo Operativo, se suscribirá un convenio interinstitucional entre el SIN y la Policía Nacional de Bolivia".

                    <h3>CAPÍTULO IV
                        DELITOS TRIBUTARIOS</h3>

                    <h4>ARTÍCULO 171</h4> (RESPONSABILIDAD). De la comisión de un delito tributario surgen dos responsabilidades: una penal tributaria para la investigación del hecho, su juzgamiento y la imposición de las penas o medida de seguridad correspondientes; y una responsabilidad civil para la reparación de los daños y perjuicios emergentes.
                    La responsabilidad civil comprende el pago del tributo omitido, su actualización e intereses cuando no se hubieran pagado en la etapa de determinación o de prejudicialidad, así como los gastos administrativos y judiciales incurridos.
                    La acción civil podrá ser ejercida en proceso penal tributario contra el autor y los partícipes del delito y en su caso contra el civilmente responsable.

                    <h4>ARTÍCULO 172</h4> (RESPONSABLE CIVIL). Son civilmente responsables a los efectos de este Código:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Las personas jurídicas o entidades, tengan o no personalidad jurídica, en cuyo nombre o representación hubieren actuado los partícipes del delito.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Los representantes, directores, gerentes, administradores, mandatarios, síndicos o las personas naturales o jurídicas que se hubieren beneficiado con el ilícito tributario.

                    Los civilmente responsables responderán solidaria e indivisiblemente de los daños causados al Estado.

                    <h4>ARTÍCULO 173</h4> (EXTINCIÓN DE LA ACCIÓN). Salvo en el delito de Contrabando, la acción penal en delitos tributarios se extingue conforme a lo establecido en el Artículo 27 del Código de Procedimiento Penal. A este efecto, se entiende por reparación integral del daño causado el pago del total de la deuda tributaria más el cien por ciento (100%) de la multa correspondiente, siempre que lo admita la Administración Tributaria en calidad de víctima.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 43, señala lo siguiente:

                    "ARTÍCULO 43 (EXTINCIÓN DE LA ACCIÓN).
                    <br>I. A efectos de lo dispuesto en el Artículo 173 de la Ley N° 2492, para las deudas cuya recaudación corresponda al Servicio de Impuestos Nacionales, se extinguirá la acción penal cuando se constate la reparación integral del daño causado.

                    <br>II. Cuando se trate de deudas cuya recaudación corresponda a los Gobiernos Municipales, la extinción de la acción procederá previa resolución de la máxima autoridad ejecutiva".

                    <h4>ARTÍCULO 174</h4> (EFECTOS DEL ACTO FIRME O RESOLUCIÓN JUDICIAL EJECUTORIADA). El acto administrativo firme emergente de la fase de determinación o de prejudicialidad, que incluye la resolución judicial ejecutoriada emergente de proceso contencioso administrativo producirá efecto de cosa juzgada en el proceso penal tributario en cuanto a la determinación de la cuantía de la deuda tributaria.

                    La sentencia que se dicte en proceso penal tributario no afectará la cuantía de la deuda tributaria así determinada.

                    <h4>ARTÍCULO 175</h4> (CLASIFICACIÓN). Son delitos tributarios:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Defraudación tributaria;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Defraudación aduanera;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Instigación pública a no pagar tributos;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. Violación de precintos y otros controles tributarios;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;5. Contrabando;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;6. Otros delitos aduaneros tipificados en leyes especiales.

                    <h4>ARTÍCULO 176</h4> (PENAS). Los delitos tributarios serán sancionados con las siguientes penas, independientemente de las sanciones que por contravenciones correspondan:

                    <br>I. Pena Principal: Privación de libertad.
                    <br>II. Penas Accesorias:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Multa;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Comiso de las mercancías y medios o unidades de transporte;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Inhabilitación especial:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Inhabilitación para ejercer directa o indirectamente actividades relacionadas con operaciones aduaneras y de comercio de importación y exportación por el tiempo de uno (1) a cinco (5) años.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Inhabilitación para el ejercicio del comercio, por el tiempo de uno a tres años.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Pérdida de concesiones, beneficios, exenciones y prerrogativas tributarias que gocen las personas naturales o jurídicas.

                    <h4>ARTÍCULO 176</h4> bis. (CONFISCACIÓN). En el caso de delitos tributario aduaneros, los instrumentos del delito como propiedades, depósitos o recintos de depósito, vehículos automotores, lanchas, avionetas y aviones, serán confiscados a favor del Estado, y luego de su registro se entregarán definitivamente a las Fuerzas Armadas, a la Policía Boliviana, al Ministerio Público y otras entidades conforme a Reglamentación.

                    <h5>Nota del Editor:</h5>
                    Ley Nº 037 de 10/08/2010; Ley que Modifica el Código Tributario y la Ley General de Aduanas, mediante su Artículo 4º, incorporó el Artículo precedente.

                    <h4>ARTÍCULO 177</h4> (DEFRAUDACIÓN TRIBUTARIA). El que dolosamente, en perjuicio del derecho de la Administración Tributaria a percibir tributos, por acción u omisión disminuya o no pague la deuda tributaria, no efectúe las retenciones a que está obligado u obtenga indebidamente beneficios y valores fiscales, cuya cuantía sea mayor o igual a UFV's 10.000 (Diez Mil Unidades de Fomento de la Vivienda), será sancionado con la pena privativa de libertad de tres (3) a seis (6) años y una multa equivalente al cien por ciento (100%) de la deuda tributaria establecida en el procedimiento de determinación o de prejudicialidad. Estas penas serán establecidas sin perjuicio de imponer inhabilitación especial. En el caso de tributos de carácter municipal y liquidación anual, la cuantía deberá ser mayor a UFV's 10.000 (Diez Mil Unidades de Fomento de la Vivienda) por cada periodo impositivo.

                    A efecto de determinar la cuantía señalada, si se trata de tributos de declaración anual, el importe de lo defraudado se referirá a cada uno de los doce (12) meses del año natural (UFV's 120.000). En otros supuestos, la cuantía se entenderá referida a cada uno de los conceptos por los que un hecho imponible sea susceptible de liquidación.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 44, señala lo siguiente:
                    "ARTÍCULO 44 (DEFRAUDACIÓN TRIBUTARIA). La multa por defraudación a que se refiere el Artículo 177 de la Ley N° 2492, será calculada sobre la base del tributo omitido determinado a la fecha de vencimiento expresado en Unidades de Fomento de la Vivienda".

                    <h4>ARTÍCULO 177 bis</h4> El comprador en el mercado interno, que dolosamente incluya, retenga o traslade el importe de un impuesto indirecto en el precio de venta, repercutiendo el mismo al vendedor, de cuya cuantía se obtenga un beneficio inferior a UFV´s 10.000 Diez Mil Unidades de Fomento de la Vivienda, será sancionado con multas progresivas e inhabilitaciones especiales que se establezcan reglamentariamente. Cuando el importe sea igual o superior a las UFV´s 10.000 Diez Mil Unidades de Fomento de la Vivienda, al margen de las sanciones descritas se aplicará una sanción de (3) tres a (6) seis años de pena privativa de libertad. La cuantía se entenderá referida a cada uno de los conceptos por lo que un hecho imponible sea susceptible de liquidación.

                    <h5>Nota del Editor:</h5>
                    Ley N° 186 de 17/11/2011; Ley Régimen Tasa Cero en el Impuesto al Valor Agregado para la Venta de Minerales y Metales en su Primera Fase de Comercialización, mediante su Artículo 2, Parágrafo I, incorporó el Artículo precedente.

                    <h4>ARTÍCULO 177</h4> (EMISIÓN DE FACTURAS, NOTAS FISCALES Y DOCUMENTOS EQUIVALENTES SIN HECHO GENERADOR). El que de manera directa o indirecta, comercialice, coadyuve o adquiera facturas, notas fiscales o documentos equivalentes sin haberse realizado el hecho generador gravado, será sancionado con pena privativa de libertad de dos (2) a seis (6) años.

                    <h5>Nota del Editor:</h5>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i) Ley N° 317 de 11/12/2012; Presupuesto General del Estado Gestión 2013 en su
                    Disposición Adicional Sexta, incorporó el Artículo precedente.

                    ii) Sentencia Constitucional 0100/2014, de 10 de enero de 2014: En la Acción de Inconstitucionalidad Abstracta, en la cual se demanda la Inconstitucionalidad de las Disposiciones Adicionales Quinta y Sexta de la Ley del Presupuesto General del Estado (LPGE) Gestión 2013, por infringir las normas de los Artículos 1, 8 Parágrafos I y II, 9 Inciso 4), 14 Parágrafo II, 22, 46 Parágrafo I Incisos 1 y 2 y Parágrafo II, 47 Parágrafo I, 108 Incisos 1, 2 y 3, 109 Parágrafo II, 115 Parágrafo II, 116 Parágrafos I y II, 117 Parágrafo I, 120 Parágrafo I, 306 Parágrafos I, II y III, 308 Parágrafos I y II, 318 Parágrafo II, 323 Parágrafo I, 334 Inciso 4) y 410 Parágrafos I y II de la Constitución Política del Estado (CPE); (...)

                    La Sala Plena del Tribunal Constitucional Plurinacional declara: 1) La Inconstitucionalidad de la frase de la Disposición Adicional Quinta de la Ley del Presupuesto General del Estado Gestión 2013, que señala: "Concluida la misma, procederá la clausura inmediata del negocio de acuerdo a las sanciones establecidas en el Parágrafo II del Artículo 164 de este Código. En caso de reincidencia, después de la máxima aplicada, se procederá a la clausura definitiva del local intervenido". La declaratoria de Inconstitucionalidad de la frase señalada, no implica la declaratoria de Inconstitucionalidad del contenido del
                    Parágrafo II del Artículo 164 de la Ley N° 2492 (Código Tributario Boliviano CTB), por no haberse sometido a control de constitucionalidad.
                    2) La INCONSTITUCIONALIDAD de la Disposición Adicional Sexta de la Ley del Presupuesto General del Estado Gestión 2013.
                    3) La INCONSTITUCIONALIDAD por conexitud de la frase, "La no emisión de facturas, notas fiscales o documentos equivalentes y", del Artículo 162 Parágrafo II, Inciso 2) del Código Tributario Boliviano (CTB).
                    4) Se EXHORTA al Órgano Legislativo, a que en el plazo de seis meses, regule el procedimiento administrativo sancionador que responda a la naturaleza de la contravención de la no emisión de facturas, notas fiscales o documentos equivalentes, verificados en operativos de control tributario; en tanto se proceda con la regulación de dicho procedimiento sancionador y en el marco de una interpretación previsora, se aplicara el procedimiento contravencional establecido en el Artículo 168 del Código Tributario Boliviano (CTB).

                    <h4>ARTÍCULO 177 quáter</h4> (ALTERACIÓN DE FACTURAS, NOTAS FISCALES Y DOCUMENTOS EQUIVALENTES). El que insertare o hiciere insertar en una factura, nota fiscal o documento equivalente verdadero, declaraciones falsas concernientes al hecho generador que el documento deba probar, será sancionado con privación de libertad de dos (2) a seis (6) años. La sanción será agravada en un tercio en caso de reincidencia.

                    <h5>Nota del Editor:</h5>
                    Ley N° 317 de 11/12/2012; Presupuesto General del Estado Gestión 2013 en su Disposición Adicional Séptima, incorporó el Artículo precedente.

                    <h4>ARTÍCULO 178</h4> (DEFRAUDACIÓN ADUANERA). Comete delito de defraudación aduanera, el que dolosamente perjudique el derecho de la Administración Tributaria a percibir tributos a través de las conductas que se detallan, siempre y cuando la cuantía sea mayor o igual a 50.000 UFV's (Cincuenta mil Unidades de Fomento de la Vivienda) del valor de los tributos omitidos por cada operación de despacho aduanero.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Realice una descripción falsa en las declaraciones de mercancías cuyo contenido sea redactado por cualquier medio;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Realice una operación aduanera declarando cantidad, calidad, valor, peso u origen diferente de las mercancías objeto del despacho aduanero;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Induzca en error a la Administración Tributaria, de los cuales resulte un pago incorrecto de los tributos de importación;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Utilice o invoque indebidamente documentos relativos a inmunidades, privilegios o concesión de exenciones;

                    El delito será sancionado con la pena privativa de libertad de cinco (5) a diez (10) años y una multa equivalente al cien por ciento (100%) de la deuda tributaria establecida en el procedimiento de determinación o de prejudicialidad.

                    <h5>Nota del Editor:</h5>
                    Ley N° 037 de 10/08/2010; Ley que Modifica el Código Tributario y la Ley General de Aduanas, mediante su Artículo 6, modificó de cinco (5) a diez (10) años la sanción penal de privación de libertad a los delitos previstos en el Articulo precedente.

                    Estas penas serán establecidas sin perjuicio de imponer inhabilitación especial.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Artículo 50, señala lo siguiente:

                    "ARTÍCULO 50 (RESULTADOS DEL AFORO). Se modifica el Párrafo Tercero del Artículo 108 del Reglamento a la Ley General de Aduanas, con el siguiente texto:
                    "Cuando la observación en el Acta de Reconocimiento establezca disminución u omisión en el pago de los tributos aduaneros por una cuantía menor a Cincuenta mil Unidades de Fomento de la Vivienda (50.000 UFV's) o, siendo el monto igual o mayor a esta cuantía, no se hubiere configurado las conductas detalladas en el Artículo 178 de la Ley N° 2492, el consignatario podrá reintegrar los tributos aduaneros con el pago de la multa prevista en el Artículo 165 de la Ley N° 2492 o constituir garantía suficiente por el importe total para continuar con el despacho aduanero"".

                    <h4>ARTÍCULO 179</h4> (INSTIGACIÓN PÚBLICA A NO PAGAR TRIBUTOS). El que instigue públicamente a través de acciones de hecho, amenazas o maniobras a no pagar, rehusar, resistir o demorar el pago de tributos será sancionado con pena privativa de libertad de cinco (5) a diez (10) años y multa de 10.000 UFV's (Diez mil Unidades de Fomento de la Vivienda).

                    <h5>Nota del Editor:</h5>
                    Ley N° 037 de 10/08/2010; Ley que Modifica el Código Tributario y la Ley General de Aduanas, mediante su Artículo 6, modificó de cinco (5) a diez (10) años la sanción penal de privación de libertad a los delitos previstos en el Artículo precedente.

                    <h4>ARTÍCULO 180</h4> (VIOLACIÓN DE PRECINTOS Y OTROS CONTROLES TRIBUTARIOS). El que para continuar su actividad o evitar controles sobre la misma, violara, rompiera o destruyera precintos y demás medios de control o instrumentos de medición o de seguridad establecidos mediante norma previa por la Administración Tributaria respectiva, utilizados para el cumplimiento de clausuras o para la correcta liquidación, verificación, fiscalización, determinación o cobro del tributo, será sancionado con pena privativa de libertad de tres (3) a cinco (5) años y multa de 6.000 UFV's (seis mil Unidades de Fomento de la Vivienda).
                    En el caso de daño o destrucción de instrumentos de medición, el sujeto pasivo deberá además reponer los mismos o pagar el monto equivalente, costos de instalación y funcionamiento.

                    <h4>ARTÍCULO 181</h4> (CONTRABANDO). Comete contrabando el que incurra en alguna de las conductas descritas a continuación:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Introducir o extraer mercancías a territorio aduanero nacional en forma clandestina o por rutas u horarios no habilitados, eludiendo el control aduanero. Será considerado también autor del delito el consignatario o propietario de dicha mercancía.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Realizar tráfico de mercancías sin la documentación legal o infringiendo los requisitos esenciales exigidos por normas aduaneras o por disposiciones especiales.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Realizar transbordo de mercancías sin autorización previa de la Administración Tributaria, salvo fuerza mayor comunicada en el día a la Administración Tributaria más próxima.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) El transportador, que descargue o entregue mercancías en lugares distintos a la aduana, sin autorización previa de la Administración Tributaria.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) El que retire o permita retirar de la zona primaria mercancías no comprendidas en la Declaración de Mercancías que ampare el régimen aduanero al que debieran ser sometidas.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) El que introduzca, extraiga del territorio aduanero nacional, se encuentre en posesión o comercialice mercancías cuya importación o exportación, según sea el caso, se encuentre prohibida.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;g) La tenencia o comercialización de mercancías extranjeras sin que previamente hubieren sido sometidas a un régimen aduanero que lo permita.

                    El contrabando no quedará desvirtuado aunque las mercancías no estén gravadas con el pago de tributos aduaneros.

                    Las sanciones aplicables en sentencia por el Tribunal de Sentencia en materia tributaria, son:

                    <br>I. Privación de libertad de ocho (8) a doce (12) años, cuando el valor de los tributos omitidos de la mercancía decomisada sea superior a UFV's200.000 (Doscientos Mil Unidades de Fomento de Vivienda) establecido en la valoración y liquidación que realice la administración tributaria.

                    <h5>Nota del Editor:</h5>
                    Ley N° 1053 de 25/04/2018; Ley de Fortalecimiento de la Lucha contra el Contrabando, en sus Disposiciones Adicionales Primera, Parágrafo II modificó el Parágrafo precedente.

                    <br>II. Comiso de mercancías. Cuando las mercancías no puedan ser objeto de comiso, la sanción económica consistirá en el pago de una multa igual a cien por ciento (100%) del valor de las mercancías objeto de contrabando.

                    <h5>Nota del Editor:</h5>
                    Ley N° 100 de 04/04/2011, en su Artículo 21, Parágrafo II, modificó el Numeral II precedente.

                    <br>III. Comiso de los medios o unidades de transporte o cualquier otro instrumento que hubiera servido para el contrabando, excepto de aquellos sobre los cuales el Estado tenga participación, en cuyo caso los servidores públicos conforme a normativa vigente, estarán sujetos a la responsabilidad penal establecida en la presente Ley, sin perjuicio de las responsabilidades de la Ley N° 1178 o las leyes en vigencia.

                    Cuando el valor de los tributos omitidos de la mercancía sea igual o menor a UFV's200.000 (Doscientos Mil Unidades de Fomento de Vivienda), se aplicará la multa del cincuenta por ciento (50%) del valor de la mercancía en sustitución del comiso del medio o unidad de transporte.

                    Cuando las empresas de transporte aéreo o férreo autorizadas por la Administración Tributaria para el transporte de carga utilicen sus medios y unidades de transporte para cometer delito de Contrabando, se aplicará al transportador internacional una multa equivalente al cien por ciento (100%) del valor de la mercancía decomisada en sustitución de la sanción de comiso del medio de transporte. Si la unidad o medio de transporte no tuviere autorización de la Administración Tributaria para transporte internacional de carga o fuere objeto de contrabando, se le aplicará la sanción de comiso definitivo.

                    <h5>Nota del Editor:</h5>
                    Ley N° 1053 de 25/04/2018; Ley de Fortalecimiento de la Lucha contra el Contrabando, en sus Disposiciones Adicionales Primera, Parágrafo II modificó el Parágrafo precedente

                    <br>IV. Se aplicará la sanción accesoria de inhabilitación especial, sólo en los casos de contrabando sancionados con pena privativa de libertad.
                    Cuando el valor de los tributos omitidos de la mercancía objeto de contrabando, sea igual o menor a UFV's200.000 (Doscientos Mil Unidades de Fomento de Vivienda), la conducta se considerará contravención tributaria debiendo aplicarse el procedimiento establecido en el Capítulo III del Título IV del presente Código; salvo concurra reincidencia, intimidación, violencia, empleo de armas o explosivos en su comisión, en cuyo caso la conducta constituirá delito de contrabando, correspondiendo su investigación, juzgamiento y sanción penal.
                    La salvedad prevista en el párrafo precedente no se aplicará cuando exista reincidencia en la falta de presentación de alguno de los requisitos esenciales exigidos por normas aduaneras o por disposiciones especiales.

                    <h5>Nota del Editor:</h5>
                    Ley N° 1053 de 25/04/2018; Ley de Fortalecimiento de la Lucha contra el Contrabando, en sus Disposiciones Adicionales Primera, Parágrafo II modificó el Parágrafo precedente.

                    <br>V. Quienes importen mercancías con respaldo parcial, serán procesados por el delito de contrabando por el total de las mismas.

                    <h5>Nota del Editor:</h5>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i) Ley N° 100 de 04/04/2011, en su Artículo 21, Parágrafo III, incorporó el Parágrafo precedente.

                    ii) Ley N° 037 de 10/08/2010; Ley que Modifica el Código Tributario y la Ley General de Aduanas, mediante su Artículo 6, modificó de cinco (5) a diez (10) años la sanción penal de privación de libertad a los delitos previstos en el Articulo precedente.

                    <h4>ARTÍCULO 181 Bis</h4> Comete delito de usurpación de funciones aduaneras, quien ejerza atribuciones de funcionario o empleado público aduanero o de auxiliar de la función pública aduanera, sin estar debidamente autorizado o designado para hacerlo y habilitado mediante los registros correspondientes, causando perjuicio al Estado o a los particulares. Este delito será sancionado con privación de libertad de seis (6) a diez (10) años.

                    <h5>Nota del Editor:</h5>
                    Ley N° 1053 de 25/04/2018; Ley de Fortalecimiento de la Lucha contra el Contrabando, en sus Disposiciones Adicionales Primera, Parágrafo III modificó el Artículo precedente.

                    <h4>ARTÍCULO 181 Ter</h4> Comete delito de sustracción de prenda aduanera el que mediante cualquier medio sustraiga o se apoderare ilegítimamente de mercancías que constituyen prenda aduanera. Este delito será sancionado con privación de libertad de seis (6) a diez (10) años, con el resarcimiento de los daños y perjuicios, y la restitución de las mercancías o su equivalente a favor del consignante, consignatario o propietario de las mismas, incluyendo el pago de los tributos aduaneros.

                    En el caso de los depósitos aduaneros, el resarcimiento tributario se sujetará a los términos de los respectivos contratos de concesión o administración.

                    Incurre en el mismo delito, el que sustraiga las mercancías decomisadas sea durante el operativo del control aduanero, su traslado o mientras éstas se encuentren almacenadas en los predios autorizados por la Aduana Nacional. En estos casos el resarcimiento de los daños y perjuicios, la restitución de las mercancías o su equivalente, incluido el pago de tributos, será a favor de la Administración Aduanera.

                    <h5>Nota del Editor:</h5>
                    Ley N° 1053 de 25/04/2018; Ley de Fortalecimiento de la Lucha contra el Contrabando, en sus Disposiciones Adicionales Primera, Parágrafo IV modificó el Artículo precedente.

                    <h4>ARTÍCULO 181 Quater</h4> Comete delito de falsificación de documentos aduaneros, el que falsifique o altere documentos, declaraciones o registros informáticos aduaneros. Este delito será sancionado con privación de libertad de seis (6) a diez (10) años.

                    <h5>Nota del Editor:</h5>
                    Ley N° 1053 de 25/04/2018; Ley de Fortalecimiento de la Lucha contra el Contrabando, en sus Disposiciones Adicionales Primera, Parágrafo V modificó el Artículo precedente.

                    <h4>ARTÍCULO 181 Quinquies</h4> Cometen delito de asociación delictiva aduanera los funcionarios o servidores públicos aduaneros, los auxiliares de la función pública aduanera, los transportadores internacionales, los concesionarios de depósitos aduaneros o de otras actividades o servicios Este delito será sancionado con privación de libertad de seis (6) a diez (10) años.
                    Este delito será sancionado con privación de libertad de seis (6) a diez (10) años.

                    <h5>Nota del Editor:</h5>
                    Ley N° 1053 de 25/04/2018; Ley de Fortalecimiento de la Lucha contra el Contrabando, en sus Disposiciones Adicionales Primera, Parágrafo VI modificó el Artículo precedente.

                    <h4>ARTÍCULO 181 Sexies</h4> Comete delito de falsedad aduanera el servidor público y/o los auxiliares de la función pública aduanera que posibilite y facilite a terceros la importación o exportación de mercancías que estén prohibidas por Ley expresa, o posibilite la exoneración o disminución indebida de tributos aduaneros, así como los que informan o certifican falsamente sobre la persona del importador o exportador o sobre la calidad, cantidad, precio, origen embarque o destino de las mercancías.
                    Este delito será sancionado con privación de libertad de seis (6) a diez (10) años.

                    <h5>Nota del Editor:</h5>
                    Ley N° 1053 de 25/04/2018; Ley de Fortalecimiento de la Lucha contra el Contrabando, en sus Disposiciones Adicionales Primera, Parágrafo VII modificó el Artículo precedente.

                    <h4>ARTÍCULO 181 Septies</h4> Comete delito de cohecho activo aduanero cuando una persona natural o jurídica oferta o entrega un beneficio a un funcionario con el fin de que contribuya a la comisión del delito, quien será sancionado con privación de libertad de seis (6) a diez (10) años.
                    El cohecho pasivo se produce con la aceptación del servidor aduanero y el incumplimiento de sus funciones a fin de facilitar la comisión del delito aduanero, será sancionado con privación de libertad de seis (6) a diez (10) años.

                    <h5>Nota del Editor:</h5>
                    Ley N° 1053 de 25/04/2018; Ley de Fortalecimiento de la Lucha contra el Contrabando, en sus Disposiciones Adicionales Primera, Parágrafo VIII modificó el Artículo precedente.

                    <h4>ARTÍCULO 181 Octies</h4> Comete tráfico de influencias en la actividad aduanera la autoridad y/o servidor público de la Aduana Nacional que, directamente o a través de un tercero, aprovechando la función o cargo que ocupa, contribuya, facilite o influya en la comisión de los delitos descritos anteriormente, a cambio de una contraprestación monetaria o de un beneficio vinculado al acto antijurídico.
                    Este delito será sancionado con privación de libertad de seis (6) a diez (10) años.

                    <h5>Nota del Editor:</h5>
                    Ley N° 1053 de 25/04/2018; Ley de Fortalecimiento de la Lucha contra el Contrabando, en sus Disposiciones Adicionales Primera, Parágrafo IX modificó el Artículo precedente.

                    <h4>ARTÍCULO 181 Nonies</h4> (DELITO DE CONTRABANDO DE EXPORTACIÓN AGRAVADO). Comete delito de contrabando de exportación agravado, el que sin portar la autorización de la instancia correspondiente, incurra en cualquiera de las siguientes conductas:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Extraiga desde territorio aduanero nacional o zonas francas, mercancías prohibidas o suspendidas de exportación, hidrocarburos y/o alimentos con subvención directa del Estado sujetas a protección específica.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Intente extraer mercancías prohibidas o suspendidas de exportación, e hidrocarburos y alimentos con subvención directa del Estado sujetas a protección específica, mediante actos idóneos o inequívocos desde territorio aduanero nacional o zonas francas, y no logre consumar el delito por causas ajenas a su voluntad.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Almacene mercancías prohibidas o suspendidas de exportación, hidrocarburos y/o alimentos con subvención directa del Estado sujetas a protección específica, sin cumplir los requisitos legales dentro un espacio de cincuenta (50) kilómetros desde la frontera.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. Transporte mercancías prohibidas o suspendidas de exportación, hidrocarburos y/o alimentos con subvención directa del Estado sujetas a protección específica, sin cumplir los requisitos legales dentro un espacio de cincuenta (50) kilómetros desde la frontera.

                    Este delito será sancionado con privación de libertad de diez (10) a catorce (14) años y el decomiso de las mercancías y la confiscación de los instrumentos del delito.

                    <h5>Nota del Editor:</h5>
                    Ley N° 1053 de 25/04/2018; Ley de Fortalecimiento de la Lucha contra el Contrabando, en sus Disposiciones Adicionales Primera, Parágrafo X modificó el Artículo precedente.

                    <h4>ARTÍCULO 181 Decies</h4> (FAVORECIMIENTO Y FACILITACIÓN DEL CONTRABANDO). Comete delito de favorecimiento y facilitación del contrabando la persona que, en el marco de un operativo de acción directa de lucha contra el contrabando, favorezca, facilite, coadyuve o encubra la comisión de un ilícito de contrabando mediante el tránsito, tenencia, recepción, destrucción u ocultación de las mercancías o instrumentos del ilícito. Este delito será sancionado con privación de libertad de cuatro (4) a ocho (8) años.

                    <h5>Nota del Editor:</h5>
                    Ley N° 1053 de 25/04/2018; Ley de Fortalecimiento de la Lucha contra el Contrabando, en sus Disposiciones Adicionales Segunda, Parágrafo I incorporó el Artículo precedente.

                    <h3>CAPÍTULO V
                        PROCEDIMIENTO PENAL TRIBUTARIO</h3>

                    <h4>SECCIÓN I: DISPOSICIONES GENERALES</h4>

                    <h4>ARTÍCULO 182</h4> (NORMATIVA APLICABLE). La tramitación de procesos penales por delitos tributarios se regirá por las normas establecidas en el Código de Procedimiento Penal, con las salvedades dispuestas en el presente Código.

                    <h4>SECCIÓN II:
                        ESPECIFICIDADES EN EL PROCESO PENAL TRIBUTARIO</h4>

                    <h4>ARTÍCULO 183</h4> (ACCIÓN PENAL POR DELITOS TRIBUTARIOS). La acción penal tributaria es de orden público y será ejercida de oficio por el Ministerio Público, con la participación que este Código reconoce a la Administración Tributaria acreedora de la deuda tributaria en calidad de víctima, que podrá constituirse en querellante. El ejercicio de la acción penal tributaria no se podrá suspender, interrumpir ni hacer cesar, salvo los casos previstos en el Código de Procedimiento Penal.

                    <h4>ARTÍCULO 184</h4> (JURISDICCIÓN PENAL TRIBUTARIA). En cumplimiento de lo establecido en el Artículo 43 del Código de Procedimiento Penal, los Tribunales de Sentencia en Materia Tributaria estarán compuestos por dos jueces técnicos especializados en materia tributaria y tres jueces ciudadanos.

                    Tanto los Tribunales de Sentencia en Materia Tributaria como los Jueces de Instrucción en materia penal tributaria tendrán competencia departamental y asiento judicial en las capitales de departamento.

                    <h5>Nota del Editor:</h5>

                    Ley N° 3092 de 07/07/2005, en su Disposición Transitoria, complementó el Artículo precedente.

                    "DISPOSICIÓN TRANSITORIA

                    En tanto se designe a los Tribunales de Sentencia en Materia Tributaria como a los Jueces

                    de Instrucción en Materia Penal Tributaria conforme a lo dispuesto en el Artículo 184 de
                    la presente Ley en el marco de sus competencias, los actuales Tribunales de Sentencia y los Jueces de Instrucción con asiento judicial en las capitales de Departamento, tendrán competencia departamental para conocer los procesos penales que se instauren o sustancien por la comisión de delitos tributarios".

                    <h4>ARTÍCULO 185</h4> (DIRECCIÓN Y ORGANO TÉCNICO DE INVESTIGACIÓN). El Ministerio Público dirigirá la investigación de los delitos tributarios y promoverá la acción penal tributaria ante los órganos jurisdiccionales, con el auxilio de equipos multidisciplinarios de investigación de la Administración Tributaria, de acuerdo con las atribuciones, funciones y responsabilidades establecidas en el presente Código, el Código de Procedimiento Penal y la Ley Orgánica del Ministerio Público.

                    Los equipos multidisciplinarios de investigación de la Administración Tributaria son el órgano técnico de investigación de los ilícitos tributarios, actuarán directamente o bajo dirección del Ministerio Público.

                    La Administración Tributaria para el cumplimiento de sus funciones podrá solicitar la colaboración de la Policía Nacional y del Instituto de Investigaciones Forenses.

                    <h4>ARTÍCULO 186</h4> (ACCIÓN PREVENTIVA).

                    <br>I. Cuando la Administración Tributaria Aduanera tenga conocimiento, por cualquier medio, de la comisión del delito de contrabando o de otro delito tributario aduanero, procederá directamente o bajo la dirección del fiscal al arresto de los presentes en el lugar del hecho, a la aprehensión de los presuntos autores o participes y al comiso preventivo de las mercancías, medios e instrumentos del delito, acumulará y asegurará las pruebas, ejecutará las diligencias y actuaciones que serán dispuestas por el fiscal que dirija la investigación, así como ejercerá amplias facultades de investigación en la acción preventiva y durante la etapa preparatoria, pudiendo al efecto requerir el auxilio de la fuerza pública.

                    Cuando el fiscal no hubiere participado en el operativo, las personas aprehendidas serán puestas a su disposición dentro las ocho horas siguientes, asimismo se le comunicará sobre las mercancías, medios y unidades de transporte decomisados preventivamente, para que asuma la dirección funcional de la investigación y solicite al Juez de la Instrucción en lo Penal la medida cautelar que corresponda.

                    Cuando la aprehensión se realice en lugares distantes a la sede del fiscal o de la autoridad jurisdiccional competente, para el cómputo de los plazos se aplicará el término de la distancia previsto en el Código de Procedimiento Civil.

                    En el caso de otras Administraciones Tributarias, la acción preventiva sólo se ejercitará cuando el delito sea flagrante.

                    <br>II. Cuando en la etapa de la investigación existan elementos de juicio que hagan presumir la fuga del o de los imputados y si las medidas cautelares que se adopten no garantizaran la presencia de éstos en la investigación o juicio penal, el Ministerio Público o la Administración Tributaria solicitarán a la autoridad judicial competente la detención preventiva del o los imputados, con auxilio de la fuerza pública, sin que aquello implique prejuzgamiento.

                    <h4>ARTÍCULO 187</h4> (ACTA DE INTERVENCIÓN EN DELITOS TRIBUTARIOS ADUANEROS).
                    La Administración Tributaria Aduanera documentará su intervención en un acta en la que constará:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) La identificación de la autoridad administrativa que efectuó la intervención y del Fiscal, si intervino.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Una relación circunstanciada de los hechos, con especificación de tiempo y lugar.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) La identificación de las personas aprehendidas; de las sindicadas como autores, cómplices o encubridores del delito aduanero si fuera posible.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) La identificación de los elementos de prueba asegurados y, en su caso, de los medios empleados para la comisión del delito.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) El detalle de la mercancía decomisada y de los instrumentos incautados.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) Otros antecedentes, elementos y medios que sean pertinentes.

                    En el plazo de 48 horas, la Administración Tributaria Aduanera y el Fiscal, informarán al Juez competente respecto a las mercancías, medios y unidades de transporte decomisados y las personas aprehendidas, sin que ello signifique comprometer la imparcialidad de la autoridad jurisdiccional.

                    <h4>ARTÍCULO 188</h4> (MEDIDAS CAUTELARES). Las medidas cautelares de carácter personal se sujetarán a las disposiciones y reglas del Código de Procedimiento Penal.

                    Se podrán aplicar las siguientes medidas cautelares de carácter real:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Decomiso preventivo de las mercancías, medios de transporte e instrumentos utilizados en la comisión del delito o vinculados al objeto del tributo, que forma parte de la deuda tributaria en ejecución;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Retención de valores por devoluciones tributarias o de otros pagos que deba realizar el Estado y terceros privados, en la cuantía necesaria para asegurar el cobro de la deuda tributaria;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Anotación preventiva en los registros públicos sobre los bienes, derechos y acciones de los responsables o participes del delito tributario y del civilmente responsable;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;4. Embargo de los bienes del imputado;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;5. Retención de depósitos de dinero o valores efectuados en entidades del sistema de intermediación financiera;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;6. Secuestro de los bienes del imputado;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;7. Intervención de la gestión del negocio del imputado, correspondiente a la deuda tributaria;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;8. Clausura del o los establecimientos o locales del deudor hasta el pago total de la deuda tributaria;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;9. Prohibición de celebrar actos o contratos de transferencia o disposición sobre bienes determinados;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;10. Hipoteca legal;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;11. Renovación de garantía si hubiera, por el tiempo aproximado que dure el proceso, bajo alternativa de ejecución de la misma;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;12. Otras dispuestas por Ley.

                    Las medidas cautelares se aplicarán con liberación del pago de valores, derechos y almacenaje que hubieran en los respectivos registros e instituciones públicas, y con diferimiento de pago en el caso de instituciones privadas.

                    <h4>ARTÍCULO 189</h4> (DEROGADO)

                    <h5>Nota del Editor:</h5>
                    Ley N° 317 de 11/12/2012; Ley del Presupuesto General del Estado Gestión 2013 mediante sus Disposiciones Derogatorias y Abrogatorias, Tercera, derogó el Artículo precedente.

                    <h4>ARTÍCULO 190</h4> (SUSPENSIÓN CONDICIONAL DEL PROCESO). En materia penal tributaria procederá la suspensión condicional del proceso en los términos establecidos en el Código de Procedimiento Penal con las siguientes particularidades:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Para los delitos de defraudación tributaria, defraudación aduanera o falsificación de documentos aduaneros, se entenderá por reparación integral del daño ocasionado, el pago de la deuda tributaria y la multa establecida para el delito correspondiente.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Para los delitos de contrabando o sustracción de prenda aduanera, se entenderá por reparación del daño ocasionado la renuncia en favor de la Administración Tributaria de la totalidad de la mercancía de contrabando o sustraída; en caso de no haberse decomisado la mercancía el pago del cien por ciento (100%) de su valor. Con relación al medio de transporte utilizado, el pago por parte del transportador del cincuenta por ciento (50%) del valor de la mercancía en sustitución del comiso del medio o unidad de transporte, salvo lo dispuesto en convenios internacionales suscritos por el Estado.

                    <h4>ARTÍCULO 191</h4> (CONTENIDO DE LA SENTENCIA CONDENATORIA). Cuando la sentencia sea condenatoria, el Tribunal de Sentencia impondrá, cuando corresponda:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) La privación de libertad.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) El comiso definitivo de las mercancías a favor del Estado, cuando corresponda.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) El comiso definitivo de los medios y unidades de transporte, cuando corresponda.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) La multa.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Otras sanciones accesorias.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) La obligación de pagar en suma líquida y exigible la deuda tributaria.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;g) El resarcimiento de los daños civiles ocasionados a la Administración Tributaria por el uso de depósitos aduaneros y otros gastos, así como las costas judiciales.

                    Las medidas cautelares reales se mantendrán subsistentes hasta el resarcimiento de los tributos y los daños civiles calificados.

                    <h4>ARTÍCULO 192</h4> (ADMINISTRACIÓN DE BIENES).

                    <br>I. Las mercancías decomisadas por ilícito de contrabando que cuenten con Resolución Sancionatoria emitida por la Administración Aduanera, serán adjudicadas por la Aduana Nacional mediante Declaración de Mercancías de Importación que tendrá un carácter simplificado, al Ministerio de la Presidencia, a título gratuito, exentas del pago de tributos aduaneros de importación, y los gastos concernientes al servicio de almacenaje y logística.

                    La interposición de cualquier recurso administrativo contra la Resolución Sancionatoria emitida por la Administración Aduanera, no paralizará el proceso de adjudicación de las mercancías a fin de evitar una mayor depreciación del valor de las mismas y/o descomposición por el transcurso del tiempo.

                    Las mercancías decomisadas por delito de contrabando, serán adjudicadas por la Aduana Nacional al Ministerio de la Presidencia, a título gratuito, exentas del pago de tributos aduaneros de importación, y los gastos concernientes al servicio de almacenaje y logística, previa comunicación al fiscal o a la autoridad jurisdiccional.

                    La obtención de certificados para el despacho aduanero de las mercancías a ser adjudicadas al Ministerio de la Presidencia, estará a cargo de la Aduana Nacional.

                    <h5>Nota del Editor:</h5>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i) Ley N° 975 de 13/09/2017; Ley de Modificaciones al Presupuesto General del Estad Gestión 2017, en sus Disposiciones Adicionales Sexta, modificó el Parágrafo precedente.
                    ii) Ley Nº 812 de 30/06/2016, en sus Disposiciones Finales Segunda, establece:

                    "SEGUNDA El Servicio de Impuestos Nacionales y la Aduana Nacional podrán establecer mecanismos de incentivos a la facturación y la generación de cultura tributaria, mediantela entrega de premios, incentivos o reconocimientos al contribuyente, usuarios y/o consumidores, de forma directa o a través de sorteos, juegos, actividades lúdicas, cualquierotro medio de acceso, ferias u otros, de acuerdo a reglamento específico.
                    Para estos fines, el Tesoro General de la Nación asignará recursos de acuerdo a disponibilidad financiera o en su caso se priorizará la entrega y/o transferencia de mercancías comisadas por contrabando y/o abandono, a través del procedimiento establecido en la Ley N° 615 de15 de diciembre de 2014 y su Reglamento".

                    La obtención de certificados para el despacho aduanero de las mercancías a ser adjudicadas al Ministerio de la Presidencia o al Ministerio de Economía y Finanzas Públicas, estará a cargo de la Aduana Nacional.

                    <br>II. En caso de alimentos frescos, verduras, frutas, hortalizas, lácteos y sus derivados, el Acta de Intervención deberá ser elaborada en un plazo no mayor a un (1) día hábil posterior a la intervención. La Resolución Sancionatoria o Determinativa deberá ser emitida en un plazo no mayor a tres (3) días hábiles después de formulada dicha Acta de Intervención. En caso que estos alimentos frescos requieran certificados para el despacho aduanero, de forma paralela al acta de intervención, la Administración Aduanera solicitará la certificación oficial del órgano competente, la cual deberá ser emitida en un plazo no mayor a tres (3) días hábiles a partir de su requerimiento, bajo responsabilidad del Ministerio cabeza de sector.

                    <br>III. En caso de alimentos, definidos por Reglamento, el Acta de Intervención deberá ser elaborado en un plazo no mayor a tres (3) días hábiles posteriores a la intervención. La Resolución Sancionatoria o Determinativa deberá ser emitida en un plazo no mayor a tres (3) días hábiles después de formulada dicha Acta de Intervención. En caso que estas mercancías requieran certificados para el despacho aduanero, la Administración Aduanera, al día siguiente hábil de emitida la Resolución Sancionatoria o Determinativa, solicitará la certificación oficial del órgano competente, la cual deberá ser emitida en un plazo no mayor a diez (10) días hábiles a partir de su requerimiento, bajo responsabilidad del Ministerio cabeza de sector.

                    <br>IV. En caso de mercancías perecederas, alimentos enlatados y otro tipo de mercancías, el Acta de Intervención deberá ser elaborado en un plazo no mayor a tres (3) días hábiles posteriores a la intervención. La Resolución Sancionatoria o Determinativa deberá ser emitida en un plazo no mayor a tres (3) días hábiles después de formulada dicha Acta de Intervención. En caso que estas mercancías requieran certificados para el despacho aduanero, la Administración Aduanera, al día siguiente hábil de emitida la Resolución Sancionatoria o Determinativa, solicitará la certificación oficial del órgano competente, la cual deberá ser emitida en un plazo no mayor a diecisiete (17) días hábiles a partir de su requerimiento, bajo responsabilidad del Ministerio cabeza de sector.

                    <br>V. Los vehículos, aeronaves y otros motorizados confiscados por los delitos de sustancias controladas,

                    <h5>Nota del Editor:</h5>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i) Ley N° 913 de 16/03/2017; Ley de Lucha Contra el Tráfico Ilícito de Sustancias Controladas, en sus Disposiciones Adicionales Tercera, incorporó el Parágrafo precedente.
                    ii) Ley N° 615 de 15/12/2014; Ley que Modifica el Código Tributario Boliviano y la Ley General de Aduanas, en su Artículo 2, modificó el Artículo precedente.
                    iii) Ley N° 975 de 13/09/2017; Ley de Modificaciones al Presupuesto General del Estad Gestión 2017, mediante sus Disposiciones Adicionales Octava, modificó el Artículo 4 de la Ley Nº 615 de 15/12/2014, Procedimiento para la Adjudicación, Entrega y Destrucción de las Mercancías, se deberá considerar lo siguiente:

                    "e) Las mercancías adjudicadas al Ministerio de la Presidencia, deberán ser retiradas de los recintos aduaneros en un plazo de treinta (30) días hábiles administrativos posteriores a la entrega oficial de la Declaración de Mercancías, pudiendo solicitar la ampliación de dicho plazo por única vez por el lapso de quince (15) días hábiles administrativos, caso contrario vencidos los plazos señalados, la Aduana Nacional destinará las mercancías a las subastas públicas, previa anulación de la Resolución de Adjudicación y la Declaración Única de Importación.

                    En el caso de las mercancías establecidas en los Parágrafos II, III y IV del Artículo 192 de la Ley N° 2492 de 2 de agosto de 2003, "Código Tributario Boliviano", serán adjudicadas en el plazo máximo de hasta cinco (5) días hábiles y el Ministerio de la Presidencia deberá recoger las mercancías en el plazo máximo de hasta cinco (5) días hábiles.

                    Los adjudicatarios de mercancías mediante subasta pública, deben retirar las mismas de los recintos aduaneros en un plazo máximo de quince (15) días hábiles administrativos"

                    iv) Ley N° 317 de 11/12/2012; Ley del Presupuesto General del Estado Gestión 2013, mediante sus Disposiciones Transitorias Tercera, Cuarta, y Disposiciones Finales Tercera, Cuarta, Quinta, Sexta y Séptima establece la adjudicación a favor del Ministerio de la Presidencia y Ministerio de Salud y Deportes, de mercancías decomisadas por ilícito de contrabando:

                    DISPOSICIONES TRANSITORIAS:

                    "TERCERA. Las mercancías que tengan Resolución de Adjudicación proveniente del proceso de remate, deberán culminar su proceso conforme al procedimiento anterior.
                    CUARTA. Las mercancías decomisadas por ilícito de contrabando que cuenten con sentencia ejecutoriada o resolución firme, que a la fecha de publicación de la presente Ley se encuentren en depósitos aduaneros, serán adjudicadas por la Aduana Nacional al Ministerio de la Presidencia o al Ministerio de Salud y Deportes, según corresponda, a título gratuito y exento del pago de tributos aduaneros de importación, en un plazo no mayor a cinco (5) días hábiles administrativos siguientes a la fecha de publicación de la presente Ley, bajo responsabilidad funcionaria".

                    DISPOSICIONES FINALES:

                    "TERCERA. Las mercancías adjudicadas al Ministerio de la Presidencia y al Ministerio de Salud y Deportes, no estarán sujetas al pago de los gastos concernientes al servicio de almacenaje.

                    CUARTA. La obtención de certificaciones de las mercancías adjudicadas al Ministerio de la Presidencia y al Ministerio de Salud y Deportes, estarán a cargo de dichas entidades.

                    QUINTA. El Ministerio de la Presidencia y el Ministerio de Salud y Deportes, deberán retirar las mercancías adjudicadas, en un plazo no mayor a quince (15) días hábiles administrativos posteriores a la notificación de la Resolución de adjudicación, computables a partir del siguiente día hábil de dicha notificación.

                    SEXTA. Las mercancías adjudicadas al Ministerio de la Presidencia y al Ministerio de Salud y Deportes, podrán ser transferidas a título gratuito, a instituciones del sector público, organizaciones sin fines de lucro o distribuida gratuitamente a la población. Las mercancías transferidas a entidades públicas deberán ser registradas por parte de la entidad beneficiaria, en sus activos fijos, según corresponda.

                    SÉPTIMA. La Aduana Nacional no podrá adjudicar a ninguna institución pública o Privada, animales vivos o plantas, frutos, semillas afectadas por enfermedades; productos alimenticios, bebidas, líquidos alcohólicos, en estado de descomposición, adulterados o que contengan sustancias nocivas a la salud; materiales tóxicos, radiactivos, desechos mineralógicos contaminantes, ropa usada, cigarrillos o tabacos; y otras mercancías abandonadas o comisadas, en razón de su naturaleza peligrosa o nociva. Estas mercancías deberán ser destruidas por la administración aduanera en coordinación con las instancias competentes, en un plazo no superior a cuarenta y cinco (45) días corridos posteriores a la emisión de la Resolución respectiva".


                    <h4>ARTÍCULO 192 bis</h4> (DEROGADO).

                    <h5>Nota del Editor:</h5>
                    Ley N° 317 de 11/12/2012; Ley del Presupuesto General del Estado Gestión 2013, mediante su Disposición Derogatoria y Abrogatoria, Segunda, derogó el Artículo precedente. Previamente incorporado por Ley N° 037 de 10/08/2010; Ley que Modifica el Código Tributario y la Ley General de Aduanas, a través de su Artículo 5.

                    <h3>Título V
                        PROCEDIMIENTO PARA EL CONOCIMIENTO Y RESOLUCIÓN DE LOS RECURSOS DE ALZADA Y JERÁRQUICO, APLICABLES ANTE LA SUPERINTENDENCIA TRIBUTARIA</h3>

                    <h3>CAPÍTULO I
                        DISPOSICIONES GENERALES</h3>

                    <h5>Nota del Editor:</h5>
                    Ley N° 3092 de 07/07/2005, en su Artículo 1 incorporó al Código Tributario Boliviano, el TÍTULO V PROCEDIMIENTO PARA EL CONOCIMIENTO Y RESOLUCIÓNDE LOS RECURSOS DE ALZADA Y JERÁRQUICO, APLICABLES ANTE LA SUPERINTENDENCIA TRIBUTARIA.

                    <h4>SECCIÓN I: L
                        COMPETENCIA TERRITORIA</h4>

                    <h4>ARTÍCULO 193</h4> (COMPETENCIA TERRITORIAL).

                    <br>I. Cada Intendente Departamental tiene competencia sobre el Departamento en cuya capital tiene sede; está a su cargo dirigir la Intendencia Departamental de la que es titular, con las atribuciones y funciones que le otorga la presente Ley.

                    <br>II. Cada Superintendente Tributario Regional tiene competencia sobre el Departamento en cuya capital tiene sede y sobre el o los Departamentos constituidos en Intendencia Departamental que se le asigne mediante Decreto Supremo, con las atribuciones y funciones que le otorga la presente Ley.

                    <br>III. El Superintendente Tributario General tiene competencia en todo el territorio de la República, con las atribuciones y funciones que le otorga la presente Ley.

                    <br>IV. Los procedimientos internos para el trámite de los recursos en la Superintendencia Tributaria serán aprobados por el Superintendente Tributario General, en aplicación de las atribuciones que le otorga la presente Ley.

                    <h4>ARTÍCULO 194</h4> (NO REVISIÓN POR OTROS ÓRGANOS DEL PODER EJECUTIVO). Las Resoluciones dictadas en los Recursos de Alzada y Jerárquico por la Superintendencia Tributaria, como órgano resolutivo de última instancia administrativa, contemplan la decisión expresa, positiva y precisa de las cuestiones planteadas y constituyen decisiones basadas en hechos sometidos al Derecho y en consecuencia no están sujetas a revisión por otros órganos del Poder Ejecutivo.


                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 4, señala lo siguiente:
                    "ARTÍCULO 4 (NO REVISIÓN POR OTROS ÓRGANOS DEL PODER EJECUTIVO). Las resoluciones dictadas en los recursos de alzada y jerárquico por la Superintendencia Tributaria, como órgano resolutivo de última instancia administrativa, contemplan la decisión expresa, positiva y precisa de las cuestiones planteadas y constituyen decisiones basadas en hechos sometidos al derecho y en consecuencia no están sujetas a revisión por otros órganos del Poder Ejecutivo".

                    <h3>CAPÍTULO II
                        DE LOS PROCEDIMIENTOS APLICABLES ANTE LA SUPERINTENDENCIA TRIBUTARIA</h3>

                    <h4>SECCIÓN I: RECURSOS ADMINISTRATIVOS</h4>

                    <h4>ARTÍCULO 195</h4> (RECURSOS ADMISIBLES).

                    <br>I. Ante la Superintendencia Tributaria son admisibles únicamente los siguientes Recursos Administrativos:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Recurso de Alzada; y,
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Recurso Jerárquico.
                    <br>II. El Recurso de Alzada no es admisible contra medidas internas, preparatorias de decisiones administrativas, incluyendo informes y Vistas de Cargo u otras actuaciones administrativas previas incluidas las Medidas Precautorias que se adoptaren a la Ejecución Tributaria ni contra ninguno de los títulos señalados en el Artículo 108 del presente Código ni contra los autos que se dicten a consecuencia de las oposiciones previstas en el parágrafo II del Artículo 109 de este mismo Código, salvo en los casos en que se deniegue la Compensación opuesta por el deudor.
                    <br>III. El Recurso Jerárquico solamente es admisible contra la Resolución que resuelve el Recurso de Alzada.
                    <br>IV. La interposición del Recurso de Alzada, así como el del Jerárquico, tienen efecto suspensivo.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 5, señala lo siguiente:
                    "ARTÍCULO 5 (RECURSOS ADMISIBLES).
                    <br>I. Ante la Superintendencia Tributaria son admisibles únicamente los siguientes Recursos Administrativos:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Recurso de Alzada. b) Recurso Jerárquico.
                    <br>II. El Recurso de Alzada es admisible solo contra los siguientes actos definitivos de la Administración Tributaria de alcance particular:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Las resoluciones determinativas.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Las resoluciones sancionatorias.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Las resoluciones que denieguen total o parcialmente solicitudes de exención, compensación, repetición o devolución de impuestos.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Las resoluciones que exijan restitución de lo indebidamente devuelto en los casos de devoluciones impositivas.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Los actos que declaren la responsabilidad de terceras personas en el pago de obligaciones tributarias en defecto o en lugar del sujeto pasivo.
                    Los actos definitivos emitidos por la administración tributaria de alcance particular no previstos en los literales precedentes se tramitaran conforme a la Ley de Procedimiento Administrativo y su reglamento.
                    El Recurso de Alzada no es admisible contra medidas internas, preparatorias de decisiones administrativas, incluyendo informes y Vistas de Cargo u otras actuaciones administrativas previas incluidas las Medidas Precautorias que se adoptaren a la Ejecución Tributaria ni contra ninguno de los títulos señalados en el Artículo 108 del Código Tributario Boliviano ni contra los autos que se dicten a consecuencia de las oposiciones previstas en el Parágrafo II del Artículo 109 del citado Código, salvo en los casos en que se deniegue la Compensación opuesta por el deudor.
                    <br>III. El Recurso Jerárquico solamente es admisible contra la resolución que resuelve el Recurso de Alzada".

                    <h4>ARTÍCULO 196</h4> (AUTORIDAD ANTE LA QUE DEBEN PRESENTARSE LOS RECURSOS).

                    <br>I. El Recurso de Alzada debe presentarse ante el Superintendente Tributario Regional a cuya jurisdicción está sujeta la autoridad administrativa cuyo acto definitivo es objeto de la impugnación, directamente en oficinas de la respectiva Superintendencia Tributaria Regional o a través de la Intendencia Departamental correspondiente.
                    <br>II. El Recurso Jerárquico debe presentarse ante el Superintendente Tributario Regional que emitió la Resolución impugnada, directamente en oficinas de la respectiva Superintendencia Tributaria Regional o a través de la Intendencia Departamental correspondiente. Una vez admitido este Recurso, el expediente será remitido por el Superintendente Tributario Regional actuante al Superintendente Tributario General para su resolución.
                    <br>III. A solicitud justificada del Superintendente Tributario Regional, el Superintendente Tributario General podrá autorizar el establecimiento de oficinas locales de recepción de los recursos administrativos en las localidades donde el volumen de casos lo haga necesario para facilitar el acceso a estos recursos.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 6, señala lo siguiente:
                    "ARTÍCULO 6 (AUTORIDAD ANTE LA QUE DEBEN PRESENTARSE LOS RECURSOS).
                    <br>I. El Recurso de Alzada debe presentarse ante el Superintendente Tributario Regional a cuya jurisdicción está sujeta la autoridad administrativa cuyo acto definitivo es objeto de la impugnación, directamente en oficinas de la respectiva Superintendencia Tributaria Regional o a través de la Intendencia Departamental correspondiente.
                    <br>II. El Recurso Jerárquico debe presentarse ante el Superintendente Tributario Regional que emitió la resolución impugnada, directamente en oficinas de la respectiva Superintendencia Tributaria Regional o a través de la Intendencia Departamental correspondiente. Una vez admitido este Recurso, el expediente será remitido por el Superintendente Tributario Regional actuante al Superintendente Tributario General para su resolución.
                    <br>III. A solicitud justificada del Superintendente Tributario Regional, el Superintendente Tributario General podrá autorizar el establecimiento de oficinas locales de recepción de los recursos administrativos en las localidades donde el volumen de casos lo haga necesario para facilitar el acceso a estos recursos".

                    <h4>ARTÍCULO 197</h4> (COMPETENCIA DE LA SUPERINTENDENCIA TRIBUTARIA).

                    <br>I. Los actos definitivos de alcance particular que se pretenda impugnar mediante el Recurso de Alzada, deben haber sido emitidos por una entidad pública que cumple funciones de
                    Administración Tributaria relativas a cualquier tributo nacional, departamental, municipal o universitario, sea impuesto, tasa, patente municipal o contribución especial, excepto las de seguridad social.

                    <br>II. No competen a la Superintendencia Tributaria:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) El control de constitucionalidad;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Las cuestiones de índole civil o penal atribuidas por la Ley a la jurisdicción ordinaria;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Las cuestiones que, así estén relacionadas con actos de la Administración Tributaria, estén atribuidas por disposición normativa a otras jurisdicciones;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Las decisiones sobre cuestiones de competencia entre la Administración Tributaria y las jurisdicciones ordinarias o especiales, ni las relativas a conflictos de atribuciones;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Conocer la impugnación de las normas administrativas dictadas con carácter general por la Administración Tributaria.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en sus Artículos 7, 2 y 3, señala lo siguiente:
                    "ARTÍCULO 7 (COMPETENCIA DE LA SUPERINTENDENCIA TRIBUTARIA).
                    <br>I. Los actos definitivos de alcance particular previstos en el Parágrafo II del Artículo 5 de este reglamento, deben haber sido emitidos por una entidad pública que cumple funciones de Administración Tributaria relativas a cualquier tributo nacional, departamental, municipal o universitario, sea impuesto, tasa, patente municipal o contribución especial, excepto las de seguridad social.

                    <br>II. No competen a la Superintendencia Tributaria:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) El control de constitucionalidad.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Las cuestiones de índole civil o penal atribuidas por la Ley a la jurisdicción ordinaria.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Las cuestiones que, así estén relacionadas con actos de la Administración Tributaria, estén atribuidas por disposición normativa a otras jurisdicciones.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Las decisiones sobre cuestiones de competencia entre la Administración Tributaria y las jurisdicciones ordinarias o especiales ni las relativas a conflictos de atribuciones.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Conocer la impugnación de las normas administrativas dictadas con carácter general por la Administración Tributaria".

                    "ARTÍCULO 2 (COMPOSICIÓN). La Superintendencia Tributaria está compuesta por un Superintendente Tributario General con sede en la ciudad de La Paz, cuatro (4) Superintendentes Tributarios Regionales con sede en las capitales de los Departamentos de Chuquisaca, La Paz, Santa Cruz y Cochabamba, respectivamente, y cinco (5) intendentes Departamentales, cada uno de ellos con asiento en las capitales de los Departamentos de Pando, Beni, Oruro, Tarija y Potosí".
                    "ARTÍCULO 3 (COMPETENCIA TERRITORIAL Y ESTRUCTURA).
                    <br>I. Cada intendente Departamental tiene competencia sobre el Departamento en cuya capital tiene sede; está a su cargo dirigir la intendencia Departamental de la que es titular, con las atribuciones y funciones que le otorgan la Ley y el presente Decreto Supremo.
                    <br>II. Cada Superintendente Tributario Regional tiene competencia sobre el Departamento en cuya capital tiene sede y sobre el o los Departamentos constituidos en intendencia Departamental con las atribuciones y funciones que le otorgan la Ley y el presente Decreto Supremo, conforme a lo siguiente:
                    • Superintendente Tributario Regional de Chuquisaca: Intendencia Departamental de Potosí.
                    • Superintendente Tributario Regional de La Paz: Intendencia Departamental de Oruro.
                    • Superintendente Tributario Regional de Santa Cruz: Intendencias Departamentales de Pando y Beni.
                    • Superintendente Tributario Regional de Cochabamba: Intendencia Departamental de Tarija.
                    <br>III. El Superintendente Tributario General tiene competencia en todo el territorio de la República; está a su cargo dirigir y representar la Superintendencia Tributaria General, con las atribuciones y funciones que le otorgan la Ley y el presente Decreto Supremo.
                    <br>IV. La estructura orgánica y funcional de la Superintendencia Tributaria General y las que corresponden a las Superintendencias Tributarias Regionales, serán aprobadas mediante Resolución Administrativa del Superintendente Tributario General, en aplicación de las atribuciones que le confiere el inciso i) del Artículo del Código Tributario Boliviano.
                    <br>V. Los procedimientos internos para el trámite de los recursos en la Superintendencia Tributaria serán aprobados por el Superintendente Tributario General, en aplicación de las atribuciones que le confiere el inciso f) del Artículo 139 del Código Tributario Boliviano".

                    <h4>ARTÍCULO 198</h4> (FORMA DE INTERPOSICIÓN DE LOS RECURSOS).

                    <br>I. Los Recursos de Alzada y Jerárquico deberán interponerse por escrito, mediante memorial o carta simple, debiendo contener:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Señalamiento específico del recurso administrativo y de la autoridad ante la que se lo interpone.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Nombre o razón social y domicilio del recurrente o de su representante legal con mandato legal expreso, acompañando el poder de representación que corresponda conforme a Ley y los documentos respaldatorios de la personería del recurrente.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Indicación de la autoridad que dictó el acto contra el que se recurre y el ejemplar original, copia o fotocopia del documento que contiene dicho acto.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Detalle de los montos impugnados por tributo y por período o fecha, según corresponda, así como la discriminación de los componentes de la deuda tributaria consignados en el acto contra el que se recurre.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Los fundamentos de hecho y/o de derecho, según sea el caso, en que se apoya la impugnación, fijando con claridad la razón de su impugnación, exponiendo fundadamente los agravios que se invoquen e indicando con precisión lo que se pide.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) En el Recurso Jerárquico, señalar el domicilio para que se practique la notificación con la Resolución que lo resuelva.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;g) Lugar, fecha y firma del recurrente.

                    <br>II. En los Recursos de Alzada, dentro de los cinco (5) días de presentado el recurso, el Superintendente Tributario Regional o el Intendente Departamental dictarán su admisión y dispondrán su notificación a la autoridad recurrida. Tratándose de Recursos Jerárquicos, no procede esta notificación al Superintendente Tributario Regional, sino, por disposición de éste o del Intendente Departamental respectivo y dentro del mismo plazo, a la autoridad administrativa cuyo acto fue objeto de impugnación en el recurso previo o al recurrente en el Recurso de Alzada, según corresponda. No será procedente la contestación al Recurso Jerárquico.

                    <br>III. La omisión de cualquiera de los requisitos señalados en el presente Artículo o si el recurso fuese insuficiente u oscuro determinará que la autoridad actuante, dentro del mismo plazo señalado en el parágrafo precedente, disponga su subsanación o aclaración en el término improrrogable de cinco (5) días, computables a partir de la notificación con la observación, que se realizará en Secretaría de la Superintendencia Tributaria General o Regional o Intendencia Departamental respectiva. Si el recurrente no subsanara la omisión u oscuridad dentro de dicho plazo, se declarará el rechazo del recurso.

                    Siendo subsanada la omisión u observación, se aplicará lo previsto en el parágrafo II de este Artículo.

                    <br>IV. La autoridad actuante deberá rechazar el recurso cuando se interponga fuera del plazo previsto en la presente Ley, o cuando se refiera a un recurso no admisible o a un acto no impugnable ante la Superintendencia Tributaria conforme a los Artículos 195 y 197 de la presente Ley.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 8, señala lo siguiente:
                    "ARTÍCULO 8 (FORMA DE INTERPOSICIÓN DE LOS RECURSOS).
                    <br>I. Los Recursos de Alzada y Jerárquico deberán interponerse por escrito, mediante memorial o carta simple, debiendo contener:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Señalamiento especifico del recurso administrativo y de la autoridad ante la que se lo interpone.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Nombre o razón social y domicilio del recurrente o de su representante legal con mandato legal expreso, acompañando el poder de representación que corresponda conforme a ley y los documentos respaldatorios de la personería del recurrente.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Indicación de la autoridad que dicto el acto contra el que se recurre y el ejemplar original, copia o fotocopia del documento que contiene dicho acto.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Detalle de los montos impugnados por tributo y por periodo o fecha, según corresponda, así como la discriminación de los componentes de la deuda tributaria consignados en el acto contra el que se recurre.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Los fundamentos de hecho y/o de derecho, según sea el caso, en que se apoya la impugnación, fijando con claridad la razón de su impugnación, exponiendo fundadamente los agravios que se invoquen e indicando con precisión lo que se pide.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) En el Recurso Jerárquico, señalar el domicilio para que se practique la notificación con la Resolución que lo resuelva.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;g) Lugar, fecha y firma del recurrente.

                    <br>II. En los Recursos de Alzada dentro de los cinco (5) días de presentado el recurso, el Superintendente Tributario Regional o los Intendentes Departamentales dictarán su admisión y dispondrán su notificación a la autoridad recurrida. Tratándose de Recursos Jerárquicos, no procede esta notificación al Superintendente Tributario Regional, sino, por disposición de este o del Intendente Departamental respectivo y dentro del mismo plazo, a la autoridad administrativa cuyo acto fue objeto de impugnación en el recurso previo o al recurrente, en el Recurso de Alzada, según corresponda. No será procedente la contestación al Recurso Jerárquico.

                    <br>III. La omisión de cualquiera de los requisitos señalados en el presente Artículo o si el recurso fuese insuficiente u oscuro determinará que la autoridad actuante, dentro del mismo plazo señalado en el Parágrafo precedente, disponga su subsanación o aclaración en el término improrrogable de cinco (5) días, computables a partir de la notificación con la observación, que se realizará en "Secretaría" de la Superintendencia Tributaria General o Regional o Intendencia Departamental respectiva. Si el recurrente no subsanara la omisión u oscuridad dentro de dicho plazo, se declarará el rechazo del recurso.

                    Siendo subsanada la omisión u observación, se aplicará lo previsto en el Parágrafo II de este Artículo.

                    <br>IV. La autoridad actuante deberá rechazar el recurso cuando se interponga fuera del plazo previsto en el Código Tributario, o cuando se refiera a un recurso no admisible o a un acto no impugnable ante la Superintendencia Tributaria conforme a los Artículos 5 y 7 del presente Decreto Supremo".

                    <h4>ARTÍCULO 199</h4> (EFECTOS). En aplicación del Artículo 108 de la presente Ley, los actos administrativos impugnados mediante los Recursos de Alzada y Jerárquico, en tanto no adquieran la condición de firmes no constituyen título de Ejecución Tributaria. La Resolución que se dicte resolviendo el Recurso Jerárquico agota la vía administrativa.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 9, señala lo siguiente:
                    "ARTÍCULO 9 (EFECTOS). En aplicación del Artículo 108 del Código Tributario Boliviano, los actos administrativos impugnados mediante los recursos de alzada y jerárquico, en tanto no adquieran la condición de firmes no constituyen, título de ejecución tributaria. La Resolución que se dicte resolviendo el Recursos Jerárquico agota la vía administrativa".

                    <h4>SECCIÓN II:
                        NORMAS GENERALES DE LOS RECURSOS ADMINISTRATIVOS Y RÉGIMEN PROBATORIO</h4>

                    <h4>SUBSECCIÓN I: NORMAS GENERALES</h4>

                    <h4>ARTÍCULO 200</h4> (PRINCIPIOS). Los recursos administrativos responderán, además de los principios descritos en el Artículo 4 de la Ley de Procedimiento Administrativo N° 2341, de 23 de abril de 2002, a los siguientes:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Principio de oficialidad o de impulso de oficio. La finalidad de los recursos administrativos es el establecimiento de la verdad material sobre los hechos, de forma de tutelar el legítimo derecho del Sujeto Activo a percibir la deuda, así como el del Sujeto Pasivo a que se presuma el correcto y oportuno cumplimiento de sus obligaciones tributarias hasta que, en debido proceso, se pruebe lo contrario; dichos procesos no están librados sólo al impulso procesal que le impriman las partes, sino que el respectivo Superintendente Tributario, atendiendo a la finalidad pública del mismo, debe intervenir activamente en la sustanciación del Recurso haciendo prevalecer su carácter impulsor sobre el simplemente dispositivo.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Principio de oralidad. Para garantizar la inmediación, transparencia e idoneidad, los Superintendentes Tributarios podrán sustanciar los recursos mediante la realización de Audiencias Públicas conforme a los procedimientos establecidos en el presente Título.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 10, señala lo siguiente:
                    "ARTÍCULO 10 (PRINCIPIOS). Los recursos administrativos responderán, además de los principios descritos en el Artículo 4 de la Ley N° 2341 de 23 de abril de 2002 Ley de Procedimiento Administrativo, a los siguientes:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Principio inquisitivo La finalidad de los recursos administrativos es el establecimiento de la verdad material sobre los hechos imponibles, de forma de tutelar el legítimo derecho del Sujeto Activo a percibir la deuda, así como el del Sujeto Pasivo a que se presuma el correcto y oportuno cumplimiento de sus obligaciones tributarias hasta que en debido proceso se pruebe lo contrario; dichos procesos no están librados sólo al impulso procesal que le impriman las partes, sino que el respectivo Superintendente Tributario, atendiendo a la finalidad pública del mismo, debe intervenir activamente en la sustanciación del Recurso haciendo prevalecer su carácter inquisitivo sobre el simplemente dispositivo.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Principio de oralidad Para garantizar la inmediación, transparencia e idoneidad, los Superintendentes Tributarios podrán sustanciar los recursos mediante la realización de Audiencias Públicas conforme a los procedimientos establecidos en el presenteReglamento".

                    <h4>ARTÍCULO 201</h4> (NORMAS SUPLETORIAS). Los recursos administrativos se sustanciarán y resolverán con arreglo al procedimiento establecido en el Título III de este Código, y el presente título. Sólo a falta de disposición expresa, se aplicarán supletoriamente las normas de la Ley de Procedimiento Administrativo.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 11, señala lo siguiente:
                    "ARTÍCULO 11 (NORMAS SUPLETORIAS). Los recursos administrativos se sustanciarán y resolverán con arreglo al procedimiento establecido en el Título III del Código Tributario Boliviano, en el presente Reglamento y, sólo a falta de disposición expresa, se aplicarán supletoriamente las normas de la Ley de Procedimiento Administrativo".

                    <h4>ARTÍCULO 202</h4> (LEGITIMACIÓN ACTIVA). Podrán promover los recursos administrativos establecidos por la presente Ley las personas naturales o jurídicas cuyos intereses legítimos y directos resulten afectados por el acto administrativo que se recurre.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 12, señala lo siguiente:
                    "ARTÍCULO 12 (LEGITIMACIÓN ACTIVA). Podrán promover los recursos administrativos objeto del presente Decreto Supremo las personas naturales o jurídicas cuyos intereses legítimos y directos resulten afectados por el acto administrativo que se recurre".

                    <h4>ARTÍCULO 203</h4> (CAPACIDAD PARA RECURRIR).
                    <br>I. Tienen capacidad para recurrir las personas que tuvieran capacidad de ejercicio con arreglo a la legislación civil.
                    <br>II. Los incapaces deberán ser representados conforme a la legislación civil.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 13, señala lo siguiente:
                    "ARTÍCULO 13 (CAPACIDAD PARA RECURRIR).
                    <br>I. Tienen capacidad para recurrir las personas que tuvieran capacidad de ejercicio con arreglo a la legislación civil.
                    <br>II. Los incapaces deberán ser representados conforme a la legislación civil".

                    <h4>ARTÍCULO 204</h4> (REPRESENTACIÓN).

                    <br>I. El recurrente podrá concurrir por sí o mediante apoderado legalmente constituido.

                    <br>II. Las personas jurídicas legalmente constituidas, así como las corporaciones, entidades autárquicas, autónomas, cooperativas y otras con personalidad jurídica, serán obligatoriamente representadas por quienes acrediten su mandato de acuerdo a la legislación civil, mercantil o normas de derecho público que correspondan.

                    <br>III. En el caso de las sociedades de hecho, podrán recurrir quienes efectúen operaciones en nombre de la sociedad y en el de las sucesiones indivisas cualquiera de los derech habientes.

                    <br>IV. La autoridad administrativa de la Administración Tributaria deberá presentar su acreditación a tiempo de su apersonamiento.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento
                    y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia
                    Tributaria, en su Artículo 14, señala lo siguiente:
                    "ARTÍCULO 14 (REPRESENTACIÓN).
                    <br>I. El recurrente podrá concurrir por sí o mediante apoderado legalmente constituido.
                    <br>II. Las personas jurídicas legalmente constituidas, así como las corporaciones, entidades autárquicas, autónomas, cooperativas y otras con personalidad jurídica, serán obligatoriamente representadas por quienes acrediten su mandato de acuerdo a la legislación civil, mercantil o normas de derecho público que correspondan.
                    <br>III. En el caso de las sociedades de hecho, podrán recurrir quienes efectúen operaciones en nombre de la sociedad y en el de las sucesiones indivisas cualquiera de los derecho habientes.
                    <br>IV. La autoridad administrativa de la Administración Tributaria deberá presentar su acreditación a tiempo de su apersonamiento".

                    <h4>ARTÍCULO 205</h4> (NOTIFICACIONES).

                    <br>I. Toda providencia y actuación, deberá ser notificada a las partes en la Secretaría de la Superintendencia Tributaria General o Regional o de la Intendencia Departamental respectiva, según sea el caso, con excepción del acto administrativo de admisión del Recurso de Alzada y de la Resolución que ponga fin al Recurso Jerárquico, que se notificará a ambas partes en forma personal según lo dispuesto en los parágrafos II y III del Artículo 84 de la presente Ley o alternativamente mediante Cédula, aplicando a este efecto las previsiones del Artículo 85 de este mismo cuerpo legal, cuyas disposiciones acerca del funcionario actuante y de la autoridad de la Administración Tributaria se entenderán referidas al funcionario y autoridad correspondientes de la Superintendencia Tributaria.
                    <br>II. A los fines de las notificaciones en Secretaría, las partes deberán concurrir a las oficinas de la Superintendencia Tributaria ante la que se presentó el recurso correspondiente todos los miércoles de cada semana, para notificarse con todas las actuaciones que se hubieran producido; la diligencia de notificación se hará constar en el expediente respectivo. La inconcurrencia de los interesados no impedirá que se practique la diligencia de notificación ni sus efectos.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 15, señala lo siguiente:
                    "ARTÍCULO 15 (NOTIFICACIONES). Toda providencia y actuación, deberá ser notificada a las partes en la Secretaría de la Superintendencia Tributaria General o Regional o de la Intendencia Departamental respectiva, según sea el caso, con excepción del acto administrativo de admisión del Recurso de Alzada y de la Resolución que ponga fin al Recurso Jerárquico, que se notificará a ambas partes en forma personal según lo dispuesto en los parágrafos II y III del Artículo 84 del Código Tributario Boliviano o alternativamente mediante cédula, aplicando a este efecto las previsiones del Artículo 85 del mismo Código, cuyas disposiciones acerca del funcionario actuante y de la autoridad de la Administración Tributaria se entenderán referidas al funcionario y autoridad correspondientes de la Superintendencia Tributaria.
                    A los fines de las notificaciones en Secretaría, las partes deberán concurrir a las oficinas de la Superintendencia Tributaria ante la que se sustancia el recurso correspondiente todos los miércoles de cada semana, para notificarse con todas las actuaciones que se hubieran producido; la diligencia de notificación se hará constar en el expediente respectivo. La inconcurrencia de los interesados no impedirá que se practique la diligencia de notificación ni sus efectos".

                    <h4>ARTÍCULO 206</h4> (PLAZOS).

                    <br>I. Los plazos administrativos establecidos en el presente Título son perentorios e improrrogables, se entienden siempre referidos a días hábiles en tanto no excedan a diez (10) días y siendo más extensos se computarán por días corridos. Los plazos correrán a partir del día siguiente hábil a aquél en que tenga lugar la notificación con el acto o resolución a impugnar y concluyen al final de la última hora hábil del día de su vencimiento; cuando el último día del plazo sea inhábil, se entenderá siempre prorrogado hasta el primer día hábil siguiente.
                    <br>II. Se entiende por días y horas hábiles administrativos aquellos en los que la Superintendencia Tributaria cumple sus funciones.
                    <br>III. Las vacaciones colectivas de los funcionarios de la Superintendencia Tributaria deberán asegurar la permanencia de personal suficiente para mantener la atención al público, por lo que en estos períodos los plazos establecidos se mantendrán inalterables.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 16, señala lo siguiente:
                    "ARTÍCULO 16 (PLAZOS). Los plazos administrativos establecidos en el presente Reglamento son perentorios e improrrogables, se entienden siempre referidos a días hábiles en tanto no excedan a diez (10) días y siendo más extensos se computarán por días corridos. Los plazos correrán a partir del día siguiente hábil a aquél en que tenga lugar la notificación con el acto o resolución a impugnar y concluyen al final de la última hora hábil del día de su vencimiento; cuando el último día del plazo sea inhábil, se entenderá siempre prorrogado hasta el primer día hábil siguiente.
                    Se entiende por días y horas hábiles administrativos aquellos en los que la Superintendencia Tributaria cumple sus funciones.
                    Las vacaciones colectivas de los funcionarios de la Superintendencia Tributaria deberán asegurar la permanencia de personal suficiente para mantener la atención al público, por lo que en estos períodos los plazos establecidos se mantendrán inalterables".

                    <h4>ARTÍCULO 207</h4> (TERCERIAS, EXCEPCIONES, RECUSACIONES, INCIDENTES, EXCUSAS Y SUPLENCIA LEGAL).

                    <br>I. No son aplicables en los Recursos de Alzada y Jerárquico, tercerías, excepciones, recusaciones, ni incidente alguno.
                    <br>II. Los Superintendentes Tributarios General y Regionales deberán excusarse en los siguientes casos:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Parentesco con el recurrente o recurrido o con sus representantes en línea directa o colateral hasta el segundo grado; y

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Relación de negocios o patrocinio profesional directo o indirecto con el interesado o participación directa en cualquier empresa que intervenga en los recursos, inclusive hasta dos (2) años de haber cesado la relación, patrocinio o participación.

                    Los Superintendentes Tributarios Regionales deberán decretar su excusa antes de la admisión, observación o rechazo del Recurso de Alzada. El Superintendente Tributario General deberá excusarse antes de decretar la radicatoria del Recurso Jerárquico admitido por el Superintendente de origen.

                    Tratándose de Recursos de Alzada presentados ante un Intendente Departamental, la excusa del Superintendente Tributario Regional deberá decretarse antes de dictar la radicatoria respectiva, teniendo para cualquiera de ambos actos un plazo común de cinco (5) días desde que el expediente fue recibido en su sede.

                    Decretada la excusa, en el caso de un Superintendente Tributario Regional, éste quedará inhibido definitivamente de conocer el proceso y lo remitirá de inmediato al Superintendente Tributario Regional cuya sede se encuentre más próxima a la propia. Tratándose del Superintendente Tributario General, éste será reemplazado por el Superintendente Tributario Regional de la sede más próxima, excepto el que hubiera dictado la Resolución recurrida, y así sucesivamente. En ambos casos, el plazo de los cinco (5) días, para la primera actuación del Superintendente Tributario que reciba el recurso, se computará a partir de la recepción del mismo.

                    Será nulo todo acto o resolución pronunciada después de decretada la excusa. La omisión de excusa será causal de responsabilidad de acuerdo a la Ley N° 1178 y disposiciones reglamentarias.

                    Los autos y proveídos de mero trámite podrán ser suscritos en suplencia legal por el inmediato inferior en grado, cuando el Superintendente Tributario General o los Superintendentes Tributarios Regionales, no se encuentren en su sede por motivos de salud, misión oficial, cursos o seminarios de capacitación o vacaciones.


                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 17, señala lo siguiente:
                    "ARTÍCULO 17 (TERCERIAS, EXCEPCIONES, RECUSACIONES, INCIDENTES, Y EXCUSAS).
                    <br>I. No son aplicables en los Recursos de Alzada y Jerárquico, tercerías, excepciones, recusaciones, ni incidente alguno.
                    <br>II. Los Superintendentes Tributarios General y Regionales deberán excusarse en los siguientes casos:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) El parentesco con el recurrente o recurrido o con sus representantes en línea directa o colateral hasta el segundo grado; y
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) La relación de negocios o patrocinio profesional directo o indirecto con el interesado o participación directa en cualquier empresa que intervenga en los recursos, inclusive hasta dos años de haber cesado la relación, patrocinio o participación.
                    Los Superintendentes Tributarios Regionales deberán decretar su excusa antes de la admisión, observación o rechazo del recurso. El Superintendente Tributario General deberá excusarse antes de decretar la radicatoria del Recurso Jerárquico admitido por el Superintendente de origen.
                    Tratándose de Recursos de Alzada presentados ante un Intendente Departamental, la excusa del Superintendente Tributario Regional deberá decretarse antes de dictar la radicatoria respectiva, teniendo para cualquier de ambos actos un plazo común de cinco (5) días desde que el expediente fue recibido en su sede.
                    Decretada la excusa, en el caso de un Superintendente Tributario Regional, éste quedara inhibido definitivamente de conocer el proceso y lo remitirá de inmediato al Superintendente Tributario Regional cuya Sede se encuentre más próxima a la propia. Tratándose del Superintendente Tributario General, éste será reemplazado por el Superintendente Tributario Regional de la Sede más próxima y así sucesivamente, En ambos casos, el plazo de los cinco (5) días, para la primera actuación del Superintendente Tributario que reciba el recurso, se computarán a partir de la recepción del mismo.
                    Será nulo todo acto o resolución pronunciada después de decretada la excusa. La omisión de excusa será causal de responsabilidad de acuerdo a la Ley N° 1178 y disposiciones reglamentarias".
                    La omisión de excusa será causal de responsabilidad de acuerdo a la Ley N° 1178 y disposiciones reglamentarias”.

                    <h4>ARTÍCULO 208</h4> (AUDIENCIA PÚBLICA). En el Recurso de Alzada regulado por este Título, dentro de los quince (15) días de concluido el término de prueba, a criterio del Superintendente Regional se convocará a Audiencia Pública conforme a las siguientes reglas:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) La Audiencia Pública, cuando se convoque, se realizará antes de dictarse resolución definitiva y en su convocatoria fijará los puntos precisos a que se limitará su realización. Si así lo requiriese el Superintendente Tributario, las partes deberán presentar en la Audiencia documentos y demás elementos probatorios adicionales a los ya presentados, relativos a los puntos controvertidos.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) La Audiencia, si se convocara, podrá efectuarse indistintamente, a criterio del Superintendente Tributario Regional actuante, en su propia sede o en la de la Intendencia Departamental respectiva.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) La Audiencia se llevará a cabo con la presencia del recurrente y de la autoridad recurrida o sus representantes y cualquier persona que, convocada por cualquiera de las partes o por el Superintendente Tributario convocante, aporte informes técnicos, estudios especializados u otros instrumentos de similar naturaleza.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Las partes, empezando por el recurrente, expondrán sus opiniones y argumentos sobre el asunto que motivó la Audiencia, teniendo derecho al uso de la palabra por tiempos iguales, las veces y por los lapsos que establezca el Superintendente Tributario que esté dirigiendo la Audiencia.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) La Audiencia se realizará en horas hábiles, prorrogables a criterio del Superintendente Tributario.

                    Podrá decretarse cuarto intermedio, por una sola vez, a criterio del Superintendente Tributario.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) La inconcurrencia de cualquiera de las partes no suspenderá la Audiencia, siempre que el representante o Abogado de la parte solicitante esté presente; caso contrario, el Superintendente emitirá por una sola vez otra convocatoria para la celebración de una nueva Audiencia que en ningún caso podrá llevarse a cabo antes de las siguientes veinticuatro (24) horas. En caso que la inconcurrencia hubiera sido debidamente justificada con anterioridad al momento de realización de la Audiencia, ésta deberá celebrarse dentro de los diez (10) días siguientes a la fecha en que originalmente debió realizarse; sin embargo, si la inconcurrencia no hubiera sido justificada, la Audiencia podrá ser celebrada, a criterio del Superintendente, dentro de los cinco (5) días siguientes a la fecha en que originalmente debió realizarse.

                    La inconcurrencia de las demás personas convocadas no suspenderá la Audiencia.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;g) Concluida la intervención de los participantes, el Superintendente Tributario declarará clausurada la Audiencia, debiendo procederse a la elaboración y firma del Acta correspondiente por las partes y el Superintendente Tributario.

                    En el Recurso Jerárquico regulado por este Título, podrá convocarse a Audiencia Pública indistintamente, a criterio del Superintendente Tributario General, en la sede de la Superintendencia Tributaria General, en la de la Superintendencia Tributaria Regional o en la Intendencia Departamental respectiva. La convocatoria y celebración de esta Audiencia, a criterio del Superintendente Tributario General, no requerirá de los formalismos previstos para las Audiencias ante los Superintendentes Regionales.


                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 18, señala lo siguiente:

                    "ARTÍCULO 18 (AUDIENCIA PÚBLICA). En el Recurso de Alzada regulado por este Título, dentro de los quince (15) días de concluido el término de prueba, a criterio del Superintendente Regional se convocará a Audiencia Pública conforme a las siguientes reglas:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) La Audiencia Pública, cuando se convoque, se realizará antes de dictarse resolución definitiva y en su convocatoria fijará los puntos precisos a que se limitará su realización, Si así lo requiriese el Superintendente Tributario, las partes deberán presentar en la Audiencia documentos y demás elementos probatorios adicionales a los ya presentados relativos a los puntos controvertidos.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) La Audiencia, si se convocara, podrá efectuarse indistintamente, a criterio del Superintendente Tributario Regional actuante, en su propia sede o en la de la Intendencia departamental respectiva.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) La Audiencia se llevará a cabo con la presencia del recurrente y de la autoridad recurrida o sus representantes y cualquier persona que, convocada por cualquiera de las partes o por el Superintendente Tributario convocante, aporte informes técnicos, estudios especializados u otros instrumentos de similar naturaleza.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Las partes, empezando por el recurrente, expondrán sus opiniones y argumentos sobre el asunto que motivó la Audiencia, teniendo derecho al uso de la palabra por tiempos iguales, las veces y por los lapsos que establezca el Superintendente Tributario que esté dirigiendo la Audiencia.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) La Audiencia se realizará en horas hábiles, prorrogables a criterio del Superintendente Tributario. Podrá decretarse cuarto intermedio, por una sola vez, a criterio del Superintendente Tributario.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) La inconcurrencia de cualquiera de las partes, no suspenderá la Audiencia, siempre que el representante o abogado de la parte solicitante esté presente; caso contrario, el Superintendente emitirá por una sola vez otra convocatoria para la celebración de una nueva Audiencia que en ningún caso podrá llevarse a cabo antes de las siguientes veinticuatro (24) horas. En caso que la inconcurrencia hubiera sido debidamente justificada con anterioridad al momento de realización de la Audiencia, esta deberá celebrarse dentro de los diez (10) días siguientes a la fecha en que originalmente debió realizarse; sin embargo, si la inconcurrencia no hubiera sido justificada, la Audiencia podrá ser celebrada, a criterio del Superintendente, dentro de los cinco (5) días siguientes a la fecha en que originalmente debió realizarse.

                    La inconcurrencia de las demás personas convocadas no suspenderá la Audiencia.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;g) Concluida la intervención de los participantes, el Superintendente Tributario declarará clausurada la Audiencia, debiendo procederse a la elaboración y firma del Acta correspondiente por las partes y el Superintendente Tributario.
                    En el Recurso Jerárquico regulado por este Título, podrá convocarse a Audiencia Pública indistintamente, a criterio del Superintendente Tributario General, en la sede de la Superintendencia Tributaria General, en la de la Superintendencia Tributaria Regional o en la Intendencia Departamental que viera conveniente. La convocatoria y celebración de esta audiencia, a criterio del Superintendente Tributario General, no requerirá de los formalismos previstos para las Audiencias ante los Superintendentes Regionales".

                    <h4>ARTÍCULO 209</h4> (DESISTIMIENTO).

                    <br>I. El recurrente podrá desistir del Recurso en cualquier estado del proceso, debiendo el Superintendente Tributario General o Regional aceptarlo sin más trámite.

                    <br>II. Si el recurso se hubiere presentado por dos (2) o más interesados, el desistimiento sólo afectará a aquél o aquellos que lo hubieran formulado.

                    <br>III. Aceptado el desistimiento, el Superintendente Tributario General o Regional, según sea el caso, declarará firme el acto impugnado disponiendo su inmediata ejecución.


                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 19, señala lo siguiente:
                    "ARTÍCULO 19 (DESISTIMIENTO).
                    <br>I. El recurrente podrá desistir del Recurso en cualquier estado del proceso, debiendo el Superintendente Tributario General o Regional aceptarlo sin más trámite.

                    <br>II. Si el recurso se hubiere presentado por dos (2) o más interesados, el desistimiento sólo afectará a aquellos que lo hubieran formulado.

                    <br>III. Aceptado el desistimiento, el Superintendente Tributario General o Regional, según sea el caso, declarará firme el acto impugnado disponiendo su inmediata ejecución".


                    <h4>ARTÍCULO 210</h4> (RESOLUCIÓN).

                    <br>I.
                    Los Superintendentes Tributarios tienen amplia facultad para ordenar cualquier diligencia relacionada con los puntos controvertidos.

                    Asimismo, con conocimiento de la otra parte, pueden pedir a cualquiera de las partes, sus

                    representantes y testigos la exhibición y presentación de documentos y formularles los

                    cuestionarios que estimen conveniente, siempre en relación a las cuestiones debatidas, dentro o 185

                    no de la Audiencia Pública a que se refiere el Artículo 208 de la presente Ley.
                    Los Superintendentes Tributarios también pueden contratar peritos, a costa de la institución, cuando la naturaleza del caso así lo amerite.

                    <br>II. Durante los primeros veinte (20) días siguientes al vencimiento del período de prueba, las partes podrán presentar, a su criterio, alegatos en conclusiones; para ello, podrán revisar in extenso el expediente únicamente en sede de la Superintendencia Tributaria General o Regional o de la Intendencia Departamental, según corresponda. Los alegatos podrán presentarse en forma escrita o en forma verbal bajo las mismas reglas, en este último caso, establecidas en el Artículo 208 de la presente Ley para el desarrollo de la Audiencia Pública.

                    <br>III. Los Superintendentes Tributarios dictarán resolución dentro del plazo de cuarenta (40) días siguientes a la conclusión del período de prueba, prorrogables por una sola vez por el mismo término.

                    <br>IV. Los Superintendentes Tributarios así como el personal técnico y administrativo de la Superintendencia Tributaria que dieran a conocer el contenido del proyecto de resolución a las partes o a terceras personas antes de su aprobación, serán sancionados conforme a Ley.


                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 21, señala lo siguiente:
                    "ARTÍCULO 21 (RESOLUCIÓN).
                    <br>I. Los Superintendentes Tributarios tienen amplia facultad para ordenar cualesquiera diligencias relacionadas con los puntos controvertidos.
                    Asimismo, con conocimiento de la otra parte, pueden pedir a cualquiera de las partes, sus representantes y testigos la exhibición y presentación de documentos y formularles los cuestionarios que estimen conveniente, siempre en relación a las cuestiones debatidas, dentro o no de la Audiencia Pública a que se refiere el Artículo 18 del presente Decreto Supremo.
                    Los Superintendentes Tributarios también pueden contratar peritos, a costa de la institución cuando la naturaleza del caso así lo amerite.
                    <br>II. Durante los primeros veinte (20) días siguientes al vencimiento del período de prueba, las partes podrán presentar, a su criterio, alegatos en conclusiones; para ello, podrán revisar in extenso el expediente únicamente en sede de la Superintendencia Tributaria General o Regional o de la Intendencia Departamental, según corresponda. Los alegatos podrán presentarse en forma escrita o en forma verbal bajo las mismas reglas, en este último caso, establecidas en el Artículo 18 de
                    <br>III. Los Superintendentes Tributarios dictarán resolución dentro del plazo de cuarenta (40) días siguientes a la conclusión del período de prueba, prorrogables por una sola vez por el mismo término.
                    <br>IV. Los Superintendentes Tributarios así como el personal técnico y administrativo de la Superintendencia Tributaria que dieran a conocer el contenido del proyecto de resolución a las partes o a terceras personas antes de su aprobación, serán sancionados conforme a Ley".

                    <h4>ARTÍCULO 211</h4> (CONTENIDO DE LAS RESOLUCIONES).

                    <br>I. Las resoluciones se dictarán en forma escrita y contendrán su fundamentación, lugar y fecha de su emisión, firma del Superintendente Tributario que la dicta y la decisión expresa, positiva y precisa de las cuestiones planteadas.

                    <br>II. Las resoluciones precedidas por Audiencias Públicas contendrán en su fundamentación, expresa valoración de los elementos de juicio producidos en las mismas.

                    <br>III. Las resoluciones deberán sustentarse en los hechos, antecedentes y en el derecho aplicable que justifiquen su dictado; siempre constará en el expediente el correspondiente informe técnico jurídico elaborado por el personal técnico designado conforme la estructura interna de la Superintendencia, pudiendo el Superintendente Tributario basar su resolución en este informe o apartarse fundamentadamente del mismo.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 22, señala lo siguiente:
                    "ARTÍCULO 22 (CONTENIDO DE LAS RESOLUCIONES).
                    <br>I. Las resoluciones se dictarán en forma escrita y contendrán su fundamentación, lugar y fecha de su emisión, firma del Superintendente Tributario que la dicta y la decisión expresa, positiva y precisa de las cuestiones planteadas.

                    <br>II. Las resoluciones precedidas por Audiencias Públicas contendrán en su fundamentación, expresa valoración de los elementos de juicio producidos en las mismas.

                    <br>III. Las resoluciones deberán sustentarse en los hechos, antecedentes y en el derecho aplicable que justifiquen su dictado; siempre constará en el expediente el correspondiente informe técnico jurídico elaborado por el personal técnico designado conforme la estructura interna de la Superintendencia, pudiendo el Superintendente Tributario basar su resolución en este informe o apartarse fundamentadamente del mismo".

                    <h4>ARTÍCULO 212</h4> (CLASES DE RESOLUCIÓN).

                    <br>I. Las resoluciones que resuelvan los Recursos de Alzada y Jerárquico, podrán ser:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Revocatorias totales o parciales del acto recurrido;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Confirmatorias; o,

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Anulatorias, con reposición hasta el vicio más antiguo.

                    <br>II. La revocación parcial del acto recurrido solamente alcanza a los puntos expresamente revocados, no afectando de modo alguno el resto de puntos contenidos en dicho acto.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 23, señala lo siguiente:
                    "ARTÍCULO 23 (CLASES DE RESOLUCIÓN).
                    <br>I. Las resoluciones que resuelvan los Recursos de Alzada y Jerárquico, podrán ser:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Revocatorias totales o parciales del acto recurrido.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Confirmatorias.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Anulatorias, con reposición hasta el vicio más antiguo.
                    <br>II. La revocación parcial del acto recurrido solamente alcanza a los puntos expresamente revocados, no afectando de modo alguno el resto de puntos contenidos en dicho acto".

                    <h4>ARTÍCULO 213</h4> (RECTIFICACIÓN Y ACLARACIÓN DE RESOLUCIONES). Dentro del plazo fatal de cinco (5) días, a partir de la notificación con la resolución que resuelve el recurso, las partes podrán solicitar la corrección de cualquier error material, la aclaración de algún concepto oscuro sin alterar lo sustancial o que se supla cualquier omisión en que se hubiera incurrido sobre alguna de las pretensiones deducidas y discutidas.
                    La rectificación se resolverá dentro de los cinco (5) días siguientes a la presentación de su solicitud. La solicitud de rectificación y aclaración interrumpirá el plazo para la presentación del Recurso Jerárquico, hasta la fecha de notificación con el auto que se dicte a consecuencia de la solicitud de
                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 24, señala lo siguiente:
                    "ARTÍCULO 24 (RECTIFICACIÓN Y ACLARACIÓN DE RESOLUCIONES). Dentro del plazo fatal de cinco (5) días, a partir de la notificación con la resolución que resuelve el recurso, las partes podrán solicitar la corrección de cualquier error material, la aclaración de algún concepto oscuro sin alterar lo sustancial o que se supla cualquier omisión en que se hubiera incurrido sobre alguna de las pretensiones deducidas y discutidas.
                    La rectificación se resolverá dentro de los cinco (5) días siguientes a la presentación de su solicitud.
                    La solicitud de rectificación y aclaración interrumpirá el plazo para la presentación del Recurso Jerárquico, hasta la fecha de notificación con el auto que se dicte a consecuencia de la solicitud de rectificación y aclaración, agotándose la vía administrativa".

                    <h4>ARTÍCULO 214</h4> (EJECUCIÓN DE LAS RESOLUCIONES). Las resoluciones dictadas resolviendo los Recursos de Alzada y Jerárquico que constituyan Títulos de Ejecución Tributaria conforme al Artículo 108 de la presente Ley, serán ejecutadas, en todos los casos, por la Administración Tributaria.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 25, señala lo siguiente:
                    "ARTÍCULO 25 (EJECUCIÓN DE LAS RESOLUCIONES). Las resoluciones dictadas resolviendo los Recursos de Alzada y Jerárquico que constituyan Títulos de Ejecución Tributaria conforme al Artículo 108 del Código Tributario Boliviano, serán ejecutadas, en todos los casos, por la Administración Tributaria".

                    <h4>SUBSECCIÓN II: PRUEBA</h4>

                    <h4>ARTÍCULO 215</h4> (MEDIOS, CARGA Y APRECIACIÓN DE LA PRUEBA).

                    <br>I. Podrá hacerse uso de todos los medios de prueba admitidos en Derecho, con excepción de la prueba confesoria de autoridad y funcionarios del ente público recurrido.
                    <br>II. Son aplicables en los Recursos Administrativos todas las disposiciones establecidas en los Artículos
                    76 al 82 de la presente Ley.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 26, señala lo siguiente:

                    "ARTÍCULO 26 (MEDIOS, CARGA Y APRECIACIÓN DE LA PRUEBA).
                    <br>I. Podrá hacerse uso de todos los medios de prueba admitidos en Derecho, con excepción de la prueba confesoria de autoridad y funcionarios del ente público recurrido.

                    <br>II. Son aplicables en los Recursos Administrativos todas las disposiciones establecidas en los Artículos 76 al 82 del Código Tributario Boliviano".


                    <h4>ARTÍCULO 216</h4> (PRUEBA TESTIFICAL).

                    <br>I. La prueba testifical sólo servirá de indicio. En la prueba testifical, la declaración de testigos se registrará por escrito.

                    <br>II. No constituye impedimento para intervenir como testigo la condición de empleado o autoridad pública, a condición de que no pertenezca al ente público que sea parte en el proceso.


                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 27, señala lo siguiente:
                    "ARTÍCULO 27 (PRUEBA TESTIFICAL).
                    <br>I. La prueba testifical sólo servirá de indicio. En la prueba testifical, la declaración de testigos se registrará por escrito.

                    <br>II. No constituye impedimento para intervenir como testigo la condición de empleado o autoridad pública, a condición de que no pertenezca al ente público que sea parte en el proceso".

                    <h4>ARTÍCULO 217</h4> (PRUEBA DOCUMENTAL). Se admitirá como prueba documental:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Cualquier documento presentado por las partes en respaldo de sus posiciones, siempre que sea original o copia de éste legalizada por autoridad competente.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Los documentos por los que la Administración Tributaria acredita la existencia de pagos.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) La impresión de la información contenida en los medios magnéticos proporcionados por los contribuyentes a la Administración Tributaria, conforme a reglamentación específica.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Todo otro documento emitido por la Administración Tributaria respectiva, que será considerado a efectos tributarios, como instrumento público.

                    La prueba documental hará fe respecto a su contenido, salvo que sean declarados falsos por fallo judicial firme.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 28, señala lo siguiente:
                    "ARTÍCULO 28 (PRUEBA DOCUMENTAL). Se admitirá como prueba documental:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Cualquier documento presentado por las partes en respaldo de sus posiciones, siempre que sea original o copia de éste legalizada por autoridad competente.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Los documentos por los que la Administración Tributaria acredita la existencia de pagos.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) La impresión de la información contenida en los medios magnéticos proporcionados por los contribuyentes a la Administración Tributaria, conforme a reglamentación específica.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Todo otro documento emitido por la Administración Tributaria respectiva, que será considerado a efectos tributarios, como instrumento público.
                    La prueba documental hará fe respecto a su contenido, salvo que sean declarados falsos por fallo judicial firme".

                    <h3>SECCIÓN III: PROCEDIMIENTOS</h3>

                    <h4>ARTÍCULO 218</h4> (RECURSO DE ALZADA). El Recurso de Alzada se sustanciará de acuerdo al siguiente procedimiento:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Una vez presentado el recurso, en Secretaría de la Superintendencia Tributaria Regional o Intendencia Departamental, el mismo deberá ser admitido, observado o rechazado mediante auto expreso del Superintendente Tributario o Intendente Departamental en el plazo de cinco (5) días.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) El Recurso de Alzada que se admita, será puesto en conocimiento de la Administración Tributaria recurrida mediante notificación personal o cédula, conforme dispone el Artículo 205 de la presente Ley.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Dentro del plazo perentorio de quince (15) días desde la notificación con la admisión del recurso, la Administración Tributaria deberá responder al mismo, negando o aceptando total o parcialmente los argumentos del recurrente y adjuntando necesariamente los antecedentes del acto impugnado. Si no se contestare dentro de este plazo, se dispondrá de oficio la continuación del proceso, aperturando a partir de ese momento el término de prueba. La Administración Tributaria recurrida podrá incorporarse al proceso en cualquier momento en el estado en que se encuentre.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Dentro de las veinticuatro (24) horas del vencimiento del plazo para la contestación, con o sin respuesta de la Administración Tributaria recurrida, se dispondrá la apertura de término probatorio de veinte (20) días comunes y perentorios al recurrente y autoridad administrativa recurrida. Este plazo correrá a partir del día siguiente a la última notificación con la providencia de apertura en Secretaría de la Superintendencia Tributaria Regional o Intendencia Departamental.

                    La omisión en la contestación o remisión del acto impugnado o sus antecedentes, será comunicada por el Superintendente Tributario o Intendente Departamental a la Máxima Autoridad Ejecutiva de la Administración Tributaria para el establecimiento de la responsabilidad que corresponda de acuerdo al Artículo 28 de la Ley N° 1178 y al Reglamento de la Responsabilidad por la Función Pública, debiendo dicha Máxima Autoridad Ejecutiva, bajo responsabilidad funcionaria, disponer la inmediata remisión de los antecedentes extrañados.

                    Cuando la Administración Tributaria recurrida responda aceptando totalmente los términos del recurso, no será necesaria la apertura del término probatorio, debiendo el Superintendente Tributario Regional proceder directamente al dictado de su Resolución. Tampoco será necesaria la apertura del término probatorio cuando la cuestión debatida merezca calificación de puro derecho en vez de la apertura del indicado término.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Tratándose de Recursos de Alzada presentados ante un Intendente Departamental, una vez tramitado el recurso hasta el cierre del período probatorio, el expediente deberá ser remitido a conocimiento del Superintendente Tributario Regional respectivo. Una vez recibido el expediente en Secretaría de la Superintendencia Tributaria Regional, el Superintendente Tributario Regional deberá dictar decreto de radicatoria del mismo, en el plazo de cinco (5) días.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) Para formar debido conocimiento de la causa, cuando así lo considere necesario, el Superintendente Tributario Regional podrá convocar a Audiencia Pública conforme al Artículo 208 de la presente Ley.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;g) Vencido el plazo para la presentación de pruebas, el Superintendente Tributario Regional dictará su resolución conforme a lo que establecen los Artículos 210 al 212 de la presente Ley.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 29, señala lo siguiente:
                    "ARTÍCULO 29 (RECURSO DE ALZADA). El Recurso de Alzada se sustanciará de acuerdo al siguiente procedimiento:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Una vez presentado el recurso, en Secretaría de la Superintendencia Tributaria Regional o Intendencia Departamental, el mismo deberá ser admitido, observado o rechazado mediante auto expreso del Superintendente Tributario o Intendente Departamental en el plazo de cinco (5) días.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) El Recurso de Alzada que se admita, será puesto en conocimiento de la Administración Tributaria recurrida mediante notificación personal o cédula, conforme dispone el Artículo 15 del presente Reglamento.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Dentro del plazo perentorio de quince (15) días desde la notificación con la admisión del recurso, la Administración Tributaria deberá responder al mismo, negando o aceptando total o parcialmente los argumentos del recurrente y adjuntando necesariamente los antecedentes del acto impugnado. Si no se contestare dentro de este plazo se dispondrá de oficio la continuación del proceso, aperturando a partir de ese momento el término de prueba. La Administración Tributaria recurrida podrá incorporarse al proceso en cualquier momento en el estado en que se encuentre.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Dentro de las 24 horas del vencimiento del plazo para la contestación, con o sin respuesta de la Administración Tributaria recurrida, se dispondrá la apertura de término probatorio de veinte (20) días comunes y perentorio al recurrente y autoridad administrativa recurrida. Este plazo correrá a partir del día siguiente a la última notificación con la providencia de apertura en Secretaria de la Superintendencia Tributaria Regional o Intendencia Departamental.
                    La omisión en la contestación o remisión del acto impugnado o sus antecedentes, será comunicada por el Superintendente Tributario o Intendente Departamental a la Máxima Autoridad Ejecutiva de la Administración Tributaria para el establecimiento de la responsabilidad que corresponda de acuerdo al Artículo 28 de la Ley N° 1178 y el Reglamento de la Responsabilidad por la Función Pública, debiendo dicha Máxima Autoridad Ejecutiva, bajo responsabilidad funcionaria, disponer la inmediata remisión de los antecedentes extrañados.
                    Cuando la Administración Tributaria recurrida responda aceptando totalmente los términos del recurso, no será necesaria la apertura del término probatorio, debiendo el Superintendente Tributario Regional proceder directamente al dictado de su Resolución. Tampoco será necesaria la apertura del término probatorio cuando la cuestión debatida merezca calificación de puro derecho en vez de la apertura del indicado término.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Tratándose de Recursos de Alzada presentados ante un Intendente Departamental, una vez tramitado el recurso basta el cierre del período probatorio, el expediente deberá ser remitido a conocimiento del Superintendente Tributario Regional respectivo. Una vez recibido el expediente en Secretaría de la Superintendencia Tributaria Regional, el Superintendente Tributario Regional deberá dictar decreto de radicatoria del mismo, en el plazo de cinco (5) días.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) Para formar debido conocimiento de la causa, cuando así lo considere necesario, el Superintendente Tributario Regional podrá convocar a Audiencia Pública conforme al Artículo 18 del presente Reglamento.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;g) Vencido el plazo para la presentación de pruebas, el Superintendente Tributario Regional dictará su resolución conforme a lo que establecen los Artículos 21 al 23 del presente Reglamento".

                    <h4>ARTÍCULO 219</h4> (RECURSO JERÁRQUICO). El Recurso Jerárquico se sustanciará sujetándose al siguiente procedimiento:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Este recurso puede ser interpuesto por el sujeto pasivo tercero responsable y/o administraciones tributarias.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Una vez presentado el Recurso Jerárquico, en Secretaría de la Superintendencia Tributaria Regional o Intendencia Departamental, el mismo deberá ser admitido, observado o rechazado mediante auto expreso del Superintendente Tributario Regional en el plazo de cinco (5) días. Previa notificación al recurrente con el auto de admisión, dentro del plazo perentorio de tres (3) días desde la fecha de la notificación, el Superintendente Tributario Regional que emitió la Resolución impugnada deberá elevar al Superintendente Tributario General los antecedentes de dicha Resolución, debiendo inhibirse de agregar consideración alguna en respaldo de su decisión.

                    En caso de rechazo del Recurso, el Superintendente Tributario Regional hará conocer su auto y fundamentación al Superintendente Tributario General, dentro del mismo plazo indicado en el párrafo precedente.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Una vez recibido el expediente en Secretaría de la Superintendencia Tributaria General, el Superintendente Tributario General deberá dictar decreto de radicatoria del mismo, en el

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) En este Recurso sólo podrán presentarse pruebas de reciente obtención a las que se refiere el Artículo 81 de la presente Ley, dentro de un plazo máximo de diez (10) días siguientes a la fecha de notificación con la Admisión del Recurso por el Superintendente Tributario Regional.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Para formar debido conocimiento de la causa, cuando así lo considere necesario, el Superintendente Tributario General podrá convocar a Audiencia Pública conforme al Artículo 208 de la presente Ley.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) Vencido el plazo para presentación de pruebas de reciente obtención, el Superintendente Tributario General dictará su Resolución conforme a lo que establecen los Artículos 210 al 212 de este Código.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 30, señala lo siguiente:
                    "ARTÍCULO 30 (RECURSO JERÁRQUICO). El Recurso Jerárquico se sustanciará sujetándose al siguiente procedimiento:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Una vez presentado el Recurso Jerárquico, en Secretaría de la Superintendencia Tributaria Regional o Intendencia Departamental, el mismo deberá ser admitido, observado o rechazado mediante auto expreso del Superintendente Tributario Regional en el plazo de cinco (5) días. Previa notificación al recurrente con el auto de admisión, dentro del plazo perentorio de tres (3) días desde la fecha de la notificación, el Superintendente Tributario Regional que emitió la Resolución impugnada deberá elevar al Superintendente Tributario General los antecedentes de dicha Resolución, debiendo inhibirse de agregar consideración alguna en respaldo de su decisión.
                    En caso de rechazo del Recurso, el Superintendente Tributario Regional hará conocer su auto y fundamentación al Superintendente Tributario General, dentro del mismo plazo indicado en el párrafo precedente.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Una vez recibido el expediente en Secretaría de la Superintendencia Tributaria General, el Superintendente Tributario General deberá dictar decreto de radicatoria del mismo, en el plazo de cinco (5) días.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) En este Recurso sólo podrán presentarse pruebas de reciente obtención a las que se refiere el Artículo 81 del Código Tributario Boliviano, dentro de un plazo máximo de 10 días siguientes a la fecha de notificación con la Admisión del Recurso por el Superintendente Tributario Regional.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Para formar debido conocimiento de la causa, cuando así lo considere necesario, el Superintendente Tributario general podrá convocar a Audiencia Pública conforme al Artículo 18 del presente Reglamento.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Vencido el plazo para presentación de pruebas de reciente obtención, el Superintendente Tributario General dictará su Resolución conforme a lo que establecen los Artículos 21 al 23 de este Reglamento.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) Las Administraciones Tributarias podrán hacer uso del Recurso Jerárquico para impugnar resoluciones que pongan fin al Recurso de Alzada que fueran contrarias a otros precedentes pronunciados por las Superintendencias Regionales, por la Superintendencia General o por Autos Supremos dictados bajo la vigencia de la Ley N° 2492. El precedente contradictorio deberá invocarse por la Administración Tributaria a tiempo de interponer el Recurso Jerárquico.
                    A tal efecto, se entenderá que existe contradicción, cuando ante una situación de derecho similar, el sentido jurado y/o técnico que le asigna la resolución que resuelve el Recurso de Alzada no coincida con el del precedente, o por haberse aplicado normas distintas con diversos alcances".

                    <h3>CAPÍTULO IV
                        MEDIDAS PRECAUTORIAS</h3>

                    <h4>ARTÍCULO 220</h4> (MEDIDAS PRECAUTORIAS).
                    <br>I. De conformidad a los literales p) del Artículo 139 y h) del Artículo 140 de la presente Ley, en cualquier momento, dentro o fuera de los procesos sujetos a su conocimiento, los Superintendentes Tributarios General y Regionales así como los Intendentes Departamentales, autorizarán o rechazarán total o parcialmente, la adopción de Medidas Precautorias por parte de la Administración Tributaria, a expresa solicitud de ésta, dentro de las veinticuatro (24) horas de recibida la solicitud. En materia aduanera, la Administración Tributaria podrá ejercer la facultad prevista en el Artículo 80 segundo párrafo de la Ley General de Aduanas.
                    <br>II. La solicitud que al efecto formule la Administración Tributaria deberá, bajo responsabilidad funcionaria de la autoridad solicitante, incluir un informe detallado de los elementos, hechos y datos que la fundamenten así como una justificación de la proporcionalidad entre la o las medidas a adoptarse y el riesgo fiscal evidente.

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27350 de 02/02/2004, Reglamento Específico para el Conocimiento y Resolución de los Recursos de Alzada y Jerárquico, Aplicables ante la Superintendencia Tributaria, en su Artículo 31, señala lo siguiente:
                    "ARTÍCULO 31 (MEDIDAS PRECAUTORIAS).
                    <br>I. De conformidad al inciso p) del Artículo 139 y el inciso h) del Artículo 140 del Código Tributario Boliviano, en cualquier momento, dentro o fuera de los procesos sujetos a su conocimiento, los Superintendentes Tributarios General y Regionales así como los Intendentes Departamentales, autorizarán o rechazarán total o parcialmente, la adopción de Medidas Precautorias por parte de la Administración Tributaria, a expresa solicitud de ésta, dentro de las veinticuatro (24) horas de recibida la solicitud. En materia aduanera, la Administración Tributaria podrá ejercer la facultad prevista en el segundo párrafo del Artículo 80 de la Ley General de Aduanas.
                    <br>II. La solicitud que al efecto formule la Administración Tributaria deberá, bajo responsabilidad funcionaria de la autoridad solicitante, incluir un informe detallado de los elementos, hechos y datos que la fundamenten así como una justificación de la proporcionalidad entre la o las medidas a adoptarse y el riesgo fiscal evidente".

                    <h3>DISPOSICIONES TRANSITORIAS</h3>
                    PRIMERA Los procedimientos administrativos o procesos judiciales en trámite a la fecha de publicación del presente Código, serán resueltos hasta su conclusión por las autoridades competentes conforme a las normas y procedimientos establecidos en las leyes N° 1340, de 28 de mayo de 1992; N° 1455, de 18 de febrero de 1993; y, N° 1990, de 28 de julio de 1999 y demás disposiciones complementarias.

                    <h5>Nota del Editor:</h5>
                    Ley N° 3092 de 07/07/2005; ha sido complementada por el Artículo 3 y Disposiciones Finales Segunda, señalando lo siguiente:
                    "ARTÍCULO 3 Los actos definitivos de la Administración Tributaria, notificados con posterioridad a la vigencia plena de la Ley Nº 2492, serán impugnados y en su caso ejecutados conforme a los procedimientos previstos en la norma legal vigente al inicio de la impugnación o ejecución.
                    La norma sustantiva aplicable a estos casos será la vigente a la fecha del acaecimiento de los hechos que les dieren lugar.
                    No existe opcionalidad para la aplicación de las Normas de Impugnación o Ejecución Tributaria". "DISPOSICIONES FINALES
                    (...)
                    SEGUNDA Las Resoluciones Determinativas dictadas conforme a la Ley N° 1340 de fecha 28 de mayo de 1992, que fueran impugnadas ante los Superintendentes Regionales en merito a la Ley N° 2492 y que contuvieran calificación de conducta como delito tributario, deberán ser sustanciadas conforme al Capítulo II, del Título V del Código Tributario Boliviano, absteniéndose los Superintendentes y la Corte Suprema de Justicia en su Sala Social de Minería y Administrativa de emitir pronunciamiento sobre la calificación de la conducta. Concluida la etapa de prejudicialidad penal, el procesamiento penal correspondiente, se efectuará conforme al Título IV de la Ley N° 2492".

                    <h5>Disposiciones Relacionadas:</h5>
                    Decreto Supremo N° 27310 de 09/01/2004, Reglamento al Código Tributario Boliviano, en su Disposición Transitoria, Primera, señala lo siguiente:

                    "DISPOSICIONES TRANSITORIAS
                    PRIMERA A efecto de la aplicación del criterio de validez temporal de la Ley tributaria, establecido por la Disposición Transitoria Primera de la Ley N° 2492, el concepto de procedimiento administrativo en trámite se aplicará a todos los actos que pongan fin a una actuación administrativa y por tanto puedan ser impugnados utilizando los recursos administrativos admitidos por Ley. En consecuencia, los procedimientos administrativos abajo señalados que estuvieran en trámite a la fecha de publicación de la Ley N° 2492, deberán ser resueltos conforme a las normas y procedimientos vigentes antes de dicha fecha:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Fiscalización y determinación de la obligación tributaria;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Procedimiento sancionatorio (sumario infraccional);
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Control y cobro de autodeterminación;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Impugnación y;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Cobranza coactiva.
                    La impugnación de los procedimientos administrativos que estuvieran en trámite antes de la vigencia de la Ley N° 2492 resueltos con posterioridad a dicha fecha, será realizada utilizando los recursos administrativos señalados en el Título III de dicha Ley.

                    Sentencia Constitucional 0029/2004, de 31 de marzo de 2004: En el Recurso Indirecto o Incidental de Inconstitucionalidad demandando la Inconstitucionalidad del Penúltimo Párrafo de la Primera Disposición Transitoria del Capítulo IV del D.S. N° 27310 de 09/01/2004; Reglamento al Código Tributario Boliviano, por ser contrario a la disposición consagrada en el Artículo 14 de la Constitución Política del Estado (CPE).

                    El Tribunal Constitucional declara INCONSTITUCIONAL el Segundo Párrafo de la Disposición Transitoria Primera del D.S. N° 27310 de 09/01/2004.

                    Las obligaciones tributarias cuyos hechos generadores hubieran acaecido antes de la vigencia de la Ley N° 2492 se sujetarán a las disposiciones sobre prescripción contempladas en la Ley N° 1340 de 28 de mayo de 1992 y la Ley N° 1990 de 28 de julio de 1999".

                    SEGUNDA Los procedimientos administrativos o procesos jurisdiccionales, iniciados a partir de la vigencia plena del presente Código, serán sustanciados y resueltos bajo este Código.

                    TERCERA Con la finalidad de implementar el nuevo Código Tributario Boliviano, se establece un Programa Transitorio, Voluntario y Excepcional para el tratamiento de adeudos tributarios en mora con las siguientes particularidades:

                    - En el caso de impuestos cuya recaudación corresponda al servicio de Impuestos Nacionales, el Programa alcanzará a los adeudos tributarios en mora al 30 de junio de 2003.

                    - En el caso de impuestos cuya recaudación corresponda a los Gobiernos Municipales y a la Aduana Nacional, el Programa se sujetará a lo dispuesto en los parágrafos IV y V de la Disposición Transitoria Tercera de la Ley Nº 2492.

                    <h5>Nota del Editor:</h5>
                    Ley N° 2626 de 22/12/2003; Ley del Programa Transitorio, Voluntario y Excepcional para el Tratamiento de Adeudos Tributarios en Mora mediante su Artículo 7, sustituyó el primer Párrafo de la Disposición Transitoria Tercera.

                    <br>I. Opciones excluyentes para la regularización de obligaciones tributarias cuya recaudación corresponda al Servicio de Impuestos Nacionales:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) PAGO ÚNICO DEFINITIVO.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Se establece un pago equivalente al diez por ciento (10%) del total de las Ventas brutas declaradas en un año.
                    A tal efecto se deberá tomar como base de cálculo el promedio de las ventas brutas declaradas de los cuatro (4) años calendario comprendidos entre 1999 y 2002. Dicho pago supone la regularización de todas las obligaciones tributarias (impuestos, sanciones y accesorios) pendientes por las gestiones fiscales no prescritas. Este pago podrá realizarse hasta el 2 de abril de 2004 al contado o mediante un pago inicial del veinticinco por ciento (25%) a la misma fecha y tres (3) cuotas bimestrales iguales y consecutivas con una tasa de interés sobre saldos del cinco por ciento (5%). Este acogimiento implica la renuncia a los saldos a favor y las pérdidas que hubieran acumulado los contribuyentes y/o responsables, con excepción del crédito fiscal comprometido para la solicitud de devoluciones de CEDEIM's previa verificación. El cálculo de las ventas brutas descontará el valor de las exportaciones certificadas.
                    A efecto del cálculo para el Pago único Definitivo se aplicará el porcentaje del tres por ciento (3%) sobre el promedio de las ventas brutas declaradas de los cuatro años calendario comprendidos entre 1999 y 2002, en los siguientes casos:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Contribuyentes y/o responsables cuya actividad principal sea la construcción según su registro en el Padrón de Contribuyentes del Servicio de Impuestos Nacionales y/o en el registro Nacional de Empresas Constructoras a cargo del Viceministerio de Transporte.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Exportadores, sólo cuando el volumen total de ventas esté destinado a la exportación.
                    El incumplimiento en el pago de hasta dos (2) de las cuotas bimestrales mencionadas, dará lugar a la pérdida automática de los beneficios del programa, consolidándose los pagos realizados a favor del Fisco.

                    <h5>Nota del Editor:</h5>
                    Ley N° 2626 de 22/12/2003; Ley del Programa Transitorio, Voluntario y Excepcional para el Tratamiento de Adeudos Tributarios en Mora, mediante su Artículo 2, modificó el Numeral 1 del Inciso a), Pago Único Definitivo, Parágrafo 1, de la Tercera Disposición Transitoria.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. En el caso del Régimen Complementario al Valor Agregado (RC IVA), el contribuyente que se acoja al Programa pagará por una sola vez sobre el último ingreso, sueldo o retribución mensual percibida hasta junio de 2003, los siguientes montos:

                    Rango de Ingresos Monto a pagar

                    Rango de Ingresos Monto a pagar
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;5.000 7.000 250
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;7.001 9.000 500
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;9.001 11.000 1.000
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;11.001 13.000 1.500
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;13.001 15.000 2.000
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;15.001 Adelante 2.500

                    El plazo para el pago total definitivo vence el 2 de abril de 2004 e implicará que la Administración Tributaria no ejerza en lo posterior sus facultades de fiscalización y determinación tributaria de los períodos no prescritos. La regularización de este impuesto no implica la renuncia a los saldos a favor que hubieran acumulado los contribuyentes.

                    <h5>Nota del Editor:</h5>
                    Ley N° 2626 de 22/12/2003; Ley del Programa Transitorio, Voluntario y Excepcional para el Tratamiento de Adeudos Tributarios en Mora, mediante su Artículo 3, sustituyó el Numeral 2 del Inciso a), Pago Único Definitivo, Numeral 1, de la Disposición Transitoria Tercera.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) PLAN DE PAGOS.

                    Los contribuyentes y/o responsables que se acojan a la modalidad de plan de pagos se beneficiarán con la condonación de sanciones pecuniarias e intereses emergentes del incumplimiento de obligaciones tributarias, debiendo presentar su solicitud dentro del plazo de noventa (90) días perentorios siguientes a la publicación del Código Tributario. La Administración Tributaria correspondiente otorgará, por una sola vez, plan de pagos para la cancelación del tributo omitido actualizado en Unidades de Fomento de la Vivienda, mediante cuotas mensuales, iguales y consecutivas, por un plazo máximo de hasta cinco (5) años calendario, sin previa constitución de garantías y con una tasa de interés del cinco por ciento (5%) anual. Para la actualización del tributo, se aplicará el procedimiento dispuesto en la Ley N° 2434 y su reglamento.

                    Cuando los adeudos tributarios no se encuentren liquidados por la Administración Tributaria, los contribuyentes y/o responsables podrán solicitar un plan de pagos para la cancelación del tributo adeudado actualizado, presentando una Declaración Jurada no rectificable que consigne todas sus deudas conforme a lo que reglamentariamente se determine.

                    La solicitud de un plan de pagos determina la suspensión del cobro coactivo de la obligación tributaria, correspondiendo el levantamiento de las medidas coactivas adoptadas, excepto la anotación preventiva de bienes, salvo cuando el levantamiento de las medidas sea necesaria para cumplir obligaciones tributarias, previa autorización de la Administración Tributaria.

                    El incumplimiento de cualquiera de las cuotas del plan de pagos otorgado por la Administración Tributaria, dará lugar a la pérdida de los beneficios del presente programa correspondiendo la exigibilidad de toda la obligación.

                    La concesión de planes de pago no inhibe el ejercicio de las facultades de fiscalización, determinación y recaudación de la Administración Tributaria dentro del término de la prescripción.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) PAGO AL CONTADO.

                    Los contribuyentes y/o responsables que se acojan a esta modalidad por obligaciones tributarias que se hubieran determinado por la Administración Tributaria, se beneficiarán con la condonación de intereses, sanciones y el diez (10%) por ciento del tributo omitido, siempre que realicen el pago al contado dentro de los noventa (90) días perentorios siguientes a la publicación del Reglamento del presente programa. El pago al contado en efectivo implicará que las Administraciones Tributarias no ejerzan en lo posterior, sus facultades de fiscalización, determinación y recaudación sobre los impuestos y períodos comprendidos en dicho pago.
                    También podrán acogerse a esta modalidad las obligaciones tributarias no determinadas por la Administración, siempre que los contribuyentes y/o responsables presenten una Declaración Jurada no rectificable que consigne sus deudas. En estos casos, no se inhibe el ejercicio de las facultades de fiscalización, determinación y recaudación de la Administración Tributaria dentro del término de la prescripción.

                    <br>II. Quienes a la fecha de entrada en vigencia de esta norma tengan recursos o procesos de impugnación en vía administrativa o jurisdiccional, podrán pagar sus obligaciones tributarias mediante las modalidades dispuestas en los incisos b) y c) del parágrafo I, previo desistimiento del recurso o acción interpuesta, tomando como base de liquidación el último acto emitido dentro del recurso administrativo. Asimismo, los contribuyentes de las situaciones descritas podrán acogerse a la opción del inciso a) en las condiciones y formas dispuestas.

                    <br>III. En el caso de obligaciones tributarias cuya recaudación corresponda al Servicio de Impuestos Nacionales, la regularización del tributo omitido, intereses y sanciones pecuniarias por incumplimiento a deberes formales, en las modalidades desarrolladas en los incisos a), b) y c) del parágrafo I, procederá además, si los contribuyentes que desarrollan actividades gravadas se inscriben en el Nuevo Padrón Nacional, dentro del plazo fijado por norma reglamentaria.

                    <br>IV. En el ámbito municipal, el Programa Transitorio, Voluntario y Excepcional alcanzará al Impuesto a la Propiedad de Bienes Inmuebles y Vehículos Automotores y Patentes Municipales anuales, cuyos hechos generadores se hubieran producido hasta el 31 de diciembre de 2001 y al Impuesto Municipal a las Transferencias, Tasas y Patentes eventuales por hechos generadores ocurridos hasta el 31 de diciembre de 2002. La Regularización realizada por los contribuyentes y/o responsables en este ámbito, bajo una de las modalidades que con carácter excluyente se establecen, dará lugar a la condonación de sanciones pecuniarias e intereses generados por el incumplimiento.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Pago al contado del tributo omitido actualizado, dentro de los noventa (90) días perentorios posteriores a la publicación del presente Código.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Pago del tributo omitido actualizado en cuotas mensuales, iguales y consecutivas por un plazo máximo de hasta dos (2) años, sin previa constitución de garantías y con una tasa de interés del cinco (5) por ciento anual. La concesión del plan de pagos se otorgará por una sola vez, siempre que los contribuyentes y/o responsables formulen su solicitud dentro de los noventa (90) días perentorios siguientes a la publicación del presente Código.

                    En los demás aspectos, el Programa Transitorio, Voluntario y Excepcional se sujetará a lo establecido con carácter general en los parágrafos siguientes, respetando las especificidades dispuestas.

                    <br>V. En materia aduanera, para los cargos tributarios establecidos en informes de fiscalización, notas de cargo, resoluciones administrativas, actas de intervención u otro instrumento administrativo o judicial, emergente de la comisión de ilícitos aduaneros, se establece el pago de los tributos aduaneros omitidos determinados por la Administración Tributaria, que implicará la regularización de todas las obligaciones tributarias (impuestos, accesorios y las sanciones que correspondan, incluyendo el recargo por abandono) y la extinción de la acción penal prevista en las leyes aplicables.

                    En los casos de contrabando de mercancías, que sean regularizados con el pago de los tributos omitidos, los medios y unidades de transporte decomisados serán devueltos al transportador, previo pago de un monto equivalente al cincuenta por ciento (50%) de dichos tributos.

                    En los demás aspectos, el Programa Transitorio, Voluntario y Excepcional se sujetará a lo establecido con carácter general en los parágrafos siguientes, respetando las especificidades dispuestas.

                    <br>VI. Las deudas tributarias emergentes de Autos Supremos que hubieran alcanzado la autoridad de cosa juzgada podrán acogerse al Programa Transitorio, Voluntario y Excepcional en la modalidad dispuesta en el inciso b) del parágrafo I, salvo la aplicación de la condonación dispuesta en el mismo, que no procederá en ningún caso.

                    <h5>Nota del Editor:</h5>
                    Ley N° 2626 de 22/12/2003; Ley del Programa Transitorio, Voluntario y Excepcional para el Tratamiento de Adeudos Tributarios en Mora, mediante su Artículo 4, suprimió el segundo parágrafo del Numeral VI de la Disposición Transitoria Tercera.

                    <br>VII. Lo pagado en aplicación de este Programa en cualquiera de sus modalidades, no implica para el contribuyente y/o tercero responsable el reconocimiento de su calidad de deudor ni de la condición de autor de ilícitos tributarios.

                    <br>VIII. Los pagos realizados en aplicación de esta Ley, se consolidarán a favor del Sujeto Activo, no pudiendo ser reclamados a éste en vía de repetición.

                    <br>IX. Los contribuyentes y/o responsables que actualmente estuvieran cumpliendo un plan de pagos, podrán acogerse a la reprogramación del mismo, únicamente por el saldo adeudado con los beneficios establecidos para cada caso, en el presente Programa.

                    <br>X. Derogado

                    <h5>Nota del Editor:</h5>
                    Ley N° 2626 de 22/12/2003; Ley del Programa Transitorio, Voluntario y Excepcional para el Tratamiento de Adeudos Tributarios en Mora, mediante su Artículo 6, derogó el Numeral X de la Disposición Transitoria Tercera.

                    <br>XI. A efecto de la depuración del actual registro del Servicio de Impuestos Nacionales y la implementación mediante decreto supremo de un Nuevo Padrón Nacional de Contribuyentes, se dispone la condonación de sanciones pecuniarias por incumplimiento a deberes formales y se autoriza a la Administración Tributaria a proceder a la cancelación de oficio del Registro de aquellos contribuyentes que no cumplieron el proceso de recarnetización, o que habiéndolo hecho no tuvieron actividad gravada de acuerdo a lo que reglamentariamente se determine.

                    <br>XII. En el marco de la política de reactivación económica, el Poder Ejecutivo reglamentará un Programa Transitorio de reprogramación de adeudos a la Seguridad Social de corto plazo, Sistema de Reparto, aportes a la vivienda y patentes, con la condonación de multas e intereses.

                    <h5>Nota del Editor:</h5>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i) Ley Nº 2647 de 01/04/2004, mediante su Artículo 1, amplió el plazo para acogerse al Programa Transitorio Voluntario y Excepcional, para la regularización de adeudos tributarios establecido por la Ley Nº 2626 de 22/12/2003, tanto en el ámbito Municipal como en el del Servicio de Impuestos Nacionales, hasta el 14/05/2004.
                    ii) El Programa Transitorio, Voluntario y Excepcional para el Tratamiento de Adeudos Tributarios en Mora, a la fecha NO SE ENCUENTRA VIGENTE.

                    <h4>DISPOSICIÓN ADICIONAL</h4>

                    ÚNICA La limitación establecida en el inciso a) del parágrafo I del Artículo 11 de la Ley N° 2027, de 27 de octubre de 1999; del párrafo sexto del Artículo 35 de la Ley N° 1990, de 28 de julio de 1999; y del inciso f) del Artículo 8 de la Ley N° 2166, de 22 de diciembre de 2000, referentes a la imposibilidad para miembros del Directorio de desempeñar otro cargo público remunerado, no será aplicable para los miembros del Directorio que desempeñen simultáneamente funciones en el Servicio de Impuestos Nacionales y la Aduana Nacional, no pudiendo ejercer funciones a tiempo completo, ni otras funciones públicas.

                    <h4>DISPOSICIONES FINALES</h4>

                    PRIMERA A la vigencia del presente Código quedará derogado el literal B) del Artículo 157 de la Ley Nº 1455, de 18 de febrero de 1993, Ley de Organización Judicial.

                    Sentencia Constitucional 0018/2004, de 2 de marzo de 2004: En el Recurso Directo o Abstracto de Inconstitucionalidad, en el cual se demanda la Inconstitucionalidad de los Artículos 107, 131 Parágrafo Tercero, 132, 147 Parágrafo Segundo y Disposición Final Primera de la Ley N° 2492 (Código Tributario Boliviano CTB), porque vulnerarían los Artículos 16 y 116 de la Constitución Política del Estado (CPE).
                    El Tribunal Constitucional establece: 1° La CONSTITUCIONALIDAD del Artículo 132 del Código Tributario Boliviano (CTB), y
                    2° La INCONSTITUCIONALIDAD del Artículo 107ºParágrafo I y de la Disposición Final Primera del Código Tributario Boliviano (CTB).

                    SEGUNDA Sustitúyase el Artículo 231 del Código Penal, por el siguiente texto:

                    "Son delitos tributarios los tipificados en el Código Tributario y la Ley General de Aduanas, los que serán sancionados y procesados conforme a lo dispuesto por el Título IV del presente Código".

                    TERCERA Se modifican las penas de privación de libertad previstas en los Artículos 171 a 177 de la Ley General de Aduanas, en la siguiente forma:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) De tres a seis años de privación de libertad para los delitos tipificados en los Artículos 171, 172, 173, 174, 175 y para el cohecho activo tipificado en el artículo 176.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) De tres a ocho años de privación de libertad para el delito de tráfico de influencias en la actividad aduanera tipificado en el Artículo 177 y para el cohecho pasivo tipificado en el Artículo 176.

                    <h5>Nota del Editor:</h5>
                    Ley Nº 037 de 10/08/2010; Ley que Modifica el Código Tributario y la Ley General de Aduanas, en su Artículo 6 segundo párrafo, modificó de cuatro (4) a ocho (8) años la sanción penal a los delitos previstos en los Artículos 171, 172, 173, 174, 175, 176 y 177 de la Ley General de Aduanas.

                    CUARTA Sustitúyase el inciso b) y el último párrafo del Artículo 45 de la Ley N° 1990, por el siguiente texto:
                    "b) Efectuar despachos aduaneros por cuenta de terceros, debiendo suscribir personalmente las declaraciones aduaneras incluyendo su número de licencia.

                    El Despachante de Aduana puede ejercer funciones a nivel nacional previa autorización del Directorio de la Aduana Nacional".
                    QUINTA Sustitúyase en el Artículo 52 de la Ley N° 1990, Aduana Nacional por Ministerio de Hacienda.

                    SEXTA Modifícase el párrafo sexto del Artículo 29 de la Ley N° 1990 de 28 de julio de 1999 con el 205
                    siguiente texto:
                    "El Presupuesto anual de funcionamiento e inversión con recursos del Tesoro General de la Nación asignado a la Aduana Nacional, no será superior al dos (2%) por ciento de la recaudación anual de tributos en efectivo".
                    SÉPTIMA Añádase como párrafo adicional del Artículo 183 de la Ley N° 1990, el siguiente texto: "Se excluyen de este eximente los casos en los cuáles se presenten cualquiera de las formas de participación criminal establecidas en el Código Penal, garantizando para el auxiliar de la función pública aduanera el derecho de comprobar la información proporcionada por sus comitentes, consignantes o consignatarios y propietarios".
                    OCTAVA Sustitúyase el Artículo 187 de la Ley N° 1990, con el siguiente texto: "Las contravenciones en materia aduanera serán sancionadas con:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Multa que irá desde cincuenta Unidades de Fomento de la Vivienda (50 UFV's) a cinco mil Unidades de Fomento de la Vivienda (5.000 UFV's). La sanción para cada una de las conductas contraventoras se establecerá en esos límites mediante norma reglamentaria.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Suspensión temporal de actividades de los auxiliares de la función pública aduanera y de los operadores de comercio exterior por un tiempo de (10) diez a noventa (90) días.
                    La Administración Tributaria podrá ejecutar total o parcialmente las garantías constituidas a objeto de cobrar las multas indicadas en el presente artículo".

                    NOVENA A partir de la entrada en vigencia del presente Código, queda abrogada la Ley N° 1340, de 28 de mayo de 1992, y se derogan todas las disposiciones contrarias al presente texto legal.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i) Sentencia Constitucional 0076/2004, de 16 de julio de 2004: En el Recurso Indirecto o Incidental de Inconstitucionalidad demandando la Inconstitucionalidad de la disposición final novena de la Ley N° 2492 (Código Tributario Boliviano CTB), por ser contraria a los Artículos 7 inc. a) y 16
                    Parágrafos II y IV de la Constitución Política del Estado (CPE).

                    El Tribunal Constitucional declara la CONSTITUCIONALIDAD de la Disposición Final Novena del Código Tributario Boliviano (CTB), con vigencia temporal de un año a partir de la fecha la citación con esta Sentencia, y EXHORTA al Poder Legislativo para que en dicho plazo subsane el vacío legal inherente a la ausencia de un procedimiento contencioso tributario, bajo conminatoria en caso de incumplimiento, de que la indicada disposición legal quedará expulsada del ordenamiento jurídico nacional, en lo que respecta a la abrogatoria del procedimiento contencioso tributario Agroambiental, Consejo de la Magistratura y Tribunal Constitucional Plurinacional, mediante su Artículo 10, Parágrafo II, incorporó al Artículo 228 de la Ley N° 1340 de 28/05/1992, el Inciso 7); mismo que fue declarado Inconstitucional por la SC 0967/2014 de 23 de mayo de 2014.:

                    "<h4>ARTÍCULO 228</h4>
                    La demanda deberá reunir los siguientes requisitos:

                    1) Que sea presentada por escrito en papel sellado y con los timbres de Ley.

                    2) El nombre completo del actor y domicilio.

                    3) La designación de la administración o ente demandado.

                    4) Que se adjunte copia legalizada de la resolución o acto impugnado, o se señale el archivo o lugar en que se encuentra.

                    5) Que se acompañe el poder de representación en juicio y los documentos justificativos de la personería del demandante.

                    6) Los fundamentos de hecho y derecho, en que se apoya la demanda, fijando con claridad lo que se pide.

                    7) Cuando el monto determinado sea igual o superior a quince mil Unidades de Fomento a la Vivienda (15.000 UFV´s), el contribuyente deberá acompañar a la demanda el comprobante de pago total del tributo omitido actualizado en UFV´s e intereses consignados en la Resolución Determinativa. En caso de que la resolución impugnada sea revocada total o parcialmente mediante resolución judicial ejecutoriada, el importe pagado indebidamente será devuelto por la Administración Tributaria expresado en UFV´s entre el día del pago y la fecha de devolución al sujeto pasivo".


                    SENTENCIA CONSTITUCIONAL PLURINACIONAL 0967/2014 de 23 de mayo de 2013: En la Acción de Inconstitucionalidad Abstracta del Artículo 10 Parágrafo II de la Ley Nº 212 de 23 de diciembre de 2011; y Artículo 1, Parágrafo II, de la Resolución Regulatoria 0 0001 11, por vulnerar presuntamente los Artículos 8, Parágrafo II, 9, Parágrafo I, 14, Parágrafos II y III, 23, Parágrafo I, 115, Parágrafos I y II, 116, Parágrafo II, 117, Parágrafo I, 119, Parágrafos I y II, 120, Parágrafo I, 178, Parágrafo I y 180, Parágrafos I y II de la Constitución Política del Estado (CPE); Artículo 8, Numeral 2, Inciso h), Artículos 24 y 25 de la Convención Americana sobre Derechos Humanos; y Artículo 14 del Pacto Internacional de Derechos Civiles y Políticos (PIDCP).
                    La Sala Plena del Tribunal Constitucional Plurinacional declara: 1ºLa IMPROCEDENCIA
                    de la acción respecto al Artículo 1, Parágrafo II de la Resolución Regulatoria 0 0001
                    11, que incorpora el Artículo 54, por existir cosa juzgada constitucional.

                    2º Declarar la INCONSTITUCIONALIDAD del Artículo 10, Parágrafo II de la Ley Nº 212, por ser incompatible con los Artículos 8, Parágrafo II, 14, Parágrafo II, 115, 117, Parágrafo I y 119 de la Constitución Política del Estado (CPE); Artículos 8, Numeral 2, Inciso h), 24 y 25 de la Convención Americana sobre Derechos Humanos; y, Artículo 14 del Pacto Internacional de Derechos Civiles y Políticos (PIDCP).

                    DÉCIMA El presente Código entrará en vigencia noventa (90) días después de su publicación en la Gaceta Oficial de Bolivia, con excepción de las Disposiciones Transitorias que entrarán en vigencia a la publicación de su Reglamento.

                    DÉCIMA PRIMERA Se derogan los Títulos Décimo Primero y Décimo Segundo así como los siguientes artículos de la Ley General de Aduanas N° 1990, de 28 de julio de 1999: 14, párrafo 5to, 15; 16, 17, 18, 19, 20, 21, 22, 23, 24, 31, 33, 158, 159, 160, 161, 162, 163, 164, 165, 166, 167, 168, 169, 170, 177 párrafo 2do, 178, 179, 180, 181, 182, 184, 185, 262, 264, 265, 266 y 267.

                    Asimismo, se autoriza al Poder Ejecutivo a ordenar por Decreto Supremo el Texto de Código Tributario, incorporando las disposiciones no derogadas por esta norma que se encuentran establecidas en el Título Décimo de la Ley N° 1990, de 28 de julio de 1999.

                    DÉCIMA SEGUNDA El Poder Ejecutivo procederá, mediante Decreto Supremo, a ordenar e integrar en un solo cuerpo los textos de las siguientes leyes: N° 1990, de 28 de Julio de 1999; N° 843, de 20 de mayo de 1986 (Texto ordenado vigente); y, N° 2166, de 22 de diciembre de 2000.

                    Palacio de Gobierno de la ciudad de La Paz, a los dos días del me de agosto de dos mil tres años.

                    LEY DE REGULARIZACIÓN DE TRIBUTOS DEL NIVEL CENTRAL DEL ESTADO

                    LEY N° 1105
                    DE 28/09/2018
                    (COMPILADA A LA FECHA)

                    <h5>Nota del Editor:</h5>
                    La presente Ley considera a la Ley N° 1154 de 27/02/2019 y Ley N° 1172 de 02/05/2019.

                    <h4>ARTÍCULO 1</h4> (OBJETO). La presente Ley tiene por objeto establecer un período de regularización en el pago de deudas y multas de dominio tributario nacional, hasta el "30 de abril de 2019".

                    <h5>Nota del Editor:</h5>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i) Ley N° 1154 de 27/02/2019; Ley de Modificaciones a la Ley Nº 1105 de 28/09/2019, mediante su Artículo 2, Parágrafo I modificó el plazo de "28 de febrero de 2019" al plazo establecido en el Artículo precedente.
                    ii) Ley N° 1172 de 02/05/2019; en su Artículo Único, establece:
                    "ARTÍCULO ÚNICO. La presente Ley tiene por objeto establecer un nuevo periodo de regularización en el pago de deudas y multas de dominio tributario nacional, desde el 1 de mayo hasta el 28 de junio de 2019, bajo las mismas condiciones establecidas en el párrafo segundo del Parágrafo I, Parágrafos II, III, IV, V, VI, VII y VIII del Artículo 2 de la Ley N° 1105 de 28 de septiembre de 2018, modificada por la Ley N° 1154 de 27 de febrero de 2019".

                    <h4>ARTÍCULO 2</h4> (REGULARIZACIÓN DE ADEUDOS TRIBUTARIOS).
                    <br>I. Los sujetos pasivos con deudas tributarias a favor del nivel central del Estado, por periodos fiscales anteriores a la fecha de la publicación de la presente Ley, podrán efectuar, hasta el 30 de noviembre de 2018, el pago al contado del tributo omitido, su mantenimiento de valor y multas por delitos de defraudación tributaria o aduanera y contravenciones de evasión u omisión de pago, con una reducción de la sanción en el noventa y cinco por ciento (95%). En cuyo caso, quedarán exonerados del pago de los intereses aplicables y de las multas por incumplimiento de deberes formales consignadas en los respectivos procesos de determinación.
                    Después de vencido el plazo previsto en el anterior párrafo y hasta el "30 de abril de 2019", los

                    sujetos pasivos podrán regularizar sus deudas tributarias pagando al contado el tributo omitido y su

                    mantenimiento de valor, sin intereses y con la reducción del noventa por ciento (90%) de las multas por
                    209
                    delitos de defraudación tributaria o aduanera, contravenciones de evasión u omisión de pago y las multas

                    por incumplimiento de deberes formales vinculadas al proceso de determinación.


                    <h5>Nota del Editor:</h5>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i)Ley N° 1154 de 27/02/2019; Ley de Modificaciones a la Ley Nº 1105 de 28/09/2019, mediante su Artículo 2, Parágrafo I modificó el plazo de "28 de febrero de 2019" al plazo establecido en el segundo párrafo del Parágrafo precedente.
                    ii)Ley N° 1172 de 02/05/2019; en su Artículo Único, establece:
                    "ARTÍCULO ÚNICO. La presente Ley tiene por objeto establecer un nuevo periodo de regularización en el pago de deudas y multas de dominio tributario nacional, desde el 1 de mayo hasta el 28 de junio de 2019, bajo las mismas condiciones establecidas en el párrafo segundo del Parágrafo I, Parágrafos II, III, IV, V, VI, VII y VIII del Artículo 2 de la Ley N° 1105 de 28 de septiembre de 2018, modificada por la Ley N° 1154 de 27 de febrero de 2019".

                    <br>II. Los sujetos pasivos, desde la fecha de publicación de la presente Ley y hasta el "30 de abril de 2019", podrán acogerse a facilidades de pago por el tributo omitido actualizado, sin intereses y con la reducción del ochenta por ciento (80%) de las multas por delitos de defraudación tributaria o aduanera, contravenciones de evasión u omisión de pago y las multas por incumplimiento de deberes formales vinculadas al proceso de determinación, correspondientes a periodos fiscales anteriores a la publicación de la presente Ley.

                    <h5>Nota del Editor:</h5>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i)Ley N° 1154 de 27/02/2019; Ley de Modificaciones a la Ley Nº 1105 de 28/09/2019, mediante su Artículo 2, Parágrafo I modificó el plazo de "28 de febrero de 2019" al plazo establecido en el Parágrafo precedente.
                    ii)Ley N° 1172 de 02/05/2019; en su Artículo Único, establece:
                    "ARTÍCULO ÚNICO. La presente Ley tiene por objeto establecer un nuevo periodo de regularización en el pago de deudas y multas de dominio tributario nacional, desde el 1 de mayo hasta el 28 de junio de 2019, bajo las mismas condiciones establecidas en el párrafo segundo del Parágrafo I, Parágrafos II, III, IV, V, VI, VII y VIII del Artículo 2 de la Ley N° 1105 de 28 de septiembre de 2018, modificada por la Ley N° 1154 de 27 de febrero de 2019".

                    <br>III. Los sujetos pasivos que a la fecha de la publicación de la presente Ley tengan pagado el tributo omitido actualizado, y mantengan deudas por intereses y/o multas por delitos de defraudación tributaria
                    Los sujetos pasivos podrán pagar al contado con la reducción del noventa por ciento (90%), las multas adeudadas por contravenciones tributarias o aduaneras distintas a las establecidas en el Parágrafo I, o acogerse a facilidades de pago con una rebaja del ochenta por ciento (80%) por el mismo concepto.
                    Las multas por contravenciones previstas en el Artículo 162 de la Ley N° 2492 de 2 de agosto de 2003, "Código Tributario Boliviano", y el Artículo 186 de la Ley N° 1990 de 28 de julio de 1999, "Ley General de Aduanas", correspondientes a periodos fiscales anteriores a la fecha de publicación de la presente Ley, por las que la Administración Tributaria no hubiese iniciado proceso sancionador, quedan extinguidas.

                    <h5>Nota del Editor:</h5>
                    Ley N° 1172 de 02/05/2019; en su Artículo Único, establece:
                    "ARTÍCULO ÚNICO. La presente Ley tiene por objeto establecer un nuevo periodo de regularización en el pago de deudas y multas de dominio tributario nacional, desde el 1 de mayo hasta el 28 de junio de 2019, bajo las mismas condiciones establecidas en el párrafo segundo del Parágrafo I, Parágrafos II, III, IV, V, VI, VII y VIII del Artículo 2 de la Ley N° 1105 de 28 de septiembre de 2018, modificada por la Ley N° 1154 de 27 de febrero de 2019."

                    <br>IV. En las facilidades de pago por deudas tributarias y/o multas en curso a la fecha de publicación de la presente Ley, los sujetos pasivos podrán pagar el saldo adeudado, de acuerdo al cronograma dispuesto en la Resolución Administrativa, sin intereses y con la reducción del ochenta por ciento (80%) en el caso de las multas adeudadas por delitos o contravenciones tributarias o aduaneras consignadas en dicha Resolución.
                    Cuando la totalidad del saldo de la deuda tributaria sujeta a facilidades de pago, sea pagada en una sola cuota al contado, tendrá el tratamiento establecido en el Parágrafo I del presente Artículo.
                    En caso de facilidades de pago por multas, cuando la totalidad de éstas sean pagadas al contado hasta el "30 de abril de 2019", será con la reducción del noventa por ciento (90%) sobre el saldo adeudado.

                    <h5>Nota del Editor:</h5>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i)Ley N° 1154 de 27/02/2019; Ley de Modificaciones a la Ley Nº 1105 de 28/09/2019, mediante su Artículo 2, Parágrafo I modificó el plazo de "28 de febrero de 2019" al plazo establecido en el tercer párrafo del Parágrafo precedente.
                    ii)Ley N° 1172 de 02/05/2019; en su Artículo Único, establece:
                    "ARTÍCULO ÚNICO. La presente Ley tiene por objeto establecer un nuevo periodo de regularización en el pago de deudas y multas de dominio tributario nacional, desde el 1 de mayo hasta el 28 de junio de 2019, bajo las mismas condiciones establecidas en el párrafo segundo del Parágrafo I, Parágrafos II, III, IV, V, VI, VII y VIII del Artículo 2 de la Ley N° 1105 de 28 de septiembre de 2018, modificada por la Ley N° 1154 de 27 de febrero de 2019".

                    <br>V. Podrán acogerse a la regularización establecida en los Parágrafos precedentes del presente Artículo, los sujetos pasivos con deudas tributarias y/o multas, en cualquier estado del proceso, en impugnación tributaria, o hasta antes de la adjudicación de bienes en proceso de disposición en ejecución tributaria o cobranza coactiva, inclusive los que tengan facilidades de pago incumplidas, o declaraciones juradas presentadas sin pago o con pagos parciales.
                    Los sujetos pasivos con procesos administrativos tributarios impugnados en la vía administrativa o judicial, para acogerse a lo dispuesto en los Parágrafos precedentes del presente Artículo, previamente deberán presentar su desistimiento por el total o una parte de los adeudos tributarios y/o multas que deseen acogerse a los beneficios establecidos en la presente Ley.

                    <h5>Nota del Editor:</h5>
                    Ley N° 1154 de 27/02/2019; Ley de Modificaciones a la Ley Nº 1105 de 28/09/2019, mediante su Artículo 2, Parágrafo II modificó el Párrafo precedente.

                    Cuando la Administración Tributaria hubiese interpuesto la impugnación, en la vía administrativa o judicial, sin perjuicio de continuar con su trámite, los sujetos pasivos podrán acogerse a lo establecido en los Parágrafos precedentes del presente Artículo, por los importes determinados en la resolución impugnada. De establecerse diferencias a favor de la Administración Tributaria, las mismas serán pagadas de acuerdo a la norma aplicable.
                    Los sujetos pasivos que no hayan sido notificados con la orden de verificación o fiscalización, o siendo notificados no tengan vistas de cargo, podrán regularizar sus obligaciones tributarias hasta el "30 de abril de 2019", conforme a los Parágrafos precedentes del presente Artículo, mediante comprobante de pago con indicación de impuestos y periodos fiscales o declaraciones de importación. En caso de determinarse diferencias a favor de la Administración Tributaria, las mismas serán pagadas de acuerdo a la norma aplicable.

                    <h5>Nota del Editor:</h5>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i)Ley N° 1154 de 27/02/2019; Ley de Modificaciones a la Ley Nº 1105 de 28/09/2019, mediante su Artículo 2, Parágrafo I modificó el plazo de "28 de febrero de 2019" al plazo establecido en el tercer párrafo del Parágrafo precedente.
                    ii)Ley N° 1172 de 02/05/2019; en su Artículo Único, establece:
                    "ARTÍCULO ÚNICO. La presente Ley tiene por objeto establecer un nuevo periodo de regularización en el pago de deudas y multas de dominio tributario nacional, desde el 1 de mayo hasta el 28 de junio de 2019, bajo las mismas condiciones establecidas en el párrafo segundo del Parágrafo I, Parágrafos II, III, IV, V, VI, VII y VIII del Artículo 2 de la Ley N° 1105 de 28 de septiembre de 2018, modificada por la Ley N° 1154 de 27 de febrero de 2019".
                    <br>VI. Los sujetos pasivos que reconozcan obligaciones tributarias no declaradas por periodos fiscales anteriores al "2018", en las que no hubiera mediado actuación del Servicio de Impuestos Nacionales, excepcionalmente podrán regularizar su situación sin intereses ni multas, hasta el "30 de abril de 2019", de acuerdo a las siguientes condiciones:

                    <h5>Nota del Editor:</h5>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i)Ley N° 1154 de 27/02/2019; Ley de Modificaciones a la Ley Nº 1105 de 28/09/2019, mediante su Artículo 2, Parágrafo I modificó el plazo de "28 de febrero de 2019" al plazo establecido en el Parágrafo precedente.
                    ii)Ley N° 1154 de 27/02/2019; Ley de Modificaciones a la Ley Nº 1105 de 28/09/2019, mediante su Artículo 2, Parágrafo III modificó la gestión de "2015" a la gestión establecida en el Parágrafo precedente.
                    iii)Ley N° 1172 de 02/05/2019; en su Artículo Único, establece:
                    "ARTÍCULO ÚNICO. La presente Ley tiene por objeto establecer un nuevo periodo de regularización en el pago de deudas y multas de dominio tributario nacional, desde el 1 de mayo hasta el 28 de junio de 2019, bajo las mismas condiciones establecidas en el párrafo segundo del Parágrafo I, Parágrafos II, III, IV, V, VI, VII y VIII del Artículo 2 de la Ley N° 1105 de 28 de septiembre de 2018, modificada por la Ley N° 1154 de 27 de febrero de 2019".

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Los sujetos pasivos no inscritos o inscritos en un Régimen que no les corresponda a la fecha de la vigencia de la presente Ley, determinarán el Impuesto al Valor Agregado IVA, Impuesto a las Transacciones IT e Impuesto sobre las Utilidades de las Empresas IUE en forma consolidada, pagando, por única vez, al contado, el importe equivalente al doce por ciento (12%) sobre el nueve por ciento (9%) de la sumatoria de sus compras anuales de las tres (3) últimas gestiones anteriores a la presente Ley, a determinarse mediante Declaración Jurada.
                    Para acogerse a este beneficio el sujeto pasivo deberá inscribirse al Padrón Nacional de Contribuyentes en el Régimen que le corresponda.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Los sujetos pasivos inscritos en el Régimen General de Tributación, determinarán el IVA, IT e IUE en forma consolidada, pagando, por única vez, al contado el importe equivalente al doce por ciento (12%) sobre el promedio de los ingresos declarados de las tres (3) últimas gestiones anteriores a la vigencia de la presente Ley. Cuando el Número de Identificación Tributaria del sujeto pasivo se encuentre en estado inactivo, se tomará el promedio de ingresos declarados de las tres (3) gestiones anteriores a dicha inactivación.
                    De no existir ingresos declarados en alguna de las tres (3) gestiones para la determinación del promedio, se sumarán y promediarán los ingresos de las gestiones que reflejen ingresos anuales.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;3. Los sujetos pasivos del Régimen Complementario al Impuesto al Valor Agregado R IVA, podrán pagar al contado, por única vez, el importe equivalente al cuatro por ciento (4%) sobre los ingresos percibidos en los últimos doce (12) meses anteriores a la publicación de la presente Ley.
                    Los sujetos pasivos que se acojan a los beneficios establecidos en el presente Parágrafo, no serán objeto de fiscalización por los periodos fiscales regularizados anteriores a la gestión 2015.

                    <br>VII. Los sujetos pasivos que hubiesen declarado incorrectamente su obligación tributaria por la importación de mercancías, en periodos fiscales anteriores al 2018, siempre que no haya mediado actuación de la Aduana Nacional, podrán excepcionalmente regularizar su situación sin intereses ni multas, hasta el 30 de abril de 2019, pagando por única vez al contado y de forma consolidada los tributos de importación en el importe equivalente al catorce por ciento (14%) sobre el promedio anual de sus importaciones de las gestiones 2014, 2015, 2016 y 2017.
                    Los sujetos pasivos que se acojan a los beneficios establecidos en el presente Parágrafo, no serán objeto de fiscalización por los periodos regularizados anteriores a la gestión 2018.

                    <h5>Nota del Editor:</h5>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i)Ley N° 1154 de 27/02/2019; Ley de Modificaciones a la Ley Nº 1105 de 28/09/2019, mediante su Artículo 2, Parágrafo IV modificó el Parágrafo precedente.
                    ii)Ley N° 1172 de 02/05/2019; en su Artículo Único, establece:
                    "ARTÍCULO ÚNICO. La presente Ley tiene por objeto establecer un nuevo periodo de regularización en el pago de deudas y multas de dominio tributario nacional, desde el 1 de mayo hasta el 28 de junio de 2019, bajo las mismas condiciones establecidas en el párrafo segundo del Parágrafo I, Parágrafos II, III, IV, V, VI, VII y VIII del Artículo 2 de la Ley N° 1105 de 28 de septiembre de 2018, modificada por la Ley N° 1154 de 27 de febrero de 2019".

                    <br>VIII. El incumplimiento de las facilidades de pago por deudas tributarias, dará lugar a la pérdida de los beneficios establecidos en la presente Ley, en cuyo caso el saldo del tributo omitido pendiente de pago, deberá ser calculado y pagado de acuerdo al Artículo 47 de la Ley N° 2492, más las multas de Ley que correspondan al saldo de las cuotas incumplidas.

                    En el caso de incumplimiento de facilidades de pago de las multas distintas a las previstas en el Parágrafo I, el saldo de las mismas será pagado sin los beneficios establecidos en la presente Ley.

                    <h5>Nota del Editor:</h5>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i)Ley N° 1154 de 27/02/2019; Ley de Modificaciones a la Ley Nº 1105 de 28/09/2019, mediante su Artículo 2, Parágrafo V incorporó el Parágrafo precedente.
                    ii)Ley N° 1172 de 02/05/2019; en su Artículo Único, establece:
                    "ARTÍCULO ÚNICO. La presente Ley tiene por objeto establecer un nuevo periodo de regularización en el pago de deudas y multas de dominio tributario nacional, desde el 1 de mayo hasta el 28 de junio de 2019, bajo las mismas condiciones establecidas en el párrafo segundo del Parágrafo I, Parágrafos II, III, IV, V, VI, VII y VIII del Artículo 2 de la Ley N° 1105 de 28 de septiembre de 2018, modificada por la Ley N° 1154 de 27 de febrero de 2019".

                    DISPOSICIÓN ADICIONAL

                    ÚNICA. Se modifica el Artículo 67 de la Ley N° 2492 de 2 de agosto de 2003, "Código Tributario Boliviano", incorporándose el Parágrafo IV, con el siguiente texto:
                    <br>IV. La Administración Tributaria otorgará información a las Administraciones Tributarias de otros países, en el marco de instrumentos jurídicos internacionales para el intercambio de información.
                    Remítase al Órgano Ejecutivo para fines constitucionales.
                    Es dada en la Sala de Sesiones de la Asamblea Legislativa Plurinacional, a los veinte días del mes de septiembre del año dos mil dieciocho.


























                    215
                    LEY N° 1154
                    DE 27/02/2019

                    <h4>ARTÍCULO 1</h4> (OBJETO). La presente Ley tiene por objeto modificar la Ley N° 1105 de 28 de septiembre de 2018.
                    <h4>ARTÍCULO 2</h4> (MODIFICACIONES).
                    <br>I. Se "modifica" el plazo establecido en el Artículo 1 y en los Parágrafos I, II, IV, "V".y VI del Artículo 2 de la Ley N° 1105 de 28 de septiembre de 2018, de "28 de febrero de 2019" por "30 de abril de 2019".

                    <h5>Nota del Editor:</h5>
                    Mediante Fe de Erratas publicada por la Gaceta Oficial de Bolivia Nº1150 de 13/03/2019, se corrigió el Artículo 2, Parágrafo I de la Ley Nº1154, incluyendo el parágrafo "V".

                    <br>II. Se "modifica" el segundo párrafo del Parágrafo V del Artículo 2 de la Ley N° 1105 de 28 de septiembre de 2018, con el siguiente texto:
                    "Los sujetos pasivos con procesos administrativos tributarios impugnados en la vía administrativa o judicial, para acogerse a lo dispuesto en los Parágrafos precedentes del presente Artículo, previamente deberán presentar su desistimiento por el total o una parte de los adeudos tributarios y/o multas que deseen acogerse a los beneficios establecidos en la presente Ley."

                    <br>III. Se "modifica" la gestión establecida en el Parágrafo VI del Artículo 2 de la Ley N° 1105 de 28 de septiembre de 2018, de "2015" por "2018".

                    <br>IV. Se "modifica" el Parágrafo VII del Artículo 2 de la Ley N° 1105 de 28 de septiembre de 2018, con el siguiente texto:

                    "VII. Los sujetos pasivos que hubiesen declarado incorrectamente su obligación tributaria por la importación de mercancías, en periodos fiscales anteriores al 2018, siempre que no haya mediado actuación de la Aduana Nacional, podrán excepcionalmente regularizar su situación sin intereses ni multas, hasta el 30 de abril de 2019, pagando por única vez al contado y de forma consolidada los tributos de importación en el importe equivalente al catorce por ciento (14%) sobre el promedio anual de sus importaciones de las gestiones 2014, 2015, 2016 y 2017.

                    Los sujetos pasivos que se acojan a los beneficios establecidos en el presente Parágrafo, no serán objeto de fiscalización por los periodos regularizados anteriores a la gestión 2018".

                    <br>V. Se modifica el Artículo 2 de la Ley N° 1105 de 28 de septiembre de 2018, incorporando el Parágrafo VIII, con el siguiente texto:

                    "VIII. El incumplimiento de las facilidades de pago por deudas tributarias, dará lugar a la pérdida de los beneficios establecidos en la presente Ley, en cuyo caso el saldo del tributo omitido pendiente de pago, deberá ser calculado y pagado de acuerdo al Artículo 47 de la Ley N° 2492, más las multas de Ley que correspondan al saldo de las cuotas incumplidas.

                    En el caso de incumplimiento de facilidades de pago de las multas distintas a las previstas en el Parágrafo I, el saldo de las mismas será pagado sin los beneficios establecidos en la presente Ley".

                    DISPOSICIÓN ADICIONAL

                    ÚNICA. Los sujetos pasivos que se hubieran acogido a los beneficios establecidos en el Parágrafo VI del Artículo 2 de la Ley N° 1105 de 28 de septiembre de 2018, tendrán por regularizados los impuestos correspondientes a las gestiones 2015, 2016 y 2017, y no serán objeto de fiscalización, salvo aquellos casos en que hubiesen sido notificados con órdenes correspondientes a dichas gestiones con anterioridad al pago único.

                    Remítase al Órgano Ejecutivo para fines constitucionales.

                    Es dada en la Sala de Sesiones de la Asamblea Legislativa Plurinacional, a los veintiséis días del mes de febrero del año dos mil diecinueve.

                    217
                    LEY N° 1172
                    DE 02/05/2019

                    ARTÍCULO ÚNICO. La presente Ley tiene por objeto establecer un nuevo periodo de regularización en el pago de deudas y multas de dominio tributario nacional, desde el 1 de mayo hasta el 28 de junio de
                    2019, bajo las mismas condiciones establecidas en el párrafo segundo del Parágrafo I, Parágrafos II, III, IV, V, VI, VII y VIII del Artículo 2 de la Ley N° 1105 de 28 de septiembre de 2018, modificada por la Ley N° 1154 de 27 de febrero de 2019.

                    Remítase al Órgano Ejecutivo para fines constitucionales.

                    Es dada en la Sala de Sesiones de la Asamblea Legislativa Plurinacional, al primer día del mes de mayo del año dos mil diecinueve.

                    DECRETOS SUPREMOS INHERENTES AL CÓDIGO TRIBUTARIO BOLIVIANO

                    DECRETO SUPREMO N° 27310

                    REGLAMENTO AL CÓDIGO TRIBUTARIO BOLIVIANO

                    de 09/01/2004

                    CONSIDERANDO:

                    Que mediante Ley Nº 2492 de 2 de agosto de 2003, se promulga el Código Tributario Boliviano y, que en aplicación de lo establecido por su Disposición Final Décima, la norma se encuentra vigente a la fecha.
                    Que en el texto de la citada Ley se han contemplado aspectos a ser desarrollados mediante disposición reglamentaria, independientemente de las normas administrativas de carácter general que emitan las Administraciones Tributarias en ejercicio de la facultad que la propia Ley les confiere.

                    EN CONSEJO DE GABINETE, DECRETA:

                    <h3>CAPÍTULO I DISPOSICIONES GENERALES</h3>

                    <h4>ARTÍCULO 1</h4> (OBJETO). El presente Decreto Supremo tiene por objeto reglamentar la Ley Nº 2492 de 2 de agosto de 2003 Código Tributario Boliviano.
                    <h4>ARTÍCULO 2</h4> (VIGENCIA).
                    <br>I. A efecto de la aplicación de lo dispuesto en el Artículo 3 de la Ley Nº 2492, en tanto la Administración Tributaria no cuente con órganos de difusión propios, será válida la publicación realizada en al menos un medio de prensa de circulación nacional.
                    <br>II. En el caso de tributos municipales, la publicación de las Ordenanzas Municipales de Tasas y Patentes se realizará juntamente con la Resolución Senatorial respectiva. Tanto ésta como las normas reglamentarias administrativas, podrán publicarse en un medio de prensa de circulación nacional o local y en los que no existiera, se difundirán a través de otros medios de comunicación locales.

                    <h5>Nota del Editor:</h5>
                    Ley N° 031 de 19/07/2010; Ley Marco de Autonomías y Descentralización "Andrés Ibáñez", mediante las Disposiciones Abrogatorias y Derogatorias, Disposiciones Derogatorias, Numeral 1, derogó implícitamente la primera parte del Parágrafo II del Artículo precedente.

                    <h4>ARTÍCULO 3</h4> (SUJETO ACTIVO).

                    <br>I. A efectos de la Ley Nº 2492, se entiende por Administración o Administración Tributaria a cualquier ente público con facultades de gestión tributaria expresamente otorgadas por Ley.

                    <br>II. En el ámbito municipal, las facultades a que se refiere el Artículo 21 de la Ley citada, serán ejercitadas por la Dirección de Recaudaciones o el órgano facultado para cumplir estas funciones mediante Resolución Técnica Administrativa emitida por la máxima autoridad ejecutiva municipal.

                    <br>III. La concesión a terceros de actividades de alcance tributario previstas en la Ley Nº 2492, requerirá la autorización previa de la máxima autoridad normativa del Servicio de Impuestos Nacionales o de la Aduana Nacional y de una Ordenanza Municipal en el caso de los Gobiernos Municipales, acorde con lo establecido en el Artículo 21 de la mencionada ley.

                    En el caso de la Aduana Nacional, si dichas actividades o servicios no son otorgados en concesión, serán prestados por dicha entidad con arreglo a lo dispuesto en el inciso a) del Artículo 29 del Reglamento a la Ley General de Aduanas.

                    <br>IV. Por medio de su máxima autoridad ejecutiva y cumpliendo las normas legales de control gubernamental, las Administraciones Tributarias podrán suscribir convenios o contratos con entidades públicas y privadas para colaborar en las gestiones propias de su actividad institucional, estableciendo la remuneración correspondiente por la realización de tales servicios, debiendo asegurar, en todos los casos, que se resguarde el interés fiscal y la confidencialidad de la información tributaria.

                    <br>V. Las normas administrativas que con alcance general dicte la Aduana Nacional, respecto a tributos que se hallen a su cargo, podrán ser impugnadas conforme a lo establecido en el Artículo 130 de la Ley Nº 2492. Las resoluciones de la máxima autoridad normativa de la Aduana Nacional, que no se refieran a tributos podrán ser impugnadas conforme a las previsiones del Artículo 38 de la Ley General de Aduanas.

                    <h4>ARTÍCULO 4</h4> (RESPONSABLES DE LA OBLIGACIÓN TRIBUTARIA). Son responsables de la obligación tributaria:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) El Sujeto pasivo en calidad de contribuyente o su sustituto en los términos definidos en la Ley Nº 2492.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Los terceros responsables por representación o por sucesión, conforme a lo previsto en la ley citada y los responsables establecidos en la Ley Nº 1990 y su reglamento.

                    <h4>ARTÍCULO 5</h4> (PRESCRIPCIÓN). El sujeto pasivo o tercero responsable podrá solicitar la prescripción tanto en sede administrativa como judicial inclusive en la etapa de ejecución tributaria.

                    A efectos de la prescripción prevista en los Artículos 59 y 60 de la Ley Nº 2492, los términos se computarán a partir del primero de enero del año calendario siguiente a aquel en que se produjo el vencimiento del plazo de pago.

                    <h4>ARTÍCULO 6</h4> (AGENTES DE INFORMACIÓN). A los efectos del Parágrafo II del Artículo 71 de la Ley Nº 2492, las máximas autoridades normativas de cada Administración Tributaria, mediante resolución, definirán los agentes de información, la forma y los plazos para el cumplimiento de la obligación de proporcionar información.

                    <h4>ARTÍCULO 7</h4> (MEDIOS E INSTRUMENTOS TECNOLÓGICOS). Las operaciones electrónicas realizadas y registradas en el sistema informático de la Administración Tributaria por un usuario autorizado surten efectos jurídicos.
                    La información generada, enviada, recibida, almacenada o comunicada a través de los sistemas informáticos o medios electrónicos, por cualquier usuario autorizado que de cómo resultado un registro electrónico, tiene validez probatoria.


                    Salvo prueba en contrario, se presume que toda operación electrónica registrada en el sistema informático de la Administración Tributaria pertenece al usuario autorizado.
                    A efectos del ejercicio de las facultades previstas en el Artículo 21 de la Ley Nº 2492, la Administración Tributaria establecerá y desarrollará bases de datos o de información actualizada, propia o procedente de terceros, a las que accederá con el objeto de contar con información objetiva.

                    Las impresiones o reproducciones de los registros electrónicos generados por los sistemas informáticos de la Administración Tributaria, tienen validez probatoria siempre que sean certificados o acreditados por el servidor público a cuyo cargo se encuentren dichos registros. A fin de asegurar la inalterabilidad y seguridad de los registros electrónicos, la Administración Tributaria adoptará procedimientos y medios tecnológicos de respaldo o duplicación.

                    Asimismo, tendrán validez probatoria las impresiones o reproducciones que obtenga la Administración Tributaria de los registros electrónicos generados por los sistemas informáticos de otras administraciones tributarias y de entidades públicas o privadas. Las Administraciones Tributarias dictarán las disposiciones reglamentarias y procedimentales para la aplicación del presente Artículo.

                    <h4>ARTÍCULO 8</h4> (DETERMINACIÓN Y COMPOSICIÓN DE LA DEUDA TRIBUTARIA). La deuda tributaria se configura al día siguiente de la fecha de vencimiento del plazo para el pago de la obligación tributaria, sin necesidad de actuación alguna de la Administración Tributaria y debe incluir su actualización en Unidades de Fomento de Vivienda UFV's e intereses de acuerdo a lo dispuesto en el Artículo 47 de la Ley N° 2492.

                    El período de la mora para el pago de la deuda tributaria, se computará a partir del día siguiente a la fecha de vencimiento del plazo para el pago de la obligación tributaria, hasta el día de pago.

                    La deuda tributaria expresada en UFV's, al momento de hacerse efectivo el pago deberá ser convertida en moneda nacional, utilizando la UFV de la fecha de pago.

                    A efectos del cálculo de los montos indebidamente devueltos, se considerará el mantenimiento de valor e intereses, desde la fecha de la devolución indebida hasta la fecha de su restitución, sin perjuicio de la aplicación de la multa por contravención de omisión de pago que corresponda.


                    223

                    <h5>Nota del Editor</h5>
                    D.S. N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo I, modificó el Artículo precedente.

                    <h4>ARTÍCULO 9</h4> (INTERESES). El importe del interés (I) generado en todo el período de la mora, será resultado de la sumatoria de los intereses calculados con la tasa que corresponda a cada uno de los períodos de tiempo establecidos en el Artículo 47 de la Ley N° 2492, y se determinarán de acuerdo al cálculo establecido en el Anexo 1 que forma parte íntegra e indivisible del presente Reglamento.

                    <h5>Nota del Editor</h5>
                    D.S. N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo II, modificó el Artículo precedente.

                    <h4>ARTÍCULO 10</h4> (PAGOS PARCIALES Y PAGOS A CUENTA).

                    <br>I. Los pagos parciales de la deuda tributaria, incluidas las cuotas pagadas en facilidades de pago incumplidas, serán convertidos a valor presente a la fecha de vencimiento del plazo de pago de la obligación tributaria, de acuerdo a lo establecido en el Anexo 2 del presente Decreto Supremo y se deducirán como pago a cuenta de dicha deuda.

                    <h5>Nota del Editor</h5>
                    D.S. N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo III, modificó el Parágrafo precedente.

                    <br>II. En el ámbito municipal, mediante norma administrativa de carácter general se podrán establecer la forma, modalidades y procedimientos para recibir pagos a cuenta de tributos cuyo vencimiento no se hubiera producido.

                    <h4>ARTÍCULO 11</h4> (MEDIDAS PRECAUTORIAS).
                    <br>I. Para efectos de la aplicación de las medidas precautorias señaladas en el Artículo 106 de la Ley Nº 2492, se entenderá que existe riesgo fundado de que el cobro de la deuda tributaria o del monto indebidamente devuelto se vea frustrado o perjudicado, cuando se presenten entre otras, cualquiera de las siguientes situaciones:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Inactivación del número de registro.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Inicio de quiebra o solicitud de concurso de acreedores, así como la existencia de juicios coactivos y ejecutivos.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Cambio de domicilio sin la comunicación correspondiente a la Administración Tributaria o casos de domicilio falso o inexistente.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Cuando la realidad económica, financiera y/o patrimonial del sujeto pasivo o tercero responsable no garantice el cumplimiento de la obligación tributaria.

                    <br>II. La autorización para la adopción de medidas precautorias por parte de la Superintendencia Tributaria a la que se hace referencia en la norma señalada, se realizará siguiendo el procedimiento establecido en el Artículo 31 del Decreto Supremo Nº 27241 de 14 de noviembre de 2003 que establece los procedimientos administrativos ante la Superintendencia Tributaria.
                    <br>III. Cuando se requiera la utilización de medios de propiedad privada para la ejecución de las medidas precautorias, el pago por sus servicios será realizado por el sujeto pasivo o tercero responsable afectado con dicha medida.
                    <h4>ARTÍCULO 12</h4> (NOTIFICACIÓN ELECTRÓNICA).
                    <br>I. Para efectos de lo dispuesto en el Artículo 83 Bis de la Ley N° 2492, la Vista de Cargo, Auto Inicial de Sumario, Resolución Determinativa, Resolución Sancionatoria, proveído que dé inicio a la ejecución tributaria y cualquier Resolución Definitiva, podrán ser notificados por correo electrónico u otros medios electrónicos, en una dirección electrónica fijada por el contribuyente o tercero responsable o asignada por la Administración Tributaria.
                    La notificación electrónica se tendrá por efectuada en los siguientes casos, lo que ocurra primero:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. En la fecha en que el contribuyente o tercero responsable proceda a la apertura del documento enviado;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. A los cinco (5) días posteriores a:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) La fecha de recepción de la notificación en el correo electrónico; o
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) La fecha de envío al medio electrónico implementado por la Administración Tributaria.

                    El soporte físico de la apertura del documento notificado o de la constancia de recepción en el correo electrónico o envío al medio electrónico, según corresponda, deberá ser adjuntado al expediente, consignando la firma, nombre y cargo del servidor público responsable de la notificación.


                    Cuando no sea posible la notificación por medios electrónicos, la Administración Tributaria procederá a la notificación del sujeto pasivo o tercero responsable de acuerdo al procedimiento establecido en los Artículos 84, 85 y 86 de la Ley N° 2492, según corresponda.

                    <br>II.
                    La Administración Tributaria, a través de medios electrónicos, teléfono fijo o móvil,


                    proporcionará a los contribuyentes o terceros responsables información referida a fechas de
                    225

                    vencimiento, existencia de actuaciones administrativas, alertas, recordatorios y cualquier otra
                    de naturaleza tributaria. De igual manera, deberá habilitar los medios para que el contribuyente efectúe consultas, reclamos, denuncias, trámites administrativos y otros por los mismos mecanismos.
                    <br>III. A efectos de la aplicación del presente Artículo, la Administración Tributaria emitirá norma administrativa reglamentaria.

                    <h5>Nota del Editor</h5>
                    D.S. N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo IV, modificó el Artículo precedente.

                    <h4>ARTÍCULO 13</h4> (NOTIFICACIONES MASIVAS).

                    <br>I. Las notificaciones masivas deben señalar el nombre del sujeto pasivo o tercero responsable, su número de registro en la Administración Tributaria, la identificación del acto administrativo y la dependencia donde debe apersonarse.
                    <br>II. Las Administraciones Tributarias podrán utilizar las notificaciones masivas para cualquier acto que no esté sujeto a un medio específico de notificación, conforme lo dispuesto por la Ley Nº 2492.
                    <br>III. Las cuantías para practicar esta forma de notificación serán:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Para el Servicio de Impuestos Nacionales y la Aduana Nacional, hasta diez mil Unidades de Fomento de la Vivienda (10.000 UFV's) por cada acto administrativo.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Para los Gobiernos Municipales, las que establezcan mediante resolución de la máxima autoridad tributaria.

                    <h4>ARTÍCULO 14</h4> (CONSULTA). La consulta se presentará ante la máxima autoridad ejecutiva de la Administración Tributaria. En el ámbito municipal se presentará ante la Dirección de Recaudaciones o la autoridad equivalente en cada jurisdicción municipal.
                    La consulta deberá contener los siguientes requisitos mínimos:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Nombre o razón social del consultante.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Personería y representación.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Domicilio.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Descripción del hecho, acto u operación concreta y real.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Indicación de la disposición normativa sobre cuya aplicación o alcance se efectúa la consulta.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) Opinión fundada sobre la aplicación y alcance de la norma tributaria, confusa o controvertible.
                    Las Administraciones Tributarias, mediante resolución expresa, definirán otros requisitos, forma y procedimientos para la presentación, admisión y respuesta a las consultas.
                    <h4>ARTÍCULO 15</h4> (COMPENSACIÓN). La compensación a que se refiere el Artículo 56 de la Ley Nº 2492 también procederá sobre las solicitudes que los sujetos pasivos o terceros responsables realicen antes del vencimiento del tributo que desean sea compensado. Sin embargo estas solicitudes no eximen del pago de las sanciones y la liquidación de la deuda tributaria conforme lo dispuesto en el Artículo 47 de la referida Ley, en caso que la solicitud resulte improcedente.
                    La compensación de oficio procederá únicamente sobre deudas tributarias firmes y exigibles.
                    Los procedimientos y mecanismos de compensación serán reglamentados por la Administración Tributaria.

                    <h4>ARTÍCULO 16</h4> (REPETICIÓN).

                    <br>I. La acción de repetición dispuesta en los Artículos 121 y siguientes de la Ley Nº 2492 comprende los tributos, intereses y multas pagados indebidamente o en exceso, quedando facultada, la Administración Tributaria, a detallar los casos por los cuales no corresponde su atención.
                    <br>II. La Administración Tributaria que hubiera recibido el pago indebido o en exceso es competente para resolver la acción de repetición en el término máximo de cuarenta y cinco (45) días computables a partir del día siguiente hábil de la presentación de la documentación requerida; en caso de ser procedente, la misma Administración Tributaria emitirá la nota de crédito fiscal por el monto autorizado en la resolución correspondiente.

                    <h4>ARTÍCULO 17</h4> (SECUESTRO O INCAUTACIÓN DE DOCUMENTACIÓN E INFORMACIÓN). La Administración Tributaria podrá secuestrar o incautar documentación y obtener copias de la información contenida en sistemas informáticos y/o unidades de almacenamiento cuando el sujeto pasivo o tercero responsable no presente la información o documentación requerida o cuando considere que existe riesgo para conservar la prueba que sustente la determinación de la deuda tributaria, aplicando el siguiente procedimiento:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) La autoridad competente de la Administración Tributaria solicitará la participación de un representante del Ministerio Público, quien tendrá la obligación de asistir a sólo requerimiento de la misma, para efectuar el secuestro o incautación de documentación o copia de la información electrónica del contribuyente.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) En presencia de dicha autoridad se procederá al secuestro de la documentación y, en su caso, a la copia de la información de los sistemas informáticos del sujeto pasivo.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Finalmente se labrará un Acta de Secuestro o Incautación de Documentación o Información Electrónica, que deberá ser firmada por los actuantes y el sujeto pasivo o tercero responsable o la persona que se encontrara en el lugar, salvo que no quisiera hacerlo, en cuyo caso con la intervención de un testigo de actuación se deberá dejar constancia del hecho.

                    <h4>ARTÍCULO 18</h4> (VISTA DE CARGO). La Vista de Cargo que dicte la Administración, deberá consignar los siguientes requisitos esenciales:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Número de la Vista de Cargo.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Fecha.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Nombre o razón social del sujeto pasivo.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Número de registro tributario, cuando corresponda.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Indicación del tributo (s) y, cuando corresponda, período (s) fiscal (es). f) Liquidación previa de la deuda tributaria.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;g) Acto u omisión que se atribuye al presunto autor, así como la calificación de la sanción en el caso de las contravenciones tributarias y requerimiento a la presentación de descargos, en el marco de lo dispuesto en el Parágrafo I del Artículo 98 de la Ley Nº 2492.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;h) Firma, nombre y cargo de la autoridad competente.

                    <h4>ARTÍCULO 19</h4> (RESOLUCIÓN DETERMINATIVA). La Resolución Determinativa deberá consignar los requisitos mínimos establecidos en el Artículo 99 de la Ley Nº 2492.

                    Las especificaciones sobre la deuda tributaria se refieren al origen, concepto y determinación del adeudo tributario calculado de acuerdo a lo establecido en el Artículo 47 de dicha Ley.

                    En el ámbito aduanero, los fundamentos de hecho y de derecho contemplarán una descripción concreta de la declaración aduanera, acto o hecho y de las disposiciones legales aplicables al caso.

                    <h4>ARTÍCULO 20</h4> (MONTOS MÍNIMOS PARA LA EJECUCIÓN TRIBUTARIA). La facultad otorgada al Ministerio de Hacienda para establecer montos mínimos a partir de los cuales el Servicio de Impuestos Nacionales y la Aduana Nacional deban efectuar el inicio de la ejecución tributaria, será ejercitada mediante la emisión de una Resolución Ministerial expresa. Los montos así definidos estarán expresados en Unidades de Fomento de la Vivienda UFV's.

                    <h4>ARTÍCULO 21</h4> (PROCEDIMIENTO PARA SANCIONAR CONTRAVENCIONES TRIBUTARIAS). El procedimiento administrativo para sancionar contravenciones tributarias podrá realizarse:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) De forma independiente, cuando la contravención se hubiera detectado a través de acciones que no emergen del procedimiento de determinación.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) De forma consecuente, cuando el procedimiento de determinación concluye antes de la emisión de la Vista de Cargo, debido al pago total de la deuda tributaria, surgiendo la necesidad de iniciar un sumario contravencional.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) De forma simultánea, cuando el sumario contravencional se subsume en el procedimiento de determinación, siendo éste el que establece la comisión o no de una contravención tributaria.

                    La Administración Tributaria queda facultada para establecer las disposiciones e instrumentos necesarios

                    <h3>CAPÍTULO II

                        DISPOSICIONES RELATIVAS AL SERVICIO DE IMPUESTOS NACIONALES Y A LOS GOBIERNOS MUNICIPALES</h3>

                    <h4>ARTÍCULO 22</h4> (DOMICILIO MUNICIPAL). Para el ámbito municipal, el domicilio legal deberá ser fijado dentro la jurisdicción territorial del municipio respectivo.

                    <h4>ARTÍCULO 23</h4> (DETERMINACIÓN SOBRE BASE PRESUNTA EN EL ÁMBITO MUNICIPAL). En el marco de lo dispuesto en el Numeral 6 del Artículo 44 de la Ley Nº 2492, en el ámbito municipal también se justificará la determinación sobre base presunta, cuando se verifique en el registro del padrón municipal una actividad distinta a la realizada.

                    <h4>ARTÍCULO 24</h4> (FACILIDADES DE PAGO).
                    <br>I. Conforme lo dispuesto por el Artículo 55 de la Ley Nº 2492, las Administraciones Tributarias podrán, mediante resolución administrativa de carácter particular, conceder facilidades de pago para las obligaciones generadas antes o después del vencimiento de los tributos que los dieron origen, tomando en cuenta las siguientes condiciones:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Tasa de Interés Tasa de interés r, definida en el Artículo 9 de este Decreto Supremo.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Plazo y numero de cuotas El plazo podrá ser de hasta sesenta (60) meses, en cuotas mensuales, computables a partir del primer día del mes siguiente a la fecha de la notificación de la Resolución Administrativa.
                    A partir de la presentación de la solicitud, la Administración Tributaria contara con (20) veinte días de plazo para emitir y notificar la Resolución Administrativa de aceptación o rechazo.

                    <h5>Nota del Editor</h5>
                    D.S. N° 3442 de 27/12/2017, en su Artículo 2, Parágrafo I, modificó el Inciso precedente.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Pago Inicial, garantías y otras condiciones en la forma definida en la reglamentación que emita la Administración Tributaria.
                    <br>II. No se podrán conceder facilidades de pago para retenciones y percepciones de tributos o para aquellos tributos cuyo pago sea requisito en los trámites administrativos, judiciales o transferencia del derecho propietario, excepto cuando la deuda tributaria sea establecida en un procedimiento de determinación de oficio.

                    <h5>Nota del Editor</h5>
                    D.S. N° 3442 de 27/12/2017, en su Artículo 2, Parágrafo II, modificó el Parágrafo precedente.

                    <br>III. Los sujetos pasivos o terceros responsables que incumplan la facilidad de pago otorgada, no podrán volver a solicitar facilidades de pago por la misma deuda o sus saldos y dará lugar a la ejecución de las garantías y medidas coactivas señaladas en la Ley N° 2492, si corresponde.

                    Asimismo, el sujeto pasivo o tercero responsable que haya solicitado facilidades de pago con el beneficio del arrepentimiento eficaz o reducción de sanciones, perderá estos beneficios debiendo la Administración Tributaria iniciar o continuar el sumario contravencional que corresponda, aplicando o imponiendo la multa por omisión de pago calculado sobre el tributo omitido actualizado pendiente de pago.

                    En las facilidades de pago otorgadas después de notificada la vista de cargo o auto inicial de sumario contravencional, la resolución administrativa que concede la facilidad de pago tendrá por efecto la conclusión del proceso de determinación y la suspensi6n del sumario contravencional así como del término de la prescripción, debiendo continuar el computo de los plazos a partir del día siguiente a la fecha de incumplimiento.

                    En la deuda tributaria con facilidad de pago incumplida, los sucesores de las personas naturales, las personas colectivas o jurídicas sucesoras en los pasivos tributarios de otra y los socios o accionistas que asuman la responsabilidad de sociedades en liquidación o disolución, podrán solicitar una nueva facilidad de pago, por única vez.

                    <h5>Nota del Editor</h5>
                    D.S. N° 3442 de 27/12/2017, en su Artículo 2, Parágrafo III, modificó el Parágrafo precedente.

                    <br>IV. En el ámbito municipal no procederá la transferencia de bienes inmuebles ni vehículos automotores, ni el cambio de radicatoria de estos, en tanto exista un plan de facilidades de pago vigente relacionado con el impuesto que grava la propiedad de los mismos.

                    <br>V. Las Administraciones Tributarias están facultadas a emitir los reglamentos que complementen lo dispuesto en el presente Artículo.

                    <h4>ARTÍCULO 25</h4> (DECLARACIONES JURADAS EN EL ÁMBITO MUNICIPAL). En el ámbito municipal, la declaración que realizan los sujetos pasivos o terceros responsables sobre las características de sus bienes gravados, que sirven para determinar la base imponible de los impuestos bajo su dominio, se entiende que son declaraciones juradas.

                    Estas declaraciones pueden ser rectificadas o modificadas por los sujetos pasivos o terceros responsables o a requerimiento de la Administración Tributaria, en los formularios que para este efecto se establezcan.

                    <h4>ARTÍCULO 26</h4> (DECLARACIONES JURADAS RECTIFICATORIAS).
                    <br>I. En el caso del Servicio de Impuestos Nacionales, las declaraciones juradas rectificatorias pueden ser de dos tipos;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Las que incrementen el saldo a favor del fisco o disminuyan el saldo a favor del contribuyente, que se denominarán "Rectificatorias a favor del Fisco".

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Las que disminuyan el saldo a favor del fisco o incrementen el saldo a favor del contribuyente, que se denominarán "Rectificatorias a favor del Contribuyente".

                    <br>II. Se faculta al Servicio de Impuestos Nacionales a reglamentar el tratamiento de los débitos y/o créditos producto de la presentación de declaraciones juradas rectificatorias.

                    <h4>ARTÍCULO 27</h4> (RECTIFICATORIAS A FAVOR DEL FISCO).

                    <br>I. El contribuyente o tercero responsable podrá rectificar su Declaración Jurada con saldo a favor del fisco en cualquier momento.

                    Las Declaraciones Juradas rectificatorias presentadas una vez iniciada la fiscalización o verificación, no tendrán efecto en la determinación de oficio. Los pagos a que den lugar estas declaraciones, serán considerados como pagos a cuenta de la deuda a determinarse por la Administración Tributaria.

                    La presentación de la Declaración Jurada Rectificatoria no suspende el proceso de ejecución iniciado por la Declaración Jurada original o la última presentada.

                    Cuando la Declaración Jurada Rectificatoria sea por un importe mayor al tributo determinado en la Declaración Jurada Original o la última presentada, la Administración Tributaria procederá a su ejecución únicamente por la diferencia del impuesto determinado.

                    <h5>Nota del Editor</h5>
                    D.S. N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo V, modificó el Parágrafo precedente.

                    <br>II. La diferencia resultante de una Rectificatoria a favor del Fisco, que hubiera sido utilizada indebidamente como crédito, será considerada como tributo omitido. El importe será calculado de acuerdo a lo establecido en el Artículo 47 de la Ley Nº 2492 desde el día siguiente de la fecha de vencimiento del impuesto al que corresponde la declaración jurada rectificatoria.
                    <br>III. Cuando la Rectificatoria a Favor del Fisco disminuya el saldo a favor del contribuyente y éste no alcance para cubrir el "crédito IVA comprometido" para la devolución de títulos valores, la diferencia se considerará como tributo omitido y será calculado de acuerdo a lo establecido en el Artículo 47 de la Ley Nº 2492 desde el día siguiente de la fecha de vencimiento del impuesto al que corresponde la declaración jurada rectificatoria.

                    <h4>ARTÍCULO 28</h4> (RECTIFICATORIA A FAVOR DEL CONTRIBUYENTE).

                    <br>I. La Declaración Jurada Rectificatoria que incremente saldos a favor del contribuyente podrá ser efectuada por una sola vez, por cada impuesto y período fiscal.

                    <h5>Nota del Editor</h5>
                    D.S. N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo VI, modificó el Parágrafo precedente.

                    <br>II. Esta rectificatoria, conforme lo dispuesto en el párrafo segundo del Parágrafo II del Artículo 78 de la Ley N° 2492, deberá ser aprobada por la Administración Tributaria antes de su presentación. La aprobación será resultado de la verificación de los documentos que respalden la determinación del tributo, conforme se establezca en la reglamentación que emita la Administración Tributaria.

                    <h5>Nota del Editor</h5>
                    D.S. N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo VI, modificó el Parágrafo precedente.

                    <br>III. Previa aceptación del interesado, si la Rectificatoria originara un pago indebido o en exceso, éste será considerado como un crédito a favor del contribuyente, salvando su derecho a solicitar su devolución mediante la Acción de Repetición.

                    <br>IV. La solicitud de rectificación de la Declaración Jurada podrá ser presentada hasta antes de que concluya el período de prescripción, o hasta antes del inicio de la Fiscalización o Verificación, lo que ocurra primero.

                    <h5>Nota del Editor</h5>
                    D.S. N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo VI, modificó el Parágrafo precedente.

                    <h4>ARTÍCULO 29</h4> (DETERMINACIÓN DE LA DEUDA POR PARTE DE LA ADMINISTRACIÓN). La determinación de la deuda tributaria por parte de la Administración se realizará mediante los procesos de fiscalización, verificación, control o investigación realizados por el Servicio de Impuestos Nacionales que, por su alcance respecto a los impuestos, períodos y hechos, se clasifican en:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Determinación total, que comprende la fiscalización de todos los impuestos de por lo menos una gestión fiscal.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Determinación parcial, que comprende la fiscalización de uno o más impuestos de uno o más períodos.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Verificación y control puntual de los elementos, hechos, transacciones económicas y circunstancias que tengan incidencia sobre el importe de los impuestos pagados o por pagar.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Verificación y control del cumplimiento a los deberes formales.

                    Si en la aplicación de los procedimientos señalados en los literales a), b) y c) se detectara la falta de cumplimiento a los deberes formales, se incorporará los cargos que correspondieran.

                    <h4>ARTÍCULO 30</h4> (RESTRICCIÓN A LAS FACULTADES DE CONTROL, VERIFICACIÓN, INVESTIGACIÓN Y FISCALIZACIÓN). A los efectos de lo dispuesto por el Parágrafo II del Artículo 93 de la Ley Nº 2492, la Administración Tributaria podrá efectuar el proceso de determinación de impuestos, hechos, transacciones económicas y elementos que no hubiesen sido afectados dentro del alcance de un proceso de determinación o verificación anterior, salvo cuando el sujeto pasivo o tercero responsable hubiera ocultado dolosamente información vinculada a hechos gravados.

                    <h4>ARTÍCULO 31</h4> (REQUISITOS PARA EL INICIO DE LOS PROCEDIMIENTOS DE DETERMINACIÓN TOTAL O PARCIAL). Conforme a lo establecido en el Parágrafo I del Artículo 104 de la Ley Nº 2492, las determinaciones totales y parciales se iniciarán con la notificación al sujeto pasivo o tercero responsable con la Orden de Fiscalización que estará suscrita por la autoridad competente determinada por la Administración Tributaria consignando, como mínimo, la siguiente información:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Número de Orden de Fiscalización.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Lugar y fecha.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Nombre o razón social del sujeto pasivo.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Objeto (s) y alcance de fiscalización.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Nombre de los funcionarios actuantes de la Administración Tributaria.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) Firma de la autoridad competente.
                    La referida orden podrá ser reasignada a otros funcionarios de acuerdo a lo que establezca la Administración Tributaria.

                    <h4>ARTÍCULO 32</h4> (PROCEDIMIENTOS DE VERIFICACIÓN Y CONTROL PUNTUAL). El procedimiento de verificación y control de elementos, hechos y circunstancias que tengan incidencia sobre el importe pagado o por pagar de impuestos, se iniciará con la notificación al sujeto pasivo o tercero responsable con una Orden de Verificación que se sujetará a los requisitos y procedimientos definidos por reglamento de la Administración Tributaria.

                    <h4>ARTÍCULO 33</h4> (LUGAR DONDE SE DESARROLLAN LAS ACTUACIONES). Cuando los elementos sobre los que se realicen las verificaciones puedan ser examinados en las oficinas de la Administración, éstas se desarrollarán en las mismas oficinas, sin que sea necesaria autorización superior específica.

                    La Administración Tributaria podrá realizar controles, verificaciones, fiscalizaciones e investigaciones en días y horas inhábiles para la misma, cuando las circunstancias del hecho o la actividad económica del sujeto pasivo así lo requieran.

                    Cuando la persona bajo cuya custodia se halle la propiedad, local o edificio, se opusiere a la entrada de los fiscalizadores, éstos podrán llevar a cabo su actuación solicitando el auxilio de la fuerza pública o recabando Orden de Allanamiento.

                    <h4>ARTÍCULO 34</h4> (DETERMINACIÓN EN CASOS ESPECIALES).

                    <br>I. A efecto de lo dispuesto en el Parágrafo I del Artículo 97 de la Ley Nº 2492, constituyen errores aritméticos las diferencias establecidas por la Administración Tributaria en la revisión de los cálculos efectuados por los sujetos pasivos o terceros responsables en las declaraciones juradas presentadas cuyo resultado derive en un menor importe pagado o un saldo a favor del sujeto pasivo mayor al que corresponda.

                    Cuando la diferencia genere un saldo a favor del fisco, la Administración Tributaria emitirá una Resolución Determinativa por el importe impago.

                    Si la diferencia genera un saldo a favor del sujeto pasivo mayor al que le corresponde, la Administración Tributaria emitirá una conminatoria para que presente una Declaración Jurada Rectificatoria.

                    La calificación de la conducta y la sanción por el ilícito tributario será determinada mediante un sumario contravencional, por lo cual no se consignará en la Resolución Determinativa o en la conminatoria para la presentación de la Declaración Jurada Rectificatoria.

                    La deuda tributaria o la disminución del saldo a favor del sujeto pasivo así determinada, no inhibe a la Administración Tributaria a ejercitar sus facultades de fiscalización sobre el tributo declarado.

                    <br>II. A efecto de lo dispuesto en el Parágrafo II del mismo Artículo, se entiende por dato básico aquél que permite identificar al sujeto pasivo o tercero responsable y a la obligación tributaria. La omisión de un dato básico en una declaración jurada, obliga a la Administración a presumir la falta de presentación de dicha declaración.

                    Para determinar el monto presunto por omisión de datos básicos o falta de presentación de declaraciones juradas, se tomará el mayor tributo mensual declarado o determinado dentro de los doce (12) períodos inmediatamente anteriores al de la omisión del cumplimiento de esta obligación, seis (6) períodos trimestrales anteriores en el caso de impuestos trimestrales y cuatro (4) períodos anteriores en el caso de impuestos anuales. Este monto debe ser expresado en Unidades de Fomento de la Vivienda considerando la fecha de vencimiento del período tomado como base de determinación del monto presunto. Si no se hubieran presentado declaraciones juradas por los períodos citados, se utilizarán las gestiones
                    De no contarse con la información necesaria para determinar el monto presunto, se determinará la obligación, aplicando lo dispuesto por el Artículo 45 de la Ley Nº 2492.

                    El importe del monto presunto así calculado, si fuera cancelado por el sujeto pasivo o tercero responsable, se tomará como pago a cuenta del impuesto que en definitiva corresponda.

                    Alternativamente, el sujeto pasivo o tercero responsable podrá presentar la declaración jurada extrañada o corregir el error material ocasionado por la falta del dato básico, en la forma que la Administración Tributaria defina mediante reglamento, el cual señalará además, la forma en que serán tratados los débitos y/o créditos producto de la falta de presentación de declaraciones juradas u omisión de datos básicos.

                    <h4>ARTÍCULO 35</h4> (SUSPENSIÓN DE LA EJECUCIÓN TRIBUTARIA).

                    <br>I. La solicitud de suspensión podrá abarcar la totalidad o parte del acto impugnado, siempre que éste sea susceptible de ejecución separada.

                    <br>II. Los medios para garantizar la deuda tributaria que implican la suspensión de la ejecución tributaria, serán establecidos en la disposición reglamentaria que al efecto dicte cada Administración Tributaria.

                    <br>III. Aún cuando no se hubiera constituido garantía suficiente sobre la deuda tributaria, la Administración podrá suspender la ejecución tributaria de oficio o a solicitud del sujeto pasivo o tercero responsable por razones de interés público. La suspensión procederá una vez emitida una resolución particular en la que se anotará el motivo de la misma, las medidas alternativas que serán ejecutadas para viabilizar el cobro de la deuda tributaria, cuando corresponda y el tiempo que durará dicha suspensión. Si la suspensión se origina en una solicitud del sujeto pasivo o tercero responsable, este deberá presentar, con anterioridad a que se ejecute la suspensión, una solicitud en la que exponga las razones que justifican la misma. El pronunciamiento de la Administración, en caso de ser negativo, no admitirá recurso alguno.

                    <h4>ARTÍCULO 36</h4> (REMATE).

                    <br>I. Los bienes embargados, con anotación definitiva en los registros públicos, secuestrados, aceptados en garantía mediante prenda o hipoteca, así como los recibidos en dación en pago por la Administración Tributaria, serán dispuestos en ejecución tributaria mediante remate en subasta pública o adjudicación directa, en la forma y condiciones que se fije mediante norma administrativa.

                    <br>II. El remate de bienes se realizará por la Administración Tributaria en forma directa o a través de terceros autorizados para este fin.

                    <br>III. Los bienes aceptados en dación de pago, podrán ser adjudicados de forma directa a entidades del sector público, mediante resolución administrativa expresa de acuerdo a norma administrativa emitida por la Administración Tributaria.

                    <br>IV. En cualquier momento y hasta antes de la adjudicación, la Administración Tributaria liberará los bienes objeto de ejecución tributaria, siempre que el obligado pague la deuda tributaria y los gastos de ejecución ocasionados.

                    <br>V. Los servidores públicos de la Administración Tributaria que hubieran intervenido en la ejecución tributaria, por sí o mediante terceros, no podrán adquirir los bienes objeto de ejecución. Su infracción dará lugar a la nulidad de la adjudicación, sin perjuicio de las responsabilidades que se determinen.

                    <br>VI. Las Administraciones Tributarias están facultadas a emitir las normas administrativas que permitan la aplicación del presente Artículo.

                    <h5>Nota del editor </h5>
                    D.S. N° 1859 de 08/01/2014, mediante su Artículo Único, modificó el Artículo precedente.

                    <h4>ARTÍCULO 37</h4> (MEDIOS FEHACIENTES DE PAGO). Se establece el monto mínimo de Bs50.000 (CINCUENTA MIL 00/100 BOLIVIANOS) a partir del cual todo pago por operaciones de compra y venta de bienes y servicios, debe estar respaldado con documento emitido por una entidad de intermediación financiera regulada por la Autoridad de Supervisión del Sistema Financiero ASFI.

                    La obligación de respaldar el pago con la documentación emitida por entidades de intermediación financiera, debe ser por el valor total de cada transacción, independientemente a que sea al contado, al crédito o se realice mediante pagos parciales, de acuerdo al reglamento que establezca el Servicio de Impuestos Nacionales y la Aduana Nacional, en el ámbito de sus atribuciones.

                    <h5>Nota del Editor:</h5>
                    D.S. N° 0772 de 19/01/2011, en su Disposición Final Cuarta, reemplazó el Artículo 37 del D.S. N° 27310 de 09/01/2004, modificado por el Parágrafo III del Artículo 12 del D.S. N° 27874 de 26/11/2004.

                    <h4>ARTÍCULO 38</h4> (REDUCCIÓN DE SANCIONES). La reducción de sanciones por la contravención de omisión de pago establecida en el Artículo 156 de la Ley N° 2492, procederá previo pago o constitución de facilidades de pago de la deuda tributaria.

                    De efectuarse el pago de la deuda tributaria, la Administración Tributaria emitirá la Resolución Determinativa que declare pagada la misma. De no estar pagadas las sanciones por contravenciones tributarias, la resolución establecerá la existencia de las mismas e impondrá las sanciones que correspondan.

                    De solicitarse facilidades de pago por la deuda tributaria y/o multas, la Administración Tributaria emitirá la Resolución Administrativa aceptando el beneficio, si corresponde. El incumplimiento de la facilidad de pago, dará lugar a la pérdida del beneficio de la reducción de sanción y a la ejecución de la Resolución Administrativa que acepta las facilidades de pago.

                    Cuando exista una pluralidad de deudas, el pago de la deuda tributaria por uno o más períodos y/o

                    <h5>Nota del Editor</h5>
                    D.S. N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo VII, modificó el Artículo precedente.

                    <h4>ARTÍCULO 39</h4> (ARREPENTIMIENTO EFICAZ).
                    <br>I. La extinción automática de la sanción pecuniaria por arrepentimiento eficaz, previsto en el Artículo 157 de la Ley N° 2492, procederá en los siguientes casos:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) La deuda tributaria en proceso de fiscalización, verificación o con Vista de Cargo, siempre que se realice el pago o se acoja a facilidades de pago, por período fiscal y/o tributo, hasta el décimo día de notificada la Vista de Cargo;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) La deuda tributaria determinada por el contribuyente en la declaración jurada, siempre que realice el pago o se acoja a facilidades de pago, hasta el décimo día de notificado el Auto Inicial de Sumario Contravencional o hasta la notificación del proveído que dé inicio a la ejecución tributaria, lo que ocurra primero, de acuerdo a la norma administrativa reglamentaria.

                    La Administración Tributaria podrá ejercer posteriormente su facultad de fiscalización a la declaración jurada, pudiendo establecer diferencias a favor del fisco, en cuyo caso, la sanción por contravención de omisión de pago aplicable, sólo será establecida respecto al monto del tributo por determinarse de oficio;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) En la Declaración Jurada con errores aritméticos que ocasionen diferencias a favor del fisco establecidas en la Resolución Determinativa, la contravención por omisión de pago se establecerá por la diferencia. De pagarse la deuda tributaria hasta el décimo día de notificado el Auto Inicial, el contribuyente o tercero responsable se beneficiará con el arrepentimiento eficaz.

                    <h5>Nota del Editor</h5>
                    D.S. N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo VIII, modificó el Parágrafo precedente.

                    <br>II. En el ámbito municipal, a efecto de la aplicación del arrepentimiento eficaz, la liquidación emitida por la Administración Tributaria, a solicitud del sujeto pasivo o tercero responsable, no se entenderá como intervención de la misma

                    <h4>ARTÍCULO 40</h4> (INCUMPLIMIENTO A DEBERES FORMALES).

                    <br>I. Conforme lo establecido por el Parágrafo I del Artículo 162 de la Ley Nº 2492, las Administraciones Tributarias dictarán las resoluciones administrativas que contemplen el detalle de sanciones para cada una de las conductas contraventoras tipificadas como incumplimiento a los deberes formales.

                    <br>II. La falta de presentación en término de la declaración de pago emitida por las Administraciones Tributarias Municipales será sancionada de manera automática con una multa del diez por ciento (10%) del tributo omitido expresado en Unidades de Fomento de la Vivienda, monto que no podrá ser superior a dos mil cuatrocientas Unidades de Fomento de la Vivienda (2400 UFV's), ni menor a cincuenta Unidades de Fomento de la Vivienda (50 UFV's). Cuando no hubiera tributo omitido, la sanción será de cincuenta Unidades de Fomento de la Vivienda (50 UFV's) para el caso de personas naturales y doscientas cuarenta Unidades de Fomento de la Vivienda (240 UFV's), para personas jurídicas, incluidas las empresas unipersonales.

                    <h4>ARTÍCULO 41</h4> (OMISIÓN DE INSCRIPCIÓN EN LOS REGISTROS TRIBUTARIOS MUNICIPALES). En el ámbito municipal, a efecto de la aplicación de la atribución otorgada a la Administración Tributaria por el Parágrafo I del Artículo 163 de la Ley Nº 2492, sólo se considerarán las actuaciones administrativas que sean parte del procedimiento previsto por ley para sancionar la contravención tributaria, por tanto la notificación de requerimientos de inscripción o corrección no afectará la eficacia del arrepentimiento del contraventor en estos casos.

                    <h4>ARTÍCULO 42</h4> (OMISIÓN DE PAGO). La multa por la contravención de omisión de pago a la que se refiere el Artículo 165 de la Ley N° 2492, será determinada en el importe equivalente al tributo omitido actualizado en UFV's, por tributo y/o período pendiente de pago al vencimiento del décimo día de notificada la Vista de Cargo, al vencimiento del décimo día de notificado el Auto Inicial de Sumario Contravencional o al inicio de la ejecución tributaria de las declaraciones juradas, lo que ocurra primero.


                    <h5>Nota del Editor</h5>
                    D.S. N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo IX, modificó el Artículo precedente.


                    <h4>ARTÍCULO 43</h4> (EXTINCIÓN DE LA ACCIÓN).

                    <br>I. A efectos de lo dispuesto en el Artículo 173 de la Ley Nº 2492, para las deudas cuya recaudación corresponda al Servicio de Impuestos Nacionales, se extinguirá la acción penal cuando se constate la reparación integral del daño causado.

                    <br>II. Cuando se trate de deudas cuya recaudación corresponda a los Gobiernos Municipales, la extinción de la acción procederá previa resolución de la máxima autoridad ejecutiva.

                    <h4>ARTÍCULO 44</h4> (DEFRAUDACIÓN TRIBUTARIA). La multa por defraudación a que se refiere el Artículo 177 de la Ley Nº 2492, será calculada sobre la base del tributo omitido determinado a la fecha de vencimiento expresado en Unidades de Fomento de la Vivienda.

                    <h3>CAPÍTULO III
                        DISPOSICIONES RELATIVAS A LA ADUANA NACIONAL</h3>

                    <h4>ARTÍCULO 45</h4> (DEUDA ADUANERA).

                    <br>I. La deuda aduanera se genera al día siguiente del vencimiento del plazo para el cumplimiento de la obligación tributaria aduanera o de la obligación de pago en aduanas.

                    La deuda aduanera se determinará con los siguientes componentes:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) El monto de los tributos aduaneros expresados en UFV's;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) El interés definido en el Artículo 9 del presente Reglamento.

                    <br>II. Las disposiciones del Capítulo II del presente Reglamento, serán aplicadas en materia aduanera en cuanto sean compatibles.

                    <h5>Nota del Editor</h5>
                    D.S. N° 2993 de 23/11/2016, mediante su Artículo 2, Parágrafo X, modificó el Artículo precedente.

                    <h4>ARTÍCULO 46</h4> (PAGO). Se modifica los Párrafos Tercero y Cuarto del Artículo 10 del Reglamento a la Ley General de Aduanas, con el siguiente texto:

                    "El pago realizado fuera del plazo establecido genera la aplicación de intereses y la actualización automática del importe de los tributos aduaneros, con arreglo a lo señalado en el Artículo 47 de la Ley Nº 2492.

                    En caso de incumplimiento de pago, la Administración Aduanera procederá a notificar al sujeto pasivo, requiriéndole para que realice el pago de la deuda aduanera, bajo apercibimiento de ejecución tributaria".

                    <h4>ARTÍCULO 47</h4> (CAMBIO DE RÉGIMEN DE MERCANCÍAS NO REEXPORTADAS). Se modifica el Artículo 167 y el Párrafo Primero del Artículo 173 del Reglamento a la Ley General de Aduanas, con los siguientes textos:

                    "ARTÍCULO 167 (REEXPORTACIÓN Y CAMBIO DE RÉGIMEN) Antes del vencimiento del plazo de permanencia, las mercancías admitidas temporalmente deberán reexportarse o cambiarse al régimen aduanero de importación para el consumo, mediante la presentación de la declaración de mercancías y el pago de los tributos aduaneros liquidados sobre la base imponible determinada al momento de la aceptación de la declaración de mercancías de admisión temporal.

                    Para tal efecto, el monto de los tributos aduaneros será expresado en UFV's al día de aceptación de la declaración de admisión temporal para su conversión al día de pago y se aplicará la tasa anual de interés (r), conforme a lo previsto en el Artículo 47 de la Ley Nº 2492, desde el día de aceptación de la admisión temporal hasta la fecha de pago".

                    "ARTICULO 173 (MERCANCÍAS NO REEXPORTADAS) Cuando la reexportación no se realice, la empresa autorizada para operaciones RITEX deberá cambiar de régimen aduanero a importación para el consumo, con el pago de los tributos aduaneros liquidados sobre la base imponible determinada al momento de la aceptación de la declaración de mercancías de admisión temporal. El monto de los tributos aduaneros será expresado en UFVs al día de aceptación de la declaración de admisión temporal para su conversión al día de pago y se aplicará la tasa anual de interés (r), conforme a lo previsto en el Artículo 47 de la Ley Nº 2492, desde el día de aceptación de la admisión temporal hasta la fecha de pago."

                    <h4>ARTÍCULO 48</h4> (FACULTADES DE CONTROL). La Aduana Nacional ejercerá las facultades de control establecidas en los Artículos 21 y 100 de la Ley Nº 2492 en las fases de: control anterior, control durante el despacho (aforo) u otra operación aduanera y control diferido. La verificación de calidad, valor en aduana, origen u otros aspectos que no puedan ser evidenciados durante estas fases, podrán ser objeto de fiscalización posterior.

                    <h4>ARTÍCULO 49</h4> (FACULTADES DE FISCALIZACIÓN). La Aduana Nacional ejercerá las facultades de fiscalización en aplicación de lo dispuesto en los Artículos 21, 100 y 104 de la Ley Nº 2492.
                    Dentro del alcance del Artículo 100 de la Ley Nº 2492, podrá:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Practicar las medidas necesarias para determinar el tipo, clase, especie, naturaleza, pureza, cantidad, calidad, medida, origen, procedencia, valor, costo de producción, manipulación, transformación, transporte y comercialización de las mercancías.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Realizar inspección e inventario de mercancías en establecimientos vinculados con el comercio exterior, para lo cual el operador de comercio exterior deberá prestar el apoyo logístico correspondiente (estiba, desestiba, descarga y otros).

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Realizar, en coordinación con las autoridades aduaneras del país interesado, investigaciones fuera del territorio nacional, con el objeto de obtener elementos de juicio para prevenir, investigar, comprobar o reprimir delitos y contravenciones aduaneras.

                    Las labores de fiscalización se realizarán con la presentación de la orden de fiscalización suscrita por la autoridad aduanera competente y previa identificación de los funcionarios aduaneros en cualquier lugar, edificio o establecimiento de personas naturales o jurídicas.

                    En caso de resistencia, la Aduana Nacional recabará orden de allanamiento y requisa de la autoridad competente y podrá recurrir al auxilio de la fuerza pública.

                    Dentro del marco establecido en el Artículo 104 de la Ley Nº 2492, la máxima autoridad normativa de la Aduana Nacional mediante resolución aprobará los procedimientos de fiscalización aduanera.

                    <h4>ARTÍCULO 50</h4> (RESULTADOS DEL AFORO). Se modifica el Párrafo Tercero del Artículo 108 del Reglamento la Ley General de Aduanas, con el siguiente texto: "Cuando la observación en el Acta de Reconocimiento establezca disminución u omisión en el pago de los tributos aduaneros por una cuantía menor a Cincuenta mil Unidades de Fomento de la Vivienda (50.000 UFV's) o, siendo el monto igual o mayor a esta cuantía, no se hubiere configurado las conductas detalladas en el Artículo 178 de la Ley Nº 2492, el consignatario podrá reintegrar los tributos aduaneros con el pago de la multa prevista en el Artículo 165 de la Ley Nº 2492 o constituir garantía suficiente por el importe total para continuar con el despacho aduanero".

                    <h4>ARTÍCULO 51</h4> (RECLAMO DEL AFORO). Se modifica el Artículo 109 del Reglamento a la Ley General de Aduanas, con el siguiente texto:

                    "ARTÍCULO 109 (RECLAMOS DE AFORO). El consignatario o consignante, directamente o por intermedio del despachante de aduana, podrá reclamar ante la Administración Aduanera, dentro de los cinco (5) días siguientes a la fecha de suscripción del Acta de Reconocimiento, los resultados del aforo cuando estime que no se han aplicado correctamente las normas legales y reglamentarias. Si al vencimiento de este plazo, no se presentare reclamo, la Administración Aduanera dictará resolución confirmando los resultados de aforo.

                    La Administración Aduanera deberá resolver el reclamo mediante resolución determinativa y/o sancionatoria dentro de un plazo de veinte (20) días de recibido el mismo.

                    La resolución de la Administración Aduanera podrá ser impugnada conforme a las normas de la Ley Nº 2492.

                    En caso de presunta comisión de delito tributario, se aplicará el procedimiento penal tributario establecido en la misma Ley."

                    <h4>ARTÍCULO 52</h4> (RECURSOS). Se modifica el Artículo 262 del Reglamento a la Ley General de Aduanas, con el siguiente texto:
                    "ARTÍCULO 262 (RECURSOS). Las resoluciones administrativas que determinen ajustes al valor en aduanas, podrán ser impugnadas conforme a las normas de la Ley Nº 2492."

                    <h4>ARTÍCULO 53</h4> (COMPETENCIA PARA PROCESAR CONTRAVENCIONES ADUANERAS). Son competentes para procesar y sancionar contravenciones aduaneras:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) La Administración Aduanera de la jurisdicción donde se cometió la contravención. b) La Gerencia Regional de Aduana, en caso de fiscalización diferida o ex post.

                    <h4>ARTÍCULO 54</h4> (REQUISITOS PARA LICENCIA DE DESPACHANTE DE ADUANA). Se modifica el Inciso d) del Artículo 43 del Reglamento a la Ley General de Aduanas, con el siguiente texto:
                    "d) Contar con título académico a nivel licenciatura en cualquier disciplina o como mínimo con título de técnico superior en comercio exterior.
                    La máxima autoridad normativa de la Aduana Nacional establecerá los requisitos y condiciones
                    para la autorización del ejercicio de las funciones del Despachante de Aduana a nivel nacional,
                    incluyendo garantías, prueba de suficiencia y otros." 241
                    <h4>ARTÍCULO 55</h4> (OBLIGACIÓN DE DESPACHANTES Y AGENCIAS DESPACHANTES DE ADUANA). Se modifica el Inciso e) del Artículo 58 del Reglamento a la Ley General de Aduanas con el siguiente texto:
                    "e) Conservar en forma ordenada la documentación inherente a los despachos y operaciones aduaneras realizadas, hasta el término de la prescripción. Los documentos originales de soporte presentados a la administración tributaria, podrán ser conservados por la Administración Aduanera en la forma, plazos y condiciones que determine su máxima autoridad normativa."

                    <h4>ARTÍCULO 56</h4> (DESPACHOS ADUANEROS DEL SECTOR PÚBLICO). Se modifica el
                    Artículo 60 del Reglamento a la Ley General de Aduanas, con el siguiente texto:
                    "ARTÍCULO 60 (DESPACHOS ADUANEROS DEL SECTOR PÚBLICO). Los despachos aduaneros para instituciones del sector público, serán realizados a través de una Oficina de Despachos Oficiales, dependiente de la Aduana Nacional.
                    La Aduana Nacional incorporará en la oficina de despachos oficiales a personal que cuente con conocimientos sobre comercio exterior y cumpla con los requisitos y condiciones establecidos por dicha institución.
                    La Aduana Nacional designará a los funcionarios responsables encargados de elaborar, suscribir y presentar las declaraciones de mercancías para el sector público".

                    <h5>Nota del Editor</h5>
                    D.S. N° 0784 de 02/02/2011, mediante su Artículo 2, Parágrafo I modificó el Artículo precedente."

                    <h4>ARTÍCULO 57</h4> (GARANTÍAS). Se modifica el primer párrafo del Artículo 272 del Reglamento a la Ley General de Aduanas, con el siguiente texto:
                    "ARTÍCULO 272 (CONDICIONES Y EJECUCIÓN). Las garantías serán irrevocables, incondicionales y de ejecución inmediata a primer requerimiento, ante el incumplimiento de la obligación afianzada y estarán expresadas en Unidades de Fomento de la Vivienda y deben necesariamente. En el caso de las boletas de garantía bancaria, serán admitidas en dólares de los Estados Unidos de Norteamérica, hasta que el sistema bancario otorgue dicha garantía bancaria expresada en UFV's."

                    <h4>ARTÍCULO 58</h4> (PRESUPUESTO). El presupuesto anual de funcionamiento e inversión con recursos del Tesoro General de la Nación asignado a la Aduana Nacional, podrá ser hasta el dos por ciento (2%) de la recaudación anual de tributos nacionales en efectivo.

                    <h4>ARTÍCULO 59</h4> (INGRESOS PROPIOS). Se modifica los Incisos a) y c) del Artículo 29 del Reglamento a la Ley General de Aduanas, con el siguiente texto:
                    "a) Los servicios especiales que preste, tales como provisión de precintos aduaneros, control de tránsitos mediante tarjeta magnética, aforos físicos fuera de recintos aduaneros autorizados sean de importación o exportación, servicio electrónico de registro informático y otros cuya vigencia y aplicación se
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Los provenientes de contratos de concesión de servicios otorgados a otras instituciones. En el caso de los recursos correspondientes a la concesión de depósitos aduaneros, éstos podrán ser utilizados para el mejoramiento o construcción de infraestructura aduanera, equipamiento aduanero, control y supervisión de concesionarios."

                    <h4>ARTÍCULO 60</h4> (REMATE EN CASO DE CONTRAVENCIONES ADUANERAS). El remate de bienes decomisados, incautados, secuestrados o embargados en casos de contravenciones aduaneras, se realizará por la Administración Aduanera directamente o a través de terceros autorizados por la misma para este fin, en la forma y según medios que se establecerá mediante resolución de la máxima autoridad normativa de la Aduana Nacional. Los bienes se rematarán en los lugares que disponga la Administración Aduanera en función de procurar el mayor beneficio para el Estado.

                    En casos de contravención aduanera de contrabando, la administración tributaria procederá al remate de las mercancías decomisadas, dentro de los diez (10) días siguientes a la elaboración del acta de intervención, en aplicación del Parágrafo II del Artículo 96 de la Ley Nº 2492.

                    El valor base del remate será el valor CIF de importación que se determinará según la base de precios referenciales de la Aduana Nacional, rebajado en un cuarenta por ciento (40%), no incluirá tributos aduaneros y el adjudicatario asumirá, por cuenta propia, el pago de dichos tributos y el cumplimiento de los requisitos y formalidades aduaneras para la nacionalización de la mercancía.

                    No será necesaria la presentación de autorizaciones previas, con excepción de mercancías que constituyan sustancias controladas reguladas por la Ley Nº 1008 y tratándose de mercancías que requieren certificados sanitarios, sólo se exigirá la presentación del certificado sanitario emitido por autoridad nacional.

                    La liquidación de los tributos aduaneros de importación se efectuará sobre el valor de adjudicación como base imponible.

                    Cuando en el acto de remate no se presenten postores, la Administración Aduanera procederá a la venta directa a la mejor propuesta presentada, pudiendo realizarse a través de medios informáticos o electrónicos, conforme a procedimiento aprobado por la máxima autoridad normativa.

                    Tratándose de productos perecibles, alimentos o medicamentos, la publicación del edicto de notificación y del aviso de remate se efectuará en forma conjunta con 24 horas de anticipación a la fecha del remate. Se procederá al remate sin precio base y se adjudicará al mejor postor. En caso de que dichas mercancías requieran certificados sanitarios, la Administración Aduanera solicitará en forma previa la certificación oficial del órgano competente que deberá ser emitida con anterioridad al acto del remate. Cuando en el acto del remate no se presenten postores y se trate de mercancías perecederas, alimentos o medicamentos de próximo vencimiento que imposibilite su remate dentro de los plazos establecidos al efecto, la Administración Aduanera en representación del Estado dispondrá la adjudicación gratuita a entidades públicas de asistencia social, de educación o de salud.

                    <h4>ARTÍCULO 61</h4> (REMATE EN CASO DE DELITOS ADUANEROS). Las mercancías, medios y unidades de transporte decomisadas por delitos aduaneros, así como los demás bienes embargados o gravados en los registros públicos, serán rematados por la Administración Aduanera o por empresas privadas contratadas al efecto.

                    El valor base del remate será el precio promedio de mercado local con la rebaja del cuarenta por ciento (40%) y, para tal efecto, la Administración Aduanera podrá contratar empresas privadas especializadas en peritaje de valor. En forma alternativa, podrá disponer la venta directa de mercancías a la mejor propuesta presentada a través de medios informáticos o electrónicos, conforme a procedimiento aprobado por su máxima autoridad normativa.

                    El adjudicatario asumirá por cuenta propia el pago de los tributos aduaneros de importación aplicables para el despacho aduanero a consumo y el cumplimiento de las demás formalidades para el despacho aduanero. Los tributos aduaneros se determinarán sobre el valor adjudicado.

                    El Reglamento de Administración de Bienes Incautados, Decomisados y Confiscados aprobado mediante Decreto Supremo Nº 26143 de 6 de abril de 2001, será aplicable en la administración y remate de mercancías decomisadas, con las salvedades establecidas en las normas de la Ley Nº 2492 y el presente Reglamento. Para tal efecto, la máxima autoridad normativa de la Aduana Nacional dictará las disposiciones administrativas respectivas.

                    <h4>ARTÍCULO 62</h4> (DISTRIBUCIÓN DEL PRODUCTO DEL REMATE). Se modifica el Artículo 301 del Reglamento a la Ley General de Aduanas, con el siguiente texto:

                    "ARTÍCULO 301 (MERCANCÍAS DECOMISADAS). Del producto del remate de mercancías decomisadas, se deducirá el pago de los gastos operativos como ser: Publicaciones, almacenaje, gastos de remate, servicios de valuación, gastos de gestión procesal y otros que pudieran adeudarse. El remanente se distribuirá en la siguiente forma:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Cuarenta por ciento (40%) a un fondo de investigación, inteligencia y represión al contrabando de la Aduana Nacional, cuya utilización será determinada por la máxima autoridad normativa de la Aduana Nacional.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Veinte por ciento (20%) a una cuenta restringida cuyo desembolso se efectuará a la Fiscalía General de la República contra presentación del descargo de su utilización en apoyo salarial y equipamiento a los fiscales adscritos a la Aduana Nacional.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Diez por ciento (10%) a una cuenta restringida de la Policía Nacional para su uso exclusivo en gastos de apoyo a operativos de represión al contrabando.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Treinta por ciento (30%) con destino al Tesoro General de la Nación."

                    <h4>ARTÍCULO 63</h4> (DESTRUCCIÓN DE MERCANCÍAS DECOMISADAS). La Administración Aduanera procederá a la destrucción inmediata de mercancías decomisadas, previa comunicación al Fiscal y sin perjuicio del proceso penal aduanero que corresponda, en los siguientes casos:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Mercancías prohibidas de ingreso al territorio nacional por el Artículo 117 del Reglamento a laLey General de Aduanas.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Mercancías descritas en el Artículo 119 del Reglamento a la Ley General de Aduanas, cuando el organismo competente determine que son nocivas a la salud o al medio ambiente.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Cigarrillos, puros o bolsas de tabaco, conforme a lo previsto en el Parágrafo II del Artículo 15 del Decreto Supremo Nº 27053 de 26 de mayo de 2003.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Otras mercancías prohibidas por disposiciones legales.
                    En todos los casos, la Administración Aduanera remitirá el acta de destrucción a conocimiento de la autoridad jurisdiccional competente. Los gastos que demande la destrucción deberán ser atribuidos a los imputados o procesados en sede administrativa o en sede jurisdiccional, según corresponda.

                    <h4>ARTÍCULO 64</h4> (AFORO EN DESPACHOS ANTICIPADO E INMEDIATO). En los despachos anticipado e inmediato previstos en los Artículos 123, 125 y 130 del Reglamento a la Ley General de Aduanas, el reconocimiento físico de las mercancías se efectuará, cuando corresponda, conforme al sistema de aforo selectivo o aleatorio.

                    <h4>ARTÍCULO 65</h4> (REGISTRO TRIBUTARIO DE USUARIOS EN ZONA FRANCA). Derogado.

                    <h5>Nota del Editor</h5>
                    D.S. N° 27627 de 13/07/2004, mediante su Artículo 8, Parágrafo I, derogó el Artículo precedente.

                    <h4>ARTÍCULO 66</h4> (ACTA DE INTERVENCIÓN). El Acta de Intervención por contravención de contrabando deberá contener los siguientes requisitos esenciales:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Número del Acta de Intervención.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Fecha.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Relación circunstanciada de los hechos.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Identificación de los presuntos responsables, cuando corresponda.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Descripción de la mercancía y de los instrumentos decomisados.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) Valoración preliminar de la mercancía decomisada y liquidación previa de los tributos.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;g) Disposición de monetización inmediata de las mercancías.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;h) Firma, nombre y cargo de los funcionarios intervinientes.

                    <h3>CAPÍTULO IV DISPOSICIONES TRANSITORIAS</h3>

                    PRIMERA A efecto de la aplicación del criterio de validez temporal de la Ley tributaria, establecido por la Disposición Transitoria Primera de la Ley Nº 2492, el concepto de procedimiento administrativo en trámite se aplicará a todos los actos que pongan fin a una actuación administrativa y por tanto puedan ser impugnados utilizando los recursos administrativos admitidos por Ley. En consecuencia, los procedimientos administrativos abajo señalados que estuvieran en trámite a la fecha de publicación de la Ley Nº 2492, deberán ser resueltos conforme a las normas y procedimientos vigentes antes de dicha fecha:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Fiscalización y determinación de la obligación tributaria;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Procedimiento sancionatorio (sumario infraccional);
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Control y cobro de autodeterminación;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Impugnación y;
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Cobranza coactiva.

                    La impugnación de los procedimientos administrativos que estuvieran en trámite antes de la vigencia de la Ley Nº 2492 resueltos con posterioridad a dicha fecha, será realizada utilizando los recursos administrativos señalados en el Título III de dicha Ley.

                    La Sentencia Constitucional 0029/2004, de 31 de marzo de 2004, establece:
                    En el Recurso Indirecto o Incidental de Inconstitucionalidad demandando la Inconstitucionalidad del Penúltimo Párrafo de la Primera Disposición Transitoria del Capítulo IV del D.S. N° 27310 de 09/01/2004; Reglamento al Código Tributario Boliviano, por ser contrario a la disposición consagrada en el Artículo 14 de la Constitución Política del Estado (CPE).
                    El Tribunal Constitucional declara INCONSTITUCIONAL el Segundo Párrafo de la Disposición Transitoria Primera del D.S. N° 27310 de 09/01/2004.}

                    Las obligaciones tributarias cuyos hechos generadores hubieran acaecido antes de la vigencia de la Ley Nº 2492 se sujetarán a las disposiciones sobre prescripción contempladas en la Ley Nº 1340 de 28 de mayo de 1992 y la Ley Nº 1990 de 28 de julio de 1999.

                    <h3>CAPÍTULO V DISPOSICIONES FINALES</h3>
                    PRIMERA Se derogan los Artículos 9, 12, 14, 16, 18, 32, Inciso c) del Artículo 47, Inciso e) del Artículo 51, Inciso g) del Artículo 52, Artículos 287 a 295, 297 y 304 del Reglamento a la Ley General de Aduanas.

                    <h5>Nota del Editor</h5>
                    D.S. N° 27352 de 04/02/2004, mediante su Artículo 7, Parágrafo I, excluyó el Inciso c) del Artículo 47 de la Disposición Adicional precedente.
                    SEGUNDA Las Administraciones Tributarias dictarán las normas reglamentarias necesarias para la aplicación de la Ley Nº 2492 y el presente Decreto Supremo.
                    TERCERA Se abrogan y derogan todas las disposiciones legales contrarias al presente Decreto Supremo.

                    El Señor Ministro de Estado en el Despacho de Hacienda queda encargado de la ejecución y cumplimiento del presente Decreto Supremo.

                    Es dado en el Palacio de Gobierno de la ciudad de La Paz, a los nueve días del mes de enero del año dos mil cuatro.

                    <h3>DECRETO SUPREMO N° 2993</h3>
                    MODIFICACIONES AL DECRETO SUPREMO N° 27310 DE 09/01/2004<br>
                    QUE REGLAMENTA LA LEY N° 2492 DE 02/08/2003<br>
                    CÓDIGO TRIBUTARIO BOLIVIANO DE 23/11/2016<br>

                    CONSIDERANDO:

                    Que el Parágrafo I del Artículo 323 de la Constitución Política del Estado, determina que la Política Fiscal se basa en los principios de capacidad económica, igualdad, progresividad, proporcionalidad, transparencia, universalidad, control, sencillez administrativa y capacidad recaudatoria.

                    Que la Ley N° 2492, de 2 de agosto de 2003, Código Tributario Boliviano, establece el régimen legal del sistema tributario aplicable a las personas naturales y jurídicas, sometidas a la potestad tributaria del Estado, en la imposición y recaudación de tributos.

                    Que la Ley N° 812, de 30 de junio de 2016, realiza modificaciones a la Ley N° 2492, en cuanto a la deuda tributaria, notificaciones, arrepentimiento eficaz y reducción de sanciones en materia de ilícitos tributarios.

                    Que el Decreto Supremo N° 27310, de 9 de enero de 2004, que reglamenta la Ley N° 2492, regula su aplicación operativa por las administraciones tributarias del nivel central del Estado y de las entidades territoriales autónomas.

                    Que para la aplicación de las modificaciones a la Ley N° 2492, efectuadas mediante la Ley N° 812, es necesario adecuar el Reglamento al Código Tributario Boliviano contenido en el Decreto Supremo N° 27310.

                    EN CONSEJO DE MINISTROS, DECRETA:
                    <h4>ARTÍCULO 1</h4> (OBJETO). El presente Decreto Supremo tiene por objeto realizar modificaciones al Decreto Supremo N° 27310, de 9 de enero de 2004, que reglamenta la Ley N° 2492, de 2 de agosto de 2003, Código Tributario Boliviano.

                    <h4>ARTÍCULO 2</h4> (MODIFICACIONES).

                    <br>I. Se modifica el Artículo 8 del Decreto Supremo N° 27310, de 9 de enero de 2004, que reglamenta la Ley N° 2492, de 2 de agosto de 2003, Código Tributario Boliviano, con el siguiente texto:

                    "ARTÍCULO 8 (DETERMINACIÓN Y COMPOSICIÓN DE LA DEUDA TRIBUTARIA). La deuda tributaria se configura al día siguiente de la fecha de vencimiento Administración Tributaria y debe incluir su actualización en Unidades de Fomento de Vivienda UFV's e intereses de acuerdo a lo dispuesto en el Artículo 47 de la Ley N° 2492.

                    El período de la mora para el pago de la deuda tributaria, se computará a partir del día siguiente a la fecha de vencimiento del plazo para el pago de la obligación tributaria, hasta el día de pago.

                    La deuda tributaria expresada en UFV's, al momento de hacerse efectivo el pago deberá ser convertida en moneda nacional, utilizando la UFV de la fecha de pago.

                    A efectos del cálculo de los montos indebidamente devueltos, se considerará el mantenimiento de valor e intereses, desde la fecha de la devolución indebida hasta la fecha de su restitución, sin perjuicio de la aplicación de la multa por contravención de omisión de pago que corresponda."

                    <br>II. Se modifica el Artículo 9 del Decreto Supremo N° 27310, de 9 de enero de 2004, que reglamenta la Ley N° 2492, de 2 de agosto de 2003, Código Tributario Boliviano, con el siguiente texto:

                    "ARTÍCULO 9 (INTERESES). El importe del interés (I) generado en todo el período de la mora, será resultado de la sumatoria de los intereses calculados con la tasa que corresponda a cada uno de los períodos de tiempo establecidos en el Artículo 47 de la Ley N° 2492, y se determinarán de acuerdo al cálculo establecido en el Anexo 1 que forma parte íntegra e indivisible del presente Reglamento."

                    <br>III. Se modifica el Parágrafo I del Artículo 10 del Decreto Supremo N° 27310, de 9 de enero de 2004, que reglamenta la Ley N° 2492, de 2 de agosto de 2003, Código Tributario Boliviano, con el siguiente texto:

                    "ARTÍCULO 10 (PAGOS PARCIALES Y PAGOS A CUENTA).

                    <br>I. Los pagos parciales de la deuda tributaria, incluidas las cuotas pagadas en facilidades de pago incumplidas, serán convertidos a valor presente a la fecha de vencimiento del plazo de pago de la obligación tributaria, de acuerdo a lo establecido en el Anexo 2 del presente Decreto Supremo y se deducirán como pago a cuenta de dicha deuda."

                    <br>IV.
                    Se modifica el Artículo 12 del Decreto Supremo N° 27310, de 9 de enero de 2004, que reglamenta la Ley N° 2492, de 2 de agosto de 2003, Código Tributario Boliviano, con el siguiente texto:

                    "ARTÍCULO 12 (NOTIFICACIÓN ELECTRÓNICA).

                    <br>I. Para efectos de lo dispuesto en el Artículo 83 Bis de la Ley N° 2492, la Vista de Cargo, Auto Inicial de Sumario, Resolución Determinativa, Resolución Sancionatoria, proveído que dé inicio a la ejecución tributaria y cualquier Resolución Definitiva, podrán ser notificados por correo electrónico u otros medios electrónicos, en una dirección electrónica fijada por el contribuyente o tercero responsable o asignada por la Administración Tributaria.

                    La notificación electrónica se tendrá por efectuada en los siguientes casos, lo que ocurra

                    primero: 249

                    <br>I. Para efectos de lo dispuesto en el Artículo 83 Bis de la Ley N° 2492, la Vista de Cargo, Auto Inicial de Sumario, Resolución Determinativa, Resolución Sancionatoria, proveído que dé inicio a la ejecución tributaria y cualquier Resolución Definitiva, podrán ser notificados por correo electrónico u otros medios electrónicos, en una dirección electrónica fijada por el contribuyente o tercero responsable o asignada por la Administración Tributaria.

                    La notificación electrónica se tendrá por efectuada en los siguientes casos, lo que ocurra primero:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. En la fecha en que el contribuyente o tercero responsable proceda a la apertura del documento enviado;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. A los cinco (5) días posteriores a:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) La fecha de recepción de la notificación en el correo electrónico; o

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) La fecha de envío al medio electrónico implementado por la Administración Tributaria.

                    El soporte físico de la apertura del documento notificado o de la constancia de recepción en el correo electrónico o envío al medio electrónico, según corresponda, deberá ser adjuntado al expediente, consignando la firma, nombre y cargo del servidor público responsable de la notificación.

                    Cuando no sea posible la notificación por medios electrónicos, la Administración Tributaria procederá a la notificación del sujeto pasivo o tercero responsable de acuerdo al procedimiento establecido en los Artículos 84, 85 y 86 de la Ley N° 2492, según corresponda.

                    <br>II. La Administración Tributaria, a través de medios electrónicos, teléfono fijo o móvil, proporcionará a los contribuyentes o terceros responsables información referida a fechas de vencimiento, existencia de actuaciones administrativas, alertas, recordatorios y cualquier otra de naturaleza tributaria. De igual manera, deberá habilitar los medios para que el contribuyente efectúe consultas, reclamos, denuncias, trámites administrativos y otros por los mismos mecanismos.

                    <br>III. A efectos de la aplicación del presente Artículo, la Administración Tributaria emitirá norma administrativa reglamentaria."

                    <br>V. Se modifica el Parágrafo I del Artículo 27 del Decreto Supremo N° 27310, de 9 de enero de 2004, que reglamenta la Ley N° 2492, de 2 de agosto de 2003, Código Tributario Boliviano, con el siguiente texto:

                    "ARTÍCULO 27 (RECTIFICATORIAS A FAVOR DEL FISCO).

                    <br>I. El contribuyente o tercero responsable podrá rectificar su Declaración Jurada con saldo a favor del fisco en cualquier momento.

                    Las Declaraciones Juradas rectificatorias presentadas una vez iniciada la fiscalización o verificación, no tendrán efecto en la determinación de oficio. Los pagos a que den lugar estas declaraciones, serán considerados como pagos a cuenta de la deuda a determinarse por la Administración Tributaria.

                    La presentación de la Declaración Jurada Rectificatoria no suspende el proceso de ejecución iniciado por la Declaración Jurada original o la última presentada.

                    Cuando la Declaración Jurada Rectificatoria sea por un importe mayor al tributo determinado.

                    <br>VI. Se modifican los Parágrafos I, II y IV del Artículo 28 del Decreto Supremo N° 27310, de 9 de enero de 2004, que reglamenta la Ley N° 2492, de 2 de agosto de 2003, Código Tributario Boliviano, con el siguiente texto:

                    "ARTÍCULO 28 (RECTIFICATORIAS A FAVOR DEL CONTRIBUYENTE).

                    <br>I. La Declaración Jurada Rectificatoria que incremente saldos a favor del contribuyente podrá ser efectuada por una sola vez, por cada impuesto y período fiscal.

                    <br>II. Esta rectificatoria, conforme lo dispuesto en el párrafo segundo del Parágrafo II del Artículo 78 de la Ley N° 2492, deberá ser aprobada por la Administración Tributaria antes de su presentación. La aprobación será resultado de la verificación de los documentos que respalden la determinación del tributo, conforme se establezca en la reglamentación que emita la Administración Tributaria.

                    <br>IV. La solicitud de rectificación de la Declaración Jurada podrá ser presentada hasta antes de que concluya el período de prescripción, o hasta antes del inicio de la Fiscalización o Verificación, lo que ocurra primero."

                    <br>VII. Se modifica el Artículo 38 del Decreto Supremo N° 27310, de 9 de enero de 2004, que reglamenta la Ley N° 2492, de 2 de agosto de 2003, Código Tributario Boliviano, con el siguiente texto:

                    "ARTÍCULO 38 (REDUCCIÓN DE SANCIONES). La reducción de sanciones por la contravención de omisión de pago establecida en el Artículo 156 de la Ley N° 2492, procederá previo pago o constitución de facilidades de pago de la deuda tributaria.

                    De efectuarse el pago de la deuda tributaria, la Administración Tributaria emitirá la Resolución Determinativa que declare pagada la misma. De no estar pagadas las sanciones por contravenciones tributarias, la resolución establecerá la existencia de las mismas e impondrá las sanciones que correspondan.

                    De solicitarse facilidades de pago por la deuda tributaria y/o multas, la Administración Tributaria emitirá la Resolución Administrativa aceptando el beneficio, si corresponde. El incumplimiento de la facilidad de pago, dará lugar a la pérdida del beneficio de la reducción de sanción y a la ejecución de la Resolución Administrativa que acepta las facilidades de pago.

                    Cuando exista una pluralidad de deudas, el pago de la deuda tributaria por uno o más períodos y/o tributos determinados, dará lugar a la reducción de sanciones respecto al o los tributos pagados."

                    <br>VIII.Se modifica el Parágrafo I del Artículo 39 del Decreto Supremo N° 27310, de 9 de enero de 2004, que reglamenta la Ley N° 2492, de 2 de agosto de 2003, Código Tributario Boliviano, con el siguiente texto:

                    "ARTÍCULO 39 (ARREPENTIMIENTO EFICAZ).

                    <br>I. La extinción automática de la sanción pecuniaria por arrepentimiento eficaz, previsto en el Artículo 157 de la Ley N° 2492, procederá en los siguientes casos:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) La deuda tributaria en proceso de fiscalización, verificación o con Vista de Cargo, siempre que se realice el pago o se acoja a facilidades de pago, por período fiscal y/o tributo, hasta el décimo día de notificada la Vista de Cargo;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) La deuda tributaria determinada por el contribuyente en la declaración jurada, siempre que realice el pago o se acoja a facilidades de pago, hasta el décimo día de notificado el Auto Inicial de Sumario Contravencional o hasta la notificación del proveído que dé inicio a la ejecución tributaria, lo que ocurra primero, de acuerdo a la norma administrativa reglamentaria.

                    La Administración Tributaria podrá ejercer posteriormente su facultad de fiscalización a la declaración jurada, pudiendo establecer diferencias a favor del fisco, en cuyo caso, la sanción por contravención de omisión de pago aplicable, sólo será establecida respecto al monto del tributo por determinarse de oficio;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) En la Declaración Jurada con errores aritméticos que ocasionen diferencias a favor del fisco establecidas en la Resolución Determinativa, la contravención por omisión de pago se establecerá por la diferencia. De pagarse la deuda tributaria hasta el décimo día de notificado el Auto Inicial, el contribuyente o tercero responsable se beneficiará con el arrepentimiento eficaz."

                    <br>IX. Se modifica el Artículo 42 del Decreto Supremo N° 27310, de 9 de enero de 2004, que reglamenta la Ley N° 2492, de 2 de agosto de 2003, Código Tributario Boliviano, con el siguiente texto:

                    "ARTÍCULO 42 (OMISIÓN DE PAGO). La multa por la contravención de omisión de pago a la que se refiere el Artículo 165 de la Ley N° 2492, será determinada en el importe equivalente al tributo omitido actualizado en UFV's, por tributo y/o período pendiente de pago al vencimiento del décimo día de notificada la Vista de Cargo, al vencimiento del décimo día de notificado el Auto Inicial de Sumario Contravencional o al inicio de la ejecución tributaria de las declaraciones juradas, lo que ocurra primero."

                    <br>X. Se modifica el Artículo 45 del Decreto Supremo N° 27310, de 9 de enero de 2004, que reglamenta la Ley N° 2492, de 2 de agosto de 2003, Código Tributario Boliviano, con el siguiente texto:

                    "ARTÍCULO 45 (DEUDA ADUANERA).

                    <br>I. La deuda aduanera se genera al día siguiente del vencimiento del plazo para el cumplimiento de la obligación tributaria aduanera o de la obligación de pago en aduanas.

                    La deuda aduanera se determinará con los siguientes componentes:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) El monto de los tributos aduaneros expresados en UFV's;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) El interés definido en el Artículo 9 del presente Reglamento.

                    <br>II. Las disposiciones del Capítulo II del presente Reglamento, serán aplicadas en materia aduanera en cuanto sean compatibles."

                    DISPOSICIONES ADICIONALES

                    DISPOSICIÓN ADICIONAL PRIMERA Conforme a lo establecido en la Disposición Final Primera de la Ley N° 812, de 30 de junio de 2016, las deudas tributarias con el Servicio de Impuestos Nacionales y la Aduana Nacional, existentes con anterioridad a la vigencia de la citada Ley, que no sean regularizadas hasta el 31 de diciembre de 2016 o se encuentren excluidas por la Disposición Transitoria Primera, serán calculadas de acuerdo a lo previsto en el Artículo 47 de la Ley N° 2492, modificado por la Ley N° 812.

                    DISPOSICIÓN ADICIONAL SEGUNDA A efecto de lo establecido en el Artículo 59 de la Ley N° 2492, modificado por la Ley N° 812, y lo dispuesto en los Artículos 45, 45 bis y 45 ter de la Ley N° 843 (Texto Ordenado Vigente), se consideran países o regiones de baja o nula tributación a aquellos que se encuentren identificados como países o regiones no cooperantes de acuerdo a la Organización para la Cooperación y el Desarrollo Económico OCDE y aquellos que estén listados como tales en cuatro o más legislaciones de Sud América.

                    Las Administraciones Tributarias, mediante norma administrativa establecerán y actualizarán el listado de los países o regiones considerados de baja o nula tributación a efectos del control y fiscalización de los precios de transferencia.

                    DISPOSICIÓN ADICIONAL TERCERA Las Administraciones Tributarias de las entidades territoriales autónomas, podrán adecuar sus sistemas informáticos para la aplicación de la presente norma.

                    El señor Ministro de Estado en el Despacho de Economía y Finanzas Públicas, queda encargado de la ejecución y cumplimiento del presente Decreto Supremo.

                    Es dado en el Palacio de Gobierno de la ciudad de La Paz, a los veintitrés días del mes de noviembre del año dos mil dieciséis.

                    <h3>ANEXO 1 D.S. N° 2993</h3>

                    <h3>CÁLCULO DE LA DEUDA TRIBUTARIA</h3>
                    El interés de la deuda tributaria se calculará de acuerdo a la siguiente metodología:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Interés de la deuda tributaria para los primeros cuatro años de mora<br>

                    I = TO *((1+4%/360)**n1 1)<br>

                    Donde:<br>
                    TO = es el Tributo Omitido expresados en UFVs.<br>
                    n1= número de días de mora transcurridos a partir del día siguiente del vencimiento del plazo para el cumplimiento de la obligación tributaria hasta la fecha de pago, que no excederá el último día del cuarto año.<br>

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Interés de la deuda tributaria para el quinto, sexto y séptimo año de mora<br>

                    I = TO *((1+4%/360)**n1 1)+ TO *((1+6%/360)**n2 1)<br>

                    Donde:<br>
                    n1= número de días transcurridos a partir del día siguiente del vencimiento del plazo para el cumplimiento de la obligación tributaria hasta el último día del cuarto año de mora.<br>
                    n2= número de días transcurridos a partir del primer día del quinto año de mora, hasta la fecha de pago, que no excederá el último día del séptimo año.<br>

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Interés de la deuda tributaria a partir del octavo año de mora<br>

                    I = TO *((1+4%/360)**n1 1)+ TO *((1+6%/360)**n2 1)+ TO *((1+10%/360)**n3 1)<br>

                    Donde:<br>

                    n1= número de días transcurridos a partir del día siguiente del vencimiento del plazo para el cumplimiento de la obligación tributaria hasta el último día del cuarto año de mora.<br>
                    n2= número de días transcurridos a partir del primer día del quinto año de mora, hasta el último día del séptimo año.<br>
                    n3= número de días transcurridos a partir del primer día del octavo año de mora hasta la fecha de pago.<br>

                    Cada período anual citado precedentemente se computará a partir del día siguiente de vencimiento del plazo de pago de la obligación tributaria o del día equivalente del año que corresponda.<br>

                    <h3>ANEXO 2 D.S. N° 2993</h3>

                    <h3>CÁLCULO DEL VALOR PRESENTE PARA LA DEUDA TRIBUTARIA (VP)</h3>
                    El valor presente para la deuda tributaria se calculará de acuerdo a la siguiente metodología:<br>

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Valor presente para deudas tributarias de hasta 4 años de mora<br>

                    VP = PP/(1+(4%/360))**n1<br>
                    Donde:<br>
                    PP= Pago Parcial<br>
                    n1= Número de días de mora transcurridos a partir de la fecha de vencimiento del plazo para el cumplimiento de la obligación tributaria hasta la fecha de pago, que no excederá el cuarto año.<br>

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Valor presente para deudas tributarias de hasta 7 años de mora:<br>

                    VP = PP/(1+(4%/360))**n1+(1+(6%/360))**n2<br>

                    Donde:<br>

                    PP = Pago Parcial<br>
                    n1= Número de días de mora transcurridos a partir de la fecha de vencimiento del plazo para el cumplimiento de la obligación tributaria hasta el último día del cuarto año de mora.<br>
                    n2= Número de días transcurridos a partir del primer día del quinto año de mora, hasta la fecha de pago, que no excederá el séptimo año.<br>

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Valor presente para deudas tributarias de 8 años de mora en adelante:<br>

                    VP = PP/(1+(4%/360))**n1+(1+(6%/360))**n2+(1+(10%/360))**n3<br>

                    Donde:<br>

                    PP= Pago parcial<br>
                    n1= Número de días de mora transcurridos a partir de la fecha de vencimiento del plazo para el cumplimiento de la obligación tributaria hasta el último día del cuarto año de mora.<br>
                    n2= Número de días transcurridos a partir del primer día del quinto año de mora, hasta el último día del séptimo año.<br>
                    n3= Número de días transcurridos a partir del primer día del octavo año de mora hasta la fecha de pago.<br>

                    Cada período anual citado precedentemente se computará a partir del día siguiente de vencimiento del plazo de pago de la obligación tributaria o del día equivalente del año que corresponda.<br>

                    <h3>DECRETO SUPREMO N° 27350</h3>
                    <h3>REGLAMENTO ESPECÍFICO PARA EL CONOCIMIENTO Y RESOLUCIÓN DE LOS RECURSOS DE ALZADA Y JERÁRQUICO, APLICABLES ANTE LA SUPERINTENDENCIA TRIBUTARIA DE 02/02/2004</h3>

                    CONSIDERANDO:

                    Que el Numeral I del Artículo 96 de la Constitución Política del Estado, confiere al Presidente de la República la atribución de ejecutar y hacer cumplir las leyes, expidiendo los Decretos y órdenes convenientes, sin definir derechos, alterar los definidos por ley ni contrariar sus disposiciones.

                    Que por mandato del Artículo 132 de la Ley Nº 2492 de 2 de agosto de 2003 Código Tributario Boliviano, se crea la Superintendencia Tributaria como parte del Poder Ejecutivo, bajo la tuición del Ministerio de Hacienda, como órgano autárquico de derecho público, con autonomía de gestión administrativa, funcional, técnica y financiera, con jurisdicción y competencia en todo el territorio nacional.

                    Que el inciso b) del Artículo 139 y los incisos a) y b) del Artículo 140 del Código Tributario Boliviano, establecen las atribuciones y funciones de los Superintendentes Tributarios General y Regionales para conocer y resolver los recursos de alzada interpuestos contra los actos definitivos emitidos por la administración tributaria y los recursos jerárquicos contra las resoluciones que resuelvan aquellos recursos, en concordancia con el párrafo segundo del Artículo 132 del citado Código.

                    Que los recursos detallados en el considerando precedente, tienen su origen en los Artículos 143 y 144 del Código Tributario Boliviano y, que deben tramitarse de acuerdo al citado Código y la reglamentación específica que se dicte al efecto, conforme establece el inciso b) del Artículo 139 de la mencionada Disposición Legal.

                    Que el último párrafo del Artículo 134 del Código Tributario Boliviano dispone que la estructura administrativa y competencia territorial de las Superintendencias Tributarias se establecerán por Reglamento.
                    EN CONSEJO DE GABINETE, DECRETA:

                    <h3>TÍTULO I DISPOSICIONES GENERALES</h3>

                    <h3>CAPÍTULO I OBJETO</h3>

                    <h4>ARTÍCULO 1</h4> (OBJETO). El presente Decreto Supremo tiene por objeto reglamentar en forma
                    específica los Recursos de Alzada y Jerárquico previstos en los Artículos 143 y 144 del Código
                    Tributario Boliviano.

                    <h3>CAPÍTULO II
                        COMPOSICIÓN, COMPETENCIA TERRITORIAL Y ESTRUCTURA</h3>

                    <h4>ARTÍCULO 2</h4> (COMPOSICIÓN). La Superintendencia Tributaria está compuesta por un Superintendente Tributario General con sede en la ciudad de La Paz, cuatro (4) Superintendentes Tributarios Regionales con sede en las capitales de los Departamentos de Chuquisaca, La Paz, Santa Cruz y Cochabamba, respectivamente, y cinco (5) Intendentes Departamentales, cada uno de ellos con asiento en las capitales de los Departamentos de Pando, Beni, Oruro, Tarija y Potosí.

                    <h4>ARTÍCULO 3</h4> (COMPETENCIA TERRITORIAL Y ESTRUCTURA).

                    <br>I. Cada Intendente Departamental tiene competencia sobre el Departamento en cuya capital tiene sede; está a su cargo dirigir la Intendencia Departamental de la que es titular, con las atribuciones y funciones que el otorgan la Ley y el presente Decreto Supremo.

                    <br>II. Cada Superintendente Tributario Regional tiene competencia sobre el Departamento en cuya capital tiene sede y sobre el o los Departamentos constituidos en Intendencia Departamental con las atribuciones y funciones que el otorgan la Ley y el presente Decreto Supremo, conforme a lo siguiente:

                    • Superintendente Tributario Regional de Chuquisaca: Intendencia Departamental de Potosí

                    • Superintendente Tributario Regional de La Paz: Intendencia Departamental de Oruro.

                    • Superintendente Tributario Regional de Santa Cruz: Intendencias Departamentales de Pando y Beni.

                    • Superintendente Tributario Regional de Cochabamba: Intendencia Departamental de Tarija.

                    <br>III. El Superintendente Tributario General tiene competencia en todo el territorio de la República; está a su cargo dirigir y representar la Superintendencia Tributaria General, con las atribuciones y funciones que el otorgan la Ley y el presente Decreto Supremo.

                    <br>IV. La estructura orgánica y funcional de la Superintendencia Tributaria General y las que corresponden a las Superintendencias Tributarias Regionales, serán aprobadas mediante Resolución Administrativa del Superintendente Tributario General, en aplicación de las atribuciones que el confiere el inciso i) del Artículo 139 del Código Tributario Boliviano.

                    <br>V. Los procedimientos internos para el trámite de los recursos en la Superintendencia Tributaria serán aprobados por el Superintendente Tributario General, en aplicación de las atribuciones que el confiere el inciso f) del Artículo 139 del Código Tributario Boliviano.

                    <h4>ARTÍCULO 4</h4> (NO REVISIÓN POR OTROS ÓRGANOS DEL PODER EJECUTIVO). Las resoluciones dictadas en los recursos de alzada y jerárquico por la Superintendencia Tributaria, como órgano resolutivo de última instancia administrativa, contemplan la decisión expresa, positiva y precisa de las cuestiones planteadas y constituyen decisiones basadas en hechos sometidos al derecho y en consecuencia no están sujetas a revisión por otros órganos del Poder Ejecutivo.

                    <h3>TÍTULO II
                        DE LOS PROCEDIMIENTOS APLICABLES ANTE LA SUPERINTENDENCIA TRIBUTARIA CAPÍTULO I RECURSOS ADMINISTRATIVOS</h3>

                    <h4>ARTÍCULO 5</h4> (RECURSOS ADMISIBLES).

                    <br>I. Ante la Superintendencia Tributaria son admisibles únicamente los siguientes Recursos Administrativos:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Recurso de Alzada.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Recurso Jerárquico.

                    <br>II. El Recurso de Alzada es admisible sólo contra los siguientes actos definitivos de la Administración Tributaria de alcance particular:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Las resoluciones determinativas.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Las resoluciones sancionatorias.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Las resoluciones que denieguen total o parcialmente solicitudes de exención, compensación, repetición o devolución de impuestos.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Las resoluciones que exijan restitución de lo indebidamente devuelto en los casos de devoluciones impositivas.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Los actos que declaren la responsabilidad de terceras personas en el pago de obligaciones tributarias en defecto o en lugar del sujeto pasivo.

                    Los actos definitivos emitidos por la administración tributaria de alcance particular no previstos en los literales precedentes se tramitarán conforme a la Ley de Procedimiento Administrativo y su reglamento.

                    El Recurso de Alzada no es admisible contra medidas internas, preparatorias de decisiones administrativas, incluyendo informes y Vistas de Cargo u otras actuaciones administrativas previas incluidas las Medidas Precautorias que se adoptaren a la Ejecución Tributaria ni contra ninguno de los títulos señalados en el Artículo 108 del Código Tributario Boliviano ni contra los autos que se dicten a consecuencia de las oposiciones previstas en el Parágrafo II del Artículo 109 del citado Código, salvo en los casos en que se deniegue la Compensación opuesta por el deudor.

                    <br>III. El Recurso Jerárquico solamente es admisible contra la resolución que resuelve el Recurso de Alzada.

                    <h4>ARTÍCULO 6</h4> (AUTORIDAD ANTE LA QUE DEBEN PRESENTARSE LOS RECURSOS).

                    <br>I. El Recurso de Alzada debe presentarse ante el Superintendente Tributario Regional a cuya jurisdicción está sujeta la autoridad administrativa cuyo acto definitivo es objeto de la impugnación, directamente en oficinas de la respectiva Superintendencia Tributaria Regional o a través de la Intendencia Departamental correspondiente.

                    <br>II. El Recurso Jerárquico debe presentarse ante el Superintendente Tributario Regional que emitió la resolución impugnada, directamente en oficinas de la respectiva Superintendencia Tributaria Regional o a través de la Intendencia Departamental correspondiente. Una vez admitido este Recurso, el expediente será remitido por el Superintendente Tributario Regional actuante al Superintendente Tributario General para su resolución.

                    <br>III. A solicitud justificada del Superintendente Tributario Regional, el Superintendente Tributario General podrá autorizar el establecimiento de oficinas locales de recepción de los recursos administrativos en las localidades donde el volumen de casos lo haga necesario para facilitar el acceso a estos recursos.

                    <h4>ARTÍCULO 7</h4> (COMPETENCIA DE LA SUPERINTENDENCIA TRIBUTARIA).

                    <br>I. Los actos definitivos de alcance particular previstos en el Parágrafo II del Artículo 5 de este reglamento, deben haber sido emitidos por una entidad pública que cumple funciones de Administración Tributaria relativas a cualquier tributo nacional, departamental, municipal o universitario, sea impuesto, tasa, patente municipal o contribución especial, excepto las de seguridad social.

                    <br>II. No competen a la Superintendencia Tributaria:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) El control de constitucionalidad.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Las cuestiones de índole civil o penal atribuidas por la Ley a la jurisdicción ordinaria.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Las cuestiones que, así estén relacionadas con actos de la Administración Tributaria, estén atribuidas por disposición normativa a otras jurisdicciones.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Las decisiones sobre cuestiones de competencia entre la Administración Tributaria y las jurisdicciones ordinarias o especiales ni las relativas a conflictos de atribuciones.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Conocer la impugnación de las normas administrativas dictadas con carácter general por la Administración Tributaria.

                    <h4>ARTÍCULO 8</h4> (FORMA DE INTERPOSICIÓN DE LOS RECURSOS).

                    <br>I. Los Recursos de Alzada y Jerárquico deberán interponerse por escrito, mediante memorial o carta simple, debiendo contener:
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Señalamiento específico del recurso administrativo y de la autoridad ante la que se lo interpone.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Nombre o razón social y domicilio del recurrente o de su representante legal con mandato legal expreso, acompañando el poder de representación que corresponda conforme a Ley y los documentos respaldatorios de la personería del recurrente.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Indicación de la autoridad que dictó el acto contra el que se recurre y el ejemplar original, copia o fotocopia del documento que contiene dicho acto.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Detalle de los montos impugnados por tributo y por período o fecha, según corresponda, así como la discriminación de los componentes de la deuda tributaria consignados en el acto contra el que se recurre.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Los fundamentos de hecho y/o de derecho, según sea el caso, en que se apoya la impugnación, fijando con claridad la razón de su impugnación, exponiendo fundadamente los agravios que se invoquen e indicando con precisión lo que se pide.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) En el Recurso Jerárquico, señalar el domicilio para que se practique la notificación con la Resolución que lo resuelva.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;g) Lugar, fecha y firma del recurrente.

                    <br>II. En los Recursos de Alzada dentro de los cinco (5) días de presentado el recurso, el Superintendente Tributario Regional o los Intendentes Departamentales dictarán su admisión y dispondrán su notificación a la autoridad recurrida. Tratándose de Recursos Jerárquicos, no procede esta notificación al Superintendente Tributario Regional, sino, por disposición de éste o del Intendente Departamental respectivo y dentro del mismo plazo, a la autoridad administrativa cuyo acto fue objeto de impugnación en el recurso previo o al recurrente en el Recurso de Alzada, según corresponda. No será procedente la contestación al Recurso Jerárquico.

                    <br>III. La omisión de cualquiera de los requisitos señalados en el presente Artículo o si el recurso fuese insuficiente u oscuro determinará que la autoridad actuante, dentro del mismo plazo señalado en el Parágrafo precedente, disponga su subsanación o aclaración en el término improrrogable de cinco (5) días, computables a partir de la notificación con la observación, que se realizará en "Secretaría" de la Superintendencia Tributaria General o Regional o Intendencia Departamental respectiva. Si el recurrente no subsanara la omisión u oscuridad dentro de dicho plazo, se declarará el rechazo del recurso. Siendo subsanada la omisión u observación, se aplicará lo previsto en el Parágrafo II de este Artículo.

                    <br>IV. La autoridad actuante deberá rechazar el recurso cuando se interponga fuera del plazo previsto en el Código Tributario, o cuando se refiera a un recurso no admisible o a un acto no impugnable ante la Superintendencia Tributaria conforme a los Artículos 5 y 7 del presente Decreto Supremo.

                    <h4>ARTÍCULO 9</h4> (EFECTOS). En aplicación del Artículo 108 del Código Tributario Boliviano, los actos administrativos impugnados mediante los recursos de alzada y jerárquico, en tanto no adquieran la condición de firmes no constituyen título de ejecución tributaria. La Resolución que se dicte resolviendo el Recurso Jerárquico agota la vía administrativa.

                    <h3>CAPÍTULO II
                        NORMAS GENERALES DE LOS RECURSOS ADMINISTRATIVOS Y RÉGIMEN PROBATORIO</h3>

                    <h4>SECCIÓN I NORMAS GENERALES</h4>

                    <h4>ARTÍCULO 10</h4> (PRINCIPIOS). Los recursos administrativos responderán, además de los principios descritos en el Artículo 4 de la Ley Nº 2341 de 23 de abril de 2002 Ley de Procedimiento Administrativo, a los siguientes:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Principio inquisitivo La finalidad de los recursos administrativos es el establecimiento de la verdad material sobre los hechos imponibles, de forma de tutelar el legítimo derecho del Sujeto Activo a percibir la deuda, así como el del Sujeto Pasivo a que se presuma el correcto y oportuno cumplimiento de sus obligaciones tributarias hasta que en debido proceso se pruebe lo contrario; dichos procesos no están librados sólo al impulso procesal que el impriman las partes, sino que el respectivo Superintendente Tributario, atendiendo a la finalidad pública del mismo, debe intervenir activamente en la sustanciación del Recurso haciendo prevalecer su carácter inquisitivo sobre el simplemente dispositivo.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Principio de oralidad Para garantizar la inmediación, transparencia e idoneidad, los Superintendentes Tributarios podrán sustanciar los recursos mediante la realización de Audiencias Públicas conforme a los procedimientos establecidos en el presente Reglamento.

                    <h4>ARTÍCULO 11</h4> (NORMAS SUPLETORIAS). Los recursos administrativos se sustanciarán y resolverán con arreglo al procedimiento establecido en el Título III del Código Tributario Boliviano, en el presente Reglamento y, sólo a falta de disposición expresa, se aplicarán supletoriamente las normas de la Ley de Procedimiento Administrativo.

                    <h4>ARTÍCULO 12</h4> (LEGITIMACIÓN ACTIVA). Podrán promover los recursos administrativos objeto del presente Decreto Supremo las personas naturales o jurídicas cuyos intereses legítimos y directos resulten afectados por el acto administrativo que se recurre.

                    <h4>ARTÍCULO 13</h4> (CAPACIDAD PARA RECURRIR).

                    <br>I. Tienen capacidad para recurrir las personas que tuvieran capacidad de ejercicio con arreglo a la legislación civil.
                    <br>II. Los incapaces deberán ser representados conforme a la legislación civil.

                    <h4>ARTÍCULO 14</h4> (REPRESENTACIÓN).
                    <br>I. El recurrente podrá concurrir por sí o mediante apoderado legalmente constituido.

                    <br>II. Las personas jurídicas legalmente constituidas, así como las corporaciones, entidades autárquicas, autónomas, cooperativas y otras con personalidad jurídica, serán obligatoriamente representadas por quienes acrediten su mandato de acuerdo a la legislación civil, mercantil o normas de derecho público que correspondan.

                    <br>III. En el caso de las sociedades de hecho, podrán recurrir quienes efectúen operaciones en nombre de la sociedad y en el de las sucesiones indivisas cualquiera de los derecho habientes.

                    <br>IV. La autoridad administrativa de la Administración Tributaria deberá presentar su acreditación a tiempo de su apersonamiento.

                    <h4>ARTÍCULO 15</h4> (NOTIFICACIONES). Toda providencia y actuación, deberá ser notificada a las partes en la Secretaría de la Superintendencia Tributaria General o Regional o de la Intendencia Departamental respectiva, según sea el caso, con excepción del acto administrativo de admisión del Recurso de Alzada y de la Resolución que ponga fin al Recurso Jerárquico, que se notificará a ambas partes en forma personal según lo dispuesto en los Parágrafos II y III del Artículo 84 del Código Tributario Boliviano o alternativamente mediante Cédula, aplicando a este efecto las previsiones del Artículo 85 del mismo Código, cuyas disposiciones acerca del funcionario actuante y de la autoridad de la Administración Tributaria se entenderán referidas al funcionario y autoridad correspondientes de la Superintendencia Tributaria.
                    A los fines de las notificaciones en Secretaría, las partes deberán concurrir a las oficinas de la Superintendencia Tributaria ante la que se sustancia el recurso correspondiente todos los miércoles de cada semana, para notificarse con todas las actuaciones que se hubieran producido; la diligencia de notificación se hará constar en el expediente respectivo. La inconcurrencia de los interesados no impedirá que se practique la diligencia de notificación ni sus efectos.

                    <h4>ARTÍCULO 16</h4> (PLAZOS). Los plazos administrativos establecidos en el presente Reglamento son perentorios e improrrogables, se entienden siempre referidos a días hábiles en tanto no excedan a diez (10) días y siendo más extensos se computarán por días corridos. Los plazos correrán a partir del día siguiente hábil a aquél en que tenga lugar la notificación con el acto o resolución a impugnar y concluyen al final de la última hora hábil del día de su vencimiento; cuando el último día del plazo sea inhábil, se entenderá siempre prorrogado hasta el primer día hábil siguiente.

                    Se entiende por días y horas hábiles administrativos aquellos en los que la Superintendencia Tributaria cumple sus funciones.

                    Las vacaciones colectivas de los funcionarios de la Superintendencia Tributaria deberán asegurar la permanencia de personal suficiente para mantener la atención al público, por lo que en estos períodos los plazos establecidos se mantendrán inalterables.

                    <h5>Disposiciones Relacionadas:</h5>

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;i) Decreto Supremo N° 4229 de 29/04/2020, en su Artículo 10, Parágrafo II, establece: "ARTÍCULO 10 (FUNCIONAMIENTO DE LOS SERVICIOS FINANCIEROS Y SERVICIOS DE ATENCIÓN DE ENTIDADES PÚBLICAS DE RECAUDACIÓN).
                    (...)
                    <br>II. Independientemente de la condición de riesgo, los servicios de atención de entidades públicas de recaudación del nivel central del Estado y de las ETA's deben funcionar desde las 07:00 hasta las 15:00 horas, de lunes a viernes, a partir del 4 de mayo de 2020, en todo el territorio nacional."
                    ii) Decreto Supremo N° 4278 de 30/06/2020; en sus Disposiciones Adicionales Segunda, Parágrafos I al III, establece:
                    "I. Se suspende el cómputo de plazos en los trámites y procesos administrativos ante el Servicio de Impuestos Nacionales, Aduana Nacional y la Autoridad de Impugnación Tributaria, en la jurisdicción municipal donde subsista o se declare cuarentena con suspensión de actividades públicas y/o privadas, por el tiempo que dure ésta.
                    <br>II. El computo de plazos queda suspendido para los administrados ante el Servicio de Impuestos Nacionales y la Aduana Nacional, que tengan su domicilio en los municipios donde subsista o se declare la cuarentena con suspensión de actividades públicas y/o privadas, en tanto dure la misma.
                    <br>III. Los plazos para la interposición y tramitación de los recursos de alzada y jerárquicos ante la Autoridad de Impugnación Tributaria quedarán automáticamente suspendidos respecto a los municipios donde subsista o se declare la cuarentena con suspensión de actividades públicas y/o privadas, en tanto dure la misma."

                    <h4>ARTÍCULO 17</h4> (TERCERÍAS, EXCEPCIONES, RECUSACIONES, INCIDENTES, Y EXCUSAS).

                    <br>I. No son aplicables en los Recursos de Alzada y Jerárquico, tercerías, excepciones, recusaciones, ni incidente alguno.

                    <br>II. Los Superintendentes Tributarios General y Regionales deberán excusarse en los siguientes casos:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) El parentesco con el recurrente o recurrido o con sus representantes en línea directa o colateral hasta el segundo grado; y

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) La relación de negocios o patrocinio profesional directo o indirecto con el interesado o participación directa en cualquier empresa que intervenga en los recursos, inclusive hasta dos años de haber cesado la relación, patrocinio o participación.

                    Los Superintendentes Tributarios Regionales deberán decretar su excusa antes de la admisión, observación o rechazo del recurso. El Superintendente Tributario General deberá excusarse antes de decretar la radicatoria del Recurso Jerárquico admitido por el Superintendente de origen.

                    Tratándose de Recursos de Alzada presentados ante un Intendente Departamental, la excusa del Superintendente Tributario Regional deberá decretarse antes de dictar la radicatoria respectiva, teniendo para cualquier de ambos actos un plazo común de cinco (5) días desde que el expediente fue recibido en su sede.

                    Decretada la excusa, en el caso de un Superintendente Tributario Regional, éste quedará inhibido definitivamente de conocer el proceso y lo remitirá de inmediato al Superintendente Tributario Regional cuya Sede se encuentre más próxima a la propia. Tratándose del Superintendente Tributario General, éste será reemplazado por el Superintendente Tributario Regional de la Sede más próxima y así sucesivamente. En ambos casos, el plazo de los cinco (5) días, para la primera actuación del Superintendente Tributario que reciba el recurso, se computarán a partir de la recepción del mismo.

                    Será nulo todo acto o resolución pronunciada después de decretada la excusa.

                    La omisión de excusa será causal de responsabilidad de acuerdo a la Ley Nº 1178 y disposiciones reglamentarias.

                    <h4>ARTÍCULO 18</h4> (AUDIENCIA PÚBLICA). En el Recurso de Alzada regulado por este Título, dentro de los quince (15) días de concluido el término de prueba, a criterio del Superintendente Regional se convocará a Audiencia Pública conforme a las siguientes reglas:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) La Audiencia Pública, cuando se convoque, se realizará antes de dictarse resolución definitiva y en su convocatoria fijará los puntos precisos a que se limitará su realización. Si así lo requiriese el Superintendente Tributario, las partes deberán presentar en la Audiencia documentos y demás elementos probatorios adicionales a los ya presentados, relativos a los puntos controvertidos.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) La Audiencia, si se convocara, podrá efectuarse indistintamente, a criterio del Superintendente Tributario
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) La Audiencia se llevará a cabo con la presencia del recurrente y de la autoridad recurrida o sus representantes y cualquier persona que, convocada por cualquiera de las partes o por el Superintendente Tributario convocante, aporte informes técnicos, estudios especializados u otros instrumentos de similar naturaleza.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Las partes, empezando por el recurrente, expondrán sus opiniones y argumentos sobre el asunto que motivó la Audiencia, teniendo derecho al uso de la palabra por tiempos iguales, las veces y por los lapsos que establezca el Superintendente Tributario que esté dirigiendo la Audiencia.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) La Audiencia se realizará en horas hábiles, prorrogables a criterio del Superintendente Tributario. Podrá decretarse cuarto intermedio, por una sola vez, a criterio del Superintendente Tributario.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) La inconcurrencia de cualquiera de las partes, no suspenderá la Audiencia, siempre que el representante o abogado de la parte solicitante esté presente; caso contrario, el Superintendente emitirá por una sola vez otra convocatoria para la celebración de una nueva Audiencia que en ningún caso podrá llevarse a cabo antes de las siguientes vienticuatro (24) horas. En caso que la inconcurrencia hubiera sido debidamente justificada con anterioridad al momento de realización de la Audiencia, ésta deberá celebrarse dentro de los diez (10) días siguientes a la fecha en que originalmente debió realizarse; sin embargo, si la inconcurrencia no hubiera sido justificada, la Audiencia podrá ser celebrada, a criterio del Superintendente, dentro de los cinco (5) días siguientes a la fecha en que originalmente debió realizarse.

                    La inconcurrencia de las demás personas convocadas no suspenderá la Audiencia.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;g) Concluida la intervención de los participantes, el Superintendente Tributario declarará clausurada la Audiencia, debiendo procederse a la elaboración y firma del Acta correspondiente por las partes y el Superintendente Tributario.

                    En el Recurso Jerárquico regulado por este Título, podrá convocarse a Audiencia Pública indistintamente, a criterio del Superintendente Tributario General, en la sede de la Superintendencia Tributaria General, en la de la Superintendencia Tributaria Regional o en la Intendencia Departamental que viera conveniente. La convocatoria y celebración de esta audiencia, a criterio del Superintendente Tributario General, no requerirá de los formalismos previstos para las Audiencias ante los Superintendentes Regionales.

                    <h4>ARTÍCULO 19</h4> (DESISTIMIENTO).

                    <br>I. El recurrente podrá desistir del Recurso en cualquier estado del proceso, debiendo el Superintendente
                    Tributario General o Regional aceptarlo sin más trámite.

                    <br>II. Si el recurso se hubiere presentado por dos (2) o más interesados, el desistimiento sólo afectará a aquellos que lo hubieran formulado.

                    <br>III. Aceptado el desistimiento, el Superintendente Tributario General o Regional, según sea el caso, declarará firme el acto impugnado disponiendo su inmediata ejecución.

                    <h4>ARTÍCULO 20</h4> (PROHIBICIÓN). Los funcionarios de la Superintendencia Tributaria no podrán, bajo responsabilidad legal, sostener reuniones privadas con los participantes en los Recursos de Alzada y Jerárquico, incluidos los de las Audiencias Públicas que pudieran convocarse, desde el momento de la presentación del Recurso hasta aquel en que se dicte la resolución correspondiente, en las que se trate aspectos relativos a dichos recursos.

                    <h4>ARTÍCULO 21</h4> (RESOLUCIÓN).

                    <br>I. Los Superintendentes Tributarios tienen amplia facultad para ordenar cualesquiera diligencias relacionadas con los puntos controvertidos.

                    Asimismo, con conocimiento de la otra parte, pueden pedir a cualquiera de las partes, sus representantes y testigos la exhibición y presentación de documentos y formularles los cuestionarios que estimen conveniente, siempre en relación a las cuestiones debatidas, dentro o no de la Audiencia Pública a que se refiere el Artículo 18 del presente Decreto Supremo.

                    Los Superintendentes Tributarios también pueden contratar peritos, a costa de la institución cuando la naturaleza del caso así lo amerite.

                    <br>II. Durante los primeros veinte (20) días siguientes al vencimiento del período de prueba, las partes podrán presentar, a su criterio, alegatos en conclusiones; para ello, podrán revisar in extenso el expediente únicamente en sede de la Superintendencia Tributaria General o Regional o de la Intendencia Departamental, según corresponda. Los alegatos podrán presentarse en forma escrita o en forma verbal bajo las mismas reglas, en este último caso, establecidas en el Artículo 18 de este Reglamento para el desarrollo de la Audiencia Pública.

                    <br>III. Los Superintendentes Tributarios dictarán resolución dentro del plazo de cuarenta (40) días siguientes a la conclusión del período de prueba, prorrogables por una sola vez por el mismo término.

                    <br>IV. Los Superintendentes Tributarios así como el personal técnico y administrativo de la Superintendencia Tributaria que dieran a conocer el contenido del proyecto de resolución a las partes o a terceras personas antes de su aprobación, serán sancionados conforme a Ley.

                    <h4>ARTÍCULO 22</h4> (CONTENIDO DE LAS RESOLUCIONES).

                    <br>I. Las resoluciones se dictarán en forma escrita y contendrán su fundamentación, lugar y fecha de su emisión, firma del Superintendente Tributario que la dicta y la decisión expresa, positiva y precisa de las cuestiones planteadas.

                    <br>II. Las resoluciones precedidas por Audiencias Públicas contendrán en su fundamentación, expresa valoración de los elementos de juicio producidos en las mismas.

                    <br>III. Las resoluciones deberán sustentarse en los hechos, antecedentes y en el derecho aplicable que justifiquen su dictado; siempre constará en el expediente el correspondiente informe técnico jurídico elaborado por el personal técnico designado conforme la estructura interna de la Superintendencia, pudiendo el Superintendente Tributario basar su resolución en este informe o apartarse fundamentadamente del mismo.

                    <h4>ARTÍCULO 23</h4> (CLASES DE RESOLUCIÓN).

                    <br>I. Las resoluciones que resuelvan los Recursos de Alzada y Jerárquico, podrán ser:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Revocatorias totales o parciales del acto recurrido.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Confirmatorias.
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Anulatorias, con reposición hasta el vicio más antiguo.

                    <br>II. La revocación parcial del acto recurrido solamente alcanza a los puntos expresamente revocados, no afectando de modo alguno el resto de puntos contenidos en dicho acto.

                    <h4>ARTÍCULO 24</h4> (RECTIFICACIÓN Y ACLARACIÓN DE RESOLUCIONES). Dentro del plazo fatal de cinco (5) días, a partir de la notificación con la resolución que resuelve el recurso, las partes podrán solicitar la corrección de cualquier error material, la aclaración de algún concepto oscuro sin alterar lo sustancial o que se supla cualquier omisión en que se hubiera incurrido sobre alguna de las pretensiones deducidas y discutidas.

                    La rectificación se resolverá dentro de los cinco (5) días siguientes a la presentación de su solicitud.

                    La solicitud de rectificación y aclaración interrumpirá el plazo para la presentación del Recurso Jerárquico, hasta la fecha de notificación con el auto que se dicte a consecuencia de la solicitud de rectificación y aclaración, agotándose la vía administrativa.

                    <h4>ARTÍCULO 25</h4> (EJECUCIÓN DE LAS RESOLUCIONES). Las resoluciones dictadas resolviendo los Recursos de Alzada y Jerárquico que constituyan Títulos de Ejecución Tributaria conforme al Artículo 108 del Código Tributario Boliviano, serán ejecutadas, en todos los casos, por la Administración Tributaria.

                    <h4>SECCIÓN II: PRUEBA</h4>

                    <h4>ARTÍCULO 26</h4> (MEDIOS, CARGA Y APRECIACIÓN DE LA PRUEBA).

                    <br>I. Podrá hacerse uso de todos los medios de prueba admitidos en Derecho, con excepción de la prueba confesoria de autoridad y funcionarios del ente público recurrido.

                    <br>II. Son aplicables en los Recursos Administrativos todas las disposiciones establecidas en los Artículos 76 al 82 del Código Tributario Boliviano.

                    <h4>ARTÍCULO 27</h4> (PRUEBA TESTIFICAL).

                    <br>I. La prueba testifical sólo servirá de indicio. En la prueba testifical, la declaración de testigos se registrará por escrito.

                    <br>II. No constituye impedimento para intervenir como testigo la condición de empleado o autoridad pública, a condición de que no pertenezca al ente público que sea parte en el proceso.

                    <h4>ARTÍCULO 28</h4> (PRUEBA DOCUMENTAL). Se admitirá como prueba documental:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Cualquier documento presentado por las partes en respaldo de sus posiciones, siempre que sea original o copia de éste legalizada por autoridad competente.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Los documentos por los que la Administración Tributaria acredita la existencia de pagos.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) La impresión de la información contenida en los medios magnéticos proporcionados por los contribuyentes a la Administración Tributaria, conforme a reglamentación específica.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Todo otro documento emitido por la Administración Tributaria respectiva, que será considerado a efectos tributarios, como instrumento público.

                    La prueba documental hará fe respecto a su contenido, salvo que sean declarados falsos por fallo judicial firme.

                    <h3>CAPÍTULO III PROCEDIMIENTOS</h3>

                    <h4>ARTÍCULO 29</h4> (RECURSO DE ALZADA). El Recurso de Alzada se sustanciará de acuerdo al siguiente procedimiento:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Una vez presentado el recurso, en Secretaría de la Superintendencia Tributaria Regional o Intendencia Departamental, el mismo deberá ser admitido, observado o rechazado mediante auto expreso del Superintendente Tributario o Intendente Departamental en el plazo de cinco (5) días.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) El Recurso de Alzada que se admita, será puesto en conocimiento de la Administración Tributaria recurrida mediante notificación personal o cédula, conforme dispone el Artículo 15 del presente Reglamento.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) Dentro del plazo perentorio de quince (15) días desde la notificación con la admisión del recurso, la Administración Tributaria deberá responder al mismo, negando o aceptando total o parcialmente los argumentos del recurrente y adjuntando necesariamente los antecedentes del acto impugnado. Si no se contestare dentro de este plazo se dispondrá de oficio la continuación del proceso, aperturando a partir de ese momento el término de prueba. La Administración Tributaria recurrida podrá incorporarse al proceso en cualquier momento en el estado en que se encuentre.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Dentro de las 24 horas del vencimiento del plazo para la contestación, con o sin respuesta de la Administración Tributaria recurrida, se dispondrá la apertura de término probatorio de veinte (20) días comunes y perentorio al recurrente y autoridad administrativa recurrida. Este plazo correrá a partir del día siguiente a la última notificación con la providencia de apertura en Secretaría de la Superintendencia Tributaria Regional o Intendencia Departamental.

                    La omisión en la contestación o remisión del acto impugnado o sus antecedentes, será comunicada por el Superintendente Tributario o Intendente Departamental a la Máxima Autoridad Ejecutiva de la Administración Tributaria para el establecimiento de la responsabilidad que corresponda de acuerdo al Artículo 28 de la Ley Nº 1178 y el Reglamento de la Responsabilidad por la Función Pública, debiendo dicha Máxima Autoridad Ejecutiva, bajo responsabilidad funcionaria, disponer la inmediata remisión de los antecedentes extrañados.

                    Cuando la Administración Tributaria recurrida responda aceptando totalmente los términos del recurso, no será necesaria la apertura del término probatorio, debiendo el Superintendente Tributario Regional proceder directamente al dictado de su Resolución. Tampoco será necesaria la apertura del término probatorio cuando la cuestión debatida merezca calificación de puro derecho en vez de la apertura del indicado término.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Tratándose de Recursos de Alzada presentados ante un Intendente Departamental, una vez tramitado el recurso hasta el cierre del período probatorio, el expediente deberá ser remitido a conocimiento del Superintendente

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) Para formar debido conocimiento de la causa, cuando así lo considere necesario, el Superintendente}Tributario Regional podrá convocar a Audiencia Pública conforme al Artículo 18 del presente Reglamento.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;g) Vencido el plazo para la presentación de pruebas, el Superintendente Tributario Regional dictará su resolución conforme a lo que establecen los Artículos 21 al 23 del presente Reglamento.

                    <h4>ARTÍCULO 30</h4> (RECURSO JERÁRQUICO). El Recurso Jerárquico se sustanciará sujetándose al siguiente procedimiento:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;a) Una vez presentado el Recurso Jerárquico, en Secretaría de la Superintendencia Tributaria Regional o Intendencia Departamental, el mismo deberá ser admitido, observado o rechazado mediante auto expreso del Superintendente Tributario Regional en el plazo de cinco (5) días. Previa notificación al recurrente con el auto de admisión, dentro del plazo perentorio de tres (3) días desde la fecha de la notificación, el Superintendente Tributario Regional que emitió la Resolución impugnada deberá elevar al Superintendente Tributario General los antecedentes de dicha Resolución, debiendo inhibirse de agregar consideración alguna en respaldo de su decisión.

                    En caso de rechazo del Recurso, el Superintendente Tributario Regional hará conocer su auto y fundamentación al Superintendente Tributario General, dentro del mismo plazo indicado en el párrafo precedente.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;b) Una vez recibido el expediente en Secretaría de la Superintendencia Tributaria General, el Superintendente
                    Tributario General deberá dictar decreto de radicatoria del mismo, en el plazo de cinco (5) días.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;c) En este Recurso sólo podrán presentarse pruebas de reciente obtención a las que se refiere el Artículo 81 del Código Tributario Boliviano, dentro de un plazo máximo de 10 días siguientes a la fecha de notificación con la Admisión del Recurso por el Superintendente Tributario Regional.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;d) Para formar debido conocimiento de la causa, cuando así lo considere necesario, el Superintendente
                    Tributario General podrá convocar a Audiencia Pública conforme al Artículo 18 del presente Reglamento.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;e) Vencido el plazo para presentación de pruebas de reciente obtención, el Superintendente Tributario General dictará su Resolución conforme a lo que establecen los Artículos 21 al 23 de este Reglamento.

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;f) Las Administraciones Tributarias podrán hacer uso del Recurso Jerárquico para impugnar resoluciones que pongan fin al Recurso de Alzada que fueran contrarias a otros precedentes pronunciados por las Superintendencias Regionales, por la Superintendencia General o por Autos Supremos dictados bajo la vigencia de la Ley Nº 2492. El precedente contradictorio deberá invocarse por la Administración Tributaria a tiempo de interponer el Recurso Jerárquico.

                    A tal efecto, se entenderá que existe contradicción, cuando ante una situación de derecho similar, el sentido jurado y/o técnico que le asigna la resolución que resuelve el recurso de Alzada no coincida con el del precedente, o por haberse aplicado normas distintas con diversos alcances.

                    <h3>CAPÍTULO IV MEDIDAS PRECAUTORIAS</h3>

                    <h4>ARTÍCULO 31</h4> (MEDIDAS PRECAUTORIAS).

                    <br>I. De conformidad al inciso p) del Artículo 139 y el inciso h) del Artículo 140 del Código Tributario Boliviano, en cualquier momento, dentro o fuera de los procesos sujetos a su conocimiento, los Superintendentes Tributarios General y Regionales así como los Intendentes Departamentales, autorizarán o rechazarán total o parcialmente, la adopción de Medidas Precautorias por parte de la Administración Tributaria, a expresa solicitud de ésta, dentro de las veinticuatro (24) horas de recibida la solicitud. En materia aduanera, la Administración Tributaria podrá ejercer la facultad prevista en el segundo párrafo del Artículo 80 de la Ley General de Aduanas.

                    <br>II. La solicitud que al efecto formule la Administración Tributaria deberá, bajo responsabilidad funcionaria de la autoridad solicitante, incluir un informe detallado de los elementos, hechos y datos que la fundamenten así como una justificación de la proporcionalidad entre la o las medidas a adoptarse y el riesgo fiscal evidente.

                    <h3>TÍTULO III DISPOSICIONES FINALES CAPÍTULO I
                        DISPOSICIONES TRANSITORIAS</h3>

                    <h4>ARTÍCULO 32</h4> (CONCLUSIÓN DE TRÁMITES). Los Recursos de Alzada ante la Superintendencia Tributaria a la fecha de publicación del presente Reglamento, serán tramitados hasta su conclusión conforme al procedimiento administrativo establecido por el Decreto Supremo Nº 27241 de 14 de noviembre de 2003.

                    <h3>CAPÍTULO II DISPOSICIONES FINALES</h3>

                    <h4>ARTÍCULO 33</h4> (AUTORIZACIÓN). Conforme al Parágrafo I del Artículo 106 de la Ley Nº 2492 Código Tributario Boliviano, para el decomiso preventivo de mercaderías, bienes y medios de transporte en materia aduanera, la Superintendencia Tributaria podrá mediante Resolución Administrativa de carácter general, autorizar a la Aduana Nacional de Bolivia la adopción de estas medidas precautorias, sin perjuicio de las facultades de acción preventiva prevista en el Artículo 186 del Código Tributario Boliviano.

                    <h4>ARTÍCULO 34</h4> (IMPUGNACIÓN). Las Resoluciones Determinativas dictadas conforme a la Ley Nº 1340 de 28 de mayo de 1992, que fueran impugnadas ante los Superintendentes Regionales en mérito a la Ley Nº 2492 y que contuvieran calificación de conducta como delito tributario, deberán ser sustanciadas conforme al Título II del presente Decreto Supremo, absteniéndose los Superintendentes y la Corte Suprema de Justicia en su Sala Social de Minería y Administrativa de emitir pronunciamiento sobre la calificación de la conducta. Concluida la etapa de prejudicialidad penal, el procesamiento penal correspondiente, se efectuará conforme al Título IV de la Ley Nº 2492.

                    <h3>CAPÍTULO III DISPOSICIONES ABROGATORIAS</h3>

                    <h4>ARTÍCULO 35</h4> (VIGENCIA DE NORMAS).

                    <br>I. Se abroga el Decreto Supremo Nº 27241 de 14 de noviembre de 2003.

                    <br>II. Se abrogan y derogan todas las disposiciones contrarias al presente Decreto Supremo.

                    El señor Ministro de Estado en el Despacho de Hacienda queda encargado de la ejecución y cumplimiento del presente Decreto Supremo.

                    Es dado en el Palacio de Gobierno de la ciudad de La Paz, a los dos días del mes de febrero del año dos mil cuatro.

                    <h3>DECRETO SUPREMO N° 27874</h3>
                    <h3>REGLAMENTA ALGUNOS ASPECTOS DEL CÓDIGO TRIBUTARIO BOLIVIANO de 26/11/2004</h3>

                    CONSIDERANDO:

                    Que la Ley Nº 2492 de 2 de agosto de 2003 Código Tributario Boliviano, contempla aspectos a ser desarrollados mediante disposiciones reglamentarias, independientemente de las normas administrativas de carácter general que emitan las Administraciones Tributarias en ejercicio de las facultades que la propia Ley los confiere.

                    Que para la aplicación del régimen transitorio previsto en las Disposiciones Transitorias de la Ley Nº 2492, se debe considerar que las normas en materia procesal se rigen por el "tempus regis actum", en cambio la aplicación de las normas sustantivas por el "tempus comissi delicti".

                    Que lo expuesto anteriormente hace necesaria la modificación de algunos Artículos del Decreto Supremo Nº 27310 de 9 de enero de 2004 y del Decreto Supremo Nº 27369 de 17 de febrero de 2004.

                    Que las Administraciones Tributarias pueden, en uso de su facultad de complementación legal, reglamentar la aplicación de las normas tributarias creadoras de cada impuesto, exigiendo el respaldo de las actividades y operaciones gravadas mediante la presentación de libros, registros u otros documentos y/o instrumentos públicos.

                    EN CONSEJO DE GABINETE, DECRETA:

                    <h4>ARTÍCULO 1</h4> (OBJETO). El presente Decreto Supremo tiene por objeto reglamentar algunos aspectos del Código Tributario Boliviano.

                    <h4>ARTÍCULO 2</h4> (PRUEBAS DE RECIENTE OBTENCIÓN). A efecto de la aplicación de lo dispuesto en el Artículo 81 de la Ley Nº 2492 de 2 de agosto de 2003, en el procedimiento administrativo de determinación tributaria, las pruebas de reciente obtención, para que sean valoradas por la Administración Tributaria, sólo podrán ser presentadas hasta el último día de plazo concedido por Ley a la Administración para la emisión de la Resolución Determinativa o Sancionatoria.

                    <h4>ARTÍCULO 3</h4> (NATURALEZA DE LA EJECUCIÓN TRIBUTARIA). La ejecución tributaria de Resoluciones Administrativas o Judiciales siempre es de naturaleza administrativa, salvo el caso en que la Resolución Judicial ejecutoriada declare probada la pretensión del sujeto pasivo, caso en el cual corresponde su ejecución por la autoridad judicial que dictó la Resolución.

                    <h4>ARTÍCULO 4</h4> (TÍTULOS DE EJECUCIÓN TRIBUTARIA). La ejecutabilidad de los títulos listados en el Parágrafo I del Artículo 108 de la Ley Nº 2492, procede al tercer día siguiente de la notificación con el proveído que dé inicio a la ejecución tributaria, acto que, de conformidad a las
                    <h4>ARTÍCULO 5</h4> (NOTIFICACIÓN POR EDICTO). Las notificaciones por edictos deben señalar como mínimo, el nombre o razón social del sujeto pasivo y/o tercero responsable, su número de registro en la Administración Tributaria, la identificación del acto administrativo y las especificaciones sobre la deuda tributaria (períodos, impuestos y montos).

                    <h4>ARTÍCULO 6</h4> (EJECUCIÓN DE LA GARANTÍA POR MONTOS INDEBIDAMENTE DEVUELTOS). En aplicación de lo dispuesto en el Artículo 127 de la Ley Nº 2492, la Administración Tributaria ejecutará la garantía presentada como respaldo a la devolución, sin perjuicio de la impugnación de la Resolución Administrativa que consigna el monto indebidamente devuelto expresado en Unidades de Fomento a la Vivienda, así como, los intereses respectivos.

                    La ejecución de la garantía presentada, sólo podrá suspenderse si el solicitante presenta una nueva garantía conforme a lo establecido en las disposiciones operativas dictadas por la Administración Tributaria, que deberá mantenerse vigente mientras dure el proceso de impugnación.

                    <h4>ARTÍCULO 7</h4> (NOM BIS IN IDEM). La Administración Tributaria no impondrá sanción por contravención de omisión de pago, cuando, como resultado del procesamiento del delito tributario respectivo, el Fiscal de manera fundamentada decrete el sobreseimiento o la autoridad judicial respectiva dicte sentencia absolutoria.

                    <h4>ARTÍCULO 8</h4> (AGRAVANTES). Procederá la aplicación de la agravante de reincidencia, siempre que el ilícito tributario sancionado por Resolución Administrativa firme o sentencia ejecutoriada, se refiera a la misma conducta ilícita dentro del tipo que corresponda.

                    <h4>ARTÍCULO 9</h4> (REDUCCIÓN DE SANCIONES). En caso de ocurrir lo previsto en el Parágrafo II del Artículo 51 de la Ley Nº 2341 de 23 de abril de 2002 Ley de Procedimiento Administrativo, la Resolución que disponga el consiguiente archivo de obrados, surtirá los efectos de la Resolución de la Superintendencia Tributaria Regional a que se refiere el Numeral 3 del Artículo 156 de la Ley Nº 2492.

                    <h4>ARTÍCULO 10</h4> (OBTENCIÓN INDEBIDA DE BENEFICIOS Y VALORES FISCALES). De acuerdo a lo dispuesto en el Artículo 165 de la Ley Nº 2492, la base para la aplicación de la sanción pecuniaria en el caso de la omisión de pago, por no haberse efectuado las retenciones o por haberse obtenido indebidamente beneficios y valores fiscales, es el 100% (CIEN POR CIENTO) del monto no retenido o del monto indebidamente devuelto, respectivamente, ambos expresados en Unidades de Fomento a la Vivienda.

                    <h4>ARTÍCULO 11</h4> (DEUDA TRIBUTARIA). A efecto de delimitar la aplicación temporal de la norma, deberá tomarse en cuenta la naturaleza sustantiva de las disposiciones que desarrollan el concepto de deuda tributaria vigente a la fecha de acaecimiento del hecho generador.
                    <h4>ARTÍCULO 12</h4> (MODIFICACIONES).

                    <br>I. Se incluye como Segundo Párrafo del Artículo 7 del Decreto Supremo Nº 25933 de 10 de octubre de 2000, el siguiente texto:

                    "En el caso de personas naturales inscritas en el Régimen Tributario Simplificado, éstas deberán pagar bimensualmente el cuarenta por ciento (40%) de las cuotas que los correspondan según sus categorías."

                    <br>II. Se modifica el Parágrafo I del Artículo 28 del Decreto Supremo Nº 27310 de 9 de enero de 2004, de la siguiente manera:

                    "I. Con excepción de las requeridas por el Servicio de Impuestos Nacionales, las Rectificatorias a Favor del Contribuyente podrán ser presentadas por una sola vez, para cada impuesto, formulario y período fiscal."

                    <br>III. Se modifica el Artículo 37 del Decreto Supremo Nº 27310 de la siguiente manera:

                    "ARTÍCULO 37 (MEDIOS FEHACIENTES DE PAGO). Se establece el monto mínimo de Bs50.000 (CINCUENTA MIL 00/100 BOLIVIANOS) a partir del cual todo pago por operaciones de compra y venta de bienes y servicios, debe estar respaldado con documento emitido por una entidad de intermediación financiera regulada por la Autoridad de Supervisión del Sistema Financiero ASFI.

                    La obligación de respaldar el pago con la documentación emitida por entidades de intermediación financiera, debe ser por el valor total de cada transacción, independientemente a que sea al contado, al crédito o se realice mediante pagos parciales, de acuerdo al reglamento que establezca el Servicio de Impuestos Nacionales y la Aduana Nacional, en el ámbito de sus atribuciones."

                    <h5>Nota del Editor:</h5>
                    D.S. N° 0772 de 19/01/2011, en su Disposición Final Cuarta, modificó el Artículo 12 en su Parágrafo III precedente.

                    <br>IV. Se modifica el inciso a) del Artículo 38 del Decreto Supremo Nº 27310 de la siguiente manera:

                    "a) En el caso previsto en el inciso b) del Artículo 21 del presente Decreto Supremo, a tiempo de dictarse la Resolución final del sumario contravencional, la sanción se establecerá tomando en cuenta la reducción de sanciones prevista en el Artículo 156 de la Ley Nº 2492, considerando a este efecto el momento en que se pagó la deuda tributaria que no incluía sanción."
                    <br>V. Se incluye en la última parte del Artículo 14 del Decreto Supremo Nº 27369 de 17 de febrero de 2004, el siguiente texto:

                    "calculada de acuerdo a la norma vigente al momento del acaecimiento del hecho generador."

                    <br>VI. Se modifica el Segundo Párrafo del Artículo 19 del Decreto Supremo Nº 27369, de la siguiente manera:

                    "Si el Plan de Pagos se otorga por obligaciones tributarias autodeterminadas, la Administración Tributaria además de verificar el cumplimiento de los requisitos para acogerse al Programa, en lo posterior podrá ejercer sus facultades de fiscalización, determinación y recaudación. En los casos de incumplimiento, se perderán los beneficios del Programa solo para esta deuda, constituyéndose en título de Ejecución Tributaria la Resolución Administrativa que autorizó el Plan de Pagos, conforme lo dispuesto por el Numeral 8 del Parágrafo I del Artículo 108 de la Ley Nº 2492, para el cobro de la totalidad de la deuda tributaria calculada de acuerdo a la norma vigente al momento de la comisión del hecho generador."

                    <br>VII. Se modifica el Artículo 20 del Decreto Supremo Nº 27369, de la siguiente manera:

                    "ARTÍCULO 20 (INCUMPLIMIENTO DEL PLAN DE PAGOS Y EJECUCIÓN TRIBUTARIA). El incumplimiento de cualesquiera de las cuotas del Plan de Pagos dará lugar a la extinción automática de los beneficios del Programa, haciendo líquida, exigible y de plazo vencido la totalidad de la deuda tributaria, que será calculada de acuerdo a la norma vigente al momento de la comisión del hecho generador. A efecto del cobro, la Resolución Administrativa que autorizó el Plan de Pagos se constituye en título de ejecución tributaria, conforme al Numeral 8 del Parágrafo I del Artículo 108 de la citada Ley. Los pagos realizados antes del incumplimiento, serán considerados como pago a cuenta de la deuda tributaria."

                    <h4>ARTÍCULO 13</h4> (REGLAMENTACIÓN). Se faculta a las Administraciones Tributarias, a emitir las normas operativas necesarias para el cumplimiento del presente Decreto Supremo.

                    El señor Ministro de Estado en el Despacho de Hacienda queda encargado de la ejecución y cumplimiento del presente Decreto Supremo.

                    Es dado en el Palacio de gobierno de la ciudad de La Paz, a los veintiséis días del mes de noviembre del año dos mil cuatro.

                    <h3>DECRETO SUPREMO N° 28247</h3>
                    <h3>REGLAMENTO CONTROL DE OFICIO DE LA OBLIGACIÓN DE EMITIR FACTURA de 14/07/2005</h3>

                    CONSIDERANDO:

                    Que el Numeral 1 del Artículo 66 de la Ley Nº 2492 de 2 de agosto de 2003 Código Tributario Boliviano, determina entre las facultades específicas de la Administración Tributaria, la de control, comprobación, verificación, fiscalización e investigación.

                    Que el Numeral 4 del Artículo 70 del Código Tributario Boliviano, establece como obligación del sujeto pasivo el respaldar las actividades y operaciones gravadas, mediante libros, registros generales y especiales, facturas, notas fiscales y otros documentos conforme a disposiciones normativas.

                    Que el Artículo 103 del Código Tributario Boliviano, señala que la Administración Tributaria podrá verificar el cumplimiento de deberes formales y la obligación de emitir facturas.

                    Que el Artículo 170 del Código Tributario Boliviano, dispone que la Administración Tributaria podrá de oficio verificar el correcto cumplimiento de la obligación de emitir factura, estableciendo, en caso de incumplimiento, la elaboración de un acta identificando la contravención y proceder a la clausura inmediata del establecimiento.

                    Que es necesario reglamentar el citado Artículo, con la finalidad de implementar y/o mejorar los sistemas de control fiscal por parte de la Administración Tributaria, permitiendo así el cumplimiento de sus fines institucionales.

                    Que tomando en cuenta lo anteriormente citado, es necesario dictar la presente norma, la misma que en el marco del Capítulo IX del Decreto Supremo Nº 27230 de 31 de octubre de 2003, fue aprobada por el Consejo Nacional de Política Económica CONAPE en fecha 7 de julio de 2005.

                    EN CONSEJO DE GABINETE, DECRETA:
                    <h4>ARTÍCULO 1</h4> (OBJETO). El presente Decreto Supremo tiene por objeto reglamentar el Control de Oficio de la obligación de emitir facturas.

                    <h4>ARTÍCULO 2</h4> (EMISIÓN DE FACTURAS, NOTAS FISCALES O DOCUMENTOS EQUIVALENTES). Una vez perfeccionado el hecho imponible, conforme lo establece el Artículo
                    4 de la Ley Nº 843 (Texto Ordenado Vigente), la factura, nota fiscal o documento equivalente debe ser extendida obligatoriamente.
                    El Servicio de Impuestos Nacionales SIN en ejercicio de la facultad que el confiere el Artículo 170 del Código Tributario Boliviano, verificará el correcto cumplimiento de esta obligación, a través de las modalidades descritas en el Artículo 3 del presente Decreto Supremo.

                    <h4>ARTÍCULO 3</h4> (VERIFICACIÓN). Además de las modalidades de verificación establecidas por el SIN, a efecto de lo dispuesto en el Artículo 170 del Código Tributario Boliviano, se utilizarán las siguientes modalidades:

                    A. Observación Directa: Procedimiento mediante el cual los servidores públicos del Servicio de Impuestos Nacionales (SIN) expresamente autorizados, observan el proceso de compra de bienes y/o contratación de servicios realizado por un tercero y verifican si el vendedor emite la factura, nota fiscal o documento equivalente.

                    La observación se llevará a cabo en el interior del establecimiento o fuera del mismo, de acuerdo a las condiciones o características de éste.

                    B. Compras de Control: Procedimiento por el cual, servidores públicos del SIN u otras personas contratadas por el SIN en el marco de lo dispuesto por el Artículo 6 de la Ley Nº 2027 de 27 de octubre de 1999 Estatuto del Funcionario Público, expresamente autorizadas al efecto, efectúan la compra de bienes y/o contratación de servicios, con la finalidad de verificar la emisión de la factura, nota fiscal o documento equivalente.

                    <h4>ARTÍCULO 4</h4> (RECUPERACIÓN DE IMPORTES DE TRANSACCIÓN Y DEVOLUCIÓN DE BIENES). Los sujetos pasivos y/o terceros responsables o sus dependientes, tienen la obligación de devolver el importe de la transacción una vez que los sea restituido el bien o el monto del servicio objeto de la Compra de Control, en las mismas condiciones en que fue adquirido, según la reglamentación que el SIN emita.

                    Independientemente de la devolución del importe de la transacción por los sujetos pasivos y/o terceros responsables o sus dependientes y la restitución del bien por parte de los funcionarios del SIN, subsiste la Contravención de no emisión de factura, nota fiscal o documento equivalente consignada en el Acta de Verificación y Clausura.

                    Si durante la ejecución del operativo de control, los funcionarios del SIN procedieran a la compra de alimentos y/o bebidas, así como a la compra de otros bienes o contratación de servicios que por su naturaleza no pueden ser objeto de devolución, el contribuyente y/o dependiente queda liberado de la devolución del importe recibido.

                    Los bienes adquiridos durante la ejecución de operativos de control, a través de la modalidad de Compras de Control, que por su naturaleza no fuesen devueltos a los sujetos pasivos y/o terceros responsables o sus dependientes, serán donados a entidades de beneficencia o asistencia social, conforme a reglamentación que emita el SIN.

                    <h4>ARTÍCULO 5</h4> (APOYO OPERATIVO). La ejecución de procesos de control, verificación e investigación del SIN, así como la ejecución del procedimiento de clausura inmediata establecido en el Artículo 170 del Código Tributario Boliviano, a requerimiento del SIN podrá ser asistida por miembros de la Policía Nacional de Bolivia declarados en comisión, efecto para el cual se conformará la Unidad de Apoyo Operativo cuyo objetivo será ejecutar tareas de seguridad y resguardo.

                    La selección de personal que conformará dicha Unidad, se realizará en base a parámetros y requisitos establecidos por el SIN.

                    Con el objetivo de coordinar e implementar la Unidad de Apoyo Operativo, se suscribirá un convenio interinstitucional entre el SIN y la Policía Nacional de Bolivia.

                    El señor Ministro de Estado en el Despacho de Hacienda queda encargado de la ejecución y cumplimiento del presente Decreto Supremo.

                    Es dado en Palacio de Gobierno de la ciudad de La Paz, a los catorce días del mes de julio del año dos mil cinco.

                    <h3>DECRETO SUPREMO N° 4249</h3>
                    <h3>PRÓRROGA DEL PLAZO DE VENCIMIENTO PARA LA DECLARACIÓN, DETERMINACIÓN Y PAGO DEL IMPUESTO SOBRE LAS UTILIDADES DE LAS EMPRESAS IUE, CON CIERRE AL 31 DE DICIEMBRE DE 2019, DE 28/05/2020</h3>

                    CONSIDERANDO:
                    Que el Parágrafo I del Artículo 35 de la Constitución Política del Estado, determina que el Estado, en

                    todos sus niveles, protegerá el derecho a la salud, promoviendo políticas públicas orientadas a mejorar la calidad de vida y el bienestar colectivo.

                    Que el Artículo 36 y siguientes de la Ley N° 843 (Texto Ordenado vigente), establece que el Impuesto sobre las Utilidades de las Empresas IUE, que según el Decreto Supremo Nº 24051, de 29 de junio de 1995, este impuesto es declarado, determinado y pagado, dentro del plazo de ciento veinte (120) días siguientes al cierre de la gestión fiscal respectiva.

                    Que el Parágrafo I del Artículo 53 de la Ley N° 2492, de 2 de agosto de 2003, Código Tributario Boliviano, dispone que el pago debe efectuarse en la fecha que establezcan las disposiciones normativas.

                    Que el Parágrafo III del Artículo 53 de la Ley N° 2492, señala que la Administración Tributaria podrá disponer fundadamente y con carácter general prórrogas de oficio para el pago de tributos. En este caso no procede la convertibilidad del tributo en Unidades de Fomento de la Vivienda, la aplicación de intereses ni de sanciones por el tiempo sujeto a prórroga.

                    Que el Artículo 39 del Decreto Supremo Nº 24051, de 29 de junio de 1995, Reglamento del Impuesto sobre las Utilidades de las Empresas, establece que los plazos para la presentación de las declaraciones juradas y el pago del impuesto, cuando corresponda, vencerán a los ciento veinte (120) días posteriores al cierre de la gestión fiscal.

                    Que el Decreto Supremo N° 4196, de 17 de marzo de 2020, declara emergencia sanitaria nacional y cuarentena en todo el territorio del Estado Plurinacional de Bolivia, contra el brote del Coronavirus (COVI 19).

                    Que el Decreto Supremo N° 4198, de 18 de marzo de 2020, difiere hasta el 29 de mayo de 2020, el plazo para el pago del IUE de la gestión cerrada al 31 de diciembre de 2019.

                    Que el Decreto Supremo N° 4199, de 21 de marzo de 2020, declara Cuarentena Total en todo el territorio del Estado Plurinacional de Bolivia, contra el contagio y propagación del Coronavirus (COVI 19), con suspensión de actividades públicas y privadas.

                    Que el Decreto Supremo N° 4229, de 29 de abril de 2020, establece la Cuarentena Condicionada y Dinámica, en base a las condiciones de riesgo determinadas por el Ministerio de Salud, en su calidad de Órgano Rector, para la aplicación de las medidas correspondientes que deberán cumplir los municipios y/o departamentos.


                    279
                    Que ante la subsistencia de la cuarentena es necesario ampliar el plazo de vencimiento para la declaración, determinación y pago del IUE por la gestión fiscal 2019, con cierre al 31 de diciembre 2019, para los contribuyentes categorizados como Resto por el Servicio de Impuestos Nacionales, a efectos de reducir el riesgo de contagio por aglomeraciones en entidades financieras.

                    EN CONSEJO DE MINISTROS, DECRETA:

                    <h4>ARTÍCULO 1</h4> (OBJETO). El presente Decreto Supremo tiene por objeto prorrogar el plazo de vencimiento para la declaración, determinación y pago del Impuesto sobre las Utilidades de las Empresas IUE, con cierre al 31 de diciembre de 2019.

                    <h4>ARTÍCULO 2</h4> (PRÓRROGA DEL IMPUESTO SOBRE LAS UTILIDADES DE LAS EMPRESAS).

                    <br>I. Se prorroga el plazo de vencimiento para la declaración, determinación y pago del IUE de la gestión cerrada al 31 de diciembre de 2019 correspondiente a los contribuyentes categorizados como Resto en la gestión 2019 por el Servicio de Impuestos Nacionales, conforme a lo siguiente:

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;1. Los contribuyentes pagarán el cien por ciento (100%) del impuesto declarado y determinado hasta el 31 de julio de 2020;

                    <br>&nbsp;&nbsp;&nbsp;&nbsp;2. Excepcionalmente, los contribuyentes que solo alcancen a pagar el cincuenta por ciento (50%) del impuesto declarado y determinado hasta el 31 de julio de 2020, tendrán una prórroga de oficio hasta el 31 de agosto de 2020 para pagar el quince por ciento (15%) del impuesto declarado y determinado; hasta el 30 de septiembre de 2020 para pagar el quince por ciento (15%) del impuesto declarado y determinado y; hasta el 30 de octubre de 2020 para pagar el veinte por ciento (20%) del impuesto declarado y determinado. Esta prórroga escalonada se concede según lo establecido en el Parágrafo III del Artículo 53 de la Ley N° 2492, por lo que no procede la convertibilidad del tributo en Unidades de Fomento de la Vivienda, la aplicación de intereses ni de sanciones por el tiempo sujeto a prórroga.

                    <br>II. Los contribuyentes que hubieran pagado hasta el 29 de mayo de 2020 el IUE de la gestión cerrada al 31 de diciembre de 2019, podrán rectificar la Declaración Jurada correspondiente hasta el 31 de julio de 2020 por el saldo a favor del Fisco que resulte, sin multas, intereses, ni mantenimiento de valor.

                    El señor Ministro de Estado en el Despacho de Economía y Finanzas Públicas, queda encargado de la ejecución y cumplimiento del presente Decreto Supremo.

                    Es dado en el Palacio de Gobierno de la ciudad de La Paz, a los veintiocho días del mes de mayo del año dos mil veinte. <br><br>

                    Publicación del Servicio de Impuestos Nacionales, realizada por la Gerencia de Servicio al Contribuyente y Cultura Tributaria.<br>
                    Servicio de Impuestos Nacionales<br>
                    Dirección: Av. José Aguirre Achá s/n, Los Pinos, Zona Sur<br>
                    Teléfonos:<br>
                    Número Piloto: 591 – 2 – 2606060<br>
                    Línea Gratuita 800 10 3444<br>
                    www.impuestos.gob.bo<br>
                    La Paz Bolivia<br>

                    Prohibida su reproducción impresa o digital sin autorización



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