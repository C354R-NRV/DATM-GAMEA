<?php
session_start();
require_once './conexionpsql.php';

$pjson = array();
$pjson['log'] =  "";
$pjson['err'] = '0';
$err = '';

try {
    $conn = new Conexion();
    $cons = $conn->conectar();

    $query = "select * from datm_parametro";
    $stmt = $cons->query($query);
    $parametros = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $cabecera = new stdClass();
    foreach ($_POST as $clave => $valor) {
        if (strpos($clave, 'cabecera_') === 0) {
            $key = str_replace('cabecera_', '', $clave);
            $cabecera->$key = addslashes(trim($valor));
        }
    }

    $fileName = '';
    $base64File = '';

    $query = " select * 
    from srf_cabecera_solicitud 
    where  codigo_solicitud = '" . $cabecera->codigo_solicitud . "' and tipo_proceso = '" . $cabecera->tipo_proceso . "' and estado_ ";
    $stmt = $cons->query($query);
    $srfCabecera = $stmt->fetch(PDO::FETCH_ASSOC);
    $uploadDir = '../static/sirefo/';

    if (isset($_FILES["cabecera_archivoPdf"]["tmp_name"])) {
        $fileName = 'srf_' . uniqid() . '.pdf';
        $fileTmpPath = $_FILES["cabecera_archivoPdf"]["tmp_name"];

        if (!move_uploaded_file($fileTmpPath,   $uploadDir . $fileName)) {
            $err .= "Hubo un error al guardar el archivo en el directorio de destino.";
            $pjson['err'] = '1';
            $pjson['log'] .= '<p>[x] Hubo un error al guardar el archivo en el directorio de destino -' .  $uploadDir . $fileName . '-.</p><p>' . error_get_last()['message'] . '</p>';
        } else {
            $pjson['log'] .= '<p>- Archivo subido correctamente.</p>';
        }
        $pdfFile = file_get_contents($uploadDir . $fileName);


        $base64Pdf = base64_encode($pdfFile);
    } else {
        $fileName = $srfCabecera['adjunto_nombre'];
        $base64Pdf = $srfCabecera['adjunto'];
    }

    if ($srfCabecera) {
        $cabecera->fecha_envio = $srfCabecera['fecha_envio'];
        $cabecera->fecha_envio_ansi = $srfCabecera['fecha_envio_ansi'];
    } else {
        $cabecera->fecha_envio_ansi = date('YmdHis');
        $fechaEnvio = new DateTime(date('Y-m-d H:i:s'));
        $cabecera->fecha_envio = $fechaEnvio->format('Y-m-d H:i:s');
        $cabecera->fecha_registro = $cabecera->fecha_envio;
    }

    $sha1Hash = strtoupper(sha1($base64Pdf));
    $cabecera->hash_imagen = $sha1Hash;

    $cabecera->adjunto = $base64Pdf;
    $cabecera->adjunto_nombre = $fileName;

    $query = " select * from datm_usuario where estado like 'DESBLOQUEADO' and rol like 'DIRECCION' ";
    $stmt = $cons->query($query);
    $mae = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $cabecera->autoridad_cargo = $mae[0]['cargo'];
    $cabecera->autoridad_solicitante = $mae[0]['nombres'] . ' ' . $mae[0]['primer_apellido'] . ' ' . $mae[0]['segundo_apellido'];
    $cabecera->entidad = $parametros[0]['sigla_entidad'];


    $cabecera->gerencia = $parametros[0]['nombre_entidad'];
    $cabecera->idusuario =  $_SESSION['idusuario'] ? $_SESSION['idusuario'] : 1;


    $nErr = true;

    if (empty($srfCabecera)) {

        try {
            $query = "INSERT INTO srf_cabecera_solicitud (
                adjunto,         adjunto_nombre,        autoridad_cargo,        autoridad_solicitante,        codigo_solicitud,
                detalle_cantidad,        entidad,        fecha_envio,        fecha_envio_ansi,        gerencia,         
                hash_imagen,         tipo_proceso,        idusuario,        estado_, fecha_registro
            ) VALUES (
                :adjunto,        :adjunto_nombre,        :autoridad_cargo,        :autoridad_solicitante,        :codigo_solicitud,
                :detalle_cantidad,        :entidad,        :fecha_envio,        :fecha_envio_ansi,        :gerencia, 
                :hash_imagen,         :tipo_proceso,        :idusuario,        :estado_, :fecha_registro
            )";
            $stmt = $cons->prepare($query);
            $stmt->bindParam(':adjunto', $cabecera->adjunto);
            $stmt->bindParam(':adjunto_nombre', $cabecera->adjunto_nombre);
            $stmt->bindParam(':autoridad_cargo', $cabecera->autoridad_cargo);
            $stmt->bindParam(':autoridad_solicitante', $cabecera->autoridad_solicitante);
            $stmt->bindParam(':codigo_solicitud', $cabecera->codigo_solicitud);
            $stmt->bindParam(':detalle_cantidad', $cabecera->detalle_cantidad);
            $stmt->bindParam(':entidad', $cabecera->entidad);
            $stmt->bindParam(':fecha_envio_ansi', $cabecera->fecha_envio_ansi);
            $stmt->bindParam(':gerencia', $cabecera->gerencia);
            $stmt->bindParam(':tipo_proceso', $cabecera->tipo_proceso);
            $stmt->bindParam(':idusuario', $cabecera->idusuario);
            $stmt->bindParam(':hash_imagen', $cabecera->hash_imagen);

            $stmt->bindParam(':estado_', $nErr);
            $stmt->bindParam(':fecha_envio', $cabecera->fecha_envio);
            $stmt->bindParam(':fecha_registro', $cabecera->fecha_registro);

            $nErr = $stmt->execute();
            $query = " select * 
                    from srf_cabecera_solicitud 
                    where  codigo_solicitud = '" . $cabecera->codigo_solicitud . "' and tipo_proceso = '" . $cabecera->tipo_proceso . "' and estado_  ";
            $stmt = $cons->query($query);
            $srfCabecera = $stmt->fetch(PDO::FETCH_ASSOC);

            $cabecera->IdSolicitud = $srfCabecera['id_cabecera_solicitud'];


            $texto = '';
            $texto .= !empty($cabecera->adjunto_nombre) ? $cabecera->adjunto_nombre : '';
            $texto .= !empty($cabecera->autoridad_cargo) ? $cabecera->autoridad_cargo : '';
            $texto .= !empty($cabecera->autoridad_solicitante) ? $cabecera->autoridad_solicitante : '';
            $texto .= !empty($cabecera->codigo_solicitud) ? $cabecera->codigo_solicitud : '';

            $texto .= !empty($cabecera->detalle_cantidad) ? $cabecera->detalle_cantidad : '';

            $texto .= !empty($cabecera->entidad) ? $cabecera->entidad : '';
            $texto .= !empty($cabecera->fecha_envio_ansi) ? $cabecera->fecha_envio_ansi : '';
            $texto .= !empty($cabecera->gerencia) ? $cabecera->gerencia : '';
            $texto .= !empty($cabecera->IdSolicitud) ? $cabecera->IdSolicitud : '';
            $texto .= !empty($cabecera->tipo_proceso) ? $cabecera->tipo_proceso : '';
            $cabecera->hash_datos_txt = $texto;

            $cabecera->hash_datos = generarSha1DesdeCabecera($cabecera);

            $pjson['hash_datos'] = $cabecera->hash_datos;

            $query = "UPDATE srf_cabecera_solicitud 
                SET hash_datos = '" . $pjson['hash_datos'] . "',  
                hash_datos_txt = '" . $cabecera->hash_datos_txt . "' 
                WHERE id_cabecera_solicitud = " . $cabecera->IdSolicitud;

            $stmt = $cons->prepare($query);
            $err = $stmt->execute();
            $auxTmp  = 'PENDIENTE DE ENVIO';
            $fecha = new DateTime(date('Y-m-d H:i:s'));
            $fecha_ = $fecha->format('Y-m-d H:i:s');
            $query = "INSERT INTO srf_estado_solicitud (
            estado,
            fecha_consulta,
            uconsulta_,
            id_cabecera_solicitud 
                ) VALUES (
                    :estado_,
                    :fecha_consulta_,
                    :uconsulta__,
                    :id_cabecera_solicitud_
                )";
            $stmt = $cons->prepare($query);
            $stmt->bindParam(':estado_', $auxTmp);
            $stmt->bindParam(':fecha_consulta_', $fecha_);
            $stmt->bindParam(':uconsulta__', $cabecera->idusuario);
            $stmt->bindParam(':id_cabecera_solicitud_', $cabecera->IdSolicitud);
            $stmt->execute();
        } catch (Exception $e) {
            $pjson['err'] = '1';
            $pjson['log'] .=  "<p class='rspIncorrecta'>[x] Error al registrar cabecera : " . $e . "</p>";
        }
    }

    if ($nErr) {
        $cabecera->IdSolicitud = $srfCabecera['id_cabecera_solicitud'];
        $fechaEdita = new DateTime(date('Y-m-d H:i:s'));
        $fechaEdita = $fechaEdita->format('Y-m-d H:i:s');

        $cntValidos = 0;
        $detalle_cantidad_aux = $cabecera->detalle_cantidad;
        $cabecera->swItems = filter_var($cabecera->swItems, FILTER_VALIDATE_BOOLEAN);
        if ($cabecera->swItems) {

            $auxCntItem = $cabecera->cntItem;
            if ($cabecera->nroitem != 0) {
                $auxCntItem = $cabecera->nroitem + 1;
            }
            for ($i = 0; $i < $auxCntItem; $i++) {
                if (
                    isset($_POST['item_documentoIdentidadNumero' . $i]) and
                    trim($_POST['item_documentoIdentidadNumero' . $i]) != '' and
                    preg_match('/^[a-zA-Z0-9\s\-]{2,}$/', $_POST['item_documentoIdentidadNumero' . $i])
                ) {
                    $cntValidos++;
                    $item = new stdClass();
                    $item->tipo_persona = $_POST['item_tipo_persona' . $i];
                    if ($item->tipo_persona  == 'N') {
                        $item->razon_social = '';
                        $item->nombre = $_POST['item_nombre' . $i];
                        $item->apellido_paterno = $_POST['item_apellidoPaterno' . $i];
                        $item->apellido_materno = $_POST['item_apellidoMaterno' . $i];
                    } else {
                        $item->razon_social = $_POST['item_razonSocial' . $i];
                        $item->nombre = '';
                        $item->apellido_paterno = '';
                        $item->apellido_materno = '';
                    }

                    $item->id_documento_identidad_tipo = $_POST['item_id_documento_identidad_tipo' . $i];
                    $item->documento_identidad_numero = $_POST['item_documentoIdentidadNumero' . $i];
                    $item->documento_tributario = $_POST['item_documentoTributario' . $i];
                    $item->tipo_documento_tributario = $_POST['item_tipo_documento_tributario' . $i];
                    $item->documento_identidad_complemento = $_POST['item_documentoIdentidadComplemento' . $i];
                    $item->id_documento_identidad_extension = '0';
                    if (! ($item->id_documento_identidad_tipo == '1' or $item->id_documento_identidad_tipo == '3' or $item->id_documento_identidad_tipo == '4'))
                        $item->id_documento_identidad_extension = $_POST['item_id_documento_identidad_extension' . $i];
                    $item->auto_conclusion = $_POST['item_autoConclusion' . $i];
                    $item->gestion_fiscal = $_POST['item_gestionFiscal' . $i];
                    $item->cite_anotacion_preventiva = $_POST['item_cite_anotacion_preventiva' . $i];
                    $item->resolucion_determinativa = $_POST['item_resolucionDeterminativa' . $i];
                    $item->id_tipo_respaldo = $_POST['item_id_tipo_respaldo' . $i];
                    $item->documento_respaldo = $_POST['item_documentoRespaldo' . $i];
                    $item->monto_retencion_bs = formatearDecimales($_POST['item_montoRetencionBs' . $i]);
                    $item->monto_retencion_ufv = formatearDecimales($_POST['item_montoRetencionUFV' . $i]);
                    $item->id_item_solicitud = intval($_POST['item_id_item_solicitud' . $i]);

                    $item->tipo_apoderado =  ($_POST['tipo_apoderado' . $i]);
                    $item->documento_identidad_apo =  ($_POST['documento_identidad_apo' . $i]);
                    $item->nombre_apo =  ($_POST['nombre_apo' . $i]);

                    $item->id_cabecera_solicitud = $cabecera->IdSolicitud;
                    $item->estado_ = true;

                    $item->id_item_solicitud = ($item->id_item_solicitud > 0 ? $item->id_item_solicitud : 0);

                    $query = "SELECT * FROM srf_item_solicitud 
                            WHERE 
                            id_item_solicitud = $item->id_item_solicitud 
                            and estado_ is true
                            ";
                    $stmt = $cons->prepare($query);
                    $stmt->execute();
                    $datosActuales = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if (empty($datosActuales) and $item->documento_identidad_numero) {
                        $pjson['log'] .= "<p> - Item creado para documento:" . $item->documento_identidad_numero . "</p>";
                        //creamos el registro
                        $query = "INSERT INTO srf_item_solicitud (
                                tipo_persona,
                                nombre,
                                apellido_paterno,
                                apellido_materno,
                                razon_social,
                                id_documento_identidad_tipo,
                                documento_identidad_numero,
                                documento_identidad_complemento,
                                auto_conclusion,
                                id_tipo_respaldo,  
                                documento_respaldo,
                                hash_detalle,
                                monto_retencion_bs,
                                monto_retencion_ufv,
                                id_cabecera_solicitud,
                                estado_,
                                id_documento_identidad_extension,
                                documento_tributario,
                                tipo_documento_tributario,
                                resolucion_determinativa, 
                                gestion_fiscal,
                                cite_anotacion_preventiva,
                                tipo_apoderado,
                                documento_identidad_apo,
                                nombre_apo 
                            ) VALUES (
                                :tipo_persona,
                                :nombre,
                                :apellido_paterno,
                                :apellido_materno,
                                :razon_social,
                                :id_documento_identidad_tipo,
                                :documento_identidad_numero,
                                :documento_identidad_complemento,
                                :auto_conclusion,
                                :id_tipo_respaldo,
                                :documento_respaldo,
                                :hash_detalle,
                                :monto_retencion_bs,
                                :monto_retencion_ufv,
                                :id_cabecera_solicitud,
                                :estado_,
                                :id_documento_identidad_extension,
                                :documento_tributario,
                                :tipo_documento_tributario,
                                :resolucion_determinativa, 
                                :gestion_fiscal,
                                :cite_anotacion_preventiva,
                                :tipo_apoderado,
                                :documento_identidad_apo,
                                :nombre_apo  
                            )";
                        $tmpTrue = true;
                        $stmt = $cons->prepare($query);
                        $stmt->bindParam(':tipo_persona', $item->tipo_persona);
                        $stmt->bindParam(':nombre', $item->nombre);
                        $stmt->bindParam(':apellido_paterno', $item->apellido_paterno);
                        $stmt->bindParam(':apellido_materno', $item->apellido_materno);
                        $stmt->bindParam(':razon_social', $item->razon_social);
                        $stmt->bindParam(':id_documento_identidad_tipo', $item->id_documento_identidad_tipo);
                        $stmt->bindParam(':documento_identidad_numero', $item->documento_identidad_numero);
                        $stmt->bindParam(':documento_tributario', $item->documento_tributario);
                        $stmt->bindParam(':tipo_documento_tributario', $item->tipo_documento_tributario);
                        $stmt->bindParam(':resolucion_determinativa', $item->resolucion_determinativa);
                        $stmt->bindParam(':gestion_fiscal', $item->gestion_fiscal);
                        $stmt->bindParam(':cite_anotacion_preventiva', $item->cite_anotacion_preventiva);
                        $stmt->bindParam(':documento_identidad_complemento', $item->documento_identidad_complemento);
                        $stmt->bindParam(':auto_conclusion', $item->auto_conclusion);
                        $stmt->bindParam(':id_tipo_respaldo', $item->id_tipo_respaldo);
                        $stmt->bindParam(':documento_respaldo', $item->documento_respaldo);
                        $stmt->bindParam(':hash_detalle', $item->hash_detalle);
                        $stmt->bindParam(':monto_retencion_bs', $item->monto_retencion_bs);
                        $stmt->bindParam(':monto_retencion_ufv', $item->monto_retencion_ufv);
                        $stmt->bindParam(':id_cabecera_solicitud', $cabecera->IdSolicitud);
                        $stmt->bindParam(':estado_', $tmpTrue);
                        $stmt->bindParam(':id_documento_identidad_extension', $item->id_documento_identidad_extension);

                        $stmt->bindParam(':tipo_apoderado', $item->tipo_apoderado);
                        $stmt->bindParam(':documento_identidad_apo', $item->documento_identidad_apo);
                        $stmt->bindParam(':nombre_apo', $item->nombre_apo);

                        $stmt->execute();

                        $item->id_item_solicitud = $cons->lastInsertId();

                        $itemAux =  generarSha1Item($item, $cons, $pjson);


                        $query = "UPDATE srf_item_solicitud 
                            SET hash_detalle = :hash_detalle, 
                                hash_detalle_text = :hash_detalle_text 
                            WHERE id_item_solicitud = :id_item";

                        $stmt = $cons->prepare($query);
                        $stmt->bindParam(':hash_detalle', $itemAux['hash_detalle']);
                        $stmt->bindParam(':hash_detalle_text', $itemAux['hash_detalle_text']);
                        $stmt->bindParam(':id_item', $item->id_item_solicitud);
                        $err = $stmt->execute();
                    } else {

                        $camposModificados = array();
                        $id_item_solicitud = 0;
                        foreach ($datosActuales as $campoBase => $datosActualesTupla) {
                            $id_item_solicitud = $datosActualesTupla['id_item_solicitud'];
                            foreach ($datosActualesTupla as $campo => $valorActual) {
                                if (
                                    $campo == 'id_documento_identidad_tipo' or
                                    $campo == 'monto_retencion_bs' or
                                    $campo == 'monto_retencion_ufv' or
                                    $campo == 'id_cabecera_solicitud' or
                                    $campo == 'id_documento_identidad_extension'
                                ) {
                                    $valorNuevo = intval($item->$campo);
                                } else {
                                    if ($campo != "id_item_solicitud")
                                        $valorNuevo = $item->$campo;
                                }
                                if (isset($item->$campo)) {
                                    $valorNuevo = $item->$campo;
                                    $valorActualJsonb = $valorActual;
                                    $valorNuevoJsonb = $valorNuevo;

                                    if ($valorActualJsonb != $valorNuevoJsonb) {
                                        $camposModificados[] = array(
                                            'campo' => $campo,
                                            'valor_anterior' => $valorActualJsonb,
                                            'valor_nuevo' => $valorNuevoJsonb,
                                            'id_item_solicitud' => $id_item_solicitud
                                        );
                                    }
                                }
                            }
                        }

                        if (!empty($camposModificados)) {
                            foreach ($camposModificados as $campoModificado) {
                                // INSERT con bindParam (ya estaba bien)
                                $query = "INSERT INTO srf_item_solicitud_hst (
                                        id_item_solicitud,
                                        campo,
                                        valor_anterior,
                                        valor_nuevo,
                                        fecha_modificacion,
                                        idusuario
                                    ) VALUES (
                                        :id_item_solicitud,
                                        :Campo,
                                        :valor_anterior,
                                        :valor_nuevo,
                                        :FechaModificacion,
                                        :idusuario
                                    )";
                                $stmt = $cons->prepare($query);
                                $stmt->bindParam(':id_item_solicitud', $campoModificado['id_item_solicitud']);
                                $stmt->bindParam(':Campo', $campoModificado['campo']);
                                $stmt->bindParam(':valor_anterior', $campoModificado['valor_anterior']);
                                $stmt->bindParam(':valor_nuevo', $campoModificado['valor_nuevo']);
                                $stmt->bindParam(':FechaModificacion', $fechaEdita);
                                $stmt->bindParam(':idusuario', $cabecera->idusuario);
                                $stmt->execute();

                                // UPDATE dinámico con campo variable — usamos prepared statement dinámico con bind
                                $campo = $campoModificado['campo'];
                                $valorNuevo = $campoModificado['valor_nuevo'];
                                $idItem = $campoModificado['id_item_solicitud'];

                                // Importante: solo permitimos campos válidos para evitar inyecciones
                                $camposPermitidos = [
                                    'nombre',
                                    'apellido_paterno',
                                    'apellido_materno',
                                    'razon_social',
                                    'documento_tributario',
                                    'tipo_documento_tributario',
                                    'resolucion_determinativa',
                                    'gestion_fiscal',
                                    'cite_anotacion_preventiva',
                                    'documento_identidad_numero',
                                    'documento_identidad_complemento',
                                    'auto_conclusion',
                                    'id_tipo_respaldo',
                                    'documento_respaldo',
                                    'tipo_apoderado',
                                    'documento_identidad_apo',
                                    'nombre_apo'
                                ];

                                if (in_array($campo, $camposPermitidos)) {
                                    $query = "UPDATE srf_item_solicitud 
                        SET {$campo} = :valor_nuevo 
                        WHERE id_item_solicitud = :id_item";
                                    $stmt = $cons->prepare($query);
                                    $stmt->bindParam(':valor_nuevo', $valorNuevo);
                                    $stmt->bindParam(':id_item', $idItem);
                                    $stmt->execute();
                                }

                                // UPDATE hash_detalle con parámetros también
                                $item->id_item_solicitud = $idItem;
                                $itemAux = generarSha1Item($item, $cons, $pjson);

                                $query = "UPDATE srf_item_solicitud 
                                                SET hash_detalle = :hash_detalle, 
                                                    hash_detalle_text = :hash_detalle_text 
                                            WHERE id_item_solicitud = :id_item";
                                $stmt = $cons->prepare($query);
                                $stmt->bindParam(':hash_detalle', $itemAux['hash_detalle']);
                                $stmt->bindParam(':hash_detalle_text', $itemAux['hash_detalle_text']);
                                $stmt->bindParam(':id_item', $idItem);
                                $stmt->execute();

                                $pjson['log'] .= "<br>- " . htmlspecialchars($campoModificado['campo']) . " de " .
                                    htmlspecialchars($campoModificado['valor_anterior']) . " a " .
                                    htmlspecialchars($campoModificado['valor_nuevo']);
                            }
                        }
                    }
                }
            }
            $cabecera->detalle_cantidad = $cntValidos;
        }

        if ($cabecera->nroitem != 0) {
            $cabecera->detalle_cantidad = $detalle_cantidad_aux;
        }
        $query = "SELECT * FROM srf_cabecera_solicitud WHERE id_cabecera_solicitud = :IdSolicitud";
        $stmt = $cons->prepare($query);
        $stmt->bindParam(':IdSolicitud', $cabecera->IdSolicitud);
        $stmt->execute();
        $datosActuales = $stmt->fetch(PDO::FETCH_ASSOC);

        $camposModificados = array();
        $swNuevo = true;
        foreach ($datosActuales as $campo => $valorActual) {
            if (isset($cabecera->$campo)) {
                $valorNuevo = $cabecera->$campo;

                $valorActualJsonb = ($valorActual);
                $valorNuevoJsonb = ($valorNuevo);

                if ($campo == 'idusuario') {
                    $valorNuevoJsonb = intval($valorNuevoJsonb);
                }
                if ($valorActualJsonb != $valorNuevoJsonb) {
                    $camposModificados[] = array(
                        'campo' => $campo,
                        'valor_anterior' => $valorActualJsonb,
                        'valor_nuevo' => $valorNuevoJsonb
                    );
                }
            }
        }

        if (!empty($camposModificados)) {
            foreach ($camposModificados as $campoModificado) {
                $query = "INSERT INTO srf_cabecera_solicitud_hst (
                        id_cabecera_solicitud,
                        campo,
                        valor_anterior,
                        valor_nuevo,
                        fecha_modificacion,
                        idusuario
                    ) VALUES (
                        :IdSolicitud,   
                        :Campo,         
                        :ValorAnterior, 
                        :ValorNuevo,    
                        :FechaModificacion,
                        :idusuario      
                    )";
                $stmt = $cons->prepare($query);
                $stmt->bindParam(':IdSolicitud', $cabecera->IdSolicitud);
                $stmt->bindParam(':Campo', $campoModificado['campo']);
                $stmt->bindParam(':ValorAnterior', $campoModificado['valor_anterior']);
                $stmt->bindParam(':ValorNuevo', $campoModificado['valor_nuevo']);
                $stmt->bindParam(':FechaModificacion', $fechaEdita);
                $stmt->bindParam(':idusuario', $cabecera->idusuario);
                $stmt->execute();

                $query = "UPDATE srf_cabecera_solicitud 
                                SET " . $campoModificado['campo'] . " = '" . $campoModificado['valor_nuevo'] . "'
                                WHERE id_cabecera_solicitud = " . $cabecera->IdSolicitud . ";";
                $stmt = $cons->prepare($query);
                $err = $stmt->execute();


                $query = "UPDATE srf_cabecera_solicitud 
                                SET " . $campoModificado['campo'] . " = '" . $campoModificado['valor_nuevo'] . "'
                                WHERE id_cabecera_solicitud = " . $cabecera->IdSolicitud . ";";
                $stmt = $cons->prepare($query);
                $err = $stmt->execute();
            }

            $cabecera->hash_datos = generarSha1DesdeCabecera($cabecera);
            $query = "UPDATE srf_cabecera_solicitud 
            SET hash_datos= '" . $cabecera->hash_datos . "',  hash_datos_txt= '" . $cabecera->hash_datos_txt . "' 
            WHERE id_cabecera_solicitud = " . $cabecera->IdSolicitud . ";";
            $stmt = $cons->prepare($query);
            $err = $stmt->execute();

            $pjson['log'] .= "<br>- Modificaciones en cabecera registradas exitosamente";
        }

        $pjson['idsolicitud'] = $cabecera->IdSolicitud;
        $pjson['codigo'] = $cabecera->codigo_solicitud;
        $pjson['cantidadItems'] = $cabecera->detalle_cantidad;
        $pjson['tipoProceso'] = $cabecera->tipo_proceso;
        $pjson['sw'] = '1';
        $pjson['log'] .= "<br>Informacion consolidada.";
    } else {
        $pjson['err'] = '1';
        $pjson['log'] .= "<p class='rspIncorrecta'>[x] Error al guardar la cabecera:" . $stmt->errorInfo()[2] . "</p>";
    }
} catch (PDOException $e) {
    $pjson['err'] = '1';
    $pjson['log'] .= "<p class='rspIncorrecta'>[x] Error de base de datos: " . $e->getMessage() . "</p>";
} catch (Exception $e) {
    $pjson['err'] = '1';
    $pjson['log'] .= "<p class='rspIncorrecta'>[x] Error general: " . $e->getMessage() . "</p>";
} finally {
    $dat = json_encode($pjson);
    echo $dat;
}

function generarSha1Item($item, $cons, $pjson)
{
    $itemAux = array();
    try {
        $query = "SELECT * FROM srf_documento_identidad_extension WHERE id_documento_identidad_extension = " . $item->id_documento_identidad_extension;
        $stmt = $cons->prepare($query);
        $stmt->execute();
        $resp1 = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $pjson['log'] .=  "<p class='rspIncorrecta'>[x] Error al generar hash de item - Tabla srf_documento_identidad_extension : " . $e->getMessage() . "</p>";
        $resp1 = array();
    }


    $hashDetalle = '';
    $hashDetalle .= !empty($item->apellido_materno) ? $item->apellido_materno : '';
    $hashDetalle .= !empty($item->apellido_paterno) ? $item->apellido_paterno : '';
    $hashDetalle .= !empty($item->auto_conclusion) ? $item->auto_conclusion : '';
    $hashDetalle .= !empty($item->documento_identidad_complemento) ? $item->documento_identidad_complemento : '';

    if (! ($item->id_documento_identidad_tipo == '1' or $item->id_documento_identidad_tipo == '3' or $item->id_documento_identidad_tipo == '4'))
        $hashDetalle .= !empty($resp1['documento_identidad_extension']) ? $resp1['documento_identidad_extension'] : '';

    //$hashDetalle .= !empty($item->id_documento_identidad_extension) ? $item->id_documento_identidad_extension : '';
    $hashDetalle .= !empty($item->documento_identidad_numero) ? $item->documento_identidad_numero : '';
    /* $hashDetalle .= !empty($resp2['cod_documento_identidad_tipo']) ? $resp2['cod_documento_identidad_tipo'] : ''; */
    $hashDetalle .= !empty($item->id_documento_identidad_tipo) ? $item->id_documento_identidad_tipo : '';
    $hashDetalle .= !empty($item->documento_respaldo) ? $item->documento_respaldo : '';
    $hashDetalle .=  $item->id_item_solicitud;
    $hashDetalle .= formatearDecimales(!empty($item->monto_retencion_bs) ? (string)$item->monto_retencion_bs : '');
    $hashDetalle .= !empty($item->nombre) ? $item->nombre : '';
    $hashDetalle .= !empty($item->razon_social) ? $item->razon_social : '';
    $hashDetalle .=  $item->id_tipo_respaldo;
    /* $hashDetalle .= (string)$resp3['tipo_respaldo']; */
    $itemAux['hash_detalle_text'] .= $hashDetalle;
    $itemAux['hash_detalle'] = strtoupper(sha1($hashDetalle));
    return $itemAux;
}

function formatearDecimales($numero)
{
    // Convertimos el número a float para asegurarnos de que es un número
    $numero = floatval($numero);

    // Formateamos el número a dos decimales
    $formateado = number_format($numero, 2, '.', '');

    return $formateado;
}
