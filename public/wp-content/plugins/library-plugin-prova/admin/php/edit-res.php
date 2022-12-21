<?php

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
	$old->id_prenotazione = htmlspecialchars( $_POST['id_prenotazione'] );
	$old->id_utente       = htmlspecialchars( $_POST['id_utente'] );
	$old->nome_utente     = htmlspecialchars( $_POST['nome_utente'] );
	$old->email_utente    = htmlspecialchars( $_POST['email_utente'] );
	$old->nome_stanza     = htmlspecialchars( $_POST['nome_stanza'] );
	$old->giorno          = htmlspecialchars( $_POST['giorno'] );
	$old->ora_arrivo      = htmlspecialchars( $_POST['ora_arrivo'] );
	$old->ora_partenza    = htmlspecialchars( $_POST['ora_partenza'] );
	$old->tutto_il_giorno = htmlspecialchars( isset( $_POST['tutto_il_giorno'] ) ? "si" : "no" );

	if ( $old->tutto_il_giorno === "si" ) {
		$old->ora_arrivo   = '09:00:00';
		$old->ora_partenza = '18:30:00';
	}

	if ( $old->ora_arrivo !== '09:00:00' && $old->ora_partenza !== '18:30:00' ) {
		$old->tutto_il_giorno = "no";
	}

	/* Controllo campi vuoti */
	if ( empty( $old->nome_stanza ) ) {
		echo 'Stanza non selezionata';
	}

	if ( empty( $old->giorno ) ) {
		echo 'Compila campo giorno';
	}

	if ( empty( $old->ora_arrivo ) ) {
		echo 'Compila campo ora arrivo';
	}

	if ( empty( $old->ora_partenza ) ) {
		echo  'Compila campo ora partenza';
	}

	if($old->ora_arrivo > $old->ora_partenza){
		$error = "Errore: ora di arrivo maggiore dell'ora di partenza.";
	}

	if ( empty( $old->tutto_il_giorno ) ) {
		echo 'Compila campo';
	}

}

if ( isset( $_POST['update'] ) ) {
	$old->id_prenotazione = htmlspecialchars( $_POST['id_prenotazione'] );
	$old->id_utente       = htmlspecialchars( $_POST['id_utente'] );
	$old->nome_utente     = htmlspecialchars( $_POST['nome_utente'] );
	$old->email_utente    = htmlspecialchars( $_POST['email_utente'] );
	$old->nome_stanza     = htmlspecialchars( $_POST['nome_stanza'] );
	$old->giorno          = htmlspecialchars( $_POST['giorno'] );
	$old->ora_arrivo      = htmlspecialchars( $_POST['ora_arrivo'] );
	$old->ora_partenza    = htmlspecialchars( $_POST['ora_partenza'] );
	$old->tutto_il_giorno = htmlspecialchars( $_POST['tutto_il_giorno'] );
	$old->numero_posto    = htmlspecialchars( $_POST['numero_posto'] );


//	if ( $old->ora_arrivo === '09:00:00' && $old->ora_partenza === '18:30:00' ) {
//		$old->tutto_il_giorno = "si";
//	} else {
//		$old->tutto_il_giorno = "no";
//	}

	$wpdb->update( $db::TABLE_PRENOTAZIONE, [
		'nome_utente'     => $old->nome_utente,
		'email_utente'    => $old->email_utente,
		'nome_stanza'     => $old->nome_stanza,
		'giorno'          => $old->giorno,
		'ora_arrivo'      => $old->ora_arrivo,
		'ora_partenza'    => $old->ora_partenza,
		'tutto_il_giorno' => $old->tutto_il_giorno,
		'numero_posto'    => $old->numero_posto
	], [
		'id_prenotazione' => $old->id_prenotazione
	] );

	print_r( $old );
	print_r( $_POST );

//	$db->updateReservedSeat( $old->numero_posto );
	$db->updateSeatsInRoom( $old->nome_stanza );
	echo '<h3>Utente modificato correttamente. Torna alla pagina <a href="http://localhost:10003/wp-admin/admin.php?page=library-plugin-prova%2Fadmin%2F.%2Fviews%2Fbooking-view.html.php">Panoramica</a></h3>';
}

