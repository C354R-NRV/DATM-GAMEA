<?php
session_start();
require_once './conexionpsql.php';

$conn = new Conexion();
$cons = $conn->conectar();

$query = "select * from datm_parametro";
$stmt = $cons->query($query);
$parametros = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pjson = array();
$cabecera = new stdClass();
foreach ($_POST as $clave => $valor) {
    if (strpos($clave, 'cabecera_') === 0) {
        $key = str_replace('cabecera_', '', $clave);
        $cabecera->$key = addslashes(trim($valor));
    }
    /* elseif (strpos($clave, 'item_') === 0) {
        $key = str_replace('item_', '', $clave);
        $items[] = array('key' => $key, 'value' => addslashes(trim($valor)));
    } */
}

$pjson['log'] =  " nroCite:" . $cabecera->codigo_solicitud . "<br>";

$err = '';
$fileName = '';
$base64File = '';

$query = " select * 
from srf_cabecera_solicitud 
where  codigo_solicitud = '" . $cabecera->codigo_solicitud . "' and tipo_proceso = '" . $cabecera->tipo_proceso . "' and estado_ ";
$stmt = $cons->query($query);
$srfCabecera = $stmt->fetch(PDO::FETCH_ASSOC);

$fichero = $_SERVER['DOCUMENT_ROOT'];
$uploadDir = '/static/sirefo/';
if (isset($_FILES["cabecera_archivoPdf"]["tmp_name"])) {

    $fileName = 'srf_' . uniqid() . '.pdf';
    $fileTmpPath = $_FILES["cabecera_archivoPdf"]["tmp_name"];

    if (!move_uploaded_file($fileTmpPath, $fichero . $uploadDir . $fileName)) {
        $err .= "Hubo un error al guardar el archivo en el directorio de destino.";
        $pjson['log'] .= 'Hubo un error al guardar el archivo en el directorio de destino.<br>';
    } else {
        $pjson['log'] .= 'archivo subido correctamente.<br>';
    }
    $pdfFile = file_get_contents($fichero . $uploadDir . $fileName);
    $sha1Hash = sha1($pdfFile);
    $cabecera->hash_imagen = $sha1Hash; // POR CONSOLIDAR INFORMACION 
    $pjson['sha1Hash'] = $sha1Hash;
    $base64Pdf = base64_encode($pdfFile);
} else {
    $fileName = $srfCabecera['adjunto_nombre'];
    $base64Pdf = $srfCabecera['adjunto'];
}

if ($srfCabecera) {
    $cabecera->fecha_envio = $srfCabecera['fecha_envio'];
    $cabecera->fecha_envio_ansi = $srfCabecera['fecha_envio_ansi'];
    /*  $fechaEnvio = new DateTime(date('Y-m-d H:i:s'));
        $fechaEnvio = $fechaEnvio->format('Y-m-d H:i:s'); */
} else {
    $cabecera->fecha_envio_ansi = date('YmdHis');
    $fechaEnvio = new DateTime(date('Y-m-d H:i:s'));
    $cabecera->fecha_envio = $fechaEnvio->format('Y-m-d H:i:s');
}

$cabecera->adjunto = $base64Pdf;
$cabecera->adjunto_nombre = $fileName;

$query = " select * from datm_usuario where estado like 'DESBLOQUEADO' and rol like 'DIRECCION' ";
$stmt = $cons->query($query);
$mae = $stmt->fetchAll(PDO::FETCH_ASSOC);

$cabecera->autoridad_cargo = $mae[0]['cargo'];
$cabecera->autoridad_solicitante = $mae[0]['nombres'] . ' ' . $mae[0]['primer_apellido'] . ' ' . $mae[0]['segundo_apellido'];
$cabecera->entidad = $parametros[0]['sigla_entidad']; // POR CONSOLIDAR INFORMACION


$cabecera->gerencia = $parametros[0]['nombre_entidad']; // POR CONSOLIDAR INFORMACION
$pjson['log'] .= 'gerencia:' . $cabecera->gerencia . '.<br>';
$cabecera->idusuario =  $_SESSION['idusuario'] ? $_SESSION['idusuario'] : 1;

$texto = '';
$texto .= !empty($cabecera->adjunto_nombre) ? $cabecera->adjunto_nombre : '';
$texto .= !empty($cabecera->autoridad_cargo) ? $cabecera->autoridad_cargo : '';
$texto .= !empty($cabecera->autoridad_solicitante) ? $cabecera->autoridad_solicitante : '';
$texto .= !empty($cabecera->codigo_solicitud) ? $cabecera->codigo_solicitud : '';
$texto .= !empty($cabecera->entidad) ? $cabecera->entidad : '';
$texto .= !empty($cabecera->fecha_envio_ansi) ? $cabecera->fecha_envio_ansi : '';
$texto .= !empty($cabecera->gerencia) ? $cabecera->gerencia : '';
$texto .= !empty($cabecera->tipo_proceso) ? $cabecera->tipo_proceso : '';
$cabecera->hash_datos = sha1($texto);
$pjson['hash_datos'] = $cabecera->hash_datos;


$nErr = true;

if (empty($srfCabecera)) {

    //no existe la cabecera
    $pjson['log'] .= " cabecera no existente, creando. <br>";
    $query = "INSERT INTO srf_cabecera_solicitud (
            adjunto,         adjunto_nombre,        autoridad_cargo,        autoridad_solicitante,        codigo_solicitud,
            detalle_cantidad,        entidad,        fecha_envio,        fecha_envio_ansi,        gerencia,         
            hash_datos, hash_imagen,         tipo_proceso,        idusuario,        estado_
        ) VALUES (
            :adjunto,        :adjunto_nombre,        :autoridad_cargo,        :autoridad_solicitante,        :codigo_solicitud,
            :detalle_cantidad,        :entidad,        :fecha_envio,        :fecha_envio_ansi,        :gerencia, 
            :hash_datos, :hash_imagen,         :tipo_proceso,        :idusuario,        :estado_
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
    $stmt->bindParam(':hash_datos', $cabecera->hash_datos);

    $stmt->bindParam(':estado_', $nErr);
    $stmt->bindParam(':fecha_envio', $cabecera->fecha_envio);

    $nErr = $stmt->execute();
    $query = " select * 
                from srf_cabecera_solicitud 
                where  codigo_solicitud = '" . $cabecera->codigo_solicitud . "' and tipo_proceso = '" . $cabecera->tipo_proceso . "' and estado_  ";
    $stmt = $cons->query($query);
    $srfCabecera = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($nErr) { 

    $pjson['log'] .= " Sin errores durante posible reigstro de cabecera <br>";
    $cabecera->IdSolicitud = $srfCabecera['id_cabecera_solicitud'];

    // ------------- items solicitud -------------------
    //, por un total de " . $cabecera->cntItem . "
    $pjson['log'] .= " para guardar items de la solicitud<br>";
    //item_detalleCantidad // vamos registrando los items listados
    $fechaEdita = new DateTime(date('Y-m-d H:i:s'));
    $fechaEdita = $fechaEdita->format('Y-m-d H:i:s');

    $cntValidos = 0;
    $pjson['log'] .= " == para con == cabecera->detalle_cantidad:" . $cabecera->detalle_cantidad . "\n<br>";
    $detalle_cantidad_aux = $cabecera->detalle_cantidad;
    $cabecera->swItems = filter_var($cabecera->swItems, FILTER_VALIDATE_BOOLEAN);
    $pjson['log'] .= " == cabecera->swItems:" . $cabecera->swItems . "\n<br>";
    if ($cabecera->swItems) {

        $auxCntItem = $cabecera->cntItem;
        if ($cabecera->nroitem != 0) {
            $auxCntItem = $cabecera->nroitem + 1;
        }

        $pjson['log'] .= " == previo para iterar cntItem: " . $auxCntItem . "\n<br>";
        for ($i = 0; $i < $auxCntItem; $i++) {
            if (
                isset($_POST['item_documentoIdentidadNumero' . $i]) and
                trim($_POST['item_documentoIdentidadNumero' . $i]) != '' and
                preg_match('/^[a-zA-Z0-9\s]{2,}$/', $_POST['item_documentoIdentidadNumero' . $i])
            ) {

                /* echo "\nProcesando para item_documentoIdentidadNumero:".$_POST['item_documentoIdentidadNumero' . $i]."\n"; */

                $cntValidos++;
                $pjson['log'] .= " ===> Agregando:$cntValidos\n<br>";
                $item = new stdClass();
                $item->tipo_persona = $_POST['item_tipo_persona' . $i];
                $item->nombre = $_POST['item_nombre' . $i];
                $item->apellido_paterno = $_POST['item_apellidoPaterno' . $i];
                $item->apellido_materno = $_POST['item_apellidoMaterno' . $i];
                $item->razon_social = $_POST['item_razonSocial' . $i];
                $item->id_documento_identidad_tipo = $_POST['item_id_documento_identidad_tipo' . $i];
                $item->documento_identidad_numero = $_POST['item_documentoIdentidadNumero' . $i];
                $item->documento_identidad_complemento = $_POST['item_documentoIdentidadComplemento' . $i];
                $item->id_documento_identidad_extension = $_POST['item_id_documento_identidad_extension' . $i];
                $item->auto_conclusion = $_POST['item_autoConclusion' . $i];
                $item->id_tipo_respaldo = $_POST['item_id_tipo_respaldo' . $i];
                $item->documento_respaldo = $_POST['item_documentoRespaldo' . $i];
                $item->monto_retencion_bs = $_POST['item_montoRetencionBs' . $i];
                $item->monto_retencion_ufv = $_POST['item_montoRetencionUFV' . $i];
                $item->id_cabecera_solicitud = $cabecera->IdSolicitud;
                $item->estado_ = true;


                //obtener los valores de id_documento_identidad_extension   id_tipo_respaldo  id_documento_identidad_tipo
                //y reemplazar esos valores para el hashDetalle 

                $hashDetalle = '';
                $hashDetalle .= !empty($item->apellido_materno) ? $item->apellido_materno : '';
                $hashDetalle .= !empty($item->apellido_paterno) ? $item->apellido_paterno : '';
                $hashDetalle .= !empty($item->auto_conclusion) ? $item->auto_conclusion : '';
                $hashDetalle .= !empty($item->documento_identidad_complemento) ? $item->documento_identidad_complemento : '';

                $query = "SELECT * FROM srf_documento_identidad_extension WHERE id_documento_identidad_extension = :id_documento_identidad_extension";
                $stmt = $cons->prepare($query);
                $stmt->bindParam(':id_documento_identidad_extension', $item->documentoIdentidadExtension);
                $stmt->execute();
                $resp = $stmt->fetch(PDO::FETCH_ASSOC);
                $hashDetalle .= !empty($resp['documento_identidad_extension']) ? $resp['documento_identidad_extension'] : '';
                $hashDetalle .= !empty($item->documento_identidad_numero) ? $item->documento_identidad_numero : '';


                $query = "SELECT * FROM srf_documento_identidad_tipo WHERE id_documento_identidad_tipo = :id_documento_identidad_tipo";
                $stmt = $cons->prepare($query);
                $stmt->bindParam(':id_documento_identidad_tipo', $item->id_documento_identidad_tipo);
                $stmt->execute();
                $resp = $stmt->fetch(PDO::FETCH_ASSOC);
                $hashDetalle .= !empty($resp['cod_documento_identidad_tipo']) ? $resp['cod_documento_identidad_tipo'] : '';

                $hashDetalle .= !empty($item->documento_respaldo) ? $item->documento_respaldo : '';
                $hashDetalle .= !empty($item->monto_retencion_bs) ? (string)$item->monto_retencion_bs : '';
                $hashDetalle .= !empty($item->nombre) ? $item->nombre : '';
                $hashDetalle .= !empty($item->razon_social) ? $item->razon_social : '';


                $query = "SELECT * FROM srf_tipo_respaldo WHERE id_tipo_respaldo = :id_tipo_respaldo";
                $stmt = $cons->prepare($query);
                $stmt->bindParam(':id_tipo_respaldo', $item->id_tipo_respaldo);
                $stmt->execute();
                $resp = $stmt->fetch(PDO::FETCH_ASSOC);
                $hashDetalle .= (string)$resp['tipo_respaldo'];
                $pjson['hashDetalle'] = " == texto hashDetalle:$hashDetalle<br>";
                $item->hash_detalle = sha1($hashDetalle);

                //verificamos la existencia previa de  documento_identidad_numero asociado a CABECERA 

                $query = "SELECT * FROM srf_item_solicitud 
                        WHERE documento_identidad_numero = :documento_identidad_numero 
                        and documento_identidad_complemento like :documento_identidad_complemento
                        and id_cabecera_solicitud = :id_cabecera_solicitud";
                $stmt = $cons->prepare($query);
                $stmt->bindParam(':documento_identidad_numero', $item->documento_identidad_numero);
                $stmt->bindParam(':id_cabecera_solicitud', $cabecera->IdSolicitud);
                $stmt->bindParam(':documento_identidad_complemento', $item->documento_identidad_complemento);
                $stmt->execute();
                $datosActuales = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // en caso de que datosActuales este vacio, se debera realizar un INSERT 0000000000000000000000000000
                if (empty($datosActuales) and $item->documento_identidad_numero) {
                    //para: " . $item->documento_identidad_numero . " en idcabecera: " . $cabecera->IdSolicitud . ", creamos el item
                    $pjson['log'] .= " no existe item <br>";
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
                            id_documento_identidad_extension
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
                            :id_documento_identidad_extension
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
                    $stmt->execute();
                } else {
                    //para: " . $item->documento_identidad_numero . " en idcabecera: " . $cabecera->IdSolicitud . ", vamos a verificar si hay cambios
                    $pjson['log'] .= " Item existente .<br>";

                    $camposModificados = array();
                    /* echo "\n ============================ \n";
                var_dump($datosActuales);
                echo "\n ============================ \n"; */
                    $id_item_solicitud = 0;
                    foreach ($datosActuales as $campoBase => $datosActualesTupla) {
                        $id_item_solicitud = $datosActualesTupla['id_item_solicitud'];
                        /* echo "\n ============================ \n";
                    echo "id_item_solicitud:$id_item_solicitud";
                    echo "\n ============================ \n"; */
                        //$id_item_solicitud = $datosActualesTupla->id_item_solicitud;
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
                                    /* echo "\n ########### Campo modificado '$campo' de:$valorActualJsonb a:$valorNuevoJsonb. - con id_item_solicitud:$id_item_solicitud############## \n"; */
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
                    /* echo " \n %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% \n";
                var_dump($camposModificados);
                echo " \n %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% \n"; */

                    if (!empty($camposModificados)) {
                        /* $pjson['log'] .= " -- Hubo cambios en el item, guardando cambios<br>"; */
                        foreach ($camposModificados as $campoModificado) {
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

                            $query = "UPDATE srf_item_solicitud 
                                    SET " . $campoModificado['campo'] . " = '" . $campoModificado['valor_nuevo'] . "'
                                    WHERE id_item_solicitud = " . $campoModificado['id_item_solicitud'];
                            $stmt = $cons->prepare($query);
                            $err = $stmt->execute();
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
    $pjson['log'] .= " == cabecera->detalle_cantidad:" . $cabecera->detalle_cantidad . "\n<br>";
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
            /* $pjson['query_update_srf_cabecera_solicitud '] = $query; */

            /* $stmt->bindParam(':campoDinamico', $campoModificado['valor_nuevo']);
            $stmt->bindParam(':IdSolicitud', intval($cabecera->IdSolicitud)); */
            // $err = $stmt->execute();
        }
    }
} else {
    echo "Error saving cabecera: " . $stmt->errorInfo()[2];
    $pjson['log'] .= " error al guardar la cabecera:" . $stmt->errorInfo()[2] . "<br>";
}
$dat = json_encode($pjson);
echo $dat;
