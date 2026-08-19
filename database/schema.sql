CREATE DATABASE IF NOT EXISTS webfinal
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE webfinal;

CREATE TABLE IF NOT EXISTS produtos (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nome VARCHAR(120) NOT NULL,
    descricao TEXT NULL,
    preco DECIMAL(10,2) NOT NULL,
    quantidade INT UNSIGNED NOT NULL DEFAULT 0,
    data_cadastro DATE NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    CONSTRAINT chk_produtos_preco_positivo CHECK (preco > 0)
);

-- Dados opcionais para teste
INSERT INTO produtos (nome, descricao, preco, quantidade, data_cadastro)
SELECT 'Ração Premium', 'Produto de demonstração para validar a instalação.', 89.90, 10, CURRENT_DATE
WHERE NOT EXISTS (
    SELECT 1 FROM produtos WHERE nome = 'Ração Premium'
);
