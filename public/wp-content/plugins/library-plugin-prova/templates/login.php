<?php

use Plugin\DB\Database;

include_once __DIR__ . '/../DB/Database.php';
$db = new Database(__FILE__);

$fields = ['email' => '', 'password' => ''];
$errors = ['email' => '', 'password' => ''];
$valid = true;

if (isset($_POST['submit-login'])) {
    $fields['email'] = $_POST['user_email'];
    $fields['password'] = $_POST['user_pass'];


    $findUserPwd = $wpdb->get_var("SELECT user_pass FROM " . $db::TABLE_UTENTI .
        " WHERE user_email = '" . $fields['email'] . "';");

    $checkUserName = $wpdb->get_var("SELECT user_login FROM " . $db::TABLE_UTENTI .
        " WHERE user_email = '" . $fields['email'] . "';");

    /* Controllo campi vuoti */
    if (empty($fields['email'])) {
        $valid = false;
        $errors['email'] = 'Compila campo email';
    }
    if (empty($fields['password'])) {
        $valid = false;
        $errors['password'] = 'Compila campo password';
    } else {
        $check = wp_check_password($fields['password'], $findUserPwd);
        if (!$check) {
            $errors['password'] = "Password errata";
        }
    }

    if (array_filter($errors)) {
        echo "\n ERRORE DATI";
    } else {
        header('Location: scegli-posto');
    }

}

include_once __DIR__ . '/./pages/login.html.php';

