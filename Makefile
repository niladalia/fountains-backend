build-project:
	docker compose up --build -d
	docker exec -it fountains_php composer install

run-migrations:
        docker exec -it fountains_php php bin/console doctrine:migrations:migrate
