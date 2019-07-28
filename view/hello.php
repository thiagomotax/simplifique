<?php
require_once("../dao/DaoCurso.php");    
$cursosDao = new DaoCurso();
$stmtCursos = $cursosDao->runQuery("SELECT * FROM curso");
$stmtCursos->execute();
?>
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


<script>
    $("#idC").select2({
});
</script>

