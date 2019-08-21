<?php

require_once('../database/Database.php');




class DaoNoticia {

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

    public function adicionarNoticia(ModelNoticia $noticia) {
        try {
            $tituloNoticia = $noticia->getTituloNoticia();
            $descricaoNoticia= $noticia->getDescricaoNoticia();
            $cursoNoticia = $noticia->getCursoNoticia();
            date_default_timezone_set('America/Sao_Paulo');
            $dataNoticia = date("d/m/Y H:i:s");

            
            $stmtAux = $this->conn->prepare("SELECT * FROM professor WHERE idUsuario = " . $_SESSION['user_id'] . " ");
            $stmtAux->execute();




             while ($rowAuxiliar = $stmtAux->fetch(PDO::FETCH_ASSOC)) {
                $idAux = $rowAuxiliar['idProfessor'];
                 }

            $stmt = $this->conn->prepare("INSERT INTO noticia(idProfessor, nomeNoticia, descricaoNoticia, dataNoticia, idCurso)
                 VALUES (:idProfessor, :nome, :descricao, :data, :curso)");
                 
            $stmt->bindparam(":idProfessor", $idAux);
            $stmt->bindparam(":nome", $tituloNoticia);
            $stmt->bindparam(":data", $dataNoticia);
            $stmt->bindparam(":descricao", $descricaoNoticia);
            $stmt->bindparam(":curso", $cursoNoticia);

            $stmt->execute();

            //FAZER ISSO COM TRIGGER FUTURAMENTE


            if ($stmt->rowCount() > 0) {
                echo 1;
            } else {
                echo 2;
            }

            } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function atualizarNoticia(ModelNoticia $noticia) {
        try {
            //update user where idprof
            $idNoticia = $noticia->getIdNoticia();
            $tituloNoticia = $noticia->getTituloNoticia();
            $descricaoNoticia= $noticia->getDescricaoNoticia();
            $cursoNoticia = $noticia->getCursoNoticia();
            date_default_timezone_set('America/Sao_Paulo');
            $dataNoticia = date("d/m/Y H:i:s");





            $stmt = $this->conn->prepare("UPDATE noticia SET idCurso = ?, nomeNoticia = ?, dataNoticia = ?, descricaoNoticia = ? WHERE idNoticia = ?");

            $stmt->bindparam(1, $cursoNoticia);
            $stmt->bindparam(2, $tituloNoticia);
            $stmt->bindparam(3, $dataNoticia);
            $stmt->bindparam(4, $descricaoNoticia);
            $stmt->bindparam(5, $idNoticia);
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

    public function excluirNoticia(ModelNoticia $noticia) {
        try {

            $idNoticia = $noticia->getIdNoticia();

            $stmt = $this->conn->prepare("DELETE FROM noticia WHERE idNoticia = ?");
            $stmt->bindparam(1, $idNoticia);
            $stmt->execute();




            if ($stmt->rowCount() > 0 ) {
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
