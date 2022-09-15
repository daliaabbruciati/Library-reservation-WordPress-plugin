<?php
require __DIR__ . '/../includes/functions/validation.php';

$nomeErr = $usernameErr = $emailErr = $passErr = '';
$nome = $username = $email = $password = '';
$valid = true;

if (isset($_POST['registrati'])) {

    $nome = $_POST['user_login'];
    $username = $_POST['user_nicename'];
    $email = $_POST['user_email'];
    $password = $_POST['user_pass'];

    if (empty($nome) || empty($username) || empty($email) || empty($password)) {

        if (empty($nome)) {
            $valid = false;
            $nomeErr = 'Compila campo nome';
        } else {
            if (!isValidName($nome)) {
                $valid = false;
                $nomeErr = 'Formato nome errato';
            }
        }

        if (empty($username)) {
            $valid = false;
            $usernameErr = 'Compila campo username';
        }

        if (empty($email)) {
            $valid = false;
            $emailErr = 'Compila campo email';
        } else {
            if (!isValidEmail($email)) {
                $valid = false;
                $emailErr = 'Email non valida';
            }
        }

        if (empty($password)) {
            $valid = false;
            $passErr = 'Compila campo password';
        } else {
            if (!isValidPassword($password)) {
                $valid = false;
                $passErr = "Password non valida. Deve:
                    <p>- contenere almeno un numero;</p>
                    <p>- contenere almeno una lettera maiuscola;</p>
                    <p>- contenere almeno una lettera minuscola;</p>
                    <p>- contenere almeno un carattere speciale;</p>
                    <p>- lunghezza compresa tra 8-16 caratteri;</p>
                ";
            }
        }
        echo '<script> alert("ERRORE: dati errati") </script>';

    } else {
        $wpdb->insert($db_table_utenti, [
            'user_login' => $_POST['user_login'],
            'user_nicename' => $_POST['user_nicename'],
            'user_email' => $_POST['user_email'],
            'user_pass' => password_hash(($_POST['user_pass']), PASSWORD_DEFAULT),
            'user_registered' => current_datetime()->format('Y-m-d H:i:s')
        ]);
        echo '<script> alert("Dati inseriti correttamente") </script>';
    }
}


include_once __DIR__ . '/./pages/signup.html.php';
