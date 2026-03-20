<!DOCTYPE html>
<?php
session_start();
require_once '../vendor/autoload.php';

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('../views');
$twig = new Environment($loader);

if (!isset($_SESSION['swlogin']) || $_SESSION['swlogin'] != 1) {
    echo "<script>window.location.href = 'index.php';</script>";
    exit;
}

$idoperativo = isset($_GET['id']) ? $_GET['id'] : 0;
?>
<html lang="es">

<head>
    <title>Asignación - Operativo</title>
    <?php echo $twig->render('linkStyle.twig'); ?>
    <link href="../css/styleRecursoIa.css" rel="stylesheet">
    <!-- Dragula for Drag and Drop -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.3/dragula.min.css" rel="stylesheet">
    <style>
        .kanban-board {
            display: flex;
            overflow-x: auto;
            padding: 20px 0;
            gap: 20px;
            align-items: flex-start;
            min-height: calc(100vh - 200px);
        }

        .kanban-col {
            min-width: 300px;
            width: 300px;
            background: #f8f9fa;
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
        }

        .kanban-header {
            font-weight: bold;
            text-align: center;
            padding: 10px;
            background: #e9ecef;
            border-radius: 5px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .kanban-header h5 { margin: 0; font-size: 1rem; }

        .kanban-items {
            flex-grow: 1;
            min-height: 100px; /* Drop zone area */
        }

        .user-card {
            background: white;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            cursor: move;
            border-left: 4px solid #007bff;
        }
        
        .user-card:hover { box-shadow: 0 3px 6px rgba(0,0,0,0.15); }

        .user-card .name { font-weight: bold; font-size: 0.95rem; }
        .user-card .role { font-size: 0.8rem; color: #6c757d; }

        .gu-mirror { position: fixed !important; margin: 0 !important; z-index: 9999 !important; opacity: 0.8; }
        .gu-hide { display: none !important; }
        .gu-unselectable { -webkit-user-select: none !important; -moz-user-select: none !important; -ms-user-select: none !important; user-select: none !important; }
        .gu-transit { opacity: 0.2; -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=20)"; filter: alpha(opacity=20); }

        .add-group-btn {
            min-width: 300px;
            border: 2px dashed #ccc;
            border-radius: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #6c757d;
            cursor: pointer;
            height: 100px;
        }
        .add-group-btn:hover { background: #f8f9fa; color: #007bff; border-color: #007bff; }
    </style>
</head>

<body>
    <?php echo $twig->render('load.twig'); ?>
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

    <!-- Her Start -->
    <?php echo $twig->render('prebodyltIni.twig'); ?>
    <li class="breadcrumb-item"><a class="text-white" href="ufOperativoList.php">Operativos</a></li>
    <li class="breadcrumb-item text-white active" aria-current="page">Asignación</li>
    <?php echo $twig->render('prebodyltFin.twig'); ?>
    <!-- Hero End -->

    <div class="contenedorDigitaliza">
        <h4 class="mb-3">Asignación de Usuarios - <span id="nombreOperativo">Cargando...</span></h4>
        <input type="hidden" id="idoperativo" value="<?php echo $idoperativo; ?>">
        
        <div class="kanban-board" id="kanbanBoard">
            <!-- Columna Usuarios Disponibles -->
            <div class="kanban-col" id="col-available">
                <div class="kanban-header">
                    <h5>Disponibles</h5>
                    <span class="badge bg-secondary" id="count-available">0</span>
                </div>
                <!-- Search Box -->
                <input type="text" class="form-control form-control-sm mb-2" id="searchAvailable" placeholder="Buscar usuario...">
                
                <div class="kanban-items" id="lane-available" data-group="">
                    <!-- Users loaded via JS -->
                </div>
            </div>

            <!-- Columna Agregar Grupo -->
            <div class="add-group-btn" onclick="addGroupPrompt()">
                <div><i class="fa fa-plus-circle fa-2x"></i><br>Nuevo Grupo</div>
            </div>
        </div>
    </div>

    <?php echo $twig->render('linkJs.twig'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.3/dragula.min.js"></script>

    <script>
        const idoperativo = $('#idoperativo').val();
        let drake;

        $(document).ready(function() {
            loadKanbanData();

            // Search functionality for Available column
            $('#searchAvailable').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $("#lane-available .user-card").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        function loadKanbanData() {
            $.ajax({
                url: '../php/getOperativoDetails.php',
                data: { idoperativo: idoperativo },
                dataType: 'json',
                success: function(data) {
                    $('#nombreOperativo').text(data.operativo + ' (' + data.fecha_operativo + ')');
                }
            });

            $.ajax({
                url: '../php/getKanbanData.php',
                data: { idoperativo: idoperativo },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        renderBoard(response);
                    } else {
                        $.alert(response.message);
                    }
                }
            });
        }

        function renderBoard(data) {
            // Clear existing Dynamic columns (keep Available and Add Btn)
            $('.kanban-col-dynamic').remove();
            $('#lane-available').empty();

            // Setup Dragula containers
            let containers = [document.getElementById('lane-available')];

            // 1. Render Available Users
            data.available_users.forEach(user => {
                $('#lane-available').append( createUserCard(user) );
            });
            $('#count-available').text(data.available_users.length);

            // 2. Render Groups
             // If no groups exist in the DB for this operativo yet, data.groups might be empty.
             // We can allow creating them.
            
            // We need to map assigned users to their groups
            let groupUsers = {};
            data.assigned_users.forEach(u => {
                if(!groupUsers[u.grupo]) groupUsers[u.grupo] = [];
                groupUsers[u.grupo].push(u);
            });

            // Merge explicit groups list with keys from assigned users (just in case)
            let allGroups = new Set([...data.groups, ...Object.keys(groupUsers)]);
            
            allGroups.forEach(groupName => {
                createGroupColumn(groupName, groupUsers[groupName] || []);
            });

            // Re-init Dragula
            if (drake) drake.destroy();
            
            // Get all lane containers
            let lanes = document.querySelectorAll('.kanban-items');
            drake = dragula(Array.from(lanes)).on('drop', function (el, target, source, sibling) {
                let idusuario = el.getAttribute('data-id');
                let targetGroup = target.getAttribute('data-group'); // "" for available, "GroupName" for groups
                let sourceGroup = source.getAttribute('data-group');

                if (targetGroup === sourceGroup) return; // No change

                if (targetGroup === "") {
                    // Moving back to Available -> Unassign
                    updateAssignment(idusuario, 'unassign', '');
                } else {
                    // Moving to a group -> Assign/Move
                    updateAssignment(idusuario, 'assign', targetGroup);
                }
                
                // Update counts
                updateCounts();
            });
        }

        function createGroupColumn(groupName, users) {
            let colHtml = `
                <div class="kanban-col kanban-col-dynamic">
                    <div class="kanban-header">
                        <h5>${groupName}</h5>
                        <span class="badge bg-primary count-badge">${users.length}</span>
                    </div>
                    <div class="kanban-items" id="lane-${groupName.replace(/\s+/g, '-')}" data-group="${groupName}">
                        <!-- Users go here -->
                    </div>
                </div>
            `;
            
            // Insert before the Add Button
            $(colHtml).insertBefore('.add-group-btn');
            
            let laneId = `lane-${groupName.replace(/\s+/g, '-')}`;
            let laneEl = document.getElementById(laneId);
            
            users.forEach(u => {
                $(laneEl).append( createUserCard({
                    id: u.idusuario,
                    nombres: u.nombres,
                    primer_apellido: u.primer_apellido,
                    segundo_apellido: u.segundo_apellido,
                    // role/cargo not always available in assigned_users join, can leave generic or fetch
                    cargo: u.usuario 
                }) );
            });
        }

        function createUserCard(user) {
            let fullName = `${user.nombres} ${user.primer_apellido} ${user.segundo_apellido || ''}`;
            return `
                <div class="user-card" data-id="${user.id}">
                    <div class="name">${fullName}</div>
                    <div class="role"><i class="fa fa-user"></i> ${user.cargo || 'Usuario'}</div>
                </div>
            `;
        }

        function updateAssignment(idusuario, action, grupo) {
            $.ajax({
                url: '../php/saveGrupoOperativo.php',
                type: 'POST',
                data: {
                    action: action,
                    idoperativo: idoperativo,
                    idusuario: idusuario,
                    grupo: grupo
                },
                success: function(response) {
                    let res = JSON.parse(response);
                    if(res.status !== 'success') {
                        toastr.error(res.message);
                        // Revert move? (Complex with Dragula without reload, simplified here by reloading if error)
                        loadKanbanData(); 
                    } else {
                        toastr.success(res.message);
                    }
                }
            });
        }

        function addGroupPrompt() {
            $.confirm({
                title: 'Nuevo Grupo',
                content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<label>Nombre del Grupo</label>' +
                '<input type="text" placeholder="Ej. G1" class="name form-control" required />' +
                '</div>' +
                '</form>',
                buttons: {
                    formSubmit: {
                        text: 'Crear',
                        btnClass: 'btn-blue',
                        action: function () {
                            var name = this.$content.find('.name').val();
                            if(!name){
                                $.alert('Ingrese un nombre válido');
                                return false;
                            }
                            // Just add the column visually. It will be saved when a user is dropped into it.
                            createGroupColumn(name, []);
                             // Re-init Dragula to include new container
                            let lanes = document.querySelectorAll('.kanban-items');
                            if (drake) drake.destroy();
                            drake = dragula(Array.from(lanes)).on('drop', function (el, target, source, sibling) {
                                // Same handler as above
                                let idusuario = el.getAttribute('data-id');
                                let targetGroup = target.getAttribute('data-group');
                                let sourceGroup = source.getAttribute('data-group');
                                if (targetGroup === sourceGroup) return; 

                                if (targetGroup === "") {
                                    updateAssignment(idusuario, 'unassign', '');
                                } else {
                                    updateAssignment(idusuario, 'assign', targetGroup);
                                }
                                updateCounts();
                            });
                        }
                    },
                    cancel: function () {
                        //close
                    },
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click');
                    });
                }
            });
        }
        
        function updateCounts() {
             $('#count-available').text( $('#lane-available .user-card').length );
             $('.kanban-col-dynamic').each(function() {
                 let count = $(this).find('.user-card').length;
                 $(this).find('.count-badge').text(count);
             });
        }

    </script>
</body>
</html>
