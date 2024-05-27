<?php

namespace app\dao;

use core\PDOSingleton;
use PDO;
use PDOException;

class BancoDadosRelacional implements BancoDados {
    private ?PDO $pdo = null;

    const ID_INEXISTENTE = 0;

    public function __construct(){
        $this->pdo = PDOSingleton::get();
    }

    private function rodar( string $comando, array $parametros = [] ){
        try {
            $stmt = $this->pdo->prepare( $comando );
            $stmt->execute( $parametros );

            return $stmt;
        } catch( PDOException $e ){
            die( "Erro ao executar query: " . $e->getMessage() );
            // TO DO => Salvar erros em tabela de log
        }
    }

    public function executar( string $comando, array $parametros = [] ){
        $stmt = $this->rodar( $comando, $parametros );

        return $stmt->rowCount();
    }

    public function consultar( string $comando, array $parametros = [] ){
        $stmt = $this->rodar( $comando, $parametros );

        return $stmt->fetchAll( PDO::FETCH_ASSOC );
    }

    public function excluir( string $tabela, int $id ){
        $comando = "DELETE FROM $tabela WHERE id = :id";
        $parametros = [ 'id' => $id ];

        return $this->executar( $comando, $parametros );
    }

    public function desativar( string $tabela, int $id ){
        $comando = "UPDATE $tabela SET ativo = :ativo WHERE id = :id";
        $parametros = [ 'ativo' => 0, 'id' => $id ];

        return $this->executar( $comando, $parametros );
    }

    public function existe(){
        // TO DO
    }

    public function obterObjetos( string $comando, array $callback, array $parametros = [] ){
        $objetos = [];

        $resultados = $this->consultar( $comando, $parametros );

        if( ! empty( $resultados ) ){
            foreach( $resultados as $resultado ){
                $objeto = call_user_func_array( $callback, [ $resultado ] );
                $objetos[] = $objeto;
            }
        }

        return $objetos;
    }

    public function iniciarTransacao(){
        $this->pdo->beginTransaction();
    }

    public function finalizarTransacao(){
        $this->pdo->commit();
    }

    public function desfazerTransacao(){
        $this->pdo->rollBack();
    }

    public function emTransacao(){
        $this->pdo->inTransaction();
    }

}