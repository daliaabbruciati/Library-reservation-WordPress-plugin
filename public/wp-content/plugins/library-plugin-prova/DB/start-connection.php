<?php
global $wpdb;

$db_table_biblioteca = $wpdb->prefix . 'biblioteca';
$db_table_biblioteca_stanza = $wpdb->prefix . 'biblioteca_stanza';
$db_table_biblioteca_posto = $wpdb->prefix . 'biblioteca_posto';
$db_table_prenotazione = $wpdb->prefix . 'prenotazione';
$db_table_utenti = $wpdb->prefix . 'users';

try {
    $connection = new PDO("mysql:host=localhost;dbname=local", "root", "root");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $output = 'Connessione al database riuscita!';

} catch (PDOException $e) {
    $output = "Connessione non riuscita: " . $e->getMessage();
}