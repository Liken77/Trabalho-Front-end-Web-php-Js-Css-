# Sistema de Gerenciamento de Produtos — PHP & MySQL

Projeto acadêmico desenvolvido durante o curso de **Análise e Desenvolvimento de Sistemas no IFRS Erechim** para praticar desenvolvimento web full stack com PHP e banco de dados relacional.

A aplicação implementa um CRUD de produtos, permitindo cadastrar, listar, pesquisar, editar e excluir registros de estoque através de uma interface web simples.

## Funcionalidades

- cadastro de produtos;
- listagem dos registros salvos no MySQL;
- pesquisa de produtos pelo nome no navegador;
- edição de produtos existentes;
- exclusão de registros com confirmação;
- validação de nome, preço e quantidade no front-end e no back-end;
- consultas parametrizadas com prepared statements nas operações que recebem dados do usuário.

## Tecnologias

- PHP;
- MySQL;
- HTML5;
- CSS3;
- JavaScript;
- Bootstrap 5;
- MySQLi.

## Estrutura principal

```text
webphpFINAL/webphpFINAL/
├── cadastrar.html
├── editar.php
├── atualizar.php
├── excluir.php
├── salvar.php
├── index.php
├── conexao.php
├── css/
├── js/
└── img/

database/
└── schema.sql
```

> A estrutura de diretórios original do trabalho acadêmico foi preservada no histórico do projeto. Uma reorganização completa pode ser feita em uma evolução futura.

## Banco de dados

O script para criação do banco e da tabela está disponível em:

```text
database/schema.sql
```

Por padrão, a aplicação utiliza:

- host: `localhost`;
- porta: `3306`;
- banco: `webfinal`;
- usuário: `root`;
- senha vazia.

Esses valores podem ser substituídos pelas variáveis de ambiente `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER` e `DB_PASSWORD`.

## Executando localmente

### 1. Crie o banco

Execute o arquivo `database/schema.sql` no MySQL.

### 2. Configure o acesso ao MySQL

Se sua instalação não utiliza os valores padrão, configure as variáveis de ambiente antes de iniciar o servidor.

Exemplo no Linux/macOS:

```bash
export DB_HOST=localhost
export DB_PORT=3306
export DB_NAME=webfinal
export DB_USER=root
export DB_PASSWORD=sua_senha
```

### 3. Inicie o servidor PHP

Na raiz do repositório:

```bash
php -S localhost:8000 -t webphpFINAL/webphpFINAL
```

Depois acesse `http://localhost:8000` no navegador.

## Contexto acadêmico

Este projeto foi criado como trabalho de desenvolvimento web e representa uma etapa da minha evolução prática com integração entre **front-end, PHP e banco de dados**. A proposta atual do repositório é manter esse histórico, mas com documentação e práticas mais claras para apresentação em portfólio.

## Autor

**Pedro Henrique Andrade**  
Análise e Desenvolvimento de Sistemas — IFRS Erechim
