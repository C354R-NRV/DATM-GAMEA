<?php
session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}

$conn = new Conexion();
$cons = $conn->conectar();

$pjson = array();
$err = '';
$pjson['err'] = '0';

try {

    $query = "
    select idestado  
    from exc_cabecera a  
    where idcabecera = $idcabecera;";
    $stmt = $cons->query($query);
    $idestadoCabecera = $stmt->fetch(PDO::FETCH_ASSOC);

    $campo = 'idestado';
    $valor_anterior = $idestadoCabecera['idestado'];
    $valor_nuevo = 11; // ENTREGADO EN FISICO

    $query = "UPDATE exc_cabecera 
    SET  idestado  =   $valor_nuevo
    WHERE idcabecera = " . $idcabecera . " ;";

    $stmt = $cons->prepare($query);
    if (!$stmt->execute()) {
        $pjson['log'] .= $stmt->errorInfo();
        $pjson['err'] = '1';
    }

    $fechaEnvio = new DateTime(date('Y-m-d H:i:s'));
    $fecha_envio = $fechaEnvio->format('Y-m-d H:i:s');


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
    )";

    $stmt = $cons->prepare($query);
    $stmt->bindParam(':idcabecera', $idcabecera);
    $stmt->bindParam(':campo', $campo);
    $stmt->bindParam(':valor_anterior', $valor_anterior);
    $stmt->bindParam(':valor_nuevo', $valor_nuevo);
    $stmt->bindParam(':fecha_modificacion', $fecha_envio);
    $stmt->bindParam(':idusuario', $_SESSION['idusuario']);
    if (!$stmt->execute()) {
        $pjson['log'] .= $stmt->errorInfo();
        $pjson['err'] = '1';
    }

    $query = "
    select max(nro_actuado) nro_actuado
    from exc_actuado a  
    where idcabecera = $idcabecera;";
    $stmt = $cons->query($query);
    $resp = $stmt->fetch(PDO::FETCH_ASSOC);
    $nro_actuado = ($resp['nro_actuado'] + 1);

    $query = "INSERT INTO  exc_actuado 
            (idcabecera, nro_actuado, idestado , fecha_registro, idusuario) values
            (:idcabecera, :nro_actuado, :idestado , :fecha_registro, :idusuario)";

    $stmt = $cons->prepare($query);
    $stmt->bindParam(':idcabecera', $idcabecera);
    $stmt->bindParam(':nro_actuado', $nro_actuado);
    $stmt->bindParam(':idestado', $valor_nuevo);
    $stmt->bindParam(':fecha_registro', $fecha_envio);
    $stmt->bindParam(':idusuario', $_SESSION['idusuario']);

    if (!$stmt->execute()) {
        $pjson['log'] .= $stmt->errorInfo();
        $pjson['err'] = '1';
    } else {
        $idactuado = $cons->lastInsertId();
    }

    // ya que se esta entregando los documentos NO observados, se los adhiere al actuado de ENTREGA, para su final revision en fisico

    $query = "
    select c.documento_path, c.idrequisito , a.iditem_act
    from exc_item_actuado a 
    left join exc_item_actuado  c on a.iditem_actuado_ant = c.iditem_act
    left join exc_actuado b on a.idactuado = b.idactuado
    where a.estado_ is true and b.estado_ is true
    and a.idestado = 6
    and idcabecera = $idcabecera order by idrequisito;";
    $stmt = $cons->query($query);
    $resp = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resp as $key => $value) {
        $query = "INSERT INTO exc_item_actuado (
            idusuario,
            idestado,
            idactuado,
            iditem_actuado_ant, 
            fecha_registro,
            idrequisito,
            documento_path 
        ) VALUES (
            :idusuario,
            :idestado,
            :idactuado,
            :iditem_actuado_ant, 
            :fecha_registro ,
            :idrequisito,
            :documento_path
        );";

        $stmt = $cons->prepare($query);
        $stmt->bindParam(':idusuario', $_SESSION['idusuario']);
        $stmt->bindParam(':idestado', $valor_nuevo);
        $stmt->bindParam(':idactuado', $idactuado);
        $stmt->bindParam(':iditem_actuado_ant', $value['iditem_act']);
        $stmt->bindParam(':fecha_registro', $fecha_envio);
        $stmt->bindParam(':idrequisito', $value['idrequisito']);
        $stmt->bindParam(':documento_path', $value['documento_path']);
        $stmt->execute();

        

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
