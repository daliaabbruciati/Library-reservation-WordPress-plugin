<?php

use Plugin\DB\Database;

include_once __DIR__ . '/../DB/Database.php';
$db = new Database(__FILE__);

$field = ['id_utente' => '', 'nome_utente' => '', 'email_utente' => '', 'nome_stanza' => '', 'giorno' => '', 'ora_arrivo' => '', 'ora_partenza' => '', 'tutto_il_giorno' => '', 'numero_posto' => ''];
$error = ['nome_stanza' => '', 'giorno' => '', 'ora_arrivo' => '', 'ora_partenza' => '', 'tutto_il_giorno' => '', 'numero_posto' => ''];


if (isset($_POST['submit_prenotazione'])) {
    $field['id_utente'] = $_POST['id_utente'];
    $field['nome_utente'] = $_POST['nome_utente'];
    $field['email_utente'] = $_POST['email_utente'];
    $field['nome_stanza'] = $_POST['nome_stanza'];
    $field['giorno'] = $_POST['giorno'];
    $field['ora_arrivo'] = $_POST['ora_arrivo'];
    $field['ora_partenza'] = $_POST['ora_partenza'];
    $field['tutto_il_giorno'] = $_POST['tutto_il_giorno'] ?? 'no';
    $field['numero_posto'] = $_POST['numero_posto'];


    /* Controllo campi vuoti */
    if (empty($field['nome_stanza'])) {
        $error['nome_stanza'] = 'Stanza non selezionata';
    }
    if (empty($field['giorno'])) {
        $error['giorno'] = 'Compila campo giorno';
    }
    if (empty($field['ora_arrivo'])) {
        $error['ora_arrivo'] = 'Compila campo ora arrivo';
    }
    if (empty($field['ora_partenza'])) {
        $error['ora_partenza'] = 'Compila campo ora partenza';
    }
    if (empty($field['tutto_il_giorno'])) {
        $error['tutto_il_giorno'] = 'Compila campo';
    }
    if (empty($field['numero_posto'])) {
        $error['numero_posto'] = 'Posto non selezionato';
    }


    if(empty(array_filter($error))){
        $db->do_reservation($field);
        $db->updateAvailableSeats($field['numero_posto'],$field['nome_stanza']);
    }
    print_r(array_filter($field));
}


include_once __DIR__ . '/./pages/book-seat.html.php';
