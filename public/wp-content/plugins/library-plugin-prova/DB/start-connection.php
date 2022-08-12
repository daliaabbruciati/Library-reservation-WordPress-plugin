<?php
global $wpdb;
$db_table_name = $wpdb->prefix . 'library_users';
try {
    $connection = new PDO("mysql:host=localhost;dbname=local", "root", "root");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $output = 'Connessione al database riuscita!';

} catch (PDOException $e) {
    $output = "Connessione non riuscita: " . $e->getMessage();
}