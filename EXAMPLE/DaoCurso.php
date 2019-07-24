<?php

require_once('../database/Database.php');

class DaoCurso {

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

    public function adicionarCurso(ModelCurso $curso) {
        try {
            $nomeCurso = $curso->getNomeCurso();
            $descricaoCurso = $curso->getDescricaoCurso();


            $stmt = $this->conn->prepare("INSERT INTO curso(nomeCurso, descricaoCurso)
                 VALUES (:nome, :descricao)");

                
            $stmt->bindparam(":nome", $nomeCurso);
            $stmt->bindparam(":descricao", $descricaoCurso);
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

    public function atualizarCurso(ModelCurso $curso) {
        try {
            $id = $curso->getIdCurso();
            $nome = $curso->getNomeCurso();
            $descricao = $curso->getDescricaoCurso();


            $stmt = $this->conn->prepare("UPDATE curso SET nomeCurso = ?, descricaoCurso = ? WHERE idCurso = ?");

            $stmt->bindparam(1, $nome);
            $stmt->bindparam(2, $descricao);
            $stmt->bindparam(3, $id);
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

    public function excluirCurso(ModelCurso $curso) {
        try {
            $id = $curso->getIdCurso();
            $stmt = $this->conn->prepare("DELETE FROM curso WHERE idCurso = ?");

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