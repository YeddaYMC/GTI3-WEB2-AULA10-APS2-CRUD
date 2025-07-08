<?php
// 1. Abre uma sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Conecta com um Banco de Dados
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'sistema_login');

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Em um ambiente de produção, é melhor logar o erro do que exibi-lo.
    die("ERRO: Não foi possível conectar ao banco de dados. " . $e->getMessage());
}

/**
 * 3. Define uma função que valida um usuário
 */
function validaUsuario($usuario, $senha)
{
    global $pdo;

    $sql = "SELECT id, usuario, nome, senha FROM usuarios WHERE usuario = :usuario LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Se encontrou o usuário e a senha está correta (usando password_verify)
    if ($user && password_verify($senha, $user['senha'])) {
        // Define variáveis de sessão com os dados do usuário
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_nome'] = $user['nome'];
        $_SESSION['usuario_login'] = $user['usuario'];
        return true;
    }

    // Senão, a função retorna falso
    return false;
}

/**
 * 4. Define uma função que protege uma página
 */
function protegePagina()
{
    // Verifica se existem variáveis de sessão do usuário definidas
    if (!isset($_SESSION['usuario_id'])) {
        // Se não existirem, chama a função que expulsa o visitante
        expulsaVisitante(false); // Alterado para não mostrar erro
    }
}

/**
 * 5. Define uma função que expulsa um visitante
 */
function expulsaVisitante($mostrarErro = true)
{
    // Limpa o cookie de sessão, se existir
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Destrói a sessão
    session_unset();
    session_destroy();

    // Redireciona, mostrando erro apenas se necessário
    $redirectUrl = $mostrarErro ? "login.php?erro=1" : "login.php";
    header("Location: " . $redirectUrl);
    exit();
}
