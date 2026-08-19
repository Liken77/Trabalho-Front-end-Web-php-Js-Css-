<?php

declare(strict_types=1);

$pageTitle = $pageTitle ?? 'StockFlow';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Gerenciador de produtos e estoque desenvolvido com PHP e MySQL.">
    <title><?= e($pageTitle) ?> | StockFlow</title>
    <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body>
    <header class="site-header">
        <div class="container header-content">
            <a class="brand" href="/index.php" aria-label="Página inicial do StockFlow">
                <span class="brand-mark" aria-hidden="true">SF</span>
                <span>
                    <strong>StockFlow</strong>
                    <small>Controle simples de produtos</small>
                </span>
            </a>
        </div>
    </header>
    <main class="container page-content">

