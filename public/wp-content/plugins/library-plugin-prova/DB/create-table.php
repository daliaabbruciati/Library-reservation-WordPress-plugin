<?php

function DB_table() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $db_table_name = $wpdb->prefix . 'library_users';

    require(ABSPATH . 'wp-admin/includes/upgrade.php');

    $sql = "CREATE TABLE " . $db_table_name . " (
    	id INT(10) NOT NULL AUTO_INCREMENT,
    	id_utente INT(10) NOT NULL,
    	nome_utente VARCHAR(50) NOT NULL,
    	email_utente VARCHAR(70) NOT NULL,
    	giorno_prenotazione DATE NOT NULL,
    	ora_arrivo TIME NOT NULL,
    	ora_partenza TIME NOT NULL,
    	id_tavolo INT(10),
    	id_posto INT(10),
    	PRIMARY KEY  (id)
	)" . $charset_collate . ";";

    dbDelta( $sql );
}