
<?php
require_once __DIR__ . "/../config/Conexao.php";

class Produto {
    private $banco;

    public function __construct() {
        $conexao = new Conexao();
        $this->banco = $conexao->conectar();
    }

    public function cadastrar($nome, $preco, $quantidade) {
        $sql = "INSERT INTO produtos
                (nome, preco, quantidade)
                VALUES (?, ?, ?)";

        $consulta = $this->banco->prepare($sql);

        return $consulta->execute([
            $nome,
            $preco,
            $quantidade
        ]);
    }

    public function listar() {
        $sql = "SELECT * FROM produtos ORDER BY id DESC";
        return $this->banco->query($sql)->fetchAll();
    }
}
?>
