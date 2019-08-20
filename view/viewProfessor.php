<?php require '../inc/_global/config.php'; ?>
<?php require '../inc/backend/config_prof.php'; ?>
<?php require '../inc/_global/views/head_start.php'; ?>


<?php require '../inc/_global/views/head_end.php'; ?>
<?php require '../inc/_global/views/page_start.php'; ?>

<!-- Page Content -->
<div class="content">


<font color=black> <center> <i>  Não há notícias cadastradas. </i> </center>  </font>

</div>

    <div id="page-loader" class=""></div>
<!-- END Page Content -->

<?php require '../inc/_global/views/page_end.php'; ?>

<?php require '../inc/_global/views/footer_start.php'; ?>


<!-- Page JS Code -->
<?php $cb->get_js('js/pages/be_pages_dashboard.min.js'); ?>

<?php require '../inc/_global/views/footer_end.php'; ?>
