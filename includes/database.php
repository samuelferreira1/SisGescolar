<?php
$host = 'localhost';
$db = 'sisg_db';
$user = 'root';
$pass = '';

$conexao = new mysqli($host, $user, $pass, $db);

if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}
?>
