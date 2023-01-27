<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124082645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON artist');
        $this->addSql('ALTER TABLE artist CHANGE summary_a summary_a VARCHAR(255) DEFAULT NULL, CHANGE id id_a INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE artist ADD PRIMARY KEY (id_a)');
        $this->addSql('ALTER TABLE concert MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON concert');
        $this->addSql('ALTER TABLE concert CHANGE id id_c INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE concert ADD PRIMARY KEY (id_c)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE concert MODIFY id_c INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON concert');
        $this->addSql('ALTER TABLE concert CHANGE id_c id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE concert ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE artist MODIFY id_a INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON artist');
        $this->addSql('ALTER TABLE artist CHANGE summary_a summary_a VARCHAR(255) DEFAULT \'NULL\', CHANGE id_a id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE artist ADD PRIMARY KEY (id)');
    }
}
