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
        $senhaVar = md5($senha); // Certifique-se de que o hashing corresponde ao armazenamento

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

    // Recupera o tipo do usuário da sessão
    public function getTipoUsuario() {
        return isset($_SESSION['tipo']) ? $_SESSION['tipo'] : null;
    }
}
?>
