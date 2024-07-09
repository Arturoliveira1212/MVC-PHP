<?php

namespace core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Twig {

	public function load(){
        $loader = new FilesystemLoader( '../app/templates' );
        return new Environment( $loader, [
            'debug' => true,
			// 'cache' => '/cache',
			'auto_reload' => true,
        ]);
	}
}