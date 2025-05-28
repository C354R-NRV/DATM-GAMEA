<?php
session_start();
require_once './conexionpsql.php';

// Initialize response array
$pjson = array(
    'err' => '0',
    'sql' => '',
    'html' => '',
    'msg' => '',
    'log' => ''
);
$conn = new Conexion();
$cons = $conn->conectar();

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

try {

    $filtro  = '';
    if ($numInmueble != '') {
        $filtro .= " and trim(numero_inmueble) = trim('$numInmueble') ";
    }
    if ($nombreTitular != '') {
        $filtro .= " and trim(upper(concat(nombre_rsocial, ' ', primer_apellido_sigla, ' ', segundo_apellido, ' ', apellido_esposo)))   like upper(concat('%', replace('$nombreTitular', ' ', '%'),'%'))  ";
    }
    if ($documento != '') {
        $filtro .= " and trim(documento_identidad)  like '$documento%' ";
    }
    if ($catastral != '') {
        $filtro .= " and trim(codigo_catastral)  like '$catastral%' ";
    }

    $query = "SELECT 
            a.numero_inmueble, 
            a.codigo_catastral,  

            TRIM(REPLACE(REPLACE(REPLACE(REPLACE(
                COALESCE(b.ubicacion_nivel1, a.ubicacion_nivel1), 
                'DISTRITO:', ''), 
                'LOTE,', ''), 
                'COMUNIDAD:', ''), 
                'URBANIZACION,', '')
            ) AS ubicacion_nivel1,

            TRIM(REPLACE(REPLACE(REPLACE(
                COALESCE(b.ubicacion_nivel2, a.ubicacion_nivel2), 
                'LOTE,', ''), 
                'COMUNIDAD:', ''), 
                'URBANIZACION,', '')
            ) AS ubicacion_nivel2, 

            TRIM(REPLACE(REPLACE(REPLACE(
                COALESCE(b.ubicacion_nivel3, a.ubicacion_nivel3), 
                'LOTE,', ''), 
                'COMUNIDAD:', ''), 
                'URBANIZACION,', '')
            ) AS ubicacion_nivel3,

            COALESCE(b.contacto_titular, a.telefono_celular) AS telefono_celular,  

            COALESCE(b.descripcion, a.direccion_descriptiva) AS direccion_descriptiva, 

            TRIM(UPPER(
                COALESCE(b.nombre_razon, CONCAT(a.nombre_rsocial, ' ', a.primer_apellido_sigla, ' ', a.segundo_apellido, ' ', a.apellido_esposo))
            )) AS nombre_tit, 

            TRIM(UPPER(
                COALESCE(b.nombre_apoderado, CONCAT(a.nombre_apo, ' ', a.primer_apellido_apo, ' ', a.segundo_apellido_apo))
            )) AS nombre_apo, 

            a.documento_identidad, 

            COALESCE(b.via, a.material_via) AS material_via,
            COALESCE(b.no_puerta, a.numero_puerta) AS numero_puerta,
            COALESCE(b.tipologia, a.tipo_construccion) AS tipo_construccion,

            a.servicio, 
            (SELECT string_agg(s.servicio, ', ') 
                FROM uf_predrial_servicio ps
                JOIN uf_servicios s ON ps.idservicio = s.idservicio
                WHERE ps.idpredial = b.id ) servicio_uf, 
                
            b.no_plantas, 
            b.no_concluidos,
            b.no_brutos, 
            b.contacto_apoderado, 
            b.latitud, 
            b.longitud

        FROM inmueble_univ a
        LEFT JOIN (
            SELECT DISTINCT ON (numero_inmueble) *
            FROM uf_predial
            ORDER BY uf_predial.numero_inmueble, uf_predial.id DESC  
        ) b ON b.numero_inmueble::text = a.numero_inmueble::text
    where 1=1 
    $filtro  
    ";

    $stmt = $cons->query($query);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $tabla = '';
    $cnt = 0;
    foreach ($resultados as $key => $value) {
        $tabla .= "<tr>
            <td>" . $value['numero_inmueble'] . "</td>
            <td>" . $value['codigo_catastral'] . "</td>
            <td>" . $value['documento_identidad'] . "</td> 
            <td>" . $value['nombre_tit'] . "</td>  
            <td>" . $value['ubicacion_nivel1'] . " " . $value['ubicacion_nivel2'] . " " . $value['ubicacion_nivel3'] . " " . $value['numero_puerta'] . " "  . "</td>
            <td aling='center' style='text-align:center;'>
                <input type='hidden' value='" . $value['numero_inmueble'] . "' id='numero_inmueble$cnt'>
                <input type='hidden' value='" . $value['codigo_catastral'] . "' id='codigo_catastral$cnt'>
                <input type='hidden' value='" . $value['documento_identidad'] . "' id='documento_identidad$cnt'>
                <input type='hidden' value='" . $value['nombre_tit'] . "' id='nombre_tit$cnt'>
                <input type='hidden' value='" . $value['ubicacion_nivel1'] . "' id='ubicacion_nivel1$cnt'>
                <input type='hidden' value='" . $value['ubicacion_nivel2'] . "' id='ubicacion_nivel2$cnt'>
                <input type='hidden' value='" . $value['ubicacion_nivel3'] . "' id='ubicacion_nivel3$cnt'>
                <input type='hidden' value='" . $value['numero_puerta'] . "' id='numero_puerta$cnt'>
                <input type='hidden' value='" . $value['nombre_apo'] . "' id='nombre_apo$cnt'>
                <input type='hidden' value='" . $value['direccion_descriptiva'] . "' id='direccion_descriptiva$cnt'>
                <input type='hidden' value='" . $value['material_via'] . "' id='material_via$cnt'>
                <input type='hidden' value='" . $value['servicio'] . "' id='servicio$cnt'>
                <input type='hidden' value='" . $value['servicio_uf'] . "' id='servicio_uf$cnt'>
                <input type='hidden' value='" . $value['telefono_celular'] . "' id='telefono_celular$cnt'>
                <input type='hidden' value='" . $value['tipo_construccion'] . "' id='tipo_construccion$cnt'>

                <input type='hidden' value='" . $value['no_plantas'] . "' id='no_plantas$cnt'>
                <input type='hidden' value='" . $value['no_concluidos'] . "' id='no_concluidos$cnt'>
                <input type='hidden' value='" . $value['no_brutos'] . "' id='no_brutos$cnt'>
                <input type='hidden' value='" . $value['contacto_apoderado'] . "' id='contacto_apoderado$cnt'>
                <input type='hidden' value='" . $value['latitud'] . "' id='latitud$cnt'>
                <input type='hidden' value='" . $value['longitud'] . "' id='longitud$cnt'>

                <button class='seleccionar-btn' onclick='seleccionarInmueble($cnt)'><i class='fa fa-hand-pointer-o' aria-hidden='true'></i></button>
            </td>
        </tr>";
        $cnt++;
    }
    $pjson['sql'] = $query;
    $pjson['html'] = $tabla;
} catch (Exception $e) {
    $pjson['err'] = '1';
    $pjson['msg'] = $e->getMessage();
    $pjson['log'] = $e->getTraceAsString();
} catch (PDOException $e) {
    $pjson['err'] = '1';
    $pjson['msg'] = 'Error de base de datos';
    $pjson['log'] = $e->getMessage();
} catch (Error $e) {
    $pjson['err'] = '1';
    $pjson['msg'] = 'Error interno del servidor';
    $pjson['log'] = $e->getMessage();
} finally {
    // Always return a JSON response
    header('Content-Type: application/json');
    echo json_encode($pjson);
    exit;
}
