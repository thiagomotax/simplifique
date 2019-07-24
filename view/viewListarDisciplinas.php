<?php require '../inc/_global/config.php'; ?>
<?php require '../inc/backend/config.php'; ?>
<?php require '../inc/_global/views/head_start.php'; ?>

<!-- Page JS Plugins CSS -->
<?php $cb->get_css('js/plugins/datatables/dataTables.bootstrap4.css'); ?>

<?php require '../inc/_global/views/head_end.php'; ?>
<?php require '../inc/_global/views/page_start.php'; ?>

<!-- Page Content -->
<div class="content">
<div class="my-50 text-center">
        <h2 class="font-w700 text-black mb-10">
            <i class="fa fa-eye text-muted mr-5"></i> Listar disciplinas
        </h2>
        <h3 class="h5 text-muted mb-0">
            Clique em ver disciplina para editar ou exclua-a
        </h3>
    </div>

    <!-- Dynamic Table Full -->
    <div class="block block-rounded block-fx-shadow">
        <!-- <div class="block-header block-header-default">
            <h3 class="block-title">Dynamic Table <small>Full</small></h3>
        </div> -->
        <div class="block-content block-content-full">
            <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center"></th>
                        <th>Nome</th>
                        <th class="d-none d-sm-table-cell">Email</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Curso</th>
                        <th class="text-center" style="width: 15%;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 1; $i < 21; $i++) { ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="font-w600"><?php $cb->get_name(); ?></td>
                        <td class="d-none d-sm-table-cell">customer<?php echo $i; ?>@example.com</td>
                        <td class="d-none d-sm-table-cell">
                            <?php $cb->get_tag(); ?>
                        </td>
                        <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Ver">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Excluir">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                        </td>
                        
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>
<!-- END Page Content -->

<?php require '../inc/_global/views/page_end.php'; ?>
<?php require '../inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $cb->get_js('js/plugins/datatables/jquery.dataTables.min.js'); ?>
<?php $cb->get_js('js/plugins/datatables/dataTables.bootstrap4.min.js'); ?>

<!-- Page JS Code -->
<?php $cb->get_js('js/pages/be_tables_datatables.min.js'); ?>

<?php require '../inc/_global/views/footer_end.php'; ?>