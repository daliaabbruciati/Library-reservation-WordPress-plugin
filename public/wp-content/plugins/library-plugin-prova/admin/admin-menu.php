<?php

add_action('admin_menu', 'settings_menu');

function settings_menu()
{
//    string $page_title,
//    string $menu_title,
//    string $capability,
//    string $menu_slug,
//    callable $function = '',
//    string $icon_url = '',
//    int $position = null

    add_menu_page(
        'Panoramica',
        'Panoramica',
        'manage_options',
        plugin_dir_path(__FILE__) . './views/db-view.html.php',
        null,
        'dashicons-admin-generic',
        90
    );

    add_submenu_page(
        plugin_dir_path(__FILE__) . './views/db-view.html.php',
        'Aggiungi nuovo utente',
        'Aggiungi nuovo utente',
        'manage_options',
        plugin_dir_path(__FILE__) . './views/add-new-user.html.php',
        null,
        90
    );


}
