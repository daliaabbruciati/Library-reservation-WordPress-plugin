<?php
require __DIR__ . '/../includes/functions/validation.php';

$errors = ['nome' => '', 'username' => '', 'email' => '', 'password' => ''];
$nome = $username = $email = $password = '';
$valid = true;

if (isset($_POST['registrati'])) {
    $nome = $_POST['user_login'];
    $username = $_POST['user_nicename'];
    $email = $_POST['user_email'];
    $password = $_POST['user_pass'];

    /* controllo errori sui campi */
    if (empty($nome)) {
        $valid = false;
        $errors['nome'] = 'Compila campo nome';
    } else {
        if (!isValidName($nome)) {
            $valid = false;
            $errors['nome'] = 'Formato nome errato';
        }
    }

    if (empty($username)) {
        $valid = false;
        $errors['username'] = 'Compila campo username';
    }

    if (empty($email)) {
        $valid = false;
        $errors['email'] = 'Compila campo email';
    } else {
        if (!isValidEmail($email)) {
            $valid = false;
            $errors['email'] = 'Email non valida';
        }
        if (isAlreadyRegistered($email)) {
            $valid = false;
            $errors['email'] = "Utente gia registrato.
                 <p>Torna indietro e accedi.</p>";
        }
    }

    if (empty($password)) {
        $valid = false;
        $errors['password'] = 'Compila campo password';
    } else {
        if (!isValidPassword($password)) {
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

    if (array_filter($errors)) {
        //ci sono errori
        echo "ERRORE: dati errati";
    } else {
        /* se tutti i campi sono validi */
        $wpdb->insert($db_table_utenti, [
            'user_login' => $_POST['user_login'],
            'user_nicename' => $_POST['user_nicename'],
            'user_email' => $_POST['user_email'],
            'user_pass' => password_hash(($_POST['user_pass']), PASSWORD_DEFAULT),
            'user_registered' => current_datetime()->format('Y-m-d H:i:s')
        ]);
    }

}


include_once __DIR__ . '/./pages/signup.html.php';
