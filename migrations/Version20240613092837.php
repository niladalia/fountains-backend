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
        return '';
    }

    public function up(Schema $schema): void
    {

        $this->addSql("CREATE TYPE fountain_type AS ENUM ('natural', 'tap_water', 'watering_place','unknown');");
        $this->addSql("CREATE TYPE safe_water AS ENUM ('yes', 'probably','no','unknown');");
        $this->addSql("CREATE TYPE legal_water AS ENUM ('trated', 'untrated','unknown');");

        $this->addSql('
            CREATE TABLE fountains (
                id VARCHAR(255) NOT NULL,
                lat DOUBLE PRECISION NOT NULL,
                long DOUBLE PRECISION NOT NULL,
                geo_point geography(Point, 4326),
                safe_water VARCHAR(50) NOT NULL,
                legal_water VARCHAR(50) NOT NULL,
                name VARCHAR(255) DEFAULT NULL,
                fountain_type VARCHAR(50) DEFAULT NULL,
                picture VARCHAR(255) DEFAULT NULL,
                description VARCHAR(255) DEFAULT NULL,
                operational_status BOOLEAN DEFAULT NULL,
                access_bottles BOOLEAN DEFAULT NULL,
                access_pets BOOLEAN DEFAULT NULL,
                acces_wheelchair BOOLEAN DEFAULT NULL,
                provider_name VARCHAR(255) DEFAULT NULL,
                provider_id VARCHAR(255) DEFAULT NULL,
                user_id VARCHAR(255) DEFAULT NULL,
                provider_updated_at TIMESTAMP WITH TIME ZONE DEFAULT NULL,
                updated_at TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP,
                created_at TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY(id),
                UNIQUE(lat, long),
                UNIQUE(provider_name, provider_id),
                CHECK ((provider_name IS NOT NULL AND provider_id IS NOT NULL AND provider_updated_at IS NOT NULL AND user_id IS NULL) OR (provider_name IS NULL AND provider_id IS NULL AND provider_updated_at IS NULL))
            );
        ');

        $this->addSql("CREATE INDEX idx_fuentes_geo_point ON fountains USING GIST(geo_point);");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE fountains;");
        $this->addSql("DROP TYPE fountain_type;");
        $this->addSql("DROP TYPE safe_water;");
        $this->addSql("DROP TYPE legal_water;");
    }
}
