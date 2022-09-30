<?php

namespace Plugin\DB;


class Database
{
    public const TABLE_BIBLIOTECA = 'wp_biblioteca';
    public const TABLE_BIBLIOTECA_STANZA = 'wp_biblioteca_stanza';
    public const TABLE_BIBLIOTECA_POSTO = 'wp_biblioteca_posto';
    public const TABLE_PRENOTAZIONE = 'wp_prenotazione';
    public const TABLE_UTENTI = 'wp_users';

    private $wpdb;
    public string $output;


    public function __construct($file)
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        add_action('init', [$this, 'start_connection']);
        register_activation_hook($file, [$this, "start_connection"]);
    }


    /* Try to start connection */
    public function start_connection(): string
    {
//        $connection = $this->wpdb->__construct("root","root","local","localhost");
        $connection = $this->wpdb->db_connect();
        if (!$connection) echo $this->wpdb->print_error();
        return $this->output = 'Connessione al database riuscita!';

//        try {
//            $myDb = new wpdb("mysql:host=localhost", "dbname=local", "root", "root");
////            $connection = new PDO("mysql:host=localhost;dbname=local", "root", "root");
////            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            $output = 'Connessione al database riuscita!';
//
//        } catch (PDOException $e) {
//            $output = "Connessione non riuscita: " . $e->getMessage();
//        }
    }


    public function create_table(): void
    {
        $charset_collate = $this->wpdb->get_charset_collate();

        require(ABSPATH . 'wp-admin/includes/upgrade.php');

        if ($this->wpdb->get_var("SHOW TABLES LIKE '" . self::TABLE_BIBLIOTECA . "'") != self::TABLE_BIBLIOTECA) {
            $table_biblioteca = "CREATE TABLE " . self::TABLE_BIBLIOTECA . " (
            id INT(10) AUTO_INCREMENT,
            nome VARCHAR(50) NOT NULL,
            stanze_tot INT(10) NOT NULL,
            PRIMARY KEY  (id)
        )" . $charset_collate . ";";

            dbDelta($table_biblioteca);
        }

        if ($this->wpdb->get_var("SHOW TABLES LIKE '" . self::TABLE_BIBLIOTECA_STANZA . "'") != self::TABLE_BIBLIOTECA_STANZA) {
            $table_biblioteca_stanza = "CREATE TABLE " . self::TABLE_BIBLIOTECA_STANZA . " (
            id INT(10) AUTO_INCREMENT,
            nome VARCHAR(50) NOT NULL,
            posti_totali INT(5) NOT NULL,
            posti_disponibili INT(5) NOT NULL,
            id_biblioteca INT(10),
            PRIMARY KEY  (id),
            FOREIGN KEY (id_biblioteca) REFERENCES " . self::TABLE_BIBLIOTECA . "(id)
        )" . $charset_collate . ";";

            dbDelta($table_biblioteca_stanza);
        }

        if ($this->wpdb->get_var("SHOW TABLES LIKE '" . self::TABLE_BIBLIOTECA_POSTO . "'") != self::TABLE_BIBLIOTECA_POSTO) {
            $table_biblioteca_posto = "CREATE TABLE " . self::TABLE_BIBLIOTECA_POSTO . " (
            id INT(10) AUTO_INCREMENT,
            numero_posto INT(5) NOT NULL,
            tipologia BOOLEAN,
            id_stanza INT(10),
            PRIMARY KEY  (id),
            FOREIGN KEY (id_stanza) REFERENCES " . self::TABLE_BIBLIOTECA_STANZA . "(id)
        )" . $charset_collate . ";";

            dbDelta($table_biblioteca_posto);
        }


        if ($this->wpdb->get_var("SHOW TABLES LIKE '" . self::TABLE_PRENOTAZIONE . "'") != self::TABLE_PRENOTAZIONE) {
            $table_prenotazione = "CREATE TABLE " . self::TABLE_PRENOTAZIONE . " (
            id INT(10) AUTO_INCREMENT,
            id_utente BIGINT(20) UNSIGNED,
            nome_utente VARCHAR(50),
            email_utente VARCHAR(100),
            stanza INT(10),
            giorno DATE NOT NULL,
            ora_arrivo TIME NOT NULL,
            ora_partenza TIME NOT NULL,
            tutto_il_giorno BOOLEAN,
            id_posto INT(10),
            qr_code BOOLEAN,
            PRIMARY KEY  (id),
            FOREIGN KEY (id_utente) REFERENCES " . self::TABLE_UTENTI . "(ID),
            FOREIGN KEY (nome_utente) REFERENCES " . self::TABLE_UTENTI . "(user_login),
            FOREIGN KEY (email_utente) REFERENCES " . self::TABLE_UTENTI . "(user_email),
            FOREIGN KEY (id_posto) REFERENCES " . self::TABLE_BIBLIOTECA_POSTO . "(id)
        )" . $charset_collate . ";";

            dbDelta($table_prenotazione);
        }

    }


    public function select_by_value($table, $column, $value)
    {
        return $this->wpdb->get_results("SELECT {$column} FROM {$table} WHERE {$column} = '{$value}'");
    }

    public function select_all($table)
    {
        return $this->wpdb->get_results("SELECT * FROM {$table}");
    }


}