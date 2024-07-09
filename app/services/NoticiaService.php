<?php

namespace app\services;

use app\models\Noticia;
use app\exceptions\ServiceException;

class NoticiaService extends Service {

    const TAMANHO_MINIMO_TITULO = 1;
    const TAMANHO_MAXIMO_TITULO = 100;

    public function __construct(){
        parent::__construct( 'Noticia' );
    }

    protected function validar( $noticia, array $erro = [] ){
        if( ! $noticia instanceof Noticia ){
            throw new ServiceException( 'Noticia inválida' );
        }
    }

    private function validarId( Noticia $noticia, array &$erro ){
        if( ! is_numeric( $noticia->getId() ) ){
            $erro['id'] = 'Id inválido.';
        }
    }

    private function validarTitulo( Noticia $noticia, array &$erro ){
        if( is_null( $noticia->getTitulo() ) ){
            $erro['titulo'] = 'Preencha o título.';
        } elseif(
            mb_strlen( $noticia->getTitulo() ) < self::TAMANHO_MINIMO_TITULO ||
            mb_strlen( $noticia->getTitulo() ) > self::TAMANHO_MAXIMO_TITULO
        ){
            $erro['titulo'] = 'O titulo deve ter entre ' . self::TAMANHO_MINIMO_TITULO . ' e ' . self::TAMANHO_MAXIMO_TITULO . ' caracteres.';
        }
    }


}