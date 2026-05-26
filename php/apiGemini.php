<?php
session_start();

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$url = 'http://192.168.0.7:3011/api/'.$modalidad;
$data = array(
    'promptUser' => $promptUser,
    'recurso' => $recurso,
    'tituloPrincipal' => $tituloPrincipal,
    'idusuario' => $_SESSION['idusuario']
);

// Crear el contexto HTTP para la solicitud POST
$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data),
    ),
);
try {
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $response = json_decode($response);
    echo $response->message; 
} catch (Exception $th) {
    var_dump($th);
}
