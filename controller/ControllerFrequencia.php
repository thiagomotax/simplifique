<?php
 session_start();

$acao = filter_var($_POST["acao"], FILTER_SANITIZE_STRING);


switch ($acao) {
    case 'adicionar':
        adicionarFrequencia();
        break;
    case 'editar':
        atualizarFrequencia();
        break;
    case 'excluir':
        deletarFrequencia();
        break;
}

function adicionarFrequencia() {
    require_once ('../model/ModelFrequencia.php');
    require_once ('../dao/DaoFrequencia.php');
    $dao = new DaoFrequencia();

    $cursoFrequencia = filter_var($_POST["curso"], FILTER_SANITIZE_NUMBER_INT);
    $dataFrequencia = filter_var($_POST["data"], FILTER_SANITIZE_STRING);
    $disciplinaFrequencia = filter_var($_POST["disciplina"], FILTER_SANITIZE_NUMBER_INT);


     $_SESSION['idCurso'] = $cursoFrequencia;
     $_SESSION['idDisciplina'] = $disciplinaFrequencia;
     $_SESSION['idData'] = $dataFrequencia;

    $Frequencia = new ModelFrequencia();

    $Frequencia->setDataFrequencia($dataFrequencia);
    $Frequencia->setDisciplinaFrequencia($disciplinaFrequencia);
    $Frequencia->setCursoFrequencia($cursoFrequencia);


    $dao->adicionarFrequencia($Frequencia);

}

function atualizarFrequencia() {
    require_once ('../model/ModelFrequencia.php');
    require_once ('../dao/DaoFrequencia.php');
    
    $dao = new DaoFrequencia();

   $situacaoFrequencia = filter_var($_POST["situacao"], FILTER_SANITIZE_STRING);


    $idFrequencia = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);



    $Frequencia = new ModelFrequencia();
    


    $Frequencia->setSituacaoFrequencia($situacaoFrequencia);
    $Frequencia->setIdFrequencia($idFrequencia);





    $dao->atualizarFrequencia($Frequencia);

}



function deletarFrequencia() {
    require_once ('../model/ModelFrequencia.php');
    require_once ('../dao/DaoFrequencia.php');

    $dao = new DaoFrequencia();

    $cursoFrequencia = filter_var($_POST["curso"], FILTER_SANITIZE_NUMBER_INT);
    $dataFrequencia = filter_var($_POST["data"], FILTER_SANITIZE_STRING);
    $disciplinaFrequencia = filter_var($_POST["disciplina"], FILTER_SANITIZE_NUMBER_INT);
    
    $Frequencia = new ModelFrequencia();
    
    $Frequencia->setDataFrequencia($dataFrequencia);
    $Frequencia->setDisciplinaFrequencia($disciplinaFrequencia);
    $Frequencia->setCursoFrequencia($cursoFrequencia);


    $dao->excluirFrequencia($Frequencia);
}





?>
