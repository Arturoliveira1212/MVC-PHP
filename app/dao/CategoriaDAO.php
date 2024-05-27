<?php

namespace app\dao;

use app\traits\ConversorDadosCategoria;

class CategoriaDAO extends DAOEmBDR {

    use ConversorDadosCategoria;

    public function __construct(){
        parent::__construct();
    }

    protected function nomeTabela(){
        return 'categoria';
    }

    protected function adicionarNovo( $categoria ){
        $nomeTabela = $this->nomeTabela();
        $comando = "INSERT INTO {$nomeTabela} ( id, nome ) VALUES ( :id, :nome )";
        $this->getBancoDados()->executar( $comando, $this->transformarEmArray( $categoria ) );
    }

    protected function atualizar( $categoria ){
        $nomeTabela = $this->nomeTabela();
        $comando = "UPDATE {$nomeTabela} SET nome = :nome WHERE id = :id";
        $this->getBancoDados()->executar( $comando, $categoria->emArray() );
    }

    protected function obterQuery( array $restricoes, array &$parametros ){
        $nomeTabela = $this->nomeTabela();

        $select = "SELECT * FROM $nomeTabela";
        $where = ' WHERE ativo = 1 ';
        $join = '';

        if( isset( $restricoes['id'] ) ){
            $where .= " AND $nomeTabela.id = :id";
            $parametros['id'] = $restricoes['id'];
        }

        $comando = $select . $join . $where;

        return $comando;
    }
}