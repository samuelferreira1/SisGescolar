<?php include 'header.php'; // Inclui o cabeçalho ?>
<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_completo = $_POST['nome_completo'];
    $data_nascimento = $_POST['data_nascimento'];
    $ano_letivo = $_POST['ano_letivo'];
    $rua = $_POST['rua'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $matricula = rand(10000, 99999); // Gera matrícula aleatória

    // Usar prepared statements para segurança
    $query = "INSERT INTO alunos (matricula, nome_completo, data_nascimento, ano_letivo, rua, cidade, estado)
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param('issssss', $matricula, $nome_completo, $data_nascimento, $ano_letivo, $rua, $cidade, $estado);
    
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Aluno adicionado com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adicionar Aluno</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Adicionar Novo Aluno</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="nome_completo" class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" id="nome_completo" name="nome_completo" required>
                            </div>
                            <div class="mb-3">
                                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                            </div>
                            <div class="mb-3">
                                <label for="ano_letivo" class="form-label">Ano Letivo</label>
                                <select class="form-select" id="ano_letivo" name="ano_letivo" required>
                                    <option value="6º ano">6º ano</option>
                                    <option value="7º ano">7º ano</option>
                                    <option value="8º ano">8º ano</option>
                                    <option value="9º ano">9º ano</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="rua" class="form-label">Rua</label>
                                <input type="text" class="form-control" id="rua" name="rua" required>
                            </div>
                            <div class="mb-3">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="cidade" name="cidade" required>
                            </div>
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-select" id="estado" name="estado" required>
                                    <option value="" disabled selected>Selecione o Estado</option>
                                    <option value="Acre">Acre</option>
                                    <option value="Alagoas">Alagoas</option>
                                    <option value="Amapá">Amapá</option>
                                    <option value="Amazonas">Amazonas</option>
                                    <option value="Bahia">Bahia</option>
                                    <option value="Ceará">Ceará</option>
                                    <option value="Distrito Federal">Distrito Federal</option>
                                    <option value="Espírito Santo">Espírito Santo</option>
                                    <option value="Goiás">Goiás</option>
                                    <option value="Maranhão">Maranhão</option>
                                    <option value="Mato Grosso">Mato Grosso</option>
                                    <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                                    <option value="Minas Gerais">Minas Gerais</option>
                                    <option value="Pará">Pará</option>
                                    <option value="Paraíba">Paraíba</option>
                                    <option value="Paraná">Paraná</option>
                                    <option value="Pernambuco">Pernambuco</option>
                                    <option value="Piauí">Piauí</option>
                                    <option value="Rio de Janeiro">Rio de Janeiro</option>
                                    <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                                    <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                                    <option value="Rondônia">Rondônia</option>
                                    <option value="Roraima">Roraima</option>
                                    <option value="Santa Catarina">Santa Catarina</option>
                                    <option value="São Paulo">São Paulo</option>
                                    <option value="Sergipe">Sergipe</option>
                                    <option value="Tocantins">Tocantins</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Adicionar Aluno</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <?php include 'footer.php'; // Inclui o cabeçalho ?>
</body>
</html>
