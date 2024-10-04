<?php
session_start();

require '../vendor/autoload.php';
require_once './conexionpsql.php';

use Spipu\Html2Pdf\Html2Pdf;

$conn = new Conexion();
$cons = $conn->conectar();
$cabecera = new stdClass();

foreach ($_GET as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$pjson = array();

$query = "
        select a.id, a.comun as  doc_identidad, c.pmc,  TRIM(
			COALESCE(a.nombre, '') || 
			CASE 
				WHEN a.paterno IS NOT NULL AND a.nombre IS NOT NULL THEN ' ' ELSE '' END || 
			COALESCE(a.paterno, '') || 
			CASE 
				WHEN a.materno IS NOT NULL AND (a.nombre IS NOT NULL OR a.paterno IS NOT NULL) THEN ' ' ELSE '' END || 
			COALESCE(a.materno, '')
		) AS nombre_completo,
		b.barrio||', '||a.tipocalle||' '||a.nombrecall||' #'||a.numcasa as residencia
        from simat_pm01cont  as a
        left join simat_pmbarrio as b on b.codigo = a.cod_barrio
        left join siim_satnombr as c on c.documento = a.comun
        where a.comun = '$id' or c.pmc = '$id'; ";
$stmt = $cons->query($query);
$simatCabecera = $stmt->fetch(PDO::FETCH_ASSOC);
$pjson['cabecera'] = $simatCabecera;

$html = "

<style type='text/css'>
    body {
        font-family: Arial, sans-serif; 
    }
    .container {
        width: 100%; 
        margin-left:25px;
    }
    h3 {
        text-align: center;
        font-size: 1em;
        margin-bottom: 20px;
    } 
    .spanTitulo {
        color:#606060;
        font-size: 11px;

    } 

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        font-size: 11px;
    }
    th, td {
        border-bottom: 1px dotted #696969;
        padding: 4px;
        text-align: center;
    }
    th {
        border: 1px solid #225075; 
        background-color: #e8f8ff;
        font-size: 12px;
    }
    .section-title {
        font-weight: bold;
        font-size: 11px;
        text-align: left;
        margin: 7px 0;
        border-bottom: 1px solid #83a714;
        border-right: 1px solid #83a714;
        border-radius: 3px; 
        padding: 4px;  
        width: 96%;
        text-align: right;
        margin-left: auto; /* Esto alinea el div a la derecha */
        margin-right: 0; 
    } 

    .datosPersona tr td span {
        font-weight: bold;

    }
    .datosPersona {
        font-size: 11px;
        text-align:left;
        margin-bottom: 10px;
    }
    .datosPersona tr td{
    border: 0;
    }
</style> 

<page format='272x210' style='font: arial; color: #222222;'>
<!--136=14cm y 210=21.5cm--> 

    <body>
        <div class='container'>  
            <span class='spanTitulo'> INFORMACION HISTORICA DE SISTEMA SIMAT/SIIM</span>  
            <h3>DATOS REGISTRADOS - SISTEMA SIMAT</h3>

            <div class='section-title'>DATOS CONTRIBUYENTE</div> 

            <table class='datosPersona'>
                <tr>
                    <td class='datosPersona' style='width: 48%;'><span>DOC_ID:</span> $id</td>
                    <td  class='datosPersona'style='width: 48%;'><span>PMC-ANT:</span>  " . $simatCabecera['pmc'] . "</td>
                </tr>
                <tr>
                    <td  class='datosPersona' style='width: 48%;'><span>NOMBRE:</span> " . $simatCabecera['nombre_completo'] . "</td>
                    <td  class='datosPersona' style='width: 48%;'><span>RESIDENCIA:</span> " . $simatCabecera['residencia'] . "</td>
                </tr>
            </table>  
            <div class='section-title'>INMUEBLES REGISTRADOS</div> 
            <table>
                <tr>
                    <th style='width: 4%;'>TV</th>
                    <th style='width: 3%;'>ID</th>
                    <th style='width: 20%;'>DIRECCION</th>
                    <th style='width: 5%;'>ZV</th>
                    <th style='width: 10%;'>VIA</th>
                    <th style='width: 4%;'>AG</th>
                    <th style='width: 4%;'>LU</th>
                    <th style='width: 4%;'>AL</th>
                    <th style='width: 4%;'>FO</th>
                    <th style='width: 8%;'>SUP_T</th>
                    <th style='width: 5%;'>IN</th>
                    <th style='width: 13%;'>TIPO CONS</th>
                    <th style='width: 6%;'>SUP_C</th>
                    <th style='width: 5%;'>EST</th>
                </tr> 
";
//buscamos datos de los items que tenga registrado para autocompletar 
$query = "select var1, b.barrio||', '||a.tipocalle||' '||a.nombrecall||' #'||a.numcasa  as residencia, 
                zona, 
                CASE mat_vias
                WHEN '1' THEN 'ASFALTO'
                WHEN '2' THEN 'ADOQUIN'
                WHEN '3' THEN 'CEMENTO'
                WHEN '4' THEN 'LOSETA'
                WHEN '5' THEN 'PIEDRA'
                WHEN '6' THEN 'RIPIO'
                WHEN '7' THEN 'TIERRA'
                WHEN '8' THEN 'LADRILLO'
                ELSE 'N/D'  
            END AS tipo_via, agua, luz, alcantari, telefono, superficie, inclinac,
            CASE viv_unifa
                WHEN '0' THEN 'N/D'
                WHEN '1' THEN 'LUJOSO'
                WHEN '2' THEN 'MUY BUENA'
                WHEN '3' THEN 'BUENA'
                WHEN '4' THEN 'ECONOMICO'
                WHEN '5' THEN 'INT. SOCIAL'
                WHEN '6' THEN 'MARGINAL'
                WHEN '7' THEN 'N/D'
                ELSE 'N/D' END AS   tipo_contruccion, sup_const, bandera as estado
        from simat_pm01inmu as a 
        left join simat_pmbarrio as b on b.codigo = a.cod_barrio
        where a.comun = '" . $simatCabecera['doc_identidad'] . "';";

$stmt = $cons->query($query);
$inmuebles = $stmt->fetchAll(PDO::FETCH_ASSOC);
$cnt = 1;
foreach ($inmuebles as $row) {
    $html .= "
        <tr>
            <td style='width: 4%;'>" . $cnt . "</td>
            <td style='width: 3%;'>" . $row['var1'] . "</td>
            <td style='width: 20%;'>" . $row['residencia'] . "</td>
            <td style='width: 5%;'>" . $row['zona'] . "</td>
            <td style='width: 10%;'>" . $row['tipo_via'] . "</td>
            <td style='width: 4%;'>" . $row['agua'] . "</td>
            <td style='width: 4%;'>" . $row['luz'] . "</td>
            <td style='width: 4%;'>" . $row['alcantari'] . "</td>
            <td style='width: 4%;'>" . $row['telefono'] . "</td>
            <td style='width: 8%;'>" . $row['superficie'] . "</td>
            <td style='width: 5%;'>" . $row['inclinac'] . "</td>
            <td style='width: 13%;'>" . $row['tipo_contruccion'] . "</td>
            <td style='width: 6%;'>" . $row['sup_const'] . "</td>
            <td style='width: 5%;'>" . $row['estado'] . "</td>
        </tr> 
    ";
    $ctn++;
} 

$html .= "
</table> 
            <div class='section-title'>DATOS DE EMPADRONAMIENTO Y MODIFICACIONES</div>
            <table >
                <tr>
                    <th style='width: 20%;'>TIPO FORMULARIO</th>
                    <th style='width: 35%;'>LOTE</th>
                    <th style='width: 22%;'>FECHA</th>
                    <th style='width: 18%;'>FOLIO</th>
                </tr> 
";


$query =  "select  tip_form, lote, fech_lote, folio 
            from simat_pmCONTRO where comun = '" . $simatCabecera['doc_identidad'] . "';";

$stmt = $cons->query($query);
$empadronamiento = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($empadronamiento as $row) {
    $html .= "
    <tr>
        <td>". $row['tip_form']."</td>
        <td>". $row['lote']."</td>
        <td>". $row['fech_lote']."</td>
        <td>". $row['folio']."</td>
    </tr> 
    ";
} 

$html .= "</table>
        </div>
        <div style='text-align: right; font-size: 9px; padding-right:20px; '>
            Usuario:".$_SESSION['usuario']."
        </div>
    </body> 
</page>";

$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($html);
$html2pdf->Output();
