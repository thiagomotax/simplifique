<?php

$conn=mysqli_connect("localhost","root","","bd_simplifique");

 /**
 * backend/views/inc_header.php
 *
 * Author: pixelcave
 *
 * The header of each page
 *
 */

 $session= $_SESSION['user_id'];
 $query=mysqli_query($conn,"SELECT * FROM usuario WHERE idUsuario = $session ")
  or die("Erro ao realizar a busca:".mysql_error());


   while($row=mysqli_fetch_array($query)){

         $idAux = $row['nomeUsuario'];
         $local="../assets/media/avatars/". $row['fotoUsuario'];

         if (($row['fotoUsuario'] != '') && (file_exists($local))){

             $foto = $local;

          }
         else{

             $foto="../assets/media/avatars/perfil_0.jpg";

         }

   }
   

             


?>

<!-- Sidebar -->
<!--
    Helper classes

    Adding .sidebar-mini-hide to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
    Adding .sidebar-mini-show to an element will make it visible (opacity: 1) when the sidebar is in mini mode
        If you would like to disable the transition, just add the .sidebar-mini-notrans along with one of the previous 2 classes

    Adding .sidebar-mini-hidden to an element will hide it when the sidebar is in mini mode
    Adding .sidebar-mini-visible to an element will show it only when the sidebar is in mini mode
        - use .sidebar-mini-visible-b if you would like to be a block when visible (display: block)
-->

<script type='text/javascript'>
Function submit(){
var formulario = document.getElementById('form-atualizar-imagem');
formulario.submit();
}
</script>


<style>

#upload_file{width:0.1px;height:0.1px;opacity:0;overflow:hidden;position:absolute;z-index:-1;}
img{  border-radius: 50%;
  width: 65px;
  height: 65px;
  overflow: hidden;
  position: relative;
  align: center;
  bottom: 0px;
  top:0px;
}

</style>


<nav id="sidebar">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Side Header -->
        <div class="content-header content-header-fullrow px-15">
            <!-- Mini Mode -->
            <div class="content-header-section sidebar-mini-visible-b">
                <!-- Logo -->
                <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                    <span class="text-dual-primary-dark">s</span><span class="text-primary">p</span>
                </span>
                <!-- END Logo -->
            </div>
            <!-- END Mini Mode -->

            <!-- Normal Mode -->
            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                    <i class="fa fa-times text-danger"></i>
                </button>
                <!-- END Close Sidebar -->

                <!-- Logo -->
                <div class="content-header-item">
                    <a class="link-effect font-w700" href="index.php">
                        <i class="si si-graduation text-primary"></i>
                        <span class="font-size-xl text-dual-primary-dark">sim</span><span class="font-size-xl text-primary">plifique</span>
                    </a>
                </div>
                <!-- END Logo -->
            </div>
            <!-- END Normal Mode -->
        </div>
        <!-- END Side Header -->

        <!-- Side User -->
        <div class="content-side content-side-full content-side-user px-10 align-parent">
            <!-- Visible only in mini mode -->
            <div class="sidebar-mini-visible-b align-v animated fadeIn">
                <?php $cb->get_avatar('15', '', 32); ?>
            </div>
            <!-- END Visible only in mini mode -->

            <!-- Visible only in normal mode -->
            <div class="sidebar-mini-hidden-b text-center " id="">

                <form class="js-validation-logado" id="form-atualizar-imagem" action="../controller/ControllerLogado.php"  method="POST" encyte="multipart/form-data">
                <input type="hidden" name="acao" value="foto"/>
                <?php
                 echo '<input type="hidden" name="id"  value="'. $session .'">';
                ?>

                <input type="file" id="upload_file" name="foto" style="opacity: 0;" accept="image/png, image/jpeg" onchange="submit()" >
                <label id="upload_btn" for="upload_file" style="cursor: pointer;" class="estilo img-link">
                <?php
                echo'<img src="'. $foto .'" >';
                ?>
                </label>
                </input>
                </form>
                <ul class="list-inline mt-10">
                    <li class="list-inline-item">
                        <a class="link-effect text-dual-primary-dark font-size-xs font-w600 text-uppercase" href="#"><?php echo explode(' ', $idAux)[0]; ?></a>
                    </li>
                    <li class="list-inline-item">
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="link-effect text-dual-primary-dark" data-toggle="layout" data-action="sidebar_style_inverse_toggle" href="javascript:void(0)">
                            <i class="si si-drop"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a class="link-effect text-dual-primary-dark" href="viewLogin.php">
                            <i class="si si-logout"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END Visible only in normal mode -->
        </div>
        <!-- END Side User -->

        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <?php $cb->build_nav(); ?>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>
<!-- END Sidebar -->

<?php

$conn=mysqli_connect("localhost","root","","bd_simplifique");

 /**
 * backend/views/inc_header.php
 *
 * Author: pixelcave
 *
 * The header of each page
 *
 */

 $session= $_SESSION['user_id'];
 $query=mysqli_query($conn,"SELECT * FROM usuario WHERE idUsuario = $session ")
  or die("Erro ao realizar a busca:".mysql_error());


   while($row=mysqli_fetch_array($query)){

         $idAux = $row['nomeUsuario'];
         $local="../assets/media/avatars/". $row['fotoUsuario'];

         if (($row['fotoUsuario'] != '') && (file_exists($local))){

             $foto = $local;

          }
         else{

             $foto="../assets/media/avatars/perfil_0.jpg";

         }

   }
   

             


?>

<!-- Sidebar -->
<!--
    Helper classes

    Adding .sidebar-mini-hide to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
    Adding .sidebar-mini-show to an element will make it visible (opacity: 1) when the sidebar is in mini mode
        If you would like to disable the transition, just add the .sidebar-mini-notrans along with one of the previous 2 classes

    Adding .sidebar-mini-hidden to an element will hide it when the sidebar is in mini mode
    Adding .sidebar-mini-visible to an element will show it only when the sidebar is in mini mode
        - use .sidebar-mini-visible-b if you would like to be a block when visible (display: block)
-->

<script type='text/javascript'>
Function submit(){
var formulario = document.getElementById('form-atualizar-imagem');
formulario.submit();
}
</script>


<style>

#upload_file{width:0.1px;height:0.1px;opacity:0;overflow:hidden;position:absolute;z-index:-1;}
img{  border-radius: 50%;
  width: 65px;
  height: 65px;
  overflow: hidden;
  position: relative;
  align: center;
  bottom: 0px;
  top:0px;
}

</style>


<nav id="sidebar">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Side Header -->
        <div class="content-header content-header-fullrow px-15">
            <!-- Mini Mode -->
            <div class="content-header-section sidebar-mini-visible-b">
                <!-- Logo -->
                <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                    <span class="text-dual-primary-dark">s</span><span class="text-primary">p</span>
                </span>
                <!-- END Logo -->
            </div>
            <!-- END Mini Mode -->

            <!-- Normal Mode -->
            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                    <i class="fa fa-times text-danger"></i>
                </button>
                <!-- END Close Sidebar -->

                <!-- Logo -->
                <div class="content-header-item">
                    <a class="link-effect font-w700" href="index.php">
                        <i class="si si-graduation text-primary"></i>
                        <span class="font-size-xl text-dual-primary-dark">sim</span><span class="font-size-xl text-primary">plifique</span>
                    </a>
                </div>
                <!-- END Logo -->
            </div>
            <!-- END Normal Mode -->
        </div>
        <!-- END Side Header -->

        <!-- Side User -->
        <div class="content-side content-side-full content-side-user px-10 align-parent">
            <!-- Visible only in mini mode -->
            <div class="sidebar-mini-visible-b align-v animated fadeIn">
                <?php $cb->get_avatar('15', '', 32); ?>
            </div>
            <!-- END Visible only in mini mode -->

            <!-- Visible only in normal mode -->
            <div class="sidebar-mini-hidden-b text-center " id="">

                <form class="js-validation-logado" id="form-atualizar-imagem" action="../controller/ControllerLogado.php"  method="POST" encyte="multipart/form-data">
                <input type="hidden" name="acao" value="foto"/>
                <?php
                 echo '<input type="hidden" name="id"  value="'. $session .'">';
                ?>

                <input type="file" id="upload_file" name="foto" style="opacity: 0;" accept="image/png, image/jpeg" onchange="submit()" >
                <label id="upload_btn" for="upload_file" style="cursor: pointer;" class="estilo img-link">
                <?php
                echo'<img src="'. $foto .'" >';
                ?>
                </label>
                </input>
                </form>
                <ul class="list-inline mt-10">
                    <li class="list-inline-item">
                        <a class="link-effect text-dual-primary-dark font-size-xs font-w600 text-uppercase" href="#"><?php echo explode(' ', $idAux)[0]; ?></a>
                    </li>
                    <li class="list-inline-item">
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="link-effect text-dual-primary-dark" data-toggle="layout" data-action="sidebar_style_inverse_toggle" href="javascript:void(0)">
                            <i class="si si-drop"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a class="link-effect text-dual-primary-dark" href="viewLogin.php">
                            <i class="si si-logout"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END Visible only in normal mode -->
        </div>
        <!-- END Side User -->

        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <?php $cb->build_nav(); ?>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>
<!-- END Sidebar -->

