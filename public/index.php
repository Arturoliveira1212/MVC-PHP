<?php

require_once '../bootstrap.php';

use core\App;

try {
    $app = new App();
    $app->executar();
} catch( Throwable $th ){
    echo $th->getMessage();
}