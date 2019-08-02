<?php

require_once('../database/Database.php');

class DaoRegistro {

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

    public function adicionarRegistro(ModelRegistro $Registro) {
        try {
            $nomeRegistro = $Registro->getNomeRegistro();
            $cpfRegistro = $Registro->getCpfRegistro();
            $dataRegistro = $Registro->getDataRegistro();
            $emailRegistro = $Registro->getEmailRegistro();
            $senhaRegistro = $Registro->getSenhaRegistro();
            $cursoRegistro = $Registro->getCursoRegistro();
            date_default_timezone_set('America/Sao_Paulo');
            $dataInscricao = date("d/m/Y H:i:s");
            $statusInscricao = 0;


            $stmt = $this->conn->prepare("INSERT INTO usuario(nomeUsuario, cpfUsuario, nascimentoUsuario, emailUsuario, senhaUsuario)
                 VALUES (:nome, :cpf, :datax, :email, :senha)");
                
            $stmt->bindparam(":nome", $nomeRegistro);
            $stmt->bindparam(":datax", $dataRegistro);
            $stmt->bindparam(":cpf", $cpfRegistro);
            $stmt->bindparam(":email", $emailRegistro);
            $stmt->bindparam(":senha", $senhaRegistro);
            $stmt->execute();
            
            
            $ultimoId = $this->conn->lastInsertId();
            $stmt2 = $this->conn->prepare("INSERT INTO inscricao_aluno(idUsuario, idCurso, statusInscricao, dataInscricao)
                 VALUES (:id, :curso, :statusy, :datay)");
            $stmt2->bindparam(":id", $ultimoId);
            $stmt2->bindparam(":curso", $cursoRegistro);
            $stmt2->bindparam(":statusy", $statusInscricao);
            $stmt2->bindparam(":datay", $dataInscricao);
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

    public function atualizarRegistro(ModelRegistro $Registro) {
        try {
            //update user where idprof
            $idRegistro = $Registro->getIdRegistro();
            $nomeRegistro = $Registro->getNomeRegistro();
            $cpfRegistro = $Registro->getCpfRegistro();
            $dataRegistro = $Registro->getDataRegistro();
            $emailRegistro = $Registro->getEmailRegistro();
            $senhaRegistro = $Registro->getSenhaRegistro();
            $idCurso = $Registro->getIdCurso();



            $stmt = $this->conn->prepare("UPDATE Registro a, usuario u, matricula_curso m SET u.nomeUsuario = ?, u.cpfUsuario = ?, u.nascimentoUsuario = ?, u.emailUsuario = ?, u.senhaUsuario = ?, m.idCurso = ? WHERE a.idRegistro = ? AND u.idUsuario = a.idUsuario AND m.idRegistro = a.idRegistro");

            $stmt->bindparam(1, $nomeRegistro);
            $stmt->bindparam(2, $cpfRegistro);
            $stmt->bindparam(3, $dataRegistro);
            $stmt->bindparam(4, $emailRegistro);
            $stmt->bindparam(5, $senhaRegistro);
            $stmt->bindparam(6, $idCurso);
            $stmt->bindparam(7, $idRegistro);

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

    public function excluirRegistro(ModelRegistro $Registro) {
        try {
            $id = $Registro->getIdRegistro();
            $idAux = null;
            $stmtAux = $this->conn->prepare("SELECT idUsuario FROM Registro WHERE idRegistro = ?");
            $stmtAux->bindparam(1, $id);
            $stmtAux->execute();
            while ($rowAuxiliar = $stmtAux->fetch(PDO::FETCH_ASSOC)) {
                $idAux = $rowAuxiliar['idUsuario'];
            }


            $stmt = $this->conn->prepare("DELETE FROM Registro WHERE idRegistro = ?");
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