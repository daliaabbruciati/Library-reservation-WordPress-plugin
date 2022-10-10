<?php

include_once __DIR__ . '/../includes/functions/Validation.php';
include_once __DIR__. '/../DB/Database.php';

use Plugin\DB\Database;
use Plugin\Functions\Validation;

$validation = new Validation();
$db = new Database(__FILE__);

$errors = ['nome' => '', 'username' => '', 'email' => '', 'password' => ''];
$fields = ['nome' => '', 'username' => '', 'email' => '', 'password' => ''];
$valid = true;


if (isset($_POST['registrati'])) {
    $fields['nome'] = $_POST['user_login'];
    $fields['username'] = $_POST['user_nicename'];
    $fields['email'] = $_POST['user_email'];
    $fields['password'] = $_POST['user_pass'];


    /* controllo errori sui campi */
    if (empty($fields['nome'])) {
        $valid = false;
        $errors['nome'] = 'Compila campo nome';
    } else {
        if (!$validation->isValidName($fields['nome'])) {
            $valid = false;
            $errors['nome'] = 'Formato nome errato';
        }
    }

    if (empty($fields['username'])) {
        $valid = false;
        $errors['username'] = 'Compila campo username';
    }

    if (empty($fields['email'])) {
        $valid = false;
        $errors['email'] = 'Compila campo email';
    } else {
        if (!$validation->isValidEmail($fields['email'])) {
            $valid = false;
            $errors['email'] = 'Email non valida';
        }
        if ($validation->isAlreadyRegistered('wp_users', 'user_email', $fields['email'])) {
            $valid = false;
            $errors['email'] = "Utente gia registrato.
                 <p>Torna indietro e accedi.</p>";
        }
    }

    if (empty($fields['password'])) {
        $valid = false;
        $errors['password'] = 'Compila campo password';
    } else {
        if (!$validation->isValidPassword($fields['password'])) {
            $valid = false;
            $errors['password'] = "Password non valida. Deve:
                    <p>- contenere almeno un numero;</p>
                    <p>- contenere almeno una lettera maiuscola;</p>
                    <p>- contenere almeno una lettera minuscola;</p>
                    <p>- contenere almeno un carattere speciale;</p>
                    <p>- lunghezza compresa tra 8-16 caratteri;</p>
                ";
        }
    }

    if (empty(array_filter($errors))) {
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
