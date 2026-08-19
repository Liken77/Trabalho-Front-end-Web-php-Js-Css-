<?php
include "conexao.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: cadastrar.html");
    exit;
}

$nome = trim($_POST['nome'] ?? '');
$descricao = trim($_POST['descricao'] ?? '');
$preco = $_POST['preco'] ?? null;
$quantidade = filter_var($_POST['quantidade'] ?? null, FILTER_VALIDATE_INT);
$data = $_POST['data_cadastro'] ?? '';
$dataObj = DateTime::createFromFormat('Y-m-d', $data);
$dataValida = $dataObj && $dataObj->format('Y-m-d') === $data;

if (
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

$sql = "INSERT INTO produtos (nome, descricao, preco, quantidade, data_cadastro) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    error_log('Erro ao preparar cadastro: ' . mysqli_error($conn));
    http_response_code(500);
    die('Não foi possível salvar o produto.');
}

mysqli_stmt_bind_param($stmt, "ssdis", $nome, $descricao, $preco, $quantidade, $data);

if (!mysqli_stmt_execute($stmt)) {
    error_log('Erro ao salvar produto: ' . mysqli_stmt_error($stmt));
    mysqli_stmt_close($stmt);
    http_response_code(500);
    die('Não foi possível salvar o produto.');
}

mysqli_stmt_close($stmt);
header("Location: index.php");
exit;
