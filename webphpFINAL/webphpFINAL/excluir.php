<?php
/*conexão ao banco*/
include "conexao.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$id = intval($_POST['id'] ?? 0);
if ($id <= 0) {
    header("Location: index.php");
    exit;
}

/*Parte de deletar do banco*/
$sql = "DELETE FROM produtos WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    header("Location: index.php");
    exit;
} else {
    mysqli_stmt_close($stmt);
    echo "Erro ao excluir: " . htmlspecialchars(mysqli_error($conn));
}
?>
