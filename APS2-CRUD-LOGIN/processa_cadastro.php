<?php
require 'seguranca.php';

// Validação: Método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: cadastro.php");
    exit();
}

// Dados: Obter do form
$nome = $_POST['nome'] ?? '';
$usuario = $_POST['usuario'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($nome) || empty($usuario) || empty($senha)) {
    header("Location: cadastro.php?erro=Todos os campos são obrigatórios.");
    exit();
}

// Segurança: Verificar se usuário já existe
$sqlCheck = "SELECT id FROM usuarios WHERE usuario = :usuario";
$stmtCheck = $pdo->prepare($sqlCheck);
$stmtCheck->execute(['usuario' => $usuario]);
if ($stmtCheck->fetch()) {
    header("Location: cadastro.php?erro=Este nome de usuário já está em uso.");
    exit();
}

// Segurança: Criptografar senha
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

// Banco: Inserir novo usuário
$sql = "INSERT INTO usuarios (nome, usuario, senha) VALUES (:nome, :usuario, :senha)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'nome' => $nome,
    'usuario' => $usuario,
    'senha' => $senhaHash
]);

// Redirecionar: Login com mensagem de sucesso
header("Location: login.php?sucesso=1");
exit();
