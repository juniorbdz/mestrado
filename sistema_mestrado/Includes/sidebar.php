<?php
session_start(); // Certifique-se de que a sessão está iniciada
$tipo_usuario = isset($_SESSION['tipo']) ? $_SESSION['tipo'] : 'desconhecido'; // Defina um valor padrão caso a variável não exista
?>

<div class="d-flex">
    <div class="sidebar bg-light" style="width: 250px;">
        <ul class="nav flex-column">
            <?php if ($tipo_usuario == 'administrador'): ?>
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Painel de Controle</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage_users.php">Gerenciar Usuários</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage_courses.php">Gerenciar Cursos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage_guidance.php">Gerenciar Orientações</a>
                </li>
            <?php elseif ($tipo_usuario == 'orientador'): ?>
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Painel de Controle</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="schedule_appointments.php">Agendar Orientação</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_students.php">Ver Alunos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage_guidance.php">Gerenciar Orientações</a>
                </li>
            <?php elseif ($tipo_usuario == 'aluno'): ?>
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Painel de Controle</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_activity.php">Adicionar Atividade</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_guidance.php">Ver Orientações</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="#">Perfil desconhecido</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="content flex-fill">
        <!-- O conteúdo da página será renderizado aqui -->
    </div>
</div>
