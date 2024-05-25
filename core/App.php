<?php

namespace core;

use core\Router;
use app\exceptions\RotaNaoEncontradaException;
use app\controllers\MetodoNaoEncontradoException;
use core\ClassFactory;

class App {

    public function executar( string $uri, string $metodoRequisicao ){
        $informacoesRota = $this->obterInformacoesRota( $uri, $metodoRequisicao );
        if( empty( $informacoesRota ) ){
            throw new RotaNaoEncontradaException( 'Recurso não existe.', HttpRequest::CODIGO_NAO_EXISTENTE );
        }

        list( $nomeController, $metodo ) = explode( '@', array_values( $informacoesRota )[0] );

        $controller = ClassFactory::makeController( $nomeController );

        if( ! method_exists( $controller, $metodo ) ){
            throw new MetodoNaoEncontradoException( "Método não existe.", HttpRequest::CODIGO_NAO_EXISTENTE );
        }

        $parametros = $this->obterParametrosRota( $informacoesRota, $uri );

        $controller->$metodo( $parametros );
    }

    /**
     * Método responsável por retornar um array com informações da rota.
     * @return array [ /home => Home@index ]
     */
    private function obterInformacoesRota( string $uri, string $metodoRequisicao ){
        $informacoesRota = [];
        $rotas = $this->obterRotasParaMetodo( $metodoRequisicao );

        if( array_key_exists( $uri, $rotas ) ){
            $informacoesRota = [ $uri => $rotas[ $uri ] ];
        } else {
            $informacoesRota = $this->obterInformacoesRotaDinamica( $rotas, $uri );
        }

        return $informacoesRota;
    }

    private function obterRotasParaMetodo( string $metodoRequisicao ){
        return (array) Router::rotas()[ $metodoRequisicao ];
    }

    private function obterInformacoesRotaDinamica( array $rotas, string $uri ){
        return array_filter( $rotas, function( $rota ) use ($uri ){
            $regex = str_replace( '/', '\/', ltrim( $rota, '/' ) );
            return preg_match( "/^$regex$/", ltrim( $uri, '/' ) );
        }, ARRAY_FILTER_USE_KEY );
    }

    private function obterParametrosRota( array $informacoesRota, string $uri ){
        $conteudoRota = array_keys( $informacoesRota )[0];
        $arrayUri = explode( '/', ltrim( $uri, '/' ) );
        $parametros = array_diff(
            $arrayUri,
            explode( '/', ltrim( $conteudoRota, '/' ) )
        );

        return $this->formatarParametrosRota( $parametros, $arrayUri );
    }

    private function formatarParametrosRota( array $parametros, array $arrayUri ){
        $parametrosFormatado = [];

        foreach( $parametros as $index => $parametro ){
            $parametrosFormatado[ $arrayUri[ $index - 1 ] ] = $parametro;
        }

        return $parametrosFormatado;
    }
}