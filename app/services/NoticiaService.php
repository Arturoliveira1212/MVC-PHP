<?php

namespace app\services;

use app\models\Noticia;
use app\exceptions\ServiceException;
use app\models\Categoria;

class NoticiaService extends Service {

    public function __construct(){
        parent::__construct( 'Noticia' );
    }

    protected function validar( $noticia, array &$erro = [] ){
        $this->validarId( $noticia, $erro );
        $this->validarTitulo( $noticia, $erro );
        $this->validarCategoria( $noticia, $erro );
        $this->validarConteudo( $noticia, $erro );

        if( ! empty( $erro ) ){
            throw new ServiceException( 'Houve um erro ao salvar.' );
        }
    }

    private function validarId( Noticia $noticia, array &$erro ){
        if( ! is_numeric( $noticia->getId() ) ){
            $erro['id'] = 'Id inválido.';
        }
    }

    private function validarTitulo( Noticia $noticia, array &$erro ){
        $tamanhoTitulo =  mb_strlen( $noticia->getTitulo() );
        if( $tamanhoTitulo == 0 ){
            $erro['tamanho'] = 'Preencha o título.';
        } elseif( $tamanhoTitulo > Noticia::TAMANHO_MAXIMO_TITULO || $tamanhoTitulo < Noticia::TAMANHO_MINIMO_TITULO ){
            $erro['tamanho'] = 'O título deve ter entre ' . Noticia::TAMANHO_MINIMO_TITULO  . ' e ' . Noticia::TAMANHO_MAXIMO_TITULO . ' caracteres';
        }
    }

    private function validarCategoria( Noticia $noticia, array &$erro ){
        if( ! $noticia->getCategoria() instanceof Categoria ){
            $erro['categoria'] = 'Categoria inváilda.';
        }
    }

    private function validarConteudo( Noticia $noticia, array &$erro ){
        $tamanhoConteudo =  mb_strlen( $noticia->getConteudo() );
        if( $tamanhoConteudo == 0 ){
            $erro['conteudo'] = 'Preencha o conteúdo.';
        } elseif( $tamanhoConteudo > Noticia::TAMANHO_MAXIMO_CONTEUDO || $tamanhoConteudo < Noticia::TAMANHO_MINIMO_CONTEUDO ){
            $erro['conteudo'] = 'O título deve ter entre ' . Noticia::TAMANHO_MINIMO_CONTEUDO  . ' e ' . Noticia::TAMANHO_MAXIMO_CONTEUDO . ' caracteres';
        }
    }
}