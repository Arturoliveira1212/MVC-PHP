<?php

namespace app\controllers;

use app\services\Service;

abstract class Controller {
    protected Service $service;

    public function salvar( $objeto, array $erro = [] ){
        $this->service->salvar( $objeto, $erro );
    }

    public function desativarComId( int $id ){

    }

    public function obterComId( int $id ){

    }

    public function obterComRestricoes( array $restricoes = [] ){

    }
}