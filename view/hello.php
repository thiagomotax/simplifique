<?php require '../inc/_global/config.php'; ?>
<?php require '../inc/backend/config.php'; ?>
<?php $cb->get_css('js/plugins/select2/css/select2.css'); ?>

<?php
require_once("../dao/DaoCurso.php");    
$cursosDao = new DaoCurso();
$stmtCursos = $cursosDao->runQuery("SELECT * FROM curso");
$stmtCursos->execute();
?>
<div class="form-group row">
<div class="col-md-12">
    <div class="form-material">
        <select class="js-select2 form-control" id="idC" name="idC" style="width: 100%;" single>
            <?php while ($rowCursos = $stmtCursos->fetch(PDO::FETCH_ASSOC)) {?>
            <?php if($rowCursos['idCurso'] == $_GET['IdCurso']){?>
            <?php echo '<option value="'.$rowCursos['idCurso'].'" selected>'.$rowCursos['nomeCurso'].'</option>'; }else{?>
            <?php echo '<option value="'.$rowCursos['idCurso'].'">'.$rowCursos['nomeCurso'].'</option>'; }?>
            <?php }?>
        </select>
    </div>
</div>
            </div>


<?php $cb->get_js('js/plugins/select2/js/select2.full.min.js'); ?>
<script>
    $("#idC").select2({
});
</script>

<?php
?>