<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET')
    foreach ($_GET as $clave => $valor) $$clave = addslashes(trim($valor));
else
    foreach ($_POST as $clave => $valor) $$clave = addslashes(trim($valor));

switch ($endpoint) {
    case 'ping':
        $result = pingServer($endpoint, $ack);
        break;
    case 'consultaEntidadVigente':
        $result = consultaEntidadVigenteServer($endpoint);
        break;
    case 'remitirSolicitud':
        $result = remitirSolicitudServer($endpoint, $id);
        break;
}

$dat = json_encode($result);
echo $dat; 

function remitirSolicitudServer($endpoint, $id)
{ 
    $ch = curl_init();  
    $url = 'https://172.16.21.116/api.php';
    $params = [
        'endpoint' => $endpoint,
        'id' => $id
    ];
    $url .= '?' . http_build_query($params);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  
    curl_setopt($ch, CURLOPT_TIMEOUT, 16);  

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($response === false) {
        $error = curl_error($ch);
        curl_close($ch);
        return [
            'success' => false,
            'message' => "Error en la solicitud cURL: $error",
            'type' => 'red'
        ];
    }
    // Cerrar la sesión cURL
    curl_close($ch);

    // Decodificar la respuesta JSON
    $data = json_decode($response, true);

    // Verificar si la decodificación fue exitosa
    if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
        return [
            'success' => false,
            'message' => 'Error al decodificar la respuesta JSON-->'.$response,
            'type' => 'red'
        ];
    }

    // Verificar el código de respuesta HTTP
    if ($httpCode >= 200 && $httpCode < 300) {
        return [
            'success' => true,
            'message' => $data['result'] ?? 'Remision de ',
            'type' => 'green'
        ];
    } else {
        return [
            'success' => false,
            'message' => 'Problemas al conectar con el servidor. Por favor, intenta de nuevo más tarde.['.$httpCode.']',
            'type' => 'red'
        ];
    }
}


function consultaEntidadVigenteServer($endpoint)
{
    $ch = curl_init();

    // Configurar la URL y los parámetros
    $url = 'https://172.16.21.116/api.php';
    $params = [
        'endpoint' => $endpoint
    ];
    $url .= '?' . http_build_query($params);

    // Configurar las opciones de cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Desactiva la verificación SSL (solo para desarrollo)
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Desactiva la verificación del host (solo para desarrollo)
    curl_setopt($ch, CURLOPT_TIMEOUT, 16); // Timeout de 16 segundos

    // Ejecutar la solicitud
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Verificar si hubo algún error
    if ($response === false) {
        $error = curl_error($ch);
        curl_close($ch);
        return [
            'success' => false,
            'message' => "Error en la solicitud cURL: $error",
            'type' => 'red'
        ];
    }
    // Cerrar la sesión cURL
    curl_close($ch);

    // Decodificar la respuesta JSON 
    $data = json_decode($response, true);

    // Verificar si la decodificación fue exitosa
    if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
        return [
            'success' => false,
            'message' => 'Error al decodificar la respuesta JSON-->'.$response,
            'type' => 'red'
        ];
    }

    // Verificar el código de respuesta HTTP
    if ($httpCode >= 200 && $httpCode < 300) {
        return [
            'success' => true,
            'message' => $data['entidades'] ?? 'Lista de entidades vigentes',
            'type' => 'green'
        ];
    } else {
        return [
            'success' => false,
            'message' => 'Problemas al conectar con el servidor. Por favor, intenta de nuevo más tarde.['.$httpCode.'-'.$data['error'].']',
            'type' => 'red'
        ];
    }
}
function pingServer($endpoint, $ack)
{
    // Inicializar cURL
    $ch = curl_init();

    // Configurar la URL y los parámetros
    $url = 'https://172.16.21.116/api.php';
    $params = [
        'endpoint' => $endpoint,
        'ack' =>  $ack
    ];
    $url .= '?' . http_build_query($params);

    // Configurar las opciones de cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Desactiva la verificación SSL (solo para desarrollo)
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Desactiva la verificación del host (solo para desarrollo)
    curl_setopt($ch, CURLOPT_TIMEOUT, 16); // Timeout de 16 segundos

    // Ejecutar la solicitud
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Verificar si hubo algún error
    if ($response === false) {
        $error = curl_error($ch);
        curl_close($ch);
        return [
            'success' => false,
            'message' => "Error en la solicitud cURL: $error",
            'type' => 'red'
        ];
    }
    // Cerrar la sesión cURL
    curl_close($ch);

    // Decodificar la respuesta JSON
    $data = json_decode($response, true);

    // Verificar si la decodificación fue exitosa
    if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
        return [
            'success' => false,
            'message' => 'Error al decodificar la respuesta JSON',
            'type' => 'red'
        ];
    }

    // Verificar el código de respuesta HTTP
    if ($httpCode >= 200 && $httpCode < 300) {
        return [
            'success' => true,
            'message' => $data['result'] ?? 'Ping exitoso',
            'type' => 'green'
        ];
    } else {
        return [
            'success' => false,
            'message' => 'Hubo un problema al conectar con el servidor. Por favor, intenta de nuevo más tarde.',
            'type' => 'red'
        ];
    }
}
