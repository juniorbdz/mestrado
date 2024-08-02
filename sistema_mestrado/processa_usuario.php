<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'classes/Database.php';

try {
    $database = new Database();
    $pdo = $database->getConnection();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = trim($_POST['nome']);
        $email = trim($_POST['email']);
        $senha = password_hash(trim($_POST['senha']), PASSWORD_DEFAULT);
        $tipo = trim($_POST['tipo']);

        // Campos adicionais
        $matricula = isset($_POST['matricula']) ? trim($_POST['matricula']) : null;
        $endereco = isset($_POST['endereco']) ? trim($_POST['endereco']) : null;
        $cpf = isset($_POST['cpf']) ? trim($_POST['cpf']) : null;
        $curso = isset($_POST['curso']) ? trim($_POST['curso']) : null;
        $tipo_curso = isset($_POST['tipo_curso']) ? trim($_POST['tipo_curso']) : null;

        // Verificar se o e-mail já está cadastrado
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $erro = "O e-mail já está cadastrado.";
        } else {
            // Preparar e executar a inserção
            $sql = "INSERT INTO usuarios (nome, email, senha, tipo, matricula, endereco, cpf, curso, tipo_curso) 
                    VALUES (:nome, :email, :senha, :tipo, :matricula, :endereco, :cpf, :curso, :tipo_curso)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':matricula', $matricula);
            $stmt->bindParam(':endereco', $endereco);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':curso', $curso);
            $stmt->bindParam(':tipo_curso', $tipo_curso);

            if ($stmt->execute()) {
                $sucesso = "Usuário adicionado com sucesso!";
            } else {
                $erro = "Erro ao adicionar o usuário: " . implode(", ", $stmt->errorInfo());
            }
        }
    }
} catch (PDOException $e) {
    $erro = "Erro: " . $e->getMessage();
}

header('Location: adicionar_usuario.php?' . http_build_query(array('erro' => $erro, 'sucesso' => $sucesso)));
exit;
?>
