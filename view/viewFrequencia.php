<?php require '../inc/_global/config.php'; ?>
<?php require '../inc/backend/config_aluno.php'; ?>
<?php require '../inc/_global/views/head_start.php'; ?>

<!-- Page JS Plugins CSS -->
<?php $cb->get_css('js/plugins/sweetalert2/sweetalert2.min.css'); ?>
<?php $cb->get_css('js/plugins/datatables/datatables.min.css'); ?>
<?php $cb->get_css('js/plugins/select2/css/select2.css'); ?>


<?php require '../inc/_global/views/head_end.php'; ?>
<?php require '../inc/_global/views/page_start.php'; ?>

<?php

require_once ('../dao/DaoLogin.php');
$loginDao = new DaoLogin();

$stmt = $loginDao->runQuery("SELECT * FROM aluno a, disciplina d, matricula_curso m  WHERE a.idUsuario =" . $_SESSION['user_id'] . "  AND a.idAluno = m.idAluno AND m.idCurso = d.idCurso ");
$stmt->execute();

?>

<!-- Page Content -->
<div class="content">
     <div class="block block-rounded block-fx-shadow">

    <!-- Dynamic Table Full -->
   <!-- <div class="block-header block-header-default">
            <h3 class="block-title">Dynamic Table <small>Full</small></h3>
        </div> -->
        <!-- END -->
        <div class="block-content">
         <h2 class="content-heading text-black">Frequência</h2>
         </div>
         <div class="block-content" >
             <div class="dropdown">
             <a class="btn btn-alt-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             Disciplinas
             <i class="fa fa-search"></i>
             </a>
             <form class="form-horizontal" method="post" id="disciplinas-form">
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                        <?php
                        $i=1;
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {?>
                                <?php  echo ' <button type="button" class="btn btn-alt-primary dropdown-item" data-toggle="tooltip"  id="rowInsereDisciplina_' . $i . '" data-id="'.$row['idDisciplina'].'" onclick="InsereDisciplina(' . ($i) . ')">'.$row['nomeDisciplina'].'
                                            </button> <div class="dropdown-divider"></div>'; ?>
                                <?php $i++; }?>
                           <BR> <!-- <label for="idC">Selecione o curso...</label> -->
                         </div>

                    </form>     </div>
                    </div>


        <div class="block-content" >


        <div class="block-content block-content-full ">
           <center>
           <table class="table table-bordered table-hover table-striped js-dataTable-full"
                style="width: 25%; white-space: normal;" id="frequencia">
                <thead>
                  <th style="background-color:#E6E6FA; "> Data </th>
                   <th style="background-color:#E6E6FA; "> Situação </th>
                 </thead>
                   <tbody>

                </tbody>


            </table> </center>
        </div>   </div>   </div>
    </div>
</div>
    <!-- END Dynamic Table Full -->

    <!-- <button type="button" class="btn btn-alt-info" data-toggle="modal" data-target="#verCurso">Launch Modal</button> -->
    <!-- Normal Modal -->


<div class="fuck"><!-- Place at bottom of page --></div>
<div id="page-loader" class="show"></div>

<!-- END Page Content -->

<?php require '../inc/_global/views/page_end.php'; ?>
<?php require '../inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $cb->get_js('/js/plugins/jquery-validation/jquery.validate.min.js'); ?>
<?php $cb->get_js('/js/plugins/sweetalert2/sweetalert2.min.js'); ?>
<?php $cb->get_js('js/plugins/select2/js/select2.full.min.js'); ?>
<?php $cb->get_js('/js/plugins/datatables/datatables.min.js'); ?>
<?php $cb->get_js('js/plugins/masked-inputs/jquery.maskedinput.min.js'); ?>

<?php $cb->get_js('/js/custom/alunoLogado.js'); ?>

<script>
$(document).ready(function() {
    jQuery('.js-dataTable-full').dataTable({
        "columnDefs": [{
                "targets": [0],
                "visible": true,
            },
            {
                "targets": [1],
                "visible": true,
            }

        ],
        "pagingType": "simple_numbers",
        "pageLength": 10,
        "ajax": {
            "url": "viewAjaxFrequenciaAluno.php",
            "type": "POST"
        },
        "columns": [
            {
                "data": "dataF",
                // "width": "80%"
            },
            {
                "data": "situacao",
                // "width": "80%"
            }
        ],
        

       "colReorder": true,
       "order": [[ 1, "asc" ]],
       "lengthMenu": [
            [5, 10, 15, 20],
            [5, 10, 15, 20]
        ],

        "language": {
            "sEmptyTable": "Lista Vazia",
            "sInfo": ".",
            "sInfoEmpty": ".",
            "sInfoFiltered": ".",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": ".",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "           Pesquisar data",
            "oPaginate": {
                "sNext": " >",
                "sPrevious": "< ",
                "sFirst": "Primeiro",
                "sLast": "Ãšltimo"
            },

        }
    });
});
</script>

<script type="text/javascript">
	$(document).ready(function());
</script>

<script>
jQuery(function() {
    Codebase.helpers('select2');
});
</script>

<?php $cb->get_js('js/plugins/masked-inputs/jquery.maskedinput.min.js'); ?>
<script>jQuery(function(){ Codebase.helpers(['masked-inputs']); });</script>

<!-- Page JS Code -->

<?php require '../inc/_global/views/footer_end.php'; ?>
