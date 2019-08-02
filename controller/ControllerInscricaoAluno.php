<?php

$acao = filter_var($_POST["acao"], FILTER_SANITIZE_STRING);

switch ($acao) {
    case 'aceitar':
        aceitarInscricao();
        break;
    case 'rejeitar':
        rejeitarInscricao();
        break;
}

function aceitarInscricao() {
    require_once ('../model/ModelInscricaoAluno.php');
    require_once ('../dao/DaoInscricaoAluno.php');
    $dao = new DaoInscricaoAluno();
    $idI = filter_var($_POST["idI"], FILTER_SANITIZE_NUMBER_INT);
    $idU = filter_var($_POST["idU"], FILTER_SANITIZE_NUMBER_INT);
    $idC = filter_var($_POST["idC"], FILTER_SANITIZE_NUMBER_INT);
    $status = 1;
    $Aluno = new ModelInscricaoAluno();
    $Aluno->setIdInscricao($idI);
    $Aluno->setIdCurso($idC);
    $Aluno->setIdUsuario($idU);
    $Aluno->setStatusInscricao($status);


    $dao->aceitarInscricao($Aluno);
}



function rejeitarInscricao() {
    require_once ('../model/ModelInscricaoAluno.php');
    require_once ('../dao/DaoInscricaoAluno.php');

    $dao = new DaoInscricaoAluno();
    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $status = 2;

    $Aluno = new ModelInscricaoAluno();
    $Aluno->setIdInscricao($id);
    $Aluno->setStatusInscricao($status);


    $dao->rejeitarInscricao($Aluno);
}

?>