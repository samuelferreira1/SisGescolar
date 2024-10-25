<?php include 'header.php'; // Inclui o cabeçalho ?>

<?php
// A sessão deve estar ativa no header.php, portanto não chamamos session_start() aqui.
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

include 'db.php'; // Inclui o arquivo de conexão ao banco de dados

// Verifica se foi passado o ID do aluno
if (!isset($_GET['id'])) {
    echo "ID do aluno não informado!";
    exit();
}

$id = $_GET['id'];

// Busca os dados do aluno pelo ID
$query = "SELECT * FROM alunos WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Aluno não encontrado!";
    exit();
}

$aluno = $result->fetch_assoc();

// Atualiza os dados do aluno se o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_completo = $_POST['nome_completo'];
    $data_nascimento = $_POST['data_nascimento'];
    $ano_letivo = $_POST['ano_letivo'];
    $rua = $_POST['rua'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    $updateQuery = "UPDATE alunos SET nome_completo = ?, data_nascimento = ?, ano_letivo = ?, rua = ?, cidade = ?, estado = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param('ssssssi', $nome_completo, $data_nascimento, $ano_letivo, $rua, $cidade, $estado, $id);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Aluno atualizado com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao atualizar aluno: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Aluno</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Editar Aluno</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="editar_aluno.php?id=<?php echo $id; ?>">
                            <div class="mb-3">
                                <label for="nome_completo" class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" id="nome_completo" name="nome_completo" value="<?php echo $aluno['nome_completo']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?php echo $aluno['data_nascimento']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="ano_letivo" class="form-label">Ano Letivo</label>
                                <select class="form-select" id="ano_letivo" name="ano_letivo" required>
                                    <option value="6º ano" <?php echo $aluno['ano_letivo'] == '6º ano' ? 'selected' : ''; ?>>6º ano</option>
                                    <option value="7º ano" <?php echo $aluno['ano_letivo'] == '7º ano' ? 'selected' : ''; ?>>7º ano</option>
                                    <option value="8º ano" <?php echo $aluno['ano_letivo'] == '8º ano' ? 'selected' : ''; ?>>8º ano</option>
                                    <option value="9º ano" <?php echo $aluno['ano_letivo'] == '9º ano' ? 'selected' : ''; ?>>9º ano</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="rua" class="form-label">Rua</label>
                                <input type="text" class="form-control" id="rua" name="rua" value="<?php echo $aluno['rua']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $aluno['cidade']; ?>" required>
                            </div>
                            <div class="mb-3">
    <label for="estado" class="form-label">Estado</label>
        <select class="form-select" id="estado" name="estado" required>
            <option value="" disabled>Selecione o Estado</option>
            <option value="Acre" <?php echo $aluno['estado'] == 'Acre' ? 'selected' : ''; ?>>Acre</option>
            <option value="Alagoas" <?php echo $aluno['estado'] == 'Alagoas' ? 'selected' : ''; ?>>Alagoas</option>
            <option value="Amapá" <?php echo $aluno['estado'] == 'Amapá' ? 'selected' : ''; ?>>Amapá</option>
            <option value="Amazonas" <?php echo $aluno['estado'] == 'Amazonas' ? 'selected' : ''; ?>>Amazonas</option>
            <option value="Bahia" <?php echo $aluno['estado'] == 'Bahia' ? 'selected' : ''; ?>>Bahia</option>
            <option value="Ceará" <?php echo $aluno['estado'] == 'Ceará' ? 'selected' : ''; ?>>Ceará</option>
            <option value="Distrito Federal" <?php echo $aluno['estado'] == 'Distrito Federal' ? 'selected' : ''; ?>>Distrito Federal</option>
            <option value="Espírito Santo" <?php echo $aluno['estado'] == 'Espírito Santo' ? 'selected' : ''; ?>>Espírito Santo</option>
            <option value="Goiás" <?php echo $aluno['estado'] == 'Goiás' ? 'selected' : ''; ?>>Goiás</option>
            <option value="Maranhão" <?php echo $aluno['estado'] == 'Maranhão' ? 'selected' : ''; ?>>Maranhão</option>
            <option value="Mato Grosso" <?php echo $aluno['estado'] == 'Mato Grosso' ? 'selected' : ''; ?>>Mato Grosso</option>
            <option value="Mato Grosso do Sul" <?php echo $aluno['estado'] == 'Mato Grosso do Sul' ? 'selected' : ''; ?>>Mato Grosso do Sul</option>
            <option value="Minas Gerais" <?php echo $aluno['estado'] == 'Minas Gerais' ? 'selected' : ''; ?>>Minas Gerais</option>
            <option value="Pará" <?php echo $aluno['estado'] == 'Pará' ? 'selected' : ''; ?>>Pará</option>
            <option value="Paraíba" <?php echo $aluno['estado'] == 'Paraíba' ? 'selected' : ''; ?>>Paraíba</option>
            <option value="Paraná" <?php echo $aluno['estado'] == 'Paraná' ? 'selected' : ''; ?>>Paraná</option>
            <option value="Pernambuco" <?php echo $aluno['estado'] == 'Pernambuco' ? 'selected' : ''; ?>>Pernambuco</option>
            <option value="Piauí" <?php echo $aluno['estado'] == 'Piauí' ? 'selected' : ''; ?>>Piauí</option>
            <option value="Rio de Janeiro" <?php echo $aluno['estado'] == 'Rio de Janeiro' ? 'selected' : ''; ?>>Rio de Janeiro</option>
            <option value="Rio Grande do Norte" <?php echo $aluno['estado'] == 'Rio Grande do Norte' ? 'selected' : ''; ?>>Rio Grande do Norte</option>
            <option value="Rio Grande do Sul" <?php echo $aluno['estado'] == 'Rio Grande do Sul' ? 'selected' : ''; ?>>Rio Grande do Sul</option>
            <option value="Rondônia" <?php echo $aluno['estado'] == 'Rondônia' ? 'selected' : ''; ?>>Rondônia</option>
            <option value="Roraima" <?php echo $aluno['estado'] == 'Roraima' ? 'selected' : ''; ?>>Roraima</option>
            <option value="Santa Catarina" <?php echo $aluno['estado'] == 'Santa Catarina' ? 'selected' : ''; ?>>Santa Catarina</option>
            <option value="São Paulo" <?php echo $aluno['estado'] == 'São Paulo' ? 'selected' : ''; ?>>São Paulo</option>
            <option value="Sergipe" <?php echo $aluno['estado'] == 'Sergipe' ? 'selected' : ''; ?>>Sergipe</option>
            <option value="Tocantins" <?php echo $aluno['estado'] == 'Tocantins' ? 'selected' : ''; ?>>Tocantins</option>
        </select>
    </div>

                            <button type="submit" class="btn btn-primary w-100">Salvar Alterações</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
