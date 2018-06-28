<?php


@session_start(); 
/***contantes para mensajes en ventanas***/
define("ACTUALIZAR", "Actualizar Datos");
define("CERRAR_MODAL", "Cerrar");
define("BASE_URL", "https://192.168.1.253:8081/desarrollo/sistema_asociacion/");
define("EXITO","Excelente");
define("EXITO_MENSAJE","Datos almacenados");

/***array para el menu*/

$template = array(
    'name'              => 'Sistema Informático: Leviatan',
    'version'           => '1',
    'author'            => 'Estudio Agil',
    'robots'            => 'noindex, nofollow',
    'title'             => 'Asociación Azucarera de El Salvador',
    'description'       => 'Sistema Informatico para la Gestión de contenedores de la Asociación Azucarera de El Salvador',
    'page_preloader'    => false,

    // true                     enable main menu auto scrolling when opening a submenu

    // false                    disable main menu auto scrolling when opening a submenu

    'menu_scroll'       => true,

    // 'navbar-default'         for a light header

    // 'navbar-inverse'         for a dark header

    'header_navbar'     => 'navbar-default',

    // ''                       empty for a static layout

    // 'navbar-fixed-top'       for a top fixed header / fixed sidebars

    // 'navbar-fixed-bottom'    for a bottom fixed header / fixed sidebars

    'header'            => '',

    // ''                                               for a full main and alternative sidebar hidden by default (> 991px)

    // 'sidebar-visible-lg'                             for a full main sidebar visible by default (> 991px)

    // 'sidebar-partial'                                for a partial main sidebar which opens on mouse hover, hidden by default (> 991px)

    // 'sidebar-partial sidebar-visible-lg'             for a partial main sidebar which opens on mouse hover, visible by default (> 991px)

    // 'sidebar-mini sidebar-visible-lg-mini'           for a mini main sidebar with a flyout menu, enabled by default (> 991px + Best with static layout)

    // 'sidebar-mini sidebar-visible-lg'                for a mini main sidebar with a flyout menu, disabled by default (> 991px + Best with static layout)

    // 'sidebar-alt-visible-lg'                         for a full alternative sidebar visible by default (> 991px)

    // 'sidebar-alt-partial'                            for a partial alternative sidebar which opens on mouse hover, hidden by default (> 991px)

    // 'sidebar-alt-partial sidebar-alt-visible-lg'     for a partial alternative sidebar which opens on mouse hover, visible by default (> 991px)

    // 'sidebar-partial sidebar-alt-partial'            for both sidebars partial which open on mouse hover, hidden by default (> 991px)

    // 'sidebar-no-animations'                          add this as extra for disabling sidebar animations on large screens (> 991px) - Better performance with heavy pages!

    'sidebar'           => 'sidebar-partial sidebar-visible-lg sidebar-no-animations',

    // ''                       empty for a static footer

    // 'footer-fixed'           for a fixed footer

    'footer'            => '',

    // ''                       empty for default style

    // 'style-alt'              for an alternative main style (affects main page background as well as blocks style)

    'main_style'        => '',

    // ''                           Disable cookies (best for setting an active color theme from the next variable)

    // 'enable-cookies'             Enables cookies for remembering active color theme when changed from the sidebar links (the next color theme variable will be ignored)

    'cookies'           => '',

    // 'night', 'amethyst', 'modern', 'autumn', 'flatie', 'spring', 'fancy', 'fire', 'coral', 'lake',

    // 'forest', 'waterlily', 'emerald', 'blackberry' or '' leave empty for the Default Blue theme

    'theme'             => '',

    // ''                       for default content in header

    // 'horizontal-menu'        for a horizontal menu in header

    // This option is just used for feature demostration and you can remove it if you like. You can keep or alter header's content in page_head.php

    'header_content'    => '',

    'active_page'       => basename($_SERVER['PHP_SELF'])

);



/* Primary navigation array (the primary navigation will be created automatically based on this array, up to 3 levels deep) */



if($_SESSION['nivel']=='1'){

    $primary_nav = array(

        array(

            'name'  => 'Home',

            'url'   => '../home/index.php',

            'icon'  => 'gi gi-stopwatch'

        ),
        array(
            'name'  => 'Usuarios',
            'icon'  => 'gi gi-group',
            'sub'   => array(
                array(
                    'name'  => 'Nuevo Usuario',
                    'url'   => '../personas/principal_administrador.php'
                ),
                array(
                    'name'  => 'Administrar Usuario',
                    'url'   => '../personas/actualizar_personas.php'
                ),
                 
            )
        ),
        array(
            'name'  => 'Traders',
            'icon'  => 'gi gi-group',
            'sub'   => array(
                array(
                    'name'  => 'Nuevo Trader',
                    'url'   => '../traders/nuevo_trader.php?id='.date("Yidisus")
                ),
                array(
                    'name'  => 'Administrar Traders',
                    'url'   => '../traders/actualizar_trader.php'
                ),
                 
            )
        ),
        array(
            'name'  => 'Ingenios',
            'icon'  => 'gi gi-building',
            'sub'   => array(
                array(
                    'name'  => 'Nuevo Ingenio',
                    'url'   => '../ingenios/nuevo_ingenio.php?id='.date("Yidisus")
                ),
                array(
                    'name'  => 'Administrar Ingenios',
                    'url'   => '../ingenios/actualizar_ingenio.php?id='.date("Yidisus")
                ),
                 
            )
        ),
        array(
            'name'  => 'Asociación AAES',
            'icon'  => 'gi gi-bank',
            'sub'   => array(
                array(
                    'name'  => 'Registro Asociación',
                    'url'   => '../asociacion_aaes/registro_AAES.php?id='.date("Yidisus")
                ),
                array(
                    'name'  => 'Administrar Asociación',
                    'url'   => '../asociacion_aaes/administrar_AAES.php?id='.date("Yidisus")
                ),
                array(
                    'name'  => 'Agregar Empleados',
                    //'url'   => 'actualizar_trader.php'
                ),
                 
            )
        ),
        array(
            'name'  => 'Empresas',
            'icon'  => 'gi gi-bank',
            'sub'   => array(
                array(
                    'name'  => 'Registro Empresa',
                    'url'   => '../empresas/nueva_empresa.php?id='.date("Yidisus")
                ),
                array(
                    'name'  => 'Administrar Empresas',
                    'url'   => '../empresas/actualizar_empresa.php?id='.date("Yidisus")
                ),
                
                 
            )
        ),
        array(
            'name'  => 'Operadores Carga',
            'icon'  => 'gi gi-bank',
            'sub'   => array(
                array(
                    'name'  => 'Registro Operador',
                    'url'   => '../empresas/nuevo_operador_carga.php?id='.date("Yidisus")
                ),
                array(
                    'name'  => 'Administrar Operadores',
                    'url'   => '../empresas/actualizar_operadores_carga.php?id='.date("Yidisus")
                ),
                
                 
            )
        )

    );

}
