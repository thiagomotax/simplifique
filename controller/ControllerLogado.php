<?php

$acao = filter_var($_POST["acao"], FILTER_SANITIZE_STRING);

switch ($acao) {
    case 'editar':
        atualizarLogado();
        break;
}


function atualizarLogado() {
    require_once ('../model/ModelLogado.php');
    require_once ('../dao/DaoLogado.php');
    $dao = new DaoLogado();
    
    if (isset($_POST["email"])){
   
    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_var($_POST["nome"], FILTER_SANITIZE_STRING);
    $cpf = filter_var($_POST["cpf"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);


    $Logado = new ModelLogado();
    $Logado->setIdLogado($id);
    $Logado->setNomeLogado($nome);
    $Logado->setCpfLogado($cpf);
    $Logado->setEmailLogado($email);

    $dao->atualizarDados($Logado);

    }
    
    else if (isset($_POST["senha"])){

    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $senha = filter_var($_POST["senha"], FILTER_SANITIZE_STRING);
    
    $Logado = new ModelLogado();
    $Logado->setIdLogado($id);
    $Logado->setSenhaLogado($senha);

    }




}


?>
