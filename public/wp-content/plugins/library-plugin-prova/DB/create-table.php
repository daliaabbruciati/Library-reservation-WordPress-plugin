<?php

function DB_table(): void
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $db_table_biblioteca = $wpdb->prefix . 'biblioteca';
    $db_table_biblioteca_stanza = $wpdb->prefix . 'biblioteca_stanza';
    $db_table_biblioteca_posto = $wpdb->prefix . 'biblioteca_posto';
    $db_table_prenotazione = $wpdb->prefix . 'prenotazione';
    $db_table_utenti = $wpdb->prefix . 'users';

    require(ABSPATH . 'wp-admin/includes/upgrade.php');


    $table_biblioteca = "CREATE TABLE " . $db_table_biblioteca . " (
        id INT(10) PRIMARY KEY AUTO_INCREMENT,
    	nome VARCHAR(50) NOT NULL,
    	stanze_tot INT(10) NOT NULL
    )" . $charset_collate . ";";

    $table_biblioteca_stanza = "CREATE TABLE " . $db_table_biblioteca_stanza . " (
        id INT(10) PRIMARY KEY AUTO_INCREMENT,
        nome VARCHAR(50) NOT NULL,
        posti_totali INT(5) NOT NULL,
        posti_disponibili INT(5) NOT NULL,
        id_biblioteca INT(10),
        FOREIGN KEY (id_biblioteca) REFERENCES " . $db_table_biblioteca . "(id)
    )" . $charset_collate . ";";

    $table_biblioteca_posto = "CREATE TABLE " . $db_table_biblioteca_posto . " (
        id INT(10) PRIMARY KEY AUTO_INCREMENT,
        numero_posto INT(5) NOT NULL,
        tipologia BOOLEAN,
        id_stanza INT(10),
        FOREIGN KEY (id_stanza) REFERENCES " . $db_table_biblioteca_stanza . "(id)
    )" . $charset_collate . ";";

    $table_prenotazione = "CREATE TABLE " . $db_table_prenotazione . " (
    	id INT(10) PRIMARY KEY AUTO_INCREMENT,
    	giorno DATE NOT NULL,
    	tutto_il_giorno BOOLEAN,
    	ora_arrivo TIME NOT NULL,
    	ora_partenza TIME NOT NULL,
    	qr_code BOOLEAN,
    	email_utente VARCHAR(50),
    	id_posto INT(10),
    	FOREIGN KEY (email_utente) REFERENCES " . $db_table_utenti . "(user_email),
    	FOREIGN KEY (id_posto) REFERENCES " . $db_table_biblioteca_posto . "(id)
	)" . $charset_collate . ";";

    dbDelta( $table_biblioteca );
    dbDelta( $table_biblioteca_stanza );
    dbDelta( $table_biblioteca_posto );
    dbDelta( $table_prenotazione );
}