<?php

namespace core;

class Router {

    public static function rotas(){
        return [
            HttpRequest::METODO_GET    => self::rotasGet(),
            HttpRequest::METODO_POST   => self::rotasPost(),
            HttpRequest::METODO_PUT    => self::rotasPut(),
            HttpRequest::METODO_DELETE => self::rotasDelete()
        ];
    }

    private static function rotasGet(){
        return [
            '/'               => 'Noticia@listar',
            '/noticia/[0-9]+' => 'Noticia@listarUm',
        ];
    }

    private static function rotasPost(){
        return [
            '/usuario/cadastrar' => 'Usuario@novo'
        ];
    }

    private static function rotasPut(){
        return [

        ];
    }

    private static function rotasDelete(){
        return [

        ];
    }
}