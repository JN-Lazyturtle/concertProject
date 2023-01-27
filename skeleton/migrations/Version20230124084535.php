<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124084535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artist_concert (artist_id INT NOT NULL, concert_id INT NOT NULL, INDEX IDX_artist_concert_a (artist_id), INDEX IDX_artist_concert_c (concert_id), PRIMARY KEY(artist_id, concert_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artist_concert ADD CONSTRAINT FK_artist FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_concert ADD CONSTRAINT FK_concert FOREIGN KEY (concert_id) REFERENCES concert (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist_concert DROP FOREIGN KEY FK_artist');
        $this->addSql('ALTER TABLE artist_concert DROP FOREIGN KEY FK_concert');
        $this->addSql('DROP TABLE artist_concert');
    }
}
