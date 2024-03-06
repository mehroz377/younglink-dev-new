.PHONY: up
up:
	docker compose up -d

.PHONY: down
down:
	docker compose down

.PHONY: rebuild
rebuild:
	docker compose build --no-cache

.PHONY: console
console:
	docker exec -it younglink-php-1 php bin/console $(CMD)

.PHONY: composer
composer:
	docker exec -it younglink-php-1 composer $(CMD)

.PHONY: yarn
yarn:
	docker exec -it younglink-node-1 yarn $(CMD)
