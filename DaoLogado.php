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
            $cpfLogado = $logado->getCpfLogado();
            $emailLogado = $logado->getEmailLogado();



            $stmt = $this->conn->prepare("UPDATE usuario SET nomeUsuario = ?, cpfUsuario = ?, emailUsuario = ? WHERE idLogado = ? ");

            $stmt->bindparam(1, $nomeLogado);
            $stmt->bindparam(2, $cpfLogado);
            $stmt->bindparam(3, $emailLogado);
            $stmt->bindparam(4, $idLogado);

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



            $stmt2 = $this->conn->prepare("UPDATE  usuario SET senhaUsuario = ? WHERE idLogado = ?");

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


}
?>
