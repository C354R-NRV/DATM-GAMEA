<?php
//$host = '172.16.100.28';
$host = '172.16.21.17:3307';
$user = 'datmremote';
$password = '1n0v4d05';
$database = 'atencion_fiscalizacion';

try {
    $mysqli = new mysqli($host, $user, $password, $database);
    if ($mysqli->connect_error) {
        print_r("Connection failed: " . $mysqli->connect_error);
    } else {
        $query = "select * from tramite_historico order by id desc limit 10";
        $result = $mysqli->query($query);
        if ($result->num_rows > 0) {
            // Salida de datos de cada fila
            while ($row = $result->fetch_assoc()) {
                print_r($row);
            }
        }
    }
} catch (\Exception $th) {
    print_r("Connection failed: " . $mysqli->connect_error . "==============>" . $th);
}
