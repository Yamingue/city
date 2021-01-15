<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210114030755 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_C509E4FF8BAC62AF');
        $this->addSql('DROP INDEX IDX_C509E4FFC54C8C93');
        $this->addSql('CREATE TEMPORARY TABLE __temp__chambre AS SELECT id, type_id, city_id, nom, cuisine, description, poster, douche, prix FROM chambre');
        $this->addSql('DROP TABLE chambre');
        $this->addSql('CREATE TABLE chambre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_id INTEGER DEFAULT NULL, city_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL COLLATE BINARY, cuisine BOOLEAN NOT NULL, description CLOB NOT NULL COLLATE BINARY, poster VARCHAR(255) NOT NULL COLLATE BINARY, douche BOOLEAN NOT NULL, prix INTEGER DEFAULT NULL, CONSTRAINT FK_C509E4FFC54C8C93 FOREIGN KEY (type_id) REFERENCES type_chabre (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_C509E4FF8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO chambre (id, type_id, city_id, nom, cuisine, description, poster, douche, prix) SELECT id, type_id, city_id, nom, cuisine, description, poster, douche, prix FROM __temp__chambre');
        $this->addSql('DROP TABLE __temp__chambre');
        $this->addSql('CREATE INDEX IDX_C509E4FF8BAC62AF ON chambre (city_id)');
        $this->addSql('CREATE INDEX IDX_C509E4FFC54C8C93 ON chambre (type_id)');
        $this->addSql('DROP INDEX IDX_2D5B0234A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__city AS SELECT id, user_id, name, poster, commentaire FROM city');
        $this->addSql('DROP TABLE city');
        $this->addSql('CREATE TABLE city (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, poster VARCHAR(255) NOT NULL COLLATE BINARY, commentaire CLOB NOT NULL COLLATE BINARY, eau VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_2D5B0234A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO city (id, user_id, name, poster, commentaire) SELECT id, user_id, name, poster, commentaire FROM __temp__city');
        $this->addSql('DROP TABLE __temp__city');
        $this->addSql('CREATE INDEX IDX_2D5B0234A76ED395 ON city (user_id)');
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
        $this->addSql('DROP INDEX IDX_C509E4FFC54C8C93');
        $this->addSql('DROP INDEX IDX_C509E4FF8BAC62AF');
        $this->addSql('CREATE TEMPORARY TABLE __temp__chambre AS SELECT id, type_id, city_id, nom, cuisine, description, poster, douche, prix FROM chambre');
        $this->addSql('DROP TABLE chambre');
        $this->addSql('CREATE TABLE chambre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_id INTEGER DEFAULT NULL, city_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, cuisine BOOLEAN NOT NULL, description CLOB NOT NULL, poster VARCHAR(255) NOT NULL, douche BOOLEAN NOT NULL, prix INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO chambre (id, type_id, city_id, nom, cuisine, description, poster, douche, prix) SELECT id, type_id, city_id, nom, cuisine, description, poster, douche, prix FROM __temp__chambre');
        $this->addSql('DROP TABLE __temp__chambre');
        $this->addSql('CREATE INDEX IDX_C509E4FFC54C8C93 ON chambre (type_id)');
        $this->addSql('CREATE INDEX IDX_C509E4FF8BAC62AF ON chambre (city_id)');
        $this->addSql('DROP INDEX IDX_2D5B0234A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__city AS SELECT id, user_id, name, poster, commentaire FROM city');
        $this->addSql('DROP TABLE city');
        $this->addSql('CREATE TABLE city (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, poster VARCHAR(255) NOT NULL, commentaire CLOB NOT NULL)');
        $this->addSql('INSERT INTO city (id, user_id, name, poster, commentaire) SELECT id, user_id, name, poster, commentaire FROM __temp__city');
        $this->addSql('DROP TABLE __temp__city');
        $this->addSql('CREATE INDEX IDX_2D5B0234A76ED395 ON city (user_id)');
        $this->addSql('DROP INDEX IDX_14B784189B177F54');
        $this->addSql('CREATE TEMPORARY TABLE __temp__photo AS SELECT id, chambre_id, path FROM photo');
        $this->addSql('DROP TABLE photo');
        $this->addSql('CREATE TABLE photo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, chambre_id INTEGER DEFAULT NULL, path VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO photo (id, chambre_id, path) SELECT id, chambre_id, path FROM __temp__photo');
        $this->addSql('DROP TABLE __temp__photo');
        $this->addSql('CREATE INDEX IDX_14B784189B177F54 ON photo (chambre_id)');
    }
}
