<?php

/**
 * dev
 *  cd C:\Program Files\PostgreSQL\16\bin
 *  pg_dump -U postgres -h localhost -p 5432 -d ruatdb -f ruatdb20240522.sql
 * server
 *  createdb -h localhost -p 5432 -O postgres -U postgres -e ruatdb20240522
 *  psql -h localhost -p 5432 -U postgres -f /var/www/html/db/ruatdb20240522.sql ruatdb20240522
 * 
 */
$host = 'localhost'; // Host de la base de datos
$dbname = 'datm'; // Nombre de la base de datos
$user = 'postgres'; // Usuario de la base de datos
$password = '1n0v4d05'; // Contraseña de la base de datos

try {
    $dsn = "pgsql:host=$host;dbname=$dbname;user=$user;password=$password";
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Conexión exitosa a la base de datos PostgreSQL."; 

} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
