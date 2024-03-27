install:
	composer install

gendiff:
	./bin/gendiff

validate:
	composer validate
	
lint:
	./vendor/bin/phpcs -v -- --standard=PSR12 src bin

test:
	composer exec --verbose phpunit tests