<?php
session_start();
include 'php/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = md5($_POST['senha']);

    $query = "SELECT * FROM usuarios WHERE usuario='$usuario' AND senha='$senha'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $_SESSION['usuario'] = $usuario;
        header('Location: php/dashboard.php');
    } else {
        echo "Usuário ou senha inválidos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <form method="POST" action="">
        <label>Usuário:</label>
        <input type="text" name="usuario" required>
        <label>Senha:</label>
        <input type="password" name="senha" required>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
