<?php

declare(strict_types=1);

$product = $product ?? [];
$errors = $errors ?? [];
$action = $action ?? '/actions/store.php';
$submitLabel = $submitLabel ?? 'Salvar produto';
?>
<form action="<?= e($action) ?>" method="post" class="product-form">
    <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">

    <?php if (isset($product['id'])): ?>
        <input type="hidden" name="id" value="<?= (int) $product['id'] ?>">
    <?php endif; ?>

    <div class="form-field">
        <label for="nome">Nome</label>
        <input
            id="nome"
            name="nome"
            type="text"
            maxlength="120"
            value="<?= e($product['nome'] ?? '') ?>"
            aria-describedby="nome-error"
            required
            autofocus
        >
        <?php if (isset($errors['nome'])): ?>
            <small class="field-error" id="nome-error"><?= e($errors['nome']) ?></small>
        <?php endif; ?>
    </div>

    <div class="form-field form-field-full">
        <label for="descricao">Descrição</label>
        <textarea
            id="descricao"
            name="descricao"
            rows="4"
            maxlength="1000"
            aria-describedby="descricao-hint descricao-error"
        ><?= e($product['descricao'] ?? '') ?></textarea>
        <small class="field-hint" id="descricao-hint">Opcional, até 1000 caracteres.</small>
        <?php if (isset($errors['descricao'])): ?>
            <small class="field-error" id="descricao-error"><?= e($errors['descricao']) ?></small>
        <?php endif; ?>
    </div>

    <div class="form-field">
        <label for="preco">Preço</label>
        <div class="input-prefix">
            <span>R$</span>
            <input
                id="preco"
                name="preco"
                type="number"
                inputmode="decimal"
                min="0.01"
                max="99999999.99"
                step="0.01"
                value="<?= e($product['preco'] ?? '') ?>"
                aria-describedby="preco-error"
                required
            >
        </div>
        <?php if (isset($errors['preco'])): ?>
            <small class="field-error" id="preco-error"><?= e($errors['preco']) ?></small>
        <?php endif; ?>
    </div>

    <div class="form-field">
        <label for="quantidade">Quantidade</label>
        <input
            id="quantidade"
            name="quantidade"
            type="number"
            inputmode="numeric"
            min="0"
            step="1"
            value="<?= e($product['quantidade'] ?? 0) ?>"
            aria-describedby="quantidade-error"
            required
        >
        <?php if (isset($errors['quantidade'])): ?>
            <small class="field-error" id="quantidade-error"><?= e($errors['quantidade']) ?></small>
        <?php endif; ?>
    </div>

    <div class="form-field">
        <label for="data_cadastro">Data de cadastro</label>
        <input
            id="data_cadastro"
            name="data_cadastro"
            type="date"
            value="<?= e($product['data_cadastro'] ?? '') ?>"
            aria-describedby="data-error"
            required
        >
        <?php if (isset($errors['data_cadastro'])): ?>
            <small class="field-error" id="data-error"><?= e($errors['data_cadastro']) ?></small>
        <?php endif; ?>
    </div>

    <div class="form-actions form-field-full">
        <button type="submit" class="button button-primary"><?= e($submitLabel) ?></button>
        <a href="/index.php" class="button button-secondary">Cancelar</a>
    </div>
</form>

