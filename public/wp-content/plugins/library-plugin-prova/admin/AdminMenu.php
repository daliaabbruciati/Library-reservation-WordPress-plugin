<?php

namespace Plugin\Admin;

class AdminMenu
{

    function __construct()
    {
        add_action('admin_menu', [$this, 'settings_menu']);
    }


    function settings_menu(): void
    {
        add_menu_page(
            'Lista prenotazioni',
            'Lista prenotazioni',
            'manage_options',
            plugin_dir_path(__FILE__) . './views/booking-view.html.php',
            null,
            'dashicons-book',
            90
        );


        add_submenu_page(
            plugin_dir_path(__FILE__) . './views/booking-view.html.php',
            'Aggiungi prenotazione',
            'Aggiungi prenotazione',
            'manage_options',
            plugin_dir_path(__FILE__) . './views/add-new-res.html.php',
            null,
            90
        );

        add_submenu_page(
            plugin_dir_path(__FILE__) . './views/booking-view.html.php',
            'Modifica prenotazione',
            'Modifica prenotazione',
            'manage_options',
            plugin_dir_path(__FILE__) . './views/edit-res.html.php',
            null,
            91
        );
    }
}
