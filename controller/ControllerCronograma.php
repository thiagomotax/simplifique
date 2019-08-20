<?php
session_start();

$acao = filter_var($_POST["acao"], FILTER_SANITIZE_STRING);


switch ($acao) {
    case 'adicionar':
        adicionarCronograma();
        break;
    case 'editar':
        atualizarCronograma();
        break;
    case 'excluir':
        deletarCronograma();
        break;
}

function adicionarCronograma() {
    require_once ('../model/ModelCronograma.php');
    require_once ('../dao/DaoCronograma.php');
    $dao = new DaoCronograma();

    $cursoCronograma = filter_var($_POST["curso"], FILTER_SANITIZE_NUMBER_INT);
    $dataCronograma = filter_var($_POST["data"], FILTER_SANITIZE_STRING);
    $disciplinaCronograma = filter_var($_POST["disciplina"], FILTER_SANITIZE_NUMBER_INT);
    $tituloCronograma = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);
    $descricaoCronograma = filter_var($_POST["descricao"], FILTER_SANITIZE_STRING);


    $Cronograma = new ModelCronograma();

    $Cronograma->setDataCronograma($dataCronograma);
    $Cronograma->setDisciplinaCronograma($disciplinaCronograma);
    $Cronograma->setCursoCronograma($cursoCronograma);
    $Cronograma->setTituloCronograma($tituloCronograma);
    $Cronograma->setDescricaoCronograma($descricaoCronograma);


    $dao->adicionarCronograma($Cronograma);
    
}

function atualizarCronograma() {
    require_once ('../model/ModelCronograma.php');
    require_once ('../dao/DaoCronograma.php');
    
    $dao = new DaoCronograma();

    $descricaoCronograma = filter_var($_POST["descricao"], FILTER_SANITIZE_STRING);
    $tituloCronograma = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);
    $dataCronograma = filter_var($_POST["data"], FILTER_SANITIZE_STRING);
    $idCronograma = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

    $date = date('Y-m-d', strtotime($dataCronograma ));


    $Cronograma = new ModelCronograma();
    


    $Cronograma->setDataCronograma($date);
    $Cronograma->setTituloCronograma($tituloCronograma);
    $Cronograma->setDescricaoCronograma($descricaoCronograma);
    $Cronograma->setIdCronograma($idCronograma);






    $dao->atualizarCronograma($Cronograma);
    

}



function deletarCronograma() {
    require_once ('../model/ModelCronograma.php');
    require_once ('../dao/DaoCronograma.php');

    $dao = new DaoCronograma();

    $idCronograma = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

    $Cronograma = new ModelCronograma();
    
    $Cronograma->setIdCronograma($idCronograma);


    $dao->excluirCronograma($Cronograma);
}





?>
