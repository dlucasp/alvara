# Requisitos

- PHP
- [Composer](https://getcomposer.org/doc/00-intro.md)
- MySql

# Instalação

- Copiar arquivo .env.example para .env
```shell script
cp .env.example .env
```
- Configuração banco de dados: 
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
- Instalação das dependecias
```shell script
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed # gerar usuário administrador
```

- Rodar o Servidor
```shell script
php -S 0.0.0.0:8000 -t public
```
ou
```shell script
php artisan serve
```

Acessar o Browser
- http:\\localhost:8000

