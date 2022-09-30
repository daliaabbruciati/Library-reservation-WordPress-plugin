<?php
include_once __DIR__ . '/../includes/functions/Validation.php';

use Plugin\Functions\Validation;

$validation = new Validation();

$fields = ['nome' => '', 'email' => '', 'stanza' => '', 'giorno' => '', 'ora_arrivo' => '', 'ora_partenza' => '', 'tutto_il_giorno' => '', 'id_posto' => ''];
$errors = ['nomeErr' => '', 'emailErr' => '', 'stanzaErr' => '', 'giornoErr' => '', 'ora_arrivoErr' => '', 'ora_partenzaErr' => '', 'tutto_il_giornoErr' => '', 'id_postoErr' => ''];


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $fields['nome'] = $_POST['nome_utente'];
    $fields['email'] = $_POST['email_utente'];
    $fields['stanza'] = $_POST['stanza'];
    $fields['giorno'] = $_POST['giorno'];
    $fields['ora_arrivo'] = $_POST['ora_arrivo'];
    $fields['ora_partenza'] = $_POST['ora_partenza'];
    $fields['tutto_il_giorno'] = $_POST['tutto_il_giorno'];
    $fields['id_posto'] = $_POST['id_posto'];
}

print_r(array_filter($fields));


/* Check errors in input fields */
if (empty($fields['nome']) || !$validation->isValidName($fields['nome'])) {
    $errors['nomeErr'] = "<span class='error-field'>Campo nome errato.</span>";
}

if (empty($fields['email']) || !$validation->isValidEmail($fields['email'])) {
    $errors['emailErr'] = "<span class='error-field'>Campo email errato.</span>";
}

if (empty($fields['stanza'])) {
    $errors['stanzaErr'] = "<span class='error-field'>Campo nome stanza.</span>";
}

if (empty($fields['giorno'])) {
    $errors['giornoErr'] = "<span class='error-field'>Campo giorno errato.</span>";
}

if (empty($fields['ora_arrivo'])) {
    $errors['ora_arrivoErr'] = "<span class='error-field'>Campo ora arrivo errato.</span>";
}

if (empty($fields['ora_partenza'])) {
    $errors['ora_partenzaErr'] = "<span class='error-field'>Campo ora partenza errato.</span>";
}

if (empty($fields['tutto_il_giorno'])) {
    $errors['tutto_il_giornoErr'] = "<span class='error-field'>Campo tutto il giorno errato.</span>";
}

if (empty($fields['id_posto'])) {
    $errors['id_postoErr'] = "<span class='error-field'>Campo numero posto errato.</span>";
}

print_r(array_filter($errors));

if (array_filter($errors)) {
    return "<p class='error-field'>ERRORE inserimento: Compila tutti i campi</p>";
} else {
    $wpdb->insert($mydb::TABLE_PRENOTAZIONE, [
        'nome_utente' => $fields['nome'],
        'email_utente' => $fields['email'],
        'stanza' => $fields['stanza'],
        'giorno' => $fields['giorno'],
        'ora_arrivo' => $fields['ora_arrivo'],
        'ora_partenza' => $fields['ora_partenza'],
        'tutto_il_giorno' => $fields['tutto_il_giorno'],
        'id_posto' => $fields['id_posto']
    ]);
    return "Dati inseriti correttamente";

}

