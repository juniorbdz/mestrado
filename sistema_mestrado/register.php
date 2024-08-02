<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'classes/Database.php';
include 'classes/Usuario.php';

try {
    $database = new Database();
    $pdo = $database->getConnection();
    $usuario = new Usuario($pdo);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = trim($_POST['nome']);
        $email = trim($_POST['email']);
        $senha = password_hash(trim($_POST['senha']), PASSWORD_DEFAULT);
        $matricula = trim($_POST['matricula']);
        $curso = trim($_POST['curso']);
        $tipo_curso = trim($_POST['tipo_curso']);

        // Verificar se o e-mail já está cadastrado
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $mensagem = "O e-mail já está cadastrado.";
        } else {
            // Preparar e executar a inserção
            $sql = "INSERT INTO usuarios (nome, email, senha, tipo, matricula, curso, tipo_curso) 
                    VALUES (:nome, :email, :senha, 'aluno', :matricula, :curso, :tipo_curso)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':matricula', $matricula);
            $stmt->bindParam(':curso', $curso);
            $stmt->bindParam(':tipo_curso', $tipo_curso);

            if ($stmt->execute()) {
                $mensagem = "Usuário aluno registrado com sucesso!";
                // Opcional: Redirecionar para a página de login ou outra página
                // header("Location: login.php");
            } else {
                $mensagem = "Erro ao registrar o usuário: " . implode(", ", $stmt->errorInfo());
            }
        }
    }
} catch (PDOException $e) {
    $mensagem = "Erro: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Aluno</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .register-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .register-container h2 {
            margin-bottom: 20px;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2 class="text-center">Registrar Aluno</h2>
        <?php if (isset($mensagem)): ?>
            <div class="alert alert-info"><?php echo htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>
        <form method="post" action="">
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
            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
            <div class="text-center mt-3">
                <a href="login.php">Já tem uma conta? Faça login</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
