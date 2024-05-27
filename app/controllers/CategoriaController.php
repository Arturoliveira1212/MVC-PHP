<?php

namespace app\controllers;

use app\exceptions\ServiceException;
use app\models\Categoria;
use app\traits\ConversorDadosCategoria;
use app\views\CategoriaView;
use Throwable;

class CategoriaController extends Controller {

    use ConversorDadosCategoria;

    public function __construct(){
        parent::__construct( Categoria::getNomeClasse() );
    }

    public function getView() :CategoriaView {
        return $this->view;
    }

    // GET => categoria/cadastrar
    public function cadastrar(){
        $this->getView()->exibirFormularioCadastro();
    }

    // POST => categoria/cadastrar/[0-9]+
    public function editar( array $parametros ){
        $id = intval( $parametros['cadastrar'] );
        $categoria = $this->getService()->obterComId( $id );
        if( $categoria instanceof Categoria ){
            $this->getView()->exibirFormularioEdicao( $categoria );
        }
    }

    // POST => categoria/cadastrar
    public function novo(){
        try {
            $erro = [];
            $categoria = $this->transformarEmObjeto( $_POST );
            $this->getService()->salvar( $categoria, $erro );
        } catch( ServiceException $e ){
            throw $e; // TO DO
        } catch( Throwable $th ){
            throw $th; // TO DO
        }
    }
}