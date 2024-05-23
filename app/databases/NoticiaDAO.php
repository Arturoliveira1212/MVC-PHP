<?php

namespace app\databases;

use app\models\Noticia;

class NoticiaDAO extends DAOEmBDR {

    public function __construct(){
        parent::__construct();
    }

    protected function nomeTabela(){
        return 'noticia';
    }

    protected function adicionarNovo( $objeto ){
        $comando = '';
    }

    protected function atualizar( $objeto ){
        $comando = '';
    }

    protected function parametros(  $noticia ){
        return [
            'id' => $noticia->getId()
        ];
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

    public function transformarEmObjeto( array $resultado ){
        $noticia = new Noticia();
        $noticia->setId( intval( $resultado['id'] ) );
        $noticia->setNome( $resultado['nome'] );

        return $noticia;
    }
}