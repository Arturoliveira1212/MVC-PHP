<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CriaTabelaNoticia extends AbstractMigration {

    public function up(): void {
        $sql = <<<'SQL'
            CREATE TABLE noticia (
                id INT AUTO_INCREMENT PRIMARY KEY,
                titulo VARCHAR(255) NOT NULL,
                idCategoria INT NOT NULL,
                conteudo TEXT NOT NULL,
                dataCadastro DATETIME NOT NULL,
                ativo INT NOT NULL DEFAULT 1,
                FOREIGN KEY (idCategoria) REFERENCES categoria(id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;;
        SQL;
        $this->execute( $sql );
    }

    public function down(): void {
        $this->execute( 'DROP TABLE noticia' );
    }
}
