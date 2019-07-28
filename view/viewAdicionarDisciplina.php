<?php require '../inc/_global/config.php'; ?>
<?php require '../inc/backend/config.php'; ?>
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

require_once("../dao/DaoProfessor.php");
$professoresDao = new DaoProfessor();
$stmtProfessores = $professoresDao->runQuery("SELECT * FROM professor p, usuario u WHERE p.idUsuario = u.idUsuario");
$stmtProfessores->execute();
?>

<!-- Page Content -->

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
<div class="content">
    <div class="my-50 text-center">
        <h2 class="font-w700 text-black mb-10">
            <i class="fa fa-plus text-muted mr-5 text-primary"></i> Adicionar disciplina
        </h2>
        <h3 class="h5 text-muted mb-0">
            Preencha os dados abaixo e clique em adicionar
        </h3>
    </div>
    <div class="block block-rounded block-fx-shadow">
        <div class="block-content">
            <form class="js-validation-disciplina" id="form-cadastrar-disciplina" method="POST">
                <input type="hidden" name="acao" value="adicionar">

                <h2 class="content-heading text-black">Informações sobre a disciplina</h2>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <p class="text-muted">
                            Qual é o nome da disciplina à ser ofertado?
                        </p>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-material floating">
                            <input type="text" class="form-control" id="nome" name="nome">
                            <label for="nome">Nome da disciplina</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <p class="text-muted">
                            Qual professor ministra essa disciplina?
                        </p>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-material">
                            <select class="js-select2 form-control" id="idP" name="idP" style="width: 100%;" data-placeholder="Selecione o professor" single>
                                <option></option>
                                <?php while ($rowProfessores = $stmtProfessores->fetch(PDO::FETCH_ASSOC)) {?>
                                <?php echo '<option value="'.$rowProfessores['idProfessor'].'">'.$rowProfessores['nomeUsuario'].'</option>'; ?>
                                <?php }?>
                                                        
                            </select>
                            <!-- <label for="idP">Selecione o curso...</label> -->
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4">
                        <p class="text-muted">
                            A qual curso pertence essa disciplina?
                        </p>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-material">
                            <select class="js-select2 form-control" id="idC" name="idC" style="width: 100%;" data-placeholder="Selecione o curso" single>
                                <option></option>
                                <?php while ($rowCursos = $stmtCursos->fetch(PDO::FETCH_ASSOC)) {?>
                                <?php echo '<option value="'.$rowCursos['idCurso'].'">'.$rowCursos['nomeCurso'].'</option>'; ?>
                                <?php }?>
                            </select>
                            <!-- <label for="idC">Selecione o curso...</label> -->
                        </div>
                    </div>
                </div>

                <h2 class="content-heading text-black">Informações adicionais</h2>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <p class="text-muted">
                            Ano de oferta da disciplina
                        </p>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-material floating">
                            <input type="text" class="form-control" id="ano" name="ano">
                            <label for="ano">Ano de oferta</label>
                        </div>
                    </div>
                </div>
        </div>

        <!-- Form Submission -->
        <div class="form-group row">
            <div class="mx-auto">
                <div class="form-group">
                    <button type="submit" id="button-cadastrar-disciplina" class="btn btn-alt-primary">
                        <i class="fa fa-plus mr-5"></i>
                        Adicionar
                    </button>
                </div>
            </div>
        </div>
        <!-- END Form Submission -->
        </form>
    </div>
</div>
</div>
<div class="modal">
    <!-- Place at bottom of page -->
</div>

<!-- END Page Content -->

<?php require '../inc/_global/views/page_end.php'; ?>
<?php require '../inc/_global/views/footer_start.php'; ?>
<?php $cb->get_js('/js/plugins/jquery-validation/jquery.validate.min.js'); ?>
<?php $cb->get_js('/js/plugins/sweetalert2/sweetalert2.min.js'); ?>
<?php $cb->get_js('js/plugins/select2/js/select2.full.min.js'); ?>

<script>
jQuery(function() {
    Codebase.helpers('select2');
});
</script>
<?php $cb->get_js('/js/custom/disciplina.js'); ?>

<?php require '../inc/_global/views/footer_end.php'; ?>