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
    <title>USUARIOS</title>
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
    <li class="breadcrumb-item"><a class="text-white">USUARIOS</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page"> <a class="text-white" href="#">GESTION DE USUARIOS</a></li>

    <?php
    echo $twig->render('prebodyltFin.twig');
    ?>
    <!-- Hero End -->

    <!-- About Start -->
    <div class="contenedorDigitaliza">
        <div class="form-group d-flex flex-column flex-md-row">
            <div class="row">
                <div class="col-md-1 mb-3">
                    <a class="btn btn-success" href="usrRegistroForm.php" role="button"><i class="fa fa-plus"></i></a>
                </div>
                <div class="col-md-4 mb-3">
                    <input type="text" class="form-control" value="" id="filtroCodigoSolicitud" placeholder="CI/NIT USUARIO">
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control datepicker" value="" id="filtroFechaIni" placeholder="Fecha ini">
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control datepicker" value="" id="filtroFechaFin" placeholder="Fecha fin">
                </div>
                <div class="col-md-1 mb-3">
                    <button class="btn btn-primary" onclick="getUsuarios()">consultar</button>
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
                data-click-to-select="true"
                data-pagination="true"
                data-page-list="[10, 25, 50, 100, 200, all]"
                data-locale="es-ES"
                class="table table-striped"
                data-sort-name="id"
                data-sort-order="desc"
                data-show-refresh="true"
                data-url="../php/usrGetUsuarios.php"
                data-query-params="filtrosDataTable">
                <thead>
                    <th data-field="id" data-sortable="true">No</th>
                    <th data-field="rol" data-sortable="true">Rol</th>
                    <th data-field="codigo_unidad" data-sortable="true">C. Unidad</th>
                    <th data-field="cedula_identidad" data-sortable="true">Ci/Nit</th>
                    <th data-field="nombres" data-sortable="true">Nombres</th>
                    <th data-field="primer_apellido" data-sortable="true">Paterno</th>
                    <th data-field="segundo_apellido" data-sortable="true">Materno</th>
                    <th data-field="usuario" data-sortable="true">Usuario</th>
                    <th data-field="contacto" data-sortable="true">Contacto</th>
                    <th data-field="estado" data-sortable="true">Estado</th>
                    <th data-field="fecha_registro" data-sortable="true">Fecha registro</th>
                    <th data-field="acciones">Acciones</th>
                </thead>
                <tbody id="tbodyItems">
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para editar usuario -->
    <div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="modalEditarUsuarioLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarUsuarioLabel">Editar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarUsuario">
                        <input type="hidden" id="editId" name="id">
                        <div class="form-group">
                            <label for="editUsuario">Usuario</label>
                            <input type="text" class="form-control" id="editUsuario" name="usuario" required>
                        </div>
                        <div class="form-group">
                            <label for="editNombre">Nombres</label>
                            <input type="text" class="form-control" id="editNombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="editPaterno">Paterno</label>
                            <input type="text" class="form-control" id="editPaterno" name="paterno" required>
                        </div>
                        <div class="form-group">
                            <label for="editMaterno">Materno</label>
                            <input type="text" class="form-control" id="editMaterno" name="materno" required>
                        </div>
                        <div class="form-group">
                            <label for="editCorreo">Correo</label>
                            <input type="email" class="form-control" id="editCorreo" name="correo" required>
                        </div>
                        <div class="form-group">
                            <label for="editContacto">Contacto</label>
                            <input type="text" class="form-control" id="editContacto" name="contacto" required>
                        </div>
                        <div class="form-group">
                            <label for="editRol">Rol</label>
                            <select class="form-control" id="editRol" name="rol" required>
                                <option value="">Seleccionar rol...</option>
                                <?php
                                $query = "select distinct rol from datm_usuario";
                                $stmt = $cons->query($query);
                                $extension = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($extension as $row) {
                                    echo  "<option value=\"" . htmlspecialchars($row['rol']) . "\">" . htmlspecialchars($row['rol']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editUnidad">Unidad</label>
                            <select class="form-control" id="editUnidad" name="unidad">
                                <option value="GAMEA">GAMEA</option>
                                <?php
                                $query = "select distinct codigo_unidad from datm_usuario order by codigo_unidad";
                                $stmt = $cons->query($query);
                                $extension = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($extension as $row) {
                                    echo  "<option value=\"" . htmlspecialchars($row['codigo_unidad']) . "\">" . htmlspecialchars($row['codigo_unidad']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editArea">Área</label>
                            <select class="form-control" id="editArea" name="area">
                                <option value="">N/A</option>
                                <?php
                                $query = "select distinct concat(codigo_unidad,' - ',area) area_, area  
                                    from datm_usuario 
                                    where area is not null 
                                    order by concat(codigo_unidad,' - ',area)   ";
                                $stmt = $cons->query($query);
                                $extension = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($extension as $row) {
                                    echo  "<option value=\"" . htmlspecialchars($row['area']) . "\">" . htmlspecialchars($row['area_']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editCargo">Cargo</label>
                            <select class="form-control" id="editCargo" name="cargo">
                                <option value="CONTRIBUYENTE">Contribuyente</option>
                                <?php
                                $query = "
                                    select distinct cargo  
                                    from datm_usuario 
                                    where cargo is not null and cargo != 'ROOT'";
                                $stmt = $cons->query($query);
                                $extension = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($extension as $row) {
                                    echo  "<option value=\"" . htmlspecialchars($row['cargo']) . "\">" . htmlspecialchars($row['cargo']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editPassword">Nueva Contraseña (dejar en blanco para no modificar)</label>
                            <input type="password" class="form-control" id="editPassword" name="password" placeholder="Nueva contraseña">
                        </div>
                        <div class="form-group">
                            <label for="editEstado">Estado</label>
                            <select class="form-control" id="editEstado" name="estado">
                                <option value="1">Activo</option>
                                <option value="0">Baja</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="guardarCambiosUsuario()">Guardar cambios</button>
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
        console.log(p);
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

    function getUsuarios() {
        $.ajax({
            async: true,
            type: 'POST',
            data: {
                filtroCodigoSolicitud: $('#filtroCodigoSolicitud').val(),
                filtroFechaIni: $('#filtroFechaIni').val(),
                filtroFechaFin: $('#filtroFechaFin').val()
            },
            url: '../php/usrGetUsuarios.php',
            beforeSend: function() {
                loadGralOn();
            },
            success: function(e) {
                loadGralOff();
                $('#tbodyItems').empty();
                dat = $.parseJSON(e);
                // Iterar sobre los datos recibidos y agregarlos al tbody
                $.each(dat, function(index, item) {
                    var estadoHtml = (item.estado == 1) ? '<span class="badge badge-success" style="background-color: #28a745; color: white; padding: 5px;">Activo</span>' : '<span class="badge badge-danger" style="background-color: #dc3545; color: white; padding: 5px;">Baja</span>';
                    var fila = `
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.rol}</td>
                        <td>${item.codigo_unidad}</td>
                        <td>${item.cedula_identidad}</td>
                        <td>${item.nombres}</td>
                        <td>${item.primer_apellido}</td>
                        <td>${item.segundo_apellido}</td>
                        <td>${item.usuario}</td>
                        <td>${item.contacto}</td> 
                        <td>${estadoHtml}</td> 
                        <td>${item.fecha_registro}</td> 
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

    function editarUsuario(idusuario, codigoSolicitud) {
        console.log("editarUsuario:" + idusuario + ", para:" + codigoSolicitud);

        // Obtener los datos del usuario de la tabla
        var fila = $('button[onclick*="' + idusuario + '"]').closest('tr');
        var id = fila.find('td:eq(0)').text();
        var rol = fila.find('td:eq(1)').text();
        var usuario = fila.find('td:eq(4)').text();
        var contacto = fila.find('td:eq(5)').text();

        // Buscar el correo desde el servidor (opcional, o puedes agregarlo como data-attr)
        $.ajax({
            async: true,
            type: 'GET',
            url: '../php/usrGetUsuarios.php',
            data: {
                idusuario: idusuario
            },
            success: function(e) {
                var dat = $.parseJSON(e);
                if (dat.length > 0) {
                    var usuarioData = dat[0];

                    // Llenar el formulario modal
                    $('#editId').val(usuarioData.id);
                    $('#editUsuario').val(usuarioData.usuario);
                    $('#editNombre').val(usuarioData.nombres);
                    $('#editPaterno').val(usuarioData.primer_apellido);
                    $('#editMaterno').val(usuarioData.segundo_apellido);
                    $('#editCorreo').val(usuarioData.correo);
                    $('#editContacto').val(usuarioData.contacto);
                    $('#editRol').val(usuarioData.rol);
                    $('#editUnidad').val(usuarioData.codigo_unidad);
                    $('#editArea').val(usuarioData.area);
                    $('#editCargo').val(usuarioData.cargo);
                    $('#editPassword').val(''); 
                    $('#editEstado').val(usuarioData.estado);

                    // Mostrar el modal
                    $('#modalEditarUsuario').modal('show');
                }
            },
            error: function(xhr, status, error) {
                alert('Error al cargar datos del usuario: ' + error);
            }
        });
    }

    function guardarCambiosUsuario() {
        var datos = {
            id: $('#editId').val(),
            usuario: $('#editUsuario').val(),
            nombre: $('#editNombre').val(),
            paterno: $('#editPaterno').val(),
            materno: $('#editMaterno').val(),
            correo: $('#editCorreo').val(),
            contacto: $('#editContacto').val(),
            rol: $('#editRol').val(),
            unidad: $('#editUnidad').val(),
            area: $('#editArea').val(),
            cargo: $('#editCargo').val(),
            password: $('#editPassword').val(),
            estado: $('#editEstado').val()
        };

        console.log(datos);

        // Validar que los campos no estén vacíos
        if (!datos.id || !datos.usuario   || !datos.rol) {
            alert('Por favor complete todos los campos');
            return;
        }

        $.ajax({
            async: true,
            type: 'POST',
            data: datos,
            url: '../php/usrEditarUsuario.php',
            beforeSend: function() {
                loadGralOn();
            },
            success: function(dat) {
                loadGralOff();
                dat = $.parseJSON(dat);
                if (dat.success) {
                    alert('Usuario actualizado correctamente');
                    $('#modalEditarUsuario').modal('hide');
                    getUsuarios(); // Recargar la tabla
                } else {
                    alert('Error: ' + dat.message);
                }
            },
            timeout: 16000,
            error: function(xhr, status, error) {
                loadGralOff();
                alert('Error: ' + error);
            }
        });
    }

    function borrarUsuario(idusuario, codigoSolicitud) {
        $.confirm({
            title: "Baja de Usuario",
            type: "red",
            content: "Confirme la baja del usuario: <b>" + idusuario + "</b>, con usuario: <b>" + codigoSolicitud +
                "</b>. Detalle brevemente la(s) razon(es):<br> <textarea id='observacion' rows='6' cols='40' class= 'form-control' placeholder='Escribe aquí el detalle...'></textarea><br><br>",
            buttons: {
                confirmar: {
                    text: "Confirmar Baja",
                    btnClass: "btn-red",
                    action: function() {

                        var datos = {
                            idusuario: idusuario,
                            observacion: $('#observacion').val(),

                        };
                        console.log(datos);
                        $.ajax({
                            async: true,
                            type: 'POST',
                            data: datos,
                            url: '../php/usrBajaSolicitud.php',
                            beforeSend: function() {
                                loadGralOn();
                            },
                            success: function(dat) {
                                loadGralOff();
                                console.log(dat);
                                dat = $.parseJSON(dat);
                                if (dat.success) {
                                    alert('Usuario dado de baja correctamente');
                                    getUsuarios(); // Recargar tabla en lugar de redirigir
                                } else {
                                    alert('Error: ' + dat.message);
                                }

                            },
                            timeout: 16000,
                            error: function(xhr, status, error) {
                                loadGralOff();
                                alert('Error: ' + error);
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