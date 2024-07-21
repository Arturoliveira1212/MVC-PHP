<?php

namespace app\dao;

use app\traits\ConversorDados;

class CategoriaDAO extends DAOEmBDR {

    use ConversorDados;

    public function __construct(){
        parent::__construct();
    }

    protected function nomeTabela(){
        return 'categoria';
    }

    protected function adicionarNovo( $categoria ){
        $comando = "INSERT INTO {$this->nomeTabela()} ( id, nome ) VALUES ( :id, :nome )";
        $this->getBancoDados()->executar( $comando, $this->converterEmArray( $categoria ) );
    }

    protected function atualizar( $categoria ){
        $comando = "UPDATE {$this->nomeTabela()} SET nome = :nome WHERE id = :id";
        $this->getBancoDados()->executar( $comando, $this->converterEmArray( $categoria ) );
    }

    protected function obterQuery( array $restricoes, array &$parametros ){
        $nomeTabela = $this->nomeTabela();

        $select = "SELECT * FROM {$nomeTabela}";
        $where = ' WHERE ativo = 1 ';
        $join = '';

        if( isset( $restricoes['id'] ) ){
            $where .= " AND $nomeTabela.id = :id";
            $parametros['id'] = $restricoes['id'];
        }

        $comando = $select . $join . $where;

        return $comando;
    }

    public function transformarEmObjeto( array $linhas ){
        return $this->converterEmObjeto( 'Categoria', $linhas );
    }
}