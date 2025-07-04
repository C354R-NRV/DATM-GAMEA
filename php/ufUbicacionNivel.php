<?php
session_start();
require_once './conexionpsql.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pjson = array(
    'err' => '0',
    'sql' => '',
    'queryNivel2' => '',
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
        $$clave = addslashes(trim($valor));
    }
}

$query = '';
$filtro = '';

try {
    // Función para generar filtros con valores predefinidos vs escritos manualmente
    function generarFiltroUbicacion($valores, $campo, $valoresPredefinidos)
    {
        if (empty($valores) || (is_array($valores) && count($valores) == 0)) {
            return '';
        }

        // Si no es array, convertirlo a array
        if (!is_array($valores)) {
            $valores = array($valores);
        }

        $condiciones = array();

        foreach ($valores as $valor) {
            $valor = strtoupper(trim($valor));

            if ($valor == 'TODOS') {
                $valor = '';
            }

            // Si el valor está en los predefinidos, usar comparación exacta
            if (in_array($valor, $valoresPredefinidos)) {
                if ($valor == '5') {
                    $condiciones[] = "(trim($campo) like '%$valor' or TRIM(replace(replace(replace(replace($campo, 'DISTRITO:', ''), 'LOTE,', ''), 'COMUNIDAD:', ''), 'URBANIZACION,', '')) = '%:$valor')";
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

    // Valores predefinidos para ubicacion1
    $valoresPredefinidosNivel1 = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', 'NO DEFINIDO', 'OTRA JURISDICCION', 'TODOS');

    // Aplicar filtro para ubicacion1 si no es 'TODOS'
    if ($ubicacion1 != 'TODOS') {
        $filtro .= generarFiltroUbicacion($ubicacion1, 'a.ubicacion_nivel1', $valoresPredefinidosNivel1);
    }

    if ($nivel == '2') {
        $query = "SELECT distinct TRIM(replace(replace(replace(ubicacion_nivel2, 'LOTE,', ''), 'COMUNIDAD:', ''), 'URBANIZACION,', '')) as ubicacion from inmueble_univ a where 1=1 $filtro order by TRIM(replace(replace(replace(ubicacion_nivel2, 'LOTE,', ''), 'COMUNIDAD:', ''), 'URBANIZACION,', ''));";
    }

    if ($nivel == '3') {
        $queryNivel2 = "SELECT distinct TRIM(replace(replace(replace(ubicacion_nivel2, 'LOTE,', ''), 'COMUNIDAD:', ''), 'URBANIZACION,', '')) as ubicacion from inmueble_univ a where 1=1 $filtro order by TRIM(replace(replace(replace(ubicacion_nivel2, 'LOTE,', ''), 'COMUNIDAD:', ''), 'URBANIZACION,', ''));";
        $stmtNivel2 = $cons->query($queryNivel2);
        $pjson['queryNivel2'] = $queryNivel2;
        $resultadosNivel2 = $stmtNivel2->fetchAll(PDO::FETCH_ASSOC);

        $valoresPredefinidosNivel2 = array('TODOS');
        foreach ($resultadosNivel2 as $row) {
            $valoresPredefinidosNivel2[] = $row['ubicacion'];
        }
        if ($ubicacion2 != 'TODOS') {
            $filtro .= generarFiltroUbicacion($ubicacion2, 'a.ubicacion_nivel2', $valoresPredefinidosNivel2);
        }

        $query = "SELECT distinct TRIM(replace(replace(replace(a.ubicacion_nivel3, 'LOTE,', ''), 'COMUNIDAD:', ''), 'URBANIZACION,', '')) as ubicacion from inmueble_univ a where 1=1 $filtro order by TRIM(replace(replace(replace(a.ubicacion_nivel3, 'LOTE,', ''), 'COMUNIDAD:', ''), 'URBANIZACION,', ''));";
    }

    $pjson['sql'] = $query;
    $stmt = $cons->query($query);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $tabla = '';
    $sw = true;

    foreach ($resultados as $key => $value) {
        if ($sw) {
            $tabla .= " <option value='TODOS'>TODOS</option>";
            $sw = false;
        }
        $tabla .= " <option value='" . $value['ubicacion'] . "'>" . $value['ubicacion'] . "</option>";
    }

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
    header('Content-Type: application/json');
    echo json_encode($pjson);
    exit;
}
