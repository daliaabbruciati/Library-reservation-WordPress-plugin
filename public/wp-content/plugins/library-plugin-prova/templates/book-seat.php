<?php

// Logica

use Plugin\DB\Database;

include_once __DIR__ . '/../DB/Database.php';
$db = new Database(__FILE__);

$fields = ['stanza' => '', 'giorno' => '', 'ora_arrivo' => '', 'ora_partenza' => '', 'tutto_il_giorno' => '', 'id_posto' => ''];
$errors = ['stanza' => '', 'giorno' => '', 'ora_arrivo' => '', 'ora_partenza' => '', 'tutto_il_giorno' => '', 'id_posto' => ''];


/* Query che restituisce tutti i posti disponibili e selezionabili per la prenotazione */
$seatNum = $wpdb->get_results("SELECT numero_posto FROM ".$db::TABLE_BIBLIOTECA_POSTO.";");

/* Query che restituisce tutte le stanze disponibili e selezionabili per la prenotazione */
$roomName = $wpdb->get_results("SELECT nome_stanza FROM ".$db::TABLE_BIBLIOTECA_STANZA.";");



if(isset($_POST['submit_prenotazione'])){
    $fields['stanza'] = $_POST['stanza'];
    $fields['giorno'] = $_POST['giorno'];
    $fields['ora_arrivo'] = $_POST['ora_arrivo'];
    $fields['ora_partenza'] = $_POST['ora_partenza'];
    $fields['tutto_il_giorno'] = $_POST['tutto_il_giorno'] ?? 'no';
    $fields['id_posto'] = $_POST['id_posto'];


    /* Controllo campi vuoti */
    if(empty($fields['stanza'])){
        $errors['stanza'] = 'Stanza non selezionata';
    }
    if(empty($fields['giorno'])){
        $errors['giorno'] = 'Compila campo giorno';
    }
    if(empty($fields['ora_arrivo'])){
        $errors['ora_arrivo'] = 'Compila campo ora arrivo';
    }
    if(empty($fields['ora_partenza'])){
        $errors['ora_partenza'] = 'Compila campo ora partenza';
    }
    if(empty($fields['tutto_il_giorno'])){
        $errors['tutto_il_giorno'] = 'Compila campo';
    }
    if(empty($fields['id_posto'])){
        $errors['id_posto'] = 'Posto non selezionato';
    }


    print_r(array_filter($fields));
}


include_once __DIR__.'/./pages/book-seat.html.php';