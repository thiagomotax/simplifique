<?php require '../inc/_global/config.php'; ?>
<?php require '../inc/_global/views/head_start.php'; ?>
<?php require '../inc/_global/views/head_end.php'; ?>
<?php require '../inc/_global/views/page_start.php'; ?>


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
<div class="bg-gd-dusk">
    <div class="hero-static content content-full bg-white invisible" data-toggle="appear">
        <!-- Header -->
        <div class="py-30 px-5 text-center">
            <a class="link-effect font-w700" href="index.php">
                <i class="fa fa-graduation-cap"></i>
                <span class="font-size-xl text-primary-dark">sim</span><span class="font-size-xl">plifique</span>
            </a>
            <h1 class="h2 font-w700 mt-50 mb-10">Bem-vindo ao Simplifique</h1>
            <h2 class="h4 font-w400 text-muted mb-0">Por favor, faça login</h2>
        </div>
        <!-- END Header -->

        <!-- Sign In Form -->
        <div class="row justify-content-center px-5">
            <div class="col-sm-8 col-md-6 col-xl-4">
                <!-- jQuery Validation functionality is initialized with .js-validation-signin class in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js -->
                <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                <form class="js-validation-signin" id="form-login" name="form-login" method="post">
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                                <input type="text" class="form-control" id="login-email" name="login-email">
                                <label for="login-email">E-mail</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                                <input type="password" class="form-control" id="login-password" name="login-password">
                                <label for="login-password">Senha</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row gutters-tiny">
                        <div class="col-12 mb-10">
                            <button type="submit" id="button-login" class="btn btn-block btn-hero btn-noborder btn-rounded btn-alt-primary">
                                <i class="si si-login mr-10"></i> Login
                            </button>
                        </div>
                        <div class="col-sm-6 mb-5">
                            <a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" href="viewRegistrar.php">
                                <i class="fa fa-plus text-muted mr-5"></i> Criar conta
                            </a>
                        </div>
                        <div class="col-sm-6 mb-5">
                            <a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" href="viewRecuperar.php">
                                <i class="fa fa-warning text-muted mr-5"></i> Esqueceu a senha?
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Sign In Form -->
    </div>
</div>
<div class="fuck"><!-- Place at bottom of page --></div>
<div id="page-loader" class="show"></div>


<!-- END Page Content -->

<?php require '../inc/_global/views/page_end.php'; ?>
<?php require '../inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $cb->get_js('/js/plugins/jquery-validation/jquery.validate.min.js'); ?>

<!-- Page JS Code -->
<?php $cb->get_js('/js/custom/login.js'); ?>

<?php require '../inc/_global/views/footer_end.php'; ?>