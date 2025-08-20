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

    private $host = '172.16.21.90';
    private $dbname = 'datm250325';
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

function generarSha1DesdeCabecera($cabecera)
{
    $texto = '';
    $texto .= !empty($cabecera->adjunto_nombre) ? $cabecera->adjunto_nombre : '';
    $texto .= !empty($cabecera->autoridad_cargo) ? $cabecera->autoridad_cargo : '';
    $texto .= !empty($cabecera->autoridad_solicitante) ? $cabecera->autoridad_solicitante : '';
    $texto .= !empty($cabecera->codigo_solicitud) ? $cabecera->codigo_solicitud : '';
    $texto .= !empty($cabecera->detalle_cantidad) ? $cabecera->detalle_cantidad : '';
    $texto .= !empty($cabecera->entidad) ? $cabecera->entidad : '';
    $texto .= !empty($cabecera->fecha_envio_ansi) ? $cabecera->fecha_envio_ansi : '';
    $texto .= !empty($cabecera->gerencia) ? $cabecera->gerencia : '';
    $texto .= !empty($cabecera->IdSolicitud) ? $cabecera->IdSolicitud : '';
    $texto .= !empty($cabecera->tipo_proceso) ? $cabecera->tipo_proceso : '';

    $cabecera->hash_datos_txt = $texto;
    $cabecera->hash_datos = strtoupper(sha1($texto));
    return $cabecera->hash_datos;
}


function getClientIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // Si hay múltiples IP separadas por coma, tomar la primera
        return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}
