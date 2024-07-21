<?php

namespace app\services;

use app\exceptions\ServiceException;
use app\models\Categoria;

class CategoriaService extends Service {

    public function __construct(){
        parent::__construct();
    }

    public function validar( $categoria, array &$erro = [] ){
        if( ! is_numeric( $categoria->getId() ) ){
            $erro['id'] = 'O id precisa ser numérico.';
        }

        $tamanhoNomeCategoria =  mb_strlen( $categoria->getNome() );
        if( $tamanhoNomeCategoria > Categoria::TAMANHO_MAXIMO_NOME || $tamanhoNomeCategoria < Categoria::TAMANHO_MINIMO_NOME ){
            $erro['nome'] = 'O nome da categoria deve ter entre ' . Categoria::TAMANHO_MINIMO_NOME  . ' e ' . Categoria::TAMANHO_MAXIMO_NOME . ' caracteres';
        }

        if( ! empty( $erro ) ){
            throw new ServiceException( 'Houve um erro ao salvar.' );
        }
    }
}