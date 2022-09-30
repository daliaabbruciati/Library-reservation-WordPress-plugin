<?php

namespace Plugin\Functions;

class Validation

{
    private $wpdb;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
    }


    public function navigateTo(string $url): void
    {
        /*Esempio: navigate('/prenotazione'), navigate('/scegli-posto'), ...;*/
        header('Location: ' . $url);
        exit;
    }

    public function isValidName($name): bool
    {
        /*
          * ^[a-z] = range of letter from a to z;
          * [^-_@.,()\d] = symbols and number not allowed;
          * .+\s = at least one space between name and last name;
          * + = one or more repetition of a character;
          * $ = end of the string;
          * /i = case sensitive.
          */
        $pattern = "/^[a-z'].+\s[a-z']+$/i";
        return preg_match($pattern, $name);
    }

    public function isValidEmail($email): bool
    {
        $pattern = "/^((?!\.)[\w_\-.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/m";
        return preg_match($pattern, $email);
    }

    public function isValidPassword($password): bool
    {
        /*
         * password must contain:
         * - at least one number [\d](0-9)
         * - at least one uppercase letters [A-Z]
         * - at least one lowercase letter [a-z]
         * - at least a special character (non-word characters) [\w]
         * - between 8-16 characters with no space
         * */

        $pattern = '/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,16}$/m';

        return preg_match($pattern, $password);
    }

    public function isAlreadyRegistered(string $table, string $column, $email): bool
    {
        $result = $this->wpdb->get_results("SELECT {$column} FROM {$table} WHERE {$column} = '{$email}'");
        return !empty($result);
    }

//    function validateUser($email, $password): void
//    {
//
////$email = $_SESSION['user_email'];
////$password = $_SESSION['user_pass'];
//        $result = $this->wpdb->get_results("SELECT user_email, user_pass FROM " . $db_table_utenti .
//            " WHERE user_email = " . $email . " and user_pass = md5(" . $password . ");");
//
//        if (!$result) {
//            echo "Cannot execute query";
//            exit;
//        }
//
//        $num_rows = $this->wpdb->num_rows;
//        if ($num_rows == 1) {
//            $_SESSION['login'] = 'OK';
//            $_SESSION['user_email'] = $email;
//            $_SESSION['user_pass'] = $password;
//            $redirect = "book-seat.php";
//        } else {
//            $redirect = "signup.php";
//        }
//        $this->wpdb->close();
//        navigateTo($redirect);
//    }
//

}