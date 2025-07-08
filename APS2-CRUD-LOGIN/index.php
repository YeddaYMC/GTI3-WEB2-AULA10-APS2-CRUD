<?php
require 'seguranca.php';

// Proteção: Chamar função
protegePagina();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Página Principal</title>
</head>

<body>
    <!-- Sessão: Exibir dados do usuário -->
    <h1>Bem-vindo ao sistema, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</h1>
    <p>Esta é a área restrita do sistema. Você está logado como: <strong><?php echo htmlspecialchars($_SESSION['usuario_login']); ?></strong>.</p>
    <p><a href="logout.php">Sair do Sistema</a></p>
</body>

</html>