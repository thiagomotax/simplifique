<?php

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

    $dataAt = $_SESSION['idData'];
    $stmtFrequencia = $frequenciaDao->runQuery("SELECT * FROM  frequencia f, usuario u, aluno a WHERE f.idCurso = " . $_SESSION['idCurso'] . " AND a.idAluno = f.idAluno AND a.idUsuario = u.idUsuario AND f.idDisciplina = " . $_SESSION['idDisciplina'] . " AND f.dataFrequencia LIKE '$dataAt'  ORDER BY u.nomeUsuario ASC");
    $stmtFrequencia->execute();

    $data = array();

    $i = 0;
    $j=1;
    while ($rowFrequencia = $stmtFrequencia->fetch(PDO::FETCH_ASSOC)) {
        $data[$i]{'numero'} = $j;
        $data[$i]{'matricula'} = $rowFrequencia['idAluno'];
        $data[$i]{'nome'} = $rowFrequencia['nomeUsuario'];
        $data[$i]{'situacaoAt'} = $rowFrequencia['statusFrequencia'];
        $data[$i]{'button'} = '<input type="button" class="btn btn-alt-primary" name="situacao" value="Presente" id="btnEditarFrequencia_' . $j . '" data-id="' . $rowFrequencia['idFrequencia'] . '"  data-situacao="Presente"  onclick="editarFrequencia(' . ($j) . ')"/>
                               <input type="button" class="btn btn-alt-primary" name="situacao" value="Ausente" id="btnEditarrFrequencia_' . $j . '" data-id="' . $rowFrequencia['idFrequencia'] . '"  data-situacao="Ausente"  onclick="editarrFrequencia(' . ($j) . ')"/>';

        $i++; $j++;
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
