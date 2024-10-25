<?php
include '../includes/database.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] != 'RH') {
    header('Location: login.php');
    exit();
}

$query = "SELECT * FROM Professor";
$resultado = $conexao->query($query);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Gestão de Professores</title>
</head>
<body>
    <h1>Lista de Professores</h1>
    <a href="cadastrar.php?role=Professor">Adicionar Novo Professor</a>
    <table>
        <tr>
            <th>Matrícula</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>E-mail</th>
            <th>Data de Nascimento</th>
            <th>Ações</th>
        </tr>
        <?php while ($professor = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?php echo $professor['matricula']; ?></td>
            <td><?php echo $professor['nome_completo']; ?></td>
            <td><?php echo $professor['cpf']; ?></td>
            <td><?php echo $professor['email']; ?></td>
            <td><?php echo $professor['data_nascimento']; ?></td>
            <td>
                <a href="editar.php?matricula=<?php echo $professor['matricula']; ?>">Editar</a>
                <a href="excluir.php?matricula=<?php echo $professor['matricula']; ?>">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
