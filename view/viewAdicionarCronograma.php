<?php require '../inc/_global/config.php'; ?>
<?php require '../inc/backend/config_prof.php'; ?>

<?php require '../inc/_global/views/head_start.php'; ?>
<?php $cb->get_css('js/plugins/select2/css/select2.css'); ?>
<?php $cb->get_css('js/plugins/sweetalert2/sweetalert2.min.css'); ?>

<?php require '../inc/_global/views/head_end.php'; ?>
<?php require '../inc/_global/views/page_start.php'; ?>

<?php

if ((isset ($_POST['disciplina'])) || (isset($_POST['curso']))){
$_SESSION['curso'] =  $_POST['curso'];
$_SESSION['disciplina'] =  $_POST['disciplina'];

}

require_once ('../dao/DaoCronograma.php');
$cronogramaDao = new DaoCronograma();

$session= $_SESSION['user_id'];
$query = $cronogramaDao->runQuery("SELECT * FROM professor WHERE idUsuario = $session ");
$query->execute();

while($row = $query->fetch(PDO::FETCH_ASSOC)){

   $idAux = $row['idProfessor'];
   }

$buscando = $cronogramaDao->runQuery("SELECT * FROM curso c, disciplina d WHERE d.idDisciplina = " . $_SESSION['disciplina'] . " AND c.idCurso = " . $_SESSION['curso']  . "");
$buscando->execute();
     
while($laco = $buscando->fetch(PDO::FETCH_ASSOC)){
   $nomeCurso = $laco['nomeCurso'];
   $nomeDisciplina = $laco['nomeDisciplina'];
   }

?>

<style>

.grab {cursor: -webkit-grab; cursor: grab;}

</style>
<!-- Page Content -->
<div class="content">
    <!-- Calendar and Events functionality is initialized in js/pages/be_comp_calendar.min.js which was auto compiled from _es6/pages/be_comp_calendar.js -->
    <!-- For more info and examples you can check out https://fullcalendar.io/ -->
    <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">
                <i class="fa fa-eye text-muted mr-5 text-primary"></i> Cronograma - <?php echo $nomeCurso; ?> - <?php echo $nomeDisciplina; ?> </h2>





            <h3 class="h5 text-muted mb-0">
                Adicione e edite as informações de suas aulaas
            </h3>
        </div>

    <div class="block">
        <div class="block-content " style="width:100%;">

                  <!-- Add Cronograma Form -->
                    <form class="js-validation-cronograma" id="form-cadastrar-cronograma" method="post">
                          <h2 class="content-heading text-black"> Adicione <div style="float: right;">
                             <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Atualizar lista" onclick="window.location.reload()">
                          <i class="fa fa-refresh"></i>
                          Atualizar
                      </button>  </div></h2>
                        <input type="hidden" name="acao" value="adicionar"  >
                        <?php
                        echo ' <input type="hidden" name="curso" value="'. $_SESSION['curso'] .'"  >
                               <input type="hidden" name="disciplina" value="'. $_SESSION['disciplina'] .'">';
                        ?>
                           <div class="input-group" style="width:80%;">
                            <input required type="date" class=" form-control"  name="data">

                            <input required type="text"  class=" form-control"  name="titulo" placeholder="Conteúdo da aula..">

                           </div>
                           <div class="input-group" style="width:80%;">
                           <textarea class="form-control form-control-lg text-secondary" id="descricao" name="descricao" style="width:30%;" rows="1" cols="50" placeholder="Descreva"></textarea>

                           </div>


                           <div class="input-group-append" style="float: right; ">
                               <button type="submit" id="button-cadastrar-cronograma"  class="btn btn-secondary" >
                                  <i class="fa fa-plus-circle"></i>
                                </button>
                            </div>
                    </form>
                    <!--End add Cronograma Form -->


                    <!-- Timeline -->


                    <?php

                    if (isset($_POST['ano'])){

                    $data = $_POST['ano'];

                    }

                    else{

                    $data = date('Y');
                    }

                    $busca = $cronogramaDao->runQuery("SELECT * FROM  cronograma WHERE idProfessor = $idAux AND LEFT(dataCronograma,4) LIKE '$data' AND idCurso =" . $_SESSION['curso'] . " AND idDisciplina = " . $_SESSION['disciplina'] . " ORDER BY dataCronograma DESC");
                    $busca->execute();

                    echo '<h2 class="content-heading text-black">' . $data . ' </h2>';

                    if ($busca->rowCount() < 1) {

                         echo '<h3 class="h5 text-muted mb-0"> Sem cadastros </h3> ';
                   }


                   else  if ($busca->rowCount() > 0){

                   $i=1;

                    while($array = $busca->fetch(PDO::FETCH_ASSOC)){

                       $new = date('d/m/Y', strtotime($array['dataCronograma'] ));
                       $date = date('Y/m/d', strtotime($array['dataCronograma'] ));

                       echo '<table class="table table-bordered table-hover table-striped js-dataTable-full" id="listar_cronograma"> ';

                        echo ' <ul class="list list-timeline list-timeline-modern pull-t">
                                 <li>
                                   <div class="list-timeline-time">' . $new . '
                                      </div>
                                         <button type="button" class="btn btn-sm list-timeline-icon bg-elegance" data-toggle="tooltip" title="Editar" id="rowEditarCronograma_' . $i . '" data-id="' . $array['idCronograma'] . '" data-titulo="' . $array['tituloCronograma'] . '" data-data="' . $new . '" data-descricao="' . $array['descricaoCronograma'] . '" onclick="editarCronograma(' . ($i) . ')">
                                          <i class="fa fa-pencil-square-o fa-2x">
                                        </i>
                                      </button>
                                  <div class="list-timeline-content" style="width:100%;">
                                <p> ' . $array['tituloCronograma'] . ' ...
                               <div style="float: right;">
                             <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Excluir" id="rowDeleteCronograma_' . $i . '" data-id="' . $array['idCronograma'] . '" onclick="excluirCronograma(' . ($i) . ')">
                          <i class="fa fa-times"></i>
                      </button>  </div>  </p>
                 </div> <BR>  <BR>
               </li> </ul> </table>';

                       $i++;
                        } }
                     ?>
                     <BR><BR><BR>
                    <div class="">
                        <em class="font-size-xs text-muted"><i class="fa fa-external-link"></i> Conteúdo referênte ao ano atual, para gerar conteúdo de anos anteriores <a href="viewGerarCronograma.php?ano=1"> clique aqui </a> </em>
                    </div>


                </div>
            </div>
        </div>
    </div>
    
    
    
    <form class="form-horizontal" id="verCronograma-form" method="POST">
    <input type="hidden" name="acao" value="editar">
    <div class="modal" id="verCronograma" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
            <input type="hidden" name="id" id="id">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title" id="nomeP"></h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                       <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material">
                                    <input type="date" class="js-masked-date form-control" id="data" name="data"></input>
                                    <label for="data">Data da aula</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material">
                                    <input type="text" required class="form-control" id="titulo" name="titulo"></input>
                                    <label for="titulo">Conteúdo da aula</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material">
                                  <textarea class="form-control form-control-lg text-secondary" id="descricao" name="descricao"></textarea>
                                   <label for="descricao">Descrição</label>
                                </div>
                            </div>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-alt-success" id="btnEditarCronograma" data-dismiss="modal">
                        <i class="fa fa-check"></i> Salvar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Normal Modal -->
        <div id="page-loader" class="show"></div>



<?php require '../inc/_global/views/page_end.php'; ?>
<?php require '../inc/_global/views/footer_start.php'; ?>

<?php $cb->get_js('/js/plugins/jquery-validation/jquery.validate.min.js'); ?>
<?php $cb->get_js('/js/plugins/sweetalert2/sweetalert2.min.js'); ?>
<?php $cb->get_js('js/plugins/masked-inputs/jquery.maskedinput.min.js'); ?>
<?php $cb->get_js('js/plugins/select2/js/select2.full.min.js'); ?>


<!-- Page JS Code -->
<?php $cb->get_js('/js/custom/cronograma.js'); ?>

<?php require '../inc/_global/views/footer_end.php'; ?>
