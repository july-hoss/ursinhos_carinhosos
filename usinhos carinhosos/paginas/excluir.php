
<?php
require_once __DIR__ . "/../classes/Produto.php";

$produto = new Produto();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $produto->excluir($_POST["id"]);
}

header("Location: ../index.php");
exit;
?>
