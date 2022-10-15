<?php

//$field = ['id_utente' => '', 'nome_utente' => '', 'email_utente' => '', 'stanza' => '', 'giorno' => '', 'ora_arrivo' => '', 'ora_partenza' => '', 'tutto_il_giorno' => '', 'numero_posto' => ''];
$error = ['nome_utente' => '','email_utente' => '', 'stanza' => '', 'giorno' => '', 'ora_arrivo' => '', 'ora_partenza' => '', 'tutto_il_giorno' => '', 'numero_posto' => ''];

if (isset($_POST['update']) && $row->id_prenotazione === $_POST['id_prenotazione']) {
    $newIdUtente = $_POST['id_utente'];
    $newNome = $_POST['nome_utente'];
    $newEmail = $_POST['email_utente'];
    $newStanza = $_POST['stanza'];
    $newGiorno = $_POST['giorno'];
    $newOra_arrivo = $_POST['ora_arrivo'];
    $newOra_partenza = $_POST['ora_partenza'];
    $newTuttoIlGiorno = $_POST['tutto_il_giorno'];
    $newNumero_posto = $_POST['numero_posto'];


    $wpdb->update($db::TABLE_UTENTI, [
        'user_login' => $newNome,
        'user_email' => $newEmail,
    ], [
        'ID' => $row->id_utente
    ]);
    $wpdb->update($db::TABLE_PRENOTAZIONE, [
        'id_utente' => $newIdUtente,
        'nome_utente' => $newNome,
        'email_utente' => $newEmail,
        'stanza' => $newStanza,
        'giorno' => $newGiorno,
        'ora_arrivo' => $newOra_arrivo,
        'ora_partenza' => $newOra_partenza,
        'tutto_il_giorno' => $newTuttoIlGiorno,
        'numero_posto' => $newNumero_posto,
    ], [
        'id_prenotazione' => $row->id_prenotazione
    ]);

    $db->updateReservedSeat();
    $db->updateSeatsInRoom($newStanza);
//    $db->updateAvailableSeats($newNumero_posto,$newStanza);
    echo '<h3>Utente modificato correttamente. Torna alla pagina <a href="http://localhost:10003/wp-admin/admin.php?page=library-plugin-prova%2Fadmin%2F.%2Fviews%2Fbooking-view.html.php">Panoramica</a></h3>';
}

//include __DIR__.'/../admin/views/edit-res.html.php';