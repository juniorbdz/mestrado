<?php
class Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Função de login
    public function login($email, $senha) {
        // Define variáveis intermediárias para evitar o aviso
        $emailVar = $email;
        $senhaVar = md5($senha);

        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
        $stmt->bindParam(':email', $emailVar);
        $stmt->bindParam(':senha', $senhaVar);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Configurar a sessão
            $_SESSION['email'] = $user['email'];
            $_SESSION['tipo'] = $user['tipo'];
            return true;
        }
        return false;
    }

    // Verifica se o usuário está logado
    public function isLoggedIn() {
        return isset($_SESSION['email']);
    }

    // Função para fazer logout
    public function logout() {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit;
    }

    // Recupera o tipo do usuário da sessão
    public function getTipoUsuario() {
        return isset($_SESSION['tipo']) ? $_SESSION['tipo'] : null;
    }

    // Função para contar o número de usuários por tipo
    public function contarUsuariosPorTipo($tipo) {
        $tipoVar = $tipo;
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE tipo = :tipo");
        $stmt->bindParam(':tipo', $tipoVar);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    // Função para contar o número total de cursos
    public function contarCursos() {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM cursos");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    // Função para contar o número de cursos por tipo
    public function contarCursosPorTipo($tipo_curso) {
        $tipoCursoVar = $tipo_curso;
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM cursos WHERE tipo_curso = :tipo_curso");
        $stmt->bindParam(':tipo_curso', $tipoCursoVar);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    // Função para contar orientadores com e sem orientandos
    public function contarOrientadores() {
        $stmt = $this->pdo->prepare("
            SELECT 
                COUNT(*) AS total_orientadores,
                SUM(CASE WHEN (SELECT COUNT(*) FROM orientacoes WHERE orientador_id = u.id) > 0 THEN 1 ELSE 0 END) AS orientadores_com_orientandos
            FROM usuarios u
            WHERE tipo = 'orientador'
        ");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
