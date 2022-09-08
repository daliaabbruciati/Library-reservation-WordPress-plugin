<!doctype html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca: Signup</title>
    <link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__) . 'css/signup.css'; ?>">
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
    <h2>Crea account</h2>
    <div class="container__form">
        <form class="form" action="/successful-signin" method="post">
            <div class="form__nome-utente">
                <label for="nome_utente">Nome utente</label>
                <input name="nome_utente" type="text" id="nome_utente">
            </div>
            <div class="form__email">
                <label for="email">Email </label>
                <input name="email" type="email" id="email" aria-describedby="emailHelp">
            </div>
            <div class="form__password">
                <label for="password">Password</label>
                <input name="password" type="password" id="password">
            </div>
            <input class="form__submit" type="submit" name="registrati" value="Crea account">
        </form>
        <p>Hai gia un account? <a href="/prenotazione">Torna indietro e accedi</a></p>
    </div>
</div>

<?php get_footer(); ?>

</body>
</html>
