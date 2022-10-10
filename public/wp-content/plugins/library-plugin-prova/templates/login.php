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

    /* Query per trovare il valore della password corrispondente all'email
     * inserita dall'utente.
     */
    $findUserPwd = $wpdb->get_var("SELECT user_pass FROM " . $db::TABLE_UTENTI .
        " WHERE user_email = '" . $fields['email'] . "';");

    /* Query per trovare il nome corrispondente all'email inserita dall'utente. */
    $checkUserName = $wpdb->get_var("SELECT user_login FROM " . $db::TABLE_UTENTI .
        " WHERE user_email = '" . $fields['email'] . "';");

    /* Controllo che i campi non siano vuoti e che la password inserita
     * dall'utente corrisposnda a quella inserita da esso durante la registrazione.
     */
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

    /* Se l'array degli errori è vuoto, significa che i dati
     * sono corretti, quindi posso navigare alla pagina per la
     * scelta del posto in aula studio.
     */
    if (empty(array_filter($errors))) header('Location: scegli-posto');

}

include_once __DIR__ . '/./pages/login.html.php';

