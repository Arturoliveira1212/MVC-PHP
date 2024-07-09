<?php

namespace app\views;

class AppView extends View {
    public function exibirPaginaNaoEncontrada(){
        $this->render( 'pagina-nao-encontrada.html', [] );
    }

    public function exibirPaginaErro(){
        $this->render( 'pagina-ops.html', [] );
    }
}