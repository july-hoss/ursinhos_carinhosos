
<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: paginas/Login.php");
    exit;
}

require_once "classes/Produto.php";

$produto = new Produto();

if (isset($_POST["cadastrar"])) {
    $produto->cadastrar(
        $_POST["nome"],
        $_POST["preco"],
        $_POST["quantidade"]
    );

    echo "Produto cadastrado com sucesso!";
}

$produtos = $produto->listar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Estoque de Produtos</title>
</head>
<body>

<h1>Cadastro de Produtos</h1>

<form method="POST">
    Nome:
    <input type="text" name="nome" required>
    <br><br>

    Preço:
    <input type="number" name="preco" step="0.01" min="0" required>
    <br><br>

    Quantidade:
    <input type="number" name="quantidade" min="0" required>
    <br><br>

    <button type="submit" name="cadastrar">
        Cadastrar Produto
    </button>
</form>

<hr>

<h2>Produtos cadastrados</h2>

<?php foreach ($produtos as $p) { ?>
    <p>
        Nome: <?= htmlspecialchars($p["nome"]) ?> |
        Preço: R$ <?= htmlspecialchars($p["preco"]) ?> |
        Quantidade: <?= htmlspecialchars($p["quantidade"]) ?>
    </p>
    
<a href="paginas/editar.php?id=<?= $p['id'] ?>">
    Editar
</a>

<form action="paginas/excluir.php" method="POST">
    <input type="hidden" name="id"
           value="<?= $p['id'] ?>">

    <button type="submit">Excluir</button>
</form>

<a href="sair.php">Sair do sistema</a>


<?php } ?>

</body>
</html>
