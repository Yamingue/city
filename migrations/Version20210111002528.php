<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210111002528 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, tel INTEGER NOT NULL, email VARCHAR(255) DEFAULT NULL)');
        $this->addSql('DROP INDEX IDX_C509E4FFC54C8C93');
        $this->addSql('CREATE TEMPORARY TABLE __temp__chambre AS SELECT id, type_id, nom, boolean, cuisine, description FROM chambre');
        $this->addSql('DROP TABLE chambre');
        $this->addSql('CREATE TABLE chambre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL COLLATE BINARY, boolean BOOLEAN NOT NULL, cuisine BOOLEAN NOT NULL, description CLOB NOT NULL COLLATE BINARY, CONSTRAINT FK_C509E4FFC54C8C93 FOREIGN KEY (type_id) REFERENCES type_chabre (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO chambre (id, type_id, nom, boolean, cuisine, description) SELECT id, type_id, nom, boolean, cuisine, description FROM __temp__chambre');
        $this->addSql('DROP TABLE __temp__chambre');
        $this->addSql('CREATE INDEX IDX_C509E4FFC54C8C93 ON chambre (type_id)');
        $this->addSql('DROP INDEX IDX_14B784189B177F54');
        $this->addSql('CREATE TEMPORARY TABLE __temp__photo AS SELECT id, chambre_id, path FROM photo');
        $this->addSql('DROP TABLE photo');
        $this->addSql('CREATE TABLE photo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, chambre_id INTEGER DEFAULT NULL, path VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_14B784189B177F54 FOREIGN KEY (chambre_id) REFERENCES chambre (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO photo (id, chambre_id, path) SELECT id, chambre_id, path FROM __temp__photo');
        $this->addSql('DROP TABLE __temp__photo');
        $this->addSql('CREATE INDEX IDX_14B784189B177F54 ON photo (chambre_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_C509E4FFC54C8C93');
        $this->addSql('CREATE TEMPORARY TABLE __temp__chambre AS SELECT id, type_id, nom, boolean, cuisine, description FROM chambre');
        $this->addSql('DROP TABLE chambre');
        $this->addSql('CREATE TABLE chambre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, boolean BOOLEAN NOT NULL, cuisine BOOLEAN NOT NULL, description CLOB NOT NULL)');
        $this->addSql('INSERT INTO chambre (id, type_id, nom, boolean, cuisine, description) SELECT id, type_id, nom, boolean, cuisine, description FROM __temp__chambre');
        $this->addSql('DROP TABLE __temp__chambre');
        $this->addSql('CREATE INDEX IDX_C509E4FFC54C8C93 ON chambre (type_id)');
        $this->addSql('DROP INDEX IDX_14B784189B177F54');
        $this->addSql('CREATE TEMPORARY TABLE __temp__photo AS SELECT id, chambre_id, path FROM photo');
        $this->addSql('DROP TABLE photo');
        $this->addSql('CREATE TABLE photo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, chambre_id INTEGER DEFAULT NULL, path VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO photo (id, chambre_id, path) SELECT id, chambre_id, path FROM __temp__photo');
        $this->addSql('DROP TABLE __temp__photo');
        $this->addSql('CREATE INDEX IDX_14B784189B177F54 ON photo (chambre_id)');
    }
}
