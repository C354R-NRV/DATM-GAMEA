<?php
session_start();
require_once './conexionpsql.php';

foreach ($_POST as $clave => $valor) {
    $$clave = addslashes(trim($valor));
}
$conn = new Conexion();
$cons = $conn->conectar();

$query = "select * from datm_parametro";
$stmt = $cons->query($query);
$parametros = $stmt->fetch(PDO::FETCH_ASSOC);


/* 
string texto = string.Empty;
texto =  
string.Concat(  remision.NumeroSIREFO,            
                remision.IdRemision.ToString(CultureInfo.InvariantCulture),  
                remision.IdentificadorRemision,
                remision.AutoridadSolicitante,
                remision.GerenciaSolicitante,  
                remision.CargoAutoridadSolicitante,                     
                remision.FechaHoraEmision,     
                remision.DetalleCantidad.ToString(CultureInfo.Invariant Culture), remision.Entidad);  

Para el algoritmo deben utilizar SHA1. */