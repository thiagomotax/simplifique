<?php

// session_start();

// if (isset($_SESSION['user_id'])) {

    require_once("../dao/DaoInscricaoAluno.php");
    
    $inscricoesAlunosDao = new DaoInscricaoAluno();
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

    $stmtInscricoesAlunos = $inscricoesAlunosDao->runQuery("SELECT * FROM usuario u, curso c, inscricao_aluno i WHERE i.idUsuario = u.idUsuario AND i.idCurso = c.idCurso");
    $stmtInscricoesAlunos->execute();

    $data = array();

    $i = 0;

    while ($rowInscricoesAlunos = $stmtInscricoesAlunos->fetch(PDO::FETCH_ASSOC)) {
        $data[$i]{'idUsuario'} = $rowInscricoesAlunos['idUsuario'];
        $data[$i]{'nomeAluno'} = $rowInscricoesAlunos['nomeUsuario'];
        $data[$i]{'cpfAluno'} = $rowInscricoesAlunos['cpfUsuario'];
        $data[$i]{'dataAluno'} = $rowInscricoesAlunos['nascimentoUsuario'];
        $data[$i]{'emailAluno'} = $rowInscricoesAlunos['emailUsuario'];
        $data[$i]{'senhaAluno'} = $rowInscricoesAlunos['senhaUsuario'];
        $data[$i]{'nomeCurso'} = $rowInscricoesAlunos['nomeCurso'];
        if($rowInscricoesAlunos['statusInscricao'] == 0) $data[$i]{'statusInscricao'} = '<span class="badge badge-primary">Pendente</span>'; else if($rowInscricoesAlunos['statusInscricao'] == 1) $data[$i]{'statusInscricao'} = '<span class="badge badge-success">Aprovado</span>'; else if($rowInscricoesAlunos['statusInscricao'] == 2) $data[$i]{'statusInscricao'} = '<span class="badge badge-danger">Recusado</span>';
        $data[$i]{'dataInscricao'} = $rowInscricoesAlunos['dataInscricao'];
        
        if($rowInscricoesAlunos['statusInscricao'] != 1 && $rowInscricoesAlunos['statusInscricao'] != 2){
        $data[$i]{'button'} = 
        '<div class="text-center">
            <div class="btn-group" center>
                <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Aceitar" id="rowAceitarInscricaoAluno_' . $i . '" data-idU="' . $rowInscricoesAlunos['idUsuario'] . '" data-idC="' . $rowInscricoesAlunos['idCurso'] .'" data-idI="' . $rowInscricoesAlunos['idInscricao'] .'" data-nome="' . $rowInscricoesAlunos['nomeUsuario'] .'" onclick="aceitarInscricao(' . ($i + 1) . ')">
                    <i class="fa fa-check"></i>
                </button>
                <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Recusar" id="rowRejeitarInscricaoAluno_' . $i . '" data-idI="' . $rowInscricoesAlunos['idInscricao']. '" data-nome="' . $rowInscricoesAlunos['nomeUsuario'] . '" onclick="rejeitarInscricao(' . ($i + 1) . ')">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div> ';}
        else{
            $data[$i]{'button'} = 
            '<div class="text-center">
                <div class="btn-group" center>
                    <button type="button" disabled class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Aceitar">
                        <i class="fa fa-check"></i>
                    </button>
                    <button type="button" disabled class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Recusar">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div> ';
        }
            
            

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