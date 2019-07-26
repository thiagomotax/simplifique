<?php

// session_start();

// if (isset($_SESSION['user_id'])) {

    require_once("../dao/DaoDisciplina.php");
    
    $disciplinasDao = new DaoDisciplina();
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

    $stmtDisciplinas = $disciplinasDao->runQuery("SELECT * FROM disciplina d, professor p, curso c, usuario u WHERE
    d.idProfessor = p.idProfessor AND d.idCurso = c.idCurso AND u.idUsuario = p.idUsuario");
    $stmtDisciplinas->execute();

    $data = array();

    $i = 0;

    while ($rowDisciplinas = $stmtDisciplinas->fetch(PDO::FETCH_ASSOC)) {
        $data[$i]{'idDisciplina'} = $rowDisciplinas['idDisciplina'];
        $data[$i]{'nomeCurso'} = $rowDisciplinas['nomeCurso'];
        $data[$i]{'nomeProfessor'} = $rowDisciplinas['nomeUsuario'];
        $data[$i]{'nomeDisciplina'} = $rowDisciplinas['nomeDisciplina'];
        $data[$i]{'anoDisciplina'} = $rowDisciplinas['anoDisciplina'];
        $data[$i]{'button'} = 
        '<div class="text-center">
            <div class="btn-group" center>
                <a id="rowEditarDisciplina_' . $i . '" data-idD="' . $rowDisciplinas['idDisciplina'] . '" data-idC="' . $rowDisciplinas['idCurso'] . '" data-idP="' . $rowDisciplinas['idProfessor']. '" data-nome="' . $rowDisciplinas['nomeDisciplina'] . '" data-ano="' . $rowDisciplinas['anoDisciplina'] . '"  onclick="editarDisciplina(' . ($i + 1) . ')"><button type="button" class="btn btn-sm btn-outline-primary" data-toggle="tooltip" title="Ver">
                <i class="fa fa-eye"></i></button></a>
                <a id="rowDeleteDisciplina_' . $i . '" data-idD="' . $rowDisciplinas['idDisciplina'] . '" data-nome="' . $rowDisciplinas['nomeDisciplina'] . '" onclick="excluirCurso(' . ($i + 1) . ')"> <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Excluir">
                <i class="fa fa-times"></i></button></a>
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