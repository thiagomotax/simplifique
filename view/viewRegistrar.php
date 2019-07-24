<?php require '../inc/_global/config.php'; ?>
<?php require '../inc/_global/views/head_start.php'; ?>
<?php require '../inc/_global/views/head_end.php'; ?>
<?php require '../inc/_global/views/page_start.php'; ?>



<!-- Page Content -->
<div class="bg-gd-emerald">
    <div class="hero-static content content-full bg-white invisible" data-toggle="appear">
        <!-- Header -->
        <div class="py-30 px-5 text-center">
            <a class="link-effect font-w700" href="index.php">
                <i class="si si-fire"></i>
                <span class="font-size-xl text-primary-dark">sim</span><span class="font-size-xl">plifique</span>
            </a>
            <h1 class="h2 font-w700 mt-50 mb-10">Criar nova conta</h1>
            <h2 class="h4 font-w400 text-muted mb-0">Por favor, preencha cuidadosamente seus dados abaixo</h2>
        </div>
        <!-- END Header -->

        <!-- Sign Up Form -->
        <div class="row justify-content-center px-5">
            <div class="col-sm-8 col-md-6 col-xl-4">
                <!-- jQuery Validation functionality is initialized with .js-validation-signup class in js/pages/op_auth_signup.min.js which was auto compiled from _es6/pages/op_auth_signup.js -->
                <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                <form class="js-validation-signup" action="be_pages_auth_all.php" method="post">
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                                <input type="text" class="form-control" id="signup-name" name="signup-name">
                                <label for="signup-email">Nome</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                                <input type="text" class="form-control" id="signup-cpf" name="signup-cpf">
                                <label for="signup-cpf">CPF</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                            <div class="col-lg-12">
                                <div class="form-material floating">
                                    <input type="text" class="js-masked-date form-control" id="signup-data" name="signup-data" >
                                    <label for="signup-data">Data de nascimento</label>
                                </div>
                            </div>
                    </div>
                    <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-material floating">
                                    <select class="form-control" id="material-select2" name="material-select2">
                                        <option></option><!-- Empty value for demostrating material select box -->
                                        <option value="1">Option #1</option>
                                        <option value="2">Option #2</option>
                                        <option value="3">Option #3</option>
                                    </select>
                                    <label for="material-select2">Curso</label>
                                </div>
                            </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                                <input type="email" class="form-control" id="signup-email" name="signup-email">
                                <label for="signup-email">Email</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                                <input type="password" class="form-control" id="signup-password" name="signup-password">
                                <label for="signup-password">Senha</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                            <input type="password" class="form-control" id="signup-password-confirm" name="signup-password-confirm">
                                <label for="signup-password-confirm">Confirmação de senha</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row"></div>                   
                    <div class="form-group row text-center">
                        <div class="col-12">
                            <label class="css-control css-control-primary css-checkbox">
                                <input type="checkbox" class="css-control-input" id="signup-terms" name="signup-terms">
                                <span class="css-control-indicator"></span>
                                Eu aceito os Termos e Condições
                            </label>
                        </div>
                    </div>
                    <div class="form-group row gutters-tiny">
                        <div class="col-12 mb-10">
                            <button type="submit"
                                class="btn btn-block btn-hero btn-noborder btn-rounded btn-alt-success">
                                <i class="si si-user-follow mr-10"></i> Registrar
                            </button>
                        </div>
                        <div class="col-6">
                            <a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" href="#"
                                data-toggle="modal" data-target="#modal-terms">
                                <i class="si si-book-open text-muted mr-10"></i> Ler Termos
                            </a>
                        </div>
                        <div class="col-6">
                            <a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" href="viewLogin.php">
                                <i class="si si-login text-muted mr-10"></i> Login
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Sign Up Form -->
    </div>
</div>
<!-- END Page Content -->

<?php require '../inc/_global/views/page_end.php'; ?>

<!-- Terms Modal -->
<div class="modal fade" id="modal-terms" tabindex="-1" role="dialog" aria-labelledby="modal-terms" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-slidedown" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Termos e condições</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-alt-success" data-dismiss="modal">
                    <i class="fa fa-check"></i> Perfeito
                </button>
            </div>
        </div>
    </div>
</div>
<!-- END Terms Modal -->

<?php require '../inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $cb->get_js('js/plugins/jquery-validation/jquery.validate.min.js'); ?>
<?php $cb->get_js('js/plugins/masked-inputs/jquery.maskedinput.min.js'); ?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#signup-cpf").mask("999.999.999-99");
	});
</script>

<!-- Page JS Code -->
<?php $cb->get_js('/js/custom/register.js'); ?>

<script>jQuery(function(){ Codebase.helpers(['masked-inputs']); });</script>

<?php require '../inc/_global/views/footer_end.php'; ?>

