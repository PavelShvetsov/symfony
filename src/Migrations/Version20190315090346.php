<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190315090346 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('ALTER TABLE ip_info ADD COLUMN ip VARCHAR(45) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__ip_info AS SELECT id, city, country FROM ip_info');
        $this->addSql('DROP TABLE ip_info');
        $this->addSql('CREATE TABLE ip_info (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, city VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO ip_info (id, city, country) SELECT id, city, country FROM __temp__ip_info');
        $this->addSql('DROP TABLE __temp__ip_info');
    }
}
