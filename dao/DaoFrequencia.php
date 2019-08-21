<?php

require_once('../database/Database.php');


$con=mysqli_connect("localhost","root","","bd_simplifique");

class DaoFrequencia {

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























    public function adicionarFrequencia(ModelFrequencia $frequencia) {
        try {

            $disciplinaFrequencia= $frequencia->getDisciplinaFrequencia();

            $cursoFrequencia = $frequencia->getCursoFrequencia();

            $dataFrequencia = $frequencia->getDataFrequencia();




            $stmtAuxFrequencia = $this->conn->prepare("SELECT * FROM professor WHERE idUsuario = " . $_SESSION['user_id'] . " ");
            $stmtAuxFrequencia->execute();
    

    

             while ($rowAuxiliar = $stmtAuxFrequencia->fetch(PDO::FETCH_ASSOC)) {
                $idAuxFrequencia = $rowAuxiliar['idProfessor'];
                 }



                 $busca=$this->conn->prepare("SELECT * FROM  frequencia  WHERE idCurso = " . $cursoFrequencia . "  AND idDisciplina = " . $disciplinaFrequencia . " AND idProfessor = " . $idAuxFrequencia . " AND  dataFrequencia LIKE '$dataFrequencia' ");
                 $busca->execute();
                 
                 
                 

                 if($busca->rowCount() < 1){

                 $stmtAux = $this->conn->prepare("SELECT * FROM matricula_curso WHERE idCurso = ?");
                 $stmtAux->bindparam(1, $cursoFrequencia);
                 $stmtAux->execute();

                 $idAux = array();
                 $i=0;
                 
                 

	             while ($row = $stmtAux->fetch(PDO::FETCH_ASSOC) ) {


                        $idAux[$i] = $row['idAluno'];

                        $i++;
                        }



                 if ($stmtAux){

                        $j=0;


                 while ($j < $i ) {



                       $idA = $idAux[$j];

                       $stmt = $this->conn->prepare("INSERT INTO frequencia(idDisciplina, idCurso, idAluno, idProfessor, dataFrequencia)
                       VALUES (:disciplinaFrequencia, :cursoFrequencia, :alunoFrequencia, :professorFrequencia, :data)");

                       $stmt->bindparam(":disciplinaFrequencia", $disciplinaFrequencia);
                       $stmt->bindparam(":cursoFrequencia", $cursoFrequencia);
                       $stmt->bindparam(":alunoFrequencia", $idA);
                       $stmt->bindparam(":professorFrequencia", $idAuxFrequencia);
                       $stmt->bindparam(":data", $dataFrequencia);


                       $stmt->execute();

                        $j++;

            }   }  }
            
            else {
            
              echo 1;

            }

            //FAZER ISSO COM TRIGGER FUTURAMENTE
           if($busca->rowCount() < 1){
           
            if ($stmtAux->rowCount() > 0) {
                echo 1;
            } else {
                echo 2;
            }
               }
               
            } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

























    public function atualizarFrequencia(ModelFrequencia $frequencia) {
        try {
            //update user where idprof
            $idFrequencia = $frequencia->getIdFrequencia();
            $situacaoFrequencia = $frequencia->getSituacaoFrequencia();

            $stmt = $this->conn->prepare("UPDATE frequencia SET  statusFrequencia = ?   WHERE idFrequencia = ?");


            $stmt->bindparam(1, $situacaoFrequencia);

            $stmt->bindparam(2, $idFrequencia);
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


















    public function excluirFrequencia(ModelFrequencia $frequencia) {
        try {

            $disciplinaFrequencia= $frequencia->getDisciplinaFrequencia();

            $cursoFrequencia = $frequencia->getCursoFrequencia();

            $dataFrequencia = $frequencia->getDataFrequencia();
            
            
            
            $stmtAuxFrequencia = $this->conn->prepare("SELECT * FROM professor WHERE idUsuario = " . $_SESSION['user_id'] . " ");
            $stmtAuxFrequencia->execute();




             while ($rowAuxiliar = $stmtAuxFrequencia->fetch(PDO::FETCH_ASSOC)) {
                $idAuxFrequencia = $rowAuxiliar['idProfessor'];
                 }



            $stmt = $this->conn->prepare("DELETE FROM frequencia WHERE idDisciplina = ? AND idCurso = ? AND idProfessor = ? AND dataFrequencia = ?");

            $stmt->bindparam(1, $disciplinaFrequencia);
            $stmt->bindparam(2, $cursoFrequencia);
            $stmt->bindparam(3, $idAuxFrequencia);
            $stmt->bindparam(4, $dataFrequencia);


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
