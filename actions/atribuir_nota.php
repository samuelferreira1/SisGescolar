<?php
include '../includes/database.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] != 'Professor') {
    header('Location: login.php');
}

$query = "SELECT * FROM Aluno";
$resultado = $conexao->query($query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Atribuir Notas</title>
</head>
<body>
    <h1>Atribuir Notas aos Alunos</h1>
    <table>
        <tr>
            <th>Nome</th>
            <th>Data de Nascimento</th>
            <th>Turma</th>
            <th>Nota</th>
            <th>Ações</th>
        </tr>
        <?php while ($aluno = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?php echo $aluno['nome_completo']; ?></td>
            <td><?php echo $aluno['data_nascimento']; ?></td>
            <td><?php echo $aluno['turma']; ?></td>
            <td><?php echo $aluno['nota']; ?></td>
            <td>
                <form action="../actions/atribuir_nota.php" method="POST">
                    <input type="hidden" name="matricula_aluno" value="<?php echo $aluno['matricula']; ?>">
                    <input type="number" step="0.01" name="nota" value="<?php echo $aluno['nota']; ?>" required>
                    <button type="submit">Atribuir Nota</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
