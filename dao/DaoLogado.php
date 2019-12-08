<?php

require_once('../database/Database.php');

class DaoLogado {

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


    public function atualizarDados(ModelLogado $logado) {
        try {
            //update user where idprof
            $idLogado = $logado->getIdLogado();
            $nomeLogado = $logado->getNomeLogado();
            $emailLogado = $logado->getEmailLogado();



            $stmt = $this->conn->prepare("UPDATE usuario SET nomeUsuario = ?, emailUsuario = ? WHERE idUsuario = ? ");

            $stmt->bindparam(1, $nomeLogado);
            $stmt->bindparam(2, $emailLogado);
            $stmt->bindparam(3, $idLogado);

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


    public function atualizarSenha(ModelLogado $logado) {
        try {
            //update user where idprof
            $idLogado = $logado->getIdLogado();
            $senhaLogado = $logado->getSenhaLogado();



            $stmt2 = $this->conn->prepare("UPDATE  usuario SET senhaUsuario = ? WHERE idUsuario = ?");

            $stmt2->bindparam(1, $senhaLogado);
            $stmt2->bindparam(2, $idLogado);

            $stmt2->execute();

            if ($stmt2->rowCount() > 0) {
                echo 1;
            } else {
                echo 2;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



    public function atualizarFoto(ModelLogado $logado) {
        try {
            //update user where idprof
            $idLogado = $logado->getIdLogado();
            $fotoLogado = $logado->getFotoLogado();



            $stmt3 = $this->conn->prepare("UPDATE  usuario SET fotoUsuario = ? WHERE idUsuario = ?");

            $stmt3->bindparam(1, $fotoLogado);
            $stmt3->bindparam(2, $idLogado);

            $stmt3->execute();

            if ($stmt3->rowCount() > 0) {
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
