<?php

namespace app\controllers;

use app\services\Service;
use app\views\ViewEmTwig;
use core\ClassFactory;

abstract class Controller {
    protected ViewEmTwig $view;
    protected Service $service;

    public function __construct( string $classe ){
        $this->setView( ClassFactory::makeView( $classe ) );
        $this->setService( ClassFactory::makeService( $classe ) );
    }

    abstract protected function getView();
    protected function setView( ViewEmTwig $view ){
        $this->view = $view;
    }

    protected function getService(){
        return $this->service;
    }

    protected function setService( Service $service ){
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