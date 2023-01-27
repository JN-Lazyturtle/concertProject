<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124142426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, concert_id INT NOT NULL, nb_ticket INT NOT NULL, INDEX IDX_E00CEDDEA76ED395 (user_id), INDEX IDX_E00CEDDE83C97B2E (concert_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, concert_id INT DEFAULT NULL, name_p VARCHAR(255) NOT NULL, alternative_name_p VARCHAR(255) DEFAULT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_16DB4F8983C97B2E (concert_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE83C97B2E FOREIGN KEY (concert_id) REFERENCES concert (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F8983C97B2E FOREIGN KEY (concert_id) REFERENCES concert (id)');
        $this->addSql('ALTER TABLE concert_hall_concert DROP FOREIGN KEY FK_4397E0CB83C97B2E');
        $this->addSql('ALTER TABLE concert_hall_concert DROP FOREIGN KEY FK_4397E0CBC8B57370');
        $this->addSql('DROP TABLE concert_hall_concert');
        $this->addSql('ALTER TABLE artist ADD picture_a_id INT NOT NULL, DROP picture_a, CHANGE summary_a summary_a VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_1599687843ED6CD FOREIGN KEY (picture_a_id) REFERENCES picture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1599687843ED6CD ON artist (picture_a_id)');
        $this->addSql('ALTER TABLE concert ADD concert_hall_id INT NOT NULL');
        $this->addSql('ALTER TABLE concert ADD CONSTRAINT FK_D57C02D2C8B57370 FOREIGN KEY (concert_hall_id) REFERENCES concert_hall (id)');
        $this->addSql('CREATE INDEX IDX_D57C02D2C8B57370 ON concert (concert_hall_id)');
        $this->addSql('ALTER TABLE user_artist DROP FOREIGN KEY FK_640B8DBAA76ED395');
        $this->addSql('ALTER TABLE user_artist DROP FOREIGN KEY FK_640B8DBAB7970CF8');
        $this->addSql('ALTER TABLE user_artist ADD CONSTRAINT FK_640B8DBAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_artist ADD CONSTRAINT FK_640B8DBAB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_1599687843ED6CD');
        $this->addSql('CREATE TABLE concert_hall_concert (concert_hall_id INT NOT NULL, concert_id INT NOT NULL, INDEX IDX_4397E0CBC8B57370 (concert_hall_id), INDEX IDX_4397E0CB83C97B2E (concert_id), PRIMARY KEY(concert_hall_id, concert_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE concert_hall_concert ADD CONSTRAINT FK_4397E0CB83C97B2E FOREIGN KEY (concert_id) REFERENCES concert (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE concert_hall_concert ADD CONSTRAINT FK_4397E0CBC8B57370 FOREIGN KEY (concert_hall_id) REFERENCES concert_hall (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEA76ED395');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE83C97B2E');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F8983C97B2E');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE picture');
        $this->addSql('ALTER TABLE user_artist DROP FOREIGN KEY FK_640B8DBAA76ED395');
        $this->addSql('ALTER TABLE user_artist DROP FOREIGN KEY FK_640B8DBAB7970CF8');
        $this->addSql('ALTER TABLE user_artist ADD CONSTRAINT FK_640B8DBAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_artist ADD CONSTRAINT FK_640B8DBAB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE concert DROP FOREIGN KEY FK_D57C02D2C8B57370');
        $this->addSql('DROP INDEX IDX_D57C02D2C8B57370 ON concert');
        $this->addSql('ALTER TABLE concert DROP concert_hall_id');
        $this->addSql('DROP INDEX UNIQ_1599687843ED6CD ON artist');
        $this->addSql('ALTER TABLE artist ADD picture_a VARCHAR(255) NOT NULL, DROP picture_a_id, CHANGE summary_a summary_a VARCHAR(255) DEFAULT \'NULL\'');
    }
}
