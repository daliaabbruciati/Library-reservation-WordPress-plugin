<?php

/* Creare e carica pagine in modo automatico all'attivazione del plugin */
function page_creator(): void
{
    $page_prenotazione = 'Prenotazione';
    $page_signup = 'Signup';
    $page_scegli_posto = 'Scegli posto';
    $page_booking_successful = 'Prenotazione confermata';

    if (get_page_by_title($page_prenotazione) == NULL && get_page_by_title($page_signup) == NULL && get_page_by_title($page_scegli_posto) == NULL && get_page_by_title($page_booking_successful) == NULL) {

        $prenotazione = [
            'post_title' => $page_prenotazione,
            'post_content' => '',
            'post_status' => 'publish',
            'post_type' => 'page'
        ];

        $signup = [
            'post_title' => $page_signup,
            'post_content' => '',
            'post_status' => 'publish',
            'post_type' => 'page'
        ];

        $scegli_posto = [
            'post_title' => $page_scegli_posto,
            'post_content' => '',
            'post_status' => 'publish',
            'post_type' => 'page'
        ];

        $booking_successful = [
            'post_title' => $page_booking_successful,
            'post_content' => '',
            'post_status' => 'publish',
            'post_type' => 'page'
        ];

        wp_insert_post($prenotazione);
        wp_insert_post($signup);
        wp_insert_post($scegli_posto);
        wp_insert_post($booking_successful);
    }
}

/* Aggiungo il mio custom menu alla 'Display location' dei menu*/
//function mytheme_register_nav_menu()
//{
//    register_nav_menus(array(
//        'library-primary-menu' => esc_html__('Header', 'library-plugin-prova'),
//    ));
//}
//
//add_action('after_setup_theme', 'mytheme_register_nav_menu', 0);

