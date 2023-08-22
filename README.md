# Introduction
This project was installed and containerized using the Laravel docker instructions which can be found here. [Laravel Installation using Docker Compose on Linux](https://laravel.com/docs/10.x/installation#getting-started-on-linux)
# Setup
- Clone this repository into working directory.
- In the working directory execute the following command to populate the vendor directory.
```
docker run --rm --interactive --tty -v $(pwd):/app composer install
```
- Clone config repository to get .env file and copy into working directory.
- In working directory execute the following command to stand up project.
```
./vendor/bin/sail up
```
- Generate database schema by executing database migrations.
```
docker compose exec laravel.test php artisan migrate
```
# References
- Using Laravel w/ Docker [Laravel Sail](https://laravel.com/docs/10.x/sail#introduction)
- Xdebug w/ Laravel Sail [Setting up XDebug](https://laravel.com/docs/10.x/installation#getting-started-on-linux)
