<?php
session_start();
require_once './conexionpsql.php';
$conn = new Conexion();
$cons = $conn->conectar();
// Función para sanitizar las entradas
function sanitizeInput($value)
{
    return htmlspecialchars(strip_tags($value), ENT_QUOTES, 'UTF-8');
}

$inputParams = $_SERVER['REQUEST_METHOD'] === 'GET' ? $_GET : $_POST;
$endpoint = sanitizeInput($inputParams['endpoint'] ?? '');
$id = sanitizeInput($inputParams['id'] ?? '');
$fecha_ = sanitizeInput($inputParams['fecha_'] ?? '');
$ack = sanitizeInput($inputParams['ack'] ?? '');

const API_URL = 'https://172.16.21.116/api.php';

function makeApiRequest($params)
{
    $ch = curl_init();
    $url = API_URL . '?' . http_build_query($params);

    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false, // Nota: Habilitar esto en producción
        CURLOPT_SSL_VERIFYHOST => false, // Nota: Habilitar esto en producción
        CURLOPT_TIMEOUT => 16
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);

    return [$response, $httpCode, $error];
}
// Función para procesar la respuesta de la API
function processApiResponse($response, $httpCode, $error, $endpoint)
{
    if ($error) {
        return [
            'success' => false,
            'message' => "Error en la petición cURL: $error",
            'type' => 'red'
        ];
    }

    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return [
            'success' => false,
            'message' => 'Error al decodificar la respuesta JSON: ' . $response,
            'type' => 'red'
        ];
    }

    if ($httpCode >= 200 && $httpCode < 300) {
        if ($endpoint === 'remitirSolicitud' && isset($data['message'])) {
            return [
                'success' => $data['success'],
                'message' => $data['message'],
                'type' => $data['type']
            ];
        }
        if ($endpoint === 'consultarEstadoEnvio') {

            return [
                'success' => true,
                'message' => $data['result']
            ];
        }
        return [
            'success' => true,
            'message' => $data['result'] ?? $data['entidades'] ?? 'Operación exitosa',
            'type' => 'green'
        ];
    } else {
        return [
            'success' => false,
            'message' => "Problema de conexión con el servidor. Por favor, intente más tarde. [$httpCode]" .
                (isset($data['error']) ? " - {$data['error']}" : ''),
            'type' => 'red'
        ];
    }
}
try {
    switch ($endpoint) {
        case 'ping': {
                [$response, $httpCode, $error] = makeApiRequest(['endpoint' => $endpoint, 'ambiente' => $_SESSION['sirefo_ambiente'],   'ack' => $ack]);
                $result = processApiResponse($response, $httpCode, $error, $endpoint);
                break;
            }
        case 'consultaEntidadVigente': {
                [$response, $httpCode, $error] = makeApiRequest(['endpoint' => $endpoint, 'ambiente' => $_SESSION['sirefo_ambiente'],]);
                $result = processApiResponse($response, $httpCode, $error, $endpoint);
                break;
            }
        case 'remitirSolicitud': {

                //ACA SE TIENE QUE ACTUALIZAR LA FECHA DE ENVIO, ACTUALIZAR EL LA FEHCA ENVIO ANSI, HAS_DATOS Y EL HASH DATOS TXT


                $query = "
                select * 
                from srf_cabecera_solicitud a 
                left join datm_usuario b on b.id = a.idusuario 
                where a.id_cabecera_solicitud = $id;";
                $stmt = $cons->query($query);
                $srfCabecera = $stmt->fetch(PDO::FETCH_ASSOC);

                $fecha_envio_ansi = date('YmdHis');
                $fechaEnvio = new DateTime(date('Y-m-d H:i:s'));
                $fecha_envio = $fechaEnvio->format('Y-m-d H:i:s');

                $cabecera =  new stdClass();
                $cabecera->adjunto_nombre = $srfCabecera['adjunto_nombre'];
                $cabecera->autoridad_cargo = $srfCabecera['autoridad_cargo'];
                $cabecera->autoridad_solicitante = $srfCabecera['autoridad_solicitante'];
                $cabecera->codigo_solicitud = $srfCabecera['codigo_solicitud'];
                $cabecera->detalle_cantidad = $srfCabecera['detalle_cantidad'];
                $cabecera->entidad = $srfCabecera['entidad'];
                $cabecera->fecha_envio_ansi = $fecha_envio_ansi;
                $cabecera->gerencia = $srfCabecera['gerencia'];
                $cabecera->IdSolicitud = $srfCabecera['id_cabecera_solicitud'];
                $cabecera->tipo_proceso = $srfCabecera['tipo_proceso'];

                $texto = '';
                $texto .= !empty($srfCabecera['adjunto_nombre']) ? $srfCabecera['adjunto_nombre'] : '';
                $texto .= !empty($srfCabecera['autoridad_cargo']) ? $srfCabecera['autoridad_cargo'] : '';
                $texto .= !empty($srfCabecera['autoridad_solicitante']) ? $srfCabecera['autoridad_solicitante'] : '';
                $texto .= !empty($srfCabecera['codigo_solicitud']) ? $srfCabecera['codigo_solicitud'] : '';
                $texto .= !empty($srfCabecera['detalle_cantidad']) ? $srfCabecera['detalle_cantidad'] : '';
                $texto .= !empty($srfCabecera['entidad']) ? $srfCabecera['entidad'] : '';
                $texto .= !empty($fecha_envio_ansi) ? $fecha_envio_ansi : '';
                $texto .= !empty($srfCabecera['gerencia']) ? $srfCabecera['gerencia'] : '';
                $texto .= !empty($srfCabecera['id_cabecera_solicitud']) ? $srfCabecera['id_cabecera_solicitud'] : '';
                $texto .= !empty($srfCabecera['tipo_proceso']) ? $srfCabecera['tipo_proceso'] : '';
                $hash_datos_txt = $texto;

                $hash_datos = generarSha1DesdeCabecera($cabecera);

                $query = "UPDATE srf_cabecera_solicitud  
                            SET hash_datos = :hash_datos,  
                                hash_datos_txt = :hash_datos_txt,
                                fecha_envio = :fecha_envio,
                                fecha_envio_ansi = :fecha_envio_ansi
                            WHERE id_cabecera_solicitud = :id_cabecera";

                $stmt = $cons->prepare($query);
                $stmt->bindParam(':hash_datos', $hash_datos);
                $stmt->bindParam(':hash_datos_txt', $hash_datos_txt);
                $stmt->bindParam(':fecha_envio', $fecha_envio);
                $stmt->bindParam(':fecha_envio_ansi', $fecha_envio_ansi);
                $stmt->bindParam(':id_cabecera', $id);
                $err = $stmt->execute();

                [$response, $httpCode, $error] = makeApiRequest(['endpoint' => $endpoint, 'ambiente' => $_SESSION['sirefo_ambiente'],   'id' => $id, 'us' => $_SESSION['idusuario']]);
                $result = processApiResponse($response, $httpCode, $error, $endpoint);
                break;
            }
        case 'consultarEstadoEnvio': {
                [$response, $httpCode, $error] = makeApiRequest(['endpoint' => $endpoint, 'ambiente' => $_SESSION['sirefo_ambiente'],   'id' => $id, 'us' => $_SESSION['idusuario']]);
                $result = processApiResponse($response, $httpCode, $error, $endpoint);

                break;
            }
        case 'consultarEstadoEnvioGeneral': {
                //OBTENER TODAS LAS SOLICITUDES ENVIADAS QUE AUN NO TIENEN UN ESTADO sirefo O QUE TENGAN ESTADO NO PROCESADO

                $sql = "SELECT a.id_cabecera_solicitud, a.codigo_solicitud, a.fecha_registro, a.fecha_envio, d.estado, d.fecha_consulta, c.respuesta
                        from srf_cabecera_solicitud a 
                        left join datm_usuario b on b.id = a.idusuario 
                        left join srf_estado_envio c on c.id_cabecera_solicitud = a.id_cabecera_solicitud 
                        left join srf_estado_solicitud  d on d.id_cabecera_solicitud = a.id_cabecera_solicitud 
                        where a.estado_  is true   and c.estado_  is true 
                        and d.estado = 'ENVIADO' and (c.respuesta = 'No Procesado' or c.respuesta is null) order by c.respuesta 
                        desc , a.id_cabecera_solicitud desc;";

                //PARA CADA RESULTADO ITERAR LA SOLICITUD A LA API PARA ACRTUALIZAR SU ESTADO DE FORMA AUTOMATICA
                $stmt = $cons->query($sql);
                $rsp = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $idusuario = 214; // USUARIO -> SISTEMA
                $respuesta = array();
                $statusAnt = true;
                foreach ($rsp as $key => $value) {
                    $id = $value['id_cabecera_solicitud'];
                    [$response, $httpCode, $error] = makeApiRequest(['endpoint' => 'consultarEstadoEnvio', 'ambiente' => $_SESSION['sirefo_ambiente'],   'id' => $id, 'us' => $idusuario]);
                    $respuesta = processApiResponse($response, $httpCode, $error, 'consultarEstadoEnvio');
                    if ($respuesta['success']) {
                        $result['message'] .=  "Procesado para " . $value['codigo_solicitud'] . " con Circular:" . $respuesta['message']['Circular'] . " -" . $respuesta['success'] . "<br>\n";
                    }
                    $result['success'] = ($statusAnt and $respuesta['success']);
                    $statusAnt  =  $result['success'];
                }
                $result['type'] = ($result['success'] ? 'green' : 'red');
                break;
            }
        case 'consultarListadoEstadoEnvio': {
                [$response, $httpCode, $error] = makeApiRequest(['endpoint' => $endpoint,  'ambiente' => $_SESSION['sirefo_ambiente'],  'fecha_' => $fecha_]);
                $result = processApiResponse($response, $httpCode, $error, $endpoint);
                break;
            }
        case 'consultaCabecera': {
                [$response, $httpCode, $error] = makeApiRequest(['endpoint' => $endpoint, 'ambiente' => $_SESSION['sirefo_ambiente'],]);
                $result = processApiResponse($response, $httpCode, $error, $endpoint);
                break;
            }
        default:
            $result = [
                'success' => false,
                'message' => 'Endpoint inválido',
                'type' => 'red'
            ];
    }

    echo json_encode($result);
} catch (Exception $th) {
    echo $th;
}
