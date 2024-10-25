<?php
include '../includes/database.php'; // Inclui a conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $role = $_POST['role']; // Captura o papel do usuário

    // Prepara a consulta SQL de acordo com o papel do usuário
    if ($role == 'RH') {
        $query = "SELECT * FROM RH WHERE email=? AND senha=?";
    } elseif ($role == 'Secretaria') {
        $query = "SELECT * FROM Secretaria WHERE email=? AND senha=?";
    } elseif ($role == 'Professor') {
        $query = "SELECT * FROM Professor WHERE email=? AND senha=?";
    } elseif ($role == 'Aluno') {
        $query = "SELECT * FROM Aluno WHERE email=? AND senha=?";
    } else {
        echo "Papel de usuário inválido!";
        exit;
    }

    // Prepara e executa a consulta
    $stmt = $conexao->prepare($query);
    $stmt->bind_param('ss', $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica o resultado da consulta
    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['user'] = $email;
        $_SESSION['role'] = $role;
        header('Location: ../pages/index.php');
    } else {
        echo "Credenciais inválidas!";
    }
}
?>
