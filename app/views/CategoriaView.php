<?php

namespace app\views;

use app\models\Categoria;
use app\views\View;
use core\HttpRequest;
use core\Redirect;

class CategoriaView extends View {

    public function listarCategorias( array $categorias ){
        $this->render( 'gerenciar-categorias.html', [
            'titulo' => 'Categorias',
            'categorias' => $categorias
        ] );
    }

    public function exibirFormularioCadastro( Categoria $categoria = null ){
        $this->render( 'cadastrar-categoria.html', [
            'titulo' => 'Categoria',
            'categoria' => $categoria,
            'action' => $this->obterActionParaFormulario( $categoria )
        ] );
    }

    private function obterActionParaFormulario( Categoria $categoria = null ){
        return $categoria instanceof Categoria ? "/categoria/cadastrar/{$categoria->getId()}" : '/categoria/cadastrar';
    }

    public function sucessoAoSalvar(){
        Redirect::to( '/categoria' );
    }

    public function erroAoSalvar( Categoria $categoria = null, array $erro ){
        $this->render( 'cadastrar-categoria.html', [
            'titulo' => 'Categoria',
            'categoria' => $categoria,
            'erro' => $erro
        ] );
    }

    public function sucessoAoExcluir(){
        http_response_code( HttpRequest::CODIGO_SUCESSO );
        header('Content-Type: application/json');
        echo json_encode( ['status' => 'success', 'message' => 'Categoria excluída com sucesso.'] );
    }

    public function erroAoExcluirCategoriaInexistente(){
        http_response_code( HttpRequest::CODIGO_ERRO_CLIENTE );
        header('Content-Type: application/json');
        echo json_encode( ['status' => 'error', 'message' => 'Categoria não existe.'] );
    }

    public function erroAoExcluir(){
        http_response_code( HttpRequest::CODIGO_ERRO_SERVIDOR );
        header('Content-Type: application/json');
        echo json_encode( ['status' => 'error', 'message' => 'Houve um erro ao excluir a categoria. Tente novamente.'] );
    }

    public function obterDadosEnviados(){
        return $_POST ?? [];
    }
}