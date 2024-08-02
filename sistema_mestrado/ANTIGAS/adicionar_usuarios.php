<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'classes/Database.php';
include 'classes/Usuario.php';
try {
    $database = new Database();
    $pdo = $database->getConnection();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = trim($_POST['nome']);
        $email = trim($_POST['email']);
        $senha = password_hash(trim($_POST['senha']), PASSWORD_DEFAULT);
        $tipo = trim($_POST['tipo']);

        // Campos adicionais
        $matricula = isset($_POST['matricula']) ? trim($_POST['matricula']) : null;
        $endereco = isset($_POST['endereco']) ? trim($_POST['endereco']) : null;
        $cpf = isset($_POST['cpf']) ? trim($_POST['cpf']) : null;
        $curso = isset($_POST['curso']) ? trim($_POST['curso']) : null;
        $tipo_curso = isset($_POST['tipo_curso']) ? trim($_POST['tipo_curso']) : null;

        // Verificar se o e-mail já está cadastrado
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $erro = "O e-mail já está cadastrado.";
        } else {
            // Preparar e executar a inserção
            $sql = "INSERT INTO usuarios (nome, email, senha, tipo, matricula, endereco, cpf, curso, tipo_curso) 
                    VALUES (:nome, :email, :senha, :tipo, :matricula, :endereco, :cpf, :curso, :tipo_curso)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':matricula', $matricula);
            $stmt->bindParam(':endereco', $endereco);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':curso', $curso);
            $stmt->bindParam(':tipo_curso', $tipo_curso);

            if ($stmt->execute()) {
                $sucesso = "Usuário adicionado com sucesso!";
            } else {
                $erro = "Erro ao adicionar o usuário: " . implode(", ", $stmt->errorInfo());
            }
        }
    }
} catch (PDOException $e) {
    $erro = "Erro: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Usuário</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        function toggleFields(tipo) {
            document.getElementById('adminFields').style.display = tipo === 'administrador' ? 'block' : 'none';
            document.getElementById('orientadorFields').style.display = tipo === 'orientador' ? 'block' : 'none';
            document.getElementById('alunoFields').style.display = tipo === 'aluno' ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container mt-5">
        <h2>Adicionar Usuário</h2>
        <?php if (isset($erro)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($erro, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>
        <?php if (isset($sucesso)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($sucesso, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>
        <form method="post" action="processa_usuario.php">
            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select class="form-control" id="tipo" name="tipo" required onchange="toggleFields(this.value)">
                    <option value="">Selecione</option>
                    <option value="administrador">Administrador</option>
                    <option value="orientador">Orientador</option>
                    <option value="aluno">Aluno</option>
                </select>
            </div>
            <div id="adminFields" style="display: none;">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" required>
                </div>
            </div>
            <div id="orientadorFields" style="display: none;">
                <div class="form-group">
                    <label for="matricula">Matrícula:</label>
                    <input type="text" class="form-control" id="matricula" name="matricula" required>
                </div>
                <div class="form-group">
                    <label for="curso">Curso:</label>
                    <input type="text" class="form-control" id="curso" name="curso" required>
                </div>
                <div class="form-group">
                    <label for="tipo_curso">Tipo do Curso:</label>
                    <select class="form-control" id="tipo_curso" name="tipo_curso" required>
                        <option value="">Selecionar tipo de Curso</option>
                        <option value="Graduacao">Graduação</option>
                        <option value="Latu Sensu">Latu Sensu</option>
                        <option value="Strictu Sensu">Strictu Sensu</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" required>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" required>
                </div>
            </div>
            <div id="alunoFields" style="display: none;">
                <div class="form-group">
                    <label for="matricula">Matrícula:</label>
                    <input type="text" class="form-control" id="matricula" name="matricula" required>
                </div>
                <div class="form-group">
                    <label for="curso">Curso:</label>
                    <input type="text" class="form-control" id="curso" name="curso" required>
                </div>
                <div class="form-group">
                    <label for="tipo_curso">Tipo do Curso:</label>
                    <select class="form-control" id="tipo_curso" name="tipo_curso" required>
                        <option value="">Selecionar tipo de Curso</option>
                        <option value="Graduacao">Graduação</option>
                        <option value="Latu Sensu">Latu Sensu</option>
                        <option value="Strictu Sensu">Strictu Sensu</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" required>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar</button>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
