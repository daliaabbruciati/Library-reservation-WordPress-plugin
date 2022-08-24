<?php

function settings_menu(): void
{
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
        'Aggiungi utente',
        'Aggiungi utente',
        'manage_options',
        plugin_dir_path(__FILE__) . './views/add-new-user.html.php',
        null,
        90
    );

    add_submenu_page(
        plugin_dir_path(__FILE__) . './views/db-view.html.php',
        'Modifica utente',
        'Modifica utente',
        'manage_options',
        plugin_dir_path(__FILE__) . './views/edit-user.html.php',
        null,
        91
    );
}
add_action('admin_menu', 'settings_menu');
