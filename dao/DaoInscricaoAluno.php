<?php

require_once('../database/Database.php');

class DaoInscricaoAluno {

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

    public function aceitarInscricao(ModelInscricaoAluno $aluno) {
        try {
            $idInscricao = $aluno->getIdInscricao();
            $statusInscricao = $aluno->getStatusInscricao();
            $idCurso = $aluno->getIdCurso();
            $idUsuario = $aluno->getIdUsuario();
            date_default_timezone_set('America/Sao_Paulo');
            $dataInscricao = date("d/m/Y H:i:s");
            //insere em aluno, dps em matricula_curso, dps atualiza o status do inscricao_aluno

            $stmt = $this->conn->prepare("INSERT INTO aluno(idUsuario)
                 VALUES (:id)");
                
            $stmt->bindparam(":id", $idUsuario);
            $stmt->execute();
            
        

            $ultimoId = $this->conn->lastInsertId();
            $stmt2 = $this->conn->prepare("INSERT INTO matricula_curso(idAluno, idCurso, dataMatricula)
            VALUES (:idA, :idC, :datax)");
            $stmt2->bindparam(":idA", $ultimoId);
            $stmt2->bindparam(":idC", $idCurso);
            $stmt2->bindparam(":datax", $dataInscricao);
            $stmt2->execute();


            $stmt3 = $this->conn->prepare("UPDATE inscricao_aluno i SET i.statusInscricao = ? WHERE i.idInscricao = ?");
            $stmt3->bindparam(1, $statusInscricao);
            $stmt3->bindparam(2, $idInscricao);
            $stmt3->execute();


            if ($stmt->rowCount() > 0 AND $stmt2->rowCount() > 0 AND $stmt3->rowCount() > 0) {
                echo 1;
            } else {
                echo 2;
            }
            
            } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function rejeitarInscricao(ModelInscricaoAluno $aluno) {
        try {
            $idInscricao = $aluno->getIdInscricao();
            $statusInscricao = $aluno->getStatusInscricao();
         

            $stmt = $this->conn->prepare("UPDATE inscricao_aluno i SET i.statusInscricao = ? WHERE i.idInscricao = ?");

            $stmt->bindparam(1, $statusInscricao);
            $stmt->bindparam(2, $idInscricao);

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