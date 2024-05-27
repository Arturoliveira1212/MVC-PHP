<?php

namespace app\dao;

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
    abstract protected function obterQuery( array $restricoes, array &$parametros );
    abstract public function transformarEmObjeto( array $linhas );

    public function salvar( $objeto ){
        if( $objeto->getId() == BancoDadosRelacional::ID_INEXISTENTE ){
            $this->adicionarNovo( $objeto );
        } else {
            $this->atualizar( $objeto );
        }
    }

    public function desativarComId( int $id ){
        $nomeTabela = $this->nomeTabela();
        return $this->getBancoDados()->desativar( $nomeTabela, $id );
    }

    public function obterComId( $id ){
        $parametros = [];
        $comando = $this->obterQuery( [ 'id' => $id ], $parametros );
        $objetos = $this->getBancoDados()->obterObjetos( $comando, [ $this, 'transformarEmObjeto' ], $parametros );
        return ! empty( $objetos ) ? array_shift($objetos) : null;
    }

    public function obterComRestricoes( array $restricoes = [] ){
        $parametros = [];
        $comando = $this->obterQuery( $restricoes, $parametros );
        return $this->getBancoDados()->obterObjetos( $comando, [ $this, 'transformarEmObjeto' ], $parametros );
    }
}