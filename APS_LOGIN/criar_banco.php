<?php
// Conecta ao MySQL (sem banco ainda)
$conexao = new PDO("mysql:host=localhost", "root", "");

// Cria o banco de dados, se não existir
$conexao->exec("CREATE DATABASE IF NOT EXISTS sistema_login CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");

// Usa o banco criado
$conexao->exec("USE sistema_login");

// Cria a tabela de usuários
$conexao->exec("
    CREATE TABLE IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        usuario VARCHAR(50) NOT NULL,
        senha VARCHAR(255) NOT NULL
    )
");

// Criptografa a senha e insere um usuário exemplo (admin / 123)
$senha = password_hash("1234", PASSWORD_DEFAULT);
$conexao->exec("INSERT INTO usuarios (usuario, senha) VALUES ('admin', '$senha')");

echo "Banco de dados e tabela criados com sucesso!";
?>
