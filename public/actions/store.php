<?php

declare(strict_types=1);

require_once __DIR__ . '/../../src/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('/create.php');
}

verifyCsrfToken($_POST['csrf_token'] ?? null);
[$product, $errors] = ProductValidator::validate($_POST);

if ($errors !== []) {
    storeFormState($product, $errors);
    redirect('/create.php');
}

try {
    $productRepository->create($product);
    setFlash('success', 'Produto cadastrado com sucesso.');
} catch (mysqli_sql_exception $exception) {
    error_log('Product creation failed: ' . $exception->getMessage());
    storeFormState($product, []);
    setFlash('error', 'Não foi possível cadastrar o produto. Tente novamente.');
    redirect('/create.php');
}

redirect('/index.php');

