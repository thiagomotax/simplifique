<?php

  require_once ('../dao/DaoLogin.php');
    $loginDao = new DaoLogin();

 /**
 * backend/views/inc_header.php
 *
 * Author: pixelcave
 *
 * The header of each page
 *
 */

 $session= $_SESSION['user_id'];
 $query=$loginDao->runQuery("SELECT * FROM usuario WHERE idUsuario = $session ");
 $query->execute();

   while($row=$query->fetch(PDO::FETCH_ASSOC)){

         $idAux = $row['nomeUsuario'];
         $cpf = $row['cpfUsuario'];
         $email = $row['emailUsuario'];
             }

?>

<style type="text/css">

    .erroNome, .erroEmail, .erroSenha, .erroConfirm-Senha{

    display: none;

    }
     </style>

<!-- Side Overlay-->
<aside id="side-overlay">
    <!-- Side Header -->
    <div class="content-header content-header-fullrow">
        <div class="content-header-section align-parent">
            <!-- Close Side Overlay -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-circle btn-dual-secondary align-v-r" data-toggle="layout"
                data-action="side_overlay_close">
                <i class="fa fa-times text-danger"></i>
            </button>
            <!-- END Close Side Overlay -->

            <!-- User Info -->
            <div class="content-header-item">
                
                <a class="align-middle link-effect text-primary-dark font-w600"
                    href="be_pages_generic_profile.html" style="left:30px;"><?php echo explode(' ', $idAux)[0]; ?></a>
            </div>
            <!-- END User Info -->
        </div>
    </div>
    <!-- END Side Header -->

    <!-- Side Content -->
    <div class="content-side">
        <!-- Search -->

        <!-- END Search -->


        <!-- Profile -->
        <div class="block pull-r-l">
            <div class="block-header bg-body-light">
                <h3 class="block-title">
                    <i class="fa fa-fw fa-pencil font-size-default mr-5"></i>Informações básicas
                </h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option"
                        data-action="content_toggle"></button>
                </div>
            </div>
            <div class="block-content">
            <iframe src="../controller/ControllerLogado.php" name="controladorDados" style="display: none;"></iframe>
                <form  action="../controller/ControllerLogado.php"class="js-validation-logado" 
                    id="atualizarDados" method="post" target="controladorDados">
                  <input type="hidden" name="id" id="id" value="<?php echo $session; ?>"> 
                  <input type="hidden" name="acao" id="acao" value="editar">
                    <div class="form-group mb-15">
                        <label for="nome">Nome</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nome"
                                name="nome" placeholder="Seu nome.." value="<?php echo $idAux; ?>" >
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
                        </div>
                        <div class="invalid-feedback erroNome">Digite o nome completo</div>
                    </div>
                    <div class="form-group mb-15">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="email"
                                name="email" placeholder="Seu email.." value="<?php echo $email; ?>" >
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-envelope"></i>
                                </span>
                            </div>
                        </div>
                        <div class="invalid-feedback erroEmail">Digite um email válido</div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12">
                            <button type="button" id="btnEditarLogado" class="btn btn-alt-primary"   onclick="enviarDados()">
                                <i class="fa fa-refresh mr-5"></i> Atualizar dados
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Profile -->

        <!-- Profile -->
        <div class="block pull-r-l block-mode-hidden">
            <div class="block-header bg-body-light">
            
                <h3 class="block-title">
                    <i class="fa fa-fw fa-key font-size-default mr-5"></i>Alterar senha
                </h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option"
                        data-action="content_toggle"></button>
                </div>
            </div>
            <div class="block-content">
            <article class="atualiza senha">
                <iframe src="../controller/ControllerLogado.php" name="controladorSenha" style="display: none;"></iframe>
                <form  action="../controller/ControllerLogado.php" class="js-validation-logado" 
                    id="atualizarSenha" method="post" target="controladorSenha" >
                    <input type="hidden" name="id" id="id" value="<?php echo $session; ?>"> 
                    <input type="hidden" name="acao" id="acao" value="editar">
                      
                    <div class="form-group mb-15">
                        <label for="senha">Nova senha</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="senha" value=""
                                name="senha" placeholder="Nova senha.." >
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-asterisk"></i>
                                </span>
                            </div>
                        </div>
                        <div class="invalid-feedback erroSenha">A senha deve ter no mínimo 8 caracteres</div>
                    </div>
                    <div class="form-group mb-15">
                        <label for="confirm-senha">Confirmação de senha</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirmSenha"
                                name="confirmSenha" placeholder="Confirmação da nova senha.." >
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-asterisk"></i>
                                </span>
                            </div>
                        </div>
                        <div class="invalid-feedback erroConfirm-Senha">As senhas não conferem</div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <button type="button"  id="btnEditarSenha" class="btn btn-alt-primary" onclick="enviarSenha()">
                                <i class="fa fa-refresh mr-5"></i> Atualizar senha
                            </button>
                        </div>
                    </div>
                </form>
                </article>
            </div>
        </div>
        <!-- END Profile -->


    </div>
    <!-- END Side Content -->
</aside>
<!-- END Side Overlay -->
<?php $cb->get_js('/js/plugins/jquery-validation/jquery.validate.min.js'); ?>
<?php $cb->get_js('/js/plugins/sweetalert2/sweetalert2.min.js'); ?>
<?php $cb->get_js('js/plugins/masked-inputs/jquery.maskedinput.min.js'); ?>
<?php $cb->get_js('js/plugins/select2/js/select2.full.min.js'); ?>

<script type="text/javascript">


function enviarDados(){

    var nome = document.getElementById('nome');
    var email = document.getElementById('email');

    if (nome.value.length < 8){

        $('.erroNome').show();
    }

    else {
    
        $('.erroNome').hide();
    
        if (email.value.length < 11){

            $('.erroEmail').show();
        }

        else {

            $('.erroEmail').hide();
            alerta("success", "Dados alterados com sucesso!", "" , "Recarregue a página", "");
            document.getElementById('atualizarDados').submit();
            document.getElementById('atualizarDados').reset();
        } 
    }     
}

function enviarSenha(){ 

    var senha = document.getElementById('senha')
    var confirm = document.getElementById('confirmSenha');

    if (senha.value.length < 8) {

        $('.erroSenha').show();
        
    }

    else {
    
        $('.erroSenha').hide();

        if (confirm.value != senha.value) {
            
            $('.erroConfirm-Senha').show();
        }  
        
         else {
            $('.erroConfirm-Senha').hide();
            alerta("success", "Senha alterada com sucesso!", " Voltar" , "Sair e fazer login", "viewLogin.php");
            document.getElementById('atualizarSenha').submit();
            document.getElementById('atualizarSenha').reset();                           
        }    
    }
    
}


</script>

<?php $cb->get_js('/js/custom/logado.js'); ?>
<script>jQuery(function(){ Codebase.helpers(['masked-inputs']); });</script>


