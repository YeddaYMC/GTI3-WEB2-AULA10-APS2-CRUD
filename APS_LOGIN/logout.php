<?php
session_start();
session_unset();
session_destroy();

// Remove o cookie
setcookie("usuario", "", time() - 3600, "/");

header("Location: login.php");
exit;
?>
