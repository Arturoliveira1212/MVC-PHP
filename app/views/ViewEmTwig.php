<?php

namespace app\views;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class ViewEmTwig {
    protected Environment $twig;

    public function __construct(){
        $loader = new FilesystemLoader( '../app/templates' );
        $this->twig = new Environment( $loader, [
            'debug' => true,
			// 'cache' => '/cache',
			'auto_reload' => true,
        ]);
    }

    public function render( string $arquivo, array $dados ){
        $template = $this->twig->load( $arquivo );
        $template->display( $dados );
    }
}