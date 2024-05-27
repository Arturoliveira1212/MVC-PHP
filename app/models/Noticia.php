<?php

namespace app\models;

use DateTime;

class Noticia extends Model {
    private int $id = 0;
    private string $titulo = '';
    private ?Categoria $categoria = null;
    private string $conteudo = '';
    private ?DateTime $dataCadastro = null;

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
}