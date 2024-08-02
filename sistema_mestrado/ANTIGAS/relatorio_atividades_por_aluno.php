<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] != 'orientador') {
    header("Location: login.php");
    exit();
}

include 'classes/Usuario.php';
include 'includes/header.php';

$usuario = new Usuario();
$alunos = $usuario->getAlunos();
?>

<h1>Relatório de Atividades por Aluno</h1>

<form method="POST" action="visualizar_relatorio.php">
    <div class="form-group">
        <label for="aluno">Selecionar Aluno:</label>
        <select class="form-control" id="aluno" name="aluno_id" required>
            <option value="">Escolha um aluno</option>
            <?php foreach ($alunos as $aluno): ?>
            <option value="<?php echo $aluno['id']; ?>"><?php echo $aluno['nome']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Buscar</button>
</form>

<?php include 'includes/footer.php'; ?>
