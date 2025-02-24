<?php
session_start();

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $respuesta = [];

    // Verifica si el archivo y el ID de usuario fueron enviados
    if (isset($_FILES["file"])) {
        $archivo = $_FILES["file"];
        $idusuario = $_SESSION['idusuario'];
        $usuario = $_SESSION['usuario'];

        // Nombre del archivo con formato "req1".$idusuario.date('ymdhmi').".pdf"
        $nuevoNombre = "req_".$noRequisito."_" . $idusuario . date('ymdhmi')."_".rand(500, 999) . ".pdf";

        // Ruta de la carpeta del usuario
        $directorioUsuario = "../static/exencion/" . $usuario;

        // Si la carpeta del usuario no existe, crearla
        if (!is_dir($directorioUsuario)) {
            mkdir($directorioUsuario, 0777, true);
        }

        // Ruta final del archivo
        $rutaDestino = $directorioUsuario . "/" . $nuevoNombre;

        // Mover el archivo a la carpeta del usuario con el nuevo nombre
        if (move_uploaded_file($archivo["tmp_name"], $rutaDestino)) {
            $respuesta["mensaje"] = "Archivo subido correctamente.";
            $respuesta["nombreArchivo"] = $nuevoNombre;
            $respuesta["ruta"] = $rutaDestino;
        } else {
            $respuesta["mensaje"] = "Error al subir el archivo.";
        }
    } else {
        $respuesta["mensaje"] = "Faltan datos.";
    }

    // Devolver respuesta en formato JSON
    echo json_encode($respuesta);
}
