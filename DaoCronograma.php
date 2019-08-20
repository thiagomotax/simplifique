<?php

require_once('../database/Database.php');


$con=mysqli_connect("localhost","root","","bd_simplifique");

class DaoCronograma {

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























    public function adicionarCronograma(ModelCronograma $cronograma) {
        try {

            $disciplinaCronograma= $cronograma->getDisciplinaCronograma();

            $cursoCronograma = $cronograma->getCursoCronograma();

            $dataCronograma = $cronograma->getDataCronograma();

            $tituloCronograma = $cronograma->getTituloCronograma();

            $descricaoCronograma = $cronograma->getDescricaoCronograma();

            $stmtAuxCronograma = $this->conn->prepare("SELECT * FROM professor WHERE idUsuario = " . $_SESSION['user_id'] . " ");
            $stmtAuxCronograma->execute();




             while ($rowAuxiliar = $stmtAuxCronograma->fetch(PDO::FETCH_ASSOC)) {
                $idAuxCronograma = $rowAuxiliar['idProfessor'];
                 }



            $stmt = $this->conn->prepare("INSERT INTO cronograma(idDisciplina, idCurso, idProfessor, dataCronograma, descricaoCronograma, tituloCronograma)
            VALUES (:disciplinaCronograma, :cursoCronograma, :professorCronograma, :data, :descricao, :titulo)");

                       $stmt->bindparam(":disciplinaCronograma", $disciplinaCronograma);
                       $stmt->bindparam(":cursoCronograma", $cursoCronograma);
                       $stmt->bindparam(":professorCronograma", $idAuxCronograma);
                       $stmt->bindparam(":data", $dataCronograma);
                       $stmt->bindparam(":descricao", $descricaoCronograma);
                       $stmt->bindparam(":titulo", $tituloCronograma);


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

























    public function atualizarCronograma(ModelCronograma $cronograma) {
        try {
            //update user where idprof
            $idCronograma = $cronograma->getIdCronograma();
            $descricaoCronograma = $cronograma->getDescricaoCronograma();
            $tituloCronograma = $cronograma->getTituloCronograma();
            $dataCronograma = $cronograma->getDataCronograma();

            $stmt = $this->conn->prepare("UPDATE cronograma SET  tituloCronograma = ?, descricaoCronograma = ?, dataCronograma = ?   WHERE idCronograma = ?");


            $stmt->bindparam(1, $tituloCronograma);
            $stmt->bindparam(2, $descricaoCronograma);
            $stmt->bindparam(3, $dataCronograma);
            $stmt->bindparam(4, $idCronograma);
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


















    public function excluirCronograma(ModelCronograma $cronograma) {
        try {

            $idCronograma= $cronograma->getIdCronograma();

            
            $stmt = $this->conn->prepare("DELETE FROM cronograma WHERE idCronograma = ?");
            $stmt->bindparam(1, $idCronograma);
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
