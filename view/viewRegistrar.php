<?php require '../inc/_global/config.php'; ?>
<?php require '../inc/_global/views/head_start.php'; ?>
<?php $cb->get_css('js/plugins/select2/css/select2.css'); ?>
<?php $cb->get_css('js/plugins/sweetalert2/sweetalert2.min.css'); ?>

<?php require '../inc/_global/views/head_end.php'; ?>
<?php require '../inc/_global/views/page_start.php'; ?>

<?php
require_once("../dao/DaoCurso.php");    
$cursosDao = new DaoCurso();
$stmtCursos = $cursosDao->runQuery("SELECT * FROM curso");
$stmtCursos->execute();

require_once("../dao/DaoDisciplina.php");    
$disciplinasDao = new DaoDisciplina();
$stmtDisciplinas = $disciplinasDao->runQuery("SELECT * FROM disciplina");
$stmtDisciplinas->execute();
?>

<style>
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background: rgba(255, 255, 255, .8) url('../assets/loading.gif') 50% 50% no-repeat;
}

/* enquanto estiver carregando, o scroll da página estará desativado */
body.loading {
    overflow: hidden;
}

/* a partir do momento em que o body estiver com a classe loading,  o modal aparecerá */
body.loading .modal {
    display: block;
}
</style>
<style>
.error {
    color: red;

}
</style>

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
            <h2 class="h4 font-w400 text-muted mb-0">Por favor, preencha cuidadosamente seus dados abaixo e aguarde o
                e-mail de aprovação da conta.</h2>
        </div>
        <!-- END Header -->

        <!-- Sign Up Form -->
        <div class="row justify-content-center px-5">
            <div class="col-sm-8 col-md-6 col-xl-4">
                <!-- jQuery Validation functionality is initialized with .js-validation-signup class in js/pages/op_auth_signup.min.js which was auto compiled from _es6/pages/op_auth_signup.js -->
                <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                <form class="js-validation-signup" id="form-cadastrar-aluno" method="post">
                <input type="hidden" name="acao" value="adicionar">
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
                                <input type="text" class="js-masked-date form-control" id="signup-data"
                                    name="signup-data">
                                <label for="signup-data">Data de nascimento</label>
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
                                <input type="password" class="form-control" id="signup-password-confirm"
                                    name="signup-password-confirm">
                                <label for="signup-password-confirm">Confirmação de senha</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material">
                                <select class="js-select2 form-control" id="signup-curso" name="signup-curso" style="width: 100%;" data-placeholder="tesste" single>
                                    <option></option>
                                    <?php while ($rowCursos = $stmtCursos->fetch(PDO::FETCH_ASSOC)) {?>
                                    <?php echo '<option value="'.$rowCursos['idCurso'].'">'.$rowCursos['nomeCurso'].'</option>'; ?>
                                    <?php }?>
                                </select>
                            </div>
                            <!-- <label for="idC">Selecione o curso...</label> -->
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
                            <button type="submit" id="button-cadastrar-usuario"
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
<div class="modal fade" id="modal-terms" role="dialog" aria-labelledby="modal-terms" aria-hidden="true">
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
<div class="modal">
    <!-- Place at bottom of page -->
</div>
<div id="page-loader" class="show"></div>


<!-- END Terms Modal -->

<?php require '../inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $cb->get_js('js/plugins/jquery-validation/jquery.validate.min.js'); ?>
<?php $cb->get_js('js/plugins/masked-inputs/jquery.maskedinput.min.js'); ?>
<?php $cb->get_js('/js/plugins/sweetalert2/sweetalert2.min.js'); ?>
<?php $cb->get_js('js/plugins/select2/js/select2.full.min.js'); ?>



<script>
    $("#signup-curso").select2({
        placeholder: "Selecione o curso"
});
</script>
<!-- Page JS Code -->
<?php $cb->get_js('/js/custom/register.js'); ?>

<script>
jQuery(function() {
    Codebase.helpers(['masked-inputs']);
});
</script>

<?php require '../inc/_global/views/footer_end.php'; ?>