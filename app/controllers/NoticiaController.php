<?php

namespace app\controllers;

use app\controllers\Controller;
use core\ClassFactory;
use app\models\Noticia;
use app\exceptions\ServiceException;
use app\models\Categoria;
use app\traits\ConversorDadosNoticia;
use app\views\NoticiaView;
use Throwable;

class NoticiaController extends Controller {

    use ConversorDadosNoticia;

    public function __construct(){
        parent::__construct( Noticia::getNomeClasse() );
    }

    public function getView() :NoticiaView {
        return $this->view;
    }

    public function cadastrar(){
        $this->getView()->exibirFormularioCadastro();
    }

    public function editar( array $parametros ){
        $id = intval( $parametros['cadastrar'] );
        $noticia = $this->getService()->obterComId( $id );
        if( $noticia instanceof Noticia ){
            $this->getView()->exibirFormularioEdicao( $noticia );
        }
    }

    public function novo(){
        try {
            $erro = [];
            $noticia = $this->transformarEmObjeto( $_POST );
            $this->getService()->salvar( $noticia, $erro );
        } catch( ServiceException $e ){
            throw $e; // TO DO
        } catch( Throwable $th ){
            throw $th; // TO DO
        }
    }

    private function povoarCategoria( Noticia $noticia, int $idCategoria ){
        /** @var CategoriaController */
        $categoriaController = ClassFactory::makeController( Categoria::class );
        /** @var Categoria */
        $categoria = $categoriaController->obterComId( $idCategoria );
        $noticia->setCategoria( $categoria );
    }

    public function listar(){
        $restricoes = $this->obterRestricoes();
        $noticias = $this->getService()->obterComRestricoes( $restricoes );
        $this->getView()->exbirNoticias( $noticias );
    }

    private function obterRestricoes(){
        $restricoes = [];

        // TO DO

        return $restricoes;
    }

    public function listarUm( array $parametros ){
        $id = intval( $parametros['noticia'] );
        $noticia = $this->getService()->obterComId( $id );
        if( $noticia instanceof Noticia ){
            $this->getView()->exibirNoticia( $noticia );
        }
    }

    public function excluir(){

    }
}