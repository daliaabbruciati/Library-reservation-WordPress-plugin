<?php

$field = [ 'nome_utente'     => '',
           'email_utente'    => '',
           'nome_stanza'     => '',
           'giorno'          => '',
           'ora_arrivo'      => '',
           'ora_partenza'    => '',
           'tutto_il_giorno' => '',
           'numero_posto'    => ''
];
$error = [ 'nome_utente'     => '',
           'email_utente'    => '',
           'nome_stanza'     => '',
           'giorno'          => '',
           'ora_arrivo'      => '',
           'ora_partenza'    => '',
           'tutto_il_giorno' => '',
           'numero_posto'    => ''
];


if ( isset( $_POST['update'] ) && $old->id_prenotazione == $_POST['id_prenotazione'] ) {
	$field['nome_utente']     = htmlspecialchars($_POST['nome_utente']);
	$field['email_utente']    = htmlspecialchars($_POST['email_utente'] );
	$field['nome_stanza']     = htmlspecialchars($_POST['nome_stanza'] ?? 'none');
	$field['giorno']          = htmlspecialchars($_POST['giorno']);
	$field['ora_arrivo']      = htmlspecialchars($_POST['ora_arrivo']);
	$field['ora_partenza']    = htmlspecialchars($_POST['ora_partenza']);
	$field['tutto_il_giorno'] = htmlspecialchars($_POST['tutto_il_giorno'] ?? 'no');
	$field['numero_posto']    = htmlspecialchars($_POST['numero_posto']);


	if($field['tutto_il_giorno'] !== 'no'){
		$field['ora_arrivo'] = '09:00:00';
		$field['ora_partenza'] = '18:30:00';
	}

	$wpdb->update( $db::TABLE_PRENOTAZIONE, [
		'nome_utente'     => $field['nome_utente'],
		'email_utente'    => $field['email_utente'],
		'nome_stanza'     => $field['nome_stanza'],
		'giorno'          => $field['giorno'],
		'ora_arrivo'      => $field['ora_arrivo'],
		'ora_partenza'    => $field['ora_partenza'],
		'tutto_il_giorno' => $field['tutto_il_giorno'] ?? 0,
		'numero_posto'    => $field['numero_posto'],
	], [
		'id_prenotazione' => $old->id_prenotazione
	] );

	print_r(array_filter($field));

	$db->updateReservedSeat( $old->numero_posto );
	$db->updateSeatsInRoom( $field['nome_stanza'] );
	echo '<h3>Utente modificato correttamente. Torna alla pagina <a href="http://localhost:10003/wp-admin/admin.php?page=library-plugin-prova%2Fadmin%2F.%2Fviews%2Fbooking-view.html.php">Panoramica</a></h3>';
}
