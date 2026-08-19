<?php

declare(strict_types=1);

final class ProductRepository
{
    public function __construct(private readonly mysqli $connection)
    {
    }

    public function findAll(): array
    {
        $query = 'SELECT id, nome, descricao, preco, quantidade, data_cadastro
                  FROM produtos
                  ORDER BY id DESC';

        return $this->connection->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function findById(int $id): ?array
    {
        $statement = $this->connection->prepare(
            'SELECT id, nome, descricao, preco, quantidade, data_cadastro
             FROM produtos
             WHERE id = ?'
        );
        $statement->bind_param('i', $id);
        $statement->execute();

        $product = $statement->get_result()->fetch_assoc();
        $statement->close();

        return $product ?: null;
    }

    public function create(array $product): void
    {
        $statement = $this->connection->prepare(
            'INSERT INTO produtos (nome, descricao, preco, quantidade, data_cadastro)
             VALUES (?, ?, ?, ?, ?)'
        );
        $statement->bind_param(
            'sssis',
            $product['nome'],
            $product['descricao'],
            $product['preco'],
            $product['quantidade'],
            $product['data_cadastro']
        );
        $statement->execute();
        $statement->close();
    }

    public function update(int $id, array $product): bool
    {
        $statement = $this->connection->prepare(
            'UPDATE produtos
             SET nome = ?, descricao = ?, preco = ?, quantidade = ?, data_cadastro = ?
             WHERE id = ?'
        );
        $statement->bind_param(
            'sssisi',
            $product['nome'],
            $product['descricao'],
            $product['preco'],
            $product['quantidade'],
            $product['data_cadastro'],
            $id
        );
        $statement->execute();
        $changed = $statement->affected_rows > 0;
        $statement->close();

        return $changed || $this->findById($id) !== null;
    }

    public function delete(int $id): bool
    {
        $statement = $this->connection->prepare('DELETE FROM produtos WHERE id = ?');
        $statement->bind_param('i', $id);
        $statement->execute();
        $deleted = $statement->affected_rows > 0;
        $statement->close();

        return $deleted;
    }
}
