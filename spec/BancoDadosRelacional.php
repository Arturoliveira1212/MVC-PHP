<?php

use app\dao\BancoDadosRelacional;

use function Kahlan\describe;
use function Kahlan\it;

describe( 'BancoDadosRelacional', function(){
    $this->bancoDados = null;

    beforeAll( function(){
        $this->bancoDados = new BancoDadosRelacional();
    });

    // TO DO => Implementar mais cenários de teste.
});