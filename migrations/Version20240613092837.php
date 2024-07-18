<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240613092837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Fountains';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TYPE fountain_type AS ENUM ('natural', 'tap_water', 'watering_place', 'unknown');");
        $this->addSql("CREATE TYPE safe_water_type AS ENUM ('yes', 'probably', 'no', 'unknown');");
        $this->addSql("CREATE TYPE legal_water_type AS ENUM ('treated', 'untreated', 'unknown');");

        $this->addSql('
            CREATE TABLE fountains (
                id UUID NOT NULL,
                lat DOUBLE PRECISION NOT NULL,
                long DOUBLE PRECISION NOT NULL,
                geo_point geography(Point, 4326),
                type fountain_type DEFAULT NULL,
                name VARCHAR(255) DEFAULT NULL,
                description TEXT DEFAULT NULL,
                picture VARCHAR(255) DEFAULT NULL,
                operational_status BOOLEAN DEFAULT NULL,
                safe_water safe_water_type NOT NULL,
                legal_water legal_water_type NOT NULL,
                access_bottles BOOLEAN DEFAULT NULL,
                access_pets BOOLEAN DEFAULT NULL,
                acces_wheelchair BOOLEAN DEFAULT NULL,
                provider_name VARCHAR(64) DEFAULT NULL,
                provider_id VARCHAR(64) DEFAULT NULL,
                user_id UUID DEFAULT NULL,
                provider_updated_at TIMESTAMP WITH TIME ZONE DEFAULT NULL,
                updated_at TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP,
                created_at TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY(id),
                UNIQUE(lat, long),
                UNIQUE(provider_name, provider_id),
                CONSTRAINT fk_provider_name FOREIGN KEY (provider_name) REFERENCES providers(name) ON DELETE RESTRICT
                CHECK ((provider_name IS NOT NULL AND provider_id IS NOT NULL AND provider_updated_at IS NOT NULL AND user_id IS NULL) OR (provider_name IS NULL AND provider_id IS NULL AND provider_updated_at IS NULL))
            );
        ');

        $this->addSql("CREATE INDEX idx_fountains_geom ON fountains USING GIST((geo_point::geometry));");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE fountains;");
        $this->addSql("DROP TYPE fountain_type;");
        $this->addSql("DROP TYPE safe_water_type;");
        $this->addSql("DROP TYPE legal_water_type;");
    }
}
