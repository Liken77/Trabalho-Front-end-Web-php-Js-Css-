<?php
include "conexao.php";

$sql = "SELECT id, nome, preco, quantidade, data_cadastro FROM produtos ORDER BY id DESC";
$res = mysqli_query($conn, $sql);

if (!$res) {
    error_log('Erro ao listar produtos: ' . mysqli_error($conn));
    die('Não foi possível carregar os produtos.');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gerenciamento de Produtos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style2.css">
</head>
<body class="p-4">
    <main class="container">
        <header class="mb-4">
            <h1 class="h3">Sistema de Gerenciamento de Produtos</h1>
            <p class="text-muted">
                Projeto acadêmico para controle simples de estoque, com cadastro, pesquisa,
                edição e exclusão de produtos utilizando PHP e MySQL.
            </p>
        </header>

        <section aria-labelledby="produtos-cadastrados">
            <div class="d-flex flex-column flex-md-row gap-2 justify-content-between align-items-md-center mb-3">
                <h2 class="h4 mb-0" id="produtos-cadastrados">Produtos cadastrados</h2>
                <a href="cadastrar.html" class="btn btn-primary">Novo produto</a>
            </div>

            <label for="pesquisa" class="form-label">Pesquisar pelo nome</label>
            <input
                type="search"
                id="pesquisa"
                class="form-control mb-3"
                placeholder="Digite o nome do produto..."
                autocomplete="off"
            >

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Data</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                            <tr>
                                <td><?php echo (int) $row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td>R$ <?php echo number_format((float) $row['preco'], 2, ',', '.'); ?></td>
                                <td><?php echo (int) $row['quantidade']; ?></td>
                                <td><?php echo htmlspecialchars($row['data_cadastro'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="text-nowrap">
                                    <a href="editar.php?id=<?php echo (int) $row['id']; ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                                    <form
                                        action="excluir.php"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Deseja realmente excluir este produto?');"
                                    >
                                        <input type="hidden" name="id" value="<?php echo (int) $row['id']; ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script src="js/index.js"></script>
</body>
</html>
