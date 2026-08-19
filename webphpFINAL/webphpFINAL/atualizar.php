<?php
include "conexao.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
$nome = trim($_POST['nome'] ?? '');
$descricao = trim($_POST['descricao'] ?? '');
$preco = $_POST['preco'] ?? null;
$quantidade = filter_var($_POST['quantidade'] ?? null, FILTER_VALIDATE_INT);
$data = $_POST['data_cadastro'] ?? '';
$dataObj = DateTime::createFromFormat('Y-m-d', $data);
$dataValida = $dataObj && $dataObj->format('Y-m-d') === $data;

if (
    $id === false ||
    $id <= 0 ||
    $nome === '' ||
    strlen($nome) > 120 ||
    !is_numeric($preco) ||
    (float) $preco <= 0 ||
    $quantidade === false ||
    $quantidade < 0 ||
    !$dataValida
) {
    http_response_code(422);
    die('Dados inválidos. Volte e verifique o formulário.');
}

$preco = (float) $preco;

$sql = "UPDATE produtos SET nome = ?, descricao = ?, preco = ?, quantidade = ?, data_cadastro = ? WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    error_log('Erro ao preparar atualização: ' . mysqli_error($conn));
    http_response_code(500);
    die('Não foi possível atualizar o produto.');
}

mysqli_stmt_bind_param($stmt, "ssdisi", $nome, $descricao, $preco, $quantidade, $data, $id);

if (!mysqli_stmt_execute($stmt)) {
    error_log('Erro ao atualizar produto: ' . mysqli_stmt_error($stmt));
    mysqli_stmt_close($stmt);
    http_response_code(500);
    die('Não foi possível atualizar o produto.');
}

mysqli_stmt_close($stmt);
header("Location: index.php");
exit;
