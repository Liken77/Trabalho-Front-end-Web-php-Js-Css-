<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/bootstrap.php';

$id = positiveId($_GET['id'] ?? null);
if ($id === null) {
    setFlash('error', 'Produto inválido.');
    redirect('/index.php');
}

$storedProduct = $productRepository->findById($id);
if ($storedProduct === null) {
    setFlash('error', 'Produto não encontrado.');
    redirect('/index.php');
}

[$oldData, $errors] = consumeFormState();
$flash = consumeFlash();
$product = array_merge($storedProduct, $oldData, ['id' => $id]);

$pageTitle = 'Editar produto';
$action = '/actions/update.php';
$submitLabel = 'Salvar alterações';

require __DIR__ . '/partials/header.php';
?>
<section class="form-page">
    <a href="/index.php" class="back-link">← Voltar para produtos</a>
    <div class="form-heading">
        <span class="eyebrow">Produto #<?= $id ?></span>
        <h1>Editar produto</h1>
        <p>Atualize as informações e salve as alterações.</p>
    </div>
    <?php if ($flash): ?>
        <div class="alert alert-<?= e($flash['type']) ?>" role="status">
            <?= e($flash['message']) ?>
        </div>
    <?php endif; ?>
    <?php require __DIR__ . '/partials/product-form.php'; ?>
</section>
<?php require __DIR__ . '/partials/footer.php'; ?>
