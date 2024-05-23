<?php

namespace app\databases;

use PDO;
use PDOException;

class PDOSingleton {
    private static ?PDO $pdo = null;

    private static function conectar(){
        try {
            $pdo = new PDO(
                'mysql:dbname=teste2;host:localhost;charset=utf8',
                'root',
                '',
                [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
            );

            return $pdo;
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