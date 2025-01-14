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
        } else {
            // Procesar respuestas de otros endpoints
            return [
                'success' => true,
                'message' => $data['result'] ?? $data['entidades'] ?? 'Operación exitosa',
                'type' => 'green'
            ];
        }
    } else {
        return [
            'success' => false,
            'message' => "Problema de conexión con el servidor. Por favor, intente más tarde. [$httpCode]" .
                (isset($data['error']) ? " - {$data['error']}" : ''),
            'type' => 'red'
        ];
    }
}

// Lógica principal
$result = [];
switch ($endpoint) {
    case 'ping':
        [$response, $httpCode, $error] = makeApiRequest(['endpoint' => $endpoint, 'ack' => $ack]);
        $result = processApiResponse($response, $httpCode, $error, $endpoint);
        break;
    case 'consultaEntidadVigente':
        [$response, $httpCode, $error] = makeApiRequest(['endpoint' => $endpoint]);
        $result = processApiResponse($response, $httpCode, $error, $endpoint);
        break;
    case 'remitirSolicitud':
        [$response, $httpCode, $error] = makeApiRequest(['endpoint' => $endpoint, 'id' => $id, 'us' => $_SESSION['idusuario']]);
        $result = processApiResponse($response, $httpCode, $error, $endpoint);
        break;
    case 'consultarEstadoEnvio':
        [$response, $httpCode, $error] = makeApiRequest(['endpoint' => $endpoint, 'id' => $id, 'us' => $_SESSION['idusuario']]);
        $result = processApiResponse($response, $httpCode, $error, $endpoint);
        break;
    case 'consultaCabecera':
        [$response, $httpCode, $error] = makeApiRequest(['endpoint' => $endpoint]);
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
