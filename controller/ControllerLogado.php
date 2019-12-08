<?php

$acao = filter_var($_POST["acao"], FILTER_SANITIZE_STRING);

switch ($acao) {
    case 'editar':
        atualizarDados();
        break;
    case 'foto':
        atualizarFoto();
        break;
}


function atualizarDados() {
    require_once ('../model/ModelLogado.php');
    require_once ('../dao/DaoLogado.php');
    $dao = new DaoLogado();
    
    if (isset($_POST["email"])){
   
    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_var($_POST["nome"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);


    $Logado = new ModelLogado();
    $Logado->setIdLogado($id);
    $Logado->setNomeLogado($nome);
    $Logado->setEmailLogado($email);

    $dao->atualizarDados($Logado);

    }
    
    else if (isset($_POST["senha"])){

    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $senha = filter_var($_POST["senha"], FILTER_SANITIZE_STRING);
    
    $Logado = new ModelLogado();
    $Logado->setIdLogado($id);
    $Logado->setSenhaLogado($senha);

    $dao->atualizarSenha($Logado);


    }
    
}



function atualizarFoto() {
    require_once ('../model/ModelLogado.php');
    require_once ('../dao/DaoLogado.php');
    $dao = new DaoLogado();


    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $foto = filter_var($_POST["foto"], FILTER_SANITIZE_STRING);

    //print_r($_FILES);

    //if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0){
    
    $fileTemp=$_FILES['foto']['tmp_name'];
    //$fileName=$_FILES['foto']['name'];
    $fileType=$_FILES['foto']['type'];
    
    $filenameTemp= explode('.', $foto);
    $fileExtension= end( $filenameTemp );
    
    $newFileName= 'perfil_' . time() . '.' . $fileExtension;
    
 /* Insira aqui a pasta que deseja salvar o arquivo*/
    $uploadir='../assets/media/avatars/';
    
    $destino= $uploadir . $fileName;
   
    move_uploaded_file($fileTemp, $destino);


    $Logado = new ModelLogado();
    $Logado->setIdLogado($id);
    $Logado->setFotoLogado($newFileName);

    $dao->atualizarFoto($Logado);
    //}
    header(sprintf('location: %s', $_SERVER['HTTP_REFERER']));

    }

?>
