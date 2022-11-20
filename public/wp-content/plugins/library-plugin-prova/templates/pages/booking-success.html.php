<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca: Prenotazione confermata</title>
    <link rel="stylesheet" href="<?php echo plugin_dir_url(__DIR__) . '/../css/booking-success.css'; ?>">
<!--    <script src="--><?//= plugin_dir_url(__DIR__) . '/../js/getQrCode.js'; ?><!--"></script>-->
</head>
<body>

<?php

//header('Content-Type: application/json');
//$input_data = file_get_contents(plugin_dir_url(__DIR__).'/../js/getQrCode.js');
//$output_data = $input_data;
//echo $output_data;
//exit;

//TODO: modificare 'nome' con id_prenotazione dell'utente
// il qr code prende il posto, quando arrivo scannerizzo il tavolo...
$prova = $_SESSION['nome'];
//$id = $_SESSION['id'];
$email = $_SESSION['email'];

$url = "https://api.qrserver.com/v1/create-qr-code/?data=$email&size=200x200&margin=15";

?>

<div class="container">
    <h2>Prenotazione effettuata!</h2>
    <p>Congratulazioni <?= $_SESSION['nome'] ?></p>
    <p>Ecco il QR code per accedere alla biblioteca. <br><strong>Buono studio!</strong></p>
<!--    <div id="qrcode"></div>-->
    <img src="<?= $url ?>" alt="qr-code"/>
    <p>Ricordati che la validità del QR code è di <strong>30 min</strong> dall'ora della prenotazione</p>
    <button>Scarica QR code</button>
    <a href="/riepilogo">Vedi riepilogo prenotazioni</a>
    <a href="/scegli-posto">Torna alla scelta dei posti</a>
</div>

<?php include 'footer.html.php'; ?>

</body>
</html>

