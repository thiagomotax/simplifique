<?php

// session_start();

// if (isset($_SESSION['user_id'])) {

    require_once("../dao/DaoAluno.php");
    
    $alunosDao = new DaoAluno();
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

    $stmtAlunos = $alunosDao->runQuery("SELECT * FROM aluno a, usuario u, matricula_curso m, curso c WHERE a.idUsuario = u.idUsuario AND m.idAluno = a.idAluno AND c.idCurso = m.idCurso");
    $stmtAlunos->execute();

    $data = array();

    $i = 0;

    while ($rowAlunos = $stmtAlunos->fetch(PDO::FETCH_ASSOC)) {
        $data[$i]{'idAluno'} = $rowAlunos['idAluno'];
        $data[$i]{'idUsuario'} = $rowAlunos['idUsuario'];
        $data[$i]{'nomeAluno'} = $rowAlunos['nomeUsuario'];
        $data[$i]{'cpfAluno'} = $rowAlunos['cpfUsuario'];
        $data[$i]{'dataAluno'} = $rowAlunos['nascimentoUsuario'];
        $data[$i]{'emailAluno'} = $rowAlunos['emailUsuario'];
        $data[$i]{'senhaAluno'} = $rowAlunos['senhaUsuario'];
        $data[$i]{'nomeCurso'} = $rowAlunos['nomeCurso'];
        $data[$i]{'button'} = 
        '<div class="text-center">
            <div class="btn-group" center>
                <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Editar" id="rowEditarAluno_' . $i . '" data-id="' . $rowAlunos['idAluno'] . '" data-nome="' . $rowAlunos['nomeUsuario'] . '" data-data="' . $rowAlunos['nascimentoUsuario'] . '" data-cpf="' . $rowAlunos['cpfUsuario'] . '" data-email="' . $rowAlunos['emailUsuario'] .'" data-senha="' . $rowAlunos['senhaUsuario'] .'" data-idc="' . $rowAlunos['idCurso'] .'" onclick="editarAluno(' . ($i + 1) . ')">
                    <i class="fa fa-pencil"></i>
                </button>
                <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Excluir" id="rowDeleteAluno_' . $i . '" data-id="' . $rowAlunos['idAluno']. '" data-nome="' . $rowAlunos['nomeUsuario'] . '" onclick="excluirAluno(' . ($i + 1) . ')">
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