<?php

require_once('../database/Database.php');

class DaoAnexo {

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

    public function adicionarAnexo(ModelAnexo $anexo) {
        try {
        
            $stmtAux = $this->conn->prepare("SELECT * FROM professor WHERE idUsuario = " . $_SESSION['user_id'] . " ");
            $stmtAux->execute();




             while ($rowAuxiliar = $stmtAux->fetch(PDO::FETCH_ASSOC)) {
                $idAux = $rowAuxiliar['idProfessor'];
                 }
                 
            $disciplinaAnexo = $anexo->getDisciplinaAnexo();
            $tituloAnexo = $anexo->getTituloAnexo();
            $fileAnexo = $anexo->getFileAnexo();
            $cursoAnexo = $anexo->getCursoAnexo();
            $urlAnexo = $anexo->getUrlAnexo();
            date_default_timezone_set('America/Sao_Paulo');
            $dataAnexo = date("d/m/Y H:i:s");


            $stmt = $this->conn->prepare("INSERT INTO anexo(idDisciplina, nomeAnexo, dataAnexo, materialAnexo, idCurso, urlAnexo, idProfessor)
                 VALUES (:disciplina, :titulo, :data,  :file, :curso, :url, :idP)");

            $stmt->bindparam(":disciplina", $disciplinaAnexo);
            $stmt->bindparam(":titulo", $tituloAnexo);
            $stmt->bindparam(":data", $dataAnexo);
            $stmt->bindparam(":file", $fileAnexo);
            $stmt->bindparam(":curso", $cursoAnexo);
            $stmt->bindparam(":url", $urlAnexo);
            $stmt->bindparam(":idP", $idAux);

            $stmt->execute();
            
            //FAZER ISSO COM TRIGGER FUTURAMENTE


            if ($stmt->rowCount() ) {
                echo 1;
            } else {
                echo 2;
            }
            
            } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function atualizarAnexo(ModelAnexo $anexo) {
        try {
            //update user where idprof
            $idAnexo = $anexo->getIdAnexo();
            $disciplinaAnexo = $anexo->getDisciplinaAnexo();
            $tituloAnexo = $anexo->getTituloAnexo();
            $fileAnexo = $anexo->getFileAnexo();
            $cursoAnexo = $anexo->getCursoAnexo();
            $urlAnexo = $anexo->getUrlAnexo();
            date_default_timezone_set('America/Sao_Paulo');
            $dataAnexo = date("d/m/Y H:i:s");



            $stmt = $this->conn->prepare("UPDATE anexo SET idDisciplina = ?, nomeAnexo = ?, dataAnexo = ?, materialAnexo = ?, idCurso = ?, urlAnexo = ? WHERE idAnexo = ? ");

            $stmt->bindparam(1, $disciplinaAnexo);
            $stmt->bindparam(2, $tituloAnexo);
            $stmt->bindparam(3, $dataAnexo);
            $stmt->bindparam(4, $fileAnexo);
            $stmt->bindparam(5, $cursoAnexo);
            $stmt->bindparam(6, $urlAnexo);
            $stmt->bindparam(7, $idAnexo);
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

    public function excluirAnexo(ModelAnexo $anexo) {
        try {
            $id = $anexo->getIdAnexo();

            $stmt = $this->conn->prepare("DELETE FROM anexo WHERE idAnexo = ?");
            $stmt->bindparam(1, $id);
            $stmt->execute();


            if ($stmt->rowCount() ) {
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
