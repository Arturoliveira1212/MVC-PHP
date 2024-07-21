<?php

namespace app\models;

use DateTime;

class Noticia implements Model {
    private int $id = 0;
    private string $titulo = '';
    private ?Categoria $categoria = null;
    private string $conteudo = '';
    private ?DateTime $dataCadastro = null;

    const TAMANHO_MINIMO_TITULO = 1;
    const TAMANHO_MAXIMO_TITULO = 100;
    const TAMANHO_MINIMO_CONTEUDO = 10;
    const TAMANHO_MAXIMO_CONTEUDO = 1000;

    public function getId(){
        return $this->id;
    }

    public function setId( int $id ){
        $this->id = $id;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function setTitulo( string $titulo ){
        $this->titulo = $titulo;
    }

    public function getCategoria(){
        return $this->categoria;
    }

    public function setCategoria( Categoria $categoria ){
        $this->categoria = $categoria;
    }

    public function getConteudo(){
        return $this->conteudo;
    }

    public function setConteudo( string $conteudo ){
        $this->conteudo = $conteudo;
    }

    public function getDataCadastro( string $formato = null ){
        if( $formato )
            return $this->dataCadastro->format( $formato );
        return $this->dataCadastro;
    }

    public function setDataCadastro( DateTime $dataCadastro ){
        $this->dataCadastro = $dataCadastro;
    }

    public function obterAtributosSimples(){
        return [ 'id', 'titulo', 'conteudo', 'dataCadastro' ];
    }

    public function obterAtributosObjetos(){
        return [
            'categoria' => [
                'idCampo' => 'idCategoria',
                'nomeObjeto' => 'Categoria'
            ]
        ];
    }
}