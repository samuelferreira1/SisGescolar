<?php
// Inicia a sessão apenas se não estiver ativa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está logado
$is_logged_in = isset($_SESSION['usuario']);

// Página atual, útil para esconder o botão "Voltar" na página de login
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- Header -->
<header class="bg-light py-3">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <!-- Botão Voltar -->
            <div class="col-2">
                <?php if ($current_page !== 'login.php' && $current_page !== 'dashboard.php'): ?>
                    <a href="javascript:history.back()" class="btn btn-secondary">Voltar</a>
                <?php endif; ?>
            </div>

            <!-- Logo Centralizada -->
            <div class="col-8 text-center">
                <img src="http://localhost/sisgeu/estilos/imagens/logo.png" alt="SISGEU" class="img-fluid" style="max-height: 120px;">

            </div>

            <!-- Botão Logout -->
            <div class="col-2 text-end">
                <?php if ($is_logged_in): ?>
                    <a href="logout.php" class="btn btn-danger">Sair</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

