<?php

namespace app\services;

use app\dao\DAO;

abstract class Service {
    protected DAO $dao;

    abstract protected function validar( $objeto, array $erro = [] );

    public function salvar( $objeto, array $erro = [] ){
        $this->validar( $objeto, $erro );
        $this->dao->salvar( $objeto );
    }

    public function desativarComId( int $id ){

    }

    public function obterComId( int $id ){

    }

    public function obterComRestricoes( array $restricoes = [] ){
        return $this->dao->obterComRestricoes( $restricoes );
    }

    protected function validarBooleano( $valor ){

    }

    protected function validarInteiro( $valor ){

    }
}