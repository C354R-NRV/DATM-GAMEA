<?php
// Configuración de la conexión a la base de datos
$tns = "
(DESCRIPTION =
    (ADDRESS = (PROTOCOL = TCP)(HOST = mtab.ruat.net.bo)(PORT = 1533))
    (CONNECT_DATA =
        (GLOBAL_NAME = RDIS.WORLD)
        (SID = RDIS)
    )
)";

$username = 'SQLEALCROJAS'; // Usuario de la base de datos
$password = 'Ces4rN1lt0n#20062024'; // Contraseña de la base de datos

try {
    // Crear la conexión
    $conn = oci_connect($username, $password, $tns, 'AL32UTF8');

    if (!$conn) {
        $e = oci_error();
        echo "Error de conexión a la base de datos: " . $e['message'];
        exit;
    }
    echo "Conexión exitosa a la base de datos Oracle";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

oci_free_statement($stid);
oci_close($conn);
