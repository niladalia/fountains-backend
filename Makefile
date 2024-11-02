build:
	docker compose --env-file .env --env-file .env.local up --build -d
	docker exec -it fountains_app_php composer install

start:
	docker compose --env-file .env --env-file .env.local up -d

stop:
	docker compose stop

restart: stop-project start-project

run-migrations:
	docker exec -it fountains_app_php php bin/console doctrine:migrations:migrate

list-migrations:
	docker exec -it fountains_app_php php bin/console doctrine:migrations:list

status-migrations:
	docker exec -it fountains_app_php php bin/console doctrine:migrations:status
run-test:
	docker exec fountains_app_php ./vendor/bin/phpunit
