<?php

namespace app\views;

use app\models\Noticia;

class NoticiaViewEmTwig extends ViewEmTwig {

    public function __construct(){
        parent::__construct();
    }

    public function exbirNoticias( array $noticias ){
        $this->render( 'listar-noticias.html', [ 'noticias' => $noticias, 'titulo' => 'Notícias' ] );
    }

    public function exibirNoticia( Noticia $noticia ){
        $this->render( 'listar-noticia.html', [ 'noticia' => $noticia, 'titulo' => $noticia->getTitulo() ] );
    }
}