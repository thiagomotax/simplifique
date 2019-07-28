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

function adicionarDisciplina() {
    require_once ('../model/ModelDisciplina.php');
    require_once ('../dao/DaoDisciplina.php');
    $dao = new DaoDisciplina();

    $idCurso = filter_var($_POST["idC"], FILTER_SANITIZE_NUMBER_INT);
    $idProfessor = filter_var($_POST["idP"], FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_var($_POST["nome"], FILTER_SANITIZE_STRING);
    $ano = filter_var($_POST["ano"], FILTER_SANITIZE_STRING);




    $Disciplina = new ModelDisciplina();
    $Disciplina->setIdCurso($idCurso);
    $Disciplina->setIdProfessor($idProfessor);
    $Disciplina->setNomeDisciplina($nome);
    $Disciplina->setAnoDisciplina($ano);

    $dao->adicionarDisciplina($Disciplina);
    
}

function atualizarDisciplina() {
    require_once ('../model/ModelDisciplina.php');
    require_once ('../dao/DaoDisciplina.php');
    $dao = new DaoDisciplina();
   
    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $idP = filter_var($_POST["idP"], FILTER_SANITIZE_NUMBER_INT);
    $idC = filter_var($_POST["idC"], FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_var($_POST["nomeD"], FILTER_SANITIZE_STRING);
    $ano = filter_var($_POST["ano"], FILTER_SANITIZE_STRING);


    $Disciplina = new ModelDisciplina();
    $Disciplina->setIdDisciplina($id);
    $Disciplina->setIdCurso($idC);
    $Disciplina->setIdProfessor($idP);
    $Disciplina->setNomeDisciplina($nome);
    $Disciplina->setAnoDisciplina($ano);


    $dao->atualizarDisciplina($Disciplina);
}



function deletarDisciplina() {
    require_once ('../model/ModelDisciplina.php');
    require_once ('../dao/DaoDisciplina.php');

    $dao = new DaoDisciplina();
    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

    $Disciplina = new ModelDisciplina();
    $Disciplina->setIdDisciplina($id);


    $dao->excluirDisciplina($Disciplina);
}





?>