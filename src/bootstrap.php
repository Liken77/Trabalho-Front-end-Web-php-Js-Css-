<?php

declare(strict_types=1);

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/ProductRepository.php';
require_once __DIR__ . '/ProductValidator.php';
require_once __DIR__ . '/helpers.php';

session_set_cookie_params([
    'httponly' => true,
    'samesite' => 'Lax',
    'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
]);
session_start();

try {
    $connection = Database::connect();
    $productRepository = new ProductRepository($connection);
} catch (mysqli_sql_exception $exception) {
    error_log('Database connection failed: ' . $exception->getMessage());
    http_response_code(503);
    exit('Não foi possível conectar ao banco de dados. Tente novamente em instantes.');
}

