<?php
include_once __DIR__ . '/../../includes/functions/Validation.php';
include_once __DIR__ . '/../../DB/Database.php';

use Plugin\Functions\Validation;
use Plugin\DB\Database;

$validation = new Validation();
$db         = new Database( __FILE__ );

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
	'nome_utente'     => '',
	'email_utente'    => '',
	'nome_stanza'     => '',
	'giorno'          => '',
	'ora_arrivo'      => '',
	'ora_partenza'    => '',
	'tutto_il_giorno' => '',
	'numero_posto'    => ''
];


if ( isset( $_POST['continua'] ) ) {
	$field['nome_utente']     = htmlspecialchars($_POST['nome_utente']);
	$field['email_utente']    = htmlspecialchars($_POST['email_utente']);
	$field['nome_stanza']     = htmlspecialchars($_POST['nome_stanza']);
	$field['giorno']          = htmlspecialchars($_POST['giorno']);
	$field['ora_arrivo']      = htmlspecialchars($_POST['ora_arrivo']);
	$field['ora_partenza']    = htmlspecialchars($_POST['ora_partenza']);
	$field['tutto_il_giorno'] = htmlspecialchars(isset($_POST['tutto_il_giorno']) ? "si" : "no");

	if($field['tutto_il_giorno'] === "si"){
		$field['ora_arrivo'] = '09:00:00';
		$field['ora_partenza'] = '18:30:00';
	}

	/* Restituisce il valore dell'id riferito all'email dell'utente */
	$findUserId = $wpdb->get_var( "SELECT ID FROM " . $db::TABLE_UTENTI .
	                              " WHERE user_email = '" . $field['email_utente'] . "';" );

	$field['id_utente'] = $findUserId;

	/* Check errors in input fields */
	if ( empty( $field['nome_utente'] ) || ! $validation->isValidName( $field['nome_utente'] ) ) {
		$error['nome_utente'] = "<span class='error-field'>Campo nome errato.</span>";
	}

	if ( empty( $field['email_utente'] ) || ! $validation->isValidEmail( $field['email_utente'] ) ) {
		$error['email_utente'] = "<span class='error-field'>Campo email errato.</span>";
	} else {
		if ( ! $validation->isAlreadyRegistered( $db::TABLE_UTENTI, 'user_email', $_POST['email_utente'] ) ) {
			$error['email_utente'] = "<span class='error-field'>Utente non registrato.</span>";
		}
	}

	if ( empty( $field['nome_stanza'] ) ) {
		$error['nome_stanza'] = "<span class='error-field'>Campo nome stanza vuoto.</span>";
	}

	if ( empty( $field['giorno'] ) ) {
		$error['giorno'] = "<span class='error-field'>Campo giorno errato.</span>";
	}

	if ( empty( $field['ora_arrivo'] ) ) {
		$error['ora_arrivo'] = "<span class='error-field'>Campo ora arrivo errato.</span>";
	}

	if ( empty( $field['ora_partenza'] ) ) {
		$error['ora_partenza'] = "<span class='error-field'>Campo ora partenza errato.</span>";
	}
}

if ( isset( $_POST['add'] ) ) {
	$field['nome_utente']     = htmlspecialchars($_POST['nome_utente']);
	$field['email_utente']    = htmlspecialchars($_POST['email_utente']);
	$field['nome_stanza']     = htmlspecialchars($_POST['nome_stanza']);
	$field['giorno']          = htmlspecialchars($_POST['giorno']);
	$field['ora_arrivo']      = htmlspecialchars($_POST['ora_arrivo']);
	$field['ora_partenza']    = htmlspecialchars($_POST['ora_partenza']);
	$field['tutto_il_giorno'] = htmlspecialchars(isset($_POST['tutto_il_giorno']) ? "si" : "no");
	$field['numero_posto'] = htmlspecialchars($_POST['numero_posto']);

	/* Restituisce il valore dell'id riferito all'email dell'utente */
	$findUserId = $wpdb->get_var( "SELECT ID FROM " . $db::TABLE_UTENTI .
	                              " WHERE user_email = '" . $field['email_utente'] . "';" );

	$field['id_utente'] = $findUserId;

	if ( ! isset( $field['numero_posto'] ) || ! filter_input( INPUT_POST, 'numero_posto', FILTER_SANITIZE_NUMBER_INT ) ) {
		$error['numero_posto'] = "<span class='error-field'>Campo numero posto vuoto.</span>";
	}
}

if ( isset( $_POST['add'] ) && empty( array_filter( $error ) ) ) {
	$db->do_reservation( $field );
	$db->updateAvailableSeats( $field['numero_posto'], $field['nome_stanza'] );
	echo "<h3>Prenotazione aggiunta correttamente.Vai alla schermata <a href='admin.php?page=library-plugin-prova%2Fadmin%2F.%2Fviews%2Fbooking-view.html.php'>Panoramica</a></h3>";
}

