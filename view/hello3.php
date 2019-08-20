<?php
require_once("../dao/DaoDisciplina.php");
$disciplinasDao = new DaoDisciplina();


$stmtDisciplinas = $disciplinasDao->runQuery("SELECT * FROM disciplina ");
$stmtDisciplinas->execute();
?>




    <style type="text/css">

    .carregando{

    display: none;

    }

     </style>
     
     
<div class="col-md-12">
    <div class="form-material">


                                 <span class="carregando form-control" > "Carregando disciplinas ..." </span>

                                <select required class="js-select2 form-control" style="width: 100%;" id="idD" name="idD"  >

                                     <?php while ($rowDisciplinas = $stmtDisciplinas->fetch(PDO::FETCH_ASSOC)) {?>
                                       <?php if($rowDisciplinas['idDisciplina'] == $_GET['IdDisciplina']){?>
                                        <?php echo '<option value="'.$rowDisciplinas['idDisciplina'].'" selected>'.$rowDisciplinas['nomeDisciplina'].'</option>'; }}?>

                                    <option > </option>


                                 </select>
                                 
        <label for="idD">Disciplina</label>
    </div>
</div>




 <script type="text/javascript" src="https://www.google.com/jsapi"> </script>

 <script type="text/javascript" >

   google.load("search","1");
   google.load("jquery", "1.4.2");
   google.load("jqueryui", "1.7.2");

 </script>


		<script type="text/javascript">
		$(function(){
			$('#idC').change(function(){
				if( $(this).val() ) {
					$('#idD').hide();
					$('.carregando').show();
					$.getJSON('call_disciplina.php?search=',{curso: $(this).val(), ajax: 'true'}, function(j){
						var options = '<option value="">Selecione a disciplina</option>';
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].idDisciplina + '">' + j[i].nomeDisciplina + '</option>';
						}
						$('#idD').html(options).show();
						$('.carregando').hide();
					});
				} else {
					$('#idD').html('<option value="">– Escolha o curso –</option>');
				}
			});
		});
		</script>



<script>
    $("#idD").select2({
});
</script>

