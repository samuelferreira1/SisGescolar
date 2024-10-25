<?php
include '../includes/database.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] != 'Aluno') {
    header('Location: login.php');
    exit();
}

$email = $_SESSION['user'];
$query = "SELECT * FROM Aluno WHERE email=?";
$stmt = $conexao->prepare($query);
$stmt->bind_param('s', $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($aluno = $resultado->fetch_assoc()):
?>
<!DOCTYPE html>
<html>
<head>
    <title>Notas do Aluno</title>
</head>
<body>
    <h1>Notas de <?php echo $aluno['nome_completo']; ?></h1>
    <p>Data de Nascimento: <?php echo $aluno['data_nascimento']; ?></p>
    <p>Turma: <?php echo $aluno['turma']; ?></p>
    <p>Nota: <?php echo $aluno['nota']; ?></p>
</body>
</html>
<?php else: ?>
    <p>Aluno não encontrado.</p>
<?php endif; ?>
