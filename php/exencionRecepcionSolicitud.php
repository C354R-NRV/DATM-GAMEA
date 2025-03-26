<?php
session_start();
require_once './conexionpsql.php';
require_once './whatsappNotificacion.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
$conn = new Conexion();
$cons = $conn->conectar();
$err = array();
$fechaEnvio = new DateTime(date('Y-m-d H:i:s'));
$fecha_envio = $fechaEnvio->format('Y-m-d H:i:s');
$campo = 'idestado';
$valor_anterior = 2;
$valor_nuevo = 3;
$pjson = array();
$pjson['err'] = 0;

$query = "INSERT INTO exc_cabecera_hst (
        idcabecera,
        campo,
        valor_anterior,
        valor_nuevo,
        fecha_modificacion,
        idusuario  
    ) VALUES (
        :idcabecera,
        :campo,
        :valor_anterior,
        :valor_nuevo,
        :fecha_modificacion,
        :idusuario 
    );";

$stmt = $cons->prepare($query);
$stmt->bindParam(':idcabecera', $idsolicitud);
$stmt->bindParam(':campo', $campo);
$stmt->bindParam(':valor_anterior', $valor_anterior);
$stmt->bindParam(':valor_nuevo', $valor_nuevo);
$stmt->bindParam(':fecha_modificacion', $fecha_envio);
$stmt->bindParam(':idusuario', $_SESSION['idusuario']);
if (!$stmt->execute()) {
    $pjson['log'] .= $stmt->errorInfo();
    $pjson['err'] = '1';
}

$query = "UPDATE exc_cabecera 
        SET  idestado  = $valor_nuevo 
        WHERE idcabecera = " . $idsolicitud . ";";
$stmt = $cons->prepare($query);
if (!$stmt->execute()) {
    $pjson['log'] .= $stmt->errorInfo();
    $pjson['err'] = '1';
}


$query = "
select a1.iditem_act, a1.idactuado, b1.nro_actuado, b1.idcabecera, a1.idrequisito, a1.idestado
from exc_item_actuado as a1 
left join exc_actuado b1 on a1.idactuado = b1.idactuado
where nro_actuado in (
select max(a.nro_actuado) nro_actuado
from  exc_actuado  a 
where a.idcabecera =  $idsolicitud  and a.estado_ is true )
and  b1.idcabecera =  $idsolicitud; ";

$stmt = $cons->query($query);
$actuados = $stmt->fetchAll(PDO::FETCH_ASSOC);
$idestado = 3;

$query = "INSERT INTO exc_actuado (
    idusuario, 
    idcabecera,
    idestado,
    fecha_registro,
    nro_actuado
    ) VALUES (
        :idusuario, 
        :idcabecera,
        :idestado,
        :fecha_registro,
        :nro_actuado
    )";
$stmt = $cons->prepare($query);
$stmt->bindParam(':idusuario', $_SESSION['idusuario']);
$stmt->bindParam(':idcabecera', $idsolicitud);
$stmt->bindParam(':idestado', $idestado);
$stmt->bindParam(':fecha_registro', $fecha_envio);
$stmt->bindValue(':nro_actuado', ($actuados[0]['nro_actuado'] + 1));

if (!$stmt->execute()) {
    $pjson['log'] .= $stmt->errorInfo();
    $pjson['err'] = '1';
} else {
    $idactuado = $cons->lastInsertId();
    $pjson['idactuado'] = $idactuado;
}

foreach ($actuados as $key => $value) {

    $query = "INSERT INTO exc_item_actuado (
        idusuario,
        idestado,
        idactuado,
        iditem_actuado_ant, 
        fecha_registro,
        idrequisito
    ) VALUES (
        :idusuario,
        :idestado,
        :idactuado,
        :iditem_actuado_ant, 
        :fecha_registro ,
        :idrequisito
    );";

    $stmt = $cons->prepare($query);
    $stmt->bindParam(':idusuario', $_SESSION['idusuario']);
    $stmt->bindParam(':idestado', $idestado);
    $stmt->bindParam(':idactuado', $idactuado);
    $stmt->bindParam(':iditem_actuado_ant', $value['iditem_act']);
    $stmt->bindParam(':fecha_registro', $fecha_envio);
    $stmt->bindParam(':idrequisito', $value['idrequisito']);
    $stmt->execute();
}
if ($pjson['err'] == 0) {
    $query = "
    select a.codigo_solicitud, b.contacto,  upper(concat(nombres, ' ', primer_apellido, ' ', segundo_apellido)) nombres
    from exc_cabecera a 
    left join datm_usuario b on b.id = a.uregistro_  
    where a.idcabecera =   $idsolicitud";

    $stmt = $cons->query($query);
    $solicitud = $stmt->fetch(PDO::FETCH_ASSOC);

    $numeroBolivia = '591' . $solicitud['contacto'];
    $mensaje = '🚨 Esta es una notificación automática desde *D.A.T.M.*
(No responda a este mensaje por favor).

*Estimad@ ' . trim($solicitud['nombres']) . '*
📥 D.A.T.M. ha recibido su solicitud: ' . $solicitud['codigo_solicitud'] . '
💁‍♂ El funcionario receptor es: ' . $_SESSION['nombreUsuario'] . '
✍ Será notificado una vez que se culmine con la revisión de los requisitos presentados en su solicitud
                
¡La Dirección de Administración Tributaria Municipal de El Alto esta a su servicio!';

    //[PENDIENTE] completar manejo de posibles errores
    enviarMensajeWhatsApp($numeroBolivia, $mensaje);   
    
}
$dat = json_encode($pjson);
echo $dat;
