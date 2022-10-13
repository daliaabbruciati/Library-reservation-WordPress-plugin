<?php

$field = ['id_utente' => '', 'nome_utente' => '', 'email_utente' => '', 'stanza' => '', 'giorno' => '', 'ora_arrivo' => '', 'ora_partenza' => '', 'tutto_il_giorno' => '', 'numero_posto' => ''];
$error = ['stanza' => '', 'giorno' => '', 'ora_arrivo' => '', 'ora_partenza' => '', 'tutto_il_giorno' => '', 'numero_posto' => ''];

if (isset($_POST['edit']) && $row->id_prenotazione === $_POST['id_prenotazione']) {
    $newNome = $_POST['nome_utente'];
    $newEmail = $_POST['email_utente'];
    $newStanza = $_POST['stanza'];
    $newGiorno = $_POST['giorno'];
    $newOra_arrivo = $_POST['ora_arrivo'];
    $newOra_partenza = $_POST['ora_partenza'];
    $newTuttoIlGiorno = $_POST['tutto_il_giorno'];
    $newNumero_posto = $_POST['numero_posto'];
//    $field['id_utente'] = $_POST['id_utente'];
//    $field['nome_utente'] = $_POST['nome_utente'];
//    $field['email_utente'] = $_POST['email_utente'];
//    $field['stanza'] = $_POST['stanza'];
//    $field['giorno'] = $_POST['giorno'];
//    $field['ora_arrivo'] = $_POST['ora_arrivo'];
//    $field['ora_partenza'] = $_POST['ora_partenza'];
//    $field['tutto_il_giorno'] = $_POST['tutto_il_giorno'] ?? 'no';
//    $field['numero_posto'] = $_POST['numero_posto'];

    $wpdb->update($mydb::TABLE_PRENOTAZIONE, [
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
    echo '<h3>Utente modificato correttamente. Torna alla pagina <a href="admin.php?page=library-plugin-prova%2Fadmin%2F.%2Fviews%2Fdb-view.html.php">Panoramica</a></h3>';
}


/* Da booking-view.html.php */

//if(isset($_POST['submit-edit'])){
//    $fields['nome_biblio'] = $_POST['nome_biblio'];
//    $fields['nome_stanza'] = $_POST['nome_stanza'];
//    $fields['posti_tot'] = $_POST['posti_totali'];
//    $fields['posti_disponibili'] = $_POST['posti_disponibili'];
//
//    $wpdb->insert($mydb::TABLE_BIBLIOTECA,[
//        'nome' => $fields['nome_biblio']
//    ]);
//    $id_biblio = $wpdb->get_var("SELECT MAX(id) FROM ".$mydb::TABLE_BIBLIOTECA." ");
//
//    $wpdb->insert($mydb::TABLE_BIBLIOTECA_STANZA,[
//        'nome' => $fields['nome_stanza'],
//        'posti_totali' => $fields['posti_tot'],
//        'posti_disponibili' => $fields['posti_tot'],
//        'id_biblioteca' => $id_biblio
//    ]);
//
//    $wpdb->show_errors();
//}