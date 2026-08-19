<?php

declare(strict_types=1);

require_once __DIR__ . '/../../src/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('/index.php');
}

verifyCsrfToken($_POST['csrf_token'] ?? null);
$id = positiveId($_POST['id'] ?? null);

if ($id === null) {
    setFlash('error', 'Produto inválido.');
    redirect('/index.php');
}

[$product, $errors] = ProductValidator::validate($_POST);

if ($errors !== []) {
    storeFormState($product, $errors);
    redirect('/edit.php?id=' . $id);
}

try {
    if (!$productRepository->update($id, $product)) {
        setFlash('error', 'Produto não encontrado.');
        redirect('/index.php');
    }

    setFlash('success', 'Produto atualizado com sucesso.');
} catch (mysqli_sql_exception $exception) {
    error_log('Product update failed: ' . $exception->getMessage());
    storeFormState($product, []);
    setFlash('error', 'Não foi possível atualizar o produto. Tente novamente.');
    redirect('/edit.php?id=' . $id);
}

redirect('/index.php');

