<?php

namespace app\services;

use app\models\Categoria;

class CategoriaService extends Service {

    public function __construct(){
        parent::__construct( Categoria::getNomeClasse() );
    }

    protected function validar( $categoria, array $erro = [] ){

    }
}