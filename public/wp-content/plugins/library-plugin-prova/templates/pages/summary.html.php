<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca: Riepilogo prenotazione</title>
    <link rel="stylesheet" href="<?php echo plugin_dir_url( __DIR__ ) . '/../styles/summary.css'; ?>">
</head>
<body>
<?php
include 'header.html.php';

use Plugin\DB\Database;

include_once __DIR__ . '/../../DB/Database.php';
$db = new Database( __FILE__ );

date_default_timezone_set( "Europe/Rome" );
$currentDate = date( 'Y-m-d' );
$currentTime = date( "H:i:s" );

if ( isset( $_POST['delete'] ) ) {
	$db->wpdb->delete($db::TABLE_PRENOTAZIONE,[
		'id_prenotazione' => $_POST['id_prenotazione']
	]);
}

$getReservation = $db->wpdb->get_results( "SELECT * FROM " . $db::TABLE_PRENOTAZIONE . " WHERE email_utente = '" . $_SESSION['email'] . "' " );
?>

<div class="container">
    <h4>Riepilogo prenotazioni</h4>
    <div class="container-card">
		<?php
		if ( ! empty( $getReservation ) ):
			foreach ( $getReservation as $reservation ):
                $url = "https://api.qrserver.com/v1/create-qr-code/?data=id_prenotazione=$reservation->id_prenotazione,utente=$reservation->id_utente,posto=$reservation->numero_posto&size=200x200&margin=15";
				?>
                <div class="card">
                    <p>Id prenotazione: <?= $reservation->id_prenotazione; ?></p>
                    <p>Id utente: <?= $reservation->id_utente; ?></p>
                    <p>Nome utente: <?= $reservation->nome_utente; ?></p>
                    <p>Email utente: <?= $reservation->email_utente; ?></p>
                    <p>Nome stanza: <?= $reservation->nome_stanza; ?></p>
                    <p>Giorno: <?= $reservation->giorno; ?></p>
                    <p>Ora arrivo: <?= $reservation->ora_arrivo; ?></p>
                    <p>Ora partenza: <?= $reservation->ora_partenza; ?></p>
                    <p>Tutto il giorno: <?= $reservation->tutto_il_giorno; ?></p>
                    <p>Numero posto: <?= $reservation->numero_posto; ?></p>
                    <p>QR code:
	                    <?php if($reservation->qr_code === '0'):
		                    ?>
                            <img width="15px" height="15px" alt="cross" src="<?= plugin_dir_url( __DIR__ ) . '/../../assets/cross.png' ?>">
	                    <?php else:?>
                            <img width="15px" height="15px" alt="check" src="<?= plugin_dir_url( __DIR__ ) . '/../../assets/check.jpg' ?>">
	                    <?php endif; ?>
                    </p>
                    <div class="qr-section">
                        <img src="<?= $url ?>" alt="qr-code"/>
                    </div>
                    <?php
                    if($reservation->giorno < $currentDate && $reservation->ora_partenza < $currentTime){
                        echo "<p style='color: red' >Scaduta</p>";
                    }
                    ?>

                    <div class="card__actions">
                        <form method="post" action="/scegli-posto">
<!--                            <input type="hidden" name="edit" value="true">-->
                            <input type="hidden" name="id_prenotazione" value="<?= $reservation->id_prenotazione; ?>">
                            <input type="hidden" name="id_utente" value="<?= $reservation->id_utente; ?>">
                            <input type="hidden" name="nome_utente" value="<?= $reservation->nome_utente; ?>">
                            <input type="hidden" name="email_utente" value="<?= $reservation->email_utente; ?>">
                            <input type="hidden" name="nome_stanza" value="<?= $reservation->nome_stanza; ?>">
                            <input type="hidden" name="giorno" value="<?= $reservation->giorno; ?>">
                            <input type="hidden" name="ora_arrivo" value="<?= $reservation->ora_arrivo; ?>">
                            <input type="hidden" name="ora_partenza" value="<?= $reservation->ora_partenza; ?>">
                            <input type="hidden" name="tutto_il_giorno" value="<?= $reservation->tutto_il_giorno; ?>">
                            <input type="hidden" name="numero_posto" value="<?= $reservation->numero_posto; ?>">
                            <input type='submit' name='edit' id='edit' class='button button - secondary'
                                   value='Modifica'>
                        </form>

                        <form id="form_delete" method="post"
                              action="<?= htmlspecialchars( $_SERVER['REQUEST_URI'] ) ?>">
                            <input type="hidden" name="id_prenotazione" id="id_prenotazione"
                                   value="<?= $reservation->id_prenotazione; ?>">
                            <input type="hidden" name="numero_posto" id="numero_posto"
                                   value="<?= $reservation->numero_posto; ?>">
                            <input type="hidden" name="nome_stanza" value="<?= $reservation->nome_stanza; ?>">
                            <input type="submit" name="delete" id="delete"
                                   class="button button-link-delete"
                                   value="Elimina">
                        </form>
                    </div>
                </div>
			<?php
			endforeach;
			?>
		<?php
		else:
			?>
            <h6 class="back">Non ci sono prenotazioni</h6>
		<?php
		endif;
		?>
    </div>
    <a class="back" href="/scegli-posto">Torna alla scelta dei posti</a>
</div>

<?php include 'footer.html.php'; ?>

</body>
</html>


