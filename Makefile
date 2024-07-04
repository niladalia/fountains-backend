build-project:
	docker compose --env-file .env --env-file .env.local up --build -d
	docker exec -it fountains_php composer install

start-project:
	docker compose --env-file .env --env-file .env.local up -d

stop-project:
	docker compose stop

run-migrations:
	docker exec -it fountains_php php bin/console doctrine:migrations:migrate
