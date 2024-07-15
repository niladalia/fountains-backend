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
        return 'Fountains triggers: geo_point, updated_at';
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
            $$ LANGUAGE plpgsql;
        ");

        $this->addSql("
            CREATE TRIGGER update_geo_point_trigger
            BEFORE UPDATE ON fountains
            FOR EACH ROW
            WHEN (NEW.lat != OLD.lat OR NEW.long != OLD.long)
            EXECUTE FUNCTION update_geo_point();
        ");

        $this->addSql("
            CREATE TRIGGER insert_geo_point_trigger
            BEFORE INSERT ON fountains
            FOR EACH ROW
            EXECUTE FUNCTION update_geo_point();
        ");

        $this->addSql("
            CREATE OR REPLACE FUNCTION update_updated_at_column()
                RETURNS TRIGGER AS $$
                BEGIN
                    NEW.updated_at = NOW();
                    RETURN NEW;
                END;
            $$ LANGUAGE plpgsql;
        ");

        $this->addSql("
            CREATE TRIGGER updated_at_trigger
            BEFORE UPDATE ON fountains
            FOR EACH ROW
            EXECUTE FUNCTION update_updated_at_column();
        ");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TRIGGER IF EXISTS update_geo_point_trigger ON fountains;");
        $this->addSql("DROP TRIGGER IF EXISTS insert_geo_point_trigger ON fountains;");
        $this->addSql("DROP FUNCTION IF EXISTS update_geo_point();");

        $this->addSql("DROP TRIGGER IF EXISTS updated_at_trigger ON fountains;");
        $this->addSql("DROP FUNCTION IF EXISTS update_updated_at_column();");
    }
}
