<?php
if(isset($_GET['save']) && $row['id'] == $_POST['id']){
    $wpdb->update($db_table_name, [
        'nome_utente' => $row['nome_utente'],
        'email_utente' => $row['email_utente'],
        'giorno_prenotazione' => $row['giorno_prenotazione'],
    ], [
        'id' => $row['id']
    ]);
}