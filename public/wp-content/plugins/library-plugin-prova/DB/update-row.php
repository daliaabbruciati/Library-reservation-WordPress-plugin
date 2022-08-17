<?php
if(isset($_POST['save']) && $row->id == $_POST['id']){
    $wpdb->update($db_table_name, [
        'nome_utente' => $row->nome_utente,
        'email_utente' => $row->email_utente,
        'giorno_prenotazione' => $row->giorno_prenotazione,
        'ora_arrivo' => $row->ora_arrivo,
        'ora_partenza' => $row->ora_partenza,
        'id_tavolo' => $row->id_tavolo,
        'id_posto' => $row->id_posto,
    ], [
        'id' => $row->id
    ]);
}
