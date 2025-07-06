<?php
session_start();
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

try {
    $pdo = new PDO("mysql:host=localhost;dbname=sistema_login", "root", "");

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $dados = $stmt->fetch();
        if (password_verify($senha, $dados['senha'])) {
            session_regenerate_id(true);
            $_SESSION['usuario'] = $dados['usuario'];

            // Define o cookie com nome do usuário por 1 hora
            setcookie("usuario", $dados['usuario'], time() + 3600, "/");

            header("Location: index.php");
            exit;
        }
    }

    header("Location: login.php?erro=1");
    exit;

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
