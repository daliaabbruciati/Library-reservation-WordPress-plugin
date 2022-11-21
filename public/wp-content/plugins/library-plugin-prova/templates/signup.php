<?php

include_once __DIR__ . '/../includes/functions/Validation.php';
include_once __DIR__. '/../DB/Database.php';

use Plugin\DB\Database;
use Plugin\Functions\Validation;

$validation = new Validation();
$db = new Database(__FILE__);

$error = ['nome' => '', 'username' => '', 'email' => '', 'password' => ''];
$field = ['nome' => '', 'username' => '', 'email' => '', 'password' => ''];
$valid = true;


if (isset($_POST['registrati'])) {
    $field['nome'] = htmlspecialchars($_POST['user_login']);
    $field['username'] = htmlspecialchars($_POST['user_nicename']);
    $field['email'] = htmlspecialchars($_POST['user_email']);
    $field['password'] = htmlspecialchars($_POST['user_pass']);


    /* controllo errori sui campi */
    if (empty($field['nome'])) {
        $valid = false;
        $error['nome'] = 'Compila campo nome';
    } else {
        if (!$validation->isValidName($field['nome'])) {
            $valid = false;
            $error['nome'] = 'Formato nome errato';
        }
    }

    if (empty($field['username'])) {
        $valid = false;
        $error['username'] = 'Compila campo username';
    }

    if (empty($field['email'])) {
        $valid = false;
        $error['email'] = 'Compila campo email';
    } else {
        if (!$validation->isValidEmail($field['email'])) {
            $valid = false;
            $error['email'] = 'Email non valida';
        }
        if ($validation->isAlreadyRegistered('wp_users', 'user_email', $field['email'])) {
            $valid = false;
            $error['email'] = "Utente gia registrato.
                 <p>Torna indietro e accedi.</p>";
        }
    }

    if (empty($field['password'])) {
        $valid = false;
        $error['password'] = 'Compila campo password';
    } else {
        if (!$validation->isValidPassword($field['password'])) {
            $valid = false;
            $error['password'] = "Password non valida. Deve:
                    <p>- contenere almeno un numero;</p>
                    <p>- contenere almeno una lettera maiuscola;</p>
                    <p>- contenere almeno una lettera minuscola;</p>
                    <p>- contenere almeno un carattere speciale;</p>
                    <p>- lunghezza compresa tra 8-16 caratteri;</p>
                ";
        }
    }

    if (empty(array_filter($error))) {
        /* se tutti i campi sono validi */
        $wpdb->insert($db::TABLE_UTENTI, [
            'user_login' => $_POST['user_login'],
            'user_nicename' => $_POST['user_nicename'],
            'user_email' => $_POST['user_email'],
            'user_pass' => password_hash(($_POST['user_pass']), PASSWORD_DEFAULT),
            'user_registered' => current_datetime()->format('Y-m-d H:i:s')
        ]);
    }
}

include_once __DIR__ . '/./pages/signup.html.php';
