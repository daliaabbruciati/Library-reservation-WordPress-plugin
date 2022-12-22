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

//header('Content-Type: application/json');
//$input_data = file_get_contents(plugin_dir_url(__DIR__).'/../js/getQrCode.js');
//$output_data = $input_data;
//echo $output_data;
//exit;

use Plugin\DB\Database;

$db = new Database( __FILE__ );

$prova = $_SESSION['nome'];
//$id = $_SESSION['id'];
//$email = $_SESSION['email'];
$id = $field['id_utente'];
$posto = $field['numero_posto'];

$getIdReservation = $db->wpdb->get_var("SELECT MAX(id_prenotazione) FROM wp_prenotazione WHERE id_utente = '$id'");

    $email = urlencode($field['email_utente']);
    $url = "https://api.qrserver.com/v1/create-qr-code/?data=$email&size=200x200&margin=15&format=jpg";

//if ( isset($_POST['download'])) {
//    die('morto');
////	$data     = urlencode( $_GET['id_prenotazione']. $_GET['id_utente'] . $_GET['posto'] );
////    $url = "https://api.qrserver.com/v1/create-qr-code/?data=id_prenotazione=$getIdReservation,utente=$id,posto=$posto&size=200x200&margin=15&format=jpg";
////	$file_url = $url;
//	header( "Content-Type: image/jpg" );
//	header( "Content-Transfer-Encoding: Binary" );
//	header( "Content-Disposition: attachment; filename=qrcode.jpg" );
//	readfile( $url );
//	exit( 0 );
//}

?>

<div class="container">
    <h2>Prenotazione effettuata!</h2>
    <p>Congratulazioni <?= $_SESSION['nome'] ?></p>
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
<!--    <script>-->
<!--        function downloadFile(url, fileName){-->
<!--            fetch(url, { method: 'get', mode: 'no-cors', referrerPolicy: 'no-referrer' })-->
<!--                .then(res => res.blob())-->
<!--                .then(res => {-->
<!--                    const aElement = document.createElement('a');-->
<!--                    aElement.setAttribute('download', fileName);-->
<!--                    const href = URL.createObjectURL(res);-->
<!--                    aElement.href = href;-->
<!--                    // aElement.setAttribute('href', href);-->
<!--                    aElement.setAttribute('target', '_blank');-->
<!--                    aElement.click();-->
<!--                    URL.revokeObjectURL(href);-->
<!--                });-->
<!--        }-->
<!--        document.getElementById('qrcode-download').onclick =function () {-->
<!--            downloadFile('https://www.kdnuggets.com/wp-content/uploads/newsletter.png', 'qrcode.png');-->
<!--        }-->
<!--    </script>-->
    <div class="links">
        <a href="/riepilogo">Vedi riepilogo prenotazioni</a>
        <a href="/scegli-posto">Torna alla scelta dei posti</a>
    </div>
</div>

<?php include 'footer.html.php'; ?>

</body>
</html>

