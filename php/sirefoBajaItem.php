<?php
session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
$conn = new Conexion();
$cons = $conn->conectar();
if ($swActualizaItems) {
    $fechaEnvio = new DateTime(date('Y-m-d H:i:s'));
    $fecha_envio = $fechaEnvio->format('Y-m-d H:i:s');

    $query = "select a.id_item_solicitud, b.id_cabecera_solicitud, b.detalle_cantidad
            from srf_item_solicitud a
            left join srf_cabecera_solicitud b on b.id_cabecera_solicitud = a.id_cabecera_solicitud 
            where a.id_item_solicitud = $id_item_solicitud;";
    $stmt = $cons->query($query);
    $itemSolicitud = $stmt->fetch(PDO::FETCH_ASSOC);
    $query = "INSERT INTO srf_item_solicitud_hst (
                id_item_solicitud,
                campo,
                valor_anterior,
                valor_nuevo,
                fecha_modificacion,
                idusuario
            ) VALUES (
                " . $itemSolicitud['id_item_solicitud'] . ",
                'estado_',
                true,
                false,
                '" . $fecha_envio . "',
                " . $_SESSION['idusuario'] . "
            )";
    $stmt = $cons->prepare($query);
    $err[] = $stmt->execute();

    $query = "UPDATE srf_item_solicitud 
            SET estado_ = false
            WHERE id_item_solicitud = " . $itemSolicitud['id_item_solicitud'];
    $stmt = $cons->prepare($query);
    $err[] = $stmt->execute();

    //actualizamos el total de solictud

    $nueva_cantidad_detalle = $itemSolicitud['detalle_cantidad'] - 1;
    $query = "INSERT INTO srf_cabecera_solicitud_hst (
                id_cabecera_solicitud,
                campo,
                valor_anterior,
                valor_nuevo,
                fecha_modificacion,
                idusuario
            ) VALUES (
                " . $itemSolicitud['id_cabecera_solicitud'] . ",
                'detalle_cantidad',
                " . $itemSolicitud['detalle_cantidad'] . ",
                " . $nueva_cantidad_detalle . ",
                '" . $fecha_envio . "',
                " . $_SESSION['idusuario'] . "
            )";
    $stmt = $cons->prepare($query);
    $id_cabecera_solicitud = $itemSolicitud['id_cabecera_solicitud'];
    $err[] = $stmt->execute();
} else {
    $nueva_cantidad_detalle = $detalleCantidad;
}

$query = "UPDATE srf_cabecera_solicitud 
            SET  detalle_cantidad  = " . $nueva_cantidad_detalle . "
            WHERE id_cabecera_solicitud = " . $id_cabecera_solicitud . ";";

$stmt = $cons->prepare($query);
$err[] = $stmt->execute();

$resp['nueva_cantidad_detalle'] = $nueva_cantidad_detalle;
$resp['err'] = $err;
$dat = json_encode($resp);
echo $dat;
