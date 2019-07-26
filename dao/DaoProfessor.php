<?php

require_once('../database/Database.php');

class DaoProfessor {

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

    public function adicionarProfessor(ModelProfessor $professor) {
        try {
            $nomeProfessor = $professor->getNomeProfessor();
            $cpfProfessor = $professor->getCpfProfessor();
            $dataProfessor = $professor->getDataProfessor();
            $emailProfessor = $professor->getEmailProfessor();
            $senhaProfessor = $professor->getSenhaProfessor();

            /*adiciona em usuario, dps em professor*/

            $stmt = $this->conn->prepare("INSERT INTO usuario(nomeUsuario, cpfUsuario, nascimentoUsuario, emailUsuario, senhaUsuario)
                 VALUES (:nome, :cpf, :datax, :email, :senha)");
                
            $stmt->bindparam(":nome", $nomeProfessor);
            $stmt->bindparam(":datax", $dataProfessor);
            $stmt->bindparam(":cpf", $cpfProfessor);
            $stmt->bindparam(":email", $emailProfessor);
            $stmt->bindparam(":senha", $senhaProfessor);
            $stmt->execute();
            
            //FAZER ISSO COM TRIGGER FUTURAMENTE
            $ultimoId = $this->conn->lastInsertId();
            $stmt2 = $this->conn->prepare("INSERT INTO professor(idUsuario)
                 VALUES (:id)");
            $stmt2->bindparam(":id", $ultimoId);
            $stmt2->execute();

            if ($stmt->rowCount() > 0 AND $stmt2->rowCount() > 0) {
                echo 1;
            } else {
                echo 2;
            }
            
            } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function atualizarProfessor(ModelProfessor $professor) {
        try {
            //update user where idprof
            $idProfessor = $professor->getIdProfessor();
            $nomeProfessor = $professor->getNomeProfessor();
            $cpfProfessor = $professor->getCpfProfessor();
            $dataProfessor = $professor->getDataProfessor();
            $emailProfessor = $professor->getEmailProfessor();
            $senhaProfessor = $professor->getSenhaProfessor();


            $stmt = $this->conn->prepare("UPDATE professor p, usuario u SET u.nomeUsuario = ?, u.cpfUsuario = ?, u.nascimentoUsuario = ?, u.emailUsuario = ?, u.senhaUsuario = ? WHERE p.idProfessor = ? AND u.idUsuario = p.idUsuario");

            $stmt->bindparam(1, $nomeProfessor);
            $stmt->bindparam(2, $cpfProfessor);
            $stmt->bindparam(3, $dataProfessor);
            $stmt->bindparam(4, $emailProfessor);
            $stmt->bindparam(5, $senhaProfessor);
            $stmt->bindparam(6, $idProfessor);
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

    public function excluirProfessor(ModelProfessor $professor) {
        try {
            $id = $professor->getIdProfessor();
            $idAux = null;
            $stmtAux = $this->conn->prepare("SELECT idUsuario FROM professor WHERE idProfessor = ?");
            $stmtAux->bindparam(1, $id);
            $stmtAux->execute();
            while ($rowAuxiliar = $stmtAux->fetch(PDO::FETCH_ASSOC)) {
                $idAux = $rowAuxiliar['idUsuario'];
            }


            $stmt = $this->conn->prepare("DELETE FROM professor WHERE idProfessor = ?");
            $stmt->bindparam(1, $id);
            $stmt->execute();

            $stmt2 = $this->conn->prepare("DELETE FROM usuario WHERE idUsuario = ?");
            $stmt2->bindparam(1, $idAux);
            $stmt2->execute();


            if ($stmt->rowCount() > 0 && $stmtAux->rowCount() > 0 && $stmt2->rowCount() > 0) {
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