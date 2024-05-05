run:
	docker compose up -d
composer-install:
	docker compose exec php composer install
