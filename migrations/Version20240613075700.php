<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240613075700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Providers';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE providers (
                name VARCHAR(64) NOT NULL,
                url VARCHAR(255) DEFAULT NULL,
                PRIMARY KEY(name)
            );
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS providers');
    }
}
