<?php include 'includes/header.php'; ?>
<?php
include 'classes/Curso.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $curso = new Curso();
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $horas = $_POST['horas'];
    $curso->cadastrar($nome, $tipo, $horas);
}
?>

<form method="POST" action="">
    <div class="form-group">
        <label for="nome">Nome do Curso:</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
    </div>
    <div class="form-group">
        <label for="tipo">Tipo:</label>
        <select class="form-control" id="tipo" name="tipo">
            <option value="graduação">Graduação</option>
            <option value="pós-graduação">Pós-graduação</option>
        </select>
    </div>
    <div class="form-group">
        <label for="horas">Horas Extracurriculares:</label>
        <input type="number" class="form-control" id="horas" name="horas" required>
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>

<?php include 'includes/footer.php'; ?>
