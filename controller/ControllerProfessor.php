<?php

$acao = filter_var($_POST["acao"], FILTER_SANITIZE_STRING);

switch ($acao) {
    case 'adicionar':
        adicionarProfessor();
        break;
    case 'editar':
        atualizarProfessor();
        break;
    case 'excluir':
        deletarProfessor();
        break;
}

function adicionarProfessor() {
    require_once ('../model/ModelProfessor.php');
    require_once ('../dao/DaoProfessor.php');
    $dao = new DaoProfessor();

    $nome = filter_var($_POST["nome"], FILTER_SANITIZE_STRING);
    $cpf = filter_var($_POST["cpf"], FILTER_SANITIZE_STRING);
    $data = filter_var($_POST["data"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
    $senha = filter_var($_POST["senha"], FILTER_SANITIZE_STRING);




    $Professor = new ModelProfessor();
    $Professor->setNomeProfessor($nome);
    $Professor->setCpfProfessor($cpf);
    $Professor->setDataProfessor($data);
    $Professor->setEmailProfessor($email);
    $Professor->setSenhaProfessor($senha);


    $dao->adicionarProfessor($Professor);
    
}

function atualizarProfessor() {
    require_once ('../model/ModelProfessor.php');
    require_once ('../dao/DaoProfessor.php');
    $dao = new DaoProfessor();
   
    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_var($_POST["nome"], FILTER_SANITIZE_STRING);
    $cpf = filter_var($_POST["cpf"], FILTER_SANITIZE_STRING);
    $data = filter_var($_POST["data"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
    $senha = filter_var($_POST["senha"], FILTER_SANITIZE_STRING);


    $Professor = new ModelProfessor();
    $Professor->setIdProfessor($id);
    $Professor->setNomeProfessor($nome);
    $Professor->setCpfProfessor($cpf);
    $Professor->setDataProfessor($data);
    $Professor->setEmailProfessor($email);
    $Professor->setSenhaProfessor($senha);


    $dao->atualizarProfessor($Professor);
}



function deletarProfessor() {
    require_once ('../model/ModelProfessor.php');
    require_once ('../dao/DaoProfessor.php');

    $dao = new DaoProfessor();
    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

    $Professor = new ModelProfessor();
    $Professor->setIdProfessor($id);


    $dao->excluirProfessor($Professor);
}





?>