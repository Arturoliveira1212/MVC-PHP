<?php

namespace app\models;

use app\traits\ConversorDados;

interface Model {
    public function obterAtributosSimples();
    public function obterAtributosObjetos();
}