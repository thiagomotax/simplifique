

<?php
session_start();


 header("Content-Type: text/html; charset=ISO-8859-1",true);
ini_set('default_charset','UTF-8');


/**
 * backend/config.php
 *
 * Author: pixelcave
 *
 * Backend pages configuration file
 *
 */

// **************************************************************************************************
// INCLUDED VIEWS
// **************************************************************************************************

$cb->inc_side_overlay           = '../inc/backend/views/inc_side_overlay_logado.php';
$cb->inc_sidebar                = '../inc/backend/views/inc_sidebar_logado.php';
$cb->inc_header                 = '../inc/backend/views/inc_header_logado.php';
$cb->inc_footer                 = '../inc/backend/views/inc_footer.php';


// **************************************************************************************************
// MAIN MENU
// **************************************************************************************************

$cb->main_nav                   = array(


    array(
        'name'  => '<span class="sidebar-mini-hide">Home</span>',
        'icon'  => 'si si-cup',
        'url'   => 'viewProfessor.php'
    ),
    
    
    
    
    
    
    
    
    
    
    array(
        'name'  => '<span class="sidebar-mini-visible">PRF</span>

        <span class="sidebar-mini-hidden">Professor</span>',
        'type'  => 'heading'
    ),
    
    








    
    array(
        'name'  => '<span class="sidebar-mini-hide">Lançar frequência</span>',
        'icon'  => 'fa fa-check-square-o',
        'sub'   => array(

            array(
                'name'  => 'Gerar listagem',
                'url'   => 'viewGerarFrequencia.php'
            ),
            array(
                'name'  => 'Ver frequencias lançadas ',
                'url'   => 'viewListarFrequencia.php'
            )
        )
    ),
    
    







    array(
        'name'  => '<span class="sidebar-mini-hide">Anexar matériais</span>',
        'icon'  => 'fa fa-upload',
        'sub'   => array(

            array(
                'name'  => 'Visualizar seus Anexos',
                'url'   => 'viewListarAnexo.php'
            ),

            array(
                'name'  => 'Adicionar anexo',
                'url'   => 'viewAdicionarAnexo.php'
            )

        )
    ),
    
    
    

    
    
    
    
    
    array(
        'name'  => '<span class="sidebar-mini-hide">Cadastrar notícia</span>',
        'icon'  => 'fa fa-newspaper-o',
        'sub'   => array(
            array(
                'name'  => 'Visualizar suas noticias',
                'url'   => 'viewListarNoticias.php'
            ),

            array(
                'name'  => 'Adicionar notícia',
                'url'   => 'viewAdicionarNoticias.php'
            )

        )
    ),
    
    
    
    
    
    
    
    
    
    
    
    
    
    array(
        'name'  => '<span class="sidebar-mini-hide">Calendário Acadêmico</span>',
        'icon'  => 'fa  fa-calendar',
        'sub'   => array(
            array(
                'name'  => 'Cronograma',
                'url'   => 'viewGerarCronograma.php'
            )
        )
    )
);
