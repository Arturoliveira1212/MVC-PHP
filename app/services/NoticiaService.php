<?php

namespace app\services;

use app\exceptions\ServiceException;
use app\models\Noticia;
use core\ClassFactory;

class NoticiaService extends Service {

    public function __construct(){
        $this->dao = ClassFactory::makeDAO( 'Noticia' );
    }

    protected function validar( $noticia, array $erro = [] ){
        if( ! $noticia instanceof Noticia ){
            throw new ServiceException( '' );
        }
    }
}