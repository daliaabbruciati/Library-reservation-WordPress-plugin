<?php
include __DIR__ . '/../../DB/start-connection.php';

session_start();

function navigate($url){
    header('Location: ' .$url);
    exit;
}

function validateUser($email, $password){

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


