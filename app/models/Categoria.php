<?php

namespace app\models;

class Categoria implements Model {
    private int $id = 0;
    private string $nome = "";

    public function getId(){
        return $this->id;
    }

    public function setId( int $id ){
        $this->id = $id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome( string $nome ){
        $this->nome = $nome;
    }

    public function obterAtributosSimples(){
        return [ 'id', 'nome' ];
    }

    public function obterAtributosObjetos(){
        return [];
    }
}