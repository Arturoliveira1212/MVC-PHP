<?php

namespace app\controllers;

use app\controllers\Controller;
use core\ClassFactory;
use app\models\Noticia;
use app\exceptions\ServiceException;
use app\views\NoticiaViewEmTwig;
use Throwable;

class NoticiaController extends Controller {

    private NoticiaViewEmTwig $view;

    public function __construct(){
        $this->view = ClassFactory::makeView( 'Noticia' );
        $this->service = ClassFactory::makeService( 'Noticia' );
    }

    public function listar(){
        $restricoes = $this->obterRestricoes();
        $noticias = $this->service->obterComRestricoes( $restricoes );
        $this->view->exbirNoticias( $noticias );
    }

    private function obterRestricoes(){
        $restricoes = [];

        if( ! empty( $_GET ) ){
            if( isset( $_GET['nome'] ) ){
                $restricoes['nome'] = $_GET['nome'];
            }
        }

        return $restricoes;
    }

    public function listarUm( array $parametros ){
        $id = intval( $parametros['noticia'] );
        $noticia = $this->service->obterComId( $id );
        if( $noticia instanceof Noticia ){
            $this->view->exibirNoticia( $noticia );
        }
    }

    public function novo(){
        try {
            $erro = [];
            $noticia = $this->criarNoticia();
            $this->service->salvar( $noticia, $erro );
        } catch( ServiceException $e ){
            throw $e; // TO DO
        } catch( Throwable $th ){
            throw $th; // TO DO
        }
    }

    private function criarNoticia(){
        $noticia = new Noticia();

        return $noticia;
    }

    public function editar(){

    }

    public function excluir(){

    }
}