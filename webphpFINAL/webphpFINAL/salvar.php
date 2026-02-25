<?php
/*conexão*/
include "conexao.php";
/*itens*/
$nome = trim($_POST['nome'] ?? '');
$descricao = trim($_POST['descricao'] ?? '');
$preco = $_POST['preco'] ?? 0;
$quantidade = $_POST['quantidade'] ?? 0;
$data = $_POST['data_cadastro'] ?? null;

if (strlen($nome) < 1 || !is_numeric($preco) || $preco <= 0 || !is_numeric($quantidade) || $quantidade < 0) {
    die("Dados inválidos. Volte e verifique o formulário.");
}
/*salvar no banco de dados*/
$sql = "INSERT INTO produtos (nome, descricao, preco, quantidade, data_cadastro) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssdis", $nome, $descricao, $preco, $quantidade, $data);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    header("Location: index.php");
    exit;
} else {
    mysqli_stmt_close($stmt);
    echo "Erro ao salvar: " . htmlspecialchars(mysqli_error($conn));
}
?>
