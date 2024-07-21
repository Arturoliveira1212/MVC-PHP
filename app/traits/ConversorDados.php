<?php

namespace app\traits;

use app\models\Model;
use core\ClassFactory;
use Exception;
use InvalidArgumentException;

trait ConversorDados {

    public function converterEmObjeto( string $nomeClasse, array $dados ){
        $nomeClasseCompleto = 'app\\models\\' . $nomeClasse;
        $classe = new $nomeClasseCompleto;
        if( ! $classe instanceof Model ){
            throw new InvalidArgumentException( 'Classe inválida.' );
        }

        $atributosSimples = $classe->obterAtributosSimples();
        if( ! empty( $atributosSimples ) ){
            $this->preencherAtributosSimplesNoObjeto( $classe, $atributosSimples, $dados );
        }

        $atributosObjeto = $classe->obterAtributosObjetos();
        if( ! empty( $atributosObjeto ) ){
            $this->preencherAtributosObjetosNoObjeto( $classe, $atributosObjeto, $dados );
        }

        return $classe;
    }

    private function preencherAtributosSimplesNoObjeto( Model $classe, array $atributosSimples, array $dados ){
        foreach( $atributosSimples as $atributoSimples ){
            $metodo = 'set' . ucfirst( $atributoSimples );
            if (method_exists($classe, $metodo) && isset($dados[$atributoSimples])) {
                $classe->$metodo( $dados[ $atributoSimples ] );
            }
        }
    }

    private function preencherAtributosObjetosNoObjeto( Model $classe, array $atributosObjeto, array $dados ){
        foreach( $atributosObjeto as $atributoObjeto => $informarcoesAtributo ){
            $idCampo = $informarcoesAtributo['idCampo'];
            $nomeObjeto = $informarcoesAtributo['nomeObjeto'];
            $metodo = 'set' . ucfirst( $atributoObjeto );
            if( method_exists( $classe, $metodo ) && isset( $dados[ $idCampo ] ) ){
                $controller = ClassFactory::makeController( $nomeObjeto );
                $objeto = $controller->obterComId( intval( $dados[ $idCampo ] ) );
                if( ! is_null( $objeto ) ){
                    $classe->$metodo( $objeto );
                }
            }
        }
    }

    public function converterEmArray( Model $classe ) {
        $array = [];

        $atributosSimples = $classe->obterAtributosSimples();
        if( ! empty( $atributosSimples ) ){
            $this->preencherAtributosSimplesNoArray( $classe, $atributosSimples, $array );
        }

        $atributosObjetos = $classe->obterAtributosObjetos();
        if( ! empty( $atributosObjetos ) ){
            $this->preencherAtributosObjetosNoArray( $classe, $atributosObjetos, $array );
        }

        return $array;
    }

    private function preencherAtributosSimplesNoArray( Model $classe, array $atributosSimples, array &$array ){
        foreach( $atributosSimples as $atributoSimples ){
            $metodo = 'get' . ucfirst( $atributoSimples );
            if (method_exists($classe, $metodo) ) {
                $array[ $atributoSimples ] = $classe->$metodo();
            }
        }
    }

    private function preencherAtributosObjetosNoArray( Model $classe, array $atributoObjetos, array &$array ){
        foreach( $atributoObjetos as $atributoObjeto => $informarcoesAtributo ){
            $idCampo = $informarcoesAtributo['idCampo'];
            $metodo = 'get' . ucfirst( $atributoObjeto );
            if( method_exists( $classe, $metodo ) && isset( $dados[ $atributoObjeto ]['id'] ) ){
                $array[ $idCampo ] = $dados[ $atributoObjeto ]['id'];
            }
        }
    }
}
