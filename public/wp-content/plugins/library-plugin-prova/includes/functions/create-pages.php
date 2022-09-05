<?php

/* Creare e carica pagine in modo automatico all'attivazione del plugin */
function page_creator(): void
{
    $page_prenotazione = 'Prenotazione';
    $page_login = 'Login';
    $page_signup = 'Signup';
    $page_scegli_posto = 'Scegli posto';

    if (get_page_by_title($page_prenotazione) == NULL && get_page_by_title($page_login) == NULL && get_page_by_title($page_signup) == NULL && get_page_by_title($page_scegli_posto) == NULL) {

        $prenotazione = [
            'post_title' => $page_prenotazione,
            'post_content' => 'this is a test',
            'post_status' => 'publish',
            'post_type' => 'page'
        ];

        $login = [
            'post_title' => $page_login,
            'post_content' => 'this is a test',
            'post_status' => 'publish',
            'post_type' => 'page'
        ];

        $signup = [
            'post_title' => $page_signup,
            'post_content' => 'this is a test',
            'post_status' => 'publish',
            'post_type' => 'page'
        ];

        $scegli_posto = [
            'post_title' => $page_scegli_posto,
            'post_content' => 'this is a test',
            'post_status' => 'publish',
            'post_type' => 'page'
        ];

        wp_insert_post($prenotazione);
        wp_insert_post($login);
        wp_insert_post($signup);
        wp_insert_post($scegli_posto);
    }
}
