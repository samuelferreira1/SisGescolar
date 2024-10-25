<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

include 'db.php';

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    echo "ID do aluno não informado!";
    exit();
}

$id = $_GET['id'];

// Prepara e executa a exclusão
$query = "DELETE FROM alunos WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    // Se a exclusão for bem-sucedida, redireciona de volta para o dashboard
    header('Location: dashboard.php');
} else {
    echo "Erro ao excluir aluno: " . $conn->error;
}
?>
