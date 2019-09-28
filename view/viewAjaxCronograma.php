<?php

session_start();

// if (isset($_SESSION['user_id'])) {

    require_once("../dao/DaoCronograma.php");
    
    $cronogramasDao = new DaoCronograma();
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

    $session= $_SESSION['user_id'];
    $query = $cronogramaDao->runQuery("SELECT * FROM professor WHERE idUsuario =". $session ."");
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){

               $idAux = $row['idProfessor'];
   }

   if (isset($_SESSION['ano'])){

    $dataForm = $_SESSION['ano'];

    }

     else{

     $dataForm = date('Y');
     }

    $stmtCronograma = $cronogramasDao->runQuery("SELECT * FROM  cronograma WHERE idProfessor =" .  $idAux . " AND LEFT(dataCronograma,4) LIKE '$dataForm' AND idCurso =" . $_SESSION['curso'] . " AND idDisciplina = " . $_SESSION['disciplina'] . " ORDER BY dataCronograma DESC");
    $stmtCronograma->execute();


    $data = array();

    $i = 0;

    while ($rowCronograma = $stmtCronograma->fetch(PDO::FETCH_ASSOC)) {

        $new = date('d/m/Y', strtotime($rowCronograma['dataCronograma'] ));

        $data[$i]{'timeline'} ='<li>
                                   <div class="list-timeline-time">' . $new . '
                                      </div>
                                         <button type="button" class="btn btn-sm list-timeline-icon bg-elegance" data-toggle="tooltip" title="Editar" id="rowEditarCronograma_' . $i . '" data-id="' . $rowCronograma['idCronograma'] . '" data-titulo="' . $rowCronograma['tituloCronograma'] . '" data-data="' . $new . '" data-descricao="' . $rowCronograma['descricaoCronograma'] . '" onclick="editarCronograma(' . ($i) . ')">
                                          <i class="fa fa-pencil-square-o fa-2x">
                                        </i>
                                      </button>
                                  <div class="list-timeline-content" style="width:100%;">
                                <p> ' . $rowCronograma['tituloCronograma'] . ' ...
                               <div style="float: right;">
                             <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Excluir" id="rowDeleteCronograma_' . $i . '" data-id="' . $rowCronograma['idCronograma'] . '" onclick="excluirCronograma(' . ($i) . ')">
                          <i class="fa fa-times"></i>
                      </button>  </div>  </p>
                 </div> </li><BR>  <BR>';
            
            

        $i++;
    }

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
