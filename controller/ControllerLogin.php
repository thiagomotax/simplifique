<?php

require_once ('../model/ModelLogin.php');
require_once ('../dao/DaoLogin.php');
require_once ('../database/Database.php');

$db = new Database();
$modelLogin = new ModelLogin();
$daoLogin = new DaoLogin();


$emailFormulario = filter_input(INPUT_POST, 'login-email', FILTER_SANITIZE_EMAIL);
$senhaFormulario = filter_input(INPUT_POST, 'login-password', FILTER_DEFAULT);

$modelLogin->setEmail($emailFormulario);
$modelLogin->setSenha($senhaFormulario);

$daoLogin->Logar($modelLogin);
?>