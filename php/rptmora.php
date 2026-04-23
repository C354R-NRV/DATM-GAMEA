<?php
session_start();
require_once './conexionpsql.php';
$conn = new Conexion();
$cons = $conn->conectar();
$cabecera = new stdClass();

foreach ($_GET as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$documento = base64_decode($id);
/* echo "documento:$documento<br>"; */

$html = "";

$filas = 0;
$rspVeh = false;
$rspInm = false;
$rspAct = false;

$totalGeneral = 0;
$subtotal = 0;
$fechaCorte = '';
$auxnumero_inmueble = '';
$swIngresoSubtotal = false;

if ($t == 'inm' or $t == 'all') {
    $sql = "select a.numero_inmueble, a.ubicacion_nivel1, a.documento_identidad, a.documento_identidad_apo, a.gestion, a.concepto, COALESCE(a.monto_total_deuda::TEXT, 'x') as monto_total_deuda,
    a.fecha_cargado, a.codigo_tributario, a.tipo_fiscalizacion, a.etapa_fiscalizacion, 
    observacion_liquidacion 
    from ruat_inmueble_mora a 
    where a.documento_identidad = '$documento' OR a.documento_identidad_apo = '$documento'
    order by a.numero_inmueble, gestion, concepto";
    $stmt = $cons->query($sql);
    $rspInm = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
if ($rspInm) {
    $html .= "<table style='width: 98%; margin:0 0 0 3mm;' cellspacing='0mm' cellpadding='0' >";
    $swPrimerRegistro = true;
    $subtotal = 0;
    foreach ($rspInm as $row) {

        if ($auxnumero_inmueble != $row["numero_inmueble"]) {

            $swPrimerRegistro = true; 
            $auxnumero_inmueble = $row["numero_inmueble"];
        }

        if ($swPrimerRegistro) {
            $swPrimerRegistro = false;
            $fechaCorte = $row["fecha_cargado"];
            $filas += 2;

            if ($swIngresoSubtotal) {
                $filas += 2;
                $auxSubtotal = number_format($subtotal, 2, '.', ',');
                if ($subtotal == 0) {
                    $auxSubtotal = '-';
                }
                $totalGeneral += $subtotal;
                $subtotal = 0;
                $html .= "
                        <tr>
                            <td></td>
                            <td></td>
                            <td style='text-align:right;'><b>" . $auxSubtotal . "</b></td>
                        </tr>
                        <tr>
                            <td colspan='3' >
                            <div style='width: 99%; height: 3px; border-bottom: #222222 dotted 1px; '></div>
                            </td>
                        </tr>";
            }

            $html .= "
            <tr>
                <td colspan='3' style='padding: 0.3rem 0 0.3rem 0;'><span>INMUEBLE: " . $row["numero_inmueble"] . ", " . $row["ubicacion_nivel1"] . "</span></td>
            </tr>
            <tr>
                <td  ><b>GESTIÓN<b></td>
                <td style='width:65%; padding: 0 0 0 0.5rem;'><b>CONCEPTO<b></td>
                <td style='width:25%;text-align:right; '><b>IMPORTE<b></td>
            </tr>
            ";
            $swIngresoSubtotal = true;
        }
        $filas++;
        $auxObs = ' <br>[OBSERVADA - VISITAR OFICINA DATM]';
        $auxMonto = '-';
        # $row["tramite"] != 'REGISTRO OBSERVADOS' and 
        if ((
                ($row["monto_total_deuda"] != 'x')
                or ($row["tipo_valuacion"] == 'VALOR TABLAS' and $row["observacion_liquidacion"] == 'OBSERVACION LEVANTADA'))
        ) {
            $auxMonto = number_format($row["monto_total_deuda"], 2, '.', ',');
            $auxObs = '';
            $subtotal += $row["monto_total_deuda"];
        }
        if ($row["monto_total_deuda"] == 'x') {
            $auxObs = '<br>[NO DETERMINADO, CONSULTAR EN OFICINA DATM]';
            $auxMonto = '-';
        }

        $html .= "
            <tr>
                <td>" . $row["gestion"] . "</td>
                <td style='width:65%; padding: 0 0 0 0.5rem;'>" . $row["concepto"] . $auxObs . "</td>
                <td style='width:25%;text-align:right; '>" . $auxMonto . "</td>
            </tr> ";
    }

    $filas += 2;
    $auxSubtotal =  number_format($subtotal, 2, '.', ',');
    if ($subtotal == 0) {
        $auxSubtotal = '-';
    }

    $html .= "
        <tr>
            <td></td>
            <td></td>
            <td style='text-align:right;'><b>" . $auxSubtotal . "</b></td>
        </tr>
        <tr>
            <td colspan='3' >
            <div style='width: 99%; height: 3px; border-bottom: #222222 dotted 1px; '></div>
            </td>
        </tr>";
    $html .= "</table> ";
}
$totalGeneral += $subtotal;
$subtotal = 0;
$auxnro_pta = '';
$swIngresoSubtotal = false;
if ($t == 'veh' or $t == 'all') {
    $sql = "select  a.nro_pta, a.documento_identidad, a.documento_identidad_apo,a.gestion, a.concepto, COALESCE(a.monto_total_deuda::TEXT, 'x') as monto_total_deuda, 
    a.fecha_cargado, a.codigo_tributario, a.tipo_fiscalizacion, a.etapa_fiscalizacion, b.clase, b.marca, b.modelo, observacion_liquidacion, tipo_valuacion, tramite
    from ruat_vehiculo_mora a
    left join vehiculo_univ b on b.nro_pta = a.nro_pta
    where a.documento_identidad = '$documento' OR a.documento_identidad_apo = '$documento'
    order by nro_pta, gestion, concepto";
    /* echo $sql; */
    $stmt = $cons->query($sql);
    $rspVeh = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
if ($rspVeh) {
    $html .= "<table style='width: 98%; margin:0 0 0 3mm;' cellspacing='0mm' cellpadding='0' >";
    $swPrimerRegistro = true;
    $subtotal = 0;

    foreach ($rspVeh as $row) {

        if ($auxnro_pta != $row["nro_pta"]) {

            $swPrimerRegistro = true; 
            $auxnro_pta = $row["nro_pta"];
        }

        if ($swPrimerRegistro) {
            $swPrimerRegistro = false;
            $fechaCorte = $row["fecha_cargado"];
            $filas += 2;

            if ($swIngresoSubtotal) {
                $filas += 2;
                $auxSubtotal = number_format($subtotal, 2, '.', ',');
                if ($subtotal == 0) {
                    $auxSubtotal = '-';
                }
                $totalGeneral += $subtotal;
                $subtotal = 0;
                $html .= "
                        <tr>
                            <td></td>
                            <td></td>
                            <td style='text-align:right;'><b>" . $auxSubtotal . "</b></td>
                        </tr>
                        <tr>
                            <td colspan='3' >
                            <div style='width: 99%; height: 3px; border-bottom: #222222 dotted 1px; '></div>
                            </td>
                        </tr>";
            }

            $html .= "
            <tr>
                <td colspan='3' style='padding: 0.3rem 0 0.3rem 0;'><span>VEHICULO: " . $row["nro_pta"] . ", " . $row["clase"] . " " . $row["marca"] . "  " . $row["modelo"] . "</span></td>
            </tr>
            <tr>
                <td  ><b>GESTIÓN<b></td>
                <td style='width:65%; padding: 0 0 0 0.5rem;'><b>CONCEPTO<b></td>
                <td style='width:25%;text-align:right; '><b>IMPORTE<b></td>
            </tr>
            ";
            $swIngresoSubtotal = true;
        }
        $filas++;

        $auxObs = ' <br>[OBSERVADA - VISITAR OFICINA DATM]';
        $auxMonto = '-';
        // $row["observacion_liquidacion"] != 'OBSERVACION LEVANTADA' and

        if (
            $row["tramite"] != 'REGISTRO OBSERVADOS' and (
                ($row["monto_total_deuda"] != 'x')
                or ($row["tipo_valuacion"] == 'VALOR TABLAS' and $row["observacion_liquidacion"] == 'OBSERVACION LEVANTADA'))
        ) {
            $auxMonto = number_format($row["monto_total_deuda"], 2, '.', ',');
            $auxObs = '';
            $subtotal += $row["monto_total_deuda"];
        }
        if ($row["monto_total_deuda"] == 'x') {
            $auxObs = '<br>[NO DETERMINADO, CONSULTAR EN OFICINA DATM]';
            $auxMonto = '-';
        }

        $html .= "
            <tr>
                <td>" . $row["gestion"] . "</td>
                <td style='width:65%; padding: 0 0 0 0.5rem;'>" . $row["concepto"] . $auxObs . "</td>
                <td style='width:25%;text-align:right; '>" . $auxMonto . "</td>
            </tr> ";
    }

    $filas += 2;
    $auxSubtotal = number_format($subtotal, 2, '.', ',');
    if ($subtotal == 0) {
        $auxSubtotal = '-';
    }
    $html .= "
        <tr>
            <td></td>
            <td></td>
            <td style='text-align:right;'><b>" . $auxSubtotal . "</b></td>
        </tr>
        <tr>
            <td colspan='3' >
            <div style='width: 99%; height: 3px; border-bottom: #222222 dotted 1px; '></div>
            </td>
        </tr>";
    $html .= "</table> ";
}

$totalGeneral += $subtotal;
$subtotal = 0;
$auxnumero_actividad = '';
$swIngresoSubtotal = false;

if ($t == 'act' or $t == 'all') {
    $sql = "select a.numero_actividad, a.razon_social, b.tipo_actividad, a.documento_identidad, a.documento_identidad_apo, a.gestion, a.concepto,  
    COALESCE(a.monto_total_deuda::TEXT, 'x') as monto_total_deuda,
    a.fecha_cargado, a.codigo_tributario, a.tipo_fiscalizacion, a.etapa_fiscalizacion, 
    observacion_liquidacion, tramite
    from ruat_actividad_economica_mora a
    left join actividad_univ b on a.numero_actividad = b.numero_actividad 
    where a.documento_identidad = '$documento' OR a.documento_identidad_apo = '$documento'
    order by a.numero_actividad, gestion, concepto";

    $stmt = $cons->query($sql);
    $rspAct = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
if ($rspAct) {
    $html .= "<table style='width: 98%; margin:0 0 0 3mm;' cellspacing='0mm' cellpadding='0' >";
    $swPrimerRegistro = true;
    $subtotal = 0;
    foreach ($rspAct as $row) {

        if ($auxnumero_actividad != $row["numero_actividad"]) {

            $swPrimerRegistro = true; 
            $auxnumero_actividad = $row["numero_actividad"];
        }

        if ($swPrimerRegistro) {
            $swPrimerRegistro = false;
            $fechaCorte = $row["fecha_cargado"];
            $filas += 2;

            if ($swIngresoSubtotal) {
                $filas += 2;
                $auxSubtotal = number_format($subtotal, 2, '.', ',');
                if ($subtotal == 0) {
                    $auxSubtotal = '-';
                }
                $totalGeneral += $subtotal;
                $subtotal = 0;
                $html .= "
                        <tr>
                            <td></td>
                            <td></td>
                            <td style='text-align:right;'><b>" . $auxSubtotal . "</b></td>
                        </tr>
                        <tr>
                            <td colspan='3'>
                            <div style='width: 99%; height: 3px; border-bottom: #222222 dotted 1px; '></div>
                            </td>
                        </tr>";
            } 

            $html .= "
            <tr>
                <td colspan='3' style='padding: 0.3rem 0 0.3rem 0;'><span>ACT. ECONOMICA: " . $row["numero_actividad"] . " - " . $row["tipo_actividad"] . ", " . $row["razon_social"] . "</span></td>
            </tr>
            <tr>
                <td  ><b>GESTIÓN<b></td>
                <td style='width:65%; padding: 0 0 0 0.5rem;'><b>CONCEPTO<b></td>
                <td style='width:25%;text-align:right; '><b>IMPORTE<b></td>
            </tr>
            ";
            $swIngresoSubtotal = true;
        }
        $filas++;

        $auxObs = '<br>[OBSERVADA - VISITAR OFICINA DATM]';
        $auxMonto = '-';

        if (
            $row["tramite"] != 'REGISTRO OBSERVADOS' and (
                ($row["monto_total_deuda"] != 'x')
                or ($row["tipo_valuacion"] == 'VALOR TABLAS' and $row["observacion_liquidacion"] == 'OBSERVACION LEVANTADA'))
        ) {
            $auxMonto = number_format($row["monto_total_deuda"], 2, '.', ',');
            $auxObs = '';
            $subtotal += $row["monto_total_deuda"];
        }
        if ($row["monto_total_deuda"] == 'x') {
            $auxObs = '<br>[NO DETERMINADO, CONSULTAR EN OFICINA DATM]';
            $auxMonto = '-';
        }

        $html .= "
            <tr>
                <td>" . $row["gestion"] . "</td>
                <td style='width:65%; padding: 0 0 0 0.5rem;'>" . $row["concepto"] . $auxObs . "</td>
                <td style='width:25%;text-align:right; '>" . $auxMonto . "</td>
            </tr> ";
    }

    $filas += 2;
    $auxSubtotal = number_format($subtotal, 2, '.', ',');
    if ($subtotal == 0) {
        $auxSubtotal = '-';
    }
    $html .= "
        <tr>
            <td></td>
            <td></td>
            <td style='text-align:right;'><b>" . $auxSubtotal . "</b></td>
        </tr>
        <tr>
            <td colspan='3' >
            <div style='width: 99%; height: 3px; border-bottom: #222222 dotted 1px; '></div>
            </td>
        </tr>";
    $html .= "</table> ";
}
$totalGeneral += $subtotal;
$subtotal = 0;
$auxTotalGeneral = number_format($totalGeneral, 2, '.', ',');
if ($totalGeneral == 0) {
    $auxTotalGeneral = '-';
}

$html .= "<table style='width: 98%; margin:5mm 0 10mm 3mm; ' cellspacing='0mm' cellpadding='0' >
    <tr>
        <td rowspan='7' style='text-align:center; vertical-align:middle; font-size:1.7rem; width:50%; border: 7px black solid;'><b><u>¡ I M P O R T A N T E !</u></b><br>Los importes calculados corresponden a fecha corte <b>$fechaCorte</b>, los mismos estan sujetos a las actualizaciones correspondientes.</td>
    </tr>
    <tr>
        <td style='text-align:right;  width:50%'><span style='font-size:1.1rem'>TOTAL ADEUDADO: </span><b>" . $auxTotalGeneral . "</b></td>
    </tr>
    <tr>
        <td style='text-align:right;  width:50%'><span  style='font-size:1.1rem'>OPERADOR: " . $_SESSION['usuario'] . "</span></td>
    </tr>
    <tr>
        <td style='text-align:right;  width:50%'><span  style='font-size:1.1rem'>IMPRESIÓN: " . date('d/m/Y H:s:i') . "</span></td>
    </tr>
    <tr>
        <td></td>
    </tr>  
    <tr>
        <td style='text-align:right;  width:65%'><span  >https://datm.elalto.gob.bo</span></td>
    </tr>
    <tr>
        <td style='text-align:right;  width:65%'><span  >Whatsapp: </span><b>64229921</b></td>
    </tr>
</table> ";

if ($filas >= 20) {
    $html .= "<table style='width: 98%; margin:0 0 0 3mm; text-align:center;' cellspacing='0mm' cellpadding='0' >

        <tr>
            <td><img src='../img/qrProformas.png' style='width:18rem;' alt='QR Code'></td>
            <td><img src='../img/qrWhatsapp.png' style='width:18rem;' alt='QR Code'></td>
        </tr> 
        <tr>
            <td  style='text-align:center; vertical-align:middle;'>Enlaces de pago via QR</td>
            <td  style='text-align:center; vertical-align:middle;'>Contáctanos por whatsapp</td>
        </tr> 
        <tr>
            <td  colspan='2' style='width: 100%; text-align:center; '>
                <img src='../img/datmInteligentev3.png' style=' text-align:center; padding-left:2.5mm;  max-width: 98%; padding:1.5rem; '/>  
            </td>
        </tr>
    </table> ";
} else {
    $html .= "<table style='width: 98%; margin:0 0 0 3mm; text-align:center;' cellspacing='0mm' cellpadding='0' > 
        <tr>
            <td><img src='../img/qrProformas.png' style='width:18rem;' alt='QR Code'></td>
            <td  style='text-align:center; vertical-align:middle;'>
                <img src='../img/datmInteligentev3.png' style=' text-align:center; padding-left:2.5mm;  max-width: 98%; padding:1.5rem; '/><br>
                Enlaces de pago via QR
            </td>
        </tr>   
        <tr>
            <td><img src='../img/qrWhatsapp.png' style='width:18rem;' alt='QR Code'></td>
            <td  style='text-align:center; vertical-align:middle;'>
                <img src='../img/whatsapp.jpg' style=' text-align:center; padding-left:2.5mm;  max-width: 98%; padding:1.5rem; '/><br>
                Contáctanos por Whatsapp
            </td>
        </tr>
        <!-- <tr>
            <td  colspan='2' style='width: 100%; text-align:center; '>
                <img src='../img/datmInteligentev3.png' style=' text-align:center; padding-left:2.5mm;  max-width: 98%; padding:1.5rem; '/>  
            </td>
        </tr>   -->
    </table>  
    ";
}

echo "

<link href='https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap' rel='stylesheet'>
    
<style>
* {
font-size:1.4rem;
font-family: 'Roboto', sans-serif;
}
</style>  
<table style=' width: 98%; margin:10mm 0 0 3mm; ' cellspacing='0mm' cellpadding='0' >
<tr>    
    <td  style='width: 100%; align:center; text-align:center;'>
    <span>GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO</span><br>
    <span>SECRETARIA MUNICIPAL ADMINISTRATIVA FINANCIERA</span>
    </td>
<tr>
    <td  style='width: 100%; align:center; text-align:center;'>
    <img src='../img/logogameav3.png' style=' text-align:center; padding-left:2.5mm;  max-width: 98%; padding:1.5rem; '/>  
    </td>
</tr>
<tr>
    <td  style='width: 100%; align:center; text-align:center;'>
    <span>DIRECCIÓN DE ADMINISTRACIÓN TRIBUTARIA MUNICIPAL</span><br>
    <span><b>EXTRACTO DEUDA TRIBUTARIA</b></span><br>
    <span>Fecha corte: $fechaCorte</span><br>
    <span>Contribuyente:" . $documento . "</span>
    </td>
<tr> 
<tr>
    <td style='height: 3px; '>
        <div style=' width: 100%; height: 3px; border-bottom: #222222 solid 3px;padding:0.2rem'></div>
    </td>
</tr>  
</table>

".$html;
