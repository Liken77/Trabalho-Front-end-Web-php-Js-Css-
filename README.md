# StockFlow — Gerenciador de Produtos com PHP

Aplicação web para cadastro e controle simples de produtos, desenvolvida com **PHP, MySQL, HTML, CSS e JavaScript**. O sistema implementa um CRUD completo e pode ser executado localmente com Docker Compose.

O projeto nasceu como trabalho acadêmico no curso de **Análise e Desenvolvimento de Sistemas do IFRS Erechim** e foi posteriormente refatorado para melhorar organização, segurança e facilidade de execução.

## Funcionalidades

- cadastro, listagem, edição e exclusão de produtos;
- pesquisa instantânea pelo nome;
- controle de preço, quantidade e data de cadastro;
- indicação visual de produtos sem estoque;
- validação no navegador e no servidor;
- mensagens de sucesso e erro após as operações;
- interface responsiva e acessível.

## Melhorias aplicadas

A versão original foi preservada no histórico do Git. A estrutura atual inclui:

- separação entre código público e regras da aplicação;
- acesso ao banco centralizado em `Database`;
- operações SQL isoladas em `ProductRepository`;
- prepared statements em todas as entradas do usuário;
- escape de conteúdo exibido para reduzir riscos de XSS;
- token CSRF nas operações de escrita;
- exclusão somente por requisição `POST`;
- credenciais configuradas por variáveis de ambiente;
- ambiente reproduzível com PHP 8.3, Apache e MySQL 8.4.

## Tecnologias

- PHP 8.3;
- MySQL 8.4;
- MySQLi;
- HTML5, CSS3 e JavaScript;
- Docker e Docker Compose.

## Estrutura

```text
.
├── database/
│   └── schema.sql
├── .github/workflows/
│   └── php-quality.yml
├── docker/php/
│   └── Dockerfile
├── public/
│   ├── actions/
│   ├── assets/
│   ├── partials/
│   ├── create.php
│   ├── edit.php
│   └── index.php
├── src/
│   ├── Database.php
│   ├── ProductRepository.php
│   ├── ProductValidator.php
│   ├── bootstrap.php
│   └── helpers.php
├── .env.example
└── compose.yml
```

## Executando com Docker

Clone o repositório e entre na pasta do projeto:

```bash
git clone https://github.com/Liken77/Trabalho-Front-end-Web-php-Js-Css-.git
cd Trabalho-Front-end-Web-php-Js-Css-
```

Opcionalmente, crie seu arquivo de configuração:

```bash
cp .env.example .env
```

Suba a aplicação e o banco:

```bash
docker compose up --build -d
```

Acesse `http://localhost:8080`. O MySQL fica disponível na porta local `3307`.

Para encerrar:

```bash
docker compose down
```

Use `docker compose down -v` somente quando quiser remover também os dados locais.

## Executando sem Docker

Pré-requisitos: PHP 8.3 com a extensão MySQLi e MySQL 8.

1. Execute `database/schema.sql` no MySQL.
2. Configure `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER` e `DB_PASSWORD`.
3. Inicie o servidor apontando para a pasta pública:

```bash
php -S localhost:8080 -t public
```

## Verificação de sintaxe

```bash
find public src -name '*.php' -print0 | xargs -0 -n1 php -l
```

O workflow do GitHub Actions executa essa verificação, valida o arquivo do Docker Compose e constrói a imagem da aplicação em cada pull request.

## Contexto acadêmico

O objetivo da primeira versão era praticar a integração entre front-end, PHP e banco de dados. A refatoração mantém essa proposta simples, mas mostra a evolução do projeto em estrutura, tratamento de erros, segurança e documentação.

## Autor

**Pedro Henrique Andrade**  
Análise e Desenvolvimento de Sistemas — IFRS Erechim
