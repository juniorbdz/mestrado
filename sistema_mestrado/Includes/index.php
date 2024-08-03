<?php include 'includes/header.php'; ?>

<div class="container">
    <div class="dashboard-panel">
        <h3>Painel de Controle</h3>
        <!-- Adicione aqui o conteúdo do painel de controle com base no tipo de usuário -->
        <?php if ($tipo_usuario == 'administrador'): ?>
            <p>Quantidade de alunos: <?php echo $total_alunos; ?></p>
            <p>Quantidade de orientadores: <!-- Código para exibir quantidade de orientadores --></p>
            <p>Quantidade de cursos: <!-- Código para exibir quantidade de cursos --></p>
            <p>Quantidade de cursos por tipo: <!-- Código para exibir quantidade de cursos por tipo --></p>
            <p>Orientadores com orientandos: <!-- Código para exibir quantidade de orientadores com orientandos --></p>
            <p>Orientadores ociosos: <!-- Código para exibir quantidade de orientadores ociosos --></p>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>