# 🧑‍💼 Sistema de Gerenciamento de RH - PHP com Laravel 11

Este é um sistema simples de gerenciamento de Recursos Humanos desenvolvido em **PHP**, com suporte a **MySQL** e **Laravel**. O sistema permite gerenciar colaboradores, cargos e departamentos.

## 🚀 Funcionalidades

- Cadastro de colaboradores
- Gestão de cargos e departamentos
- Login com autenticação por níveis de acesso (admin, RH, usuário)

## 🛠️ Tecnologias Utilizadas

- PHP 8.2+
- MySQL/MariaDB
- Laravel com fortify
- Bootstrap 5
- Composer (caso utilize bibliotecas)

## 📦 Instalação

1. Clone o repositório:
   ```bash
   git clone https://github.com/ras22lok/rh_mangnt
   cd rh_mangnt
Configure o banco de dados:

Crie um banco no MySQL com o nome que deseja

Configure o acesso ao banco: Edite o arquivo .env com os dados do seu banco:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nomedabasededados
DB_USERNAME=usuariodabasededados
DB_PASSWORD=senhadousuario

Instale as dependências via Composer e crie as tabelas do banco pelo terminal:

bash
composer install
php artisan migrate


