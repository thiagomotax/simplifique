<?php
session_start();



$acao = filter_var($_POST["acao"], FILTER_SANITIZE_STRING);






switch ($acao) {
    case 'adicionar':
        adicionarAnexo();
        break;
    case 'editar':
        atualizarAnexo();
        break;
    case 'excluir':
        deletarAnexo();
        break;
}

function adicionarAnexo() {
    require_once ('../model/ModelAnexo.php');
    require_once ('../dao/DaoAnexo.php');
    $dao = new DaoAnexo();

    $titulo = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);
    $curso = filter_var($_POST["curso"], FILTER_SANITIZE_STRING);
    $disciplina = filter_var($_POST["disciplina"], FILTER_SANITIZE_STRING);
    $url = filter_var($_POST["url"], FILTER_SANITIZE_STRING);




    if (isset($_FILES['filex'])){


    $extensao=strtolower(substr($_FILES['filex']['name'],  -4)); //pega a exten��o do arquivo
    $novo_nome=md5(time()) . $extensao;  //gera um novo nome com a exten��o
    $diretorio="../controller/anexos"; //define o diret�rio do arquivo

    move_uploaded_file($_FILES['filex']['tmp_name'], $diretorio.$novo_nome ); //copia o arquivo para a pasta



    }


    $Anexo = new ModelAnexo();
    $Anexo->setTituloAnexo($titulo);
    $Anexo->setCursoAnexo($curso);
    $Anexo->setDisciplinaAnexo($disciplina);
    $Anexo->setUrlAnexo($url);
    $Anexo->setFileAnexo($novo_nome);




    $dao->adicionarAnexo($Anexo);
    
}

function atualizarAnexo() {
    require_once ('../model/ModelAnexo.php');
    require_once ('../dao/DaoAnexo.php');
    $dao = new DaoAnexo();
   
    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $titulo = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);
    $curso = filter_var($_POST["idC"], FILTER_SANITIZE_NUMBER_INT);
    $disciplina = filter_var($_POST["idD"], FILTER_SANITIZE_NUMBER_INT);
    $url = filter_var($_POST["url"], FILTER_SANITIZE_STRING);
    
     if (isset($_FILES['filex'])){


    $extensao=strtolower(substr($_FILES['filex']['name'],  -4)); //pega a exten��o do arquivo
    $novo_nome=md5(time()) . $extensao;  //gera um novo nome com a exten��o
    $diretorio="../controller/anexos"; //define o diret�rio do arquivo

    move_uploaded_file($_FILES['filex']['tmp_name'], $diretorio.$novo_nome ); //copia o arquivo para a pasta



    }


    $Anexo = new ModelAnexo();
    $Anexo->setIdAnexo($id);
    $Anexo->setTituloAnexo($titulo);
    $Anexo->setCursoAnexo($curso);
    $Anexo->setDisciplinaAnexo($disciplina);
    $Anexo->setUrlAnexo($url);
    $Anexo->setFileAnexo($novo_nome);


    $dao->atualizarAnexo($Anexo);
}



function deletarAnexo() {
    require_once ('../model/ModelAnexo.php');
    require_once ('../dao/DaoAnexo.php');

    $dao = new DaoAnexo();
    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

    $Anexo = new ModelAnexo();
    $Anexo->setIdAnexo($id);


    $dao->excluirAnexo($Anexo);
}





?>
