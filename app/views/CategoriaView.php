<?php

namespace app\views;

use app\models\Categoria;
use app\views\View;
use Exception;

class CategoriaView extends View {

    public function listarCategorias( array $categorias ){
        $this->render( 'listar-categorias.html', [
            'titulo' => 'Categorias',
            'categorias' => $categorias
        ] );
    }

    public function exibirFormularioCadastro( Categoria $categoria = null ){
        $this->render( 'cadastrar-categoria.html', [
            'titulo' => 'Categoria',
            'categoria' => $categoria
        ] );
    }

    public function exibirMensagemSucesso(){
        $this->render( 'cadastrar-categoria.html', [
            'titulo' => 'Adicionar Categoria'
        ] );
    }

    public function exibirMensagemErroAoSalvar( Exception $erro ){
        $this->render( 'cadastrar-categoria.html', [
            'erro' => $erro->getMessage()
        ] );
    }

    public function obterDadosEnviados(){
        return $_POST ?? [];
    }
}