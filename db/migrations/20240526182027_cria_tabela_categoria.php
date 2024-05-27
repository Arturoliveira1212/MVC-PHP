<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CriaTabelaCategoria extends AbstractMigration {

    public function up(): void {
        $sql = <<<'SQL'
            CREATE TABLE categoria (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nome VARCHAR(255) NOT NULL,
                ativo INT NOT NULL DEFAULT 1
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;;
        SQL;
        $this->execute( $sql );
    }

    public function down(): void {
        $this->execute( 'DROP TABLE categoria' );
    }
}
