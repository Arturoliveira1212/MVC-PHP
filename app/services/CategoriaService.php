<?php

namespace app\services;

use app\exceptions\ServiceException;
use app\models\Categoria;

class CategoriaService extends Service {

    const TAMANHO_MINIMO_NOME = 1;
    const TAMANHO_MAXIMO_NOME = 100;

    public function __construct(){
        parent::__construct();
    }

    public function validar( $categoria, array $erro = [] ){
        if( ! $categoria instanceof Categoria ){
            throw new ServiceException( 'Dados inválidos' );
        }

        if( $categoria->getNome() == '' ){
            throw new ServiceException( 'Preencha o nome.' );
        }

        $tamanhoNomeCategoria =  mb_strlen( $categoria->getNome() );
        if( $tamanhoNomeCategoria > self::TAMANHO_MAXIMO_NOME || $tamanhoNomeCategoria < self::TAMANHO_MINIMO_NOME ){
            throw new ServiceException( 'O nome da categoria deve ter entre ' . self::TAMANHO_MINIMO_NOME  . ' e ' . self::TAMANHO_MAXIMO_NOME . ' caracteres' );
        }
    }
}