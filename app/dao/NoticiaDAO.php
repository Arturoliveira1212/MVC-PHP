<?php

namespace app\dao;

use app\traits\ConversorDados;

class NoticiaDAO extends DAOEmBDR {

    use ConversorDados;

    public function __construct(){
        parent::__construct();
    }

    protected function nomeTabela(){
        return 'noticia';
    }

    protected function adicionarNovo( $noticia ){
        $comando = "INSERT INTO {$this->nomeTabela()} ( id, titulo, idCategoria, conteudo, dataCadastro ) VALUES ( :id, :titulo, :idCategoria, :conteudo, :dataCadastro )";
        $this->getBancoDados()->executar( $comando, $this->converterEmArray( $noticia ) );
    }

    protected function atualizar( $noticia ){
        $comando = "UPDATE {$this->nomeTabela()} SET nome = :nome WHERE id = :id";
        $this->getBancoDados()->executar( $comando, $this->converterEmArray( $noticia ) );
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
        return $this->converterEmObjeto( 'Noticia', $linhas );
    }
}