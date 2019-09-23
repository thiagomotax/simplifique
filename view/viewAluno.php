<?php require '../inc/_global/config.php'; ?>
<?php require '../inc/backend/config_aluno.php'; ?>
<?php require '../inc/_global/views/head_start.php'; ?>

<!-- Page JS Plugins CSS -->
<?php $cb->get_css('js/plugins/sweetalert2/sweetalert2.min.css'); ?>
<?php $cb->get_css('js/plugins/datatables/datatables.min.css'); ?>
<?php $cb->get_css('js/plugins/select2/css/select2.css'); ?>

<?php require '../inc/_global/views/head_end.php'; ?>
<?php require '../inc/_global/views/page_start.php'; ?>



<!-- Page Content -->

<div class="content">
     <div class="block block-rounded block-fx-shadow">
          <div class="block-content">
          <h2 class="content-heading text-black">
          <i class="fa fa-exclamation" aria-hidden="true"> </i> �ltimas not�cias</h2>
          </div>

    <!-- Dynamic Table Full -->
   <!-- <div class="block-header block-header-default">
            <h3 class="block-title">Dynamic Table <small>Full</small></h3>
        </div> -->
        <div class="block-content block-content-full ">
            <div class="block-content">
            <table class=" table-hover table-striped js-dataTable-full"
                style="width: 100%; white-space: normal;" id="noticia">
                <thead>
                <tr>
                <td> <p align="right"><b><i>Ordenar &nbsp</i></b></p>
                </td>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div> </div>
</div>


    <div id="page-loader" class=""></div>
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
                "visible": true,
            }

        ],
        "pagingType": "simple_numbers",
        "pageLength": 10,
        "ajax": {
            "url": "viewAjaxNoticiaAluno.php",
            "type": "POST"
        },
        "columns": [
            {
                "data": "tituloNoticia",
                // "width": "80%"
            }
        ],


       "colReorder": true,
       "order": [[ 0, "ASC" ]],
       "lengthMenu": [
            [5, 10, 15, 20],
            [5, 10, 15, 20]
        ],

        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": ".",
            "sInfoEmpty": ".",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": ".",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar data",
            "oPaginate": {
                "sNext": " >",
                "sPrevious": "< ",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },

        }
    });
});
</script>

<script type="text/javascript">
	$(document).ready(function());
</script>


<?php $cb->get_js('js/plugins/masked-inputs/jquery.maskedinput.min.js'); ?>
<script>jQuery(function(){ Codebase.helpers(['masked-inputs']); });</script>

<!-- Page JS Code -->
<?php $cb->get_js('js/pages/be_pages_dashboard.min.js'); ?>

<?php require '../inc/_global/views/footer_end.php'; ?>
