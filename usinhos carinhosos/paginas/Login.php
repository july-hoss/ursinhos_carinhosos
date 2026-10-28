
<?php
session_start();

require_once __DIR__ . "/../config/Conexao.php";

$erro = "";

if (isset($_POST["entrar"])) {
    $conexao = (new Conexao())->conectar();

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $consulta = $conexao->prepare($sql);
    $consulta->execute([$_POST["email"]]);

    $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

    if (
        $usuario &&
        hash("sha256", $_POST["senha"]) === $usuario["senha"]
    ) {
        session_regenerate_id(true);
        $_SESSION["usuario"] = $usuario["nome"];

        header("Location: Produtos.php");
        exit;
    } else {
        $erro = "E-mail ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

<h1>Entrar no sistema</h1>

<p><?= htmlspecialchars($erro) ?></p>

<form method="POST">
    <input type="email" name="email"
           placeholder="Seu e-mail" required>
    <br><br>

    <input type="password" name="senha"
           placeholder="Sua senha" required>
    <br><br>

    <button type="submit" name="entrar">
        Entrar
    </button>
</form>

</body>
</html>
