## Instruções para rodar o projeto com php

-   Instale as dependências:

composer install

-   Rode o projeto

php artisan serve

O projeto irá rodar em localhost:8000

## Instruções para rodar o projeto com docker

-   Rode o docker

docker-compose up

## Comando para criar as tabelas

php artisan migrate

## Comando para popular a tabela Produtos

php artisan db:seed --class=ProdutoSeeder

O projeto irá rodar em localhost:8000
