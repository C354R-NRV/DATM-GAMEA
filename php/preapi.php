<?php
session_start();
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

switch ($endpoint) {
    case 'ping':
        [$response, $httpCode, $error] = makeApiRequest(['endpoint' => $endpoint, 'ambiente' => $_SESSION['sirefo_ambiente'],   'ack' => $ack]);
        $result = processApiResponse($response, $httpCode, $error, $endpoint);
        break;
    case 'consultaEntidadVigente':
        [$response, $httpCode, $error] = makeApiRequest(['endpoint' => $endpoint,'ambiente' => $_SESSION['sirefo_ambiente'], ]);
        $result = processApiResponse($response, $httpCode, $error, $endpoint);
        break;
    case 'remitirSolicitud':
        [$response, $httpCode, $error] = makeApiRequest(['endpoint' => $endpoint, 'ambiente' => $_SESSION['sirefo_ambiente'],   'id' => $id, 'us' => $_SESSION['idusuario']]);
        $result = processApiResponse($response, $httpCode, $error, $endpoint);
        break;
    case 'consultarEstadoEnvio':
        [$response, $httpCode, $error] = makeApiRequest(['endpoint' => $endpoint, 'ambiente' => $_SESSION['sirefo_ambiente'],   'id' => $id, 'us' => $_SESSION['idusuario']]);
        $result = processApiResponse($response, $httpCode, $error, $endpoint);
        break;
    case 'consultarListadoEstadoEnvio':
        [$response, $httpCode, $error] = makeApiRequest(['endpoint' => $endpoint,  'ambiente' => $_SESSION['sirefo_ambiente'],  'fecha_' => $fecha_]);
        $result = processApiResponse($response, $httpCode, $error, $endpoint);
        break;
    case 'consultaCabecera':
        [$response, $httpCode, $error] = makeApiRequest(['endpoint' => $endpoint, 'ambiente' => $_SESSION['sirefo_ambiente'], ]);
        $result = processApiResponse($response, $httpCode, $error, $endpoint);
        break;
    default:
        $result = [
            'success' => false,
            'message' => 'Endpoint inválido',
            'type' => 'red'
        ];
}

echo json_encode($result);
