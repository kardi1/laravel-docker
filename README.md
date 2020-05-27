necessário ter docker e docker-compose instalado

git clone https://github.com/kardi1/laravel-docker.git loginlog

cd loginlog

cp src/env.example src/.env

docker-compose up -d --build

docker-compose run --rm composer install

docker-compose run --rm npm install

docker-compose run --rm npm run dev

docker-compose run --rm artisan migrate

docker-compose run -rm artisan db:seed --class=UserSeeder

docker-compose run -rm artisan db:seed --class=UseraccessSeeder

docker-compose run --rm nginx chmod -R 777 /var/www/html/storage/
