<?php
session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
foreach ($_GET as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
$conn = new Conexion();
$cons = $conn->conectar();

if (isset($filtroFechaIni) and trim($filtroFechaIni) != '' and isset($filtroFechaFin) and trim($filtroFechaFin) != '') {
    $filtro .= " and a.fecha_registro::DATE  BETWEEN TO_DATE( '$filtroFechaIni', 'YYYY-MM-DD') AND TO_DATE( '$filtroFechaFin', 'YYYY-MM-DD') ";
}

if (isset($filtroCodigoSolicitud) and trim($filtroCodigoSolicitud) != '') {
    $filtro .= " and a.cite like '%$filtroCodigoSolicitud%' ";
}

// Query to get the maximum correlative for the given unit and code
$query = "select idcite, TO_CHAR(a.fecha_registro::timestamp, 'DD/MM/YYYY HH24:MI:SS') fecha,  b.usuario, a.cite, a.referencia, a.motivo_anulacion, CASE 
        WHEN a.estado_ IS TRUE THEN 'Activo'
        WHEN a.estado_ IS FALSE THEN 'Revertido'
    END as estado, c.usuario usuario_anulacion, destino, d.usuario  usuario_solicitante, usuario_,  detalle_doc as doc_, hhrr_, e.codigo_doc
    from datm_cites a 
    left join datm_usuario b on b.id =  a.usuario_ 
    left join datm_usuario c on c.id =  a.usuario_anulacion
    left join datm_usuario d on d.id =  a.usuario_solicitante
    left join datm_cite_tipo_doc e on e.codigo_doc = a.codigo    and e.unidad = a.unidad and COALESCE(a.area, '') = COALESCE(e.area, '')
    where a.unidad like '" . $_SESSION['codigo_unidad'] . "'
        $filtro 
    order by idcite;";

$stmt = $cons->query($query);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$data = array();
$cnt = 1;
foreach ($result as $key => $cite) {

    $html = '<div style="text-align:center;">';

    $html .= '<a class="btn btn-secondary" title="ver detalle de CITE" onclick="verAnulacionCite(' . $cite['idcite'] . ', \'' . $cite['cite'] . '\')" role="button"><i class="fa fa-search" aria-hidden="true"></i></a>';
 
    if (
        $cite['estado'] == 'Activo' &&
        (
            $cite['usuario_'] == $_SESSION['idusuario'] ||
            $_SESSION['rol'] == 'SECRETARIA' ||
            $_SESSION['rol'] == 'JEFATURA'
        ) &&
        comparaFechaLimite($cite['fecha'], 1)
    ) {
        $html .= '<a class="btn btn-danger" title="Dar de baja el CITE" onclick="borrarCite(' . $cite['idcite'] . ', \'' . $cite['cite'] . '\')" role="button"><i class="fa fa-trash"></i></a>';
    } 

    if (
        (
            ($_SESSION['rol'] == 'SECRETARIA' || $_SESSION['rol'] == 'JEFATURA') &&
            $cite['estado'] == 'Activo'
        ) || (
            $cite['usuario_'] == $_SESSION['idusuario'] &&
            comparaFechaLimite($cite['fecha'], 3) &&
            $cite['estado'] == 'Activo'
        )
    ) {
        $html .= ' <br><a class="btn btn-warning" title="Editar CITE" onclick="editarCite(' . $cite['idcite'] . ', \'' . $cite['cite'] . '\')" role="button"><i class="fa fa-edit" aria-hidden="true"></i></a>';
    }
    if ($cite['codigo_doc'] == 'ITL') {
        $html .= ' <br><a class="btn btn-success" title="Generar Informe" onclick="formularioInforme(' . $cite['idcite'] . ', \'' . $cite['cite'] . '\')" role="button"><i class="fa fa-file-word-o" aria-hidden="true"></i></a>';
    }

    $html .= '</div>';


    $fila = array(
        "idcite" => $cnt,
        "fecha" =>  $cite['fecha'],
        "usuario" => ($cite['usuario'] == $cite['usuario_solicitante'] ? $cite['usuario'] : $cite['usuario_solicitante']),
        "doc" => $cite['doc_'],
        "cite" => $cite['cite'],
        "destino" => $cite['destino'],
        "referencia" => $cite['referencia'],
        "hhrr_" => $cite['hhrr_'],
        "estado" =>   $cite['estado'],
        "acciones" => $html
    );
    $cnt++;
    $data[] = $fila;
}
print_r(json_encode($data));


function comparaFechaLimite($fecha, $dias)
{
    $currentDate = new DateTime();
    $inputDate = DateTime::createFromFormat('d/m/Y H:i:s', $fecha);

    if (!$inputDate) {
        echo "Formato de fecha inválido.";
        exit;
    }

    $inputDatePlus3Days = clone $inputDate;
    $inputDatePlus3Days->modify("+$dias days");

    if ($currentDate < $inputDatePlus3Days) {
        return true;
    } else {
        return false;
    }
}
