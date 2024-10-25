<?php
include '../includes/database.php';
session_start();
if ($_SESSION['role'] !== 'Secretaria') {
    header('Location: login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];

    $query = "INSERT INTO Secretaria (nome, email, telefone, senha) VALUES (?, ?, ?, ?)";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param('ssss', $nome, $email, $telefone, $senha);
    $stmt->execute();
    echo "Secretaria adicionada com sucesso!";
}

$query = "SELECT * FROM Secretaria";
$resultado = $conexao->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Secretaria</title>
</head>
<body>
    <h1>Dados das Secretarias</h1>
    <form method="POST">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="telefone" placeholder="Telefone" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Adicionar</button>
    </form>
    <table>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
        <?php while ($sec = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?php echo $sec['nome']; ?></td>
            <td><?php echo $sec['email']; ?></td>
            <td><?php echo $sec['telefone']; ?></td>
            <td>
                <form method="POST" action="../actions/editar_secretaria.php">
                    <input type="hidden" name="id" value="<?php echo $sec['id']; ?>">
                    <button type="submit">Editar</button>
                </form>
                <form method="POST" action="../actions/excluir_secretaria.php">
                    <input type="hidden" name="id" value="<?php echo $sec['id']; ?>">
                    <button type="submit">Excluir</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
