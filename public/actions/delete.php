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

try {
    $deleted = $productRepository->delete($id);
    setFlash(
        $deleted ? 'success' : 'error',
        $deleted ? 'Produto excluído com sucesso.' : 'Produto não encontrado.'
    );
} catch (mysqli_sql_exception $exception) {
    error_log('Product deletion failed: ' . $exception->getMessage());
    setFlash('error', 'Não foi possível excluir o produto. Tente novamente.');
}

redirect('/index.php');

