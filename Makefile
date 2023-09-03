init:
	@make build
	@make up
up:
	docker compose up -d
build:
	docker compose build
remake:
	@make destroy
	@make install
stop:
	docker compose stop
down:
	docker compose down --remove-orphans
down-v:
	docker compose down --remove-orphans --volumes
restart:
	@make down
	@make up
destroy:
	docker compose down --rmi all --volumes --remove-orphans
ps:
	docker compose ps
logs:
	docker compose logs
logs-watch:
	docker compose logs --follow

create-db:
	docker compose run --rm php-cli php bin/console doctrine:database:create

run-migrations:
	docker compose run --rm php-cli php bin/console doctrine:migrations:migrate

run-fixtures:
	docker compose run --rm php-cli php bin/console doctrine:fixtures:load

clear-cache:
	docker compose run --rm php-cli php bin/console cache:clear       