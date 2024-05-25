<?php

namespace app\dao;

interface BancoDados {
    public function executar( string $comando, array $parametros = [] );
    public function consultar( string $comando, array $parametros = [] );
    public function excluir( string $tabela, int $id );
    public function desativar( string $tabela, int $id );
    public function existe(); // TO DO
    public function obterObjetos( string $comando, array $callback, array $parametros = [] ); // TO DO
    public function iniciarTransacao();
    public function finalizarTransacao();
    public function desfazerTransacao();
    public function emTransacao();
}