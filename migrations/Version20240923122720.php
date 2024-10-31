<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240923122720 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE users (
                id UUID NOT NULL,
                email VARCHAR(225) NOT NULL,
                password VARCHAR(255) DEFAULT NULL,
                auth_token VARCHAR(255) DEFAULT NULL,
                UNIQUE (email),
                PRIMARY KEY(id)
            );
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS users');
    }
}
