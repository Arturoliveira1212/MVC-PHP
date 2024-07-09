<?php

namespace app\dao;

use app\traits\ConversorDados;

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
        $objetos = $this->obterObjetos( $comando, [ $this, 'transformarEmObjeto' ], $parametros );
        return ! empty( $objetos ) ? array_shift($objetos) : null;
    }

    public function obterComRestricoes( array $restricoes = [] ){
        $parametros = [];
        $comando = $this->obterQuery( $restricoes, $parametros );
        return $this->obterObjetos( $comando, [ $this, 'transformarEmObjeto' ], $parametros );
    }

    public function obterObjetos( string $comando, array $callback, array $parametros = [] ){
        $objetos = [];

        $resultados = $this->getBancoDados()->consultar( $comando, $parametros );

        if( ! empty( $resultados ) ){
            foreach( $resultados as $resultado ){
                $objeto = call_user_func_array( $callback, [ $resultado ] );
                $objetos[] = $objeto;
            }
        }

        return $objetos;
    }
}