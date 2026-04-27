up:
	docker compose -f docker-compose.yml up -d --build

down:
	docker compose -f docker-compose.yml down

composer:
	docker exec -it dev_php composer install

autoload:
	docker exec -it dev_php composer dump-autoload

db:
	docker exec -i dev_mysql mysql -uroot -proot < database/schema.sql

seed:
	docker exec -it dev_php php database/seed_categories.php
	docker exec -it dev_php php database/seed_posts.php

scss:
	docker exec -it dev_php sass resources/scss/style.scss public/css/style.css

watch:
	docker exec -it dev_php sass --watch resources/scss/style.scss:public/css/style.css

sleep:
	@sleep 5

dev: up watch

start: up sleep composer autoload db seed scss