<?php

namespace app\views;

use app\models\Noticia;

class NoticiaView extends View {

    public function listarNoticias( array $noticias ){
        $this->render( 'gerenciar-noticias.html', [
            'titulo' => 'Notícias',
            'noticias' => $noticias
        ] );
    }

    public function exibirFormularioCadastro( array $categorias, Noticia $noticia = null ){
        $this->render( 'cadastrar-noticia.html', [
            'titulo' => 'Notícia',
            'noticia' => $noticia,
            'categorias' => $categorias,
            'action' => $this->obterActionParaFormulario( $noticia )
        ] );
    }

    private function obterActionParaFormulario( Noticia $noticia = null ){
        return $noticia instanceof Noticia ? "/noticia/cadastrar/{$noticia->getId()}" : '/noticia/cadastrar';
    }

    public function exibirFormularioEdicao(){
        // TO DO
    }

    public function obterDadosEnviados(){
        return $_POST ?? [];
    }

}