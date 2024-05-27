<?php

namespace app\models;

class Categoria extends Model {
    private ?int $id = null;
    private string $nome = "";

    public function getId(){
        return $this->id;
    }

    public function setId( ?int $id ){
        $this->id = $id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome( string $nome ){
        $this->nome = $nome;
    }
}