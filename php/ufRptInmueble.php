<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;

require_once("conexionpsql.php");
require_once("getInfoUnivRpt.php");

$conn = new Conexion();
$cons = $conn->conectar();

if (!$_SESSION['swlogin']) {
    header('Location: index.php');
    exit;
}

// Verificar que se recibió el ID del inmueble
if (!isset($_GET['j']) || empty($_GET['j'])) {
    die('Error: ID de inmueble no proporcionado');
}

$numero_inmueble = $_GET['j'];

// Consultar datos del inmueble (tu query original)
$query = "select 
        a.id,
        x.detalle ,x.idprepredial, 
        b.grupo, 
        d.operativo, 
        c.usuario,
            a.nombre_razon, 
            a.nombre_apoderado, 
            trim(a.ubicacion_nivel1||' '||a.ubicacion_nivel2 ||' '||a.ubicacion_nivel3 ||' '||a.descripcion||' #'||a.no_puerta) as direccion, 
            a.codigo_catastral,  
            a.no_formulario, 
            a.via as dato_tecnico_via, 
            CASE 
            WHEN ( 
            SELECT string_agg(s.servicio, ', ')  
            FROM uf_predrial_servicio ps 
            JOIN uf_servicios s ON ps.idservicio = s.idservicio 
            WHERE ps.idpredial = a.id 
            ) IN ( 
            'LUZ, AGUA, ALCANTARILLADO, GAS, TELEFONO', 
            'TODOS, LUZ, AGUA, ALCANTARILLADO, GAS, TELEFONO' 
            )
            THEN 'TODOS'
            ELSE (
            SELECT string_agg(s.servicio, ', ') 
            FROM uf_predrial_servicio ps
            JOIN uf_servicios s ON ps.idservicio = s.idservicio
            WHERE ps.idpredial = a.id
            )
        END AS dato_tecnico_servicio,
            a.tipologia as dato_tecnico_tipologia,
            a.no_plantas as construccion_plantas,
            a.no_concluidos as construccion_concluidas,
            a.no_brutos as construccion_construccion,
            'https://datm.elalto.gob.bo/pages/ufPredialList.php?i='||a.numero_inmueble as enlace,
            a.numero_inmueble,
            a.descripcion,
            a.cant_act,
            a.descripcion_act,
            a.hhrr,
            to_char( a.fecha_apersonamiento, 'DD/MM/YYYY') AS fecha_apersonamiento ,
            a.imagen_principal||','||a.imagen_adicional as fotos,
            a.latitud, a.longitud
        from uf_predial a 
        LEFT JOIN uf_prepredial x ON x.idpredial_asociado = a.id 
        left join uf_operativo d on d.idoperativo = x.idoperativo
        left join uf_grupo_operativo b on a.idusuario = b.idusuario and d.idoperativo = b.idoperativo  
        left join datm_usuario c on c.id = a.idusuario
        where a.estado_ = true
        and a.id = $numero_inmueble
        order by id desc
        limit 1;";

$stmt = $cons->query($query);
$inmueble = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$inmueble) {
    die('Error: No se encontró el inmueble especificado');
}

$fotos = $inmueble['fotos'] ? explode(',', $inmueble['fotos']) : [];

// Generar HTML para el PDF
$html = generatePDFHTML($inmueble, $fotos);

try {
    // Configurar Html2Pdf con configuraciones específicas para imágenes
    $html2pdf = new Html2Pdf('P', 'LETTER', 'es', true, 'UTF-8', array(15, 15, 15, 15));

    // Configuraciones importantes para el manejo de imágenes
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->setTestTdInOnePage(false);
    $html2pdf->setTestIsImage(false);

    // Escribir el HTML
    $html2pdf->writeHTML($html);

    // Generar nombre del archivo
    $filename = 'Reporte_Inmueble_' . $inmueble['numero_inmueble'] . '_' . date('Y-m-d_H-i-s') . '.pdf';

    // Enviar PDF al navegador
    $html2pdf->output($filename, 'I');
} catch (Html2PdfException $e) {
    echo 'Error al generar PDF: ' . $e->getMessage();
    exit;
}

function generatePDFHTML($inmueble, $fotos)
{
    $numero_inmueble = htmlspecialchars($inmueble['numero_inmueble']);
    $direccion = htmlspecialchars($inmueble['direccion']);
    $propietario = htmlspecialchars($inmueble['nombre_razon']);
    $codigo_catastral = htmlspecialchars($inmueble['codigo_catastral']);
    $tipologia = htmlspecialchars($inmueble['dato_tecnico_tipologia']);
    $servicio = htmlspecialchars($inmueble['dato_tecnico_servicio']);
    $fecha_apersonamiento = htmlspecialchars($inmueble['fecha_apersonamiento']);
    $usuario = htmlspecialchars($inmueble['usuario']);

    $html = '
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        .header h1 {
            color: #333;
            margin: 0;
            font-size: 18px;
        }
        .info-section {
            margin-bottom: 10px;
            background-color: #f8f9fa;
            padding: 5px;
            border-radius: 5px;
        }
        .info-row {
            margin-bottom: 8px;
            display: block;
            clear: both;
        }
        .info-label {
            font-weight: bold;
            width: 150px;
            color: #333;
            float: left;
        }
        .info-value {
            margin-left: 160px;
        }
        .photos-section {
            margin-top: 10px;
            page-break-inside: avoid;
        }
        .photos-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            /* text-align: center; */
            color: #333;
        }
        .photo-container {
            /* text-align: center; */
            margin-bottom: 20px;
            page-break-inside: avoid;
        }
        .photo-single {
            max-width: 650px;
            max-height: 550px;
            width: auto;
            height: auto;
            border: 2px solid #ddd;
            border-radius: 8px;
            
        }
        .photo-multiple {
            max-width: 350px;
            max-height: 450px;
            width: auto;
            height: auto;
            border: 2px solid #ddd;
            border-radius: 8px;
            margin: 0 5px;
        }
        .photo-label {
            font-weight: bold;
            margin-top: 10px;
            color: #666;
            font-size: 11px;
        }
        .footer {
            position: fixed;
            bottom: 15px;
            right: 15px;
            font-size: 10px;
            color: #666;
        }
        .no-photos {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 40px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
    </style>
    
    <div class="header">
        <h1>REPORTE DE INMUEBLE</h1>
        <p>Dirección de Administración Tributaria Municipal - El Alto</p>
    </div>
    
    <div class="info-section">
        <div class="info-row">
            <span class="info-label">NÚMERO DE INMUEBLE:</span>
            <span  >' . $numero_inmueble . '</span>
        </div>
        <div class="info-row">
            <span class="info-label">DIRECCIÓN:</span>
            <span  >' . $direccion . '</span>
        </div>
        <div class="info-row">
            <span class="info-label">PROPIETARIO:</span>
            <span  >' . $propietario . '</span>
        </div>
        <div class="info-row">
            <span class="info-label">CÓDIGO CATASTRAL:</span>
            <span  >' . $codigo_catastral . '</span>
        </div>
        <div class="info-row">
            <span class="info-label">TIPOLOGÍA:</span>
            <span  >' . $tipologia . '</span>
        </div>
        <div class="info-row">
            <span class="info-label">SERVICIOS:</span>
            <span  >' . $servicio . '</span>
        </div>
        <div class="info-row">
            <span class="info-label">FECHA APERSONAMIENTO:</span>
            <span >' . $fecha_apersonamiento . '</span>
        </div>
        <div class="info-row">
            <span class="info-label">USUARIO:</span>
            <span  >' . $usuario . '</span>
        </div>
    </div>
    <hr>
    <div class="photos-section">
        <div class="photos-title">FOTOGRAFÍAS DEL INMUEBLE</div>';
$log = '___';
    if (empty($fotos) || (count($fotos) == 1 && empty($fotos[0]))) {
        $html .= '<div class="no-photos">No hay fotografías disponibles para este inmueble</div>';
    } else {
        $validPhotos = [];

        // Validar y procesar fotos con mejor manejo de errores
        foreach ($fotos as $foto) {
            $log .= '$foto:'.$foto;
            if (!empty($foto) and $foto != '') {
                $imagePath = '../static/ufpredial/' . trim($foto);

                // Verificar que el archivo existe y es legible
                if (file_exists($imagePath) && is_readable($imagePath)) {
                    // Verificar que es una imagen válida
                    $imageInfo = @getimagesize($imagePath);
                    if ($imageInfo !== false) {
                        $validPhotos[] = [
                            'path' => $imagePath,
                            'filename' => $foto,
                            'mime' => $imageInfo['mime']
                        ];
                    }
                }
            }
        }

        if (empty($validPhotos)) {
            $html .= '<div class="no-photos">No se encontraron fotografías válidas para este inmueble</div>';
        } else {
            $photoCount = count($validPhotos);
            $log .= '$photoCount:'.$photoCount;
            if ($photoCount === 1) { 
                $log .= '$UNA SOLA FOTO$';
                $photo = $validPhotos[0];
                $imageData = @file_get_contents($photo['path']);

                if ($imageData !== false) {
                    $base64 = base64_encode($imageData);
                    $html .= '
                    <div style="text-align:center;">
                        <img src="data:' . $photo['mime'] . ';base64,' . $base64 . '" class="photo-single" alt="Fotografía del inmueble">
                        </div> ';
                }
            } else {
                // Múltiples fotos
                $photoIndex = 1;
                for ($i = 0; $i < count($validPhotos); $i += 2) {
                    $html .= '<div style="text-align:center;">';

                    // Primera foto del par
                    $photo1 = $validPhotos[$i];
                    $imageData1 = @file_get_contents($photo1['path']);

                    if ($imageData1 !== false) {
                        $base64_1 = base64_encode($imageData1);
                        $html .= '<img src="data:' . $photo1['mime'] . ';base64,' . $base64_1 . '" class="photo-multiple" alt="Fotografía ' . $photoIndex . '">';
                    }

                    // Segunda foto del par (si existe)
                    if (isset($validPhotos[$i + 1])) {
                        $photo2 = $validPhotos[$i + 1];
                        $imageData2 = @file_get_contents($photo2['path']);

                        if ($imageData2 !== false) {
                            $base64_2 = base64_encode($imageData2);
                            $html .= '<img src="data:' . $photo2['mime'] . ';base64,' . $base64_2 . '" class="photo-multiple" alt="Fotografía ' . ($photoIndex + 1) . '">';
                        }
                    }

                    $html .= ' </div>';
                }
            }
        }
    }

    $html .= '
    </div>
    <br>
    <div class="footer">
        Generado el ' . date('d/m/Y H:i:s') . ' por ' . $_SESSION['usuario'] . ' 
    </div>';

    return $html;
}
