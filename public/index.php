<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/bootstrap.php';

$products = $productRepository->findAll();
$flash = consumeFlash();
$pageTitle = 'Produtos';

require __DIR__ . '/partials/header.php';
?>
<section class="hero">
    <div>
        <span class="eyebrow">Gerenciamento de estoque</span>
        <h1>Produtos cadastrados</h1>
        <p>Cadastre, consulte e atualize os itens do estoque em uma interface simples.</p>
    </div>
    <a href="/create.php" class="button button-primary">Novo produto</a>
</section>

<?php if ($flash): ?>
    <div class="alert alert-<?= e($flash['type']) ?>" role="status">
        <?= e($flash['message']) ?>
    </div>
<?php endif; ?>

<section class="panel" aria-labelledby="products-heading">
    <div class="panel-header">
        <div>
            <h2 id="products-heading">Estoque</h2>
            <p><?= count($products) ?> produto(s) encontrado(s)</p>
        </div>
        <div class="search-field">
            <label class="sr-only" for="product-search">Pesquisar produtos</label>
            <input
                id="product-search"
                type="search"
                placeholder="Pesquisar pelo nome..."
                autocomplete="off"
                data-product-search
            >
        </div>
    </div>

    <?php if ($products === []): ?>
        <div class="empty-state">
            <strong>Nenhum produto cadastrado.</strong>
            <p>Crie o primeiro item para começar a organizar o estoque.</p>
            <a href="/create.php" class="button button-primary">Cadastrar produto</a>
        </div>
    <?php else: ?>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th scope="col">Produto</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Cadastro</th>
                        <th scope="col" class="actions-column">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr
                            data-product-row
                            data-product-name="<?= e($product['nome']) ?>"
                        >
                            <td>
                                <strong><?= e($product['nome']) ?></strong>
                                <?php if (!empty($product['descricao'])): ?>
                                    <small><?= e($product['descricao']) ?></small>
                                <?php endif; ?>
                            </td>
                            <td>R$ <?= number_format((float) $product['preco'], 2, ',', '.') ?></td>
                            <td>
                                <span class="stock-badge <?= (int) $product['quantidade'] === 0 ? 'stock-empty' : '' ?>">
                                    <?= (int) $product['quantidade'] ?> un.
                                </span>
                            </td>
                            <td><?= e(date('d/m/Y', strtotime($product['data_cadastro']))) ?></td>
                            <td class="row-actions">
                                <a href="/edit.php?id=<?= (int) $product['id'] ?>" class="button button-small button-secondary">
                                    Editar
                                </a>
                                <form action="/actions/delete.php" method="post" data-confirm-delete>
                                    <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
                                    <input type="hidden" name="id" value="<?= (int) $product['id'] ?>">
                                    <button type="submit" class="button button-small button-danger">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <p class="no-results" data-no-results hidden>Nenhum produto corresponde à pesquisa.</p>
    <?php endif; ?>
</section>
<?php require __DIR__ . '/partials/footer.php'; ?>
