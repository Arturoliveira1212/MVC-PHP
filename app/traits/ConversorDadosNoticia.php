<?php

namespace app\traits;

use app\dao\BancoDadosRelacional;
use app\models\Noticia;
use app\models\Categoria;
use core\ClassFactory;
use DateTime;

trait ConversorDadosNoticia {
    public function transformarEmObjeto( array $dados ){
        $noticia = new Noticia();
        $noticia->setId( $dados['id'] != BancoDadosRelacional::ID_INEXISTENTE ? intval( $dados['id'] ) : null );
        $noticia->setTitulo( $dados['titulo'] );
        $this->preencherCategoria( $noticia, intval( $dados['idCategoria'] ) );
        $noticia->setConteudo( $dados['conteudo'] );
        $noticia->setDataCadastro( new DateTime( $dados['dataCadastro'] ) );
    }

    private function preencherCategoria( Noticia &$noticia, int $idCategoria ){
        $categoriaDAO = ClassFactory::makeDAO( 'Categoria' );
        $categoria = $categoriaDAO->obterComId( $idCategoria );
        $noticia->setCategoria( $categoria );
    }

    public function transformarEmArray( Noticia $noticia ){
        return [
            'id'           => $noticia->getId(),
            'titulo'       => $noticia->getTitulo(),
            'idCategoria'  => $noticia->getCategoria()->getId(),
            'conteudo'     => $noticia->getConteudo(),
            'dataCadastro' => $noticia->getDataCadastro( 'Y-m-d H:i:s' )
        ];
    }
}