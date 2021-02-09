build:
	@echo "Building application"
	@docker-compose build

start:
	@echo "Running application"
	@docker-compose build
	@docker-compose up -d
	@docker exec test_app composer update
	@docker exec test_app composer install
	@docker exec test_app php bin/console doctrine:migrations:migrate --no-interaction

down:
	@docker-compose down

test:
	@docker exec test_app php bin/phpunit
