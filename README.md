# Fountains Backend

## Install

### [Setup environment](https://symfony.com/doc/current/configuration.html#configuration-based-on-environment-variables)

```sh
cp .env .env.local
```

- Edit `APP_ENV` to [select active environment](https://symfony.com/doc/current/configuration.html#selecting-the-active-environment) (`dev` or `prod`)
- Edit [other values](https://symfony.com/doc/current/configuration.html#overriding-environment-values-via-env-local) as needed

#### Regenerate `APP_SECRET`

```sh
php bin/console regenerate-app-secret

# Docker
docker exec -it fountains_php php bin/console regenerate-app-secret
```

## Run

Run docker containers (php server, nginx, database...) with [docker compose](https://docs.docker.com/compose/install/)

```sh
make build-project
```

To execute migrations (first time or with new migrations):

```sh
make run-migrations # input yes
```

**Endpoint**: http://localhost:8000/api/fountains

Port configurable with `NGINX_PORT` in `.env.local`

To stop all containers:

```sh
make stop-project
```

To start again all containers:

```sh
make start-project
```

To restart containers:

```sh
make restart-project
```

To delete all containers:

```sh
docker compose down
```

To also delete database and other data volumes:

```sh
docker compose down --volumes --remove-orphans  # CAUTION (!) This deletes all data!

docker system prune -a # This removes unused images and containers (to clear storage)
```

### Debugging

```sh
# See container logs
docker logs -f -t --tail 1000 fountains_php
docker logs -f -t --tail 1000 fountains_db
docker logs -f -t --tail 1000 fountains_nginx

# See merged docker-compose.yml variables
docker compose --env-file .env --env-file .env.local config

# Log in to the database
docker exec -it fountains_db bash
PGPASSWORD=$POSTGRES_PASSWORD psql -U $POSTGRES_USER -d $POSTGRES_DB
```

#### Migrations

```sh
# Show current migrations
make list-migrations
make status-migrations

# Revert up to a specific migration
docker exec -it fountains_php php bin/console doctrine:migrations:migrate DoctrineMigrations\\Version20240613092837

# Undo specific migration only
docker exec -it fountains_php php bin/console doctrine:migrations:execute --down DoctrineMigrations\\Version20240613092837

# Undo all migrations
docker exec -it fountains_php php bin/console doctrine:migrations:migrate 0
```

#### SQL

Useful queries for debugging:

```sql
-- Count fountains
SELECT COUNT(*) FROM fountains;

-- Last updated fountains
SELECT * FROM fountains ORDER BY updated_at DESC LIMIT 5;
```
