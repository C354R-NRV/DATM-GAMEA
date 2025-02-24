<!DOCTYPE html>
<html lang="es">
<?php
session_start();
require_once '../vendor/autoload.php';

require_once("../php/conexionpsql.php");
$conn = new Conexion();
$cons = $conn->conectar();

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('../views');
$twig = new Environment($loader);

foreach ($_GET as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
?>

<head>
    <meta charset="utf-8">
    <title>Verificación</title>
    <?php
    echo $twig->render('linkStyle.twig');
    ?>
    <style>
        #hash {
            word-wrap: break-word;
            /* Permite que el texto se ajuste al contenedor y haga saltos de línea si es necesario */
            overflow-wrap: break-word;
            /* Propiedad similar a 'word-wrap' para navegadores más antiguos */
        }
    </style>
</head>

<?php
$hash = $_GET['id'];
$swVerificado = false;

$query = "select  a.id_item_solicitud, TRIM(
        CONCAT_WS(' ', 
            NULLIF(CONCAT(nombre, ' ', COALESCE(apellido_paterno, ''), ' ', COALESCE(apellido_materno, '')), '  '), 
            razon_social
        )
    ) AS nombre_completo,
documento_identidad_numero, 
documento_identidad_complemento,
documento_identidad_extension,
auto_conclusion, 
tipo_respaldo, 
documento_respaldo, 
monto_retencion_bs, 
monto_retencion_ufv , 
tipo_persona,
tipo_proceso,
a.id_cabecera_solicitud,  d.codigo_solicitud, 
to_char(d.fecha_envio, 'DD/MM/YYYY') AS fecha_envio,
e.circular, 
to_char(e.fecha_circular, 'DD/MM/YYYY HH24:MI:SS') AS fecha_circular ,  a.hash_detalle
from srf_item_solicitud a 
left join srf_documento_identidad_extension b on b.id_documento_identidad_extension = a.id_documento_identidad_extension
left join srf_tipo_respaldo c on  c.id_tipo_respaldo = a.id_tipo_respaldo
left join srf_cabecera_solicitud d on d.id_cabecera_solicitud = a.id_cabecera_solicitud
left join srf_estado_envio e on e.id_cabecera_solicitud = a.id_cabecera_solicitud and e.estado_ is true
where a.estado_  is true and  a.hash_detalle = '$id'";
$stmt = $cons->query($query);
$resultados = $stmt->fetch(PDO::FETCH_ASSOC); 

if ($resultados['id_item_solicitud'] > 0) {
    $swVerificado = true;
}
?>

<body>
    <!-- Spinner Start -->
    <?php
    echo $twig->render('load.twig');
    ?>
    <!-- Spinner End -->

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
    <li class="breadcrumb-item"><a class="text-white" href="home.php">Index</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page">Verificación</li>
    <?php
    echo $twig->render('prebodyltFin.twig');
    ?>
    <!-- Hero End --> 


    <?php
    if ($swVerificado) {
    ?>
        <!-- body Start -->
        <div class="container-fluid py-2">
            <div class="container py-2">
                <div class="containerFlex">
                    <div class="rowFlex">
                        <div class="columnFlex">
                            <h2>RESUMEN DE VERIFICACION DE <?php echo ($resultados['tipo_proceso']=='S'?'SUSPENSIÓN':'RETENCIÓN'); ?></h2>
                        </div>
                    </div>
                    <hr>
                    <div class="rowFlex">
                        <div class="columnFlex">
                            <label for="nombre">Nombre completo o razón social:</label>
                            <span id="nombre"><?php echo $resultados['nombre_completo']; ?></span>
                        </div>
                        <div class="columnFlex">
                            <label for="ci">CI/NIT:</label>
                            <span id="ci"><?php echo $resultados['documento_identidad_numero']; ?></span>
                        </div>
                    </div>
                    <div class="rowFlex">
                        <div class="columnFlex">
                            <label for="direccion">Auto de conclusión:</label>
                            <span id="direccion"><?php echo $resultados['auto_conclusion']; ?></span>
                        </div>
                        <div class="columnFlex">
                            <label for="actividad">Documento de Respaldo:</label>
                            <span id="actividad"><?php echo $resultados['documento_respaldo']; ?></span>
                        </div>
                    </div>
                    <div class="rowFlex">
                        <div class="columnFlex">
                            <label for="direccion">No. Circular:</label>
                            <span id="direccion"><?php echo $resultados['circular']; ?></span>
                        </div>
                        <div class="columnFlex">
                            <label for="fecha">Fecha y hora de circular:</label>
                            <span id="fecha"><?php echo $resultados['fecha_circular']; ?></span>
                        </div>
                    </div> 
                    <div class="rowFlex">
                        <div class="columnFlex">
                            <label for="hash">HASH: </label>
                            <span id="hash">
                                <?php echo $resultados['hash_detalle']; ?>
                            </span>
                        </div>
                    </div>
                    <div class="rowFlex">
                        <div class="columnFlex" style="text-align: center;">
                            <h5 style="color:green;width:100%;">INFORMACIÓN VALIDADA EN SERVIDOR</h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- body End -->
        <?php
    } else {
        ?>
            <div class="container-fluid py-2">
                <div class="container py-2">
                    <div class="containerFlex">
                        <div class="rowFlex">
                            <div class="columnFlex">
                                <h2>VERIFICACIÓN DE INFORMACIÓN</h2>
                            </div>
                        </div>
                        <hr>
                        <div style="text-align:center;width:100%;">
                            <h5 style="color:RED;">EL CODIGO DE CONTROL ENCRIPTADO NO FUE ENCONTRADO EN EL SERVIDOR<br><br><b>CODIGO QR DE VERIFICACIÓN NO VÁLIDO</b></h5>
                        </div>
                        <hr>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br> 
                    </div>
                </div>
            </div>
        <?php
    }
        ?>

        <!-- Footer Start -->
        <?php
        echo $twig->render('footer.twig');
        ?>
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="index.php#" class="btn btn-lg btn-primary btn-lg-square back-to-top pt-2"><i class="fa fa-sort-asc"></i></a>


        <!-- JavaScript Libraries -->
        <?php
        echo $twig->render('linkJs.twig');
        ?>
</body>

</html>