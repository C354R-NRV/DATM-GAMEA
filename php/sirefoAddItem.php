<?php
session_start();
require_once './conexionpsql.php';
foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$conn = new Conexion();
$cons = $conn->conectar();
$query = "select * from srf_documento_identidad_tipo where estado_ is true";
$stmt = $cons->query($query);
$tipoDoc = $stmt->fetchAll(PDO::FETCH_ASSOC);


$query = "select * from srf_documento_identidad_extension";
$stmt = $cons->query($query);
$extension = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query = "select * from srf_tipo_respaldo where estado_ is true ";
$stmt = $cons->query($query);
$tipoRespaldo = $stmt->fetchAll(PDO::FETCH_ASSOC);

$item = '';

for ($i = $cntItemAct; $i < ($cntItemAct + $cnt); $i++) {

    $item .= '<div id="item' . $i . '" class="itemSolicitud">
    <div class="row">
        <h3>Item No ' . ($i + 1) . '.</h3>
    </div>
    <div class="row">
        <div class="col-md-3 mb-3">
            <label for="tipoPersona' . $i . '">Tipo de persona</label>
            <select class="form-controlSelect" onchange="reestructuraFormItem(' . $i . ')" id="tipoPersona' . $i . '">
                <option value="N">Natural</option>
                <option value="J">Juridico</option>
            </select>
            <br>
                <label for="tipo_documento_tributario' . $i . '">Tipo documento tributario</label>
                <select class="form-controlSelect"  id="tipo_documento_tributario' . $i . '">
                    <option value="VEH">Vehiculo</option>
                    <option value="INM">Inmueble</option>
                    <option value="ACT">Actividad Economica</option>
                </select>
        </div>
        <div class="col-md-3 mb-3">
            <label for="id_documento_identidad_tipo' . $i . '">Tipo de documento</label>
            <select class="form-controlSelect" onchange="actExtension(' . $i . ')" id="id_documento_identidad_tipo' . $i . '">';

    foreach ($tipoDoc as $row) {
        if ($row['tipo_persona'] === 'N')
            $item .= "<option value=" . $row['id_documento_identidad_tipo'] . ">" . $row['documento_identidad_tipo'] . "</option>";
    }

    $item .= '</select>
                <br>
                <label for="documento_tributario' . $i . '">Documento tributario</label>
                <input type="text" id="documentoTributario' . $i . '" class="form-control" placeholder="NRO PTA/NUM. INM/NUM ACT">
        </div>
        <div class="col-md-3 mb-3">
            <label for="documentoIdentidadNumero' . $i . '">No. Documento</label>
            <input type="text" id="documentoIdentidadNumero' . $i . '" class="form-control" placeholder="Num. documento">
            <input type="text" id="documentoIdentidadComplemento' . $i . '" class="form-control natural_' . $i . '" placeholder="Complemento">
            <select class="form-controlSelect natural_' . $i . '"  id="id_documento_identidad_extension' . $i . '">';

    foreach ($extension as $row) {
        $item .=  "<option value=" . $row['id_documento_identidad_extension'] . ">" . $row['documento_identidad_extension_det'] . "</option>";
    }


    $item .= '</select>
        </div>
        <div class="col-md-3 mb-3" id="forrazonSocial">
            <label for="razonSocial' . $i . '"><span class="natural_' . $i . '">Nombre completo</span><span class="juridico_' . $i . ' oculto_">Razón social</span></label>
            <input type="text" id="razonSocial' . $i . '" class="form-control juridico_' . $i . ' oculto_" placeholder="Razon social"> 
            <input type="text" id="nombre' . $i . '" class="form-control natural_' . $i . '" placeholder="Nombres">
            <input type="text" id="apellidoPaterno' . $i . '" class="form-control natural_' . $i . '" placeholder="Apellido Paterno">
            <input type="text" id="apellidoMaterno' . $i . '" class="form-control natural_' . $i . '" placeholder="Apellido Materno">
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 mb-3" id="bloqueAutoConclusion' . $i . '" '.($tipoProceso == 'R' ? ' style="display:none;"' : '') .'>
            <label for="autoConclusion' . $i . '">Auto Conclusión</label>
            <input type="text" id="autoConclusion' . $i . '" '. ' class="form-control" placeholder="Auto de Conclusion">
        </div>
        
        <div class="col-md-3 mb-3" id="bloqueResolucionDeterminativa' . $i . '" '.($tipoProceso == 'S' ? ' style="display:none;"' : '') .'>
            <label for="resolucionDeterminativa' . $i . '">Resolución Determinativa</label>
            <input type="text" id="resolucionDeterminativa' . $i . '" class="form-control" placeholder="Cite de resolución determinativa">
            <input type="text" id="gestionFiscal' . $i . '" class="form-control" placeholder="Gestion(en) fiscal(es)">
            <input type="text" id="cite_anotacion_preventiva' . $i . '" class="form-control" placeholder="Cite para inscripcion de anotación preventiva">
        </div>

        <div class="col-md-3 mb-3">
            <label for="id_tipo_respaldo' . $i . '">Tipo de Respaldo</label>
            <select class="form-controlSelect" id="id_tipo_respaldo' . $i . '">';

    foreach ($tipoRespaldo as $row) {
        $item .=   "<option value=" . $row['id_tipo_respaldo'] . ">" . $row['tipo_respaldo_det'] . "</option>";
    }
    $item .=   '</select>
        </div>
        <div class="col-md-3 mb-3">
            <label for="documentoRespaldo' . $i . '">Documento de respaldo</label>
            <input type="text" id="documentoRespaldo' . $i . '" class="form-control" placeholder="Numero de documento respecto del PIET o PC">
        </div>
        <div class="col-md-3 mb-3">
            <label for="montoRetencionBs' . $i . '">Monto Retención</label>
            <input type="number" id="montoRetencionBs' . $i . '" class="form-control"  placeholder="En Bs.">
            <input type="hidden" id="montoRetencionUFV' . $i . '" class="form-control" value="0" disabeld  placeholder="En UFV\'s">
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 mb-3">
            <input type="hidden" id="id_item_solicitud' . $i . '"/>
            <button type="button" class="btn btn-danger" id="search-button" onclick="quitarItem(' . $i . ')"><i class="fa fa-trash"></i></button>
        </div>
    </div>
    <hr>
</div>
';
}

$resp['items']  = $item;
$resp['tipoDoc']  = $tipoDoc;
$resp['extension']  = $extension;
$resp['tipoRespaldo']  = $tipoRespaldo;
$dat = json_encode($resp);
echo $dat;

