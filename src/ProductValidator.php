<?php

declare(strict_types=1);

final class ProductValidator
{
    public static function validate(array $input): array
    {
        $name = trim((string) ($input['nome'] ?? ''));
        $description = trim((string) ($input['descricao'] ?? ''));
        $rawPrice = str_replace(',', '.', trim((string) ($input['preco'] ?? '')));
        $quantity = filter_var($input['quantidade'] ?? null, FILTER_VALIDATE_INT);
        $date = trim((string) ($input['data_cadastro'] ?? ''));

        $errors = [];

        if ($name === '') {
            $errors['nome'] = 'Informe o nome do produto.';
        } elseif (strlen($name) > 120) {
            $errors['nome'] = 'O nome deve ter no máximo 120 caracteres.';
        }

        if (strlen($description) > 1000) {
            $errors['descricao'] = 'A descrição deve ter no máximo 1000 caracteres.';
        }

        if (!preg_match('/^(?:0|[1-9]\d{0,7})(?:\.\d{1,2})?$/', $rawPrice)
            || (float) $rawPrice <= 0) {
            $errors['preco'] = 'Informe um preço maior que zero, com até duas casas decimais.';
        }

        if ($quantity === false || $quantity < 0) {
            $errors['quantidade'] = 'A quantidade deve ser um número inteiro igual ou maior que zero.';
        }

        $parsedDate = DateTimeImmutable::createFromFormat('!Y-m-d', $date);
        if (!$parsedDate || $parsedDate->format('Y-m-d') !== $date) {
            $errors['data_cadastro'] = 'Informe uma data válida.';
        }

        $product = [
            'nome' => $name,
            'descricao' => $description,
            'preco' => is_numeric($rawPrice)
                ? number_format((float) $rawPrice, 2, '.', '')
                : $rawPrice,
            'quantidade' => $quantity === false ? (string) ($input['quantidade'] ?? '') : $quantity,
            'data_cadastro' => $date,
        ];

        return [$product, $errors];
    }
}

