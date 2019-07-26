<?php

$acao = filter_var($_POST["acao"], FILTER_SANITIZE_STRING);

switch ($acao) {
    case 'adicionar':
        adicionarDisciplina();
        break;
    case 'editar':
        atualizarDisciplina();
        break;
    case 'excluir':
        deletarDisciplina();
        break;
}

function adicionarCurso() {
    require_once ('../model/ModelCurso.php');
    require_once ('../dao/DaoCurso.php');
    $dao = new DaoCurso();

    $nome = filter_var($_POST["nome"], FILTER_SANITIZE_STRING);
    $descricao = filter_var($_POST["descricao"], FILTER_SANITIZE_STRING);


    $Curso = new ModelCurso();
    $Curso->setNomeCurso($nome);
    $Curso->setDescricaoCurso($descricao);

    $dao->adicionarCurso($Curso);
    
}

function atualizarCurso() {
    require_once ('../model/ModelCurso.php');
    require_once ('../dao/DaoCurso.php');
    $dao = new DaoCurso();
   
    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_var($_POST["nome"], FILTER_SANITIZE_STRING);
    $descricao = filter_var($_POST["descricao"], FILTER_SANITIZE_STRING);


    $Curso = new ModelCurso();
    $Curso->setIdCurso($id);
    $Curso->setNomeCurso($nome);
    $Curso->setDescricaoCurso($descricao);


    $dao->atualizarCurso($Curso);
}



function deletarCurso() {
    require_once ('../model/ModelCurso.php');
    require_once ('../dao/DaoCurso.php');

    $dao = new DaoCurso();
    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

    $Curso = new ModelCurso();
    $Curso->setIdCurso($id);


    $dao->excluirCurso($Curso);
}





?>