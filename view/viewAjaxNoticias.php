<?php

// session_start();

// if (isset($_SESSION['user_id'])) {


    require_once ('../dao/DaoLogin.php');

 session_start();

  $idProf= $_SESSION['user_id'] ;



    require_once("../dao/DaoNoticia.php");

    $noticiasDao = new DaoNoticia();
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

    $stmtNot = $noticiasDao->runQuery("SELECT * FROM professor WHERE idUsuario = " . $_SESSION['user_id'] . " ");
    $stmtNot->execute();

    while ($rowAuxiliar = $stmtNot->fetch(PDO::FETCH_ASSOC)) {
                $idAux = $rowAuxiliar['idProfessor'];
            }


    $stmtNoticias = $noticiasDao->runQuery("SELECT * FROM noticia a, curso c WHERE a.idCurso = c.idCurso AND idProfessor = ? ");
    $stmtNoticias->bindparam(1, $idAux);
    $stmtNoticias->execute();

    $data = array();

    $i = 0;

    while ($rowNoticia = $stmtNoticias->fetch(PDO::FETCH_ASSOC)) {

        $data[$i]{'idNoticia'} = $rowNoticia['idNoticia'];
        $data[$i]{'tituloNoticia'} = $rowNoticia['nomeNoticia'];
        $data[$i]{'descricaoNoticia'} = $rowNoticia['descricaoNoticia'];
        $data[$i]{'dataNoticia'} = $rowNoticia['dataNoticia'];
        $data[$i]{'cursoNoticia'} = $rowNoticia['nomeCurso'];

        $data[$i]{'button'} =
         '<div class="text-center">
            <div class="btn-group" center>
                <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Editar" id="rowEditarNoticia_' . $i . '" data-id="' . $rowNoticia['idNoticia'] . '" data-titulo="' . $rowNoticia['nomeNoticia'] . '" data-data="' . $rowNoticia['dataNoticia'] . '" data-descricao="' . $rowNoticia['descricaoNoticia'] . '" data-idC="' . $rowNoticia['idCurso'] .'" onclick="editarNoticia(' . ($i + 1) . ')">
                    <i class="fa fa-pencil"></i>
                </button>
                <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Excluir" id="rowDeleteNoticia_' . $i . '" data-id="' . $rowNoticia['idNoticia']. '" onclick="excluirNoticia(' . ($i + 1) . ')">
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
