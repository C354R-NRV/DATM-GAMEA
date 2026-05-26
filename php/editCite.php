<?php
session_start();
require_once './conexionpsql.php';
foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
try {
    $conn = new Conexion();
    $cons = $conn->conectar();
    $cons->beginTransaction();
    $resp = array();
    $resp['message'] = '';

    // Sanitize and prepare input
    $idcite = filter_input(INPUT_POST, 'idcite', FILTER_SANITIZE_NUMBER_INT);
    date_default_timezone_set('America/La_Paz');
    $fechaEdita = date('Y-m-d H:i:s');

    // Fetch current data
    $query = "SELECT hhrr_, referencia, destino, fecha_registro FROM datm_cites WHERE idcite = :idcite";
    $stmt = $cons->prepare($query);
    $stmt->bindParam(':idcite', $idcite, PDO::PARAM_INT);
    $stmt->execute();
    $datosActuales = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$datosActuales) {
        throw new Exception("No se encontró el registro con idcite: $idcite");
    }

    $camposModificados = array();
    $camposARevisar = ['hhrr_', 'referencia', 'destino', 'fecha_registro'];

    foreach ($camposARevisar as $campo) {
        $valorActual = $datosActuales[$campo];
        $valorNuevo = $$campo; // Using variable variables

        //if ($campo == 'fecha_registro')
            //$resp['message'] .= "$campo|valorActual:$valorActual=valorNuevo:$valorNuevo<br>\n";

        if ($valorActual != $valorNuevo) {
            $camposModificados[] = array(
                'campo' => $campo,
                'valor_anterior' => $valorActual,
                'valor_nuevo' => $valorNuevo,
                'idcite' => $idcite
            );
        }
    }

    if (!empty($camposModificados)) {
        foreach ($camposModificados as $campoModificado) {
            // Insert into history table
            $queryHist = "INSERT INTO datm_cites_hst (idcite, campo, valor_anterior, valor_nuevo, fecha_modificacion, idusuario) 
                            VALUES (:idcite, :campo, :valor_anterior, :valor_nuevo, :fecha_modificacion, :idusuario)";
            $stmtHist = $cons->prepare($queryHist);
            $stmtHist->bindParam(':idcite', $campoModificado['idcite'], PDO::PARAM_INT);
            $stmtHist->bindParam(':campo', $campoModificado['campo'], PDO::PARAM_STR);
            $stmtHist->bindParam(':valor_anterior', $campoModificado['valor_anterior'], PDO::PARAM_STR);
            $stmtHist->bindParam(':valor_nuevo', $campoModificado['valor_nuevo'], PDO::PARAM_STR);
            $stmtHist->bindParam(':fecha_modificacion', $fechaEdita, PDO::PARAM_STR);
            $stmtHist->bindParam(':idusuario', $_SESSION['idusuario'], PDO::PARAM_INT);
            $stmtHist->execute();

            // Update main table
            $queryUpdate = "UPDATE datm_cites SET {$campoModificado['campo']} = :valor_nuevo WHERE idcite = :idcite";
            $stmtUpdate = $cons->prepare($queryUpdate);
            $stmtUpdate->bindParam(':valor_nuevo', $campoModificado['valor_nuevo'], PDO::PARAM_STR);
            $stmtUpdate->bindParam(':idcite', $campoModificado['idcite'], PDO::PARAM_INT);
            $stmtUpdate->execute();
        }
    }

    $cons->commit();
    $resp['message']  .= "Se ha realizado correctamente el registro de la edicion del CITE";
    $resp['estado'] = 'green';
    $resp['title'] = 'Edicion completa';
} catch (Exception $e) {
    if (isset($cons)) {
        $cons->rollBack();
    }
    $resp['message']  = $e->getMessage();
    $resp['estado'] = 'red';
    $resp['title'] = 'Ocurrio un error';
} finally {

    if (isset($cons)) {
        $cons = null;
    }
    header('Content-Type: application/json');
    $dat = json_encode($resp);
    echo $dat;
}
