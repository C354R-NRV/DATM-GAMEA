<?php
session_start();


require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$conn = new Conexion();
$cons = $conn->conectar();

if (isset($filtroFechaIni) and trim($filtroFechaIni) != '' and isset($filtroFechaFin) and trim($filtroFechaFin) != '') {
    $filtro .= " and (a.fecha_apersonamiento::DATE  BETWEEN TO_DATE( '$filtroFechaIni', 'YYYY-MM-DD') AND TO_DATE( '$filtroFechaFin', 'YYYY-MM-DD') or 
                d.fecha_operativo::DATE  BETWEEN TO_DATE( '$filtroFechaIni', 'YYYY-MM-DD') AND TO_DATE( '$filtroFechaFin', 'YYYY-MM-DD')  )";
}

if (isset($filtroInmueble) and trim($filtroInmueble) != '') {
    $condicion = '';
    if (filter_var($filtroInmueble, FILTER_VALIDATE_INT) !== false) {
        $condicion = " or a.no_formulario = $filtroInmueble";
    }

    $filtro .= 

    "and (
    
        a.numero_inmueble like '$filtroInmueble'  
        $condicion
        or
        
            (
            (
        SELECT string_agg ( ltrim( x, '0' ), '-' ) FROM UNNEST ( string_to_array( A.codigo_catastral, '-' ) ) x ) = ( SELECT string_agg ( ltrim( x, '0' ), '-' ) FROM UNNEST ( string_to_array( '$filtroInmueble', '-' ) ) x )
        )
    
    )";

}

$query = "
    select 
        a.id,
        x.detalle ,x.idprepredial,
        d.operativo||'/'||b.grupo as grupo,
        c.usuario,
            a.nombre_razon, 
            a.nombre_apoderado, 
            trim(a.ubicacion_nivel1||' '||a.ubicacion_nivel2 ||' '||a.ubicacion_nivel3 ||' '||a.descripcion||' #'||a.no_puerta) as direccion, 
            a.codigo_catastral, 
            a.no_formulario,
            a.via as dato_tecnico_via,
            CASE 
            WHEN (
            SELECT string_agg(s.servicio, ', ') 
            FROM uf_predrial_servicio ps
            JOIN uf_servicios s ON ps.idservicio = s.idservicio
            WHERE ps.idpredial = a.id
            ) IN (
            'LUZ, AGUA, ALCANTARILLADO, GAS, TELEFONO',
            'TODOS, LUZ, AGUA, ALCANTARILLADO, GAS, TELEFONO'
            )
            THEN 'TODOS'
            ELSE (
            SELECT string_agg(s.servicio, ', ') 
            FROM uf_predrial_servicio ps
            JOIN uf_servicios s ON ps.idservicio = s.idservicio
            WHERE ps.idpredial = a.id
            )
        END AS dato_tecnico_servicio,
            a.tipologia as dato_tecnico_tipologia,
            a.no_plantas as construccion_plantas,
            a.no_concluidos as construccion_concluidas,
            a.no_brutos as construccion_construccion,
            'https://datm.elalto.gob.bo/pages/ufPredialList.php?i='||a.numero_inmueble as enlace,
            a.numero_inmueble,
            a.descripcion,
            a.cant_act,
            a.descripcion_act,
            a.hhrr,
            to_char( a.fecha_apersonamiento, 'DD/MM/YYYY') AS fecha_apersonamiento ,
            estado_fiscalizacion,
            observacion_estado
        from uf_predial a 
        left join uf_grupo_operativo b on a.idusuario = b.idusuario
        left join uf_operativo d on d.idoperativo = b.idoperativo
        left join datm_usuario c on c.id = b.idusuario
        LEFT JOIN uf_prepredial x ON x.idpredial_asociado = a.id 
        left join uf_estado_fiscalizacion f on f.idestado_fiscalizacion = a.idestado_fiscalizacion
        where  a.estado_  
        and a.clasificacion = 'A' 
        AND d.fecha_operativo::DATE = a.fecha_apersonamiento::DATE 
        
        $filtro 
        
        order by a.id desc
        limit 300 ; 
";



$stmt = $cons->query($query);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$data = array();

$cnt = 1;
foreach ($result as $key => $item) {

    $html = '<div style="text-align:center;">';

    $html .= '<a class="btn btn-secondary" title="Ver historial" onclick="verHistorialPredial(\'' . $item['numero_inmueble'] . '\')" role="button"><i class="fa fa-history" style="color:#fff;" aria-hidden="true"></i></a> ';
    $iconoEstado = '<a class="btn btn-warning" ><i class="fa fa-user-secret"  aria-hidden="true"></i></a>';
    if ($item['estado_fiscalizacion'] == 'PROCESADO')
        $iconoEstado = '<a class="btn btn-success"  title="' . $item['observacion_estado'] . '" ><i class="fa fa-user-plus" onclick="verHistorialEstado(\'' . $item['numero_inmueble'] . '\')"   aria-hidden="true"></i></a>';
    if ($item['estado_fiscalizacion'] == 'DESACATO')
        $iconoEstado = '<a class="btn btn-danger"  title="' . $item['observacion_estado'] . '" ><i class="fa fa-user-times" onclick="verHistorialEstado(\'' . $item['numero_inmueble'] . '\')"  aria-hidden="true"></i></a>';


    $html .= '</div>';

    $auxActividad = '-';
    if ($item['cant_act'] > 0 and $item['cant_act'] != '')
        $auxActividad = 'Con actividad economica (' . $item['cant_act'] . ') ';

    $fila = array(
        "id" => $item['id'],
        "grupo" =>  $item['grupo'],
        "usuario" =>  $item['usuario'],
        "numero_inmueble" =>  $item['numero_inmueble'],
        "codigo_catastral" => normalizarCodigo($item['codigo_catastral']),
        "nombre_razon" => $item['nombre_razon'],
        "no_formulario" => $item['no_formulario'],
        "fecha_apersonamiento" =>  $item['fecha_apersonamiento'],
        "actividad" =>  $auxActividad,
        "estado_fiscalizacion" =>  $item['estado_fiscalizacion'] . " " . $iconoEstado,
        "acciones" => $html
    );
    $cnt++;
    $data[] = $fila;
}
print_r(json_encode($data));

function normalizarCodigo($cadena)
{
    $cadena = (string) ($cadena ?? '');
    $partes = explode('-', $cadena);
    $partesNormalizadas = array_map(function ($parte) {
        return ltrim($parte, '0');
    }, $partes);
    return strtolower(implode('-', $partesNormalizadas));
}

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
