<?php

session_start();

include __DIR__ . '/../../DB/start-connection.php';


function navigate(string $url): void
{
    header('Location: ' . $url);
    exit;
}


function isValidName($name): bool
{
    /*
     * ^[a-z] = range of letter from a to z;
     * [^-_@.,()\d] = symbols and number not allowed;
     * + = one or more repetition of a character;
     * $ = end of the string;
     * /i = case sensitive.
     */
    $pattern = "/^[a-z '][^-_@.,()\d]+$/i";

    if (!preg_match($pattern, $name))
        return false;
    return true;
}


function isValidEmail($email): bool
{
     $pattern = "/^((?!\.)[\w_\-.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/m";    //"/m = multiline"
    if(!preg_match($pattern,$email)){
        return false;
    }
    return  true;
}

function isValidPassword($password): bool
{
    /*
    Regular Expression: $\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$
    $ = beginning of string;
    \S* = any set of characters;
    (?=\S{8,}) = of at least length 8;
    (?=\S*[a-z]) = containing at least one lowercase letter;
    (?=\S*[A-Z]) = and at least one uppercase letter;
    (?=\S*[\d]) = and at least one number;
    (?=\S*[\W]) = and at least a special character (non-word characters);
    $ = end of the string.
 */

    /*
     * password must contain 1 number (0-9)
     * password must contain 1 uppercase letters
     * password must contain 1 lowercase letters
     * password must contain 1 non-alpha numeric number
     * password is 8-16 characters with no space
     * */

    $pattern = '/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,16}$/m';

    if (!preg_match($pattern, $password))
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

function checkUserRegistration($table,$column,$value){
//    global $wpdb;
    $result = $wpdb->get_results(
        $wpdb->prepare("SELECT ".$column." FROM " .$table. " WHERE ".$column." = %s", $value));

    return $result;
}

