<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Bem-vindo</title></head>
<body>
    <h2>Olá, <?= $_SESSION['usuario'] ?>!</h2>
    <?php
    if (isset($_COOKIE['usuario'])) {
        echo "<p>Bem-vindo novamente, " . htmlspecialchars($_COOKIE['usuario']) . "!</p>";
    }
    ?>
    <a href="logout.php">Sair</a>
</body>
</html>
