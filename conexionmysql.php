<?php
$host = '172.16.21.17:3307';
$user = 'datmremote';
$password = '1n0v4d05';
$database = 'titanprodlt';

try {
    $mysqli = new mysqli($host, $user, $password, $database);
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
} catch (\Exception $th) {
    die("Connection failed: " . $mysqli->connect_error . "==============>" . $th);
}
