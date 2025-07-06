<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Login</title></head>
<body>
    <form method="post" action="valida.php">
        <label>Usuário:</label>
        <input type="text" name="usuario" required><br>
        <label>Senha:</label>
        <input type="password" name="senha" required><br>
        <button type="submit">Entrar</button>
    </form>
    <?php if (isset($_GET['erro'])) echo "<p style='color:red;'>Login inválido.</p>"; ?>
</body>
</html>
