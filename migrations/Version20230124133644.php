<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124133644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE concert_hall (id INT AUTO_INCREMENT NOT NULL, name_h VARCHAR(30) NOT NULL, capacity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE concert_hall_concert (concert_hall_id INT NOT NULL, concert_id INT NOT NULL, INDEX IDX_4397E0CBC8B57370 (concert_hall_id), INDEX IDX_4397E0CB83C97B2E (concert_id), PRIMARY KEY(concert_hall_id, concert_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE concert_hall_concert ADD CONSTRAINT FK_4397E0CBC8B57370 FOREIGN KEY (concert_hall_id) REFERENCES concert_hall (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE concert_hall_concert ADD CONSTRAINT FK_4397E0CB83C97B2E FOREIGN KEY (concert_id) REFERENCES concert (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE concert_hall_concert DROP FOREIGN KEY FK_4397E0CBC8B57370');
        $this->addSql('ALTER TABLE concert_hall_concert DROP FOREIGN KEY FK_4397E0CB83C97B2E');
        $this->addSql('DROP TABLE concert_hall');
        $this->addSql('DROP TABLE concert_hall_concert');
    }
}
