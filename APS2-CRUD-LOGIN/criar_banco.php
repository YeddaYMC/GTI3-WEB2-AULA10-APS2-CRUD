<?php
// Conexão: Servidor MySQL
$conexao = new PDO("mysql:host=localhost", "root", "");

// Banco: Criar
$conexao->exec("CREATE DATABASE IF NOT EXISTS sistema_login CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");

// Banco: Selecionar
$conexao->exec("USE sistema_login");

// Tabela: Criar usuários
$conexao->exec("
    CREATE TABLE IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        usuario VARCHAR(50) NOT NULL,
        senha VARCHAR(255) NOT NULL,
        nome VARCHAR(150) NOT NULL
    )
");

// Usuário: Inserir admin
$senha = password_hash("1234", PASSWORD_DEFAULT);
$conexao->exec("INSERT INTO usuarios (usuario, senha, nome) VALUES ('admin', '$senha', 'Administrador')");

echo "Banco de dados e tabela criados com sucesso!";
?>
