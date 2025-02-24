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
    <title>Exencion Form</title>
    <?php
    echo $twig->render('linkStyle.twig');
    ?>
    <link href="../css/styleRecursoIa.css" rel="stylesheet">
    <link href="../css/styleExencion.css" rel="stylesheet">
    <link href="../vendor/bootstrap-table-master/dist/bootstrap-table.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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



        .token-container {
            max-width: 400px;
            margin: 20px auto;
            border: 2px solid #1d97b1;
            border-radius: 25px;
            padding: 5px;
            text-align: center;
        }

        .token-title {
            color: #17798e;
            font-size: 1.25rem;
            font-family: Arial, sans-serif;
        }

        .token-input {
            width: 100%;
            font-size: 3rem;
            text-align: center;
            border: none;
            background: transparent;
            font-family: Arial, sans-serif;
            font-weight: 500;
            padding: 10px 0;
            box-sizing: border-box;
        }

        /* Remover flechas del input number */
        .token-input::-webkit-outer-spin-button,
        .token-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .token-input[type=number] {
            -moz-appearance: textfield;
        }

        /* Remover el outline al hacer focus */
        .token-input:focus {
            outline: none;
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
    <li class="breadcrumb-item text-white active" aria-current="page"><a class="text-white" href="sirefoList.php">EXENCION</a></li>
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
            <div class="col-md-4 mb-4">
                <label for="codigoSolicitud">Gestión a solicitar</label>

                <?php
                $gestionActual = date('Y'); // Puedes cambiar esto para que sea dinámico con date("Y")

                $html = "<select id='gestion' class='form-controlSelect'>";

                for ($i = $gestionActual; $i >= ($gestionActual - 10); $i--) {
                    $html .= "<option value='$i'>$i</option>";
                }

                $html .= "</select>";

                echo $html;
                ?>

            </div>
            <div class="col-md-4 mb-4">
                <label for="tipoProceso">Nro. placa</label>
                <?php
                $swR = '';
                $swS = 'selected';
                if (isset($_GET['tp']) && $_GET['tp'] == 'R') {
                    $swR = 'selected';
                    $swS = '';
                }
                ?>
                <select class="form-controlSelect" id="tipoProceso">
                    <option value="R" <?php echo $swR; ?>>Retención</option>
                    <option value="S" <?php echo $swS; ?>>Suspención</option>
                </select>
            </div>
            <div class="col-md-4 mb-4">

            </div>
        </div>

        <div class="row exencionRequisito">
            <div class="col-md-4 mb-4">
                <h1>Nota de solicitud</h1><br>Generar solicitud -> <a onclick="generarSolicitud()" title="Generar solicitud" role="button"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
            </div>
            <div class="col-md-4 mb-4">
                <div class="containerUpload">
                    <div class="drop-section drop-section1">
                        <div class="colFormUpload">
                            <i class="fa fa-cloud-upload" aria-hidden="true" style="font-size: 2rem;padding-top:1vh ;"></i>
                            <button class="file-selector file-selector1">Buscar solicitud</button>
                            <input type="file" class="file-selector-input file-selector-input1" multiple />
                        </div>
                        <div class="colFormUpload">
                            <div class="drop-here">Suelta aqui</div>
                        </div>
                    </div>
                    <div class="list-section list-section1">
                        <div class="list listaReq1"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row exencionRequisito">
            <div class="col-md-4 mb-4">
                <h1>Folio Real</h1>
            </div>
            <div class="col-md-4 mb-4">
                <div class="containerUpload">
                    <div class="drop-section  drop-section2">
                        <div class="colFormUpload">
                            <i class="fa fa-cloud-upload" aria-hidden="true" style="font-size: 2rem;padding-top:1vh ;"></i>
                            <button class="file-selector file-selector2">Buscar folio real</button>
                            <input type="file" class="file-selector-input file-selector-input2" multiple />
                        </div>
                        <div class="colFormUpload">
                            <div class="drop-here">Suelta aqui</div>
                        </div>
                    </div>
                    <div class="list-section  list-section2">
                        <div class="list listaReq2"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row exencionRequisito">
            <div class="col-md-4 mb-4">
                <h1>Estados financieros</h1>
            </div>
            <div class="col-md-4 mb-4">
                <div class="containerUpload">
                    <div class="drop-section drop-section3">
                        <div class="colFormUpload">
                            <i class="fa fa-cloud-upload" aria-hidden="true" style="font-size: 2rem;padding-top:1vh ;"></i>
                            <button class="file-selector  file-selector3">Buscar EEFF</button>
                            <input type="file" class="file-selector-input  file-selector-input3" multiple />
                        </div>
                        <div class="colFormUpload">
                            <div class="drop-here">Suelta aqui</div>
                        </div>
                    </div>
                    <div class="list-section list-section3">
                        <div class="list listaReq3"></div>
                    </div>
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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $(document).ready(function() {

        for (let index = 1; index < 4; index++) {
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

    function verDocPopup(rutaArchivo) {
        console.log("verDocPopup --->" + rutaArchivo);
        $.confirm({
            title: '',
            content: `<iframe src="pdfjs/web/viewer.html?file=../../${rutaArchivo}"
                        width="100%"
                        height="700px"
                        style="border: none;"></iframe>`,
            type: "black",
            typeAnimated: true,
            columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
            buttons: {
                cancel: {
                    text: "Cerrar",
                    action: function() {},
                },
            },
        });
    }

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

        console.log("para index:" + index);
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

                console.log("Respuesta del servidor:", http.responseText);
                let respuesta = JSON.parse(http.responseText);
                let ruta = String(respuesta.ruta);
                let nombreArchivo = String(respuesta.nombreArchivo);

                // Crear el input correctamente
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

                // Agregar el input al principio del <li>
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
            gestion: $('#gestion').val(),
            documentos: {},
            cntItem: 0
        }
        var html = `<h3 style="color:black;">Gestion solicitada: <b>${$('#gestion').val()}</b></h3>
                    <table class="striped-table">
                    <thead>
                        <tr>
                            <th>Requisito</th>
                            <th>Codigo de documento generado</th>
                            <th>Visualizar</th>
                        </tr>
                    </thead>`;
        let cntItem = 0;
        $('div[class^="list"]').each(function() {
            const listClass = $(this).attr("class").match(/listaReq\d+/)
            if (listClass) {
                const h1Content = $(this).closest('.exencionRequisito').find('h1').text();
                const listKey = listClass[0];
                console.log(listKey);

                const docNames = $(this).find("input.nomDoc").map(function() {
                    html += `<tr><td>${h1Content}</td><td>${$(this).val()}</td><td><a class="btn verDoc"  onclick="verDocPopup('${$("."+listKey).find("input.pathDoc").val()}')"><i class="fa fa-eye" aria-hidden="true" style="color:#3d7915; font-size:1.2rem;"></i></a></td></tr>`;
                    return $(this).val()
                }).get();
                console.log(docNames);
                datos.documentos[listKey] = docNames;
                cntItem++;
            }
        });
        html += '</table>';
        datos.cntItem = cntItem;
        console.log(datos);

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
                                enviarDocumentos();
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
                                            action: function() {}
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

    function enviarDocumentos() {
        $.confirm({
            title: "Confirmar envío de documentos",
            type: "blue",
            columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
            content: `Se le ha enviado el TOKEN correspondiente para validar y confirmar su envio de documentos, favor ingresar el mismo en el siguiente recuadro:<br>
            <div class="token-container">
                <h2 class="token-title">TOKEN ASIGNADO</h2>
                <input type="number" class="token-input" value="" placehoslder="Ingrese el token aca."  maxlength="6">
            </div>
            `,
            buttons: {
                cancel: {
                    btnClass: "btn-green",
                    text: "Aceptar",
                    action: function() {

                    }
                }
            },
            onOpen: function() {
                setTimeout(() => {
                    this.$content.find('.token-input').focus();
                }, 100);
            }
        });
    }

    function validateTokenInput(input) {
        // Remover cualquier carácter que no sea número
        input.value = input.value.replace(/[^0-9]/g, '');

        // Limitar a 6 dígitos
        if (input.value.length > 6) {
            input.value = input.value.slice(0, 6);
        }

        // Prevenir números negativos y ceros a la izquierda
        if (input.value.startsWith('0')) {
            input.value = input.value.replace(/^0+/, '');
        }
    }

    document.addEventListener('input', function(e) {
        if (e.target && e.target.classList.contains('token-input')) {
            validateTokenInput(e.target);
        }
    }, true);

    document.addEventListener('keydown', function(e) {
        if (e.target && e.target.classList.contains('token-input')) {
            // Prevenir la entrada del signo menos
            if (e.key === '-' || e.keyCode === 189) {
                e.preventDefault();
            }
        }
    }, true);

    function iconSelector(type) {
        var splitType =
            type.split("/")[0] == "application" ?
            type.split("/")[1] :
            type.split("/")[0];
        return splitType + ".png";
    }
</script>

</html>