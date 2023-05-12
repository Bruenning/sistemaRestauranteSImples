## Projeto para teste da Empresa Digitaliza


## Comandos para executar:

```bash

# criar .env
$ cp .env.example .env

# configurar .env localHost pois o projeto foi desenvolvido em ambiente
# local com o wamp Laragon que utilizar o nome da pasta do projeto como url
$ nano .env

# Instale as dependências
$ npm install
$ composer install


# Execute as migrações
$ php artisan migrate:fresh --seed

# instalar passport
$ php artisan passport:install

# gerar chave
$ php artisan key:generate

# Execute a aplicação em modo de desenvolvimento
$ npm run dev
