<?php
session_start();
require_once './conexionpsql.php';
require_once './whatsappNotificacion.php';


foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$conn = new Conexion();
$cons = $conn->conectar();

$pjson = array();
$err = '';
$pjson['err'] = '0';

//previo a guardar la revision verificamos que el tecnico haya revisado todos los requisitos
$query = "SELECT count(a.idactuado) cnt_por_revisar  from exc_item_actuado a 
                left join exc_actuado b on a.idactuado = b.idactuado 
                where a.idactuado = $idactuado
                and a.idestado in (2,3,7,11)";
$stmt = $cons->query($query);
$resp = $stmt->fetch(PDO::FETCH_ASSOC); 
try { 
    if ($resp['cnt_por_revisar'] > 0) {
        $pjson['log'] .= "<p class='rspIncorrecta'>[x] No se ha completado la revision de la totalidad de los documentos enviados en requisitos; 
        <br><br>POR REVISAR: " . $resp['cnt_por_revisar'] . "</p>";
        $pjson['err'] = '1';
    } else {

        $query = "
            select count(*) observados   
            from exc_item_actuado a  
            where idestado = 5  and idactuado = $idactuado;";
        $stmt = $cons->query($query);
        $cntObservado = $stmt->fetch(PDO::FETCH_ASSOC);


        $idestado = 6;
        if ($cntObservado['observados'] > 0) {
            $idestado = 5;
        }

        $query = "UPDATE exc_actuado 
                SET  idestado  = $idestado , observacion = '$obs_gral' 
                WHERE idactuado = $idactuado;";
        $stmt = $cons->prepare($query);
        if (!$stmt->execute()) {
            $pjson['log'] .= $stmt->errorInfo();
            $pjson['err'] = '1';
        }

        $query = "
            select idcabecera   
            from exc_actuado a  
            where  idactuado = $idactuado;";
        $stmt = $cons->query($query);
        $actuado_ = $stmt->fetch(PDO::FETCH_ASSOC);

        $query = "UPDATE exc_cabecera 
                SET  idestado  = $idestado  
                WHERE idcabecera = " . $actuado_['idcabecera'] . " ;";

        $stmt = $cons->prepare($query);
        if (!$stmt->execute()) {
            $pjson['log'] .= $stmt->errorInfo();
            $pjson['err'] = '1';
        }

        if ($pjson['err'] == 0) {
            $query = " 
                select e.observacion, d.contacto,  upper(concat(nombres, ' ', primer_apellido, ' ', segundo_apellido)) nombres, c.codigo_solicitud
                from  exc_actuado e 
                left join exc_cabecera c on c.idcabecera = e.idcabecera
                left join datm_usuario d on d.id = c.uregistro_
                where e.idactuado = $idactuado ;";
            $stmt = $cons->query($query);
            $actuado = $stmt->fetch(PDO::FETCH_ASSOC);

            $contacto_ = $actuado['contacto'];
            $nombre_ = $actuado['nombres'];

            $mensaje = '🚨 Esta es una notificación automática desde *D.A.T.M.*
(No responda a este mensaje por favor).

*Estimad@ ' . trim($nombre_) . '*

Se ha concluido con la revisión de su solicitud *' . $actuado['codigo_solicitud'] . '*';

            if ($idestado == '5') {
                if (strlen(trim($actuado['observacion'])) > 0) {
                    $mensaje .= ', se tiene la siguiente *observación* general:
" _' . trim($actuado['observacion']) . '_ "';
                }
                $mensaje .= '
Ingrese al sistema, modulo: EXENCIÓN, solicitud: ' . $itemobservado['codigo_solicitud'] . ' para ver más detalles.
https://datm.elalto.gob.bo/ 
';
            } else {
                $mensaje .= '  *SIN OBSERVACIONES!*, por lo que le envitamos a realizar la entrega de los requisitos en fisico en la oficina de D.A.T.M.:
Nuestra dirección es Zona Villa Bolivar D, Terminal Metropolitana de El Alto, La Paz, Bolivia.  El horario de atención es de lunes a viernes de 8:00 a 16:00.  
Puedes encontrar nuestra ubicación en este enlace: https://maps.app.goo.gl/RSHmPufwraJnA1vx8 
                    ';
            }
            $mensaje .= '
¡La Dirección de Administración Tributaria Municipal de El Alto esta a su servicio!';

            //[PENDIENTE] completar manejo de posibles errores
            enviarMensajeWhatsApp('591' . $contacto_, $mensaje);
        }
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
