
<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit;
}

require_once __DIR__ . "/../classes/Produto.php";

$produto = new Produto();
$mensagem = "";

if (isset($_POST["importar"]) &&
    isset($_FILES["arquivo"])) {

    $arquivo = fopen($_FILES["arquivo"]["tmp_name"], "r");

    if ($arquivo) {
        fgetcsv($arquivo); // Pula o cabeçalho

        while (($linha = fgetcsv($arquivo)) !== false) {
            if (count($linha) >= 3) {
                $produto->cadastrar(
                    $linha[0],
                    $linha[1],
                    $linha[2]
                );
            }
        }

        fclose($arquivo);
        $mensagem = "Importação concluída!";
    }
}
?>

<h1>Importar produtos</h1>

<p><?= htmlspecialchars($mensagem) ?></p>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="arquivo"
           accept=".csv" required>

    <button name="importar">Importar CSV</button>
</form>

<a href="../index.php">Voltar</a>
