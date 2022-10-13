<?php

use Plugin\DB\Database;

include_once __DIR__ . '/../DB/Database.php';
$db = new Database(__FILE__);

$field = ['email' => '', 'password' => ''];
$error = ['email' => '', 'password' => ''];
$valid = true;

if (isset($_POST['submit-login'])) {
    $field['email'] = $_POST['user_email'];
    $field['password'] = $_POST['user_pass'];

    /* Query per trovare il valore della password corrispondente all'email
     * inserita dall'utente.
     */
    $findUserPwd = $wpdb->get_var("SELECT user_pass FROM " . $db::TABLE_UTENTI .
        " WHERE user_email = '" . $field['email'] . "';");

    /* Query per trovare il nome corrispondente all'email inserita dall'utente. */
    $checkUserName = $wpdb->get_var("SELECT user_login FROM " . $db::TABLE_UTENTI .
        " WHERE user_email = '" . $field['email'] . "';");

    /* Controllo che i campi non siano vuoti e che la password inserita
     * dall'utente corrisposnda a quella inserita da esso durante la registrazione.
     */
    if (empty($field['email'])) {
        $valid = false;
        $error['email'] = 'Compila campo email';
    }
    if (empty($field['password'])) {
        $valid = false;
        $error['password'] = 'Compila campo password';
    } else {
        $check = wp_check_password($field['password'], $findUserPwd);
        if (!$check) {
            $error['password'] = "Password errata";
        }
    }

    /* Se l'array degli errori è vuoto, significa che i dati
     * sono corretti, quindi posso navigare alla pagina per la
     * scelta del posto in aula studio.
     */
    if (empty(array_filter($error))) header('Location: scegli-posto');

}

include_once __DIR__ . '/./pages/login.html.php';

