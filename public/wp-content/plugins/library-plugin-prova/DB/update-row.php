<?php

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