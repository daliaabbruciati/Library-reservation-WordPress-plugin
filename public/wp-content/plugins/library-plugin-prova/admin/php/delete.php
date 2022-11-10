<?php

//use Plugin\DB\Database;

//include_once __DIR__ . '/../../library-plugin-prova.php';
//$data = stripslashes(file_get_contents('php://input'));
//$mydata = json_decode($data,true);
//$id = $mydata['id_prenotazione'];

$_POST = json_decode( file_get_contents( "php://input" ), true );
//echo $_POST['data_id'];

//var_dump($_POST);
//exit();

if ( isset( $_POST['delete'] ) ) {
	header( "'Content-Type': 'application/json'" );
	if ( !$wpdb->delete( $database::TABLE_PRENOTAZIONE, [
		'id_prenotazione' => $_POST['id']
	] ) ) {
		echo json_encode( array( "result" => 'Error' ) );
		exit();
	};
//	if ( ! $database->deleteReservation( $_POST['id'] ) ) {
//		header( "'Content-Type': 'application/json'" );
//		echo json_encode( array( "result" => 'Error' ) );
//		exit();
//	}
	header( "'Content-Type': 'application/json'" );
	echo json_encode( array( "result" => "Success" ) );
	exit();
}
