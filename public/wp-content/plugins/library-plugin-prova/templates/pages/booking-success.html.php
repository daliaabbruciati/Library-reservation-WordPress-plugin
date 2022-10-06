<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca: Prenotazione confermata</title>
    <link rel="stylesheet" href="<?php echo plugin_dir_url(__DIR__) . '/../css/booking-success.css'; ?>">
</head>
<body>
<?php include 'header.html.php';?>

<div class="container">
    <h2>Prenotazione effettuata!</h2>
    <p>Ecco il QR code per accedere alla biblioteca. <br><strong>Buono studio!</strong></p>
    <h2>immagine qr code</h2>
    <p>Ricordati che la validità del QR code è di <strong>30 min</strong> dall'ora della prenotazione</p>
    <button>Scarica QR code</button>
    <a href="/prenotazione">Torna alla home</a>
</div>

<?php include 'footer.html.php';?>

</body>
</html>

