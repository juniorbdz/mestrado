<?php
include_once 'Database.php';

class AtividadeExtracurricular {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function cadastrar($aluno_id, $curso_id, $horas, $certificado) {
        $sql = "INSERT INTO atividades_extracurriculares (aluno_id, curso_id, horas, certificado) VALUES ('$aluno_id', '$curso_id', '$horas', '$certificado')";
        return $this->db->conn->query($sql);
    }

    public function listarPorAluno($aluno_id) {
        $sql = "SELECT * FROM atividades_extracurriculares WHERE aluno_id = '$aluno_id'";
        $result = $this->db->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
