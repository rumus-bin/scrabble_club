
up :
	docker-compose up -d
down :
	docker-compose down
down-v :
	docker-compose down -v
install :
	docker-compose run  --rm  provalido.test_app composer install
	docker-compose run  --rm  provalido.test_app npm install
key_generate :
	docker-compose run  --rm  provalido.test_app php artisan key:generate
migrate :
	docker-compose run  --rm  provalido.test_app php artisan migrate
migrate_seed :
	docker-compose run  --rm  provalido.test_app php artisan migrate --seed
run-dev :
	docker-compose exec -ti  provalido.test_app npm run dev
enter:
	docker-compose exec -ti provalido.test_app bash

# Path: docker-compose.yml
