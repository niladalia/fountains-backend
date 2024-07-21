build-project:
	docker compose --env-file .env --env-file .env.local up --build -d
	docker exec -it fountains_php composer install

start-project:
	docker compose --env-file .env --env-file .env.local up -d

stop-project:
	docker compose stop

restart-project: stop-project start-project

run-migrations:
	docker exec -it fountains_php php bin/console doctrine:migrations:migrate

list-migrations:
	docker exec -it fountains_php php bin/console doctrine:migrations:list

status-migrations:
	docker exec -it fountains_php php bin/console doctrine:migrations:status
