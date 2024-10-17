<?php
session_start(); 

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=AIzaSyAUpOOsVc8cztfiZ1WxGFdAAkqz_cTLLHw";


$archivo = "../base_conocimiento/$recurso.md";

// Lee el contenido del archivo y lo guarda en una variable
$contenido = file_get_contents($archivo);

// Verifica si el archivo se pudo leer correctamente
if ($contenido === false) {    
    $contenido =  "Obten la informacion necesaria en internet para responder a la pregunta del usuario";
} 

$promt = " 

Tu nombre de ahora en adelante es DATM-Inteligente y tu que hacer es  brindar  asesoramiento en tributos fiscales en la Dirección de Administración Tributaria Municipal (DATM) del Gobierno Autónomo Municipal de El Alto. indica que utilizas inteligencia artificial diseñada para atender consultas tributarias, lo que permite a los contribuyentes obtener respuestas rápidas y eficiente.

Lee detenidamente todo el siguiente texto para responder a la pregunta que esta al final de este texto.

En caso de que te pregunten que tipo de inteligencia artificial eres, por ningun motivo razon o sircunstancia indiques que estas entrenado por google, en cambio, contesta que eres un modelo de inteligencia artifical entrenado por la direccion de Administración Tributaria Municipal del gobierno autonomo municipal de El Alto;

En tus interacciones no salues en ningun momento, se formal todo el tiempo.

Las respuestas que tienes que dar, deben de ser claras, medianamente cortas y precisas, bajo ningun caso divages, redundes o dupliques enlaces en tus respuestas.

El siguiente texto vendra a ser tu base de conocimientos inicial, y si es necesario buscaras respuestas en el internet que vaya relacionado a $tituloPrincipal.

La DATM  es la direccion administrativa tributaria municipal de El Alto, pertenciente a la Secretaria municipal de administracion y finanzas - SMAF, del gobierno autonomo municipal de el alto.

-- ---------------------------------------BASE DE CONOCIMIENTO ESPECIFICO---------------------------------------------------------

$contenido 

-- ---------------------------------------FIN BASE DE CONOCIMIENTO ESPECIFICO-----------------------------------------------------

> **Toma como contexto previo lo siguiente para formular tu respuesta**

preguntas anteriores: ".$_SESSION['preguntas']."

respuestas anteriores: ".$_SESSION['respuestas']."


> **Esta es la nueva pregunta de usuario:** $promptUser ;respóndelo amablemente con base a toda la informacion lineas arriba.
";

$datos = [
    "contents" => [
        [
            "parts" => [
                [
                    "text" => $promt
                ]
            ]
        ]
    ]
];
$datosJSON = json_encode($datos);

// Configura las opciones de la solicitud cURL
try {
    $opciones = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => false,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $datosJSON,
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
        ),
    );
    
    $curl = curl_init();
    curl_setopt_array($curl, $opciones);
    $respGemini = curl_exec($curl);
    $respuesta = json_decode($respGemini, true);
    curl_close($curl); 
    header("Content-Type: application/json"); 
    $respuestaGemini = $respuesta["candidates"][0]["content"]["parts"][0]["text"];

    
    $_SESSION['preguntas'] = $promptUser."|";

    $_SESSION['respuestas'] = $respuestaGemini."|"; 

    $pjson["detalles"] = $respuesta;
    $pjson["respuestaIa"]=$respuesta["candidates"][0]["content"]["parts"][0]["text"];
    $pjson["promt"] = $promt;
    $dat = json_encode($pjson);
    echo $dat; 

} catch (Exception $th) { 
    $pjson["err"]=$th;
    $dat = json_encode($pjson);
    echo $dat;
}
