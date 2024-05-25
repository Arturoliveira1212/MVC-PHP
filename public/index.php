<?php

require_once '../bootstrap.php';

use core\App;
use core\HttpRequest;

try {
    $app = new App();
    $app->executar( HttpRequest::uri(), HttpRequest::metodo() );
} catch( Throwable $th ){
    echo $th->getMessage();
}