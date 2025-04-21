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

foreach ($_GET as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

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
    <li class="breadcrumb-item text-white active" aria-current="page">Inmueble <?php echo $c; ?></li>
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
    <?php

    $query = "SELECT b.idcabecera, b.idactuado , x.gestion, x.codigo_solicitud, 
                x.registro_tributario, y.idrubro, y.rubro, 
                c.idrequisito, c.detalle, c.anotacion,  a.observacion , c.obligatorio,
                a.iditem_actuado_ant, e.documento_path, f.detalle_estado as detalle_estado_ant, uant.usuario as usuarioant,
                a.iditem_act, a.documento_path as documento_path_rev, d.detalle_estado, uact.usuario as usuarioact , b.observacion obs_gral
                from exc_item_actuado a 
                left join datm_usuario uact on uAct.id = a.idusuario 
                left join exc_requisito c on a.idrequisito = c.idrequisito
                left join exc_actuado b on b.idactuado = a.idactuado 
                left join exc_cabecera x on x.idcabecera = b.idcabecera
                left join exc_rubro y on y.idrubro = x.idrubro
                left join exc_estado d on d.idestado = a.idestado
                left join exc_item_actuado e on e.iditem_act = a.iditem_actuado_ant
                left join datm_usuario uant on uAnt.id = e.idusuario 
                left join exc_estado f on f.idestado = e.idestado
                where b.idcabecera = $i 
                and b.idactuado = (select max(idactuado) from exc_actuado a 
                where a.idcabecera = $i  and a.idestado = 5) 
                and b.idestado = 5 and a.idestado = 5
                and a.estado_ is true   order by c.orden, iditem_act";

    $stmt = $cons->query($query);
    $solicitud = $stmt->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <div class="contenedorDigitaliza">
        <div class="row exencionCabecera">
            <div class="col-md-3 mb-3">
                <label for="codigoSolicitud">Gestión para exención</label>
                <input id="gestionIni" class='form-control' disabled value="<?php echo $solicitud[0]['gestion']; ?>" />
                <?php
                echo "<input id='idcabecera' type='hidden' value='" . $solicitud[0]['idcabecera'] . "' >";
                echo "<input id='codigo_solicitud' type='hidden' value='" . $solicitud[0]['codigo_solicitud'] . "' >";
                ?>
            </div>

            <div class="col-md-3 mb-3">
                <label for="numero_inmueble">Nro. placa</label>
                <select class="form-controlSelect" id="numero_inmueble" disabled>
                    <?php

                    $query = "SELECT numero_inmueble
                                FROM inmueble_univ a 
                                where a.documento_identidad =  '" . $_SESSION['cedula_identidad'] . "' order by a.numero_inmueble  desc";
                    $stmt = $cons->query($query);
                    $bienes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $html = '';
                    $sw = true;
                    foreach ($bienes as $row) {
                        $selected = '';
                        if ($solicitud[0]['registro_tributario'] == 'TODOS' && $sw)
                            $selected = 'selected';
                        if ($sw) {
                            $html .= "<option value='TODOS' $selected>TODOS</option>";
                            $sw = false;
                            $selected = '';
                        }
                        if ($row['numero_inmueble'] ==  $solicitud[0]['registro_tributario'])
                            $selected = 'selected';

                        $html .=  "<option value=" . $row['numero_inmueble'] . " $selected >" . $row['numero_inmueble'] . "</option>";
                    }
                    echo $html;
                    ?>
                </select>
            </div>
            <div class="col-md-6 mb-6" style="text-align: right; font-weight: bold; font-style: italic; font-size: 0.8rem;">
                <?php echo ($solicitud[0]['obs_gral'] != '' ? '"' . $solicitud[0]['obs_gral'] . '"' : ""); ?>
            </div>
        </div>

        <?php
        $html = '';
        $cnt = 1;


        foreach ($solicitud as $key => $value) {
            $html .= "
                <div class='row exencionRequisito'>
                    <div class='col-md-4 mb-4'>
                        <h1>" . $value['detalle'] .   ($value['obligatorio'] ? '<span style="color:#7e2d05;  ">*</span>' : '') . "</h1>                        
                        <p>" . $value['anotacion']
                . ($value['idrequisito'] == '1' ? "<a onclick='generarSolicitud()' title='Generar solicitud' role='button'><i class='fa fa-file-text-o' aria-hidden='true'></i></a>" : "")
                . "</p>
                        <input type='hidden' class='idrequisito' value='" . $value['idrequisito'] . "'/>
                        <input type='hidden' class='resquisitoObligatorio' value='" . $value['obligatorio'] . "'/>
                        <input type='hidden' class='iditem_act' value='" . $value['iditem_act'] . "'> 
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
                                ";

            $html .= '
                            <div class="list-section list-section' . $cnt . '" style="display: block;">
                                <div class="list listaReq' . $cnt . '">
                                <li class="complete documento' . $cnt . '">
                                    <div class="colFormUpload">
                                        <img src="../img/pdf.png" alt="">
                                    </div>
                                    <div class="colFormUpload">
                                        <div class="file-name">
                                            <div class="name">' . $value['documento_path'] . '</div> 
                                            <span>100%</span>
                                        </div>
                                        <div class="file-progress">
                                            <span style="width: 100%;"></span>
                                        </div>
                                        <div class="file-size"></div>
                                    </div>
                                    <div class="colFormUpload">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="cross" height="20" width="20"><path d="m5.979 14.917-.854-.896 4-4.021-4-4.062.854-.896 4.042 4.062 4-4.062.854.896-4 4.062 4 4.021-.854.896-4-4.063Z"></path></svg>
                                    </div> 
                                    <div class="colFormUpload">
                                        <a class="btn verDoc" href="#"><i class="fa fa-eye" aria-hidden="true" style="color:#3d7915; font-size:1.2rem;"></i></a>
                                        <a class="btn eliminarDoc" href="#"><i class="fa fa-trash-o" aria-hidden="true" style="color:#bf0404; font-size:1.2rem;"></i></a>
                                    </div> 
                                    <input type="hidden" class="pathDoc" value="../static/exencion/' . $_SESSION['usuario'] . '/' . $value['documento_path'] . '">
                                    <input type="hidden" class="nomDoc" value="' . $value['documento_path'] . '">
                                    
                                </li>
                                <div style="border:0.0625rem solid rgb(255, 158, 158); border-radius:0.3rem;margin:0.625rem 0; padding:0.125rem" >
                                    ' . $value['observacion'] . (trim($value['documento_path_rev']) != '' ? ' <br><a class="btn" onclick="verDocPopup(\'../static/exencion/' . $value['usuarioact'] . '/' . $value['documento_path_rev'] . '\',\'' . $value['observacion'] . '\')"><i class="fa fa-eye" aria-hidden="true" style="color:#3d7915; font-size:1.2rem;"></i></a>' : '') . '<br>                                    
                                    
                                    </div>
                                </div>
                            </div>
                                ';

            $html .=            " 
                        </div>
                    </div>
                </div>
            ";
            $cnt++;
        }

        //ahora incorporamos los requisitos no completados o vacios, para dar posibilidad de incorporarlos
        $query = "SELECT  idrequisito, detalle,  anotacion, obligatorio  from exc_requisito where idrequisito not in (
                    select  c.idrequisito 
                    from exc_item_actuado a 
                    left join exc_item_actuado  c on a.iditem_actuado_ant = c.iditem_act
                    left join exc_actuado b on a.idactuado = b.idactuado
                    where a.estado_ is true and b.estado_ is true
                    and a.idestado in (6,5)
                    and idcabecera = $i  
                    group by  c.idrequisito 
                    ) and idrubro = 1 and estado_ is true";

        $stmt = $cons->query($query);
        $requisitos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($requisitos as $key => $value) {
            $html .= "<div class='row exencionRequisito'>
                <div class='col-md-4 mb-4'>
                    <h1>" . $value['detalle'] . ($value['obligatorio'] ? '<span style="color:#7e2d05;  ">*</span>' : '') . "</h1>                        
                        <p>" . $value['anotacion']
                . ($value['idrequisito'] == '1' ? "<a onclick='generarSolicitud()' title='Generar solicitud' role='button'><i class='fa fa-file-text-o' aria-hidden='true'></i></a>" : "")
                . "</p>
                    <input type='hidden' class='idrequisito' value='" . $value['idrequisito'] . "'/>
                    <input type='hidden' class='resquisitoObligatorio' value='" . $value['obligatorio'] . "'/>
                    <input type='hidden' class='iditem_act' value=''> 
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
        echo "<input type='hidden' id='items' value='$cnt'>";
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
<script>
    $(document).ready(function() {
        var cantidadItems = $('#items').val();
        for (let index = 1; index < cantidadItems; index++) {
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
            numero_inmueble: $('#numero_inmueble').val(),
            documentos: {},
            cntItem: 0
        }
        var html = `
        <h3 style="color:black;">Gestión solicitada: <b>${$('#gestionIni').val()}</b></h3>
        <h4 style="color:black;">Nro. Placa: ${$('#numero_inmueble').val()}</h4>
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
                const iditem_act = $(this).closest('.exencionRequisito').find('.iditem_act').val();
                const idrequisito = $(this).closest('.exencionRequisito').find('.idrequisito').val();
                const resquisitoObligatorio = $(this).closest('.exencionRequisito').find('.resquisitoObligatorio').val();
                const listKey = listClass[0];

                $(this).find("input.nomDoc").each(function(index) {
                    const pathDoc = $("." + listKey).find("input.pathDoc").eq(index).val();

                    const docName = $(this).val();
                    console.log("docName:" + docName);

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
                    return $(this).val()
                }).get();
                datos.documentos[listKey] = {
                    docNames,
                    iditem_act,
                    idrequisito
                }; 
                if (docNames == '' && resquisitoObligatorio == '1') {
                    errores.push(" - No se ha agregado ningún documento PDF para el requisito: <b>" + h1Content + "</b>");
                } 
                cntItem++;
            }
        });
        html += '</table>';
        datos.idcabecera = $("#idcabecera").val();
        datos.codigo_solicitud = $("#codigo_solicitud").val();
        datos.cntItem = cntItem;
        datos.items = cntItem;

        console.log('========================================');
        console.log(datos);
        console.log('========================================');

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
                                url: "../php/exencionSaveVehSubsanado.php",
                                data: JSON.stringify(datos),
                                beforeSend: function() {
                                    loadGralOn();
                                },
                                success: function(e) {
                                    loadGralOff();
                                    console.log(e);
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
            "&numero_inmueble=" + $('#numero_inmueble').val() + "&gestionIni_=" + $('#gestionIni').val() + "&gestionFin_=" + $('#gestionFin').val();

        var url_ = "../php/rptveh_11_v2.php?" + datos;
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