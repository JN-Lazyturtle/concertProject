<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230127132721 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE concert_hall CHANGE renovation_start_date renovation_start_date DATETIME DEFAULT NULL, CHANGE renovation_end_date renovation_end_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE picture CHANGE alternative_name_p alternative_name_p VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture CHANGE alternative_name_p alternative_name_p VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE concert_hall CHANGE renovation_start_date renovation_start_date DATETIME DEFAULT \'NULL\', CHANGE renovation_end_date renovation_end_date DATETIME DEFAULT \'NULL\'');
    }
}
