<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] != 'orientador') {
    header("Location: login.php");
    exit();
}

include 'includes/header.php';
?>

<h1>Cadastro de Orientação</h1>

<form method="POST" action="salvar_orientacao.php">
    <div class="form-group">
        <label for="data">Data da Orientação:</label>
        <input type="date" class="form-control" id="data" name="data" required>
    </div>
    <div class="form-group">
        <label for="descricao">Descrição:</label>
        <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar Orientação</button>
</form>

<?php include 'includes/footer.php'; ?>

