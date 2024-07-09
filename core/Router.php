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
            '/'                           => 'Noticia@listar',
            '/noticia'                    => 'Noticia@listar',
            '/noticia/[0-9]+'             => 'Noticia@listarUm',
            '/noticia/cadastrar'          => 'Noticia@cadastrar',
            '/noticia/cadastrar/[0-9]+'   => 'Noticia@editar',
            '/categoria'                  => 'Categoria@listar',
            '/categoria/cadastrar/[0-9]+' => 'Categoria@listarUm',
            '/categoria/cadastrar'        => 'Categoria@cadastrar'
        ];
    }

    private static function rotasPost(){
        return [
            '/categoria/cadastrar'        => 'Categoria@salvarCategoria',
            '/categoria/cadastrar/[0-9]+' => 'Categoria@salvarCategoria',
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