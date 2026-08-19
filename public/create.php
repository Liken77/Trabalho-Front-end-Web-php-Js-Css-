<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/bootstrap.php';

[$oldData, $errors] = consumeFormState();
$flash = consumeFlash();
$product = array_merge([
    'nome' => '',
    'descricao' => '',
    'preco' => '',
    'quantidade' => 0,
    'data_cadastro' => date('Y-m-d'),
], $oldData);

$pageTitle = 'Cadastrar produto';
$action = '/actions/store.php';
$submitLabel = 'Cadastrar produto';

require __DIR__ . '/partials/header.php';
?>
<section class="form-page">
    <a href="/index.php" class="back-link">← Voltar para produtos</a>
    <div class="form-heading">
        <span class="eyebrow">Novo registro</span>
        <h1>Cadastrar produto</h1>
        <p>Preencha os dados abaixo para adicionar um item ao estoque.</p>
    </div>
    <?php if ($flash): ?>
        <div class="alert alert-<?= e($flash['type']) ?>" role="status">
            <?= e($flash['message']) ?>
        </div>
    <?php endif; ?>
    <?php require __DIR__ . '/partials/product-form.php'; ?>
</section>
<?php require __DIR__ . '/partials/footer.php'; ?>
