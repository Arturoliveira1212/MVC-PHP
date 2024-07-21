<?php

namespace app\views;

use Exception;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class View {
    private function loadTwig(){
        $loader = new FilesystemLoader( '../app/templates' );
        return new Environment( $loader, [
            'debug' => true,
			// 'cache' => '/cache',
			'auto_reload' => true,
        ]);
    }

    public function render( string $view, array $dados ){
        $template = $this->loadTwig()->load( $view );
        $template->display( $dados );
    }

    public function exibirPaginaNaoEncontrada( Exception $e ){
        $this->render( 'pagina-nao-encontrada.html', [
            'erro' => $e->getMessage()
        ] );
    }

    public function exibirPaginaErro(){
        $this->render( 'pagina-ops.html', [] );
    }
}