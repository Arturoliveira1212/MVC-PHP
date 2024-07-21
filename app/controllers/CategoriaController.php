<?php

namespace app\controllers;

use app\exceptions\NaoEncontradoException;
use app\exceptions\ServiceException;
use app\models\Categoria;
use app\views\CategoriaView;
use Exception;
use Throwable;

class CategoriaController extends Controller {

    public function __construct(){
        parent::__construct();
    }

    // GET => categoria
    public function listar(){
        $categorias = $this->getService()->obterComRestricoes();

        /** @var CategoriaView */
        $categoriaView = $this->getView();
        $categoriaView->listarCategorias( $categorias );
    }

    // GET => categoria/cadastrar/[0-9]
    public function listarComId( array $parametros ){
        $id = intval( $parametros['cadastrar'] );
        $categoria = $this->getService()->obterComId( $id );
        if( ! $categoria instanceof Categoria ){
            throw new NaoEncontradoException( 'Categoria não encontrada' );
        }

        /** @var CategoriaView */
        $categoriaView = $this->getView();
        $categoriaView->exibirFormularioCadastro( $categoria );
    }

    // GET => /categoria/cadastrar
    public function cadastrar(){
        /** @var CategoriaView */
        $categoriaView = $this->getView();
        $categoriaView->exibirFormularioCadastro();
    }

    // POST => /categoria/cadastrar ou /categoria/cadastrar/[0-9]
    public function salvarCategoria(){
        /** @var CategoriaView */
        $categoriaView = $this->getView();

        $erro = [];

        try {
            $dadosEnviados = $categoriaView->obterDadosEnviados();
            $categoria = $this->converterEmObjeto( $this->getClasse(), $dadosEnviados );
            $this->getService()->salvar( $categoria, $erro );

            $categoriaView->sucessoAoSalvar();
        } catch( ServiceException $e ){
            $categoriaView->erroAoSalvar( $categoria, $erro );
        }
    }

    // DELETE => categoria/excluir/[0-9]
    public function excluirComId( array $parametros ){
        /** @var CategoriaView */
        $categoriaView = $this->getView();

        try {
            $id = intval( $parametros['excluir'] );
            $categoria = $this->getService()->obterComId( $id );
            if( ! $categoria instanceof Categoria ){
                throw new NaoEncontradoException( 'Categoria não encontrada' );
            }

            $retorno = $this->getService()->desativarComId( $id );
            if( $retorno == 0 ){
                throw new Exception( 'Houve um erro ao excluir a categoria' );
            }

            $categoriaView->sucessoAoExcluir();
        } catch( NaoEncontradoException $e ){
            $categoriaView->erroAoExcluirCategoriaInexistente();
        } catch( Throwable $th ){
            $categoriaView->erroAoExcluir();
        }
    }
}