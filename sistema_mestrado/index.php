<?php
session_start();
include 'classes/Database.php';
include 'classes/Usuario.php';

if (!isset($_SESSION['tipo'])) {
    header("Location: login.php");
    exit;
}

try {
    $database = new Database();
    $pdo = $database->getConnection();
    $usuario = new Usuario($pdo);

    // Verifica o tipo de usuário
    $tipo_usuario = $_SESSION['tipo'];

    // Obtenha dados necessários com base no tipo de usuário, se necessário
} catch (PDOException $e) {
    $mensagem = "Erro: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .container {
            margin-top: 80px;
        }
        .dashboard-panel {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .footer {
            background: #f1f1f1;
            padding: 10px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">Sistema de Mestrado</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?dashboard=admin">Início</a>
                </li>
                <?php if ($tipo_usuario == 'administrador'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="add_user.php">Adicionar Usuário</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_orientador.php">Adicionar Orientador</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_aluno.php">Adicionar Aluno</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_curso.php">Adicionar Curso</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link btn btn-danger text-white" href="logout.php">Sair</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="dashboard-panel">
            <h3>Painel de Controle</h3>
            <!-- Adicione aqui o conteúdo do painel de controle com base no tipo de usuário -->
            <?php if ($tipo_usuario == 'administrador'): ?>
                <p>Quantidade de alunos: <!-- Código para exibir quantidade de alunos --></p>
                <p>Quantidade de orientadores: <!-- Código para exibir quantidade de orientadores --></p>
                <p>Quantidade de cursos: <!-- Código para exibir quantidade de cursos --></p>
                <p>Quantidade de cursos por tipo: <!-- Código para exibir quantidade de cursos por tipo --></p>
                <p>Orientadores com orientandos: <!-- Código para exibir quantidade de orientadores com orientandos --></p>
                <p>Orientadores ociosos: <!-- Código para exibir quantidade de orientadores ociosos --></p>
            <?php endif; ?>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 Sistema de Mestrado. Todos os direitos reservados.</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
