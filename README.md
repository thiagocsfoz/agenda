## Requisitos

- PHP 7.4.3
- MariaDB 10.4.11 
- Laravel Framework 7.3.0
- Composer 1.10.1 
- Node v8.17.0

## Banco de dados
Abrir o .env na raiz do projeto e setar nos campos:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db
DB_USERNAME=root
DB_PASSWORD=******
```
os dados de conexão com o banco de dados

## Executar aplicação


Executar os seguintes comandos em ordem:
```
composer global require laravel/installer
composer install
npm install
php artisan migrate
php artisan serve
```
