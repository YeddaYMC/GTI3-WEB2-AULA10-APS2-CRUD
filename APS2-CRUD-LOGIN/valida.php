<?php
require 'seguranca.php';

// Validação: Método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Redirecionar: Login
    header("Location: login.php");
    exit();
}

// Dados: Obter do form
$usuario = $_POST['usuario'] ?? '';
$senha = $_POST['senha'] ?? '';

// Validação: Chamar função
if (validaUsuario($usuario, $senha) === true) {
    // Segurança: Regenerar ID da sessão
    session_regenerate_id(true); 

    // Redirecionar: Página principal
    header("Location: index.php"); 
    exit();
} else {
    // Falha: Expulsar visitante
    expulsaVisitante();
}