<?php

namespace app\models;

use ReflectionClass;

abstract class Model {
    /**
     * Método responsável por obter o nome da classe.
     *
     * @return string
     */
    public static function getNomeClasse(){
        $reflection = new ReflectionClass(static::class);
        return $reflection->getShortName();
    }
}