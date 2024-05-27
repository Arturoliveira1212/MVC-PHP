<?php

namespace app\services;

use app\dao\DAO;
use core\ClassFactory;

abstract class Service {
    protected DAO $dao;

    public function __construct( string $classe ){
        $this->setDao( ClassFactory::makeDAO( $classe ) );
    }

    protected function getDao(){
        return $this->dao;
    }

    protected function setDao( DAO $dao ){
        $this->dao = $dao;
    }

    abstract protected function validar( $objeto, array $erro = [] );

    public function salvar( $objeto, array $erro = [] ){
        $this->validar( $objeto, $erro );
        $this->getDao()->salvar( $objeto );
    }

    public function desativarComId( int $id ){
        return $this->getDao()->desativarComId( $id );
    }

    public function obterComId( int $id ){
        return $this->getDao()->obterComId( $id );
    }

    public function obterComRestricoes( array $restricoes = [] ){
        return $this->getDao()->obterComRestricoes( $restricoes );
    }
}