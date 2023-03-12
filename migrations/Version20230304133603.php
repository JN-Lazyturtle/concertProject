<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230304133603 extends AbstractMigration
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
        $this->addSql('ALTER TABLE booking ADD artists_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE54A05007 FOREIGN KEY (artists_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE54A05007 ON booking (artists_id)');
        $this->addSql('ALTER TABLE concert_hall CHANGE renovation_start_date renovation_start_date DATETIME DEFAULT NULL, CHANGE renovation_end_date renovation_end_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE picture CHANGE alternative_name_p alternative_name_p VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD email VARCHAR(180) NOT NULL, ADD roles JSON NOT NULL, ADD password VARCHAR(255) NOT NULL, DROP mail_u, DROP is_admin, CHANGE firstname firstname VARCHAR(30) DEFAULT NULL, CHANGE lastname lastname VARCHAR(30) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE publications (idPublication INT AUTO_INCREMENT NOT NULL, message TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, date DATETIME NOT NULL, idAuteur INT NOT NULL, INDEX fk_auteur (idAuteur), PRIMARY KEY(idPublication)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateurs (idUtilisateur INT AUTO_INCREMENT NOT NULL, login VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, password TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, adresseMail VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, profilePictureName VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, PRIMARY KEY(idUtilisateur)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE publications ADD CONSTRAINT fk_auteur FOREIGN KEY (idAuteur) REFERENCES utilisateurs (idUtilisateur) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE54A05007');
        $this->addSql('DROP INDEX IDX_E00CEDDE54A05007 ON booking');
        $this->addSql('ALTER TABLE booking DROP artists_id');
        $this->addSql('ALTER TABLE picture CHANGE alternative_name_p alternative_name_p VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user ADD mail_u VARCHAR(30) NOT NULL, ADD is_admin TINYINT(1) NOT NULL, DROP email, DROP roles, DROP password, CHANGE firstname firstname VARCHAR(30) NOT NULL, CHANGE lastname lastname VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE concert_hall CHANGE renovation_start_date renovation_start_date DATETIME DEFAULT \'NULL\', CHANGE renovation_end_date renovation_end_date DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE artist CHANGE summary_a summary_a VARCHAR(1000) DEFAULT \'NULL\'');
    }
}
