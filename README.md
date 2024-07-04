# Fountains Backend

## Install

### [Setup environment](https://symfony.com/doc/current/configuration.html#configuration-based-on-environment-variables)

```sh
cp .env .env.local
```

- Edit `APP_ENV` to [select active environment](https://symfony.com/doc/current/configuration.html#selecting-the-active-environment) (`dev` or `prod`)
- Edit [other values](https://symfony.com/doc/current/configuration.html#overriding-environment-values-via-env-local) as needed

## Run

Run docker containers (php server, nginx, database...) with [docker compose](https://docs.docker.com/compose/install/)

```sh
make build-project
```

To make migrations (first time or with new migrations):

```sh
make run-migrations # input yes
```

**Endpoint**: http://localhost:88/api/fountains

Port configurable with `NGINX_PORT` in `.env.local`

To stop all containers:

```sh
make stop-project
```

To start again all containers:

```sh
make start-project
```

To delete all containers:

```sh
docker compose down
```

To also delete database and other data volumes:

```sh
docker-compose down --volumes --remove-orphans  # CAUTION (!) This deletes all data!
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
