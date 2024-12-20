<?php
class conexion
{

    /**
     * dev
     *  cd C:\Program Files\PostgreSQL\16\bin
     *  pg_dump -U postgres -h localhost -p 5432 -d ruatdb -f ruatdb20240522.sql
     *  server
     *  createdb -h localhost -p 5432 -O postgres -U postgres -e ruatdb20240522
     *  psql -h localhost -p 5432 -U postgres -f /var/www/html/db/ruatdb20240522.sql ruatdb20240522
     */

    // private $host = '172.16.100.28'; 
    
    private $host = 'localhost';
    private $dbname = 'datm';
    private $user = 'postgres';
    private $password = '1n0v4d05';

    public function conectar()
    {
        try {
            date_default_timezone_set('America/La_Paz');
            $dsn = "pgsql:host=$this->host;dbname=$this->dbname;user=$this->user;password=$this->password";
            $pdo = new PDO($dsn);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("SET client_encoding TO 'UTF8'");
            /* echo "Conexión exitosa a la base de datos PostgreSQL."; */
            return $pdo;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }
    function obtenerNombreMes($numero_mes)
    {
        $meses = array(
            1 => 'enero',
            2 => 'febrero',
            3 => 'marzo',
            4 => 'abril',
            5 => 'mayo',
            6 => 'junio',
            7 => 'julio',
            8 => 'agosto',
            9 => 'septiembre',
            10 => 'octubre',
            11 => 'noviembre',
            12 => 'diciembre'
        );
        if ($numero_mes < 1 || $numero_mes > 12) {
            return 'Mes inválido';
        }
        return $meses[$numero_mes];
    }
}
