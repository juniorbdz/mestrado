<?php
include_once 'Database.php';

class Orientacao {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function cadastrar($orientador_id, $aluno_id, $data, $descricao) {
        $sql = "INSERT INTO orientacoes (orientador_id, aluno_id, data, descricao) VALUES ('$orientador_id', '$aluno_id', '$data', '$descricao')";
        return $this->db->conn->query($sql);
    }

    public function listarPorOrientador($orientador_id) {
        $sql = "SELECT * FROM orientacoes WHERE orientador_id = '$orientador_id'";
        $result = $this->db->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
