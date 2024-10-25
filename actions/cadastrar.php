<?php
include '../includes/database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role = $_POST['role'];

    if ($role == 'RH') {
        $query = "INSERT INTO RH (cpf, nome_completo, email, data_nascimento, senha) VALUES (?, ?, ?, ?, ?)";
    } elseif ($role == 'Professor') {
        $query = "INSERT INTO Professor (cpf, nome_completo, email, data_nascimento, senha) VALUES (?, ?, ?, ?, ?)";
    } elseif ($role == 'Secretaria') {
        $query = "INSERT INTO Secretaria (nome_instituicao, rua, cidade, estado, senha) VALUES (?, ?, ?, ?, ?)";
    } elseif ($role == 'Aluno') {
        $query = "INSERT INTO Aluno (cpf, nome_completo, email, data_nascimento, turma, nota, senha) VALUES (?, ?, ?, ?, ?, ?, ?)";
    } else {
        echo "Papel de usuário inválido!";
        exit();
    }

    $stmt = $conexao->prepare($query);
    if ($role == 'Secretaria') {
        $stmt->bind_param('sssss', $_POST['nome_instituicao'], $_POST['rua'], $_POST['cidade'], $_POST['estado'], $_POST['senha']);
    } elseif ($role == 'Aluno') {
        $stmt->bind_param('sssssss', $_POST['cpf'], $_POST['nome_completo'], $_POST['email'], $_POST['data_nascimento'], $_POST['turma'], $_POST['nota'], $_POST['senha']);
    } else {
        $stmt->bind_param('sssss', $_POST['cpf'], $_POST['nome_completo'], $_POST['email'], $_POST['data_nascimento'], $_POST['senha']);
    }
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao realizar o cadastro.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Usuário</title>
</head>
<body>
    <h1>Cadastrar Novo Usuário</h1>
    <form action="cadastrar.php" method="POST">
        <label for="role">Tipo de Usuário:</label>
        <select name="role" id="role">
            <option value="RH">RH</option>
            <option value="Secretaria">Secretaria</option>
            <option value="Professor">Professor</option>
            <option value="Aluno">Aluno</option>
        </select>
        <br>
        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" id="cpf">
        <br>
        <label for="nome_completo">Nome Completo:</label>
        <input type="text" name="nome_completo" id="nome_completo">
        <br>
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email">
        <br>
        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" name="data_nascimento" id="data_nascimento">
        <br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha">
        <br>
        <label for="turma">Turma (para alunos):</label>
        <input type="text" name="turma" id="turma">
        <br>
        <label for="nota">Nota (para alunos):</label>
        <input type="text" name="nota" id="nota">
        <br>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
