# Ensure SHELL is /bin/sh
SHELL = /bin/sh

.PHONY: build
install: ## Build the image
	@docker compose up -d --build --force-recreate hornbach-test-app

.PHONY: ssh
ssh: ## SSH into image container
	@docker compose exec hornbach-test-app ash

.PHONY: unit-tests
unit-tests: ## Run unit tests
	@vendor/bin/phpunit tests

.PHONY: run
run: ## Run the project
	@php ./index.php
