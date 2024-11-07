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
    <title>DATM Ley 317</title>
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
    <li class="breadcrumb-item text-white active" aria-current="page">Ley 317</li>
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

                    <h1>LEY Nº 317</h1>

                    <h2>LEY DE 11 DE DICIEMBRE DE 2012</h2>

                    <br>EVO MORALES AYMA

                    <br>PRESIDENTE CONSTITUCIONAL DEL ESTADO PLURINACIONAL DE BOLIVIA

                    <br>Por cuanto, la Asamblea Legislativa Plurinacional, ha sancionado la siguiente Ley:<br>
                    LA ASAMBLEA LEGISLATIVA PLURINACIONAL,<br>
                    D E C R E T A:<br>
                    <input type="hidden" id="recurso_" value="l317">
                    <h1><span id="tituloPrincipal">LEY DEL PRESUPUESTO GENERAL DEL ESTADO - GESTIÓN 2013</span></h1>

                    <h3>CAPÍTULO PRIMERO DISPOSICIONES GENERALES</h3>
                    <br>
                    <h4>Artículo 1.</h4> (OBJETO). La presente Ley tiene por objeto aprobar el Presupuesto General del Estado - PGE del sector público para la Gestión Fiscal 2013, y otras disposiciones específicas para la administración de las finanzas públicas.<br>
                    <h4>Artículo 2.</h4> (PRESUPUESTO AGREGADO Y CONSOLIDADO). Se
                    aprueba el Presupuesto General del Estado, para su vigencia durante la Gestión Fiscal del 1 de enero al 31 de diciembre de 2013, por un importe total agregado de Bs.228.285.224.092.- (DOSCIENTOS VEINTIOCHO MIL DOSCIENTOS

                    OCHENTA Y CINCO MILLONES DOSCIENTOS VEINTICUATRO MIL NOVENTA Y DOS 00/100 BOLIVIANOS), y un consolidado de Bs.172.020.910.618.- (CIENTO SETENTA Y DOS MIL VEINTE MILLONES NOVECIENTOS DIEZ MIL
                    SEISCIENTOS DIECIOCHO 00/100 BOLIVIANOS), según detalle de recursos y gastos consignados en los Tomos I y II adjuntos.<br>
                    <h4>Artículo 3.</h4> (ÁMBITO DE APLICACIÓN). La presente Ley se aplica a todas las Instituciones del Sector Público que comprenden los Órganos del Estado Plurinacional, instituciones que ejercen funciones de Control, de Defensa de la Sociedad y del Estado, Gobiernos Autónomos Departamentales, Regionales, Municipales e Indígena Originario Campesinos, Universidades Públicas, Empresas Públicas, Instituciones Financieras Bancarias y no Bancarias, Instituciones Públicas de Seguridad Social y todas aquellas personas naturales y jurídicas que perciban, generen y/o administren recursos públicos.<br><br><br>
                    <h4>Artículo 4.</h4> (RESPONSABILIDAD). La Máxima Autoridad Ejecutiva - MAE de cada entidad pública, es responsable del uso, administración, destino, cumplimiento de objetivos, metas y resultados de los recursos públicos, a cuyo efecto deberá observar el cumplimiento de las disposiciones contenidas en la presente Ley y las establecidas en las normas legales vigentes.<br>
                    <h3>CAPÍTULO SEGUNDO DISPOSICIONES ESPECÍFICAS</h3>

                    <h4>Artículo 5.</h4> (RESULTADO FISCAL).<br>
                    I. En el marco del Artículo 298, Parágrafo II, Numeral 23 de la Constitución Política del Estado, los Ministerios de Economía y Finanzas Públicas, y de Planificación del Desarrollo, aprobarán mediante Resolución Ministerial, las modificaciones presupuestarias destinadas a gasto corriente o inversión pública, respectivamente, de las entidades públicas que afecten negativamente el resultado fiscal global del sector público; exceptuándose los saldos no ejecutados de donación externa.<br>
                    II. Se exceptúa de la aplicación del parágrafo precedente, a los Gobiernos Autónomos Municipales, Gobiernos Autónomos Departamentales y Universidades Públicas Autónomas, en aquellos traspasos presupuestarios intrainstitucionales que afecten negativamente el resultado fiscal.<br>
                    <h4>Artículo 6.</h4> (TRANSFERENCIAS PÚBLICO PRIVADAS). Se incorpora los Parágrafos VIII y IX en el Artículo 6 de la Ley Nº 211 de 23 de diciembre de 2011, con el siguiente texto:<br><br>"VIII. Las Entidades Territoriales Autónomas - ETAs, podrán realizar transferencias de recursos públicos conforme las competencias establecidas en la Constitución Política del Estado, a organizaciones privadas sin fines de lucro nacional, debiendo ser autorizada mediante norma expresa de la instancia correspondiente de cada ETA, aperturando en su presupuesto institucional programas y actividades que permitan identificar el sector económico, localización geográfica, organización beneficiaria y monto a transferir."<br><br>"IX. Las entidades públicas, como parte de sus objetivos estratégicos y/o atribuciones, podrán transferir recursos públicos en efectivo y/o en especie a personas naturales por concepto de premios, emergentes de concursos estudiantiles, académicos y científicos."<br>
                    <h4>Artículo 7.</h4> (TRANSFERENCIA DE RECURSOS DE LA CORPORACIÓN MINERA DE BOLIVIA AL MINISTERIO DE MINERÍA Y
                    METALURGIA). A efecto de coadyuvar a la gestión del sector minero, la Corporación Minera de Bolivia - COMIBOL, debe transferir anualmente Bs.4.000.000.- (CUATRO MILLONES 00/100 BOLIVIANOS) con cargo a sus recursos específicos, al Ministerio de Minería y Metalurgia, destinados a financiar gastos de funcionamiento.<br>
                    <h4>Artículo 8.</h4> (TRANSFERENCIA EXTRAORDINARIA DE RECURSOS A GOBIERNOS AUTÓNOMOS DEPARTAMENTALES). Para garantizar el
                    funcionamiento y/o inversiones de los Gobiernos Autónomos Departamentales en la gestión 2013, se autoriza al Órgano Ejecutivo, transferir recursos de manera

                    extraordinaria, a aquellos Gobiernos Autónomos Departamentales (ex prefecturas) cuyos ingresos aprobados en la gestión 2008, por concepto de Impuesto Especial a los Hidrocarburos y sus Derivados - IEHD y Fondo de Compensación Departamental - FCD, hayan representado más del 50% del total de sus ingresos por Regalías Mineras e Hidrocarburíferas, FCD, IEHD e IDH.<br>
                    <h4>Artículo 9.</h4> (PAGO DE REFRIGERIO SERVICIOS
                    DEPARTAMENTALES DE GESTIÓN SOCIAL). Se autoriza a los Gobiernos Autónomos Departamentales, asignar recursos para el pago de refrigerio a los servidores públicos de los Servicios Departamentales de Gestión Social, cuyos ítems son financiados con recursos del Tesoro General de la Nación, exceptuando los recursos provenientes del Impuesto Directo a los Hidrocarburos - IDH.<br>
                    <h4>Artículo 10.</h4> (ESCALAS SALARIALES DE ENTIDADES TERRITORIALES AUTÓNOMAS Y UNIVERSIDADES PÚBLICAS AUTÓNOMAS).<br>
                    I. Los Gobiernos Autónomos Departamentales, Regionales, Municipales, Indígena Originario Campesinas y Universidades Públicas Autónomas, deberán remitir al Ministerio de Economía y Finanzas Públicas, las escalas salariales aprobadas por la instancia correspondiente de cada entidad en un plazo de 15 días hábiles posterior a su aprobación, las cuales deben estar expresamente enmarcadas en los criterios y lineamientos de Política Salarial establecidos por el nivel central del Estado.<br>
                    II. Las Escalas Salariales de las Asambleas Departamentales y de los Concejos Municipales, deberán contar con la conformidad del Ejecutivo de la Entidad Territorial Autónoma.<br>
                    <h4>Artículo 11.</h4> (RECURSOS DE SALDOS DE CAJA Y BANCOS, Y RECURSOS ADICIONALES).<br>
                    I. Se autoriza al Ministerio de Economía y Finanzas Públicas, previa evaluación, registrar en el presupuesto institucional de las Entidades Territoriales Autónomas, los recursos de saldos de caja y bancos al 31 de diciembre de la gestión anterior, por concepto de Coparticipación Tributaria, Impuesto Directo

                    a los Hidrocarburos - IDH, Fondo de Compensación Departamental, Regalías y Recursos Específicos.<br>
                    II. Los recursos adicionales recibidos por las Entidades Territoriales Autónomas por concepto de Coparticipación Tributaria, Impuesto Directo a los Hidrocarburos - IDH, Fondo de Compensación Departamental y Regalías, que superen los recursos aprobados en el Presupuesto General del Estado de cada gestión fiscal, deben destinarse a contrapartes de proyectos concurrentes con el nivel central del Estado, así como a programas y proyectos de agua, riego, saneamiento básico y desarrollo productivo; asimismo, los Gobiernos Autónomos Departamentales también podrán asignar a caminos, electrificación y vivienda; considerando los siguientes porcentajes como mínimo:<br>
                    1. 50% los Gobiernos Autónomos Municipales - GAM tipo "A";<br>
                    2. 40% los GAM tipo "B";<br>
                    3. 30% los GAM tipo "C";<br>
                    4. 20% los GAM tipo "D"; y<br>

                    5. 20% los Gobiernos Autónomos Departamentales.<br>
                    <h4>Artículo 12.</h4> (INCORPORACIÓN DE LOS PRESUPUESTOS INSTITUCIONALES AL PGE DE LAS EMPRESAS DE LAS ENTIDADES
                    TERRITORIALES AUTÓNOMAS). Se autoriza al Órgano Ejecutivo a través del Ministerio de Economía y Finanzas Públicas, incorporar previa evaluación, en el Presupuesto General del Estado, los presupuestos institucionales de ingresos y gastos (incluye servicios personales y consultorías) de las Empresas de las Entidades Territoriales Autónomas.<br>
                    <h4>Artículo 13.</h4> (PRIORIZACIÓN EN LA ASIGNACIÓN DE RECURSOS).
                    Las entidades públicas deberán priorizar sus recursos en proyectos de inversión pública de continuidad y/o de contraparte, a objeto de garantizar la conclusión de los mismos y el cumplimiento de convenios.<br>
                    <h4>Artículo 14.</h4> (CONSULTORÍAS FINANCIADAS CON RECURSOS EXTERNOS Y CONTRAPARTE NACIONAL).<br>
                    I. Se autoriza al Ministerio de Economía y Finanzas Públicas, y al Viceministerio de Inversión Pública y Financiamiento Externo, dependiente del Ministerio de Planificación del Desarrollo, en el marco de sus competencias, inscribir y/o incrementar el gasto en las partidas 25200 "Estudios, Investigaciones, Auditorías Externas y Revalorizaciones", 25800 "Estudios e Investigaciones para Proyectos de Inversión No Capitalizables", y Subgrupo 46000 "Estudios y Proyectos para Inversión", cuyo financiamiento provenga de recursos de donación externa, crédito externo y/o contraparte nacional, según lo establecido en los convenios respectivos, los cuales no ameritarán la emisión de Decreto Supremo.<br>
                    II. Para las demás fuentes de financiamiento y los casos que no correspondan a contraparte nacional, deberá aprobarse mediante Decreto Supremo específico, que autorice el incremento de estas partidas de gasto. Se exceptúa a las Universidades Públicas Autónomas, Gobiernos Autónomos Departamentales y Municipales, los cuales deberán hacer aprobar por su máxima instancia resolutiva.<br>
                    III. Se autoriza al Viceministerio de Inversión Pública y Financiamiento Externo, dependiente del Ministerio de Planificación del Desarrollo, registrar modificaciones presupuestarias intrainstitucionales, cuyo financiamiento provenga de recursos específicos, en los presupuestos institucionales de las entidades del sector público, para incrementar las subpartidas 46110
                    "Consultorías por Producto para Construcciones de Bienes Públicos Dominio Privado", 46210 "Consultorías por Producto para Construcciones de Bienes Públicos de Dominio Público", y 46310 "Consultorías por Producto", de proyectos de inversión, las cuales no ameritarán la emisión de Decreto Supremo.<br>
                    <h4>Artículo 15.</h4> (INICIO DE PROCESO DE CONTRATACIÓN DE PROYECTOS DE INVERSION PÚBLICA).<br>
                    I. A partir de la promulgación de la presente Ley, y garantizados los recursos para la siguiente gestión fiscal, las entidades públicas bajo responsabilidad de su Máxima Autoridad Ejecutiva, podrán iniciar procesos de contratación de bienes, obras y servicios de proyectos de inversión, pudiendo llegar hasta la adjudicación, sin compromiso de gasto en tanto no haya iniciado la gestión fiscal señalada en el objeto de la Ley del PGE, para lo cual el Ministerio de Economía y Finanzas Públicas queda autorizado a emitir la certificación presupuestaria correspondiente.<br>
                    II. Iniciada la gestión fiscal correspondiente al objeto de la Ley del PGE, las entidades deberán continuar con sus procesos de contratación para inversión pública, contemplando los aspectos regulados por las Normas Básicas del Sistema de Administración de Bienes y Servicios.<br>
                    <h4>Artículo 16.</h4> (RECURSOS ASIGNADOS POR EL TESORO GENERAL
                    DE LA NACIÓN). Las asignaciones de recursos efectuadas por el Tesoro General de la Nación - TGN a entidades del sector público, para gasto corriente y/o proyectos de inversión, deberán ser ejecutadas exclusivamente para el fin autorizado, las cuales no podrán ser reasignadas a otro tipo de gasto, sin previa evaluación y aprobación del Ministerio de Economía y Finanzas Públicas; los saldos no ejecutados deben ser revertidos al TGN.<br><br>
                    <h4>Artículo 17.</h4> (OPERACIONES DE CRÉDITO PÚBLICO DE LAS EMPRESAS PÚBLICAS).<br>
                    I. Las Empresas Públicas podrán realizar operaciones de crédito público justificando técnicamente las mejores condiciones en términos de tasas, plazos y monto, así como demostrar la capacidad de generar ingresos futuros para asumir dicho endeudamiento.<br>
                    II. La contratación de deuda pública externa de las Empresas Públicas debe ser autorizada por Ley de la Asamblea Legislativa Plurinacional.<br>
                    III. La contratación de deuda pública interna de las Empresas Públicas debe ser autorizada mediante Decreto Supremo.<br>
                    IV. Con carácter previo a la contratación de cualquier endeudamiento interno y/o externo, las Empresas Públicas, deben cumplir al menos una de las siguientes condiciones:<br>
                    1. Contraer endeudamiento hasta una vez su patrimonio.<br>
                    2. Demostrar que su flujo de caja futuro es positivo.<br>
                    3. Demostrar que se generarán indicadores de liquidez y endeudamiento favorables.<br>
                    V. Se exceptúa del cumplimiento de los Artículos 33 y 35 de la Ley Nº 2042 de 21 de diciembre de 1999, a las Empresas Públicas, debiendo adecuarse a los criterios establecidos en el Parágrafo anterior.<br>
                    VI. La contratación del endeudamiento y el pago del servicio de la deuda son de responsabilidad de la Máxima Autoridad Ejecutiva y/o Directorio.<br>
                    VII. Las instancias señaladas en el Parágrafo I, deberán remitir información al Ministerio de Economía y Finanzas Públicas sobre el endeudamiento contraído.<br>
                    VIII. El Órgano Ejecutivo mediante el Ministerio de Economía y Finanzas Públicas, emitirá la reglamentación que requiera la operativa y aplicación de las operaciones de crédito público, por las Empresas Públicas.<br><br>
                    <h4>Artículo 18.</h4> (ENDEUDAMIENTO PÚBLICO MEDIANTE EMISIÓN DE TÍTULOS VALOR EN MERCADOS DE CAPITAL EXTERNOS).<br>
                    I. Se autoriza al Ministerio de Economía y Finanzas Públicas, en el marco de lo establecido en los Numerales 8 y 10 del Parágrafo I del Artículo 158 y el Artículo 322 de la Constitución Política del Estado, en representación del Estado Plurinacional de Bolivia, celebrar operaciones de deuda pública en los mercados de capital externos por un monto de hasta USD500.000.000.- (QUINIENTOS MILLONES 00/100 DÓLARES ESTADOUNIDENSES) o su
                    equivalente en otras monedas, para apoyo presupuestario.<br>
                    II. Los intereses a favor de acreedores de deuda pública mediante emisión de títulos valor en mercados de capital externos, conforme al presente Artículo, están exentos del Impuesto sobre las Utilidades de las Empresas.<br>
                    III. Se autoriza al Ministerio de Economía y Finanzas Públicas, la contratación directa en el ámbito nacional y/o internacional de servicios de asesoría legal y financiera, y de otros servicios especializados, vinculados a la operación de deuda pública en los mercados de capital externos, señalada en el Parágrafo I del presente Artículo, de acuerdo a prácticas internacionales.<br>
                    IV. El procedimiento para la contratación establecida en el Parágrafo anterior, será aprobado mediante Resolución Ministerial expresa del Ministerio de Economía y Finanzas Públicas.<br>
                    V. Los pagos por la prestación de servicios de asesoría legal y financiera y, de otros servicios especializados, vinculados a la operación de deuda pública en los mercados de capital externos, conforme al presente Artículo, están exentos del Impuesto sobre las Utilidades de las Empresas.<br>
                    <h4>Artículo 19.</h4> (DÉBITO AUTOMÁTICO).<br>
                    I. Se autoriza al Ministerio de Economía y Finanzas Públicas, realizar débitos automáticos a favor de las entidades públicas afectadas por la aplicación de factores de distribución o entidades beneficiarias y/o ejecutoras de programas y proyectos, cuando éstas lo soliciten, con el objeto de garantizar el cumplimiento de las obligaciones contraídas y competencias asignadas, así como por daños ocasionados al Patrimonio Estatal; conforme a normativa vigente.<br><br><br>
                    II. Se autoriza al Ministerio de Economía y Finanzas Públicas, debitar cuatrimestralmente de las cuentas fiscales de las entidades públicas, los recursos adicionales desembolsados para gastos específicos, con fuente y organismo (10-111) y (41-111) del Tesoro General de la Nación, los cuales no fueron comprometidos, ni devengados de acuerdo a programación establecida; debiéndose realizar las afectaciones presupuestarias que correspondan, para su consolidación en el presupuesto del Tesoro
                    General de la Nación y la transferencia al Programa "Bolivia Cambia". Esta disposición no aplica a contrataciones en proyectos de inversión que se encuentren publicados en el SICOES y a recursos de
                    contraparte nacional.<br><br><br>
                    III. Se autoriza al Ministro de Economía y Finanzas Públicas - MEFP, efectuar el débito automático a las entidades públicas que perciban ingresos que no son

                    de su competencia de acuerdo a normativa vigente. El débito se lo realizará previa justificación técnica y legal, y a solicitud de la entidad afectada, para
                    posterior evaluación del Ministro de Economía y Finanzas Públicas - MEFP.<br><br><br>
                    IV. Se autoriza al Ministerio de Economía y Finanzas Públicas, debitar cuatrimestralmente de las cuentas fiscales de las entidades públicas, los recursos no comprometidos, ni devengados con fuente y organismo (10 - 111) y (41 - 111) Tesoro General de la Nación.
                    Estos recursos serán reasignados presupuestaria y financieramente al Programa "Bolivia Cambia", autorizándose a las entidades beneficiarias del Programa, ejecutar los recursos mediante la
                    modalidad de contratación directa de bienes y servicios. Esta disposición no aplica a proyectos de inversión que se encuentren publicados en el SICOES y a recursos de contraparte nacional.<br><br><br>
                    V. Se autoriza al Ministerio de Economía y Finanzas Públicas, efectuar débitos automáticos a favor de los Gobiernos Autónomos Municipales afectados por la aplicación de nuevos factores de distribución, aprobados por el Ministerio de Autonomía, previa conciliación entre los municipios involucrados y a solicitud del municipio beneficiario, canalizado a través del referido Ministerio.<br><br><br>
                    VI. Se autoriza al Ministerio de Economía y Finanzas Públicas, efectuar débitos automáticos de las cuentas corrientes fiscales de la Caja Nacional de Salud a requerimiento de las entidades públicas empleadoras, cuando el ente gestor no haya efectuado los reembolsos por Subsidios de Incapacidad Temporal una vez vencido el plazo de 30 días a partir de la solicitud.
                    <h4>Artículo 20.</h4> (ADMINISTRACIÓN DE CARTERA DE CRÉDITOS

                    CEDIDA AL TESORO GENERAL DE LA NACIÓN).<br><br>
                    I. El Tesoro General de la Nación, representado por el Ministerio de Economía y Finanzas Públicas, como cesionario de las carteras de créditos del Banco Sur
                    S.A. "en liquidación", Banco de Cochabamba S.A. "en liquidación" y Banco Internacional de Desarrollo S.A. "en liquidación", encomendará su administración y cobranza de dichas carteras de créditos al Banco Central de Bolivia, estableciéndose mediante contrato los términos correspondientes, entre ellos la comisión respectiva.<br>
                    II. Los bienes muebles e inmuebles provenientes de la recuperación judicial o extrajudicial de créditos de las carteras señaladas en el Parágrafo anterior, deberán ser vendidos por el Banco Central de Bolivia, siguiendo los criterios establecidos en la disposición legal vigente que autoriza al Tesoro General de la Nación, a través del Ministerio de Economía y Finanzas Públicas y por intermedio del Servicio Nacional de Patrimonio del Estado, para la venta de los bienes muebles e inmuebles que le transfirieron los Banco Sur S.A. "en
                    liquidación", Banco de Cochabamba S.A. "en liquidación" y Banco Internacional de Desarrollo S.A. "en liquidación".<br><br>
                    <h4>Artículo 21.</h4> (AMPLIACIÓN DE VIGENCIA DEL PROCESO DE
                    CONCILIACIÓN PARA LA GESTIÓN 2013). Se autoriza al Ministerio de Economía y Finanzas Públicas, a través del Viceministerio del Tesoro y Crédito Público, continuar el proceso de conciliación iniciado en cumplimiento del Artículo 25 de la Ley Nº 211 de 23 de diciembre de 2011, por un periodo máximo de diez meses, con aquellas entidades que han reconocido la deuda registrada en el Tesoro General de la Nación. Para el efecto, será plenamente aplicable lo establecido en el Artículo 25 de la citada Ley, el Decreto Supremo Nº 1148 de 29 de febrero de 2012 y demás normas reglamentarias, en lo que corresponda.<br><br><br>
                    <h4>Artículo 22.</h4> (CRÉDITO INTERNO DEL BANCO CENTRAL DE BOLIVIA - BCB, A FAVOR DE LA EMPRESA NACIONAL DE ELECTRICIDAD - ENDE).<br><br><br>
                    I. Se amplía la vigencia del Artículo 8 de la Ley Nº 50, modificado por el Artículo 13 de la Ley Nº 62, respecto de los recursos del crédito autorizado a favor de la Empresa Nacional de Electricidad - ENDE, que no hubieran sido comprometidos.<br><br><br>
                    II. A este aspecto, se exceptúa a ENDE, de la aplicación de los Artículos 33 y 35 de la Ley Nº 2042 de Administración Presupuestaria, y se mantiene vigente la Disposición Adicional Sexta de la Ley Nº 111.<br><br><br>
                    III. Se autoriza al Ministerio de Economía y Finanzas Públicas, a través del Tesoro General de la Nación - TGN, emitir y otorgar Bonos del Tesoro No Negociables a favor del Banco Central de Bolivia - BCB, para garantizar el crédito mencionado en el Parágrafo I, a solicitud escrita del Ministerio cabeza de sector y en forma conjunta con el Banco Central de Bolivia - BCB.<br><br>
                    <h4>Artículo 23.</h4> (FONDO PARA LA DOTACIÓN DE INFRAESTRUCTURA).<br><br>
                    I. Los recursos generados por la venta de los bienes señalados en los parágrafos siguientes, deberán ser abonados en la Cuenta Única del Tesoro - CUT, a objeto de constituir un Fondo no reembolsable administrado por el Ministerio de Economía y Finanzas Públicas - MEFP, destinado a la dotación y mejora de la infraestructura para el Órgano Ejecutivo del nivel central del Estado, exceptuando a la Policía Boliviana y Fuerzas Armadas.<br><br><br>
                    II. Se autoriza al Tesoro General de la Nación - TGN, a través del Ministerio de Economía y Finanzas Públicas - MEFP, y por intermedio del Servicio Nacional de Patrimonio del Estado - SENAPE, vender los bienes inmuebles, muebles, muebles sujetos a registro, enseres, equipos y acciones que le fueron entregados producto del proceso de liquidación de los Bancos Sur S.A. Cochabamba S.A. y BIDESA S.A.<br><br>
                    III. Se autoriza al Intendente Liquidador de los Bancos Sur S.A., Cochabamba S.A. e Internacional de Desarrollo S.A., vender de acuerdo a reglamentación, los bienes muebles e inmuebles que aún no fueron transferidos al Tesoro General de la Nación - TGN.<br><br>
                    IV. El Órgano Ejecutivo del nivel central del Estado, deberá reglamentar el presente Artículo en un plazo no mayor a sesenta (60) días a partir de la promulgación de la presente Ley.<br><br>
                    <h4>Artículo 24.</h4> (FONDO LATINOAMERICANO DE RESERVAS - FLAR).<br><br><br>
                    I. En el marco del Acuerdo de la Asamblea del Fondo Latinoamericano de Reservas - FLAR, Nº 169 de 25 de septiembre de 2012, se autoriza al Banco Central de Bolivia - BCB, efectuar:<br><br><br>
                    1. El prepago del saldo adeudado del capital suscrito al 1 de abril de 2012, por un monto de USD36.437.899,45.- (TREINTA Y SEIS MILLONES CUATROCIENTOS TREINTA Y SIETE MIL OCHOCIENTOS NOVENTA Y NUEVE 45/100 DÓLARES ESTADOUNIDENSES) y el
                    prepago de reservas de capital del 10%, por un monto de USD3.643.789,94.- (TRES MILLONES SEISCIENTOS CUARENTA Y TRES MIL SETECIENTOS OCHENTA Y NUEVE 94/100 DÓLARES
                    ESTADOUNIDENSES), con cargo a sus propios recursos.<br><br><br>
                    2. La capitalización de las utilidades netas del FLAR a partir del ejercicio fiscal 2013, hasta pagar la totalidad del incremento de capital suscrito por USD93.750.000.- (NOVENTA Y TRES MILLONES SETECIENTOS CINCUENTA MIL 00/100 DÓLARES ESTADOUNIDENSES),
                    manteniendo las reservas institucionales en el diez por ciento (10%) del capital pagado, equivalente a USD9.375.000.- (NUEVE MILLONES TRESCIENTOS SETENTA Y CINCO MIL 00/100 DÓLARES ESTADOUNIDENSES).<br><br><br>
                    II. Para el cumplimiento del presente Artículo, se exceptúa al BCB de la aplicación del inciso d), Artículo 29, de la Ley Nº 1670 de 31 de octubre de 1995.<br>
                    <h4>Artículo 25.</h4> (REASIGNACIÓN DEL CRÉDITO INTERNO DEL BCB A FAVOR DE YACIMIENTOS PETROLIFEROS FISCALES BOLIVIANOS - YPFB).<br><br>
                    I. Se autoriza al Banco Central de Bolivia - BCB, reasignar el crédito extraordinario de hasta Bs.9.100.000.000.- (NUEVE MIL CIEN MILLONES 00/100
                    BOLIVIANOS) aprobado conforme al Artículo 17 de la Ley Nº 211 de 23 de diciembre de 2011, del Presupuesto General del Estado Gestión 2012, a favor de Yacimientos Petrolíferos Fiscales Bolivianos - YPFB, para las siguientes actividades de la cadena productiva de hidrocarburos:<br><br>
                    YPFB Refinación hasta Bs. 1.050.000.000.- Industrialización hasta Bs. 8.050.000.000.- TOTAL Bs. 9.100.000.000.-<br><br>
                    II. Se faculta al BCB, como efecto del Parágrafo anterior, en caso de ser necesario, adecuar los contratos suscritos con Yacimientos Petrolíferos Fiscales Bolivianos.<br>
                    <h4>Artículo 26.</h4> (FINANCIAMIENTO SISTEMA DE TRANSPORTE FÉRREO EN EL TRAMO MONTERO - BULO BULO).<br>
                    I. En el marco de los Artículos 158 y 322 de la Constitución Política del Estado, se autoriza al Ministerio de Economía y Finanzas Públicas, a través del Tesoro General de la Nación, contraer un crédito con el Banco Central de Bolivia en moneda nacional, por un monto de hasta Bs.1.044.000.000.- (UN MIL CUARENTA Y CUATRO MILLONES 00/100 BOLIVIANOS) para financiar
                    la construcción del Sistema de Transporte Férreo en el tramo Montero - Bulo Bulo.<br>
                    II. En el marco del Parágrafo I del presente Artículo, se autoriza al Banco Central de Bolivia otorgar al Ministerio de Economía y Finanzas Públicas, a través del Tesoro General de la Nación, un crédito extraordinario en condiciones concesionales, para lo cual se exceptúa al Banco Central de Bolivia de la aplicación de los Artículos 22 y 23 de la Ley del Banco Central de Bolivia Nº 1670 de 31 de octubre de 1995.<br><br>
                    III. Se autoriza al Ministerio de Economía y Finanzas Públicas, a través del Tesoro General de la Nación, la constitución de las garantías necesarias de respaldo que requiera el contrato de préstamo respectivo.<br><br>
                    IV. El Ministerio de Obras Públicas, Servicios y Vivienda, es responsable del uso, evaluación y seguimiento de los recursos del crédito a ser otorgado por el Banco Central de Bolivia, para financiar la construcción del Sistema de Transporte Férreo en el tramo Montero - Bulo Bulo.<br><br>
                    <h4>Artículo 27.</h4> (AUTORIZACIÓN DEL USO DE RECURSOS).<br><br><br>
                    I. Se autoriza de manera excepcional al Órgano Ejecutivo, a través del Ministerio de Economía y Finanzas Públicas, transferir recursos del Tesoro General de la Nación - TGN a la Asamblea Legislativa Plurinacional en la gestión 2013, correspondientes al importe de los saldos presupuestarios institucionales no ejecutados ni comprometidos de la partida 41100 "Edificios", al cierre de la gestión 2012, de la Vicepresidencia del Estado y la Asamblea Legislativa Plurinacional, para la Construcción del nuevo edificio de la Asamblea Legislativa Plurinacional.<br><br><br>
                    II. El registro presupuestario del proyecto de inversión, incluye Servicios Personales y Consultorías, los cuales deben ser inscritos a través del Viceministerio de Inversión Pública y Financiamiento Externo, dependiente del Ministerio de Planificación del Desarrollo.<br>
                    <h4>Artículo 28.</h4> (RECURSOS DE SEGURIDAD CIUDADANA).<br><br>
                    I. Los recursos asignados para el cumplimiento de los objetivos y metas de los planes de seguridad ciudadana, no podrán ser reasignados para otro propósito.<br><br><br>
                    II. A solicitud del Ministerio de Gobierno, se autoriza al Ministerio de Economía y Finanzas Públicas, previo cumplimiento de lo dispuesto en el Artículo 116 de la Ley Nº 031 de 19 de julio de 2010 "Marco de
                    Autonomías y Descentralización Andrés Ibáñez",
                    debitar semestralmente de las cuentas corrientes fiscales de las Entidades Territoriales Autónomas, los recursos no ejecutados de los programas y proyectos de los Planes de Desarrollo Departamental y Planes de Desarrollo Municipal, establecidos en el
                    marco de la Ley N° 264 de 31 de julio de 2012 del "Sistema Nacional de Seguridad Ciudadana para una Vida Segura", los cuales no fueron comprometidos, ni devengados de acuerdo a programación establecida.<br><br><br>
                    III. Los recursos debitados conforme al presente Artículo, deberán ser destinados única y exclusivamente a la ejecución de programas y proyectos de seguridad ciudadana de la jurisdicción de las Entidades Territoriales Autónomas afectadas.<br><br><br>
                    IV. Para efectos del parágrafo precedente, el Ministerio de Gobierno solicitará al Ministerio de Economía y Finanzas Públicas la apertura de una libreta en la Cuenta Única del Tesoro - CUT.<br><br><br>
                    <h4>Artículo 29.</h4> (EXCEPCIÓN A LA EMPRESA NACIONAL DE
                    ELECTRICIDAD - ENDE). Se exceptúa a la Empresa Nacional de Electricidad - ENDE, en su condición de Empresa Pública Nacional Estratégica - ENDE, de la aplicación de los Artículos 33 y 35 de la Ley Nº 2042 de 21 de diciembre de 1999, de

                    Administración Presupuestaria, para la transferencia de recursos provenientes del Contrato de Préstamo 2460/BL-BO, suscrito entre el Estado Plurinacional de Bolivia y el Banco Interamericano de Desarrollo - BID, aprobado mediante Ley Nº 116 de 7 de mayo de 2011, destinado a financiar el Proyecto "Extinción de Redes de Transmisión - Línea de Transmisión Yucumo - San Buenaventura", del Componente 2 del Programa de Electrificación Rural.<br>
                    DISPOSICIONES ADICIONALES
                    <br><br>
                    PRIMERA. Se modifica el Parágrafo III, y se adiciona el Parágrafo IV en el Artículo 28 de la Ley Nº 065 de Pensiones, de 10 de diciembre de 2010, de acuerdo al siguiente texto:<br><br><br><br>"III. Durante cinco (5) años a partir de la gestión 2012, la Compensación de Cotizaciones Mensual - CCM en curso de pago será actualizada anualmente en base a los siguientes criterios:<br><br><br>
                    1. Se determinará la masa de pagos de la Compensación de Cotizaciones Mensual financiada con recursos del Tesoro General de la Nación, utilizando la planilla de pagos de CCM del mes de diciembre de la gestión anterior a la que corresponde el ajuste.
                    2. El monto a distribuir en el ajuste anual resultara de aplicar, a la masa de pagos de CCM determinada en el punto anterior, la variación anual de la Unidad de Fomento a la Vivienda, observada entre el 31 de diciembre del año en cuestión, respecto al del año anterior, índice publicado por el Banco Central de Bolivia.
                    3. Un 50% del monto anterior será distribuido de forma percápita y el otro 50% de manera inversamente proporcional para cada uno de los asegurados con pago de CCM."<br><br><br><br>"IV. Independientemente del periodo o año en que se hubiera realizado la suspensión de la CCM, la CCM se rehabilitará con los ajustes que le hubiese correspondido en las gestiones que estuvo suspendida."<br><br><br>
                    SEGUNDA. A los fines de lo dispuesto en el inciso c) del Artículo 8 de la Ley N° 154, están fuera del dominio tributario municipal las transferencias onerosas de

                    bienes inmuebles y vehículos automotores realizadas por empresas sean unipersonales, públicas, mixtas o privadas u otras sociedades comerciales, cualquiera sea su giro de negocio.<br><br><br>
                    TERCERA. En la compra de Gasolina Especial, Gasolina Premium o Diesel Oil a las Estaciones de Servicio, las personas naturales o jurídicas, computarán como crédito fiscal para la liquidación del Impuesto al Valor Agregado - IVA, sólo el 70% sobre el crédito fiscal del valor de la compra.<br><br><br>
                    CUARTA. Se modifica el Parágrafo I del Artículo 163 de la Ley N° 2492 de 2 de agosto de 2003, con el siguiente texto:<br><br><br><br>"I. El que omitiera su inscripción en los registros tributarios correspondientes, se inscribiera o permaneciera en un régimen tributario distinto al que le corresponda y de cuyo resultado se produjera beneficios o dispensas indebidas en perjuicio de la Administración Tributaria, será sancionado con la clausura del establecimiento hasta que regularice su inscripción. Sin perjuicio del derecho de la administración tributaria a inscribir de oficio, recategorizar, fiscalizar y determinar la deuda tributaria dentro el término de prescripción."<br><br><br>
                    QUINTA. Se modifica el primer párrafo del Artículo 170 de la Ley N° 2492 de 2 de agosto de 2003, Código Tributario Boliviano, con el siguiente texto:<br><br><br><br>"La Administración Tributaria podrá de oficio verificar el correcto cumplimiento de la obligación de emisión de factura, nota fiscal o documento equivalente mediante operativos de control. Cuando advierta la comisión de esta contravención tributaria, los funcionarios de la Administración Tributaria actuante deberán elaborar un acta donde se identifique la misma, se especifiquen los datos del sujeto pasivo o tercero responsable, los funcionarios actuantes y un testigo de actuación, quienes deberán firmar el acta, caso contrario se dejará expresa constancia de la negativa a esta actuación. Concluida la misma, procederá la clausura inmediata del negocio de acuerdo a las sanciones establecidas en el Parágrafo II del Artículo 164 de este Código. En caso

                    de reincidencia, después de la máxima aplicada, se procederá a la clausura definitiva del local intervenido."<br><br><br>
                    SEXTA. Se incorpora el Artículo 177° ter a la Ley N° 2492 de 2 de agosto de 2003, con el siguiente texto:<br><br><br>"Artículo 177° ter (EMISIÓN DE FACTURAS, NOTAS FISCALES Y DOCUMENTOS EQUIVALENTES SIN HECHO GENERADOR). El que de
                    manera directa o indirecta, comercialice, coadyuve o adquiera facturas, notas fiscales o documentos equivalentes sin haberse realizado el hecho generador gravado, será sancionado con pena privativa de libertad de dos (2) a seis (6) años."<br><br><br>
                    SÉPTIMA. Se incorpora el Artículo 177° Quáter a la Ley N° 2492 de 2 de agosto de 2003, con el siguiente texto:<br><br><br>"Artículo 177º Quáter (ALTERACIÓN DE FACTURAS, NOTAS FISCALES Y DOCUMENTOS EQUIVALENTES). El que insertare o
                    hiciere insertar en una factura, nota fiscal o documento equivalente verdadero, declaraciones falsas concernientes al hecho generador que el documento deba probar, será sancionado con privación de libertad de dos (2) a seis (6) años.
                    La sanción será agravada en un tercio en caso de reincidencia."<br><br><br>
                    OCTAVA. Se incluye un tercer párrafo al Artículo 124 de la Ley N° 1990 de 28 de julio de 1999, Ley General de Aduanas:<br><br><br><br>"Las mercancías cuyo consignatario sea una entidad del sector público o una empresa donde el Estado tenga participación mayoritaria, podrán ser objeto de Admisión Temporal para Reexportación en el Mismo Estado, con la presentación de la Declaración de Mercancías, y la constitución de una boleta de garantía bancaria, seguro de fianza o garantía prendaria consistente en la misma mercancía que cubra ante la Aduana Nacional los tributos aduaneros de importación suspendidos."<br><br>
                    NOVENA. Se modifica el primer párrafo del Artículo 47 de la Ley N° 1990 de 28 de julio de 1999, Ley General de Aduanas, con el siguiente texto:<br><br><br><br>"Los despachos aduaneros de importación podrán ser tramitados ante las administraciones aduaneras debidamente autorizadas al efecto, directamente por los importadores o por intermedio de los Despachantes de Aduana formalmente habilitados, en las modalidades y condiciones que se establezcan en el Reglamento."<br><br>
                    DÉCIMA. Se modifica el último párrafo del Artículo 74 de la Ley N° 1990 de 28 de julio de 1999, Ley General de Aduanas, con el siguiente texto:<br><br><br><br>"Los importadores que realicen sus despachos de manera directa, sin la intervención de un Despachante de Aduana o Agencia Despachante de Aduana podrán efectuar todos los trámites y formalidades aduaneras, siendo responsables de la correcta declaración de cantidad, calidad y valor de las mercancías objeto de importación. Asimismo, son responsables de la liquidación de tributos aduaneros, la conservación de la documentación de los despachos aduaneros, así como del cumplimiento de otras obligaciones establecidas en la presente Ley. La Aduana Nacional, comprobará la correcta declaración del importador."<br><br>
                    DÉCIMA PRIMERA. Se modifica el Artículo 7 de la Ley N° 060, de 25 de noviembre de 2010, de Juegos de Lotería y de Azar, por el siguiente texto:<br><br> "<h4>Artículo 7.</h4> (PROMOCIONES EMPRESARIALES). Las promociones empresariales son aquellas actividades destinadas a obtener un incremento en las ventas de bienes y servicios, captar clientes, mantener o incentivar a los ya existentes, a cambio de premios en dinero, bienes o servicios, otorgados mediante sorteos, azar o cualquier otro medio de acceso al premio, siempre que el mismo no implique un pago por derecho de participación.<br><br><br>
                    Constituyen también promociones empresariales aquellas actividades donde

                    las ventas incluyen premios de disponibilidad limitada."<br><br>
                    DÉCIMA SEGUNDA. Se modifican los Parágrafos I y II del Artículo 60 de la Ley Nº 2492 de 2 de agosto de 2003, Código Tributario Boliviano, modificados por la Disposición Adicional Sexta de la Ley N° 291 de 22 de septiembre de 2012, por el siguiente texto:<br><br>"<h4>Artículo 60.</h4> (CÓMPUTO).<br><br>
                    I. Excepto en el Numeral 3 del Parágrafo I del Artículo anterior, el término de la prescripción se computará desde el primer día del año siguiente a aquel en que se produjo el vencimiento del período de pago respectivo.<br>
                    II. En el supuesto 3 del Parágrafo I del Artículo anterior, el término se computará desde el primer día del año siguiente a aquel en que se cometió la contravención tributaria."<br><br><br>
                    DÉCIMA TERCERA. Se modifica el Parágrafo II del Artículo 96 de la Ley N° 2492, de 2 de agosto de 2003, Código Tributario Boliviano, con el siguiente texto:<br><br><br><br>"II. En Contrabando, el Acta de Intervención que fundamente la Resolución Sancionatoria o Determinativa, contendrá la relación circunstanciada de los hechos, actos, mercancías, elementos, valoración y liquidación, emergentes del operativo aduanero correspondiente, el cual deberá ser elaborado en un plazo no mayor a diez (10) días hábiles siguientes al inicio de la intervención."<br><br><br>
                    DÉCIMA CUARTA. Se modifica el Artículo 111° de la Ley N° 2492, de 2 de agosto de 2003, Código Tributario Boliviano, con el siguiente texto:<br><br><br><br>"Artículo 111° (DENUNCIA Y DISTRIBUCIÓN). En contravenciones y delitos flagrantes de contrabando de importación y exportación, las mercancías decomisadas aptas para el consumo y no sujetas a prohibición específica para su importación, serán entregadas con posterioridad al Acta de

                    Intervención, a título gratuito, exentas del pago de tributos, sin pago por servicio de almacenaje y de otros gastos emergentes, de la siguiente forma:<br><br>
                    1. Veinte por ciento (20%) para el denunciante individual, o cuarenta por ciento (40%) a la comunidad o pueblo denunciante.<br><br>
                    2. Diez por ciento (10%) para el municipio donde se descubra la comisión del ilícito, para su distribución a título gratuito, a través de programas de apoyo social.<br><br>
                    3. En caso de productos alimenticios, setenta por ciento (70%) para la entidad pública encargada de su comercialización, que puede rebajar al cincuenta por ciento (50%) en caso de que el denunciante sea la comunidad o pueblo.<br>
                    En caso de que dichas mercancías requieran certificados sanitarios, fitosanitarios, de inocuidad alimentaria u otras certificaciones para el despacho aduanero, la Administración Tributaria Aduanera previa a la entrega, solicitará la certificación oficial del órgano competente, la cual deberá ser emitida en un plazo no mayor a tres (3) días hábiles administrativos a partir de su requerimiento, sin costo, bajo responsabilidad del Ministerio cabeza de sector.<br><br><br>
                    Tratándose de mercancías que por su naturaleza requieran autorizaciones previas, éstas serán entregadas por la Aduana Nacional a la entidad o Autoridad competente, a título gratuito, exentas del pago de tributos, sin pago por servicio de almacenaje y de otros gastos emergentes, en el plazo máximo de tres (3) días hábiles administrativos de elaborada el Acta de Intervención. En este caso, la Aduana Nacional entregará al denunciante y al municipio donde se descubra la comisión del ilícito, notas de crédito fiscal - NOCRES en un plazo máximo de tres (3) días hábiles administrativos a partir de su emisión, por los conceptos definidos en los numerales 1 y 2, previa gestión de dichos valores ante el Ministerio de Economía y Finanzas Públicas.<br>
                    El inicio para la obtención de NOCRES por parte de la Aduana Nacional, no deberá exceder los tres días hábiles administrativos posteriores a la entrega de esta mercancía, bajo responsabilidad funcionaria."<br><br>
                    DÉCIMA QUINTA. Se modifica el Artículo 192° de la Ley N° 2492, de 2 de agosto de 2003, Código Tributario Boliviano, con el siguiente texto:<br><br><br><br>"Artículo 192° (ADMINISTRACIÓN DE BIENES).<br><br><br>
                    I. Las mercancías decomisadas por ilícito de contrabando que cuenten con Sentencia Ejecutoriada o Resolución Firme, serán adjudicadas por la Aduana Nacional al Ministerio de la Presidencia, en forma gratuita y exentas del pago de tributos aduaneros de importación, al día siguiente de haber adquirido la calidad de título de ejecución tributaria.<br><br><br>
                    II. En caso de mercancías perecederas o alimentos, el Acta de Intervención deberá ser elaborada en un plazo no mayor a tres (3) días posteriores a la intervención. La Resolución Sancionatoria o Determinativa deberá ser emitida en un plazo no mayor a tres (3) días después de formulada dicha Acta de Intervención. En caso que éstas mercancías requieran certificados sanitarios, fitosanitarios, de inocuidad alimentaria u otras certificaciones para el despacho aduanero, la Administración Tributaria Aduanera, al día siguiente hábil de emitida la Resolución Sancionatoria o Determinativa, solicitará la certificación oficial del órgano competente, la cual deberá ser emitida en un plazo no mayor a tres (3) días a partir de su requerimiento, bajo responsabilidad del Ministerio cabeza de sector. Estas mercancías serán adjudicadas por la Aduana Nacional al Ministerio de la Presidencia, a título gratuito y exentas del pago de tributos aduaneros de importación, al día siguiente de la recepción de los certificados, bajo responsabilidad funcionaria.<br><br><br><br>
                    En caso de medicamentos, la Aduana Nacional adjudicará estas mercancías al Ministerio de Salud y Deportes, a título gratuito y exentas del pago de tributos aduaneros de importación, al día siguiente de la notificación de la Resolución Sancionatoria o Determinativa, bajo

                    responsabilidad funcionaria."<br><br>
                    DÉCIMA SEXTA. Se modifica el monto de los numerales I, III, IV del Artículo 181 de la Ley Nº 2492 de 2 de agosto de 2003, Código Tributario Boliviano: De UFVs 50.000.- (CINCUENTA MIL 00/100 UNIDADES DE FOMENTO A LA VIVIENDA) a UFVs 200.000.- (DOSCIENTOS MIL 00/100 UNIDADES DE FOMENTO A LA VIVIENDA).<br><br><br>
                    DÉCIMA SÉPTIMA. Se modifica el Artículo 152 de la Ley Nº 1990 de 28 de julio de 1999, Ley General de Aduanas, con el siguiente texto:<br><br><br><br>"Abandono expreso o voluntario es el acto mediante el cual aquel que tiene el derecho de disposición sobre la mercancía, renuncia al mismo a favor del Estado, ya sea en forma total o parcial, expresando esta voluntad por escrito a la administración aduanera.<br><br><br>
                    La administración aduanera rechazará el abandono siempre y cuando las mercancías no se encuentren en depósitos aduaneros, almacenes fiscales o privados, o no se coloquen en ellos a costa del interesado, y que por su naturaleza y estado de conservación no puedan ser dispuestas o estén afectadas por algún gravamen o situación jurídica que pueda impedir su inmediata disposición.<br><br><br>
                    Las mercancías que no hayan sido rechazadas, serán adjudicadas por la Aduana Nacional al Ministerio de la Presidencia, a título gratuito y exentas del pago de tributos aduaneros de importación, multas y otros gastos emergentes, al día siguiente hábil de la fecha de emisión de la Resolución que acepte el abandono, bajo responsabilidad funcionaria.<br><br><br>
                    La Resolución de Aceptación o Rechazo será emitida en el plazo de dos
                    (2) días hábiles administrativos siguientes a la formalización de abandono."<br>
                    DÉCIMA OCTAVA. Se modifica el Artículo 154 de la Ley Nº 1990 de 28 de julio de 1999, Ley General de Aduanas, con el siguiente texto:<br><br>"La Resolución que declare el abandono de hecho o tácito de las mercancías, será emitida al día siguiente de haberse configurado alguna de las causales establecidas en el Artículo 153 de la presente Ley y notificada en secretaría de la administración aduanera dentro de las 24 horas de su emisión.<br><br><br>
                    En el abandono de mercancías no procede el levante de las mismas."<br><br><br>
                    DÉCIMA NOVENA. Se modifica el Artículo 155 de la Ley Nº 1990 de 28 de julio de 1999, Ley General de Aduanas, con el siguiente texto:<br><br><br><br>"Las mercancías abandonadas de hecho serán adjudicadas por la Aduana Nacional al Ministerio de la Presidencia, a título gratuito y exentas del pago de tributos aduaneros de importación, al día siguiente hábil de la ejecutoria o firmeza de la Resolución que declare el abandono, bajo responsabilidad funcionaria.<br><br><br>
                    En el caso de medicamentos la Aduana Nacional adjudicará estas mercancías al Ministerio de Salud y Deportes, a título gratuito y exentas del pago de tributos aduaneros de importación, al día siguiente hábil de la ejecutoria o firmeza de la Resolución que declare el abandono, bajo responsabilidad funcionaria."<br><br><br>
                    VIGÉSIMA. Se modifican los Parágrafos II y III del Artículo 156 de la Ley Nº 1990 de 28 de julio de 1999, Ley General de Aduanas, con el siguiente texto:<br><br><br><br>"II. En caso de que dichas mercancías sean declaradas en abandono, la Aduana Nacional adjudicará las mismas al Ministerio de la Presidencia, a título gratuito y exentas del pago de tributos aduaneros de importación, multas y otros gastos emergentes, al día siguiente hábil de

                    la ejecutoria de la Resolución que declara el abandono, bajo responsabilidad funcionaria.<br><br><br>
                    III. Si las mercancías no fueran aptas para la adjudicación, éstas deberán ser destruidas por la administración aduanera en coordinación con las instancias competentes, en un plazo no superior a cuarenta y cinco (45) días corridos posteriores a la emisión de la Resolución respectiva."<br><br><br>
                    VIGÉSIMA PRIMERA. Se modifica la Ley Nº 232 de 9 de abril de 2012, de acuerdo a lo siguiente:<br><br><br>
                    I. El Parágrafo I del Artículo 6 se modifica de conformidad con el siguiente texto:<br><br>"<h4>Artículo 6.</h4> (RECURSOS).<br><br><br>
                    I. El fideicomiso de FINPRO se constituirá con la transferencia no reembolsable de Seiscientos Millones 00/100 de Dólares Estadounidenses ($us600.000.000.-) provenientes de las Reservas Internacionales que efectúe el BCB en el marco de lo señalado en el Artículo 2 de la presente Ley. El registro de la transferencia deberá efectuarse afectando cuentas del patrimonio neto."<br><br><br>
                    II. El Artículo 9 se modifica de conformidad con el siguiente texto:<br><br><br>"<h4>Artículo 9.</h4> (EXENCIONES TRIBUTARIAS). La constitución y administración, incluida la contratación de la operación de préstamo del Banco Central de Bolivia a FINPRO, así como, la terminación y liquidación del fideicomiso de FINPRO estarán exentas de cualquier tributo, así como, de los gastos de protocolización y otros que se requiera para su formalización."<br><br><br>
                    DISPOSICIONES TRANSITORIAS

                    PRIMERA. Previa a la aprobación de los Estatutos Autonómicos del Departamento de Tarija, la Escala Salarial del Fondo Rotatorio de Fomento Productivo Regional - FRFPR, será aprobada por su Directorio, la cual deberá estar enmarcada en los criterios y lineamientos de Política Salarial establecidos por el nivel central del Estado, debiendo remitir al Ministerio de Economía y Finanzas Públicas - MEFP, en un plazo de 15 días hábiles posterior a su emisión.<br><br>
                    SEGUNDA. Las mercancías declaradas en abandono, mediante Resolución notificada y no impugnada en los plazos establecidos por Ley, serán adjudicadas por la Aduana Nacional al Ministerio de la Presidencia o al Ministerio de Salud y Deportes, según corresponda, a título gratuito y exento del pago de tributos aduaneros de importación, en un plazo no mayor a cinco (5) días hábiles administrativos siguientes a la fecha de publicación de la presente Ley, bajo responsabilidad funcionaria.<br><br><br>
                    TERCERA. Las mercancías que tengan Resolución de Adjudicación proveniente del proceso de remate, deberán culminar su proceso conforme al procedimiento anterior.<br><br><br>
                    CUARTA. Las mercancías decomisadas por ilícito de contrabando que cuenten con sentencia ejecutoriada o resolución firme, que a la fecha de publicación de la presente Ley se encuentren en depósitos aduaneros, serán adjudicadas por la Aduana Nacional al Ministerio de la Presidencia o al Ministerio de Salud y Deportes, según corresponda, a título gratuito y exento del pago de tributos aduaneros de importación, en un plazo no mayor a cinco (5) días hábiles administrativos siguientes a la fecha de publicación de la presente Ley, bajo responsabilidad funcionaria.<br><br><br>
                    DISPOSICIONES FINALES
                    <br>
                    PRIMERA. Las disposiciones contenidas en la presente Ley, se adecúan de manera automática, en cuanto sean aplicables, a la nueva estructura organizacional y definición de entidades del sector público, emergente de la Constitución Política del Estado y las demás disposiciones legales.<br><br>
                    SEGUNDA. Quedan vigentes para su aplicación:<br><br>
                    a) Artículos 6, 7, 8, 13, 14, 15, 16, 17, 20, 22, 23, 24, 25, 28, 33, 37, 42,
                    43, 46, 47, 50, 53, 56, 62 y 63 de la Ley del Presupuesto General
                    del Estado 2010. a. Artículos 5, 6, 11 y 13 de la Ley Nº 050 de 9 de octubre de 2010.<br>
                    c) Artículos 5, 6, 8, 9, 10, 11, 16, 18, 19, 22, 25, 26, 27, 33, 34, 35, 37 y
                    40 de la Ley Nº 062 de 28 de noviembre de 2010.<br>
                    d. Disposiciones Adicionales Primera, Quinta y Sexta de la Ley Nº 111 de 7 de mayo de 2011.<br>
                    e) Artículos 5 y 13 de la Ley Nº 169 de 9 de septiembre de 2011<br>
                    f) Artículo 10 de la Ley Nº 3302 de 16 de diciembre de 2005.<br>
                    g) Artículos 4, 5, 6, 7, 8, 10, 11, 13, 15, 17, 18, 19, 23, 24, 25, 29, 30 y
                    33; Disposición Adicional Segunda; Disposición Transitoria Primera; Disposiciones Finales Primera y Sexta de la Ley Nº 211 de 23 de diciembre de 2011.<br>
                    h) Artículo 4, Disposiciones Adicionales Primera y Segunda de la Ley Nº 233 de 13 de abril de 2012.<br>
                    i. Artículos 6, 7, 10, 11, 12, Disposiciones Adicionales Primera, Segunda, Cuarta y Décima Tercera de la Ley Nº 291 de 22 de septiembre de 2012.<br><br>
                    TERCERA. Las mercancías adjudicadas al Ministerio de la Presidencia y al Ministerio de Salud y Deportes, no estarán sujetas al pago de los gastos concernientes al servicio de almacenaje.<br><br>
                    CUARTA. La obtención de certificaciones de las mercancías adjudicadas al Ministerio de la Presidencia y al Ministerio de Salud y Deportes, estarán a cargo de dichas entidades.<br>
                    QUINTA. El Ministerio de la Presidencia y el Ministerio de Salud y Deportes, deberán retirar las mercancías adjudicadas, en un plazo no mayor a quince (15) días hábiles administrativos posteriores a la notificación de la Resolución de adjudicación, computables a partir del siguiente día hábil de dicha notificación.<br><br><br>
                    SEXTA. Las mercancías adjudicadas al Ministerio de la Presidencia y al Ministerio de Salud y Deportes, podrán ser transferidas a título gratuito, a instituciones del sector público, organizaciones sin fines de lucro o distribuida gratuitamente a la población. Las mercancías transferidas a entidades públicas deberán ser registradas por parte de la entidad beneficiaria, en sus activos fijos, según corresponda.<br><br><br>
                    SÉPTIMA. La Aduana Nacional no podrá adjudicar a ninguna institución pública o privada, animales vivos o plantas, frutos, semillas afectadas por enfermedades; productos alimenticios, bebidas, líquidos alcohólicos, en estado de descomposición, adulterados o que contengan sustancias nocivas a la salud; materiales tóxicos, radiactivos, desechos mineralógicos contaminantes, ropa usada, cigarrillos o tabacos; y otras mercancías abandonadas o comisadas, en razón de su naturaleza peligrosa o nociva. Estas mercancías deberán ser destruidas por la administración aduanera en coordinación con las instancias competentes, en un plazo no superior a cuarenta y cinco (45) días corridos posteriores a la emisión de la Resolución respectiva.<br><br><br>
                    OCTAVA. El Órgano Ejecutivo, mediante Decreto Supremo reglamentará la presente Ley.<br><br><br>
                    DISPOSICIONES DEROGATORIAS Y ABROGATORIAS
                    <br>
                    PRIMERA. Se deroga el último párrafo del Parágrafo I del Artículo 59 de la Ley Nº 2492, de 2 de agosto de 2003, Código Tributario Boliviano, modificado por la Disposición Adicional Quinta de la Ley N° 291, de 22 de septiembre de 2012.<br><br>
                    SEGUNDA. Se deroga el Artículo 192 bis de la Ley N° 2492 de 2 de agosto de 2003, Código Tributario Boliviano, incorporado por el Artículo 5 de la Ley N° 037

                    de 10 de agosto de 2010, y modificado por la Disposición Adicional Tercera de la Ley N° 211 de 23 de diciembre de 2011.<br><br><br>
                    TERCERA. Se deroga el Artículo 189 de la Ley N° 2492 de 2 de agosto de 2003, Código Tributario Boliviano.<br><br><br>
                    CUARTA.<br><br><br>
                    I. Se derogan y abrogan todas las disposiciones de igual o inferior jerarquía, contrarias a la presente Ley.<br><br><br>
                    II. Quedan sin efecto todas las disposiciones contrarias a la presente Ley.<br><br><br>
                    Remítase al Órgano Ejecutivo para fines constitucionales.<br><br><br>
                    Es dada en la Sala de Sesiones de la Asamblea Legislativa Plurinacional, a los seis días del mes de diciembre del año dos mil doce.<br>
                    Fdo. Lilly Gabriela Montaño Viaña, Rebeca Elvira Delgado Burgoa, Mary Medina Zabaleta, David Sánchez Heredia, Wilson Changaray T., Angel David Cortéz Villegas.<br>
                    Por tanto, la promulgo para que se tenga y cumpla como Ley del Estado Plurinacional de Bolivia.<br>
                    Palacio de Gobierno de la ciudad de La Paz, a los once días del mes de diciembre del año dos mil doce.<br><br>
                    FDO. EVO MORALES AYMA, David Choquehuanca Céspedes, Juan Ramón Quintana Taborga MINISTRO DE LA PRESIDENCIA E INTERINO DE PLANIFICACION DEL DESARROLLO, Carlos Gustavo Romero Bonifaz MINISTRO DE GOBIERNO E INTERINO DE TRANSPARENCIA INST. Y LUCHA CONTRA LA CORRUPCIÓN, Rubén Aldo Saavedra Soto, Luis Alberto Arce Catacora, Juan José Hernando Sosa Soruco, Ana Teresa Morales Olivera, Arturo Vladimir Sánchez Escobar, Mario Virreira Iporre, Cecilia Luisa Ayllon Quinteros, Daniel Santalla Torrez, Juan Carlos Calvimontes Camargo, José Antonio Zamora Gutiérrez, Roberto Iván Aguilar Gómez, Nemesia Achacollo Tola, Claudia Stacy Peña Claros, Pablo Cesar Groux Canedo, Amanda Dávila Torres.
                    TEXTO DE CONSULTA
                    Gaceta Oficial del Estado Plurinacional de Bolivia
                    Derechos Reservados (c) 2014
                    www.gacetaoficialdebolivia.gob.bo

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