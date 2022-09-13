<?php

use JetBrains\PhpStorm\NoReturn;

include __DIR__ . '/../../DB/start-connection.php';

session_start();

function navigate($url)
{
    header('Location: ' . $url);
    exit;
}


function isValidName($name): bool
{
    /*
     * [A-Z] = Uppercase letter
     * \S* = any set of characters
     * \s = whitespace
     */
    $pattern = "/([a-zA-Z]\S*)\s([a-zA-Z]\S*)/";
//    $pattern = '/(?<=\s|^)[a-z]/';
    $replacement = '/^[A-Z]/';
    $subject = $name;
    if (!preg_replace($pattern, $replacement, $subject))
        return false;
    return true;
}


function isValidEmail($email): bool
{
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        return false;
    return true;
}

function isValidPassword($password): bool
{
    /*
    Regular Expression: $\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$
    $ = beginning of string
    \S* = any set of characters
    (?=\S{8,}) = of at least length 8
    (?=\S*[a-z]) = containing at least one lowercase letter
    (?=\S*[A-Z]) = and at least one uppercase letter
    (?=\S*[\d]) = and at least one number
    (?=\S*[\W]) = and at least a special character (non-word characters)
    $ = end of the string
 */
    if (!preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $password))
        return false;
    return true;
}


function validateUser($email, $password): void
{

//$email = $_SESSION['user_email'];
//$password = $_SESSION['user_pass'];
    $result = $wpdb->get_results("SELECT user_email, user_pass FROM " . $db_table_utenti .
        " WHERE user_email = " . $email . " and user_pass = md5(" . $password . ");");

    if (!$result) {
        echo "Cannot execute query";
        exit;
    }

    $num_rows = $wpdb->num_rows;
    if ($num_rows == 1) {
        $_SESSION['login'] = 'OK';
        $_SESSION['user_email'] = $email;
        $_SESSION['user_pass'] = $password;
        $redirect = "book-seat.php";
    } else {
        $redirect = "signup.php";
    }
    $wpdb->close();
    navigate($redirect);

}


