<?php

namespace app\databases;

use Exception;

abstract class DAOEmBDR implements DAO {
    private ?BancoDadosRelacional $bancoDados = null;

    public function __construct(){
        $this->bancoDados = new BancoDadosRelacional();
    }

    protected function getBancoDados(){
        return $this->bancoDados;
    }

    abstract protected function nomeTabela();
    abstract protected function adicionarNovo( $objeto );
    abstract protected function atualizar( $objeto );
    abstract protected function parametros( $objeto );
    abstract protected function obterQuery( array $restricoes, array &$parametros );
    abstract public function transformarEmObjeto( array $linhas );

    public function salvar( $objeto ){
        if( $objeto->getId() == BancoDadosRelacional::ID_INEXISTENTE ){
            $this->adicionarNovo( $objeto );
        }
    }

    public function desativarComId( int $id ){

    }

    public function obterComId( $id ){
        $nomeTabela = $this->nomeTabela();
        if( is_null( $nomeTabela ) ){
            throw new Exception( 'Nome da tabela não definido.' );
        }

        $parametros = [];
        $comando = $this->obterQuery( [ 'id' => $id ], $parametros );
        $objetos = $this->bancoDados->obterObjetos( $comando, [ $this, 'transformarEmObjeto' ], $parametros );
        return ! empty( $objetos ) ? array_shift($objetos) : null;
    }

    public function obterComRestricoes( array $restricoes = [] ){
        $nomeTabela = $this->nomeTabela();
        if( is_null( $nomeTabela ) ){
            throw new Exception( 'Nome da tabela não definido.' );
        }

        $parametros = [];
        $comando = $this->obterQuery( $restricoes, $parametros );
        return $this->bancoDados->obterObjetos( $comando, [ $this, 'transformarEmObjeto' ], $parametros );
    }
}