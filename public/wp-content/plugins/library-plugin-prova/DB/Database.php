<?php

namespace Plugin\DB;

class Database {
	public const TABLE_BIBLIOTECA = 'wp_biblioteca';
	public const TABLE_BIBLIOTECA_STANZA = 'wp_biblioteca_stanza';
	public const TABLE_BIBLIOTECA_POSTO = 'wp_biblioteca_posto';
	public const TABLE_PRENOTAZIONE = 'wp_prenotazione';
	public const TABLE_UTENTI = 'wp_users';
	public $wpdb;
	public string $output;

	public function __construct( $file ) {
		global $wpdb;
		$this->wpdb = $wpdb;
		add_action( 'init', [ $this, 'start_connection' ] );
		register_activation_hook( $file, [ $this, "start_connection" ] );
	}

	/* Try to start connection */
	public function start_connection(): string {
		$connection = $this->wpdb->db_connect();
		if ( ! $connection ) {
			echo $this->wpdb->print_error();
		}

		return $this->output = 'Connessione al database riuscita!';
	}


	public function create_table(): void {
		$charset_collate = $this->wpdb->get_charset_collate();

		require( ABSPATH . 'wp-admin/includes/upgrade.php' );

		if ( $this->wpdb->get_var( "SHOW TABLES LIKE '" . self::TABLE_BIBLIOTECA . "'" ) != self::TABLE_BIBLIOTECA ) {
			$table_biblioteca = "CREATE TABLE " . self::TABLE_BIBLIOTECA . " (
            id_biblioteca INT(10) AUTO_INCREMENT,
            nome_biblioteca VARCHAR(50) NOT NULL,
            PRIMARY KEY  (id_biblioteca)
        )" . $charset_collate . ";";

			dbDelta( $table_biblioteca );

			$this->wpdb->insert( self::TABLE_BIBLIOTECA, [
				'id_biblioteca'   => 1,
				'nome_biblioteca' => 'Biblioteca Senigallia'
			] );
		}

		if ( $this->wpdb->get_var( "SHOW TABLES LIKE '" . self::TABLE_BIBLIOTECA_STANZA . "'" ) != self::TABLE_BIBLIOTECA_STANZA ) {
			$table_biblioteca_stanza = "CREATE TABLE " . self::TABLE_BIBLIOTECA_STANZA . " (
            id_stanza INT(10) AUTO_INCREMENT,
            nome_stanza VARCHAR(100) NOT NULL,
            posti_totali INT(5) NOT NULL,
            posti_disponibili INT(5) NOT NULL,
            id_biblioteca INT(10),
            PRIMARY KEY  (id_stanza),
            UNIQUE  (nome_stanza),
            FOREIGN KEY (id_biblioteca) REFERENCES " . self::TABLE_BIBLIOTECA . "(id_biblioteca)
        )" . $charset_collate . ";";

			dbDelta( $table_biblioteca_stanza );

			$this->wpdb->insert( self::TABLE_BIBLIOTECA_STANZA, [
				'id_stanza'         => 1,
				'nome_stanza'       => 'Stanza 1',
				'posti_totali'      => 108,
				'posti_disponibili' => 108,
				'id_biblioteca'     => 1
			] );
		}

		if ( $this->wpdb->get_var( "SHOW TABLES LIKE '" . self::TABLE_BIBLIOTECA_POSTO . "'" ) != self::TABLE_BIBLIOTECA_POSTO ) {
			$table_biblioteca_posto = "CREATE TABLE " . self::TABLE_BIBLIOTECA_POSTO . " (
            id_posto INT(10) AUTO_INCREMENT,
            numero_posto INT(5) NOT NULL,
            id_stanza INT(10),
            PRIMARY KEY  (id_posto),
            FOREIGN KEY (id_stanza) REFERENCES " . self::TABLE_BIBLIOTECA_STANZA . "(id_stanza)
        )" . $charset_collate . ";";

			dbDelta( $table_biblioteca_posto );
		}


		if ( $this->wpdb->get_var( "SHOW TABLES LIKE '" . self::TABLE_PRENOTAZIONE . "'" ) != self::TABLE_PRENOTAZIONE ) {
			$table_prenotazione = "CREATE TABLE " . self::TABLE_PRENOTAZIONE . " (
            id_prenotazione INT(10) AUTO_INCREMENT,
            id_utente BIGINT(20) UNSIGNED,
            nome_utente VARCHAR(50),
            email_utente VARCHAR(100),
            nome_stanza VARCHAR(100) NOT NULL,
            giorno DATE NOT NULL,
            ora_arrivo TIME NOT NULL,
            ora_partenza TIME NOT NULL,
            tutto_il_giorno VARCHAR(10),
            numero_posto INT(10),
            qr_code BOOLEAN,
            PRIMARY KEY  (id_prenotazione),
            FOREIGN KEY (id_utente) REFERENCES " . self::TABLE_UTENTI . "(ID),
            FOREIGN KEY (nome_utente) REFERENCES " . self::TABLE_UTENTI . "(user_login),
            FOREIGN KEY (email_utente) REFERENCES " . self::TABLE_UTENTI . "(user_email),
            FOREIGN KEY (nome_stanza) REFERENCES " . self::TABLE_BIBLIOTECA_STANZA . "(nome_stanza),
            FOREIGN KEY (numero_posto) REFERENCES " . self::TABLE_BIBLIOTECA_POSTO . "(id_posto)
        )" . $charset_collate . ";";

			dbDelta( $table_prenotazione );
		}
	}

	public function getHours(): array {
		return $hours = [
			'09:00:00',
			' 09:30:00',
			'10:00:00',
			'10:30:00',
			'11:00:00',
			'11:30:00',
			'12:00:00',
			'12:30:00',
			'13:00:00',
			'13:30:00',
			'15:30:00',
			'16:00:00',
			'16:30:00',
			'17:00:00',
			'17:30:00',
			'18:00:00',
			'18:30:00'
		];
	}

	/* Query che restituisce tutte le stanze disponibili e selezionabili per la prenotazione */
	public function getRoomName() {
		return $this->wpdb->get_results( "SELECT nome_stanza FROM " . self::TABLE_BIBLIOTECA_STANZA . ";" );
	}

	/* Query che restituisce tutti i posti disponibili e selezionabili per la prenotazione */
	public function getAvailableSeats( $giorno, $ora_arrivo, $ora_partenza ) {
		date_default_timezone_set( "Europe/Rome" );
		$currentDate = date( 'Y-m-d' );
		return $this->wpdb->get_results( "SELECT numero_posto FROM wp_biblioteca_posto WHERE id_stanza = 1 AND numero_posto NOT IN (SELECT numero_posto FROM wp_prenotazione WHERE giorno = '$giorno' AND nome_stanza = 'Stanza 1' AND ((ora_arrivo BETWEEN '$ora_arrivo' AND '$ora_partenza') OR (ora_partenza BETWEEN '$ora_arrivo' AND '$ora_partenza') OR (giorno = '$currentDate' AND ora_arrivo <= '$ora_arrivo' AND ora_partenza >= '$ora_partenza') OR (giorno < '$currentDate' AND ora_arrivo <= '$ora_arrivo' AND ora_partenza >= '$ora_partenza')))");
	}

	/* Restituisce il numero totale di posti ancora disponibili */
	public function getNumOfAvailableSeats($field_stanza): int {
		date_default_timezone_set( "Europe/Rome" );
		$currentDate = date( 'Y-m-d' );
		$currentTime = date( "H:i:s" );

		return $this->wpdb->get_var("SELECT COUNT(*) FROM wp_biblioteca_posto WHERE numero_posto NOT IN (SELECT numero_posto FROM wp_prenotazione WHERE  nome_stanza = '$field_stanza' AND giorno = '$currentDate' AND ora_partenza >= '$currentTime')");
	}

	/* Aggiorno il numero totale di posti disponibili nella tabella 'wp_biblioteca_stanza' */
	public function updateSeatsInRoom( $field_stanza ) {
		$this->wpdb->update( self::TABLE_BIBLIOTECA_STANZA, [
			'posti_disponibili' => $this->getNumOfAvailableSeats($field_stanza)
		], [
			'nome_stanza' => $field_stanza
		] );
	}

	public function getReservedSeats() {
		return $this->wpdb->get_results( "SELECT numero_posto FROM " . self::TABLE_PRENOTAZIONE . ";" );
	}

	public function createSeats(): void {
		/* Prendo il numero totale dei posti disponibili nella stanza */
		$posti_tot = $this->wpdb->get_var( "SELECT posti_totali FROM " . self::TABLE_BIBLIOTECA_STANZA . ";" );

		/* Prendo l'id della stanza corrispondente */
		$get_stanza = $this->wpdb->get_var( "SELECT id_stanza FROM " . self::TABLE_BIBLIOTECA_STANZA . ";" );

		$i = 1;

		/* Prendo il numero di righe presenti nella tabella wp_biblioteca_posto */
		$row_count = $this->wpdb->get_var( "SELECT COUNT(*) FROM " . self::TABLE_BIBLIOTECA_POSTO . ";" );

		/* Creo tanti record quanti sono i posti totali presenti nella stanza selezionata */
		while ( $i <= $posti_tot ) {
			if ( $posti_tot === $row_count ) {
				break;
			}

			$this->wpdb->get_results( 'INSERT INTO ' . self::TABLE_BIBLIOTECA_POSTO .
			                          ' SET numero_posto = ' . $i . ', id_stanza = ' . $get_stanza . ' ' );
			$i += 1;
		}
	}

	public function delete( $row ) {
		if ( isset( $_POST['delete'] ) &&
		     $row->id_prenotazione == $_POST['id_prenotazione']) {

			$this->wpdb->delete( self::TABLE_PRENOTAZIONE, [
				'id_prenotazione' => $row->id_prenotazione
			] );

			$posti_rimanenti = self::getNumOfAvailableSeats($row->nome_stanza);

			$this->wpdb->update(self::TABLE_BIBLIOTECA_STANZA,[
				'posti_disponibili' => $posti_rimanenti
			],[
				'nome_stanza' => $row->nome_stanza
			]);
		}
	}

	public function deleteAll($row){
		$this->wpdb->get_results("TRUNCATE TABLE ".self::TABLE_PRENOTAZIONE."");

		$posti_rimanenti = self::getNumOfAvailableSeats($row->nome_stanza);

		$this->wpdb->update(self::TABLE_BIBLIOTECA_STANZA,[
			'posti_disponibili' => $posti_rimanenti
		],[
			'nome_stanza' => $row->nome_stanza
		]);
	}

	public function do_reservation( array $field ): void {
		$this->wpdb->insert( self::TABLE_PRENOTAZIONE, [
			'id_utente'       => $field['id_utente'],
			'nome_utente'     => $field['nome_utente'],
			'email_utente'    => $field['email_utente'],
			'nome_stanza'     => $field['nome_stanza'],
			'giorno'          => $field['giorno'],
			'ora_arrivo'      => $field['ora_arrivo'],
			'ora_partenza'    => $field['ora_partenza'],
			'tutto_il_giorno' => $field['tutto_il_giorno'] ?? 0,
			'numero_posto'    => $field['numero_posto'],
			'qr_code'         => ''
		] );
	}

	public function navigateTo( string $url ): void {
		/*Esempio: navigate('/prenotazione'), navigate('/scegli-posto'), ...;*/
		header( 'Location: ' . $url );
		exit;
	}

	public function select_by_value( $table, $column, $value ): array {
		return $this->wpdb->get_results( "SELECT {$column} FROM {$table} WHERE {$column} = '{$value}'" );
	}

	public function select_all( $table ): array {
		return $this->wpdb->get_results( "SELECT * FROM {$table}" );
	}
}
