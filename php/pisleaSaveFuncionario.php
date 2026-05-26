<?php
session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    if (is_array($valor)) {
        $$clave = array_map(function ($v) {
            return is_array($v) ? $v : addslashes(trim($v));
        }, $valor);
    } else {
        $$clave = addslashes(trim($valor));
    }
}

$pjson = array(
    'err' => '0',
    'message' => '',
    'log' => ''
);

try {
    if (!isset($_SESSION['idusuario'])) {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'unauthenticated',
            'message' => 'Usuario no autenticado'
        ]);
        exit;
    }

    $conn = new Conexion();
    $cons = $conn->conectar();
    $cons->beginTransaction();

    $idfuncionario = isset($idfuncionario) && !empty($idfuncionario) ? $idfuncionario : null;
    
    if ($idfuncionario) {
        // Actualizar funcionario existente
        $query = "UPDATE pislea_funcionario SET 
                    nombres = :nombres,
                    apellido_paterno = :apellido_paterno,
                    apellido_materno = :apellido_materno,
                    contacto = :contacto,
                    idarea = :idarea,
                    idnivel_know = :idnivel_know
                  WHERE idfuncionario = :idfuncionario";
        
        $stmt = $cons->prepare($query);
        $stmt->bindParam(':idfuncionario', $idfuncionario);
        $stmt->bindParam(':nombres', $nombres);
        $stmt->bindParam(':apellido_paterno', $apellido_paterno);
        $stmt->bindParam(':apellido_materno', $apellido_materno);
        $stmt->bindParam(':contacto', $contacto);
        $stmt->bindParam(':idarea', $idarea);
        $idnivel_know_val = !empty($idnivel_know) ? $idnivel_know : null;
        $stmt->bindParam(':idnivel_know', $idnivel_know_val);
        
        if (!$stmt->execute()) {
            throw new Exception("Error al actualizar funcionario");
        }
        
        // Desactivar equipos y software anteriores
        $cons->exec("UPDATE pislea_equipo SET estado_ = false WHERE idfuncionario = $idfuncionario");
        $cons->exec("UPDATE pislea_software SET estado_ = false WHERE idfuncionario = $idfuncionario");
        
    } else {
        // Insertar nuevo funcionario
        $query = "INSERT INTO pislea_funcionario 
                    (nombres, apellido_paterno, apellido_materno, contacto, idarea, idnivel_know, fregistro_, uregsitro_, estado_) 
                  VALUES 
                    (:nombres, :apellido_paterno, :apellido_materno, :contacto, :idarea, :idnivel_know, :fregistro_, :uregsitro_, true)";
        
        $stmt = $cons->prepare($query);
        $stmt->bindParam(':nombres', $nombres);
        $stmt->bindParam(':apellido_paterno', $apellido_paterno);
        $stmt->bindParam(':apellido_materno', $apellido_materno);
        $stmt->bindParam(':contacto', $contacto);
        $stmt->bindParam(':idarea', $idarea);
        $idnivel_know_val = !empty($idnivel_know) ? $idnivel_know : null;
        $stmt->bindParam(':idnivel_know', $idnivel_know_val);
        
        $idusuario = $_SESSION['idusuario'];
        $stmt->bindParam(':uregsitro_', $idusuario);
        
        $fecha = new DateTime(date('Y-m-d H:i:s'));
        $fecha_ = $fecha->format('Y-m-d H:i:s');
        $stmt->bindParam(':fregistro_', $fecha_);
        
        if (!$stmt->execute()) {
            throw new Exception("Error al insertar funcionario");
        }
        
        $idfuncionario = $cons->lastInsertId();
    }

    // Insertar/Actualizar equipos
    if (isset($equipos) && is_array($equipos)) {
        foreach ($equipos as $equipo) {
            if (empty($equipo['sistema_operativo']) && empty($equipo['ofimatica']) && empty($equipo['mac_address'])) {
                continue;
            }
            
            if (isset($equipo['idequipo']) && !empty($equipo['idequipo'])) {
                // Actualizar equipo existente
                $queryEq = "UPDATE pislea_equipo SET 
                            sistema_operativo = :sistema_operativo,
                            ofimatica = :ofimatica,
                            mac_address = :mac_address,
                            estado_ = true
                          WHERE idequipo = :idequipo";
                
                $stmtEq = $cons->prepare($queryEq);
                $stmtEq->bindParam(':idequipo', $equipo['idequipo']);
            } else {
                // Insertar nuevo equipo
                $queryEq = "INSERT INTO pislea_equipo 
                            (sistema_operativo, ofimatica, mac_address, idfuncionario, estado_) 
                          VALUES 
                            (:sistema_operativo, :ofimatica, :mac_address, :idfuncionario, true)";
                
                $stmtEq = $cons->prepare($queryEq);
                $stmtEq->bindParam(':idfuncionario', $idfuncionario);
            }
            
            $sistema_op = isset($equipo['sistema_operativo']) ? $equipo['sistema_operativo'] : null;
            $ofimatica = isset($equipo['ofimatica']) ? $equipo['ofimatica'] : null;
            $mac = isset($equipo['mac_address']) ? $equipo['mac_address'] : null;
            
            $stmtEq->bindParam(':sistema_operativo', $sistema_op);
            $stmtEq->bindParam(':ofimatica', $ofimatica);
            $stmtEq->bindParam(':mac_address', $mac);
            
            if (!$stmtEq->execute()) {
                throw new Exception("Error al guardar equipo");
            }
        }
    }

    // Insertar/Actualizar software
    if (isset($software) && is_array($software)) {
        foreach ($software as $soft) {
            if (empty($soft['nombre_software']) && empty($soft['fabricante_proveedor']) && 
                empty($soft['hardware_asociado']) && empty($soft['uso_especifico'])) {
                continue;
            }
            
            if (isset($soft['idsoftware']) && !empty($soft['idsoftware'])) {
                // Actualizar software existente
                $querySw = "UPDATE pislea_software SET 
                            nombre_software = :nombre_software,
                            fabricante_proveedor = :fabricante_proveedor,
                            hardware_asociado = :hardware_asociado,
                            uso_especifico = :uso_especifico,
                            estado_ = true
                          WHERE idsoftware = :idsoftware";
                
                $stmtSw = $cons->prepare($querySw);
                $stmtSw->bindParam(':idsoftware', $soft['idsoftware']);
            } else {
                // Obtener el siguiente ID para software
                $maxIdQuery = "SELECT COALESCE(MAX(idsoftware), 0) + 1 as next_id FROM pislea_software";
                $maxIdStmt = $cons->query($maxIdQuery);
                $nextId = $maxIdStmt->fetch(PDO::FETCH_ASSOC)['next_id'];
                
                // Insertar nuevo software
                $querySw = "INSERT INTO pislea_software 
                            (idsoftware, nombre_software, fabricante_proveedor, hardware_asociado, uso_especifico, idfuncionario, estado_) 
                          VALUES 
                            (:idsoftware, :nombre_software, :fabricante_proveedor, :hardware_asociado, :uso_especifico, :idfuncionario, true)";
                
                $stmtSw = $cons->prepare($querySw);
                $stmtSw->bindParam(':idsoftware', $nextId);
                $stmtSw->bindParam(':idfuncionario', $idfuncionario);
            }
            
            $nombre_sw = isset($soft['nombre_software']) ? $soft['nombre_software'] : null;
            $fabricante = isset($soft['fabricante_proveedor']) ? $soft['fabricante_proveedor'] : null;
            $hardware = isset($soft['hardware_asociado']) ? $soft['hardware_asociado'] : null;
            $uso = isset($soft['uso_especifico']) ? $soft['uso_especifico'] : null;
            
            $stmtSw->bindParam(':nombre_software', $nombre_sw);
            $stmtSw->bindParam(':fabricante_proveedor', $fabricante);
            $stmtSw->bindParam(':hardware_asociado', $hardware);
            $stmtSw->bindParam(':uso_especifico', $uso);
            
            if (!$stmtSw->execute()) {
                throw new Exception("Error al guardar software");
            }
        }
    }

    $cons->commit();

    $pjson['message'] = 'Funcionario guardado exitosamente';
    $pjson['id'] = $idfuncionario;
    $pjson['status'] = "success";

} catch (Exception $e) {
    if (isset($cons)) {
        $cons->rollBack();
    }
    $pjson['err'] = '1';
    $pjson['message'] = $e->getMessage();
    $pjson['log'] = $e->getTraceAsString();
    $pjson['status'] = "error";
} finally {
    header('Content-Type: application/json');
    echo json_encode($pjson);
    exit;
}
