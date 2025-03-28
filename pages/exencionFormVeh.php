<!DOCTYPE html>
<?php
session_start();
require_once '../vendor/autoload.php';
require_once '../php/conexionpsql.php';

/**
agreegar como tool tips

Para la habilitación de proforma de liquidación, en caso de que no se genere o visualice en RUAT, será necesario que el contribuyente se apersone a oficinas de la DATM, unidad de ingresos.

Con que documento, decreto o ley fue credo la institución publica. 


NIT  --> corresponde en todos los casos.

FOTOCOIPIOA DE L ci DE Maxima Autoridad Ejecutiva.

 */


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
    <title>Exencion Form</title>
    <?php
    echo $twig->render('linkStyle.twig');
    ?>
    <link href="../css/styleRecursoIa.css" rel="stylesheet">
    <link href="../css/styleExencion.css" rel="stylesheet">
    <link href="../vendor/bootstrap-table-master/dist/bootstrap-table.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .oculto_ {
            display: none;
        }

        .btn-flotante {
            position: fixed;
            top: 40%;
            right: 20px;
            transform: translateY(-80%);
            z-index: 1000;
        }

        .btn-flotante button {
            border-radius: 20%;
            padding: 10px;
            font-size: 18px;
            cursor: pointer;
        }

        /* .form-trash {
            border-radius: 20%;
            padding: 10px;
            font-size: 18px;
            cursor: pointer;
        } */

        .input-group {
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        #refreshButton {
            margin-left: 5px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            cursor: pointer;
        }

        #refreshButton i {
            font-size: 18px;
            color: #007bff;
        }

        #refreshButton:hover i {
            color: #0056b3;
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
    ?>
    <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
    <li class="breadcrumb-item"><a class="text-white">UAJ</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page"><a class="text-white" href="exencionList.php">EXENCION</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page">FORMULARIO</li>

    <?php
    echo $twig->render('prebodyltFin.twig');
    ?>
    <!-- Hero End -->

    <!-- About Start -->
    <div class="btn-flotante">
        <button id="btn-guardar" class="btn btn-primary" onclick="guardar()">
            <i class="fa fa-floppy-o"></i>
        </button>
    </div>
    <div class="contenedorDigitaliza">
        <div class="row exencionCabecera">
            <div class="col-md-3 mb-3">
                <label for="codigoSolicitud">Gestión para exención</label>
                <input id="gestionIni" class='form-control' disabled value="<?php $gestionActual = date('Y');
                                                                            echo ($gestionActual - 1); ?>" />
            </div>
            <div class="col-md-6 mb-6">
                <label for="nro_pta">Nro. placa</label>
                <select id="nro_pta" multiple class="js-example-basic-multiple">
                    <option value="TODOS">TODOS</option>
                    <?php
                    $query = "SELECT nro_pta 
                                FROM vehiculo_univ          
                                WHERE documento_identidad = '" . $_SESSION['cedula_identidad'] . "' order by nro_pta desc;";
                    /* echo $query; */
                    $stmt = $cons->query($query);
                    $extension = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($extension as $row) {
                        echo  "<option value=" . $row['nro_pta'] . ">" . $row['nro_pta'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3 mb-3">

            </div>
        </div>

        <?php
        $query = "SELECT c.idrequisito, c.detalle,  c.anotacion, c.obligatorio
            from  exc_requisito c  
            where c.estado_ is true 
            and c.idrubro = 1
            order by c.orden ";

        $stmt = $cons->query($query);
        $requisito = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $cnt = 1;
        $html = '';
        foreach ($requisito as $key => $value) {
            $html .= "<div class='row exencionRequisito'>
                <div class='col-md-4 mb-4'>
                    <h1>" . $value['detalle'] . ($value['obligatorio'] ? '<span style="color:#7e2d05;  ">*</span>' : '') . "</h1>                        
                        <p>" . $value['anotacion']
                . ($value['idrequisito'] == '1' ? "<a onclick='generarSolicitud()' title='Generar solicitud' role='button'><i class='fa fa-file-text-o' aria-hidden='true'></i></a>" : "")
                . "</p>
                        <input type='hidden' class='idrequisito' value='" . $value['idrequisito'] . "'/>
                        <input type='hidden' class='resquisitoObligatorio' value='" . $value['obligatorio'] . "'/>
                </div>
                <div class='col-md-4 mb-4'>
                    <div class='containerUpload'>
                        <div class='drop-section drop-section$cnt'>
                            <div class='colFormUpload'>
                                <i class='fa fa-cloud-upload' aria-hidden='true' style='font-size: 2rem;padding-top:1vh ;'></i>
                                <button class='file-selector file-selector$cnt'>Adjuntar PDF</button>
                                <input type='file' class='file-selector-input file-selector-input$cnt' multiple />
                            </div>
                            <div class='colFormUpload'>
                                <div class='drop-here sueltaAqui'>Suelta aqui</div>
                            </div>
                        </div>
                        <div class='list-section list-section$cnt'>
                            <div class='list listaReq$cnt'></div>
                        </div>
                    </div>
                </div>
            </div>";
            $cnt++;
        }
        echo $html;
        ?>
    </div>

    <!-- About End -->
    <!-- JavaScript Libraries -->
    <?php
    echo $twig->render('linkJs.twig');
    ?>
    <!-- Template Javascript -->
</body>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {

        $('.js-example-basic-multiple').select2({
            placeholder: "Selecciona placas",
            allowClear: true
        });

        $('.js-example-basic-multiple').select2({
            width: '100%', // Expande al ancho completo del contenedor
            placeholder: "Selecciona placas",
            allowClear: true
        });

        for (let index = 1; index < 9; index++) {
            let dropArea = document.querySelector(".drop-section" + index);
            let fileSelector = document.querySelector(".file-selector" + index);
            let fileSelectorInput = document.querySelector(".file-selector-input" + index);

            fileSelector.onclick = () => fileSelectorInput.click();
            fileSelectorInput.onchange = () => {
                [...fileSelectorInput.files].forEach((file) => {
                    if (typeValidation(file.type)) {
                        uploadFile(index, file);
                    }
                });
            };

            dropArea.ondragover = (e) => {
                e.preventDefault();
                [...e.dataTransfer.items].forEach((item) => {
                    if (typeValidation(item.type)) {
                        dropArea.classList.add("drag-over-effect");
                    }
                });
            };
            dropArea.ondragleave = () => {
                dropArea.classList.remove("drag-over-effect");
            };

            dropArea.ondrop = (e) => {
                e.preventDefault();
                dropArea.classList.remove("drag-over-effect");
                if (e.dataTransfer.items) {
                    [...e.dataTransfer.items].forEach((item) => {
                        if (item.kind === "file") {
                            const file = item.getAsFile();
                            if (typeValidation(file.type)) {
                                uploadFile(index, file);
                            }
                        }
                    });
                } else {
                    [...e.dataTransfer.files].forEach((file) => {
                        if (typeValidation(file.type)) {
                            uploadFile(file);
                        }
                    });
                }
            };

            $(".listaReq" + index).on("click", ".eliminarDoc", function(e) {
                e.preventDefault(); // Evita que el enlace navegue
                $(this).closest("li").remove(); // Elimina el elemento li más cercano
            });
            $(".listaReq" + index).on("click", ".verDoc", function(e) {
                e.preventDefault();
                let rutaArchivo = $(this).closest("li").find(".pathDoc").val().trim();
                // Muestra el resultado en la consola o úsalo como necesites
                console.log("Archivo seleccionado:", rutaArchivo);
                verDocPopup(rutaArchivo);
            });
        }
    });

    function typeValidation(type) {
        var splitType = type.split("/")[0];
        if (type == "application/pdf") {
            return true;
        }
    }

    // upload file function
    var contadorArchivos = 0;
    var contadorArchivosAux = 0;

    function uploadFile(index = 0, file) {

        let listSection = document.querySelector(".list-section" + index);
        let listContainer = document.querySelector(".listaReq" + index);

        listSection.style.display = "block";
        var li = document.createElement("li");
        li.classList.add("in-prog");
        li.innerHTML = `
            <div class="colFormUpload">
                <img src="../img/${iconSelector(file.type)}" alt="">
            </div>
            <div class="colFormUpload">
                <div class="file-name">
                    <div class="name">${file.name}</div> 
                    <span>0%</span>
                </div>
                <div class="file-progress">
                    <span></span>
                </div>
                <div class="file-size">${(file.size / (1024 * 1024)).toFixed(2)} MB</div>
            </div>
            <div class="colFormUpload">
                <svg xmlns="http://www.w3.org/2000/svg" class="cross" height="20" width="20"><path d="m5.979 14.917-.854-.896 4-4.021-4-4.062.854-.896 4.042 4.062 4-4.062.854.896-4 4.062 4 4.021-.854.896-4-4.063Z"/></svg>
            </div> 
            <div class="colFormUpload">
                <a class="btn verDoc" href="#"><i class="fa fa-eye" aria-hidden="true" style="color:#3d7915; font-size:1.2rem;"></i></a>
                <a class="btn eliminarDoc" href="#"><i class="fa fa-trash-o" aria-hidden="true" style="color:#bf0404; font-size:1.2rem;"></i></a>
            </div> 
        `;
        listContainer.prepend(li);
        var http = new XMLHttpRequest();
        var data = new FormData();
        data.append("file", file);
        data.append("noRequisito", index);
        http.onload = () => {

            if (http.status === 200) {

                li.classList.add("complete");
                li.classList.add("documento" + contadorArchivos);
                li.classList.remove("in-prog");
                contadorArchivos++;

                let respuesta = JSON.parse(http.responseText);
                let ruta = String(respuesta.ruta);
                let nombreArchivo = String(respuesta.nombreArchivo);

                let input = $('<input>', {
                    type: 'hidden',
                    class: 'pathDoc',
                    value: ruta
                });
                let input2 = $('<input>', {
                    type: 'hidden',
                    class: 'nomDoc',
                    value: nombreArchivo
                });

                $(li).append(input);
                $(li).append(input2);

            }

        };
        http.upload.onprogress = (e) => {
            var percent_complete = (e.loaded / e.total) * 100;
            li.querySelectorAll("span")[0].innerHTML =
                Math.round(percent_complete) + "%";
            li.querySelectorAll("span")[1].style.width = percent_complete + "%";
        };


        http.open("POST", "sender.php", true);
        http.send(data);
        li.querySelector(".cross").onclick = () => http.abort();
        http.onabort = () => li.remove();
        contadorArchivosAux++;
    }

    function guardar() { 

        var datos = {
            gestion: $('#gestionIni').val(),
            nro_pta: $('#nro_pta').val(),
            documentos: {},
            cntItem: 0
        }
        console.log(datos);
        var html = `
        <h3 style="color:black;">Gestión solicitada: <b>${$('#gestionIni').val()}</b></h3>
        <h4 style="color:black;">Nro. Placa: ${$('#nro_pta').val()}</h4>
                    <table class="striped-table">
                    <thead>
                        <tr>
                            <th>Requisito</th>
                            <th>Codigo de documento generado</th>
                            <th>Visualizar</th>
                        </tr>
                    </thead>`;
        let cntItem = 0;

        let errores = [];
        $('div[class^="list"]').each(function() {
            const listClass = $(this).attr("class").match(/listaReq\d+/)
            if (listClass) {
                const h1Content = $(this).closest('.exencionRequisito').find('h1').text();
                const resquisitoObligatorio = $(this).closest('.exencionRequisito').find('.resquisitoObligatorio').val();
                const idrequisito = $(this).closest('.exencionRequisito').find('.idrequisito').val();
                const listKey = listClass[0];

                // Use each() to iterate through each input.nomDoc
                $(this).find("input.nomDoc").each(function(index) {
                    // Get the corresponding pathDoc for this nomDoc (at the same index)
                    const pathDoc = $("." + listKey).find("input.pathDoc").eq(index).val();

                    // Get the document name
                    const docName = $(this).val();
                    console.log("docName:" + docName);
                    // Append the HTML for this document
                    html += `<tr>
                                <td>${h1Content}</td>
                                <td>${docName}</td>
                                <td>
                                    <a class="btn verDoc" onclick="verDocPopup('${pathDoc}')">
                                        <i class="fa fa-eye" aria-hidden="true" style="color:#3d7915; font-size:1.2rem;"></i>
                                    </a>
                                </td>
                            </tr>`;
                });

                const docNames = $(this).find("input.nomDoc").map(function() {
                    /* html += `<tr><td>${h1Content}</td><td>${$(this).val()}</td><td>
                                                    <a class="btn verDoc" onclick="verDocPopup('${$("."+listKey).find("input.pathDoc").val()}')">
                                                        <i class="fa fa-eye" aria-hidden="true" style="color:#3d7915; font-size:1.2rem;"></i>
                                                    </a></td></tr>`; */
                    return $(this).val()
                }).get();
                datos.documentos[listKey] = docNames;

                console.log("docNames:" + docNames);
                if (docNames == '' && resquisitoObligatorio == '1') {
                    errores.push(" - No se ha agregado ningún documento PDF para el requisito: <b>" + h1Content + "</b>");
                }

                cntItem++;
            }
        });
        html += '</table>';
        datos.cntItem = cntItem;

        if (errores.length > 0) {
            $.confirm({
                title: "Se encontraron errores",
                columnClass: "col-md-8 col-md-offset-8 col-xs-8 col-xs-offset-8",
                content: errores.join('</br>'),
                type: "red",
                buttons: {
                    ok: {
                        text: "Aceptar",
                        action: function() {}
                    }
                }
            });
            return false;
        } else {
            $.confirm({
                title: "Revision de documentos previo envio",
                type: "green",
                content: html,
                columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
                buttons: {
                    confirmar: {
                        text: "Confirmar",
                        btnClass: "btn-green",
                        action: function() {
                            $.ajax({
                                async: true,
                                type: "POST",
                                dataType: "html",
                                contentType: 'application/json',
                                url: "../php/exencionSaveVeh.php",
                                data: JSON.stringify(datos),
                                beforeSend: function() {
                                    loadGralOn();
                                },
                                success: function(e) {
                                    console.log(e);
                                    loadGralOff();
                                    dat = JSON.parse(e);
                                    toastr[dat.err == '0' ? 'success' : 'warning'](dat.log, "Respuesta de servidor");
                                    if (dat.err == '0') {
                                        enviarDocumentosExencion(dat.codigo_solicitud);
                                    }
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
                                    loadGralOff();
                                    $.confirm({
                                        title: "Error",
                                        content: "Hubo un problema al conectar con el servidor. Por favor, intenta de nuevo más tarde.",
                                        type: "red",
                                        buttons: {
                                            ok: {
                                                text: "Aceptar",
                                                action: function() {
                                                    window.location.href = './exencionList.php';
                                                }
                                            }
                                        }
                                    });
                                },
                                timeout: 16000
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
    }

    function generarSolicitud() {
        datos =
            "&nro_pta=" + $('#nro_pta').val() + "&gestionIni_=" + $('#gestionIni').val() + "&gestionFin_=" + $('#gestionFin').val();

        var url_ = "../php/rptveh_11_v2.php?" + datos;
        console.log("url_:"+url_);
        $.ajax({
            url: url_,
            type: 'HEAD',
            success: function() {
                window.open(url_, "_blank");
            },
            error: function() {
                $.confirm({
                    title: "Documento no encontrado!",
                    type: "red",
                    content: "No se ha logrado encontrar el documento solicitado, estamos trabajando en la actualización del recurso.",
                    buttons: {
                        cancel: {
                            text: "Cerrar",
                            action: function() {},
                        },
                    },
                });
            }
        });
    }

    function iconSelector(type) {
        var splitType =
            type.split("/")[0] == "application" ?
            type.split("/")[1] :
            type.split("/")[0];
        return splitType + ".png";
    }
</script>

</html>