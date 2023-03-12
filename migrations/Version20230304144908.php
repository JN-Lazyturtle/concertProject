<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230304144908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publications DROP FOREIGN KEY fk_auteur');
        $this->addSql('DROP TABLE publications');
        $this->addSql('DROP TABLE utilisateurs');
        $this->addSql('ALTER TABLE artist CHANGE summary_a summary_a VARCHAR(1000) DEFAULT NULL');
        $this->addSql('ALTER TABLE concert_hall CHANGE renovation_start_date renovation_start_date DATETIME DEFAULT NULL, CHANGE renovation_end_date renovation_end_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE picture CHANGE alternative_name_p alternative_name_p VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE firstname firstname VARCHAR(30) DEFAULT NULL, CHANGE lastname lastname VARCHAR(30) DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE publications (idPublication INT AUTO_INCREMENT NOT NULL, message TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, date DATETIME NOT NULL, idAuteur INT NOT NULL, INDEX fk_auteur (idAuteur), PRIMARY KEY(idPublication)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateurs (idUtilisateur INT AUTO_INCREMENT NOT NULL, login VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, password TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, adresseMail VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, profilePictureName VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, PRIMARY KEY(idUtilisateur)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE publications ADD CONSTRAINT fk_auteur FOREIGN KEY (idAuteur) REFERENCES utilisateurs (idUtilisateur) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE picture CHANGE alternative_name_p alternative_name_p VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`, CHANGE firstname firstname VARCHAR(30) DEFAULT \'NULL\', CHANGE lastname lastname VARCHAR(30) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE concert_hall CHANGE renovation_start_date renovation_start_date DATETIME DEFAULT \'NULL\', CHANGE renovation_end_date renovation_end_date DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE artist CHANGE summary_a summary_a VARCHAR(1000) DEFAULT \'NULL\'');
    }
}
