<?php

$field = ['nome_utente' => '', 'email_utente' => '', 'nome_stanza' => '', 'giorno' => '', 'ora_arrivo' => '', 'ora_partenza' => '', 'tutto_il_giorno' => '', 'numero_posto' => ''];
$error = ['nome_utente' => '','email_utente' => '', 'nome_stanza' => '', 'giorno' => '', 'ora_arrivo' => '', 'ora_partenza' => '', 'tutto_il_giorno' => '', 'numero_posto' => ''];

if (isset($_POST['update']) &&
    $row->id_prenotazione == $_POST['id_prenotazione'] &&
    $row->numero_posto !== $_POST['numero_posto']) {
    $field['nome_utente'] = $_POST['nome_utente'];
    $field['email_utente'] = $_POST['email_utente'];
    $field['nome_stanza'] = $_POST['nome_stanza'];
    $field['giorno'] = $_POST['giorno'];
    $field['ora_arrivo'] = $_POST['ora_arrivo'];
    $field['ora_partenza'] = $_POST['ora_partenza'];
    $field['tutto_il_giorno'] = $_POST['tutto_il_giorno'] ?? 0;
    $field['numero_posto'] = $_POST['numero_posto'];


    $wpdb->update($db::TABLE_UTENTI, [
        'user_login' => $field['nome_utente'],
        'user_email' => $field['email_utente'],
    ], [
        'ID' => $row->id_utente
    ]);
    $wpdb->update($db::TABLE_PRENOTAZIONE, [
        'nome_utente' => $field['nome_utente'],
        'email_utente' => $field['email_utente'],
        'nome_stanza' => $field['nome_stanza'],
        'giorno' => $field['giorno'],
        'ora_arrivo' => $field['ora_arrivo'],
        'ora_partenza' => $field['ora_partenza'],
        'tutto_il_giorno' => $field['tutto_il_giorno'] ?? 0,
        'numero_posto' => $field['numero_posto'],
    ], [
        'id_prenotazione' => $row->id_prenotazione
    ]);

    $db->updateReservedSeat($row->numero_posto);
    $db->updateSeatsInRoom($field['nome_stanza']);
    echo '<h3>Utente modificato correttamente. Torna alla pagina <a href="http://localhost:10003/wp-admin/admin.php?page=library-plugin-prova%2Fadmin%2F.%2Fviews%2Fbooking-view.html.php">Panoramica</a></h3>';
}