<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

include 'classes/Database.php';
include 'classes/Usuario.php';

$tipoUsuario = $_SESSION['tipo'];

try {
    $database = new Database();
    $pdo = $database->getConnection();

    // Obter informações gerais do sistema (exemplo)
    $totalUsuarios = $pdo->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();
    $totalAlunos = $pdo->query("SELECT COUNT(*) FROM usuarios WHERE tipo = 'aluno'")->fetchColumn();
    $totalOrientadores = $pdo->query("SELECT COUNT(*) FROM usuarios WHERE tipo = 'orientador'")->fetchColumn();
    // Adicione mais consultas conforme necessário

} catch (PDOException $e) {
    $erro = "Erro: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container mt-5">
        <h2>Dashboard</h2>
        <?php if (isset($erro)): ?>
            <div class="alert alert-danger"><?php echo $erro; ?></div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total de Usuários</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $totalUsuarios; ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Total de Alunos</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $totalAlunos; ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Total de Orientadores</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $totalOrientadores; ?></h5>
                    </div>
                </div>
            </div>
            <!-- Adicione mais painéis conforme necessário -->
        </div>
        <a href="edit_user.php" class="btn btn-primary">Editar Usuários</a>
    </div>
</body>
</html>
