<?php include 'includes/header.php'; ?>

<h2>Relatório de Atividades por Aluno</h2>

<form action="relatorio_aluno.php" method="post">
    <div class="form-group">
        <label for="aluno">Selecione o Aluno:</label>
        <select class="form-control" id="aluno" name="aluno">
            <!-- Preencha com os alunos disponíveis -->
            <?php
            // Código para listar alunos
            include 'classes/Database.php';
            $database = new Database();
            $pdo = $database->getConnection();
            $sql = "SELECT id, nome FROM usuarios WHERE tipo = 'aluno'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($alunos as $aluno) {
                echo "<option value='{$aluno['id']}'>{$aluno['nome']}</option>";
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Buscar</button>
</form>

<?php include 'includes/footer.php'; ?>
