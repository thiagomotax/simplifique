<?php

// session_start();

// if (isset($_SESSION['user_id'])) {
    require_once ('../dao/DaoLogin.php');

 session_start();

  $idProf = $_SESSION['user_id'] ;

  ?>

  <?php



    require_once("../dao/DaoAnexo.php");


    $anexoDao = new DaoAnexo();
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
    
    $stmtAnexo = $anexoDao->runQuery("SELECT * FROM professor WHERE idUsuario = " . $_SESSION['user_id'] . " ");
    $stmtAnexo->execute();
    
    while ($rowAuxiliar = $stmtAnexo->fetch(PDO::FETCH_ASSOC)) {
                $idAux = $rowAuxiliar['idProfessor'];
            }

    $stmtAuxx = $anexoDao->runQuery("SELECT * FROM anexo a, disciplina d, curso c WHERE a.idDisciplina = d.idDisciplina AND a.idCurso = c.idCurso AND a.idProfessor = ? ");
    $stmtAuxx->bindparam(1, $idAux);
    $stmtAuxx->execute();

    $data = array();

    $i = 0;

    while ($rowAnexo = $stmtAuxx->fetch(PDO::FETCH_ASSOC)) {
        $data[$i]{'idAnexo'} = $rowAnexo['idAnexo'];
        $data[$i]{'fileAnexo'} = $rowAnexo['materialAnexo'];
        $data[$i]{'disciplinaAnexo'} = $rowAnexo['nomeDisciplina'];
        $data[$i]{'tituloAnexo'} = $rowAnexo['nomeAnexo'];
        $data[$i]{'dataAnexo'} = $rowAnexo['dataAnexo'];
        $data[$i]{'nomeCurso'} = $rowAnexo['nomeCurso'];
        $data[$i]{'urlAnexo'} = $rowAnexo['urlAnexo'];

        $data[$i]{'button'} =
        '<div class="text-center">
            <div class="btn-group" center>
                <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Editar" id="rowEditarAnexo_' . $i . '" data-id="' . $rowAnexo['idAnexo'] . '" data-titulo="' . $rowAnexo['nomeAnexo'] . '" data-disciplina="' . $rowAnexo['idDisciplina'] . '" data-file="' . $rowAnexo['materialAnexo'] .'" data-url="' . $rowAnexo['urlAnexo'] .'" data-idC="' . $rowAnexo['idCurso'] .'" onclick="editarAnexo(' . ($i + 1) . ')">
                    <i class="fa fa-pencil"></i>
                </button>
                <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Excluir" id="rowDeleteAnexo_' . $i . '" data-id="' . $rowAnexo['idAnexo']. '" onclick="excluirAnexo(' . ($i + 1) . ')">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div> ';



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
