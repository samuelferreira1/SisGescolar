<?php include 'header.php'; // Inclui o cabeçalho ?>

<?php
// A sessão deve estar ativa no header.php, portanto não chamamos session_start() aqui.
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

include 'db.php'; // Inclui o arquivo de conexão ao banco de dados

// Consulta para buscar alunos
$query = "SELECT * FROM alunos";
$result = $conn->query($query);

if (!$result) {
    echo "Erro ao buscar alunos: " . $conn->error;
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard do Secretário</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center">Bem-vindo, <?php echo $_SESSION['usuario']; ?></h2>
        <div class="d-flex justify-content-end mb-3">
            <a href="adicionar_aluno.php" class="btn btn-success">Adicionar Novo Aluno</a>
        </div>
        
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Matrícula</th>
                    <th>Nome Completo</th>
                    <th>Ano Letivo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['matricula']; ?></td>
                    <td><?php echo $row['nome_completo']; ?></td>
                    <td><?php echo $row['ano_letivo']; ?></td>
                    <td>
                        <a href="editar_aluno.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Ver/Editar</a>
                        <a href="excluir_aluno.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
