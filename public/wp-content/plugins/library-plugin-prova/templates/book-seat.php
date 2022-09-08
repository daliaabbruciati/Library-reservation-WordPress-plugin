<!doctype html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca: Scegli posto</title>
    <link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__) . 'css/book-seat.css'; ?>">
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
    <div class="container__form">
        <h2>Prenota posto</h2>
        <form class="form" action="/prenotazione-confermata">
            <div class="form__stanza">
                <label for="stanza">Scegli stanza</label>
                <input name="stanza" type="number" id="stanza"min="1" max="2">
            </div>
            <div class="form__giorno">
                <label for="giorno">Scegli giorno</label>
                <input name="giorno" type="datetime-local" id="giorno">
            </div>
            <div class="form__ora-arrivo">
                <label for="ora-arrivo">Ora arrivo</label>
                <input name="ora-arrivo" type="time" id="ora-arrivo">
            </div>
            <div class="form__ora-partenza">
                <label for="ora-partenza">Ora partenza</label>
                <input name="ora-partenza" type="time" id="ora-partenza">
            </div>
            <div class="form__tutto-il-giorno">
                <label for="tutto-il-giorno">Tutto il giorno</label>
                <input name="tutto-il-giorno" type="checkbox" id="tutto-il-giorno" value="giorno-completo">
            </div>
            <div class="form__posto">
                <label for="posto">Scegli posto disponibile</label>
                <input name="posto" type="number" id="posto" min="1" max="120">
            </div>
            <input class="form__submit" type="submit" name="submit_prenotazione" value="Conferma">
        </form>
    </div>
    <div class="container__image">
        <img src="<?php echo plugin_dir_url(__FILE__) . '../assets/piantina-desktop.svg' ?>" alt="piantina-posti"/>
    </div>
</div>


<?php get_footer(); ?>

</body>
</html>

