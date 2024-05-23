<?php

namespace core;

class Router {

    public static function rotas(){
        return [
            'GET' => self::rotasGet(),
            'POST' => self::rotasPost(),
            'PUT' => self::rotasPut(),
            'DELETE' => self::rotasDelete()
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