<?php
include "conexao.php";
$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    header("Location: index.php");
    exit;
}

$sql = "SELECT * FROM produtos WHERE id = ?";
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
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Editar produto</title>
<!--desgine-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="css/style3.css">
</head>
<body class="p-4">
<div class="container">
    <!--Corpo principal-->
    <h2>Editar produto</h2>
  <form action="atualizar.php" method="POST" onsubmit="return validar()" id="coreditar">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
        Nome: <input class="form-control" type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($row['nome']); ?>"><br>
        Nome do Pet: <textarea class="form-control" id="descricao" name="descricao"><?php echo htmlspecialchars($row['descricao']); ?></textarea><br>
        Preço: <input class="form-control" id="preco" type="number" name="preco" step="0.01" value="<?php echo htmlspecialchars($row['preco']); ?>"><br>
        Quantidade <input class="form-control" id="quantidade" type="number" name="quantidade" value="<?php echo htmlspecialchars($row['quantidade']); ?>"><br>
        Data: <input class="form-control" id="data" type="date" name="data_cadastro" value="<?php echo htmlspecialchars($row['data_cadastro']); ?>"><br>
        <button class="btn btn-primary" type="submit">Atualizar</button>
        <a class="btn btn-secondary" href="index.php">Voltar</a>
    </form>
</div>
<!--Link do js-->
<script src="js/index2.js"></script>
</body>
</html>
