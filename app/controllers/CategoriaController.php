<?php

namespace app\controllers;

use app\exceptions\NaoEncontradoException;
use app\exceptions\ServiceException;
use app\models\Categoria;
use app\views\CategoriaView;
use core\Redirect;
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
    public function listarUm( array $parametros ){
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
    public function salvarCategoria( array $parametros ){
        /** @var CategoriaView */
        $categoriaView = $this->getView();

        $erro = [];

        try {
            $dadosEnviados = $categoriaView->obterDadosEnviados();
            $categoria = $this->converterEmObjeto( $this->getClasse(), $dadosEnviados );
            $this->getService()->salvar( $categoria, $erro );

            Redirect::to( '/categoria' );
        } catch( ServiceException $e ){
            $categoriaView->exibirMensagemErroAoSalvar( $e );
        }
    }
}