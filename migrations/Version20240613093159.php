<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240613093159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            CREATE OR REPLACE FUNCTION update_geo_point()
                RETURNS TRIGGER AS $$
                BEGIN
                    NEW.geo_point := ST_SetSRID(ST_MakePoint(NEW.long, NEW.lat), 4326);
                    RETURN NEW;
                END;
            $$ LANGUAGE plpgsql;"
        );

        $this->addSql("
            CREATE TRIGGER update_geo_point_trigger
            BEFORE INSERT OR UPDATE ON fountains
            FOR EACH ROW
            EXECUTE FUNCTION update_geo_point(); 
           ");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
