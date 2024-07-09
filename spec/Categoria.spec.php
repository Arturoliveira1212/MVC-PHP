<?php

use app\exceptions\ServiceException;
use app\models\Categoria;
use core\ClassFactory;

use function Kahlan\describe;
use function Kahlan\it;

describe( 'Categoria', function(){
    $this->categoriaService = null;

    beforeAll( function(){
        $this->categoriaService = ClassFactory::makeService( 'Categoria' );
    });

    it( 'Lança excessão ao passar objeto que não seja instância de categoria.', function(){
        expect( function(){
            $categoria = [];
            $erro = [];
            $this->categoriaService->validar( $categoria, $erro );
        })->toThrow( new ServiceException( 'A categoria precisa ser uma instância de categoria.' ) );
    });

    // TO DO => Implementar mais cenários de teste.
});