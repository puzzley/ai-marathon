.PHONY: setup install health

setup:
	bash setup.sh

install:
	@if [ -f composer.json ]; then composer install --no-interaction; else echo "No composer.json; skipping Composer."; fi
	@if [ -f package.json ]; then npm install; else echo "No package.json; skipping npm."; fi

health:
	php health-check.php
