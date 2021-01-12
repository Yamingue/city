<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210110233331 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chambre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, boolean BOOLEAN NOT NULL, cuisine BOOLEAN NOT NULL, description CLOB NOT NULL)');
        $this->addSql('CREATE INDEX IDX_C509E4FFC54C8C93 ON chambre (type_id)');
        $this->addSql('CREATE TABLE city (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE photo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, chambre_id INTEGER DEFAULT NULL, path VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_14B784189B177F54 ON photo (chambre_id)');
        $this->addSql('CREATE TABLE type_chabre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE chambre');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE type_chabre');
    }
}
