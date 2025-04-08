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
    <title>CITES</title>
    <?php
    echo $twig->render('linkStyle.twig');
    ?>
    <link href="../css/styleRecursoIa.css" rel="stylesheet">
    <link href="../vendor/bootstrap-table-master/dist/bootstrap-table.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .containerDetalleSolicitud {
            width: 98%;

            margin: auto;
            /* border: 1px solid #000; */
            border-radius: 10px;
            padding: 1rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .headerDetalleSolicitud {
            display: flex;
            justify-content: space-between;
            border: 1px solid #fff;
            /* padding: 10px; */
            /* margin-bottom: 20px; */
            border-radius: 5px;
        }

        .headerDetalleSolicitud p {
            margin: 5px 0;
        } 

        .show-btn3 {
            position: absolute;
            /* Ajusta la distancia desde la parte superior */
            top: 9.5rem;
            right: -3px;
            /* Ajusta la distancia desde la parte derecha */
            background-color: #020e10;
            /* Color de fondo del botón */
            color: white;
            /* Color del texto del botón */
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .chat-message2 {
            margin-bottom: 10px;
            /* color: rgb(23, 83, 129); */
            color: rgb(0, 5, 8);
        }

        .text-end2 {
            color: rgb(27, 95, 64);
            text-align: right;
            font-size: 13px;
        }

        #sendMessageIa:hover i {
            color: rgb(17, 71, 47);
        }

        #chat-box h1 {
            /* color: rgb(56, 94, 143); */
            color: rgb(0, 5, 8);
            font-weight: bold;
            font-size: 1.2rem;

        }



        .thinking {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            color: #0f4562;
        }

        .thinking-dots {
            display: flex;
            color: #0f4562;
        }

        .thinking-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #000;
            margin: 0 3px;
            opacity: 0;
            animation: pulse 1.5s infinite;
            color: #0f4562;
        }

        .thinking-dot:nth-child(2) {
            animation-delay: 0.5s;
        }

        .thinking-dot:nth-child(3) {
            animation-delay: 1s;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 0;
            }

            50% {
                opacity: 1;
            }
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
    <li class="breadcrumb-item text-white active" aria-current="page"> <a class="text-white">CITE</a></li>
    <?php
    echo $twig->render('prebodyltFin.twig');
    ?>
    <!-- Hero End -->
    <!-- About Start -->
    <div class="contenedorDigitaliza">
        <div class="form-group d-flex flex-column flex-md-row">
            <div class="row">
                <div class="col-md-1 mb-3">
                    <a class="btn btn-success" onclick="solicitudCite()" role="button"><i class="fa fa-plus"></i></a>
                </div>
                <div class="col-md-4 mb-3">
                    <input type="text" class="form-control" value="" id="filtroCodigoSolicitud" placeholder="Codigo de CITE">
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control datepicker" value="" id="filtroFechaIni" placeholder="Fecha ini">
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control datepicker" value="" id="filtroFechaFin" placeholder="Fecha fin">
                </div>
                <div class="col-md-1 mb-3">
                    <button class="btn btn-primary" onclick="getCites()">consultar</button>
                    <div class="show-btn3" onclick="showIa()"><span id="contenBtn"><img class="img-fluid" src="../img/ia.gif" style="height: 2rem;" alt=""></span></div>
                </div>
            </div>
        </div>

        <hr>
        <div>
            <table id="tableCompendio"
                data-toggle="table"
                data-search="true"
                data-show-toggle="true"
                data-show-fullscreen="true"
                data-show-columns="true"
                data-show-columns-toggle-all="true"
                data-show-export="true"
                data-export-types='["csv","excel"]'
                data-click-to-select="true"
                data-pagination="true"
                data-page-list="[10, 25, 50, 100, all]"
                data-locale="es-ES"
                class="table table-striped"
                data-sort-name="idcite"
                data-sort-order="desc"
                data-show-refresh="true"
                data-url="../php/getDetalleCites.php"
                data-query-params="filtrosDataTable">
                <thead>
                    <th data-field="idcite" data-sortable="true">Id</th>
                    <th data-field="fecha" data-sortable="true">Fecha</th>
                    <th data-field="usuario" data-sortable="true">Usuario</th>
                    <th data-field="doc" data-sortable="true">Documento</th>
                    <th data-field="cite" data-sortable="true">CITE</th>
                    <th data-field="destino" data-sortable="true">Destino</th>
                    <th data-field="referencia" data-sortable="true">Referencia</th>
                    <th data-field="hhrr_" data-sortable="true">HHRR</th>
                    <th data-field="estado" data-sortable="true">Estado</th>
                    <th data-field="acciones">Acciones</th>
                </thead>
                <tbody id="tbodyItems">
                </tbody>
            </table>
        </div>
    </div>

    <!-- About End -->
    <!-- JavaScript Libraries -->
    <?php
    echo $twig->render('linkJs.twig');
    ?>
    <!-- Template Javascript -->
</body>
<script src="../js/mainRecursoIa.js"></script>
<script src="../vendor/bootstrap-table-master/dist/bootstrap-table.min.js"></script>
<script src="../vendor/bootstrap-table-master/dist/extensions/export/bootstrap-table-export.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF/jspdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $(".datepicker").flatpickr();

    function filtrosDataTable(p) {
        console.log("en filtrosDataTable");
        return {
            filtroCodigoSolicitud: $('#filtroCodigoSolicitud').val(),
            filtroFechaIni: $('#filtroFechaIni').val(),
            filtroFechaFin: $('#filtroFechaFin').val(),
            offset: p.offset,
            limit: p.limit,
            sort: p.sort,
            order: p.order,
            search: p.search
        }
    }


    document.addEventListener('DOMContentLoaded', function() {
        var toastrMessage = localStorage.getItem('toastrMessage');
        if (toastrMessage) {
            toastr["success"](toastrMessage);
            localStorage.removeItem('toastrMessage');
        }
    });

    function showIa() {
        $.confirm({
            title: '',
            content: ` 
            <div class="chat-container border p-3 mt-3">
                    <div id="chat-box" class="chat-box"></div>
                </div>
                <div class="position-relative w-100 mt-3 mb-2">
                    <textarea class="form-control w-100 ps-4 pe-5" rows="5" id="user-input" placeholder="Escriba su consulta aca ..."  ></textarea>
                    <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2" onclick="sendMessageIa()" id="sendMessageIa"><i class="fa fa-paper-plane fs-4" style="color:#036b8b;"></i></button>
                </div>`,
            type: "green",
            typeAnimated: true,
            columnClass: "col-md-10 col-md-offset-10 col-xs-10 col-xs-offset-10",
            buttons: {
                cancel: {
                    text: "Cerrar",
                    action: function() {},
                },
            },
            onOpenBefore: function() {
                $('.jconfirm-title-c').css('text-align', 'center');
                const $chatBox = $('#chat-box');
                const botMessage = $('<div>').addClass('chat-message2').text(`Hola!, soy DATM inteligente, estoy lista para ayudarte con la redacción de tu documento. 🤖`);
                $chatBox.append(botMessage);
                loadGralOff();
            }
        });
    }


    function renderWithTypingEffect(element, htmlContent, delay = 50) {
        let tempDiv = $('<div>').html(htmlContent); // Crear un contenedor temporal para conservar el HTML
        let elements = tempDiv.contents(); // Obtener los nodos internos 
        function typeNext(index) {
            if (index < elements.length) {
                $(element).append(elements[index]); // Agregar el siguiente nodo al contenedor destino
                console.log(elements[index]);
                setTimeout(() => typeNext(index + 1), delay);
            }
        }
        typeNext(0);
    }

    function sendMessageIa() {
        console.log("En sendMessageIa");
        const userInput = $('#user-input').val().trim();
        if (userInput === '') return;

        const $chatBox = $('#chat-box');
        const userMessage = $('<div>').addClass('chat-message2 text-end2').text(`${userInput}`);

        $chatBox.append(userMessage);
        datos = '&modalidad=docs' +'&promptUser=' + userInput + "&recurso=redaccionnotas&tituloPrincipal=Redaccion de documentos";


        $.ajax({
            async: true,
            type: "POST",
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            url: "../php/apiGemini.php",
            data: datos,
            beforeSend: function() {
                console.log("cargando...");
                const $thinking = $('<div class="thinking"><span>Generando contenido</span><div class="thinking-dots"><div class="thinking-dot"></div><div class="thinking-dot"></div><div class="thinking-dot"></div></div></div>');
                $('#chat-box').append($thinking);

            },
            success: function(response) {
                $('.thinking').remove();

                /* const botMessage = $('<div>').addClass('chat-message2');
                $chatBox.append(botMessage); 
                typeWriter(botMessage, response); */

                const botMessage = $('<div>').addClass('chat-message2').html(`${response}`);
                $chatBox.append(botMessage);
                setTimeout(function() { 
                    $chatBox.scrollTop($chatBox.prop('scrollHeight'));
                }, 100);

                /* const botMessage = $('<div>').addClass('chat-message2');
                $('#chatBox').append(botMessage); // Agregar el contenedor vacío
                renderWithTypingEffect(botMessage, response); */

            },
            timeout: 16000,
            error: function() {}
        });
        $('#user-input').val('');
        setTimeout(function() {
            $chatBox.scrollTop($chatBox.prop('scrollHeight'));
        }, 100);
    }


    function getCites() {
        $.ajax({
            async: true,
            type: 'POST',
            data: {
                filtroCodigoSolicitud: $('#filtroCodigoSolicitud').val(),
                filtroFechaIni: $('#filtroFechaIni').val(),
                filtroFechaFin: $('#filtroFechaFin').val()
            },
            url: '../php/getDetalleCites.php',
            beforeSend: function() {
                loadGralOn();
            },
            success: function(dat) {
                loadGralOff();
                $('#tbodyItems').empty();
                dat = $.parseJSON(dat);
                // Iterar sobre los datos recibidos y agregarlos al tbody
                $.each(dat, function(index, item) {
                    var fila = `
                    <tr>
                        <td>${item.idcite}</td>
                        <td>${item.fecha}</td>
                        <td>${item.usuario}</td>
                        <td>${item.doc}</td>
                        <td>${item.cite}</td>
                        <td>${item.destino}</td>
                        <td>${item.referencia}</td>
                        <td>${item.hhrr_}</td>
                        <td>${item.estado} </td>
                        <td>${item.acciones}</td> 
                    </tr>
                `;
                    $('#tbodyItems').append(fila);
                });
                $('#tableCompendio').bootstrapTable('refresh');
            },
            timeout: 16000,
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    } 
 

    function cargaUbicacion(idregistro) {
        if (idregistro) {
            var content_ = `
        <div class="form-group" >
            <div class="row" style="margin-right:0 !important;">
                <div class="col-md-6">
                    <label>Nro Registro</label>
                    <input type="text" disabled id="no_registro_" placeholder="No. Registro" class="form-control" value="10000001" required />
                </div> 
            </div>
            <div class="row" style="margin-right:0 !important;">
                <div class="col-md-6">
                    <label>Rubro</label>
                    <select disabled id="rubro_" class="form-control">
                        <option  value="inmueble">Inmueble</option>
                        <option selected value="vehiculo">Vehiculo</option>
                        <option value="actividad economica">Actividad economica</option>
                        <option value="otros">Otros</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Identificador</label>
                    <input disabled type="text" id="identificador_" placeholder="Placa, No. Inmb. No. Patente" class="form-control" value="SGE122" required />
                </div>
            </div> 
            <div  class="row" style="margin-right:0 !important;">  
                <div class="col-md-6">
                    <label>Estante</label>
                    <select id="estante_" class="form-control">
                        <option  value="1">No 1</option>
                        <option selected value="2">No 2</option>
                        <option value="3">No 3</option>
                        <option value="4">No 4</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Sección</label>
                    <select id="seccion_" class="form-control">
                        <option  value="1A">1A</option>
                        <option selected value="1B">1B</option>
                        <option value="1C">1C</option>
                        <option value="2A">2A</option>
                        <option value="2B">2B</option>
                    </select>
                </div>
            </div>
            <div>
                <div class="col-md-12">
                    <label>Observación</label>
                    <textarea cols="15" rows="4" class="form-control" id='observacion_'></textarea>
                </div>
            </div>
            <hr>
            <div style="color:red;font-size:0.8rem;">
            * Todos son campos obligatorios
            </div>
        </div>
        `;

            var errorContribuyente = true;
            $.confirm({
                title: "<i class='fa fa-map-marker'></i> Registro de ubicación fisica",
                type: "dark",
                content: content_,
                buttons: {
                    formSubmit: {
                        text: "Registrar",
                        btnClass: "btn-blue",
                        action: function() {
                            var formSubmitButton = this.buttons.formSubmit;
                            datos =
                                "&estante_=" + $("#estante_").val() +
                                "&seccion_=" + $("#seccion_").val() +
                                "&idregistro=" + idregistro +
                                "&observacion_=" + $("#observacion_").val();
                            $.ajax({
                                async: true,
                                type: "POST",
                                dataType: "html",
                                contentType: "application/x-www-form-urlencoded",
                                url: "../php/regUbicacionRegistro.php",
                                data: datos,
                                beforeSend: function() {
                                    formSubmitButton.setText('Procesando...');
                                    formSubmitButton.disable();
                                    loadGralOn();
                                },
                                success: function(e) {
                                    loadGralOff();
                                    dat = JSON.parse(e)
                                    $.confirm(dat.html);

                                },
                                timeout: 16000,
                                error: function() {},
                            });

                        },
                    },
                    cancel: function() {},
                },
            });

        } else {
            $.confirm({
                title: " Ops...",
                type: "red",
                content: "No se obtuvo correctamente el numero de actuado, vuelva a intentarlo",
            });
        }
    }

    function formActuado(idactuado = 0) {
        var titulo = 'Registro de ';
        if (idactuado) {
            titulo = 'Edición de ';
            //seteamos valores para efectuar la modificacion 
        }
        var content_ = `
        <div class="form-group" >
            <div class="row" style="margin-right:0 !important;">
                <div class="col-md-6">
                    <label>Nro Registro</label>
                    <input type="text" id="no_registro_" placeholder="No. Registro" class="form-control" value="10000001" required />
                </div>
                <div class="col-md-6">
                    <label>Fojas</label>
                    <input type="text" id="fojas_" placeholder="Numero de fojas" class="form-control" value="6" required />
                </div>
            </div>
            <div class="row" style="margin-right:0 !important;">
                <div class="col-md-6">
                    <label>Rubro</label>
                    <select id="rubro_" class="form-control">
                        <option  value="inmueble">Inmueble</option>
                        <option selected value="vehiculo">Vehiculo</option>
                        <option value="actividad economica">Actividad economica</option>
                        <option value="otros">Otros</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Identificador</label>
                    <input type="text" id="identificador_" placeholder="Placa, No. Inmb. No. Patente" class="form-control" value="SGE122" required />
                </div>
            </div>

            <div  class="row" style="margin-right:0 !important;">

                <div class="col-md-6">
                    <label>Nro. Hoja de ruta</label>
                    <input type="text" id="hhrr_" placeholder="DATM/XXX/2024" class="form-control" value="DATM/5238/2024" required />
                </div>
                <div class="col-md-6">
                    <label>Documento</label>
                    <input type="file" id="documento_" class="form-control" placeholder="Cargar documento" />
                </div>
            </div>
            <div>
                <div class="col-md-12">
                <label>Comentario</label>
                <textarea cols="15" rows="4" class="form-control" id='comentario_'></textarea>
                </div>
            </div>
            <hr>
            <div style="color:red;font-size:0.8rem;">
            * Todos son campos obligatorios
            </div>
        </div>
        `;

        var errorContribuyente = true;
        $.confirm({
            title: titulo + " actuado:",
            type: "dark",
            content: content_,
            buttons: {
                formSubmit: {
                    text: "Registrar",
                    btnClass: "btn-blue",
                    action: function() {
                        var formSubmitButton = this.buttons.formSubmit;
                        datos =
                            "&no_registro_=" + $("#no_registro_").val() +
                            "&fojas_=" + $("#fojas_").val() +
                            "&rubro_=" + $("#rubro_").val() +
                            "&identificador_=" + $("#identificador_").val() +
                            "&hhrr_=" + $("#hhrr_").val() +
                            "&documento_=" + $("#documento_").val() +
                            "&idactuado=" + idactuado +
                            "&comentario_=" + $("#comentario_").val();
                        $.ajax({
                            async: true,
                            type: "POST",
                            dataType: "html",
                            contentType: "application/x-www-form-urlencoded",
                            url: "../php/regeditActuado.php",
                            data: datos,
                            beforeSend: function() {
                                formSubmitButton.setText('Procesando...');
                                formSubmitButton.disable();
                                loadGralOn();
                            },
                            success: function(e) {
                                loadGralOff();
                                dat = JSON.parse(e)
                                $.confirm(dat.html);

                            },
                            timeout: 16000,
                            error: function() {},
                        });

                    },
                },
                cancel: function() {},
            },
        });
    }

    function verAnulacionCite(idcite, codigoCite) {
        var datos = {
            idcite: idcite,
        };
        $.ajax({
            async: true,
            type: 'POST',
            data: datos,
            url: '../php/getCiteAnulado.php',
            beforeSend: function() {
                loadGralOn();
            },
            success: function(dat) {
                loadGralOff();
                $.confirm({
                    title: "Detalle de cite",
                    type: "red",
                    content: dat,
                    buttons: {
                        cancel: {
                            text: "Cerrar",
                            action: function() {},
                        },
                    },
                });
            },
            timeout: 16000,
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    }

    function editarCite(idcite, codigoCite) {
        var datos = {
            idcite: idcite,
        };
        $.ajax({
            async: true,
            type: 'POST',
            data: datos,
            url: '../php/formEditCite.php',
            beforeSend: function() {
                loadGralOn();
            },
            success: function(dat) {
                loadGralOff();
                $.confirm({
                    title: codigoCite,
                    type: "green",
                    content: dat,
                    buttons: {

                        guardar: {
                            text: "Guardar",
                            btnClass: "btn-green",
                            action: function() {
                                var datos2 = {
                                    idcite: idcite,
                                    hhrr_: $('#hhrr_').val(),
                                    referencia: $('#referencia').val(),
                                    destino: $('#destino').val(),
                                    fecha_registro: $('#fecha_registro').val(),
                                };

                                $.ajax({
                                    async: true,
                                    type: 'POST',
                                    data: datos2,
                                    url: '../php/editCite.php',
                                    beforeSend: function() {
                                        loadGralOn();
                                    },
                                    success: function(dat) {
                                        loadGralOff();
                                        $.confirm({
                                            title: dat.title,
                                            type: dat.estado,
                                            content: dat.message,
                                            buttons: {
                                                cancel: {
                                                    text: "Cerrar",
                                                    action: function() {
                                                        window.location.href = './citeList.php';
                                                    },
                                                },
                                            }
                                        });

                                    }
                                });
                            },
                        },
                        cancel: {
                            text: "Cerrar",
                            action: function() {},
                        },
                    },
                });
            },
            timeout: 16000,
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    }

    function borrarCite(idcite, codigoCite) {
        $.confirm({
            title: "Eliminación de CITE",
            type: "red",
            content: "Confirme la eliminacion del CITE: <b>" + codigoCite + "</b> y detalle brevemente la(s) razon(es):<br> <textarea id='observacion' rows='6' cols='40' class= 'form-control' placeholder='Escribe aquí el detalle...'></textarea><br><br>",
            buttons: {
                confirmar: {
                    text: "Confirmar",
                    btnClass: "btn-red",
                    action: function() {

                        var datos = {
                            idcite: idcite,
                            observacion: $('#observacion').val(),
                        };
                        $.ajax({
                            async: true,
                            type: 'POST',
                            data: datos,
                            url: '../php/citeAnulacion.php',
                            beforeSend: function() {
                                loadGralOn();
                            },
                            success: function(dat) {
                                loadGralOff();
                                if (dat.err == '0') {
                                    toastr["success"]("CITE anulado correctamente", codigoCite);
                                    window.location.href = './citeList.php';
                                } else {
                                    if (dat.err == '2') {
                                        $.confirm({
                                            title: dat.message,
                                            type: "red",
                                            content: "Su sesión a concluido, vuelva a ingresar por favor.",
                                            buttons: {
                                                login: {
                                                    text: "Login",
                                                    btnClass: "btn-red",
                                                    action: function() {
                                                        window.location.href = './login.php';
                                                    }
                                                }
                                            }
                                        });
                                    } else {
                                        toastr["warning"]("Ocurrio un error", dat.message);
                                    }
                                }
                            },
                            timeout: 16000,
                            error: function(xhr, status, error) {
                                alert('Excepcion: ' + error);
                            }
                        });
                    }
                },
                cancel: {
                    text: "Cerrar",
                    action: function() {}
                }
            }
        });
    }
</script>

</html>