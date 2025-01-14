<?php
session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
$conn = new Conexion();
$cons = $conn->conectar();

// Query to get the maximum correlative for the given unit and code
$query = "select idcite, TO_CHAR(a.fecha_registro::timestamp, 'DD/MM/YYYY HH24:MI:SS') fecha,  b.usuario, a.cite, a.referencia, a.motivo_anulacion, CASE 
        WHEN a.estado_ IS TRUE THEN 'Activo'
        WHEN a.estado_ IS FALSE THEN 'Revertido'
    END as estado, c.usuario usuario_anulacion, destino, d.usuario  usuario_solicitante, usuario_,  detalle_doc as doc_, hhrr_
    from datm_cites a 
    left join datm_usuario b on b.id =  a.usuario_ 
    left join datm_usuario c on c.id =  a.usuario_anulacion
    left join datm_usuario d on d.id =  a.usuario_solicitante
    left join datm_cite_tipo_doc e on e.codigo_doc = a.codigo    and e.unidad = a.unidad and COALESCE(a.area, '') = COALESCE(e.area, '')
    where a.unidad like '" . $_SESSION['codigo_unidad'] . "' order by idcite;";

$stmt = $cons->query($query);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$data = array();
$cnt= 1;
foreach ($result as $key => $cite) {
    $fila = array(
        "idcite" => $cnt,
        "fecha" =>  $cite['fecha'],
        "usuario" => ($cite['usuario'] == $cite['usuario_solicitante']? $cite['usuario']: $cite['usuario_solicitante']),
        "doc" => $cite['doc_'],
        "cite" => $cite['cite'],
        "destino" => $cite['destino'],
        "referencia" => $cite['referencia'],
        "hhrr_" => $cite['hhrr_'],
        "estado" =>   $cite['estado'],
        "acciones" => '<div style="text-align:center;">' . 
                ( ($cite['estado'] == 'Activo' and ($cite['usuario_'] == $_SESSION['idusuario'] or $_SESSION['rol'] == 'SECRETARIA'  or $_SESSION['rol'] == 'JEFATURA')  )  ? 
                    '<a class="btn btn-danger" title="Dar de baja el CITE" onclick="borrarCite(' . $cite['idcite'] . ', \'' . $cite['cite'] . '\')" role="button"><i class="fa fa-trash"></i></a>' : 
                    '<a class="btn btn-secondary" title="ver detalle de CITE" onclick="verAnulacionCite(' . $cite['idcite'] . ', \'' . $cite['cite'] . '\')" role="button"><i class="fa fa-search" aria-hidden="true"></i></a>').
                    ((($_SESSION['rol'] == 'SECRETARIA'  or $_SESSION['rol'] == 'JEFATURA') and $cite['estado'] == 'Activo' )?' <br><a class="btn btn-warning" title="Editar CITE" onclick="editarCite(' . $cite['idcite'] . ', \'' . $cite['cite'] . '\')" role="button"><i class="fa fa-edit" aria-hidden="true"></i></a>':''). '</div>'
    );
    $cnt++;
    $data[] = $fila;
}
print_r(json_encode($data));
