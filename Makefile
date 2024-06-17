build-project:
	docker compose up --build -d
	docker exec -it fountains_php composer install
