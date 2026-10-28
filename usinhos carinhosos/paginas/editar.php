
<?php
require_once __DIR__ . "/../classes/Produto.php";

$produto = new Produto();

if (isset($_POST["salvar"])) {
    $produto->editar(
        $_POST["id"],
        $_POST["nome"],
        $_POST["preco"],
        $_POST["quantidade"]
    );

    header("Location: ../index.php");
    exit;
}

$id = $_GET["id"] ?? "";
?>

<h1>Editar produto</h1>

<form method="POST">
    <input type="hidden" name="id"
           value="<?= htmlspecialchars($id) ?>">

    Nome:
    <input name="nome" required>

    Preço:
    <input type="number" name="preco"
           step="0.01" min="0" required>

    Quantidade:
    <input type="number" name="quantidade"
           min="0" required>

    <button name="salvar">Salvar alterações</button>
</form>
