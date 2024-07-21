<?php

namespace app\controllers;

use app\controllers\Controller;
use app\exceptions\NaoEncontradoException;
use core\ClassFactory;
use app\models\Noticia;
use app\exceptions\ServiceException;
use app\views\NoticiaView;

class NoticiaController extends Controller {

    public function __construct(){
        parent::__construct();
    }

    // GET => /noticia
    public function listar(){
        $restricoes = $this->obterRestricoes();
        $noticias = $this->getService()->obterComRestricoes( $restricoes );

        /** @var NoticiaView */
        $noticiaView = $this->getView();
        $noticiaView->listarNoticias( $noticias );
    }

    private function obterRestricoes(){
        $restricoes = [];

        // TO DO

        return $restricoes;
    }

    // GET => categoria/cadastrar/[0-9]
    public function listarComId( array $parametros ){
        $id = intval( $parametros['cadastrar'] );
        $noticia = $this->getService()->obterComId( $id );
        if( ! $noticia instanceof Noticia ){
            throw new NaoEncontradoException( 'Notícia não encontrada' );
        }

        /** @var CategoriaController */
        $categoriaController = ClassFactory::makeController( 'Categoria' );
        $categorias = (array) $categoriaController->obterComRestricoes();

        /** @var NoticiaView */
        $noticiaView = $this->getView();
        $noticiaView->exibirFormularioCadastro( $categorias, $noticia );
    }

    // GET => /noticia/cadastrar
    public function cadastrar(){
        /** @var CategoriaController */
        $categoriaController = ClassFactory::makeController( 'Categoria' );
        $categorias = (array) $categoriaController->obterComRestricoes();

        /** @var NoticiaView */
        $noticiaView = $this->getView();
        $noticiaView->exibirFormularioCadastro( $categorias );
    }

    // POST => /noticia/cadastrar ou /noticia/cadastrar/[0-9]
    public function salvarNoticia(){
        /** @var NoticiaView */
        $noticiaView = $this->getView();

        $erro = [];

        try {
            $dadosEnviados = $noticiaView->obterDadosEnviados();
            $noticia = $this->converterEmObjeto( $this->getClasse(), $dadosEnviados );
            $this->getService()->salvar( $noticia, $erro );

            $noticiaView->sucessoAoSalvar();
        } catch( ServiceException $e ){
            $noticiaView->erroAoSalvar( $noticia, $erro );
        }
    }
}