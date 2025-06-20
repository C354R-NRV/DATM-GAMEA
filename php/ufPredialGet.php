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
    if (is_array($valor)) {
        $$clave = array_map(function ($v) {
            return addslashes(trim($v));
        }, $valor);
    } else {
        // Si el valor contiene comas, convertirlo a array
        if (strpos($valor, ',') !== false && in_array($clave, ['ubicacion2', 'ubicacion3'])) {
            $$clave = array_map(function ($v) {
                return addslashes(trim($v));
            }, explode(',', $valor));
        } else {
            $$clave = addslashes(trim($valor));
        }
    }
}

try {
    // Función para generar filtros con valores predefinidos vs escritos manualmente
    function generarFiltroUbicacion($valores, $campo, $valoresPredefinidos)
    {
        if (empty($valores)) {
            return '';
        }

        // Si no es array, convertirlo a array
        if (!is_array($valores)) {
            // Si contiene comas, dividir por comas
            if (strpos($valores, ',') !== false) {
                $valores = explode(',', $valores);
            } else {
                $valores = array($valores);
            }
        }

        // Limpiar y filtrar valores vacíos, 'TODOS', 'null'
        $valores = array_filter(array_map('trim', $valores), function ($v) {
            return !empty($v) && $v != 'TODOS' && $v != 'null';
        });

        if (empty($valores)) {
            return '';
        }

        $condiciones = array();

        foreach ($valores as $valor) {
            $valor = strtoupper(trim($valor));

            // Si el valor está en los predefinidos, usar comparación exacta
            if (in_array($valor, $valoresPredefinidos)) {
                if ($valor == '5') {
                    $condiciones[] = "(trim($campo) like '% $valor' or TRIM(replace(replace(replace(replace($campo, 'DISTRITO:', ''), 'LOTE,', ''), 'COMUNIDAD:', ''), 'URBANIZACION,', '')) = '%:$valor')";
                } elseif ($valor == 'OTRA JURISDICCION') {
                    $condiciones[] = "TRIM(replace(replace(replace(replace($campo, 'DISTRITO:', ''), 'LOTE,', ''), 'COMUNIDAD:', ''), 'URBANIZACION,', '')) like '%$valor'";
                } else {
                    $condiciones[] = "TRIM(replace(replace(replace(replace($campo, 'DISTRITO:', ''), 'LOTE,', ''), 'COMUNIDAD:', ''), 'URBANIZACION,', '')) like '%$valor'";
                }
            } else {
                // Si es un valor escrito manualmente, usar LIKE con %
                $condiciones[] = "TRIM(replace(replace(replace(replace($campo, 'DISTRITO:', ''), 'LOTE,', ''), 'COMUNIDAD:', ''), 'URBANIZACION,', '')) like '%$valor%'";
            }
        }

        if (!empty($condiciones)) {
            return ' and (' . implode(' or ', $condiciones) . ')';
        }

        return '';
    }

    $filtro = '';

    if ($actividad_eco != '') {
        $filtro .= " and trim(documento_identidad) in (SELECT distinct documento_identidad
        FROM actividad_univ a where upper(a.razon_social) like upper ('%$actividad_eco%' )) ";
    }
    if ($no_placa != '') {
        $filtro .= " and trim(documento_identidad) in ( SELECT  documento_identidad
        FROM vehiculo_univ a where upper(a.nro_pta) like upper ('%$no_placa%') ) ";
    }

    // Valores predefinidos para ubicacion1
    $valoresPredefinidosNivel1 = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', 'NO DEFINIDO', 'OTRA JURISDICCION', 'TODOS');

    // Aplicar filtro para ubicacion1 si no es 'TODOS'
    if ($ubicacion1 != 'TODOS' && !empty($ubicacion1)) {
        $filtro .= generarFiltroUbicacion($ubicacion1, 'a.ubicacion_nivel1', $valoresPredefinidosNivel1);
    }

    // Para ubicacion2, necesitamos obtener los valores predefinidos dinámicamente
    $valoresPredefinidosNivel2 = array('TODOS');
    if (!empty($ubicacion2)) {
        // Construir filtro temporal para obtener valores predefinidos del nivel 2
        $filtroTemporal = '';
        if ($ubicacion1 != 'TODOS' && !empty($ubicacion1)) {
            $filtroTemporal .= generarFiltroUbicacion($ubicacion1, 'ubicacion_nivel1', $valoresPredefinidosNivel1);
        }

        $queryNivel2 = "SELECT distinct TRIM(replace(replace(replace(ubicacion_nivel2, 'LOTE,', ''), 'COMUNIDAD:', ''), 'URBANIZACION,', '')) as ubicacion from inmueble_univ where 1=1 $filtroTemporal order by TRIM(replace(replace(replace(ubicacion_nivel2, 'LOTE,', ''), 'COMUNIDAD:', ''), 'URBANIZACION,', ''));";
        $stmtNivel2 = $cons->query($queryNivel2);
        $resultadosNivel2 = $stmtNivel2->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultadosNivel2 as $row) {
            if (!empty($row['ubicacion'])) {
                $valoresPredefinidosNivel2[] = $row['ubicacion'];
            }
        }

        // Aplicar filtro para ubicacion2
        $filtro .= generarFiltroUbicacion($ubicacion2, 'a.ubicacion_nivel2', $valoresPredefinidosNivel2);
    }

    // Para ubicacion3, necesitamos obtener los valores predefinidos dinámicamente
    $valoresPredefinidosNivel3 = array('TODOS');
    if (!empty($ubicacion3)) {
        // Construir filtro temporal para obtener valores predefinidos del nivel 3
        $filtroTemporal = '';
        if ($ubicacion1 != 'TODOS' && !empty($ubicacion1)) {
            $filtroTemporal .= generarFiltroUbicacion($ubicacion1, 'ubicacion_nivel1', $valoresPredefinidosNivel1);
        }
        if (!empty($ubicacion2)) {
            $filtroTemporal .= generarFiltroUbicacion($ubicacion2, 'ubicacion_nivel2', $valoresPredefinidosNivel2);
        }

        $queryNivel3 = "SELECT distinct TRIM(replace(replace(replace(ubicacion_nivel3, 'LOTE,', ''), 'COMUNIDAD:', ''), 'URBANIZACION,', '')) as ubicacion from inmueble_univ where 1=1 $filtroTemporal order by TRIM(replace(replace(replace(ubicacion_nivel3, 'LOTE,', ''), 'COMUNIDAD:', ''), 'URBANIZACION,', ''));";
        $stmtNivel3 = $cons->query($queryNivel3);
        $resultadosNivel3 = $stmtNivel3->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultadosNivel3 as $row) {
            if (!empty($row['ubicacion'])) {
                $valoresPredefinidosNivel3[] = $row['ubicacion'];
            }
        }

        // Aplicar filtro para ubicacion3
        $filtro .= generarFiltroUbicacion($ubicacion3, 'a.ubicacion_nivel3', $valoresPredefinidosNivel3);
    }

    $numInmueble = strtoupper($numInmueble);
    if ($numInmueble != '') {
        if (str_contains($numInmueble, "INM-")) {
            $filtro .= " and trim(b.numero_inmueble) = upper(trim('$numInmueble')) ";
        } else {
            $filtro .= " and trim(a.numero_inmueble) = upper(trim('$numInmueble')) ";
        }
    }
    if ($nombreTitular != '') {
        $filtro .= " and trim(upper(concat(nombre_rsocial, ' ', primer_apellido_sigla, ' ', segundo_apellido, ' ', apellido_esposo)))   like upper(concat('%', replace('$nombreTitular', ' ', '%'),'%'))  ";
    }
    if ($documento != '') {
        $filtro .= " and trim(documento_identidad)  like '$documento%' ";
    }
    if ($catastral != '') {
        /* $filtro .= " and trim(a.codigo_catastral)  like '$catastral%' "; */
        $filtro .= "AND (
                    (
                    SELECT
                    ltrim( partes [ 1 ], '0' ) || '-' || ltrim( partes [ 2 ], '0' ) || '-' || ltrim( partes [ 3 ], '0' ) AS codigo_normalizado 
                    FROM
                    ( SELECT regexp_split_to_array( TRIM ( A.codigo_catastral ), '-' ) AS partes ) AS sub 
                    ) LIKE (
                    SELECT
                    ltrim( partes [ 1 ], '0' ) || '-' || ltrim( partes [ 2 ], '0' ) || '-' || ltrim( partes [ 3 ], '0' ) AS codigo_normalizado 
                    FROM
                    ( SELECT regexp_split_to_array( TRIM ( '$catastral' ), '-' ) AS partes ) AS sub 
                    ) || '%' 
                )";
    }

    $query = "SELECT  distinct
            COALESCE(a.numero_inmueble, b.numero_inmueble) numero_inmueble, 
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
            b.longitud ";

    if (str_contains($numInmueble, "INM-")) {
        $query .= " 
        FROM (
            SELECT DISTINCT ON (numero_inmueble) *
            FROM uf_predial
            where estado_
            ORDER BY uf_predial.numero_inmueble, uf_predial.id DESC  
        ) b 
        LEFT JOIN inmueble_univ a  ON b.numero_inmueble::text = a.numero_inmueble::text 
    where 1=1 ";
    } else {
        $query .= " 
        FROM inmueble_univ a
        LEFT JOIN (
            SELECT DISTINCT ON (numero_inmueble) *
            FROM uf_predial
            where estado_
            ORDER BY uf_predial.numero_inmueble, uf_predial.id DESC  
        ) b ON b.numero_inmueble::text = a.numero_inmueble::text
    where 1=1 ";
    }
    $query .= " $filtro ";

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
