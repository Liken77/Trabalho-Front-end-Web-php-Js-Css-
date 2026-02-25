<?php  
include "conexao.php";

$sql = "SELECT * FROM produtos ORDER BY id DESC";
$res = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de produtos</title>
   <!--Desginer do projeto-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style2.css">
    
</head>

<body class="p-4">
    <!--cabeça do projeto-->
<h3>Mercado Pet Vida – Sistema de Gerenciamento de Produtos</h3>
<p>O Supermercado Bom Preço é um estabelecimento voltado ao varejo alimentar, oferecendo uma grande variedade de produtos que vão desde alimentos perecíveis e não perecíveis até itens de limpeza, higiene pessoal e utilidades domésticas. Com um fluxo constante de mercadorias entrando e saindo, manter o controle de estoque sempre atualizado se torna essencial para garantir eficiência, evitar perdas e oferecer ao cliente um atendimento de qualidade.

Pensando nessa necessidade, foi desenvolvido este sistema simples e intuitivo para auxiliar o gerente do supermercado no gerenciamento dos produtos cadastrados. A ferramenta funciona como um painel administrativo, onde o gerente pode adicionar, editar, consultar e excluir produtos de maneira rápida e organizada. Cada item pode ser registrado com informações como nome, descrição, preço, quantidade em estoque e data de cadastro.</p>
 <img src="img/mecado.png" alt="mercado" id="imagem">
<h2>Produtos Cadastrados</h2>

<!--Procurar produto por js-->
<input  type="text" id="pesquisa" class="form-control mb-3" placeholder="Pesquisar produto..."
>
<!--novo produto-->
<a href="cadastrar.html" class="btn btn-primary mb-3">Novo produto</a>

<table class="table table-bordered table-striped">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Preço</th>
        <th>Quantidade</th>
        <th>Data</th>
        <th>Ações</th>
    </tr>


    <!--Produtor por php/ligação-->
<?php while ($row = mysqli_fetch_assoc($res)) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['nome']); ?></td>
        <td><?php echo $row['preco']; ?></td>
        <td><?php echo $row['quantidade']; ?></td>
        <td><?php echo $row['data_cadastro']; ?></td>

        <td>
            <!--Botões de editar e excluir-->
            <a href="editar.php?id=<?php echo $row['id']; ?>" class="butao">Editar</a>
            <form action="excluir.php" method="POST" style="display:inline-block">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
               <button type="submit" class="butao">Excluir</button>
            </form>
        </td>
    </tr>
<?php } ?>

</table>
<script src="js/index.js"></script>
</body>
</html>
