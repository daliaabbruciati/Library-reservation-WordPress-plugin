<?php
if (isset($_POST['edit']) && $row->id === $_POST['id']) {
    $newNome = $_POST['nome_utente'];
    $newEmail = $_POST['email_utente'];
    $newGiorno = $_POST['giorno_prenotazione'];
    $newOra_arrivo = $_POST['ora_arrivo'];
    $newOra_partenza = $_POST['ora_partenza'];
    $newId_tavolo = $_POST['id_tavolo'];
    $newId_posto = $_POST['id_posto'];

    $row->nome_utente = $newNome;

    $wpdb->update($db_table_name, [
        'nome_utente' => $newNome,
        'email_utente' => $newEmail,
        'giorno_prenotazione' => $newGiorno,
        'ora_arrivo' => $newOra_arrivo,
        'ora_partenza' => $newOra_partenza,
        'id_tavolo' => $newId_tavolo,
        'id_posto' => $newId_posto,
    ], [
        'id' => $row->id
    ]);
    echo '<h3>Utente modificato correttamente. Torna alla pagina <a href="admin.php?page=library-plugin-prova%2Fadmin%2F.%2Fviews%2Fdb-view.html.php">Panoramica</a></h3>';
}