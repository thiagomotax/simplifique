<?php
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

$cb->inc_side_overlay           = 'inc/backend/views/inc_side_overlay.php';
$cb->inc_sidebar                = 'inc/backend/views/inc_sidebar.php';
$cb->inc_header                 = 'inc/backend/views/inc_header.php';
$cb->inc_footer                 = 'inc/backend/views/inc_footer.php';


// **************************************************************************************************
// MAIN MENU
// **************************************************************************************************

$cb->main_nav                   = array(
    array(
        'name'  => '<span class="sidebar-mini-hide">Home</span>',
        'icon'  => 'si si-cup',
        'url'   => 'index.php'
    ),
    array(
        'name'  => '<span class="sidebar-mini-visible">ADM</span><span class="sidebar-mini-hidden">Administrador</span>',
        'type'  => 'heading'
    ),
    array(
        'name'  => '<span class="sidebar-mini-hide">Aluno</span>',
        'icon'  => 'fa fa-address-card-o',
        'sub'   => array(
            array(
                'name'  => 'Listar alunos',
                'url'   => 'viewListarAlunos.php'
            ),
            array(
                'name'  => 'Adicionar aluno',
                'url'   => 'viewAdicionarAluno.php'
            )
        )
    ),
    array(
        'name'  => '<span class="sidebar-mini-hide">Professor</span>',
        'icon'  => 'fa fa-graduation-cap',
        'sub'   => array(
            array(
                'name'  => 'Listar professores',
                'url'   => '.php'
            ),
            array(
                'name'  => 'Adicionar professor',
                'url'   => '.php'
            )
        )
    ),
    array(
        'name'  => '<span class="sidebar-mini-hide">Curso</span>',
        'icon'  => 'fa fa-university',
        'sub'   => array(
            array(
                'name'  => 'Listar cursos',
                'url'   => '.php'
            ),
            array(
                'name'  => 'Adicionar curso',
                'url'   => '.php'
            )
        )
    ),
    array(
        'name'  => '<span class="sidebar-mini-hide">Disciplina</span>',
        'icon'  => 'fa fa-file-text-o',
        'sub'   => array(
            array(
                'name'  => 'Listar disciplinas',
                'url'   => '.php'
            ),
            array(
                'name'  => 'Adicionar disciplina',
                'url'   => '.php'
            )
        )
    )
);