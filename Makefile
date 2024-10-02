-include .env
-include .env.local

COMPOSE?=docker compose -f docker-compose.yml -f docker-compose-dev.yml
EXEC?=$(COMPOSE) exec app
CONSOLE?=$(EXEC) php bin/console

.PHONY: start up vendor bash db fixtures cc stop

start: up vendor db cc

up:
	docker kill $$(docker ps -q) || true
	$(COMPOSE) build --force-rm
	$(COMPOSE) up -d --remove-orphans

stop:
	$(COMPOSE) stop

vendor:
	$(EXEC) composer install -n
	make perm

bash:
	$(EXEC) bash

db:
	@$(CONSOLE) doctrine:database:drop --if-exists --force
	@$(CONSOLE) doctrine:database:create --if-not-exists
	@$(CONSOLE) doctrine:schema:update --force --complete
	@$(CONSOLE) doctrine:fixtures:load -n

cc:
	$(CONSOLE) cache:clear --no-warmup
	$(CONSOLE) cache:warmup

perm:
	sudo chown -R $(USER):$(USER) .
	mkdir -p ./var ./public/
	sudo chown -R www-data:$(USER) ./var ./public/
	sudo chmod -R g+rwx .

php-lint:
	sh -c "COMPOSE_INTERACTIVE_NO_CLI=1 $(EXEC) vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.php"

twig-lint:
	sh -c "COMPOSE_INTERACTIVE_NO_CLI=1 $(EXEC) vendor/bin/twig-cs-fixer lint --fix --config=.twig-cs-fixer.php"
