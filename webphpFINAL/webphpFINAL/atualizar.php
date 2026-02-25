<?php
include "conexao.php";

/*itens Gerais*/
$id = intval($_POST['id'] ?? 0);
$nome = trim($_POST['nome'] ?? '');
$descricao = trim($_POST['descricao'] ?? '');
$preco = $_POST['preco'] ?? 0;
$quantidade = $_POST['quantidade'] ?? 0;
$data = $_POST['data_cadastro'] ?? null;

/*Analise de dado*/
if ($id <= 0) {
    die('ID inválido');
}
if (strlen($nome) < 1 || !is_numeric($preco) || $preco <= 0 || !is_numeric($quantidade) || $quantidade < 0) {
    die('Dados inválidos.');
}

/*atualização de produto*/
$sql = "UPDATE produtos SET nome = ?, descricao = ?, preco = ?, quantidade = ?, data_cadastro = ? WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssdisi", $nome, $descricao, $preco, $quantidade, $data, $id);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    header("Location: index.php");
    exit;
} else {
    mysqli_stmt_close($stmt); /*Caso der erro*/
    echo "Erro ao atualizar: " . htmlspecialchars(mysqli_error($conn));
}
?>
