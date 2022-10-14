<?php
include_once __DIR__ . '/../includes/functions/Validation.php';
include_once __DIR__. '/Database.php';

use Plugin\Functions\Validation;
use Plugin\DB\Database;

$validation = new Validation();
$db = new Database(__FILE__);

$field = ['id_utente' => '', 'nome_utente' => '', 'email_utente' => '', 'stanza' => '', 'giorno' => '', 'ora_arrivo' => '', 'ora_partenza' => '', 'tutto_il_giorno' => '', 'numero_posto' => ''];
$error = ['nome_utente' => '', 'email_utente' => '', 'stanza' => '', 'giorno' => '', 'ora_arrivo' => '', 'ora_partenza' => '', 'tutto_il_giorno' => '', 'numero_posto' => ''];


/* Query che restituisce tutte le stanze disponibili e selezionabili per la prenotazione */
$roomName = $wpdb->get_results("SELECT nome_stanza FROM " . $db::TABLE_BIBLIOTECA_STANZA . ";");

/* Query che restituisce tutti i posti disponibili e selezionabili per la prenotazione */
$seatNum = $wpdb->get_results("SELECT numero_posto FROM " . $db::TABLE_BIBLIOTECA_POSTO .
    " WHERE disponibile = 1;");


if (isset($_POST['submit'])) {
    $field['id_utente'] = $_POST['id_utente'];
    $field['nome_utente'] = $_POST['nome_utente'];
    $field['email_utente'] = $_POST['email_utente'];
    $field['stanza'] = $_POST['stanza'];
    $field['giorno'] = $_POST['giorno'];
    $field['ora_arrivo'] = $_POST['ora_arrivo'];
    $field['ora_partenza'] = $_POST['ora_partenza'];
    $field['tutto_il_giorno'] = $_POST['tutto_il_giorno'] ?? 'no';
    $field['numero_posto'] = $_POST['numero_posto'];

    print_r(array_filter($field));

    /* Check errors in input fields */
    if (empty($field['nome_utente']) || !$validation->isValidName($field['nome_utente'])) {
        $error['nome_utente'] = "<span class='error-field'>Campo nome errato.</span>";
    }

    if (empty($field['email_utente']) || !$validation->isValidEmail($field['email_utente'])) {
        $error['email_utente'] = "<span class='error-field'>Campo email errato.</span>";
    }else{
        if(!$validation->isAlreadyRegistered($db::TABLE_UTENTI,'user_email',$_POST['email_utente'])){
            $error['email_utente'] = "<span class='error-field'>Utente non registrato.</span>";
        }
    }

    if (empty($field['stanza'])) {
        $error['stanza'] = "<span class='error-field'>Campo nome stanza.</span>";
    }

    if (empty($field['giorno'])) {
        $error['giorno'] = "<span class='error-field'>Campo giorno errato.</span>";
    }

    if (empty($field['ora_arrivo'])) {
        $error['ora_arrivo'] = "<span class='error-field'>Campo ora arrivo errato.</span>";
    }

    if (empty($field['ora_partenza'])) {
        $error['ora_partenza'] = "<span class='error-field'>Campo ora partenza errato.</span>";
    }

    if (empty($field['tutto_il_giorno'])) {
        $error['tutto_il_giorno'] = "<span class='error-field'>Campo tutto il giorno errato.</span>";
    }

    if (empty($field['numero_posto']) || !filter_input(INPUT_POST,'numero_posto',FILTER_SANITIZE_NUMBER_INT)) {
        $error['numero_posto'] = "<span class='error-field'>Campo numero posto errato.</span>";
    }

    if(empty(array_filter($error))){
        $db->do_reservation($field);
        $db->updateAvailableSeats($field['numero_posto'],$field['stanza']);
        echo "<span class='success-field'>Prenotazione inserita correttamente</span>";
    }
}
