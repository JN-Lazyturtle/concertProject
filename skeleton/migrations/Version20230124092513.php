<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124092513 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(30) NOT NULL, lastname VARCHAR(30) NOT NULL, mail_u VARCHAR(30) NOT NULL, is_admin TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_artist (id_U INT NOT NULL, id_A INT NOT NULL, INDEX IDX_640B8DBAE96E089 (id_U), INDEX IDX_640B8DBA144C34F4 (id_A), PRIMARY KEY(id_U, id_A)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_artist ADD CONSTRAINT FK_user_artist_u FOREIGN KEY (id_U) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_artist ADD CONSTRAINT FK_user_artist_a FOREIGN KEY (id_A) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE artist RENAME COLUMN id TO id_a');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_artist DROP FOREIGN KEY FK_user_artist_a');
        $this->addSql('ALTER TABLE user_artist DROP FOREIGN KEY FK_user_artist_u');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_artist');
    }
}
