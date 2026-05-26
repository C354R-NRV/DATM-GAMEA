<?php
/**
 * Ejemplo de cliente PHP para consumir la API de WhatsApp
 * 
 * Este archivo muestra cómo enviar mensajes de WhatsApp desde PHP
 * a través de la API Node.js que hemos creado.
 */

/**
 * Función para enviar un mensaje de WhatsApp
 * 
 * @param string $phoneNumber Número de teléfono con código de país (ej: 59170123456)
 * @param string $message Mensaje a enviar
 * @return array Respuesta de la API
 */

function enviarMensajeWhatsApp($phoneNumber, $message) {
    // URL de la API (ajusta según tu configuración)
    $apiUrl = 'http://172.16.21.90:3051/api/send-message';
    
    // Datos a enviar
    $data = array(
        'phoneNumber' => $phoneNumber,
        'message' => $message
    );
    
    // Configurar la petición cURL
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen(json_encode($data))
    ));
    
    // Ejecutar la petición
    $response = curl_exec($ch);
    $error = curl_error($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    // Manejar la respuesta
    if ($error) {
        return array(
            'success' => false,
            'message' => 'Error de cURL: ' . $error
        );
    }
    
    // Decodificar la respuesta JSON
    $responseData = json_decode($response, true);
    
    // Verificar si la petición fue exitosa
    if ($httpCode != 200) {
        return array(
            'success' => false,
            'message' => 'Error HTTP: ' . $httpCode,
            'response' => $responseData
        );
    }
    
    return $responseData;
} 
?>

