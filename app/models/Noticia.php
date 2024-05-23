<?php

namespace app\models;

class Noticia {
    private int $id = 0;
    private string $nome = '';

    public function setId( int $id ){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setNome( string $nome ){
        $this->nome = $nome;
    }

    public function getNome(){
        return $this->nome;
    }
}