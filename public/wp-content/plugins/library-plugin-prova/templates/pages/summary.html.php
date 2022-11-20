<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca: Riepilogo prenotazione</title>
    <link rel="stylesheet" href="<?php echo plugin_dir_url( __DIR__ ) . '/../css/summary.css'; ?>">
</head>
<body>
<?php include 'header.html.php'; ?>

<div class="container">
    <h4>Riepilogo prenotazioni</h4>
    <div class="container-card">
        <div class="card">
            <p>Status</p>
            <p>Giorno</p>
            <p>Ora dalle alle</p>
            <p>Numero posto</p>
            <p>QR code</p>
            <div class="card__actions">
                <button>Modifica</button>
                <button>Elimina</button>
            </div>
        </div>
    </div>
    <a href="/scegli-posto">Torna alla scelta dei posti</a>
</div>


<?php include 'footer.html.php'; ?>

</body>
</html>


