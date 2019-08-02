<?php

$acao = filter_var($_POST["acao"], FILTER_SANITIZE_STRING);

switch ($acao) {
    case 'adicionar':
        adicionarRegistro();
        break;
    case 'editar':
        atualizarRegistro();
        break;
    case 'excluir':
        deletarRegistro();
        break;
}

function adicionarRegistro() {
    require_once ('../model/ModelRegistro.php');
    require_once ('../dao/DaoRegistro.php');
    $dao = new DaoRegistro();

    $nome = filter_var($_POST["signup-name"], FILTER_SANITIZE_STRING);
    $cpf = filter_var($_POST["signup-cpf"], FILTER_SANITIZE_STRING);
    $data = filter_var($_POST["signup-data"], FILTER_SANITIZE_STRING);
    $curso = filter_var($_POST["signup-curso"], FILTER_SANITIZE_NUMBER_INT);
    $email = filter_var($_POST["signup-email"], FILTER_SANITIZE_STRING);
    $senha = filter_var($_POST["signup-password"], FILTER_SANITIZE_STRING);




    $Registro = new ModelRegistro();
    $Registro->setNomeRegistro($nome);
    $Registro->setCpfRegistro($cpf);
    $Registro->setDataRegistro($data);
    $Registro->setCursoRegistro($curso);
    $Registro->setEmailRegistro($email);
    $Registro->setSenhaRegistro($senha);


    $dao->adicionarRegistro($Registro);
    
}

function atualizarRegistro() {
    require_once ('../model/ModelRegistro.php');
    require_once ('../dao/DaoRegistro.php');
    $dao = new DaoRegistro();
   
    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_var($_POST["nome"], FILTER_SANITIZE_STRING);
    $cpf = filter_var($_POST["cpf"], FILTER_SANITIZE_STRING);
    $data = filter_var($_POST["data"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
    $senha = filter_var($_POST["senha"], FILTER_SANITIZE_STRING);
    $idc = filter_var($_POST["idC"], FILTER_SANITIZE_STRING);



    $Registro = new ModelRegistro();
    $Registro->setIdRegistro($id);
    $Registro->setNomeRegistro($nome);
    $Registro->setCpfRegistro($cpf);
    $Registro->setDataRegistro($data);
    $Registro->setEmailRegistro($email);
    $Registro->setSenhaRegistro($senha);
    $Registro->setIdCurso($idc);


    $dao->atualizarRegistro($Registro);
}



function deletarRegistro() {
    require_once ('../model/ModelRegistro.php');
    require_once ('../dao/DaoRegistro.php');

    $dao = new DaoRegistro();
    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

    $Registro = new ModelRegistro();
    $Registro->setIdRegistro($id);


    $dao->excluirRegistro($Registro);
}





?>