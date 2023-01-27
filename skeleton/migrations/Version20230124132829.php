<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124132829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artist_music_style (artist_id INT NOT NULL, music_style_id INT NOT NULL, INDEX IDX_7D0E75E5B7970CF8 (artist_id), INDEX IDX_7D0E75E57DDE3C52 (music_style_id), PRIMARY KEY(artist_id, music_style_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE music_style (id INT AUTO_INCREMENT NOT NULL, name_ms VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artist_music_style ADD CONSTRAINT FK_7D0E75E5B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_music_style ADD CONSTRAINT FK_7D0E75E57DDE3C52 FOREIGN KEY (music_style_id) REFERENCES music_style (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist_music_style DROP FOREIGN KEY FK_7D0E75E5B7970CF8');
        $this->addSql('ALTER TABLE artist_music_style DROP FOREIGN KEY FK_7D0E75E57DDE3C52');
        $this->addSql('DROP TABLE artist_music_style');
        $this->addSql('DROP TABLE music_style');
    }
}
