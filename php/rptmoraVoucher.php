<?php
session_start();   
require_once './conexionpsql.php';
require '../vendor/phpqrcode/qrlib.php';

foreach ($_GET as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$documento = base64_decode($id);

$contenido = "https://datm.elalto.gob.bo";

$tempDir = './temp/';
$qrFilePath = $tempDir . 'codigo_qr.png'; 
if (!file_exists($tempDir)) {
    mkdir($tempDir, 0777, true);
} 
QRcode::png($contenido, $qrFilePath, QR_ECLEVEL_H, 3);

$html = "
<link href='https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap' rel='stylesheet'>
    
<style>
* {
font-size:0.85rem;
font-family: 'Roboto', sans-serif;
}
</style>  
<table style=' width: 75mm; margin:0 0 0 3mm; ' cellspacing='0mm' cellpadding='0' >
<tr>
    <td  style='width: 100%; align:center; text-align:center;'>
    <span>GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO</span><br>
    <span>SECRETARIA MUNICIPAL ADMINISTRATIVA FINANCIERA</span>
    </td>
<tr>
    <td  style='width: 100%; align:center; text-align:center;'>
    <img src='../img/datm_logo.png' style=' text-align:center; padding-left:2.5mm;  max-width: 75mm; height: 19mm;'/>  
    </td>
</tr>
<tr>
    <td  style='width: 100%; align:center; text-align:center;'>
    <span>DIRECCIÓN DE ADMINISTRACIÓN TRIBUTARIA MUNICIPAL</span><br>
    <span>DETALLE DE DEUDA</span><br>
    <span>".date('dd/mm/YYYY H:s:i')."</span><br>
    <span>Contribuyente:". $documento ."</span>
    </td>
<tr> 
<tr>
    <td style='height: 3px; '>
        <div style=' width: 100%; height: 3px; border-bottom: #222222 solid 1px;padding:0.2rem'></div>
    </td>
</tr>  
</table>



<table style='width: 75mm; margin:0 0 0 3mm;' cellspacing='0mm' cellpadding='0' >
<tr>
    <td colspan='3' style='padding: 0.3rem 0 0 0;'><span>INMUEBLE: 1510101377, Distrito  10</span></td>
</tr>
<tr>
    <td>GESTION</td>
    <td>CONCEPTO</td>
    <td style='text-align:right;'>IMPORTE</td>
</tr>
<tr>
    <td>1995</td>
    <td>IMP. MUN. A LA PROPIEDAD</td>
    <td style='text-align:right;'>10,537.00</td>
</tr>
<tr>
    <td>1995</td>
    <td>IMP. MUN. A LA PROPIEDAD</td>
    <td style='text-align:right;'>10,537.00</td>
</tr>
<tr>
    <td></td>
    <td></td>
    <td style='text-align:right;'><b>10,537.00</b></td>
</tr>
<tr >
    <td colspan='3' >
    <div style='width: 99%; height: 3px; border-bottom: #222222 dotted 1px; '></div>
    </td>
</tr>
<tr >
    <td colspan='3' style='padding: 0.3rem 0 0 0;'><span>INMUEBLE: 1510101377, Distrito  10</span></td>
</tr>
<tr>
    <td>GESTION</td>
    <td>CONCEPTO</td>
    <td style='text-align:right;'>IMPORTE</td>
</tr>
<tr>
    <td>1995</td>
    <td>IMP. MUN. A LA PROPIEDAD</td>
    <td style='text-align:right;'>10,537.00</td>
</tr>
<tr>
    <td>1995</td>
    <td>IMP. MUN. A LA PROPIEDAD</td>
    <td style='text-align:right;'>10,537.00</td>
</tr>
<tr>
    <td>1995</td>
    <td>IMP. MUN. A LA PROPIEDAD</td>
    <td style='text-align:right;'>10,537.00</td>
</tr>
<tr>
    <td>1995</td>
    <td>IMP. MUN. A LA PROPIEDAD</td>
    <td style='text-align:right;'>10,537.00</td>
</tr>
<tr>
    <td>1995</td>
    <td>IMP. MUN. A LA PROPIEDAD</td>
    <td style='text-align:right;'>10,537.00</td>
</tr>
<tr>
    <td>1995</td>
    <td>IMP. MUN. A LA PROPIEDAD</td>
    <td style='text-align:right;'>10,537.00</td>
</tr>
<tr>
    <td>1995</td>
    <td>IMP. MUN. A LA PROPIEDAD</td>
    <td style='text-align:right;'>10,537.00</td>
</tr>
<tr>
    <td>1995</td>
    <td>IMP. MUN. A LA PROPIEDAD</td>
    <td style='text-align:right;'>10,537.00</td>
</tr>
<tr>
    <td>1995</td>
    <td>IMP. MUN. A LA PROPIEDAD</td>
    <td style='text-align:right;'>10,537.00</td>
</tr>
<tr>
    <td>1995</td>
    <td>IMP. MUN. A LA PROPIEDAD</td>
    <td style='text-align:right;'>10,537.00</td>
</tr>
<tr>
    <td>1995</td>
    <td>IMP. MUN. A LA PROPIEDAD</td>
    <td style='text-align:right;'>10,537.00</td>
</tr>
<tr>
    <td></td>
    <td></td>
    <td style='text-align:right;'><b>10,537.00</b></td>
</tr>
<tr>
    <td colspan='3' >
    <div style='width: 99%; height: 3px; border-bottom: #222222 dotted 1px;'></div>
    </td>
</tr>
</table> 






<table style='width: 75mm; margin:0 0 0 3mm; ' cellspacing='0mm' cellpadding='0' >
    <tr>
        <td rowspan='7'><img src='$qrFilePath' alt='QR Code'></td>
    </tr>
    <tr>
        <td style='text-align:right;'><span style='font-size:0.7rem'>TOTAL ADEUDADO: </span><b>449,582.00</b></td>
    </tr>
    <tr>
        <td style='text-align:right;'><span  style='font-size:0.7rem'>OPERADOR: JLOPEZ.RUAT</span></td>
    </tr>
    <tr>
        <td></td>
    </tr> 
    <tr>
        <td></td>
    </tr>
    <tr>
        <td style='text-align:right;'><span  >https://datm.elalto.gob.bo</span></td>
    </tr>
    <tr>
        <td style='text-align:right;'><span  >Whatsapp: </span><b>+591 60103191</b></td>
    </tr>
</table> 
";  

echo $html; 