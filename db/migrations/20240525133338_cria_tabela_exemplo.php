<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CriaTabelaExemplo extends AbstractMigration {

    public function up(): void {
      $sql = <<<'SQL'
          CREATE TABLE exemplo (
            id INT NOT NULL AUTO_INCREMENT,
            nome VARCHAR(100) NOT NULL
            CONSTRAINT pk_exemplo PRIMARY KEY( id ),
            CONSTRAINT unq_exemplo__nome UNIQUE( nome )
          ) ENGINE=INNODB
      SQL;
      $this->execute( $sql );
    }

    public function down(): void {
        $this->execute( 'DROP TABLE exemplo' );
    }
}
