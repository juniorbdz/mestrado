<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

include 'classes/Database.php';
include 'classes/Usuario.php';

try {
    $database = new Database();
    $pdo = $database->getConnection();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario_id = $_POST['usuario_id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = !empty($_POST['senha']) ? password_hash($_POST['senha'], PASSWORD_DEFAULT) : null;
        $tipo = $_POST['tipo'];

        $stmt = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, tipo = :tipo" . ($senha ? ", senha = :senha" : "") . " WHERE id = :id");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':tipo', $tipo);
        if ($senha) {
            $stmt->bindParam(':senha', $senha);
        }
        $stmt->bindParam(':id', $usuario_id);

        if ($stmt->execute()) {
            $mensagem = "Usuário atualizado com sucesso.";
        } else {
            $erro = "Erro ao atualizar o usuário.";
        }
    }

    $usuarios = $pdo->query("SELECT * FROM usuarios")->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $erro = "Erro: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuários</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container mt-5">
        <h2>Editar Usuários</h2>
        <?php if (isset($erro)): ?>
            <div class="alert alert-danger"><?php echo $erro; ?></div>
        <?php elseif (isset($mensagem)): ?>
            <div class="alert alert-success"><?php echo $mensagem; ?></div>
        <?php endif; ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <form method="post" action="">
                            <td><input type="text" class="form-control" name="nome" value="<?php echo $usuario['nome']; ?>"></td>
                            <td><input type="email" class="form-control" name="email" value="<?php echo $usuario['email']; ?>"></td>
                            <td>
                                <select class="form-control" name="tipo">
                                    <option value="aluno" <?php echo $usuario['tipo'] == 'aluno' ? 'selected' : ''; ?>>Aluno</option>
                                    <option value="orientador" <?php echo $usuario['tipo'] == 'orientador' ? 'selected' : ''; ?>>Orientador</option>
                                    <option value="administrador" <?php echo $usuario['tipo'] == 'administrador' ? 'selected' : ''; ?>>Administrador</option>
                                </select>
                            </td>
                            <td>
                                <input type="hidden" name="usuario_id" value="<?php echo $usuario['id']; ?>">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
