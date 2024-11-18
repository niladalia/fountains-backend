<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241115181948 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE comments (
                id UUID NOT NULL,
                user_id UUID NOT NULL,
                fountain_id UUID NOT NULL,
                content TEXT NOT NULL,
                updated_at TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP,
                created_at TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id),
                FOREIGN KEY (user_id) REFERENCES users (id),
                FOREIGN KEY (fountain_id) REFERENCES fountains (id)
            )
        ');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS comments');

    }
}
