<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124132119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_artist DROP FOREIGN KEY FK_640B8DBA144C34F4');
        $this->addSql('ALTER TABLE user_artist DROP FOREIGN KEY FK_640B8DBAE96E089');
        $this->addSql('DROP INDEX IDX_640B8DBA144C34F4 ON user_artist');
        $this->addSql('DROP INDEX IDX_640B8DBAE96E089 ON user_artist');
        $this->addSql('DROP INDEX `primary` ON user_artist');
        $this->addSql('ALTER TABLE user_artist ADD user_id INT NOT NULL, ADD artist_id INT NOT NULL, DROP id_U, DROP id_A');
        $this->addSql('ALTER TABLE user_artist ADD CONSTRAINT FK_640B8DBAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_artist ADD CONSTRAINT FK_640B8DBAB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('CREATE INDEX IDX_640B8DBAA76ED395 ON user_artist (user_id)');
        $this->addSql('CREATE INDEX IDX_640B8DBAB7970CF8 ON user_artist (artist_id)');
        $this->addSql('ALTER TABLE user_artist ADD PRIMARY KEY (user_id, artist_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_artist DROP FOREIGN KEY FK_640B8DBAA76ED395');
        $this->addSql('ALTER TABLE user_artist DROP FOREIGN KEY FK_640B8DBAB7970CF8');
        $this->addSql('DROP INDEX IDX_640B8DBAA76ED395 ON user_artist');
        $this->addSql('DROP INDEX IDX_640B8DBAB7970CF8 ON user_artist');
        $this->addSql('DROP INDEX `PRIMARY` ON user_artist');
        $this->addSql('ALTER TABLE user_artist ADD id_U INT NOT NULL, ADD id_A INT NOT NULL, DROP user_id, DROP artist_id');
        $this->addSql('ALTER TABLE user_artist ADD CONSTRAINT FK_640B8DBA144C34F4 FOREIGN KEY (id_A) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE user_artist ADD CONSTRAINT FK_640B8DBAE96E089 FOREIGN KEY (id_U) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_640B8DBA144C34F4 ON user_artist (id_A)');
        $this->addSql('CREATE INDEX IDX_640B8DBAE96E089 ON user_artist (id_U)');
        $this->addSql('ALTER TABLE user_artist ADD PRIMARY KEY (id_U, id_A)');
    }
}
