QA_DOCKER_IMAGE=jakzal/phpqa:1.92.1-php8.2-alpine
QA_DOCKER_COMMAND=docker run --init -t --rm --env "COMPOSER_HOME=/composer" --user "$(shell id -u):$(shell id -g)" --volume /tmp/tmp-phpqa-$(shell id -u):/tmp:delegated --volume "$(shell pwd):/project:delegated" --volume "${HOME}/.composer:/composer:delegated" --workdir /project ${QA_DOCKER_IMAGE}

install: composer-install
ci: install check test
check: composer-validate lint-xml cs-check phpstan
test: phpunit

clean:
	rm -rf var/

composer-validate: ensure
	@echo "Validating local composer files"
	@sh -c "${QA_DOCKER_COMMAND} composer validate"

lint-xml:
	@echo "Validating XML files"

ifeq (, $(shell which xmllint))
	@echo "[SKIPPED] No xmllint in $(PATH), consider installing it"
else
	@find . \( -name '*.xml' -or -name '*.xliff' -or -name '*.xlf' \) \
			-not -path './vendor/*' \
			-not -path './.*' \
			-not -path './var/*' \
			-type f \
			-exec xmllint --format --encode UTF-8 --noout '{}' \;
endif

composer-install: clean
	composer install

cs: ensure
	sh -c "${QA_DOCKER_COMMAND} php-cs-fixer fix -vvv --using-cache=no --diff"

cs-check: ensure
	sh -c "${QA_DOCKER_COMMAND} php-cs-fixer fix -vvv --diff --dry-run"

phpstan: ensure
	vendor/bin/phpstan analyse

phpunit: encore
	./vendor/bin/simple-phpunit

fetch:
	docker pull "${QA_DOCKER_IMAGE}"

ensure:
	mkdir -p ${HOME}/.composer /tmp/tmp-phpqa-$(shell id -u) var/

.PHONY: clean composer-validate lint-xml lint-yaml lint-twig
.PHONY: composer-install cs cs-check phpstan psalm phpunit infection
.PHONY: db-fixtures in-docker-phpunit in-docker-infection fetch ensure

