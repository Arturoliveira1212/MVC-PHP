<?php

namespace core;

use PDO;
use PDOException;

class PDOSingleton {
    private static ?PDO $pdo = null;

    private static function conectar(){
        try {
            $dsn = $_ENV['DB_DSN'];
            $username = $_ENV['DB_USERNAME'];
            $password = $_ENV['DB_PASSWORD'];
            $options = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ];

            return new PDO( $dsn, $username, $password, $options );
        } catch( PDOException $e ){
            die("Erro na conexão: " . $e->getMessage());
        }
    }

    public static function get(){
        if( ! self::$pdo instanceof PDO ){
            self::$pdo = self::conectar();
        }

        return self::$pdo;
    }
}