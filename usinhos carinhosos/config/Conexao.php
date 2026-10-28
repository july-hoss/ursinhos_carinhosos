
<?php
Class Conexao {
    public function conectar() {
        $conexao = new PDO(
            "mysql:host=localhost;dbname=sistema_estoque;charset=utf8mb4",
            "root",
                        ""

        );

        return $conexao;
    }
}
?>