<?php

// session_start();

// if (isset($_SESSION['user_id'])) {


require_once ('../dao/DaoLogin.php');

$loginDao = new DaoLogin();


 session_start();



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
 
  $data = array();
  $i = 0;

 if (isset($_POST['idDisciplina'])){
    $_SESSION['idDisciplina']= $_POST['idDisciplina'];
    }
    else if (!isset($_SESSION['idDisciplina'])){
     $_SESSION['idDisciplina']= -1;
     }

$query = $loginDao->runQuery("SELECT * FROM cronograma c, aluno a, matricula_curso m  WHERE a.idUsuario =" . $_SESSION['user_id'] . " AND a.idAluno = m.idAluno AND m.idCurso = c.idCurso AND  c.idDisciplina =" . $_SESSION['idDisciplina'] . " ORDER BY c.dataCronograma DESC ");
$query->execute();

    while ($rowCronograma = $query->fetch(PDO::FETCH_ASSOC)) {

        $newDate = date('d/m/Y', strtotime($rowCronograma['dataCronograma'] ));

        $data[$i]{'titulo'} = ' <div class="block-content" style="float: top; ">
                               <h2 class="content-heading text-black">' . $rowCronograma['tituloCronograma'] . ' (' . $newDate . ') </h2>
                               </div>'. $rowCronograma['descricaoCronograma'] .'';



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
