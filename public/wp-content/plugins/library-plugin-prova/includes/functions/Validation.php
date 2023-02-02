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

}
