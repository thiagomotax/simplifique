<?php

session_start();


if (isset($_SESSION['idDisciplina']))  {
unset($_SESSION['idDisciplina']);
}

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
        'url'   => 'viewAluno.php'
    ),
    
    
    
    
    
    
    
    
    
    
    array(
        'name'  => '<span class="sidebar-mini-visible">PRF</span>

        <span class="sidebar-mini-hidden">Aluno</span>',
        'type'  => 'heading'
    ),
    
    








    
    array(
        'name'  => '<span class="sidebar-mini-hide">Frequência</span>',
        'icon'  => 'fa fa-calendar-check-o',
        'sub'   => array(

            array(
                'name'  => 'Escolher disciplina',
                'url'   => 'viewFrequencia.php'
            )
        )
    ),
    
    







    array(
        'name'  => '<span class="sidebar-mini-hide">Matériais</span>',
        'icon'  => 'fa fa-files-o',
        'sub'   => array(

            array(
                'name'  => 'Escolher disciplina',
                'url'   => 'viewAnexo.php'
            ),

        )
    ),
    
    
    

    
    
    
    
    
    array(
        'name'  => '<span class="sidebar-mini-hide">Programação</span>',
        'icon'  => 'fa fa-list-alt"',
        'sub'   => array(
            array(
                'name'  => 'Escolher disciplina',
                'url'   => 'viewCronograma.php'
            )

        )
    )
);
