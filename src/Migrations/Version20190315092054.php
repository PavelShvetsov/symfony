<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190315092054 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX UNIQ_D8EE6DD8A5E3B32D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ip_info AS SELECT id, city, country, ip FROM ip_info');
        $this->addSql('DROP TABLE ip_info');
        $this->addSql('CREATE TABLE ip_info (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, city VARCHAR(255) DEFAULT NULL COLLATE BINARY, country VARCHAR(255) DEFAULT NULL COLLATE BINARY, ip VARCHAR(45) NOT NULL)');
        $this->addSql('INSERT INTO ip_info (id, city, country, ip) SELECT id, city, country, ip FROM __temp__ip_info');
        $this->addSql('DROP TABLE __temp__ip_info');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D8EE6DD8A5E3B32D ON ip_info (ip)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX UNIQ_D8EE6DD8A5E3B32D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ip_info AS SELECT id, city, country, ip FROM ip_info');
        $this->addSql('DROP TABLE ip_info');
        $this->addSql('CREATE TABLE ip_info (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, city VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, ip VARCHAR(45) DEFAULT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO ip_info (id, city, country, ip) SELECT id, city, country, ip FROM __temp__ip_info');
        $this->addSql('DROP TABLE __temp__ip_info');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D8EE6DD8A5E3B32D ON ip_info (ip)');
    }
}
