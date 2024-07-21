<?php

require_once '../bootstrap.php';

use core\App;
use core\ClassFactory;
use core\HttpRequest;
use app\exceptions\NaoEncontradoException;
use app\views\AppView;

/** @var AppView */
$appView = ClassFactory::makeView( 'App' );

try {
    $app = new App();
    $app->executar( HttpRequest::uri(), HttpRequest::metodo() );
} catch( NaoEncontradoException $e ){
    $appView->exibirPaginaNaoEncontrada( $e );
} catch( Throwable $e ){
    $appView->exibirPaginaErro();
    dd( $e );
}