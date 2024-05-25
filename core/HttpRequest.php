<?php

namespace core;

class HttpRequest {

    const METODO_GET = 'GET';
    const METODO_POST = 'POST';
    const METODO_PUT = 'PUT';
    const METODO_DELETE = 'DELETE';

    const CODIGO_SUCESSO = 200;
    const CODIGO_NAO_EXISTENTE = 404;

    /**
     * Método responsável por retornar a URI da requisição enviada.
     *
     * @return string
     */
    public static function uri(){
        return parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
    }

    /**
     * Método responsável por retornar o método da requisição enviada.
     *
     * @return string
     */
    public static function metodo(){
        return $_SERVER['REQUEST_METHOD'];
    }
}