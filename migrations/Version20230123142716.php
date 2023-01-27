<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230123142716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, name_a VARCHAR(30) NOT NULL, contact_a VARCHAR(30) NOT NULL, summary_a VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE publications DROP FOREIGN KEY fk_auteur');
        $this->addSql('DROP TABLE publications');
        $this->addSql('DROP TABLE utilisateurs');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE publications (idPublication INT AUTO_INCREMENT NOT NULL, message TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, date DATETIME NOT NULL, idAuteur INT NOT NULL, INDEX fk_auteur (idAuteur), PRIMARY KEY(idPublication)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateurs (idUtilisateur INT AUTO_INCREMENT NOT NULL, login VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, password TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, adresseMail VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, profilePictureName VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, PRIMARY KEY(idUtilisateur)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE publications ADD CONSTRAINT fk_auteur FOREIGN KEY (idAuteur) REFERENCES utilisateurs (idUtilisateur) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP TABLE artist');
    }
}
