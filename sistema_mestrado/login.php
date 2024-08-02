<?php
session_start();
include 'classes/Database.php';
include 'classes/Usuario.php';

try {
    $database = new Database();
    $pdo = $database->getConnection();
    $usuario = new Usuario($pdo);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = trim($_POST['email']);
        $senha = trim($_POST['senha']);

        if ($usuario->login($email, $senha)) {
            // Redireciona para a página com base no tipo de usuário
            $tipo_usuario = $usuario->getTipoUsuario();

            if ($tipo_usuario == 'administrador') {
                header("Location: index.php?dashboard=admin");
            } elseif ($tipo_usuario == 'orientador') {
                header("Location: index.php?dashboard=orientador");
            } elseif ($tipo_usuario == 'aluno') {
                header("Location: index.php?dashboard=aluno");
            } else {
                $mensagem = "Tipo de usuário desconhecido.";
            }
            exit;
        } else {
            $mensagem = "Email ou senha incorretos.";
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
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            margin-bottom: 20px;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="text-center">Login</h2>
        <?php if (isset($mensagem)): ?>
            <div class="alert alert-info"><?php echo htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
        </form>
        <div class="text-center mt-3">
            <a href="register.php">Criar uma conta</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
