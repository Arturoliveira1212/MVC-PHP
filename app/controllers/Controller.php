<?php

namespace app\controllers;

use app\services\Service;
use app\traits\ConversorDados;
use app\views\View;
use core\ClassFactory;

abstract class Controller {
    protected string $classe;
    protected View $view;
    protected Service $service;

    use ConversorDados;

    public function __construct(){
        $this->setClasse( str_replace( 'Controller','', basename( str_replace( '\\', '/', get_class( $this ) ) ) ) );
        $this->setView( ClassFactory::makeView( $this->getClasse() ) );
        $this->setService( ClassFactory::makeService( $this->getClasse() ) );
    }

    public function getClasse(){
        return $this->classe;
    }

    public function setClasse( string $classe ){
        $this->classe = $classe;
    }

    public function getView(){
        return $this->view;
    }

    public function setView( View $view ){
        $this->view = $view;
    }

    public function getService(){
        return $this->service;
    }

    public function setService( Service $service ){
        $this->service = $service;
    }

    public function salvar( $objeto, array $erro = [] ){
        $this->getService()->salvar( $objeto, $erro );
    }

    public function desativarComId( int $id ){
        $this->getService()->desativarComId( $id );
    }

    public function obterComId( int $id ){
        $this->getService()->obterComId( $id );
    }

    public function obterComRestricoes( array $restricoes = [] ){
        $this->getService()->obterComRestricoes( $restricoes );
    }
}