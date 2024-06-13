<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Projeto Laravel

Este é um projeto Laravel para gerenciamento de contratos e boletos.

## Requisitos

- PHP >= 7.4
- Composer
- Banco de dados MySQL

## Instalação

1. Clone o repositório:

   ```bash
   git clone https://github.com/seu-usuario/seu-repositorio.git
   cd seu-repositorio
2. Instale as dependências do Composer:
   ```bash
   composer install
3. Copie o arquivo .env.example para .env e configure suas variáveis de ambiente:
    ```bash
    cp .env.example .env
4. Gere a chave da aplicação:
   ```bash
   php artisan key:generate
5. Configure o banco de dados no arquivo .env:
   ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nome_do_banco
    DB_USERNAME=seu_usuario
    DB_PASSWORD=sua_senha
6. Execute as migrações e seeders para criar as tabelas e dados iniciais:
   ```bash
   php artisan migrate --seed
7. Inicie o servidor de desenvolvimento:
   ```bash
   php artisan serve

O projeto estará disponível em http://localhost:8000.

- Funcionalidades:
    * Gerenciamento de contratos
    * Criação e atualização de boletos
    * Integração com clientes
