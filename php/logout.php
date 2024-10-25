<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (isset($_SESSION['usuario'])) {
    // Destrói a sessão
    session_unset();
    session_destroy();
}

// Redireciona para a página de login
header('Location: login.php');
exit();
?>
