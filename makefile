SHELL := /bin/bash 

compose-up-srv: 
	docker compose -f composefile.srv -p compose up -d;

compose-down-srv:
	docker compose -f composefile.srv -p compose down;

compose-up-dev:
	docker compose -f composefile.dev -p compose up -d;

compose-down-dev:
	docker compose -f composefile.dev -p compose down;

build-image:
	docker build -f imagefile -t php:7.2.laravel .;

clear:
	rm -rf ./laravel7/vendor;
	rm ./laravel7/.env;

