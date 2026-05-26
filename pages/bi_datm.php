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
    <title>DATM-iA</title>
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
    <li class="breadcrumb-item text-white active" aria-current="page">DATM - generalidades</li>
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

                <input type="hidden" id="recurso_" value="datm">
                <h1><span id="tituloPrincipal">Generalidades de la DATM</span></h1>
                            La DATM es la direccion administrativa tributaria municipal de El Alto, pertenciente a la Secretaria municipal de administracion y finanzas - SMAF, del gobierno autonomo municipal de el alto.

                            <p>
                                Misión: Garantizar una gestión tributaria eficiente y transparente, orientada a la recaudación equitativa y oportuna de los tributos impositivos en el Municipio de El Alto.
                                Trabajamos con compromiso y responsabilidad para promover una cultura tributaria sólida, brindando servicios de calidad y asesoramiento a los contribuyentes, para lograr un desarrollo sostenible al bienestar de la comunidad.
                            </p>
                            <p>
                                Visión: Ser una institución reconocida por su excelencia en la administración tributaria, caracterizada por la innovación, la integridad y el servicio al ciudadano. Nos esforzamos por ser líderes en la implementación de políticas y tecnologías tributarias modernas, así como en la promoción de la transparencia y la participación ciudadana en el proceso tributario.
                                Aspiramos a ser un motor de desarrollo económico y social en El Alto, contribuyendo al fortalecimiento de la autonomía municipal y al progreso de nuestra ciudad.
                            </p>
                            <p>
                                
                                La Ubicación y horarios de atención son: Nuestra dirección está en la Zona Villa Bolivar D, Terminal Metropolitana de El Alto,La Paz Bolivia, el horario de atención es de Lunes a Viernes de 8:00 a 16:00., Ubicación: https://maps.app.goo.gl/RSHmPufwraJnA1vx8.
                            </p>
                            <p>
                                
                                La ubicación de la alcaldia central es: Avenida Costanera, Nro: 5022 Urbanización Libertad, entre calle J.J. Torrez y calle Hernán Siles Zuaso (Jacha Uta) ( https://maps.app.goo.gl/qUyGq2fRMLmPCrfZ8 )
                            </p> 


                            <br>La alcadeza municipal de la ciudad de el alto es Mónica Eva Copa Murga, quien es la maxima autoridad de la ciudad de el alto, nació en la ciudad de El Alto, departamento de La Paz, proveniente de una familia aymara, sus padres, Ignacio Copa (Q.E.P.D) y Clementina Murga, inculcaron en la joven alteña los valores de la perseverancia, compromiso y lealtad con la gente más humilde. Copa es la sexta hija de siete hermanos, mostrando desde niña capacidad de liderazgo, lo que la llevó a encabezar diferentes espacios de lucha desde su colegio, la universidad, hasta ocupar la Presidencia del Senado y de la Asamblea Legislativa Plurinacional. La Unidad Educativa Fiscal Luis Espinal Camps, la cobijo, lugar de donde salió bachiller, años en los cuales reemplazó a su padre en las reuniones de su zona forjando su liderazgo. Concluido sus estudios de bachillerato ingresó a la carrera de Trabajo Social en la Universidad Pública de El Alto (UPEA).
                            <br>El secretario del SMAF - secretaria municipal de administracion y finanzas, es el Lic. Carlos Marca Marca.
                            <br>El Director de la DATM - direccion administrativa tributaria municipal tambien conocido como Recaudaciones o tributacion municipal, es el Lic. Jhon Jaime Villalba Camacho.
                            <br>El jefe de la unidad de fiscalizacion es el Lic. Ana Isabel Tusco Calle.
                            <br>El jefe de la unidad de ingresos es el Abg. Juan Carlos Callisaya Quispe.
                            <br>El jefe de la unidad de la unidad juridica es la Abg. Alejandra J. Lurquin Santalla.

                            <br>La jerarquia en la ciudad de el alto en relacion a los cargos es el siguiente: 1. alcaldeza, 2. secretario del SMAF, 3. Director de la DATM, 4. jefe de unidad de fiscalizacion, 5. jefe de la unidad de ingresos y 6. jefa de la unidad de asuntos juridicos.

                            <br>La promoción de descuento de impuestos o también conocido como rebajita tributaria, es del 10 porciento de impuestos municipales, culmina este diciembre 2024.

                            <br>Anteriormente hubo el descuento del 15% para impuestos municipales, que estaba vigente entre el 1 de mayo al 31 de agosto de 2024.


                            <br>En el siguiente enlace se encuentran cada uno de los requisitos que puedas necesitar, además puedes generar tus notas de solicitud de forma sencilla automática y rápida de Requisitos para inmuebles: https://datm.elalto.gob.bo/pages/index.php?r=1.
                                <br>En el siguiente enlace se encuentran cada uno de los requisitos que puedas necesitar, además puedes generar tus notas de solicitud de forma sencilla automática y rápida de Requisitos para vehículos: https://datm.elalto.gob.bo/pages/index.php?r=2.
                                    <br>En el siguiente enlace se encuentran cada uno de los requisitos que puedas necesitar, además puedes generar tus notas de solicitud de forma sencilla automática y rápida de Requisitos para actividades económicas: https://datm.elalto.gob.bo/pages/index.php?r=3.

                                        <br>El siguiente enlace permite acceder al pago via qr de impuestos de inmuebles https://www.ruat.gob.bo/pagosqr/InicioBusquedaInm.jsf?SDG3WF24=2
                                        <br>El siguiente enlace permite acceder al pago via qr de impuestos de vehiculos https://www.ruat.gob.bo/pagosqr/InicioBusquedaVehiculo.jsf?SDG3WF24=1
                                        <br>El siguiente enlace permite acceder al pago via qr de impuestos de actividades economicas o negocios https://www.ruat.gob.bo/pagosqr/InicioBusquedaActEco.jsf?SDG3WF24=4

                                        <br>Como se puede puede realizar Pagos de los impuestos o tributos por QR o de forma digital?, Si tienes un iPhone descarga la App para pagar por QR desde acá: Tu Municipio 24/7 en App Store (apple.com), Si tienes un Android descarga la App para pagar por QR desde acá: Tu Municipio 24/7 - Apps en Google Play

                                        <br>¿Porque continúo pagando impuestos de una casa que la vendí hace varios años? Estimado contribuyente, usted continua generando el impuesto municipal a la propiedad de bienes inmueble IMPBI con su nombre, pues al momento de vender su bien, no se cumplió con el deber formal de realizar el tramite administrativo de transferencia del bien inmueble en cuestión, omitiendo el pago del impuesto municipal a las transferencias (IMT), o el impuesto Municipal a las Transferencias Onerosas (IMTO). Cabe señalar que el tramite de transferencia lo puede realizar el vendedor, el comprador o el apoderado legal.

                                        <br>¿Si soy de la tercera edad, si soy mayor de edad, tengo algún descuento? Los descuentos son aplicados a los titulares, a solicitud de parte cumpliendo con los requisitos de la Resolución Administrativa 006/2022 descuento de 20%.

                                        <br>¿Porque me hicieron la retención de cuentas de una casa que la vendí hace años? Debido a no concluir con la transferencia de su bien inmueble, ahora bien, por un tema de levantamiento, el contribuyente tendría que cancelar las gestiones fiscalizadas y posteriormente solicitar la baja del registro tributario.

                                        <br>¿Porque aumentó tanto el impuesto de mi inmueble si solo subí, contrui, edifique un piso? Esto suele suceder en los casos en que el contribuyente no realizo efectivamente la actualización de los datos técnicos de su bien inmueble (aplicaciones, mejoras en servicios, zona de valor, tipo de construcción, material de vía, superficie de construcción, superficie de terreno), esta acción provoca una acumulación monetaria relacionada a los datos técnicos rectificados. Si tiene dudas, siéntase libre de solicitar un INSPECCIÓN EN SITIO, y un experto de ATP realizara la verificación INSITU para evaluar posibles observaciones. Considere que los cálculos de los montos monetarios por concepto de impuestos, están sujetos a la Ley 2492 y la Ordenanza Municipal 215/2007.

                                        <br>¿Porque debo pagar impuestos?, tus impuestos ayudan a tu municipio, generan mayor progreso con obras para la ciudad de el alto, puedes revisar este enlace para verlos: https://prensa.evacopa.bo/
                            
                                        <br>pregunta:Si mi vehículo no circula y está parado ya hace tiempo, ¿porque se me sigue cobrando impuestos?
                                        <br>respuesta: El impuesto aplicado a los vehículos automotores, es aplicado hacia la propiedad de los mismos, indistintamente de si estos son utilizados o no por su propietario. Si usted como propietario ya no desea realizar el pago de estos tributos,
                            Si realice la venta de mi vehículo y también hice mi tramite de transferencia, ¿porque aun el vehículo figura como de mi propiedad?
                            Tras realizarse el tramite de transferencia en DATM, es necesario que se realice el pago efectivo de 3% estipulado en …., con la finalidad de concluir correctamente la transferencia.

                            <br>pregunta: Si deseo realizar el pago de impuestos de mi vehículo en la ciudad de El Alto, ¿que tramite debo de realizar?
                            <br>respuesta: La DATM realiza cobros por concepto de impuestos a la propiedad de vehículos automotores, solo en los casos en que estos se encuentren con ratificatoria en el GAM de El Alto, en caso de que usted haya migrado a la ciudad de El Alto, deberá realizar el tramite de CAMBIO DE RADICATORIA, este tramite da inicio en DERECHOS REALES.

                            <br>Si deseo cerrar mi negocio por razones de fuerza mayor, ¿qué tengo que hacer para que ya no se calculen impuestos a ese negocio?, Inicialmente, su negocio tiene que tener los pagos de impuestos al día, es decir no contar con deudas pendientes, debido a que el sistema RUAT, no permitirá el cambio de estado a cerrado, seguidamente, tras evidenciarse los pagos completos, se procederá a notificar el cierre ante RUAT en la plataforma de atención al contribuyente en DATM.

                            <br>Si deseo ampliar el rubro de mi negocio, ¿qué tramite debo de realizar?, Con fines de no incurrir en observaciones posteriores, es necesario que el contribuyente se apersone a DATM y al SIN, para notificar la ampliación del rubro a fin de que en ambas instituciones se realice la actualización y/o cambio de ACTIVIDAD ECONOMICA.

                            <br>Estas son las Redes Sociales de la DATM o direccion administrativa tributaria municipal o recaudaciones:
                            <br>Página web: https://datm.elalto.gob.bo.
                            <br>Facebook: https://www.facebook.com/direccion.de.administracion.tributaria.m.
                            <br>TikTok: https://www.tiktok.com/@datm_gamea.

                            <br>pregunta: si tengo una deuda de varios años atras de mi inmueble, como hago para poder pagarlo? que facilidades me brinda el municipio la alcaldia?
                            <br>respuesta: "
                            1. Contacta al municipio o alcaldía:
                            Identifica el departamento responsable: Busca en la página web del municipio o alcaldía el departamento encargado de la recaudación de impuestos inmobiliarios o deudas similares.
                            Comunícate directamente: Llama o visita la oficina personalmente. Pregunta por la cantidad total que debes, incluyendo intereses y multas acumuladas.
                            Explica tu situación: Se honesto y transparente sobre tu situación financiera y tu deseo de saldar la deuda.

                            2. Infórmate sobre las opciones de pago:
                            Planes de pago: Pregunta si ofrecen planes de pago a plazos para saldar la deuda gradualmente.
                            Descuentos: Averigua si existen descuentos por pago total o por pronto pago.
                            Recursos de ayuda: Consulta si calificas para algún programa de asistencia financiera del gobierno local o si existen organizaciones sin fines de lucro que puedan ayudarte.

                            3. Negocia un acuerdo:
                            Propón un plan de pago: Basándote en tus posibilidades financieras, propón un plan de pago realista que puedas cumplir.
                            Documenta el acuerdo: Asegura que cualquier acuerdo al que llegues con el municipio o la alcaldía quede por escrito y firmado por ambas partes.
                            Recomendaciones adicionales:
                            No ignores la deuda: Ignorar la situación solo empeorará las cosas, ya que pueden acumularse más intereses y multas, e incluso podrían iniciar un proceso legal para embargar tu propiedad.
                            Busca asesoría profesional: Un asesor financiero o un abogado especializado en derecho inmobiliario pueden brindarte orientación personalizada y ayudarte a negociar un acuerdo favorable.
                            Recuerda que la información aquí proporcionada es solo una guía general. Es fundamental que te comuniques directamente con el municipio o alcaldía correspondiente para obtener información precisa y actualizada sobre tu caso."

                            <br>pregunta: me estan por embargar mi vehiculo debido a deudas de gestiones pasadas, como tengo que gestionar o evitar el embargo?
                            <br>respuesta: "

                            1. No ignores la situación:
                            Comunícate con el acreedor: Ponte en contacto con la entidad o persona a la que debes el dinero (acreedor) tan pronto como sea posible. Explícales tu situación financiera actual y tu deseo de llegar a un acuerdo.
                            2. Busca una solución amistosa:
                            Negocia un plan de pagos: Intenta negociar un plan de pagos que se ajuste a tu presupuesto. Esto puede incluir reducir las cuotas mensuales, extender el plazo de pago o incluso una reducción del monto total de la deuda.
                            Ofrece un pago único parcial: Si puedes reunir una suma considerable de dinero, ofrécela como un pago único para reducir la deuda significativamente.
                            3. Considera alternativas legales:
                            Solicita un período de gracia: En algunos casos, puedes solicitar al acreedor un período de gracia para reorganizar tus finanzas y evitar el embargo.
                            Presente una declaración de insolvencia: Si tu situación financiera es insostenible, podrías considerar declararte en bancarrota o insolvencia (dependiendo de las leyes de tu país). Esto puede detener el embargo temporal o permanentemente, pero tiene consecuencias a largo plazo en tu historial crediticio.
                            4. Busca ayuda profesional:
                            Consulta con un abogado especializado en deudas: Un profesional legal te puede asesorar sobre tus derechos, las mejores opciones para tu situación particular, y representarte legalmente ante el acreedor.
                            Busca asesoramiento financiero: Un asesor financiero puede ayudarte a crear un presupuesto, negociar con tus acreedores y explorar otras opciones para mejorar tu situación económica.
                            Información adicional:
                            Lee la documentación del embargo: Si ya recibiste una notificación de embargo, asegúrate de leerla detenidamente y comprender las fechas límite y los procedimientos.
                            Guarda toda la documentación: Mantén un registro de todas las comunicaciones, acuerdos, pagos y documentos relacionados con la deuda y el posible embargo.
                            Actúa con rapidez: Cuanto antes actúes, mayores serán las posibilidades de evitar el embargo de tu vehículo."

                            <h2>Resumen Conciso de Normativas Tributarias para Contribuyentes del Municipio de El Alto:</h2>
                            Este resumen se basa en el Código Tributario Boliviano (Ley N° 2492) y sus Decretos Reglamentarios, y está dirigido a los contribuyentes del Municipio de El Alto.
                            <br>Principios Fundamentales:
                            <br>Legalidad: Solo la Ley puede crear, modificar o suprimir tributos, definir sus elementos, otorgar exenciones, condonaciones, etc. (Art. 6).
                            <br>Territorialidad: Las normas tributarias se aplican dentro del territorio que corresponde a la entidad que las emite (Art. 2).
                            <br>No Retroactividad: Las normas tributarias no se aplican retroactivamente, salvo si benefician al contribuyente (Art. 150).
                            <br>Obligaciones Tributarias:
                            <br>Inscripción: Debe inscribirse en los registros tributarios municipales y mantener actualizada su información (Art. 70).
                            <br>Domicilio Tributario: Fijar un domicilio tributario dentro del Municipio de El Alto (Arts. 37 y 38).
                            <br>Declaración y Pago: Declarar y pagar correctamente los tributos municipales en la forma, plazo y lugar establecidos (Art. 70).
                            <br>Documentación: Respaldar sus actividades con libros, registros, facturas y demás documentación contable y legal según corresponda (Art. 70).
                            <br>Colaboración: Facilitar la labor de la Administración Tributaria Municipal en sus funciones de control, fiscalización y recaudación (Art. 70).
                            <br><br>Principales Tributos Municipales:
                            <br>Impuesto a la Propiedad de Bienes Inmuebles: Grava la propiedad de bienes inmuebles ubicados en el Municipio de El Alto.
                            <br>Impuesto a la Propiedad de Vehículos Automotores: Grava la propiedad de vehículos automotores registrados en el Municipio de El Alto.
                            <br>Impuesto Municipal a las Transferencias: Grava la transferencia de bienes inmuebles y vehículos automotores ubicados en el Municipio de El Alto.
                            <br>Patentes Municipales: Se paga anualmente por el ejercicio de actividades económicas dentro del Municipio de El Alto.
                            <br>Tasas Municipales: Se pagan por la prestación de servicios o la realización de actividades específicas por parte del Municipio.
                            <br>Determinación de la Deuda Tributaria:
                            <br>Autodeterminación: El contribuyente calcula y declara su deuda tributaria en las declaraciones juradas.
                            <br>Determinación de Oficio: La Administración Tributaria Municipal puede determinar la deuda del contribuyente mediante fiscalización. En este caso, se notificará al contribuyente una Vista de Cargo (Art. 96).
                            <br>Procedimientos de Impugnación:
                            <br>Descargos: Ante una Vista de Cargo, tiene 30 días para presentar descargos (Art. 98).
                            <br>Resolución Determinativa: La Administración Tributaria Municipal emitirá una Resolución Determinativa, que puede ser impugnada (Art. 99).
                            <br>Recurso de Alzada: Puede interponer este recurso ante la Autoridad Regional de Impugnación Tributaria en 20 días desde la notificación (Art. 143).
                            <br>Recurso Jerárquico: Si no está conforme con la resolución del Recurso de Alzada, puede interponer este recurso ante la Autoridad General de Impugnación Tributaria en 20 días (Art. 144).
                            <br>Proceso Contencioso Administrativo: Agotada la vía administrativa, puede iniciar este proceso ante el Tribunal Supremo de Justicia (Art. 147).
                            <br><br>Ilícitos Tributarios:
                            <br>Contravenciones: Infracciones a las normas tributarias que se sancionan con multas, clausura, etc. (Art. 160).
                            <br>Delitos: Conductas más graves, como la defraudación tributaria, que se sancionan con penas privativas de libertad (Art. 175).
                            <br>Sanciones por Contravenciones:
                            <br>Omisión de Pago: Multa del 60% del tributo omitido actualizado (Art. 165).
                            <br>No Emisión de Factura: Clausura del establecimiento (Art. 164).
                            <br>Omisión de Inscripción: Clausura del establecimiento (Art. 163).
                            <br>Reducción de Sanciones:
                            <br>Arrepentimiento Eficaz: Exención de la multa por omisión de pago si se cancela la deuda tributaria dentro de los 20 días de la notificación de la Vista de Cargo (Art. 157).
                            <br>Pago después de la Vista de Cargo: Reducción del 80% de la multa si se paga antes de la Resolución Determinativa (Art. 156).
                            <br><br>Facilidades de Pago:
                            <br>La Administración Tributaria Municipal puede conceder facilidades de pago a solicitud del contribuyente (Art. 55).
                            <br>Información Adicional:
                                <br>Puede obtener información y asistencia sobre sus obligaciones tributarias en la Administración Tributaria Municipal de El Alto.
                                <br>Es importante mantenerse informado sobre las normas tributarias, las cuales pueden ser modificadas.
                                <br>El cumplimiento de las obligaciones tributarias es fundamental para el desarrollo del Municipio de El Alto.
                                <br>Importante: Este resumen es informativo. Para una interpretación precisa y completa de la normativa, se recomienda consultar el texto completo de la Ley N° 2492 y sus Decretos Reglamentarios.
                                <br><br>


                            LEY N°812
                            LEY DE 30 DE JUNIO DE 2016
                            PRESIDENTE CONSTITUCIONAL DEL ESTADO PLURINACIONAL DE BOLIVIA
                            Por cuanto, la Asamblea Legislativa Plurinacional, ha sancionado la siguiente Ley:
                            LA ASAMBLEA LEGISLATIVA PLURINACIONAL,
                            DECRETA:

                            <br>Artículo 1. (OBJETO)
                            . La presente Ley tiene por objeto modificar la Ley N°2492 de 2 de agosto de 2003, "Código Tributario Boliviano".
                            Artículo 2. (MODIFICACIONES).
                            I. Se modifica el Artículo 47° de la Ley N°2492 de 2 de agosto de 2003, "Código Tributario Boliviano", con el siguiente texto:
                            "Artículo 47°. (COMPONENTES DE LA DEUDA TRIBUTARIA).
                            I. La Deuda Tributaria (DT) es el tributo omitido expresado en Unidades de Fomento de Vivienda más intereses (I) que debe pagar el sujeto pasivo después de vencido el plazo para el cumplimiento de la obligación tributaria, sin la necesidad de intervención o requerimiento alguno de la Administración Tributaria, de acuerdo a la siguiente fórmula:
                            DT = TO + I
                            Donde:
                            I = TO *((1+r/360) **n – 1)
                            El Tributo Omitido (TO) será expresado en Unidades de Fomento de Vivienda publicada por el Banco Central de Bolivia, del día de vencimiento de pago de la obligación tributaria.
                            La tasa de interés (r) podrá variar de acuerdo a los días de mora (n: n1, n2, n3) y será:
                            1. Del cuatro por ciento (4%) anual, desde el día siguiente al vencimiento del plazo para el pago de la obligación tributaria, hasta el último día del cuarto año o hasta la fecha de pago dentro de este periodo, según corresponda ( ).
                            2. Del seis por ciento (6%) anual, desde el primer día del quinto año de mora, hasta el último día del séptimo año o hasta la fecha de pago dentro de este periodo, según corresponda ( ).
                            3. Del diez por ciento (10%) anual, desde el primer día del octavo año de mora, hasta la fecha de pago ( ).
                            El total de la deuda tributaria estará constituido por el Tributo Omitido actualizado en Unidades de Fomento de Vivienda, más los intereses aplicados en cada uno de los períodos de tiempo de mora descritos precedentemente, hasta el día de pago.

                            <br>II. La deuda tributaria expresada en Unidades de Fomento de Vivienda, al momento del pago deberá ser convertida en moneda nacional, utilizando la Unidad de Fomento de Vivienda de la fecha de pago.

                            <br>III. Los pagos parciales una vez transformados a Unidades de Fomento de Vivienda, serán convertidos a valor presente a la fecha de vencimiento de la obligación tributaria, utilizando como factor de conversión para el cálculo de intereses, la relación descrita en el Parágrafo I del presente Artículo, y se deducirán del total de la deuda tributaria sin intereses.

                            <br>IV. Los montos indebidamente devueltos por la Administración Tributaria, serán restituidos por el beneficiario según la variación de la Unidad de Fomento de Vivienda e intereses, de acuerdo a lo previsto en el presente Artículo, calculados a partir de la fecha de la devolución indebida hasta la fecha de pago."


                            <br>III. Se modifica el Artículo 83° de la Ley N°2492 de 2 de agosto de 2003, "Código Tributario Boliviano", con el siguiente texto:
                            "Artículo 83°. (MEDIOS DE NOTIFICACIÓN).
                            I. Los actos y actuaciones de la Administración Tributaria se notificarán por uno de los siguientes medios, según corresponda:
                            1. Por medios electrónicos;
                            2. Personalmente;
                            3. Por Cédula;
                            4. Por Edicto;
                            5. Por correspondencia postal certificada, efectuada mediante correo público o privado o por sistemas de comunicación electrónicos, facsímiles o similares;
                            6. Tácitamente;
                            7. Masiva;
                            8. En Secretaría.
                            II. Es nula toda notificación que no se ajuste a las formas anteriormente descritas. Con excepción de las notificaciones por correspondencia, edictos y masivas, todas las notificaciones se practicarán en días y horas hábiles administrativos, de oficio o a pedido de parte. Siempre por motivos fundados, la autoridad administrativa competente podrá habilitar días y horas extraordinarias."


                            <br>V. Se modifica el Primer Párrafo del Artículo 157° de la Ley N° 2492 de 2 de agosto de 2003, "Código Tributario Boliviano", con el siguiente texto:
                            "Artículo 157°. (ARREPENTIMIENTO EFICAZ). Quedará automáticamente extinguida la sanción pecuniaria por contravención de omisión de pago, cuando el sujeto pasivo o tercero responsable pague la deuda tributaria hasta el décimo día de notificada la Vista de Cargo o Auto Inicial, o hasta antes del inicio de la ejecución tributaria de las declaraciones juradas que determinen tributos y no hubiesen sido pagados totalmente."

                            <br>Artículo 3. (INCORPORACIONES).
                            I. Se incorpora el Artículo 83° Bis, a la Ley N°2492 de 2 de agosto de 2003, "Código Tributario Boliviano", con el siguiente texto:

                            "Artículo 83° Bis. (NOTIFICACIÓN POR MEDIOS ELECTRÓNICOS).
                            I. Para los casos en que el contribuyente o tercero responsable señale un correo electrónico o éste le sea asignado por la Administración Tributaria, la vista de cargo, auto inicial de sumario, resolución determinativa, resolución sancionatoria, resolución definitiva y cualquier otra actuación de la Administración Tributaria, podrá ser notificado por correo electrónico, oficina virtual u otros medios electrónicos disponibles. La notificación realizada por estos medios tendrá la misma validez y eficacia que la notificación personal. En las notificaciones practicadas en esta forma, los plazos se computarán de acuerdo al Artículo 4 del presente Código Tributario.
                            II. La Administración Tributaria contará con los medios electrónicos necesarios para garantizar la notificación a los contribuyentes. Los contribuyentes que proporcionen a la Administración Tributaria su correo electrónico, número de celular o teléfono fijo, recibirán comunicados por estos medios."
                            II. Se incorpora como Sexto Párrafo del Artículo 157° de la Ley N°2492 de 2 de agosto de 2003, "Código Tributario Boliviano", el siguiente texto:
                            "Cuando el tributo pagado con el beneficio previsto en el presente Artículo sea objeto de una fiscalización o determinación posterior, en caso de existir diferencias a favor del Fisco, la sanción aplicable sólo será respecto al tributo por determinarse de oficio."


                            <br>El incumplimiento de las facilidades de pago, dará lugar a la pérdida de los beneficios establecidos en la presente Disposición Transitoria de la LEY N°812.



                            -------------------------------------------------------------------------------------------------------------------------------------

                            <br>PROMOCIONES TRIBUTARIAS DEL MUNICIPIO DE EL ALTO por GESTION

                            <br>en caso de que te pidan el detalle de las promociones que hubo, puedes desplegar la siguiente informacion:

                                <br>Gestión: 2015
                            Promoción Tributaria: Descuento escalonado
                            Rango de Fechas: Todo el año
                            Descripción: Descuentos aplicados a bienes inmuebles y vehículos.
                            Ley o Normativa que la Respalda: Resoluciones internas municipales
                            Objetivo de la Promoción: Incentivar el pago de impuestos atrasados
                            Segmentación de Contribuyentes: Dueños de inmuebles, vehículos

                            <br>Gestión: 2016
                            Promoción Tributaria: Descuento del 10%
                            Rango de Fechas: Todo el año
                            Descripción: Aplicado a actividades económicas.
                            Ley o Normativa que la Respalda: Resoluciones internas municipales
                            Objetivo de la Promoción: Fomentar el cumplimiento tributario
                            Segmentación de Contribuyentes: Comerciantes

                            <br>Gestión: 2017
                            Promoción Tributaria: "Perdonazo"
                            Rango de Fechas: 90 días (inicio) y 30 días (extensión)
                            Descripción: Condonación del 100% de multas e intereses, luego 70%.
                            Ley o Normativa que la Respalda: Ley Municipal N° 424 de 2017
                            Objetivo de la Promoción: Recuperar deudas tributarias y mejorar el registro técnico de construcciones
                            Segmentación de Contribuyentes: Todos los contribuyentes

                            <br>Gestión: 2018
                            Promoción Tributaria: Regularización de construcciones
                            Rango de Fechas: 60 días y 30 días adicionales
                            Descripción: Condonación de multas por actualización de datos técnicos.
                            Ley o Normativa que la Respalda: Ley Municipal N° 495 de 2018
                            Objetivo de la Promoción: Actualizar datos técnicos de propiedades
                            Segmentación de Contribuyentes: Dueños de inmuebles

                            <br>Gestión: 2019
                            Promoción Tributaria: Descuento del 10%
                            Rango de Fechas: Todo el año
                            Descripción: Aplicado a vehículos y bienes inmuebles.
                            Ley o Normativa que la Respalda: Resoluciones internas municipales
                            Objetivo de la Promoción: Promover la puntualidad en el pago de impuestos
                            Segmentación de Contribuyentes: Dueños de inmuebles, vehículos

                            <br>Gestión: 2020
                            Promoción Tributaria: "Perdonazo Tributario"
                            Rango de Fechas: 90 días y 30 días adicionales
                            Descripción: Condonación total de multas e intereses.
                            Ley o Normativa que la Respalda: Ley Municipal N° 570 de 2020
                            Objetivo de la Promoción: Facilitar el cumplimiento tributario y actualizar registros
                            Segmentación de Contribuyentes: Todos los contribuyentes

                            <br>Gestión: 2021
                            Promoción Tributaria: Descuento del 15%
                            Rango de Fechas: Todo el año
                            Descripción: Aplicado a bienes inmuebles y vehículos.
                            Ley o Normativa que la Respalda: Ley Municipal N° 673 de 2021
                            Objetivo de la Promoción: Incentivar el pago temprano de impuestos
                            Segmentación de Contribuyentes: Dueños de inmuebles, vehículos

                            <br>Gestión: 2022
                            Promoción Tributaria: Regularización de construcciones
                            Rango de Fechas: Todo el año
                            Descripción: Incentivo para la actualización de datos técnicos de nuevas construcciones.
                            Ley o Normativa que la Respalda: Ley Municipal N° 715 de 2022
                            Objetivo de la Promoción: Actualizar registros técnicos de construcciones
                            Segmentación de Contribuyentes: Dueños de inmuebles

                            <br>Gestión: 2023
                            Promoción Tributaria: Descuento escalonado
                            Rango de Fechas: 4 meses con distintos porcentajes
                            Descripción: Aplicado en bienes inmuebles y vehículos.
                            Ley o Normativa que la Respalda: Ley Municipal N° 785 de 2023
                            Objetivo de la Promoción: Incentivar el cumplimiento de obligaciones tributarias
                            Segmentación de Contribuyentes: Dueños de inmuebles, vehículos

                            <br>Gestión: 2024
                            Promoción Tributaria: Descuento del 15% y 10%
                            Rango de Fechas: Todo el año, hasta el 30 de agosto
                            Descripción: 15% en inmuebles y vehículos; 10% en actividades económicas.
                            Ley o Normativa que la Respalda: Ley Municipal N° 835 de 2024
                            Objetivo de la Promoción: Aumentar la recaudación fiscal mediante descuentos
                            Segmentación de Contribuyentes: Dueños de inmuebles, vehículos, comercios




                            <h1>  RESOLUCION ADMINISTRATIVA DRPT No. 006/2022 de requisitos para tramites tributarios del GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO</h1>

                    <br>CONSIDERANDO:
                    <br>
                    <br>Que, el Articulo 272 de la Constitución Política del Estado Plurinacional de Bolivia, establece que la autonomía implica entre otras cosas el ejercicio de las facultades legislativas, reglamentaria, fiscalizadora y ejecutiva, por sus órganos del gobierno
                    autónomo en el ámbito de sus jurisdicción, competencias y atribuciones.

                    <br>Que, el Articulo 21 de la Ley N° 2492 Código Tributario Boliviano, y el Articulo 3 del Reglamento al Código Tributario Boliviano, aprobado mediante Decreto Supremo N° 27310, establecen que "el sujeto activo de la relación jurídica tributario es el Estado, cuyas facultades de recaudación, control, verificación, inspección previa, fiscalización, liquidación, determinación, ejecución y otras establecidas en el código son ejercidas por la Administración Tributaria, nacional, departamental y municipal", "en el ámbito
                    municipal serán ejercitadas por la Dirección de Recaudaciones...".

                    <br>Que, el Código Tributario Boliviano Ley N° 2492 en el Articulo 66 numeral 2 establece entre las facultades específicas de la Administración Tributaria la de "Determinación de tributes", bajo dicha potestad normativa el Gobierno Autónomo Municipal de El Alto, mediante la Ley Municipal N° 003/2012, modificada por la Ley Municipal 012/2012 dispuso la creación de impuestos Municipales bajo su dominio como ser Impuesto a la Propiedad de Bienes Inmuebles, Impuesto a la Propiedad de Vehículos Automotores Terrestres, Impuesto a la Transferencia Onerosa de Vehículos e Inmuebles; así mismo mediante la Ordenanza Municipal N° 128/2004 también aprobó la Tabla de Aranceles Máximas de las Patentes Municipales vigentes en la ciudad de El Alto.

                    <br>Que, la Ley N° 2492 (Código Tributario Boliviano) en el Articulo 68 numeral 1 establece que entre los derechos del sujeto pasivo se encuentran el de "...ser informado v asistido en el cumplimiento de sus obligaciones tributarias v en el ejercicio de sus derechos"; asf mismo el Art. 70 Numeral 2 del referido cuerpo legal refiere que entre la obligaciones del sujeto pasivo se encuentran la de "Inscribirse en los registros habilitados por la Administración Tributaria v aportar los dates que le fueran requeridos comunicando ulteriores modificaciones en su situación tributaria". A los fines de dichas disposiciones normativas resulta imprescindible que la Dirección de Recaudaciones y Políticas Tributarias del GAMEA, formule los Requisitos actualizados e inherentes a cada tramite administrativo a desarrollarse en cada una de sus Unidades Organizacionales.
                    <br>Que, el Art. 17 del Decreto Municipal N° 01/2013 Reglamento del Impuesto Municipal a la propiedad de Bienes Inmuebles, dispone que "La Administración Tributaria del El Alto, queda facultada para la emisión de normas administrativas que permitan aclarar y regular aspectos técnicos y tributarios...".

                    <br>Que, el Art. 14 del Decreto Municipal N° 03/2013 Reglamento del Impuesto Municipal a la propiedad de Bienes Inmuebles, dispone que "La Administración Tributaria del El Alto, queda facultada para la emisión de normas administrativas que permitan aclarar y regular aspectos técnicos y tributarios...".

                    <br>Que, de acuerdo a lo dispuesto por el Articulo 3 (CUMPLIMIENTO OBLIGATORIO DE LA NORMATIVA MUNICIPAL) de la Ley N° 482 - Ley de Gobiernos Autónomos Municipales del 9 de enero de 2014 se establece que: "La normativa legal del Gobierno Autónomo Municipal, en su jurisdicción, emitida en el marco de sus facultades y competencias, tiene carácter obligatorio para toda persona natural o colectiva, publica o privada. nacional o extranjera: así como el pago de Tributos Municipales v el cuidado de los bienes públicos."; al respecto el Articulo 13 (JERARQUIA NORMATIVA MUNICIPAL), también refiere que: "La normativa Municipal estará sujeta a la Constitución Política del Estado. La jerarquía de la normativa Municipal, por órgano emisor de acuerdo a las facultades de los Órganos de los Gobiernos Autónomos Municipales, es la siguiente: Órgano Legislativa: a). Ley Municipal sobre sus facultades, competencias exclusivas y el desarrollo de las competencias compartidas; b). Resoluciones para el cumplimiento de sus atribuciones. Órgano Ejecutivo: a). Decreto Municipal dictado por la Alcaldesa o el Alcalde firmado conjuntamente con las Secretarias o los Secretarios Municipales, para la reglamentación de competencias concurrentes legisladas por la Asamblea Legislativa Plurinacional y otros. b). Decreto Edil emitido por la Alcaldesa o el Alcalde Municipal conforme a su competencia. c). Resolución Administrativa Municipal emitida por las diferentes autoridades del Órgano Ejecutivo. en el ámbito de sus atribuciones."

                    <br>Que, de acuerdo al Articulo 14 (Resoluciones Administrativas de Regulación) del DECRETO MUNICIPAL No 003 REGLAMENTO DEL IMPUESTO MUNICIPAL A LAS TRANSFERENCIAS ONEROSAS DE INMUEBLES Y VEHICULOS AUTOMOTORES, refiere lo siguiente: "La Administración Tributaria Municipal del GAMEA queda facultada para la emisión de normas administrativas que permitan aclarar y regular aspectos técnicos y tributarios inherentes al objeto del presente reglamento".

                    <br>Que, el Decreto Municipal N° 014 de fecha 12 de febrero de 2014, tiene por objeto APROBAR, CREAR Y ORGANIZAR LA JERARQUIA NORMATIVA y la emisión de normas Administrativas Municipales, de forma supletoria para el funcionamiento del Órgano Ejecutivo del Gobierno Autónomo Municipal de El Alto, a través de las cuales ejerce sus facultades reglamentarias y ejecutivas previstas por la Constitución Política del Estado Plurinacional de Bolivia y la Ley. Dicha Disposición Municipal en su Articulo 34 señala: "... (Resolución Administrativa) Es la normativa jurídica que emerge de las disposiciones legales vigentes a efectos de aplicar dentro de los procesos y procedimientos administrativos de las Unidades organizaciones del órgano ejecutivo del Gobierno Autónomo Municipal de El Alto, en marco de la norma vigente...".

                    <br><br>POR TANTO:

                    <br>El señor Director de Recaudaciones y Políticas Tributarias del Gobierno Autónomo Municipal de El Alto, en cumplimiento de las atribuciones conferidas por la Constitución Política del Estado, Ley de Gobiernos Autónomos Municipales, Ley Marco de Autonomías y Descentralización "Andrés Ibáñez" Ley N.° 031, Ley N° 2492 (Código Tributario), Ley Municipal N° 003/2012, Decreto Municipal N°003 y demas normas conexas.

                    <br>RESUELVE:

                    <br>ARTICULO 1°.-. Se APRUEBAlos “REQUISITOS PARA TRAMITES ADMINISTRATIVOS DE INMUEBLES, VEHICULOS, ACTIVIDADES ECONOMICAS, PUBLICIDAD Y PROPAGANDA", cuyo detalle se encuentra desarrollado en el Anexo 1 y Anexo 2 y los cuales se constituyen en parte indisoluble de la presente Resolución Administrativa.

                    <br>ARTICULO 2°.- I. En cumplimiento a lo dispuesto por el Art. 67 de la Ley N° 2492
                    (Código Tributario), todo tramite administrativo debe ser realizado en forma personal
                    por el Titular del Registro Tributario o mediante Testimonio de Escritura Publica de Poder
                    Especial Notarial de representación.

                    <br>II. Para efectos de seguridad todo poder que haya pasado mas de un ano desde su
                    emisión requerirá la actualización del notario. Los poderes pueden ser de carácter
                    general y de carácter especial. Los generales suficientemente deben indicar
                    apersonamiento ante municipios o alcaldías sin necesidad de especificar el tipo de
                    tramites a realizarse, y los especiales señalar en forma especifica el apersonamiento y
                    las facultades, deberá ser específico para el tramite o tramites a realizarse. Para
                    transferencias deberá ser poder especial.

                    <br>III. Todo tramite debe iniciarse y gestionarse como requisitos esenciales con la
                    presentación de la Cedula de Identidad, Pasaporte o Carnet de Extranjero y su
                    correspondiente fotocopia de cada una de las partes intervinientes en el acto, así como
                    del apoderado o representante legal según corresponda a Persona Natural o Persona
                    Jurídica.

                    <br>ARTICULO 3°.-En los diversos tramites y requisitos que se consignan en el anexo 1 y
                    anexo 2 de la presente Resolución Administrativa deberá tomarse en cuenta la siguiente
                    simbología:

                    <br>a) El documento que se consigne en la tabla de requisitos del anexo 1 y anexo 2, el
                    símbolo de un asterisco (\*) debe ser presentado en original.

                    <br>b) El documento que se consigne en la tabla de requisitos del anexo 1 y anexo 2, el
                    símbolo de dos asteriscos (\*\*) debe ser presentado en fotocopias legalizadas.

                    <br>c) El documento que se consigne en la tabla de requisitos del anexo 1 y anexo 2, el
                    símbolo de tres asteriscos (\*\*\*) debe ser presentado solo en fotocopia simple.

                    <br>ARTICULO 4°.- En cumplimiento a la Ordenanza Municipal N° 134/2005 que aprueba
                    la tabla clasificadora de OTROS INGRESOS NO TRIBUTARIOS vigentes del Gobierno
                    Autónomo Municipal de El Alto, el sujeto pasivo y/o peticionante en forma obligatoria
                    deberá adjuntar a su solicitud dos (2) Timbres administrativos

                    <br>DISPOSICIONES FINALES

                    <br>PRIMERA. Quedan encargados del cumplimiento de la presente Resolución
                    Administrativa, todo el personal de las Unidades Organizacionales dependientes de la
                    Dirección de Recaudaciones y Políticas Tributarias del Gobierno Autónomo Municipal de
                    El Alto.

                    <br>SEGUNDA. - Por la Secretaria Municipal de Gestión Institucional, realizar las gestiones
                    correspondientes para la publicación de la presente Resolución Administrativa y el anexo
                    1 y anexo 2, en la Gaceta Municipal del Gobierno Autónomo Municipal de El Alto, de
                    acuerdo a lo previsto en el párrafo I del Artículo 135 de la Ley Marco de Autonomías N°
                    031 y a los fines de lo establecido por el Art. 130 la Ley N° 2492.

                    <br>DISPOSICIONES ABROGATORIAS

                    <br>UNICA. Se ABROGA en su totalidad la Resolución Administrativa DRPT/Na009/2017 y
                    todas la Disposiciones Normativas de Igual o Inferior jerarquía contrarias a la presente
                    Resolucion Administrativa.

                    <br>GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO

                    <br>ANEXO 1

                    <br><br>REQUISITOS PARA TRAMITES DE BIENES INMUEBLES EMPADRONAMIENTOS, EMPADRONAMIENTOS DE BIENES INMUEBLES POR POSESION
                    <br>Para persona natural:
                    <br>1. Solicitud escrita de Empadronamiento (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Documento que acredite la tenencia del bien inmueble (Minuta, Contrato, recibido u otros)
                    <br>3. Piano de Lote visado por la Sub Alcaldía
                    <br>4. Certificación de sub Alcaldía
                    <br>5. Declaración Jurada Ante Notaria de fe Publica (si corresponde)

                    <br>Para persona Jurídica:
                    <br>1. Solicitud escrita de Empadronamiento (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. NIT (si corresponde)
                    <br>3. Testimonio de Constitución de Sociedad
                    <br>4. Documento que acredite la tenencia del bien inmueble (Minutas, Contratos, recibidos u otros)
                    <br>5. Plano de Lote visado por la Sub Alcaldía
                    <br>6. Certificación de sub Alcaldía
                    <br>7. Declaración Jurada Ante Notaria de fe Publica (si corresponde)

                    <br><br>REQUISITOS PARA EMPADRONAMIENTOS DE BIENES INMUEBLES POR USUCAPION
                    <br>Para persona natural:
                    <br>1. Testimonio de Propiedad (Minuta, Contrato, recibido u otros)
                    <br>2. Sentencia o proceso JUDICIAL
                    <br>3. Plano de Lote visado por la Sub Alcaldía
                    <br>4. Certificación de sub Alcaldía
                    <br>5. Declaración Jurada Ante Notaria de fe Publica (si corresponde)
                    <br>6. Minuta o Testimonio de Adjudicación Judicial

                    <br>Para persona Jurídica:
                    <br>1. NIT (si corresponde)
                    <br>2. Testimonio de Constitución de Sociedad
                    <br>3. Sentencia o proceso JUDICIAL
                    <br>4. Certificación de sub Alcaldía
                    <br>5. Declaración Jurada Ante Notaria de fe Publica (si corresponde)
                    <br>6. Plano de Lote visado por la Sub Alcaldía
                    <br>7. Minuta Adjudicación Judicial

                    <br><br>REQUISITOS PARA EMPADRONAMIENTOS DE BIENES INMUEBLES POR CAMBIO DE JURISDICCIÓN

                    <br>Para persona natural:
                    <br>1. Testimonio de Propiedad
                    <br>2. Folio Real (con cambio de jurisdicción)
                    <br>3. Piano de Lote visado por la Sub Alcaldía
                    <br>4. Certificación de sub Alcaldía
                    <br>5. Declaración Jurada Ante Notaria de fe Publica (si corresponde)
                    <br>6. Certificación de Ubicación Jurisdiccional- emitido por la Dirección de Catastro del GAMEA (para superficies mayo res a 1000 m2)

                    <br>Para persona Jurídica:
                    <br>1. NIT (si corresponde)
                    <br>2. Testimonio de Constitución de Sociedad
                    <br>3. Testimonio de Propiedad
                    <br>4. Fofio Real (con cambio de jurisdicción)
                    <br>5. Plano de Lote visado por la Sub Alcaldía
                    <br>6. Certificación de sub Alcaldía
                    <br>7. Declaración Jurada Ante Notaria de fe Publica (si corresponde)
                    <br>8. Certificación de Ubicación Jurisdiccional- emitido por la Dirección de Catastro del GAMEA (para superficies mayores a 1000 m2)

                    <br><br>REQUISITOS PARA EMPADRONAMIENTOS DE BIENES INMUEBLES CON DECLARACIÓN JURADA EN NOTARIA

                    <br>Para persona natural:
                    <br>1. Solicitud escrita de Empadronamiento (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Declaración jurada de del poseedor ante notaria de fe publica certificación de junta de vecinos con firma de dirigentes (mínimo 3 firmas)
                    <br>3. Factura de luz
                    <br>4. Plano de Lote visado por la Sub Alcaldía
                    <br>5. Certificación de sub Alcaldía

                    <br><br>REQUISITOS PARA TRANSFERENCIAS, TRANSFERENCIA ONEROSA DE BIENES INMUEBLES
                    <br>Para persona natural:
                    <br>1. Testimonio de Propiedad
                    <br>2. Tarjeta de Registro de Propiedad o Folio Real
                    <br>3. Minuta de Transferencia
                    <br>4. Ultimo comprobante de pago del Impuesto (IMPBI).
                    <br>5. Plano de ubicación actualizado
                    <br>6. Información rápida (si el folio es anterior a dos años)

                    <br><br>Para persona Jurídica:
                    <br>1. NIT (Comprador y/o Vendedor según corresponda)
                    <br>2. Testimonio de Propiedad
                    <br>3. Tarjeta de Registro de Propiedad o Folio Real
                    <br>4. Minuta de Transferencia
                    <br>5. Ultimo comprobante de pago del Impuesto (IMPBI).
                    <br>6. Plano de ubicación actualizado
                    <br>7. Información rápida (si el folio es anterior a dos años)
                    <br>Nota: Para Transferencias en Acciones y Derechos en la Minuta deberá señalar el porcentaje (%) Y SU EQUIVALENTES EN METROS CUADRADOS Correspondiente.

                    <br><br>REQUISITOS PARA TRANSFERENCIA DE BIENES INMUEBLES ADJUDICADOS POR PROCESOS JUDICIALES
                    <br>Para persona natural:
                    <br>1. Sentencia o PROCESO JUDICIAL
                    <br>2. Minuta de Adjudicación Judicial
                    <br>3. Ultimo comprobante de pago del Impuesto (IMPBI)
                    <br>4. Testimonio de Propiedad
                    <br>5. Tarjeta de Registro de Propiedad o Folio Real
                    <br>6. Plano de ubicación actualizado
                    <br>7. Información rápida (si el folio es anterior a dos años)
                    <br>Nota: Para Transferencias en Acciones y Derechos en la Minuta deberá señalar el porcentaje (%) Y SU EQUIVALENTE EN METROS CUADRADOS Correspondiente.

                    <br><br>Para persona Jurídica:
                    <br>Sentencia o PROCESO JUDICIAL
                    <br>1. NIT (Comprador y/o Vendedor según corresponda)
                    <br>2. Minuta de Adjudicación Judicial
                    <br>3. Ultimo comprobante de pago del Impuesto (IMPBI)
                    <br>4. Testimonio de Propiedad
                    <br>5. Tarjeta de Registro de Propiedad o Folio Real
                    <br>6. Plano de ubicación actualizado
                    <br>7. Información rápida (si el folio es anterior a dos años)
                    <br>Nota: Para Transferencias en Acciones y Derechos en la Minuta deberá señalar el porcentaje (%) Y SU EQUIVALENTE EN METROS CUADRADOS Correspondiente.

                    <br><br>REQUISITOS PARA TRANSFERENCIA DE BIENES INMUEBLES POR SUCESION HEREDITARIA, ANTICIPO DE LEGITIMA, APORTE DE CAPITAL, DONACION, FUSION U OTROS
                    <br>Para persona natural:
                    <br>1. Testimonio de Propiedad a Titulo gratuito
                    <br>2. Folio Real de la Transferencia a Titulo gratuito
                    <br>3. Testimonio de Propiedad (origen)
                    <br>4. Folio Real (origen)
                    <br>5. Ultimo comprobante de pago del Impuesto (IMPBI).
                    <br>6. Plano de Ubicación Actualizado

                    <br><br>Para persona Jurídica:
                    <br>1. NIT (Beneficiario)
                    <br>2. Testimonio de Propiedad a Titulo gratuito
                    <br>3. Folio Real de la Transferencia a Titulo gratuito
                    <br>4. Testimonio de Propiedad (origen)
                    <br>5. Folio Real (origen)
                    <br>6. Ultimo comprobante de pago del Impuesto (IMPBI).
                    <br>7. Plano de Ubicación Actualizado

                    <br><br>REQUISITOS PARA RECISION o DESISTIMIENTO DE VENTA (MINUTA O ESCRITURA) DE BIENES INMUEBLES
                    <br>Para persona natural:
                    <br>1. Minuta de Recisión o Desistimiento de Venta
                    <br>2. Minuta de compra/venta o escritura Publica de Transferencia
                    <br>3. Pago del Impuesto Municipal a la Transferencia Onerosa
                    <br>4. Ultimo comprobante de pago del Impuesto (IMPBI).
                    <br>5. Información Rápida actual
                    <br>6. Plano de Ubicación Actualizado
                    <br>7. Tarjeta de Registro de Propiedad o Folio Real
                    <br>8. Testimonio de origen
                    <br>Nota: Si no posee la BOLETA ORIGINAL deberá presentar originales de TESTIMONIOS DE LA COMPRA VENTA YDE RECESION.

                    <br><br>Para persona Jurídica:
                    <br>1. NIT (Comprador y Vendedor - según corresponda)
                    <br>2. Minuta de compra/venta o escritura Publica de Transferencia
                    <br>3. Minuta de Recisión o Desistimiento de Venta
                    <br>4. Pago del Impuesto Municipal a la Transferencia Onerosa
                    <br>5. Ultimo comprobante de pago del Impuesto (IMPBI).
                    <br>6. Información Rápida actual
                    <br>7. Plano de Ubicación Actualizado
                    <br>8. Tarjeta de Registro de Propiedad o Folio Real
                    <br>9. Testimonio de origen
                    <br>Nota: Si no posee la BOLETA ORIGINAL deberá presentar originales de TESTIMONIOS DE LA COMPRA VENTA YDE RECESION.

                    <br>OTROS TRAMITES DE CARACTER TECNICO DE BIENES INMUEBLES - REQUISITOS PARA MODIFICACIÓN DE DATOS TECNICOS DEL INMUEBLE DE CARACTER Voluntario

                    <br>Para persona natural:
                    <br>1. Comprobante de pago del Impuesto (IMPBI)
                    <br>2. Testimonio de Propiedad
                    <br>3. Folio Real (para modificación de datos de: ubicación, y superficie de terreno)
                    <br>4. Plano de lote actualizado

                    <br>Para persona Jurídica:
                    <br>1. Comprobante de pago de Impuesto (IMPBI)
                    <br>2. Testimonio de Propiedad
                    <br>3. Folio Real (para modificación de datos de: ubicación, y superficie de terreno)
                    <br>4. Plano de lote actualizado
                    <br>5. Plano de Construcción o fotos (en caso de construcciones grandes)


                    <br>REQUISITOS PARA MODIFICACIÓN DE DATOS TECNICOS - ADICION DE CONSTRUCCION DE BIENES INMUEBLES
                    <br>Para persona natural:
                    <br>1. Comprobante de pago del Impuesto (IMPBI)
                    <br>2. Plano de lote, plano de construcción y fotos
                    <br>3. Testimonio de Propiedad
                    <br>4. Tarjeta de Registro de Propiedad o Folio Real

                    <br>Para persona Jurídica:
                    <br>1. Comprobante de pago de Impuesto (IMPBI)
                    <br>2. Plano de lote, plano de construcción y fotos
                    <br>3. Testimonio de Propiedad
                    <br>4. Tarjeta de Registro de Propiedad o Folio Real

                    <br>REQUISITOS PARA MODIFICACION DE DATOS TECNICOS DE BIENES INMUEBLES CON INSPECCiÓN PREDIAL
                    <br>Para persona natural:
                    <br>1. Comprobante de pago del Impuesto (IMPBI)
                    <br>2. Plano de lote, plano de construcción y fotos
                    <br>3. Testimonio de Propiedad
                    <br>4. Tarjeta de Registro de Propiedad o Folio Real
                    <br>5. Informe Predial emitido por el Área Técnica Predial de la ATM

                    <br>Para persona Jurídica:
                    <br>1. Comprobante de pago del Impuesto (IMPBI)
                    <br>2. Original y Fotocopia del piano de lote , piano de construcción y fotos
                    <br>3. Testimonio de Propiedad
                    <br>4. Tarjeta de Registro de Propiedad o Folio Real
                    <br>5. Informe Predial emitido por el Área Técnica Predial de la ATM

                    <br><br>REQUISITOS PARA FUSION DE INMUEBLES GLOBAL FUSIONADO Para persona natural
                    <br>1. Comprobantes de pago del Impuesto de los Inmuebles (IMPBI)
                    <br>2. Testimonies de Propiedad (fusionado)
                    <br>3. Folios Reales (fusionado)
                    <br>4. Plano de lote global (fusionado)

                    <br><br>REQUISITOS PARA FUSION DE INMUEBLES INDIVIDUAL Para persona natural
                    <br>1. Comprobante de pago del Impuesto de los Inmueble individuales (IMPBI)
                    <br>2. Testimonio de Propiedad (individuales)
                    <br>3. Folio Real (individuales)
                    <br>4. Plano de lote (individuales)

                    <br><br>REQUISITOS PARA DIVISION Y PARTICION O FRACCIONAMIENTO DE INMUEBLES GLOBAL
                    <br>1. Comprobante de pago del Impuesto del Inmueble global (IMPBI)
                    <br>2. Testimonio de Propiedad (global)
                    <br>3. Folio Real (global)
                    <br>4. Plano de lote (global)

                    <br><br>REQUISITOS PARA DIVISION Y PARTICION O FRACCIONAMIENTO DE INMUEBLES INDIVIDUAL
                    <br>1. Comprobante de pago del Impuesto del Inmueble global (IMPBI)
                    <br>2. Testimonio de división y partición de Propiedad
                    <br>3. Folio Real (individual)
                    <br>4. Piano de lote (individual)
                    <br>Nota: En caso de SESION DE AREA adjuntar folio real y testimonio de sesión de superficie correspondiente

                    <br><br>REQUISITOS PARA OTROS TRAMITES DE CARACTER ADMINISTRATIVO AUTO AVALUO (PROPIEDAD RURAL)
                    <br>Para persona natural:
                    <br>1. Comprobante de pago del Impuesto (IMPBI)
                    <br>2. Para persona Jurídica:- Empresa
                    <br>3. Comprobante de pago del Impuesto (IMPBI)
                    <br>4. NIT (según corresponda)

                    <br><br>REQUISITOS PARA PERSONA JURIDICA- EMPRESA VALOR LIBROS
                    <br>1. C.I. original y fotocopia de las partes involucradas
                    <br>2. terceras personas o personas juridicas solo con poder de representacion notariado en original o fotocopia legalizada mas una fotocopia simple
                    <br>3. si hubiese pasado mas de un año de la emision requerira la actualizacion del notario
                    <br>4. todas las solicitudes escritas deben contar con dos trimbres
                    <br>5. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>6. Estados Financieros - Balance General
                    <br>7. Detalle y desglose de los Inmuebles (cuadro de ajustes del 1RO de enero hasta el 31 de diciembre de la gestión que requiere la liquidación) EN ORIGINAL
                    <br>8. Plano de lote actualizado
                    <br>9. NIT
                    <br>10. Folio real
                    <br>11. Comprobante de pago de impuesto (IMPBI)
                    <br>Nota: referirse a los requisitos expuestos en el sitio

                    <br>dd<br>REQUISITOS PARA PERSONA JURIDICA- VALOR EN TABLAS
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Comprobante de pago del Impuesto (IMPBI)
                    <br>3. Testimonio de Propiedad
                    <br>4. Folio Real (para modificación de datos de: ubicación, y superficie de terreno)
                    <br>5. Plano de Lote actualizado

                    <br><br>REQUISITOS PARA REDUCCIÓN de SANCIONES
                    <br>Para persona natural:
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Proforma de liquidación.

                    <br>Para persona Jurídica:
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Proforma de liquidación.


                    <br><br>REQUISITOS PARA FACILIDADES DE PAGO

                    <br>Para persona natural:
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Plano de ubicación o croquis de ubicación.
                    <br>3. Testimonio de Propiedad (inmueble vigente).
                    <br>4. Tarjeta de Registro de Propiedad y/o Folio Real (inmueble vigente).
                    <br>5. Proforma de liquidación.
                    <br>Para persona Jurídica:
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Plano de ubicación o croquis de ubicación.
                    <br>3. Testimonio de Propiedad (inmueble vigente).
                    <br>4. Tarjeta de Registro de Propiedad y/o Folio Real (inmueble vigente).
                    <br>5. Proforma de liquidación.


                    <br><br>REQUISITOS PARA DESBLOQUEO
                    <br>Para persona natural:
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Proforma de liquidación
                    <br>3. Testimonio de propiedad.(compra y venta)
                    <br>4. Folio real y/o Tarjeta de Registro de Propiedad.
                    <br>5. Comprobante de pago del Impuesto (IMPBI)
                    <br>6. Plano de Lote
                    <br>7. Plano de Construcción o fotos (en case de construcciones grandes).

                    <br>Para persona Jurídica:
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Proforma de liquidación.
                    <br>3. Testimonio de propiedad.(compra y venta).
                    <br>4. Folio real y/o Tarjeta de Registro de Propiedad
                    <br>5. Comprobante de pago del Impuesto (IMPBI)
                    <br>6. Plano de Lote
                    <br>7. Plano de Construcción o fotos (en caso de construcciones grandes).

                    <br><br>REQUISITOS PARA BAJA POR DOBLE EMPADRONAMIENTO (MISMOS PROPIETARIOS)

                    <br>Para persona natural:
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal)
                    <br>2. Testimonio de Propiedad (inmueble vigente).
                    <br>3. Tarjeta de Registro de Propiedad y/o Folio Real (inmueble vigente).
                    <br>4. Plano de lote (inmueble vigente).
                    <br>5. Plano de ubicación o croquis (detallado, inmueble vigente).
                    <br>6. Comprobantes de pago del inmueble vigente (IMPBI)
                    <br>7. Comprobantes de pago del inmueble para baja (IMPBI) si corresponde
                    <br>8. Certificado de Propiedad emitido por DD.RR. (inmueble vigente).

                    <br>Para persona Jurídica:
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Testimonio de Propiedad (inmueble vigente).
                    <br>3. Tarjeta de Registro de Propiedad y/o Folio Real (inmueble vigente).
                    <br>4. Plano de lote (inmueble vigente).
                    <br>5. Plano de ubicación o croquis (detallado, inmueble vigente).
                    <br>6. Comprobantes de pago del inmueble vigente (IMPBI)
                    <br>7. Comprobantes de pago del inmueble para baja (IMPBI) si corresponde
                    <br>8. Certificado de Propiedad emitido por DD.RR. (inmueble vigente).
                    <br>9. Estados financieros con desglose del inmueble (inmueble vigente).
                    <br>10. NIT (inmueble vigente).

                    <br><br>REQUISITOS PARA BAJA POR DOBLE EMPADRONAMIENTO (PROPIETARIOS DIFERENTES)
                    <br>Para persona natural:
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Testimonio de Propiedad (inmueble vigente).
                    <br>3. Tarjeta de Registro de Propiedad y/o Folio Real (inmueble vigente).
                    <br>4. Plano de lote (inmueble vigente).
                    <br>5. Plano de ubicación o croquis (detallado, inmueble vigente).
                    <br>6. Comprobantes de pago del inmueble vigente (IMPBI)
                    <br>7. Comprobantes de pago del inmueble para baja (IMPBI) si corresponde
                    <br>8. Certificado de NO Propiedad emitido por DD.RR. (inmueble vigente).

                    <br>Para persona Jurídica:
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Testimonio de Propiedad (inmueble vigente).
                    <br>3. Tarjeta de Registro de Propiedad y/o Folio Real (inmueble vigente).
                    <br>4. Plano de lote (inmueble vigente).
                    <br>5. Plano de ubicación o croquis (detallado, inmueble vigente).
                    <br>6. Comprobantes de pago del inmueble vigente (IMPBI)
                    <br>7. Comprobantes de pago del inmueble para baja (IMPBI) si corresponde
                    <br>8. Certificado de NO Propiedad emitido por DD.RR. (inmueble vigente).
                    <br>9. Estados financieros con desglose del inmueble (inmueble vigente).
                    <br>10. NIT (inmueble vigente).

                    <br><br>REQUISITOS PARA BAJA POR CAMBIO DE JURISDICCIÓN
                    <br>Para persona natural:
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal)
                    <br>2. Testimonio de Propiedad.
                    <br>3. Tarjeta de Registro de Propiedad y/o Folio Real.
                    <br>4. Plano de lote
                    <br>5. Comprobantes de pago del inmueble para baja (IMPBI).
                    <br>6. Certificado Jurisdiccional emitido por la Unidad de límites territoriales. (Catastro GAMEA)

                    <br>Para persona Jurídica:
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Testimonio de Propiedad.
                    <br>3. Tarjeta de Registro de Propiedad y/o Folio Real.
                    <br>4. Plano de lote
                    <br>5. Comprobantes de pago del inmueble para baja (IMPBI).
                    <br>6. Certificado Jurisdiccional emitido por la Unidad de limites territoriales. (Catastro GAMEA)
                    <br>7. Estados financieros con desglose del inmueble
                    <br>8. NIT

                    <br><br>REQUISITOS PARA BAJA POR INMUEBLE POR NO POSESION Y/O DESCONOCIMIENTO DE LA Ubicación DEL INMUEBLE
                    <br>Para persona natural:
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Testimonio de Propiedad (SI CORRESPONDE)
                    <br>3. Tarjeta de Registro de Propiedad y/o Folio Real. (SI CORRESPONDE)
                    <br>4. Plano de ubicación o croquis detallado.
                    <br>5. Comprobantes de pago del inmueble para baja (IMPBI) si corresponde.
                    <br>6. Certificado de NO Propiedad emitido por DD.RR.
                    <br>7. Certificado de CATASTRQ- GAMEA indicando que es AREA VERDE (SI CORRESPONDE)


                    <br>Para persona Jurídica:
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Testimonio de Propiedad (SI CORRESPONDE)
                    <br>3. Tarjeta de Registro de Propiedad y/o Folio Real. (SI CORRESPONDE)
                    <br>4. Plano de ubicación o croquis (detallado).
                    <br>5. Comprobantes de pago del inmueble para baja (IMPBI).
                    <br>6. Certificado de NO Propiedad emitido por DD.RR.
                    <br>7. Certificado de CATASTRO- GAMEA indicando que es AREA VERDE (SI CORRESPONDE)
                    <br>8. Estados financieros con desglose del inmueble
                    <br>9. NIT


                    <br><br>REQUISITOS PARA ACCION DE REPETICION
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Testimonio de Propiedad.
                    <br>3. Tarjeta de Registro de Propiedad y/o Folio Real.
                    <br>4. Plano de lote
                    <br>5. Plano de Construcción o fotos (en caso de construcciones grandes).
                    <br>6. Comprobante de pago de la gestión pagada previamente (IPBI/IMPBI)..
                    <br>7. Comprobante de pago de la gestión pagada posteriormente (IPBI/IMPBI).


                    <br><br>REQUISITOS PARA ALTA DE INMUEBLE
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Testimonio de Propiedad.
                    <br>3. Tarjeta de Registro de Propiedad y/o Folio Real.
                    <br>4. Plano de lote de Plano de ubicación o croquis (detallado).
                    <br>5. Certificado de Propiedad emitida por DD.RR.


                    <br><br>REQUISITOS DE PRESCRIPCIÓN de inmueble
                    <br>Para persona natural:
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Testimonio de propiedad.
                    <br>3. Folio real y/o Tarjeta de Registro de Propiedad.(compra y venta)
                    <br>4. Comprobante de pago del Impuesto (IMPBI).
                    <br>5. Plano de lote
                    <br> 6. Plano de Construcción o fotos (en caso de construcciones grandes).

                    <br>Para persona Jurídica:
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Testimonio de propiedad.
                    <br>3. Folio real y/o Tarjeta de Registro de Propiedad.(compra y venta)
                    <br>4. Comprobante de pago del Impuesto (IMPBI).
                    <br>5. Plano de lote
                    <br>6. Plano de Construcción o fotos (en caso de construcciones grandes).
                    <br>7. Estados financieros con desglose del inmueble
                    <br>8. NIT

                    <br><br>REQUISITOS PARA EXENCIONES PERSONAS DE 60 AÑOS O MAS (TERCERA EDAD)
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Testimonio de Propiedad. (compra y venta)
                    <br>3. Folio Real y/o Tarjeta de Registro de Propiedad.
                    <br>4. Certificado de vivencia actualizado (cuando corresponda)
                    <br>5. Plano de Lote
                    <br>6. Plano de Construcción o fotos (en caso de construcciones grandes).


                    <br><br>REQUISITOS PARA REQUISITOS PARA EXENCIONES BENEMERITOS DE LA CAMPANA DEL CHACO O SUS VIUDAS

                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Testimonio de Propiedad. (compra y venta)
                    <br>3. Folio Real y/o Tarjeta de Registro de Propiedad.
                    <br>4. Resolución Suprema de declaratoria de Benemérito o viuda de benemérito
                    <br>5. Plano de Lote
                    <br>6. Plano de Construcción o fotos (en caso de construcciones grandes).


                    <br>REQUISITOS PARA EXENCIONES ASOCIACIONES, FUNDACIONES O INSTITUCIONES NO LUCRATIVAS
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Testimonio de Propiedad. (compra y venta)
                    <br>3. Folio Real y/o Tarjeta de Registro de Propiedad.
                    <br>4. Plano de Lote
                    <br>5. Plano de Construcción o fotos (en caso de construcciones grandes).
                    <br>6. Estatutos aprobados
                    <br>7. Reconocimiento de personería jurídica o documento de constitución, según corresponda
                    <br>8. Estados financieros, memoria anual y/o registros contables con desglose del inmueble.
                    <br>9. NIT (Si corresponde)


                    <br><br>REQUISITOS PARA EXCLUSIONES (INSTITUCIONES PUBLICAS, MISIONES DIPLOMATICAS Y CONSULARES)

                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Testimonio de Propiedad. (compra y venta)
                    <br>3. Folio Real y/o Tarjeta de Registro de Propiedad.
                    <br>4. Plano de Lote
                    <br>5. Proforma de liquidación
                    <br>6. Testimonio de constitución o documento de creación.
                    <br>7. Estados financieros, memoria anual y/o registros contables con desglose del inmueble.
                    <br>8. NIT (Si corresponde)

                    <br><br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES para INSCRIPCIÓN IMPORTACIÓN DIRECTA Vehículo/MOTOCICLETA
                    <br>1. Póliza de Importación
                    <br>2. Formulario de Registro de Vehículos (FRV)
                    <br>3. Declaración Importación de Mercancías (D.I.M.) (en caso de no contar con los requisitos anteriores)
                    <br>4. NIT (Para persona Jurídica) (Si corresponde)


                    <br><br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA INSCRIPCIÓN CON FACTURA COMERCIAL VEHÍCULO/MOTOCICLETA
                    <br>1. Póliza de Importación
                    <br>2. Formulario de Registro de Vehículos (FRV)
                    <br>3. Declaración Importación de Mercancías (D.I.M.) (en caso de no contar con los requisitos anteriores)
                    <br>4. NIT (Para persona Jurídica) (Si corresponde)


                    <br><br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA CAMBIO DE SERVICIO
                    <br>1. Tarjeta de operación emitida por la autoridad componte.
                    <br>2. Certificado de Registro de Propiedad - Vehículo Automotor (CRPVA) o RUA -03
                    <br>3. NIT (Para persona Jurídica) (Si corresponde)

                    <br><br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA CAMBIO DE RADICATORIA
                    <br>1. Certificado de Registro de Propiedad - Vehículo Automotor (CRPVA) o RUA -03
                    <br>2. Fotocopia NIT (Según corresponda)


                    <br><br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA MODIFICACION DATOS TECNICOS
                    <br>1. Certificado de Registro de Propiedad - Vehículo Automotor (CRPVA) o RUA -03
                    <br>2. Resolución de Modificación de Datos Técnicos (emitida por la Dirección Nacional de Transito,
                    <br>3. Transporte y Seguridad Vial)
                    <br>4. NIT (Para persona Jurídica) (Si corresponde)


                    <br><br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA MODIFICACIÓN DATOS TECNICOS CAMBIO DE ESTRUCTURA
                    <br>1. Certificado de Registro de Propiedad - Vehículo Automotor (CRPVA) o RUA 03
                    <br>2. Resolución de Modificación de Datos Cambio de Estructura (emitida por la Dirección Nacional de Transito, Transporte y Seguridad Vial)
                    <br>3. NIT (Para persona Jurídica) (Si corresponde)

                    <br><br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA TRANSFERENCIA ESPECIAL - DECLARATORIA DE HEREDEROS, ANTICIPO DE LEGftlMA, DONACIÓN, APORTE DE CAPITAL, FUSION Y OTROS
                    <br>1. Testimonio (sucesión hereditaria, anticipo de legitima, donación u otros)
                    <br>2. Certificado de Registro de Propiedad -Vehículo Automotor (CRPVA) o RUA -03
                    <br>3. NIT (Para persona Jurídica) (Si corresponde)
                    <br>4. Formulario 430 emitida por el Servicio de Impuestos Nacionales (opcional)
                    <br>5. Póliza de Importación


                    <br> <br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA TRANSFERENCIA NORMAL
                    <br>1. Minuta de Compra y Venta (Visada por la Dirección Nacional de Transito, Transporte y Seguridad Vial)
                    <br>2. Certificado de Registro de Propiedad - Vehículo Automotor (CRPVA) o RUA -03
                    <br>3. Cedula de Identidad (Comprador y Vendedor)
                    <br>4. NIT (Para persona Jurídica) (Si corresponde)
                    <br>5. Póliza de Importación


                    <br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA CONCLUSION DE TRANSFERENCIA
                    <br>1. Testimonio Protocolizado
                    <br>2. Resolución y Ficha Kardex, emitida por la Dirección Nacional de Transito, Transporte y Seguridad Vial
                    <br>3. Certificado de Registro de Propiedad - Vehículo Automotor (CRPVA) o RUA -03
                    <br>4. NIT (Para persona Jurídica) (Si corresponde)


                    <br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA DUPLICADO DE CRPVA
                    <br>1. Certificado de Extravió, Robo o Deterioro de Certificado de Registro de Propiedad -Vehículo
                    <br>2. Automotor (CRPVA) o RUA -03, emitida por la Dirección Nacional de Transito, Transporte y Seguridad Vial
                    <br>3. NIT (Para persona Jurídica) (Si corresponde)


                    <br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA DUPLICADO DE PLACAS
                    <br>1. Certificado de Extravío, Robo o Deterioro de Placas, emitida por DlPROVE
                    <br>2. Certificado de Registro de Propiedad - Vehículo Automotor (CRPVA) o RUA -03
                    <br>3. NIT (Para persona Jurídica) (Si corresponde)


                    <br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA VALOR LIBROS
                    <br>1. Certificado de Registro de Propiedad - Vehi'culo Automotor (CRPVA) o RUA -03
                    <br>2. NIT (Para persona Jurídica) (Si corresponde)
                    <br>3. Balance General - Estados Financieros valor Libros
                    <br>4. Detalle y desglose de los Vehículos (cuadro de ajustes de la gestión fiscal que requiere la liquidación)

                    <br><br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA VALOR TABLAS
                    <br>1. Certificado de Registro de Propiedad - Vehículo Automotor (CRPVA) o RUA -03
                    <br>2. NIT (Para persona Jurídica) (Si corresponde)

                    <br><br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA RECISIÓN O DESISTIMIENTO
                    <br>1. Minuta de Compra y Venta (Visada por Transito)
                    <br>2. Minuta de Recisión o Desistimiento de Venta
                    <br>3. Certificado de Registro de Propiedad - Vehículo Automotor (CRPVA) o RUA -03
                    <br>4. NIT (Para persona Jurídica) (Si corresponde)
                    <br>5. Factura de Luz (domicilio del contribuyente)
                    <br>6. Testimonio de constitución (Personas Jurídicas según corresponda)

                    <br><br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA FACILIDADES DE PAGO
                    <br>1. Solicitud escrita del titular (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Plano de ubicación o croquis del domicilio legal.
                    <br>3. Certificado de Registro de Propiedad - Vehículo Automotor (CRPVA) o RUA -03
                    <br>4. Proforma de liquidación.


                    <br><br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA REDUCCIÓN de SANCIONES
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Proforma de liquidación.


                    <br><br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA CERTIFICACIONES DE PAGO, REGISTRO Y OTROS
                    <br>1. Certificado de Registro de Propiedad - Vehículo Automotor (CRPVA) o RUA -03
                    <br>2. Comprobante de pago del impuesto correspondiente.


                    <br><br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA COMPENSACIONES O CRÉDITO FISCAL
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Resolución Administrativa emitida dentro tramite
                    <br>3. Comprobante de pago del impuesto (IMPVAT)
                    <br>4. Certificado de Registro de Propiedad - Vehículo Automotor (CRPVA) o RUA -03
                    <br>5. NIT (Para persona Jurídica) (Si corresponde)


                    <br><br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA EXENCIONES DE VEHÍCULOS Y/O MOTOCICLETAS
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Póliza Titularizada, COPO o Póliza de Importación del Automotor, según corresponda
                    <br>3. Certificado de Registro de Propiedad - Vehículo Automotor (CRPVA) o RUA -03
                    <br>4. Proforma de liquidación
                    <br>5. Testimonio de constitución o documento de creación.
                    <br>6. Estados financieros, memoria anual y/o registros contables con desglose del vehículo (si corresponde).
                    <br>7. NIT (Si corresponde)


                    <br><br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA EXCLUSIONES DE VEHÍCULOS Y/O MOTOCICLETAS (INSTITUCIONES PUBLICAS, MISIONES DIPLOMATICAS Y CONSULARES)
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Acta de Posesión como Máxima Autoridad Ejecutiva o nombramiento de Representación
                    <br>3. Diplomática y consular homologada por la cancillería.
                    <br>4. Testimonio poder y/o memorándum de asignación de funciones (si corresponde)
                    <br>5. Fotocopia de cedula de identidad del funcionario (si corresponde)
                    <br>6. Certificado de Registro de Propiedad - Vehículo Automotor (CRPVA) o RUA -03
                    <br>7. Proforma de liquidación
                    <br>8. Testimonio de constitución o documento de creación.
                    <br>9. Estados financieros, memoria anual y/o registros contables con desglose del vehículo (si corresponde).
                    <br>10. NIT (Si corresponde)

                    <br><br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA PRESCRIPCION DE VEHICULOS Y/O MOTOCICLETAS
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Certificado de Registro de Propiedad - Vehículo Automotor (CRPVA) o RUA -03
                    <br>3. Comprobantes de pago del Impuesto (IMPVAT).
                    <br>4. Proforma de liquidación
                    <br>5. NIT (Para persona Jurídica) (Si corresponde)

                    <br><br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA BAJA DEFINITIVA DE VEHÍCULOS Y/O MOTOCICLETAS (Según R.A. 010)
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Certificado vigente de la Dirección de Transito, transporte y seguridad vial, de que el vehículo no ha realizado Inspección Técnica Vehicular por los últimos 3 años.
                    <br>3. Certificado vigente de la Dirección de Transito, transporte y seguridad vial, de que el vehículo no registra y/o se encuentran canceladas las infracciones de transito de los últimos 3 años.
                    <br>4. Certificado vigente de la ANH de que no haya efectuado el cargado de gasolina durante los últimos 3 años.
                    <br>5. Ficha Kardex vigente emitida por la Dirección de Transito, transporte y seguridad vial.
                    <br>6. Comprobante de pago del impuesto de las gestiones vigentes y correspondientes (IMPVAT).
                    <br>7. Certificación de denuncia e investigación del vehículo circunstanciada, emitida por DIPROVE (caso por robo).
                    <br>8. Devolución de placas, plaquetas y CRPVA (cualquiera que fuera la condición de las mismas) (si corresponde el caso)
                    <br>9. Declaratoria de herederos (si corresponde)


                    <br><br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA BAJA POR ROBO E INHABILITACIÓN DEL SISTEMA DE VEHÍCULOS Y/O MOTOCICLETAS (De no generar IMPVAT en adelante y procesos de fiscalización)
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Certificado vigente de la Dirección de Transito; transporte y seguridad vial, de que el vehículo no ha realizado inspección Técnica Vehicular por los últimos 3 años.
                    <br>3. Certificado vigente de la Dirección de Transito, transporte y seguridad vial, de que el vehículo no registra y/o se encuentran canceladas las infracciones de transito de los últimos 3 años.
                    <br>4. Certificado vigente de la ANH de que no haya efectuado el cargado de gasolina durante los últimos 3 años.
                    <br>5. Ficha Kardex vigente emitida por la Dirección de Transito, transporte y seguridad vial.
                    <br>6. Comprobante de pago del Impuesto mínimamente hasta la gestión de denuncia del robo (IMPVAT).
                    <br>7. Certificación de denuncia e investigación del vehículo circunstanciada, emitida por DIPROVE (caso por robo).
                    <br>8. Declaratoria de herederos (si corresponde)


                    <br><br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA BAJA TEMPORAL DE VEHÍCULOS Y/O MOTOCICLETAS CASO ROBO (inserción como observados al ser de mero tramite)
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Certificado de Registro de Propiedad - Vehículo Automotor (CRPVA) o RUA -03
                    <br>3. Certificación de denuncia e investigación del vehículo circunstanciada, emitida por DIPROVE (caso por robo).
                    <br>4. Comprobante de pago del Impuesto mínimamente hasta la gestión de denuncia del robo (IMPVAT).


                    <br><br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA ALTA DE VEHÍCULOS Y/O MOTOCICLETAS (En caso de recuperación de Vehículos por Robo)
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Certificado de Registro de Propiedad - Vehículo Automotor (CRPVA) o RUA -03
                    <br>3. Informe del vehículo recuperado, emitida por DIPROVE (Teniendo por consigna la fecha de la denuncia por robo y marcado del vehículo)
                    <br>4. Ultimo Comprobante de pago del Impuesto (IMPVAT) realizado hasta la gestión de denuncia de robo.


                    <br><br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES para BAJA DEFINITIVA DE VEHÍCULOS Y/O MOTOCICLETAS CASO SINIESTRO Y/U OBSOLESCENCIA (Según D.M. 04)
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Certificado de Registro de Propiedad - Vehículo Automotor (CRPVA) o RUA -03
                    <br>3. Comprobante de pago del impuesto mínimamente hasta la gestión de inspección por parte del organismo operativo de transito (IMPVAT).
                    <br>4. Informe del Organismo Operativo de Transito en caso de siniestro y obsolescencia (original y fotocopia)
                    <br>5. Devolución de placas, plaquetas (cualquiera que fuera la condición de las mismas) (si corresponde el caso)

                    <br><br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA BAJA DE REGISTRO FOR EXPORTACIÓN DE VEHÍCULOS Y/O MOTOCICLETAS
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Devolución del Certificado de Registro de Propiedad - Vehículo Automotor (CRPVA) o RUA - 03
                    <br>3. Declaración única de exportación DUE emitida por la Aduana Nacional
                    <br>4. Devolución de placas y plaquetas (cualquiera fuera la condición de las mismas)
                    <br>5. Comprobante de pago del Impuesto mínimamente hasta la gestión que se emita la DUE (IMPVAT).

                    <br><br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA DESBLOQUEO DE VEHÍCULOS AUTOMOTORES
                    <br>1. Solicitud escrita del o los propietarios (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Certificado de Registro de Propiedad - Vehículo Automotor (CRPVA) o RUA -03
                    <br>3. Comprobante de pago del Impuesto (IMPVAT).
                    <br>4. Documento Privado, Testimonio, Minuta, Poder, etc. que demuestre la cadena de traslación del titular con el actual propietario o poseedor.

                    <br><br>REQUISITOS PARA TRAMITES DE Vehículos AUTOMOTORES TERRESTRES PARA DESCUENTO POR SERVICIO PUBLICO VEHÍCULOS
                    <br>1. Certificado de Registro de Propiedad - Vehículo Automotor (CRPVA) o RUA -03
                    <br>2. Tarjeta de Operaciones gestión fiscal del Viceministerio de Transporte. ( Internacional - Interdepartamental) (según corresponda)
                    <br>3. Tarjeta de Operaciones gestión fiscal de la Gobernación. ( Interprovincial) (según corresponda)
                    <br>4. Tarjeta de Operaciones gestión fiscal de la Secretaria Municipal Urbana y Sostenible SMUS. (Municipal) (segun corresponda)


                    <br><br>REQUISITOS PARA TRAMITES DE PUBLICIDAD Y PROPAGANDA PARA EMPADRONAMIENTO PUBLICIDAD PERMANENTE EN PUNTO DE VENTA
                    <br>1. Fotografía de(l)(los) letrero(s) publicitario(s) (Especificar Ancho y Alto)
                    <br>2. Licencia de Funcionamiento (si corresponde)
                    <br>3. Croquis de ubicación de la Actividad Económica
                    <br>4. NIT (según corresponda)
                    <br>5. Certificado de Inscripción del SIN (según corresponda)
                    <br>6. Comprobante pago gestiones 2013 al 2015 (si corresponde)
                    <br>7. Factura de adquisición del letrero (si corresponde)
                    <br>8. Formulario FUTAE

                    <br><br>REQUISITOS PARA TRAMITES DE PUBLICIDAD Y PROPAGANDA PARA EMPADRONAMIENTO PUBLICIDAD PERMANENTE EN SITIO PUBLICO
                    <br>1. Solicitud escrita de autorización (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Fotomontaje de(l)(los) letrero(s) publicitario(s) (Especificar Ancho y Alto)
                    <br>3. Licencia de Funcionamiento (si corresponde)
                    <br>4. Croquis de ubicación solicitada para el elemento publicitario.
                    <br>5. NIT (según corresponda)
                    <br>6. Certificado de Inscripción del SIN (según corresponda)
                    <br>7. Factura de adquisición del letrero (si corresponde)
                    <br>8. Formulario FUTAE


                    <br><br>REQUISITOS PARA TRAMITES DE PUBLICIDAD Y PROPAGANDA PARA EMPADRONAMIENTO PUBLICIDAD EVENTUAL
                    <br>1. Solicitud escrita de autorización especificando fechas de emplazamiento (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Fotomontaje de(l)(los) letrero(s) publicitario(s) (Especificar Ancho y Alto) Licencia de Funcionamiento (si corresponde)
                    <br>3. Croquis de ubicación solicitada para el elemento publicitario.
                    <br>4. NIT (según corresponda)
                    <br>5. Certificado de Inscripción del SIN (según corresponda)


                    <br><br>REQUISITOS PARA TRAMITES DE PUBLICIDAD Y PROPAGANDA PARA BAJA SIN DEUDADE PUBLICIDAD PERMANENTE
                    <br>1. Fotógrafa de la Publicidad Retirada.
                    <br>2. Comprobante de pago (PMPPPE).
                    <br>3. Formulario FUTAE.


                    <br><br>REQUISITOS PARA TRAMITES DE PUBLICIDAD Y PROPAGANDA PARA BAJA CON DEUDA DE PUBLICIDAD PERMANENTE
                    <br>1. Solicitud escrita del titular (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Fotografía de la Publicidad Retirada.
                    <br>3. Formulario FUTAE.
                    <br>4. Proforma de liquidación.


                    <br><br>REQUISITOS PARA TRAMITES DE PUBLICIDAD Y PROPAGANDA PARA PRESCRIPCION DE PUBLICIDAD Y PROPAGANDA
                    <br>1. Solicitud escrita del titular (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Proforma de liquidación.


                    <br><br>REQUISITOS PARA TRAMITES DE PUBLICIDAD Y PROPAGANDA PARA DESBLOQUEO DE PUBLICIDAD Y PROPAGANDA
                    <br>1. Solicitud escrita del titular (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Proforma de liquidación.


                    <br><br>REQUISITOS PARA TRAMITES DE PUBLICIDAD Y PROPAGANDA PARA FACILIDADES DE PAGO DE PUBLICIDAD Y PROPAGANDA
                    <br>1. Solicitud escrita del titular (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Plano de ubicación o croquis de ubicación de la Publicidad.
                    <br>3. Proforma de liquidación.


                    <br><br>REQUISITOS PARA TRAMITES DE PUBLICIDAD Y PROPAGANDA PARA REDUCCION DE SANCIONES DE PUBLICIDAD Y PROPAGANDA
                    <br>1. Solicitud escrita del titular (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Proforma de liquidación.


                    <br><br>REQUISITOS PARA TRAMITES DE PUBLICIDAD Y PROPAGANDA PARA PAGOS PREVIOS DE PUBLICIDAD Y PROPAGANDA
                    <br>1. Solicitud escrita del titular (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Proforma de liquidación.
                    <br>3. Comprobante de pago (PMPPPE).


                    <br><br>REQUISITOS PARA TRAMITES DE PUBLICIDAD Y PROPAGANDA PARA EXENCION DE PUBLICIDAD Y PROPAGANDA
                    <br>1. Solicitud escrita del titular (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Proforma de liquidación.


                    <br><br>REQUISITOS PARA TRAMITES DE ACTIVIDADES ECONOMICAS PARA EMPADRONAMIENTO DE ACTVIDAD ECONOMICA
                    <br>1. Folder mas Formularios FUTAE y FUI
                    <br>2. Factura de Electricidad de la Actividad
                    <br>3. Testimonio de Constitución o documento de creación (Personas Jurídicas)
                    <br>4. Documentos adicionales según corresponda a la actividad.


                    <br><br>REQUISITOS PARA TRAMITES DE ACTIVIDADES ECONOMICAS PARA RENOVACIÓN DE LICENCIA DE FUNCIONAMIENTO O MODIFICACION DE TIPO, UBICACION Y SUPERFICIE
                    <br>1. Formularios FUTAE y FUI
                    <br>2. Devolución de la LICENCIA original (en caso de perdida de la Licencia, adjuntar originales de las 2 publicaciones de dos días diferentes remarcando el aviso)
                    <br>3. Comprobante de pago de la patente (PMPAE)
                    <br>4. Factura de Luz de la Actividad
                    <br>5. Comprobante de pago de publicidad (PMPPPE) (según corresponda)
                    <br>6. Testimonio de Constitución o documento de creación (Personas Jurídicas) Documentos adicionales según corresponda a la actividad.

                    <br><br>REQUISITOS PARA TRAMITES DE ACTIVIDADES ECONOMICAS PARA BAJA DE LICENCIA DE FUNCIONAMIENTO
                    <br>1. Formulario FUTAE
                    <br>2. Licencia de Funcionamiento (en caso de perdida de la Licencia adjuntar los originales de 2
                    <br>3. publicaciones de dos días diferentes, marcando la publicación)
                    <br>4. Comprobante de pago de la patente (PMPAE)
                    <br>5. Comprobante de pago de publicidad (PMPPPE) (si corresponda con fotografía del retiro del letrero)
                    <br>6. Certificación de No Tenencia de Numero De Identificación Tributaria o NIT Inactive

                    <br><br>REQUISITOS PARA TRAMITES DE ACTIVIDADES ECONOMICAS PARA BAJA CON DEUDA DE ACTIVIDADES ECONÓMICAS
                    <br>1. Solicitud escrita del titular (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Licencia de Funcionamiento (en caso de perdida de la Licencia adjuntar los originales de 2
                    <br>3. publicaciones de dos días diferentes, marcando la publicación)
                    <br>4. Plano de ubicación o croquis de ubicación de la Actividad Económica.
                    <br>5. Formulario FUTAE.
                    <br>6. Proforma de liquidación.
                    <br>7. Certificación de No Tenencia de Numero De Identificación Tributaria o NIT Inactive
                    <br>8. Certificación o justificación del cierre de la actividad económica

                    <br><br>REQUISITOS PARA TRAMITES DE ACTIVIDADES ECONOMICAS PARA PRESCRIPCION DE ACTIVIDADES ECON6MICAS
                    <br>1. Solicitud escrita del titular (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Proforma de liquidación.


                    <br><br>REQUISITOS PARA TRAMITES DE ACTIVIDADES ECONOMICAS PARA DESBLOQUEO DE ACTIVIDADES ECONOMICAS
                    <br>1. Solicitud escrita del titular (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Proforma de liquidación.


                    <br><br>REQUISITOS PARA TRAMITES DE ACTIVIDADES ECONOMICAS PARA FACILIDADES DE PAGO DE ACTIVIDADES ECONÓMICAS
                    <br>1. Solicitud escrita del titular (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Plano de ubicación o croquis de ubicación de la Actividad Económica.
                    <br>3. Proforma de liquidación.


                    <br><br>REQUISITOS PARA TRAMITES DE ACTIVIDADES ECONOMICAS PARA REDUCCIÓN DE SANCIONES DE ACTIVIDADES ECONOMICAS
                    <br>1. Solicitud escrita del titular (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Proforma de liquidación.


                    <br><br>REQUISITOS PARA TRAMITES DE ACTIVIDADES ECONOMICAS PARA EXENCION DE ACTIVIDADES ECONOMICAS
                    <br>1. Solicitud escrita del titular (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Licencia de funcionamiento vigente
                    <br>3. Comprobante de pago (PMPAE)
                    <br>4. Resolución Administrativa (si corresponde)
                    <br>5. Proforma de liquidación
                    <br>6. Testimonio de constitución o documento de creación.
                    <br>7. NIT (Si corresponde)

                    <br><br>REQUISITOS PARA TRAMITES VARIOS GENERALES, PARA OTRAS CERTIFICACIONES
                    <br>1. Solicitud escrita del titular (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Documentación respaldatoria


                    <br><br>REQUISITOS PARA TRAMITES VARIOS GENERALES PARA CERTIFICACIONES E INFORMES POR ORDEN JUDICIAL O REQUERIMIENTO FISCAL
                    <br>1. Oficio Judicial o requerimiento fiscal (original)
                    <br>2. Comisión instruida cuando viene de otro distrito judicial (exhorto suplicatorio orden instruida)


                    <br><br>REQUISITOS PARA TRAMITES VARIOS GENERALES PARA LEVANTAMIENTO DE MEDIDAS COACTIVAS
                    <br>1. Comprobante de pago (si corresponde)
                    <br>2. Proforma con saldo cero (0)
                    <br>3. Resolución Administrativa de prescripción, baja, condonación, compensación, etc. (según corresponda)

                    <br><br>REQUISITOS PARA TRAMITES VARIOS GENERALES PARA LEGALIZACIONES:
                    <br>1. Solicitud escrita del titular (Dirigida al Director de Administración Tributaria Municipal).
                    <br>2. Fotocopia nítida del documento que se pretende legalizar 

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