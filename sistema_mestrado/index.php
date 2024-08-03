<?php
session_start();
include 'classes/Database.php';
include 'classes/Usuario.php';

try {
    $database = new Database();
    $pdo = $database->getConnection();
    $usuario = new Usuario($pdo);

    // Verifica se o usuário está logado e define o tipo de usuário
    if (!$usuario->isLoggedIn()) {
        header("Location: login.php");
        exit;
    }
    
    $tipo_usuario = $usuario->getTipoUsuario();
    
    // Verifica se o tipo de usuário foi definido
    if (!$tipo_usuario) {
        // Redireciona ou mostra uma mensagem de erro se o tipo de usuário não estiver definido
        die("Erro: Tipo de usuário não definido.");
    }

    // Exemplos de funções para obter informações adicionais
    $total_alunos = $usuario->contarUsuariosPorTipo('aluno');
    $total_orientadores = $usuario->contarUsuariosPorTipo('orientador');
    $total_cursos = $usuario->contarCursos();
    $total_cursos_online = $usuario->contarCursosPorTipo('online');
    $total_cursos_presenciais = $usuario->contarCursosPorTipo('presencial');
    $total_orientadores_com_orientandos = $usuario->contarOrientadores()['orientadores_com_orientandos'];
    $total_orientadores_sem_orientandos = $usuario->contarOrientadores()['total_orientadores'] - $total_orientadores_com_orientandos;
    
} catch (PDOException $e) {
    $mensagem = "Erro: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include 'includes/header.php'; ?>
    <title>Painel de Controle</title>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="container mt-4">
        <div class="content">
            <?php if ($tipo_usuario == 'administrador'): ?>
                <div class="admin-dashboard">
                    <h2>Painel do Administrador</h2>
                    <div class="card-deck">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total de Alunos</h5>
                                <p class="card-text"><?php echo $total_alunos; ?></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total de Orientadores</h5>
                                <p class="card-text"><?php echo $total_orientadores; ?></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total de Cursos</h5>
                                <p class="card-text"><?php echo $total_cursos; ?></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Cursos Online</h5>
                                <p class="card-text"><?php echo $total_cursos_online; ?></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Cursos Presenciais</h5>
                                <p class="card-text"><?php echo $total_cursos_presenciais; ?></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Orientadores com Orientandos</h5>
                                <p class="card-text"><?php echo $total_orientadores_com_orientandos; ?></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Orientadores Ociosos</h5>
                                <p class="card-text"><?php echo $total_orientadores_sem_orientandos; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php elseif ($tipo_usuario == 'orientador'): ?>
                <div class="orientador-dashboard">
                    <h2>Painel do Orientador</h2>
                    <ul>
                        <li><a href="schedule_appointments.php">Agendar Orientação</a></li>
                        <!-- Outros links e funcionalidades para orientadores -->
                    </ul>
                </div>
            <?php elseif ($tipo_usuario == 'aluno'): ?>
                <div class="aluno-dashboard">
                    <h2>Painel do Aluno</h2>
                    <ul>
                        <li><a href="add_activity.php">Adicionar Atividade</a></li>
                        <!-- Outros links e funcionalidades para alunos -->
                    </ul>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">
                    Tipo de usuário desconhecido. Por favor, entre em contato com o suporte.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="includes/script.js"></script>
</body>
</html>
