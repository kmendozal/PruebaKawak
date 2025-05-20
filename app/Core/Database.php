<?php
namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static $instance = null;

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $host = 'localhost';
            $db = 'bd_documentos';
            $user = 'root';
            $pass = '';
            $charset = 'utf8mb4';

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            try {
                self::$instance = new PDO($dsn, $user, $pass, $options);
            } catch (PDOException $e) {
                die('Error de conexión: ' . $e->getMessage());
            }
        }

        return self::$instance;
    }
}

?>