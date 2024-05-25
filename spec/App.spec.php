<?php

use app\exceptions\RotaNaoEncontradaException;
use core\App;
use core\HttpRequest;

use function Kahlan\describe;
use function Kahlan\it;

describe( 'App', function(){
    $this->app = null;

    beforeAll( function(){
        $this->app = new App();
    });

    it( 'Lança excessão ao buscar rota inexistente.', function(){
        expect( function(){
            $this->app->executar( '/rota-inexistente', HttpRequest::METODO_GET );
        })->toThrow( new RotaNaoEncontradaException( 'Recurso não existe.', HttpRequest::CODIGO_NAO_EXISTENTE ) );
    });

    // TO DO => Implementar mais cenários de teste.
});