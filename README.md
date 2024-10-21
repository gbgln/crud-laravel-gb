# CRUD php

Projeto criado com base na especificação provida no seguinte link:
https://github.com/marcelodrachler/testepratico

## Requisitos

Para rodar este projeto Laravel, você precisará das seguintes dependências:

- **PHP** >= 8.x
- **Composer** >= 2.x
- **Laravel** >= 10.x
- **MySQL** 

## Instalação

### 1. Clonar o Repositório

Primeiro, clone o repositório para a sua máquina local:
```bash
git clone https://github.com/gbgln/crud-laravel-gb.git 

cd nome-do-repositorio

### 2. Instalar Dependências do PHP
Rode o comando abaixo para instalar as dependências do Laravel:

composer install

### 3. Configurar Variáveis de Ambiente
Renomeie o arquivo .env.example para .env e configure suas variáveis de ambiente, incluindo as credenciais de conexão com o banco de dados.

cp .env.example .env


### 4. Configurar Banco de Dados
Configure suas credenciais de banco de dados no arquivo .env. Exemplo:

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=nome_do_banco

DB_USERNAME=seu_usuario

DB_PASSWORD=sua_senha


### 5. Rodar Migrações
Execute as migrações para criar as tabelas no banco de dados:

php artisan migrate

### 6. Rodar o Projeto Localmente
Finalmente, rode o servidor de desenvolvimento:

php artisan serve

O servidor estará disponível em http://127.0.0.1:8000

### Funcionalidades
#### Autenticação: O sistema permite cadastro e login de usuários.
#### Gestão de Usuários: Administradores podem visualizar, editar e remover qualquer usuário cadastrado. Usuários comuns apenas podem editar seu próprio usuário.
**Para a criação de um usuário ADMIN, é necessário informar uma senha especial, que será configurada e salva no arquivo .env (tag SUPER_SENHA)
#### Sistema de Perfis: Diferencia usuários comuns e administradores, com permissões específicas para cada tipo.
#### Seções Protegidas: Apenas usuários autenticados podem acessar determinadas seções do sistema.


Tecnologias Utilizadas:
Laravel - Framework PHP
Bootstrap - Framework CSS
MySQL - Banco de dados relacional

Sistema criado com base e auxilio dos seguintes videos, além de pesquisas em blogs de internet, StackOverflow e chatGPT:

https://www.youtube.com/watch?v=cDEVWbz2PpQ&t=2866s&ab_channel=LearnWebCode

https://www.youtube.com/watch?v=_LA9QsgJ0bw&t=1981s&ab_channel=Devtamin
