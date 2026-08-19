<?php
include "conexao.php";

$id = intval($_GET['id'] ?? 0);

if ($id <= 0) {
    header("Location: index.php");
    exit;
}

$sql = "SELECT id, nome, descricao, preco, quantidade, data_cadastro FROM produtos WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($res);
mysqli_stmt_close($stmt);

if (!$row) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar produto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style3.css">
</head>
<body class="p-4">
    <main class="container" style="max-width: 760px;">
        <h1 class="h3 mb-4">Editar produto</h1>

        <form action="atualizar.php" method="POST" onsubmit="return validar()" id="form-editar">
            <input type="hidden" name="id" value="<?php echo (int) $row['id']; ?>">

            <div class="mb-3">
                <label class="form-label" for="nome">Nome</label>
                <input class="form-control" type="text" id="nome" name="nome" maxlength="120" required value="<?php echo htmlspecialchars($row['nome'], ENT_QUOTES, 'UTF-8'); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label" for="descricao">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="4"><?php echo htmlspecialchars($row['descricao'], ENT_QUOTES, 'UTF-8'); ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label" for="preco">Preço</label>
                <input class="form-control" id="preco" type="number" name="preco" step="0.01" min="0.01" required value="<?php echo htmlspecialchars($row['preco'], ENT_QUOTES, 'UTF-8'); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label" for="quantidade">Quantidade</label>
                <input class="form-control" id="quantidade" type="number" name="quantidade" min="0" step="1" required value="<?php echo (int) $row['quantidade']; ?>">
            </div>

            <div class="mb-4">
                <label class="form-label" for="data_cadastro">Data de cadastro</label>
                <input class="form-control" id="data_cadastro" type="date" name="data_cadastro" required value="<?php echo htmlspecialchars($row['data_cadastro'], ENT_QUOTES, 'UTF-8'); ?>">
            </div>

            <button class="btn btn-primary" type="submit">Atualizar</button>
            <a class="btn btn-secondary" href="index.php">Cancelar</a>
        </form>
    </main>

    <script src="js/index2.js"></script>
</body>
</html>
