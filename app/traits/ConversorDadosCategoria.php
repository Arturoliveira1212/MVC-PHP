<?php

namespace app\traits;

use app\dao\BancoDadosRelacional;
use app\models\Categoria;

trait ConversorDadosCategoria {

    public function transformarEmObjeto( array $dados ) {
        $categoria = new Categoria();
        $categoria->setId( $dados['id'] != BancoDadosRelacional::ID_INEXISTENTE ? intval( $dados['id'] ) : null );
        $categoria->setNome( $dados['nome'] );

        return $categoria;
    }

    public function transformarEmArray( Categoria $categoria ){
        return [
            'id'   => $categoria->getId(),
            'nome' => $categoria->getNome()
        ];
    }
}