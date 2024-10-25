<?php
include '../includes/database.php';
session_start();
if ($_SESSION['role'] !== 'RH') {
    header('Location: login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_completo = $_POST['nome_completo'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];
    $senha = $_POST['senha'];

    $query = "INSERT INTO Professor (nome_completo, cpf, email, data_nascimento, senha) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param('sssss', $nome_completo, $cpf, $email, $data_nascimento, $senha);
    $stmt->execute();
    echo "Professor adicionado com sucesso!";
}

$query = "SELECT * FROM Professor";
$resultado = $conexao->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Professores</title>
</head>
<body>
    <h1>Dados dos Professores</h1>
    <form method="POST">
        <input type="text" name="nome_completo" placeholder="Nome Completo" required>
        <input type="text" name="cpf" placeholder="CPF" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="date" name="data_nascimento" placeholder="Data de Nascimento" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Adicionar</button>
    </form>
    <table>
        <tr>
            <th>Nome Completo</th>
            <th>CPF</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
        <?php while ($prof = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?php echo $prof['nome_completo']; ?></td>
            <td><?php echo $prof['cpf']; ?></td>
            <td><?php echo $prof['email']; ?></td>
            <td>
                <form method="POST" action="../actions/editar_professor.php">
                    <input type="hidden" name="matricula" value="<?php echo $prof['matricula']; ?>">
                    <button type="submit">Editar</button>
                </form>
                <form method="POST" action="../actions/excluir_professor.php">
                    <input type="hidden" name="matricula" value="<?php echo $prof['matricula']; ?>">
                    <button type="submit">Excluir</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
