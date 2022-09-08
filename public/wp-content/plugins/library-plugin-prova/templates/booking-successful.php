<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca: Prenotazione confermata</title>
    <link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__) . 'css/booking-successful.css'; ?>">
</head>
<body>
<?php
wp_head();
get_header();
//wp_nav_menu([
//    'theme_location' => 'library-primary-menu'
//]);

?>

<div class="container">
    <h2>Prenotazione effettuata!</h2>
    <p>Ecco il QR code per accedere alla biblioteca.</p>
    <p><strong>Buono studio!</strong></p>
    <h2>immagine qr code</h2>
    <p>Ricordati che la validità del QR code è di 30 min dall'ora della prenotazione</p>
    <button>Scarica QR code</button>
    <a href="/prenotazione">Torna alla home</a>
</div>

<?php get_footer(); ?>

</body>
</html>

