<?php
session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
$conn = new Conexion();
$cons = $conn->conectar();

$html_ = "";

if ($_SESSION['rol'] == 'SECRETARIA') {
    $auxFiltro = ' solicitante_cite is true ';
    if ($_SESSION['codigo_unidad'] != 'DIR')
        $auxFiltro = " codigo_unidad = '" . $_SESSION['codigo_unidad'] . "'";

    $query = "select id, upper(concat(nombres, ' ', primer_apellido, ' ', segundo_apellido)) nombres from datm_usuario where  estado = 1 and $auxFiltro 
                order by nombres;";
    $stmt = $cons->query($query);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $html_ .= "<div class='col-md-12' style='padding:0.3rem 0 0.3rem 0'> <label for='usuario_solicitante'>Solicitante</label>";

    $resp = array();
    $html_ .=  "<select id='usuario_solicitante' class='form-control'>";
    if ($result) {
        foreach ($result as $row) {
            $id = htmlspecialchars($row['id']);
            $nombres = htmlspecialchars($row['nombres']);
            $html_ .= "<option value='$id'>$nombres</option>";
        }
    } else {
        $html_ .=  "<option value=''>No hay solicitantes disponibles</option>";
    }
    $html_ .=  "</select></div>";
} else {

    $html_ .= "<input type= 'hidden' id= 'usuario_solicitante' value = '" . $_SESSION['idusuario'] . "'>";
}


$query = "select codigo_doc,detalle_doc 
            from  datm_cite_tipo_doc 
            where estado_ is true and unidad like '" . $_SESSION['codigo_unidad'] . "' and COALESCE(area, '') = '" . $_SESSION['area'] . "' order by detalle_doc ;";
$stmt = $cons->query($query);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


$resp = array();
$html_ .= "<div class='col-md-12' style='padding:0.3rem 0 0.3rem 0'> <label for='tipoDocumento_'>Tipo de documento</label>";
$html_ .= "<select id='tipoDocumento_' class='form-control'>";
if ($result) {
    foreach ($result as $row) {
        $codigo_doc = htmlspecialchars($row['codigo_doc']); // Escapar caracteres especiales
        $detalle_doc = htmlspecialchars($row['detalle_doc']);
        $html_ .=  "<option value='$codigo_doc'>$detalle_doc</option>";
    }
} else {
    $html_ .=  "<option value=''>No hay documentos disponibles</option>";
}
$html_ .=  "</select>";
$html_ .= "</div>";


$html_ .= "
            <div class='col-md-12' style='padding:0.3rem 0 0.3rem 0'>
            <label for='hhrr_'>Numero de Hoja de ruta</label>
                <input type='text' id='hhrr_' class='form-control' placeholder='Hoja de ruta relacionada'  >
            </div>
            <div class='col-md-12' style='padding:0.3rem 0 0.3rem 0'>
            <label for='referencia_'>Referencia</label>
                <input type='text' id='referencia_' class='form-control' placeholder='Breve referencia'  >
            </div>
            <div class='col-md-12' style='padding:0.3rem 0 0.3rem 0'>
            <label for='destino_'>Destinatario</label>
                <input type='text' id='destino_' class='form-control' placeholder='Destinatario del documento'>
            </div>";

echo $html_;
