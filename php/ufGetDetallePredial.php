<?php
session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$conn = new Conexion();
$cons = $conn->conectar();

if (isset($filtroFechaIni) and trim($filtroFechaIni) != '' and isset($filtroFechaFin) and trim($filtroFechaFin) != '') {
    $filtro .= " and a.fecha_registro::DATE  BETWEEN TO_DATE( '$filtroFechaIni', 'YYYY-MM-DD') AND TO_DATE( '$filtroFechaFin', 'YYYY-MM-DD') ";
}

if (isset($filtroInmueble) and trim($filtroInmueble) != '') {
    $filtro .= " and a.numero_inmueble like '$filtroInmueble' ";
}

$query = "SELECT a.numero_inmueble, a.codigo_catastral, a.nombre_razon,  to_char( a.fecha_apersonamiento, 'DD/MM/YYYY') AS  fecha_apersonamiento 
FROM uf_predial a 
INNER JOIN ( 
    SELECT numero_inmueble, MAX(id) AS max_id 
    FROM uf_predial 
    where  estado_
    GROUP BY numero_inmueble 
) b ON a.numero_inmueble = b.numero_inmueble AND a.id = b.max_id 
where 1 = 1 
        and a.estado_
    $filtro  
ORDER BY a.id;";

$stmt = $cons->query($query);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$data = array();
$cnt = 1;
foreach ($result as $key => $item) {

    $html = '<div style="text-align:center;">';

    $html .= '<a class="btn btn-secondary" title="ver historial" onclick="verHistorialPredial(\'' . $item['numero_inmueble'] . '\')" role="button"><i class="fa fa-history" style="color:#fff;" aria-hidden="true"></i></a>';

    $html .= '</div>';

    $fila = array(
        "id" => $cnt,
        "numero_inmueble" =>  $item['numero_inmueble'],
        "codigo_catastral" => $item['codigo_catastral'],
        "nombre_razon" => $item['nombre_razon'],
        "fecha_apersonamiento" =>  $item['fecha_apersonamiento'],
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

    // Verificar si la fecha ingresada es válida
    if (!$inputDate) {
        echo "Formato de fecha inválido.";
        exit;
    }

    // Sumar 3 días a la fecha ingresada
    $inputDatePlus3Days = clone $inputDate;
    $inputDatePlus3Days->modify("+$dias days");

    // Comparar las fechas
    if ($currentDate < $inputDatePlus3Days) {
        return true;
    } else {
        return false;
    }
}
