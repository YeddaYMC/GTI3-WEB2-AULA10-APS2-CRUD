<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .success {
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 4px;
        }

        .error {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <h2>Acesso ao Sistema</h2>

    <?php
    // Erro: Exibir mensagem
    if (isset($_GET['erro'])) {
        echo "<p class='error'>Login inválido. Por favor, tente novamente.</p>";
    }
    if (isset($_GET['sucesso'])) {
        echo "<p class='success'>Cadastro realizado com sucesso! Faça o login.</p>";
    }
    ?>

    <!-- Formulário: Login -->
    <form method="post" action="valida.php">
        <label for="usuario">Usuário:</label><br>
        <input type="text" id="usuario" name="usuario" required><br><br>
        <label for="senha">Senha:</label><br>
        <input type="password" id="senha" name="senha" required><br><br>
        <button type="submit">Entrar</button>
    </form>
    <p><a href="cadastro.php">Não tem uma conta? Cadastre-se</a></p>
</body>

</html>