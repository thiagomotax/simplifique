<?php

  require_once ('../dao/DaoCronograma.php');
  $cronogramaDao = new DaoCronograma();

  ?>


<?php require '../inc/_global/config.php'; ?>
<?php require '../inc/backend/config_prof.php'; ?>

<?php require '../inc/_global/views/head_start.php'; ?>
<?php $cb->get_css('js/plugins/select2/css/select2.css'); ?>
<?php $cb->get_css('js/plugins/sweetalert2/sweetalert2.min.css'); ?>

<?php require '../inc/_global/views/head_end.php'; ?>
<?php require '../inc/_global/views/page_start.php'; ?>



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
                <i class="fa fa-plus text-muted mr-5 text-primary"></i> Gerar cronograma de aula
            </h2>
            <h3 class="h5 text-muted mb-0">
                Selecione as apções
            </h3>
        </div>
        <div class="block block-rounded block-fx-shadow">
            <div class="block-content">
                <form class="js-validation-cronograma" id="form-cadastrar-frequencia" method="POST" action="viewAdicionarCronograma.php">
                    <input type="hidden" name="acao" value="adicionar">


                    <div class="form-group row">
                    <div class="col-lg-4">
                            <p class="text-muted">
                                Qual o curso?
                            </p>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-material">
                               <select required class="js-select2 form-control" style="width: 100%;" id="curso" name="curso" data-placeholder="Selecione o curso">
                                 <option value=""> Selecione o curso </option>

                               <?php

                                $busca=$cronogramaDao->runQuery("Select * From curso") ;
                                $busca->execute();

                                 echo "";

                                 while($array=$busca->fetch(PDO::FETCH_ASSOC)){

                                    echo "<option name='curso' value='$array[idCurso]'> $array[nomeCurso]
                                      </option>";
                                       }

                                       echo "";

                                 ?>
                                 </select>
                            </div>
                        </div>
                    </div>

                    






                    <div class="form-group row">
                    <div class="col-lg-4">
                        <p class="text-muted">
                            Qual a disciplina?
                        </p>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-material">


                                <select required class="js-select2 form-control" style="width: 100%;" id="disciplina" name="disciplina"  >
                                 <span class="selecione form-control" >   <option selected> Selecione um curso </option>        </span>


                                 </select>
                        </div>
                    </div>
                    </div>
                    
                    <?php
                    
                    if(isset($_REQUEST['ano'])) {
                    
                    $atual = date('Y');
                    
                    echo '  <div class="form-group row">
                    <div class="col-lg-4">
                            <p class="text-muted">
                                Qual o ano?
                            </p>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-material floating">
                                <input type="number" class="form-control" id="ano" name="ano" min="2019" max="' . $atual . '" step="1" value="2019">
                            </div>
                        </div>
                    </div>';
                     }
                    ?>
            </div>

            <!-- Form Submission -->
            <div class="form-group row">
                <div class="mx-auto">
                    <div class="form-group">
                        <button type="submit"  id="button-Gerar-Cronograma" class="btn btn-alt-primary">
                            <i class="fa fa-plus mr-5"></i>
                            Gerar
                        </button>
                    </div>
                </div>
            </div>
            <!-- END Form Submission -->
            </form>
        </div>
    </div>
    </div>
    <div class="modal"><!-- Place at bottom of page --></div>
        <div id="page-loader" class="show"></div>



<!-- END Page Content -->


  <script type="text/javascript" src="https://www.google.com/jsapi"> </script>

 <script type="text/javascript" >

   google.load("search","1");
   google.load("jquery", "1.4.2");
   google.load("jqueryui", "1.7.2");

 </script>


		<script type="text/javascript">
		$(function(){
			$('#curso').change(function(){
				if( $(this).val() ) {
					$('#disciplina').hide();

					$('.carregando').show();
					$.getJSON('call_disciplina.php?search=',{curso: $(this).val(), ajax: 'true'}, function(j){
						var options = '<option value="">Selecione a disciplina</option>';
						for (var i = 0; i < j.length; i++) {
							options += '<option name="disciplina" value="' + j[i].idDisciplina + '">' + j[i].nomeDisciplina + '</option>';
						}
						$('#disciplina').html(options).show();
						$('.carregando').hide();
					});
				} else {
					$('#disciplina').html('<option value="">– Escolha o curso –</option>');
                }
                

            });

            /*var curso = document.getElementById('curso');
            curso.setCustomValidity('Selecione um curso');*/
		});
		</script>
		
		
		
<?php require '../inc/_global/views/page_end.php'; ?>
<?php require '../inc/_global/views/footer_start.php'; ?>

<?php $cb->get_js('/js/plugins/jquery-validation/jquery.validate.min.js'); ?>
<?php $cb->get_js('/js/plugins/sweetalert2/sweetalert2.min.js'); ?>
<?php $cb->get_js('js/plugins/masked-inputs/jquery.maskedinput.min.js'); ?>
<?php $cb->get_js('js/plugins/select2/js/select2.full.min.js'); ?>






<script>
jQuery(function() {
    Codebase.helpers('select2');
});
</script>

<?php $cb->get_js('/js/custom/cronograma.js'); ?>
<script>jQuery(function(){ Codebase.helpers(['masked-inputs']); });</script>


<?php require '../inc/_global/views/footer_end.php'; ?>
