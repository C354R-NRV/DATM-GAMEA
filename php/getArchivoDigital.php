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
    $filtro .= " and a.fregistro_::DATE  BETWEEN TO_DATE( '$filtroFechaIni', 'YYYY-MM-DD') AND TO_DATE( '$filtroFechaFin', 'YYYY-MM-DD') ";
}

if (isset($no_registro) and trim($no_registro) != '') {
    $filtro .= " and a.codigo_archivo like '$no_registro%' ";
}

$query = "SELECT a.idarchivo, c.rubro, c.idrubro,  a.codigo_archivo, a.estante, a.nivel, a.fregistro_::DATE as fregistro_, b.usuario 
            from ga_archivo a 
            left join datm_usuario b on a.idusuario_ = b.id  
            left join exc_rubro c on a.idrubro = c.idrubro 
            where a.estado_ 
                $filtro  
            order by a.idarchivo asc";

$stmt = $cons->query($query);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$data = array();
$cnt = 1;
foreach ($result as $key => $item) {

    $html = '<div style="text-align:center;">';
    $rubro = '2_INMUEBLES';
    switch ($item['rubro']) {
        case 'VEHICULO':
            $rubro = '1_VEHICULOS';
            break;
        case 'ACTIVIDAD ECONOMICA':
            $rubro = '3_ACT_ECON';
            break;
        case 'TASAS Y PATENTES':
            $rubro = '4_TASAS_PATENTES';
            break;
        case 'OTROS':
            $rubro = '5_OTROS';
            break;
    }

    $link   = 'downloadArchivoDigital.php?file=' . rawurlencode($item['codigo_archivo']) . '&r=' . $item['idrubro'] . '&i=' . $item['idarchivo'];
    $html .= '<a class="btn btn-primary " href="' . $link . '" target="_blank"  role="button"><i class="fa fa-search"></i></a> | 
                <a class="btn btn-warning " onclick="editarUbicacion(' . $item['idarchivo'] . ',\'' . $item['codigo_archivo'] . '\',' . ($item['estante'] ? $item['estante'] : 0) . ',' . ($item['nivel'] ? $item['nivel'] : 0) . ')" role="button"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
                <!-- |
                <a class="btn btn-warning " onclick="formActuado(' . $item['idarchivo'] . ')" role="button"><i class="fa fa-edit"></i></a>  |
                <a class="btn btn-danger " onclick="borrarCompendio(' . $item['idarchivo'] . ')" role="button"><i class="fa fa-trash-o"></i></a> -->';

    $html .= '</div>';

    $fila = array(
        "idarchivo" => $cnt,
        "rubro" =>  $item['rubro'],
        "codigo_archivo" =>   $item['codigo_archivo'],
        "estante" => $item['estante'],
        "nivel" => $item['nivel'],
        "fregistro" => $item['fregistro_'],
        "usuario" => $item['usuario'],
        "acciones" => $html
    );
    $cnt++;
    $data[] = $fila;
}
print_r(json_encode($data));
