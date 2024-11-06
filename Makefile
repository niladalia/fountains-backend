build:
	docker compose --env-file .env --env-file .env.local up --build -d
	docker exec -it fountains_app_php composer install

start:
	docker compose --env-file .env --env-file .env.local up -d

stop:
	docker compose stop

run-migrations:
	docker exec -it fountains_app_php php bin/console doctrine:migrations:migrate

prepare-test-db:
	docker exec -i fountains_app_php php bin/console --env=test d:d:d  --force --if-exists
	docker exec -i fountains_app_php php bin/console --env=test d:d:c --if-not-exists
	docker exec -i fountains_app_php php bin/console --env=test d:s:c

list-migrations:
	docker exec -it fountains_app_php php bin/console doctrine:migrations:list

status-migrations:
	docker exec -it fountains_app_php php bin/console doctrine:migrations:status

run-test:
	docker exec fountains_app_php ./vendor/bin/phpunit
