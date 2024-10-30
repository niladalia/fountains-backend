<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240925150426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE user_google_id (
            user_id UUID NOT NULL,
            google_id VARCHAR(255) NOT NULL,
            PRIMARY KEY (user_id, google_id),
            FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
            );
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS user_google_id');
    }
}
