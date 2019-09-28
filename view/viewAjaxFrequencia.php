<?php
     require_once ('../dao/DaoLogin.php');

 session_start();

// if (isset($_SESSION['user_id'])) {

    require_once("../dao/DaoFrequencia.php");

    $frequenciaDao = new DaoFrequencia();
    // $stmtMembros = $membrosDao->runQuery("SELECT * FROM membro WHERE idMembro = " . $_SESSION['user_id'] . "");
    // $stmtMembros->execute();
    // $rowMembro = $stmtMembros->fetch(PDO::FETCH_ASSOC);


    // if ($rowMembro['nivelMembro'] != 0) {

    //     header('Location: viewPainel.php');
    // }

    function mask($val, $mask) {

        $maskared = '';
        $k = 0;

        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset($val[$k])) {
                    $maskared .= $val[$k++];
                }
            } else {
                if (isset($mask[$i])) {
                    $maskared .= $mask[$i];
                }
            }
        }

        return $maskared;
    }

    $encoding = 'UTF-8';
    
    

    $stmtAuxFrequencia = $frequenciaDao->runQuery("SELECT * FROM professor WHERE idUsuario = " . $_SESSION['user_id'] . " ");
    $stmtAuxFrequencia->execute();

    while ($rowAuxiliar = $stmtAuxFrequencia->fetch(PDO::FETCH_ASSOC)) {
                $idAuxFrequencia = $rowAuxiliar['idProfessor'];
            }


    

    
            
    $stmtAux = $frequenciaDao->runQuery("SELECT DISTINCT f.dataFrequencia, f.idCurso FROM frequencia f, disciplina d, curso c WHERE f.idDisciplina = d.idDisciplina AND f.idCurso = c.idCurso AND f.idProfessor = ?  ");
    $stmtAux->bindparam(1, $idAuxFrequencia);
    $stmtAux->execute();

     $datas = array();
     $cursos = array();
     
     $n=0;
     
     $data = array();

    $i = 0;
    while ($rowAuxiliar = $stmtAux->fetch(PDO::FETCH_ASSOC)) {

                $datas[$n] = $rowAuxiliar['dataFrequencia'];
                $cursos[$n] = $rowAuxiliar['idCurso'];

                 $n++;
                        }
                        

      $vez=1;
      $j=0;


     while ($j < $n ) {



     $idAux = $datas[$j];
     $cursoF = $cursos[$j];
     $new = date('d/m/Y', strtotime($idAux ));




    $stmtFrequencia = $frequenciaDao->runQuery("SELECT * FROM frequencia f, disciplina d, curso c WHERE f.idDisciplina = d.idDisciplina AND f.idCurso = ? AND f.idCurso = c.idCurso AND f.idProfessor = ? AND f.dataFrequencia = ?");
    $stmtFrequencia->bindparam(1, $cursoF);
    $stmtFrequencia->bindparam(2, $idAuxFrequencia);
    $stmtFrequencia->bindparam(3, $idAux);
    $stmtFrequencia->execute();




    while ($rowFrequencia = $stmtFrequencia->fetch(PDO::FETCH_ASSOC)) {

         if (($j == 0) && ($vez == 1)){

        $data[$i]{'dataFrequencia'} = $new;
        $data[$i]{'disciplinaFrequencia'} = $rowFrequencia['nomeDisciplina'];
        $data[$i]{'cursoFrequencia'} = $rowFrequencia['nomeCurso'];

        $data[$i]{'button'} =

        '<div class="text-center">
            <div class="btn-group" center>
                <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Excluir" id="rowDeleteFrequencia_' . $i . '" data-curso="' . $rowFrequencia['idCurso'] . '" data-data="' . $rowFrequencia['dataFrequencia'] . '" data-disciplina="' . $rowFrequencia['idDisciplina'] . '" onclick="excluirFrequencia(' . ($i + 1) . ')">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div> ';
        $vez++;
        $i++;
       }
        else if ($vez == 1) {
         $x= ($j - 1);
         $anteidAux = $datas[$x];

         $Curso = $rowFrequencia['idCurso'];

         if (($idCurso != $Curso) || ($idAux != $anteidAux) ) {


        $data[$i]{'dataFrequencia'} = $new;
        $data[$i]{'disciplinaFrequencia'} = $rowFrequencia['nomeDisciplina'];
        $data[$i]{'cursoFrequencia'} = $rowFrequencia['nomeCurso'];

        $data[$i]{'button'} =

        '<div class="text-center">
            <div class="btn-group" center>
                <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Excluir" id="rowDeleteFrequencia_' . $i . '" data-curso="' . $rowFrequencia['idCurso'] . '" data-data="' . $rowFrequencia['dataFrequencia'] . '" data-disciplina="' . $rowFrequencia['idDisciplina'] . '" onclick="excluirFrequencia(' . ($i + 1) . ')">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div> ';

              }
        $i++;
        $vez++;
        }


        $idCurso = $rowFrequencia['idCurso'];
         }

         $j++;
         $vez=1; }


    $datax = array('data' => $data);

    function raw_json_encode($input, $flags = 0) {
        $fails = implode('|', array_filter(array(
            '\\\\',
            $flags & JSON_HEX_TAG ? 'u003[CE]' : '',
            $flags & JSON_HEX_AMP ? 'u0026' : '',
            $flags & JSON_HEX_APOS ? 'u0027' : '',
            $flags & JSON_HEX_QUOT ? 'u0022' : '',
        )));
        $pattern = "/\\\\(?:(?:$fails)(*SKIP)(*FAIL)|u([0-9a-fA-F]{4}))/";
        $callback = function ($m) {
            return html_entity_decode("&#x$m[1];", ENT_QUOTES, 'UTF-8');
        };
        return preg_replace_callback($pattern, $callback, json_encode($input, $flags));
    }

    echo raw_json_encode($datax);
// } else {
//     header('Location: viewLogin.php');
// }
?>
