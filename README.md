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
 - composer install
 - php artisan migrate

 Utilizamos o mailhog para criar um servidor de e-mail local para teste. Caso deseje fazer o mesmo faça:

 - Acesse https://github.com/mailhog/MailHog/releases/
 - Assets baixe o arquivo referente ao seu sistema operacional. No meu caso que é windows eu baixei o MailHog_windows_amd64.exe
 - Execute o mesmo e ele vai abrir um terminal escutando uma porta específica
 - Para acessar no navegador você acessa localhost:porta_que_está_escutando, no meu caso é localhost:8025
 - Para saber qual é a porta que está sendo escutada vai ter uma linha no terminal mais ou menos assim 2025/04/24 18:17:46 Serving under http://0.0.0.0:8025/. Esse link depois do under é o que ele está escutando e a porta é o que está após os :.

 E para testar, configure o .env assim:

MAIL_MAILER=smtp
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="admin@rhmangnt.com.br"
MAIL_FROM_NAME="${APP_NAME}"

Em MAIL_FROM_ADDRESS coloque o que desejar, as unicas que importa mesmo são as 4 primeiras configurações onde mailer tem que ser smtp, host é o ip que informa ou localhost tanto faz, em port você pega no terminal a porta que está sendo escutada na linha 2025/04/24 18:40:25 [SMTP] Binding to address: 0.0.0.0:1025 que no meu caso é 1025

Depois vá até o arquivo web.php e crie a rota

Route::get('/teste-email', function () {
    try {
        Mail::raw('Teste de envio de e-mail', function(Message $message) {
            $message->to('teste@teste.com')
                    ->subject('Isso é um teste de envio')
                    ->from(env('MAIL_FROM_ADDRESS'));
        });
        return "E-mail enviado com sucesso!";
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});

Importando o Message e o Mail

use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

Caso estiver tudo correto, ao acessar a rota irá retornar a mensagem E-mail enviado com sucesso! se não vai mostrar a mensagem do erro que ocorrer.
