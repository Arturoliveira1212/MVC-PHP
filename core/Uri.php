<?php

namespace core;

class Uri {

    /**
     * Método responsável por retornar a URI da requisição enviada.
     *
     * @return string
     */
    public static function uri(){
        return parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
    }
}