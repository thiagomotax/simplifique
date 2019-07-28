<?php

require_once('../database/Database.php');

class DaoDisciplina {

    private $conn;

    public function __construct() {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function runQuery($sql) {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    public function adicionarDisciplina(ModelDisciplina $disciplina) {
        try {
            $idCurso = $disciplina->getIdCurso();
            $idProfessor = $disciplina->getIdProfessor();
            $nomeDisciplina = $disciplina->getNomeDisciplina();
            $anoDisciplina = $disciplina->getAnoDisciplina();



            $stmt = $this->conn->prepare("INSERT INTO disciplina(idCurso, idProfessor, nomeDisciplina, anoDisciplina)
                 VALUES (:idC, :idP, :nome, :ano)");

                
            $stmt->bindparam(":idC", $idCurso);
            $stmt->bindparam(":idP", $idProfessor);
            $stmt->bindparam(":nome", $nomeDisciplina);
            $stmt->bindparam(":ano", $anoDisciplina);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo 1;
            } else {
                echo 2;
            }
            
            } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function atualizarDisciplina(ModelDisciplina $disciplina) {
        try {
            $idDisciplina = $disciplina->getIdDisciplina();
            $idCurso = $disciplina->getIdCurso();
            $idProfessor = $disciplina->getIdProfessor();
            $nomeDisciplina = $disciplina->getNomeDisciplina();
            $anoDisciplina = $disciplina->getAnoDisciplina();



            $stmt = $this->conn->prepare("UPDATE disciplina SET idCurso = ?, idProfessor = ?, nomeDisciplina = ?, anoDisciplina = ? WHERE idDisciplina = ?");
            // $stmt = $this->conn->prepare("UPDATE disciplina SET nomeDisciplina = ?, anoDisciplina = ? WHERE idDisciplina = ?");

            $stmt->bindparam(1, $idCurso);
            $stmt->bindparam(2, $idProfessor);
            $stmt->bindparam(3, $nomeDisciplina);
            $stmt->bindparam(4, $anoDisciplina);
            $stmt->bindparam(5, $idDisciplina);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo 1;
            } else {
                echo 2;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function excluirDisciplina(ModelDisciplina $disciplina) {
        try {
            $id = $disciplina->getIdDisciplina();
            $stmt = $this->conn->prepare("DELETE FROM disciplina WHERE idDisciplina = ?");

            $stmt->bindparam(1, $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo 1;
            } else {
                echo 2;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }
}
?>