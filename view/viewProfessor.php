<?php require '../inc/_global/config.php'; ?>
<?php require '../inc/backend/config_prof.php'; ?>
<?php require '../inc/_global/views/head_start.php'; ?>

<!-- Page JS Plugins CSS -->
<?php $cb->get_css('js/plugins/sweetalert2/sweetalert2.min.css'); ?>
<?php $cb->get_css('js/plugins/datatables/datatables.min.css'); ?>

<?php require '../inc/_global/views/head_end.php'; ?>
<?php require '../inc/_global/views/page_start.php'; ?>



<!-- Page Content -->

<div class="content">
    
</div>


    <div id="page-loader" class=""></div>
<!-- END Page Content -->

<?php require '../inc/_global/views/page_end.php'; ?>

<?php require '../inc/_global/views/footer_start.php'; ?>

<!-- Page JS Code -->
<?php $cb->get_js('js/pages/be_pages_dashboard.min.js'); ?>

<?php require '../inc/_global/views/footer_end.php'; ?>
