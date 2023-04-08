
up :
	docker-compose up -d
down :
	docker-compose down
down-v :
	docker-compose down -v
init :
	docker-compose run  --rm  provalido.test_app composer install
	docker-compose run  --rm  provalido.test_app npm install
	docker-compose run  --rm  provalido.test_app php artisan key:generate
	docker-compose run  --rm  provalido.test_app php artisan migrate --seed

run-dev :
	docker-compose run  --rm  provalido.test_app npm run dev

# Path: docker-compose.yml
