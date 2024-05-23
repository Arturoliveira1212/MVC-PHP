<?php

require_once './bootstrap.php';

use core\App;

try {
    $app = new App();
    $app->executar();
} catch( Throwable $th ){
    echo $th->getMessage();
}

/*
require '../vendor/autoload.php';

use app\databases\BancoDadosRelacional;
use core\App;

$bancoDados = new BancoDadosRelacional();

// $comando = 'INSERT INTO noticia ( id, nome, ativo ) VALUES (:id, :nome, :ativo)';
// $parametros = [
//     'id' => null,
//     'nome' => 'Artur',
//     'ativo' => 1
// ];
// $bancoDados->executar( $comando, $parametros );

// $comando = 'SELECT * FROM noticia WHERE id = :id';
// $parametros = [
//     'id' => 1
// ];
// dd( $bancoDados->consultar( $comando, $parametros ) );

// $bancoDados->excluir( 'noticia', 1 );

// dd('');

try {
    $app = new App();
    $app->executar();
} catch (\Throwable $th) {
    echo $th->getMessage();
}

*/

// iniciar servidor do php => php -S localhost:8888 -t public