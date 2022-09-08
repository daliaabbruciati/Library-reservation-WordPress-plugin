<?php
if (isset($_POST['submit']) && $row->id == $_POST['id']) {
    $wpdb->delete($db_table_prenotazione, [
        'id' => $row->id
    ]);
}
