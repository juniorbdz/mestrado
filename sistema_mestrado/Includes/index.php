<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Inclui o header
include 'includes/header.php';

// Obtém o tipo de usuário
$tipo_usuario = $_SESSION['usuario_tipo'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 20px;
        }
        .menu-item {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Bem-vindo ao Sistema de Mestrado</h1>
        <p class="text-center">Utilize o menu de navegação para acessar as diferentes funcionalidades do sistema.</p>
        
        <div class="row">
            <div class="col-md-12">
                <div class="list-group">
                    <?php if ($tipo_usuario == 'aluno'): ?>
                        <a href="cadastro_atividade_extracurricular.php" class="list-group-item list-group-item-action menu-item">Cadastro de Atividade Extracurricular</a>
                        <a href="resposta_orientacao.php" class="list-group-item list-group-item-action menu-item">Resposta a Orientação</a>
                        <a href="relatorio_atividades.php" class="list-group-item list-group-item-action menu-item">Relatório de Atividades</a>
                    <?php elseif ($tipo_usuario == 'orientador'): ?>
                        <a href="cadastro_orientacao.php" class="list-group-item list-group-item-action menu-item">Cadastro de Orientação</a>
                        <a href="agendamento_orientacao.php" class="list-group-item list-group-item-action menu-item">Agendamento de Orientação</a>
                        <a href="relatorio_atividades_por_aluno.php" class="list-group-item list-group-item-action menu-item">Relatório de Atividades por Aluno</a>
                    <?php elseif ($tipo_usuario == 'administrador'): ?>
                        <a href="adicionar_usuarios.php" class="list-group-item list-group-item-action menu-item">Adicionar Usuários</a>
                        <a href="cadastro_curso.php" class="list-group-item list-group-item-action menu-item">Cadastro de Cursos</a>
                        <a href="atribuir_orientador.php" class="list-group-item list-group-item-action menu-item">Atribuir Orientador</a>
                    <?php else: ?>
                        <div class="alert alert-warning text-center">
                            Você não tem permissão para acessar esta página.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Botão de Logout -->
        <div class="text-center mt-4">
            <form method="post" action="logout.php">
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
