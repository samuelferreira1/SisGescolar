<?php
include '../includes/database.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] != 'Aluno') {
    header('Location: login.php');
}

$email = $_SESSION['user'];
$query = "SELECT * FROM Aluno WHERE email = ?";
$stmt = $conexao->prepare($query);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt;