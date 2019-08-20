<?php
session_start();

$acao = filter_var($_POST["acao"], FILTER_SANITIZE_STRING);


switch ($acao) {
    case 'adicionar':
        adicionarNoticia();
        break;
    case 'editar':
        atualizarNoticia();
        break;
    case 'excluir':
        deletarNoticia();
        break;
}

function adicionarNoticia() {
    require_once ('../model/ModelNoticia.php');
    require_once ('../dao/DaoNoticia.php');
    $dao = new DaoNoticia();

    $tituloNoticia = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);
    $descricaoNoticia = filter_var($_POST["descricao"], FILTER_SANITIZE_STRING);
    $cursoNoticia = filter_var($_POST["curso"], FILTER_SANITIZE_STRING);



    $Noticia = new ModelNoticia();
    $Noticia->setTituloNoticia($tituloNoticia);
    $Noticia->setDescricaoNoticia($descricaoNoticia);
    $Noticia->setCursoNoticia($cursoNoticia);

    $dao->adicionarNoticia($Noticia);
    
}

function atualizarNoticia() {
    require_once ('../model/ModelNoticia.php');
    require_once ('../dao/DaoNoticia.php');
    $dao = new DaoNoticia();

    $idNoticia = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $tituloNoticia = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);
    $descricaoNoticia = filter_var($_POST["descricao"], FILTER_SANITIZE_STRING);
    $cursoNoticia = filter_var($_POST["idC"], FILTER_SANITIZE_NUMBER_INT);



    $Noticia = new ModelNoticia();
    $Noticia->setIdNoticia($idNoticia);
    $Noticia->setTituloNoticia($tituloNoticia);
    $Noticia->setDescricaoNoticia($descricaoNoticia);
    $Noticia->setCursoNoticia($cursoNoticia);



    $dao->atualizarNoticia($Noticia);
}



function deletarNoticia() {
    require_once ('../model/ModelNoticia.php');
    require_once ('../dao/DaoNoticia.php');

    $dao = new DaoNoticia();
    $idNoticia = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

    $Noticia = new ModelNoticia();
    $Noticia->setIdNoticia($idNoticia);


    $dao->excluirNoticia($Noticia);
}





?>
