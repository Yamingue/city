<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210117165711 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chambre (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, city_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, cuisine TINYINT(1) NOT NULL, description LONGTEXT NOT NULL, poster VARCHAR(255) NOT NULL, douche TINYINT(1) NOT NULL, prix INT DEFAULT NULL, is_free TINYINT(1) DEFAULT NULL, caution INT DEFAULT NULL, INDEX IDX_C509E4FFC54C8C93 (type_id), INDEX IDX_C509E4FF8BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chat (id INT AUTO_INCREMENT NOT NULL, form_id INT NOT NULL, destination_id INT NOT NULL, message LONGTEXT NOT NULL, INDEX IDX_659DF2AA5FF69B7D (form_id), INDEX IDX_659DF2AA816C6140 (destination_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, poster VARCHAR(255) NOT NULL, commentaire LONGTEXT NOT NULL, eau VARCHAR(255) DEFAULT NULL, INDEX IDX_2D5B0234A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, content VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, is_read TINYINT(1) NOT NULL, INDEX IDX_BF5476CAA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, chambre_id INT DEFAULT NULL, path VARCHAR(255) NOT NULL, INDEX IDX_14B784189B177F54 (chambre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, chambre_id INT DEFAULT NULL, mois INT NOT NULL, tel INT NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_42C849559B177F54 (chambre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_chabre (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649F037AB0F (tel), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FFC54C8C93 FOREIGN KEY (type_id) REFERENCES type_chabre (id)');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FF8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AA5FF69B7D FOREIGN KEY (form_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AA816C6140 FOREIGN KEY (destination_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784189B177F54 FOREIGN KEY (chambre_id) REFERENCES chambre (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559B177F54 FOREIGN KEY (chambre_id) REFERENCES chambre (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784189B177F54');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559B177F54');
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FF8BAC62AF');
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FFC54C8C93');
        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AA5FF69B7D');
        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AA816C6140');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B0234A76ED395');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CAA76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE chambre');
        $this->addSql('DROP TABLE chat');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE type_chabre');
        $this->addSql('DROP TABLE user');
    }
}
