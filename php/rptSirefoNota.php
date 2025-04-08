<?php
require '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

require_once("conexionpsql.php");

foreach ($_GET as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$conn = new Conexion();
$cons = $conn->conectar();

$query = "select  TRIM(
    CONCAT_WS(' ', 
        NULLIF(CONCAT(nombre, ' ', COALESCE(apellido_paterno, ''), ' ', COALESCE(apellido_materno, '')), '  '), 
        razon_social
    )
) AS nombre_completo,
f.cod_documento_identidad_tipo,
CONCAT(documento_identidad_numero, ' ', COALESCE(documento_identidad_complemento, ''), ' ', COALESCE(b.documento_identidad_extension, '')) documento, 
auto_conclusion, 
tipo_respaldo, 
documento_respaldo, 
monto_retencion_bs, 
monto_retencion_ufv , 
a.tipo_persona,
tipo_proceso,
a.id_cabecera_solicitud, a.id_item_solicitud, d.codigo_solicitud, 
to_char(d.fecha_envio, 'YYYY-MM-DD HH24:MI:SS') AS fecha_envio,
e.circular, 
to_char(e.fecha_circular, 'YYYY-MM-DD HH24:MI:SS') AS fecha_circular , documento_tributario, hash_datos, tipo_documento_tributario,
gestion_fiscal, resolucion_determinativa, cite_anotacion_preventiva
from srf_cabecera_solicitud d 
left join srf_item_solicitud a  on d.id_cabecera_solicitud = a.id_cabecera_solicitud
left join srf_documento_identidad_extension b on b.id_documento_identidad_extension = a.id_documento_identidad_extension
left join srf_documento_identidad_tipo f on f.id_documento_identidad_tipo = a.id_documento_identidad_tipo
left join srf_tipo_respaldo c on  c.id_tipo_respaldo = a.id_tipo_respaldo
left join srf_estado_envio e on e.id_cabecera_solicitud = a.id_cabecera_solicitud
where d.estado_  is true and a.estado_  is true  and d.id_cabecera_solicitud = $id order by a.id_item_solicitud asc;";

$stmt = $cons->query($query);
$solicitud = $stmt->fetchAll(PDO::FETCH_ASSOC);


$date = DateTime::createFromFormat('Y-m-d H:i:s', $solicitud[0]['fecha_envio']);
$dia = $date->format('d'); // Día (DD)
$mes = intval($date->format('m')); // Mes (MM) como número entero
$anio = $date->format('Y'); // Año (YYYY)

try {

    $documento = "
    <style type='text/css'>
        ul.main { width: 95%; list-style-type: square; }
        ul.main li { padding-bottom: 2mm; } 
        .tableReq {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0;
            font-size: 12px;
        }
        .tableReq .tableReqth, .tableReqtd {
            border: 1px solid #525659;
            padding: 3px;
            text-align: center;
        }
        .tableReq .tableReqth {
            background-color: #f2f2f2;
            text-align: center;
        } 
    </style> 
    ";
    $documento .= " 
        <page format='272x210' style='font: arial; color: #222222;' backtop='27mm' backbottom='17mm' backleft='20mm' backright='10mm'>
            <page_header>
                <table style='width: 100%; font-size:11px; color:#515151;'>
                    <tr>
                        <td style='text-align: center; padding:5px 10px 5px 20px; border-bottom:3px double black; width: 100%; font-size:10px;'> 
                            <img src='./escudo.jpg' style='width:60px;height:70px;'/><br><b>GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO</b>
                        </td>
                    </tr>
                </table>
            </page_header>
            <page_footer>
                <table style='width: 100%; font-size:11px; color:##515151; '>
                " . ($solicitud[0]['tipo_proceso'] == 'R' ? "<tr>
                    <td style='width: 100%; font-size:8px;'>
                        UAJ-CC<br>
                        C.c. Arch. Unidad<br>
                        Contribuyente
                    </td>
                </tr>" : "") . "
                <tr>
                    <td>
                        " . $solicitud[0]['hash_datos'] . " - <b>“2025 BICENTENARIO DE BOLIVIA”</b>
                    </td>
                </tr>
                    <tr>
                        <td style='text-align: center; padding:5px 10px 0 20px; border-top:3px double black; width: 100%; font-size:10px;'> 
                            Zonal Villa Bolivar D, Carretera a Viacha, Terminal Metropolitana de la Ciudad de El Alto, primer piso<br>https://datm.elalto.gob.bo/
                        </td>
                    </tr>
                </table>
            </page_footer> 

            <!--136=14cm y 210=21.5cm--> 
            <div  >
                <div style='text-align: right; margin-bottom: 20px;'>
                    El Alto, <span id='fechaActual'>" . $dia . " de " . $conn->obtenerNombreMes(intval($mes)) . " de " . $anio . "</span><br>
                    <b>" . $solicitud[0]['codigo_solicitud'] . "</b>
                </div>
                <div style='margin-bottom: 20px;'>
                    <p><b>Señora:<br>
                    Lic. Ivette Espinoza Vasquez<br>
                    Directora General Ejecutiva a.i.<br>
                    AUTORIDAD DE SUPERVISION DEL SISTEMA FINANCIERO - ASFI<br></b>
                    </p>
                </div>
                Presente:<br>
                <div style='text-align: right; margin-bottom: 20px;'>
                    <span style='text-decoration:underline;'><b>REF.: " . ($solicitud[0]['tipo_proceso'] == 'S' ? "SOLICITUD DE LEVANTAMIENTO DE RETENCIÓN DE FONDOS" : "SOLICITUD DE RETENCIÓN DE FONDOS") . "</b></span>
                </div>

                <div style='text-align: justify;'>
                    <p>De nuestra mayor consideración:</p> 
                    ";
    if ($solicitud[0]['tipo_proceso'] == 'S') {
        $documento .= "
                    <p>
                    En previsión a lo dispuesto por el Artículo 109 del Código Tributario Boliviano Ley 2492, concordante con el parágrafo Art. 35 del D.S. 27310 Reglamento del Código Tributario Boliviano, se solicita a su despacho, instruya los levantamientos de retención de las cuentas que mantienen en el sistema financiero los señores contribuyentes.
                    </p>
                    <p>
                    Por lo expuesto líneas arriba, se solicita proceda al <b><u>LEVANTAMIENTO DE LA RETENCIÓN DE FONDOS EN CAJAS DE AHORRO – CUENTAS CORRIENTES Y/O TITULOS VALORES</u></b> de los bienes o actividades registrados en la Administración Tributaria Municipal, <b>DEJANDO SIN EFECTO TODAS LAS MEDIDAS COACTIVAS, ASÍ COMO TODOS LOS PROVEÍDOS DE INICIO DE EJECUCIÓN TRIBUTARIA</b> girados contra los sujetos pasivos mencionados en el siguiente cuadro, en virtud de que este ente recaudador ha evidenciado la regularización de su situación tributaria.
                    </p>
                        </div>  
                    </div> ";

        $documento .= "<table class='tableReq' align='center' style='font-size:11px;'>
                    <tr class='tableReqtr'>
                        <th class='tableReqth' style='width: 5%;'>No</th>
                        <th class='tableReqth' style='width: 30%;'>Nombre/Razon social</th>
                        <th class='tableReqth' style='width: 15%;'>Documento</th>
                        <th class='tableReqth' style='width: 25%;'>No. Registro tributario</th>
                        <th class='tableReqth' style='width: 25%;'>Doc. Respaldo</th>
                    </tr>";
        $cnt = 1;
        foreach ($solicitud as $key => $item) {
            $documento .=   "<tr>
                            <td class='tableReqtd' style='width: 5%;'>" . $cnt . "</td>
                            <td class='tableReqtd' style='width: 30%; text-align:left;'>" . $item['nombre_completo'] . "</td>
                            <td class='tableReqtd' style='width: 15%;'>" . $item['documento'] . "</td>
                            <td class='tableReqtd' style='width: 25%;'>" . $item['documento_tributario'] . " <span  style='font-size:9px;'>[" . $item['tipo_documento_tributario'] . "]</span></td>
                            <td class='tableReqtd' style='width: 25%;'>"  . $item['documento_respaldo'] . "</td> 
                        </tr> ";
            $cnt++;
        }
        $documento .=   "</table>";
    } else {
        $documento .= "
            <p>
            En previsión a lo dispuesto por el Articulo 110 del Código Tributario Boliviano, Ley No 2492, solicitamos a su autoridad se ordene la RETENCIÓN DE FONDOS de las cuentas que tuviese en el sistema financiero del contribuyente: <b>" .
            strtoupper($solicitud[0]['nombre_completo'])  . "</b> con <b>" . $solicitud[0]['cod_documento_identidad_tipo'] . "  " . $solicitud[0]['documento'] . "</b>";
        $documento .= "(Titular de";

        switch ($solicitud[0]['tipo_documento_tributario']) {
            case 'INM':
                $documento .= "l VEÍCULO con placa de control ";
                break;
            case 'VEH':
                $documento .= "l BIEN INMUEBLE con número de inmueble ";
                break;
            case 'PUB':
                $documento .= " la PUBLICIDAD con número de de registro tributario ";
                break;
            default:
                $documento .= " la ACTIVIDAD ECONOMICA con número de de registro tributario ";
                break;
        }

        $documento .= strtoupper($solicitud[0]['documento_tributario']) . "), hasta el monto de <b>Bs. " . $solicitud[0]['monto_retencion_bs'] . ".- (" . numeroALetras($solicitud[0]['monto_retencion_bs']) . " BOLIVIANOS)</b>. Siendo que mediante la Resolución Determinativa No." .
            $solicitud[0]['resolucion_determinativa'] . ",  se transfiguro en título de ejecución de acuerdo a lo dispuesto en el numeral 1 del Artículo 108 del Código Tributario Boliviano Ley 2492.
            </p>
            <p>
            Señalar que aquella <b>RETENCIÓN DE FONDOS</b> es resultado del proceso de fiscalización de la gestión fiscal <b>" . $solicitud[0]['gestion_fiscal'] . "</b>
            , con número de <b>" . $solicitud[0]['tipo_respaldo'] . ": " . $solicitud[0]['documento_respaldo'] . "</b>, 
            en el cual se determina que el citado aún mantiene deuda pendiente con esta Administración Tributaria Municipal, y ante la falta de pago se encuentra en etapa de ejecución tributaria.
            </p> 
        </div>  
    </div> ";
    }

    $documento .=   "
                    <p>Con las consideraciones más distinguidas, nos despedimos.</p>
                    <p>Atentamente,</p>
                    <br>  
        ";
    $documento .= '
        </page>
        ';

    if ($solicitud[0]['tipo_proceso'] == 'R' and  $solicitud[0]['tipo_documento_tributario'] == 'VEH') {

        $documento .= "
        <page format='272x210' style='font: arial; color: #222222;' backtop='27mm' backbottom='17mm' backleft='20mm' backright='10mm'>
            <page_header>
                <table style='width: 100%; font-size:11px; color:#515151;'>
                    <tr>
                        <td style='text-align: center; padding:5px 10px 5px 20px; border-bottom:3px double black; width: 100%; font-size:10px;'> 
                            <img src='./escudo.jpg' style='width:60px;height:70px;'/><br><b>GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO</b>
                        </td>
                    </tr>
                </table>
            </page_header>
            <page_footer>
                <table style='width: 100%; font-size:11px; color:##515151; '>
                <tr>
                    <td style='width: 100%; font-size:8px;'>
                        UAJ-CC<br>
                        C.c. Arch. Unidad<br>
                        Contribuyente
                    </td>
                </tr>
                <tr>
                    <td>
                        " . $solicitud[0]['hash_datos'] . " - <b>“2025 BICENTENARIO DE BOLIVIA”</b>
                    </td>
                </tr>
                    <tr>
                        <td style='text-align: center; padding:5px 10px 0 20px; border-top:3px double black; width: 100%; font-size:10px;'> 
                            Zonal Villa Bolivar D, Carretera a Viacha, Terminal Metropolitana de la Ciudad de El Alto, primer piso<br>https://datm.elalto.gob.bo/
                        </td>
                    </tr>
                </table>
            </page_footer> 
            
            <div style='text-align: right; margin-bottom: 20px;'>
                    El Alto, <span id='fechaActual'>" . $dia . " de " . $conn->obtenerNombreMes(intval($mes)) . " de " . $anio . "</span><br>
                    <b>" . $solicitud[0]['cite_anotacion_preventiva'] . "</b>
            </div>
            <div style='margin-bottom: 20px;'>
                <p>
                <b>Señor:<br>
                DIRECCIÓN DE TRANSITO TRANSPORTE Y SEGURIDAD VIAL EL ALTO – DIVISIÓN DE REGISTROS DE VEHÍCULOS<br>
                POLICIA BOLIVIANA<br></b>
                </p>
            </div>
            Presente.-<br>
            <div style='text-align: right; margin-bottom: 20px;'>
                <span style='text-decoration:underline;'><b>REF.: INSCRIPCIÓN DE ANOTACION PREVENTIVA</b></span>
            </div>
            <span style='text-align: justify;'>
                    <p>De nuestra mayor consideración:</p> 
            </span>
            <div style='text-align: justify;'>
                    <p>
                    En previsión a lo dispuesto por el Articulo 110 del Código Tributario Boliviano Ley 2492, 
                    solicitamos la inscripción de la <b>ANOTACIÓN PREVENTIVA</b> del VEHÍCULO con placa de control <b>" . strtoupper($solicitud[0]['documento_tributario']) . "</b>, 
                    registrado a nombre del (la) contribuyente señor(a) <b>" . strtoupper($solicitud[0]['nombre_completo'])  . "</b> con <b>" . $solicitud[0]['cod_documento_identidad_tipo'] . "  " . trim($solicitud[0]['documento']) .
            ".</b><br>Considerando que conforme a lo dispuesto por el numeral I  parágrafo I del Artículo 108 del Código Tributario Boliviano Ley No 2492, 
                    concordante con el Articulo 4 del Decreto Supremo No 27874, conforme a la RESOLUCIÓN DETERMINATIVA No " . $solicitud[0]['resolucion_determinativa'] . ", 
                    se constituye en el título de ejecución tributaria.
                    </p> 
            </div> 
            <span style='text-align: justify;'>
                <p>
                    Lo solicitado es conforme al amparo de lo establecido por el Articulo 3 del Decreto supremo No 27310, debiendo considerarse que la inscripción es 
                    resultado del proceso de fiscalización de oficio de las gestiones fiscales: <b>" . $solicitud[0]['gestion_fiscal'] . "</b>, por un monto de 
                    <b>Bs. " . $solicitud[0]['monto_retencion_bs'] . ".- (" . numeroALetras($solicitud[0]['monto_retencion_bs']) . " BOLIVIANOS)</b>, en el cual se determina 
                    que el citado aún mantiene deuda pendiente con esta Administración Tributaria Municipal, y ante la falta de pago se encuentra en etapa de ejecución tributaria.                
                </p> 
            </span>
            <span style='text-align: justify;'>
                <p>
                Asimismo, solicito a usted que con carácter preliminar se considere que conforme dispone la Ley No 1602 en su Artículo 8. 
                <i>“Las entidades del Estado que persigan la recuperación de sus créditos, quedan exentas del pago de tasas o derechos establecidos para los registros públicos nacionales, departamentales y municipales, así como valores judiciales”</i>
                </p> 
                <p>Sin otro particular, reciba un cordial saludo.</p>
                <p>Atentamente,</p>
            </span>
        </page>
        ";
    }

    /* if ($resultados) { */
    /* echo $documento; */
    $html2pdf = new Html2Pdf();
    $html2pdf->writeHTML($documento);

    /* $html2pdf->pdf->Image('../img/escudo.png', 70, 75, 80, 80, '', '', '', true, 800); */

    $html2pdf->Output();
        /* } else
        echo "No se logro recuperar los registros" */;
} catch (PDOException $e) {
    echo "Error al ejecutar la consulta: " . $e->getMessage();
}

function convertirGrupo($n, $final, $unidades, $unidadesEspeciales, $decenas, $decenas2, $centenas)
{
    $resultado = '';

    if ($n === 100) return 'cien';

    if ($n >= 100) {
        $resultado .= $centenas[floor($n / 100)] . ' ';
        $n %= 100;
    }

    if ($n >= 30) {
        $resultado .= $decenas2[floor($n / 10)];
        if ($n % 10 !== 0) {
            $resultado .= ' y ' . ($final ? $unidadesEspeciales[$n % 10] : $unidades[$n % 10]);
        }
    } elseif ($n >= 20) {
        if ($n === 20) {
            $resultado .= 'veinte';
        } else {
            $resultado .= 'veinti' . ($final ? $unidadesEspeciales[$n % 10] : $unidades[$n % 10]);
        }
    } elseif ($n >= 10) {
        $resultado .= $decenas[$n - 10];
    } elseif ($n > 0) {
        $resultado .= $final ? $unidadesEspeciales[$n] : $unidades[$n];
    }

    return trim($resultado);
}

function numeroALetras($numero)
{
    // Eliminar comas y convertir a número
    $numero = floatval(str_replace(',', '', $numero));

    if (!is_numeric($numero)) {
        return 'Por favor, ingrese un número válido.';
    }

    $unidades = ['', 'un', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve'];
    $unidadesEspeciales = ['', 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve'];
    $decenas = ['diez', 'once', 'doce', 'trece', 'catorce', 'quince', 'dieciséis', 'diecisiete', 'dieciocho', 'diecinueve'];
    $decenas2 = ['', '', 'veinte', 'treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa'];
    $centenas = ['', 'ciento', 'doscientos', 'trescientos', 'cuatrocientos', 'quinientos', 'seiscientos', 'setecientos', 'ochocientos', 'novecientos'];

    if ($numero === 0) return 'Cero 00/100';

    $grupos = ['', 'mil', 'millones', 'mil millones', 'billones'];
    $resultado = '';
    $i = 0;
    $parteEntera = floor($numero);
    $parteDecimal = round(($numero - $parteEntera) * 100);

    while ($parteEntera > 0) {
        $grupo = $parteEntera % 1000;
        if ($grupo > 0) {
            $texto = convertirGrupo($grupo, $i === 0, $unidades, $unidadesEspeciales, $decenas, $decenas2, $centenas);
            if ($i === 1) {
                if ($grupo === 1) {
                    $resultado = 'mil ' . $resultado;
                } else {
                    $resultado = $texto . ' mil ' . $resultado;
                }
            } elseif ($i === 2 && $grupo === 1) {
                $resultado = 'un millón ' . $resultado;
            } else {
                $resultado = $texto . ($i > 0 ? ' ' . $grupos[$i] : '') . ($resultado ? ' ' . $resultado : '');
            }
        }
        $parteEntera = floor($parteEntera / 1000);
        $i++;
    }

    $resultado = trim($resultado);

    // Capitalizar la primera letra
    $resultado = ucfirst($resultado);

    // Reemplazar "Uno mil" por "Un mil" al inicio de la cadena
    if (strpos($resultado, 'Mil') === 0) {
        $resultado = 'Un mil' . substr($resultado, 3);
    }

    $resultado .= ' ' . str_pad($parteDecimal, 2, '0', STR_PAD_LEFT) . '/100';

    return $resultado;
}
