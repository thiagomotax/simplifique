<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Page Content -->
<div class="bg-gd-lake">
    <div class="hero-static content content-full bg-white invisible" data-toggle="appear">
        <!-- Header -->
        <div class="py-30 px-5 text-center">
            <a class="link-effect font-w700" href="index.php">
                <i class="fa fa-graduation-cap"></i>
                <span class="font-size-xl text-primary-dark">sim</span><span class="font-size-xl">plifique</span>
            </a>
            <h1 class="h2 font-w700 mt-50 mb-10">Não se preocupe, vamos recuperar sua senha</h1>
            <h2 class="h4 font-w400 text-muted mb-0">Preencha seu e-mail abaixo</h2>
        </div>
        <!-- END Header -->

        <!-- Reminder Form -->
        <div class="row justify-content-center px-5">
            <div class="col-sm-8 col-md-6 col-xl-4">
                <!-- jQuery Validation functionality is initialized with .js-validation-reminder class in js/pages/op_auth_reminder.min.js which was auto compiled from _es6/pages/op_auth_reminder.js -->
                <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                <form class="js-validation-reminder" action="be_pages_auth_all.php" method="post">
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                                <input type="text" class="form-control" id="reminder-credential" name="reminder-credential">
                                <label for="reminder-credential">Email</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-hero btn-noborder btn-rounded btn-alt-primary">
                            <i class="fa fa-asterisk mr-10"></i> Recuperar senha
                        </button>
                        <a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" href="viewLogin.php">
                            <i class="si si-login text-muted mr-10"></i> Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Reminder Form -->
    </div>
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $cb->get_js('js/plugins/jquery-validation/jquery.validate.min.js'); ?>

<!-- Page JS Code -->
<?php $cb->get_js('js/pages/op_auth_reminder.min.js'); ?>

<?php require 'inc/_global/views/footer_end.php'; ?>