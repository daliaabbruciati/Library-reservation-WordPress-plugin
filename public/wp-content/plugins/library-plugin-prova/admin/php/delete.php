<?php

use Plugin\DB\Database;

//include_once __DIR__ . '/../../DB/Database.php';
//$db = new Database(__FILE__);

$data = stripslashes(file_get_contents('php://input'));
$mydata = json_decode($data,true);
$id = $mydata['id_prenotazione'];

//echo 'ciao mondo';
//$db->deleteReservation($row);