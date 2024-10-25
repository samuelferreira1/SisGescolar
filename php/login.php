<?php
session_start(); // Inicia a sessão
include 'db.php'; // Inclui o arquivo de conexão ao banco de dados

// Verifica se o usuário já está logado
if (isset($_SESSION['usuario'])) {
    header('Location: dashboard.php'); // Redireciona para o dashboard se já estiver logado
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = md5($_POST['senha']); // Supondo que a senha esteja sendo armazenada como MD5

    // Modifiquei a consulta para usar o nome de usuário
    $query = "SELECT * FROM usuarios WHERE usuario = ? AND senha = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $usuario, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['usuario'] = $usuario; // Armazena o nome do usuário na sessão
        header('Location: dashboard.php'); // Redireciona para o dashboard
        exit();
    } else {
        echo "<div class='alert alert-danger'>Usuário ou senha inválidos!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos/style.css">
</head>
<body class="bg-light">
    <?php include 'header.php'; // Inclui o cabeçalho ?>
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="login.php">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuário</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; // Inclui o footer ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
