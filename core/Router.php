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
            '/'                         => 'Noticia@listar',
            '/categoria'                => 'Categoria@listar',
            '/categoria/[0-9]+'         => 'Categoria@listarUm',
            '/categoria/cadastrar'      => 'Categoria@cadastrar',
            '/noticia'                  => 'Noticia@listar',
            '/noticia/[0-9]+'           => 'Noticia@listarUm',
            '/noticia/cadastrar'        => 'Noticia@cadastrar',
            '/noticia/cadastrar/[0-9]+' => 'Noticia@editar',
        ];
    }

    private static function rotasPost(){
        return [
            '/categoria/cadastrar'        => 'Categoria@novo',
            '/categoria/cadastrar/[0-9]+' => 'Categoria@novo',
            '/usuario/cadastrar'          => 'Usuario@novo',
            '/usuario/cadastrar/[0-9]+'   => 'Usuario@novo'
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