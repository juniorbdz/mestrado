<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] != 'orientador') {
    header("Location: login.php");
    exit();
}

include 'classes/Usuario.php';
include 'classes/Atividade.php';
include 'includes/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['aluno_id'])) {
    $aluno_id = $_POST['aluno_id'];

    $usuario = new Usuario();
    $aluno = $usuario->getAlunoById($aluno_id);

    $atividade = new Atividade();
    $atividades = $atividade->getAtividadesByAluno($aluno_id);
} else {
    header("Location: relatorio_atividades_por_aluno.php");
    exit();
}
?>

<h1>Relatório de Atividades de <?php echo htmlspecialchars($aluno['nome']); ?></h1>

<div class="panel panel-default">
    <div class="panel-heading">Atividades Extracurriculares</div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome do Curso</th>
                    <th>Horas</th>
                    <th>Certificado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($atividades as $atividade): ?>
                <tr>
                    <td><?php echo htmlspecialchars($atividade['nome_curso']); ?></td>
                    <td><?php echo htmlspecialchars($atividade['horas']); ?></td>
                    <td>
                        <a href="uploads/<?php echo htmlspecialchars($atividade['certificado']); ?>" target="_blank">
                            <i class="fas fa-file-pdf"></i> Ver Certificado
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
