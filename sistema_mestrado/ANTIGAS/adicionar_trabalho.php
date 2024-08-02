<?php
session_start();
if ($_SESSION['tipo'] != 'aluno') {
    header("Location: index.php");
    exit();
}

include 'classes/Database.php';


$usuario = new Usuario();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $id = $_SESSION['id'];

    $resultado = $usuario->adicionarTrabalho($id, $titulo, $descricao);

    if ($resultado) {
        $mensagem = "Trabalho científico adicionado com sucesso!";
    } else {
        $mensagem = "Erro ao adicionar o trabalho científico.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Trabalho Científico</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Adicionar Trabalho Científico</h2>
        <?php if (isset($mensagem)): ?>
            <div class="alert alert-info"><?php echo $mensagem; ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea class="form-control" id="descricao" name="descricao" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </form>
    </div>
</body>
</html>
