<?php

namespace app\dao;

use app\traits\ConversorDadosNoticia;

class NoticiaDAO extends DAOEmBDR {

    use ConversorDadosNoticia;

    public function __construct(){
        parent::__construct();
    }

    protected function nomeTabela(){
        return 'noticia';
    }

    protected function adicionarNovo( $noticia ){
        $nomeTabela = $this->nomeTabela();
        $comando = "INSERT INTO {$nomeTabela} ( id, titulo, idCategoria, conteudo, dataCadastro ) VALUES ( :id, :titulo, :idCategoria, :conteudo, :dataCadastro )";
        $parametros = $this->transformarEmArray( $noticia );
        $this->getBancoDados()->executar( $comando, $parametros );
    }

    protected function atualizar( $objeto ){
        $comando = '';
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