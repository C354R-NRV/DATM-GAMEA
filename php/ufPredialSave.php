<?php

session_start();

require_once './conexionpsql.php';

// Initialize response array
$pjson = array(
    'err' => '0',
    'msg' => '',
    'log' => ''
);

try {
    if (!isset($_SESSION['idusuario'])) {
        throw new Exception("Usuario no autenticado");
    }

    $conn = new Conexion();
    $cons = $conn->conectar();

    $geolocalizacion = isset($_POST['geolocalizacion']) ? limpiarDato($_POST['geolocalizacion']) : '';

    if (substr($_POST['numeroInmueble'], 0, 4) === 'INM-') {
        $numero_inmueble = ($_POST['numeroInmueble']);
    } else {
        $numero_inmueble = intval($_POST['numeroInmueble']);
    }

    if (TRIM($_POST['numeroInmueble']) == '') {
        $numero_inmueble = generarNumeroInmuebleUnico($cons, $_SESSION['idusuario']);

        /* $query = "SELECT 
            CAST(substring(numero_inmueble FROM '\d+') AS INTEGER) + 1 AS correlativo
            FROM uf_predial
            WHERE numero_inmueble ~ '^INM-\d+$' and estado_
            order by id desc limit 1; ";

        $stmt = $cons->query($query);
        $extension = $stmt->fetch(PDO::FETCH_ASSOC);
        $numero_inmueble = "INM-" . $extension['correlativo']; */
    }

    $codigo_catastral = isset($_POST['codigo_catastro']) ? limpiarDato($_POST['codigo_catastro']) : '';
    $tipologia = isset($_POST['tipologia']) ? limpiarDato($_POST['tipologia']) : '';

    // FIX: Handle servicio properly - check if it's an array
    if (isset($_POST['servicio'])) {
        if (is_array($_POST['servicio'])) {
            // If it's an array, store it as a comma-separated string for the main table
            $serviciosArray = $_POST['servicio'];
            $servicio = implode(',', array_map('limpiarDato', $serviciosArray));
        } else {
            // If it's a string, clean it normally
            $servicio = limpiarDato($_POST['servicio']);
        }
    } else {
        $servicio = '';
    }

    $via = isset($_POST['via']) ? limpiarDato($_POST['via']) : '';
    $no_plantas = isset($_POST['no_plantas']) ? intval($_POST['no_plantas']) : 0;
    $idprepredial_seleccionado = isset($_POST['idprepredial_seleccionado']) ? intval($_POST['idprepredial_seleccionado']) : 0;
    $no_plantas = ($no_plantas ? $no_plantas : '0');
    $no_concluidos = isset($_POST['no_concluidos']) ? intval($_POST['no_concluidos']) : 0;
    $no_concluidos = ($no_concluidos ? $no_concluidos : '0');
    $no_bruto = isset($_POST['no_bruto']) ? intval($_POST['no_bruto']) : 0;
    $no_bruto = ($no_bruto ? $no_bruto : '0');
    $ubicacion_nivel1 = isset($_POST['distrito']) ? limpiarDato($_POST['distrito']) : '';
    $ubicacion_nivel2 = isset($_POST['zona']) ? limpiarDato($_POST['zona']) : '';
    $ubicacion_nivel3 = isset($_POST['calle']) ? limpiarDato($_POST['calle']) : '';
    $no_puerta = isset($_POST['no_puerta']) ? limpiarDato($_POST['no_puerta']) : '';
    $descripcion = isset($_POST['descripcion']) ? limpiarDato($_POST['descripcion']) : '';
    $no_formulario = isset($_POST['no_formulario']) ? limpiarDato($_POST['no_formulario']) : '';
    $no_formulario = ($no_formulario ? $no_formulario : '0');
    $hhrr_ = isset($_POST['hhrr_']) ? limpiarDato($_POST['hhrr_']) : '';
    $fechaApersonamiento = isset($_POST['fechaApersonamiento']) ? limpiarDato($_POST['fechaApersonamiento']) : '';
    $nombre_titular = (isset($_POST['nombre_titular']) and $_POST['nombre_titular'] != '') ? limpiarDato($_POST['nombre_titular']) : 'PROPIETARIO';
    $nombre_apoderado = isset($_POST['nombre_apoderado']) ? limpiarDato($_POST['nombre_apoderado']) : '';
    $contactoTitular = isset($_POST['contactoTitular']) ? limpiarDato($_POST['contactoTitular']) : '';
    $contactoApoderado = isset($_POST['contactoApoderado']) ? limpiarDato($_POST['contactoApoderado']) : '';
    $videoInmueble = isset($_POST['videoInmueble']) ? limpiarDato($_POST['videoInmueble']) : '';
    $cant_act = isset($_POST['cant_act']) ? intval($_POST['cant_act']) : 0;
    $descripcion_act = isset($_POST['descripcion_act']) ? limpiarDato($_POST['descripcion_act']) : '';

    // Validate coordinates
    $coordenadas = explode(',', $geolocalizacion);
    if (count($coordenadas) !== 2) {
        throw new Exception('Formato de coordenadas inválido');
    }
    $latitud = trim($coordenadas[0]);
    $longitud = trim($coordenadas[1]);

    // *** NUEVA SECCIÓN: Manejar imágenes existentes desde la base de datos ***
    $imagen_principal_existente = isset($_POST['imagen_principal_existente']) ? limpiarDato($_POST['imagen_principal_existente']) : '';
    $imagenes_adicionales_existentes = isset($_POST['imagenes_adicionales_existentes']) ? $_POST['imagenes_adicionales_existentes'] : [];

    // Limpiar array de imágenes adicionales existentes
    if (is_array($imagenes_adicionales_existentes)) {
        $imagenes_adicionales_existentes = array_map('limpiarDato', $imagenes_adicionales_existentes);
        $imagenes_adicionales_existentes = array_filter($imagenes_adicionales_existentes); // Remover valores vacíos
    } else {
        // Si viene como string separado por comas, convertir a array
        if (!empty($imagenes_adicionales_existentes)) {
            $imagenes_adicionales_existentes = array_map('trim', explode(',', $imagenes_adicionales_existentes));
            $imagenes_adicionales_existentes = array_filter($imagenes_adicionales_existentes);
        } else {
            $imagenes_adicionales_existentes = [];
        }
    }

    // Handle image uploads
    $directorioImagenes = '../static/ufpredial/';
    if (!file_exists($directorioImagenes)) {
        if (!mkdir($directorioImagenes, 0777, true)) {
            throw new Exception('No se pudo crear el directorio para las imágenes');
        }
    }

    // *** SECCIÓN MODIFICADA: Process main image ***
    $imagenPrincipalNombre = '';

    // Verificar si hay una nueva imagen principal subida
    if (isset($_FILES['imagenPrincipal']) && $_FILES['imagenPrincipal']['error'] === UPLOAD_ERR_OK) {
        $nombreOriginal = $_FILES['imagenPrincipal']['name'];
        $extension = pathinfo($nombreOriginal, PATHINFO_EXTENSION);
        $nombreArchivo = 'inmueble_' . time() . '_principal.' . $extension;
        $rutaCompleta = $directorioImagenes . $nombreArchivo;
        $tipoArchivo = $_FILES['imagenPrincipal']['type'];

        if (strpos($tipoArchivo, 'image/') !== 0) {
            throw new Exception('El archivo principal debe ser una imagen');
        }

        if (move_uploaded_file($_FILES['imagenPrincipal']['tmp_name'], $rutaCompleta)) {
            $imagenPrincipalNombre = $nombreArchivo;
        } else {
            throw new Exception('Error al guardar la imagen principal');
        }
    }
    // Si no hay nueva imagen, verificar si hay una imagen existente de BD
    elseif (!empty($imagen_principal_existente)) {
        // Usar la imagen existente de la base de datos
        $imagenPrincipalNombre = $imagen_principal_existente;
    }
    // Si no hay imagen nueva ni existente, validar según tipología
    else {
        if ($tipologia == 'OBRA BRUTA') {
            throw new Exception('No se ha proporcionado una imagen principal');
        }
    }

    // Process additional images
    $imagenesAdicionales = [];
    if (isset($_FILES['imagenesAdicionales']) && $_FILES['imagenesAdicionales']['error'][0] !== UPLOAD_ERR_NO_FILE) {
        $esMultiple = is_array($_FILES['imagenesAdicionales']['name']);
        if ($esMultiple) {
            $totalArchivos = count($_FILES['imagenesAdicionales']['name']);
            for ($i = 0; $i < $totalArchivos; $i++) {
                if ($_FILES['imagenesAdicionales']['error'][$i] === UPLOAD_ERR_OK) {
                    $nombreOriginal = $_FILES['imagenesAdicionales']['name'][$i];
                    $extension = pathinfo($nombreOriginal, PATHINFO_EXTENSION);
                    $nombreArchivo = 'inmueble_' . time() . '_adicional_' . $i . '.' . $extension;
                    $rutaCompleta = $directorioImagenes . $nombreArchivo;
                    $tipoArchivo = $_FILES['imagenesAdicionales']['type'][$i];

                    if (strpos($tipoArchivo, 'image/') !== 0) {
                        continue; // Skip non-image files
                    }

                    if (move_uploaded_file($_FILES['imagenesAdicionales']['tmp_name'][$i], $rutaCompleta)) {
                        $imagenesAdicionales[] = $nombreArchivo;
                    }
                }
            }
        } else {
            if ($_FILES['imagenesAdicionales']['error'] === UPLOAD_ERR_OK) {
                $nombreOriginal = $_FILES['imagenesAdicionales']['name'];
                $extension = pathinfo($nombreOriginal, PATHINFO_EXTENSION);
                $nombreArchivo = 'inmueble_' . time() . '_adicional.' . $extension;
                $rutaCompleta = $directorioImagenes . $nombreArchivo;
                $tipoArchivo = $_FILES['imagenesAdicionales']['type'];

                if (strpos($tipoArchivo, 'image/') === 0) {
                    if (move_uploaded_file($_FILES['imagenesAdicionales']['tmp_name'], $rutaCompleta)) {
                        $imagenesAdicionales[] = $nombreArchivo;
                    }
                }
            }
        }
    }

    // *** SECCIÓN MODIFICADA: Combinar imágenes adicionales nuevas con las existentes ***
    $todasImagenesAdicionales = array_merge($imagenes_adicionales_existentes, $imagenesAdicionales);

    // Prepare image_adicional value (tomar la primera imagen disponible)
    $imagen_adicional = !empty($todasImagenesAdicionales) ? $todasImagenesAdicionales[0] : '';

    // *** SECCIÓN DE DEBUG (opcional - puedes comentar después de probar) ***
    $pjson['log'] .= "Imagen principal final: " . $imagenPrincipalNombre . "; ";
    $pjson['log'] .= "Imagen principal existente recibida: " . $imagen_principal_existente . "; ";
    $pjson['log'] .= "Imágenes adicionales nuevas: " . implode(',', $imagenesAdicionales) . "; ";
    $pjson['log'] .= "Imágenes adicionales existentes: " . implode(',', $imagenes_adicionales_existentes) . "; ";
    $pjson['log'] .= "Imagen adicional final: " . $imagen_adicional . "; ";


    $clasificacion = 'H';
    $query = "UPDATE uf_predial 
                SET clasificacion = :clasificacion where numero_inmueble = :numero_inmueble and estado_ and clasificacion = 'A';";
    $stmt = $cons->prepare($query);
    $stmt->bindParam(':numero_inmueble', $numero_inmueble);
    /*     $stmt->bindParam(':codigo_catastral', $codigo_catastral); */
    $stmt->bindParam(':clasificacion', $clasificacion);
    $err = $stmt->execute();

    // Insert into database
    $query = "INSERT INTO uf_predial 
                (nombre_razon, nombre_apoderado, ubicacion_nivel1, ubicacion_nivel2, ubicacion_nivel3, no_puerta,
                codigo_catastral, no_formulario, via, 
                tipologia, no_plantas, 
                no_concluidos, no_brutos, imagen_principal, 
                imagen_adicional, 
                numero_inmueble, descripcion, hhrr, 
                fecha_apersonamiento, latitud, longitud, idusuario, fregistro_, contacto_apoderado,  contacto_titular, video , idestado_fiscalizacion,
                descripcion_act, cant_act ) VALUES (
                :nombre_razon, :nombre_apoderado, :ubicacion_nivel1, :ubicacion_nivel2, :ubicacion_nivel3, :no_puerta,
                :codigo_catastral, :no_formulario, :via, 
                :tipologia, :no_plantas, 
                :no_concluidos, :no_brutos, :imagen_principal, 
                :imagen_adicional, 
                :numero_inmueble, :descripcion, :hhrr, 
                :fecha_apersonamiento, :latitud, :longitud, :idusuario, :fregistro_ , :contacto_apoderado,  :contacto_titular, :video, :idestado_fiscalizacion,
                :descripcion_act, :cant_act 
                )";

    $idestado_fiscalizacion = 1;

    $stmt = $cons->prepare($query);
    $stmt->bindParam(':nombre_razon', $nombre_titular);
    $stmt->bindParam(':nombre_apoderado', $nombre_apoderado);
    $stmt->bindParam(':ubicacion_nivel1', $ubicacion_nivel1);
    $stmt->bindParam(':ubicacion_nivel2', $ubicacion_nivel2);
    $stmt->bindParam(':ubicacion_nivel3', $ubicacion_nivel3);
    $stmt->bindParam(':no_puerta', $no_puerta);
    $stmt->bindParam(':codigo_catastral', $codigo_catastral);
    $stmt->bindParam(':no_formulario', $no_formulario);
    $stmt->bindParam(':via', $via);
    $stmt->bindParam(':tipologia', $tipologia);
    $stmt->bindParam(':no_plantas', $no_plantas);
    $stmt->bindParam(':no_concluidos', $no_concluidos);
    $stmt->bindParam(':no_brutos', $no_bruto);
    $stmt->bindParam(':imagen_principal', $imagenPrincipalNombre);
    $stmt->bindParam(':imagen_adicional', $imagen_adicional);
    $stmt->bindParam(':numero_inmueble', $numero_inmueble);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':hhrr', $hhrr_);

    if ($fechaApersonamiento == date('d/m/Y') or  $fechaApersonamiento == date('Y-m-d')) {
        $fechaApersonamiento .= ' ' . date('H:i:s');
    } else {
        $fechaApersonamiento .= ' 07:00:00';
    }

    $stmt->bindParam(':fecha_apersonamiento', $fechaApersonamiento);
    $stmt->bindParam(':latitud', $latitud);
    $stmt->bindParam(':longitud', $longitud);
    $stmt->bindParam(':contacto_apoderado', $contactoApoderado);
    $stmt->bindParam(':contacto_titular', $contactoTitular);
    $stmt->bindParam(':video', $videoInmueble);
    $stmt->bindParam(':idestado_fiscalizacion', $idestado_fiscalizacion);
    $stmt->bindParam(':descripcion_act', $descripcion_act);
    $stmt->bindParam(':cant_act', $cant_act);

    $idusuario = $_SESSION['idusuario'];
    $stmt->bindParam(':idusuario', $idusuario);

    $fecha = new DateTime(date('Y-m-d H:i:s'));
    $fecha_ = $fecha->format('Y-m-d H:i:s');
    $stmt->bindParam(':fregistro_', $fecha_);

    $idpredial = '';

    if (!$stmt->execute()) {
        $errorInfo = $stmt->errorInfo();
        throw new Exception("Error al insertar en la base de datos: " . $errorInfo[2]);
    } else {
        $idpredial = $cons->lastInsertId();
    }

    // Handle services if they exist
    if (isset($_POST['servicio']) && is_array($_POST['servicio'])) {
        $serviciosSeleccionados = $_POST['servicio'];
        foreach ($serviciosSeleccionados as $idservicio) {
            // Clean the service ID
            $idservicio = limpiarDato($idservicio);
            $sql = "INSERT INTO uf_predrial_servicio (idpredial, idservicio) VALUES (:idpredial, :idservicio)";
            $stmt = $cons->prepare($sql);
            $stmt->bindParam(':idpredial', $idpredial);
            $stmt->bindParam(':idservicio', $idservicio);

            if (!$stmt->execute()) {
                $errorInfo = $stmt->errorInfo();
                $pjson['log'] .= "Error al insertar servicio: " . $errorInfo[2] . "; ";
                // Continue execution even if service insertion fails
            }
        }
    }

    if ($idprepredial_seleccionado > 0) {
        $query = "UPDATE uf_prepredial 
                SET idpredial_asociado = :idpredial_asociado where idprepredial = :idprepredial;";
        $stmt = $cons->prepare($query);
        $stmt->bindParam(':idpredial_asociado', $idpredial);
        $stmt->bindParam(':idprepredial', $idprepredial_seleccionado);
        $err = $stmt->execute();
    }


    $pjson['msg'] = 'Registro guardado exitosamente';
    $pjson['id'] = $idpredial;
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
    // Always return a JSON response
    header('Content-Type: application/json');
    echo json_encode($pjson);
    exit;
}

/**
 * Clean input data
 * @param string $dato The data to clean
 * @return string The cleaned data
 */
function limpiarDato($dato)
{
    // Make sure $dato is a string
    if (is_array($dato)) {
        return ''; // Return empty string for arrays or handle differently if needed
    }

    $dato = trim($dato);
    $dato = stripslashes($dato);
    $dato = htmlspecialchars($dato);
    return $dato;
}


function generarNumeroInmuebleUnico($conexion, $idusuario = 0)
{
    $intentos = 0;
    $max_intentos = 5;

    do {
        try {
            // Generar código único basado en:
            // - Timestamp con microsegundos (últimos 2 dígitos)
            // - ID de usuario (2 dígitos)
            // - Número aleatorio (4 dígitos)
            $timestamp = microtime(true);
            $microsegundos = str_replace('.', '', $timestamp);
            $usuario_pad = str_pad($idusuario, 2, '0', STR_PAD_LEFT);

            $codigo_unico = substr($microsegundos, -3) . $usuario_pad;

            // Obtener el siguiente correlativo
            $query = "SELECT 
                    COALESCE(MAX(CAST(substring(numero_inmueble FROM 'INM-(\d+)') AS INTEGER)), 0) + 1 AS correlativo
                FROM uf_predial 
                WHERE numero_inmueble ~ '^INM-\d+' 
                AND estado_";

            $stmt = $conexion->query($query);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            $correlativo = $resultado['correlativo'] ?? 1;

            $numero_inmueble = "INM-" . $correlativo . "-" . $codigo_unico;

            // Verificar que no exista (doble verificación)
            $queryVerificar = "SELECT COUNT(*) as existe FROM uf_predial WHERE numero_inmueble = :numero_inmueble";
            $stmtVerificar = $conexion->prepare($queryVerificar);
            $stmtVerificar->bindParam(':numero_inmueble', $numero_inmueble);
            $stmtVerificar->execute();
            $existe = $stmtVerificar->fetch(PDO::FETCH_ASSOC);

            if ($existe['existe'] == 0) {
                return $numero_inmueble; // Número único encontrado
            }

            $intentos++;
            // Esperar un tiempo aleatorio antes del siguiente intento
            usleep(mt_rand(10000, 50000)); // 10-50 milisegundos

        } catch (Exception $e) {
            $intentos++;
            if ($intentos >= $max_intentos) {
                throw new Exception("Error al generar número de inmueble: " . $e->getMessage());
            }
            usleep(mt_rand(10000, 50000));
        }
    } while ($intentos < $max_intentos);

    throw new Exception("No se pudo generar un número de inmueble único después de $max_intentos intentos");
}
