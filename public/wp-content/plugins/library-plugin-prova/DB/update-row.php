<?php

$fields = ['nome_biblio' => '', 'nome_stanza' => '', 'posti_tot' => '', 'posti_disponibili' => ''];
//$errors = ['nomeErr' => '', 'emailErr' => '', 'stanzaErr' => '', 'giornoErr' => '', 'ora_arrivoErr' => '', 'ora_partenzaErr' => '', 'tutto_il_giornoErr' => '', 'id_postoErr' => ''];

if (isset($_POST['edit']) && $row->id === $_POST['id']) {
    $newNome = $_POST['nome_utente'];
    $newEmail = $_POST['email_utente'];
    $newStanza = $_POST['stanza'];
    $newGiorno = $_POST['giorno'];
    $newOra_arrivo = $_POST['ora_arrivo'];
    $newOra_partenza = $_POST['ora_partenza'];
    $newTuttoIlGiorno = $_POST['tutto_il_giorno'];
    $newId_posto = $_POST['id_posto'];

    $wpdb->update($mydb::TABLE_PRENOTAZIONE, [
        'nome_utente' => $newNome,
        'email_utente' => $newEmail,
        'stanza' => $newStanza,
        'giorno' => $newGiorno,
        'ora_arrivo' => $newOra_arrivo,
        'ora_partenza' => $newOra_partenza,
        'tutto_il_giorno' => $newTuttoIlGiorno,
        'id_posto' => $newId_posto,
    ], [
        'id' => $row->id
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