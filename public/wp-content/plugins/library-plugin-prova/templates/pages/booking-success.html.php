<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca: Prenotazione confermata</title>
    <link rel="stylesheet" href="<?php echo plugin_dir_url( __DIR__ ) . '/../styles/booking-success.css'; ?>">
</head>
<body>

<?php

use Plugin\DB\Database;

$db = new Database( __FILE__ );
$prova = $_SESSION['nome'];
$id = $field['id_utente'];
$posto = $field['numero_posto'];

$getIdReservation = $db->wpdb->get_var("SELECT MAX(id_prenotazione) FROM wp_prenotazione WHERE id_utente = '$id'");

    //$email = urlencode($field['email_utente']);
    //$url = "https://api.qrserver.com/v1/create-qr-code/?data=$email&size=200x200&margin=15&format=jpg";
    $url = "https://api.qrserver.com/v1/create-qr-code/?data=id_utente=$id,posto=$posto&size=200x200&margin=15&formato=jpg";

?>

<div class="container">
    <h2>Prenotazione effettuata!</h2>
    <p>Congratulazioni <strong><?= $_SESSION['nome'] ?></strong></p>
    <p>Ecco il riepilogo della tua prenotazione:</p>
    <table class="card">
		<?php
		if ( ! empty( $field ) ):
			foreach ( $field as $key => $value ):
				?>
                <tbody>
                <tr class="card-items">
                    <td class="item"><?= $key ?></td>
                    <td class="item"><?= $value ?></td>
                </tr>
                </tbody>
			<?php
			endforeach;
		endif; ?>
    </table>
    <div class="qr-code">
        <p>Ecco il QR code per accedere alla biblioteca. <br><strong>Buono studio!</strong></p>
        <img src="<?= $url ?>" alt="qr-code"/>
        <p>Ricordati che la validità del QR code è di <strong>30 min</strong> dall'ora della prenotazione</p>

        <form  method="get" action="<?= htmlspecialchars( $_SERVER['REQUEST_URI'] ) ?>">
        <input type="hidden" name="id_prenotazione" value="1">
        <input type="hidden" name="id_utente" value="2">
        <input type="hidden" name="posto" value="5">
        <input type="hidden" name="email" value="<?= $field['email_utente'] ?>">
            <input type="submit" name="download" value="Download"/>
        </form>
    </div>
    <div class="links">
        <a aria-label="Vai al riepilogo prenotazioni" href="/riepilogo">Vedi riepilogo prenotazioni</a>
        <a aria-label="Effettua nuova prenotazione" href="/scegli-posto">Torna alla scelta dei posti</a>
    </div>
</div>
<?php include 'footer.html.php'; ?>
</body>
</html>

