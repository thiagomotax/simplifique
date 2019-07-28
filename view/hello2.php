<?php require '../inc/_global/config.php'; ?>
<?php require '../inc/backend/config.php'; ?>
<?php $cb->get_css('js/plugins/select2/css/select2.css'); ?>

<?php
require_once("../dao/DaoProfessor.php");
$professoresDao = new DaoProfessor();
$stmtProfessores = $professoresDao->runQuery("SELECT * FROM professor p, usuario u WHERE p.idUsuario = u.idUsuario");
$stmtProfessores->execute();
?>

<div class="col-md-12">
    <div class="form-material">
        <select class="js-select2 form-control" id="idP" name="idP" style="width: 100%;" single>
            <?php while ($rowProfessores = $stmtProfessores->fetch(PDO::FETCH_ASSOC)) {?>
            <?php if($rowProfessores['idProfessor'] == $_GET['IdProfessor']){?>
            <?php echo '<option value="'.$rowProfessores['idProfessor'].'" selected>'.$rowProfessores['nomeUsuario'].'</option>'; }else{?>
            <?php echo '<option value="'.$rowProfessores['idProfessor'].'">'.$rowProfessores['nomeUsuario'].'</option>'; }?>
            <?php }?>
        </select>
    </div>
</div>

<?php $cb->get_js('js/plugins/select2/js/select2.full.min.js'); ?>
<script>
$("#idP").select2({
});


</script>

<?php
?>