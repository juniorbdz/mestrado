<?php
class Curso {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function contarCursos() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM cursos");
        return $stmt->fetchColumn();
    }

    public function contarCursosPorTipo() {
        $stmt = $this->pdo->query("SELECT tipo_curso, COUNT(*) as count FROM cursos GROUP BY tipo_curso");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
