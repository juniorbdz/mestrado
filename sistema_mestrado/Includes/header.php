<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$tipoUsuario = isset($_SESSION['tipo']) ? $_SESSION['tipo'] : '';

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Sistema de Mestrado</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <?php if ($tipoUsuario == 'administrador'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_users.php">Gerenciar Usuários</a>
                    </li>
                <?php elseif ($tipoUsuario == 'aluno'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard_aluno.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastro_atividade.php">Cadastro de Atividade Extracurricular</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="resposta_orientacao.php">Resposta a Orientação</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="relatorio_atividades.php">Relatório de Atividades</a>
                    </li>
                <?php elseif ($tipoUsuario == 'orientador'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard_orientador.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastro_orientacao.php">Cadastro de Orientação</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="agendamento_orientacao.php">Agendamento de Orientação</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="relatorio_atividades_aluno.php">Relatório de Atividades por Aluno</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <form action="logout.php" method="post" style="display: inline;">
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
