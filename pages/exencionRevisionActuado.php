<!DOCTYPE html>
<?php
session_start();
require_once '../vendor/autoload.php';
require_once '../php/conexionpsql.php';

$conn = new Conexion();
$cons = $conn->conectar();

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
    <title>EXC. REVISION</title>
    <?php
    echo $twig->render('linkStyle.twig');
    ?>
    <link href="../css/styleRecursoIa.css" rel="stylesheet">
    <style>
        #obs-panel {
            padding: 0 2rem 0 2rem;
        }
    </style>
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
    $query = "select  a.documento_path, a.observacion,  to_char(a.fecha_registro, 'DD/MM/YYYY') AS  fecha_registro , 
                    d.codigo_solicitud, c.detalle, e.usuario, a.iditem_act, b.idcabecera, d.idestado, 
                    f.documento_path as documento_path_ant, g.usuario  as usuario_ant, b.idactuado
                    from exc_item_actuado  a 
                    left join exc_actuado b on a.idactuado = b.idactuado 
                    left join exc_requisito c on c.idrequisito = a.idrequisito
                    left join exc_cabecera d on d.idcabecera = b.idcabecera
                    left join datm_usuario e on a.idusuario = e.id
                    left join exc_item_actuado f on f.iditem_act = a.iditem_actuado_ant
                    left join datm_usuario g on f.idusuario = g.id
                    where a.estado_ is true
                    and a.iditem_act = " . $_GET['j'];

    $stmt = $cons->query($query);
    $actuado = $stmt->fetch(PDO::FETCH_ASSOC);

    ?>
    <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
    <li class="breadcrumb-item"><a class="text-white">UAJ</a></li>
    <li class="breadcrumb-item"><a class="text-white" href="exencionList.php">EXENCION</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page"> <a class="text-white" href="exencionRevisionSolicitud.php?j=<?php echo $actuado['idcabecera']; ?>&i=<?php echo $actuado['codigo_solicitud']; ?>&x=<?php echo $actuado['idactuado']; ?>">REVISION SOLICITUD</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page"> <a class="text-white">ACTUADO</a></li>
    <?php
    echo $twig->render('prebodyltFin.twig');
    ?>
    <!-- Hero End -->

    <!-- About Start -->
    <div class="contenedorDigitaliza">
        <div class="row position-relative">
            <div class="col-8" id="main-content">
                <div class="show-btn" onclick="toggleObsPanel()"><span id="contenBtn"><img class="img-fluid" src="../img/ia.gif" style="height: 2rem;" alt=""></span></div>
                <div class="main-content-container">


                    <h1 id="tituloh1" class="">Revisión de solicitud><?php echo $actuado['codigo_solicitud'] . '>' . $actuado['detalle']; ?>></h1>
                    <div class="form-group">

                        <iframe src="pdfjs/web/viewer.html?file=<?php echo "../../../static/exencion/" . $actuado['usuario_ant'] . "/" . $actuado['documento_path_ant']; ?>"
                            width="100%"
                            height="780px"
                            style="border: none;"></iframe>
                    </div>
                </div>
            </div>
            <div class="col-4 hidden" id="obs-panel">
                <div class="d-flex justify-content-end">
                    <span class="toggle-btn"></span>
                </div>
                <div class="chat-container border p-3 mt-3">
                    <textarea type="text" id="observacion" class="form-control" rows="22"></textarea>
                </div>
                <div class="position-relative w-100 mt-3 mb-2">
                    <input type="file" id="formFilePdf" class="form-control" placeholder="Cargar documento" />
                    <input type="hidden" id="iditem_act" value="<?php echo $actuado['iditem_act'] ?>" />
                    <input type="hidden" id="idcabecera" value="<?php echo $actuado['idcabecera'] ?>" />
                    <input type="hidden" id="usuario" value="<?php echo $actuado['usuario'] ?>" />
                    <input type="hidden" id="idestado" value="<?php echo $actuado['idestado'] ?>" />
                    <input type="hidden" id="documento_path" value="<?php echo $actuado['documento_path_ant'] ?>" />
                    <input type="hidden" id="idactuado" value="<?php echo $actuado['idactuado'] ?>" />
                    <input type="hidden" id="codigo" value="<?php echo $_GET['i'] ?>" />
                </div>
                <div class="position-relative w-100 mt-3 mb-2">
                    <button type="button" onclick="guardar('COBS')" class="btn btn-danger  ">GUARDAR CON OBSERVACIÓN</button>
                </div>
                <div class="position-relative w-100 mt-3 mb-2">
                    <button type="button" onclick="guardar('SOBS')" class="btn btn-success   ">GUARDAR SIN OBSERVACIÓN</button>
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
<script>
    function toggleObsPanel() {
        const $tituloh1 = $('#tituloh1');
        const $infoPanel = $('#obs-panel');
        const $mainContent = $('#main-content');
        const $showBtn = $('#show-btn');

        if ($infoPanel.hasClass('hidden')) {
            $('#contenBtn').html(' >> ');
            $tituloh1.addClass('hidden');
            $infoPanel.removeClass('hidden');
            $mainContent.removeClass('col-12').addClass('col-8');

        } else {
            $('#contenBtn').html(' <img class="img-fluid" src="../img/ia.gif" style="height: 2rem;" alt=""> ');
            $tituloh1.removeClass('hidden');
            $infoPanel.addClass('hidden');
            $mainContent.removeClass('col-8').addClass('col-12');
            $showBtn.addClass('hidden');
        }
    }

    function guardar(modo) {

        var color = (modo == 'COBS'?'red':'green');

        $.confirm({
            title: "Confirmación de guardado",
            type: color,
            content: "Confirme el registro <b>"+(modo=='COBS'?"CON</b> OBSERVACIÓN":"SIN</b> OBSERVACIÓN")+" de la solictud: <b>" + $('#idcabecera').val() + "</b>, con código de solicitud: <b>" + $('#codigo').val() + "</b>",
            columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
            buttons: {
                confirmar: {
                    text: "Confirmar",
                    btnClass: "btn-"+color,
                    action: function() { 

                        var formData = new FormData();
                        var fileInput = $('#formFilePdf')[0];
                        formData.append('archivoPdf', fileInput.files[0]);
                        formData.append('iditem_act', $('#iditem_act').val());
                        formData.append('idcabecera', $('#idcabecera').val());
                        formData.append('idactuado', $('#idactuado').val());
                        formData.append('usuario', $('#usuario').val());
                        formData.append('idestado', $('#idestado').val());
                        if (modo == 'COBS') {
                            formData.append('observacion', $('#observacion').val());
                            formData.append('documento_path', $('#documento_path').val());
                        } else {
                            formData.append('observacion', '');
                            formData.append('documento_path', '');
                        }

                        $.ajax({
                            async: true,
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            url: '../php/exencionSaveRevisionActuadoItem.php',
                            beforeSend: function() {
                                loadGralOn(); 
                            }, 
                            success: function(dat) {
                                loadGralOff();
                                //AGREAGAR NOTIFICACION DE GUARDADO CORRECTO 
                                console.log(dat);
                                dat = $.parseJSON(dat);
                                if (dat.err == '0') {
                                    console.log("cargando en localStorage:" + dat.log);
                                    localStorage.setItem('toastrMessage', dat.log);
                                    localStorage.setItem('toastrTitle', "Registro guardado correctamente");
                                    url_ = "exencionRevisionSolicitud.php?j=" + $('#idcabecera').val() + "&i=" + $('#codigo').val() + "&x=" + $('#idactuado').val();
                                    //console.log(url_);
                                    window.location.href = url_;

                                } else {
                                    toastr["error"]("Ocurrio un error.", dat.log);
                                }
                            },
                            timeout: 16000,
                            error: function(xhr, status, error) {
                                toastr["error"]("Ocurrio algun error.", 'Error: ' + error);
                            }
                        });

                    }
                },
                cancel: {
                    text: "Cancelar",
                    action: function() {}
                }
            }
        });
    }
</script>

</html>