<?php

namespace app\databases;

interface DAO {
    public function salvar( $objeto );
    public function desativarComId( int $id );
    public function obterComId( int $id );
    public function obterComRestricoes( array $restricoes = [] );
}