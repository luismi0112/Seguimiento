<?php

namespace App\Models;

class SimpleConexion
{
    /**
     * Conexión sencilla usando mysqli y valores por defecto.
     *
     * @return \mysqli
     * @throws \Exception
     */
    public static function conectar(): \mysqli
    {
        $host = getenv('DB_HOST') ?: '127.0.0.1';
        $port = getenv('DB_PORT') ?: '3306';
        $user = getenv('DB_USERNAME') ?: 'root';
        $pass = getenv('DB_PASSWORD') ?: '';
        $db   = getenv('DB_DATABASE') ?: 'bd_seguimiento';

        $conn = mysqli_connect($host, $user, $pass, $db, (int)$port);
        if (!$conn) {
            throw new \Exception('Error al conectar a MySQL: ' . mysqli_connect_error());
        }

        mysqli_set_charset($conn, 'utf8mb4');
        return $conn;
    }
}

/**
 * Ejemplo de uso:
 * $conn = \App\Models\SimpleConexion::conectar();
 * // luego usar mysqli_query/$conn->query y mysqli_close($conn) cuando termine.
 */
