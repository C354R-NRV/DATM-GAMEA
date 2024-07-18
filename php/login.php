<?php 
session_start(); 
require_once("conexionpsql.php"); 

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}   

$conn = new Conexion();
$cons = $conn->conectar();  

    $query = "select * from usuario u where u.usuario like UPPER('$u_')  and u.password like MD5('$p_'); ";  
    $stmt = $cons->query($query); 

    $rs  = array();

    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);  
    $sw = 0;
    $obs = '';
    $nombre = '';
    $_SESSION['cargo'] = '';
    $_SESSION['swlogin'] = '0';
    foreach ($resultados as $row) {
        $_SESSION['swlogin'] = $sw = '1';
        if($row['estado'] == 'DESBLOQUEADO'){
            $_SESSION['usuario'] = $row['usuario'] ;
            $_SESSION['cargo'] = $row['cargo'] ;
            $_SESSION['nombreUsuario']  = $nombre = $row['nombres'].' '.$row['primer_apellido'].' '.$row['segundo_apellido'];
        }else{
            $obs = 'Su USUARIO se encuentra bloqueado, favor comuniquese con el area de sistemas';
        }
    }  
    if($sw==0){
        $obs = 'Las credenciales proporcionadas no son válidas, verifique nuevamente su información por favor.';
    } 
    $rs['sw'] = $sw;
    $rs['obs'] = $obs;
    $rs['cargo'] = $_SESSION['cargo'];
    $rs['nombre'] = $nombre; 
    $dat = json_encode($rs);
    echo $dat; 
?>