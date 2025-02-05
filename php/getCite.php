<?php
session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

function get_next_correlative($usuario_, $unidad, $codigo, $referencia, $usuario_solicitante, $destino_, $hhrr_)
{
    // Validate input parameters
    $conn = new Conexion();
    $cons = $conn->conectar();
    $valid_units = ['UAJ-CC', 'UFyR', 'UICT', 'SIS', 'DIR', 'GA'];
    $baseCite = '';
    if (!in_array(($unidad), $valid_units)) {
        throw new Exception('Unidad no valida:' . $unidad . "|" . $valid_units);
    }

    /* if (!in_array(strtoupper($codigo), $valid_codes)) {
        throw new Exception('Codigo de documento no valido ->' . $codigo);
    } */

    try {

        $query = "SELECT id, codigo_unidad, rol, COALESCE(area, '') AS area
        FROM datm_usuario 
        WHERE id = $usuario_solicitante ";
        $stmt = $cons->query($query);
        $resultUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

        $auxArea = '';
        if ($resultUsuario['area'] != '')
            $auxArea = "/" . $resultUsuario['area'];

        // Query to get the maximum correlative for the given unit and code
        $query = "SELECT COALESCE(MAX(correlativo), 0) as max_correlativo 
                    FROM datm_cites  
                    WHERE unidad = '$unidad'  
                    AND codigo = '$codigo'  
                    and COALESCE(area, '') = '" . $resultUsuario['area'] . "' 
                    AND estado_ is true 
                    AND gestion = " . date('Y');

        $stmt = $cons->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            throw new Exception('La consulta fallo');
        }
        $next_correlative = $result['max_correlativo'] + 1;

        $baseCite = $unidad . '/' . $codigo . $auxArea . '/' . $next_correlative . '/' . date('Y');

        if ($_SESSION['codigo_unidad'] == 'DIR' and $_SESSION['rol'] == 'SECRETARIA') {

            if ($_SESSION['idusuario'] != $usuario_solicitante) {

                $baseCite =  $codigo . '/' . $resultUsuario['codigo_unidad'] . '/' . $next_correlative . '/' . date('Y');
                if ($resultUsuario['rol'] == 'DIRECCION' or ($_SESSION['rol'] == 'SECRETARIA' and $_SESSION['idusuario'] == $usuario_solicitante)) {
                    $baseCite =  $codigo . '/' . $next_correlative . '/' . date('Y');
                }
            }
        }

        if ($unidad == 'GA' and $_SESSION['codigo_usuario'] != '') {
            $baseCite = $unidad . '/' . $codigo . $auxArea . '/' . $_SESSION['codigo_usuario'] . '/' . $next_correlative . '/' . date('Y');
        }

        if ($_SESSION['codigo_unidad'] == 'DIR' and $_SESSION['rol'] == 'SECRETARIA' and $codigo == 'RA') {
            $baseCite = 'N°' . completarConCeros($next_correlative) . '/' . date('Y');
        }

        if ($unidad == 'UFyR' and $auxArea == '/INM_VEH') {
            $baseCite =  $unidad . '/' . $codigo  . '/' . $next_correlative . '/' . date('Y');
        }


        $baseCite = 'DATM/' . $baseCite;



        // Insert new record
        date_default_timezone_set('America/La_Paz');
        $fecha_registro = date('Y-m-d H:i:s');
        $insert_query = "INSERT INTO datm_cites (correlativo, unidad, codigo, referencia, usuario_, fecha_registro, estado_, gestion, cite, usuario_solicitante, destino, hhrr_ , area) 
                        VALUES ($next_correlative, '$unidad', '$codigo', '$referencia', " . $usuario_ . ", '$fecha_registro', true, " . date('Y') . ", '$baseCite', $usuario_solicitante, '$destino_', '$hhrr_', '" . $resultUsuario['area'] . "')";
        $stmt = $cons->prepare($insert_query);
        $nErr = $stmt->execute();

        if (!$nErr) {
            throw new Exception('No se pudo registrar el cite');
        }
        return $baseCite;
    } catch (Exception $e) {
        throw $e;
    }
}

// Example usage:
$resp = array();
try {
    $next_number = get_next_correlative(
        $_SESSION['idusuario'],
        $_SESSION['codigo_unidad'],
        $tipoDocumento_,
        $referencia_,
        $usuario_solicitante,
        $destino_,
        $hhrr_
    );
    $resp['message']  = "<div style='text-align:center'><h1><b><span id='citeCreado'>$next_number</span></b></h1></div>";
    $resp['estado'] = 'green';
    $resp['title'] = 'CITE GENERADO';
} catch (Exception $e) {
    $resp['message']  = $e->getMessage();
    $resp['estado'] = 'red';
    $resp['title'] = 'Ocurrio un error';
}

$dat = json_encode($resp);
echo $dat;


function completarConCeros($numero)
{
    // Aseguramos que el número sea un entero
    $numero = intval($numero);
    // Usamos str_pad para completar con ceros a la izquierda hasta 3 dígitos
    return str_pad($numero, 2, '0', STR_PAD_LEFT);
}
