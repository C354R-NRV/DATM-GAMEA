<?php
// Datos de conexión proporcionados
$usuario = 'SQLEALCROJAS';
$password = 'Ces4rN1lt0n#20062024';
$tns = "(DESCRIPTION= (ADDRESS= (PROTOCOL=TCP) (HOST=mtab.ruat.net.bo) (PORT=1533) ) (CONNECT_DATA= (GLOBAL_NAME=RDIS.WORLD) (SID=RDIS) ))";

// Intentar establecer la conexión
try {
    $conn = oci_connect($usuario, $password, $tns);
    if (!$conn) {
        $m = oci_error();
        echo "Error de conexión: " . $m['message'] . "\n";
        exit;
    } else {
        echo "Conexión exitosa a Oracle usando OCI8\n";
    } 
} catch (\Throwable $th) {
    echo "error:".$th;
}

// Realizar consultas u operaciones con la base de datos aquí...

// Cerrar la conexión
oci_close($conn);
