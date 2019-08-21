<?php require '../inc/_global/config.php'; ?>
<?php require '../inc/backend/config_prof.php'; ?>
<?php require '../inc/_global/views/head_start.php'; ?>

<?php

require_once ('../dao/DaoFrequencia.php');
$frequenciaDao = new DaoFrequencia();

?>


<!-- Page JS Plugins CSS -->
<?php $cb->get_css('js/plugins/sweetalert2/sweetalert2.min.css'); ?>
<?php $cb->get_css('js/plugins/datatables/datatables.min.css'); ?>
<?php $cb->get_css('js/plugins/select2/css/select2.css'); ?>


<?php require '../inc/_global/views/head_end.php'; ?>
<?php require '../inc/_global/views/page_start.php'; ?>

<?php


$buscando = $frequenciaDao->runQuery("SELECT * FROM curso c, disciplina d WHERE d.idDisciplina = " . $_SESSION['idDisciplina'] . " AND c.idCurso = " . $_SESSION['idCurso'] . "");
$buscando->execute();

while($array = $buscando->fetch(PDO::FETCH_ASSOC)){
     $nomeCurso = $array['nomeCurso'];
     $nomeDisciplina = $array['nomeDisciplina'];
}

?>

<script type="text/javascript" src="jquery.js"> </script>

   <style type="text/css">

    .carregando{

    display: none;

    }

     .selecione{

    display: block;

    }

   input:focus, select:focus {
    outline: 0;
}

     </style>
     
     
<style>
    /* Start by setting display:none to make this hidden.
   Then we position it in relation to the viewport window
   with position:fixed. Width, height, top and left speak
   for themselves. Background we set to 80% white with
   our animation centered, and no-repeating */
.fuck {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba(255, 255, 255, .8) url('../assets/loading.gif') 50% 50% no-repeat;
}

/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
body.loading .fuck {
    overflow: hidden;
}

/* Anytime the body has the loading class, our
   modal element will be visible */
body.loading .fuck{
    display: block;
}
</style>

<!-- Page Content -->
<div class="content">
    <div class="my-50 text-center">
        <h2 class="font-w700 text-black mb-10">
            <i class="fa fa-eye text-muted mr-5 text-primary"></i> Lista de alunos
        </h2>
        <h3 class="h5 text-muted mb-0">
           &nbsp &nbsp &nbsp &nbsp &nbsp <?php echo $nomeCurso; ?> - <?php echo $nomeDisciplina; ?> - <?php echo date('d/m/Y', strtotime($_SESSION['idData']));  ?>
        </h3>
    </div>

    <!-- Dynamic Table Full -->
    <div class="block block-rounded block-fx-shadow">
        <!-- <div class="block-header block-header-default">
            <h3 class="block-title">Dynamic Table <small>Full</small></h3>
        </div> -->
        <div class="block-content block-content-full ">


                
            <table class="table table-bordered table-hover table-striped js-dataTable-full"
                style="width: 100%; white-space: normal;" id="listar_frequencia">
                <thead>
                    <tr>
                        <th style="width: 5%;">Número</th>
                        <th>Matricula</th>
                        <th>Nome</th>
                        <th>Situação</th>
                        <th>Alterar situação </th>
                        </tr>
                    </thead>
                    


                <tbody >

                   





                </tbody>
            </table>
            
             <div class="form-group row">
                <div class="mx-auto">
                    <div class="form-group">
                           <a href="viewGerarFrequencia.php">
                              <button type="button" class="btn btn-alt-primary">
                                      <i class="fa fa-plus mr-5"></i>
                                         Voltar
                              </button>
                           </a>

                </div>
             </div>
          </div>
          

    </div>
    </div>
    </div>
    <div class="modal"><!-- Place at bottom of page --></div>
    <div id="page-loader" class="show"></div>
    <!-- END Dynamic Table Full -->





    <!-- <button type="button" class="btn btn-alt-info" data-toggle="modal" data-target="#verCurso">Launch Modal</button> -->
    <!-- Normal Modal -->




<!-- END Page Content -->

<?php require '../inc/_global/views/page_end.php'; ?>
<?php require '../inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $cb->get_js('/js/plugins/jquery-validation/jquery.validate.min.js'); ?>
<?php $cb->get_js('/js/plugins/sweetalert2/sweetalert2.min.js'); ?>
<?php $cb->get_js('js/plugins/select2/js/select2.full.min.js'); ?>
<?php $cb->get_js('/js/plugins/datatables/datatables.min.js'); ?>
<?php $cb->get_js('js/plugins/masked-inputs/jquery.maskedinput.min.js'); ?>

<script>




$(document).ready(function() {


    jQuery('.js-dataTable-full').dataTable({
        "columnDefs": [{
                "targets": [0],
                "visible": false,
            },
            {
                "targets": [1],
                "visible": true,
            },
            {
                "targets": [2],
                "visible": true,
            },
            {
                "targets": [3],
                "visible": true,
            },
            {
                "targets": [4],
                "visible": true,
            }
        ],
        "pagingType": "simple_numbers",
        "pageLength": 10,
        "ajax": {
            "url": "viewAjaxListaFrequencia.php",
            "type": "POST"
        },
        "columns": [
            {
                "data": "numero",
            },
            {
                "data": "matricula",
            },
            {
                "data": "nome",
            },
            {
                "data": "situacaoAt",
            },
            {
                "data": "button",
            }
        ],
        dom: 'Bfrtip',

        buttons: [
        {
            extend: 'print',
            title: 'Relatório de Frequencia - Curso - Disciplina - data',
            text: '<i class="fa fa-print"></i> imprimir',
            exportOptions: {
                columns: [0,2,3]
            }
        },
        {
            extend: 'pdf',
            title: 'Relatório de Frequencia',
            text: '<i class="fa fa-file-pdf-o"></i> pdf',
            exportOptions: {
                columns: [0,2,3]
            }
        },
        {    extend: 'colvis',
                text: '<i class="fa fa-eye-slash"></i> colunas',
        }],
        "colReorder": true,

        "lengthMenu": [
            [5, 10, 15, 20],
            [5, 10, 15, 20]
        ],
        "responsive": true,
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ atÃ© _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 atÃ© 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por pÃ¡gina",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": " >",
                "sPrevious": "< ",
                "sFirst": "Primeiro",
                "sLast": "Ãšltimo"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            },
        }
    });
});
</script>


        
<!-- <script>
function dataAtualFormatada(){
    var data = new Date(),
        dia  = data.getDate().toString().padStart(2, '0'),
        mes  = (data.getMonth()+1).toString().padStart(2, '0'), //+1 pois no getMonth Janeiro comeÃ§a com zero.
        ano  = data.getFullYear();
        time = data.getHours()+"h" + data.getMinutes()+"min";
    return " " + dia+"-"+mes+"-"+ano+" "+time;
}
</script> -->

<?php $cb->get_js('js/plugins/select2/js/select2.full.min.js'); ?>

<script>
jQuery(function() {
    Codebase.helpers('select2');
});
</script>


<?php $cb->get_js('/js/custom/frequencia.js'); ?>


<script>jQuery(function(){ Codebase.helpers(['masked-inputs']); });</script>

<!-- Page JS Code -->

<?php require '../inc/_global/views/footer_end.php'; ?>

