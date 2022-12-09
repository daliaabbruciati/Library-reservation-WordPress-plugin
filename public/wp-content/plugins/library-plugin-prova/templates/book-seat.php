<?php

use Plugin\DB\Database;

include_once __DIR__ . '/../DB/Database.php';
$db = new Database( __FILE__ );

$field = [
	'id_utente'       => '',
	'nome_utente'     => '',
	'email_utente'    => '',
	'nome_stanza'     => '',
	'giorno'          => '',
	'ora_arrivo'      => '',
	'ora_partenza'    => '',
	'tutto_il_giorno' => '',
	'numero_posto'    => ''
];
$error = [
	'nome_stanza'     => '',
	'giorno'          => '',
	'ora_arrivo'      => '',
	'ora_partenza'    => '',
	'tutto_il_giorno' => '',
	'numero_posto'    => ''
];


if ( isset( $_POST['continua'] ) ) {
	$field['id_utente']       = htmlspecialchars( $_POST['id_utente'] );
	$field['nome_utente']     = htmlspecialchars( $_POST['nome_utente'] );
	$field['email_utente']    = htmlspecialchars( $_POST['email_utente'] );
	$field['nome_stanza']     = htmlspecialchars( $_POST['nome_stanza'] );
	$field['giorno']          = htmlspecialchars( $_POST['giorno'] );
	$field['ora_arrivo']      = htmlspecialchars( $_POST['ora_arrivo'] );
	$field['ora_partenza']    = htmlspecialchars( $_POST['ora_partenza'] );
	$field['tutto_il_giorno'] = htmlspecialchars( isset( $_POST['tutto_il_giorno'] ) ? "si" : "no" );

	if ( $field['tutto_il_giorno'] === "si" ) {
		$field['ora_arrivo']   = '09:00:00';
		$field['ora_partenza'] = '18:30:00';
	}

	/* Controllo campi vuoti */
	if ( empty( $field['nome_stanza'] ) ) {
		$error['nome_stanza'] = 'Stanza non selezionata';
	}
	if ( empty( $field['giorno'] ) ) {
		$error['giorno'] = 'Compila campo giorno';
	}
	if ( empty( $field['ora_arrivo'] ) ) {
		$error['ora_arrivo'] = 'Compila campo ora arrivo';
	}
	if ( empty( $field['ora_partenza'] ) ) {
		$error['ora_partenza'] = 'Compila campo ora partenza';
	}
	if ( empty( $field['tutto_il_giorno'] ) ) {
		$error['tutto_il_giorno'] = 'Compila campo';
	}
}

if(isset($_POST['submit_prenotazione'])){
	$field['id_utente']       = htmlspecialchars( $_POST['id_utente'] );
	$field['nome_utente']     = htmlspecialchars( $_POST['nome_utente'] );
	$field['email_utente']    = htmlspecialchars( $_POST['email_utente'] );
	$field['nome_stanza']     = htmlspecialchars( $_POST['nome_stanza'] );
	$field['giorno']          = htmlspecialchars( $_POST['giorno'] );
	$field['ora_arrivo']      = htmlspecialchars( $_POST['ora_arrivo'] );
	$field['ora_partenza']    = htmlspecialchars( $_POST['ora_partenza'] );
	$field['tutto_il_giorno'] = htmlspecialchars( $_POST['tutto_il_giorno']);

	$field['numero_posto']    = htmlspecialchars( $_POST['numero_posto'] );

	if ( empty( $field['numero_posto'] ) ) {
		$error['numero_posto'] = 'Posto non selezionato';
	}

	if ( empty( array_filter( $error ) ) ) {
		$db->do_reservation( $field );
		$db->updateAvailableSeats( $field['numero_posto'], $field['nome_stanza'] );
	}
	print_r( array_filter( $field ) );
}


include_once __DIR__ . '/./pages/book-seat.html.php';
