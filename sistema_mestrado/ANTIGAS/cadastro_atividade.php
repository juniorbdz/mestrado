<?php include 'includes/header.php'; ?>

<h2>Cadastro de Atividade Extracurricular</h2>

<form action="processar_atividade.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nome_curso">Nome do Curso:</label>
        <input type="text" class="form-control" id="nome_curso" name="nome_curso" required>
    </div>
    <div class="form-group">
        <label for="horas">Horas:</label>
        <input type="number" class="form-control" id="horas" name="horas" required>
    </div>
    <div class="form-group">
        <label for="certificado">Certificado (PDF ou JPG):</label>
        <input type="file" class="form-control-file" id="certificado" name="certificado" required>
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>

<?php include 'includes/footer.php'; ?>
